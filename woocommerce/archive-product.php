<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); global $bella_options,$wp_query;?>
<?php $shop_layout=$bella_options['shop_layout'];?>
		<section class="page-section with-sidebar">
			<?php
			/**
			* woocommerce_before_main_content hook
			*
			* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			* @hooked woocommerce_breadcrumb - 20
			*/
			do_action( 'woocommerce_before_main_content' );
				if($shop_layout=='left-sidebar' || $shop_layout=='list-view'):?>
					<?php if(is_active_sidebar('bella-widgets-woocommerce-sidebar')){?>
						<aside class="col-md-3 sidebar" id="sidebar">
							<?php dynamic_sidebar('bella-widgets-woocommerce-sidebar');?>
						</aside> 
					<?php } 
				endif;?>
			<?php do_action( 'woocommerce_archive_description' ); ?>
			<div class="col-md-9 content" id="content">
				<?php if (have_posts() ) : ?>
					<?php wc_get_template('loop/main-slider.php');
					/**
					* woocommerce_before_shop_loop hook
					*
					* @hooked woocommerce_result_count - 20
					* @hooked woocommerce_catalog_ordering - 30
					*/
					echo '<div class="shop-sorting">';
						do_action( 'woocommerce_before_shop_loop' );
					echo '</div>';
					woocommerce_product_loop_start(); ?>
					<?php woocommerce_product_subcategories(); ?>                           
					<?php while ( have_posts() ) : the_post(); ?>
						<?php if($shop_layout=='left-sidebar' || $shop_layout=='right-sidebar'):?>
							<div class="col-md-4 col-sm-6 grid-item">
								<?php wc_get_template_part( 'content', 'product' ); ?>
							</div> 
						<?php else:
							 wc_get_template_part( 'content', 'product-list' ); 
						endif;?>
					<?php endwhile; // end of the loop. ?>
					<?php woocommerce_product_loop_end(); ?>
					<?php   if ($wp_query->max_num_pages>1) : 
						/**
						* woocommerce_after_shop_loop hook
						*
						* @hooked woocommerce_pagination - 10
						*/
						do_action( 'woocommerce_after_shop_loop' );
					endif;?>
					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
						<?php wc_get_template( 'loop/no-products-found.php' ); ?>
				<?php endif; 
				wp_reset_postdata();?>
			</div>
			<?php if($shop_layout=='right-sidebar'):?>
				<?php if(is_active_sidebar('bella-widgets-woocommerce-sidebar')){?>
				<aside class="col-md-3 sidebar" id="sidebar">
					<?php dynamic_sidebar('bella-widgets-woocommerce-sidebar');?>
				</aside> 
			<?php }
			endif;?>			
			<?php
			/**
			* woocommerce_after_main_content hook
			*
			* @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			*/
			do_action( 'woocommerce_after_main_content' );?>
		</section>
	<?php woocommerce_get_template('single-product/shop-banners.php');		                   
 get_footer( 'shop' ); ?>
