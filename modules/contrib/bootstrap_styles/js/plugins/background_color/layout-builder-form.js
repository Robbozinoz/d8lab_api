/**
 * @file
 * Behaviors Background Color plugin layout builder form scripts.
 */

(function ($, _, Drupal, drupalSettings) {
  "use strict";
  
  // Background color.
  Drupal.behaviors.backgroundColorLayoutBuilderForm = {
    attach: function (context) {

      $(".fieldgroup.field-background-color input:radio", context).once('blb_bg-color').each(function () {
        if($(this).val() != '_none') {
          $(this).next('label').addClass($(this).val());

          // Set a contrast class so we can see our checkmarks on light vs. dark backgrounds.s.
          var bgColor = $(this).next('label').css('background-color');
          var bgColorHex = rgb2hex(bgColor);
          var bgColorContrast = getContrast(bgColorHex);
          $(this).next('label').addClass('bs_yiq-' + bgColorContrast);
        }
      });

      $(".fieldgroup.field-background-color .fieldset-wrapper label", context).on('click', function () {
        $(this).parents('.fieldset-wrapper').find('label').removeClass('active');
        $(this).parents('.fieldset-wrapper').addClass('style-selected').find('input').prop("checked", false);
        $(this).parent().find('input').prop('checked', true);

        if($(this).hasClass('_none')) {
          $(this).parents('.fieldset-wrapper').removeClass('style-selected');
        }
      });

      // Custom solution for bootstrap 3 & Bario drupal theme issues.
      $(".fieldgroup.field-background-color .fieldset-wrapper input:radio", context).each(function () {
        $(this).closest('.radio').find('label').addClass($(this).val());
        var checked = $(this).prop("checked");
        if (typeof checked !== typeof undefined && checked !== false) {
          $(this).closest('.radio').find('label').addClass('active');
        }
      });
    }
  };

})(window.jQuery, window._, window.Drupal, window.drupalSettings);
