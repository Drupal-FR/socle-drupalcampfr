<?php

namespace Drupal\drupalcampfr_site\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityFormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'ContactFormBlock' block.
 *
 * @Block(
 *  id = "contact_form_block",
 *  admin_label = @Translation("Contact form block"),
 * )
 */
class ContactFormBlock extends BlockBase implements ContainerFactoryPluginInterface {


  /**
   * Constructs a new Block instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityFormBuilderInterface $entityFormBuilder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->entityFormBuilder = $entityFormBuilder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity.form_builder')
    );
  }

  /**
   * The entity form builder.
   *
   * @var \Drupal\Core\Entity\EntityFormBuilderInterface
   */
  protected $entityFormBuilder;

  /**
   * {@inheritdoc}
   */
  public function build() {
    $message = \Drupal::entityTypeManager()
      ->getStorage('contact_message')
      ->create(array(
        'contact_form' => 'contact',
      ));

    $form = $this->entityFormBuilder->getForm($message);
    $form['#attributes']['class'][] = 'col-lg-6';
    $form['#attributes']['class'][] = 'col-lg-offset-3';
    $form['#attributes']['class'][] = 'col-md-8';
    $form['#attributes']['class'][] = 'col-md-offset-2';
    $form['#attributes']['class'][] = 'col-sm-12';

    return $form;
  }

  /**
   * Implements cache contexts.
   *
   * @return array|\string[]
   *   An array of cache contexts.
   */
  public function getCacheContexts() {
    $contexts = parent::getCacheContexts();

    $contexts[] = 'user';

    return $contexts;
  }

}
