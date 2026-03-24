<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\ContentStatus;
use App\Enums\PageType;
use App\Filament\Forms\Components\MediaPicker;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\TwoColumnBlock;
use App\Helpers\Filament\FormHelper;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageForm
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
                                        ->afterStateUpdated(function (Set $set, Get $get, $state, $record) {
                                            if (! $record || ($record && empty($get('slug')))) {
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
                                                Rule::unique('pages', "slug->$locale")
                                                    ->ignore($record?->id),
                                            ];
                                        }),
                                ]),
                                TextInput::make('description')
                                    ->label(FormHelper::localizedLabel(__('filament.fields.description')))
                                    ->maxLength(255),
                            ]),

                        Section::make(__('filament.sections.content'))
                            ->schema([
                                RichEditor::make('content')
                                    ->label(FormHelper::localizedLabel(__('filament.fields.content')))
                                    ->extraInputAttributes(['style' => 'min-height: 20rem;'])
                                    ->customBlocks([
                                        TwoColumnBlock::withFolderPath('pages'),
                                    ]),
                            ]),

                        Section::make(__('filament.sections.images'))
                            ->schema([
                                MediaPicker::make('image')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages')
                                    ->acceptedFileTypes(['image/*']),
                            ]),
                    ]),

                    // Sidebar (right, 1/3)
                    Grid::make(1)->columnSpan(1)->schema([
                        Section::make(__('filament.sections.organization'))
                            ->schema([
                                Select::make('status')
                                    ->label(__('filament.fields.status'))
                                    ->options(ContentStatus::class)
                                    ->default(ContentStatus::Published),
                                // Select::make('page_type')
                                //     ->label(__('filament.fields.page_type'))
                                //     ->options(
                                //         fn() => Collection::make(PageType::cases())
                                //             ->reject(fn(PageType $type) => $type === PageType::System)
                                //             ->mapWithKeys(fn(PageType $type) => [$type->value => $type->getLabel()])
                                //     )
                                //     ->default(PageType::Regular)
                                //     ->helperText(__('filament.helpers.page_type')),
                            ]),
                    ]),
                ]),
            ]);
    }
}
