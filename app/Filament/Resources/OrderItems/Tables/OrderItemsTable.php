<?php

namespace App\Filament\Resources\OrderItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.code')->label(__('filament.fields.order_code')),
                TextColumn::make('product.name')->label(__('filament.fields.product')),
                TextColumn::make('quantity')->label(__('filament.fields.quantity')),
                TextColumn::make('price')->money('VND')->label(__('filament.fields.price')),
                TextColumn::make('created_at')->dateTime()->label(__('filament.fields.created_at')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
