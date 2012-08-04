<div class="clear-block" id="product-images">
<?php
foreach ($node->field_product_image as $product_image):
 $images[] = theme('imagecache','50x50',$product_image['filepath']);
 $images_large[] = '<a rel="lightbox[imgs]" href="/'.$product_image['filepath'].'">'.theme('imagecache','product-display',$product_image['filepath'],$product_image['data']['description']).'</a>';
endforeach;
?>
  <div id="slideshow-container">
    <div id="slideshow" class="pics"> <?php echo implode('',$images_large); ?> </div>
  </div>
  <div id="nav-container">
    <ul id="image-nav" class="clear-block">
      <li><a href="#" rel="nofollow"><?php echo implode('</a><li><a href="#" rel="nofollow">',$images);?></a></li>
    </ul>
  </div>
	<?php print $node->content['add_to_cart']['#value'] ?>
</div>
<?php if ($node->field_withtab[0]['value']): ?>
<div class="product-tabs clear-block">
<?php
$li = $tab_content = array();
for ($count=1;$count<=2;$count++):
	$field = 'field_detail_'.$count;
	$tablabel = 'field_label_'.$count;
	$ptab = $node->$field;
	$plabel = $node->$tablabel;
	if (!empty($plabel[0]['view'])):
		$li[] = '<li><a href="#fragment-'.$count.'"><span>'.$plabel[0]['view'].'</span></a></li>';
		$tab_content[] = '<div id="fragment-'.$count.'">'.$ptab[0]['view'].'</div>';
	endif;
endfor;
  echo '<ul>', implode('',$li),'</li>',implode('',$tab_content);
?>
</div>
<?php endif; ?>
<?php echo $node->content['body']['#value']; ?>