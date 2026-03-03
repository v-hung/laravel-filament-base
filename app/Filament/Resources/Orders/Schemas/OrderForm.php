<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->columnSpanFull()->schema([
                    // Main content (left, 2/3)
                    Grid::make(1)->columnSpan(2)->schema([
                        Section::make(__('filament.sections.customer'))
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('code')
                                        ->label(__('filament.fields.code'))
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('name')
                                        ->label(__('filament.fields.name'))
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('phone')
                                        ->label(__('filament.fields.phone'))
                                        ->required()
                                        ->maxLength(20),
                                    TextInput::make('email')
                                        ->label(__('filament.fields.email'))
                                        ->email()
                                        ->maxLength(255),
                                ]),
                            ]),

                        Section::make(__('filament.sections.shipping'))
                            ->schema([
                                Grid::make(2)->schema([
                                    Select::make('province_id')
                                        ->label(__('filament.fields.province_id'))
                                        ->relationship('province', 'name')
                                        ->nullable(),
                                    Select::make('ward_id')
                                        ->label(__('filament.fields.ward_id'))
                                        ->relationship('ward', 'name')
                                        ->nullable(),
                                ]),
                                TextInput::make('address')
                                    ->label(__('filament.fields.address'))
                                    ->maxLength(255),
                                Textarea::make('note')
                                    ->label(__('filament.fields.note')),
                            ]),
                    ]),

                    // Sidebar (right, 1/3)
                    Grid::make(1)->columnSpan(1)->schema([
                        Section::make(__('filament.sections.organization'))
                            ->schema([
                                TextInput::make('total')
                                    ->label(__('filament.fields.total'))
                                    ->numeric('VND')
                                    ->default(0),
                                Select::make('status')
                                    ->label(__('filament.fields.status'))
                                    ->options(OrderStatus::class),
                                Select::make('payment_method')
                                    ->label(__('filament.fields.payment_method'))
                                    ->options(PaymentMethod::class),
                                Select::make('payment_status')
                                    ->label(__('filament.fields.payment_status'))
                                    ->options(PaymentStatus::class),
                            ]),
                    ]),
                ]),
            ]);
    }
}
