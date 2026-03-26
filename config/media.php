<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Media Upload Size Limit
    |--------------------------------------------------------------------------
    |
    | Maximum file size allowed for media uploads, in kilobytes (KB).
    | The default is 10240 KB (10 MB). Override via MEDIA_MAX_UPLOAD_SIZE.
    |
    */

    'max_upload_size' => (int) env('MEDIA_MAX_UPLOAD_SIZE', 10240),

];
