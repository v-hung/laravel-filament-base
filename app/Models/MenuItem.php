<?php

namespace App\Models;

use App\Repositories\MenuItemRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title'];

    protected $guarded = [];

    protected static function booted(): void
    {
        $clearCache = function (self $item): void {
            $slug = $item->menu?->slug;
            if ($slug) {
                MenuItemRepository::clearFrontendCache($slug);
            }
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'linkable_id' => 'integer',
        ];
    }

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order');
    }
}
