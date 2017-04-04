<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>
<!DOCTYPE html>
<?php
global $bella_options;
 ?>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<?php if(isset($bella_options['meta_author']) && $bella_options['meta_author']!='') : ?>
<meta name="author" content="<?php echo esc_attr($bella_options['meta_author']); ?>">	
<?php else: ?>
<meta name="author" content="<?php esc_attr(bloginfo('name')); ?>">
<?php endif; ?>
<?php if(isset($bella_options['meta_author']) && $bella_options['meta_desc']!='') : ?>
<meta name="description" content="<?php echo esc_attr($bella_options['meta_desc']); ?>">	
<?php endif; ?>
<?php if(isset($bella_options['meta_author']) && $bella_options['meta_keyword']!='') : ?>
<meta name="keyword" content="<?php echo esc_attr($bella_options['meta_keyword']); ?>">	
<?php endif; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
<title><?php wp_title( '|', true, 'right' );?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if(isset($bella_options['favicon']['url'])) :  ?>
<link rel="shortcut icon" href="<?php echo esc_url($bella_options['favicon']['url']); ?>">
<?php endif; ?>

<?php
// WordPress Head
wp_head();
?>
</head> 
<!-- BEGIN BODY -->
<?php if($bella_options['theme_layout']=='1') $layout='wide'; else $layout='boxed';?>
<body id="home" <?php body_class("$layout" ); ?>>
<?php if ( isset($bella_options['preloader']) && $bella_options['preloader'] == 1 ) : ?> 
	<div id="preloader">
	    <div id="preloader-status">
	        <div class="spinner">
	            <div class="rect1"></div>
	            <div class="rect2"></div>
	            <div class="rect3"></div>
	            <div class="rect4"></div>
	            <div class="rect5"></div>
	        </div>
	        <?php if($bella_options['preloader-title']==1): ?>
	        	<div id="preloader-title"><?php echo esc_attr(get_bloginfo('name')); ?></div>
	        <?php else:?>
	        	<div id="preloader-title"><?php _e('Loading','bella')?></div>
	   		<?php endif; ?>	        
	    </div>
	</div>	
<?php endif ; ?>

  	
<!-- WRAPPER -->
<div class="wrapper">

<?php
 // Navbar
get_template_part('partials/navbar');?>
<!-- CONTENT AREA -->
<div class="content-area">
<?php 
$breadcrumb=1;
if($breadcrumb==1 && is_page_template('bella-page-builder.php')):
	$breadcrumb=0;
endif;
if($breadcrumb==1 && is_page_template('login.php')):
	$breadcrumb=0;
endif;
if($breadcrumb==1 && is_page_template('register.php')):
	$breadcrumb=0;
endif;
if ($breadcrumb==1) :
	get_template_part('partials/breadcrumb');
endif;

	