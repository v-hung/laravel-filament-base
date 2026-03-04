<?php

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

if (! function_exists('setting')) {
    function setting($key, $default = null)
    {
        if (! app()->bound('settings')) {
            // Nếu service 'settings' chưa tồn tại, trả về giá trị mặc định
            return $default ?? $key;
        }

        $settings = app('settings');

        return $settings[$key] ?? $default ?? $key;
    }
}

if (! function_exists('setting_image')) {
    function setting_image(string $key): mixed
    {
        $value = setting($key);

        if (! $value) {
            return null;
        }

        if (is_array($value)) {
            return Media::whereIn('id', $value)
                ->get()
                ->map(fn (Media $media): array => $media->toMediaData())
                ->values()
                ->toArray();
        }

        $media = Media::find($value);

        return $media ? $media->toMediaData() : null;
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
     * Get all settings for a given group, resolving image types automatically.
     * Returns short keys (without group prefix), e.g. 'site_name', 'site_logo'.
     */
    function settings_all(string $group): array
    {
        if (! app()->bound('settings')) {
            return [];
        }

        $settings = app('settings');
        $types = $settings['__types'] ?? [];
        $prefix = $group.'.';

        return collect($settings)
            ->filter(fn ($value, $key) => str_starts_with($key, $prefix))
            ->mapWithKeys(function ($value, $key) use ($types, $prefix) {
                $shortKey = substr($key, strlen($prefix));

                if (($types[$key] ?? null) === 'image') {
                    return [$shortKey => setting_image($key)];
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
