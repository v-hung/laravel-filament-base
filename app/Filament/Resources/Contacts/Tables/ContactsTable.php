<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_read')
                    ->label(__('filament.fields.contact_is_read'))
                    ->state(fn ($record) => $record->isRead())
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),
                TextColumn::make('name')
                    ->label(__('filament.fields.name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('filament.fields.email_address'))
                    ->searchable(),
                TextColumn::make('content')
                    ->label(__('filament.fields.contact_message'))
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->content),
                TextColumn::make('created_at')
                    ->label(__('filament.fields.created_at'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('read_at')
                    ->label(__('filament.fields.contact_read_status'))
                    ->nullable()
                    ->trueLabel(__('filament.fields.contact_read'))
                    ->falseLabel(__('filament.fields.contact_unread'))
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('read_at'),
                        false: fn (Builder $query) => $query->whereNull('read_at'),
                        blank: fn (Builder $query) => $query,
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
