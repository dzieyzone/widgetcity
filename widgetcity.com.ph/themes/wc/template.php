<?php
// $Id: template.php,v 1.17.2.1 2009/02/13 06:47:44 johnalbin Exp $

/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */

/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.
if (theme_get_setting('wc_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
}
// */


/**
 * Implementation of HOOK_theme().
 */
function wc_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function wc_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */

/* -- Delete this line if you want to use this function
function wc_preprocess_page(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */
/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
//* -- Delete this line if you want to use this function
function wc_preprocess_node(&$vars, $hook) {
  if ($vars['teaser']) {
    $vars['template_files'][] = "node-{$vars['node']->type}-teaser";
  }

  $function = "wc_preprocess_node_{$vars['node']->type}";
  if (function_exists($function)) {
    $function($vars);
  }
}
function wc_preprocess_node_product(&$vars) {
  $node = $vars['node'];
	
  if ($vars['teaser']) {
		drupal_add_js(drupal_get_path('theme', 'wc') . '/js/jquery.hoverIntent.minified.js');
		drupal_add_js(drupal_get_path('theme', 'wc') . '/js/products.js');
		drupal_add_css(drupal_get_path('theme', 'wc') . '/css/products.css');
  } else {
		drupal_add_css(drupal_get_path('theme', 'wc') . '/css/node.css');		
	}
	
	$vars['phaseout'] = (array_key_exists(95, $node->taxonomy))?true:false;
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function wc_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */

/* -- Delete this line if you want to use this function
function wc_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */
//*
function wc_nice_menu_build($menu, $depth = -1, $trail = NULL) {
  $output = '';
  $index = 0;
  $count = 0;
  foreach ($menu as $menu_count) {
    if ($menu_count['link']['hidden'] == 0) {
      $count++;
    }
  }

  foreach ($menu as $menu_item) {
    $mlid = $menu_item['link']['mlid'];

    // Check to see if it is a visible menu item.
    if ($menu_item['link']['hidden'] == 0) {
      //prepare marking of li tag as odd, even, first or last
      $index++;
      $first_class = $index == 1 ? ' first ' : '';
      $oddeven_class = $index % 2 == 0 ? ' even' : ' odd';
      $last_class = $index == $count ? ' last ' : '';

      // Build class name based on menu path
      // e.g. to give each menu item individual style.
      // Strip funny symbols.
      $clean_path = str_replace(array('http://', 'www', '<', '>', '&', '=', '?', ':'), '', $menu_item['link']['href']);

      // Convert slashes to dashes.
      $clean_path = str_replace('/', '-', $clean_path);
      $class = 'menu-path-'. $clean_path;
      if ($trail && in_array($mlid, $trail)) {
        $class .= ' active-trail';
      }

      // If it has children build a nice little tree under it.
      if ((!empty($menu_item['link']['has_children'])) && (!empty($menu_item['below'])) && $depth != 0) {
        // Keep passing children into the function 'til we get them all.
        $children = theme('nice_menu_build', $menu_item['below'], $depth, $trail);
        // Set the class to parent only of children are displayed.
        $parent_class = $children ? 'menuparent ' : '';
        $output .= '<li id="menu-'. $mlid .'" class="'. $parent_class . $class . $trail_class . $path_class . $first_class . $last_class . $oddeven_class .'">
'. theme('menu_item_link', $menu_item['link']);
        // Check our depth parameters.
        if ($menu_item['link']['depth'] <= $depth || $depth == -1) {
          // Build the child UL only if children are displayed for the user.
          if ($children) {
            $output .= '
<ul>
  ';
  $output .= $children;
  $output .= "
</ul>
\n";
          }
        }
        $output .= "
</li>
\n";
      }
      else {
        $output .= '
<li id="menu-'. $mlid .'" class="'. $class . $trail_class . $path_class . $first_class . $last_class . $oddeven_class .'">'. theme('menu_item_link', $menu_item['link']) .'</li>
'."\n";
      }
    }
  }
  return $output;
}
//*/
function wc_preprocess_search_theme_form(&$variables) {
  $variables['form']['search_theme_form']['#title'] = 'Search';
  $variables['form']['search_theme_form']['#size'] = 25;
  $variables['form']['search_theme_form']['#value'] = 'enter keyword';
  $variables['form']['search_theme_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = 'enter keyword';}", 'onfocus' => "if (this.value == 'enter keyword') {this.value = '';}" );
  unset($variables['form']['search_theme_form']['#printed']);
  $variables['search']['search_theme_form'] = drupal_render($variables['form']['search_theme_form']);
  $variables['search_form'] = implode($variables['search']);
}