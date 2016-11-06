<?php

namespace Drupal\drupalcampfr_theme\Plugin\Preprocess;

use Drupal\bootstrap\Plugin\Preprocess\PreprocessBase;
use Drupal\bootstrap\Utility\Variables;
use Drupal\Component\Render\FormattableMarkup;

/**
 * Implements hook_preprocess_menu__account().
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("menu__account")
 */
class MenuAccount extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    // Add icon on user link.
    if (isset($variables['items']['drupalcampfr_user.account.compte'])) {
      $variables['items']['drupalcampfr_user.account.compte']['title'] = new FormattableMarkup(
        '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> @original_title',
        array(
          '@original_title' => $variables['items']['drupalcampfr_user.account.compte']['title'],
        )
      );
    }

    parent::preprocessVariables($variables);
  }

}
