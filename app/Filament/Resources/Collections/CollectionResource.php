<?php

namespace App\Filament\Resources\Collections;

use App\Filament\Resources\Collections\Pages\CreateCollection;
use App\Filament\Resources\Collections\Pages\EditCollection;
use App\Filament\Resources\Collections\Pages\ListCollections;
use App\Filament\Resources\Collections\Schemas\CollectionForm;
use App\Filament\Resources\Collections\Schemas\CollectionInfolist;
use App\Filament\Resources\Collections\Tables\CollectionsTable;
use App\Models\Collection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class CollectionResource extends Resource
{
    use Translatable;

    protected static ?string $model = Collection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Squares2x2;

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('filament.navigation.shop');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.collection.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.collection.plural_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.collection.label');
    }

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return CollectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CollectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CollectionsTable::configure($table);
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
            'index' => ListCollections::route('/'),
            'create' => CreateCollection::route('/create'),
            'edit' => EditCollection::route('/{record}/edit'),
        ];
    }

    public static function getDefaultTranslatableLocale(): string
    {
        return app()->getLocale();
    }
}
