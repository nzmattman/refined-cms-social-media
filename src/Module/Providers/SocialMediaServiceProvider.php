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
            'icon' => 'fas fa-share-alt',
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
    }
}
