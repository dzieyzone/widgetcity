<?php  //$Id: viewscarousel3d_style_plugin.inc,v 1.1.2.1 2010/08/15 21:44:32 rashad612 Exp $


/**
 * Implementation of views_plugin_style().
 *
 */
class viewscarousel3d_style_plugin extends views_plugin_style {
  
  
  function option_definition() {
    $options = parent::option_definition();

    $options['minScale'] = array('default' => 0.5);
    
    $options['reflHeight'] = array('default' => 0);
    $options['reflGap'] = array('default' => 0);
    $options['reflOpacity'] = array('default' => 0.5);

    $options['xPos'] = array('default' => 0);
    $options['yPos'] = array('default' => 0);
    
    $options['titleBox'] = array('default' => NULL);
    $options['altBox'] = array('default' => NULL);
    
    $options['FPS'] = array('default' => 30);
    $options['speed'] = array('default' => 0.2);
    
    $options['autoRotate'] = array('default' => 'no');
    $options['autoRotateDelay'] = array('default' => 1500);
    
    $options['mouseWheel'] = array('default' => 0);
    
    $options['bringToFront'] = array('default' => 1);
    
    $options['showButtons'] = array('default' => 1);
    return $options;
  }// end function option_definition;
  
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    
    
    $form['minScale'] = array(
      '#type' => 'textfield',
      '#title' => t('Minimum Scale'),
      '#default_value' => $this->options['minScale'],
      '#size' => 5,
      '#description' => t('The minimum scale appled to the furthest item. The item at the front has a scale of 1. To make items in the distance one quarter of the size, minScale would be 0.25.'),
      '#required' => TRUE
    );
    
    $form['reflHeight'] = array(
      '#type' => 'textfield',
      '#title' => t('Reflection Height'),
      '#default_value' => $this->options['reflHeight'],
      '#size' => 5,
      '#description' => t('Height of the auto-reflection in pixels, assuming applied to the item at the front. The reflection will scale automatically. A value of 0 means that no auto-reflection will appear.'),
      '#required' => TRUE
    );
    
    $form['reflGap'] = array(
      '#type' => 'textfield',
      '#title' => t('Reflection Gap'),
      '#default_value' => $this->options['reflGap'],
      '#size' => 5,
      '#description' => t('Amount of vertical space in pixels between image and reflection, assuming applied to the item at the front. Gap will scale automatically.'),
      '#required' => TRUE
    );
    
    $form['reflOpacity'] = array(
      '#type' => 'textfield',
      '#title' => t('Reflection Opacity'),
      '#default_value' => $this->options['reflOpacity'],
      '#size' => 5,
      '#description' => t('Specifies how transparent the reflection is. 0 is invisible, 1 is totally opaque.'),
      '#required' => TRUE
    );
    
    $form['FPS'] = array(
      '#type' => 'textfield',
      '#title' => t('Frames Per Second'),
      '#default_value' => $this->options['FPS'],
      '#size' => 5,
      '#description' => t('This is the approximate frame rate of the carousel in frames per second. The higher the number, the faster and smoother the carousel movement will appear. However, frame rates that are too high can make the user\'s browser feel sluggish, especially if they have an under powered machine. The default setting of 30 is a good tradeoff between speed and performance.'),
      '#required' => TRUE
    );
    
    $form['speed'] = array(
      '#type' => 'textfield',
      '#title' => t('Speed'),
      '#default_value' => $this->options['speed'],
      '#size' => 5,
      '#description' => t('This value represents the speed at which the carousel rotates between items. Good values are around 0.1 ~ 0.3. A value of one will instantly move from one item to the next without any rotation animation. Values should be greater than zero and less than one.'),
      '#required' => TRUE
    );
    
    $form['autoRotate'] = array(
      '#type' => 'select',
      '#title' => t('Auto Rotation'),
      '#default_value' => $this->options['autoRotate'],
      '#options' => array('no' => t('Off'), 'left' => t('Left'), 'right' => t('Right')),
      '#description' => t('Turn on auto-rotation of the carousel using either \'left\' or \'right\' as the value. The carousel will rotate between items automatically. The auto-rotation stops when the user hovers over the carousel area, and starts again when the mouse is moved off.'),
      '#required' => TRUE
    );
    
    $form['autoRotateDelay'] = array(
      '#type' => 'textfield',
      '#title' => t('Auto Rotation Delay'),
      '#default_value' => $this->options['autoRotateDelay'],
      '#size' => 5,
      '#description' => t('Delay in milliseconds between each rotation in auto-rotate mode. A minimum value of 1000 (i.e. one second) is recommended.'),
      '#required' => TRUE
    );
    
   $form['mouseWheel'] = array(
      '#type' => 'select',
      '#title' => t('Mouse Wheel'),
      '#default_value' => $this->options['mouseWheel'],
      '#options' => array(0 => t('Disable'), 1 => t('Enable')),
      '#description' => t('If set to true, this will enable mouse wheel support for the carousel.'),
      '#required' => TRUE
    );
    
    $form['titleBox'] = array(
      '#type' => 'select',
      '#title' => t('Show Image Title'),
      '#default_value' => $this->options['titleBox'],
      '#options' => array(0 => t('No'), 1 => t('Yes')),
      '#description' => t('Show image\'s title attribute as caption in the footer of the carousel.'),
      '#required' => TRUE
    );
   
    $form['bringToFront'] = array(
      '#type' => 'select',
      '#title' => t('Bring to Front'),
      '#default_value' => $this->options['bringToFront'],
      '#options' => array(0 => t('No'), 1 => t('Yes')),
      '#description' => t('If set to true, this will enable mouse wheel support for the carousel.'),
      '#required' => TRUE
    );
    
    $form['showButtons'] = array(
      '#type' => 'select',
      '#title' => t('Control Buttons'),
      '#default_value' => $this->options['showButtons'],
      '#options' => array(0 => t('No'), 1 => t('Yes')),
      '#description' => t('Show control buttons, that rotate carousel left and right.'),
      '#required' => TRUE
    );
  }// end function options_form;
  
  function options_validate(&$form, &$form_state) {
    parent::options_validate($form, $form_state);
   
    if($form['minScale']['#value'] < 0)
      form_set_error('minScale', t('\'Minimum Scale\' should be a positive value.'));
    
    if($form['reflHeight']['#value'] < 0)
      form_set_error('reflHeight', t('\'Reflection Height\' should be a positive value.'));
    
    if($form['reflGap']['#value'] < 0)
      form_set_error('reflGap', t('\'Reflection Gap\' should be a positive value.'));
      
    if($form['reflOpacity']['#value'] < 0)
      form_set_error('reflOpacity', t('\'Reflection Opacity\' should be a positive value.'));
      
    if($form['xPos']['#value'] < 0)
      form_set_error('xPos', t('\'X Position\' should be a positive value.'));
    
    if($form['yPos']['#value'] < 0)
      form_set_error('yPos', t('\'Y Position\' should be a positive value.'));

    
    if($form['FPS']['#value']  < 0)
      form_set_error('FPS', t('\'Frames Per Second\' should be a positive value.'));
      
    if($form['speed']['#value'] < 0)
      form_set_error('speed', t('\'Speed\' should be a positive value.'));
    
    if($form['autoRotate']['#value'] != 'no' && $form['autoRotateDelay']['#value'] < 0)
      form_set_error('autoRotateDelay', t('\'Auto Rotation Delay\' should be a positive value.'));
    
    
  }// end function options_submit;
  
}// end class viewscarousel3d_style_plugin;
