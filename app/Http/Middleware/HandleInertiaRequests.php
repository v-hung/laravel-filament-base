<?php

namespace App\Http\Middleware;

use App\Repositories\MenuItemRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'appLocale' => app()->getLocale(),
            'name' => setting_locales('shop.site_name'),
            'auth' => [
                'user' => $request->user(),
            ],
            'cart' => function () {
                return app(CartService::class)->getCart();
            },
            'settings' => settings_all_locales('shop'),
            'menus' => function () {
                $repo = app(MenuItemRepository::class);

                return [
                    'header' => $repo->forFrontend('header'),
                    'footer' => $repo->forFrontend('footer'),
                ];
            },
        ];
    }
}
