<div id="node-<?php echo $node->nid; ?>" class="<?php echo $classes; ?>">
  <div class="node-inner">
    <?php if (!$page): ?>
    <h2 class="title"> <a href="<?php echo $node_url; ?>" title="<?php echo $title ?>"><?php echo $title; ?></a> </h2>
    <?php endif; ?>
    <?php if ($unpublished): ?>
    <div class="unpublished"><?php echo t('Unpublished'); ?></div>
    <?php endif; ?>
    <div class="content">
      <div class="clear-block" id="product-images">
        <?php
				foreach ($node->field_product_image as $product_image):
				 $images[] = theme('imagecache','50x50',$product_image['filepath']);
				 $images_large[] = '<a rel="lightbox[imgs]" href="/'.$product_image['filepath'].'">'.theme('imagecache','product-display',$product_image['filepath'],$product_image['data']['description']).'</a>';
				endforeach;
				?>
        <div id="slideshow-container" class="clear-block">
          <div id="slideshow" class="pics"> <?php echo implode('',$images_large); ?> </div>
          <div id="nav-container">
            <ul id="image-nav" class="clear-block">
              <li><a href="#" rel="nofollow"><?php echo implode('</a><li><a href="#" rel="nofollow">',$images);?></a></li>
            </ul>
          </div>
        </div>
        <div id="product-cart">
          <?php 
					if ($phaseout):
						echo '<strong class="phaseout">Phase Out</strong>';
					else:
						if ($node->list_price > 0):
						echo $node->content['list_price']['#value'];
						endif;
						echo $node->content['sell_price']['#value'];
						echo $node->content['add_to_cart']['#value'];
						if ($node->field_freeshipping[0]['value']):
						 echo '<div class="free-shipping" style="padding:5px 0;"><span style="color:red;">***</span><strong style="font-size:14px;">Free Shipping</strong></div>';
						endif;
					endif;
					?>
          <div class="call-badge">Call or Text: <strong>09175423438</strong><br />
Note: Please book your order before you come.</div>
          <noscript>
          <strong style="color:#FF0000;">You should enable javascript to show the correct price.</strong>
          </noscript>
          <iframe width="250" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Victoria+de+Manila,+1655+Taft+Ave.,+Manila.+Taft+Avenue,+Manila,+Philippines&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=33.160552,79.013672&amp;ie=UTF8&amp;hq=Victoria+de+Manila,+1655+Taft+Ave.,+Manila.&amp;hnear=Taft+Ave,+Manila,+Metro+Manila,+Philippines&amp;ll=14.575048,120.988398&amp;spn=0.004153,0.005343&amp;z=16&amp;iwloc=A&amp;output=embed"></iframe><br /><small style="text-align:center; margin:0 auto; width:90px; display:block;"><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Victoria+de+Manila,+1655+Taft+Ave.,+Manila.+Taft+Avenue,+Manila,+Philippines&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=33.160552,79.013672&amp;ie=UTF8&amp;hq=Victoria+de+Manila,+1655+Taft+Ave.,+Manila.&amp;hnear=Taft+Ave,+Manila,+Metro+Manila,+Philippines&amp;ll=14.575048,120.988398&amp;spn=0.00623,0.006437&amp;z=16&amp;iwloc=A" style="color:#0000FF;text-align:center;" target="_WCTMAP">View Larger Map</a></small>
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
			$quicktabs1['style'] = 'Dark';
			$quicktabs1['ajax'] = FALSE;
			echo theme('quicktabs', $quicktabs1);
			echo '</div>';
		endif; ?>
    </div>
    <?php if ($links): ?>
    <div class="clear-block">
      <div class="links"><?php print $links; ?></div>
    </div>
    <?php endif; ?>
  </div>
</div>