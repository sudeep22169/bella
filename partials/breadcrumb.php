<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} 
global $bella_options;
$pageid=get_the_ID();
$page_setting_activate=get_post_meta( $pageid, 'bella_pagetitle_activate',true);
if(isset($page_setting_activate) && $page_setting_activate=='on') :
   $page_title_text=get_post_meta($pageid,'bella_pagetitle_text',true);?>
   <section class="page-section breadcrumbs">
      <div class="container"> 
        <div class="page-header">          
        <?php if (is_home()) :?>
        <h1><?php _e('BLOG', 'bella'); ?></h1>
        <?php elseif (is_single()) :?>
        <h1><?php echo esc_attr($page_title_text); ?></h1>
        <?php elseif (is_page()) : ?>
        <h1><?php echo esc_attr($page_title_text); ?></h1>
        <?php elseif (is_author()) : ?>
        <h1><?php _e('AUTHOR', 'bella'); ?></h1>
        <?php elseif (is_search()) : ?>
        <h1><?php _e('SEARCH', 'bella'); ?></h1>
        <?php elseif (is_category()) : ?>
        <h1><?php _e('CATEGORY', 'bella'); ?></h1>
        <?php elseif (is_tag()) : ?>
        <h1><?php _e('TAG', 'bella'); ?></h1>
        <?php elseif (is_archive()) : ?>
        <?php if (get_post_type() == 'product') : ?>
        <h1><?php _e('PRODUCTS', 'bella'); ?></h1>
        <?php elseif (get_post_type() == 'portfolio') : ?>
        <h1><?php _e('PORTFOLIO', 'bella'); ?></h1>
        <?php else: ?>
        <h1><?php _e('ARCHIVE', 'bella'); ?></h1>
        <?php endif; ?>
        <?php elseif (get_post_type() == 'product') : ?>
        <h1><?php echo esc_attr($page_title_text); ?></h1>
        <?php else : ?>
        <h1><?php _e('PAGE NOT FOUND', 'bella'); ?></h1>
        <?php endif; ?>
        </div>
        <?php if (function_exists('bella_breadcrumbs')) bella_breadcrumbs();  ?>
      </div>
  </section>  
<?php else :?>
<section class="page-section breadcrumbs">
      <div class="container"> 
        <div class="page-header">          
        <?php if (is_home()) :?>
        <h1><?php _e('BLOG', 'bella'); ?></h1>
        <?php elseif (is_single()) :?>
        <h1><?php echo get_the_title(); ?></h1>
        <?php elseif (is_page()) : ?>
        <h1><?php echo get_the_title(); ?></h1>
        <?php elseif (is_author()) : ?>
        <h1><?php _e('AUTHOR', 'bella'); ?></h1>
        <?php elseif (is_search()) : ?>
        <h1><?php _e('SEARCH', 'bella'); ?></h1>
        <?php elseif (get_post_type() == 'portfolio') : ?>
        <h1><?php _e('PORTFOLIO', 'bella'); ?></h1>
        <?php elseif (is_category()) : ?>
        <h1><?php _e('CATEGORY', 'bella'); ?></h1>
        <?php elseif (is_tag()) : ?>
        <h1><?php _e('TAG', 'bella'); ?></h1>
        <?php elseif (is_archive()) : ?>
        <?php if (get_post_type() == 'product') : ?>
        <h1><?php _e('PRODUCTS', 'bella'); ?></h1>
        <?php else: ?>
        <h1><?php _e('ARCHIVE', 'bella'); ?></h1>
        <?php endif; ?>
        <?php elseif (get_post_type() == 'product') : ?>
        <h1><?php _e('PRODUCTS', 'bella'); ?></h1>
        <?php else : ?>
        <h1><?php _e('PAGE NOT FOUND', 'bella'); ?></h1>
        <?php endif; ?>
        </div>
        <?php if (function_exists('bella_breadcrumbs')) bella_breadcrumbs();  ?>
      </div>
  </section>
<?php endif; ?> 