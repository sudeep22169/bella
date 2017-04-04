<?php 
/**
 * 
 *
 * @package WordPress
 * @subpackage Kena
 * @since Kena 1.0
 */

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header();; ?>
 <section class="page-section text-center error-page">
    <div class="container">
        <h3><?php _e('404','bella')?></h3>
        <h2><i class="fa fa-warning"></i><?php _e(' Oops! The Page you requested was not found!','bella')?></h2>
        <p><a class="btn btn-theme btn-theme-dark" href="<?php echo esc_url(site_url()); ?>"><?php _e('Back to Home','bella')?></a></p>
    </div>
</section>
<?php get_footer(); ?>
