<?php

namespace Drupal\bddbs4_layouts\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "bddbs4_layouts_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("bddbs4_layouts")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
