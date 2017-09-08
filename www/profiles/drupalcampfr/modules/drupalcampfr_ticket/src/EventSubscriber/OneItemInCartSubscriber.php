<?php

namespace Drupal\drupalcampfr_ticket\EventSubscriber;

use Drupal\commerce_cart\Event\CartEntityAddEvent;
use Drupal\commerce_cart\Event\CartEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class OneItemInCartSubscriber.
 */
class OneItemInCartSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = [
      CartEvents::CART_ENTITY_ADD => ['onProductAdded', 900],
    ];
    return $events;
  }

  /**
   * Sets quantity to 1, and sends to checkout process.
   *
   * @param \Drupal\commerce_cart\Event\CartEntityAddEvent $event
   *   The cart event.
   */
  public function onProductAdded(CartEntityAddEvent $event) {
    // We only want 1 quantity.
    $cart = $event->getCart();
    $purchased_entity_id = $event->getEntity()->id();

    $cart_items = $cart->getItems();
    foreach ($cart_items as $cart_item) {
      $cart_purchased_entity_id = $cart_item->getPurchasedEntity()->id();
      if ($cart_purchased_entity_id != $purchased_entity_id) {
        $cart->removeItem($cart_item);
      }
    }

    $quantity = $cart_items[0]->getQuantity();
    if ($quantity > 1) {
      $cart_items[0]->setQuantity(1);
    }

    // If this order was re-used, make sure that we wipe clear the checkout
    // information.
    if (!$cart->get('checkout_flow')->isEmpty()) {
      $cart->get('checkout_flow')->setValue(NULL);
      $cart->get('checkout_step')->setValue(NULL);
    }

    $cart->save();
  }

}
