<div id="node-<?php print $node->nid; ?>" class="node clear-block <?php print $node_classes; ?>">
  <div class="inner">
    <?php if ($page == 0): ?>
    <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
    <?php if ($submitted): ?>
    <div class="meta">
      <span class="submitted"><?php print $submitted ?></span>
    </div>
    <?php endif; ?>
    <?php if ($node_top && !$teaser): ?>
    <div id="node-top" class="node-top row nested">
      <div id="node-top-inner" class="node-top-inner inner">
        <?php print $node_top; ?>
      </div><!-- /node-top-inner -->
    </div><!-- /node-top -->
    <?php endif; ?>
    <div id="product-images" class="product-group clearfix">
			<?php
      foreach ($node->field_product_image as $product_image):
       $images[] = theme('imagecache','50x50',$product_image['filepath']);
       $images_large[] = '<a rel="lightbox[imgs]" href="/'.$product_image['filepath'].'">'.theme('imagecache','product-display-wc',$product_image['filepath'],$product_image['data']['description']).'</a>';
      endforeach;
      ?>
      <div id="slideshow-container" class="clearfix grid24-6 nested">
        <div id="slideshow" class="pics"> <?php echo implode('',$images_large); ?> </div>
        <div id="nav-container">
          <ul id="image-nav" class="clearfix">
            <li><a href="#" rel="nofollow"><?php echo implode('</a><li><a href="#" rel="nofollow">',$images);?></a></li>
          </ul>
        </div>
      </div>
      <div id="product-cart" class="grid24-indent-1 grid24-6 nested">
          <?php 
					if ($phaseout):
						echo '<strong class="phaseout">Phase Out</strong>';
					else:
						if ($node->list_price > 0):
						echo $node->content['list_price']['#value'];
						endif;
						echo $node->content['sell_price']['#value'];
//						echo '<div style="display:none;">'. print_r($node->content, true) . '</div>';
            if ($node->field_multiply_page[0]['value'] || ($node->field_multiply_page[0]['value'] != 'http://widgetcity.multiply.com/') ):
              echo l('Checkout with Multiply',
										   $node->field_multiply_page[0]['value'], 
										   array('attributes'=> array('class'=>'checkout-button')
						           )
										 );
						endif;
						echo $node->content['add_to_cart']['#value'];
						if ($node->field_freeshipping[0]['value']):
						 echo '<div class="free-shipping" style="padding:5px 0;"><span style="color:red;">***</span><strong style="font-size:14px;">Free Shipping</strong></div>';
						endif;
					endif;
					?>
          <noscript>
          <strong style="color:#FF0000;">You should enable javascript to show the correct price.</strong>
          </noscript>
        </div>
    </div><!-- /product-group -->
    <div class="content clearfix">
        <div id="content-body">
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
			$quicktabs1['style'] = 'Widget';
			$quicktabs1['ajax'] = FALSE;
			echo theme('quicktabs', $quicktabs1);
			echo '</div>';
		endif; ?>
        </div>
        <!-- /hide terms
        <?php if ($terms): ?>
        <div class="terms">
          <?php print $terms; ?>
        </div>
        <?php endif;?>
         -->

        <?php if ($links && !$teaser): ?>
        <div class="links clear">
          <?php print $links; ?>
        </div>
        <?php endif; ?>
      </div><!-- /content -->
  </div><!-- /inner -->

  <?php if ($node_bottom && !$teaser): ?>
  <div id="node-bottom" class="node-bottom row nested">
    <div id="node-bottom-inner" class="node-bottom-inner inner">
      <?php print $node_bottom; ?>
    </div><!-- /node-bottom-inner -->
  </div><!-- /node-bottom -->
  <?php endif; ?>
</div>
