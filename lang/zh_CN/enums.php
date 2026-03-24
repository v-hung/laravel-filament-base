<?php

return [
    'category_status' => [
        'active' => [
            'label' => '启用',
            'description' => '对用户可见并可使用。',
        ],
        'inactive' => [
            'label' => '停用',
            'description' => '对用户隐藏，目前未使用。',
        ],
        'archived' => [
            'label' => '已归档',
            'description' => '不再使用，仅用于历史参考。',
        ],
    ],

    'collection_status' => [
        'active' => [
            'label' => '启用',
            'description' => '在搜索中可见并对用户开放。',
        ],
        'inactive' => [
            'label' => '停用',
            'description' => '不可见且用户无法访问。',
        ],
        'unlisted' => [
            'label' => '不公开',
            'description' => '不会出现在搜索中，但可通过直接链接访问。',
        ],
    ],

    'content_status' => [
        'draft' => [
            'label' => '草稿',
            'description' => '内容尚未完成。',
        ],
        'reviewing' => [
            'label' => '审核中',
            'description' => '内容已准备好，等待工作人员审核。',
        ],
        'published' => [
            'label' => '已发布',
            'description' => '内容已通过审核并公开展示。',
        ],
        'rejected' => [
            'label' => '已拒绝',
            'description' => '内容不符合要求，未被通过。',
        ],
    ],

    'product_status' => [
        'active' => [
            'label' => '在售',
            'description' => '产品可购买。',
        ],
        'inactive' => [
            'label' => '下架',
            'description' => '产品已隐藏且不可购买。',
        ],
        'out_of_stock' => [
            'label' => '缺货',
            'description' => '产品当前无库存。',
        ],
        'coming_soon' => [
            'label' => '即将上线',
            'description' => '产品即将上线。',
        ],
        'discontinued' => [
            'label' => '已停售',
            'description' => '产品不再提供。',
        ],
    ],

    'showcase_type' => [
        'testimonial' => [
            'label' => '客户评价',
            'description' => '用于展示客户反馈的专区。',
        ],
        'partner' => [
            'label' => '合作伙伴',
            'description' => '用于展示合作伙伴的专区。',
        ],
    ],

    'page_type' => [
        'regular' => [
            'label' => '普通页面',
            'description' => '可通过 slug 访问，并显示在公开列表中。',
        ],
        'system' => [
            'label' => '系统页面',
            'description' => '特殊页面（如首页、关于页），不可通过 slug 访问且不在公开列表中显示。',
        ],
    ],

    'status' => [
        'active' => [
            'label' => '启用',
            'description' => '对用户可见并可使用。',
        ],
        'archived' => [
            'label' => '已归档',
            'description' => '不再使用，仅用于历史参考。',
        ],
    ],
];
