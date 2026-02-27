<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class MediaImageColumn extends ImageColumn
{
    protected string $mediaRelationship = 'media';

    protected function setUp(): void
    {
        parent::setUp();

        $this->state(function (mixed $record): array {
            return $record->getMedia($this->getCollection())
                ->map->getUrl()
                ->filter()
                ->values()
                ->toArray();
        });
    }

    public function applyEagerLoading(Builder|Relation $query): Builder|Relation
    {
        $relationship = $this->getMediaRelationship();

        if (array_key_exists($relationship, $query->getEagerLoads())) {
            return $query;
        }

        return $query->with([$relationship]);
    }

    public function mediaRelationship(string $relationship): static
    {
        $this->mediaRelationship = $relationship;

        return $this;
    }

    public function getMediaRelationship(): string
    {
        return $this->mediaRelationship;
    }

    public function getCollection(): string
    {
        return $this->getName();
    }
}
