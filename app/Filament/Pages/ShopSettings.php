<?php

namespace App\Filament\Pages;

use App\Filament\Core\Pages\PageSettingsTranslatable;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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

    public array $translatableAttributes = [];

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->action('save'),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('save')
                    ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                    ->action('save'),
                TextInput::make('site_name')->label(__('filament.settings.fields.site_name')),
                FileUpload::make('site_logo')->disk('public')->directory('settings')->label(__('filament.settings.fields.site_logo')),
                TextInput::make('site_email')->label(__('filament.settings.fields.site_email')),
                TextInput::make('site_phone')->label(__('filament.settings.fields.site_phone')),
                TextInput::make('site_address')->label(__('filament.settings.fields.site_address')),
                Textarea::make('site_description')->label(__('filament.settings.fields.site_description')),
                TextArea::make('site_map')->label(__('filament.settings.fields.site_map')),
                KeyValue::make('bank_info')->label(__('filament.settings.fields.bank_info')),
            ])->statePath('data');
    }
}
