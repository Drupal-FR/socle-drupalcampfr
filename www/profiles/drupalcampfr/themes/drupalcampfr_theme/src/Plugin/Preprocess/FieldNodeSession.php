<?php

namespace Drupal\drupalcampfr_theme\Plugin\Preprocess;

use Drupal\bootstrap\Plugin\Preprocess\PreprocessBase;
use Drupal\bootstrap\Utility\Variables;
use Drupal\Component\Render\FormattableMarkup;

/**
 * Implements hook_preprocess_field__node__session().
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("field__node__session")
 */
class FieldNodeSession extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    $field_name = $variables->offsetGet('field_name');

    if ($field_name == 'field_session_date_start') {
      // Change field session start date label for display.
      $variables->offsetSet('label', $this->t('Slots'));
    }

    // Add icons on labels.
    $iconised_fields = [
      'field_session_speaker' => 'bullhorn',
      'field_session_level' => 'star',
      'field_session_track' => 'tag',
      'field_session_length' => 'time',
      'field_session_date_start' => 'calendar',
      'field_session_room' => 'map-marker',
    ];

    if (array_key_exists($field_name, $iconised_fields)) {
      $label = $variables->offsetGet('label');
      $iconised_label = new FormattableMarkup('<i class="glyphicon glyphicon-:glyphicon" aria-hidden="true"></i> @label', [
        '@label' => $label,
        ':glyphicon' => $iconised_fields[$field_name],
      ]);

      $variables->offsetSet('label', $iconised_label);
    }

    parent::preprocessVariables($variables);
  }

}
