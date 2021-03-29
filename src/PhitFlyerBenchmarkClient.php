<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer;

use Stk2k\NetDriver\Http\HttpRequest;
use Stk2k\NetDriver\NetDriverInterface;

/**
 * Benchmark decorator
 */
class PhitFlyerBenchmarkClient implements PhitFlyerClientInterface
{
    private $client;
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
     * @param PhitFlyerClientInterface $flyer
     * @param callable $callback
     */
    public function __construct(PhitFlyerClientInterface $flyer, callable $callback){
        $this->client = $flyer;
        $this->callback = $callback;
    }

    /**
     * get last request
     *
     * @return HttpRequest|null
     */
    public function getLastRequest() : ?HttpRequest
    {
        return $this->client->getLastRequest();
    }

    /**
     * add net driver change listener
     *
     * @param NetDriverChangeListenerInterface|callable $listener
     */
    public function addNetDriverChangeListener($listener)
    {
        $this->client->addNetDriverChangeListener($listener);
    }

    /**
     * get net driver
     *
     * @return NetDriverInterface|null
     */
    public function getNetDriver() : ?NetDriverInterface
    {
        return $this->client->getNetDriver();
    }

    /**
     * set net driver
     *
     * @param NetDriverInterface $net_driver
     */
    public function setNetDriver(NetDriverInterface $net_driver)
    {
        $this->client->setNetDriver($net_driver);
    }

    /**
     * execute benchmark with result
     *
     * @param callable $bench_func
     * @param array|null $args
     * @param int $precision
     *
     * @return array
     */
    private static function bench(callable $bench_func, array $args = null, int $precision = 4) : array
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
        return [$result, $elapsed];
    }
    
    /**
     * execute benchmark with no result
     *
     * @param callable $bench_func
     * @param array|null $args
     * @param int $precision
     *
     * @return float
     */
    private static function benchNoResult(callable $bench_func, array $args = null, $precision = 4) : float
    {
        $start = microtime(true);
        if ($args){
            call_user_func_array($bench_func, $args);
        }
        else{
            call_user_func($bench_func);
        }
        $end = microtime(true);
        return round($end - $start, $precision);
    }
    
    /**
     * [public] get markets
     *
     * @return mixed
     */
    public function getMarkets()
    {
        $bench_func = array( $this->client, 'getMarkets' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('getMarkets', $elapsed));
        return $result;
    }
    
    /**
     * [public] get boards
     *
     * @param string|null $product_code
     *
     * @return mixed
     */
    public function getBoard(string $product_code = null)
    {
        $bench_func = array( $this->client, 'getBoard' );
        $args = array( $product_code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getBoard', $elapsed));
        return $result;
    }
    
    /**
     * [public] get ticker
     *
     * @param string|null $product_code
     *
     * @return mixed
     */
    public function getTicker(string $product_code = null)
    {
        $bench_func = array( $this->client, 'getTicker' );
        $args = array( $product_code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getTicker', $elapsed));
        return $result;
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
     */
    public function getExecutions(string $product_code = null, int $before = null, int $after = null, int $count = null)
    {
        $bench_func = array( $this->client, 'getExecutions' );
        $args = array( $product_code, $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getExecutions', $elapsed));
        return $result;
    }
    
    /**
     * [public] get board state
     *
     * @param string|null $product_code
     *
     * @return mixed
     */
    public function getBoardState(string $product_code = null)
    {
        $bench_func = array( $this->client, 'getBoardState' );
        $args = array( $product_code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getBoardState', $elapsed));
        return $result;
    }
    
    /**
     * [public] get health
     *
     * @return mixed
     */
    public function getHealth()
    {
        $bench_func = array( $this->client, 'getHealth' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('getHealth', $elapsed));
        return $result;
    }
    
    /**
     * [public] get chats
     *
     * @param string|null $from_date
     *
     * @return mixed
     */
    public function getChats(string $from_date = null)
    {
        $bench_func = array( $this->client, 'getChats' );
        $args = array( $from_date );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('getChats', $elapsed));
        return $result;
    }
    
    /**
     * [private] get permissions
     *
     * @return mixed
     */
    public function meGetPermissions()
    {
        $bench_func = array( $this->client, 'meGetPermissions' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetPermissions', $elapsed));
        return $result;
    }
    
    /**
     * [private] get balance
     *
     * @return mixed
     */
    public function meGetBalance()
    {
        $bench_func = array( $this->client, 'meGetBalance' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetBalance', $elapsed));
        return $result;
    }
    
    /**
     * [private] get collateral
     *
     * @return mixed
     */
    public function meGetCollateral()
    {
        $bench_func = array( $this->client, 'meGetCollateral' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetCollateral', $elapsed));
        return $result;
    }
    
    /**
     * [private] get collateral accounts
     *
     * @return mixed
     */
    public function meGetCollateralAccounts()
    {
        $bench_func = array( $this->client, 'meGetCollateralAccounts' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetCollateralAccounts', $elapsed));
        return $result;
    }
    
    /**
     * [private] get address
     *
     * @return mixed
     */
    public function meGetAddress()
    {
        $bench_func = array( $this->client, 'meGetAddress' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetAddress', $elapsed));
        return $result;
    }
    
    /**
     * [private] get coin ins
     *
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     *
     * @return mixed
     */
    public function meGetCoinIns(int $before = null, int $after = null, int $count = null)
    {
        $bench_func = array( $this->client, 'meGetCoinIns' );
        $args = array( $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetCoinIns', $elapsed));
        return $result;
    }
    
    /**
     * [private] get coin outs
     *
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     *
     * @return mixed
     */
    public function meGetCoinOuts(int $before = null, int $after = null, int $count = null)
    {
        $bench_func = array( $this->client, 'meGetCoinOuts' );
        $args = array( $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetCoinOuts', $elapsed));
        return $result;
    }
    
    /**
     * [private] get bank accounts
     *
     * @return mixed
     */
    public function meGetBankAccounts()
    {
        $bench_func = array( $this->client, 'meGetBankAccounts' );
        list($result, $elapsed) = self::bench($bench_func);
        call_user_func_array($this->callback, array('meGetBankAccounts', $elapsed));
        return $result;
    }
    
    /**
     * [private] get deposits
     *
     * @param int|null $before
     * @param int|null $after
     * @param int|null $count
     *
     * @return mixed
     */
    public function meGetDeposits(int $before = null, int $after = null, int $count = null)
    {
        $bench_func = array( $this->client, 'meGetDeposits' );
        $args = array( $before, $after, $count );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetDeposits', $elapsed));
        return $result;
    }
    
    /**
     * [private] withdraw
     *
     * @param string $currency_code
     * @param int $bank_account_id
     * @param int $amount
     * @param string|null $code
     *
     * @return mixed
     * @noinspection PhpUnused
     */
    public function meWithdraw(string $currency_code, int $bank_account_id, int $amount, string $code = null)
    {
        $bench_func = array( $this->client, 'meWithdraw' );
        $args = array( $currency_code, $bank_account_id, $amount, $code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meWithdraw', $elapsed));
        return $result;
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
     */
    public function meSendChildOrder(string $product_code, string $child_order_type, string $side, int $price, float $size,
                                     int $minute_to_expire = null, string $time_in_force = null)
    {
        $bench_func = array( $this->client, 'meSendChildOrder' );
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
     */
    public function meCancelChildOrder(string $product_code, string $child_order_id)
    {
        $bench_func = array( $this->client, 'meCancelChildOrder' );
        $args = array( $product_code, $child_order_id );
        $elapsed = self::benchNoResult($bench_func, $args);
        call_user_func_array($this->callback, array('meCancelChildOrder', $elapsed));
    }
    
    /**
     * [private] cancel all child orders
     *
     * @param string $product_code
     */
    public function meCancelAllChildOrders(string $product_code)
    {
        $bench_func = array( $this->client, 'meCancelAllChildOrders' );
        $args = array( $product_code, );
        $elapsed = self::benchNoResult($bench_func, $args);
        call_user_func_array($this->callback, array('meCancelAllChildOrders', $elapsed));
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
     */
    public function meGetChildOrders(string $product_code, int $before = null, int $after = null, int $count = null,
                                     string $child_order_state = null, string $parent_order_id = null)
    {
        $bench_func = array( $this->client, 'meGetChildOrders' );
        $args = array( $product_code, $before, $after, $count, $child_order_state, $parent_order_id );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetChildOrders', $elapsed));
        return $result;
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
     */
    public function meGetExecutions(string $product_code, int $before = null, int $after = null, int $count = null,
                                    string $child_order_id = null, string $child_order_acceptance_id = null)
    {
        $bench_func = array( $this->client, 'meGetExecutions' );
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
     * @return mixed
     */
    public function meGetPositions(string $product_code)
    {
        $bench_func = array( $this->client, 'meGetPositions' );
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
     * @return mixed
     */
    public function meGetTradingCommission(string $product_code)
    {
        $bench_func = array( $this->client, 'meGetTradingCommission' );
        $args = array( $product_code );
        list($result, $elapsed) = self::bench($bench_func, $args);
        call_user_func_array($this->callback, array('meGetTradingCommission', $elapsed));
        return $result;
    }
}