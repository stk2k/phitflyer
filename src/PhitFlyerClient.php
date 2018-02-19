<?php
namespace PhitFlyer;

use PhitFlyer\Exception\BitflyerClientException;
use PhitFlyer\Exception\ServerResponseFormatException;
use PhitFlyer\Http\CurlRequest;
use PhitFlyer\Http\HttpGetRequest;
use PhitFlyer\Http\JsonPostRequest;
use PhitFlyer\Http\CurlHandle;


/**
 * PhitFlyer client class
 */
class PhitFlyerClient implements IPhitFlyerClient
{
    const DEFAULT_USERAGENT    = 'phitFlyer';
    
    private $api_key;
    private $api_secret;
    private $user_agent;
    private $curl_handle;
    private $last_request;
    
    /**
     * construct
     *
     * @param string|null $api_key
     * @param string|null $api_secret
     */
    public function __construct($api_key = null, $api_secret = null){
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->user_agent = self::DEFAULT_USERAGENT;
        $this->curl_handle = new CurlHandle();
        $this->last_request = null;
    }
    
    /**
     * get last request
     *
     * @return CurlRequest
     */
    public function getLastRequest()
    {
        return $this->last_request;
    }
    
    /**
     * get user agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->user_agent;
    }
    
    /**
     * make request URL
     *
     * @param string $api
     *
     * @return string
     */
    private static function getURL($api)
    {
        return PhitFlyerApi::ENDPOINT . $api;
    }
    
    /**
     * call web API by HTTP/GET
     *
     * @param string $api
     * @param array|null $query_data
     * @param bool $return_value
     *
     * @return mixed
     *
     * @throws BitflyerClientException
     */
    private function get($api, $query_data = null, $return_value = true)
    {
        $url = self::getURL($api);
    
        $query_data = is_array($query_data) ? array_filter($query_data, function($v){
            return $v !== null;
        }) : null;
        
        $request = new HttpGetRequest($this, $url, $query_data);
    
        return $this->executeRequest($request, $return_value);
    }
    
    /**
     * call web API(private) by HTTP/GET
     *
     * @param string $api
     * @param array|null $query_data
     * @param bool $return_value
     *
     * @return mixed
     *
     * @throws BitflyerClientException
     */
    private function privateGet($api, $query_data = null, $return_value = true)
    {
        $query_data = is_array($query_data) ? array_filter($query_data, function($v){
            return $v !== null;
        }) : null;
        
        $timestamp = time();
        $method = 'GET';
        $body = !empty($query_data) ? '?' . http_build_query($query_data) : '';
        $text = $timestamp . $method . $api . $body;
        $sign = hash_hmac('sha256', $text, $this->api_secret);
        
        $options['http_headers'] = array(
            'ACCESS-KEY' => $this->api_key,
            'ACCESS-TIMESTAMP' => $timestamp,
            'ACCESS-SIGN' => $sign,
        );
        //$options['verbose'] = 1;
        
        $url = self::getURL($api);
        $request = new HttpGetRequest($this, $url, $query_data, $options);
    
        return $this->executeRequest($request, $return_value);
    }
    
    /**
     * call web API(private) by HTTP/POST
     *
     * @param string $api
     * @param array $post_data
     * @param bool $return_value
     *
     * @return mixed
     *
     * @throws BitflyerClientException
     */
    private function privatePost($api, $post_data = null, $return_value = true)
    {
        $post_data = is_array($post_data) ? array_filter($post_data, function($v){
            return $v !== null;
        }) : null;
        
        $timestamp = time();
        $method = 'POST';
        $body = !empty($post_data) ? json_encode($post_data, JSON_FORCE_OBJECT) : '';
        $text = $timestamp . $method . $api . $body;
        $sign = hash_hmac('sha256', $text, $this->api_secret);
        
        $options['http_headers'] = array(
            'Content-Type' => 'application/json',
            'ACCESS-KEY' => $this->api_key,
            'ACCESS-TIMESTAMP' => $timestamp,
            'ACCESS-SIGN' => $sign,
        );
        
        $url = self::getURL($api);
        $request = new JsonPostRequest($this, $url, $post_data, $options);
    
        return $this->executeRequest($request, $return_value);
    }
    
    /**
     * execute request
     *
     * @param CurlRequest $request
     * @param bool $return_value
     *
     * @return mixed
     *
     * @throws BitflyerClientException
     */
    private function executeRequest($request, $return_value = true)
    {
        $json = $request->execute($this->curl_handle, $return_value);
    
        $this->last_request = $request;
    
        return $json;
    }
    
    /**
     * [public] get markets
     *
     * @return array
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getBoard($product_code = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code
        );
        $json = $this->get(PhitFlyerApi::BOARD, $query_data);
        // check return type
        if (!is_object($json)){
            throw new ServerResponseFormatException('response must be an object, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [public] get ticker
     *
     * @param string $product_code
     *
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getTicker($product_code = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code
        );
        $json = $this->get(PhitFlyerApi::TICKER, $query_data);
        // check return type
        if (!is_object($json)){
            throw new ServerResponseFormatException('response must be an object, but returned:' . gettype($json));
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getBoardState($product_code = null)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code,
        );
        $json = $this->get(PhitFlyerApi::GETBOARDSTATE, $query_data);
        // check return type
        if (!is_object($json)){
            throw new ServerResponseFormatException('response must be an object, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [public] get health
     *
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getHealth()
    {
        // HTTP GET
        $json = $this->get(PhitFlyerApi::GETHEALTH);
        // check return type
        if (!is_object($json)){
            throw new ServerResponseFormatException('response must be an object, but returned:' . gettype($json));
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetCollateral()
    {
        // HTTP GET
        $json = $this->privateGet(PhitFlyerApi::ME_GETCOLLATERAL);
        // check return type
        if (!is_object($json)){
            throw new ServerResponseFormatException('response must be an object, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] get collateral accounts
     *
     * @return array
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
        if (!is_object($json)){
            throw new ServerResponseFormatException('response must be an object, but returned:' . gettype($json));
        }
        return $json;
    }
    
    /**
     * [private] cancel child order
     *
     * @param string $product_code
     * @param string $child_order_id
     *
     * @throws BitflyerClientException
     */
    public function meCancelChildOrder($product_code, $child_order_id)
    {
        // HTTP POST
        $post_data = array(
            'product_code' => $product_code,
            'child_order_id' => $child_order_id,
        );
        $this->privatePost(PhitFlyerApi::ME_CANCELCHILDORDER, $post_data, false);
    }
    
    /**
     * [private] cancel child order
     *
     * @param string $product_code
     *
     * @throws BitflyerClientException
     */
    public function meCancelAllChildOrders($product_code)
    {
        // HTTP POST
        $post_data = array(
            'product_code' => $product_code,
        );
        $this->privatePost(PhitFlyerApi::ME_CANCELALLCHILDORDERS, $post_data, false);
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetTradingCommission($product_code)
    {
        // HTTP GET
        $query_data = array(
            'product_code' => $product_code,
        );
        $json = $this->privateGet(PhitFlyerApi::ME_GETTRADINGCOMMISSION, $query_data);
        // check return type
        if (!is_object($json)){
            throw new ServerResponseFormatException('response must be an object, but returned:' . gettype($json));
        }
        return $json;
    }
    
}