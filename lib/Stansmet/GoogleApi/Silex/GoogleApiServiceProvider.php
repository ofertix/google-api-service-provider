<?php

namespace Stansmet\GoogleApi\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;

class GoogleApiServiceProvider implements ServiceProviderInterface
{
  public function register(Application $app)
  {
    $app['google.api.client'] = $app->share(function() use ($app) {
      if (isset($app['google.api.key'])) {
        $key = $app['google.api.key_file'];
      } else {
        throw new Exception("Key api key must be defined", 1);
      }

      $config = new \Google_Config();
      $config->setDeveloperKey($key);

      $client = new \Google_Client($config);

      return $client;
    });
  }

  public function boot(Application $app)
  {}
}
