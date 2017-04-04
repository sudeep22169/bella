<?php 

/* 

 */// Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); global $bella_options,$wp_query;
?>

<?php $portfolio_class='';
$portfolio=esc_attr($bella_options['portfolio_layout']);

if($portfolio=='portfolio-3columns'){

    $portfolio_class='col-md-4 col-sm-6 ';    

}elseif($portfolio=='portfolio-4columns'){

    $portfolio_class='col-md-3 col-sm-6'; 

}

elseif($portfolio=='portfolio-alternate'){

    $portfolio_class='col-md-3 col-sm-6';   

}

?>

<section class="page-section">

    <div class="container">

	<?php $args = array(

			  'taxonomy'     => 'portfolio_categories',

			  'orderby'      => 'name',

			  'type'		 => 'portfolio',  

			  

			);                                    

		$categories = get_categories($args);

		  if ($categories) :

			  $cat_slugs_arr = array();?>

			<div class="clearfix text-center">

			  <ul id="filtrable" class="filtrable clearfix">

				 <li class="all current"><a href="#" data-filter="*"><?php _e('All','bella')?></a></li> 

				 <?php foreach ($categories as $cat) :?>					

					<li class="<?php echo $cat->slug; ?>"><a href="#" data-filter=".<?php echo $cat->slug; ?>"><?php echo esc_attr($cat->name);?></a></li>

				<?php  endforeach;?>

			  </ul>

			</div>		 

		  <?php  endif;?>

                  <!--main div-->
			<?php if (have_posts()) : echo ' <div class="row thumbnails portfolio isotope isotope-items">';?>

                <?php while (have_posts()) : the_post(); ?>              

				 <?php 

				 $terms = get_the_terms($post->ID, 'portfolio_categories' );

				  if ($terms && ! is_wp_error($terms)) :

					  $term_slugs_arr = array();

					  $num=count($terms);

					  foreach ($terms as $term) {

						  $term_slugs_arr[] = $term->slug;

					  }

					  $terms_slug_str = join( " ", $term_slugs_arr);

				  endif;

				 ?>

				<div class="<?php echo $portfolio_class;?> isotope-item <?php if($terms!='') echo esc_attr($terms_slug_str); ?> ">

				<?php if($portfolio=='portfolio-alternate'):?>

					<div class="thumbnail no-border no-padding">

	                    <div class="media">

	                        <?php if (has_post_thumbnail() ) :

                                // Get attached file guid

                                $att = get_post_meta(get_the_ID(),'_thumbnail_id',true);

                                $thumb = get_post($att);

                                if (is_object($thumb)) { $att_ID = $thumb->ID; $att_url = $thumb->guid; }

                                else { $att_ID = $post->ID; $att_url = $post->guid; }

                                $att_title = (!empty(get_post($att_ID)->post_excerpt)) ? get_post($att_ID)->post_excerpt : get_the_title($att_ID);?>                                     

                             <?php echo get_the_post_thumbnail(get_the_ID(), 'large', array('alt'=>'','class'=>'','title'=> ''));  ?> 

                            <?php endif; ?>

	                        <div class="caption hovered">

	                            <div class="caption-wrapper div-table">

	                                <div class="caption-inner div-cell">

	                                    <p class="caption-buttons">

	                                        <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>" class="btn caption-zoom" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>

	                                        <a href="<?php the_permalink();?>" class="btn caption-link"><i class="fa fa-link"></i></a>

	                                    </p>

	                                </div>

	                            </div>

	                        </div>

	                    </div>

	                    <div class="caption">

	                        <h3 class="caption-title"><a href="<?php the_permalink();?>"><?php echo get_the_title();?></a></h3>

	                            <p class="caption-category">

								 <?php $terms = get_the_terms($post->ID, 'portfolio_categories' );

					              if ($terms && ! is_wp_error($terms)) :

					                $term_slugs_arr = array();

					                $num=count($terms);



					                foreach ($terms as $term) {

					                  $term_slugs_arr[] = $term->name;

					                }

					                $terms_slug_str = join( " , ", $term_slugs_arr);

					                echo'<a href="'.get_the_permalink().'">'.$terms_slug_str.'</a>';					                

					              endif;?>

					            </p>

	                    </div>

	                </div>

                 <?php else :?>

                     <div class="thumbnail no-border no-padding">

                     	 <div class="media">

							<?php if (has_post_thumbnail() ) :

                                // Get attached file guid

                                $att = get_post_meta(get_the_ID(),'_thumbnail_id',true);

                                $thumb = get_post($att);

                                if (is_object($thumb)) { $att_ID = $thumb->ID; $att_url = $thumb->guid; }

                                else { $att_ID = $post->ID; $att_url = $post->guid; }

                                $att_title = (!empty(get_post($att_ID)->post_excerpt)) ? get_post($att_ID)->post_excerpt : get_the_title($att_ID);

                            ?>                                     

                             <?php echo get_the_post_thumbnail(get_the_ID(), 'large', array('alt'=>'','class'=>'','title'=> ''));  ?> 

                            <?php endif; ?>

                        	<div class="caption hovered">

	                            <div class="caption-wrapper div-table">

	                                <div class="caption-inner div-cell">

	                                    <h3 class="caption-title"><a href="<?php the_permalink();?>"><?php echo get_the_title();?></a></h3>

	                                    <p class="caption-category">

										 <?php $terms = get_the_terms($post->ID, 'portfolio_categories' );

							              if ($terms && ! is_wp_error($terms)) :

							                $term_slugs_arr = array();

							                $num=count($terms);



							                foreach ($terms as $term) {

							                  $term_slugs_arr[] = $term->name;

							                }

							                $terms_slug_str = join( " , ", $term_slugs_arr);

							                echo'<a href="'.get_the_permalink().'">'.$terms_slug_str.'</a>';					                

							              endif;?>

							            </p>

	                                    <p class="caption-buttons">

	                                        <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>" class="btn caption-zoom" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>

	                                        <a href="<?php the_permalink();?>" class="btn caption-link"><i class="fa fa-link"></i></a>

	                                    </p>

	                                </div>

	                            </div>

	                        </div>

                         </div><!--media-->

                     </div>

                 <?php endif;?>

                </div>				

			<?php endwhile;
				echo ' </div><!--main div isotope-->';
			 if ($wp_query->max_num_pages>1) : 
			  bella_pagination(); 
				
			 endif; 
			else : ?>

            	<?php get_template_part('partials/nothing-found');

			endif;

			?>

        </div><!--main div isotope-->

        

</section>

<?php get_footer(); ?>