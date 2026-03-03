<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Artisan;
use UnitEnum;

class SystemSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.base-settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ExclamationTriangle;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('filament.navigation.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.pages.system_settings.label');
    }

    public function getTitle(): string|Htmlable
    {
        return __('filament.pages.system_settings.label');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('save')
                    ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                    ->action('save'),
                Section::make(__('filament.sections.system_actions'))->description(__('filament.system_settings.description'))
                    ->schema([
                        Grid::make(2)->schema([

                            Action::make('Clear Cache')
                                ->tooltip(__('filament.system_settings.clear_cache_tooltip'))
                                ->action(function () {
                                    Artisan::call('optimize:clear');
                                    Notification::make()
                                        ->title(__('filament.system_settings.cache_cleared'))
                                        ->success()
                                        ->send();
                                }),

                        ]),
                    ]),
            ]);
    }
}
