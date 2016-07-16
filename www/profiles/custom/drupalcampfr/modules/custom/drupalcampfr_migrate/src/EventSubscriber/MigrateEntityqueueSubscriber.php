<?php

namespace Drupal\drupalcampfr_migrate\EventSubscriber;

use Drupal\migrate\Event\MigrateEvents;
use Drupal\migrate\Event\MigratePostRowSaveEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\entityqueue\Entity\EntitySubqueue;

/**
 * Class MigrateEntityqueueSubscriber.
 *
 * @package Drupal\drupalcampfr_migrate
 */
class MigrateEntityqueueSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[MigrateEvents::POST_ROW_SAVE] = ['setItemInEntityqueue'];

    return $events;
  }

  /**
   * Function to react on migrate.post_row_save event.
   *
   * Add items to entityqueues if 'entityqueue' source property is defined.
   *
   * @param \Drupal\migrate\Event\MigratePostRowSaveEvent $event
   *   The event.
   */
  public function setItemInEntityqueue(MigratePostRowSaveEvent $event) {
    /** @var \Drupal\migrate\row $row */
    $row = $event->getRow();
    // The unique destination ID, as an array (accomodating multi-column keys),
    // of the item just imported.
    $destination_id_values = $event->getDestinationIdValues();
    $destination_id = array_shift($destination_id_values);

    $entity_subqueue = $row->getSourceProperty('entityqueue');
    if (!is_null($entity_subqueue)) {
      /** @var EntitySubqueue $entity_subqueue */
      $entity_subqueue = EntitySubqueue::load($entity_subqueue);
      $entity_subqueue_items = $entity_subqueue->get('items')->getValue();
      $entity_subqueue_position = $row->getSourceProperty('entityqueue_position');

      // Add the item to the queue.
      if (!is_null($entity_subqueue_position)) {
        $entity_subqueue_items[$entity_subqueue_position] = array(
          'target_id' => $destination_id,
        );
      }
      else {
        // If no position is defined, add the item at the end of the queue.
        $entity_subqueue_items[] = array('target_id' => $destination_id);
      }

      $entity_subqueue->set('items', $entity_subqueue_items);
      $entity_subqueue->save();
    }
  }

}
