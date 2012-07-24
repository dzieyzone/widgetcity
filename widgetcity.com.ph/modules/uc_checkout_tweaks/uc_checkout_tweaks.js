// $Id: uc_checkout_tweaks.js,v 1.1 2010/10/22 16:41:25 longwave Exp $

$(function() {
  if (Drupal.settings.uc_checkout_tweaks.same_address) {
    if ($('#edit-panes-billing-copy-address').is(':checked')) {
      uc_cart_copy_address(true, 'delivery', 'billing');
    }
    if ($('#edit-panes-delivery-copy-address').is(':checked')) {
      uc_cart_copy_address(true, 'billing', 'delivery');
    }
  }
});
