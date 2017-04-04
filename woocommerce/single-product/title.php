<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );

?>
<div class="back-to-category">
  <span class="link"><i class="fa fa-angle-left"></i><?php _e(' Back to ','dikka');?><a href="<?php echo $shop_page_url;?>"><?php _e('Category','dikka');?></a></span>
  <div class="pull-right">
      
	  <?php previous_post_link('%link','<div class="btn btn-theme btn-theme-transparent btn-previous"> <i class="fa fa-angle-left"></i></div>');	   ?>
     <?php next_post_link('%link','<div class="btn btn-theme btn-theme-transparent btn-next"> <i class="fa fa-angle-right"></i></div>');	   ?>
      </div>
</div>
 <h2 class="product-title"><?php the_title(); ?></h2>
