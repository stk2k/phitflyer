<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer;

use Throwable;

use Stk2k\NetDriver\NetDriverInterface;
use Stk2k\NetDriver\NetDriverHandleInterface;
use Stk2k\NetDriver\Http\HttpRequest;
use Stk2k\NetDriver\Http\HttpGetRequest;
use Stk2k\NetDriver\Http\JsonPostRequest;
use Stk2k\NetDriver\Drivers\Curl\CurlNetDriver;

use Stk2k\PhitFlyer\Exception\PhitFlyerClientExceptionInterface;
use Stk2k\PhitFlyer\Exception\PhitFlyerClientException;
use Stk2k\PhitFlyer\Exception\WebApiCallException;
use Stk2k\PhitFlyer\Exception\ServerResponseFormatException;

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
     * @return HttpRequest|null
     */
    public function getLastRequest() : ?HttpRequest
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
     * @return NetDriverInterface|null
     */
    public function getNetDriver() : ?NetDriverInterface
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
    public function getNetDriverHandle() : ?NetDriverHandleInterface
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
     * @param array|null $query_data
     *
     * @return string
     */
    private static function getURL(string $api, array $query_data = null) : string
    {
        $url = PhitFlyerApi::ENDPOINT . $api;
        if ($query_data){
            $glue = strpos($url,'?') === false ? '?' : '&';
            $url .= $glue . http_build_query($query_data);
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
    private function get(string $api, array $query_data = [])
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
    private function privateGet(string $api, array $query_data = [])
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
     * @param array|null $post_data
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    private function privatePost(string $api, array $post_data = null)
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
    private function executeRequest(HttpRequest $request)
    {
        try{
            $response = $this->net_driver->sendRequest($this->getNetDriverHandle(), $request);

            $this->last_request = $request;

            $json = @json_decode($response->getBody(), true);
            if ($json === null){
                throw new WebApiCallException(json_last_error_msg());
            }
            return $json;
        }
        catch(Exception $e)
        {
            throw new PhitFlyerClientException('NetDriver#sendRequest() failed: ' . $e->getMessage(), $e);
        }
    }
    
    /**
     * [public] get markets
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
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
     * @param string|null $product_code
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getBoard(string $product_code = null)
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
     * @param string|null $product_code
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getTicker(string $product_code = null)
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
     * @param string|null $product_code
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getExecutions(string $product_code = null, int $before = null, int $after = null, int $count = null)
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
     * @param string|null $product_code
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getBoardState(string $product_code = null)
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
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
     * @param string|null $from_date
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getChats(string $from_date = null)
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
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
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function meGetCoinIns(int $before = null, int $after = null, int $count = null)
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
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function meGetCoinOuts(int $before = null, int $after = null, int $count = null)
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
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
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function meGetDeposits(int $before = null, int $after = null, int $count = null)
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
     * @param int $price
     * @param float $size
     * @param int|null $minute_to_expire
     * @param string|null $time_in_force
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function meSendChildOrder(string $product_code, string $child_order_type, string $side, int $price, float $size,
                                     int $minute_to_expire = null, string $time_in_force = null)
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
    public function meCancelChildOrder(string $product_code, string $child_order_id)
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
    public function meCancelAllChildOrders(string $product_code)
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
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     * @param string|null $child_order_state
     * @param string|null $parent_order_id
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function meGetChildOrders(string $product_code, int $before = null, int $after = null, int $count = null,
                                     string $child_order_state = null, string $parent_order_id = null)
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
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     * @param string|null $child_order_id
     * @param string|null $child_order_acceptance_id
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function meGetExecutions(string $product_code, int $before = null, int $after = null, int $count = null,
                                    string $child_order_id = null, string $child_order_acceptance_id = null)
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function meGetPositions(string $product_code)
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function meGetTradingCommission(string $product_code)
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
