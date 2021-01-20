<?php

namespace Drupal\Tests\layout_builder_restrictions\FunctionalJavascript;

use Drupal\Core\Url;
use Drupal\FunctionalJavascriptTests\WebDriverTestBase;

/**
 * Demonstrate that Layout Builder Restrictions works with Layout Library.
 *
 * @group layout_builder_restrictions
 *
 * @requires layout_library
 */
class LayoutLibraryIntegrationTest extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'layout_builder',
    'layout_builder_restrictions',
    'layout_library',
    'field_ui',
    'node',
  ];

  /**
   * Specify the theme to be used in testing.
   *
   * @var string
   */
  protected $defaultTheme = 'stable';

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->drupalCreateContentType(['type' => 'alpha', 'name' => 'Alpha']);

    $this->drupalLogin($this->drupalCreateUser([
      'access administration pages',
      'configure any layout',
      'administer node display',
    ]));
  }

  /**
   * Verify that Layout Builder Restrictions does not break Layout Library.
   */
  public function testLayoutLibraryWithRestrictionsEnabled() {
    $assert_session = $this->assertSession();
    $page = $this->getSession()->getPage();

    $this->drupalGet(Url::fromRoute('entity.layout.add_form'));
    $page->fillField('Label', 'Charlie');
    $this->assertNotEmpty($assert_session->waitForText('Machine name: charlie'));
    $page->selectFieldOption('Entity Type', 'node:alpha');
    $page->pressButton('Save');
    $page->clickLink('Add section');
    $this->assertNotEmpty($assert_session->waitForElementVisible('css', '.layout-selection'));
    $page->clickLink('One column');
    $assert_session->assertWaitOnAjaxRequest();
  }

}
