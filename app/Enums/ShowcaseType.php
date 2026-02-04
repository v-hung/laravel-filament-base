<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum ShowcaseType: string implements HasColor, HasDescription, HasLabel
{
    case Testimonial = 'testimonial';
    case Partner = 'partner';

    public function getLabel(): ?string
    {
        return __("enums.showcase_type.{$this->value}.label");
    }

    public function getDescription(): ?string
    {
        return __("enums.showcase_type.{$this->value}.description");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Testimonial => 'secondary',
            self::Testimonial => 'waring',
        };
    }
}
