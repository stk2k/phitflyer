<?php

use NetDriver\Http\HttpGetRequest;

use Wa72\SimpleLogger\EchoLogger;

use PhitFlyer\PhitFlyerApi;
use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerLoggerClient;

class PhitFlyerLoggerClientTest extends PHPUnit_Framework_TestCase
{
    /** @var PhitFlyerClient */
    private $client;

    protected function setUp()
    {
        $api_key = getenv('PHITFLYER_API_KEY');
        $api_secret = getenv('PHITFLYER_API_SECRET');

        $this->assertGreaterThan(0,strlen($api_key),'Plase set environment variable(PHITFLYER_API_KEY) before running this test.');
        $this->assertGreaterThan(0,strlen($api_secret),'Plase set environment variable(PHITFLYER_API_SECRET) before running this test.');

        $this->client = new PhitFlyerLoggerClient(new PhitFlyerClient($api_key, $api_secret), new EchoLogger());

        sleep(1);
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetMarkets()
    {
        $markets = $this->client->getMarkets();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::MARKETS, $req->getUrl() );
        $this->assertInternalType('array', $markets );
        $this->assertGreaterThanOrEqual(0, count($markets) );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoard()
    {
        $board = $this->client->getBoard();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::BOARD, $req->getUrl() );
        $this->assertInternalType('array', $board );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoardWithProductCode()
    {
        $board = $this->client->getBoard('BTC_JPY');

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::BOARD . '?product_code=BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $board );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testTicker()
    {
        $ticker = $this->client->getTicker();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::TICKER, $req->getUrl() );
        $this->assertInternalType('array', $ticker );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetTickerWithProductCode()
    {
        $ticker = $this->client->getTicker('BTC_JPY');

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::TICKER . '?product_code=BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $ticker );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetExecutions()
    {
        $executions = $this->client->getExecutions();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::EXECUTIONS, $req->getUrl() );
        $this->assertInternalType('array', $executions );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetExecutionsWithProductCode()
    {
        $executions = $this->client->getExecutions('BTC_JPY');

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::EXECUTIONS . '?product_code=BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $executions );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetBoardState()
    {
        $board_state = $this->client->getBoardState();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::GETBOARDSTATE, $req->getUrl() );
        $this->assertInternalType('array', $board_state );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetHealth()
    {
        $health = $this->client->getHealth();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::GETHEALTH, $req->getUrl() );
        $this->assertInternalType('array', $health );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testGetChats()
    {
        $from_date = date('Y-m-d\Th:i:s', strtotime('-1 min'));
        $chats = $this->client->getChats($from_date);

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::GETCHATS . '?from_date=' . rawurlencode($from_date), $req->getUrl() );
        $this->assertInternalType('array', $chats );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetPermissions()
    {
        $permissions = $this->client->meGetPermissions();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETPERMISSIONS, $req->getUrl() );
        $this->assertInternalType('array', $permissions );

        foreach($permissions as $item){
            $this->assertInternalType('string', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetBalance()
    {
        $balances = $this->client->meGetBalance();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETBALANCE, $req->getUrl() );
        $this->assertInternalType('array', $balances );

        foreach($balances as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCollateral()
    {
        $collateral = $this->client->meGetCollateral();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCOLLATERAL, $req->getUrl() );
        $this->assertInternalType('array', $collateral );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCollateralAccounts()
    {
        $accounts = $this->client->meGetCollateralAccounts();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCOLLATERALACCOUNTS, $req->getUrl() );
        $this->assertInternalType('array', $accounts );

        foreach($accounts as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetAddress()
    {
        $addresses = $this->client->meGetAddress();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETADDRESS, $req->getUrl() );
        $this->assertInternalType('array', $addresses );

        foreach($addresses as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCoinIns()
    {
        $coinins = $this->client->meGetCoinIns();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCOININS, $req->getUrl() );
        $this->assertInternalType('array', $coinins );

        foreach($coinins as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetCoinOuts()
    {
        $coinouts = $this->client->meGetCoinOuts();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCOINOUTS, $req->getUrl() );
        $this->assertInternalType('array', $coinouts );

        foreach($coinouts as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetBankAccounts()
    {
        $bank_accounts = $this->client->meGetBankAccounts();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETBANKACCOUNTS, $req->getUrl() );
        $this->assertInternalType('array', $bank_accounts );

        foreach($bank_accounts as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetDeposits()
    {
        $deposits = $this->client->meGetDeposits();

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETDEPOSITS, $req->getUrl() );
        $this->assertInternalType('array', $deposits );

        foreach($deposits as $item){
            $this->assertInternalType('array', $item );
        }
    }

    public function testMeSendChildOrder()
    {
        $this->assertTrue(true);

        //$result = $this->client->meSendChildOrder(
        //    'FX_BTC_JPY', 'LIMIT', 'SELL' ,300000, 0.001
        //);

        /** @var HttpGetRequest $req */
        //$req = $this->client->getLastRequest();

        //$this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_SENDCHILDORDER, $req->getUrl() );
        //$this->assertInternalType('object', $result );
    }

    public function testMeCancelChildOrder()
    {
        $this->assertTrue(true);

        //$this->client->meCancelChildOrder('FX_BTC_JPY', 'JFX20170717-213828-930722F');

        /** @var HttpGetRequest $req */
        //$req = $this->client->getLastRequest();

        //$this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_CANCELCHILDORDER, $req->getUrl() );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     */
    public function testMeCancelAllChildOrders()
    {
        $this->client->meCancelAllChildOrders('FX_BTC_JPY');

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_CANCELALLCHILDORDERS, $req->getUrl() );
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetChildOrders()
    {
        $child_orders = $this->client->meGetChildOrders(
            'FX_BTC_JPY', null, null, null, 'ACTIVE', null
        );

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETCHILDORDERS . '?product_code=FX_BTC_JPY&child_order_state=ACTIVE', $req->getUrl() );
        $this->assertInternalType('array', $child_orders );

        foreach($child_orders as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetExecutions()
    {
        $executions = $this->client->meGetExecutions( 'FX_BTC_JPY', null, null, 10 );

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETEXECUTIONS . '?product_code=FX_BTC_JPY&count=10', $req->getUrl() );
        $this->assertInternalType('array', $executions );

        foreach($executions as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetPositions()
    {
        $positions = $this->client->meGetPositions('FX_BTC_JPY');

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETPOSITIONS . '?product_code=FX_BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $positions );

        foreach($positions as $item){
            $this->assertInternalType('array', $item );
        }
    }

    /**
     * @throws \PhitFlyer\Exception\PhitFlyerClientException
     * @throws \PhitFlyer\Exception\ServerResponseFormatException
     */
    public function testMeGetTradingCommission()
    {
        $commissions = $this->client->meGetTradingCommission('FX_BTC_JPY');

        /** @var HttpGetRequest $req */
        $req = $this->client->getLastRequest();

        $this->assertEquals(PhitFlyerApi::ENDPOINT . PhitFlyerApi::ME_GETTRADINGCOMMISSION . '?product_code=FX_BTC_JPY', $req->getUrl() );
        $this->assertInternalType('array', $commissions );
    }
}