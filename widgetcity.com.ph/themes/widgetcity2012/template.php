<?php
function widgetcity2012_preprocess_node(&$vars, $hook) {
  if ($vars['teaser']) {
    $vars['template_files'][] = "node-{$vars['node']->type}-teaser";
  }

  $function = "widgetcity2012_preprocess_node_{$vars['node']->type}";
  if (function_exists($function)) {
    $function($vars);
  }
}

function widgetcity2012_preprocess_node_product(&$vars) {
  $node = $vars['node'];
	
  if (!$vars['teaser']) {
		drupal_add_css(drupal_get_path('theme', 'widgetcity2012') . '/css/node.css');
		drupal_add_js(drupal_get_path('theme', 'widgetcity2012') . '/js/products.js');
	}
	
	$vars['phaseout'] = (array_key_exists(95, $node->taxonomy))?true:false;
}

function widgetcity2012_nice_menu_build($menu, $depth = -1, $trail = NULL) {
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

function widgetcity2012_preprocess_search_block_form(&$variables) {
	$search_value = 'Search';
  $variables['form']['search_block_form']['#title'] = '';//'Search';
  $variables['form']['search_block_form']['#size'] = 25;
  $variables['form']['search_block_form']['#value'] = $search_value;
  $variables['form']['search_block_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = '" . $search_value . "';}", 'onfocus' => "if (this.value == '" . $search_value . "') {this.value = '';}" );
  unset($variables['form']['search_block_form']['#printed']);
  $variables['search']['search_block_form'] = drupal_render($variables['form']['search_block_form']);
  $variables['search_form'] = implode($variables['search']);
}

function widgetcity2012_preprocess_views_view(&$variables) {
	if ($variables['name'] == 'front'){
		$theme_path = drupal_get_path('theme', 'widgetcity2012');
//		drupal_add_js( $theme_path . '/js/jquery.ui.core.js');
//		drupal_add_js( $theme_path . '/js/jquery.ui.widget.js');
//		drupal_add_js( $theme_path . '/js/jquery.ui.selectmenu.js');
		drupal_add_js( $theme_path . '/js/global.js');
//		drupal_add_css( $theme_path . '/css/jquery.ui.selectmenu.css');
	}
}