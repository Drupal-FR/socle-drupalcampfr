<?php

namespace Drupal\drupalcampfr_ticket\EventSubscriber;

use Drupal\state_machine\Event\WorkflowTransitionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Give the role attendee to an order owner when it is placed and has a ticket.
 */
class AssignAttendeeRoleSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    // Use the same event as Commerce do to send a receipt.
    $events = ['commerce_order.place.post_transition' => ['assignAttendeeRole', -100]];
    return $events;
  }

  /**
   * Give the role attendee to an order owner.
   *
   * @param \Drupal\state_machine\Event\WorkflowTransitionEvent $event
   *   The event we subscribed to.
   */
  public function assignAttendeeRole(WorkflowTransitionEvent $event) {
    $attendee = FALSE;
    /** @var \Drupal\commerce_order\Entity\OrderInterface $order */
    $order = $event->getEntity();

    // Check if the order as a ticket.
    $order_items = $order->getItems();
    foreach ($order_items as $order_item) {
      $purchased_entity = $order_item->getPurchasedEntity();
      if ($purchased_entity->bundle() == 'ticket') {
        $attendee = TRUE;
        break;
      }
    }

    // Assign attendee role.
    if ($attendee) {
      $customer = $order->getCustomer();
      $customer->addRole('attendee');
      $customer->save();
    }
  }

}
