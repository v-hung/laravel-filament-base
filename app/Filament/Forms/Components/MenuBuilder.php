<?php

namespace App\Filament\Forms\Components;

use App\Repositories\MenuItemRepository;
use Closure;
use Filament\Forms\Components\Field;

class MenuBuilder extends Field
{
    protected string $view = 'filament.forms.components.menu-builder';

    /** @var array<string, array<string, mixed>> */
    protected array $itemTypes = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->default([]);
        $this->dehydrated(false);

        $this->loadStateFromRelationshipsUsing(function (MenuBuilder $component, mixed $record): void {
            $locale = $component->getActiveLocale();
            $items = app(MenuItemRepository::class)->flatForBuilder($record, $locale);
            $component->state($items);
        });

        $this->saveRelationshipsUsing(function (MenuBuilder $component, mixed $record): void {
            $state = $component->getState() ?? [];
            $component->persistItems($state, $record);
        });
    }

    public function addItemType(string $key, array $config): static
    {
        $this->itemTypes[$key] = $config;

        return $this;
    }

    /**
     * Register a model-based item type (e.g. posts, pages).
     *
     * @param  callable(mixed $record): string  $urlResolver
     */
    public function withModel(
        string $key,
        string $label,
        string $modelClass,
        string $titleField = 'title',
        ?callable $urlResolver = null,
        string $icon = 'heroicon-o-document',
    ): static {
        $this->itemTypes[$key] = [
            'type' => 'model',
            'label' => $label,
            'icon' => $icon,
            'linkable_type' => $modelClass,
            'items_resolver' => function (string $locale) use ($modelClass, $titleField, $urlResolver): array {
                return $modelClass::query()
                    ->get()
                    ->map(function ($record) use ($titleField, $urlResolver, $locale) {
                        $rawTitle = $record->{$titleField};
                        $title = is_array($rawTitle)
                            ? ($rawTitle[$locale] ?? (reset($rawTitle) ?: ''))
                            : (string) $rawTitle;

                        return [
                            'id' => $record->id,
                            'title' => $title,
                            'title_translations' => is_array($rawTitle) ? $rawTitle : [],
                            'url' => $urlResolver ? $urlResolver($record) : '',
                        ];
                    })
                    ->values()
                    ->toArray();
            },
        ];

        return $this;
    }

    /** @return array<string, array<string, mixed>> */
    public function getItemTypes(): array
    {
        $locale = $this->getActiveLocale();

        $types = [
            'custom' => [
                'type' => 'custom',
                'label' => __('filament.menu_builder.custom_link'),
                'items' => [],
            ],
        ];

        foreach ($this->itemTypes as $key => $config) {
            if (isset($config['items_resolver']) && $config['items_resolver'] instanceof Closure) {
                $config['items'] = ($config['items_resolver'])($locale);
                unset($config['items_resolver']);
            }

            $types[$key] = $config;
        }

        return $types;
    }

    public function getActiveLocale(): string
    {
        try {
            $livewire = $this->getLivewire();
            if ($livewire && property_exists($livewire, 'activeLocale') && ! blank($livewire->activeLocale)) {
                return $livewire->activeLocale;
            }
        } catch (\Throwable) {
            // fall through
        }

        return session('spatie_translatable_active_locale', app()->getLocale());
    }

    /** @param  array<int, array<string, mixed>>  $flatItems */
    private function persistItems(array $flatItems, mixed $record): void
    {
        $locale = $this->getActiveLocale();

        $record->items()->delete();

        /** @var array<string, int> $idMap temp_id → real DB id */
        $idMap = [];

        foreach ($flatItems as $index => $item) {
            $parentId = null;

            // Prefer explicit parent_temp_id; fallback to depth-based resolution
            if (! empty($item['parent_temp_id'])) {
                $parentId = $idMap[$item['parent_temp_id']] ?? null;
            } elseif (($item['depth'] ?? 0) > 0) {
                for ($i = $index - 1; $i >= 0; $i--) {
                    if (($flatItems[$i]['depth'] ?? 0) === ($item['depth'] - 1)) {
                        $parentId = $idMap[$flatItems[$i]['temp_id']] ?? null;
                        break;
                    }
                }
            }

            // Merge translations: only update the current locale if `title` belongs to it.
            // `title_locale` tracks which locale the `title` field was set for,
            // so we avoid overwriting other locales' data when saving from a different locale.
            $titleTranslations = is_array($item['title_translations'] ?? null)
                ? $item['title_translations']
                : [];
            $titleLocale = $item['title_locale'] ?? $locale;
            if ($titleLocale === $locale) {
                $titleTranslations[$locale] = $item['title'];
            }

            $newItem = $record->items()->create([
                'parent_id' => $parentId,
                'title' => $titleTranslations,
                'type' => $item['type'] ?? 'custom',
                'linkable_type' => $item['linkable_type'] ?: null,
                'linkable_id' => $item['linkable_id'] ?: null,
                'url' => $item['url'] ?: null,
                'target' => $item['target'] ?? '_self',
                'icon' => $item['icon'] ?: null,
                'sort_order' => $index,
                'is_active' => $item['is_active'] ?? true,
            ]);

            $idMap[$item['temp_id']] = $newItem->id;
        }
    }
}
