<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasColor, HasDescription, HasLabel
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Shipped = 'shipped';
    case Completed = 'completed';
    case Canceled = 'canceled';

    public function getLabel(): ?string
    {
        return __("shop.order.status.{$this->value}.label");
    }

    public function getDescription(): ?string
    {
        return __("shop.order.status.{$this->value}.description");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Paid => 'primary',
            self::Shipped => 'info',
            self::Completed => 'success',
            self::Canceled => 'danger',
        };
    }
}
