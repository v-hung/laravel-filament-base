<?php

namespace App\Filament\Resources\Showcases\Tables;

use App\Filament\Tables\Columns\MediaImageColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ShowcasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')->label(__('filament.fields.type'))->badge(),
                TextColumn::make('title')->label(__('filament.fields.title'))->searchable(),
                MediaImageColumn::make('image')->label(__('filament.fields.image')),
                TextColumn::make('status')->label(__('filament.fields.status'))->badge(),
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
