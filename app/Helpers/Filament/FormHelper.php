<?php

namespace App\Helpers\Filament;

class FormHelper
{
    private static array $displayNameCache = [];

    public static function localizedLabel(string $label): \Closure
    {
        $displayLocale = app()->getLocale();

        return function ($livewire) use ($label, $displayLocale) {
            $activeLocale = $livewire->activeLocale;
            $cacheKey = $activeLocale.'_'.$displayLocale;

            if (! isset(self::$displayNameCache[$cacheKey])) {
                self::$displayNameCache[$cacheKey] = locale_get_display_name($activeLocale, $displayLocale);
            }

            return $label.' ('.self::$displayNameCache[$cacheKey].')';
        };
    }
}
