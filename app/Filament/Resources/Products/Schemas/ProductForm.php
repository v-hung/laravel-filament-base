<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Concerns\Media\MediaConversionDefinition;
use App\Enums\ProductStatus;
use App\Filament\Forms\Components\MediaPicker;
use App\Helpers\Filament\FormHelper;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductForm
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
                                    TextInput::make('name')
                                        ->label(FormHelper::localizedLabel(__('filament.fields.name')))
                                        ->validationAttribute(__('filament.fields.name'))
                                        ->maxLength(255)
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function (Set $set, $state, $record) {
                                            if (! $record) {
                                                $set('slug', Str::slug($state));
                                            }
                                        }),
                                    TextInput::make('slug')
                                        ->label(FormHelper::localizedLabel(__('filament.fields.slug')))
                                        ->validationAttribute(__('filament.fields.slug'))
                                        ->required()
                                        ->maxLength(255)
                                        ->rules(function ($livewire, $record) {
                                            $locale = $livewire->activeLocale ?? app()->getLocale();

                                            return [
                                                Rule::unique('products', "slug->$locale")
                                                    ->ignore($record?->id),
                                            ];
                                        }),
                                ]),
                                Textarea::make('description')
                                    ->label(FormHelper::localizedLabel(__('filament.fields.description')))
                                    ->rows(3),
                            ]),

                        // Section::make(__('filament.sections.content'))
                        //     ->schema([
                        //         RichEditor::make('content')
                        //             ->label(__('filament.fields.content'))
                        //             ->extraInputAttributes(['style' => 'min-height: 20rem;']),
                        //     ]),

                        Section::make(__('filament.sections.images'))
                            ->schema([
                                MediaPicker::make('images')
                                    ->label(__('filament.fields.images'))
                                    ->folderPath('products')
                                    ->acceptedFileTypes(['image/*'])
                                    ->multiple()
                                    ->conversions([
                                        MediaConversionDefinition::make('thumb')
                                            ->width(400)
                                            ->height(400)
                                            ->sharpen(10),
                                    ]),
                            ]),

                        Section::make(__('filament.sections.specifications'))
                            ->schema([
                                KeyValue::make('specifications')
                                    ->label(FormHelper::localizedLabel(__('filament.fields.specifications')))
                                    ->keyLabel(__('filament.fields.spec_key'))
                                    ->valueLabel(__('filament.fields.spec_value'))
                                    ->reorderable(),
                                Textarea::make('features')
                                    ->label(FormHelper::localizedLabel(__('filament.fields.features')))
                                    ->rows(4),
                                Textarea::make('policies')
                                    ->label(FormHelper::localizedLabel(__('filament.fields.policies')))
                                    ->rows(4),
                            ]),

                        // Section::make(__('filament.sections.pricing'))
                        //     ->schema([
                        //         Grid::make(3)->schema([
                        //             TextInput::make('price')
                        //                 ->label(__('filament.fields.price'))
                        //                 ->required()
                        //                 ->numeric()
                        //                 ->default(0)
                        //                 ->prefix('VND'),
                        //             TextInput::make('compare_at_price')
                        //                 ->label(__('filament.fields.compare_at_price'))
                        //                 ->numeric()
                        //                 ->prefix('VND'),
                        //             TextInput::make('stock_quantity')
                        //                 ->label(__('filament.fields.stock_quantity'))
                        //                 ->required()
                        //                 ->numeric()
                        //                 ->default(0),
                        //         ]),
                        //     ]),
                    ]),

                    // Sidebar (right, 1/3)
                    Grid::make(1)->columnSpan(1)->schema([
                        Section::make(__('filament.sections.organization'))
                            ->schema([
                                Select::make('status')
                                    ->label(__('filament.fields.status'))
                                    ->options(ProductStatus::class)
                                    ->default(ProductStatus::Active),
                                Select::make('collections')
                                    ->label(__('filament.fields.collections'))
                                    ->relationship('collections', 'title')
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),
                            ]),

                        Section::make(__('filament.sections.featured'))
                            ->schema([
                                Toggle::make('is_featured')
                                    ->label(__('filament.fields.is_featured'))
                                    ->default(false)
                                    ->live(),
                                TextInput::make('featured_position')
                                    ->label(__('filament.fields.featured_position'))
                                    ->numeric()
                                    ->default(0)
                                    ->visible(fn (Get $get): bool => (bool) $get('is_featured')),
                            ]),

                    ]),
                ]),
            ]);
    }
}
