<?php

use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerObjectClient;

class PhitFlyerObjectClientTest extends PHPUnit_Framework_TestCase
{
    /** @var PhitFlyerClient */
    private $flyer;
    
    protected function setUp()
    {
        $api_key = getenv('PHITFLYER_API_KEY');
        $api_secret = getenv('PHITFLYER_API_SECRET');
    
        $this->assertGreaterThan(0,strlen($api_key),'Plase set environment variable(PHITFLYER_API_KEY) before running this test.');
        $this->assertGreaterThan(0,strlen($api_secret),'Plase set environment variable(PHITFLYER_API_SECRET) before running this test.');
    
        $this->flyer = new PhitFlyerClient($api_key, $api_secret);
    
        sleep(1);
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetMarkets()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $markets = $flyer->getMarkets();
        
        $this->assertInternalType('array', $markets );
        $this->assertGreaterThanOrEqual(0, count($markets) );
        
        foreach($markets as $item){
            $this->assertInstanceOf('PhitFlyer\Object\Market', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoard()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $board = $flyer->getBoard();
        
        $this->assertInternalType('object', $board );
        $this->assertInstanceOf('PhitFlyer\Object\Board', $board );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoardWithProductCode()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $board = $flyer->getBoard('BTC_JPY');
        
        $this->assertInternalType('object', $board );
        $this->assertInstanceOf('PhitFlyer\Object\Board', $board );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testTicker()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $ticker = $flyer->getTicker();
        
        $this->assertInternalType('object', $ticker );
        $this->assertInstanceOf('PhitFlyer\Object\Ticker', $ticker );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetTickerWithProductCode()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $ticker = $flyer->getTicker('BTC_JPY');
        
        $this->assertInternalType('object', $ticker );
        $this->assertInstanceOf('PhitFlyer\Object\Ticker', $ticker );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetExecutions()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $executions = $flyer->getExecutions();
        
        $this->assertInternalType('array', $executions );
        $this->assertGreaterThanOrEqual(0, count($executions) );
    
        foreach($executions as $item){
            $this->assertInstanceOf('PhitFlyer\Object\Execution', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetExecutionsWithProductCode()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $executions = $flyer->getExecutions('BTC_JPY');
        
        $this->assertInternalType('array', $executions );
        $this->assertGreaterThanOrEqual(0, count($executions) );
    
        foreach($executions as $item){
            $this->assertInstanceOf('PhitFlyer\Object\Execution', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoardState()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $board_state = $flyer->getBoardState('BTC_JPY');
    
        $this->assertInternalType('object', $board_state );
        $this->assertInstanceOf('PhitFlyer\Object\BoardState', $board_state );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetHealth()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $health = $flyer->getHealth();
        
        $this->assertInternalType('object', $health );
        $this->assertInstanceOf('PhitFlyer\Object\Health', $health );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetChats()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $from_date = date('Y-m-d\Th:i:s', strtotime('-1 min'));
        $chats = $flyer->getChats($from_date);
        
        $this->assertInternalType('array', $chats );
        $this->assertGreaterThanOrEqual(0, count($chats) );
        
        foreach($chats as $item){
            $this->assertInstanceOf('PhitFlyer\Object\Chat', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetPermissions()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $permissions = $flyer->meGetPermissions();
        
        $this->assertInternalType('array', $permissions );
        $this->assertGreaterThanOrEqual(0, count($permissions) );
        
        foreach($permissions as $item){
            $this->assertInternalType('string', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetBalance()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $balances = $flyer->meGetBalance();
        
        $this->assertInternalType('array', $balances );
        $this->assertGreaterThanOrEqual(0, count($balances) );
        
        foreach($balances as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeBalance', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCollateral()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $collateral = $flyer->meGetCollateral();
    
        $this->assertInternalType('object', $collateral );
        $this->assertInstanceOf('PhitFlyer\Object\MeCollateral', $collateral );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCollateralAccounts()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $accounts = $flyer->meGetCollateralAccounts();
        
        $this->assertInternalType('array', $accounts );
        $this->assertGreaterThanOrEqual(0, count($accounts) );
        
        foreach($accounts as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeCollateralAccount', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetAddress()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $addresses = $flyer->meGetAddress();
    
        $this->assertInternalType('array', $addresses );
        $this->assertGreaterThanOrEqual(0, count($addresses) );
    
        foreach($addresses as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeAddress', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCoinIns()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $coinins = $flyer->meGetCoinIns();
        
        $this->assertInternalType('array', $coinins );
        $this->assertGreaterThanOrEqual(0, count($coinins) );
        
        foreach($coinins as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeCoinIn', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCoinOuts()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $coinouts = $flyer->meGetCoinOuts();
        
        $this->assertInternalType('array', $coinouts );
        $this->assertGreaterThanOrEqual(0, count($coinouts) );
        
        foreach($coinouts as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeCoinOut', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetBankAccounts()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $bank_accounts = $flyer->meGetBankAccounts();
        
        $this->assertInternalType('array', $bank_accounts );
        $this->assertGreaterThanOrEqual(0, count($bank_accounts) );
        
        foreach($bank_accounts as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeBankAccount', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetDeposits()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $deposits = $flyer->meGetDeposits();
        
        $this->assertInternalType('array', $deposits );
        $this->assertGreaterThanOrEqual(0, count($deposits) );
        
        foreach($deposits as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeDeposit', $item );
        }
    }
    
    public function testMeSendChildOrder()
    {
        $this->assertTrue(true);
        
        //$flyer = new PhitFlyerObjectClient($this->flyer);
        
        //$result = $flyer->meSendChildOrder(
        //    'FX_BTC_JPY', 'LIMIT', 'SELL' ,300000, 0.1
        //);
    
        //$this->assertInternalType('object', $result );
        //$this->assertInstanceOf('PhitFlyer\Object\MeChildOrderResult', $result );
    }
    
    public function testMeCancelChildOrder()
    {
        $this->assertTrue(true);
        
        //$flyer = new PhitFlyerObjectClient($this->flyer);
        
        //$flyer->meCancelChildOrder('FX_BTC_JPY', 'JFX20170717-213404-907976F');
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeCancelAllChildOrders()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $flyer->meCancelAllChildOrders('FX_BTC_JPY');
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetChildOrders()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $child_orders = $flyer->meGetChildOrders(
            'FX_BTC_JPY', null, null, null, 'ACTIVE', null
        );
    
        $this->assertInternalType('array', $child_orders );
        $this->assertGreaterThanOrEqual(0, count($child_orders) );
    
        foreach($child_orders as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeChildOrder', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetExecutions()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $executions = $flyer->meGetExecutions( 'FX_BTC_JPY', null, null, 10 );
        
        $this->assertInternalType('array', $executions );
        $this->assertGreaterThanOrEqual(0, count($executions) );
        
        foreach($executions as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeExecution', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetPositions()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $positions = $flyer->meGetPositions('FX_BTC_JPY');
        
        $this->assertInternalType('array', $positions );
        $this->assertGreaterThanOrEqual(0, count($positions) );
        
        foreach($positions as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MePosition', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetTradingCommission()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $commissions = $flyer->meGetTradingCommission('FX_BTC_JPY');
        
        $this->assertInternalType('object', $commissions );
        $this->assertInstanceOf('PhitFlyer\Object\MeCommission', $commissions );
    }
}