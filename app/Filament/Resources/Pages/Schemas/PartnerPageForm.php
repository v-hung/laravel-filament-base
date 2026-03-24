<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\ContentStatus;
use App\Filament\Forms\Components\MediaPickerInline;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->columnSpanFull()->schema([
                // Main content (left, 2/3)
                Grid::make(1)->columnSpan(2)->schema([
                    Section::make(__('filament.pages.partner.sections.hero'))
                        ->statePath('sections.hero')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.banner_image'))
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(3),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.partner.sections.innovation'))
                        ->statePath('sections.innovation')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.partner.sections.stats'))
                        ->statePath('sections.stats')
                        ->schema([
                            Repeater::make('items')
                                ->label(__('filament.pages.partner.repeaters.stats'))
                                ->table([
                                    TableColumn::make(__('filament.pages.partner.fields.stat_value')),
                                    TableColumn::make(__('filament.pages.partner.fields.stat_unit')),
                                    TableColumn::make(__('filament.pages.partner.fields.stat_label')),
                                ])
                                ->schema([
                                    TextInput::make('value')->label(__('filament.pages.partner.fields.stat_value'))->maxLength(50),
                                    TextInput::make('unit')->label(__('filament.pages.partner.fields.stat_unit'))->maxLength(50),
                                    TextInput::make('label')->label(__('filament.pages.partner.fields.stat_label'))->maxLength(255),
                                ])
                                ->maxItems(4)
                                ->addActionLabel(__('filament.pages.partner.actions.add_stat'))
                                ->columnSpanFull(),
                        ]),

                    Section::make(__('filament.pages.partner.sections.direction'))
                        ->statePath('sections.direction')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.partner.sections.core_values'))
                        ->statePath('sections.core_values')
                        ->schema([
                            TextInput::make('title')->label(__('filament.pages.partner.fields.section_title'))->maxLength(255),
                            Repeater::make('values')
                                ->label(__('filament.pages.partner.repeaters.core_values'))
                                ->table([
                                    TableColumn::make(__('filament.fields.icon'))->width('40%'),
                                    TableColumn::make(__('filament.fields.content')),
                                ])
                                ->schema([
                                    MediaPickerInline::make('image_id')
                                        ->label(__('filament.pages.partner.fields.icon_image'))
                                        ->folderPath('pages/partner/icons')
                                        ->compact()
                                        ->acceptedFileTypes(['image/*']),
                                    Grid::make(1)->schema([
                                        TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                        Textarea::make('description')->label(__('filament.fields.description'))->rows(2),
                                    ]),
                                ])
                                ->maxItems(4)
                                ->addActionLabel(__('filament.pages.partner.actions.add_value'))
                                ->columnSpanFull(),
                        ]),

                    Section::make(__('filament.pages.partner.sections.design'))
                        ->statePath('sections.design')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.partner.sections.improvement'))
                        ->statePath('sections.improvement')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.partner.sections.materials'))
                        ->statePath('sections.materials')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.partner.sections.process'))
                        ->statePath('sections.process')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                            Repeater::make('features')
                                ->label(__('filament.pages.partner.repeaters.process_features'))
                                ->table([
                                    TableColumn::make(__('filament.fields.icon'))->width('40%'),
                                    TableColumn::make(__('filament.pages.partner.fields.feature_name')),
                                ])
                                ->schema([
                                    MediaPickerInline::make('image_id')
                                        ->label(__('filament.pages.partner.fields.icon_image'))
                                        ->folderPath('pages/partner/icons')
                                        ->compact()
                                        ->acceptedFileTypes(['image/*']),
                                    TextInput::make('title')->label(__('filament.pages.partner.fields.feature_name'))->maxLength(255),
                                ])
                                ->addActionLabel(__('filament.pages.partner.actions.add_feature'))
                                ->columnSpanFull(),
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
