<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasTranslatableSlug
{
    public function scopeWhereSlug(Builder $query, string $slug): Builder
    {
        return $query->where(function (Builder $q) use ($slug): void {
            foreach (config('app.available_locales') as $locale) {
                $q->orWhere("slug->{$locale}", $slug);
            }
        });
    }
}
