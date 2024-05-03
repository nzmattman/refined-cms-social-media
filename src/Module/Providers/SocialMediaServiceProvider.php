<?php

namespace RefinedDigital\SocialMedia\Module\Providers;

use Illuminate\Support\ServiceProvider;
use RefinedDigital\SocialMedia\Commands\Install;
use RefinedDigital\CMS\Modules\Core\Aggregates\PackageAggregate;
use RefinedDigital\CMS\Modules\Core\Aggregates\ModuleAggregate;
use RefinedDigital\CMS\Modules\Core\Aggregates\RouteAggregate;

class SocialMediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->addNamespace('socialMedia', [
            base_path().'/resources/views',
            __DIR__.'/../Resources/views',
        ]);

        try {
            if ($this->app->runningInConsole()) {
                if (\DB::connection()->getDatabaseName() && !\Schema::hasTable('social_media')) {
                    $this->commands([
                        Install::class
                    ]);
                }
            }
        } catch (\Exception $e) {}


        $this->publishes([
            __DIR__.'/../../../config/social-media.php' => config_path('social-media.php'),
        ], 'social-media');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        app(RouteAggregate::class)
            ->addRouteFile('socialMedia', __DIR__.'/../Http/routes.php');

        $menuConfig = [
            'order' => 300,
            'name' => 'Social Media',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"><path class="fa-primary" d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM384 160c0 35.3-28.7 64-64 64c-15.4 0-29.5-5.4-40.6-14.5L194.1 256l85.3 46.5c11-9.1 25.2-14.5 40.6-14.5c35.3 0 64 28.7 64 64s-28.7 64-64 64s-64-28.7-64-64c0-2.5 .1-4.9 .4-7.3L174.5 300c-11.7 12.3-28.2 20-46.5 20c-35.3 0-64-28.7-64-64s28.7-64 64-64c18.3 0 34.8 7.7 46.5 20l81.9-44.7c-.3-2.4-.4-4.9-.4-7.3c0-35.3 28.7-64 64-64s64 28.7 64 64z"/><path class="fa-secondary" opacity="0.4" d="M320 224c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64c0 2.5 .1 4.9 .4 7.3L174.5 212c-11.7-12.3-28.2-20-46.5-20c-35.3 0-64 28.7-64 64s28.7 64 64 64c18.3 0 34.8-7.7 46.5-20l81.9 44.7c-.3 2.4-.4 4.9-.4 7.3c0 35.3 28.7 64 64 64s64-28.7 64-64s-28.7-64-64-64c-15.4 0-29.5 5.4-40.6 14.5L194.1 256l85.3-46.5c11 9.1 25.2 14.5 40.6 14.5z"/></svg>',
            'route' => 'social-media',
            'activeFor' => ['social-media']
        ];

        app(ModuleAggregate::class)
            ->addMenuItem($menuConfig);

        app(PackageAggregate::class)
            ->addPackage('SocialMedia', [
                'repository' => \RefinedDigital\SocialMedia\Module\Http\Repositories\SocialMediaRepository::class,
                'model' => '\\RefinedDigital\\SocialMedia\\Module\\Models\\SocialMedia',
            ]);

        $this->mergeConfigFrom(__DIR__.'/../../../config/social-media.php', 'social-media');
    }
}
