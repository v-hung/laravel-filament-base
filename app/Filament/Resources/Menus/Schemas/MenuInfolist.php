<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MenuInfolist
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
