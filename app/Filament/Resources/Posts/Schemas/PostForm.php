<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Concerns\Media\MediaConversionDefinition;
use App\Enums\ContentStatus;
use App\Filament\Forms\Components\MediaPicker;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\TwoColumnBlock;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
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
                Grid::make(3)->columnSpanFull()->schema([
                    // Main content (left, 2/3)
                    Grid::make(1)->columnSpan(2)->schema([
                        Section::make(__('filament.sections.basic'))
                            ->schema([
                                Grid::make(2)->schema([
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
                                                Rule::unique('posts', "slug->$locale")
                                                    ->ignore($record?->id),
                                            ];
                                        }),
                                ]),
                                TextInput::make('description')
                                    ->label(__('filament.fields.description'))
                                    ->maxLength(255),
                            ]),

                        Section::make(__('filament.sections.content'))
                            ->schema([
                                RichEditor::make('content')
                                    ->label(__('filament.fields.content'))
                                    ->extraInputAttributes(['style' => 'min-height: 20rem;'])
                                    ->customBlocks([
                                        TwoColumnBlock::class,
                                    ]),
                            ]),

                        Section::make(__('filament.sections.images'))
                            ->schema([
                                MediaPicker::make('image')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('posts')
                                    ->acceptedFileTypes(['image/*'])
                                    ->conversions([
                                        MediaConversionDefinition::make('thumb')
                                            ->width(300)
                                            ->height(300)
                                            ->sharpen(10),
                                    ]),
                            ]),
                    ]),

                    // Sidebar (right, 1/3)
                    Grid::make(1)->columnSpan(1)->schema([
                        Section::make(__('filament.sections.organization'))
                            ->schema([
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
                            ]),
                    ]),
                ]),
            ]);
    }
}
