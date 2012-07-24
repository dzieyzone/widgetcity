<?php
// $Id: uc_checkout_tweaks.pages.inc,v 1.1 2010/10/25 06:52:07 longwave Exp $

/**
 * Overridden copy of uc_payment_get_totals() that removes the first line
 * if the separate order preview pane is in use.
 */
function uc_checkout_tweaks_uc_payment_get_totals() {
  $output = '';
  if (is_array($_POST)) {
    $order = unserialize($_POST['order']);
  }

  if ($order) {
    usort($order->line_items, 'uc_weight_sort');

    if (!variable_get('uc_pane_checkout_preview_enabled', TRUE)) {
      $output = t('Order total preview:')
              .' <span id="order-total-throbber"></span>';
    }
    $output .= '<table>';
    $grand_total = 0;

    $context = array(
      'type' => 'line_item',
      'subject' => array(
        'order' => $order,
      ),
    );

    foreach ($order->line_items as $line) {
      if (!empty($line['title'])) {
        $context['revision'] = 'themed';
        $context['subject']['line_item'] = $line;

        $output .= '<tr><td align="right"><b>'. $line['title'] .':</b></td>'
                  .'<td align="right">'. uc_price($line['amount'], $context) .'</td></tr>';

        if ($line['summed']) {
          $context['revision'] = 'altered';
        }
      }
    }

    $context['revision'] = 'themed';
    $context['type'] = 'amount';
    unset($context['subject']);
    $output .= '<tr><td align="right"><b>'. t('Order total:') .'</b></td>'
              .'<td align="right">'. uc_price(uc_order_get_total($order), $context)
              .'</td></tr></table>';
  }

  print $output;
  exit();
}
