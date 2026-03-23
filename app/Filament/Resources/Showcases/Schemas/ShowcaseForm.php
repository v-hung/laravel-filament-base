<?php

namespace App\Filament\Resources\Showcases\Schemas;

use App\Enums\ShowcaseType;
use App\Enums\Status;
use App\Filament\Forms\Components\MediaPicker;
use App\Helpers\Filament\FormHelper;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ShowcaseForm
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
                                    Select::make('type')
                                        ->label(__('filament.fields.type'))
                                        ->options(ShowcaseType::class)
                                        ->required(),
                                    TextInput::make('title')
                                        ->label(FormHelper::localizedLabel(__('filament.fields.title')))
                                        ->maxLength(255)
                                        ->required(),
                                ]),
                                TextInput::make('description')
                                    ->label(FormHelper::localizedLabel(__('filament.fields.description')))
                                    ->maxLength(255),
                            ]),

                        Section::make(__('filament.sections.content'))
                            ->schema([
                                RichEditor::make('content')
                                    ->label(__('filament.fields.content'))
                                    ->extraInputAttributes(['style' => 'min-height: 20rem;']),
                            ]),

                        Section::make(__('filament.sections.images'))
                            ->schema([
                                MediaPicker::make('image')
                                    ->label(__('filament.fields.image'))
                                    ->folderPath('showcases')
                                    ->acceptedFileTypes(['image/*']),
                            ]),
                    ]),

                    // Sidebar (right, 1/3)
                    Grid::make(1)->columnSpan(1)->schema([
                        Section::make(__('filament.sections.organization'))
                            ->schema([
                                TextInput::make('link')
                                    ->label(__('filament.fields.link'))
                                    ->maxLength(255),
                                TextInput::make('order')
                                    ->label(__('filament.fields.order'))
                                    ->numeric()
                                    ->default(0),
                                Select::make('status')
                                    ->label(__('filament.fields.status'))
                                    ->options(Status::class)
                                    ->default(Status::Active),
                            ]),
                    ]),
                ]),
            ]);
    }
}
