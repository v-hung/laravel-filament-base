<?php

namespace App\Concerns\Media;

class MediaConversionDefinition
{
    public string $name;

    public ?int $width = null;

    public ?int $height = null;

    public int $sharpen = 0;

    public bool $queued = true;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    public function width(int $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function height(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function sharpen(int $amount): static
    {
        $this->sharpen = $amount;

        return $this;
    }

    public function nonQueued(): static
    {
        $this->queued = false;

        return $this;
    }
}
