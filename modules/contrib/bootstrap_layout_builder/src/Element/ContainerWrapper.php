<?php

namespace Drupal\bootstrap_layout_builder\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * Provides a container wapper render element.
 *
 * @RenderElement("blb_container_wrapper")
 */
class ContainerWrapper extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      '#theme' => 'blb_container_wrapper',
      '#attributes' => [],
      '#children' => [],
    ];
  }

}
