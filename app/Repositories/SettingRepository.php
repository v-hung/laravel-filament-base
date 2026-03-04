<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    public function getAll(): array
    {
        $locale = app()->getLocale();

        return cache()->remember('settings', now()->addMinutes(60), function () use ($locale) {
            $all = Setting::get();

            $values = $all->mapWithKeys(function ($setting) use ($locale) {
                $key = strtolower($setting->group.'.'.$setting->key);
                $value = $setting->getTranslation('value', $locale)
                    ?: collect(optional($setting)->getTranslations('value'))->first()
                    ?: null;

                return [$key => $value];
            })->toArray();

            $values['__types'] = $all->whereNotNull('type')
                ->mapWithKeys(fn ($s) => [strtolower($s->group.'.'.$s->key) => $s->type])
                ->toArray();

            return $values;
        });
    }
}
