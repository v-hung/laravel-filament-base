<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label(__('filament.forms.fields.name')),
                TextEntry::make('slug')->label(__('filament.forms.fields.slug'))
                    ->copyable()
                    ->copyMessage('Copied!')
                    ->copyMessageDuration(1500),
                TextEntry::make('description')->label(__('filament.forms.fields.description'))->columnSpanFull(),
                TextEntry::make('content')
                    ->label(__('filament.forms.fields.content'))
                    ->columnSpanFull()->html(),
                ImageEntry::make('images')->label(__('filament.forms.fields.images')),
                TextEntry::make('price')
                    ->label(__('filament.forms.fields.price'))
                    ->money('VND'),
                TextEntry::make('compare_at_price')
                    ->label(__('filament.forms.fields.compare_at_price'))
                    ->money('VND'),
                TextEntry::make('stock_quantity')
                    ->label(__('filament.forms.fields.stock_quantity'))
                    ->numeric(),
                TextEntry::make('status')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
