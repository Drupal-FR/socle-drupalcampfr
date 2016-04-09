<?php

/**
 * @file
 * Contains \Drupal\drupalcampfr_newsletter\Plugin\Block\NewsletterSubscriptionBlock.
 */

namespace Drupal\drupalcampfr_newsletter\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

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
  public function blockForm($form, FormStateInterface $form_state) {
    $form['account_hash'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Account hash'),
      '#description' => $this->t('Mailchimp account hash.'),
      '#default_value' => isset($this->configuration['account_hash']) ? $this->configuration['account_hash'] : DRUPALCAMPFR_NEWSLETTER_DEFAULT_ACCOUNT_HASH,
      '#required' => TRUE,
    );
    $form['mailing_list_hash'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Mailing list hash'),
      '#description' => $this->t('Mailchimp mailing list hash.'),
      '#default_value' => isset($this->configuration['mailing_list_hash']) ? $this->configuration['mailing_list_hash'] : DRUPALCAMPFR_NEWSLETTER_DEFAULT_MAILING_LIST_HASH,
      '#required' => TRUE,
    );
    $form['anti_spam_token'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Anti-spam token'),
      '#description' => $this->t('Mailchimp anti-spam token'),
      '#default_value' => isset($this->configuration['anti_spam_token']) ? $this->configuration['anti_spam_token'] : DRUPALCAMPFR_NEWSLETTER_DEFAULT_ANTI_SPAM_TOKEN,
      '#required' => TRUE,
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['account_hash'] = $form_state->getValue('account_hash');
    $this->configuration['mailing_list_hash'] = $form_state->getValue('mailing_list_hash');
    $this->configuration['anti_spam_token'] = $form_state->getValue('anti_spam_token');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $build = array(
      '#theme' => 'drupalcampfr_newsletter_subscription_block',
      '#account_hash' => isset($this->configuration['account_hash']) ? $this->configuration['account_hash'] : DRUPALCAMPFR_NEWSLETTER_DEFAULT_ACCOUNT_HASH,
      '#mailing_list_hash' => isset($this->configuration['mailing_list_hash']) ? $this->configuration['mailing_list_hash'] : DRUPALCAMPFR_NEWSLETTER_DEFAULT_MAILING_LIST_HASH,
      '#anti_spam_token' => isset($this->configuration['anti_spam_token']) ? $this->configuration['anti_spam_token'] : DRUPALCAMPFR_NEWSLETTER_DEFAULT_ANTI_SPAM_TOKEN,
    );

    return $build;
  }

}
