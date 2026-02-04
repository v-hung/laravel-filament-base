<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasColor, HasDescription, HasLabel
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Failed = 'failed';
    case Refunded = 'refunded';
    case Canceled = 'canceled';

    public function getLabel(): ?string
    {
        return __("shop.payment.status.{$this->value}.label");
    }

    public function getDescription(): ?string
    {
        return __("shop.payment.status.{$this->value}.description");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Paid => 'success',
            self::Failed => 'danger',
            self::Refunded => 'warning',
            self::Canceled => 'secondary',
        };
    }
}
