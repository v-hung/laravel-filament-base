<?php

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin;

class AdminPanelProvider extends PanelProvider
{
	public function panel(Panel $panel): Panel
	{
		return $panel
			->default()
			->id('admin')
			->path('admin')
			->viteTheme('resources/css/filament/admin/theme.css')
			->login()
			->colors([
				'primary' => Color::Amber,
			])
			->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
			->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
			->pages([
				Dashboard::class,
			])
			->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
			->widgets([
				AccountWidget::class,
				FilamentInfoWidget::class,
			])
			->middleware([
				EncryptCookies::class,
				AddQueuedCookiesToResponse::class,
				StartSession::class,
				AuthenticateSession::class,
				ShareErrorsFromSession::class,
				VerifyCsrfToken::class,
				SubstituteBindings::class,
				DisableBladeIconComponents::class,
				DispatchServingFilamentEvent::class,
			])
			->plugins([
				FilamentShieldPlugin::make()
					->gridColumns([
						'default' => 1,
						'sm' => 2,
						'lg' => 3,
					])
					->sectionColumnSpan(1)
					->checkboxListColumns([
						'default' => 1,
						'sm' => 2,
						'lg' => 4,
					])
					->resourceCheckboxListColumns([
						'default' => 1,
						'sm' => 2,
					]),
				SpatieTranslatablePlugin::make()
					->defaultLocales(['vi', 'en']),
			])
			->navigationGroups([
				'shop' => NavigationGroup::make(fn() => __('filament.navigation.shop')),
				'content' => NavigationGroup::make(fn() => __('filament.navigation.content')),
				'user' => NavigationGroup::make(fn() => __('filament-shield::filament-shield.nav.group')),
				'settings' => NavigationGroup::make(fn() => __('filament.navigation.settings')),
			])
			->renderHook(
				PanelsRenderHook::BODY_END,
				fn() => Blade::render('@livewire(\'media-picker-modal\')')
			)
			->authMiddleware([
				Authenticate::class,
			]);
	}
}
