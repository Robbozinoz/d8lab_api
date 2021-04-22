<?php
namespace Drupal\th_store_locator\Plugin\Block;
use Drupal\Core\Block\BlockBase;
//Use only if the block submits directly
//use Drupal\Core\Form\FormStateInterface; 

/**
 * Provides a 'OriginLocation' block.
 *
 * @Block(
 *  id = "origin_location_block",
 *  admin_label = @Translation("Origin Location block"),
 *  category = @Translation("Custom block for the original Stroe Finder function Origin Location block")
 * )
 */
class OriginLocationBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['origin_location_block']['#markup'] = 'Implement Store locator';

    $form = \Drupal::formBuilder()->getForm('Drupal\th_store_locator\Form\OriginLocationForm');

    return $form;
  }
}