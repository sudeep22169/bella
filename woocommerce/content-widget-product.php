<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
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
global $product; ?>
<div class="thumbnail no-border no-padding">
    <div class="media">
     <a  href="#" class="button yith-wcqv-button media-link" data-product_id="<?php echo $product->id; ?>">
			<?php the_post_thumbnail('top-product-thumbnails'); ?>    
         <span class="icon-view">
                    <strong><i class="fa fa-eye"></i></strong>
          </span>          
     </a>
       
    </div>
    <div class="caption text-center">
        <a  href="<?php the_permalink(); ?>"><h4 class="caption-title"><?php echo $product->get_title(); ?></h4></a>
      
        <?php if ( ! empty( $show_rating ) )$rating_count = $product->get_rating_count();
			$review_count = $product->get_review_count();
			$average      = $product->get_average_rating();
			
			if ( $rating_count > 0 ) : ?>
			<div class="rating">
				<?php 
				
				$args = array(
			   'rating' => $average,
			   'type' => 'rating'
			 
					);?>
					 <?php wp_star_rating( $args ); ?>
			</div><?php endif; ?> 
        <div class="price">
            <?php echo $product->get_price_html(); ?>
        </div>
        <div class="buttons">
             <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {              
                        echo  do_shortcode('[yith_wcwl_add_to_wishlist]');  
                           }    
            ?>
             <a data-product_id="<?php echo $product->id;?>" data-product_sku="<?php echo $product->get_sku();?>" data-quantity="%s" class="btn btn-theme btn-theme-transparent btn-icon-left" href="<?php echo $product->add_to_cart_url()?>"><i class="fa fa-shopping-cart"></i><?php _e('Add to Cart','bella')?></a>
            <?php if (is_plugin_active('yith-woocommerce-compare/init.php')) {
                echo do_shortcode('[yith_compare_button]');
                
            }
            ?>
        </div>
    </div>
</div>
