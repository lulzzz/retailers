<?php

return [

    'shopify' => [

        'use_package_routes' => true,

        /**
         *  https://docs.shopify.com/api/authentication/oauth#get-the-client-redentials
         */
        'client_id' => env('SHOPIFY_KEY'),
        'client_secret' => env('SHOPIFY_SECRET'),
        'app_store_url' => 'https://apps.shopify.com/locate-retailers',


        /**
         *  https://docs.shopify.com/api/authentication/oauth#scopes
         */
        'scope' => implode(',', [
            'read_content',
            'read_themes',
        ]),

        /**
         *  https://docs.shopify.com/api/recurringapplicationcharge#create
         */
        'plans' => [

            'test' => [
                'name' => 'Beta 0.9.7',
                'price' => 47.00,
                'return_url' => env('APP_URL', 'http://localhost').'/activate',
                'trial_day' => 14,
                'test' => false,
            ],

            /*'basic' => [
                'name' => 'Version 1.0',
                'price' => 47.00,
                'return_url' => env('APP_URL', 'http://localhost').'/activate',
                'trial_day' => 14,
                'test' => false,
            ],*/

        ],

        /**
         * Webhooks to create when Shopify store installs app
         * https://help.shopify.com/api/reference/webhook
         */
        'webhooks' => [

            [
                'address' => env('APP_URL', 'http://localhost').'/webhooks/app/uninstalled',
                'topic' => 'app/uninstalled',
            ],

        ],

        /**
         * https://help.shopify.com/api/guides/api-call-limit
         */
        'api' => [

            /**
             * Available options:
             * \NickyWoolf\Carter\ShopifyApiClientFactory
             * \NickyWoolf\Carter\CallLimitApiClientFactory
             */
            'client_factory' => \NickyWoolf\Carter\CallLimitApiClientFactory::class,

            /**
             * Available options:
             * \NickyWoolf\Carter\ApiCallsArray
             * \NickyWoolf\Carter\ApiCallsCache
             */
            'call_limit_store' => \NickyWoolf\Carter\ApiCallsCache::class,

        ],

    ],

];
