<?php

namespace App\Models;

use App\Enums\CategoryStatus;
use App\Repositories\MenuItemRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name'];

    protected $guarded = [];

    protected static function booted(): void
    {
        $clearCache = fn (self $menu) => MenuItemRepository::clearFrontendCache($menu->slug);

        static::saved($clearCache);
        static::deleted($clearCache);
    }

    protected function casts(): array
    {
        return [
            'status' => CategoryStatus::class,
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('sort_order');
    }

    public function rootItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('sort_order');
    }
}
