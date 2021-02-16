<?php

namespace Drupal\react_app_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ReactBasicBlock' block.
 *
 * @Block(
 *  id = "react_app_block_block",
 *  admin_label = @Translation("React list block"),
 * )
 */
class ReactAppBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['react_list_block'] = [
      '#markup' => '<div id="list-app"></div>',
      '#attached' => [
        'library' => 'react_app_block/react-list'
      ],
    ];

    return $build;
  }
}