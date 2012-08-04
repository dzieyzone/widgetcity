<div class="<?php echo $classes; ?>">
  <div class="node-inner">
    <?php if ($unpublished): ?>
    <div class="unpublished"><?php echo t('Unpublished'); ?></div>
    <?php endif; ?>
  </div>
  <div class="views-field-title"><span class="field-content"><a href="<?php echo $node_url; ?>" title="<?php echo $title ?>"><?php echo $title; ?></a></span></div>
  <div class="views-field-field-product-image-fid">
    <div class="field-content"><a href="<?php echo $node_url; ?>" title="<?php echo $title ?>"><?php echo theme('imagecache', 'product-list', $node->field_product_image[0]['filepath'], $node->field_product_image[0]['data']['description'], $node->field_product_image[0]['data']['description']);?></a></div>
  </div>
  <div class="views-field-sell-price"><span class="field-content"><span class="uc-price-product uc-price-sell_price uc-price"><?php echo uc_currency_format($node->sell_price);?></span></span></div>
  <div class="views-field-buyitnowbutton">
    <div class="field-content">
      <?php echo drupal_get_form('uc_catalog_buy_it_now_form', $node);?>
    </div>
  </div>
  <div class="views-field-nid"> <span class="field-content"><a href="<?php echo $node_url; ?>" title="<?php echo $title ?>">More Info</a></span> </div>
</div>
