<?php
/*

 * Template Name: Blog Template with Right Sidebar

 *

 */

// Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>

<?php query_posts('post_type=post&post_status=publish&paged='. get_query_var('paged')); ?>

<section class="page-section with-sidebar">

	<div class="container">

	    <div class="row">	      

            <div class="col-md-9 content" id="content">                           

                <?php if (have_posts()) : ?>

                	<?php while (have_posts()) : the_post(); ?>

                    	<?php get_template_part('partials/article'); ?>

                	<?php endwhile; ?>

	                <?php if ($wp_query->max_num_pages>1) : ?>                   

	                  <?php bella_pagination(); ?>              

	                <?php endif; ?>

            		<?php else : ?>

                		<?php get_template_part('partials/nothing-found'); ?>

            	<?php endif; wp_reset_query(); ?>

            </div>

          <?php if ( is_active_sidebar( 'bella-widgets-aside-right' ) ) { ?>

                <aside class="col-md-3 sidebar" id="sidebar">             

                    <?php dynamic_sidebar( 'bella-widgets-aside-right' );  ?>                  

                </aside>                        

            <?php } ?> 

	    </div>

	</div>

</section>

<?php get_footer(); ?>