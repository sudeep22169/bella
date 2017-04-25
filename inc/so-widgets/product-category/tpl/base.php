	<div class="product-list">      
        <h4 class="block-title"><span><?php echo esc_attr($instance['title'])?></span></h4>
	     <?php
        add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
        $query_args = array( 
        	'posts_per_page' => $instance['num'], 
        	'no_found_rows' => true, 
        	'post_status' => 'publish', 
        	'post_type' => 'product',
        	'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => array($instance['product_categories'])
				),
			),
        );
       // $query_args['meta_query'] = WC()->query->get_meta_query();
       
		$loop = new WP_Query( $query_args );?>
        <?php if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) : $loop->the_post();
			?>
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