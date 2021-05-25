<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer;

use Stk2k\NetDriver\Http\HttpRequest;
use Stk2k\NetDriver\NetDriverInterface;

use Stk2k\PhitFlyer\Exception\PhitFlyerClientExceptionInterface;

/**
 * PhitFlyer interface
 */
interface PhitFlyerClientInterface
{
    /**
     * get last request
     *
     * @return HttpRequest|null
     */
    public function getLastRequest() : ?HttpRequest;

    /**
     * add net driver change listener
     *
     * @param NetDriverChangeListenerInterface|callable $listener
     */
    public function addNetDriverChangeListener($listener);

    /**
     * get net driver
     *
     * @return NetDriverInterface|null
     */
    public function getNetDriver() : ?NetDriverInterface;

    /**
     * set net driver
     *
     * @param NetDriverInterface $net_driver
     */
    public function setNetDriver(NetDriverInterface $net_driver);

    /**
     * [public] get markets
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getMarkets();
    
    /**
     * [public] get board
     *
     * @param string $product_code
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoard($product_code = null);
    
    /**
     * [public] get ticker
     *
     * @param string $product_code
     *
     * @return mixed
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getExecutions(?string $product_code = null, ?int $before = null, ?int $after = null, ?int $count = null);
    
    
    /**
     * [public] get board state
     *
     * @param string $product_code
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getBoardState(?string $product_code = null);
    
    /**
     * get health
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getHealth();
    
    /**
     * [public] get chats
     *
     * @param string $from_date
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function getChats(?string $from_date = null);
    
    /**
     * [private] get permissions
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPermissions();
    
    /**
     * [private] get balance
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetBalance();
    
    /**
     * [private] get collateral
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCollateral();
    
    /**
     * [private] get collateral accounts
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCollateralAccounts();
    
    /**
     * [private] get address
     *
     * @return mixed
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCoinIns(?int $before = null, ?int $after = null, ?int $count = null);
    
    /**
     * [private] get coin outs
     *
     * @param integer $before
     * @param integer $after
     * @param integer $count
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetCoinOuts(?int $before = null, ?int $after = null, ?int $count = null);
    
    /**
     * [private] get bank accounts
     *
     * @return mixed
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
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetDeposits(?int $before = null, ?int $after = null, ?int $count = null);
    
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
     */
    public function meSendChildOrder(string $product_code, string $child_order_type, string $side, int $price, float $size,
                                     int $minute_to_expire = null, string $time_in_force = null);
    
    /**
     * [private] cancel child order
     *
     * @param string $product_code
     * @param string $child_order_id
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meCancelChildOrder(string $product_code, string $child_order_id);
    
    /**
     * [private] cancel all child orders
     *
     * @param string $product_code
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meCancelAllChildOrders(string $product_code);
    
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
     */
    public function meGetChildOrders(string $product_code, ?int $before = null, ?int $after = null, ?int $count = null,
                                     ?string $child_order_state = null, ?string $parent_order_id = null);
    
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
     */
    public function meGetExecutions(string $product_code, ?int $before = null, ?int $after = null, ?int $count = null,
                                    ?string $child_order_id = null, ?string $child_order_acceptance_id = null);
    
    /**
     * [private] get positions
     *
     * @param string $product_code
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetPositions(string $product_code);
    
    /**
     * [private] get trading commission
     *
     * @param string $product_code
     *
     * @return mixed
     *
     * @throws PhitFlyerClientExceptionInterface
     */
    public function meGetTradingCommission(string $product_code);
    
}
