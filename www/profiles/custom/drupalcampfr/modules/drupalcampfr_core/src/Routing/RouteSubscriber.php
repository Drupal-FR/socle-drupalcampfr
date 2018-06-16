<?php

namespace Drupal\drupalcampfr_core\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Alter some routes.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    $route = $collection->get('commerce_cart.page');
    if ($route) {
      $route->setDefault('_title', 'My shopping cart');
    }
  }

}
