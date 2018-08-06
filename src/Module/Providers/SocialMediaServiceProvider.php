<?php

namespace RefinedDigital\SocialMedia\Module\Providers;

use Illuminate\Support\ServiceProvider;
use RefinedDigital\SocialMedia\Commands\Install;
use RefinedDigital\CMS\Modules\Core\Models\PackageAggregate;
use RefinedDigital\CMS\Modules\Core\Models\ModuleAggregate;
use RefinedDigital\CMS\Modules\Core\Models\RouteAggregate;

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
            __DIR__.'/../Resources/views',
            app_path().'/views'
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class
            ]);
        }

        /*$this->publishes([
            __DIR__.'/../../../config/socialMedia.php' => config_path('socialMedia.php'),
        ], 'socialMedia');*/
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
            'order' => 3,
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
