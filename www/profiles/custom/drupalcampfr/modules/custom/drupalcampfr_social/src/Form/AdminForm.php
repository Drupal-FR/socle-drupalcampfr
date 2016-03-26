<?php

/**
 * @file
 * Contains Drupal\drupalcampfr_social\Form\AdminForm.
 */

namespace Drupal\drupalcampfr_social\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AdminForm.
 *
 * @package Drupal\drupalcampfr_social\Form
 */
class AdminForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'drupalcampfr_social.twitter',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admin_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $twitter = $this->config('drupalcampfr_social.twitter');

    $form['twitter'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Twitter'),
      '#description' => $this->t('These values are defined in the settings.php file.'),
    );

    $form['twitter']['consumer_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Consumer key'),
      '#size' => 64,
      '#default_value' => $twitter->get('consumer_key'),
      '#disabled' => TRUE,
    ];
    $form['twitter']['consumer_secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Consumer secret'),
      '#size' => 64,
      '#default_value' => $twitter->get('consumer_secret'),
      '#disabled' => TRUE,
    ];
    $form['twitter']['access_token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Access token'),
      '#size' => 64,
      '#default_value' => $twitter->get('access_token'),
      '#disabled' => TRUE,
    ];
    $form['twitter']['access_token_secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Access token secret'),
      '#size' => 64,
      '#default_value' => $twitter->get('access_token_secret'),
      '#disabled' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('drupalcampfr_social.twitter')
      ->set('consumer_key', $form_state->getValue('consumer_key'))
      ->set('consumer_secret', $form_state->getValue('consumer_secret'))
      ->set('access_token', $form_state->getValue('access_token'))
      ->set('access_token_secret', $form_state->getValue('access_token_secret'))
      ->save();
  }

}
