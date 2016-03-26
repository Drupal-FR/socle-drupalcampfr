<?php

/**
 * @file
 * Contains \Drupal\drupalcampfr_social\Service\TwitterService.
 */

namespace Drupal\drupalcampfr_social\Service;

use Drupal\Core\Config\ConfigFactoryInterface;
use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Class TwitterService.
 *
 * @package Drupal\drupalcampfr_social
 */
class TwitterService implements TwitterServiceInterface {

  /**
   * The factory for configuration objects.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The connection object.
   *
   * @var Abraham\TwitterOAuth\TwitterOAuth
   */
  protected $connection = NULL;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Get the twitter connection.
   *
   * @return \Abraham\TwitterOAuth\TwitterOAuth
   *   A TwitterOAuth object.
   */
  protected function getConnection() {
    if (is_null($this->connection)) {
      $twitter = $this->configFactory->get('drupalcampfr_social.twitter');

      $consumer_key = $twitter->get('consumer_key');
      $consumer_secret = $twitter->get('consumer_secret');
      $access_token = $twitter->get('access_token');
      $access_token_secret = $twitter->get('access_token_secret');

      $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
      $this->connection = $connection;
    }
    else {
      $connection = $this->connection;
    }

    return $connection;
  }

  /**
   * {@inheritdoc}
   */
  public function getStatuses($path, array $options) {
    $connection = $this->getConnection();

    return $connection->get($path, $options);
  }

}
