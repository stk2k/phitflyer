<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer;

use Stk2k\NetDriver\Http\HttpRequest;
use Stk2k\NetDriver\NetDriverInterface;

use Stk2k\PhitFlyer\Object\Market;
use Stk2k\PhitFlyer\Object\Board;
use Stk2k\PhitFlyer\Object\Ticker;
use Stk2k\PhitFlyer\Object\Execution;
use Stk2k\PhitFlyer\Object\BoardState;
use Stk2k\PhitFlyer\Object\Health;
use Stk2k\PhitFlyer\Object\Chat;
use Stk2k\PhitFlyer\Object\MeBalance;
use Stk2k\PhitFlyer\Object\MeCollateral;
use Stk2k\PhitFlyer\Object\MeCollateralAccount;
use Stk2k\PhitFlyer\Object\MeAddress;
use Stk2k\PhitFlyer\Object\MeCoinIn;
use Stk2k\PhitFlyer\Object\MeCoinOut;
use Stk2k\PhitFlyer\Object\MeBankAccount;
use Stk2k\PhitFlyer\Object\MeDeposit;
use Stk2k\PhitFlyer\Object\MeChildOrderResult;
use Stk2k\PhitFlyer\Object\MeChildOrder;
use Stk2k\PhitFlyer\Object\MeExecution;
use Stk2k\PhitFlyer\Object\MePosition;
use Stk2k\PhitFlyer\Object\MeCommission;

use Stk2k\PhitFlyer\Exception\PhitFlyerClientExceptionInterface;

/**
 * Object decorator
 */
class PhitFlyerObjectClient implements PhitFlyerClientInterface
{
    private $client;
    
    /**
     * construct
     *
     * @param PhitFlyerClientInterface $flyer
     */
    public function __construct($flyer){
        $this->client = $flyer;
    }

    /**
     * get last request
     *
     * @return HttpRequest
     */
    public function getLastRequest()
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
     * @return NetDriverInterface
     */
    public function getNetDriver()
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
     * [public] get markets
     *
     * @return Market[]|null
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getMarkets()
    {
        // get result from server
        $json = $this->client->getMarkets();
        // make market list
        $items = array();
        foreach ($json as $item){
            $items[] = Market::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoard($product_code = null)
    {
        // get result from server
        $json = $this->client->getBoard($product_code);
        // make board
        return Board::fromArray($json);
    }
    
    /**
     * [public] get ticker
     *
     * @param string $product_code
     *
     * @return Ticker
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getTicker($product_code = null)
    {
        // get result from server
        $json = $this->client->getTicker($product_code);
        // make ticker
        return Ticker::fromArray($json);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getExecutions($product_code = null, $before = null, $after = null, $count = null)
    {
        // get result from server
        $json = $this->client->getExecutions($product_code, $before, $after, $count);
        // make execution list
        $items = array();
        foreach ($json as $item){
            $items[] = Execution::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoardState($product_code = null)
    {
        // get result from server
        $json = $this->client->getBoardState($product_code);
        // make board state
        return BoardState::fromArray($json);
    }
    
    /**
     * [public] get health
     *
     * @return Health
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getHealth()
    {
        // get result from server
        $json = $this->client->getHealth();
        // make health
        return Health::fromArray($json);
    }
    
    /**
     * [public] get chats
     *
     * @param string $from_date
     *
     * @return Chat[]
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getChats($from_date = null)
    {
        // get result from server
        $json = $this->client->getChats($from_date);
        // make chat list
        $items = array();
        foreach ($json as $item){
            $items[] = Chat::fromArray($item);
        }
        return $items;
    }
    
    /**
     * [private] get permissions
     *
     * @return string[]
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPermissions()
    {
        // get result from server
        $json = $this->client->meGetPermissions();
        return $json;
    }
    
    /**
     * [private] get balance
     *
     * @return MeBalance[]
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetBalance()
    {
        // get result from server
        $json = $this->client->meGetBalance();
        // make balances list
        $items = array();
        foreach ($json as $item){
            $items[] = MeBalance::fromArray($item);
        }
        return $items;
    }
    
    /**
     * [private] get collateral
     *
     * @return MeCollateral
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCollateral()
    {
        // get result from server
        $json = $this->client->meGetCollateral();
        // make collateral
        return MeCollateral::fromArray($json);
    }
    
    /**
     * [private] get collateral accounts
     *
     * @return MeCollateralAccount[]
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCollateralAccounts()
    {
        // get result from server
        $json = $this->client->meGetCollateralAccounts();
        // make collateral account list
        $items = array();
        foreach ($json as $item){
            $items[] = MeCollateralAccount::fromArray($item);
        }
        return $items;
    }
    
    /**
     * [private] get address
     *
     * @return MeAddress[]
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetAddress()
    {
        // get result from server
        $json = $this->client->meGetAddress();
        // make address list
        $items = array();
        foreach ($json as $item){
            $items[] = MeAddress::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCoinIns($before = null, $after = null, $count = null)
    {
        // get result from server
        $json = $this->client->meGetCoinIns($before, $after, $count);
        // make coin in list
        $items = array();
        foreach ($json as $item){
            $items[] = MeCoinIn::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCoinOuts($before = null, $after = null, $count = null)
    {
        // get result from server
        $json = $this->client->meGetCoinOuts($before, $after, $count);
        // make coin out list
        $items = array();
        foreach ($json as $item){
            $items[] = MeCoinOut::fromArray($item);
        }
        return $items;
    }
    
    /**
     * [private] get bank accounts
     *
     * @return MeBankAccount[]
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetBankAccounts()
    {
        // get result from server
        $json = $this->client->meGetBankAccounts();
        // make bank account list
        $items = array();
        foreach ($json as $item){
            $items[] = MeBankAccount::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetDeposits($before = null, $after = null, $count = null)
    {
        // get result from server
        $json = $this->client->meGetDeposits($before, $after, $count);
        // make deposit list
        $items = array();
        foreach ($json as $item){
            $items[] = MeDeposit::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire = null, $time_in_force = null)
    {
        // get result from server
        $json = $this->client->meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire, $time_in_force);
        // make message
        return MeChildOrderResult::fromArray($json);
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
        // get result from server
        $this->client->meCancelChildOrder($product_code, $child_order_id);
    }
    
    /**
     * [private] cancel all child orders
     *
     * @param string $product_code
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meCancelAllChildOrders($product_code)
    {
        // get result from server
        $this->client->meCancelAllChildOrders($product_code);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetChildOrders($product_code, $before = null, $after = null, $count = null, $child_order_state = null, $parent_order_id = null)
    {
        // get result from server
        $json = $this->client->meGetChildOrders($before, $after, $count);
        // make child order list
        $items = array();
        foreach ($json as $item){
            $items[] = MeChildOrder::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetExecutions($product_code, $before = null, $after = null, $count = null, $child_order_id = null, $child_order_acceptance_id = null)
    {
        // get result from server
        $json = $this->client->meGetChildOrders($before, $after, $count);
        // make child order list
        $items = array();
        foreach ($json as $item){
            $items[] = MeExecution::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPositions($product_code)
    {
        // get result from server
        $json = $this->client->meGetPositions($product_code);
        // make child order list
        $items = array();
        foreach ($json as $item){
            $items[] = MePosition::fromArray($item);
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetTradingCommission($product_code)
    {
        // get result from server
        $json = $this->client->meGetTradingCommission($product_code);
        // make comission
        return MeCommission::fromArray($json);
    }
}