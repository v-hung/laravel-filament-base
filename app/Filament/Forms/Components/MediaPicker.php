<?php

namespace App\Filament\Forms\Components;

use App\Models\Media;
use Filament\Forms\Components\Field;

class MediaPicker extends Field
{
    protected string $view = 'filament.forms.components.media-picker';

    protected bool $multiple = false;

    protected ?string $disk = null;

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

    public function getCollection(): ?string
    {
        return $this->name;
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
        return $this->conversions;
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
