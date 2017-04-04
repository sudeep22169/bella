<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<div class="thumbnail no-border no-padding">
	<div class="media">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<?php if ( ! class_exists( 'YITH_WCQV' ) ) : ?>
		<a  href="<?php the_permalink(); ?>" class="button media-link" data-product_id="<?php echo $product->id; ?>">
		<?php else : ?>	
		<a  href="#" class="button yith-wcqv-button media-link" data-product_id="<?php echo $product->id; ?>">
		<?php endif; ?>
			<?php
			/**
			* woocommerce_before_shop_loop_item_title hook
			*
			* @hooked woocommerce_show_product_loop_sale_flash - 10
			* @hooked woocommerce_template_loop_product_thumbnail - 10
			*/
			do_action( 'woocommerce_before_shop_loop_item_title' );	?>
			<span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
		</a>

	</div>

	<div class="caption text-center">

		<a  href="<?php the_permalink(); ?>"><h4 class="caption-title"><?php the_title(); ?></h4></a>
		<?php
		/**
		* woocommerce_after_shop_loop_item_title hook
		*
		* @hooked woocommerce_template_loop_rating - 5
		* @hooked woocommerce_template_loop_price - 10
		*/
		do_action( 'woocommerce_after_shop_loop_item_title' );?>

	     <div class="buttons">
		     <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {              
		                echo  do_shortcode('[yith_wcwl_add_to_wishlist]');               
		            }
			
			/**
			* woocommerce_after_shop_loop_item hook
			*
			* @hooked woocommerce_template_loop_add_to_cart - 10
			*/
			do_action( 'woocommerce_after_shop_loop_item' ); 
			if (is_plugin_active('yith-woocommerce-compare/init.php')) {
                echo do_shortcode('[yith_compare_button]');
                
            }
			?>
		</div>
	</div>	
</div>