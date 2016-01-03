<?php

$databases['default']['default'] = array(
  'driver' => 'mysql',
  'database' => 'drupalcampfr',
  'username' => 'drupalcampfr',
  'password' => 'drupalcampfr',
  'host' => 'localhost',
  'prefix' => '',
);

$settings['install_profile'] = 'standard';
$settings['hash_salt'] = 'drupalcampfr';
$settings['trusted_host_patterns'] = array(
  '^socle-drupalcampfr\.local$',
);

if (file_exists(__DIR__ . '../development.settings.php')) {
  include __DIR__ . '../development.settings.php';
}
