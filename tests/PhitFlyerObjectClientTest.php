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
    
    public function testGetBoard()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $board = $flyer->getBoard();
        
        $this->assertInternalType('object', $board );
        $this->assertInstanceOf('PhitFlyer\Object\Board', $board );
    }
    
    public function testGetBoardWithProductCode()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $board = $flyer->getBoard('BTC_JPY');
        
        $this->assertInternalType('object', $board );
        $this->assertInstanceOf('PhitFlyer\Object\Board', $board );
    }
    
    public function testTicker()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $ticker = $flyer->getTicker();
        
        $this->assertInternalType('object', $ticker );
        $this->assertInstanceOf('PhitFlyer\Object\Ticker', $ticker );
    }
    
    public function testGetTickerWithProductCode()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $ticker = $flyer->getTicker('BTC_JPY');
        
        $this->assertInternalType('object', $ticker );
        $this->assertInstanceOf('PhitFlyer\Object\Ticker', $ticker );
    }
    
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
    
    public function testGetHealth()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $health = $flyer->getHealth();
        
        $this->assertInternalType('object', $health );
        $this->assertInstanceOf('PhitFlyer\Object\Health', $health );
    }
    
    public function testGetChats()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $chats = $flyer->getChats();
        
        $this->assertInternalType('array', $chats );
        $this->assertGreaterThanOrEqual(0, count($chats) );
        
        foreach($chats as $item){
            $this->assertInstanceOf('PhitFlyer\Object\Chat', $item );
        }
    }
    
    public function testGetChatsWithFromDate()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        date_default_timezone_set('UTC');
    
        $from_date = date('Y-m-d\Th:i:s', strtotime('-10 min'));
        $chats = $flyer->getChats($from_date);
        
        $this->assertInternalType('array', $chats );
        $this->assertGreaterThanOrEqual(0, count($chats) );
        
        foreach($chats as $item){
            $this->assertInstanceOf('PhitFlyer\Object\Chat', $item );
        }
    }
    
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
    
    public function testMeGetCollateral()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $collateral = $flyer->meGetCollateral();
    
        $this->assertInternalType('object', $collateral );
        $this->assertInstanceOf('PhitFlyer\Object\MeCollateral', $collateral );
    }
    
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
    
    public function testMeWithdraw()
    {
        $bank_account_id = getenv('PHITFLYER_BANK_ACCOUNT_ID');
    
        echo 'PHITFLYER_BANK_ACCOUNT_ID:',$bank_account_id,PHP_EOL;
    
        $flyer = new PhitFlyerObjectClient($this->flyer);
    
        $withdraw_message = $flyer->meWithdraw( 'JPY', $bank_account_id, 1000 );
    
        $this->assertInternalType('object', $withdraw_message );
        $this->assertInstanceOf('PhitFlyer\Object\MeWithdrawMessage', $withdraw_message );
    }
    
    public function testMeGetWithdrawals()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $withdrawals = $flyer->meGetWithdrawals();
    
        $this->assertInternalType('array', $withdrawals );
        $this->assertGreaterThanOrEqual(0, count($withdrawals) );
    
        foreach($withdrawals as $item){
            $this->assertInstanceOf('PhitFlyer\Object\MeWithdrawal', $item );
        }
    }
    
    public function testMeSendChildOrder()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $result = $flyer->meSendChildOrder(
            'FX_BTC_JPY', 'LIMIT', 'SELL' ,300000, 0.1
        );
    
        $this->assertInternalType('object', $result );
        $this->assertInstanceOf('PhitFlyer\Object\MeChildOrderResult', $result );
    }
    
    public function testMeCancelChildOrder()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $flyer->meCancelChildOrder('FX_BTC_JPY', 'JFX20170717-213404-907976F');
    }
    
    public function testMeCancelAllChildOrders()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $flyer->meCancelAllChildOrders('FX_BTC_JPY');
    }
    
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
    
    public function testMeGetTradingCommission()
    {
        $flyer = new PhitFlyerObjectClient($this->flyer);
        
        $commissions = $flyer->meGetTradingCommission('FX_BTC_JPY');
        
        $this->assertInternalType('object', $commissions );
        $this->assertInstanceOf('PhitFlyer\Object\MeCommission', $commissions );
    }
}