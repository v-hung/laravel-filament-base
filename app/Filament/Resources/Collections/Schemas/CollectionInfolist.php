<?php

namespace App\Filament\Resources\Collections\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CollectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')->label(__('filament.forms.fields.title')),
                TextEntry::make('slug')
                    ->label(__('filament.forms.fields.slug'))
                    ->copyable()
                    ->copyMessage('Copied!')
                    ->copyMessageDuration(1500),
                TextEntry::make('description')->label(__('filament.forms.fields.description'))->columnSpanFull(),
                TextEntry::make('status')
                    ->label(__('filament.forms.fields.status'))
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label(__('filament.tables.columns.created_at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label(__('filament.tables.columns.updated_at'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
