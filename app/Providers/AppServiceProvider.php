<?php

namespace App\Providers;

use App\Livewire\MediaManager;
use App\Livewire\MediaPickerModal;
use App\Repositories\SettingRepository;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Carbon\CarbonImmutable;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        // Register Livewire components
        Livewire::component('media-picker-modal', MediaPickerModal::class);
        Livewire::component('media-manager', MediaManager::class);

        // FilamentAsset::register([
        //     Js::make('apline-sort', __DIR__ . '/../../resources/js/alpine-plugin/alpine.sort.min.js'),
        //     // Js::make('apline-mask', __DIR__ . '/../../resources/js/alpine-plugin/alpine.mask.min.js'),
        // ]);

        if (! $this->app->runningInConsole()) {
            // Gate::guessPolicyNamesUsing(function (string $modelClass) {
            //     return str_replace('Models', 'Policies', $modelClass) . 'Policy';
            // });

            LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
                $switch->locales(['en', 'vi']); // also accepts a closure
            });

            app()->instance('settings', app(SettingRepository::class)->getAll());
        }
    }

    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn (): ?Password => app()->isProduction()
                ? Password::min(12)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
                : null
        );
    }
}
