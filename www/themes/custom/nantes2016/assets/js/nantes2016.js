(function ($) {
  Drupal.behaviors.paypalModal = {
    attach: function (context) {
      if (location.pathname == '/') {
        $('.buy-btn').click(function () {
          $('#paypalModal', context).modal();
          return false;
        });
      }
      if (location.hash == '#paypal') {
        $('#paypalModal', context).modal();
      }
    }
  };
}(jQuery));
