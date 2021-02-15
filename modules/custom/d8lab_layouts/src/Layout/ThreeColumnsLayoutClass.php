<?php

namespace Drupal\d8lab_layouts\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Alternate class for the custom three column elements layout.
 */

 class ThreeColumnsLayoutClass extends LayoutDefault implements PluginFormInterface {

    /**
    * {@inheritdoc}
    */
    public function defaultConfiguration() {
        return parent::defaultConfiguration() + [
            'column_width' => 'equal_columns',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state)
    {
        $form = parent::buildConfigurationForm($form, $form_state);
        $configuration = $this->getConfiguration();
        $form['column_width'] = [
            '#type' => 'select',
            '#title' => $this->t('Choose column width'),
            '#options' => [
                'equal_columns' => $this->t('Equal columns'),
                '25_50_25' => $this->t('25%-50%-25%'),
                '50_25_25' => $this->t('50%-25%-25%'),
            ],
            '#default_value' => $configuration['column_width'],
        ];
        return $form;
    }

    /**
     *  {@inheritdoc}
     */
    public function submitConfigurationForm(array &$form, FormStateInterface $form_state)
    {
        $this->configuration['column_width'] = $form_state->getValue('column_width');
        parent::submitConfigurationForm($form, $form_state);
    }
 }