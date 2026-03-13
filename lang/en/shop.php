<?php

return [
    'order' => [
        'status' => [
            'pending' => [
                'label' => 'Pending',
                'description' => 'The order has been placed but not yet paid.',
            ],
            'paid' => [
                'label' => 'Paid',
                'description' => 'The order has been paid.',
            ],
            'shipped' => [
                'label' => 'Shipped',
                'description' => 'The order is being shipped to the customer.',
            ],
            'completed' => [
                'label' => 'Completed',
                'description' => 'The order has been delivered and completed.',
            ],
            'canceled' => [
                'label' => 'Canceled',
                'description' => 'The order has been canceled and will not be processed.',
            ],
        ],
    ],

    'payment' => [
        'method' => [
            'bank_transfer' => 'Bank Transfer',
            'cash_delivery' => 'Cash on Delivery',
        ],
        'status' => [
            'pending' => [
                'label' => 'Pending',
                'description' => 'The order has not been paid.',
            ],
            'paid' => [
                'label' => 'Paid',
                'description' => 'The order has been paid.',
            ],
            'failed' => [
                'label' => 'Failed',
                'description' => 'Payment failed.',
            ],
            'refunded' => [
                'label' => 'Refunded',
                'description' => 'The order has been refunded.',
            ],
            'canceled' => [
                'label' => 'Canceled',
                'description' => 'The order has been canceled.',
            ],
        ],
    ],

    'product' => [
        'not_found' => 'Product not found',
    ],
    'post' => [
        'not_found' => 'Post not found',
    ],
    'collection' => [
        'not_found' => 'Collection not found',
    ],
    'page' => [
        'not_found' => 'Page not found',
    ],
];
