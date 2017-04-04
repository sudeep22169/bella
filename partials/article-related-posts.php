<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>

<section class="page-section">

	<?php $cat = get_the_category($post->ID);	

		$category_id = array();

		foreach($cat as $individual_category) 

		{ 

			$category_id[] = $individual_category->term_id;

		}   

    $category_link = get_category_link( $category_id[0] );?>

	<a class="btn btn-theme btn-title-more btn-icon-left" href="<?php echo esc_url( $category_link ); ?>"><i class="fa fa-file-text-o"></i><?php _e('See All Posts', 'bella');?></a>

	<h2 class="block-title"><span><?php  _e('Related Posts', 'bella'); ?></span></h2>

	<div class="row">

		<?php $orig_post = $post;

		global $post;	

		$categories = get_the_category($post->ID);

		if ($categories) {

			$category_ids = array();

			foreach($categories as $individual_category) 

			{ 

				$category_ids[] = $individual_category->term_id;

			}



			$args=array(

				'category__in' => $category_ids,

				'post__not_in' => array($post->ID),

				'posts_per_page'=> 3, 	

				'orderby'=>'rand'

				);

			$my_query = new wp_query( $args );

			if( $my_query->have_posts() ) :



				while( $my_query->have_posts() )  :  

				

					$my_query->the_post(); ?>



					<div class="col-md-4">

						<div class="recent-post alt">

							<div class="media">

								<a class="media-link" href="<?php the_permalink();?>">

									<?php the_post_thumbnail('related-posts-thumbnails'); ?> <i class="fa fa-plus"></i>

								</a>

								<div class="media-body">

									<p class="media-category">

										<?php if (get_the_category()) : ?>                        

											<?php the_category(' / ');

										endif; ?>

									</p>



									<h4 class="media-heading">

										<a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>

									</h4>

									 <?php $excerpt = get_the_content();

				                        $excerpt = strip_shortcodes($excerpt);

				                        $excerpt = strip_tags($excerpt);				                        

				                        echo substr($excerpt, 0,100);?>

									<div class="media-meta">

										<?php echo get_the_date('jS M Y') ?>

										<span class="divider">/</span><a href="<?php the_permalink()?>"><i class="fa fa-comment"></i><?php echo get_comments_number(); ?></a>

										
									</div>



								</div>	

							</div>

						</div>

					</div>

				<?php 

				endwhile;

				endif;}

				$post = $orig_post;

				wp_reset_query();?>                

	</div>

</section>

