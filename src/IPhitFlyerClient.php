<?php
namespace PhitFlyer;

use PhitFlyer\Object\Market;
use PhitFlyer\Object\Board;
use PhitFlyer\Object\Ticker;
use PhitFlyer\Object\Execution;
use PhitFlyer\Object\BoardState;
use PhitFlyer\Object\Health;
use PhitFlyer\Object\Chat;
use PhitFlyer\Exception\BitflyerClientException;
use PhitFlyer\Exception\ServerResponseFormatException;

/**
 * PhitFlyer interface
 */
interface IPhitFlyerClient
{
    /**
     * [public] get markets
     *
     * @return Market[]|null
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getMarkets();
    
    /**
     * [public] get board
     *
     * @param string $product_code
     *
     * @return Board
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getBoard($product_code = null);
    
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
    public function getTicker($product_code = null);
    
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
    public function getExecutions($product_code = null, $before = null, $after = null, $count = null);
    
    
    /**
     * [public] get board state
     *
     * @param string $product_code
     *
     * @return BoardState
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getBoardState($product_code = null);
    
    /**
     * get health
     *
     * @return Health
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function getHealth();
    
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
    public function getChats($from_date = null);
    
    /**
     * [private] get permissions
     *
     * @return array
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetPermissions();
    
    /**
     * [private] get balance
     *
     * @return array
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetBalance();
    
    /**
     * [private] get collateral
     *
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetCollateral();
    
    /**
     * [private] get collateral accounts
     *
     * @return array
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetCollateralAccounts();
    
    /**
     * [private] get address
     *
     * @return array
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetCoinOuts($before = null, $after = null, $count = null);
    
    /**
     * [private] get bank accounts
     *
     * @return array
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @return object
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire = null, $time_in_force = null);
    
    /**
     * [private] cancel child order
     *
     * @param string $product_code
     * @param string $child_order_id
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meCancelChildOrder($product_code, $child_order_id);
    
    /**
     * [private] cancel all child orders
     *
     * @param string $product_code
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
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
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetExecutions($product_code, $before = null, $after = null, $count = null, $child_order_id = null, $child_order_acceptance_id = null);
    
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
    public function meGetPositions($product_code);
    
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
    public function meGetTradingCommission($product_code);
    
}