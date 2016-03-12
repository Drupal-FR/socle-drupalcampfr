<?php

/**
 * @file
 * Helper class for migration.
 */

namespace Drupal\drupalcampfr_core;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\menu_link_content\Entity\MenuLinkContent;

/**
 * Class FindMenuPluginId.
 *
 * Maps Menu id to Menu plugin id.
 *
 * Taken from https://github.com/drupaldevdays/website
 */
class FindMenuPluginId implements ContainerInjectionInterface {

  /**
   * An entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new FindMenuPluginId.
   *
   * @param EntityTypeManagerInterface $entity_type_manager
   *   An Entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * Find a menu parent ID.
   *
   * @param int $value
   *   Menu id.
   *
   * @return string
   *   Menu plugin id.
   */
  public function find($value) {
    /** @var MenuLinkContent $menu */
    $menu = $this->entityTypeManager->getStorage('menu_link_content')->load($value);
    if ($menu) {
      return $menu->getPluginId();
    }
    else {
      return $value;
    }
  }


}
