<?php

namespace Drupal\react_drupal_projects\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ReactBasicBlock' block.
 *
 * @Block(
 *  id = "react_drupal_projects",
 *  admin_label = @Translation("React Project block"),
 * )
 */
class ReactDrupalProjects extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['react_drupal_projects_block'] = [
      '#markup' => '<div id="react-projects-app"></div>',
      '#attached' => [
        'library' => 'react_drupal_projects/react-projects'
      ],
    ];

    return $build;
  }
}