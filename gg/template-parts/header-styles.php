<!-- header styles -->

<?php
   $localFonts = apply_filters('get_local_fonts', '');
?>
<?php if ($localFonts) : ?> 
   <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $localFonts; ?>" media="screen" type="text/css" />
<?php else : ?>
   <?php endif; ?>

<style>.u-header {
  background-image: none;
}
.u-header .u-sheet-1 {
  min-height: 100px;
}
.u-header .u-menu-1 {
  margin: 28px 0 28px auto;
}
.u-header .u-nav-1 {
  font-size: 1.5rem;
  letter-spacing: 0px;
  font-weight: 500;
}
.u-block-efe9-19 {
  box-shadow: 2px 2px 8px 0 rgba(128,128,128,1);
}
.u-header .u-nav-2 {
  font-size: 1.25rem;
}
.u-block-efe9-20 {
  box-shadow: 2px 2px 8px 0 rgba(128,128,128,1);
}
@media (max-width: 1199px) {
  .u-header .u-menu-1 {
    width: auto;
  }
}</style>
