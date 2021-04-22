<?php

namespace Drupal\locator_view\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LocatorForm.
 */
class LocatorForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'locator_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $default_value = '';

    // prepare default_values
    foreach ($_GET AS $key => $value) {
      if (is_array($value)) {
        $default_value = [];
        
        foreach ($value AS $k => $v) {
          $default_value[$key][] = $v;
        }
      }
      else if (is_string($value)) {
        $default_value[$key] = $value;
      }
    }

    $form['string'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Milk Finder'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
      // '#default_value' => isset($default_value['string']) ? $default_value['string'] : ''
    ];

    // prepare tags options
    $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties(['vid' => 'tags']);
    foreach ($terms AS $term) {
      $options[$term->id()] = $term->getName();
    }

    $locations = \Drupal::entityTypeManager()->getStorage('node__field_milk_address')->load(['field_milk_address_locality']);
    foreach ($locations AS $location) {
      $options[$location->id()] = $location->getName();
    }

    $form['tags'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Tags'),
      '#options' => $options,
      '#default_value' => isset($default_value['tags']) ? $default_value['tags'] : ''
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $values = $form_state->getValues();
    $params = [];

    foreach ($values as $key => $value) {

      if (is_array($value) && $key == 'tags') {
        foreach ($value AS $k => $v) {
          if ($v) {
            $params[$key.'['.$v.']'] = $v;
          }
        }
      }
      else if ($key == 'string') {
        $params[$key] = $value;
      }
    }

    $url_options = [
      'query' => [
        $params
      ]
    ];

    $form_state->setRedirect('locator_view.locator_controller_content', [], $url_options);

  }

}
