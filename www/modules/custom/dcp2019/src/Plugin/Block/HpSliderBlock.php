<?php

namespace Drupal\dcp2019\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'HpSliderBlock' block.
 *
 * @Block(
 *  id = "hp_slider_block",
 *  admin_label = @Translation("Diaporama Homepage"),
 * )
 */
class HpSliderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'hp_slider_block';

    return $build;
  }

}
