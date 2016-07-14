<?php

namespace Drupal\drupalcampfr_migrate\Plugin\migrate\source;

use Drupal\migrate_source_csv\Plugin\migrate\source\CSV;
use Drupal\migrate\Row;

/**
 * Source plugin for menu link.
 *
 * @MigrateSource(
 *   id = "drupalcampfr_migrate_menu_link_csv"
 * )
 */
class MenuLink extends CSV {

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    if (!parent::prepareRow($row)) {
      return FALSE;
    }

    // Prepare structure of options managed by menu_attributes.
    $menu_attributes_options = array(
      'attributes' => array(
        'title',
        'id',
        'name',
        'rel',
        'class',
        'style',
        'target',
        'accesskey',
      ),
      'item_attributes' => array(
        'id',
        'class',
        'style',
      ),
    );

    $menu_link_options = array();
    foreach ($menu_attributes_options as $options_group_key => $options) {
      $menu_link_options[$options_group_key] = array();
      foreach ($options as $option) {
        $menu_link_options[$options_group_key][$option] = $row->getSourceProperty($options_group_key . '_' . $option);
      }
    }

    $row->setSourceProperty('options', $menu_link_options);

    return TRUE;
  }

}
