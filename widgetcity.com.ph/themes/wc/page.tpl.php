<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<head>
<title><?php print $head_title; ?></title>
<?php print $head; ?><?php print $styles; ?>
<!--[if lt IE 8]>
   <style type="text/css">
   #block-menu-menu-product-menu li a {display:inline-block;}
   #block-menu-menu-product-menu li a {display:block;}
   </style>
<![endif]-->
<?php print $scripts; ?>
</head>
<body class="fb_canvas-resizable <?php print $body_classes; ?>">
<div id="page">
  <div id="header">
    <div id="header-inner" class="clear-block">
      <?php if ($header): ?>
      <div id="header-blocks" class="region region-header clear-block">
        <div class="header-block-left"> <?php echo $header; ?> </div>
        <div id="block-expand-cart">
          <?php
          $cart = module_invoke('uc_cart', 'get_contents');
					$block = module_invoke('uc_cart', 'block', 'view', 0);
          $cart_count = (is_array($cart)) ? count($cart) : 0;
          echo '<a id="expandcart" href="#">What\'s on my Cart ('.$cart_count.')?</a>';
					echo '<div id="block-cart-content">'.$block['content'].'</div>';
        ?>
        </div>
      </div>
      <?php endif; ?>
      <div id="header-logo-menu-search">
        <div id="header-logo-menu-search-inner" class="clear-block">
          <?php if ($logo): ?>
          <div id="logo-title">
            <?php if ($logo): ?>
            <div id="logo"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" id="logo-image" /></a></div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
          <div id="navbar" class="clear-block">
            <div id="navbar-inner" class="clear-block region region-navbar"> <?php echo $navbar; ?>
              <?php if ($search_box): ?>
              <div id="search-box" class="clear-block"> <?php print $search_box; ?> </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="main">
    <div id="main-inner" class="clear-block">
      <?php if ($body_top): ?>
      <div id="body-top">
        <div id="body-top-inner" class="clear-block"> <?php echo $body_top; ?> </div>
      </div>
      <?php endif; ?>
      <?php if ($right): ?>
      <div id="sidebar-right">
        <?php if ($feed_icons && FALSE): ?>
        <span class="feed-icons"><?php print $feed_icons; ?></span>
        <?php endif; ?>
        <div id="sidebar-right-inner" class="region region-right"> <?php print $right; ?> </div>
      </div>
      <?php endif; ?>
      <div id="content<?php echo ($right)?'-left':'';?>">
        <div id="content-inner">
          <?php if ($mission): ?>
          <div id="mission"><?php print $mission; ?></div>
          <?php endif; ?>
          <?php if ($content_top): ?>
          <div id="content-top" class="region region-content_top"> <?php print $content_top; ?> </div>
          <?php endif; ?>
          <?php echo $breadcrumb; ?> <?php print $messages; ?>
          <?php if (arg(0) != 'frontpage'): ?>
          <?php if ($title || $tabs || $help): ?>
          <div id="content-header">
            <?php if ($title): ?>
            <h1 class="title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php if ($tabs): ?>
            <div class="tabs"><?php print $tabs; ?></div>
            <?php endif; ?>
            <?php print $help; ?> </div>
          <?php endif; ?>
          <div id="content-area" class="clear-block"> <?php print $content; ?>
          </div>
          <?php endif; ?>
          <?php if ($content_bottom): ?>
          <div id="content-bottom" class="region region-content_bottom"> <?php print $content_bottom; ?> </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div id="main-bottom">
    <div id="main-bottom-inner" class="region region-footer clear-block">
      <?php if ($main_bottom_a): ?>
      <div id="main_bottom_a" class="clear-block"> <?php print $main_bottom_a; ?> </div>
      <?php endif; ?>
      <?php if ($main_bottom_b): ?>
      <div id="main_bottom_b" class="clear-block"> <?php print $main_bottom_b; ?> </div>
      <?php endif; ?>
      <?php if ($main_bottom_c): ?>
      <div id="main_bottom_c" class="clear-block"> <?php print $main_bottom_c; ?> </div>
      <?php endif; ?>
    </div>
  </div>
  <div id="footer">
    <div id="footer-inner" class="region region-footer">
      <?php if ($footer_message): ?>
      <div id="footer-message"><?php print $footer_message; ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php print $closure; ?>
<!-- Begin Olark Chat -->
<script type="text/javascript">
(function(){document.write(unescape('%3Cscript src=%27' + (document.location.protocol == 'https:' ? "https:" : "http:") + '//static.olark.com/js/wc.js%27 type=%27text/javascript%27%3E%3C/script%3E'));})();</script>
<div id="olark-data"><a class="olark-key" id="olark-6599-186-10-5524" title="Powered by Olark" href="http://olark.com/about" rel="nofollow">Powered by Olark</a></div>
<script type="text/javascript">
$(document).ready(function(){
	wc_init();
});
</script>
<!-- /End Olark Chat -->
</body>
</html>