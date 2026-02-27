<?php

namespace App\Models;

use App\Models\Media\Mediable;
use App\Models\Media\MediaFolder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    public function __construct(
        protected string $disk = 'public',
        protected string $path = 'media'
    ) {
        $this->disk = config('filesystems.default', 'public');
        $this->path = config('filesystems.media_path', 'media');
    }

    protected $guarded = [];

    protected $hidden = [
        'folder_id',
        'generated_conversions',
    ];

    protected $casts = [
        'custom_properties' => 'array',
        'generated_conversions' => 'array',
    ];

    protected $appends = ['dimensions'];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id');
    }

    public function mediables(): HasMany
    {
        return $this->hasMany(Mediable::class);
    }

    /**
     * Get the relative path to the file: media/{id}/filename
     */
    public function getPath(?string $conversionName = null): ?string
    {
        $basePath = $this->path.'/'.$this->id;

        if ($conversionName) {
            // Build key based on pivot context if available
            $key = $this->buildConversionKey($conversionName);

            // Get conversion filename from generated_conversions
            $conversions = $this->generated_conversions ?? [];
            if (isset($conversions[$key]['file_name'])) {
                return $basePath.'/conversions/'.$conversions[$key]['file_name'];
            }

            // Return null if conversion doesn't exist
            return null;
        }

        return $basePath.'/'.$this->file_name;
    }

    /**
     * Build conversion key from pivot context or simple name
     */
    protected function buildConversionKey(string $conversionName): string
    {
        // If media is loaded via relationship, use pivot data
        if (isset($this->pivot) && $this->pivot->model_type && $this->pivot->collection) {
            $modelBasename = class_basename($this->pivot->model_type);

            return "{$modelBasename}_{$this->pivot->collection}_{$conversionName}";
        }

        // Fallback to simple conversion name
        return $conversionName;
    }

    /**
     * Get the full URL to the file
     */
    public function getUrl(?string $conversionName = null): ?string
    {
        $path = $this->getPath($conversionName);
        if (! $path) {
            return null;
        }

        $diskName = $this->disk ?? config('filesystems.default', 'public');

        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk($diskName);

        return $disk->url($path);
    }

    /**
     * Get the full system path to the file
     */
    public function getFullPath(?string $conversionName = null): ?string
    {
        $path = $this->getPath($conversionName);
        if (! $path) {
            return null;
        }

        $disk = $this->disk ?? config('filesystems.default', 'public');

        return Storage::disk($disk)->path($path);
    }

    public function dimensions(): Attribute
    {
        return Attribute::get(function () {
            if ($this->width && $this->height) {
                return [$this->width, $this->height];
            }

            return null;
        });
    }

    /**
     * Get a custom property value
     */
    public function getCustomProperty(string $key, mixed $default = null): mixed
    {
        $properties = $this->custom_properties ?? [];

        return $properties[$key] ?? $default;
    }

    /**
     * Set a custom property value
     */
    public function setCustomProperty(string $key, mixed $value): static
    {
        $properties = $this->custom_properties ?? [];
        $properties[$key] = $value;
        $this->custom_properties = $properties;

        return $this;
    }
}
