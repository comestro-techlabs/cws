<?php

return [
    'merchant_id' => env('PHONEPE_MERCHANT_ID'),
    'salt_key' => env('PHONEPE_SALT_KEY'),
    'salt_index' => env('PHONEPE_SALT_INDEX'),
    'environment' => env('PHONEPE_ENV', 'UAT'), // Default to UAT
    'should_publish_events' => true,
];
