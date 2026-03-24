<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum CollectionStatus: string implements HasColor, HasDescription, HasLabel
{
    case Active = 'active';
    case Unlisted = 'unlisted';
    case Inactive = 'inactive';

    public function getLabel(): ?string
    {
        return __("enums.collection_status.{$this->value}.label");
    }

    public function getDescription(): ?string
    {
        return __("enums.collection_status.{$this->value}.description");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Active => 'success',
            self::Unlisted => 'gray',
            self::Inactive => 'warning',
        };
    }
}
