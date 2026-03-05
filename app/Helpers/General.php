<?php

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

if (! function_exists('setting')) {
    function setting($key, $default = null): mixed
    {
        if (! app()->bound('settings')) {
            return $default ?? $key;
        }

        $settings = app('settings');
        $value = $settings[$key] ?? null;

        // Translations map: ['vi' => ..., 'en' => ...] — resolve by current locale
        if (is_array($value) && ! array_is_list($value)) {
            $locale = app()->getLocale();

            return $value[$locale] ?? collect($value)->first() ?? $default ?? $key;
        }

        return $value ?? $default ?? $key;
    }
}

if (! function_exists('setting_locales')) {
    function setting_locales($key, $default = null): mixed
    {
        if (! app()->bound('settings')) {
            return $default ?? $key;
        }

        $settings = app('settings');
        $value = $settings[$key] ?? null;

        return $value ?? $default ?? $key;
    }
}

if (! function_exists('resolve_media_setting')) {
    function resolve_media_setting(mixed $value): mixed
    {
        if (! $value) {
            return null;
        }

        if (is_array($value)) {
            return Media::whereIn('id', $value)
                ->get()
                ->map(fn(Media $media): array => $media->toMediaData())
                ->values()
                ->toArray();
        }

        $media = Media::find($value);

        return $media ? $media->toMediaData() : null;
    }
}

if (! function_exists('setting_image')) {
    function setting_image(string $key): mixed
    {
        return resolve_media_setting(setting($key));
    }
}

if (! function_exists('image_url')) {
    function image_url($image)
    {
        if (! $image) {
            return null;
        }

        if (is_array($image)) {
            // Nếu array có key-value kiểu uuid => path
            $image = reset($image); // lấy value đầu tiên
        }

        return Storage::url($image);
    }
}

if (! function_exists('settings_all')) {
    /**
     * Get all settings for a given group resolved to the current locale.
     * Returns short keys (without group prefix), e.g. 'site_name', 'site_logo'.
     */
    function settings_all(string $group): array
    {
        if (! app()->bound('settings')) {
            return [];
        }

        $settings = app('settings');
        $types = $settings['__types'] ?? [];
        $prefix = $group . '.';

        return collect($settings)
            ->filter(fn($value, $key) => str_starts_with($key, $prefix))
            ->keys()
            ->mapWithKeys(function ($key) use ($types, $prefix) {
                $shortKey = substr($key, strlen($prefix));

                if (($types[$key] ?? null) === 'image') {
                    return [$shortKey => setting_image($key)];
                }

                return [$shortKey => setting($key)];
            })
            ->toArray();
    }
}

if (! function_exists('settings_all_locales')) {
    /**
     * Get all settings for a given group with ALL locale translations included.
     * Useful for passing to the frontend for client-side language switching.
     * Returns short keys with locale-keyed values, e.g.:
     * ['site_name' => ['vi' => '...', 'en' => '...'], 'site_logo' => ['vi' => {...}, 'en' => {...}]]
     *
     * @return array<string, array<string, mixed>>
     */
    function settings_all_locales(string $group): array
    {
        if (! app()->bound('settings')) {
            return [];
        }

        $settings = app('settings');
        $types = $settings['__types'] ?? [];
        $prefix = $group . '.';

        return collect($settings)
            ->filter(fn($value, $key) => str_starts_with($key, $prefix))
            ->mapWithKeys(function ($value, $key) use ($types, $prefix) {
                $shortKey = substr($key, strlen($prefix));

                if (($types[$key] ?? null) === 'image') {
                    if (is_array($value) && ! array_is_list($value)) {
                        return [$shortKey => collect($value)
                            ->mapWithKeys(fn($localeValue, $locale) => [
                                $locale => resolve_media_setting($localeValue),
                            ])
                            ->toArray()];
                    }

                    return [$shortKey => resolve_media_setting($value)];
                }

                return [$shortKey => $value];
            })
            ->toArray();
    }
}

if (! function_exists('format_currency')) {
    function format_currency($amount, $currency = 'VND', $locale = 'vi_VN')
    {
        $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        return $fmt->formatCurrency($amount, $currency);
    }
}
