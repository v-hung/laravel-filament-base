<?php

return [
    'order' => [
        'status' => [
            'pending' => [
                'label' => 'Đang chờ xử lý',
                'description' => 'Đơn hàng đã được đặt nhưng chưa thanh toán.',
            ],
            'paid' => [
                'label' => 'Đã thanh toán',
                'description' => 'Đơn hàng đã được thanh toán.',
            ],
            'shipped' => [
                'label' => 'Đang vận chuyển',
                'description' => 'Đơn hàng đang được vận chuyển đến khách hàng.',
            ],
            'completed' => [
                'label' => 'Hoàn tất',
                'description' => 'Đơn hàng đã giao và hoàn tất.',
            ],
            'canceled' => [
                'label' => 'Đã hủy',
                'description' => 'Đơn hàng đã bị hủy và sẽ không được xử lý.',
            ],
        ],
    ],

    'payment' => [
        'method' => [
            'bank_transfer' => 'Chuyển khoản ngân hàng',
            'cash_delivery' => 'Thanh toán khi nhận hàng',
        ],
        'status' => [
            'pending' => [
                'label' => 'Chưa thanh toán',
                'description' => 'Đơn hàng chưa được thanh toán',
            ],
            'paid' => [
                'label' => 'Đã thanh toán',
                'description' => 'Đơn hàng đã được thanh toán.',
            ],
            'failed' => [
                'label' => 'Thanh toán thất bại',
                'description' => 'Thanh toán thất bại.',
            ],
            'refunded' => [
                'label' => 'Đã hoàn tiền',
                'description' => 'Đơn hàng đã được hoàn tiền.',
            ],
            'canceled' => [
                'label' => 'Đã hủy',
                'description' => 'Đơn hàng đã bị hủy.',
            ],
        ],
    ],
];
