    <div class="product-list">      
        <h4 class="block-title"><span><?php echo esc_attr($instance['title'])?></span></h4>
	    <?php 
	    	$querysellers='post_type=product&posts_per_page='.$instance['num'].'&meta_key=total_sales&orderby=meta_value_num';
			$querysellers = siteorigin_widget_post_selector_process_query( $querysellers);
			$loopsellers = new WP_Query( $querysellers );
		?>
        <?php if ( $loopsellers->have_posts() ) :
			while ( $loopsellers->have_posts() ) : $loopsellers->the_post();?>
		        <div class="media">
		            <?php wc_get_template( 'content-own_widget-product.php', array( 'show_rating' => true ) ); ?>  
		        </div><?php
		    endwhile;
		else :
			echo __( 'No products found' );
		endif;
		wp_reset_postdata();
		?>     
 </div>

