<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Concerns\Media\MediaConversionDefinition;
use App\Enums\ContentStatus;
use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('filament.fields.title'))
                    ->maxLength(255)
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->label(__('filament.fields.slug'))
                    ->required()
                    ->maxLength(255)
                    ->rules(function ($livewire, $record) {
                        $locale = $livewire->activeLocale ?? app()->getLocale();

                        return [
                            // Rule::unique('posts', 'slug')->ignore($record?->id),
                            Rule::unique('posts', "slug->$locale")
                                ->ignore($record?->id),
                        ];
                    }),
                TextInput::make('description')
                    ->label(__('filament.fields.description'))
                    ->maxLength(255)->columnSpan('full'),
                RichEditor::make('content')
                    ->label(__('filament.fields.content'))
                    ->columnSpan('full')
                    ->extraInputAttributes(['style' => 'min-height: 20rem;']),
                MediaPicker::make('image')
                    ->label(__('filament.fields.image'))
                    ->folderPath('posts')
                    ->acceptedFileTypes(['image/*'])
                    ->conversions([
                        MediaConversionDefinition::make('thumb')
                            ->width(300)
                            ->height(300)
                            ->sharpen(10),
                    ])
                    ->columnSpan('full'),
                Select::make('categories')
                    ->label(__('filament.fields.categories'))
                    ->relationship('categories', 'title')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->label(__('filament.fields.status'))
                    ->options(ContentStatus::class)
                    ->default(ContentStatus::Published),
            ]);
    }
}
