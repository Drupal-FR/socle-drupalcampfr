<?php

namespace Drupal\drupalcampfr_migrate\EventSubscriber;

use Drupal\Core\KeyValueStore\KeyValueFactoryInterface;
use Drupal\entityqueue\Entity\EntitySubqueue;
use Drupal\migrate\Event\MigrateEvents;
use Drupal\migrate\Event\MigrateImportEvent;
use Drupal\migrate\Event\MigratePostRowSaveEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class MigrateEntityqueueSubscriber.
 *
 * @package Drupal\drupalcampfr_migrate
 */
class MigrateEntityqueueSubscriber implements EventSubscriberInterface {

  /**
   * Key value factory service.
   *
   * @var \Drupal\Core\KeyValueStore\KeyValueFactoryInterface
   */
  protected $keyValueFactory;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\KeyValueStore\KeyValueFactoryInterface $key_value_factory
   *   Key value factory service.
   */
  public function __construct(KeyValueFactoryInterface $key_value_factory) {
    $this->keyValueFactory = $key_value_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[MigrateEvents::POST_ROW_SAVE] = ['setItemInEntityqueuePosition'];
    $events[MigrateEvents::POST_IMPORT] = ['setItemInEntityqueue'];

    return $events;
  }

  /**
   * Function to react on migrate.post_row_save event.
   *
   * Keep items positions in a key/value store.
   *
   * @param \Drupal\migrate\Event\MigratePostRowSaveEvent $event
   *   The event.
   */
  public function setItemInEntityqueuePosition(MigratePostRowSaveEvent $event) {
    /** @var \Drupal\migrate\row $row */
    $row = $event->getRow();
    // The unique destination ID, as an array (accommodating multi-column keys),
    // of the item just imported.
    $destination_id_values = $event->getDestinationIdValues();
    $destination_id = array_shift($destination_id_values);

    $entity_subqueue = $row->getSourceProperty('entityqueue');
    if (!empty($entity_subqueue)) {
      $drupalcampfr_migrate_entityqueues = $this->keyValueFactory->get('drupalcampfr_migrate.entityqueues');
      $entity_subqueue_positions = $drupalcampfr_migrate_entityqueues->get($entity_subqueue, []);
      $entity_subqueue_position = $row->getSourceProperty('entityqueue_position');

      // We need to insert element at a specific position.
      if ($entity_subqueue_position == '0' || !empty($entity_subqueue_position)) {
        $already_present_id = FALSE;

        // Check if the position is already taken. If yes, keep already present
        // id to push if later.
        if (isset($entity_subqueue_positions[$entity_subqueue_position])) {
          $already_present_id = $entity_subqueue_positions[$entity_subqueue_position];
        }

        $entity_subqueue_positions[$entity_subqueue_position] = $destination_id;

        if ($already_present_id) {
          array_push($entity_subqueue_positions, $already_present_id);
        }
      }
      // No specific position. Insert at the end.
      else {
        array_push($entity_subqueue_positions, $destination_id);
      }

      $drupalcampfr_migrate_entityqueues->set($entity_subqueue, $entity_subqueue_positions);
    }
  }

  /**
   * Function to react on migrate.post_import event.
   *
   * Add items to entityqueues from key/value store.
   *
   * @param \Drupal\migrate\Event\MigrateImportEvent $event
   *   The event.
   */
  public function setItemInEntityqueue(MigrateImportEvent $event) {
    $drupalcampfr_migrate_entityqueues = $this->keyValueFactory->get('drupalcampfr_migrate.entityqueues');
    $entity_subqueues_positions = $drupalcampfr_migrate_entityqueues->getAll();

    foreach ($entity_subqueues_positions as $entity_queue_id => $entity_subqueue_positions) {
      /** @var \Drupal\entityqueue\Entity\EntitySubqueue $entity_subqueue */
      $entity_subqueue = EntitySubqueue::load($entity_queue_id);

      // Reset the item in the entityqueue.
      $entity_subqueue_items = [];
      // Add the item to the queue.
      foreach ($entity_subqueue_positions as $position => $entity_id) {
        $entity_subqueue_items[$position] = [
          'target_id' => $entity_id,
        ];
      }

      $entity_subqueue->set('items', $entity_subqueue_items);
      $entity_subqueue->save();

      // Remove entry from key/value store.
      $drupalcampfr_migrate_entityqueues->delete($entity_queue_id);
    }
  }

}
