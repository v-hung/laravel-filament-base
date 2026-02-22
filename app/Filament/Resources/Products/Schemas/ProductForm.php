<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Concerns\Media\MediaConversionDefinition;
use App\Enums\ProductStatus;
use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                TextInput::make('name')
                    ->label(__('filament.forms.fields.name'))
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
                            // Rule::unique('products', "slug")->ignore($record?->id),
                            Rule::unique('products', "slug->$locale")
                                ->ignore($record?->id),
                        ];
                    }),
                TextInput::make('description')
                    ->label(__('filament.forms.fields.description'))
                    ->maxLength(255)->columnSpan('full'),
                RichEditor::make('content')
                    ->label(__('filament.forms.fields.content'))
                    ->columnSpan('full')
                    ->extraInputAttributes(['style' => 'min-height: 20rem;']),
                MediaPicker::make('images')
                    ->label(__('filament.forms.fields.images'))
                    ->acceptedFileTypes(['image/*'])
                    ->multiple()
                    ->conversions([
                        MediaConversionDefinition::make('thumb')
                            ->width(200)
                            ->height(200)
                            ->sharpen(10),
                    ])
                    ->columnSpan('full'),
                TextInput::make('compare_at_price')
                    ->label(__('filament.forms.fields.compare_at_price'))
                    ->numeric()
                    ->prefix('VND'),
                TextInput::make('price')
                    ->label(__('filament.forms.fields.price'))
                    ->required()
                    ->numeric()
                    ->prefix('VND'),
                TextInput::make('stock_quantity')
                    ->label(__('filament.forms.fields.stock_quantity'))
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('collections')
                    ->label(__('filament.forms.fields.collections'))
                    ->relationship('collections', 'title')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                // Section::make([
                //     ProductOptionVariant::make('option_variant'),
                // ])->columnSpan('full'),
                Select::make('status')
                    ->label(__('filament.forms.fields.status'))
                    ->options(ProductStatus::class)
                    ->default(ProductStatus::Active),
            ]);
    }
}
