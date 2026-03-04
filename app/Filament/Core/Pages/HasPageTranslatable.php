<?php

namespace App\Filament\Core\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Field;
use Filament\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * @property-read string $GROUP_KEY
 */
trait HasPageTranslatable
{
    public ?array $data = [];

    public string $activeLocale;

    public array $otherLocaleData = [];

    protected ?string $oldActiveLocale = null;

    public array $translatableAttributes = [];

    public array $imageAttributes = [];

    public function getGroupKey(): string
    {
        return strtolower(static::$GROUP_KEY);
    }

    public function getTranslatableLocales(): array
    {
        return [];
    }

    public function updatingActiveLocale(): void
    {
        $this->oldActiveLocale = $this->activeLocale;
    }

    public function updatedActiveLocale(): void
    {
        if (blank($this->oldActiveLocale)) {
            return;
        }

        $this->resetValidation();

        $this->otherLocaleData[$this->oldActiveLocale] = $this->data;

        $newLocaleData = $this->otherLocaleData[$this->activeLocale] ?? [];

        unset($this->otherLocaleData[$this->activeLocale]);

        $this->form->fill([
            ...Arr::except($this->data, $this->translatableAttributes),
            ...$newLocaleData,
        ]);
    }

    public function setActiveLocale(string $locale): void
    {
        $this->updatingActiveLocale();
        $this->activeLocale = $locale;
        $this->updatedActiveLocale();
    }

    public function mount(): void
    {
        $this->activeLocale ??= app()->getLocale();
        $settings = Setting::where('group', $this->getGroupKey())->get()->keyBy('key');

        $attributes = [];
        $fields = $this->getFlatFields($this->form->getComponents());

        foreach ($fields as $field) {
            $fieldName = $field->getName();
            $setting = $settings->get($fieldName);

            $attributes[$fieldName] = optional($setting)->getTranslation('value', $this->activeLocale)
                ?: collect(optional($setting)->getTranslations('value'))->first()
                ?: null;
        }

        // Pre-load translatable data for other locales so switching works correctly
        foreach ($this->getTranslatableLocales() as $locale) {
            if ($locale === $this->activeLocale) {
                continue;
            }

            $localeAttributes = [];

            foreach ($this->translatableAttributes as $attribute) {
                $setting = $settings->get($attribute);
                $localeAttributes[$attribute] = optional($setting)->getTranslation('value', $locale) ?: null;
            }

            $this->otherLocaleData[$locale] = $localeAttributes;
        }

        $this->form->fill($attributes);
    }

    public function save()
    {
        $this->validate();

        $locales = $this->getTranslatableLocales();
        $formData = $this->form->getState();

        $existingSettings = Setting::where('group', $this->getGroupKey())->get()->keyBy('key');

        foreach ($formData as $key => $value) {
            $setting = $existingSettings->get($key);
            $translations = $this->getAllLocaleTranslationsForKey($key, $locales, $setting?->getTranslations('value') ?? []);

            $type = in_array($key, $this->imageAttributes) ? 'image' : null;

            if ($setting) {
                $setting->updated_at = now();
                $setting->value = $translations;
                $setting->type = $type;
                $setting->save();
            } else {
                Setting::create([
                    'group' => $this->getGroupKey(),
                    'key' => $key,
                    'value' => $translations,
                    'type' => $type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Cache::forget('settings');

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }

    protected function getAllLocaleTranslationsForKey(string $key, array $locales, array $translations): array
    {
        if (! in_array($key, $this->translatableAttributes)) {
            $singleValue = $this->data[$key] ?? null;

            $result = [];
            foreach ($locales as $locale) {
                $result[$locale] = $singleValue;
            }

            return $result;
        }

        foreach ($locales as $locale) {
            $localeValue = $this->getLocaleValue($key, $locale);

            if (! is_null($localeValue)) {
                $translations[$locale] = $localeValue;
            }
        }

        return $translations;
    }

    /**
     * @param  array<\Filament\Schemas\Components\Component>  $components
     * @return array<Field>
     */
    protected function getFlatFields(array $components): array
    {
        $fields = [];

        foreach ($components as $component) {
            if ($component instanceof Field) {
                $fields[] = $component;
            } elseif (method_exists($component, 'getChildComponents')) {
                array_push($fields, ...$this->getFlatFields($component->getChildComponents()));
            }
        }

        return $fields;
    }

    protected function getLocaleValue(string $key, string $locale): mixed
    {
        return $locale === $this->activeLocale
            ? ($this->data[$key] ?? null)
            : ($this->otherLocaleData[$locale][$key] ?? null);
    }
}
