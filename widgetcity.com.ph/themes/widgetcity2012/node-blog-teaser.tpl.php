<div id="node-<?php print $node->nid; ?>" class="clearfix node <?php print $node_classes; ?>">
  <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
  <?php if ($node->field_blogimg[0]['view']): ?>
  <div class="blog-image grid24-3 nested">
  <?php print $node->field_blogimg[0]['view'];?>
  </div>
  <?php endif; ?>
  <?php if ($node->field_blog_teaser[0]['view']): ?>
  <div class="blog-teaser grid24-11 nested">
  <?php print $node->field_blog_teaser[0]['view'];?>
  </div>
  <?php endif; ?>
</div>