<?php // $Id: viewscarousel3d.tpl.php,v 1.1.2.1 2010/08/15 21:44:32 rashad612 Exp $ 
?>
<div id="<?php print $current_display; ?>-wrapper" class="views-carousel-3d-wrapper">
  <div id="<?php print $current_display; ?>" class="viewscarousel3d">
    <?php foreach ($rows as $row): ?>
      <div class="views-carousel-3d-item"><?php print $row; ?></div>
    <?php endforeach; ?>
  </div>
</div>
