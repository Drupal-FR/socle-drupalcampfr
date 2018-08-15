<?php

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
    $build = [
      '#theme' => 'drupalcampfr_site_banner_block',
      '#attached' => [
        'library' => [
          'blazy/blazy',
        ],
      ],
    ];

    return $build;
  }

}
