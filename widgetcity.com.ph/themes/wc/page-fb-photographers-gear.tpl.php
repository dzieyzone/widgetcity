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

<style type="text/css">
	body{
		background:#FFF;
		font-family:Verdana,Geneva,sans-serif,Arial,Helvetica;
		font-size:12px;
	}
	#page{
		background:#FFF;
	}
	#main-inner{
		width:500px;
	}
	#content-left{
		width:490px;
	}
</style>
<script type="text/javascript">
     $(document).ready(function() {
            $("a").each(function() {
                $(this).attr("target", "_blank");
            });
        });
</script>
</head>
<body class="fb_canvas-resizable">
<div id="page">

  <div id="main">
    <div id="main-inner" class="clear-block">
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
          <div id="content-area" class="clear-block">
		  		<?php echo $content; ?>
          </div>
          <?php endif; ?>
          <?php if ($content_bottom): ?>
          <div id="content-bottom" class="region region-content_bottom"> <?php print $content_bottom; ?> </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php print $closure; ?>
</body>
</html>