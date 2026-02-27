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
                TextColumn::make('code')->label(__('filament.fields.code')),
                TextColumn::make('name')->label(__('filament.fields.customer_name')),
                TextColumn::make('total')->money('VND')->label(__('filament.fields.total')),
                TextColumn::make('status')->label(__('filament.fields.status'))->badge(),
                TextColumn::make('payment_method')->label(__('filament.fields.payment_method'))->badge(),
                TextColumn::make('payment_status')->label(__('filament.fields.payment_status'))->badge(),
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
