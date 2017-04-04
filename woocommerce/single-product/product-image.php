<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;
$attachment_ids = $product->get_gallery_attachment_ids();
$gall_count=count($attachment_ids);
 ?>

 <div class="col-md-6">
 <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 2, 'orderby' =>'date','order' => 'DESC' );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();  ?>
	<?php if ( $loop->post->ID==$product->post->ID){?>
	    <div class="badges">
          <div class="hot"><?php _e('hot','dikka')?></div>
          <div class="new"><?php _e('new','dikka')?></div>
        </div>   	
	<?php } endwhile; ?>
	<?php wp_reset_postdata(); ?>
	<?php
	$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
				$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array('title' => $image_title) );
				$attachment_count = count( $product->get_gallery_attachment_ids() );
				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}?>
	 		 	<div class="hidden_featured" >
				<a class="btn btn-theme btn-theme-transparent btn-zoom" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())) ?>" data-gal="prettyPhoto"><i class="fa fa-plus"></i></a><?php echo $image; ?></a>
				</div>
	<?php if ($gall_count==0):
		$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
				$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single img-responsive' ), array('title' => $image_title) );
				$attachment_count = count( $product->get_gallery_attachment_ids() );
				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}?>
	 		 
				<a class="btn btn-theme btn-theme-transparent btn-zoom" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())) ?>" data-gal="prettyPhoto"><i class="fa fa-plus"></i></a><?php echo $image; ?></a>
			
	<?php else:?>
	 
  	<div class="owl-carousel img-carousel" data-gall="<?php echo $gall_count; ?>">
	   <?php if ( has_post_thumbnail() ) {

				$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
				$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single img-responsive' ), array('title' => $image_title) );
				$attachment_count = count( $product->get_gallery_attachment_ids() );
				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}?>
	 		 <div class="item">
				<a class="btn btn-theme btn-theme-transparent btn-zoom" href="<?php echo $image_link; ?>" data-gal="prettyPhoto"><i class="fa fa-plus"></i></a><a href="<?php echo $image_link; ?>"  title="<?php echo $image_title; ?>" data-gal="prettyPhoto<?php $gallery?>"><?php echo $image; ?></a>
			 </div>
			
			<?php } else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

			}
		do_action( 'woocommerce_product_thumbnails' ); ?>
    </div>
     <div class="row product-thumbnails">
					 <?php if ( $attachment_ids ) {
                    $loop 		= 0;
					$x=1;
                    $columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
                    ?>
                     <?php
                 
                        foreach ( $attachment_ids as $attachment_id ) {
                
                            $classes = array( 'zoom' );
                
                            if ( $loop == 0 || $loop % $columns == 0 )
                                $classes[] = 'first';
                
                            if ( ( $loop + 1 ) % $columns == 0 )
                                $classes[] = 'last';
                
                            $image_link = wp_get_attachment_url( $attachment_id );
                
                            if ( ! $image_link )
                                continue;
                
                            $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                            $image_class = esc_attr( implode( ' ', $classes ) );
                            $image_title = esc_attr( get_the_title( $attachment_id ) );?>
                 <div class="col-xs-2 col-sm-2 <?php echo 'col-md-' . $columns; ?>">
                           <?php //echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
              		?> 
                   
                    <a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [<?php echo $x;?>,300]);"><?php echo $image;?></a>
                      
			   </div>
			  <?php $loop++; $x++;
                        }
                
                    
                }?>
</div>
<?php endif;?>
</div>
