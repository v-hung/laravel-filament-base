<?php

namespace App\Filament\Resources\Showcases\Schemas;

use App\Enums\ShowcaseType;
use App\Enums\Status;
use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ShowcaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label(__('filament.fields.type'))
                    ->options(ShowcaseType::class)
                    ->required(),
                TextInput::make('title')
                    ->label(__('filament.fields.title'))
                    ->maxLength(255)
                    ->required(),
                TextInput::make('description')
                    ->label(__('filament.fields.description'))
                    ->maxLength(255)->columnSpan('full'),
                RichEditor::make('content')
                    ->label(__('filament.fields.content'))
                    ->columnSpan('full')
                    ->extraInputAttributes(['style' => 'min-height: 20rem;']),
                MediaPicker::make('image')
                    ->label(__('filament.fields.image'))
                    ->folderPath('showcases')
                    ->acceptedFileTypes(['image/*'])
                    ->columnSpan('full'),
                TextInput::make('link')
                    ->label(__('filament.fields.link'))
                    ->maxLength(255),
                TextInput::make('order')
                    ->label(__('filament.fields.order'))
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->label(__('filament.fields.status'))
                    ->options(Status::class)->default(Status::Active),
            ]);
    }
}
