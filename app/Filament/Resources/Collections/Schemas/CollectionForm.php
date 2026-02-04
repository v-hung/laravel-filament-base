<?php

namespace App\Filament\Resources\Collections\Schemas;

use App\Enums\CategoryStatus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CollectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('filament.forms.fields.title'))
                    ->maxLength(255)
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->label(__('filament.forms.fields.slug'))
                    ->required()
                    ->maxLength(255)
                    ->rules(function ($livewire, $record) {
                        $locale = $livewire->activeLocale ?? app()->getLocale();

                        return [
                            Rule::unique('collections', 'slug')->ignore($record?->id),
                            // Rule::unique('collections', "slug->$locale")
                            //     ->ignore($record?->id),
                        ];
                    }),
                TextInput::make('description')
                    ->label(__('filament.forms.fields.description'))
                    ->maxLength(255)->columnSpan('full'),
                FileUpload::make('image')
                    ->label(__('filament.forms.fields.image'))
                    ->disk('public')->directory('collections')->columnSpan('full'),
                Select::make('status')
                    ->label(__('filament.forms.fields.status'))
                    ->options(CategoryStatus::class)
                    ->default(CategoryStatus::Active),
            ]);
    }
}
