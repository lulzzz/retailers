<?php

return [

'shopify' => [

        /*
         *  https://docs.shopify.com/api/authentication/oauth#get-the-client-redentials
         */
        'client_id'     => env('SHOPIFY_KEY'),
        'client_secret' => env('SHOPIFY_SECRET'),

        /*
         *  https://docs.shopify.com/api/authentication/oauth#scopes
         */
        'scopes'        => [
        'read_content',
        'read_themes',
        'read_products',
        'read_customers'
        ],

        /*
         *  https://docs.shopify.com/api/recurringapplicationcharge#create
         */
        'plan'          => [
        'name'       => 'Retailers',
        'price'      => 39.99,
        'return_url' => env('APP_URL', 'http://localhost').'/shopify/activate',
        'trial_day'  => 0,
        'test'       => true
        ],

        ]

        ];