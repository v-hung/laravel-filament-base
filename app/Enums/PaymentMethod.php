<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel
{
    case BANK_TRANSFER = 'bank_transfer';
    case CASH_DELIVERY = 'cash_delivery';

    public function getLabel(): ?string
    {
        return __("shop.payment.method.{$this->value}");
    }
}
