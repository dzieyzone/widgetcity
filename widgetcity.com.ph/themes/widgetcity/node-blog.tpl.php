<div id="node-<?php echo $node->nid; ?>" class="<?php echo $classes; ?>">
  <div class="node-inner">
    <?php if (!$page): ?>
    <h2 class="title"> <a href="<?php echo $node_url; ?>" title="<?php echo $title ?>"><?php echo $title; ?></a> </h2>
    <?php endif; ?>
    <?php if ($unpublished): ?>
    <div class="unpublished"><?php echo t('Unpublished'); ?></div>
    <?php endif; ?>
    <div class="content">
    	<div style="padding:0 0 10px 0;"><?php print ucfirst($node->name) ?> wrote on <?php print date('F t, Y',$node->revision_timestamp) ?></div>
    	<?php echo $content; ?>
      </div>
    <?php if ($comment): ?>
    <div class="block-widget product-comments">
    	<div class="block-title">
      	<h2>Comments</h2>
      </div>
      <div class="content clear-block">
			<?php echo $links;?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</div>