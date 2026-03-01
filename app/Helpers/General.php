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

if (! function_exists('format_currency')) {
    function format_currency($amount, $currency = 'VND', $locale = 'vi_VN')
    {
        $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        return $fmt->formatCurrency($amount, $currency);
    }
}
