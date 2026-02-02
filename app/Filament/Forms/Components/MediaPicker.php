<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaPicker extends Field
{
    protected string $view = 'filament.forms.components.media-picker';

    protected bool $multiple = false;

    protected ?string $collection = null;

    protected ?string $disk = 'public';

    protected array $acceptedFileTypes = ['image/*'];

    protected int $maxFiles = 1;

    public function multiple(bool $condition = true): static
    {
        $this->multiple = $condition;

        if ($condition) {
            $this->maxFiles = 10;
        }

        return $this;
    }

    public function collection(?string $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function disk(?string $disk): static
    {
        $this->disk = $disk;

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

    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function getDisk(): ?string
    {
        return $this->disk;
    }

    public function getAcceptedFileTypes(): array
    {
        return $this->acceptedFileTypes;
    }

    public function getMaxFiles(): int
    {
        return $this->maxFiles;
    }

    public function getMediaItems(): array
    {
        $state = $this->getState();

        if (empty($state)) {
            return [];
        }

        $ids = $this->multiple ? (is_array($state) ? $state : [$state]) : [$state];

        return Media::query()
            ->whereIn('id', $ids)
            ->get()
            ->map(fn (Media $media) => [
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
