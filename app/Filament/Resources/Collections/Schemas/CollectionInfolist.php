<?php

namespace App\Filament\Resources\Collections\Schemas;

use App\Filament\Infolists\Entries\MediaImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CollectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')->label(__('filament.fields.title')),
                TextEntry::make('slug')
                    ->label(__('filament.fields.slug'))
                    ->copyable()
                    ->copyMessage('Copied!')
                    ->copyMessageDuration(1500),
                TextEntry::make('description')->label(__('filament.fields.description'))->columnSpanFull(),
                MediaImageEntry::make('image')->label(__('filament.fields.image')),
                TextEntry::make('status')
                    ->label(__('filament.fields.status'))
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label(__('filament.fields.created_at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label(__('filament.fields.updated_at'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
