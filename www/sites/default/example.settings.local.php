<?php

$databases['default']['default'] = array(
  'driver' => 'mysql',
  'database' => 'drupal',
  'username' => 'drupal',
  'password' => 'drupal',
  'host' => 'mysql',
  'prefix' => '',
);

$settings['install_profile'] = 'drupalcampfr';
$settings['hash_salt'] = 'drupalcampfr';
$settings['trusted_host_patterns'] = array(
  '^socle-drupalcampfr\.local$',
);

// Twitter.
// Go to https://apps.twitter.com to get these tokens.
$config['drupalcampfr_social.twitter']['consumer_key'] = '';
$config['drupalcampfr_social.twitter']['consumer_secret'] = '';
$config['drupalcampfr_social.twitter']['access_token'] = '';
$config['drupalcampfr_social.twitter']['access_token_secret'] = '';

if (file_exists(__DIR__ . '/../development.settings.php')) {
  include __DIR__ . '/../development.settings.php';
}
