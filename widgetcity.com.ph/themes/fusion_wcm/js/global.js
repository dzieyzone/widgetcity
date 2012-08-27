$(document).ready(function() {
  var top = $('#sidebar-first-inner').offset().top - parseFloat($('#sidebar-first-inner').css('marginTop').replace(/auto/, 0));
  var footTop = $('#footer-wrapper').offset().top - parseFloat($('#footer-wrapper').css('marginTop').replace(/auto/, 0));

  var maxY = footTop - $('#sidebar-first-inner').outerHeight();

  $(window).scroll(function(evt) {
    var y = $(this).scrollTop();
    if (y > top) {
      if (y < maxY) {
        $('#sidebar-first-inner').addClass('fixed').removeAttr('style');
      }
      else {
        $('#sidebar-first-inner').removeClass('fixed').css({
          position: 'absolute',
          top: (maxY - top) + 'px'
        });
      }
    }
    else {
      $('#sidebar-first-inner').removeClass('fixed');
    }
  });
});