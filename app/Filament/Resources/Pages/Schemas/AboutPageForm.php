<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\ContentStatus;
use App\Filament\Forms\Components\MediaPickerInline;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->columnSpanFull()->schema([
                // Main content (left, 2/3)
                Grid::make(1)->columnSpan(2)->schema([
                    Section::make(__('filament.pages.about.sections.hero'))
                        ->statePath('sections.hero')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.banner_image'))
                                    ->folderPath('pages/about')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(3),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.about.sections.who_we_are'))
                        ->statePath('sections.who_we_are')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/about')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.about.sections.vision'))
                        ->statePath('sections.vision')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/about')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.about.sections.mission'))
                        ->statePath('sections.mission')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/about')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.about.sections.team'))
                        ->statePath('sections.team')
                        ->schema([
                            TextInput::make('title')->label(__('filament.pages.about.fields.section_title'))->maxLength(255),
                            Repeater::make('members')
                                ->label(__('filament.pages.about.repeaters.members'))
                                ->schema([
                                    Grid::make(2)->schema([
                                        MediaPickerInline::make('image_id')
                                            ->label(__('filament.fields.image'))
                                            ->folderPath('pages/about/team')
                                            ->acceptedFileTypes(['image/*']),
                                        Grid::make(1)->schema([
                                            TextInput::make('name')->label(__('filament.fields.name'))->maxLength(255),
                                            TextInput::make('role')->label(__('filament.pages.about.fields.member_role'))->maxLength(255),
                                        ]),
                                    ]),
                                    KeyValue::make('social_links')
                                        ->label(__('filament.pages.about.fields.social_links'))
                                        ->keyLabel(__('filament.pages.about.fields.social_label'))
                                        ->valueLabel(__('filament.pages.about.fields.social_url')),
                                ])
                                ->addActionLabel(__('filament.pages.about.actions.add_member'))
                                ->columnSpanFull(),
                        ]),

                    Section::make(__('filament.pages.about.sections.core_values'))
                        ->statePath('sections.core_values')
                        ->schema([
                            TextInput::make('title')->label(__('filament.pages.about.fields.section_title'))->maxLength(255),
                            Repeater::make('values')
                                ->label(__('filament.pages.about.repeaters.core_values'))
                                ->table([
                                    TableColumn::make(__('filament.fields.icon'))->width('40%'),
                                    TableColumn::make(__('filament.fields.content')),
                                ])
                                ->schema([
                                    MediaPickerInline::make('image_id')
                                        ->label(__('filament.pages.about.fields.icon_image'))
                                        ->folderPath('pages/about/icons')
                                        ->compact()
                                        ->acceptedFileTypes(['image/*']),
                                    Grid::make(1)->schema([
                                        TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                        Textarea::make('description')->label(__('filament.fields.description'))->rows(2),
                                    ]),
                                ])
                                ->maxItems(4)
                                ->addActionLabel(__('filament.pages.about.actions.add_value'))
                                ->columnSpanFull(),
                        ]),

                    Section::make(__('filament.pages.about.sections.development'))
                        ->statePath('sections.development')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('pages/about')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(5),
                                ]),
                            ]),
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
