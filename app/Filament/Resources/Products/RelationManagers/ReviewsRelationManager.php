<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reviewer_name')
                    ->label(__('filament.fields.reviewer_name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('reviewer_email')
                    ->label(__('filament.fields.reviewer_email'))
                    ->email()
                    ->maxLength(255),
                Select::make('rating')
                    ->label(__('filament.fields.rating'))
                    ->options([
                        1 => '⭐ 1',
                        2 => '⭐⭐ 2',
                        3 => '⭐⭐⭐ 3',
                        4 => '⭐⭐⭐⭐ 4',
                        5 => '⭐⭐⭐⭐⭐ 5',
                    ])
                    ->required(),
                Textarea::make('comment')
                    ->label(__('filament.fields.comment'))
                    ->rows(4)
                    ->columnSpan('full'),
                Toggle::make('is_approved')
                    ->label(__('filament.fields.is_approved'))
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reviewer_name')
                    ->label(__('filament.fields.reviewer_name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reviewer_email')
                    ->label(__('filament.fields.reviewer_email'))
                    ->searchable(),
                TextColumn::make('rating')
                    ->label(__('filament.fields.rating'))
                    ->sortable()
                    ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)),
                TextColumn::make('comment')
                    ->label(__('filament.fields.comment'))
                    ->limit(50)
                    ->wrap(),
                IconColumn::make('is_approved')
                    ->label(__('filament.fields.is_approved'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('filament.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label(__('filament.fields.is_approved')),
                SelectFilter::make('rating')
                    ->label(__('filament.fields.rating'))
                    ->options([
                        1 => '1 ⭐',
                        2 => '2 ⭐⭐',
                        3 => '3 ⭐⭐⭐',
                        4 => '4 ⭐⭐⭐⭐',
                        5 => '5 ⭐⭐⭐⭐⭐',
                    ]),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
