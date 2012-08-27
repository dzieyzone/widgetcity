<?php  //$Id: viewscarousel3d.views.inc,v 1.1.2.1 2010/08/15 21:44:32 rashad612 Exp $

/**
 * Implementation of hook_views_plugins().
 *
 */
function viewscarousel3d_views_plugins() {
  
  return array(
    'module' => 'viewscarousel3d',
    'style'  => array(
      'viewscarousel3d' => array(
        'title' => t('3D Views Carousel'),
        'theme' => 'viewscarousel3d',
        'help'  => 'Display rows as rotated 3D carousel.',
        'handler' => 'viewscarousel3d_style_plugin',
        'uses row plugin' => TRUE,
        'uses options' => TRUE,
        'type' => 'normal'
      )
    )
  );
}// end function viewscarousel3d_views_plugins;
