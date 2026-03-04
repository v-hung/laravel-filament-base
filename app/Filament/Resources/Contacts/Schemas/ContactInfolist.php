<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContactInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('filament.fields.name')),
                TextEntry::make('email')
                    ->label(__('filament.fields.email_address')),
                TextEntry::make('read_at')
                    ->label(__('filament.fields.contact_read_status'))
                    ->dateTime('d/m/Y H:i')
                    ->placeholder(__('filament.fields.contact_unread')),
                TextEntry::make('created_at')
                    ->label(__('filament.fields.created_at'))
                    ->dateTime('d/m/Y H:i'),
                TextEntry::make('content')
                    ->label(__('filament.fields.contact_message'))
                    ->columnSpanFull(),
            ]);
    }
}
