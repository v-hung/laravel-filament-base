<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\ContentStatus;
use App\Filament\Forms\Components\MediaPickerInline;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->columnSpanFull()->schema([
                // Main content (left, 2/3)
                Grid::make(1)->columnSpan(2)->schema([
                    Section::make(__('filament.pages.contact.sections.hero'))
                        ->statePath('sections.hero')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.banner_image'))
                                    ->folderPath('pages/contact')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label(__('filament.fields.title'))->maxLength(255),
                                    Textarea::make('description')->label(__('filament.fields.description'))->rows(3),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.contact.sections.info'))
                        ->statePath('sections.info')
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('address')
                                    ->label(__('filament.pages.contact.fields.address'))
                                    ->maxLength(500),
                                TextInput::make('tax_code')
                                    ->label(__('filament.pages.contact.fields.tax_code'))
                                    ->maxLength(255),
                                TextInput::make('representative')
                                    ->label(__('filament.pages.contact.fields.representative'))
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->label(__('filament.pages.contact.fields.phone'))
                                    ->maxLength(255),
                                TextInput::make('business_field')
                                    ->label(__('filament.pages.contact.fields.business_field'))
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label(__('filament.pages.contact.fields.email'))
                                    ->email()
                                    ->maxLength(255),
                            ]),
                        ]),

                    Section::make(__('filament.pages.contact.sections.working_hours'))
                        ->statePath('sections.working_hours')
                        ->schema([
                            KeyValue::make('working_hours')
                                ->label(__('filament.pages.contact.repeaters.working_hours'))
                                ->keyLabel(__('filament.pages.contact.fields.working_day'))
                                ->valueLabel(__('filament.pages.contact.fields.working_hours_value'))
                                ->columnSpanFull(),
                        ]),

                    Section::make(__('filament.pages.contact.sections.map'))
                        ->statePath('sections.map')
                        ->schema([
                            Textarea::make('embed')
                                ->label(__('filament.pages.contact.fields.map_embed'))
                                ->rows(3)
                                ->helperText(__('filament.pages.contact.helpers.map_embed')),
                        ]),

                    Section::make(__('filament.pages.contact.sections.faq'))
                        ->statePath('sections.faq')
                        ->schema([
                            TextInput::make('title')
                                ->label(__('filament.fields.title'))
                                ->maxLength(255),
                            Textarea::make('description')
                                ->label(__('filament.fields.description'))
                                ->rows(3),
                            KeyValue::make('faq')
                                ->label(__('filament.pages.contact.repeaters.faq'))
                                ->keyLabel(__('filament.pages.contact.fields.faq_question'))
                                ->valueLabel(__('filament.pages.contact.fields.faq_answer')),
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
                        ]),
                ]),
            ]),
        ]);
    }
}
