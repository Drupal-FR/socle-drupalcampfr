
(function ($, Drupal) {

  'use strict';

  //REV SLIDER
  jQuery('.tp-banner').show().revolution(
    {
      dottedOverlay: "none",
      delay: 9000,
      startwidth: 1170,
      startheight: 700,
      hideThumbs: 200,

      thumbWidth: 100,
      thumbHeight: 50,
      thumbAmount: 5,

      navigationType: "none",
      navigationArrows: "solo",
      navigationStyle: "preview1",

      touchenabled: "on",
      onHoverStop: "on",

      swipe_velocity: 0.7,
      swipe_min_touches: 1,
      swipe_max_touches: 1,
      drag_block_vertical: false,


      keyboardNavigation: "on",

      navigationHAlign: "center",
      navigationVAlign: "bottom",
      navigationHOffset: 0,
      navigationVOffset: 20,

      soloArrowLeftHalign: "left",
      soloArrowLeftValign: "center",
      soloArrowLeftHOffset: 20,
      soloArrowLeftVOffset: 0,

      soloArrowRightHalign: "right",
      soloArrowRightValign: "center",
      soloArrowRightHOffset: 20,
      soloArrowRightVOffset: 0,

      shadow: 0,
      fullWidth: "off",
      fullScreen: "on",

      spinner: "spinner0",

      stopLoop: "off",
      stopAfterLoops: -1,
      stopAtSlide: -1,

      shuffle: "off",


      forceFullWidth: "off",
      fullScreenAlignForce: "off",
      minFullScreenHeight: "400",

      hideThumbsOnMobile: "off",
      hideNavDelayOnMobile: 1500,
      hideBulletsOnMobile: "off",
      hideArrowsOnMobile: "off",
      hideThumbsUnderResolution: 0,

      hideSliderAtLimit: 0,
      hideCaptionAtLimit: 0,
      hideAllCaptionAtLilmit: 0,
      startWithSlide: 0,
      fullScreenOffsetContainer: ".header"
    });

  //COUNTDOWN TIMER
  var newYear = new Date();
  newYear = new Date(newYear.getFullYear() + 1, 1 - 1, 1);
  $('#countdown').countdown({until: new Date(2019, 2 - 1, 15)}); // enter event day

  $('#removeCountdown').toggle(
    function () {
      $(this).text('Re-attach');
      $('#defaultCountdown').countdown('destroy');
    },
    function () {
      $(this).text('Remove');
      $('#defaultCountdown').countdown({until: newYear});
    }
  );


  //MAGNIFIC POPUP LOAD CONTENT VIA AJAX
  $('.html-popup').magnificPopup({type: 'ajax'});

  //MAGNIFIC POPUP IMAGE
  $('.image-popup').magnificPopup({
    type: 'image',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
    },

  });

  //LOAD MORE
  $('#list-speaker li:lt(4)').show();

  $('#loadmore').on("click", function () {
    $('#list-speaker li:lt(8)').fadeIn();
    $('#list-speaker li:lt(8)').show();
  });

  //FAQ TOGGLE
  $('.faqs dd').hide();
  $('.faqs dt').on({
    click: function () {
      $(this).next().slideToggle('normal');
    },
    mouseenter: function () {
      $(this).addClass('hover');
    },
    mouseleave: function () {
      $(this).removeClass('hover');
    }
  });

  //OWLCAROUSEL HOTEL CAROUSEL
  var owl = $("#hotel-carousel");

  owl.owlCarousel({
    autoPlay: false,
    itemsCustom: [[0, 1], [450, 1], [600, 3], [700, 3], [1000, 3], [1200, 3], [1600, 3]],
    pagination: false,
    navigation: true,
    navigationText: ['<i class="pe-4x pe-7s-angle-left pe-border"></i>', '<i class="pe-4x  pe-7s-angle-right pe-border"></i>'],
  });

  //OWLCAROUSEL FUNFACT CAROUSEL
  var owl = $("#funfacts-carousel");

  owl.owlCarousel({
    itemsCustom: [
      [0, 1],
      [450, 1],
      [600, 2],
      [700, 4],
      [1000, 4],
      [1200, 4],
      [1600, 4]
    ],
    navigation: false,
    navigationText: ['<i class="pe-4x pe-7s-angle-left pe-border"></i>', '<i class="pe-4x  pe-7s-angle-right pe-border"></i>'],
  });

  //OWLCAROUSEL PRICE TABLE CAROUSEL
  var owl = $("#price-carousel");

  owl.owlCarousel({
    itemsCustom: [
      [0, 1],
      [450, 1],
      [600, 2],
      [700, 3],
      [1000, 3],
      [1200, 3],
    ],
    pagination: false,
    navigation: true,
    navigationText: ['<i class="pe-4x pe-7s-angle-left pe-border"></i>', '<i class="pe-4x  pe-7s-angle-right pe-border"></i>'],
  });

  //OWLCAROUSEL TESTIMONIAL CAROUSEL
  var owl = $("#testimonial-carousel");

  owl.owlCarousel({
    navigation: false, // Show next and prev buttons
    slideSpeed: 300,
    paginationSpeed: 400,
    singleItem: true,
    transitionStyle: "fade"
  });

  //OWLCAROUSEL SPONSORS CAROUSEL
  var owl = $("#sponsors-carousel");

  owl.owlCarousel({

    autoPlay: false,
    itemsCustom: [
      [0, 1],
      [450, 1],
      [600, 3],
      [700, 3],
      [1000, 3],
      [1200, 5],
      [1600, 5]
    ],
    pagination: false,
    navigation: true,
    navigationText: ['<i class="pe-4x pe-7s-angle-left pe-border"></i>', '<i class="pe-4x  pe-7s-angle-right pe-border"></i>'],
  });

  // FUNFACTS
  $('.number').counterUp({
    delay: 10,
    time: 3000
  });

  //FIX HOVER EFFECT ON IOS DEVICES
  document.addEventListener("touchstart", function () {
  }, true);

    $(document).ready(function () {


        $("#nav-primary").sticky({topSpacing: 0,});

        //PRELOADER
        $('#preload').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.

    });

})(jQuery, Drupal);

