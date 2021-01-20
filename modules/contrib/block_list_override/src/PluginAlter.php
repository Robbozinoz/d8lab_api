<?php

namespace Drupal\block_list_override;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\block_list_override\BlockListOverride;

/**
 * Implementation callbacks for plugin alter hooks.
 */
class PluginAlter implements ContainerInjectionInterface {

  /**
   * The Config factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The Entity Type Manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * List service.
   *
   * @var \Drupal\block_list_override\BlockListOverride
   */
  protected $listService;

  /**
   * PluginAlter constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   Configuration factory.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The Entity Type Manager service.
   * @param \Drupal\block_list_override\BlockListOverride $list_service
   *   The Block List Override service.
   */
  protected function __construct(
    ConfigFactoryInterface $config_factory,
    EntityTypeManagerInterface $entity_type_manager,
    BlockListOverride $list_service) {
    $this->configFactory = $config_factory;
    $this->entityTypeManager = $entity_type_manager;
    $this->listService = $list_service;
    $this->setUp();
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('entity_type.manager'),
      $container->get('block_list_override.list')
    );
  }

  /**
   * Configure variables based on configuration settings.
   */
  protected function setUp() {
    $settings = $this->configFactory->get('block_list_override.settings');
    $options = [
      'match' => !empty($settings) ? trim($settings->get('system_match')) : '',
      'prefix' => !empty($settings) ? trim($settings->get('system_prefix')) : '',
      'regex' => !empty($settings) ? trim($settings->get('system_regex')) : '',
      'negate' => !empty($settings) ? $settings->get('system_negate') : 0,
    ];
    $this->listService->setUp($options);
  }

  /**
   * Alters block definitions.
   *
   * Speeds up the system performance and the Layout Builder page by removing
   * as many blocks as possible from the system, decreasing the number that it
   * has to parse.
   *
   * @see hook_block_alter()
   * @see hook_plugin_filter_TYPE__CONSUMER_alter()
   */
  public function alterBlocks(&$definitions) {
    if (!$this->listService->hasSettings()) {
      return;
    }
    $callback = [$this->listService, 'blockIsAllowed'];
    $definitions = array_filter($definitions, $callback, ARRAY_FILTER_USE_KEY);
  }

}

