<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Enums\ContentStatus;
use App\Enums\PageType;
use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PageRepository
{
    public function __construct(protected MediaRepository $mediaRepository) {}

    public function search(?SearchParams $params = null, ?array $excludeIds = []): LengthAwarePaginator
    {
        $params ??= new SearchParams;

        $query = Page::query()
            ->where('status', ContentStatus::Published)
            ->where('page_type', PageType::Regular);

        if (! empty($excludeIds)) {
            $query->whereNotIn('id', $excludeIds);
        }

        return $query
            ->with(['categories' => function ($q) {
                $q->limit(1);
            }])
            ->orderBy($params->sortBy, $params->sortDirection)
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            );
    }

    public function findBySlug(string $slug): ?Page
    {
        return Page::with('categories')
            ->where('status', ContentStatus::Published)
            ->where(function ($q) use ($slug) {
                $q->where('slug->vi', $slug)
                    ->orWhere('slug->en', $slug);
            })
            ->firstOrFail();
    }

    /**
     * Find a page by its Vietnamese slug and return its sections with image_id resolved to image objects.
     */
    public function getPageSectionsWithImages(string $slug): ?array
    {
        $page = Page::where(function ($q) use ($slug): void {
            $q->where('slug->vi', $slug)
                ->orWhere('slug->en', $slug);
        })->first();

        if (! $page) {
            return null;
        }

        $translations = $page->getTranslations('sections');

        $allImageIds = [];
        foreach ($translations as $localeSections) {
            $sections = is_array($localeSections) ? $localeSections : [];
            $allImageIds = array_merge($allImageIds, $this->collectImageIds($sections));
        }
        $mediaMap = $this->mediaRepository->getMediaByIds(
            array_values(array_unique(array_filter($allImageIds)))
        )->keyBy('id');

        $result = [];
        foreach ($translations as $locale => $localeSections) {
            $sections = is_array($localeSections) ? $localeSections : [];
            $result[$locale] = $this->resolveImages($sections, $mediaMap);
        }

        return $result;
    }

    private function collectImageIds(array $data): array
    {
        $ids = [];
        array_walk_recursive($data, function ($value, $key) use (&$ids): void {
            if ($key === 'image_id' && is_int($value)) {
                $ids[] = $value;
            }
        });

        return array_values(array_unique(array_filter($ids)));
    }

    private function resolveImages(array $data, Collection $mediaMap): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            if ($key === 'image_id' && is_int($value)) {
                $result['image'] = $mediaMap->get($value)?->toMediaData();
            } elseif (is_array($value)) {
                $result[$key] = $this->resolveImages($value, $mediaMap);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
