<?php

namespace App\Repositories;

use App\Enums\CategoryStatus;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Collection;

class MenuItemRepository
{
    /**
     * Return a nested tree of active menu items for a given slug.
     * Title is returned as a translations map { locale: value } so the
     * frontend can switch languages without a new request.
     * Returns an empty array if the menu does not exist or is inactive.
     *
     * @return array<int, array<string, mixed>>
     */
    public function forFrontend(string $slug): array
    {
        $menu = Menu::query()
            ->where('slug', $slug)
            ->where('status', CategoryStatus::Active)
            ->first();

        if (! $menu) {
            return [];
        }

        $allItems = $menu->items()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return $this->buildTree($allItems);
    }

    /**
     * Build a nested tree from a flat Collection ordered by sort_order.
     *
     * @param  Collection<int, MenuItem>  $allItems
     * @return array<int, array<string, mixed>>
     */
    private function buildTree(Collection $allItems, ?int $parentId = null): array
    {
        $tree = [];
        $children = $allItems->where('parent_id', $parentId)->sortBy('sort_order')->values();

        foreach ($children as $item) {
            $translations = method_exists($item, 'getTranslations')
                ? $item->getTranslations('title')
                : ['default' => (string) $item->title];

            $tree[] = [
                'id' => $item->id,
                'title' => $translations,
                'url' => $item->url,
                'target' => $item->target ?? '_self',
                'icon' => $item->icon,
                'type' => $item->type ?? 'custom',
                'children' => $this->buildTree($allItems, $item->id),
            ];
        }

        return $tree;
    }

    /**
     * Fetch all menu items for a menu in a single query,
     * then build a flat array (with depth) in memory — no nested DB queries.
     *
     * @return array<int, array<string, mixed>>
     */
    public function flatForBuilder(Menu $menu, string $locale): array
    {
        $allItems = $menu->items()->orderBy('sort_order')->get();

        return $this->buildFlatList($allItems, $locale);
    }

    /**
     * Build a flat array with depth from a flat Collection ordered by sort_order.
     * Items are grouped by parent_id so we recurse in memory only.
     *
     * @param  Collection<int, MenuItem>  $allItems
     * @return array<int, array<string, mixed>>
     */
    public function buildFlatList(Collection $allItems, string $locale, ?int $parentId = null, int $depth = 0): array
    {
        $flat = [];

        $children = $allItems->where('parent_id', $parentId)->sortBy('sort_order')->values();

        foreach ($children as $item) {
            $allTranslations = method_exists($item, 'getTranslations')
                ? $item->getTranslations('title')
                : [];

            $title = method_exists($item, 'getTranslation')
                ? ($item->getTranslation('title', $locale, false) ?: (reset($allTranslations) ?: ''))
                : (string) $item->title;

            $tempId = 'item_'.$item->id;
            $parentTempId = $item->parent_id ? 'item_'.$item->parent_id : null;

            $flat[] = [
                'id' => $item->id,
                'temp_id' => $tempId,
                'parent_temp_id' => $parentTempId,
                'title' => $title,
                'title_locale' => $locale,
                'title_translations' => $allTranslations,
                'type' => $item->type ?? 'custom',
                'linkable_type' => $item->linkable_type,
                'linkable_id' => $item->linkable_id,
                'url' => $item->url ?? '',
                'target' => $item->target ?? '_self',
                'icon' => $item->icon ?? '',
                'depth' => $depth,
                'is_active' => (bool) $item->is_active,
            ];

            $flat = array_merge($flat, $this->buildFlatList($allItems, $locale, $item->id, $depth + 1));
        }

        return $flat;
    }
}
