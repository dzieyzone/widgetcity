/* $Id: admin_menu.js,v 1.7.2.4 2008/09/08 23:02:26 sun Exp $ */

$(document).ready(function() {
	$('.jcarousel-skin-widgetcity').parents('.view-header ul').each(function(){
    var list=$(this),
    select=$(document.createElement('select')).insertBefore($(this).hide());
    $('>li a', this).each(function(){
      var target=$(this).attr('target'),
      option=$(document.createElement('option'))
      .appendTo(select)
      .val(this.href)
      .html($(this).html())
      .change(function(){
        if (target==='_blank'){
          window.open($(this).val());
        } else {
          window.location.href=$(this).val();
        }
      });
    });
    select.selectmenu({'change':function(){window.location.href = jQuery(this).val();}});
    list.remove();
  });
});