(function ($, Drupal) {
  'use strict';

  // //////////////////////////////////////////////////////////////////////////////
  // [ STORE LOCATOR DIRECTION BUTTON ]
  $(() => {
    let addrHnd='';

    let processStr = (str,link) => {
    //function processStr(str,link) {
        str = str.trim(str);
        str = str.replace(/ /gi,"+");
        if (link=="") {
          link = str;
        }
        else{
          link += "+" + str;
        }
        return link;
    }

    $('.view-duplicate-of-milk-finder-th-locator .views-field-field-milk-address').each(function(){
       addrHnd = $(this);
       console.log(this);
       let link="";
       link = processStr(addrHnd.find('.address-line1').text(),link);
       link = processStr(addrHnd.find('.premise').text(),link);
       link = processStr(addrHnd.find('.locality').text(),link);
       link = processStr(', '+addrHnd.find('.administrative-area').text(),link);
       link = processStr(', '+addrHnd.find('.postal-code').text(),link);
       link = processStr(', '+addrHnd.find('.country').text(),link);
       
       link = "http://maps.google.com/?q=" + link;
       addrHnd.append("<a target='_blank' class='btn btn-info get_dir' href=" + link + ">Directions</a>");
    });
  });

  // //////////////////////////////////////////////////////////////////////////////
  // [ DROPDOWN LANGUAGE MENU MOBILE ]
  $(() => {
    if (window.matchMedia('(max-width: 768px)').matches) {
      $('#language-selector').addClass('dropup');
    }
    else {
      $('#language-selector').removeClass('dropup');
    }
  });

  // //////////////////////////////////////////////////////////////////////////////
  // [ DESKTOP MENU - SEARCH TOGGLE ]
  $('#menu-main').on('click', '.form-actions', function (e) {
    $('#menu-main')
      .toggleClass('show-search')
      .find('.form-search')
      .focus();
    $(this).toggleClass('active');
    e.preventDefault();
  });

  // //////////////////////////////////////////////////////////////////////////////
  // [ ANCHOR OFFSET ]
  $(() => {
    const target = window.location.hash;
    // only try to scroll to offset if target has been set in location hash

    if (target !== '') {
      const $target = jQuery(target);
      jQuery('html, body')
        .stop()
        .animate(
        {
          scrollTop: $target.offset().top - 150
        }, // set offset value here i.e. 50
          100,
          'swing',
          () => {
            window.location.hash = target - 80;
          }
        );
    }
  });

  // //////////////////////////////////////////////////////////////////////////////
  // [ MOBILE NAV - SMOOTH OPENING/CLOSING SUBMENU ]
  if (window.matchMedia('(max-width: 768px)').matches) {
    let open = $('#menu-main .dropdown-toggle');
    let a = $('#menu-main .nav').find('.dropdown-toggle');

    open.click(function (e) {
      e.preventDefault();
      let $this = $(this);
      let speed = 250;
      if ($this.hasClass('active-menu') === true) {
        $this
          .removeClass('active-menu')
          .next('.dropdown-menu')
          .slideUp(speed);
      }
      else if (a.hasClass('active-menu') === false) {
        $this
          .addClass('active-menu')
          .next('.dropdown-menu')
          .slideDown(speed);
      }
      else {
        a.removeClass('active-menu')
          .next('.dropdown-menu')
          .slideUp(speed);
        $this
          .addClass('active-menu')
          .next('.dropdown-menu')
          .delay(speed)
          .slideDown(speed);
      }
    });
  }
  // //////////////////////////////////////////////////////////////////////////////
  // [ BOOTSTRAP COMPONENTS ]

  // [ TOOLTIP ]
  $(() => {
    $('[data-toggle="tooltip"]').tooltip({
      delay: {
        show: 100,
        hide: 250
      }
    });
  });

  // [ POPOVERS ]
  $(() => {
    $('[data-toggle="popover"]').popover();
  });

  // [ CAROUSEL ]
  $(() => {
    $('.carousel').carousel({
      interval: 2000
    });
  });

  // [ MODAL ]
  $(() => {
    $('#bs-modal').on('shown.bs.modal', () => {
      $('#bs-modal-button').trigger('focus');
    });
  });

  // //////////////////////////////////////////////////////////////////////////////
  // [ DESKTOP MENU - SEARCH TOGGLE ]
  $('#menu-main').on('click', '.form-actions', function (e) {
    $('#menu-main')
      .toggleClass('show-search')
      .find('.form-search')
      .focus();
    $(this).toggleClass('active');
    e.preventDefault();
  });

  // //////////////////////////////////////////////////////////////////////////////
  // [ HIDE / SHOW IMAGE LOGO ON SCROOL ]
  $(() => {
    const logo = $('#header-menu .navbar-brand');
    $(window).scroll(() => {
      const scroll = $(window).scrollTop();

      if (scroll >= 85) {
        if (!logo.hasClass('show-logo')) {
          logo.removeClass('hide-logo').addClass('show-logo');
        }
      }
      else if (!logo.hasClass('hide-logo')) {
        logo.removeClass('show-logo').addClass('hide-logo');
      }
    });
  });
})(jQuery, Drupal);