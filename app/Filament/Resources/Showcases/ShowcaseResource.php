<?php

namespace App\Filament\Resources\Showcases;

use App\Filament\Resources\Showcases\Pages\CreateShowcase;
use App\Filament\Resources\Showcases\Pages\EditShowcase;
use App\Filament\Resources\Showcases\Pages\ListShowcases;
use App\Filament\Resources\Showcases\Schemas\ShowcaseForm;
use App\Filament\Resources\Showcases\Tables\ShowcasesTable;
use App\Models\Showcase;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ShowcaseResource extends Resource
{
    protected static ?string $model = Showcase::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CircleStack;

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('filament.navigation.content');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.showcase.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.showcase.plural_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.showcase.label');
    }

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return ShowcaseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShowcasesTable::configure($table);
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
            'index' => ListShowcases::route('/'),
            'create' => CreateShowcase::route('/create'),
            'edit' => EditShowcase::route('/{record}/edit'),
        ];
    }
}
