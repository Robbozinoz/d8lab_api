(function ($, Drupal) {

  Drupal.AjaxCommands.prototype.changeWhenReady = function (ajax, response, status) {
    $(document).ready(function () {
      $(response.selector).change();
    });
  }
})(jQuery, Drupal);
