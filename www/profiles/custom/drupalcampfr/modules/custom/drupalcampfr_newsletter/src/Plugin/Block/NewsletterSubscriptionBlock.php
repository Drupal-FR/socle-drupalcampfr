<?php

/**
 * @file
 * Contains \Drupal\drupalcampfr_newsletter\Plugin\Block\NewsletterSubscriptionBlock.
 */

namespace Drupal\drupalcampfr_newsletter\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'NewsletterSubscriptionBlock' block.
 *
 * @Block(
 *  id = "newsletter_subscription_block",
 *  admin_label = @Translation("Newsletter subscription block"),
 * )
 */
class NewsletterSubscriptionBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = '
      <form role="form" action="//drupalfr.us8.list-manage.com/subscribe/post?u=eb7ebedd32b3b2fc0ac192ee9&amp;id=26bff72b56" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Saisir votre email" name="EMAIL" id="mce-EMAIL">
            <span class="input-group-btn">
              <input value="S\'inscrire" name="subscribe" id="mc-embedded-subscribe" class="btn btn-success form-submit" type="submit">
            </span>
          </div>
          <div class="hidden">
            <input name="b_eb7ebedd32b3b2fc0ac192ee9_450c6dc6d6" tabindex="-1" value="" type="text">
          </div>
        </div>
      </form>';

    $build = array(
      '#markup' => $form,
      '#allowed_tags' => array(
        'form',
        'input',
        'div',
        'h3',
        'label',
        'span',
      ),
    );

    return $build;
  }

}
