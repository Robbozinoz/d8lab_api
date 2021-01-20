<?php

namespace Drupal\bootstrap_styles\Plugin\BootstrapStyles\Style;

use Drupal\bootstrap_styles\Style\StylePluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class BackgroundColor.
 *
 * @package Drupal\bootstrap_styles\Plugin\Style
 *
 * @Style(
 *   id = "background_color",
 *   title = @Translation("Background Color"),
 *   group_id = "background",
 *   weight = 1
 * )
 */
class BackgroundColor extends StylePluginBase {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $config = $this->config();

    $form['background']['background_colors'] = [
      '#type' => 'textarea',
      '#default_value' => $config->get('background_colors'),
      '#title' => $this->t('Background colors (classes)'),
      '#description' => $this->t('<p>Enter one value per line, in the format <b>key|label</b> where <em>key</em> is the CSS class name (without the .), and <em>label</em> is the human readable name of the background.</p>'),
      '#cols' => 60,
      '#rows' => 5,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->config()
      ->set('background_colors', $form_state->getValue('background_colors'))
      ->save();
  }

  /**
   * {@inheritdoc}
   */
  public function buildStyleFormElements(array &$form, FormStateInterface $form_state, $storage) {
    $icon_path = drupal_get_path('module', 'bootstrap_styles') . '/images/';
    $form['background_type']['#options']['color'] = $this->getSvgIconMarkup($icon_path . 'plugins/background/background-color.svg');
    $form['background_type']['#default_value'] = $storage['background']['background_type'] ?? 'color';

    $form['background_color'] = [
      '#type' => 'radios',
      '#options' => $this->getStyleOptions('background_colors'),
      '#title' => $this->t('Background color'),
      '#default_value' => $storage['background_color']['class'] ?? NULL,
      '#validated' => TRUE,
      '#attributes' => [
        'class' => ['field-background-color', 'bs_input-circles', 'with-selected-gradient'],
      ],
      '#states' => [
        'visible' => [
          ':input.bs_background--type' => ['value' => 'color'],
        ],
      ],
    ];

    // Attach the Layout Builder form style for this plugin.
    $form['#attached']['library'][] = 'bootstrap_styles/plugin.background_color.layout_builder_form';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitStyleFormElements(array $group_elements) {
    return [
      'background_color' => [
        'class' => $group_elements['background_color'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build(array $build, array $storage, $theme_wrapper = NULL) {
    $classes = [];
    // Backwards compatibility for layouts created on the 1.x version.
    $background_type = $storage['background']['background_type'] ?? 'color';

    if ($background_type != 'video') {
      $classes[] = $storage['background_color']['class'];
      // Add the classes to the build.
      $build = $this->addClassesToBuild($build, $classes, $theme_wrapper);
    }

    // Attach bs-classes to the build.
    $build['#attached']['library'][] = 'bootstrap_styles/plugin.background_color.build';

    return $build;
  }

}
