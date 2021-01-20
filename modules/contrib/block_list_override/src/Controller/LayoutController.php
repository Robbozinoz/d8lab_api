<?php

namespace Drupal\block_list_override\Controller;

use Drupal\block_list_override\LayoutPluginAlter;

/**
 * Class DefaultController.
 */
class LayoutController extends DefaultController {

  /**
   * {@inheritdoc}
   */
  protected function getCaption() {
    return $this->t('This page lists block IDs available to the Layout Builder for all contexts.');
  }

  /**
   * {@inheritdoc}
   */
  protected function getList() {
    $definitions = parent::getList();

    $settings = $this->configFactory->get('block_list_override.settings');
    $options = [
      'match' => !empty($settings) ? trim($settings->get('layout_match')) : '',
      'prefix' => !empty($settings) ? trim($settings->get('layout_prefix')) : '',
      'regex' => !empty($settings) ? trim($settings->get('layout_regex')) : '',
      'negate' => !empty($settings) ? $settings->get('layout_negate') : FALSE,
    ];
    $this->listService->setUp($options);

    if ($this->listService->hasSettings()) {
      $callback = [$this->listService, 'blockIsAllowed'];
      $definitions = array_filter($definitions, $callback, ARRAY_FILTER_USE_KEY);
    }
    return $definitions;

  }

}
