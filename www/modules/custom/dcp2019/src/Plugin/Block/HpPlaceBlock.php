<?php

namespace Drupal\dcp2019\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'HpSliderBlock' block.
 *
 * @Block(
 *  id = "hp_place_block",
 *  admin_label = @Translation("Home page - block « le lieu »"),
 * )
 */
class HpPlaceBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'hp_place';

    return $build;
  }

}
