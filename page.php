<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>
<section class="page-section with-sidebar">
    <div class="container"> 
        <div class="row">
            <aside class="col-md-3 sidebar" id="sidebar">
                <?php get_sidebar(); ?>
            </aside>         
        <div class="col-md-9 content" id="content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); 
                     get_template_part('partials/article'); ?>
                    <br>                    
                    <?php comments_template( '', true ); ?>
                <?php endwhile; ?>
            <?php if ($wp_query->max_num_pages>1) : ?>
                <?php bella_pagination(); ?>
            <?php endif; ?>
            <?php else : ?>
                <?php get_template_part('partials/nothing-found'); ?>
            <?php endif; ?>
        </div>
        </div>
    </div>  
</section>
<?php get_template_part('partials/shop-banners');?>
<?php get_footer(); ?>