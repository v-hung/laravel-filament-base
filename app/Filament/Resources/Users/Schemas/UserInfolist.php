<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label(__('filament.fields.name')),
                TextEntry::make('email')
                    ->label(__('filament.fields.email')),
                TextEntry::make('email_verified_at')->label(__('filament.fields.email_verified_at'))
                    ->dateTime()
                    ->placeholder('-'),
                IconEntry::make('is_admin')->label(__('filament.fields.is_admin'))
                    ->boolean(),
                TextEntry::make('created_at')->label(__('filament.fields.created_at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')->label(__('filament.fields.updated_at'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
