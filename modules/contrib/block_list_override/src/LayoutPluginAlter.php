<?php

namespace Drupal\block_list_override;

/**
 * Implementation callbacks for layout builder plugin alter hooks.
 */
class LayoutPluginAlter extends PluginAlter{

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    $settings = $this->configFactory->get('block_list_override.settings');
    $options = [
      'match' => !empty($settings) ? trim($settings->get('layout_match')) : '',
      'prefix' => !empty($settings) ? trim($settings->get('layout_prefix')) : '',
      'regex' => !empty($settings) ? trim($settings->get('layout_regex')) : '',
      'negate' => !empty($settings) ? $settings->get('layout_negate') : 0,
    ];
    $this->listService->setUp($options);
  }

}

