<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
if ( $rating_count > 0 ) : ?>
    <div class="rating">
	    <?php $args = array(
	   		'rating' => $average,
	   		'type' => 'rating');?>
		<?php wp_star_rating( $args ); ?>
    </div> 
<?php endif; ?>
