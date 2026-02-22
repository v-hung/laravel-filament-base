<?php

return [
    // Common
    'search_placeholder' => 'Search media...',
    'no_media_found' => 'No media found',
    'root' => 'Root',
    'cancel' => 'Cancel',
    'close' => 'Close',
    'save_changes' => 'Save Changes',
    'delete' => 'Delete',
    'clear' => 'Clear',
    'location' => 'Location',

    // Manager
    'manager' => [
        'search_label' => 'Search',
        'add_folder' => 'Add Folder',
        'add_asset' => 'Add Asset',
        'folders' => 'Folders',
        'files' => 'Files',
        'empty_hint' => 'Upload some files to get started',
        'showing' => 'Showing',
        'to' => 'to',
        'of' => 'of',
        'results' => 'results',
    ],

    // Picker (main modal)
    'picker' => [
        'title' => 'Add new assets',
        'tab_browse' => 'Browse',
        'tab_selected' => 'Selected Files',
        'new_folder' => 'New Folder',
        'upload_files' => 'Upload Files',
        'confirm_selection' => 'Confirm Selection',
        'files_selected' => ':count file(s) selected',
        'no_files_selected' => 'No files selected',
        'click_finish' => 'Click "Finish" to use selected files',
        'go_to_browse' => 'Go to Browse tab to select files',
        'add_more_assets' => 'Add more assets',
        'files_ready_to_upload' => ':count file(s) ready to upload',
        'upload_now' => 'Upload Now',
    ],

    // Detail modal
    'detail' => [
        'title' => 'Media Details',
        'delete_confirm' => 'Are you sure you want to delete this media?',
        'download' => 'Download',
        'copy_link' => 'Copy link',
        'open_in_new_tab' => 'Open in new tab',
        'size' => 'Size',
        'dimensions' => 'Dimensions',
        'date' => 'Date',
        'extension' => 'Extension',
        'asset_id' => 'Asset ID',
        'file_name' => 'File name',
        'alt_text' => 'Alternative text',
        'alt_text_placeholder' => 'An image uploaded called favicon',
        'alt_text_hint' => "This text will be displayed if the asset can't be shown.",
        'caption' => 'Caption',
        'replace_media' => 'Replace media',
        'new_file_selected' => 'New file selected:',
        'replace_media_btn' => 'Replace Media',
    ],

    // Upload modal
    'upload' => [
        'title' => 'Upload Files',
        'heading' => 'Upload Assets',
        'upload_to' => 'Upload to:',
        'files_selected' => ':count file(s) selected',
        'upload_files_btn' => 'Upload Files',
        'click_to_upload' => 'Click to upload',
        'drag_and_drop' => 'or drag and drop',
        'drop_here' => 'Drop files here',
        'file_types' => 'PNG, JPG, GIF up to 10MB',
    ],

    // Folder modals
    'folder' => [
        'create_title' => 'Create New Folder',
        'create_in' => 'Create folder in:',
        'name_label' => 'Folder Name',
        'name_placeholder' => 'e.g. products, blog, avatars',
        'create_btn' => 'Create Folder',
        'details_title' => 'Folder Details',
        'location_label' => 'Location:',
        'delete_title' => 'Delete this folder',
        'delete_hint' => 'Contents will be moved to parent folder',
        'folders_count' => ':count folder|:count folders',
        'files_count' => ':count file|:count files',
    ],

    'confirm' => [
        'delete_media_title' => 'Delete Media',
        'delete_media_message' => 'Are you sure you want to delete this media? This action cannot be undone.',
        'delete_folder_title' => 'Delete Folder',
        'delete_folder_message' => 'Delete this folder? Contents will be moved to parent folder.',
    ],

    'notifications' => [
        'media_deleted' => 'Media deleted successfully',
        'media_delete_failed' => 'Failed to delete media',
        'media_not_found' => 'Media not found',
        'media_details_updated' => 'Media details updated successfully',
        'media_details_update_failed' => 'Failed to update media details',
        'media_replaced' => 'Media replaced successfully',
        'media_replace_failed' => 'Failed to replace media',
        'files_uploaded' => 'Files uploaded successfully',
        'files_upload_failed' => 'Failed to upload files',
        'folder_created' => 'Folder created successfully',
        'folder_create_failed' => 'Failed to create folder',
        'folder_not_found' => 'Folder not found',
        'folder_deleted' => 'Folder deleted successfully',
        'folder_delete_failed' => 'Failed to delete folder',
        'folder_updated' => 'Folder updated successfully',
        'folder_update_failed' => 'Failed to update folder',
        'all_contents_deleted' => 'All contents deleted',
        'error_deleting_folder' => 'Error deleting folder',
    ],

    'validation' => [
        'folder_name_regex' => 'Folder name can only contain letters, numbers, spaces, hyphens, and underscores.',
        'folder_name_exists' => 'A folder with this name already exists in this location.',
    ],
];
