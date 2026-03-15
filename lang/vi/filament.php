<?php

return [
    'navigation' => [
        'content' => 'Nội dung',
        'settings' => 'Cài đặt',
        'shop' => 'Cửa hàng',
    ],
    'resources' => [
        'user' => [
            'label' => 'Người dùng',
            'plural_label' => 'Danh sách Người dùng',
        ],
        'blog' => [
            'label' => 'Danh mục bài viết',
            'plural_label' => 'Danh sách danh mục bài viết',
        ],
        'post' => [
            'label' => 'Bài viết',
            'plural_label' => 'Danh sách bài viết',
        ],
        'page' => [
            'label' => 'Trang',
            'plural_label' => 'Danh sách bài trang',
        ],
        'order' => [
            'label' => 'Hóa đơn',
            'plural_label' => 'Danh sách hóa đơn',
        ],
        'order_item' => [
            'label' => 'Chi tiết hóa đơn',
            'plural_label' => 'Danh sách chi tiết hóa đơn',
        ],
        'collection' => [
            'label' => 'Danh mục sản phẩm',
            'plural_label' => 'Danh sách danh mục sản phẩm',
        ],
        'product' => [
            'label' => 'Sản phẩm',
            'plural_label' => 'Danh sách sản phẩm',
        ],
        'showcase' => [
            'label' => 'Trưng bày',
            'plural_label' => 'Danh sách mục trưng bày',
        ],
        'contact' => [
            'label' => 'Liên hệ',
            'plural_label' => 'Danh sách liên hệ',
        ],
    ],

    'pages' => [
        'shop_settings' => [
            'label' => 'Cài đặt cửa hàng',
        ],
        'system_settings' => [
            'label' => 'Cài đặt hệ thống',
        ],
        'media_manager' => [
            'label' => 'Quản lý phương tiện',
        ],
    ],

    'sections' => [
        'basic' => 'Thông tin cơ bản',
        'blocks' => 'Khối nội dung',
        'branding' => 'Thương hiệu',
        'contact' => 'Thông tin liên hệ',
        'content' => 'Nội dung',
        'faq' => 'Câu hỏi thường gặp',
        'featured' => 'Nổi bật',
        'images' => 'Hình ảnh',
        'customer' => 'Thông tin khách hàng',
        'organization' => 'Phân loại',
        'permissions' => 'Phân quyền',
        'pricing' => 'Giá & Tồn kho',
        'shipping' => 'Thông tin giao hàng',
        'specifications' => 'Thông số kỹ thuật',
        'business_info' => 'Thông tin doanh nghiệp',
        'gallery' => 'Thư viện ảnh',
        'system_actions' => 'Thao tác hệ thống',
    ],

    'blocks' => [
        'split' => 'Layout 2 cột',
        'two_column' => [
            'image_position' => 'Vị trí ảnh',
            'position_left' => 'Bên trái',
            'position_right' => 'Bên phải',
            'title' => 'Tiêu đề',
            'text' => 'Nội dung văn bản',
            'image' => 'Hình ảnh',
        ],
    ],

    'options' => [
        'text' => 'Chữ',
        'image' => 'Hình ảnh',
    ],

    'actions' => [
        'add_split_block' => 'Thêm block 2 cột',
    ],

    'settings' => [
        'fields' => [
            'site_name' => 'Tên website',
            'site_logo' => 'Logo',
            'site_email' => 'Địa chỉ email',
            'site_phone' => 'Số điện thoại',
            'site_address' => 'Địa chỉ cửa hàng',
            'site_description' => 'Mô tả website',
            'site_map' => 'Địa chỉ map',
            'tax_code' => 'Mã số thuế',
            'business_field' => 'Ngành nghề sản xuất',
            'representative' => 'Người đại diện',
            'working_hours' => 'Giờ làm việc',
            'working_hours_day' => 'Ngày',
            'working_hours_time' => 'Giờ',
            'bank_info' => 'Thông tin ngân hàng',
            'faq' => 'Câu hỏi thường gặp',
            'faq_question' => 'Câu hỏi',
            'faq_answer' => 'Câu trả lời',
            'gallery' => 'Ảnh thư viện',
        ],
    ],

    'helpers' => [
        'page_type' => 'Trang hệ thống không thể truy cập qua slug và bị ẩn khỏi danh sách trang công khai.',
    ],

    'system_settings' => [
        'description' => 'Các thao tác hệ thống. Nhấn nút tương ứng để thực hiện.',
        'clear_cache_tooltip' => 'Xóa toàn bộ cache',
        'cache_cleared' => 'Đã xóa cache',
    ],

    'fields' => [
        'title' => 'Tiêu đề',
        'slug' => 'Đường dẫn',
        'description' => 'Mô tả',
        'content' => 'Nội dung',
        'image' => 'Hình ảnh',
        'images' => 'Hình ảnh',
        'status' => 'Trạng thái',
        'name' => 'Tên',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'code' => 'Mã đơn',
        'phone' => 'Số điện thoại',
        'address' => 'Địa chỉ',
        'note' => 'Ghi chú',
        'total' => 'Tổng tiền',
        'quantity' => 'Số lượng',
        'price' => 'Giá',
        'compare_at_price' => 'Giá so sánh',
        'stock_quantity' => 'Số lượng tồn kho',
        'link' => 'Liên kết',
        'order' => 'Thứ tự',
        'type' => 'Loại',
        'categories' => 'Danh mục',
        'collections' => 'Bộ sưu tập',
        'province_id' => 'Tỉnh',
        'ward_id' => 'Phường/Xã',
        'payment_method' => 'Phương thức thanh toán',
        'payment_status' => 'Trạng thái thanh toán',
        'roles' => 'Vai trò',
        'is_admin' => 'Là admin',
        'is_featured' => 'Sản phẩm nổi bật',
        'featured_position' => 'Vị trí nổi bật',
        'email_verified_at' => 'Email xác nhận',
        'created_at' => 'Ngày tạo',
        'updated_at' => 'Ngày cập nhật',
        'customer_name' => 'Tên khách hàng',
        'product' => 'Sản phẩm',
        'order_code' => 'Mã đơn',
        'email_address' => 'Địa chỉ Email',
        'reviewer_name' => 'Tên người đánh giá',
        'reviewer_email' => 'Email người đánh giá',
        'rating' => 'Đánh giá',
        'comment' => 'Bình luận',
        'is_approved' => 'Đã duyệt',
        'specifications' => 'Thông số kỹ thuật',
        'spec_key' => 'Thông số',
        'spec_value' => 'Giá trị',
        'contact_message' => 'Nội dung',
        'contact_is_read' => 'Đã đọc',
        'contact_read_status' => 'Trạng thái đọc',
        'contact_read' => 'Đã đọc',
        'contact_unread' => 'Chưa đọc',
        'page_type' => 'Loại trang',
        'left_type' => 'Loại cột trái',
        'right_type' => 'Loại cột phải',
        'left_text' => 'Chữ cột trái',
        'right_text' => 'Chữ cột phải',
        'left_image' => 'Ảnh cột trái',
        'right_image' => 'Ảnh cột phải',
    ],
];
