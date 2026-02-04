<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum CategoryStatus: string implements HasColor, HasDescription, HasLabel
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Archived = 'archived';

    public function getLabel(): ?string
    {
        return __("enums.category_status.{$this->value}.label");
    }

    public function getDescription(): ?string
    {
        return __("enums.category_status.{$this->value}.description");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Active => 'success',
            self::Inactive => 'gray',
            self::Archived => 'warning',
        };
    }
}
