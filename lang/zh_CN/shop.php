<?php

return [
    'order' => [
        'status' => [
            'pending' => [
                'label' => '待处理',
                'description' => '订单已创建但尚未支付。',
            ],
            'paid' => [
                'label' => '已支付',
                'description' => '订单已完成支付。',
            ],
            'shipped' => [
                'label' => '运输中',
                'description' => '订单正在运送至客户。',
            ],
            'completed' => [
                'label' => '已完成',
                'description' => '订单已交付并完成。',
            ],
            'canceled' => [
                'label' => '已取消',
                'description' => '订单已被取消且不会被处理。',
            ],
        ],
    ],

    'payment' => [
        'method' => [
            'bank_transfer' => '银行转账',
            'cash_delivery' => '货到付款',
        ],
        'status' => [
            'pending' => [
                'label' => '未支付',
                'description' => '订单尚未支付',
            ],
            'paid' => [
                'label' => '已支付',
                'description' => '订单已完成支付。',
            ],
            'failed' => [
                'label' => '支付失败',
                'description' => '支付失败。',
            ],
            'refunded' => [
                'label' => '已退款',
                'description' => '订单已退款。',
            ],
            'canceled' => [
                'label' => '已取消',
                'description' => '订单已被取消。',
            ],
        ],
    ],

    'product' => [
        'not_found' => '未找到产品',
    ],
    'post' => [
        'not_found' => '未找到文章',
    ],
    'collection' => [
        'not_found' => '未找到集合',
    ],
    'page' => [
        'not_found' => '未找到页面',
    ],
];
