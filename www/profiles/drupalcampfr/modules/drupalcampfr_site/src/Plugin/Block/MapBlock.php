<?php

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
    $form['latitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Latitude'),
      '#default_value' => $this->configuration['latitude'],
      '#required' => TRUE,
    ];
    $form['longitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Longitude'),
      '#default_value' => $this->configuration['longitude'],
      '#required' => TRUE,
    ];
    $form['zoom_level'] = [
      '#type' => 'number',
      '#title' => $this->t('Zoom level'),
      '#default_value' => $this->configuration['zoom_level'],
      '#required' => TRUE,
    ];
    $form['box_bottom_left_latitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Box bottom left latitude'),
      '#default_value' => $this->configuration['box_bottom_left_latitude'],
      '#required' => TRUE,
    ];
    $form['box_bottom_left_longitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Box bottom left longitude'),
      '#default_value' => $this->configuration['box_bottom_left_longitude'],
      '#required' => TRUE,
    ];
    $form['box_top_right_latitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Box top right latitude'),
      '#default_value' => $this->configuration['box_top_right_latitude'],
      '#required' => TRUE,
    ];
    $form['box_top_right_longitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Box top right longitude'),
      '#default_value' => $this->configuration['box_top_right_longitude'],
      '#required' => TRUE,
    ];
    $form['marker_latitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Marker latitude'),
      '#default_value' => $this->configuration['marker_latitude'],
      '#required' => TRUE,
    ];
    $form['marker_longitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Marker longitude'),
      '#default_value' => $this->configuration['marker_longitude'],
      '#required' => TRUE,
    ];

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
    $build = [
      '#theme' => 'drupalcampfr_site_map_block',
      '#latitude' => $this->configuration['latitude'],
      '#longitude' => $this->configuration['longitude'],
      '#zoom_level' => $this->configuration['zoom_level'],
      '#box_bottom_left_latitude' => $this->configuration['box_bottom_left_latitude'],
      '#box_bottom_left_longitude' => $this->configuration['box_bottom_left_longitude'],
      '#box_top_right_latitude' => $this->configuration['box_top_right_latitude'],
      '#box_top_right_longitude' => $this->configuration['box_top_right_longitude'],
      '#marker_latitude' => $this->configuration['marker_latitude'],
      '#marker_longitude' => $this->configuration['marker_longitude'],
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'latitude' => DRUPALCAMPFR_SITE_DEFAULT_MAP_LATITUDE,
      'longitude' => DRUPALCAMPFR_SITE_DEFAULT_MAP_LONGITUDE,
      'zoom_level' => DRUPALCAMPFR_SITE_DEFAULT_MAP_ZOOM_LEVEL,
      'box_bottom_left_latitude' => DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_BOTTOM_LEFT_LATITUDE,
      'box_bottom_left_longitude' => DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_BOTTOM_LEFT_LONGITUDE,
      'box_top_right_latitude' => DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_TOP_RIGHT_LATITUDE,
      'box_top_right_longitude' => DRUPALCAMPFR_SITE_DEFAULT_MAP_BOX_TOP_RIGHT_LONGITUDE,
      'marker_latitude' => DRUPALCAMPFR_SITE_DEFAULT_MAP_MARKER_LATITUDE,
      'marker_longitude' => DRUPALCAMPFR_SITE_DEFAULT_MAP_MARKER_LONGITUDE,
    ];
  }

}
