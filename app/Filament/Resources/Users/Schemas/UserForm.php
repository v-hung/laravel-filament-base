<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->columnSpanFull()->schema([
                    // Main content (left, 2/3)
                    Grid::make(1)->columnSpan(2)->schema([
                        Section::make(__('filament.sections.basic'))
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('name')
                                        ->label(__('filament.fields.name'))
                                        ->required(),
                                    TextInput::make('email')
                                        ->label(__('filament.fields.email'))
                                        ->email()
                                        ->required(),
                                    TextInput::make('password')
                                        ->label(__('filament.fields.password'))
                                        ->password()
                                        ->required(),
                                    DateTimePicker::make('email_verified_at')
                                        ->label(__('filament.fields.email_verified_at')),
                                ]),
                            ]),
                    ]),

                    // Sidebar (right, 1/3)
                    Grid::make(1)->columnSpan(1)->schema([
                        Section::make(__('filament.sections.permissions'))
                            ->schema([
                                Select::make('roles')
                                    ->label(__('filament.fields.roles'))
                                    ->relationship('roles', 'name')
                                    ->multiple()
                                    ->preload(),
                                Toggle::make('is_admin')
                                    ->label(__('filament.fields.is_admin'))
                                    ->required(),
                            ]),
                    ]),
                ]),
            ]);
    }
}
