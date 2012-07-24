<div class="clear-block" id="product-images">
<?php
foreach ($node->field_product_image as $product_image):
 $images[] = theme('imagecache','50x50',$product_image['filepath']);
 $images_large[] = '<a rel="lightbox[imgs]" href="/'.$product_image['filepath'].'">'.theme('imagecache','product-display',$product_image['filepath'],$product_image['data']['description']).'</a>';
endforeach;
?>
  <div id="slideshow-container" class="clear-block">
    <div id="slideshow" class="pics"> <?php echo implode('',$images_large); ?> </div>
  </div>
  <div id="nav-container">
    <ul id="image-nav" class="clear-block">
      <li><a href="#" rel="nofollow"><?php echo implode('</a><li><a href="#" rel="nofollow">',$images);?></a></li>
    </ul>
  </div>
  <div id="product-cart">
		<?php echo $node->content['add_to_cart']['#value'] ?>
    <?php if ($node->field_freeshipping[0]['value']): ?>
    <div class="free-shipping" style="padding:5px 0;"><span style="color:red;">***</span><strong style="font-size:14px;">Free Shipping</strong></div>
    <?php endif; ?>
    <div class="clear-block">
 			<div class="product-info product display"><span class="uc-price-product uc-price-display uc-price"><?php echo uc_currency_format($node->sell_price);?></span></div>
    </div>
    <div class="call-badge">Call or Text:<br /><strong>09228423438</strong> / <strong>09065529590</strong></div>
    <noscript><strong style="color:#FF0000;">You should enable javascript to show the correct price.</strong></noscript>
  </div>
</div>
<?php echo $node->content['body']['#value']; ?>
<?php
if ($node->field_withtab[0]['value']):
	echo '<div id="product-tabs">';
	$count=1;
	$tabs['tab1'] = array(
				'title' => '',
				'type' => 'freetext',
				'text' => '',
			);
	do {
		$field = 'field_detail_'.$count;
		$tablabel = 'field_label_'.$count;
		$ptab = $node->$field;
		$plabel = $node->$tablabel;
		if (!empty($plabel[0]['value'])):
			$tabs['tab'.$count] = array(
				'title' => t($plabel[0]['value']),
				'type' => 'freetext',
				'text' => check_markup($ptab[0]['value']),
			);
		endif;
		$count++;
		$field = 'field_detail_'.$count;  
	} while (isset($node->$field));
	$quicktabs1['qtid'] = '101';
	$quicktabs1['tabs'] = $tabs;
	$quicktabs1['style'] = 'Excel';
	$quicktabs1['ajax'] = FALSE;
	echo theme('quicktabs', $quicktabs1);
	echo '</div>';
endif; ?>