<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasColor, HasDescription, HasLabel
{
    case Active = 'active';
    case Archived = 'archived';

    public function getLabel(): ?string
    {
        return __("enums.status.{$this->value}.label");
    }

    public function getDescription(): ?string
    {
        return __("enums.status.{$this->value}.description");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Active => 'success',
            self::Archived => 'warning',
        };
    }
}
