<?php

namespace Drupal\drupalcampfr_homepage\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class HomepageController.
 *
 * @package Drupal\drupalcampfr_homepage\Controller
 */
class HomepageController extends ControllerBase {

  /**
   * Index.
   *
   * @return array
   *   Return empty renderable array.
   */
  public function index() {
    return [
      '#type' => 'markup',
      '#markup' => '',
    ];
  }

}
