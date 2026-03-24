<?php

namespace App\Helpers\Filament;

class FormHelper
{
    private static array $displayNameCache = [];

    public static function localizedLabel(string $label): LocalizedLabel
    {
        $displayLocale = app()->getLocale();

        return new LocalizedLabel($label, $displayLocale);
    }
}

class LocalizedLabel
{
    private static array $displayNameCache = [];

    public function __construct(
        private readonly string $label,
        private readonly string $displayLocale,
    ) {}

    public function __invoke(mixed $livewire): string
    {
        $activeLocale = $livewire->activeLocale;
        $cacheKey = $activeLocale.'_'.$this->displayLocale;

        if (! isset(self::$displayNameCache[$cacheKey])) {
            self::$displayNameCache[$cacheKey] = locale_get_display_name($activeLocale, $this->displayLocale);
        }

        return $this->label.' ('.self::$displayNameCache[$cacheKey].')';
    }

    public function __toString(): string
    {
        return $this->label;
    }
}
