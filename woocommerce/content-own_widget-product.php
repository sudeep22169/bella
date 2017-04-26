<?php global $product, $bella_options;
if( $bella_options['rtl_css'] == 1){
	$style = 'pull-right';
}
else
{
	$style = 'pull-left'; 
}
?>
 <a class="button yith-wcqv-button <?php echo $style; ?> media-link" href="#" data-product_id="<?php echo $product->id; ?>">
               <?php the_post_thumbnail('product-thumbnails'); ?>     <i class="fa fa-plus"></i>           
 </a>
 <div class="media-body">
	<h4 class="media-heading"><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo $product->get_title(); ?></a></h4> 
		
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
     
     <?php if ( $price_html = $product->get_price_html() ) : ?>
    <div class="price"><?php echo $price_html; ?> </div>
        
    <?php endif; ?>
 </div>
             	
                      
