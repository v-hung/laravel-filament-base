<?php

namespace App\Filament\Resources\Collections\Schemas;

use App\Enums\CollectionStatus;
use App\Filament\Forms\Components\MediaPicker;
use App\Helpers\Filament\FormHelper;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
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
                Grid::make(3)->columnSpanFull()->schema([
                    // Main content (left, 2/3)
                    Grid::make(1)->columnSpan(2)->schema([
                        Section::make(__('filament.sections.basic'))
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('title')
                                        ->label(FormHelper::localizedLabel(__('filament.fields.title')))
                                        ->validationAttribute(__('filament.fields.title'))
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
                                                Rule::unique('collections', "slug->$locale")
                                                    ->ignore($record?->id),
                                            ];
                                        }),
                                ]),
                                TextInput::make('description')
                                    ->label(FormHelper::localizedLabel(__('filament.fields.description')))
                                    ->maxLength(255),
                            ]),

                        Section::make(__('filament.sections.images'))
                            ->schema([
                                MediaPicker::make('image')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('collections')
                                    ->acceptedFileTypes(['image/*']),
                            ]),
                    ]),

                    // Sidebar (right, 1/3)
                    Grid::make(1)->columnSpan(1)->schema([
                        Section::make(__('filament.sections.organization'))
                            ->schema([
                                Select::make('status')
                                    ->label(__('filament.fields.status'))
                                    ->options(CollectionStatus::class)
                                    ->default(CollectionStatus::Active),
                            ]),
                    ]),
                ]),
            ]);
    }
}
