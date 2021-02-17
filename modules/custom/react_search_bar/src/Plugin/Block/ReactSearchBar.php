<?php

namespace Drupal\react_search_bar\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ReactBasicBlock' block.
 *
 * @Block(
 *  id = "react_search_bar",
 *  admin_label = @Translation("React Search bar"),
 * )
 */
class ReactSearchBar extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['react_search_bar_block'] = [
      '#markup' => '<div id="react-search-app"></div>',
      '#attached' => [
        'library' => 'react_search_bar/react-search-bar'
      ],
    ];

    return $build;
  }
}