<?php

namespace NickyWoolf\Carter;

use Illuminate\Support\ServiceProvider;
use Route;

class CarterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/routes.php' => $this->routesPath(),
        ], 'routes');

        $this->publishes([
            __DIR__.'/config.php' => config_path('carter.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/carter'),
        ], 'views');

        $this->mergeConfigFrom(__DIR__.'/config.php', 'carter');
        $this->loadViewsFrom(__DIR__.'/views', 'carter');
        $this->commands('command.carter.table');

        if (! $this->app->routesAreCached() && config('carter.shopify.use_package_routes')) {
            $this->mapRoutes();
        }
    }

    protected function routesPath()
    {
        return $this->hasRoutesDirectory() ? base_path('routes/carter.php') : app_path('Http/carter.php');
    }

    protected function hasRoutesDirectory()
    {
        return is_dir(base_path('routes'));
    }

    protected function mapRoutes()
    {
        if ($this->hasRoutesDirectory() && file_exists(base_path('routes/carter.php'))) {
            $routes = base_path('routes/carter.php');
        } elseif (file_exists(app_path('Http/carter.php'))) {
            $routes = app_path('Http/carter.php');
        } else {
            $routes = __DIR__.'/routes.php';
        }

        Route::group(['namespace' => 'NickyWoolf\Carter\Controllers'], function () use ($routes) {
            require $routes;
        });
    }

    public function register()
    {
        $this->app->bind(ApiCallsStore::class, function () {
            return app(config('carter.shopify.api.call_limit_store'));
        });

        $this->app->bind(ApiClientFactory::class, function () {
            return app(config('carter.shopify.api.client_factory'));
        });

        $this->app->bind(ShopifySignatureHttp::class, function () {
            return new ShopifySignatureHttp(request()->all());
        });

        $this->app->bind(ShopifySignatureWebhook::class, function () {
            return new ShopifySignatureWebhook([
                'header' => request()->header('X-Shopify-Hmac-SHA256'),
                'data' => file_get_contents('php://input'),
            ]);
        });

        $this->app->bind('carter.user', function () {
            return app(config('auth.providers.users.model'));
        });

        $this->app->singleton('command.carter.table', function () {
            return new CarterTableCommand();
        });

        $this->registerMiddleware();
    }

    protected function registerMiddleware()
    {
        $routeMiddleware = [
            'carter.paying' => \NickyWoolf\Carter\Middleware\ChargeAccepted::class,
            'carter.charged' => \NickyWoolf\Carter\Middleware\HasChargeId::class,
            'carter.shopify_domain' => \NickyWoolf\Carter\Middleware\HasShopifyDomain::class,
            'carter.login' => \NickyWoolf\Carter\Middleware\LoginShop::class,
            'carter.guest' => \NickyWoolf\Carter\Middleware\RedirectIfLoggedIn::class,
            'carter.signed' => \NickyWoolf\Carter\Middleware\SignedByShopify::class,
            'carter.webhook_signed' => \NickyWoolf\Carter\Middleware\WebhookSignedByShopify::class,
        ];

        foreach ($routeMiddleware as $key => $middleware) {
            Route::middleware($key, $middleware);
        }
    }
}
