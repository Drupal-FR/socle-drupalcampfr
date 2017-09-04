<?php

namespace Drupal\drupalcampfr_ticket\EventSubscriber;

use Drupal\commerce_cart\Event\CartEntityAddEvent;
use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Redirect to the cart once a product has been added to the cart.
 */
class RedirectToCartSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = ['commerce_cart.entity.add' => 'redirectToCart'];
    return $events;
  }

  /**
   * Redirect to the cart.
   *
   * @param \Drupal\commerce_cart\Event\CartEntityAddEvent $event
   *   The event we subscribed to.
   */
  public function redirectToCart(CartEntityAddEvent $event) {
    $response = new RedirectResponse(Url::fromRoute('commerce_cart.page')->toString());
    $response->send();
  }

}
