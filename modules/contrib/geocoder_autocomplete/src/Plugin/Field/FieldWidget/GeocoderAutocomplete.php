<?php

namespace Drupal\geocoder_autocomplete\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\StringTextfieldWidget;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements geocoder_autocomplete widget on 'string' fields.
 *
 * @FieldWidget(
 *  id = "geocoder_autocomplete",
 *  label = @Translation("Geocoder text field with autocomplete"),
 *  field_types = {"string"}
 * )
 */
class GeocoderAutocomplete extends StringTextfieldWidget {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'size' => '60',
      'autocomplete_route_name' => 'geocoder_autocomplete.autocomplete',
      'placeholder' => t('Digit a place'),
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $main_widget = parent::formElement($items, $delta, $element, $form, $form_state);
    $element['value'] = $main_widget['value'];

    if (\Drupal::currentUser()->hasPermission('access geocoder autocomplete')) {
      $element['value'] = $element['value'] + array(
        '#size' => $this->getSetting('size'),
        '#autocomplete_route_name' => $this->getSetting('autocomplete_route_name'),
        '#autocomplete_route_parameters' => array(),
        '#placeholder' => $this->getSetting('placeholder'),
        '#maxlength' => 255,
        '#element_validate' => array(array(get_class($this), 'validateFormElement')),
      );
    }

    return $element;
  }

  /**
   * Form element validate handler.
   *
   * @param array $element
   *   The form element to validate.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function validateFormElement($element, FormStateInterface $form_state) {
    if ($geocoded_address = $element['#value']) {
      $geocoded_address_cleaned = trim($geocoded_address, '"');
      $form_state->setValueForElement($element, $geocoded_address_cleaned);
    }
  }

}
