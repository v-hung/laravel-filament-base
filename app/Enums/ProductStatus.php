<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum ProductStatus: string implements HasColor, HasDescription, HasLabel
{
    case Active = 'active';
    case Inactive = 'inactive';
    case OutOfStock = 'out_of_stock';
    case ComingSoon = 'coming_soon';
    case Discontinued = 'discontinued';

    public function getLabel(): ?string
    {
        return __("enums.product_status.{$this->value}.label");
    }

    public function getDescription(): ?string
    {
        return __("enums.product_status.{$this->value}.description");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Active => 'success',
            self::Inactive => 'gray',
            self::OutOfStock => 'danger',
            self::ComingSoon => 'info',
            self::Discontinued => 'warning',
        };
    }
}
