// $Id: viewscarousel3d.js,v 1.1.2.2 2010/08/15 23:52:51 rashad612 Exp $

Drupal.behaviors.viewscarousel3d_init = function(context) {
  var settings = Drupal.settings.viewscarousel3d.viewscarousel3d_settings;
  var displays = settings.display_id;
  
  // Convert single display and its settings to one-element array.
  if(typeof(displays) != 'object' || typeof(displays) == 'string') {
    displays = [displays];
    settings.minScale = [settings.minScale];
    settings.reflHeight = [settings.reflHeight];
    settings.reflGap = [settings.reflGap];
    settings.reflOpacity = [settings.reflOpacity];
    settings.FPS = [settings.FPS];
    settings.speed = [settings.speed];
    settings.autoRotate = [settings.autoRotate];
    settings.autoRotateDelay = [settings.autoRotateDelay];
    settings.mouseWheel = [settings.mouseWheel];
    settings.bringToFront = [settings.bringToFront];
    settings.showButtons = [settings.showButtons];
    settings.titleBox = [settings.titleBox];
  }
  
  for(var i = 0; i < displays.length; i++) {
    var wrapper = $('#' + displays[i]);
    

    var carouselObject = {
      minScale: parseFloat(settings.minScale[i]),
      reflHeight: parseInt(settings.reflHeight[i]),
      reflGap: parseInt(settings.reflGap[i]),
      reflOpacity: parseFloat(settings.reflOpacity[i]),
      xPos: parseInt(parseInt($(wrapper).width()) / 2),
      yPos: 100,
      altBox: $(".viewscarousel3d-alt-text"),
      FPS: parseInt(settings.FPS[i]),
      speed: parseFloat(settings.speed[i]),
      autoRotate: settings.autoRotate[i],
      autoRotateDelay: parseInt(settings.autoRotateDelay[i]),
      mouseWheel: settings.mouseWheel[i],
      bringToFront: settings.bringToFront[i]
    };
    
    if(settings.showButtons[i]) {
      
      $(wrapper).append('<a id="' + displays[i] + '-left-btn" class="viewscarousel3d-left-btn viewscarousel3d-btn" href="#"></a>');
      $(wrapper).append('<a id="' + displays[i] + '-right-btn" class="viewscarousel3d-right-btn viewscarousel3d-btn" href="#"></a>');
      
      $('.viewscarousel3d-btn').click(function() { return false; });
      
      // I switched the behavior of the buttons.
      carouselObject.buttonLeft = $('#' + displays[i] + '-right-btn');
      carouselObject.buttonRight = $('#' + displays[i] + '-left-btn');
      
    }
    
    if(settings.titleBox[i]) {
      $('#' + displays[i] + '-wrapper').append('<div id="' + displays[i] + '-title-text" class="viewscarousel3d-title-text"></div>');
    }
    carouselObject.titleBox = $('#' + displays[i] + '-title-text');
    

    $(wrapper).find('img').addClass("cloudcarousel");
    $(wrapper).CloudCarousel(carouselObject);
    
  }// end for;
};
