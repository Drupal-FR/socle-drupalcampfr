<?php

$databases['default']['default'] = [
  'driver' => 'mysql',
  'database' => 'drupal',
  'username' => 'drupal',
  'password' => 'drupal',
  'host' => 'mysql',
  'prefix' => '',
];

$settings['hash_salt'] = 'drupalcampfr';
$settings['trusted_host_patterns'] = [
  '^127\.0\.0\.1$',
  'varnish',
  'web',
];

$settings['file_private_path'] = '/project/private_files/default';

// Translations.
$config['locale.settings']['translation']['path'] = 'translations/contrib';
$config['locale.settings']['translation']['use_source'] = 'local';

// Redis.
$settings['redis.connection']['interface'] = 'PhpRedis';
$settings['redis.connection']['host'] = 'redis';
$settings['redis.connection']['port'] = '6379';
$settings['redis.connection']['base'] = 0;

$settings['container_yamls'][] = 'modules/contrib/redis/redis.services.yml';
$settings['container_yamls'][] = 'modules/contrib/redis/example.services.yml';

$settings['cache']['default'] = 'cache.backend.redis';

// Varnish.
$config['varnish_purger.settings.varnish']['hostname'] = 'varnish';

// Twitter.
// Go to https://apps.twitter.com to get these tokens.
$config['drupalcampfr_social.twitter']['consumer_key'] = '';
$config['drupalcampfr_social.twitter']['consumer_secret'] = '';
$config['drupalcampfr_social.twitter']['access_token'] = '';
$config['drupalcampfr_social.twitter']['access_token_secret'] = '';

// Paypal.
$config['commerce_payment.commerce_payment_gateway.paypal_test']['configuration']['api_username'] = '';
$config['commerce_payment.commerce_payment_gateway.paypal_test']['configuration']['api_password'] = '';
$config['commerce_payment.commerce_payment_gateway.paypal_test']['configuration']['signature'] = '';
$config['commerce_payment.commerce_payment_gateway.paypal']['configuration']['api_username'] = '';
$config['commerce_payment.commerce_payment_gateway.paypal']['configuration']['api_password'] = '';
$config['commerce_payment.commerce_payment_gateway.paypal']['configuration']['signature'] = '';

if (file_exists($app_root . '/' . $site_path . '/../development.settings.php')) {
  include $app_root . '/' . $site_path . '/../development.settings.php';
}
