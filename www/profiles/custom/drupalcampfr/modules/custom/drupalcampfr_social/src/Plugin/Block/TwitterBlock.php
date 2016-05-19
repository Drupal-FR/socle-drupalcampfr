<?php

namespace Drupal\drupalcampfr_social\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\drupalcampfr_social\Service\TwitterServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'TwitterBlock' block.
 *
 * @Block(
 *  id = "twitter_block",
 *  admin_label = @Translation("Twitter block"),
 * )
 */
class TwitterBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * A twitter service.
   *
   * @var TwitterServiceInterface
   */
  protected $twitterService;

  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\drupalcampfr_social\Service\TwitterServiceInterface $twitter_service
   *   A twitter service.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        TwitterServiceInterface $twitter_service
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->twitterService = $twitter_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('drupalcampfr_social.twitter')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $statuses = $this->twitterService->getStatuses('statuses/user_timeline', [
      'count' => 3,
      'exclude_replies' => FALSE,
    ]);

    $build = [];
    if (!empty($statuses)) {
      $build['twitter_block'] = array(
        '#theme' => 'drupalcampfr_social_twitter_statuses',
        '#statuses' => $statuses,
        '#cache' => array(
          // 15 minutes.
          'max-age' => '900',
        ),
      );
    }

    return $build;
  }

}
