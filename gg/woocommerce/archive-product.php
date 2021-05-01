<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if (is_shop() || is_product_category()) {
    add_action('theme_content_styles', 'theme_products_content_styles');
    function products_index_body_class_filter($classes) {
        $classes[] = 'u-body';
        return $classes;
    }
    add_filter('body_class', 'products_index_body_class_filter');

    function products_index_body_style_attribute() {
        return "";
    }
    add_filter('add_body_style_attribute', 'products_index_body_style_attribute');

    function products_index_body_back_to_top() {
        return <<<BACKTOTOP

BACKTOTOP;
    }
    add_filter('add_back_to_top', 'products_index_body_back_to_top');

    function products_index_get_local_fonts() {
        return '';
    }
    add_filter('get_local_fonts', 'products_index_get_local_fonts');

    ob_start();
    get_header();
    $header = ob_get_clean();
    if (function_exists('renderHeader')) {
        renderHeader($header, '', 'echo');
    } else {
        echo $header;
    }
    theme_layout_before('products');

    $first_repeatable = 2;
    $last_repeatable = 1;

    $template_used = array();
    $templates_count = 2;

    $products_sections_count = $last_repeatable + 1;

    if (have_posts() && $products_sections_count) {
        for ($template_idx = 0; $template_idx < $templates_count; $template_idx++) {
            get_template_part('/woocommerce/template-parts/product-content-' . ($template_idx + 1));
        }
    }

    theme_layout_after('products');

    ob_start();
    get_footer();
    $footer = ob_get_clean();
    if (function_exists('renderFooter')) {
        renderFooter($footer, '', 'echo');
    } else {
        echo $footer;
    }
    remove_filter('body_class', 'products_index_body_class_filter');
    remove_action('theme_content_styles', 'theme_products_content_styles');
} else {
    get_header( 'shop' );

    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    do_action( 'woocommerce_before_main_content' );

    ?>
    <header class="woocommerce-products-header">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php
        /**
         * Hook: woocommerce_archive_description.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action( 'woocommerce_archive_description' );
        ?>
    </header>
    <?php
    if ( woocommerce_product_loop() ) {

        /**
         * Hook: woocommerce_before_shop_loop.
         *
         * @hooked woocommerce_output_all_notices - 10
         * @hooked woocommerce_result_count - 20
         * @hooked woocommerce_catalog_ordering - 30
         */
        do_action( 'woocommerce_before_shop_loop' );

        woocommerce_product_loop_start();

        if ( wc_get_loop_prop( 'total' ) ) {
            while ( have_posts() ) {
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action( 'woocommerce_shop_loop' );

                wc_get_template_part( 'content', 'product' );
            }
        }

        woocommerce_product_loop_end();

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action( 'woocommerce_after_shop_loop' );
    } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action( 'woocommerce_no_products_found' );
    }

    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );

    /**
     * Hook: woocommerce_sidebar.
     *
     * @hooked woocommerce_get_sidebar - 10
     */
    do_action( 'woocommerce_sidebar' );

    get_footer( 'shop' );
}
