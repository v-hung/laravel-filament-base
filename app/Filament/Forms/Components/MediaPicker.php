<?php

namespace App\Filament\Forms\Components;

use App\Repositories\MediaRepository;
use Filament\Forms\Components\Field;

class MediaPicker extends Field
{
    protected string $view = 'filament.forms.components.media-picker';

    protected bool $multiple = false;

    protected ?string $disk = null;

    protected ?string $collection = null;

    protected array $acceptedFileTypes = ['image/*'];

    protected int $maxFiles = 1;

    protected array $conversions = [];

    public function multiple(bool $condition = true): static
    {
        $this->multiple = $condition;

        if ($condition) {
            $this->maxFiles = 10;
        }

        return $this;
    }

    public function disk(?string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    public function collection(string $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function acceptedFileTypes(array $types): static
    {
        $this->acceptedFileTypes = $types;

        return $this;
    }

    public function maxFiles(int $count): static
    {
        $this->maxFiles = $count;
        $this->multiple = $count > 1;

        return $this;
    }

    public function conversions(array $conversions): static
    {
        $this->conversions = $conversions;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    public function getCollection(): string
    {
        return $this->collection ?? $this->getName();
    }

    public function getDisk(): string
    {
        return $this->disk ?? config('filesystems.default', 'public');
    }

    public function getAcceptedFileTypes(): array
    {
        return $this->acceptedFileTypes;
    }

    public function getMaxFiles(): int
    {
        return $this->maxFiles;
    }

    public function getConversions(): array
    {
        if (! empty($this->conversions)) {
            return $this->conversions;
        }

        $record = $this->getRecord();

        if ($record && method_exists($record, 'registerMediaCollections') && method_exists($record, 'getRegisteredMediaConversions')) {
            $record->registerMediaCollections();

            return $record->getRegisteredMediaConversions($this->getCollection());
        }

        return [];
    }

    public function getSerializedConversions(): array
    {
        return array_map(fn ($c) => [
            'name' => $c->name,
            'width' => $c->width,
            'height' => $c->height,
            'sharpen' => $c->sharpen,
            'queued' => $c->queued,
        ], $this->getConversions());
    }

    public function getModelClass(): ?string
    {
        $record = $this->getRecord();

        return $record ? get_class($record) : null;
    }

    public function getMediaItems(): array
    {
        $state = $this->getState();

        if (empty($state)) {
            return [];
        }

        $ids = $this->multiple ? (is_array($state) ? $state : [$state]) : [$state];

        return app(MediaRepository::class)->getMediaByIds($ids)
            ->map(fn ($media) => [
                'id' => $media->id,
                'name' => $media->name,
                'file_name' => $media->file_name,
                'url' => $media->getUrl(),
                'mime_type' => $media->mime_type,
                'size' => $media->size,
            ])
            ->toArray();
    }
}
