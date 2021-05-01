<?php $skip_min_height = false; ?><section class="u-align-center u-clearfix u-section-1" id="sec-9cdf">
  <div class="u-clearfix u-sheet u-valign-middle u-sheet-1"><?php
$productsJson = '{"type":"Recent","source":"","tags":"","count":"","gridProps":[{"mode":"XL","columns":3,"gap":0,"styles":".u-section-1 .u-repeater-1 {grid-auto-rows: [[XL_VALUE]] !important}"},{"mode":"LG","columns":3,"gap":0,"styles":"@media (max-width: 1199px) {.u-section-1 .u-repeater-1 {grid-auto-rows: [[LG_VALUE]] !important}}"},{"mode":"MD","columns":2,"gap":0,"styles":"@media (max-width: 991px) {.u-section-1 .u-repeater-1 {grid-auto-rows: [[MD_VALUE]] !important}}"},{"mode":"SM","columns":1,"gap":0,"styles":"@media (max-width: 767px) {.u-section-1 .u-repeater-1 {grid-auto-rows: [[SM_VALUE]] !important}}"},{"mode":"XS","columns":1,"gap":0,"styles":"@media (max-width: 575px) {.u-section-1 .u-repeater-1 {grid-auto-rows: [[XS_VALUE]] !important}}"}]}';
global $wp_query; $all = count($wp_query->posts); echo getGridAutoRowsStyles($productsJson, $all);
?>

    <?php global $product; if (!$product) {
	global $post; $product = wc_get_product($post->ID);
} ?><div class="u-expanded-width u-products u-repeater u-repeater-1"><!--product_item-->
      <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); $product = wc_get_product($post->ID); $productItemInvisible = !wp_get_attachment_image_url($product->get_image_id()) ? true : false; ?><div class="u-align-center u-container-style u-products-item u-repeater-item u-white u-repeater-item-1">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1"><!--product_image-->
          <?php
                            $product_image = theme_get_post_image(array('class' => 'u-expanded-width u-image u-image-default u-product-control u-image-1', 'default' => '/images/4.svg'));
                            if ($product_image) echo $product_image; else { echo '<div class="hidden-image"></div>'; $skip_min_height = true; } ?><!--/product_image--><!--product_title-->
          <h4 class="u-product-control u-text u-text-1">
            <a class="u-product-title-link" href="<?php the_permalink(); ?>"><?php echo $product->get_title(); ?></a>
          </h4><!--/product_title--><!--product_price-->
          <div class="u-product-control u-product-price u-product-price-1">
            <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
              <div class="u-hide-price u-old-price"><?php $regularPrice = wc_price($product->get_regular_price()); if ($product->get_regular_price() !== '') { echo $regularPrice; } ?></div><!--/product_old_price--><!--product_regular_price-->
              <div class="u-price u-text-palette-2-base" style="font-size: 1.25rem; font-weight: 700;"><?php if($product->is_type('variable')) { if ($product->get_variation_sale_price( 'min', true ) && $product->get_variation_sale_price( 'max', true )) { echo wc_price($product->get_variation_sale_price( 'min', true )) . ' - ' . wc_price($product->get_variation_sale_price( 'max', true ));} else { echo wc_price(false); } } else {echo wc_price($product->get_price());} ?></div><!--/product_regular_price-->
            </div>
          </div><!--/product_price--><?php
$clickTypeProductbutton = 'add-to-cart';
$contentProductbutton = '';
?>

          <?php ob_start() ?>
						‌<a data-quantity="1" data-product_id="%s" data-product_sku="%s" href="%s" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-1 %s">%s</a>
						<?php $button_html = ob_get_clean();
		                $button_html = getProductsButtonHtml($button_html, $product, $clickTypeProductbutton, $contentProductbutton);
		                echo $button_html; ?>
        </div>
      </div><?php endwhile; ?><!--/product_item--><!--product_item-->
      <!--/product_item--><!--product_item-->
      <!--/product_item--><!--product_item-->
      <!--/product_item--><!--product_item-->
      <!--/product_item--><!--product_item-->
      <!--/product_item-->
    </div>
  </div>
</section><?php if ($skip_min_height) { echo "<style> .u-section-1, .u-section-1 .u-sheet {min-height: auto;}</style>"; } ?>