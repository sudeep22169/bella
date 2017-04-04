<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>              
                                            
	<div class="product-rating clearfix" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
    <div class="rating">
    <?php 
	
	$args = array(
   'rating' => $average,
   'type' => 'rating'
 
		);?>
		 <?php wp_star_rating( $args ); ?>
        </div>
		
		<?php if ( comments_open() ) : ?>
        <a href="#reviews" class="reviews" rel="nofollow"><?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), '' . $review_count . '' ); ?></a> | <a class="add-review" href="#reviews">Add Your Review</a><?php endif ?>
	</div>
  
<?php endif; ?>
<div class="product-availability">
		<?php $count=$product->get_stock_quantity();
        if($count!=0):?>
              Availability:<strong> In stock</strong>
              <?php echo $count.' Item(s)';
        endif;?>
</div>
<hr class="page-divider small"/>