<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    public function getAll(): array
    {
        return cache()->remember('settings', now()->addMinutes(60), function () {
            $all = Setting::get();

            $values = $all->mapWithKeys(function ($setting) {
                $key = strtolower($setting->group.'.'.$setting->key);

                return [$key => $setting->getTranslations('value')];
            })->toArray();

            $values['__types'] = $all->whereNotNull('type')
                ->mapWithKeys(fn ($s) => [strtolower($s->group.'.'.$s->key) => $s->type])
                ->toArray();

            return $values;
        });
    }
}
