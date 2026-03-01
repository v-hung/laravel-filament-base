<?php

namespace App\Http\Middleware;

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
            'name' => setting('shop.site_name'),
            'auth' => [
                'user' => $request->user(),
            ],
            'cart' => function () {
                return app(CartService::class)->getCart();
            },
            'settings' => [
                'site_name' => setting('shop.site_name'),
                'site_logo' => setting_image('shop.site_logo'),
                'site_email' => setting('shop.site_email'),
                'site_phone' => setting('shop.site_phone'),
                'site_address' => setting('shop.site_address'),
            ],
        ];
    }
}
