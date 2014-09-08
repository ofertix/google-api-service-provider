<?php

namespace GoogleApi\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;

class GoogleApiServiceProvider implements ServiceProviderInterface
{
  public function register(Application $app)
  {
    /*
    'google.api.client_id' => '562788149368-bcnr3m5sbg6s0vu0nogjaodn8ak3036k.apps.googleusercontent.com',
    'google.api.service_account_name' => '562788149368-bcnr3m5sbg6s0vu0nogjaodn8ak3036k@developer.gserviceaccount.com',
    'google.api.token_file_location' => $_SERVER['home'] . '/.google_api_token',
    'google.api.key_file_location' => $_SERVER['home'] . '/google-api-cert.p12',
    'google.api.ofertix_merchant_id' => '6883931',
    'google.api.nc_es_merchant_id' => '100908656',
    'google.api.nc_fr_merchant_id' => '100909066',
    'google.api.developer_key' => 'AIzaSyDStvtK4krs3Oi-md1o3u5GxQ0sg_vMj5U'
    */
    $app['google.api.client'] = $app->share(function() use ($app) {
      if (!isset($app['google.api.client_id'])) {
        throw new \Exception("client_id api must be defined", 1);
      }

      if (!isset($app['google.api.service_account_name'])) {
        throw new \Exception("client_id api must be defined", 1);
      }

      if (!isset($app['google.api.token_file_location'])) {
        throw new \Exception("client_id api must be defined", 1);
      }

      if (!isset($app['google.api.key_file_location'])) {
        throw new \Exception("client_id api must be defined", 1);
      }

      if (!isset($app['google.api.developer_key'])) {
        throw new \Exception("client_id api must be defined", 1);
      }

      $client = new \Google_Client();
      $client->setApplicationName('Marketplaces Ofertix');
      $client->setDeveloperKey($app['google.api.developer_key']);

      $app['google.api.service'] = new \Google_Service_ShoppingContent($client);

      return $client;
    });
  }

  public function boot(Application $app)
  {}
}
