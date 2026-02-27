<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.fields.name'))
                    ->required(),
                TextInput::make('email')
                    ->label(__('filament.fields.email'))
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at')
                    ->label(__('filament.fields.email_verified_at')),
                TextInput::make('password')
                    ->label(__('filament.fields.password'))
                    ->password()
                    ->required(),
                Select::make('roles')
                    ->label(__('filament.fields.roles'))
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload(),
                Toggle::make('is_admin')
                    ->label(__('filament.fields.is_admin'))
                    ->required(),
            ]);
    }
}
