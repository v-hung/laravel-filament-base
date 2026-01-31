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
                    ->label(__('filament.forms.fields.name'))
                    ->required(),
                TextInput::make('email')
                    ->label(__('filament.forms.fields.email'))
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at')
                    ->label(__('filament.forms.fields.email_verified_at')),
                TextInput::make('password')
                    ->label(__('filament.forms.fields.password'))
                    ->password()
                    ->required(),
                Select::make('roles')
                    ->label(__('filament.forms.fields.roles'))
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload(),
                Toggle::make('is_admin')
                    ->label(__('filament.forms.fields.is_admin'))
                    ->required(),
            ]);
    }
}
