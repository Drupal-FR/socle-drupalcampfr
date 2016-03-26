<?php

/**
 * @file
 * Contains \Drupal\drupalcampfr_social\Service\TwitterServiceInterface.
 */

namespace Drupal\drupalcampfr_social\Service;

/**
 * Interface TwitterServiceInterface.
 *
 * @package Drupal\drupalcampfr_social
 */
interface TwitterServiceInterface {

  /**
   * Retrieve statuses from Twitter.
   *
   * @param string $path
   *   The path to get the statuses.
   * @param array $options
   *   Options to retrieve statuses.
   *
   * @return array
   *   An array of statuses object.
   *
   * @see: https://twitteroauth.com/
   * @see: https://dev.twitter.com/rest/public
   */
  public function getStatuses($path, array $options);

}
