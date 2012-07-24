<?php
// $Id: uc_checkout_tweaks.theme.inc,v 1.1 2010/10/24 19:09:17 longwave Exp $

/**
 * Theme the delivery/billing address forms in tables, with the Amazon-style
 * saved address selector.
 */
function theme_address_pane_amazon_style($form) {
  $output = '';

  if (isset($form['copy_address'])) {
    $output .= drupal_render($form['copy_address']);
  }

  $output .= '<div class="address-pane-table">';

  if (isset($form['#saved_addresses'])) {
    $output .= '<div class="show-onload"><table class="saved-addresses"><tr>';
    foreach ($form['#saved_addresses'] as $id => $address) {
      if ($id > 0 && $id % 3 == 0) {
        $output .= '</tr><tr>';
      }
      $output .= '<td>';
      $output .= '<input type="submit" value="' . check_plain(t('Use this address')) . '" onclick="apply_address(\'' . $form['#pane'] . '\', Drupal.settings.savedAddresses.' . $form['#pane'] . '[' . $id . ']); return false;" />';
      $output .= '<br />' . $address;
      $output .= '</td>';
    }
    $output .= '</tr></table></div>';
  }

  $output .= '<table>';
  foreach (element_children($form) as $field) {
    if (substr($field, 0, 9) == 'delivery_' || substr($field, 0, 8) == 'billing_') {
      $title = $form[$field]['#title'] .':';
      unset($form[$field]['#title']);
      if (substr($field, -7) == 'street1') {
        $title = uc_get_field_name('street') .':';
      }
      elseif (substr($field, -7) == 'street2') {
        $title = ' ';
      }
      $output .= '<tr><td class="field-label">';
      if ($form[$field]['#required']) {
        $output .= '<span class="form-required">*</span>';
      }
      $output .= $title .'</td><td>'. drupal_render($form[$field]) .'</td></tr>';
    }
  }
  $output .= '</table></div>';

  foreach (element_children($form) as $element) {
    $output .= drupal_render($form[$element]);
  }

  return $output;
}
