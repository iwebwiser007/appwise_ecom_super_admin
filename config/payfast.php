<?php

return [
    'mode' => env('PAYFAST_MODE', 'sandbox'), // Can be 'sandbox' or 'live'
    
    'sandbox' => [
        'merchant_id' => env('PAYFAST_SANDBOX_MERCHANT_ID', ''),
        'merchant_key' => env('PAYFAST_SANDBOX_MERCHANT_KEY', ''),
        'return_url' => env('PAYFAST_RETURN_URL', ''),
        'cancel_url' => env('PAYFAST_CANCEL_URL', ''),
        'notify_url' => env('PAYFAST_NOTIFY_URL', ''),
    ],

    'live' => [
        'merchant_id' => env('PAYFAST_LIVE_MERCHANT_ID', ''),
        'merchant_key' => env('PAYFAST_LIVE_MERCHANT_KEY', ''),
    ],

    'currency' => env('PAYFAST_CURRENCY', 'ZAR'), // Currency for transactions
];
