<?php

return [
    'merchant_id' => env('PHONEPE_MERCHANT_ID', 'AYURVIPONLINE'),
    'salt_key' => env('PHONEPE_SALT_KEY', '040e4e10-5d24-4052-a91b-c9b1cbe597b7'),
    'salt_index' => env('PHONEPE_SALT_INDEX', 1),
    'env' => env('PHONEPE_ENV', 'PRODUCTION'), // UAT or PRODUCTION
];
