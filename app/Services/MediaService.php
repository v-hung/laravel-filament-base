<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    public function __construct(
        protected string $disk = 'public',
        protected string $path = 'media'
    ) {
        $this->disk = config('filesystems.default', 'public');
        $this->path = config('filesystems.media_path', 'media');
    }

    public function createMediaFromUpload(
        UploadedFile $file,
        ?string $collection = null,
        ?int $folderId = null,
        array $customProperties = []
    ): Media {
        // Store file
        $filePath = $file->store($this->path, $this->disk);

        // Create media instance
        $media = $this->createMediaInstance(
            name: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            fileName: basename($filePath),
            disk: $this->disk,
            size: $file->getSize(),
            mimeType: $file->getMimeType(),
            collection: $collection ?? 'default',
            folderId: $folderId,
            customProperties: $customProperties
        );

        // Extract dimensions for images
        $this->extractDimensions($media, $filePath);

        $media->save();

        return $media;
    }

    public function replaceMedia(
        Media $oldMedia,
        UploadedFile $newFile,
        string $name,
        array $customProperties = []
    ): Media {
        // Store new file
        $filePath = $newFile->store($this->path, $this->disk);

        // Create new media instance
        $newMedia = $this->createMediaInstance(
            name: $name,
            fileName: basename($filePath),
            disk: $this->disk,
            size: $newFile->getSize(),
            mimeType: $newFile->getMimeType(),
            collection: $oldMedia->collection_name,
            folderId: $oldMedia->folder_id,
            customProperties: $customProperties
        );

        // Extract dimensions for images
        $this->extractDimensions($newMedia, $filePath);

        $newMedia->save();

        // Delete old media
        $oldMedia->delete();

        return $newMedia;
    }

    protected function createMediaInstance(
        string $name,
        string $fileName,
        string $disk,
        int $size,
        string $mimeType,
        string $collection,
        ?int $folderId = null,
        array $customProperties = []
    ): Media {
        $media = new Media;
        $media->name = $name;
        $media->file_name = $fileName;
        $media->disk = $disk;
        $media->size = $size;
        $media->mime_type = $mimeType;
        $media->folder_id = $folderId;
        $media->collection_name = $collection;
        $media->manipulations = [];
        $media->custom_properties = $customProperties;
        $media->generated_conversions = [];
        $media->responsive_images = [];

        return $media;
    }

    protected function extractDimensions(Media $media, string $path): void
    {
        if (! str_starts_with($media->mime_type, 'image/') || $media->mime_type === 'image/svg+xml') {
            return;
        }

        try {
            $fullPath = Storage::disk($this->disk)->path($path);
            $imageInfo = getimagesize($fullPath);

            if ($imageInfo) {
                $media->width = $imageInfo[0];
                $media->height = $imageInfo[1];
            }
        } catch (\Exception $e) {
            // Ignore errors, dimensions will be null
        }
    }

    public function deleteMedia(Media $media): bool
    {
        try {
            // Delete physical file
            if (Storage::disk($media->disk)->exists($this->path.'/'.$media->file_name)) {
                Storage::disk($media->disk)->delete($this->path.'/'.$media->file_name);
            }

            // Delete database record
            return $media->delete();
        } catch (\Exception $e) {
            return false;
        }
    }
}
