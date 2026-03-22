<?php

namespace App\Filament\Resources\Menus\Schemas;

use App\Enums\CategoryStatus;
use App\Filament\Forms\Components\MenuBuilder;
use App\Models\Collection;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->columnSpanFull()->schema([
                    Grid::make(1)->columnSpan(2)->schema([
                        Section::make(__('filament.sections.basic'))
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('filament.fields.name'))
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, $state, $record) {
                                        if (! $record) {
                                            $set('slug', Str::slug($state));
                                        }
                                    }),
                                TextInput::make('slug')
                                    ->label(__('filament.fields.slug'))
                                    ->required()
                                    ->maxLength(255)
                                    ->rules(function ($record) {
                                        return [
                                            Rule::unique('menus', 'slug')->ignore($record?->id),
                                        ];
                                    })
                                    ->helperText(__('filament.helpers.menu_slug')),
                            ]),
                    ]),

                    Grid::make(1)->columnSpan(1)->schema([
                        Section::make(__('filament.sections.organization'))
                            ->schema([
                                Select::make('status')
                                    ->label(__('filament.fields.status'))
                                    ->options(CategoryStatus::class)
                                    ->default(CategoryStatus::Active)
                                    ->required(),
                            ]),
                    ]),
                ]),

                Section::make(__('filament.resources.menu_item.plural_label'))
                    ->columnSpanFull()
                    ->schema([
                        MenuBuilder::make('menu_items')
                            ->label(__('filament.resources.menu_item.plural_label'))
                            // ->withFixedLinks(
                            //     key: 'fixed_pages',
                            //     label: __('filament.menu_builder.fixed_pages'),
                            //     icon: 'heroicon-o-home',
                            //     links: [
                            //         ['title' => ['en' => 'Home', 'vi' => 'Trang chủ'], 'url' => '/'],
                            //         ['title' => ['en' => 'About', 'vi' => 'Về chúng tôi'], 'url' => '/about'],
                            //         ['title' => ['en' => 'Contact', 'vi' => 'Liên hệ'], 'url' => '/contact'],
                            //         ['title' => ['en' => 'Partners', 'vi' => 'Đối tác Tin cậy'], 'url' => '/partners'],
                            //         ['title' => ['en' => 'Shop', 'vi' => 'Sản phẩm'], 'url' => '/shop'],
                            //     ],
                            // )
                            ->withModel(
                                key: 'pages',
                                label: __('filament.resources.page.plural_label'),
                                modelClass: Page::class,
                                titleField: 'title',
                                urlResolver: fn(Page $record): string => '/pages/' . $record->slug,
                                icon: 'heroicon-o-document-text',
                            )
                            ->withModel(
                                key: 'collections',
                                label: __('filament.resources.collection.plural_label'),
                                modelClass: Collection::class,
                                titleField: 'title',
                                urlResolver: fn(Collection $record): string => '/shop?category=' . $record->slug,
                                icon: 'heroicon-o-squares-2x2',
                            )
                            ->withModel(
                                key: 'products',
                                label: __('filament.resources.product.plural_label'),
                                modelClass: Product::class,
                                titleField: 'name',
                                urlResolver: fn(Product $record): string => '/products/' . $record->slug,
                                icon: 'heroicon-o-shopping-bag',
                            ),
                    ]),
            ]);
    }
}
