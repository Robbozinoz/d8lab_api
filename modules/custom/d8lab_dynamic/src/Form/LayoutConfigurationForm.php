<?php

namespace Drupal\d8lab_dynamic\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for dynamic custom layouts.
 */
class LayoutConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['d8lab_dynamic.settings'];
  }

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'd8lab_dynamic_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['layout_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Layout label'),
      '#size' => 60,
      '#maxlength' => 512,
      '#required' => TRUE,
    ];
    $form['layout_category'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Layout category'),
      '#size' => 60,
      '#maxlength' => 512,
      '#required' => TRUE,
    ];
    $form['number_of_columns'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of columns'),
      '#options' => [
        'two_cols' => $this->t('Two columns'),
        'three_cols' => $this->t('Three columns'),
        'four_cols' => $this->t('Four columns'),
      ],
      '#required' => TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Populating config array.
    $config = $this->config('d8lab_dynamic.settings')->get('layouts');
    if (!isset($config)) {
      $config = [];
    }
    $layout['label'] = $form_state->getValue('layout_label');
    $layout['category'] = $form_state->getValue('layout_cateogry');
    $layout['columns'] = $form_state->getValue('number_of_columns');
    // Convert label into future array key.
    // We use helper method for this to keep code readable.
    $label = $this->toMachineName($form_state->getValue('layout_label'));
    // Making sure we are saving unique layouts even if editors enter the same label.
    $count = count($config);
    $config[$label . '_' . $count] = $layout;
    // Saving config.
    $this->config('d8lab_dynamic.settings')
      ->set('layouts', $config)
      ->save();
    parent::submitForm($form, $form_state);
  }

  /**
   * Helper function to convert label into machine name.
   *
   * @param string $label
   *    Label that needs to be converted.
   *
   * @return string $label
   *    converted label string.
   */
  protected function toMachineName(string $label) {
    $label = strtolower($label);
    $label = preg_replace('/[^a-z0-9]+/i', '_', $label);
    return $label;
  }

}