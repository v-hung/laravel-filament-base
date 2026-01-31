<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('filament.tables.columns.name'))->searchable(),
                TextColumn::make('slug')->label(__('filament.tables.columns.slug'))->searchable(),
                ImageColumn::make('images')->label(__('filament.tables.columns.images'))->disk('public')->limit(3)
                    ->limitedRemainingText(),
                TextColumn::make('price')
                    ->label(__('filament.tables.columns.price'))
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('stock_quantity')
                    ->label(__('filament.tables.columns.stock_quantity'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('filament.tables.columns.status'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament.tables.columns.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.tables.columns.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
