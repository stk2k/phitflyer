<?php
namespace PhitFlyer;

use NetDriver\NetDriverInterface;
use NetDriver\NetDriverHandleInterface;
use NetDriver\Http\HttpRequest;
use NetDriver\Http\HttpGetRequest;
use NetDriver\Http\JsonPostRequest;
use NetDriver\NetDriver\Curl\CurlNetDriver;

use PhitFlyer\Exception\PhitFlyerClientExceptionInterface;
use PhitFlyer\Exception\PhitFlyerClientException;
use PhitFlyer\Exception\WebApiCallException;
use PhitFlyer\Exception\ServerResponseFormatException;

/**
 * PhitFlyer client class
 */
class PhitFlyerClient implements PhitFlyerClientInterface
{
    /** @var null|string  */
    private $api_key;
    
    /** @var null|string  */
    private $api_secret;

    /** @var NetDriverHandleInterface  */
    private $netdriver_handle;
    
    /** @var null */
    private $last_request;
    
    /** @var NetDriverInterface */
    private $net_driver;

    /** @var NetDriverChangeListenerInterface[] */
    private $listeners;
    
    /**
     * construct
     *
     * @param string|null $api_key
     * @param string|null $api_secret
     */
    public function __construct($api_key = null, $api_secret = null){
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->netdriver_handle = null;
        $this->last_request = null;
        $this->listeners = [];
    }

    /**
     * get last request
     *
     * @return HttpRequest
     */
    public function getLastRequest()
    {
        return $this->last_request;
    }

    /**
     * add net driver change listener
     *
     * @param NetDriverChangeListenerInterface|callable $listener
     */
    public function addNetDriverChangeListener($listener)
    {
        if (is_callable($listener) || $listener instanceof NetDriverChangeListenerInterface)
        $this->listeners[] = $listener;
    }

    /**
     * set net driver
     * 
     * @param NetDriverInterface $net_driver
     */
    public function setNetDriver(NetDriverInterface $net_driver)
    {
        $this->net_driver = $net_driver;

        // callback
        $this->fireNetDriverChangeEvent($net_driver);
    }

    /**
     * net driver change callback
     *
     * @param NetDriverInterface $net_driver
     */
    private function fireNetDriverChangeEvent(NetDriverInterface $net_driver)
    {
        foreach($this->listeners as $l) {
            if ($l instanceof NetDriverChangeListenerInterface) {
                $l->onNetDriverChanged($net_driver);
            }
            else if (is_callable($l)) {
                $l($net_driver);
            }
        }
    }

    /**
     * get net friver
     *
     * @return CurlNetDriver|NetDriverInterface
     */
    public function getNetDriver()
    {
        if ($this->net_driver){
            return $this->net_driver;
        }
        $this->net_driver = new CurlNetDriver();
        // callback
        $this->fireNetDriverChangeEvent($this->net_driver);
        return $this->net_driver;
    }

    /**
     * get net driver handle
     *
     * @return NetDriverHandleInterface|null
     */
    public function getNetDriverHandle()
    {
        if ($this->netdriver_handle){
            return $this->netdriver_handle;
        }
        $this->netdriver_handle = $this->getNetDriver()->newHandle();
        return $this->netdriver_handle;
    }

    /**
     * make request URL
     *
     * @param string $api
     * @param array $query_data
     *
     * @return string
     */
    private static function getURL($api, array $query_data = null)
    {
        $url = PhitFlyerApi::ENDPOINT . $api;
        if ($query_data){
            $url .= '?' . http_build_query($query_data);
        }
        return $url;
    }
    
    /**
     * call web API by HTTP/GET
     *
     * @param string $api
     * @param array|null $query_data
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    private function get($api, array $query_data = [])
    {
        $query_data = array_filter($query_data, function($v){
            return $v !== null;
        });

        $url = self::getURL($api, $query_data);
        
        $request = new HttpGetRequest($this->getNetDriver(), $url);
    
        return $this->executeRequest($request);
    }
    
    /**
     * call web API(private) by HTTP/GET
     *
     * @param string $api
     * @param array|null $query_data
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    private function privateGet($api, array $query_data = [])
    {
        $query_data = array_filter($query_data, function($v){
            return $v !== null;
        });

        $timestamp = time();
        $method = 'GET';
        $body = !empty($query_data) ? '?' . http_build_query($query_data) : '';
        $text = $timestamp . $method . $api . $body;
        $sign = hash_hmac('sha256', $text, $this->api_secret);
        
        $options['http-headers'] = array(
            'ACCESS-KEY' => $this->api_key,
            'ACCESS-TIMESTAMP' => $timestamp,
            'ACCESS-SIGN' => $sign,
        );
        
        $url = self::getURL($api, $query_data);
        $request = new HttpGetRequest($this->getNetDriver(), $url, $options);
    
        return $this->executeRequest($request);
    }
    
    /**
     * call web API(private) by HTTP/POST
     *
     * @param string $api
     * @param array $post_data
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    private function privatePost($api, array $post_data = null)
    {
        $post_data = array_filter($post_data, function($v){
            return $v !== null;
        });
        
        $timestamp = time();
        $method = 'POST';
        $body = !empty($post_data) ? json_encode($post_data, JSON_FORCE_OBJECT) : '';
        $text = $timestamp . $method . $api . $body;
        $sign = hash_hmac('sha256', $text, $this->api_secret);
        
        $options['http-headers'] = array(
            'Content-Type' => 'application/json',
            'ACCESS-KEY' => $this->api_key,
            'ACCESS-TIMESTAMP' => $timestamp,
            'ACCESS-SIGN' => $sign,
        );
        
        $url = self::getURL($api);
        $request = new JsonPostRequest($this->getNetDriver(), $url, $post_data, $options);
    
        return $this->executeRequest($request);
    }
    
    /**
     * execute request
     *
     * @param HttpRequest $request
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    private function executeRequest($request)
    {
        try{
            $response = $this->net_driver->sendRequest($this->getNetDriverHandle(), $request);

            $this->last_request = $request;

            $json = @json_decode($response->getBody(), true);
            if ($json === null){
                throw new WebApiCallException(json_last_error_msg() . '/' . $response->getBody());
            }
            return $json;
        }
        catch(\Throwable $e)
        {
            throw new PhitFlyerClientException('NetDriver#sendRequest() failed: ' . $e->getMessage(), $e);
        }
    }
    
    /**
     * [public] get markets
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getMarkets()
    {
        // HTTP GET
        $json = $this->get(PhitFlyerApi::MARKETS);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [public] get board
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoard($product_code = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code
        );
        $json = $this->get(PhitFlyerApi::BOARD, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [public] get ticker
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getTicker($product_code = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code
        );
        $json = $this->get(PhitFlyerApi::TICKER, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [public] get executions
     *
     * @param string $product_code
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getExecutions($product_code = null, $before = null, $after = null, $count = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code,
            'before' => $before,
            'after' => $after,
            'count' => $count,
        );
        $json = $this->get(PhitFlyerApi::EXECUTIONS, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [public] get board state
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoardState($product_code = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code,
        );
        $json = $this->get(PhitFlyerApi::GETBOARDSTATE, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [public] get health
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getHealth()
    {
        // HTTP GET
        $json = $this->get(PhitFlyerApi::GETHEALTH);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [public] get chats
     *
     * @param string $from_date
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getChats($from_date = null)
    {
        // HTTP GET
        $query_data = array(
            'from_date' => $from_date
        );
        $json = $this->get(PhitFlyerApi::GETCHATS, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get permissions
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPermissions()
    {
        // HTTP GET
        $json = $this->privateGet(PhitFlyerApi::ME_GETPERMISSIONS);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get balance
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetBalance()
    {
        // HTTP GET
        $json = $this->privateGet(PhitFlyerApi::ME_GETBALANCE);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get collateral
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCollateral()
    {
        // HTTP GET
        $json = $this->privateGet(PhitFlyerApi::ME_GETCOLLATERAL);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get collateral accounts
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCollateralAccounts()
    {
        // HTTP GET
        $json = $this->privateGet(PhitFlyerApi::ME_GETCOLLATERALACCOUNTS);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get address
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetAddress()
    {
        // HTTP GET
        $json = $this->privateGet(PhitFlyerApi::ME_GETADDRESS);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get coin ins
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCoinIns($before = null, $after = null, $count = null)
    {
        // HTTP GET
        $query_data = array(
            'before' => $before,
            'after' => $after,
            'count' => $count,
        );
        $json = $this->privateGet(PhitFlyerApi::ME_GETCOININS, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get coin outs
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCoinOuts($before = null, $after = null, $count = null)
    {
        // HTTP GET
        $query_data = array(
            'before' => $before,
            'after' => $after,
            'count' => $count,
        );
        $json = $this->privateGet(PhitFlyerApi::ME_GETCOINOUTS,$query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get bank accounts
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetBankAccounts()
    {
        // HTTP GET
        $json = $this->privateGet(PhitFlyerApi::ME_GETBANKACCOUNTS);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get deposits
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetDeposits($before = null, $after = null, $count = null)
    {
        // HTTP GET
        $query_data = array(
            'before' => $before,
            'after' => $after,
            'count' => $count,
        );
        $json = $this->privateGet(PhitFlyerApi::ME_GETDEPOSITS, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] send child order
     *
     * @param string $product_code
     * @param string $child_order_type
     * @param string $side
     * @param integer $price
     * @param float $size
     * @param integer $minute_to_expire
     * @param string $time_in_force
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire = null, $time_in_force = null)
    {
        // HTTP POST
        $post_data = array(
            'product_code' => $product_code,
            'child_order_type' => $child_order_type,
            'side' => $side,
            'price' => $price,
            'size' => $size,
            'minute_to_expire' => $minute_to_expire,
            'time_in_force' => $time_in_force,
        );
        $json = $this->privatePost(PhitFlyerApi::ME_SENDCHILDORDER, $post_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] cancel child order
     *
     * @param string $product_code
     * @param string $child_order_id
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meCancelChildOrder($product_code, $child_order_id)
    {
        // HTTP POST
        $post_data = array(
            'product_code' => $product_code,
            'child_order_id' => $child_order_id,
        );
        $this->privatePost(PhitFlyerApi::ME_CANCELCHILDORDER, $post_data);
    }
    
    /**
     * [private] cancel child order
     *
     * @param string $product_code
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meCancelAllChildOrders($product_code)
    {
        // HTTP POST
        $post_data = array(
            'product_code' => $product_code,
        );
        $this->privatePost(PhitFlyerApi::ME_CANCELALLCHILDORDERS, $post_data);
    }
    
    /**
     * [private] get child orders
     *
     * @param string $product_code
     * @param integer $before
     * @param integer $after
     * @param integer $count
     * @param string $child_order_state
     * @param string $parent_order_id
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetChildOrders($product_code, $before = null, $after = null, $count = null, $child_order_state = null, $parent_order_id = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code,
            'before' => $before,
            'after' => $after,
            'count' => $count,
            'child_order_state' => $child_order_state,
            'parent_order_id' => $parent_order_id,
        );
        $json = $this->privateGet(PhitFlyerApi::ME_GETCHILDORDERS, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get executions
     *
     * @param string $product_code
     * @param integer $before
     * @param integer $after
     * @param integer $count
     * @param string $child_order_id
     * @param string $child_order_acceptance_id
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetExecutions($product_code, $before = null, $after = null, $count = null, $child_order_id = null, $child_order_acceptance_id = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code,
            'before' => $before,
            'after' => $after,
            'count' => $count,
            'child_order_id' => $child_order_id,
            'child_order_acceptance_id' => $child_order_acceptance_id,
        );
        $json = $this->privateGet(PhitFlyerApi::ME_GETEXECUTIONS, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get positions
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPositions($product_code)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code,
        );
        $json = $this->privateGet(PhitFlyerApi::ME_GETPOSITIONS, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get trading commission
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetTradingCommission($product_code)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code,
        );
        $json = $this->privateGet(PhitFlyerApi::ME_GETTRADINGCOMMISSION, $query_data);
        // check return type
        if (!is_array($json)){
            throw new ServerResponseFormatException('response must be an array, but returned:' . gettype($json));
        }
        return $json;
    }
    
}