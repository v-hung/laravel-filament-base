<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\ImageManager;

class MediaService
{
    protected ImageManager $imageManager;

    public function __construct(
        protected string $disk = 'public',
        protected string $path = 'media'
    ) {
        $this->disk = config('filesystems.default', 'public');
        $this->path = config('filesystems.media_path', 'media');

        // Use Imagick if available, fallback to GD
        $driver = extension_loaded('imagick') ? new ImagickDriver : new GdDriver;
        $this->imageManager = new ImageManager($driver);
    }

    public function createMediaFromUpload(
        UploadedFile $file,
        ?string $collection = null,
        ?int $folderId = null,
        array $customProperties = []
    ): Media {
        // Store file temporarily
        $tempPath = $file->store('temp', $this->disk);
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $uuid = (string) Str::uuid();
        $fileName = $uuid.'.'.$extension;

        // Create media instance
        $media = $this->createMediaInstance(
            name: pathinfo($originalName, PATHINFO_FILENAME),
            fileName: $fileName,
            size: $file->getSize(),
            mimeType: $file->getMimeType(),
            folderId: $folderId,
            customProperties: array_merge($customProperties, [
                'original_name' => $originalName,
            ])
        );

        // Save to get ID
        $media->save();

        // Move file to proper location: media/{id}/uuid.ext
        $finalPath = $this->getMediaPath($media->id, $fileName);
        Storage::disk($this->disk)->move($tempPath, $finalPath);

        // Extract dimensions for images
        $this->extractDimensions($media, $finalPath);
        $media->save();

        return $media;
    }

    public function replaceMedia(
        Media $media,
        UploadedFile $newFile,
        string $name,
        array $customProperties = []
    ): Media {
        // Delete old files (entire media folder including conversions)
        $mediaFolder = $this->getMediaDirectory($media->id);
        if (Storage::disk($this->disk)->exists($mediaFolder)) {
            Storage::disk($this->disk)->deleteDirectory($mediaFolder);
        }

        // Store file temporarily
        $tempPath = $newFile->store('temp', $this->disk);
        $originalName = $newFile->getClientOriginalName();
        $extension = $newFile->getClientOriginalExtension();
        $uuid = (string) Str::uuid();
        $fileName = $uuid.'.'.$extension;

        // Update existing media record
        $media->name = $name;
        $media->file_name = $fileName;
        $media->size = $newFile->getSize();
        $media->mime_type = $newFile->getMimeType();
        $media->custom_properties = array_merge($media->custom_properties ?? [], $customProperties, [
            'original_name' => $originalName,
        ]);
        $media->generated_conversions = []; // Clear old conversions

        // Move file to proper location: media/{id}/uuid.ext
        $finalPath = $this->getMediaPath($media->id, $fileName);
        Storage::disk($this->disk)->move($tempPath, $finalPath);

        // Extract dimensions for images
        $this->extractDimensions($media, $finalPath);
        $media->save();

        return $media;
    }

    protected function createMediaInstance(
        string $name,
        string $fileName,
        int $size,
        string $mimeType,
        ?int $folderId = null,
        array $customProperties = []
    ): Media {
        $media = new Media;
        $media->name = $name;
        $media->file_name = $fileName;
        $media->size = $size;
        $media->mime_type = $mimeType;
        $media->folder_id = $folderId;
        $media->custom_properties = $customProperties;
        $media->generated_conversions = [];

        return $media;
    }

    protected function extractDimensions(Media $media, string $path): void
    {
        if (! $this->isProcessableImage($media)) {
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

    /**
     * Check if media is a processable image (not SVG)
     */
    protected function isProcessableImage(Media $media): bool
    {
        return str_starts_with($media->mime_type, 'image/')
            && $media->mime_type !== 'image/svg+xml';
    }

    public function deleteMedia(Media $media): bool
    {
        try {
            // Delete entire media folder (includes file and conversions)
            $mediaFolder = $this->getMediaDirectory($media->id);
            if (Storage::disk($this->disk)->exists($mediaFolder)) {
                Storage::disk($this->disk)->deleteDirectory($mediaFolder);
            }

            // Delete database record
            return $media->delete();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Delete multiple media items (batch operation)
     * More efficient than calling deleteMedia() in a loop
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $mediaItems
     * @return int Number of successfully deleted items
     */
    public function deleteMediaBatch($mediaItems): int
    {
        $deleted = 0;

        try {
            // Delete all media files from storage
            foreach ($mediaItems as $media) {
                $mediaFolder = $this->getMediaDirectory($media->id);
                if (Storage::disk($this->disk)->exists($mediaFolder)) {
                    Storage::disk($this->disk)->deleteDirectory($mediaFolder);
                    $deleted++;
                }
            }

            // Delete all media from database (1 query)
            $mediaIds = $mediaItems->pluck('id')->toArray();
            Media::whereIn('id', $mediaIds)->delete();

            return $deleted;
        } catch (\Exception $e) {
            logger()->error('Failed to delete media batch: '.$e->getMessage());

            return $deleted;
        }
    }

    /**
     * Get the full path for a media file: media/{id}/filename
     */
    protected function getMediaPath(int $mediaId, string $fileName): string
    {
        return $this->path.'/'.$mediaId.'/'.$fileName;
    }

    /**
     * Get the directory path for a media: media/{id}
     */
    public function getMediaDirectory(int $mediaId): string
    {
        return $this->path.'/'.$mediaId;
    }

    /**
     * Get the conversions directory path: media/{id}/conversions
     */
    protected function getConversionsPath(int $mediaId): string
    {
        return $this->path.'/'.$mediaId.'/conversions';
    }

    /**
     * Generate a conversion for a media file
     *
     * @param  mixed  $conversion  MediaConversionDefinition
     * @param  string|null  $modelClass  Full model class name (e.g., App\Models\Product)
     * @param  string|null  $collection  Collection name (e.g., 'gallery')
     */
    public function generateConversion(
        Media $media,
        $conversion,
        ?string $modelClass = null,
        ?string $collection = null
    ): void {
        if (! $this->isProcessableImage($media)) {
            return;
        }

        // Build conversion key
        $key = $this->buildConversionKey($conversion->name, $modelClass, $collection);

        try {
            $sourcePath = $media->getFullPath();
            if (! file_exists($sourcePath)) {
                return;
            }

            // Load image with Intervention
            $image = $this->imageManager->read($sourcePath);

            // Resize image based on conversion settings
            if ($conversion->width && $conversion->height) {
                // Scale to fit within dimensions
                $image->scale(
                    width: $conversion->width,
                    height: $conversion->height
                );
            } elseif ($conversion->width) {
                $image->scaleDown(width: $conversion->width);
            } elseif ($conversion->height) {
                $image->scaleDown(height: $conversion->height);
            }

            // Apply sharpening if specified
            if ($conversion->sharpen > 0) {
                $image->sharpen($conversion->sharpen);
            }

            // Save conversion
            $conversionFileName = $this->saveConversionImage($media, $conversion, $image);

            $this->markConversionAsGenerated(
                $media,
                $key,
                $conversionFileName,
                $image->width(),
                $image->height()
            );
        } catch (\Exception $e) {
            logger()->error('Failed to generate conversion: '.$e->getMessage());
        }
    }

    protected function saveConversionImage(Media $media, $conversion, $image): string
    {
        $conversionsDir = $this->getConversionsPath($media->id);
        Storage::disk($media->disk)->makeDirectory($conversionsDir);

        // Generate unique UUID for each conversion
        $uuid = (string) Str::uuid();
        $extension = pathinfo($media->file_name, PATHINFO_EXTENSION);
        $conversionFileName = $uuid.'-'.$conversion->name.'.'.$extension;
        $conversionPath = $conversionsDir.'/'.$conversionFileName;
        $fullPath = Storage::disk($media->disk)->path($conversionPath);

        // Intervention Image automatically handles format and quality
        $image->save($fullPath, quality: 90);

        return $conversionFileName;
    }

    protected function markConversionAsGenerated(
        Media $media,
        string $conversionKey,
        string $fileName,
        int $width,
        int $height
    ): void {
        $conversions = $media->generated_conversions ?? [];
        $conversions[$conversionKey] = [
            'file_name' => $fileName,
            'width' => $width,
            'height' => $height,
            'generated_at' => now()->toDateTimeString(),
        ];
        $media->generated_conversions = $conversions;
        $media->save();
    }

    /**
     * Build conversion key from model context
     *
     * @param  string  $conversionName  Simple name like 'thumb'
     * @param  string|null  $modelClass  Full class name like 'App\Models\Product'
     * @param  string|null  $collection  Collection name like 'gallery'
     * @return string Key like 'Product_gallery_thumb' or just 'thumb'
     */
    protected function buildConversionKey(
        string $conversionName,
        ?string $modelClass = null,
        ?string $collection = null
    ): string {
        if ($modelClass && $collection) {
            $modelBasename = class_basename($modelClass);

            return "{$modelBasename}_{$collection}_{$conversionName}";
        }

        return $conversionName;
    }
}
