<?php

use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerBenchmarkClient;

class PhitFlyerBenchmarkClientTest extends PHPUnit_Framework_TestCase
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
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $markets = $flyer->getMarkets();
        
        $this->assertInternalType( 'array', $markets );
        $this->assertGreaterThanOrEqual( 0, count($markets) );
        $this->assertEquals( 'getMarkets', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testGetBoard()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $board = $flyer->getBoard();
        
        $this->assertInternalType('array', $board );
        $this->assertEquals( 'getBoard', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testGetBoardWithProductCode()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $board = $flyer->getBoard('BTC_JPY');
        
        $this->assertInternalType('array', $board );
        $this->assertEquals( 'getBoard', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testTicker()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $ticker = $flyer->getTicker();
        
        $this->assertInternalType('array', $ticker );
        $this->assertEquals( 'getTicker', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testGetTickerWithProductCode()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $ticker = $flyer->getTicker('BTC_JPY');
        
        $this->assertInternalType('array', $ticker );
        $this->assertEquals( 'getTicker', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testGetExecutions()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $executions = $flyer->getExecutions();
        
        $this->assertInternalType('array', $executions );
        $this->assertEquals( 'getExecutions', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testGetExecutionsWithProductCode()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $executions = $flyer->getExecutions('BTC_JPY');
        
        $this->assertInternalType('array', $executions );
        $this->assertEquals( 'getExecutions', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testGetBoardState()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $board_state = $flyer->getBoardState('BTC_JPY');
    
        $this->assertInternalType('array', $board_state );
        $this->assertEquals( 'getBoardState', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testGetHealth()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $health = $flyer->getHealth();
        
        $this->assertInternalType('array', $health );
        $this->assertEquals( 'getHealth', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testGetChats()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $from_date = date('Y-m-d\Th:i:s', strtotime('-1 min'));
        $chats = $flyer->getChats($from_date);
        
        $this->assertInternalType('array', $chats );
        $this->assertEquals( 'getChats', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetPermissions()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $permissions = $flyer->meGetPermissions();
        
        $this->assertInternalType('array', $permissions );
        $this->assertEquals( 'meGetPermissions', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetBalance()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $balances = $flyer->meGetBalance();
    
        $this->assertInternalType('array', $balances );
        $this->assertEquals( 'meGetBalance', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetCollateral()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $collateral = $flyer->meGetCollateral();
    
        $this->assertInternalType('array', $collateral );
        $this->assertEquals( 'meGetCollateral', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetCollateralAccounts()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $accounts = $flyer->meGetCollateralAccounts();
        
        $this->assertInternalType('array', $accounts );
        $this->assertEquals( 'meGetCollateralAccounts', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetAddress()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $addresses = $flyer->meGetAddress();
    
        $this->assertInternalType('array', $addresses );
        $this->assertEquals( 'meGetAddress', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetCoinIns()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $coinins = $flyer->meGetCoinIns();
    
        $this->assertInternalType('array', $coinins );
        $this->assertEquals( 'meGetCoinIns', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetCoinOuts()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $coinouts = $flyer->meGetCoinOuts();
        
        $this->assertInternalType('array', $coinouts );
        $this->assertEquals( 'meGetCoinOuts', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetBankAccounts()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $bank_accounts = $flyer->meGetBankAccounts();
        
        $this->assertInternalType('array', $bank_accounts );
        $this->assertEquals( 'meGetBankAccounts', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetDeposits()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $deposits = $flyer->meGetDeposits();
        
        $this->assertInternalType('array', $deposits );
        $this->assertEquals( 'meGetDeposits', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeSendChildOrder()
    {
        $this->assertTrue(true);
        
        /*
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $result = $flyer->meSendChildOrder(
            'FX_BTC_JPY', 'LIMIT', 'SELL' ,300000, 0.1
        );
    
        $this->assertInternalType('object', $result );
        $this->assertEquals( 'meSendChildOrder', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
        */
    }
    
    public function testMeCancelChildOrder()
    {
        $this->assertTrue(true);
        
        /*
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $flyer->meCancelChildOrder('FX_BTC_JPY', 'JFX20170717-214220-952616F');
    
        $this->assertEquals( 'meCancelChildOrder', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
        */
    }
    
    public function testMeCancelAllChildOrders()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $flyer->meCancelAllChildOrders('FX_BTC_JPY');
    
        $this->assertEquals( 'meCancelAllChildOrders', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetChildOrders()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
        
        $child_orders = $flyer->meGetChildOrders(
            'FX_BTC_JPY', null, null, null, 'ACTIVE', null
        );
        
        $this->assertInternalType('array', $child_orders );
        $this->assertEquals( 'meGetChildOrders', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetExecutions()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $executions = $flyer->meGetExecutions( 'FX_BTC_JPY', null, null, 10 );
    
        $this->assertInternalType('array', $executions );
        $this->assertEquals( 'meGetExecutions', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetPositions()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $positions = $flyer->meGetPositions('FX_BTC_JPY');
    
        $this->assertInternalType('array', $positions );
        $this->assertEquals( 'meGetPositions', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
    
    public function testMeGetTradingCommission()
    {
        $method = '';
        $elapsed = 0;
        $flyer = new PhitFlyerBenchmarkClient($this->flyer, function ($m, $e) use(&$method, &$elapsed){
            $method = $m;
            $elapsed = $e;
        });
    
        $commissions = $flyer->meGetTradingCommission('FX_BTC_JPY');
    
        $this->assertInternalType('array', $commissions );
        $this->assertEquals( 'meGetTradingCommission', $method );
        $this->assertInternalType( 'float', $elapsed );
        $this->assertGreaterThanOrEqual( 0, $elapsed );
    }
}