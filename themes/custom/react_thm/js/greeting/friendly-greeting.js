(function (Drupal) {
    // If we have a nice user name, let's replace the
    // site name with a greeting.
    if (drupalSettings.friendly.name) {
        var siteName = document.getElementsByClassName('site-branding__name')[0];
        siteName.getElementsByTagName('a')[0].innerHTML = '<h1>Howdy, ' + drupalSettings.friendly.name + '!</h1>';
    }
})(Drupal);