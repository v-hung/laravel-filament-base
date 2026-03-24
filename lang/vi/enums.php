<?php

return [
    'category_status' => [
        'active' => [
            'label' => 'Hoạt động',
            'description' => 'Hiển thị và có sẵn cho người dùng.',
        ],
        'inactive' => [
            'label' => 'Không hoạt động',
            'description' => 'Ẩn khỏi người dùng. Hiện không được sử dụng.',
        ],
        'archived' => [
            'label' => 'Lưu trữ',
            'description' => 'Không còn sử dụng, được giữ để tham khảo lịch sử.',
        ],
    ],

    'collection_status' => [
        'active' => [
            'label' => 'Hoạt động',
            'description' => 'Hiển thị trong tìm kiếm và có sẵn cho người dùng.',
        ],
        'inactive' => [
            'label' => 'Không hoạt động',
            'description' => 'Không hiển thị và không thể truy cập bởi người dùng.',
        ],
        'unlisted' => [
            'label' => 'Không công khai',
            'description' => 'Không xuất hiện trong tìm kiếm nhưng vẫn truy cập được qua liên kết trực tiếp.',
        ],
    ],

    'content_status' => [
        'draft' => [
            'label' => 'Bản nháp',
            'description' => 'Nội dung này chưa được hoàn tất.',
        ],
        'reviewing' => [
            'label' => 'Đang xét duyệt',
            'description' => 'Nội dung này đã sẵn sàng để nhân viên xem xét.',
        ],
        'published' => [
            'label' => 'Đã xuất bản',
            'description' => 'Nội dung này đã được nhân viên phê duyệt và công khai trên website.',
        ],
        'rejected' => [
            'label' => 'Đã từ chối',
            'description' => 'Nhân viên đã quyết định nội dung này không phù hợp với website.',
        ],
    ],

    'product_status' => [
        'active' => [
            'label' => 'Hoạt động',
            'description' => 'Sản phẩm có sẵn để mua.',
        ],
        'inactive' => [
            'label' => 'Không hoạt động',
            'description' => 'Sản phẩm bị ẩn và không có sẵn.',
        ],
        'out_of_stock' => [
            'label' => 'Hết hàng',
            'description' => 'Sản phẩm hiện đang hết hàng trong kho.',
        ],
        'coming_soon' => [
            'label' => 'Sắp ra mắt',
            'description' => 'Sản phẩm sẽ sớm có sẵn.',
        ],
        'discontinued' => [
            'label' => 'Ngừng kinh doanh',
            'description' => 'Sản phẩm không còn có sẵn.',
        ],
    ],

    'showcase_type' => [
        'testimonial' => [
            'label' => 'Phản hồi',
            'description' => 'Giới thiệu đặc biệt cho phản hồi khách hàng.',
        ],
        'partner' => [
            'label' => 'Đối tác',
            'description' => 'Giới thiệu đặc biệt cho đối tác.',
        ],
    ],

    'page_type' => [
        'regular' => [
            'label' => 'Thông thường',
            'description' => 'Có thể truy cập qua slug và hiển thị trong danh sách công khai.',
        ],
        'system' => [
            'label' => 'Hệ thống',
            'description' => 'Trang đặc biệt (vd: trang chủ, giới thiệu). Không truy cập qua slug và ẩn khỏi danh sách công khai.',
        ],
    ],

    'status' => [
        'active' => [
            'label' => 'Hoạt động',
            'description' => 'Hiển thị và có sẵn cho người dùng.',
        ],
        'archived' => [
            'label' => 'Lưu trữ',
            'description' => 'Không còn sử dụng, được giữ để tham khảo lịch sử.',
        ],
    ],
];
