<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Infolists\Entries\MediaImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label(__('filament.fields.name')),
                TextEntry::make('slug')->label(__('filament.fields.slug'))
                    ->copyable()
                    ->copyMessage('Copied!')
                    ->copyMessageDuration(1500),
                TextEntry::make('description')->label(__('filament.fields.description'))->columnSpanFull(),
                TextEntry::make('content')
                    ->label(__('filament.fields.content'))
                    ->columnSpanFull()->html(),
                MediaImageEntry::make('images')->label(__('filament.fields.images')),
                TextEntry::make('price')
                    ->label(__('filament.fields.price'))
                    ->money('VND'),
                TextEntry::make('compare_at_price')
                    ->label(__('filament.fields.compare_at_price'))
                    ->money('VND'),
                TextEntry::make('stock_quantity')
                    ->label(__('filament.fields.stock_quantity'))
                    ->numeric(),
                TextEntry::make('status')->label(__('filament.fields.status'))->badge(),
                TextEntry::make('created_at')->label(__('filament.fields.created_at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')->label(__('filament.fields.updated_at'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
