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
  '^127\.0\.0\.1$',
);

// External cache.
if (file_exists(__DIR__ . '/.cache_activated')) {
  $settings['redis.connection']['interface'] = 'PhpRedis';
  $settings['redis.connection']['host']      = 'redis';
  $settings['cache']['default'] = 'cache.backend.redis';

  // Always set the fast backend for bootstrap, discover and config, otherwise
  // this gets lost when redis is enabled.
  $settings['cache']['bins']['bootstrap'] = 'cache.backend.chainedfast';
  $settings['cache']['bins']['discovery'] = 'cache.backend.chainedfast';
  $settings['cache']['bins']['config'] = 'cache.backend.chainedfast';
}

// Twitter.
// Go to https://apps.twitter.com to get these tokens.
$config['drupalcampfr_social.twitter']['consumer_key'] = '';
$config['drupalcampfr_social.twitter']['consumer_secret'] = '';
$config['drupalcampfr_social.twitter']['access_token'] = '';
$config['drupalcampfr_social.twitter']['access_token_secret'] = '';

// Contact email.
$contact_email = '';
$config['contact.form.attendance_certificate']['recipients'] = array($contact_email);
$config['contact.form.contact']['recipients']                = array($contact_email);
$config['contact.form.demander_une_reduction']['recipients'] = array($contact_email);
$config['contact.form.sponsor']['recipients']                = array($contact_email);
$config['contact.form.volunteer']['recipients']              = array($contact_email);

if (file_exists(__DIR__ . '/../development.settings.php')) {
  include __DIR__ . '/../development.settings.php';
}
