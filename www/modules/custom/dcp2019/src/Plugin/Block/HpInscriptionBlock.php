<?php

namespace Drupal\dcp2019\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'HpSliderBlock' block.
 *
 * @Block(
 *  id = "hp_inscription_block",
 *  admin_label = @Translation("Home page - block « Inscription »"),
 * )
 */
class HpInscriptionBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'hp_inscription';

    return $build;
  }

}
