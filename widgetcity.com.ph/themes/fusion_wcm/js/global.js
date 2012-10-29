$(document).ready(function() {
  var $sidebar = $('#sidebar-first-inner');
  var $footer = $('#footer-wrapper');
  var $window = $(window);
  var top = $sidebar.offset().top - parseFloat($sidebar.css('marginTop').replace(/auto/, 0));
  var footTop = $footer.offset().top - parseFloat($footer.css('marginTop').replace(/auto/, 0));
  var maxY = footTop - $sidebar.outerHeight();

  $window.scroll(function(evt) {
    var y = $window.scrollTop();
    if (y > top) {
      if (y < maxY) {
        $sidebar.addClass('fixed').removeAttr('style');
      }
      else {
        $sidebar.removeClass('fixed').css({
          position: 'absolute',
          top: (maxY - top) + 'px'
        });
      }
    }
    else {
      $sidebar.removeClass('fixed');
    }
  });
});