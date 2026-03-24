<?php

return [
    'category_status' => [
        'active' => [
            'label' => 'Active',
            'description' => 'Displayed and available to users.',
        ],
        'inactive' => [
            'label' => 'Inactive',
            'description' => 'Hidden from users. Currently not in use.',
        ],
        'archived' => [
            'label' => 'Archived',
            'description' => 'No longer in use, kept for historical reference.',
        ],
    ],

    'collection_status' => [
        'active' => [
            'label' => 'Active',
            'description' => 'Visible in search and available to users.',
        ],
        'inactive' => [
            'label' => 'Inactive',
            'description' => 'Not visible and not accessible to users.',
        ],
        'unlisted' => [
            'label' => 'Unlisted',
            'description' => 'Not shown in search but accessible via direct link.',
        ],
    ],

    'content_status' => [
        'draft' => [
            'label' => 'Draft',
            'description' => 'This content is not yet completed.',
        ],
        'reviewing' => [
            'label' => 'Reviewing',
            'description' => 'This content is ready for staff review.',
        ],
        'published' => [
            'label' => 'Published',
            'description' => 'This content has been approved by staff and is public on the website.',
        ],
        'rejected' => [
            'label' => 'Rejected',
            'description' => 'Staff has decided this content is not suitable for the website.',
        ],
    ],

    'product_status' => [
        'active' => [
            'label' => 'Active',
            'description' => 'Product is available for purchase.',
        ],
        'inactive' => [
            'label' => 'Inactive',
            'description' => 'Product is hidden and not available.',
        ],
        'out_of_stock' => [
            'label' => 'Out of Stock',
            'description' => 'Product is currently out of stock.',
        ],
        'coming_soon' => [
            'label' => 'Coming Soon',
            'description' => 'Product will be available soon.',
        ],
        'discontinued' => [
            'label' => 'Discontinued',
            'description' => 'Product is no longer available.',
        ],
    ],

    'showcase_type' => [
        'testimonial' => [
            'label' => 'Testimonial',
            'description' => 'Special showcase for customer feedback.',
        ],
        'partner' => [
            'label' => 'Partner',
            'description' => 'Special showcase for partners.',
        ],
    ],

    'page_type' => [
        'regular' => [
            'label' => 'Regular',
            'description' => 'Accessible by slug and shown in public lists.',
        ],
        'system' => [
            'label' => 'System',
            'description' => 'Special page (e.g. home, about). Not accessible by slug and hidden from public lists.',
        ],
    ],

    'status' => [
        'active' => [
            'label' => 'Active',
            'description' => 'Displayed and available to users.',
        ],
        'archived' => [
            'label' => 'Archived',
            'description' => 'No longer in use, kept for historical reference.',
        ],
    ],
];
