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
                TextColumn::make('order.code')->label(__('filament.tables.columns.order_code')),
                TextColumn::make('product.name')->label(__('filament.tables.columns.product')),
                TextColumn::make('quantity')->label(__('filament.tables.columns.quantity')),
                TextColumn::make('price')->money('VND')->label(__('filament.tables.columns.price')),
                TextColumn::make('created_at')->dateTime()->label(__('filament.tables.columns.created_at')),
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
