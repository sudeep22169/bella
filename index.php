<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); if (is_page_template('bella-page-builder-left-sidebar.php')) echo'rafin';?>
<section class="page-section with-sidebar">
    <div class="container">
        <div class="row">
            <?php if(esc_attr($bella_options['page-layout'])=='1'): ?>
                <aside class="col-md-3 sidebar" id="sidebar">             
                    <?php get_sidebar(); ?>                  
               </aside>
            <?php endif;?>         
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
                <?php endif; ?>
            </div>
            <?php if(esc_attr($bella_options['page-layout'])=='2'): ?>
                  <?php if ( is_active_sidebar( 'bella-widgets-aside-right' ) ) { ?>
                    <aside class="col-md-3 sidebar" id="sidebar">             
                        <?php dynamic_sidebar( 'bella-widgets-aside-right' );  ?>                  
                    </aside>                        
                <?php } ?> 
                
            <?php endif;?>
        </div>
    </div>
</section>
<?php get_footer(); ?>