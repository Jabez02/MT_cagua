<?php

return [
    'gcash' => [
        'endpoint' => env('GCASH_API_ENDPOINT', 'https://api.gcash.com/v1'),
        'merchant_id' => env('GCASH_MERCHANT_ID'),
        'merchant_secret' => env('GCASH_MERCHANT_SECRET'),
    ],

    'bank' => [
        'endpoint' => env('BANK_API_ENDPOINT', 'https://api.bank.com/v1'),
        'account_name' => env('BANK_ACCOUNT_NAME', 'Mt. Cagua Hiking'),
        'account_number' => env('BANK_ACCOUNT_NUMBER'),
        'bank_name' => env('BANK_NAME', 'BDO'),
    ],

    'api_key' => env('PAYMENT_API_KEY'),

    'fees' => [
        'tourist' => [
            'local' => env('LOCAL_FEE', 180),
            'foreign' => env('FOREIGN_FEE', 350),
        ],
        'guide' => [
            'day_trek' => env('GUIDE_DAY_TREK_FEE', 500),
            'overnight' => env('GUIDE_OVERNIGHT_FEE', 1000),
        ],
        'porter' => [
            'day_trek' => env('PORTER_DAY_TREK_FEE', 500),
            'overnight' => env('PORTER_OVERNIGHT_FEE', 1000),
        ],
        'tricycle_rental' => env('TRICYCLE_RENTAL_FEE', 800),
    ],

    'down_payment_percentage' => env('DOWN_PAYMENT_PERCENTAGE', 50),
];