<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\ContentStatus;
use App\Filament\Forms\Components\MediaPickerInline;
use App\Models\Collection;
use App\Repositories\CollectionRepository;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ShopPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->columnSpanFull()->schema([
                // Main content (left, 2/3)
                Grid::make(1)->columnSpan(2)->schema([
                    Section::make(__('filament.pages.shop.sections.hero'))
                        ->statePath('sections.hero')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label(__('filament.fields.banner_image'))
                                    ->folderPath('pages/shop')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')
                                        ->label(__('filament.fields.title'))
                                        ->maxLength(255),
                                ]),
                            ]),
                        ]),

                    Section::make(__('filament.pages.shop.sections.banners'))
                        ->statePath('sections.banners')
                        ->schema([
                            Grid::make(2)->schema([
                                Fieldset::make(__('filament.pages.shop.sections.banner_1'))
                                    ->statePath('0')
                                    ->schema([
                                        MediaPickerInline::make('image_id')
                                            ->label(__('filament.fields.image'))
                                            ->folderPath('pages/shop')
                                            ->acceptedFileTypes(['image/*'])
                                            ->columnSpanFull(),
                                        TextInput::make('title')
                                            ->label(__('filament.fields.title'))
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        Textarea::make('description')
                                            ->label(__('filament.fields.description'))
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Select::make('collection_id')
                                            ->label(__('filament.pages.shop.fields.collection'))
                                            ->options(
                                                fn() => app(CollectionRepository::class)
                                                    ->getAll()
                                                    ->mapWithKeys(fn(Collection $collection) => [
                                                        $collection->id => $collection->title,
                                                    ])
                                            )
                                            ->searchable()
                                            ->nullable()
                                            ->columnSpanFull(),
                                    ]),
                                Fieldset::make(__('filament.pages.shop.sections.banner_2'))
                                    ->statePath('1')
                                    ->schema([
                                        MediaPickerInline::make('image_id')
                                            ->label(__('filament.fields.image'))
                                            ->folderPath('pages/shop')
                                            ->acceptedFileTypes(['image/*'])
                                            ->columnSpanFull(),
                                        TextInput::make('title')
                                            ->label(__('filament.fields.title'))
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        Textarea::make('description')
                                            ->label(__('filament.fields.description'))
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Select::make('collection_id')
                                            ->label(__('filament.pages.shop.fields.collection'))
                                            ->options(
                                                fn() => app(CollectionRepository::class)
                                                    ->getAll()
                                                    ->mapWithKeys(fn(Collection $collection) => [
                                                        $collection->id => $collection->title,
                                                    ])
                                            )
                                            ->searchable()
                                            ->nullable()
                                            ->columnSpanFull(),
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
                        ]),
                ]),
            ]),
        ]);
    }
}
