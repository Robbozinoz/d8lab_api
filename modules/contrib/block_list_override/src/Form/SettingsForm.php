<?php

namespace Drupal\block_list_override\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Class SettingsForm.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * Drupal\Core\Entity\EntityTypeManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new BlockListSettings object.
   */
  public function __construct(ConfigFactoryInterface $config_factory, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($config_factory);
    $this->entityTypeManager = $entity_type_manager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'block_list_override.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'block_list_override_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $description[] = $this->t("Drupal provides an extensive list of blocks, " .
      "many of which you may never use anywhere, and others you won't use " .
      "in Layout Builder. Improve UX and system performance by removing " .
      "blocks that won't be used anywhere on this site from the system list " .
      "or allowing only specific blocks in Layout Builder. Removing blocks " .
      "from the system list can provide performance benefits, but blocks " .
      "removed using the 'System' settings will no longer appear anywhere " .
      "in Drupal, neither in the block configuration for each theme, nor in " .
      "the Layout Builder block list, so you must carefully check that you " .
      "really don't need those blocks. "
      )->__toString();

    $description[] = $this->t("See a list of all remaining blocks in the " .
      "<a href=':url'> System block ID list</a> and the <a href=':url2'> " .
      "Layout Builder block ID list</a> to help you adjust these settings. " .
      "These lists will display the blocks that remain after your changes " .
      "have been applied. Use the lists to identity block IDs " .
      "and figure out which patterns and items you want to remove. The lists " .
      "will be impacted by the settings below, so you can keep checking " .
      "them as you update your settings to see that you have gotten the " .
      "results you intended.", [
        ":url" => "system-list",
        ":url2" => "layout-list",
      ])->__toString();

    $description[] = '<strong> ' . $this->t("Use this feature with care! " .
      "If you remove any blocks currently in use, you will see messages about " .
      "non-existant blocks in places where the blocks should appear."
      )->__toString() . '</strong>';

    $description[] = $this->t("List each name or value on a new line in the " .
      "appropriate section below. You have the option to identify blocks to " .
      "be removed or allowed by name or prefix, or provide a regex for more " .
      "complex matching options."
      )->__toString();

    $items = [];
    $items[] = $this->t("Block ids listed in the 'Match' list will be " .
      "adjusted by looking for an exact match for that id."
      )->__toString();
    $items[] = $this->t("Use the 'Prefix' list to remove or allow all blocks " .
      "that have a specific prefix followed by a colon. For example, " .
      "identifying the prefix 'field_block:user' would remove or allow block " .
      "IDs like 'field_block:user:user:uid' and 'field_block:user:user:" .
      "langcode'."
      )->__toString();
    $items[] = $this->t("The regex list is a place to provide regex strings " .
      "that will be used to determine which blocks to remove or allow. A " .
      "regex like '/field_block:node:(.*):nid/' would remove or allow the " .
      "nid field block for all content types."
      )->__toString();
    $description[] = '<ul><li>' . implode('</li><li>', $items) . '</li></ul>';

    $config = $this->config('block_list_override.settings');

    $form['system'] = [
      '#type' => 'details',
      '#title' => $this->t('System-wide List'),
      '#open' => TRUE,
      '#prefix' => '<p>' . implode('</p><p>', $description) . '</p>',
    ];

    $form['system']['system_negate'] = [
      '#type' => 'radios',
      '#title' => $this->t('Action'),
      '#description' => $this->t('The action to take with the patterns ' .
        'below. Remove blocks that match these patterns from the list OR ' .
        'limit the list to ONLY blocks that match these patterns.'),
      '#default_value' => empty($config->get('system_negate')) ? 0 : $config->get('system_negate'),
      '#options' => [0 => $this->t('Remove'), 1 => $this->t('Allow only')],
    ];

    $form['system']['system_match'] = [
      '#type' => 'textarea',
      '#title' => $this->t('System List Match'),
      '#description' => $this->t('Enter a list of block ids to remove/allow.'),
      '#default_value' => $config->get('system_match'),
    ];
    $form['system']['system_prefix'] = [
      '#type' => 'textarea',
      '#title' => $this->t('System List Prefix'),
      '#description' => $this->t('Enter a list of prefixes to use to ' .
        'identify system blocks to remove/allow.'),
      '#default_value' => $config->get('system_prefix'),
    ];
    $form['system']['system_regex'] = [
      '#type' => 'textarea',
      '#title' => $this->t('System List Regex'),
      '#description' => $this->t('Enter a list of regex strings to use to ' .
        'identify system blocks to remove/allow.'),
      '#default_value' => $config->get('system_regex'),
    ];

    $form['layout'] = [
      '#type' => 'details',
      '#title' => $this->t('Layout Builder List'),
      '#open' => TRUE,
    ];

    $form['layout']['layout_negate'] = [
      '#type' => 'radios',
      '#title' => $this->t('Action'),
      '#description' => $this->t('The action to take with the patterns ' .
        'below. Remove blocks that match these patterns from the list OR ' .
        'limit the list to ONLY blocks that match these patterns.'),
      '#default_value' => empty($config->get('layout_negate')) ? 0 : $config->get('layout_negate'),
      '#options' => [0 => $this->t('Remove'), 1 => $this->t('Allow only')],
    ];

    $form['layout']['layout_match'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Layout Builder List Match'),
      '#description' => $this->t('Enter a list of block ids to remove/allow ' .
        'from the Layout Builder list.'),
      '#default_value' => $config->get('layout_match'),
    ];
    $form['layout']['layout_prefix'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Layout Builder List Prefix'),
      '#description' => $this->t('Enter a list of prefixes to use to ' .
        'identify Layout Builder blocks to remove/allow.'),
      '#default_value' => $config->get('layout_prefix'),
    ];
    $form['layout']['layout_regex'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Layout Builder List Regex'),
      '#description' => $this->t('Enter a list of regex strings to use to ' .
        'identify Layout Builder blocks to remove/allow.'),
      '#default_value' => $config->get('layout_regex'),
    ];

    return parent::buildForm($form, $form_state);
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
    parent::submitForm($form, $form_state);

    $settings = $this->config('block_list_override.settings');
    $settings->set('system_match', $form_state->getValue('system_match'));
    $settings->set('system_prefix', $form_state->getValue('system_prefix'));
    $settings->set('system_regex', $form_state->getValue('system_regex'));
    $settings->set('system_negate', $form_state->getValue('system_negate'));
    $settings->set('layout_match', $form_state->getValue('layout_match'));
    $settings->set('layout_prefix', $form_state->getValue('layout_prefix'));
    $settings->set('layout_regex', $form_state->getValue('layout_regex'));
    $settings->set('layout_negate', $form_state->getValue('layout_negate'));
    $settings->save();

    // Flush caches to be sure the system block list gets updated.
    drupal_flush_all_caches();

  }

}
