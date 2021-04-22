<?php
/**
 * @file
 * Contains \Drupal\resume\Form\OriginLocationForm
 */
namespace Drupal\th_store_locator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
// use Drupal\Core\Ajax\AjaxResponse;
// use Drupal\Core\Ajax\HtmlCommand;
// use Drupal\Core\Form\ConfigFormBase;
// use Drupal\Core\Database\Database;
use Drupal\Core\Url;


/**
 * Class th_store_locatorForm.
 *
 * @package Drupal\th_store_locator\Form
 */
class OriginLocationForm extends FormBase {
   /**
   * {@inheritdoc}
   */
    public function getFormId() {
        return 'origin_location_form';
    }

   /**
   * {@inheritdoc}
   */
    public function buildForm(array $form, FormStateInterface $form_state) {
        /**
         * Custom form.
         */
        $form['origin_location'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Milk Finder'),
            '#attributes' => ['placeholder' => $this->t('Suburb/Postcode') ],
            '#prefix' => '<div id="store-locator-form"></div>',
        ];

        $form['actions'] = [
            '#type' => 'actions',
         ];
    
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t(' '),
        ];

        return $form;
    }

   /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        //Get the value from the origin_location form
        $origin_location = $form_state->getValue('origin_location');
        //Strip the value entered
        $origin_location = trim($origin_location);
        $origin_location = str_replace(' ', '+' , $origin_location);
        //Rebuild the url for the view
        $loc = "https://".$_SERVER['SERVER_NAME']."/store-locator?";
        $loc .= "field_geofield_distance[value]=20&field_geofield_distance[source_configuration][origin_address]=". $origin_location ."+AU,Australia&tid[]=16&tid[]=17&tid[]=18";
        ////Variable for the redirect response method
        $url = Url::fromUri(
            $loc, 
            [
              'absolute' => TRUE,
              'attributes' => [
                'target' => '_blank',
              ],
            ]
        )->toString();
        //You need the have Devel module enabled for dpm() to work.
        //Testing dpm($url);
        $response = new RedirectResponse($url);
        $response->send();
    }
}