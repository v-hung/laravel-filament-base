<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\ContentStatus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;

class PageForm
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
                            Rule::unique('pages', "slug")->ignore($record?->id),
                            // Rule::unique('pages', "slug->$locale")
                            //     ->ignore($record?->id),
                        ];
                    }),
                TextInput::make('description')
                    ->label(__('filament.forms.fields.description'))
                    ->maxLength(255)->columnSpan('full'),
                RichEditor::make('content')
                    ->label(__('filament.forms.fields.content'))
                    ->columnSpan('full')
                    ->extraInputAttributes(['style' => 'min-height: 20rem;']),
                FileUpload::make('images')
                    ->label(__('filament.forms.fields.images'))
                    ->disk('public')->directory('pages')
                    ->multiple(),
                Select::make('status')
                    ->label(__('filament.forms.fields.status'))
                    ->options(ContentStatus::class)
                    ->default(ContentStatus::Published),
            ]);
    }
}
