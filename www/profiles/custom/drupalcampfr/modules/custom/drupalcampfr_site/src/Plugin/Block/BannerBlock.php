<?php

/**
 * @file
 * Contains \Drupal\drupalcampfr_site\Plugin\Block\BannerBlock.
 */

namespace Drupal\drupalcampfr_site\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'BannerBlock' block.
 *
 * @Block(
 *  id = "banner_block",
 *  admin_label = @Translation("Banner block"),
 * )
 */
class BannerBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = array(
      '#theme' => 'drupalcampfr_site_banner_block',
    );

    return $build;
  }

  /**
   * Implements cache contexts.
   *
   * @return array|\string[]
   *   An array of cache contexts.
   */
  public function getCacheContexts() {
    $contexts = parent::getCacheContexts();

    $contexts[] = 'user';

    return $contexts;
  }

}
