<?php if($instance['product-type']=='top-sellers'):?>
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
<?php elseif($instance['product-type']=='top-products'):?>
	<div class="product-list">      
        <h4 class="block-title"><span><?php echo esc_attr($instance['title'])?></span></h4>
	     <?php
        add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
        $query_args = array( 'posts_per_page' => $instance['num'], 'no_found_rows' => true, 'post_status' => 'publish', 'post_type' => 'product','ignore_sticky_posts' => true  );
        $query_args['meta_query'] = WC()->query->get_meta_query();
       
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
<?php else:?>
	<div class="product-list">      
        <h4 class="block-title"><span><?php echo esc_attr($instance['title'])?></span></h4>
	     <?php
        	$queryrecent='post_type=product&posts_per_page='.$instance['num'];
			$queryrecent = siteorigin_widget_post_selector_process_query( $queryrecent );
			$looprecent = new WP_Query( $queryrecent );
			?>
        <?php if ( $looprecent->have_posts() ) :
			while ( $looprecent->have_posts() ) : $looprecent->the_post();
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
<?php endif;?>
