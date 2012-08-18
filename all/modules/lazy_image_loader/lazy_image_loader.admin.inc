<?php
/**
* Implementation of settigs page
*/
function lazy_image_loader_admin_settings() {
  $form = array();

  $form['lazy_image_loader_classes'] = array(
    '#type' => 'textfield',
    '#title' => t('CSS classes to work with lazy image loader'),
    '#default_value' => variable_get('lazy_image_loader_classes', '.content img'),
    '#description' => t("Separate classes with comma's. Input is similar to jQuery selectors. Examples: 'img' for all images, 'div.node img.imagecache' for imagecache images within the node body. <em>Default (all images): img</em>"),
  );

  $form['lazy_image_loader_threshold'] = array(
    '#type' => 'textfield',
    '#title' => t('Threshold from the fold in pixels'),
    '#default_value' => variable_get('lazy_image_loader_threshold', 0),
    '#description' => t("You can set threshold on how close to the edge (don't push me too far) image should come before it is loaded. <em>Default: 0</em>"),
  );
  
  $form['lazy_image_loader_event'] = array(
    '#type' => 'select',
	'#options' => array('blur' => 'blur', 'click' => 'click', 'dblclick' => 'dblclick', 'focus' => 'focus', 'keydown' => 'keydown', 'keypress' => 'keypress', 'keyup' => 'keyup', 'mousedown' => 'mousedown', 'mouseenter' => 'mouseenter', 'mouseleave' => 'mouseleave', 'mousemove' => 'mousemove', 'mouseout' => 'mouseout', 'mouseover' => 'mouseover', 'mouseup' => 'mouseup', 'resize' => 'resize', 'scroll' => 'scroll'),
    '#title' => t('jQuery event to start loading images'),
    '#default_value' => variable_get('lazy_image_loader_event', 'scroll'),
    '#description' => t("Default is to wait until user scrolls down and image appears on the window (scroll). Change this setting only when you know what you're doing. For example, 'click' will postpone loading until a user has clicked the placeholder. <em>Default: scroll</em>"),
  );
  
  $form['lazy_image_loader_effect'] = array(
    '#type' => 'select',
	'#options' => array('fadeIn' => 'fadeIn', 'show' => 'show', 'slideDown' => 'slideDown', 'slideUp' => 'slideUp'),
    '#title' => t('jQuery effect when loading images'),
    '#default_value' => variable_get('lazy_image_loader_effect', 'show'),
    '#description' => t("By default plugin waits for image to fully load and calls show() to show it. <em>Default: show</em>"),
  );

  $form['lazy_image_loader_failurelimit'] = array(
    '#type' => 'textfield',
    '#title' => t('Failure limit'),
    '#default_value' => variable_get('lazy_image_loader_failurelimit', 10),
    '#description' => t("After scrolling page Lazy Load loops though unloaded images. In loop it checks if image has become visible. By default loop is stopped when first image below the fold (not visible) is found. This is based on following assumption. Order of images on page is same as order of images in HTML code. With some layouts assumption this might be wrong. You can control loading behaviour with failurelimit option. <em>Default: 10</em>"),
  );
  
  $form['lazy_image_loader_placeholder'] = array(
    '#type' => 'fieldset',
    '#title' => t('Placeholder'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  
  $options=array(t('gray.gif'), t('transparent.gif'),t('Custom'));
  $form['lazy_image_loader_placeholder']['lazy_image_loader_placeholder_type'] = array(
    '#type' => 'radios',
    '#title' => t('Select the placeholder for the images that are not yet loaded'),
    '#default_value' => variable_get('lazy_image_loader_placeholder_type',1) ,
    '#options' => $options
  );
  
  $form['lazy_image_loader_placeholder']['lazy_image_loader_placeholder_custom_image'] = array(
    '#type' => 'textfield',
    '#title' => t('Path to custom Placeholder image'),
    '#default_value' => variable_get('lazy_image_loader_placeholder_custom_image', ''),
    '#description' => t("The path to the file you would like to use as placeholder file instead of the default ones, the path should be relative to files folder with no slash at the beginning like \"design/placeholder.gif\""),
  );  
  
 $form['lazy_image_loader_access_details'] = array(
    '#type' => 'fieldset',
    '#title' => t('Access'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  
  $access = user_access('use PHP for block visibility');
  
  // If the visibility is set to PHP mode but the user doesn't have this block permission, don't allow them to edit nor see this PHP code
  $options = array(t('Use on every page except the listed pages.'), t('Use on only the listed pages.'));
  $description = t("Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are '!blog' for the blog page and !blog-wildcard for every personal blog. !front is the front page.", array('!blog' => theme('placeholder', 'blog'), '!blog-wildcard' =>  theme('placeholder', 'blog/*'), '!front' => theme('placeholder', '<front>')));

  if ($access) {
    $options[] = t('Show if the following PHP code returns <code>TRUE</code> (PHP-mode, experts only).');
    $description .= t('If the PHP-mode is chosen, enter PHP code between !php. Note that executing incorrect PHP-code can break your Drupal site.', array('!php' => theme('placeholder', '<?php ?>')));
 }
  $form['lazy_image_loader_access_details']['lazy_image_loader_access'] = array(
    '#type' => 'radios',
    '#title' => t('Use lazy image loading on specific pages'),
    '#default_value' => variable_get('lazy_image_loader_access',1) ,
    '#options' => $options
  );
  $form['lazy_image_loader_access_details']['lazy_image_loader_access_pages'] = array(
    '#type' => 'textarea',
    '#title' => t('Pages'),
    '#default_value' => variable_get('lazy_image_loader_access_pages',''),
    '#description' => $description
  );
  
  $form['#submit'][] = 'lazy_image_loader_admin_settings_submit';

  return system_settings_form($form);
}

/**
* Overriding system_settings_form for submition
*/
function lazy_image_loader_admin_settings_submit($form, &$form_state) {
   
  if (!empty($_POST) && form_get_errors()) {
	//variable_set('lazy_image_loader_placeholder_image', '')
    //$form_state['values']['lazy_image_loader_placeholder_custom_image']='bb';
  }

}

/**
* Validating admin settings form
*/
function lazy_image_loader_admin_settings_validate($form, $form_state) {

  if ($form_state['values']['lazy_image_loader_placeholder_type']==2) {//Custom
    if (!file_exists(file_directory_path().'/'.$form_state['values']['lazy_image_loader_placeholder_custom_image'])) {
	  form_set_error('lazy_image_loader_placeholder_custom_image', t('Custom placeholder image does not exists!'));
    }
  }
}