<?php

namespace Drupal\geocoder_ajax_prepopulate\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Ajax command to update the coordinates field.
 */
class ChangeWhenReady implements CommandInterface {

  /**
   * The selector.
   *
   * @var string
   */
  protected $selector;

  /**
   * Constructor.
   */
  public function __construct(string $selector) {
    $this->selector = $selector;
  }

  /**
   * {@inheritDoc}
   */
  public function render() {
    return [
      'command' => 'changeWhenReady',
      'selector' => $this->selector,
    ];
  }

}
