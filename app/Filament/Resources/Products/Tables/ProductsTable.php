<?php

namespace App\Filament\Resources\Products\Tables;

use App\Filament\Tables\Columns\MediaImageColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('filament.fields.name'))->searchable(),
                TextColumn::make('slug')->label(__('filament.fields.slug'))->searchable(),
                MediaImageColumn::make('images')
                    ->label(__('filament.fields.images'))
                    ->limit(3)
                    ->limitedRemainingText(),
                TextColumn::make('price')
                    ->label(__('filament.fields.price'))
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('stock_quantity')
                    ->label(__('filament.fields.stock_quantity'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('filament.fields.status'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.fields.updated_at'))
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
