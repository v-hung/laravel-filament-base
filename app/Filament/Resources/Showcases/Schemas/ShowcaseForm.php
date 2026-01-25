<?php

namespace App\Filament\Resources\Showcases\Schemas;

use App\Enums\ShowcaseType;
use App\Enums\Status;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ShowcaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label(__('filament.forms.fields.type'))
                    ->options(ShowcaseType::class)
                    ->required(),
                TextInput::make('title')
                    ->label(__('filament.forms.fields.title'))
                    ->maxLength(255)
                    ->required(),
                TextInput::make('description')
                    ->label(__('filament.forms.fields.description'))
                    ->maxLength(255)->columnSpan('full'),
                RichEditor::make('content')
                    ->label(__('filament.forms.fields.content'))
                    ->columnSpan('full')
                    ->extraInputAttributes(['style' => 'min-height: 20rem;']),
                FileUpload::make('image')
                    ->label(__('filament.forms.fields.image'))
                    ->disk('public')
                    ->directory('showcases'),
                TextInput::make('link')
                    ->label(__('filament.forms.fields.link'))
                    ->maxLength(255),
                TextInput::make('order')
                    ->label(__('filament.forms.fields.order'))
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->label(__('filament.forms.fields.status'))
                    ->options(Status::class)->default(Status::Active),
            ]);
    }
}
