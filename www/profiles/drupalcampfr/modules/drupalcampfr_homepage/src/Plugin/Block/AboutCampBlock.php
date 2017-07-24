<?php

namespace Drupal\drupalcampfr_homepage\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'About Camp' Block.
 *
 * @Block(
 *   id = "about_camp_block",
 *   admin_label = @Translation("About camp block"),
 * )
 */
class AboutCampBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#theme' => 'drupalcampfr_homepage_about_camp_block',
    );
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