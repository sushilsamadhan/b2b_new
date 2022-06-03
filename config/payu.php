<?php

use Tzsk\Payu\Gateway\Gateway;
use Tzsk\Payu\Gateway\PayuBiz;
use Tzsk\Payu\Gateway\PayuMoney;
use Tzsk\Payu\Models\PayuTransaction;

return [
    'default' => env('PAYU_DEFAULT_GATEWAY', 'biz'),

    'gateways' => [
        'money' => new PayuMoney([
            'mode' => env('PAYU_MONEY_MODE', Gateway::TEST_MODE),
            'key' => env('PAYU_MONEY_KEY', 'SWX8LxLC'),
            'salt' => env('PAYU_MONEY_SALT', 'cXhuLZsI4t'),
            'auth' => env('PAYU_MONEY_AUTH','JSdfrtdc3v/mDnUgG7rcx37tyRWc0j0WLeleCyV3nY4='),
        ]),

        'biz' => new PayuBiz([
            'mode' => env('PAYU_BIZ_MODE', Gateway::TEST_MODE),
            'key' => env('PAYU_BIZ_KEY', 'SWX8LxLC'),
            'salt' => env('PAYU_BIZ_SALT', 'cXhuLZsI4t'),
        ]),
    ],

    'verify' => [
        PayuTransaction::STATUS_PENDING,
    ],
];
