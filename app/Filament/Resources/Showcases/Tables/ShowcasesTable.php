<?php

namespace App\Filament\Resources\Showcases\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ShowcasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')->label(__('filament.tables.columns.type'))->badge(),
                TextColumn::make('title')->label(__('filament.tables.columns.title'))->searchable(),
                ImageColumn::make('image')->label(__('filament.tables.columns.image'))->disk('public'),
                TextColumn::make('status')->label(__('filament.tables.columns.status'))->badge(),
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
