<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

class MediaManager extends Page
{
    protected string $view = 'filament.pages.media-manager';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?int $navigationSort = 0;

    public static function getNavigationLabel(): string
    {
        return __('filament.pages.media_manager.label');
    }

    public function getTitle(): string|Htmlable
    {
        return __('filament.pages.media_manager.label');
    }
}
