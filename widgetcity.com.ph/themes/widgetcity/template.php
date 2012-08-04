<?php

// $Id: template.php,v 1.17.2.1 2009/02/13 06:47:44 johnalbin Exp $



/**

 * @file

 * Contains theme override functions and preprocess functions for the theme.

 *

 * ABOUT THE TEMPLATE.PHP FILE

 *

 *   The template.php file is one of the most useful files when creating or

 *   modifying Drupal themes. You can add new regions for block content, modify

 *   or override Drupal's theme functions, intercept or make additional

 *   variables available to your theme, and create custom PHP logic. For more

 *   information, please visit the Theme Developer's Guide on Drupal.org:

 *   http://drupal.org/theme-guide

 *

 * OVERRIDING THEME FUNCTIONS

 *

 *   The Drupal theme system uses special theme functions to generate HTML

 *   output automatically. Often we wish to customize this HTML output. To do

 *   this, we have to override the theme function. You have to first find the

 *   theme function that generates the output, and then "catch" it and modify it

 *   here. The easiest way to do it is to copy the original function in its

 *   entirety and paste it here, changing the prefix from theme_ to widgetcity_.

 *   For example:

 *

 *     original: theme_breadcrumb()

 *     theme override: widgetcity_breadcrumb()

 *

 *   where widgetcity is the name of your sub-theme. For example, the

 *   zen_classic theme would define a zen_classic_breadcrumb() function.

 *

 *   If you would like to override any of the theme functions used in Zen core,

 *   you should first look at how Zen core implements those functions:

 *     theme_breadcrumbs()      in zen/template.php

 *     theme_menu_item_link()   in zen/template.php

 *     theme_menu_local_tasks() in zen/template.php

 *

 *   For more information, please visit the Theme Developer's Guide on

 *   Drupal.org: http://drupal.org/node/173880

 *

 * CREATE OR MODIFY VARIABLES FOR YOUR THEME

 *

 *   Each tpl.php template file has several variables which hold various pieces

 *   of content. You can modify those variables (or add new ones) before they

 *   are used in the template files by using preprocess functions.

 *

 *   This makes THEME_preprocess_HOOK() functions the most powerful functions

 *   available to themers.

 *

 *   It works by having one preprocess function for each template file or its

 *   derivatives (called template suggestions). For example:

 *     THEME_preprocess_page    alters the variables for page.tpl.php

 *     THEME_preprocess_node    alters the variables for node.tpl.php or

 *                              for node-forum.tpl.php

 *     THEME_preprocess_comment alters the variables for comment.tpl.php

 *     THEME_preprocess_block   alters the variables for block.tpl.php

 *

 *   For more information on preprocess functions and template suggestions,

 *   please visit the Theme Developer's Guide on Drupal.org:

 *   http://drupal.org/node/223440

 *   and http://drupal.org/node/190815#template-suggestions

 */





/*

 * Add any conditional stylesheets you will need for this sub-theme.

 *

 * To add stylesheets that ALWAYS need to be included, you should add them to

 * your .info file instead. Only use this section if you are including

 * stylesheets based on certain conditions.

 */

/* -- Delete this line if you want to use and modify this code

// Example: optionally add a fixed width CSS file.

if (theme_get_setting('widgetcity_fixed')) {

  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');

}

// */





/**

 * Implementation of HOOK_theme().

 */

function widgetcity_theme(&$existing, $type, $theme, $path) {

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

function widgetcity_preprocess(&$vars, $hook) {

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

function widgetcity_preprocess_page(&$vars, $hook) {

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

function widgetcity_preprocess_node(&$vars, $hook) {
  if ($vars['teaser']) {
    $vars['template_files'][] = "node-{$vars['node']->type}-teaser";
  } else {
		drupal_add_css(drupal_get_path('theme', 'widgetcity') . '/node.css');		
  }
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

function widgetcity_preprocess_comment(&$vars, $hook) {

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

function widgetcity_preprocess_block(&$vars, $hook) {

  $vars['sample_variable'] = t('Lorem ipsum.');

}

// */



function widgetcity_nice_menu_build($menu, $depth = -1, $trail = NULL) {

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

        $children = theme('nice_menus_build', $menu_item['below'], $depth, $trail);

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

function widgetcity_preprocess_search_theme_form(&$variables) {

  $variables['form']['search_theme_form']['#title'] = 'Search';

  $variables['form']['search_theme_form']['#size'] = 25;

  $variables['form']['search_theme_form']['#value'] = 'enter keyword';

  $variables['form']['search_theme_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = 'enter keyword';}", 'onfocus' => "if (this.value == 'enter keyword') {this.value = '';}" );

  unset($variables['form']['search_theme_form']['#printed']);

 

  $variables['search']['search_theme_form'] = drupal_render($variables['form']['search_theme_form']);

 

  $variables['search_form'] = implode($variables['search']);

}