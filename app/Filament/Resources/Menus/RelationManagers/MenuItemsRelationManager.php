<?php

namespace App\Filament\Resources\Menus\RelationManagers;

use App\Models\MenuItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\RelationManagers\Concerns\Translatable;

class MenuItemsRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'items';

    public static function getTitle(\Illuminate\Database\Eloquent\Model $ownerRecord, string $pageClass): string
    {
        return __('filament.resources.menu_item.plural_label');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->columnSpanFull()->schema([
                TextInput::make('title')
                    ->label(__('filament.fields.title'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                TextInput::make('url')
                    ->label(__('filament.fields.url'))
                    ->maxLength(500)
                    ->placeholder('https://...')
                    ->columnSpan(2),
                Select::make('target')
                    ->label(__('filament.fields.menu_target'))
                    ->options([
                        '_self' => __('filament.options.menu_target_self'),
                        '_blank' => __('filament.options.menu_target_blank'),
                    ])
                    ->default('_self')
                    ->required(),
                TextInput::make('icon')
                    ->label(__('filament.fields.icon'))
                    ->maxLength(100)
                    ->placeholder('heroicon-o-home'),
                Select::make('parent_id')
                    ->label(__('filament.fields.menu_parent'))
                    ->options(function (RelationManager $livewire) {
                        return MenuItem::query()
                            ->where('menu_id', $livewire->getOwnerRecord()->id)
                            ->whereNull('parent_id')
                            ->pluck('title', 'id');
                    })
                    ->searchable()
                    ->nullable()
                    ->placeholder(__('filament.placeholders.no_parent')),
                Toggle::make('is_active')
                    ->label(__('filament.fields.is_active'))
                    ->default(true),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament.fields.title'))
                    ->formatStateUsing(function (MenuItem $record): string {
                        $prefix = $record->parent_id ? '└── ' : '';

                        $locale = app()->getLocale();
                        $title = $record[$locale];

                        return $prefix.$title;
                    })
                    ->searchable(),
                TextColumn::make('parent.title')
                    ->label(__('filament.fields.menu_parent'))
                    ->placeholder('—')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('url')
                    ->label(__('filament.fields.url'))
                    ->limit(40)
                    ->placeholder('—'),
                TextColumn::make('target')
                    ->label(__('filament.fields.menu_target'))
                    ->badge()
                    ->color(fn (string $state): string => $state === '_blank' ? 'info' : 'gray')
                    ->formatStateUsing(fn (string $state): string => $state === '_blank'
                        ? __('filament.options.menu_target_blank')
                        : __('filament.options.menu_target_self')),
                IconColumn::make('is_active')
                    ->label(__('filament.fields.is_active'))
                    ->boolean(),
            ])
            ->headerActions([
                LocaleSwitcher::make(),
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->with('parent'));
    }
}
