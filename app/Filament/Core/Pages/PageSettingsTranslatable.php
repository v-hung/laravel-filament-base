<?php

namespace App\Filament\Core\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use UnitEnum;

class PageSettingsTranslatable extends Page implements HasForms
{
    use HasPageTranslatable, InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.base-settings';

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('filament.navigation.settings');
    }

    public function getTranslatableLocales(): array
    {
        return ['en', 'vi'];
    }

    protected function getHeaderActions(): array
    {
        return [
            PageLocaleSwitcher::make(),
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->action('save'),
        ];
    }
}
