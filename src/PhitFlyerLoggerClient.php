<?php
namespace PhitFlyer;

use NetDriver\Http\HttpRequest;
use NetDriver\NetDriverInterface;

use Psr\Log\LoggerInterface;

use PhitFlyer\Exception\PhitFlyerClientExceptionInterface;

/**
 * Logger decorator
 */
class PhitFlyerLoggerClient implements PhitFlyerClientInterface, NetDriverChangeListenerInterface
{
    /** @var PhitFlyerClientInterface  */
    private $client;
    
    /** @var LoggerInterface */
    private $logger;
    
    /**
     * construct
     *
     * @param PhitFlyerClientInterface $client
     * @param LoggerInterface $logger
     */
    public function __construct($client, $logger){
        $this->client = $client;
        $this->logger = $logger;

        $client->addNetDriverChangeListener($this);
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
     * Net driver change callback
     *
     * @param NetDriverInterface $net_driver
     */
    public function onNetDriverChanged(NetDriverInterface $net_driver)
    {
        $net_driver->setLogger($this->logger);
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
     * [public] get markets
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getMarkets()
    {
        $this->logger->debug('started getMarkets');
        $ret = $this->client->getMarkets();
        $this->logger->debug('finished getMarkets');
        return $ret;
    }
    
    /**
     * [public] get boards
     *
     * @param string $product_code
     *
     * @return array
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoard($product_code = null)
    {
        $this->logger->debug('started getBoard');
        $ret = $this->client->getBoard($product_code);
        $this->logger->debug('finished getBoard');
        return $ret;
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
        $this->logger->debug('started getTicker');
        $ret = $this->client->getTicker($product_code);
        $this->logger->debug('finished getTicker');
        return $ret;
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
        $this->logger->debug('started getExecutions');
        $ret = $this->client->getExecutions($product_code, $before, $after, $count);
        $this->logger->debug('finished getExecutions');
        return $ret;
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
        $this->logger->debug('started getBoardState');
        $ret = $this->client->getBoardState($product_code);
        $this->logger->debug('finished getBoardState');
        return $ret;
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
        $this->logger->debug('started getHealth');
        $ret = $this->client->getHealth();
        $this->logger->debug('finished getHealth');
        return $ret;
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
        $this->logger->debug('started getChats');
        $ret = $this->client->getChats($from_date);
        $this->logger->debug('finished getChats');
        return $ret;
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
        $this->logger->debug('started meGetPermissions');
        $ret = $this->client->meGetPermissions();
        $this->logger->debug('finished meGetPermissions');
        return $ret;
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
        $this->logger->debug('started meGetBalance');
        $ret = $this->client->meGetBalance();
        $this->logger->debug('finished meGetBalance');
        return $ret;
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
        $this->logger->debug('started meGetCollateral');
        $ret = $this->client->meGetCollateral();
        $this->logger->debug('finished meGetCollateral');
        return $ret;
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
        $this->logger->debug('started meGetCollateralAccounts');
        $ret = $this->client->meGetCollateralAccounts();
        $this->logger->debug('finished meGetCollateralAccounts');
        return $ret;
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
        $this->logger->debug('started meGetAddress');
        $ret = $this->client->meGetAddress();
        $this->logger->debug('finished meGetAddress');
        return $ret;
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
        $this->logger->debug('started meGetCoinIns');
        $ret = $this->client->meGetCoinIns($before, $after, $count);
        $this->logger->debug('finished meGetCoinIns');
        return $ret;
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
        $this->logger->debug('started meGetCoinOuts');
        $ret = $this->client->meGetCoinOuts($before, $after, $count);
        $this->logger->debug('finished meGetCoinOuts');
        return $ret;
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
        $this->logger->debug('started meGetBankAccounts');
        $ret = $this->client->meGetBankAccounts();
        $this->logger->debug('finished meGetBankAccounts');
        return $ret;
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
        $this->logger->debug('started meGetDeposits');
        $ret = $this->client->meGetDeposits($before, $after, $count);
        $this->logger->debug('finished meGetDeposits');
        return $ret;
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
     * @return  array
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire = null, $time_in_force = null)
    {
        $this->logger->debug('started meSendChildOrder');
        $ret = $this->client->meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire, $time_in_force);
        $this->logger->debug('finished meSendChildOrder');
        return $ret;
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
        $this->logger->debug('started meCancelChildOrder');
        $this->client->meCancelChildOrder($product_code, $child_order_id);
        $this->logger->debug('finished meCancelChildOrder');
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
        $this->logger->debug('started meCancelAllChildOrders');
        $this->client->meCancelAllChildOrders($product_code);
        $this->logger->debug('finished meCancelAllChildOrders');
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetChildOrders($product_code, $before = null, $after = null, $count = null, $child_order_state = null, $parent_order_id = null)
    {
        $this->logger->debug('started meGetChildOrders');
        $ret = $this->client->meGetChildOrders($product_code, $before, $after, $count, $child_order_state, $parent_order_id);
        $this->logger->debug('finished meGetChildOrders');
        return $ret;
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
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetExecutions($product_code, $before = null, $after = null, $count = null, $child_order_id = null, $child_order_acceptance_id = null)
    {
        $this->logger->debug('started meGetExecutions');
        $ret = $this->client->meGetExecutions($product_code, $before, $after, $count, $child_order_id, $child_order_acceptance_id);
        $this->logger->debug('finished meGetExecutions');
        return $ret;
    }
    
    /**
     * [private] get positions
     *
     * @param string $product_code
     *
     * @return array
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPositions($product_code)
    {
        $this->logger->debug('started meGetPositions');
        $ret = $this->client->meGetPositions($product_code);
        $this->logger->debug('finished meGetPositions');
        return $ret;
    }
    
    /**
     * [private] get trading commission
     *
     * @param string $product_code
     *
     * @return array
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetTradingCommission($product_code)
    {
        $this->logger->debug('started meGetTradingCommission');
        $ret = $this->client->meGetTradingCommission($product_code);
        $this->logger->debug('finished meGetTradingCommission');
        return $ret;
    }
}