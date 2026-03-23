<?php

namespace App\Filament\Actions;

use App\Services\GeminiTranslationService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class AutoTranslateAction extends Action
{
    /**
     * Fields containing HTML — tags will be preserved during translation.
     *
     * @var array<string>
     */
    protected array $htmlFields = ['content'];

    /**
     * Fields whose value is auto-generated from a translated "name" field
     * (i.e. slug) rather than sent to the translation API.
     *
     * @var array<string>
     */
    protected array $slugFields = ['slug'];

    /**
     * Fields that are key-value JSON objects — keys kept, values translated.
     *
     * @var array<string>
     */
    protected array $jsonFields = ['specifications'];

    public static function getDefaultName(): ?string
    {
        return 'autoTranslate';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label(__('filament.actions.auto_translate'))
            ->icon(Heroicon::Language)
            ->color('info')
            ->requiresConfirmation()
            ->modalHeading(__('filament.actions.auto_translate'))
            ->modalDescription(function ($livewire): string {
                $uiLocale = app()->getLocale();
                $localeName = fn (string $locale): string => \Locale::getDisplayLanguage($locale, $uiLocale) ?: strtoupper($locale);

                $sourceLocale = $livewire->activeLocale;
                $targetLocales = array_values(array_filter(
                    $livewire->getTranslatableLocales(),
                    fn ($locale) => $locale !== $sourceLocale
                ));

                $sourceName = $localeName($sourceLocale);
                $targetNames = implode(', ', array_map($localeName, $targetLocales));

                return __('filament.actions.auto_translate_description_dynamic', [
                    'source' => $sourceName,
                    'targets' => $targetNames,
                ]);
            })
            ->modalSubmitActionLabel(__('filament.actions.auto_translate_confirm'))
            ->action(function ($livewire, GeminiTranslationService $service): void {
                $translatableAttributes = $livewire::getResource()::getTranslatableAttributes();
                $sourceLocale = $livewire->activeLocale;
                $targetLocales = array_values(array_filter(
                    $livewire->getTranslatableLocales(),
                    fn ($locale) => $locale !== $sourceLocale
                ));

                if (empty($targetLocales)) {
                    Notification::make()
                        ->warning()
                        ->title(__('filament.actions.auto_translate_no_targets'))
                        ->send();

                    return;
                }

                // Get translatable fields from current form state
                $currentState = $livewire->form->getState();
                $fieldsToTranslate = Arr::only($currentState, $translatableAttributes);

                try {
                    $translations = $service->translate(
                        fields: $fieldsToTranslate,
                        sourceLocale: $sourceLocale,
                        targetLocales: $targetLocales,
                        htmlFields: $this->htmlFields,
                        slugFields: $this->slugFields,
                        jsonFields: $this->jsonFields,
                    );
                } catch (\Throwable $e) {
                    Log::error('AutoTranslateAction failed', ['error' => $e->getMessage()]);

                    Notification::make()
                        ->danger()
                        ->title(__('filament.actions.auto_translate_failed'))
                        ->send();

                    return;
                }

                if (empty($translations)) {
                    Notification::make()
                        ->danger()
                        ->title(__('filament.actions.auto_translate_failed'))
                        ->send();

                    return;
                }

                // Post-process slugs: skip if locale already has one, ensure uniqueness
                $record = $livewire->record ?? null;
                foreach ($translations as $locale => &$localeData) {
                    foreach ($this->slugFields as $slugField) {
                        if (! isset($localeData[$slugField])) {
                            continue;
                        }

                        $existingSlug = $livewire->otherLocaleData[$locale][$slugField] ?? null;

                        if (! empty($existingSlug)) {
                            unset($localeData[$slugField]);

                            continue;
                        }

                        $localeData[$slugField] = $this->makeSlugUnique($localeData[$slugField], $locale, $record, $slugField);
                    }
                }
                unset($localeData);

                foreach ($translations as $locale => $localeData) {
                    $livewire->otherLocaleData[$locale] = array_merge(
                        $livewire->otherLocaleData[$locale] ?? [],
                        Arr::only($localeData, $translatableAttributes)
                    );
                }

                Notification::make()
                    ->success()
                    ->title(__('filament.actions.auto_translate_success'))
                    ->send();
            });
    }

    private function makeSlugUnique(string $slug, string $locale, mixed $record, string $field = 'slug'): string
    {
        if (! $record) {
            return $slug;
        }

        $modelClass = get_class($record);
        $baseSlug = $slug;
        $counter = 2;

        while (true) {
            $query = $modelClass::query()->where("{$field}->{$locale}", $slug);

            if ($record->exists) {
                $query->where($record->getKeyName(), '!=', $record->getKey());
            }

            if (! $query->exists()) {
                break;
            }

            $slug = $baseSlug.'-'.$counter++;
        }

        return $slug;
    }

    /**
     * @param  array<string>  $fields
     */
    public function htmlFields(array $fields): static
    {
        $this->htmlFields = $fields;

        return $this;
    }

    /**
     * @param  array<string>  $fields
     */
    public function slugFields(array $fields): static
    {
        $this->slugFields = $fields;

        return $this;
    }

    /**
     * @param  array<string>  $fields
     */
    public function jsonFields(array $fields): static
    {
        $this->jsonFields = $fields;

        return $this;
    }
}
