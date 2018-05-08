<?php

use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerApi;

class PhitFlyerClientTest extends PHPUnit_Framework_TestCase
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
        $markets = $this->flyer->getMarkets();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::MARKETS, $req->getUrl() );
        $this->assertInternalType('array', $markets );
        $this->assertGreaterThanOrEqual(0, count($markets) );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoard()
    {
        $board = $this->flyer->getBoard();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::BOARD, $req->getUrl() );
        $this->assertInternalType('array', $board );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoardWithProductCode()
    {
        $board = $this->flyer->getBoard('BTC_JPY');
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(array('product_code'=>'BTC_JPY'), $req->getQueryData() );
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::BOARD . '?product_code=BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $board );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testTicker()
    {
        $ticker = $this->flyer->getTicker();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::TICKER, $req->getUrl() );
        $this->assertInternalType('array', $ticker );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetTickerWithProductCode()
    {
        $ticker = $this->flyer->getTicker('BTC_JPY');
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(array('product_code'=>'BTC_JPY'), $req->getQueryData() );
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::TICKER . '?product_code=BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $ticker );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetExecutions()
    {
        $executions = $this->flyer->getExecutions();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::EXECUTIONS, $req->getUrl() );
        $this->assertInternalType('array', $executions );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetExecutionsWithProductCode()
    {
        $executions = $this->flyer->getExecutions('BTC_JPY');
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(array('product_code'=>'BTC_JPY'), $req->getQueryData() );
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::EXECUTIONS . '?product_code=BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $executions );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoardState()
    {
        $board_state = $this->flyer->getBoardState();
        
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
        
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::GETBOARDSTATE, $req->getUrl() );
        $this->assertInternalType('array', $board_state );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetHealth()
    {
        $health = $this->flyer->getHealth();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::GETHEALTH, $req->getUrl() );
        $this->assertInternalType('array', $health );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetChats()
    {
        $from_date = date('Y-m-d\Th:i:s', strtotime('-1 min'));
        $chats = $this->flyer->getChats($from_date);
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::GETCHATS . '?from_date=' . rawurlencode($from_date), $req->getUrl() );
        $this->assertInternalType('array', $chats );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetPermissions()
    {
        $permissions = $this->flyer->meGetPermissions();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETPERMISSIONS, $req->getUrl() );
        $this->assertInternalType('array', $permissions );
    
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
        $balances = $this->flyer->meGetBalance();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETBALANCE, $req->getUrl() );
        $this->assertInternalType('array', $balances );
        
        foreach($balances as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCollateral()
    {
        $collateral = $this->flyer->meGetCollateral();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCOLLATERAL, $req->getUrl() );
        $this->assertInternalType('array', $collateral );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCollateralAccounts()
    {
        $accounts = $this->flyer->meGetCollateralAccounts();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCOLLATERALACCOUNTS, $req->getUrl() );
        $this->assertInternalType('array', $accounts );
        
        foreach($accounts as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetAddress()
    {
        $addresses = $this->flyer->meGetAddress();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETADDRESS, $req->getUrl() );
        $this->assertInternalType('array', $addresses );
        
        foreach($addresses as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCoinIns()
    {
        $coinins = $this->flyer->meGetCoinIns();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCOININS, $req->getUrl() );
        $this->assertInternalType('array', $coinins );
        
        foreach($coinins as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCoinOuts()
    {
        $coinouts = $this->flyer->meGetCoinOuts();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCOINOUTS, $req->getUrl() );
        $this->assertInternalType('array', $coinouts );
        
        foreach($coinouts as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetBankAccounts()
    {
        $bank_accounts = $this->flyer->meGetBankAccounts();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETBANKACCOUNTS, $req->getUrl() );
        $this->assertInternalType('array', $bank_accounts );
        
        foreach($bank_accounts as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetDeposits()
    {
        $deposits = $this->flyer->meGetDeposits();
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETDEPOSITS, $req->getUrl() );
        $this->assertInternalType('array', $deposits );
        
        foreach($deposits as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    public function testMeSendChildOrder()
    {
        $this->assertTrue(true);
        
        //$result = $this->flyer->meSendChildOrder(
        //    'FX_BTC_JPY', 'LIMIT', 'SELL' ,300000, 0.001
        //);
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        //$req = $this->flyer->getLastRequest();
    
        //$this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_SENDCHILDORDER, $req->getUrl() );
        //$this->assertInternalType('object', $result );
    }
    
    public function testMeCancelChildOrder()
    {
        $this->assertTrue(true);
        
        //$this->flyer->meCancelChildOrder('FX_BTC_JPY', 'JFX20170717-213828-930722F');
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        //$req = $this->flyer->getLastRequest();
    
        //$this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_CANCELCHILDORDER, $req->getUrl() );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     */
    public function testMeCancelAllChildOrders()
    {
        $this->flyer->meCancelAllChildOrders('FX_BTC_JPY');
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_CANCELALLCHILDORDERS, $req->getUrl() );
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetChildOrders()
    {
        $child_orders = $this->flyer->meGetChildOrders(
            'FX_BTC_JPY', null, null, null, 'ACTIVE', null
        );
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCHILDORDERS . '?product_code=FX_BTC_JPY&child_order_state=ACTIVE', $req->getUrl() );
        $this->assertInternalType('array', $child_orders );
    
        foreach($child_orders as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetExecutions()
    {
        $executions = $this->flyer->meGetExecutions( 'FX_BTC_JPY', null, null, 10 );
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETEXECUTIONS . '?product_code=FX_BTC_JPY&count=10', $req->getUrl() );
        $this->assertInternalType('array', $executions );
    
        foreach($executions as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetPositions()
    {
        $positions = $this->flyer->meGetPositions('FX_BTC_JPY');
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETPOSITIONS . '?product_code=FX_BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $positions );
    
        foreach($positions as $item){
            $this->assertInternalType('array', $item );
        }
    }
    
    /**
     * @throws \PhitFlyer\Exception\BitflyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetTradingCommission()
    {
        $commissions = $this->flyer->meGetTradingCommission('FX_BTC_JPY');
    
        /** @var \PhitFlyer\Http\HttpGetRequest $req */
        $req = $this->flyer->getLastRequest();
    
        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETTRADINGCOMMISSION . '?product_code=FX_BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $commissions );
    }
}