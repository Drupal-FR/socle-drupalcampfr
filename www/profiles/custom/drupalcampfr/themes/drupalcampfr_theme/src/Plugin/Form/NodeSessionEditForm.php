<?php

namespace Drupal\drupalcampfr_theme\Plugin\Form;

use Drupal\bootstrap\Plugin\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @ingroup plugins_form
 *
 * @BootstrapForm("node_session_edit_form")
 */
class NodeSessionEditForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function alterForm(array &$form, FormStateInterface $form_state, $form_id = NULL) {
    parent::alterForm($form, $form_state, $form_id);

    // Add classes for delete link.
    if (isset($form['actions']['delete'])) {
      $form['actions']['delete']['#attributes']['class'][] = 'btn';
      $form['actions']['delete']['#attributes']['class'][] = 'btn-danger';
    }
  }

}
