<?php

namespace App\Filament\Resources\Blogs\Schemas;

use App\Enums\CategoryStatus;
use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogForm
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
                            // Rule::unique('blogs', 'slug')->ignore($record?->id),
                            Rule::unique('blogs', "slug->$locale")
                                ->ignore($record?->id),
                        ];
                    }),
                TextInput::make('description')
                    ->label(__('filament.fields.description'))
                    ->maxLength(255)->columnSpan('full'),
                MediaPicker::make('image')
                    ->label(__('filament.fields.image'))
                    ->folderPath('blogs')
                    ->acceptedFileTypes(['image/*'])
                    ->columnSpan('full'),
                Select::make('status')
                    ->label(__('filament.fields.status'))
                    ->options(CategoryStatus::class)
                    ->default(CategoryStatus::Active),
            ]);
    }
}
