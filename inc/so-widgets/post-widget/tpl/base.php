<?php
$query = siteorigin_widget_post_selector_process_query( $instance['posts'] );
$the_query = new WP_Query( $query );
?>
<?php global $bella_options;

if( $bella_options['rtl_css'] == 1){

	$align = "right";


}

else
{
	$align = 'left'; 

}
?>
<?php if($the_query->have_posts()) : ?>
	
		<?php while($the_query->have_posts()) : $the_query->the_post(); ?>
		<div class=" col-md-<?php echo $instance['alt']?'4':'6'?>">
			<div class="recent-post <?php echo $instance['alt'] ?'alt':''?>">
		    <div class="media">
		        <a class="<?php echo $instance['alt'] ?'':'pull-'.$align.''?> media-link" href="<?php the_permalink() ?>">
		        	<?php if( has_post_thumbnail() ) :
		        		if($instance['alt']=='1') 		        		
		        			echo get_the_post_thumbnail(get_the_ID(), array(360,214), array('alt'=>'','class'=>"media-object",'title'=> '')); 
		        		else
		        			echo get_the_post_thumbnail(get_the_ID(), array(170,120), array('alt'=>'','class'=>"media-object",'title'=> '')); 				
					 else:?>
						<div class="noimage"></div>
					 <?php endif; ?>
		            <i class="fa fa-plus"></i>
		        </a>
		        <div class="media-body">
		            <p class="media-category"> <?php if (get_the_category()) : ?>            
				              <?php the_category('/ ');
				              endif; ?></p>
		            <h4 class="media-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
		               <?php $excerpt = get_the_content();
                        $excerpt = strip_shortcodes($excerpt);
                        $excerpt = strip_tags($excerpt);                       
                        echo substr($excerpt, 0,100);?>
		            <div class="media-meta">
		                <?php echo get_the_date('j M Y') ?>
		                <span class="divider"><?php _e('/','bella')?></span><a href="<?php the_permalink();?>"><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></a>
		                <span class="divider">/</span><a href="#"><i class="fa fa-heart"></i>18</a>
		            </div>
		        </div>
		    </div>
		</div>
		</div>		
		<?php endwhile; wp_reset_postdata(); ?>
	
<?php endif; ?>
