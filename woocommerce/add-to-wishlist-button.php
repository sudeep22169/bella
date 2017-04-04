<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $product;
?>
 
<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) )?>" rel="nofollow" data-product-id="<?php echo $product_id ?>" data-product-type="<?php echo $product_type?>" class="btn btn-theme btn-theme-transparent btn-wish-list <?php echo $link_classes ?>" >
   <i class="fa fa-heart"></i>
    
</a>
<img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ) ?>" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />