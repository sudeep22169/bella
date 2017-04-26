<div class="product-list">      
        <h4 class="block-title"><span><?php echo esc_attr($instance['title'])?></span></h4>
	     <?php
        	$argsss = array(
        		'post_type'=>'product',
        		'posts_per_page'=>$instance['num'],
        		'ignore_sticky_posts'=>true

    		);
        	$looprecents = get_posts( $argsss );
        	var_dump($looprecents); die();
			?>
        <?php if ( $looprecents->have_posts() ) : setup_postdata();
			while ( $looprecents->have_posts() ) : $looprecents->the_post();
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
