<?php

namespace App\Http\Repositories;

use App\Http\Repositories\ShopifyInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Guzzle\Http\EntityBody;
use Shopify;


class ShopifyRepository implements ShopifyInterface {


  public function client($site) {

    session_start();

    $APIclient = new Shopify\PrivateApp(
      env('EU_SHOPIFY_DOMAIN'),
      env('EU_SHOPIFY_API_KEY'),
      env('EU_SHOPIFY_PASSWORD'),
      env('EU_SHOPIFY_SECRET'));

      return $APIclient;
    }
  }

  public function hooks($site) {

    if($site == 'eu') {
      $webhook = new Shopify\IncomingWebhook(env('EU_SHOPIFY_WEBHOOK'));
      return $webhook;
    } else {
      $webhook = new Shopify\IncomingWebhook(env('SE_SHOPIFY_WEBHOOK'));
      return $webhook;
    }
  }

  public function get($site, $resource, $query) {

    $client = $this->client($site);

    return $client->getResources($resource, ['query' => ['fields' => $query]]);
  }


  public function put($site, $resource, $id, $query) {

    $client = $this->client($site);

    return $client->put($resource. '/'. $id, $query);
  }


  public function webhook($site, $query) {

    $webhook = $this->hooks($site);
    $webhook->validate();

    $data = $webhook->getData();

    return $data->$query;

  }

}
