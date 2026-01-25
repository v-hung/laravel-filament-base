<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->label(__('filament.tables.columns.code')),
                TextColumn::make('name')->label(__('filament.tables.columns.customer_name')),
                TextColumn::make('total')->money('VND')->label(__('filament.tables.columns.total')),
                TextColumn::make('status')->label(__('filament.tables.columns.status'))->badge(),
                TextColumn::make('payment_method')->label(__('filament.tables.columns.payment_method'))->badge(),
                TextColumn::make('payment_status')->label(__('filament.tables.columns.payment_status'))->badge(),
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
