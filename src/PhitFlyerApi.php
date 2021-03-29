<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer;

/**
 * PhitFlyer API consts class
 */
final class PhitFlyerApi
{
    const ENDPOINT      = 'https://api.bitflyer.jp';
    
    // BitFlyer public API
    const MARKETS       = '/v1/markets';
    const BOARD         = '/v1/board';
    const TICKER        = '/v1/ticker';
    const EXECUTIONS    = '/v1/executions';
    const GETBOARDSTATE = '/v1/getboardstate';                          // ... added at ver.0.2.0
    const GETHEALTH     = '/v1/gethealth';
    const GETCHATS      = '/v1/getchats';
    
    // BitFlyer private API
    const ME_GETPERMISSIONS           = '/v1/me/getpermissions';
    const ME_GETBALANCE               = '/v1/me/getbalance';
    const ME_GETCOLLATERAL            = '/v1/me/getcollateral';
    const ME_GETCOLLATERALACCOUNTS    = '/v1/me/getcollateralaccounts';
    const ME_GETADDRESS               = '/v1/me/getaddresses';
    const ME_GETCOININS               = '/v1/me/getcoinins';
    const ME_GETCOINOUTS              = '/v1/me/getcoinouts';
    const ME_GETBANKACCOUNTS          = '/v1/me/getbankaccounts';
    const ME_GETDEPOSITS              = '/v1/me/getdeposits';
    //const ME_WITHDRAW                 = '/v1/me/withdraw';                      ...removed at ver.0.2.0
    //const ME_GETWITHDRAWALS           = '/v1/me/getwithdrawals';                ...removed at ver.0.2.0
    const ME_SENDCHILDORDER           = '/v1/me/sendchildorder';
    const ME_CANCELCHILDORDER         = '/v1/me/cancelchildorder';
    const ME_CANCELALLCHILDORDERS     = '/v1/me/cancelallchildorders';
    const ME_GETCHILDORDERS           = '/v1/me/getchildorders';
    const ME_GETEXECUTIONS            = '/v1/me/getexecutions';
    const ME_GETPOSITIONS             = '/v1/me/getpositions';
    const ME_GETTRADINGCOMMISSION     = '/v1/me/gettradingcommission';
    
}