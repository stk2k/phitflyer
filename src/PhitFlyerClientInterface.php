<?php
namespace PhitFlyer;

use NetDriver\Http\HttpRequest;
use NetDriver\NetDriverInterface;

use PhitFlyer\Exception\PhitFlyerClientExceptionInterface;

/**
 * PhitFlyer interface
 */
interface PhitFlyerClientInterface
{
    /**
     * get last request
     *
     * @return HttpRequest
     */
    public function getLastRequest();

    /**
     * add net driver change listener
     *
     * @param NetDriverChangeListenerInterface|callable $listener
     */
    public function addNetDriverChangeListener($listener);

    /**
     * get net driver
     *
     * @return NetDriverInterface
     */
    public function getNetDriver();

    /**
     * set net driver
     *
     * @param NetDriverInterface $net_driver
     */
    public function setNetDriver(NetDriverInterface $net_driver);

    /**
     * [public] get markets
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getMarkets();
    
    /**
     * [public] get board
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoard($product_code = null);
    
    /**
     * [public] get ticker
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getTicker($product_code = null);
    
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
    public function getExecutions($product_code = null, $before = null, $after = null, $count = null);
    
    
    /**
     * [public] get board state
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoardState($product_code = null);
    
    /**
     * get health
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getHealth();
    
    /**
     * [public] get chats
     *
     * @param string $from_date
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getChats($from_date = null);
    
    /**
     * [private] get permissions
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPermissions();
    
    /**
     * [private] get balance
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetBalance();
    
    /**
     * [private] get collateral
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCollateral();
    
    /**
     * [private] get collateral accounts
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCollateralAccounts();
    
    /**
     * [private] get address
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetAddress();
    
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
    public function meGetCoinIns($before = null, $after = null, $count = null);
    
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
    public function meGetCoinOuts($before = null, $after = null, $count = null);
    
    /**
     * [private] get bank accounts
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetBankAccounts();
    
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
    public function meGetDeposits($before = null, $after = null, $count = null);
    
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
    public function meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire = null, $time_in_force = null);
    
    /**
     * [private] cancel child order
     *
     * @param string $product_code
     * @param string $child_order_id
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meCancelChildOrder($product_code, $child_order_id);
    
    /**
     * [private] cancel all child orders
     *
     * @param string $product_code
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meCancelAllChildOrders($product_code);
    
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
    public function meGetChildOrders($product_code, $before = null, $after = null, $count = null, $child_order_state = null, $parent_order_id = null);
    
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
    public function meGetExecutions($product_code, $before = null, $after = null, $count = null, $child_order_id = null, $child_order_acceptance_id = null);
    
    /**
     * [private] get positions
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPositions($product_code);
    
    /**
     * [private] get trading commission
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetTradingCommission($product_code);
    
}