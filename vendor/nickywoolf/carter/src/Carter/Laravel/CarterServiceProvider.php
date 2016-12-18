<?php

namespace NickyWoolf\Carter\Laravel;

use Illuminate\Support\ServiceProvider;
use NickyWoolf\Carter\Laravel\ShopifyManager;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\CallLimit;
use NickyWoolf\Carter\Shopify\CallLimit\ShopifyClientThrottle;
use NickyWoolf\Carter\Shopify\Client;
use NickyWoolf\Carter\Shopify\Contracts\CallQueueCollection;
use NickyWoolf\Carter\Shopify\Contracts\CallQueueStorage;
use NickyWoolf\Carter\Shopify\Contracts\ShopifyClient as ShopifyClientContract;
use NickyWoolf\Carter\Shopify\Domain;
use NickyWoolf\Carter\Shopify\ShopifyClient;
use NickyWoolf\Carter\Shopify\Signature;
use Route;

class CarterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/routes.php' => $this->routesPath(),
            __DIR__.'/config.php' => config_path('carter.php'),
            __DIR__.'/views'      => resource_path('views/vendor/carter'),
        ]);

        $this->loadViewsFrom(__DIR__.'/views', 'carter');
        $this->mergeConfigFrom(__DIR__.'/config.php', 'carter');
        $this->commands('command.carter.table');

        if (! $this->app->routesAreCached()) {
            $this->mapRoutes();
        }
    }

    /**
     * @return string
     */
    protected function routesPath()
    {
        return $this->hasRoutesDirectory() ? base_path('routes/carter.php') : app_path('Http/carter.php');
    }

    /**
     * @return void
     */
    protected function mapRoutes()
    {
        if ($this->hasRoutesDirectory() && file_exists(base_path('routes/carter.php'))) {
            $routes = base_path('routes/carter.php');
        } elseif (file_exists(app_path('Http/carter.php'))) {
            $routes = app_path('Http/carter.php');
        } else {
            $routes = __DIR__.'/routes.php';
        }

        Route::group([
            'namespace' => 'NickyWoolf\Carter\Laravel\Controllers'
        ], function () use ($routes) {
            require $routes;
        });
    }

    /**
     * @return bool
     */
    protected function hasRoutesDirectory()
    {
        return file_exists(base_path('routes/web.php'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMiddleware();

        $this->app->bind('shopify', ShopifyManager::class);

        $this->app->bind(ApiRequest::class, function () {
            return app('shopify')->apiRequest();
        });

        $this->app->bind(CallQueueStorage::class, function () {
            return app(config('carter.shopify.call_queue_storage'));
        });

        $this->app->bind(ShopifyClientContract::class, function () {
            return app(ShopifyClientThrottle::class, ['client' => new ShopifyClient()]);
        });

        $this->app->bind(Signature::class, function () {
            return new Signature(request()->all());
        });

        $this->app->bind('carter.user', function () {
            return app(config('auth.providers.users.model'));
        });

        $this->app->singleton('command.carter.table', function () {
            return new CarterTableCommand();
        });
    }

    /**
     * @return void
     */
    protected function registerMiddleware()
    {
        $routeMiddleware = [
            'carter.auth'    => \NickyWoolf\Carter\Laravel\Middleware\Authenticate::class,
            'carter.paying'  => \NickyWoolf\Carter\Laravel\Middleware\CheckChargeAccepted::class,
            'carter.install' => \NickyWoolf\Carter\Laravel\Middleware\CheckInstallAuthorizationCode::class,
            'carter.nonce'   => \NickyWoolf\Carter\Laravel\Middleware\CheckNonce::class,
            'carter.signed'  => \NickyWoolf\Carter\Laravel\Middleware\CheckShopifySignature::class,
            'carter.webhook' => \NickyWoolf\Carter\Laravel\Middleware\CheckWebhookSignature::class,
            'carter.guest'   => \NickyWoolf\Carter\Laravel\Middleware\RedirectIfAuthenticated::class,
            'carter.charged' => \NickyWoolf\Carter\Laravel\Middleware\RequestHasChargeId::class,
            'carter.domain'  => \NickyWoolf\Carter\Laravel\Middleware\RequestHasShopDomain::class,
        ];

        foreach ($routeMiddleware as $key => $middleware) {
            Route::middleware($key, $middleware);
        }
    }
}
