<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


use App\User;
use App\Brand;
use App\Merchant;
use App\Retailer;
use App\Location;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Guzzle\Http\EntityBody;
use Shopify;

use View;
use Auth;
use Redirect;



class ShopifyController extends Controller
{
   public function install()
   {

      session_start();
      $client = new Shopify\PublicApp('vehina.myshopify.com', env('SHOPIFY_KEY'), env('SHOPIFY_SECRET'));

      // You set a random state that you will confirm later.
      $random_state = 'client-id:' . $_SESSION['client_id'];

      $client->authorizeUser('/shopify/redirect', [
         'read_products',
         'write_products',
      ], $random_state);

      return 'hello';
   }

   public function redirect()
   {
      session_start();
      $shop = 'vehina.myshopify.com';
      $client = new Shopify\PublicApp($shop, env('SHOPIFY_KEY'), env('SHOPIFY_SECRET'));

      // Used to check request data is valid.
      $client->setState('client-id:' . $_SESSION['client_id']);

      if ($token = $client->getAccessToken()) {
        $_SESSION['shopify_access_token'] = $token;
        $_SESSION['shopify_shop_domain'] = $_GET['shop'];
      }
      else {
        die('invalid token');
      }

      return 'hello';
   }


   public function dashboard ()
   {
      session_start();
      $client = new Shopify\PublicApp($_SESSION['shopify_shop_domain'], env('SHOPIFY_KEY'), env('SHOPIFY_SECRET'));
      $client->setAccessToken($_SESSION['shopify_access_token']);
      $products = $client->getProducts();
   }
}
