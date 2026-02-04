<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Filament\Resources\Pages\Pages\ViewPage;
use App\Filament\Resources\Pages\Schemas\PageForm;
use App\Filament\Resources\Pages\Schemas\PageInfolist;
use App\Filament\Resources\Pages\Tables\PagesTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class PageResource extends Resource
{
    // use Translatable;

    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BookOpen;

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('filament.navigation.content');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.page.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.page.plural_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.page.label');
    }

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return PageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'view' => ViewPage::route('/{record}'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }

    public static function getDefaultTranslatableLocale(): string
    {
        return app()->getLocale();
    }
}
