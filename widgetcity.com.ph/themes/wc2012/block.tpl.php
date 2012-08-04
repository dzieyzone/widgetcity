<div id="block-<?php print $block->module . '-' . $block->delta; ?>" class="<?php print $classes; ?><?php if (function_exists('block_class')) {echo ' '.block_class($block);} ?>">
  <div class="block-inner">
    <?php if ($block->subject): ?>
    <div class="block-title">
      <h2 class="title"><?php echo $block->subject; ?></h2>
    </div>
    <?php endif; ?>
    <div class="block-content clearfix">
		<?php print $block->content; ?>
    </div>
    <?php print $edit_links; ?> </div>
</div>
