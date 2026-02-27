<?php

namespace App\Filament\Resources\OrderItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Select::make('order_id')
                //     ->relationship('order', 'code')
                //     ->required(),
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                TextInput::make('quantity')
                    ->label(__('filament.fields.quantity'))
                    ->numeric()->required(),
                TextInput::make('price')
                    ->label(__('filament.fields.price'))
                    ->numeric('VND')->required(),
            ]);
    }
}
