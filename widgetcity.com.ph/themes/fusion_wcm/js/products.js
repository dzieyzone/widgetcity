$(document).ready(function() {
  $('#product-images #slideshow').cycle({
    fx:'fade',
    speed:'fast',
    timeout: 5000,
    pager:  '#product-images #image-nav',
    pagerAnchorBuilder: function(idx, slide) {
      return '#product-images #image-nav li:eq(' + (idx) + ') a';
    }
  });
});