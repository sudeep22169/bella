<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop; ?>
 
<section class="page-section">
    <div class="container">
    <?php if ( empty( $product ) || ! $product->exists() ) {
        return;
        }$posts_per_page=50;
        $related = $product->get_related( $posts_per_page );
        if ( sizeof( $related ) == 0 ) return;
        $args = apply_filters( 'woocommerce_related_products_args', array(
        'post_type'            => 'product',
        'ignore_sticky_posts'  => 1,
        'no_found_rows'        => 2,
        'posts_per_page'       => $posts_per_page,
        'orderby'              => $orderby,
        'post__in'             => $related,
        'post__not_in'         => array( $product->id )
        ) );
        $products = new WP_Query( $args );
        $woocommerce_loop['columns'] = $columns;
        if ( $products->have_posts() ) : ?> 
            <h2 class="section-title section-title-lg"><span><?php _e( 'Related Products', 'woocommerce' ); ?></span></h2>
            <div class="featured-products-carousel">
                <?php //woocommerce_product_loop_start(); ?>
                <div class="owl-carousel" id="featured-products-carousel">
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; // end of the loop. ?>
                </div>
                <?php //woocommerce_product_loop_end(); ?>
            </div>
        <?php endif;
        wp_reset_postdata();?>
        <hr class="page-divider half"/>
    </div>
</section>


