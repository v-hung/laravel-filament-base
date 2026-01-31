<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.tables.columns.name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('filament.tables.columns.email_address'))
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->label(__('filament.tables.columns.email_verified_at'))
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('is_admin')
                    ->label(__('filament.tables.columns.is_admin'))
                    ->boolean(),
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
