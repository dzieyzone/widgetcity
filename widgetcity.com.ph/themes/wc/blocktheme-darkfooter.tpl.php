<div id="block-<?php echo $block->module . '-' . $block->delta; ?>" class="<?php echo $classes; ?> block-darkfooter<?php if (function_exists('block_class')) echo ' '.block_class($block); ?>">
  <div class="block-inner">
    <?php if ($block->subject): ?>
    <div class="block-title">
      <h2 class="title"><?php echo $block->subject; ?></h2>
    </div>
    <?php endif; ?>
    <div class="block-content clear-block"> <?php echo $block->content; ?> </div>
    <?php print $edit_links; ?> </div>
  <div class="footer">
    <div class="left">
      <div class="right">
        <div class="mid"></div>
      </div>
    </div>
  </div>
</div>
