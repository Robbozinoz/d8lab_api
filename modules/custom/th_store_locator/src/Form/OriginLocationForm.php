<?php

namespace Drupal\th_store_locator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;


/**
 * Class th_store_locatorForm.
 *
 * @package Drupal\th_store_locator\Form
 */
class OriginLocationForm extends FormBase
{
    /**
   * {@inheritdoc}
   */
    public function getFormId()
    {
        return 'origin_location_form';
    }

    /**
   * {@inheritdoc}
   */

    public function buildForm(array $form, FormStateInterface $form_state)
    {
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

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $origin_location = $form_state->getValue('origin_location');
        // You need the have Devel module enabled for dpm() to work.
        // $origin_location = $form_state['values']['origin_location'];
        $origin_location = trim($origin_location);
        $origin_location = str_replace(' ', '+' , $origin_location);
        // dpm($origin_location);
        $loc = "https://" . $_SERVER['SERVER_NAME'] . "/store-locator?";
        $loc .= "field_geofield_distance[distance]=20&field_geofield_distance[unit]=6371&field_geofield_distance[origin]=" . $origin_location. "&tid[]=16&tid[]=17&tid[]=18";
        //redirect
        dpm("Location: $loc");
        // drupal_goto($loc);
        // return new RedirectResponse(\Drupal::url($loc, [], ['absolute' => TRUE]));
        return new RedirectResponse($loc);
    }
}