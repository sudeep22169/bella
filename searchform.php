<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>

<div class="widget-search">
	<form class="form-search" method="post" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	    <input class="form-control" name="s" type="text" placeholder="<?php _e('Search', 'dikka'); ?>">
	    <button><i class="fa fa-search"></i></button>
     </form>
</div>
                   
                    
