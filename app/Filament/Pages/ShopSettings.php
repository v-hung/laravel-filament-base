<?php

namespace App\Filament\Pages;

use App\Filament\Core\Pages\PageSettingsTranslatable;
use App\Filament\Forms\Components\MediaPicker;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use UnitEnum;

class ShopSettings extends PageSettingsTranslatable
{
    public static string $GROUP_KEY = 'shop';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('filament.navigation.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.pages.shop_settings.label');
    }

    public function getTitle(): string|Htmlable
    {
        return __('filament.pages.shop_settings.label');
    }

    public array $translatableAttributes = ['faq', 'business_field', 'site_description', 'site_name', 'site_address', 'working_hours', 'tax_code', 'representative'];

    public array $imageAttributes = ['site_logo', 'gallery'];

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('save')
                    ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                    ->action('save'),

                Section::make(__('filament.sections.branding'))
                    // ->columns(2)
                    ->schema([
                        Grid::make(2)->schema([
                            MediaPicker::make('site_logo')
                                ->label(__('filament.settings.fields.site_logo'))
                                ->dehydrated(true)
                                ->folderPath('settings')
                                ->acceptedFileTypes(['image/*']),
                            Grid::make(1)->schema([
                                TextInput::make('site_name')
                                    ->label(__('filament.settings.fields.site_name')),
                                Textarea::make('site_description')
                                    ->label(__('filament.settings.fields.site_description'))
                                    ->rows(3),
                            ]),
                        ]),

                    ]),

                Section::make(__('filament.sections.contact'))
                    ->columns(2)
                    ->schema([
                        TextInput::make('site_email')
                            ->label(__('filament.settings.fields.site_email')),
                        TextInput::make('site_phone')
                            ->label(__('filament.settings.fields.site_phone')),
                        TextInput::make('site_address')
                            ->label(__('filament.settings.fields.site_address'))
                            ->columnSpanFull(),
                    ]),
            ])->statePath('data');
    }
}
