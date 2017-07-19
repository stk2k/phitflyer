<?php
namespace PhitFlyer;

use PhitFlyer\Object\Market;
use PhitFlyer\Object\Board;
use PhitFlyer\Object\Ticker;
use PhitFlyer\Object\Execution;
use PhitFlyer\Object\Health;
use PhitFlyer\Object\Chat;
use PhitFlyer\Exception\ServerResponseFormatException;
use PhitFlyer\Exception\BitflyerClientException;


/**
 * Benchmark decorator
 */
class PhitFlyerBenchmarkClient implements IPhitFlyerClient
{
    const ENDPOINT_URL            = 'https://api.bitflyer.jp/v1/';
    const BITFLYER_API_MARKETS    = 'markets';
    const BITFLYER_API_BOARD      = 'board';
    
    private $flyer;
    private $callback;
    
    /**
     * construct
     *
     * callback is like this:
     *
     * function benchmark_callback($method, $elapsed){
     *    echo 'method:' . $method . PHP_EOL;
     *    echo 'elapsed:' . $elapsed . PHP_EOL;
     * }
     *
     * @param IPhitFlyerClient $flyer
     * @param callable $callback
     */
    public function __construct($flyer, $callback){
        $this->flyer = $flyer;
        $this->callback = $callback;
    }
    
    /**
     * execute benchmark with result
     *
     * @param callable $bench_func
     * @param array|null $args
     * @param integer $precision
     *
     * @return array
     */
    private static function bench($bench_func, $args = null, $precision = 4)
    {
        $start = microtime(true);
        if ($args){
            $result = call_user_func_array($bench_func, $args);
        }
        else{
            $result = call_user_func($bench_func);
        }
        $end = microtime(true);
        $elapsed = round($end - $start, $precision);
        return array( $result, $elapsed );
    }
    
    /**
     * execute benchmark with no result
     *
     * @param callable $bench_func
     * @param array|null $args
     * @param integer $precision
     *
     * @return float
     */
    private static function benchNoResult($bench_func, $args = null, $precision = 4)
    {
        $start = microtime(true);
        if ($args){
            call_user_func_array($bench_func, $args);
        }
        else{
            call_user_func($bench_func);
        }
        $end = microtime(true);
        $elapsed = round($end - $start, $precision);
        return $elapsed;
    }
    
    /**
     * [public] get markets
     *
     * @return Market[]|null
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getMarkets()
    {
        $bench_func = array( $this->flyer, 'getMarkets' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('getMarkets', $elapsed));
        return $result;
    }
    
    /**
     * [public] get boards
     *
     * @param string $product_code
     *
     * @return Board
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getBoard($product_code = null)
    {
        $bench_func = array( $this->flyer, 'getBoard' );
        $args = array( $product_code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getBoard', $elapsed));
        return $result;
    }
    
    /**
     * [public] get ticker
     *
     * @param string $product_code
     *
     * @return Ticker
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getTicker($product_code = null)
    {
        $bench_func = array( $this->flyer, 'getTicker' );
        $args = array( $product_code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getTicker', $elapsed));
        return $result;
    }
    
    /**
     * [public] get executions
     *
     * @param string $product_code
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return Execution[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getExecutions($product_code = null, $before = null, $after = null, $count = null)
    {
        $bench_func = array( $this->flyer, 'getExecutions' );
        $args = array( $product_code, $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getExecutions', $elapsed));
        return $result;
    }
    
    /**
     * [public] get health
     *
     * @return Health
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getHealth()
    {
        $bench_func = array( $this->flyer, 'getHealth' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('getHealth', $elapsed));
        return $result;
    }
    
    /**
     * [public] get chats
     *
     * @param string $from_date
     *
     * @return Chat[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getChats($from_date = null)
    {
        $bench_func = array( $this->flyer, 'getChats' );
        $args = array( $from_date );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getChats', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetPermissions' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetPermissions', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetBalance' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetBalance', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetCollateral' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetCollateral', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetCollateralAccounts' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetCollateralAccounts', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetAddress' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetAddress', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetCoinIns' );
        $args = array( $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetCoinIns', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetCoinOuts' );
        $args = array( $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetCoinOuts', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetBankAccounts' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetBankAccounts', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetDeposits' );
        $args = array( $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetDeposits', $elapsed));
        return $result;
    }
    
    /**
     * [private] withdraw
     *
     * @param string $currency_code
     * @param integer $bank_account_id
     * @param integer $amount
     * @param string|null $code
     *
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meWithdraw($currency_code, $bank_account_id, $amount, $code = null)
    {
        $bench_func = array( $this->flyer, 'meWithdraw' );
        $args = array( $currency_code, $bank_account_id, $amount, $code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meWithdraw', $elapsed));
        return $result;
    }
    
    /**
     * [private] get withdrawals
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetWithdrawals($before = null, $after = null, $count = null)
    {
        $bench_func = array( $this->flyer, 'meGetWithdrawals' );
        $args = array( $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetWithdrawals', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meSendChildOrder' );
        $args = array( $product_code, $child_order_type, $side, $price, $size, $minute_to_expire, $time_in_force );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meSendChildOrder', $elapsed));
        return $result;
    }
    
    /**
     * [private] cancel child order
     *
     * @param string $product_code
     * @param string $child_order_id
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meCancelChildOrder($product_code, $child_order_id)
    {
        $bench_func = array( $this->flyer, 'meCancelChildOrder' );
        $args = array( $product_code, $child_order_id );
        $elapsed = self::benchNoResult($bench_func, $args);
        call_user_func_array($this->callback, array('meCancelChildOrder', $elapsed));
    }
    
    /**
     * [private] cancel all child orders
     *
     * @param string $product_code
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meCancelAllChildOrders($product_code)
    {
        $bench_func = array( $this->flyer, 'meCancelAllChildOrders' );
        $args = array( $product_code, );
        $elapsed = self::benchNoResult($bench_func, $args);
        call_user_func_array($this->callback, array('meCancelAllChildOrders', $elapsed));
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
        $bench_func = array( $this->flyer, 'meGetChildOrders' );
        $args = array( $product_code, $before, $after, $count, $child_order_state, $parent_order_id );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetChildOrders', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetExecutions' );
        $args = array( $product_code, $before, $after, $count, $child_order_id, $child_order_acceptance_id );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetExecutions', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetPositions' );
        $args = array( $product_code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetPositions', $elapsed));
        return $result;
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
        $bench_func = array( $this->flyer, 'meGetTradingCommission' );
        $args = array( $product_code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetTradingCommission', $elapsed));
        return $result;
    }
}