<div class="<?php echo $instance['style']? 'featured-products-carousel' :'top-products-carousel'?>">
	<div class="owl-carousel" id="<?php echo $instance['style']? 'featured-products-carousel' :'top-products-carousel'?>">
       <?php if($instance['product-type']=='top'):
	        add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
	        $query_args = array( 'posts_per_page' => $instance['num'], 'no_found_rows' => true, 'post_status' => 'publish', 'post_type' => 'product','ignore_sticky_posts' => true  );
	        $query_args['meta_query'] = WC()->query->get_meta_query();	    	
			$query = siteorigin_widget_post_selector_process_query(   $query_args);
		else:
			$query='post_type=product&posts_per_page='.$instance['num'].'&meta_key=_featured&meta_value=yes';
			$query = siteorigin_widget_post_selector_process_query( $query);
		endif;
		$loop = new WP_Query( $query );
		?>

		<?php

			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post();
				?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
				<?php
				endwhile;
			} else {
				echo __( 'No products found' );
			}
			wp_reset_postdata();
		?>
	</div>
</div>	    
