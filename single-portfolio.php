<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>



 <section class="page-section">

  <div class="container">

    <div class="row">

      <?php if (have_posts()) : ?>

          <?php while (have_posts()) : the_post();

            $terms = get_the_terms( $post->ID, 'portfolio_categories' );

            if ($terms && ! is_wp_error($terms)) :

            $term_slugs_arr = array();

              foreach ($terms as $term) {

                $term_slugs_arr[] = $term->name;

              }

              $terms_slug_str = join( ", ", $term_slugs_arr);

            endif; ?>

             <?php if (has_post_thumbnail()&& !get_post_gallery() ) :  ?> 

                <div class="col-lg-8 col-md-7 col-sm-12 project-media ">                   

                     <?php  the_post_thumbnail('portfolio-single-thumbnails'); ?>

                </div>

              <?php endif;?>



              <?php if(has_post_thumbnail()&& get_post_gallery() ):?>                                   

                  <?php if ( get_post_gallery() ) : 

                      $gallery = get_post_gallery( get_the_ID(), false );?>

                     <div class="col-lg-8 col-md-7 col-sm-12 project-media ">

                        <div class="img-carousel">

                        <?php foreach( $gallery['src'] AS $src ){?>

                          <div><img   src="<?php echo esc_url($src); ?>" /></div>

                        <?php }?>

                         

                        </div>

                    </div>

                  <?php endif; 

              endif; ?>            

        

        <?php $portfolio_item_title = get_the_title( $post->ID );

  			$portfolio_item_name =esc_attr(get_post_meta( get_the_ID(), 'bella_add_client', true ));

  			$portfolio_item_releasedate =esc_attr(get_post_meta($post->ID, 'bella_add_releasedate', true ));

  			$portfolio_item_releasedate = strtotime( $portfolio_item_releasedate );

  			$portfolio_item_skills =esc_attr(get_post_meta($post->ID, 'bella_add_skills', true ));  			

  			$postContentStr = apply_filters('the_content', strip_shortcodes($post->post_content));?>    	

          <div class="col-lg-4 col-md-5 col-sm-7">

              <div class="project-overview">

                  <h3 class="block-title"><span><?php _e('Project Overview', 'bella'); ?></span></h3>

                	<?php echo wp_kses_post($postContentStr); ?>

              </div>

              <div class="project-details">

                  <h3 class="block-title"><span><?php _e('Project Details', 'bella'); ?></span></h3>

                  <dl class="dl-horizontal">

                      <dt><?php _e( 'Client','bella' ); ?></dt>

                      <dd><?php echo esc_attr($portfolio_item_name); ?></dd>                      

                      <dt><?php _e('Category: ','kerna')?></dt>

                      <dd><a href="<?php the_permalink();?>"><?php echo $terms_slug_str;?></a></dd>                     

                      <dt><?php _e( 'Release Date','bella' ); ?></dt>

                      <dd><?php echo date( 'jS F, Y', $portfolio_item_releasedate ); ?></dd>

                  </dl>

              </div>

          </div>					  

              

     </div><!--row-->

      <hr class="page-divider"/>



          <div class="pager">

            <?php previous_post_link('%link','<div class="btn btn-theme btn-theme-transparent pull-left btn-icon-left"> <i class="fa fa-angle-double-left"></i>Older</div>');?>               

  			    <?php next_post_link('%link','<div class="btn btn-theme btn-theme-transparent pull-right btn-icon-right"> Newer <i class="fa fa-angle-double-right"></i></div>');	   ?>

          </div>

     <hr class="page-divider half"/>



     

     <?php if(isset($bella_options['related_portfolio']) && $bella_options['related_portfolio']==1):?>

        <h2 class="block-title"><span><?php _e( 'Related Products', 'bella' ); ?></span></h2>

       <?php get_template_part('partials/portfolio-related');

    

     endif?>   

    

  	<?php endwhile; ?>    

    <?php else : ?><?php get_template_part('partials/nothing-found'); ?>



    <?php endif; ?>



  </div><!--container-->

           

</section>







<?php get_footer(); ?>