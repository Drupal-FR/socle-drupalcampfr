<?php

namespace Drupal\bzh_theme\Plugin\Preprocess;

use Drupal\bootstrap\Plugin\Preprocess\PreprocessBase;
use Drupal\bootstrap\Utility\Variables;

/**
 * Implements hook_preprocess_field__field_news_link().
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("field__field_news_link")
 */
class FieldFieldNewsLink extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    // Add classes to link.
    if (isset($variables['items']) && is_array($variables['items'])) {
      foreach ($variables['items'] as $key => $item) {
        $variables['items'][$key]['content']['#options']['attributes'] = [
          'class' => [
            'btn',
            'btn-primary',
          ],
        ];
      }
    }

    parent::preprocessVariables($variables);
  }

}
