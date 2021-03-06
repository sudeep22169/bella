<div class="<?php echo $instance['style']? 'featured-products-carousel' :'top-products-carousel'?>">
	<div class="owl-carousel" id="<?php echo $instance['style']? 'featured-products-carousel' :'top-products-carousel'?>">
       <?php if($instance['product-type']=='top'):
	   	$query_args = array(
			'posts_per_page' => $instance['num'],
			'no_found_rows'  => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'meta_key'       => '_wc_average_rating',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC',
			'meta_query'     => WC()->query->get_meta_query(),
			'tax_query'      => WC()->query->get_tax_query(),
		);
		else:
			$query_args='post_type=product&posts_per_page='.$instance['num'].'&meta_key=_featured&meta_value=yes';
			$query = siteorigin_widget_post_selector_process_query( $query_args);
		endif;
		$loop = new WP_Query( $query_args );
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
