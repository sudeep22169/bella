<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
if ( $attachment_ids ) {
	?>
   
<?php

		foreach ( $attachment_ids as $attachment_id ) {
			$classes = array( 'zoom' );
			$image_link = wp_get_attachment_url( $attachment_id );
			if ( ! $image_link )
				continue;
			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );
			ob_start();
			?>
            <div class="item">
				<a class="btn btn-theme btn-theme-transparent btn-zoom" href="<?php echo $image_link; ?>" data-gal="prettyPhoto"><i class="fa fa-plus"></i></a><a href="<?php echo $image_link; ?>" class="<?php echo $image_class; ?>" title="<?php echo $image_title; ?>" data-gal="prettyPhoto"><?php echo $image; ?></a>
			</div>
			<?php
			
			$html = ob_get_clean();

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html , $attachment_id, $post->ID, $image_class );

		}

	?>
    
    <?php
}
