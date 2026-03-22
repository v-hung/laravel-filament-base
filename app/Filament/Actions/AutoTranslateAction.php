<?php

namespace App\Filament\Actions;

use App\Services\GeminiTranslationService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Arr;

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
            ->modalDescription(__('filament.actions.auto_translate_description'))
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

                $translations = $service->translate(
                    fields: $fieldsToTranslate,
                    sourceLocale: $sourceLocale,
                    targetLocales: $targetLocales,
                    htmlFields: $this->htmlFields,
                    slugFields: $this->slugFields,
                );

                if (empty($translations)) {
                    Notification::make()
                        ->danger()
                        ->title(__('filament.actions.auto_translate_failed'))
                        ->send();

                    return;
                }

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
}
