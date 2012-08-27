// $Id: viewscarousel3d_options.js,v 1.1.2.1 2010/08/15 21:41:00 rashad612 Exp $
Drupal.behaviors.viewscarousel3d_options = function(context) {
  if($('#edit-style-options-autoRotate').val() == Drupal.t('no'))
      $('#edit-style-options-autoRotateDelay-wrapper').hide();
    else
     $('#edit-style-options-autoRotateDelay-wrapper').show();
     
  $('#edit-style-options-autoRotate').change(function() {
    if($(this).val() == Drupal.t('no'))
      $('#edit-style-options-autoRotateDelay-wrapper').fadeOut();
    else
     $('#edit-style-options-autoRotateDelay-wrapper').fadeIn();
  });
};
