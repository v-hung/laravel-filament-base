<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\ContentStatus;
use App\Filament\Forms\Components\MediaPicker;
use App\Filament\Forms\Components\MediaPickerInline;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->columnSpanFull()->schema([
                // Main content (left, 2/3)
                Grid::make(1)->columnSpan(2)->schema([
                    Section::make(__('filament.pages.home.sections.banner'))
                        ->statePath('sections.banner')
                        ->schema([
                            MediaPickerInline::make('image_id')
                                ->label(__('filament.fields.banner_image'))
                                ->folderPath('pages/home')
                                ->acceptedFileTypes(['image/*', 'video/*']),
                        ]),

                    Section::make(__('filament.pages.home.sections.about'))
                        ->statePath('sections.about')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/home')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('label')->label(__('filament.pages.home.fields.section_label'))->maxLength(255),
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(3),
                                ]),
                            ]),
                            Repeater::make('features')
                                ->label(__('filament.pages.home.fields.highlights'))
                                ->table([
                                    TableColumn::make(__('filament.fields.image'))->width('40%'),
                                    TableColumn::make(__('filament.pages.home.fields.label')),
                                ])
                                ->schema([
                                    MediaPickerInline::make('image_id')
                                        ->label(__('filament.fields.image'))
                                        ->folderPath('pages/home/icons')
                                        ->compact()
                                        ->acceptedFileTypes(['image/*']),
                                    TextInput::make('label')->label(__('filament.pages.home.fields.label'))->maxLength(255),
                                ])
                                // ->columns(2)
                                ->maxItems(4)
                                ->addActionLabel(__('filament.pages.home.actions.add_item'))
                                ->columnSpanFull(),
                        ]),

                    Section::make(__('filament.pages.home.sections.featured'))
                        ->statePath('sections.featured')
                        ->schema([
                            TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                            Textarea::make('description')->label(__('filament.fields.description'))->rows(4),
                        ]),

                    Section::make(__('filament.pages.home.sections.banner2'))
                        ->statePath('sections.banner2')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.pages.home.fields.banner_photo'))
                                    ->folderPath('pages/home')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(3),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.home.sections.collections'))
                        ->statePath('sections.collections')
                        ->schema([
                            TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                            Textarea::make('description')->label(__('filament.fields.description'))->rows(4),
                        ]),

                    Section::make(__('filament.pages.home.sections.cta'))
                        ->statePath('sections.cta')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.pages.home.fields.background_photo'))
                                    ->folderPath('pages/home')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(3),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.home.sections.inspiration'))
                        ->statePath('sections.inspiration')
                        ->schema([
                            TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                            MediaPicker::make('image_ids')
                                ->label(__('filament.settings.fields.gallery'))
                                ->multiple()
                                ->maxFiles(8)
                                ->dehydrated(true)
                                ->folderPath('pages/home/gallery')
                                ->acceptedFileTypes(['image/*']),
                        ]),

                    Section::make(__('filament.pages.home.sections.post'))
                        ->statePath('sections.post')
                        ->schema([
                            TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                            Textarea::make('description')->label(__('filament.fields.description'))->rows(4),
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
