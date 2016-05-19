<?php

namespace Drupal\drupalcampfr_migrate\Plugin\migrate\process;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\migrate\Entity\MigrationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Maps Menu id to Menu plugin id.
 *
 * Taken from https://github.com/drupaldevdays/website.
 *
 * @MigrateProcessPlugin(
 *   id = "drupalcampfr_findmenupluginid"
 * )
 */
class FindMenuPluginId extends ProcessPluginBase implements ContainerFactoryPluginInterface {

  /**
   * An entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration = NULL) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $migration,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    /** @var \Drupal\menu_link_content\Entity\MenuLinkContent $menu */
    $menu = $this->entityTypeManager->getStorage('menu_link_content')->load($value);
    if ($menu) {
      return $menu->getPluginId();
    }
    else {
      return $value;
    }
  }

}
