<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>
<!-- About the author -->
<div class="about-the-author clearfix">
    <div class="media">
      <?php echo str_replace('avatar-130', 'media-object pull-left', get_avatar(get_the_author_meta('email'),130 )); ?>
           <div class="media-body">
            <p class="media-category"><?php  _e('Administrator', 'bella'); ?></p>
            <h4 class="media-heading"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></h4>
            <p><?php the_author_meta('description'); ?></p>     </div>
    </div>
</div>
