<div class="tabs">
	<ul id="tabs" class="nav nav-justified-off">
		<?php if(!empty($instance['featured'])): ?><li class=""><a href="#tab-1" data-toggle="tab"><?php _e('Featured','siteorigin-widgets');?></a></li><?php endif; ?>
		<?php if(!empty($instance['recent'])): ?><li class=""><a href="#tab-2" data-toggle="tab"><?php _e('Recent','siteorigin-widgets');?></a></li><?php endif; ?>
		<?php if(!empty($instance['topseller'])): ?><li class=""><a href="#tab-3" data-toggle="tab"><?php _e('Top Sellers','siteorigin-widgets');?></a></li><?php endif; ?>
	</ul>
</div>
<div class="tab-content">
	<?php if(!empty($instance['featured'])): ?>
		<div class="tab-pane fade" id="tab-1">
			<div class="row">
				<?php
				$query='post_type=product&posts_per_page='.$instance['num'].'&meta_key=_featured&meta_value=yes';
				$query = siteorigin_widget_post_selector_process_query( $query);
				$loop = new WP_Query( $query );
				?>
				<?php
				if ( $loop->have_posts() ) {
					while ( $loop->have_posts() ) : $loop->the_post();
					?>
					<div class="product-item col-md-3 col-sm-6">
						<?php wc_get_template_part( 'content', 'product' ); ?>
					</div><!--/.products-->
					<?php
					endwhile;
				} else {
					echo __( 'No products found' );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	<?php endif; ?>
	<?php if(!empty($instance['recent'])): ?>
		<div class="tab-pane fade active in" id="tab-2">
			<div class="row">
				<?php
				$query='post_type=product&posts_per_page='.$instance['num'];
				$query = siteorigin_widget_post_selector_process_query( $query );
				$loop = new WP_Query( $query );
				?>
				<?php
				if ( $loop->have_posts() ) {
					while ( $loop->have_posts() ) : $loop->the_post();
					?>
					<div class="product-item col-md-3 col-sm-6">
						<?php wc_get_template_part( 'content', 'product' ); ?>
					</div><!--/.products-->
					<?php
					endwhile;
				} else {
					echo __( 'No products found' );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	<?php endif; ?>
	<?php if(!empty($instance['topseller'])): ?>
		<div class="tab-pane fade" id="tab-3">
			<div class="row">
				<?php	
				$query='post_type=product&posts_per_page='.$instance['num'].'&meta_key=total_sales&orderby=meta_value_num';
				$query = siteorigin_widget_post_selector_process_query( $query);
				$loop = new WP_Query( $query );
				?>
				<?php
				if ( $loop->have_posts() ) {
					while ( $loop->have_posts() ) : $loop->the_post();
					?>
					<div class="product-item col-md-3 col-sm-6">
						<?php wc_get_template_part( 'content', 'product' ); ?>
					</div><!--/.products-->
					<?php
					endwhile;
				} else {
					echo __( 'No products found' );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	<?php endif; ?>
</div>
<script type="text/javascript">
	var length = jQuery("ul#tabs li").length;
	if( length == 2 ){

		jQuery("ul#tabs li:first-child").addClass("active");

	}
	if( length == 3 ){

		jQuery("ul#tabs li:nth-child(2)").addClass("active");

	}
	if( length == 1 ){

		 jQuery("ul#tabs li:first-child").addClass("active");
		 jQuery("li.active a").attr("aria-expanded", "true");
		 jQuery("#tab-1").addClass( "active" );
		 jQuery("#tab-1").css( "opacity","1" );
		 jQuery("#tab-3").addClass( "active" );
		 jQuery("#tab-3").css( "opacity","1" );

	}
</script>