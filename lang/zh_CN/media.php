<?php

return [
    // Common
    'search_placeholder' => '搜索媒体...',
    'no_media_found' => '未找到媒体',
    'root' => '根目录',
    'cancel' => '取消',
    'close' => '关闭',
    'save_changes' => '保存更改',
    'delete' => '删除',
    'clear' => '清除',
    'location' => '位置',

    // Manager
    'manager' => [
        'search_label' => '搜索',
        'add_folder' => '新建文件夹',
        'add_asset' => '添加资源',
        'folders' => '文件夹',
        'files' => '文件',
        'empty_hint' => '上传文件以开始使用',
        'showing' => '显示',
        'to' => '到',
        'of' => '共',
        'results' => '条结果',
    ],

    // Picker (main modal)
    'picker' => [
        'title' => '添加新资源',
        'tab_browse' => '浏览',
        'tab_selected' => '已选择文件',
        'new_folder' => '新建文件夹',
        'upload_files' => '上传文件',
        'confirm_selection' => '确认选择',
        'files_selected' => '已选择 :count 个文件',
        'no_files_selected' => '未选择文件',
        'click_finish' => '点击“完成”以使用所选文件',
        'go_to_browse' => '前往浏览标签选择文件',
        'add_more_assets' => '添加更多资源',
        'files_ready_to_upload' => '有 :count 个文件待上传',
        'upload_now' => '立即上传',
    ],

    // Detail modal
    'detail' => [
        'title' => '媒体详情',
        'delete_confirm' => '确定要删除此媒体吗？',
        'download' => '下载',
        'copy_link' => '复制链接',
        'open_in_new_tab' => '在新标签页打开',
        'size' => '大小',
        'dimensions' => '尺寸',
        'date' => '日期',
        'extension' => '扩展名',
        'asset_id' => '资源 ID',
        'file_name' => '文件名',
        'alt_text' => '替代文本',
        'alt_text_placeholder' => '例如 favicon 的图片',
        'alt_text_hint' => '当资源无法显示时，将显示此文本。',
        'caption' => '说明',
        'replace_media' => '替换媒体',
        'new_file_selected' => '已选择新文件：',
        'replace_media_btn' => '替换媒体',
    ],

    // Upload modal
    'upload' => [
        'title' => '上传文件',
        'heading' => '上传资源',
        'upload_to' => '上传到：',
        'files_selected' => '已选择 :count 个文件',
        'upload_files_btn' => '上传文件',
        'uploading' => '上传中...',
        'click_to_upload' => '点击上传',
        'drag_and_drop' => '或拖拽文件到此处',
        'drop_here' => '将文件拖到这里',
        'file_types' => '支持 PNG、JPG、GIF，最大 :maxMB',
    ],

    // Folder modals
    'folder' => [
        'create_title' => '创建新文件夹',
        'create_in' => '创建于：',
        'name_label' => '文件夹名称',
        'name_placeholder' => '例如：products、blog、avatars',
        'create_btn' => '创建文件夹',
        'details_title' => '文件夹详情',
        'location_label' => '位置：',
        'delete_title' => '删除此文件夹',
        'delete_hint' => '内容将移动到父文件夹',
        'folders_count' => ':count 个文件夹',
        'files_count' => ':count 个文件',
    ],

    'confirm' => [
        'delete_media_title' => '删除媒体',
        'delete_media_message' => '确定要删除此媒体吗？此操作无法撤销。',
        'delete_folder_title' => '删除文件夹',
        'delete_folder_message' => '确定删除此文件夹吗？内容将移动到父文件夹。',
    ],

    'notifications' => [
        'media_deleted' => '媒体删除成功',
        'media_delete_failed' => '删除媒体失败',
        'media_not_found' => '未找到媒体',
        'media_details_updated' => '媒体信息更新成功',
        'media_details_update_failed' => '更新媒体信息失败',
        'media_replaced' => '媒体替换成功',
        'media_replace_failed' => '替换媒体失败',
        'files_uploaded' => '文件上传成功',
        'files_upload_failed' => '文件上传失败',
        'folder_created' => '文件夹创建成功',
        'folder_create_failed' => '创建文件夹失败',
        'folder_not_found' => '未找到文件夹',
        'folder_deleted' => '文件夹删除成功',
        'folder_delete_failed' => '删除文件夹失败',
        'folder_updated' => '文件夹更新成功',
        'folder_update_failed' => '更新文件夹失败',
        'all_contents_deleted' => '所有内容已删除',
        'error_deleting_folder' => '删除文件夹时发生错误',
    ],

    // Picker field (form component)
    'field' => [
        'click_to_add' => '点击添加资源或将文件拖到此区域',
        'replace' => '替换',
        'view_file' => '查看文件',
        'remove' => '移除',
    ],

    'validation' => [
        'folder_name_regex' => '文件夹名称只能包含字母、数字、空格、连字符和下划线。',
        'folder_name_exists' => '该位置已存在同名文件夹。',
        'max_files' => '最多只能选择 :max 个文件。',
        'invalid_file_type' => '一个或多个文件类型不受支持。',
    ],
];
