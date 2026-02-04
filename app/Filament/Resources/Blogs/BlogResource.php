<?php

namespace App\Filament\Resources\Blogs;

use App\Filament\Resources\Blogs\Pages\CreateBlog;
use App\Filament\Resources\Blogs\Pages\EditBlog;
use App\Filament\Resources\Blogs\Pages\ListBlogs;
use App\Filament\Resources\Blogs\Schemas\BlogForm;
use App\Filament\Resources\Blogs\Tables\BlogsTable;
use App\Models\Blog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class BlogResource extends Resource
{
    use Translatable;

    protected static ?string $model = Blog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PencilSquare;

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('filament.navigation.content');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.blog.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.blog.plural_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.blog.label');
    }

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return BlogForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogsTable::configure($table);
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
            'index' => ListBlogs::route('/'),
            'create' => CreateBlog::route('/create'),
            'edit' => EditBlog::route('/{record}/edit'),
        ];
    }

    public static function getDefaultTranslatableLocale(): string
    {
        return app()->getLocale();
    }
}
