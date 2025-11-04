<?php

declare(strict_types=1);

namespace Djnew\MoonShineNestedSet\Providers;

use Illuminate\Support\Facades\{Blade, Vite};
use Illuminate\Support\ServiceProvider;
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

final class MoonShineNestedSetServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'moonshine-nestedset');

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/djnew/moonshine-nestedset'),
        ], ['moonshine-nestedset', 'laravel-assets']);


        if (file_exists(public_path() . '/vendor/djnew/moonshine-nestedset/')) {
            moonShineAssets()->add([
                Css::make(
                    Vite::createAssetPathsUsing(function (string $path, ?bool $secure) {
                        return "$path";
                    })->asset('resources/css/nested-set.css', 'vendor/djnew/moonshine-nestedset')
                ),

                Js::make(
                    Vite::createAssetPathsUsing(function (string $path, ?bool $secure) {
                        return "$path";
                    })->asset('resources/js/app.js', 'vendor/djnew/moonshine-nestedset')
                )
            ]);
        }

        Blade::withoutDoubleEncoding();
        Blade::componentNamespace('Djnew\MoonShineNestedset\View\Components', 'moonshine-nestedset');
    }
}
