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
    /**
     * Each resolver covers one relation type and handles BOTH the single (_id) and
     * multiple (_ids) variants with a single shared batch fetch.
     *
     * Shape:
     * [
     *   'id_key'       => string|null,  // singular key  (e.g. 'image_id')
     *   'ids_key'      => string|null,  // plural key    (e.g. 'image_ids')
     *   'output_key'   => string|null,  // output for singular (e.g. 'image')
     *   'output_keys'  => string|null,  // output for plural   (e.g. 'images')
     *   'fetch'        => Closure(int[]) → Collection<int, mixed>,  // batch load keyed by id
     *   'serialize'    => Closure(mixed) → mixed,                   // model → output value
     * ]
     *
     * @var array<int, array{id_key: string|null, ids_key: string|null, output_key: string|null, output_keys: string|null, fetch: \Closure, serialize: \Closure}>
     */
    private array $resolvers;

    public function __construct(
        protected MediaRepository $mediaRepository,
        protected CollectionRepository $collectionRepository,
    ) {
        $this->resolvers = [
            [
                'id_key' => 'image_id',
                'ids_key' => 'image_ids',
                'output_key' => 'image',
                'output_keys' => 'images',
                'fetch' => fn (array $ids) => $this->mediaRepository->getMediaByIds($ids)->keyBy('id'),
                'serialize' => fn ($item) => $item->toMediaData(),
            ],
            [
                'id_key' => 'collection_id',
                'ids_key' => 'collection_ids',
                'output_key' => 'collection',
                'output_keys' => 'collections',
                'fetch' => fn (array $ids) => $this->collectionRepository->getByIds($ids)->keyBy('id'),
                'serialize' => fn ($item) => $item->toArray(),
            ],
        ];
    }

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
            ->whereSlug($slug)
            ->firstOrFail();
    }

    /**
     * Find a page by slug and return its sections with all relational IDs resolved to objects.
     *
     * Supported by default:
     *   image_id → image, image_ids → images
     *   collection_id → collection, collection_ids → collections
     *
     * To add a new relation type, register a new entry in $this->resolvers.
     */
    public function getPageSections(string $slug): ?array
    {
        $page = Page::whereSlug($slug)->first();

        if (! $page) {
            return null;
        }

        $translations = $page->getTranslations('sections');

        // Collect all IDs per resolver across all locales in a single pass.
        $idsByResolver = array_fill_keys(array_keys($this->resolvers), []);

        foreach ($translations as $localeSections) {
            $sections = is_array($localeSections) ? $localeSections : [];
            foreach ($this->resolvers as $index => $resolver) {
                $idsByResolver[$index] = array_merge(
                    $idsByResolver[$index],
                    $this->collectIds($sections, $resolver)
                );
            }
        }

        // Batch-fetch each relation type once, keyed by id.
        $maps = [];
        foreach ($this->resolvers as $index => $resolver) {
            $ids = array_values(array_unique(array_filter($idsByResolver[$index])));
            $maps[$index] = $ids ? ($resolver['fetch'])($ids) : collect();
        }

        // Resolve all locales.
        $result = [];
        foreach ($translations as $locale => $localeSections) {
            $sections = is_array($localeSections) ? $localeSections : [];
            $result[$locale] = $this->resolveRelations($sections, $maps);
        }

        return $result;
    }

    /**
     * Recursively collect all IDs (both singular and plural) for a resolver.
     *
     * @param  array{id_key: string|null, ids_key: string|null}  $resolver
     * @return int[]
     */
    private function collectIds(array $data, array $resolver): array
    {
        $ids = [];

        foreach ($data as $key => $value) {
            if ($resolver['id_key'] && $key === $resolver['id_key'] && is_int($value)) {
                $ids[] = $value;
            } elseif ($resolver['ids_key'] && $key === $resolver['ids_key'] && is_array($value)) {
                foreach ($value as $id) {
                    if (is_int($id)) {
                        $ids[] = $id;
                    }
                }
            } elseif (is_array($value)) {
                $ids = array_merge($ids, $this->collectIds($value, $resolver));
            }
        }

        return $ids;
    }

    /**
     * Recursively replace relational ID keys with resolved objects.
     *
     * @param  array<int, Collection<int, mixed>>  $maps  Keyed by resolver index.
     */
    private function resolveRelations(array $data, array $maps): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            $resolved = false;

            foreach ($this->resolvers as $index => $resolver) {
                $map = $maps[$index];

                if ($resolver['id_key'] && $key === $resolver['id_key'] && is_int($value)) {
                    $item = $map->get($value);
                    $result[$resolver['output_key']] = $item ? ($resolver['serialize'])($item) : null;
                    $resolved = true;
                    break;
                }

                if ($resolver['ids_key'] && $key === $resolver['ids_key'] && is_array($value)) {
                    $result[$resolver['output_keys']] = array_values(array_filter(
                        array_map(
                            fn ($id) => is_int($id) && ($item = $map->get($id))
                                ? ($resolver['serialize'])($item)
                                : null,
                            $value
                        )
                    ));
                    $resolved = true;
                    break;
                }
            }

            if (! $resolved) {
                $result[$key] = is_array($value)
                    ? $this->resolveRelations($value, $maps)
                    : $value;
            }
        }

        return $result;
    }
}
