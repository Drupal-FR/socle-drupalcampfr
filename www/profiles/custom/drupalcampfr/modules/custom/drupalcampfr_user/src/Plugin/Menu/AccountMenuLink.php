<?php

namespace Drupal\drupalcampfr_user\Plugin\Menu;

/**
 * A menu link that shows "Account" to the appropriated path.
 */
class AccountMenuLink extends MyAccountCreateAccountMenuLink {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->t('Compte');
  }

}
