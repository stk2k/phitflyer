<?php
namespace PhitFlyer;

use PhitFlyer\Object\Market;
use PhitFlyer\Object\Board;
use PhitFlyer\Object\Ticker;
use PhitFlyer\Object\Execution;
use PhitFlyer\Object\BoardState;
use PhitFlyer\Object\Health;
use PhitFlyer\Object\Chat;
use PhitFlyer\Object\MeBalance;
use PhitFlyer\Object\MeCollateral;
use PhitFlyer\Object\MeCollateralAccount;
use PhitFlyer\Object\MeAddress;
use PhitFlyer\Object\MeCoinIn;
use PhitFlyer\Object\MeCoinOut;
use PhitFlyer\Object\MeBankAccount;
use PhitFlyer\Object\MeDeposit;
use PhitFlyer\Object\MeWithdrawMessage;
use PhitFlyer\Object\MeWithdrawal;
use PhitFlyer\Object\MeChildOrderResult;
use PhitFlyer\Object\MeChildOrder;
use PhitFlyer\Object\MeExecution;
use PhitFlyer\Object\MePosition;
use PhitFlyer\Object\MeCommission;
use PhitFlyer\Exception\ServerResponseFormatException;
use PhitFlyer\Exception\BitflyerClientException;

/**
 * Object decorator
 */
class PhitFlyerObjectClient implements IPhitFlyerClient
{
    private $flyer;
    
    /**
     * construct
     *
     * @param IPhitFlyerClient $flyer
     */
    public function __construct($flyer){
        $this->flyer = $flyer;
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
        // get result from server
        $json = $this->flyer->getMarkets();
        // make market list
        $items = array();
        foreach ($json as $item){
            $items[] = Market::fromObject($item);
        }
        return $items;
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
        // get result from server
        $json = $this->flyer->getBoard($product_code);
        // make board
        return Board::fromObject($json);
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
        // get result from server
        $json = $this->flyer->getTicker($product_code);
        // make ticker
        return Ticker::fromObject($json);
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
        // get result from server
        $json = $this->flyer->getExecutions($product_code, $before, $after, $count);
        // make execution list
        $items = array();
        foreach ($json as $item){
            $items[] = Execution::fromObject($item);
        }
        return $items;
    }
    
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
    public function getBoardState($product_code = null)
    {
        // get result from server
        $json = $this->flyer->getBoardState($product_code);
        // make board state
        return BoardState::fromObject($json);
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
        // get result from server
        $json = $this->flyer->getHealth();
        // make health
        return Health::fromObject($json);
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
        // get result from server
        $json = $this->flyer->getChats($from_date);
        // make chat list
        $items = array();
        foreach ($json as $item){
            $items[] = Chat::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get permissions
     *
     * @return string[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetPermissions()
    {
        // get result from server
        $json = $this->flyer->meGetPermissions();
        return $json;
    }
    
    /**
     * [private] get balance
     *
     * @return MeBalance[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetBalance()
    {
        // get result from server
        $json = $this->flyer->meGetBalance();
        // make balances list
        $items = array();
        foreach ($json as $item){
            $items[] = MeBalance::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get collateral
     *
     * @return MeCollateral
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetCollateral()
    {
        // get result from server
        $json = $this->flyer->meGetCollateral();
        // make collateral
        return MeCollateral::fromObject($json);
    }
    
    /**
     * [private] get collateral accounts
     *
     * @return MeCollateralAccount[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetCollateralAccounts()
    {
        // get result from server
        $json = $this->flyer->meGetCollateralAccounts();
        // make collateral account list
        $items = array();
        foreach ($json as $item){
            $items[] = MeCollateralAccount::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get address
     *
     * @return MeAddress[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetAddress()
    {
        // get result from server
        $json = $this->flyer->meGetAddress();
        // make address list
        $items = array();
        foreach ($json as $item){
            $items[] = MeAddress::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get coin ins
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return MeCoinIn[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetCoinIns($before = null, $after = null, $count = null)
    {
        // get result from server
        $json = $this->flyer->meGetCoinIns($before, $after, $count);
        // make coin in list
        $items = array();
        foreach ($json as $item){
            $items[] = MeCoinIn::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get coin outs
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return MeCoinOut[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetCoinOuts($before = null, $after = null, $count = null)
    {
        // get result from server
        $json = $this->flyer->meGetCoinOuts($before, $after, $count);
        // make coin out list
        $items = array();
        foreach ($json as $item){
            $items[] = MeCoinOut::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get bank accounts
     *
     * @return MeBankAccount[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetBankAccounts()
    {
        // get result from server
        $json = $this->flyer->meGetBankAccounts();
        // make bank account list
        $items = array();
        foreach ($json as $item){
            $items[] = MeBankAccount::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get deposits
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return MeDeposit[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetDeposits($before = null, $after = null, $count = null)
    {
        // get result from server
        $json = $this->flyer->meGetDeposits($before, $after, $count);
        // make deposit list
        $items = array();
        foreach ($json as $item){
            $items[] = MeDeposit::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] withdraw
     *
     * @param string $currency_code
     * @param integer $bank_account_id
     * @param integer $amount
     * @param string|null $code
     *
     * @return MeWithdrawMessage
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meWithdraw($currency_code, $bank_account_id, $amount, $code = null)
    {
        // get result from server
        $json = $this->flyer->meWithdraw($currency_code, $bank_account_id, $amount, $code);
        // make message
        return MeWithdrawMessage::fromObject($json);
    }
    
    /**
     * [private] get withdrawals
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return MeWithdrawal[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetWithdrawals($before = null, $after = null, $count = null)
    {
        // get result from server
        $json = $this->flyer->meGetWithdrawals($before, $after, $count);
        // make withdrawal list
        $items = array();
        foreach ($json as $item){
            $items[] = MeWithdrawal::fromObject($item);
        }
        return $items;
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
     * @return MeChildOrderResult
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire = null, $time_in_force = null)
    {
        // get result from server
        $json = $this->flyer->meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire, $time_in_force);
        // make message
        return MeChildOrderResult::fromObject($json);
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
        // get result from server
        $this->flyer->meCancelChildOrder($product_code, $child_order_id);
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
        // get result from server
        $this->flyer->meCancelAllChildOrders($product_code);
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
     * @return MeChildOrder[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetChildOrders($product_code, $before = null, $after = null, $count = null, $child_order_state = null, $parent_order_id = null)
    {
        // get result from server
        $json = $this->flyer->meGetChildOrders($before, $after, $count);
        // make child order list
        $items = array();
        foreach ($json as $item){
            $items[] = MeChildOrder::fromObject($item);
        }
        return $items;
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
     * @return MeExecution[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetExecutions($product_code, $before = null, $after = null, $count = null, $child_order_id = null, $child_order_acceptance_id = null)
    {
        // get result from server
        $json = $this->flyer->meGetChildOrders($before, $after, $count);
        // make child order list
        $items = array();
        foreach ($json as $item){
            $items[] = MeExecution::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get positions
     *
     * @param string $product_code
     *
     * @return MePosition[]
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetPositions($product_code)
    {
        // get result from server
        $json = $this->flyer->meGetPositions($product_code);
        // make child order list
        $items = array();
        foreach ($json as $item){
            $items[] = MePosition::fromObject($item);
        }
        return $items;
    }
    
    /**
     * [private] get trading commission
     *
     * @param string $product_code
     *
     * @return MeCommission
     *
     * @throws ServerResponseFormatException
     * @throws BitflyerClientException
     */
    public function meGetTradingCommission($product_code)
    {
        // get result from server
        $json = $this->flyer->meGetTradingCommission($product_code);
        // make comission
        return MeCommission::fromObject($json);
    }
}