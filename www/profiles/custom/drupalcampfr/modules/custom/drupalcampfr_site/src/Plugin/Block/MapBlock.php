<?php

/**
 * @file
 * Contains \Drupal\drupalcampfr_site\Plugin\Block\MapBlock.
 */

namespace Drupal\drupalcampfr_site\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'MapBlock' block.
 *
 * @Block(
 *  id = "map_block",
 *  admin_label = @Translation("Map block"),
 * )
 */
class MapBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    // TODO: Add validation on latitudes and longitudes.
    $form['latitude'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Latitude'),
      '#default_value' => isset($this->configuration['latitude']) ? $this->configuration['latitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_LATITUDE,
      '#required' => TRUE,
    );
    $form['longitude'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Longitude'),
      '#default_value' => isset($this->configuration['longitude']) ? $this->configuration['longitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_LONGITUDE,
      '#required' => TRUE,
    );
    $form['zoom_level'] = array(
      '#type' => 'number',
      '#title' => $this->t('Zoom level'),
      '#default_value' => isset($this->configuration['zoom_level']) ? $this->configuration['zoom_level'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_ZOOM_LEVEL,
      '#required' => TRUE,
    );
    $form['box_bottom_left_latitude'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Box bottom left latitude'),
      '#default_value' => isset($this->configuration['box_bottom_left_latitude']) ? $this->configuration['box_bottom_left_latitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_BOTTOM_LEFT_LATITUDE,
      '#required' => TRUE,
    );
    $form['box_bottom_left_longitude'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Box bottom left longitude'),
      '#default_value' => isset($this->configuration['box_bottom_left_longitude']) ? $this->configuration['box_bottom_left_longitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_BOTTOM_LEFT_LONGITUDE,
      '#required' => TRUE,
    );
    $form['box_top_right_latitude'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Box top right latitude'),
      '#default_value' => isset($this->configuration['box_top_right_latitude']) ? $this->configuration['box_top_right_latitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_TOP_RIGHT_LATITUDE,
      '#required' => TRUE,
    );
    $form['box_top_right_longitude'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Box top right longitude'),
      '#default_value' => isset($this->configuration['box_top_right_longitude']) ? $this->configuration['box_top_right_longitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_TOP_RIGHT_LONGITUDE,
      '#required' => TRUE,
    );
    $form['marker_latitude'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Marker latitude'),
      '#default_value' => isset($this->configuration['marker_latitude']) ? $this->configuration['marker_latitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_MARKER_LATITUDE,
      '#required' => TRUE,
    );
    $form['marker_longitude'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Marker longitude'),
      '#default_value' => isset($this->configuration['marker_longitude']) ? $this->configuration['marker_longitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_MARKER_LONGITUDE,
      '#required' => TRUE,
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['latitude'] = $form_state->getValue('latitude');
    $this->configuration['longitude'] = $form_state->getValue('longitude');
    $this->configuration['zoom_level'] = $form_state->getValue('zoom_level');
    $this->configuration['box_bottom_left_latitude'] = $form_state->getValue('box_bottom_left_latitude');
    $this->configuration['box_bottom_left_longitude'] = $form_state->getValue('box_bottom_left_longitude');
    $this->configuration['box_top_right_latitude'] = $form_state->getValue('box_top_right_latitude');
    $this->configuration['box_top_right_longitude'] = $form_state->getValue('box_top_right_longitude');
    $this->configuration['marker_latitude'] = $form_state->getValue('marker_latitude');
    $this->configuration['marker_longitude'] = $form_state->getValue('marker_longitude');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = array(
      '#theme' => 'drupalcampfr_site_map_block',
      '#latitude' => isset($this->configuration['latitude']) ? $this->configuration['latitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_LATITUDE,
      '#longitude' => isset($this->configuration['longitude']) ? $this->configuration['longitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_LONGITUDE,
      '#zoom_level' => isset($this->configuration['zoom_level']) ? $this->configuration['zoom_level'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_ZOOM_LEVEL,
      '#box_bottom_left_latitude' => isset($this->configuration['box_bottom_left_latitude']) ? $this->configuration['box_bottom_left_latitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_BOTTOM_LEFT_LATITUDE,
      '#box_bottom_left_longitude' => isset($this->configuration['box_bottom_left_longitude']) ? $this->configuration['box_bottom_left_longitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_BOTTOM_LEFT_LONGITUDE,
      '#box_top_right_latitude' => isset($this->configuration['box_top_right_latitude']) ? $this->configuration['box_top_right_latitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_TOP_RIGHT_LATITUDE,
      '#box_top_right_longitude' => isset($this->configuration['box_top_right_longitude']) ? $this->configuration['box_top_right_longitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_TOP_RIGHT_LONGITUDE,
      '#marker_latitude' => isset($this->configuration['marker_latitude']) ? $this->configuration['marker_latitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_MARKER_LATITUDE,
      '#marker_longitude' => isset($this->configuration['marker_longitude']) ? $this->configuration['marker_longitude'] : DRUPALCAMPFR_SITE_DEFAULT_MAP_MARKER_LONGITUDE,
    );

    return $build;
  }

}
