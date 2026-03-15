<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum PageType: string implements HasColor, HasDescription, HasLabel
{
    case Regular = 'regular';
    case System = 'system';

    public function getLabel(): ?string
    {
        return __("enums.page_type.{$this->value}.label");
    }

    public function getDescription(): ?string
    {
        return __("enums.page_type.{$this->value}.description");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Regular => 'primary',
            self::System => 'warning',
        };
    }
}
