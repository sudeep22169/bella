<?php

/**

 * The template for displaying product content within loops.

 *

 * Override this template by copying it to yourtheme/woocommerce/content-product.php

 *

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     1.6.4

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

      <div class="row">      

          <div class="col-md-4">

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

                          do_action( 'woocommerce_before_shop_loop_item_title' );?>

                      <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>

                  </a>

              </div>

          </div>

          <div class="col-md-8">

              <div class="caption">

                  <a  href="<?php the_permalink(); ?>"><h4 class="caption-title list"><?php the_title(); ?></h4></a>                 

                  <?php if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {

                          return;

                      }

                      

                      $rating_count = $product->get_rating_count();

                      $review_count = $product->get_review_count();

                      $average      = $product->get_average_rating();

                      

                      if ( $rating_count > 0 ) : ?>

                  <div class="rating">

                      <?php 	

                              $args = array(

                             'rating' => $average,

                             'type' => 'rating'

                      );?><?php wp_star_rating( $args ); ?>

                  </div>

                  <?php endif;?>

                  <?php if ( comments_open() && $review_count!=0) : ?>

                   <a href="<?php the_permalink();?>" class="reviews" rel="nofollow"><?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), '' . $review_count . '' ); ?></a> 

                   <?php endif ?>                

                  <div class="overflowed">

                        <?php $count=$product->get_stock_quantity();

                        if($count!=0):?>

                             <div class="availability"><?php _e('Availability:','bella')?><strong><?php _e(' In stock','bella')?></strong>

                              <?php echo $count.' Item(s)';?></div>

                        <?php endif;?>		

                         <div class="price"><?php echo $product->get_price_html(); ?></div>

                   </div>                   

                  <div class="caption-text"><?php the_excerpt(); ?></div>

                  <div class="buttons">                                               

                    <?php
                    

                      /**

                      * woocommerce_after_shop_loop_item hook

                      *

                      * @hooked woocommerce_template_loop_add_to_cart - 10

                      */

                      do_action( 'woocommerce_after_shop_loop_item' ); 

                    
                      if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {              
                      echo  do_shortcode('[yith_wcwl_add_to_wishlist]');               
                      }


                      if (is_plugin_active('yith-woocommerce-compare/init.php')) {
                          echo do_shortcode('[yith_compare_button]');
                          
                      }

                      ?>              

                                            

                  </div>

              </div>

          </div>

      </div>

</div>



		 

