<?php

namespace App\Filament\Resources\Collections\Pages;

use App\Filament\Resources\Collections\CollectionResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateCollection extends CreateRecord
{
    use Translatable;

    protected static string $resource = CollectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            // ...
        ];
    }
}
