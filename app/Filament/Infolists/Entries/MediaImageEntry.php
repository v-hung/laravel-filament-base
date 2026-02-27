<?php

namespace App\Filament\Infolists\Entries;

use Filament\Infolists\Components\ImageEntry;

class MediaImageEntry extends ImageEntry
{
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

    public function getCollection(): string
    {
        return $this->getName();
    }
}
