<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label(__('filament.forms.fields.code'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->label(__('filament.forms.fields.name'))
                    ->required()->maxLength(255),
                TextInput::make('phone')
                    ->label(__('filament.forms.fields.phone'))
                    ->required()->maxLength(20),
                TextInput::make('email')
                    ->label(__('filament.forms.fields.email'))
                    ->email()->maxLength(255),
                // Select::make('user_id')
                //     ->relationship('user', 'name')
                //     ->nullable(),
                Select::make('province_id')
                    ->label(__('filament.forms.fields.province_id'))
                    ->relationship('province', 'name')
                    ->nullable(),
                Select::make('ward_id')
                    ->label(__('filament.forms.fields.ward_id'))
                    ->relationship('ward', 'name')
                    ->nullable(),
                TextInput::make('address')
                    ->label(__('filament.forms.fields.address'))
                    ->maxLength(255),
                Textarea::make('note')
                    ->label(__('filament.forms.fields.note')),
                TextInput::make('total')
                    ->label(__('filament.forms.fields.total'))
                    ->numeric('VND')->default(0),
                Select::make('status')
                    ->label(__('filament.forms.fields.status'))
                    ->options(OrderStatus::class),
                Select::make('payment_method')
                    ->label(__('filament.forms.fields.payment_method'))
                    ->options(PaymentMethod::class),
                Select::make('payment_status')
                    ->label(__('filament.forms.fields.payment_status'))
                    ->options(PaymentStatus::class),
            ]);
    }
}
