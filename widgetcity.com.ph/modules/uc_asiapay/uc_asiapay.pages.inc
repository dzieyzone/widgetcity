<?php
/**
 * @file
 * EasyPay menu items.
 */

/**
 * Callback for Receive Instant Payment Notification with Success status.
 */
function uc_asiapay_success($order_id = 0) {
  watchdog('uc_asiapay', 'Receiving IPN with SUCCESS notification for order @order_id.', array(
    '@order_id' => $order_id,
  ));
  drupal_set_message('Your payment is SUCCESS on EasyPay', 'status');
	$redirecturl = 'admin/store/orders/'. $order_id;

  drupal_goto($redirecturl);
}

/**
 * Callback for Receive Instant Payment Notification with Fail status.
 */
function uc_asiapay_fail($order_id = 0) {
  watchdog('uc_asiapay', 'Receiving IPN with FAIL notification for order @order_id.', array(
    '@order_id' => $order_id,
  ), WATCHDOG_ERROR);

  drupal_set_message('Your payment is FAIL on EasyPay', 'warning');

  drupal_goto('cart');
}

/**
 * Callback for Receive Instant Payment Notification with Cancel status.
 */
function uc_asiapay_cancel($order_id = 0) {
  watchdog('uc_asiapay', 'Receiving IPN with CANCEL notification for order @order_id.', array(
    '@order_id' => $order_id,
  ), WATCHDOG_ERROR);

  drupal_set_message('Your payment has been CANCELLED as user requested', 'warning');

  drupal_goto('cart');
}

/**
 * The Action when receive EasyPay detail datafeed.
 */
function uc_asiapay_datafeed() {
  // echo the page back to EasyPay
  print("OK\n");
  //print("successcode = $successcode");

  $src = check_plain($_POST['src']);
  $prc = check_plain($_POST['prc']);
  $bank_ord = check_plain($_POST['Ord']);
  $holder = check_plain($_POST['Holder']);
  $successcode = check_plain($_POST['successcode']);
  $order_id = check_plain($_POST['Ref']);
  $asiapay_ref = check_plain($_POST['PayRef']);
  $amt = check_plain($_POST['Amt']);
  $cur = check_plain($_POST['Cur']);
  $cart_id = check_plain($_POST['remark']);
  $authid = check_plain($_POST['Authid']);
  $eci = check_plain($_POST['eci']);
  $payerauth = check_plain($_POST['payerAuth']);
  $sourceip = check_plain($_POST['sourceIp']);
  $ipcountry = check_plain($_POST['ipCountry']);
  $cdatetime = time();
  $mdatetime = $cdatetime;

  $order = uc_order_load($order_id);
  // variable for Ubercart
  $context = array(
    'revision' => 'formatted-original',
    'type' => 'amount',
  );
  $options = array(
    'sign' => FALSE,
  );

  if (!is_null($successcode)) {
    // Insert the datafeed into database
    db_query("INSERT INTO {uc_asiapay_datafeed} (src, prc, ord, holder, successcode, ref, payref, amt, cur, remark, authid, eci, payerauth, sourceip, ipcountry, cdatetime, mdatetime) 
		          VALUES (%d, %d, %d, '%s', %d, '%s', %d, %f, '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %d)",
							$src, $prc, $bank_ord, $holder, $successcode, $order_id, $asiapay_ref, $amt, $cur, $cart_id, $authid, $eci, $payerauth, $sourceip, $ipcountry, $cdatetime, $mdatetime);
  }

  switch ($successcode) {
    case 0:
      watchdog('uc_asiapay', 'Receiving AsiaPay datafeed with SUCCESS notification for order @cart_id.', array(
        '@cart_id' => $cart_id,
      ));
      $comment = t('AsiaPay transaction ID: @asiapay_ref', array('@asiapay_ref' => $asiapay_ref));
      uc_payment_enter($order_id, 'asiapay', $amt, $order->uid, NULL, $comment);

      // Empty that cart...
      uc_cart_empty($cart_id);

      // Complete a sale, including adjusting order status and creating user account.
      uc_cart_complete_sale($order);

      uc_order_comment_save($order_id, 0, t('Payment of @amount @cur submitted through AsiaPay.', array('@amount' => uc_price($amt, $context, $options), '@cur' => $cur)), 'order', 'payment_received');
      uc_order_comment_save($order_id, 0, t('AsiaPay IPN reported a payment of @amount @cur.', array('@amount' => uc_price($amt, $context, $options), '@cur' => $cur)));

      break;

    case 1:
      watchdog('uc_asiapay', 'Receiving AsiaPay datafeed with FAIL notification for order @cart_id.', array(
        '@cart_id' => $cart_id,
      ), WATCHDOG_ERROR);
      break;

    default:
      watchdog('uc_asiapay', 'Receiving AsiaPay datafeed with OTHERS notification for order @cart_id.', array(
        '@cart_id' => $cart_id,
      ), WATCHDOG_ERROR);
      break;
  }
  exit(0);
}
