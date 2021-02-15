(function($, Drupal) {
    'use strict';
    Drupal.behaviors.tabs = {
      attach: function (context, settings) {
        let tab = $('.tab-triggers .tab');
        if (tab.length) {
          tab.on('click', function(e){
            e.preventDefault();
            e.stopPropagation();
            $('.tab-content').removeClass('open');
            $('.tab-content').addClass('closed');
            var id = $(this).attr('id');
            $('.' + id).removeClass('closed').addClass('open');
          });
        }
      }
    };
  })(jQuery, Drupal);