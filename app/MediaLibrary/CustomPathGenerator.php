<?php

namespace App\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        // Nó sẽ tạo ra: products/1/image.jpg
        return $media->collection_name.'/'.$media->id.'/';
    }

    /**
     * Đường dẫn cho các bản resize (conversions)
     */
    public function getPathForConversions(Media $media): string
    {
        return $media->collection_name.'/'.$media->id.'/conversions/';
    }

    /**
     * Đường dẫn cho file tạm (responsive images)
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $media->collection_name.'/'.$media->id.'/responsive/';
    }
}
