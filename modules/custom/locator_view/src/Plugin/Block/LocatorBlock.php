<?php
namespace Drupal\locator_view\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'Locator' block.
 *
 * @Block(
 *  id = "locator_block",
 *  admin_label = @Translation("Locator block"),
 * )
 */
class LocatorBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['locator_block']['#markup'] = 'Implement Storelocator';

    $form = \Drupal::formBuilder()->getForm('Drupal\locator_view\Form\LocatorForm');

    return $form;
  }
}