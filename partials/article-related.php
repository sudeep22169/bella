<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>

<?php if (get_next_post_link('&laquo; %link', '%title', 1) OR get_previous_post_link('%link &raquo;', '%title', 1)) : ?>
    <div class="prev-next-btn" style="display:none;">
      <ul class="pager">
        <li class="previous">
        <?php 
        previous_posts_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous feature', 'lenard' ) . '</span> %title' ); ?>
        </li>
        <li class="next">
        <?php 
        next_posts_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next feature', 'lenard' ) . '</span>' ); ?>
        </li>
      </ul>
    </div>
  <?php endif; ?>

 <?php if (get_next_post_link('&laquo; %link', '%title', 1) OR get_previous_post_link('%link &raquo;', '%title', 1)) : ?>
    <div class="pager">
            <?php previous_post_link('%link','<div class="btn btn-theme btn-theme-transparent pull-left btn-icon-left"> <i class="fa fa-angle-double-left"></i>' . __( 'Older', 'bella' ) . '</div>');?>               
            <?php next_post_link('%link','<div class="btn btn-theme btn-theme-transparent pull-right btn-icon-right"> ' . __( 'Newer', 'bella' ) . ' <i class="fa fa-angle-double-right"></i></div>');    ?>
          </div>
  <?php endif; ?>

