<?php

namespace App\Filament\Forms\Components;

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
            $items = $component->flattenItems($record->rootItems()->with('children')->get());
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
        $locale = app()->getLocale();

        $items = $modelClass::query()
            ->get()
            ->map(function ($record) use ($titleField, $urlResolver, $locale) {
                $rawTitle = $record->{$titleField};
                $title = is_array($rawTitle)
                    ? ($rawTitle[$locale] ?? (reset($rawTitle) ?: ''))
                    : (string) $rawTitle;

                return [
                    'id' => $record->id,
                    'title' => $title,
                    'url' => $urlResolver ? $urlResolver($record) : '',
                ];
            })
            ->values()
            ->toArray();

        return $this->addItemType($key, [
            'type' => 'model',
            'label' => $label,
            'icon' => $icon,
            'items' => $items,
        ]);
    }

    /** @return array<string, array<string, mixed>> */
    public function getItemTypes(): array
    {
        return array_merge(
            [
                'custom' => [
                    'type' => 'custom',
                    'label' => __('filament.menu_builder.custom_link'),
                    'items' => [],
                ],
            ],
            $this->itemTypes
        );
    }

    /** @param  iterable<mixed>  $items */
    private function flattenItems(iterable $items, int $depth = 0): array
    {
        $flat = [];
        $locale = app()->getLocale();

        foreach ($items as $item) {
            $rawTitle = $item->title;
            $title = is_array($rawTitle)
                ? ($rawTitle[$locale] ?? (reset($rawTitle) ?: ''))
                : (string) $rawTitle;

            $flat[] = [
                'id' => $item->id,
                'temp_id' => 'item_'.$item->id,
                'title' => $title,
                'url' => $item->url ?? '',
                'target' => $item->target ?? '_self',
                'icon' => $item->icon ?? '',
                'depth' => $depth,
                'is_active' => (bool) $item->is_active,
            ];

            if ($item->children->isNotEmpty()) {
                $flat = array_merge($flat, $this->flattenItems($item->children, $depth + 1));
            }
        }

        return $flat;
    }

    /** @param  array<int, array<string, mixed>>  $flatItems */
    private function persistItems(array $flatItems, mixed $record): void
    {
        $locale = app()->getLocale();

        $record->items()->delete();

        /** @var array<string, int> $idMap temp_id → real DB id */
        $idMap = [];

        foreach ($flatItems as $index => $item) {
            $parentId = null;

            if ($item['depth'] > 0) {
                for ($i = $index - 1; $i >= 0; $i--) {
                    if ($flatItems[$i]['depth'] === $item['depth'] - 1) {
                        $parentId = $idMap[$flatItems[$i]['temp_id']] ?? null;
                        break;
                    }
                }
            }

            $newItem = $record->items()->create([
                'parent_id' => $parentId,
                'title' => [$locale => $item['title']],
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
