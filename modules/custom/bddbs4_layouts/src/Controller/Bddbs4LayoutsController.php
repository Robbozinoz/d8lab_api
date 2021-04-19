<?php

namespace Drupal\bddbs4_layouts\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for bddbs4_layouts routes.
 */
class Bddbs4LayoutsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
