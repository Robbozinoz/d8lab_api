<?php
namespace Drupal\th_store_locator\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'OriginLocation' block.
 *
 * @Block(
 *  id = "origin_location_block",
 *  admin_label = @Translation("Origin Location block"),
 * )
 */
class OriginLocationBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['store_locator_block']['#markup'] = 'Implement Storelocator';

    $form = \Drupal::formBuilder()->getForm('Drupal\th_store_locator\Form\OriginLocationForm');

    return $form;
  }
}