<?php
/**
 * Bella functions file.
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
global $bella_options;
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/theme-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/theme-config.php' );
}
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( ABSPATH . 'wp-admin/includes/template.php' );
/*********************************************************************
* THEME SETUP
*/
function bella_setup() {
    global $bella_options;
    // Translations support. Find language files in bella/languages
    load_theme_textdomain('bella', get_template_directory().'/languages');
    $locale = get_locale();
    $locale_file = get_template_directory()."/languages/{$locale}.php";
    if(is_readable($locale_file)) { require_once($locale_file); }
    // Set content width
    global $content_width;
    if (!isset($content_width)) $content_width = 720;
    // Editor style (editor-style.css)
    add_editor_style(array('assets/css/editor-style.css'));
    // Load plugin checker
    require(get_template_directory() . '/inc/plugin-activation.php');
    //Include all post types
    require(get_template_directory() . '/inc/metabox.php');
    add_filter('add_to_cart_fragments' , 'woocommerce_header_add_to_cart_fragment' );
    // Nav Menu (Custom menu support)
    if (function_exists('register_nav_menu')) :
        register_nav_menu('primary', __('Bella Primary Menu', 'bella'));
        register_nav_menu('secondary', __('Bella Secondary Menu', 'bella'));
    endif;
    // Theme Features: Automatic Feed Links
    add_theme_support('automatic-feed-links');
    // Theme Features: woocommerce
    add_theme_support( 'woocommerce' );
    // Theme Features: Dynamic Sidebar
    add_post_type_support( 'post', 'simple-page-sidebars' );
    // Theme Features: Post Thumbnails and custom image sizes for post-thumbnails
    add_theme_support('post-thumbnails', array('post', 'page','product','portfolio'));
    // Theme Features: Post Formats
    add_theme_support('post-formats', array( 'gallery', 'image', 'link', 'quote', 'video', 'audio'));
    
}
add_action('after_setup_theme', 'bella_setup');
function bella_widgets_setup() {
    global $bella_options;
    // Widget areas
    if (function_exists('register_sidebar')) :
        // Sidebar right
        register_sidebar(array(
            'name' => "Blog Sidebar",
            'id' => "bella-widgets-aside-right",
            'description' => __('Widgets placed here will display in the right sidebar', 'bella'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'=>' <h4 class="widget-title">',
            'after_title'=>'</h4>'
        ));
        // Woocommerce sidebar
        register_sidebar(array(
            'name' => "WooCommerce Sidebar",
            'id' => "bella-widgets-woocommerce-sidebar",
            'description' => __('Widgets placed here will display in the product page sidebar', 'bella'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'=>' <h4 class="widget-title">',
            'after_title'=>'</h4>'
        ));
        // Footer Block 1
        register_sidebar(array(
            'name' => "Footer Block 1",
            'id' => "bella-widgets-footer-block-1",
            'description' => __('Widgets placed here will display in the first footer block', 'bella'),
           'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'=>'<h4 class="widget-title">',
            'after_title'=>'</h4>'
        ));
        // Footer Block 2
        register_sidebar(array(
            'name' => "Footer Block 2",
            'id' => "bella-widgets-footer-block-2",
            'description' => __('Widgets placed here will display in the second footer block', 'bella'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'=>'<h4 class="widget-title">',
            'after_title'=>'</h4>'
        ));
        // Footer Block 3
        if(isset($bella_options['footer-layout']) && esc_attr($bella_options['footer-layout'])>5) {
        register_sidebar(array(
            'name' => "Footer Block 3",
            'id' => "bella-widgets-footer-block-3",
            'description' => __('Widgets placed here will display in the third footer block', 'bella'),
           'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'=>'<h4 class="widget-title">',
            'after_title'=>'</h4>'
        ));
        }
        // Footer Block 4
        if(isset($bella_options['footer-layout']) && esc_attr($bella_options['footer-layout'])>9) {
        register_sidebar(array(
            'name' => "Footer Block 4",
            'id' => "bella-widgets-footer-block-4",
            'description' => __('Widgets placed here will display in the third footer block', 'bella'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'=>'<h4 class="widget-title">',
            'after_title'=>'</h4>'
        ));
        }
       
    endif;
   
}
add_action('widgets_init', 'bella_widgets_setup');
function bella_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) {
		return $title;
	} 
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	} 
	if ( $paged >= 2 || $page >= 2 ) {
		$title = sprintf( __( 'Page %s', 'bella' ), max( $paged, $page ) ) . " $sep $title";
	} 
	return $title;
} 
add_filter( 'wp_title', 'bella_title', 10, 2 );
// The excerpt "more" button
function bella_excerpt($text) {
    return str_replace('[&hellip;]', '[&hellip;]<a class="" title="'. sprintf (__('Read more on %s','bella'), get_the_title()).'" href="'.get_permalink().'">' . __(' Read more','bella') . '</a>', $text);
}
add_filter('the_excerpt', 'bella_excerpt');
/*********************************************************************
 * Function to load all theme assets (scripts and styles) in header
 */
function bella_load_theme_assets() {
    global $bella_options;
    // Do not know any method to enqueue a script with conditional tags!
    echo '
    <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
   <![endif]-->
    
    <!--[if IE]>
        <link rel="stylesheet" href="'.get_template_directory_uri().'/assets/css/ie.css" media="screen" type="text/css" />
        <![endif]-->
    ';
     //Enqueue google fonts 
    wp_enqueue_style('googleapis', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900');
    wp_enqueue_style('googlefont-vidaloka', 'http://fonts.googleapis.com/css?family=Vidaloka');
   
    // Enqueue all the theme CSS
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/plugins/bootstrap/css/bootstrap.min.css');
    if($bella_options['rtl_css'] == 1 ){
      wp_enqueue_style('bootstrap-rtl', get_template_directory_uri().'/assets/plugins/bootstrap/css/bootstrap-rtl.min.css');
    }
    wp_enqueue_style('bootstrap-select', get_template_directory_uri().'/assets/plugins/bootstrap-select/css/bootstrap-select.min.css');
    wp_enqueue_style('font-awsome', get_template_directory_uri().'/assets/plugins/fontawesome/css/font-awesome.min.css');
    wp_enqueue_style('pretty-photo', get_template_directory_uri().'/assets/plugins/prettyphoto/css/prettyPhoto.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri().'/assets/plugins/owl-carousel2/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-theme', get_template_directory_uri().'/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css');
    wp_enqueue_style('animate', get_template_directory_uri().'/assets/plugins/animate/animate.min.css');
    wp_enqueue_style('jquery-ui.min', get_template_directory_uri().'/assets/plugins/jquery-ui/jquery-ui.min.css');
    wp_enqueue_style('jquery.countdown', get_template_directory_uri().'/assets/plugins/countdown/jquery.countdown.css');
    if($bella_options['rtl_css'] != 1 ){
      wp_enqueue_style('theme-green', get_template_directory_uri().'/assets/css/theme-green-1.css');
    }
    wp_enqueue_style('main-style', get_template_directory_uri().'/style.css');
     if($bella_options['rtl_css'] == 1 ){
        wp_enqueue_style('theme-green-rtl', get_template_directory_uri().'/assets/css/colo-rtl-bu/theme-green-rtl.css');
    }
   
   // Enqueue all the js files of theme
    wp_enqueue_script('jquery');
    wp_enqueue_script('mordenizr.custom', get_template_directory_uri().'/assets/plugins/modernizr.custom.js', array(), FALSE, TRUE);
    wp_enqueue_script('bootstrap-min', get_template_directory_uri().'/assets/plugins/bootstrap/js/bootstrap.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('bootstrap-select-min', get_template_directory_uri().'/assets/plugins/bootstrap-select/js/bootstrap-select.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('superfish', get_template_directory_uri().'/assets/plugins/superfish/js/superfish.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('jquery-pretty-photo', get_template_directory_uri().'/assets/plugins/prettyphoto/js/jquery.prettyPhoto.js', array(), FALSE, TRUE);
    wp_enqueue_script('owl-carousel-min', get_template_directory_uri().'/assets/plugins/owl-carousel2/owl.carousel.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('jquery-sticky-min', get_template_directory_uri().'/assets/plugins/jquery.sticky.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('easing-min', get_template_directory_uri().'/assets/plugins/jquery.easing.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('jquery-smoothscroll-min', get_template_directory_uri().'/assets/plugins/jquery.smoothscroll.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('smooth-scrollbar-min', get_template_directory_uri().'/assets/plugins/smooth-scrollbar.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('jquery-ui.min', get_template_directory_uri().'/assets/plugins/jquery-ui/jquery-ui.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('jquery.plugin.min', get_template_directory_uri().'/assets/plugins/countdown/jquery.plugin.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('countdown-min', get_template_directory_uri().'/assets/plugins/countdown/jquery.countdown.min.js', array(), FALSE, TRUE);
    if($bella_options['rtl_css'] == 1 ){
      wp_enqueue_script('theme-js', get_template_directory_uri().'/assets/js/themertl.js', array(), FALSE, TRUE);
    }
    else{
      wp_enqueue_script('theme-js', get_template_directory_uri().'/assets/js/theme.js', array(), FALSE, TRUE);
    }
   
    wp_enqueue_script('isotope-min', get_template_directory_uri().'/assets/plugins/isotope/jquery.isotope.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('jquery-cookie-js', get_template_directory_uri().'/assets/plugins/jquery.cookie.js', array(), FALSE, TRUE);
    //wp_enqueue_script('theme-config-js', get_template_directory_uri().'/assets/js/theme-config.js', array(), FALSE, TRUE);
    
    $color_variation ='';
    if(isset($bella_options['custom_color_primary']) && $bella_options['custom_color_primary']!=''){
    $main_custom_color_primary= esc_attr($bella_options['custom_color_primary']);
    } else {
    $main_custom_color_primary= "#00b16a";
    }
         $hex_primary = str_replace("#", "", esc_attr($main_custom_color_primary));
           if(strlen($hex_primary) == 3) {
              $r = hexdec(substr($hex_primary,0,1).substr($hex_primary,0,1));
              $g = hexdec(substr($hex_primary,1,1).substr($hex_primary,1,1));
              $b = hexdec(substr($hex_primary,2,1).substr($hex_primary,2,1));
           } else {
              $r = hexdec(substr($hex_primary,0,2));
              $g = hexdec(substr($hex_primary,2,2));
              $b = hexdec(substr($hex_primary,4,2));
           }
            $new_custom_color_primary= array($r, $g, $b);
    
            
            $color_variation='
           
            .spinner > div {
              background-color: '.$main_custom_color_primary.';
            }
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
              color: '.$main_custom_color_primary.';
            }
            a {
              color: '.$main_custom_color_primary.';
            }
            .footer a:hover,
            .footer a:active,
            .footer a:focus {
              color: '.$main_custom_color_primary.';
            }
            .block-title.alt .fa.color {
              background-color: '.$main_custom_color_primary.';
            }
            .text-color {
              color: '.$main_custom_color_primary.';
            }
            .drop-cap {
              color: '.$main_custom_color_primary.';
            }
            blockquote {
              background-color: '.$main_custom_color_primary.';
            }
            .btn-theme {
              
              background-color: '.$main_custom_color_primary.';
              border-color: '.$main_custom_color_primary.';
            }
            .btn-theme-transparent, .btn-theme-transparent:focus, .btn-theme-transparent:active {
              background-color: transparent;
              border-width: 3px;
              border-color: #e9e9e9;
              color: #232323;
            }
            .btn-theme-dark:hover {
              background-color: '.$main_custom_color_primary.';
              border-color: '.$main_custom_color_primary.';
             
            }
            .btn-title-more {              
              background-color: transparent;             
              border-color: #e9e9e9;
              color: #232323;
            }
            .btn-theme-dark, .btn-theme-dark:focus, .btn-theme-dark:active {
              background-color: #232323;
              border-width: 3px;
              border-color: #232323;
              color: #ffffff;
            }
            a:hover .btn-play,
            .btn-play:hover {
              
              color: '.$main_custom_color_primary.';
            }
            .top-bar ul a:hover .fa {
              color: '.$main_custom_color_primary.';
            }
            .top-bar ul a span.colored {
              color: '.$main_custom_color_primary.';
            
            }
            .header {
              border-bottom: solid 3px '.$main_custom_color_primary. ';
            }
            .sf-arrows > li > .sf-with-ul:focus:after,
            .sf-arrows > li:hover > .sf-with-ul:after,
            .sf-arrows > .sfHover > .sf-with-ul:after {
              border-top-color: '.$main_custom_color_primary.';
            }
            .sf-arrows ul li > .sf-with-ul:focus:after,
            .sf-arrows ul li:hover > .sf-with-ul:after,
            .sf-arrows ul .sfHover > .sf-with-ul:after {
              border-left-color: '.$main_custom_color_primary.';
            }
            .sf-menu li.megamenu ul a:hover {
              color: '.$main_custom_color_primary.';
            }
            .sf-menu li.sale a {
              background-color: '.$main_custom_color_primary.';
              
            }
            
              .footer {
              border-top: solid 10px '.$main_custom_color_primary.';
            
            }
            .main-slider .caption-subtitle {
            
              color: '.$main_custom_color_primary.';
          
            }
            .main-slider .btn-theme:hover {
             
              background-color: '.$main_custom_color_primary.';
             
            }
            .main-slider .dark .caption-text .btn-theme:hover {
              background-color: '.$main_custom_color_primary.';
              border-color: '.$main_custom_color_primary.';
            }
            .pagination > li > a:hover,
            .pagination > li > span:hover,
            .pagination > li > a:focus,
            .pagination > li > span:focus {
              border-color: '.$main_custom_color_primary.';
              background-color: '.$main_custom_color_primary.';
           
            }
            .message-box {
             
              background-color: '.$main_custom_color_primary.';
             
            }
            .content-tabs .nav-tabs > li.active > a {
             
              color: '.$main_custom_color_primary.';
            }
            .post-title a:hover {
              color: '.$main_custom_color_primary.';
            }
            .post-meta a:hover {
              color: '.$main_custom_color_primary.';
            }
            .about-the-author .media-heading a:hover {
              color: '.$main_custom_color_primary.';
            }
            .post-wrap blockquote {
             
              border-top: solid 6px '.$main_custom_color_primary.';
             
            }
            .recent-post .media-category {
          
              color: '.$main_custom_color_primary.';
            }
            .recent-post .media-heading a:hover {
              color: '.$main_custom_color_primary.';
            }
            .widget .recent-post .media-meta a:hover {
              color: '.$main_custom_color_primary.';
            }
            .comment-author a:hover {
              color: '.$main_custom_color_primary.';
            }
            .comment-date .fa {
              color: '.$main_custom_color_primary.';
              
            }
            .thumbnail.hover,
            .thumbnail:hover {
              border: solid 1px '.$main_custom_color_primary.';
            }
            .caption-title a:hover {
              color: '.$main_custom_color_primary.';
            }
            .thumbnail.thumbnail-banner .btn-theme:hover {
              background-color: '.$main_custom_color_primary.';
              border-color: '.$main_custom_color_primary.';
            }
            .thumbnail .price ins {
            
              color: '.$main_custom_color_primary.';
            }
            .product-single .reviews:hover,
            .product-single .add-review:hover {
              color: '.$main_custom_color_primary.';
            }
            .product-single .product-availability strong {
              color: '.$main_custom_color_primary.';
            }
            .dropdown-menu > .active > a,
            .dropdown-menu > .active > a:hover,
            .dropdown-menu > .active > a:focus {
              background-color: '.$main_custom_color_primary.';
            }
            .products.list .thumbnail .reviews:hover {
              color: '.$main_custom_color_primary.';
            }
            .products.list .thumbnail .availability strong {
              color: '.$main_custom_color_primary.';
            }
            .widget.widget-shop-deals .countdown-amount {
            
              color: '.$main_custom_color_primary.';
            }
            .widget.widget-tabs .nav-justified > li.active > a,
            .widget.widget-tabs .nav-justified > li > a:hover,
            .widget.widget-tabs .nav-justified > li > a:focus {
              border-color: '.$main_custom_color_primary.';
              background-color: '.$main_custom_color_primary.';
              
            }
            @media (min-width: 768px) {
            
              .widget.widget-tabs.alt .nav-justified > li.active > a:before {
               
                border-top: solid 5px '.$main_custom_color_primary.';
              }
            }
            .widget.shop-categories ul a:hover {
              color: '.$main_custom_color_primary.';
            }
            .widget-flickr-feed ul a:hover {
              border-color: '.$main_custom_color_primary.';
            }
            .recent-tweets .media .fa {
              color: '.$main_custom_color_primary.';
            }
            .product-list .price ins {
              padding-right: 5px;
              text-decoration: none;
              color: '.$main_custom_color_primary.';
            }
            .product-list .price ins {
             
              color: '.$main_custom_color_primary.';
            }
            .orders td.description h4 a:hover {
              color: '.$main_custom_color_primary.';
            }
            .orders td.total a:hover {
              color: '.$main_custom_color_primary.';
            }
            .wishlist td.description h4 a:hover {
              color: '.$main_custom_color_primary.';
            }
            .wishlist td.total a:hover {
              color: '.$main_custom_color_primary.';
            }
            .compare-products .product h4:hover,
            .compare-products .product h4 a:hover {
              color: '.$main_custom_color_primary.';
            }
            #contact-form .alert {
              
              border-color: '.$main_custom_color_primary.';
              background-color: '.$main_custom_color_primary.';
            
            }
            .to-top {
            
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.5);
              border: solid 2px '.$main_custom_color_primary.';
             
            }
            .to-top:hover {
             
              border-color: '.$main_custom_color_primary.';
              color: '.$main_custom_color_primary.';
            }
            span.onsale {
              
              background-color: '.$main_custom_color_primary.';
             
            }
            .btn-play {
            
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.85);
              
            }
            .btn-play:before {
        
              border: solid 10px rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.35);
            }
            .recent-post .media-link:after {
          
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0);
            
            }
            .recent-post .media-link:hover:after {
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.7);
            }
            .thumbnail-banner .media-link:after {
             
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0);
            }
            .thumbnail-banner.hover .media-link:after,
            .thumbnail-banner:hover .media-link:after {
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.3);
            }
            .thumbnails.portfolio .thumbnail .caption.hovered {
              
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.5);
            }
            .widget-flickr-feed ul a:hover:before {
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.7);
            }
            .product-list .media-link:after {
             
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0);
              
            }
            .product-list .media-link:hover:after {
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.7);
            }
            .orders .media-link:after {
              
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0);
              
            }
            .orders .media-link:hover:after {
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.7);
            }
            .wishlist .media-link:after {
              
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0);
              
            }
            .wishlist .media-link:hover:after {
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.7);
            }
            .compare-products .product .media-link:after {
              
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0);
              
            }
            .compare-products .product .media-link:hover:after {
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.7);
            }
            .to-top {
           
              background-color: rgba('.$new_custom_color_primary['0'].','.$new_custom_color_primary['1'].','.$new_custom_color_primary['2'].',0.5);
              
            }
            .product-single .onsale {            
              background-color: '.$main_custom_color_primary.';
              
            }
            #content .onsale,
            .featured-products-carousel .onsale {            
              background-color: '.$main_custom_color_primary.';              
            }
            a.checkout-button {
             
              background-color: '.$main_custom_color_primary.'; 
              border-color: '.$main_custom_color_primary.'; 
              
            }
            .form-row.place-order input#place_order { 
              background-color: '.$main_custom_color_primary.'; 
              border-color: '.$main_custom_color_primary.';            
            }
            .shipping-calculator-form button.button:hover {
              background-color: '.$main_custom_color_primary.'; 
              border-color: '.$main_custom_color_primary.'; 
              
            }
            ';
        wp_add_inline_style( 'theme-green', $color_variation );
        if( class_exists( 'YITH_Woocompare' ) ) {
        }
        if ( class_exists( 'YITH_WCWL' ) ) {
        }
    
}
add_action('wp_enqueue_scripts', 'bella_load_theme_assets');
/*********************************************************************
 * RETINA SUPPORT
 */
add_filter('wp_generate_attachment_metadata', 'bella_retina_support_attachment_meta', 10, 2);
function bella_retina_support_attachment_meta($metadata, $attachment_id) {
    // Create first image @2
    bella_retina_support_create_images(get_attached_file($attachment_id), 0, 0, false);
    foreach ($metadata as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $image => $attr) {
                if (is_array($attr))
                    bella_retina_support_create_images(get_attached_file($attachment_id), $attr['width'], $attr['height'], true);
            }
        }
    }
    return $metadata;
}
function bella_retina_support_create_images($file, $width, $height, $crop = false) {
    $resized_file = wp_get_image_editor($file);
    if (!is_wp_error($resized_file)) {
        if ($width || $height) {
            $filename = $resized_file->generate_filename($width . 'x' . $height . '@2x');
            $resized_file->resize($width * 2, $height * 2, $crop);
        } else {
            $filename = str_replace('-@2x','@2x',$resized_file->generate_filename('@2x'));
        }
        $resized_file->save($filename);
        $info = $resized_file->get_size();
        return array(
            'file' => wp_basename($filename),
            'width' => $info['width'],
            'height' => $info['height'],
        );
    }
    return false;
}
add_filter('delete_attachment', 'bella_delete_retina_support_images');
function bella_delete_retina_support_images($attachment_id) {
    $meta = wp_get_attachment_metadata($attachment_id);
    if(is_array($meta)){
        $upload_dir = wp_upload_dir();
        $path = pathinfo($meta['file']);
        // First image (without width-height specified
        $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . wp_basename($meta['file']);
        $retina_filename = substr_replace($original_filename, '@2x.', strrpos($original_filename, '.'), strlen('.'));
        if (file_exists($retina_filename)) unlink($retina_filename);
        foreach ($meta as $key => $value) {
            if ('sizes' === $key) {
                foreach ($value as $sizes => $size) {
                    $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
                    $retina_filename = substr_replace($original_filename, '@2x.', strrpos($original_filename, '.'), strlen('.'));
                    if (file_exists($retina_filename))
                        unlink($retina_filename);
                }
            }
        }
    }
}
// Enqueue comment-reply script if comments_open and singular
function bella_enqueue_comment_reply() {
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
        }
}
add_action( 'wp_enqueue_scripts', 'bella_enqueue_comment_reply' );
// Bella Pagination
// Code taken from: http://wp-snippets.com/pagination-for-twitter-bootstrap/
function bella_pagination ($before = '', $after = '') {
    global $bella_options;
    echo $before;
        global $wpdb, $wp_query;
        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        if ($numposts <= $posts_per_page) return;
        if (empty($paged) || $paged == 0) $paged = 1;
        $pages_to_show = 7;
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1 / 2);
        $half_page_end = ceil($pages_to_show_minus_1 / 2);
        $start_page = $paged - $half_page_start;
        if ($start_page <= 0) $start_page = 1;
        $end_page = $paged + $half_page_end;
        if (($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if ($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if ($start_page <= 0) $start_page = 1;       
       
        echo '<div class="pagination-wrapper">';
        echo'<ul class="pagination">';
        $var=$paged;
        
        if($paged!=$start_page)
        echo ( '<li><a href="'.get_pagenum_link(--$var).'"><i class="fa fa-angle-double-left"></i> Previous</a></li>' );
      else
        echo ( '<li class="disabled"><a href="#"><i class="fa fa-angle-double-left"></i> Previous</a></li>' );
        for ($i = $start_page; $i <= $end_page; $i++) {
            
            if ($i == $paged)
                echo ' <li class="active"><a href="#">' .$i. '<span class="sr-only">(current)</span></a></li>';
            else{
                echo ' <li><a href="'.get_pagenum_link($i).'">' . $i . '</a></li>';
                        }
        }
        $var2=$paged;
        if($paged==$end_page)
        
            echo ( '<li class="disabled"><a href="#">Next<i class="fa fa-angle-double-right"></i></a></li>' );
        else
            echo ( '<li><a href="'.get_pagenum_link(++$var2).'">Next<i class="fa fa-angle-double-right"></i></a></li>' );       
        
        echo '</ul>';
        echo '</div>';
    echo $after;
    return;
}
Class Description_Walker extends Walker_Nav_Menu {
    function start_lvl( &$output , $depth = 0 , $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown-menu \">\n";
    }
   function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
           $class_names = $value = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
          
           $class_names = ' '. esc_attr( $class_names ) . '';
           
           $output .= $indent . '<li >';
           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
           $prepend='';
          
           $append = '';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
          
            $item_output = $args->before;
            if($depth<1){
                $item_output .= '<a class="nav-to '.esc_attr( $class_names ).'" '. $attributes .'>';
            } else {
                $item_output .= '<a class="'.esc_attr( $class_names ).'" '. $attributes .'>';
            }
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
       
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
Class Bella_Menu_Walker extends Walker_Nav_Menu {
    
    public $flag=0;
    public $width='';
    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    function start_lvl( &$output , $depth = 0 , $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        if($this->flag==0):
            if($depth>-1):
            $output .= "\n$indent<ul >\n";
            else :
            $output .= "\n$indent<ul role='menu'>\n";
            endif;
        else:
            if($depth==0):
            $output .= "\n$indent<ul ><li class='row'>\n";
            elseif($depth==1):
            $output .= "\n$indent<ul >\n";
            else :
            $output .= "\n$indent<ul > \n";
            endif;
        endif;
    }
     function end_lvl(&$output, $depth=0, $args=array()) {
        $indent = str_repeat( "\t", $depth );
        if($this->flag==1):
            if($depth==0):
            $output .="\n$indent</ul>\n";
            elseif($depth==1):
            $output .= "\n$indent</li></ul >\n";
            else :
            $output .= "\n$indent</ul>\n";
            endif;
        else:
            $output .= "\n$indent</ul>\n";
        endif;
    }
   function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
      {
           global $wp_query;
        
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
           $class_names = $value = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
          
           $class_names = ' '. esc_attr( $class_names ) . '';
           $description  = ! empty( $item->description ) ? '<p>'.esc_attr( $item->description ).'</p>' : '';
           if($item->hasChildren):
                $class_names .= ' dropdown-toggle';
           endif;
            if($item->hasChildren && $depth>-1):
                if($depth==0):
                    if($item->size!='simple'):
                    $output .= $indent . '<li class="megamenu wps-'.$item->size.'">';
                    $this->flag=1;   
                    else:
                    $output .= $indent .'<li class="">';   
                    endif;   
                elseif($depth==1 && $this->flag==1):  
                    $parent_object= get_post_meta(intval($item->ID));
                    $parent_object= get_post_meta(intval($parent_object['_menu_item_menu_item_parent'][0]));
                        if(isset($parent_object['_menu_item_col'])):
                        $col=12/$parent_object['_menu_item_col'][0];
                        $output .= "<div class='col-md-".$col."' >";
                        endif;
                else:
                $output .=  '<li class="dropdown dropdown-submenu">'; 
                endif;
elseif( $depth>1 &&  $this->flag==1):
$output .=  '<li >'; 
            else:
                 $output .=  '<li >'; 
            endif;
           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            
            if($item->hasChildren):
                $attributes .=' data-toggle="dropdown"';
            endif;
           $prepend='';
          
           $append = '';
           
             $item_output ='';
            $icon=esc_attr(get_post_meta($item->ID,'icon',true));
            $size=esc_attr(get_post_meta($item->ID,'size',true));
            if($this->flag==1 && $depth==0){
                $item_output .= $args->before;
                $item_output .= '<a class="'.esc_attr( $class_names ).'" '. $attributes .'>';
                $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
                $item_output .= $args->link_after;
                $item_output .= '</a>';    
                $item_output .= $args->after;
                $this->width = $size;
            } 
            elseif($this->flag==1 && $depth>1){
                if($description!=''):
                 $item_output .= do_shortcode($description);
                else:
                $item_output .= $args->before;
                $item_output .='<a class="'.esc_attr( $class_names ).'" '. $attributes .'>';
                $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
                $item_output .= $args->link_after;
                $item_output .= '</a>';    
                $item_output .= $args->after;
                endif;
            }
            elseif($this->flag==0 || $depth!=1){
                $item_output .= $args->before;
                $item_output .= '<a class="'.esc_attr( $class_names ).'" '. $attributes .'>';
                $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
                $item_output .= $args->link_after;
                $item_output .= '</a>';    
                $item_output .= $args->after;
            }
             elseif($this->flag==1 &&  $depth==1){
                $item_output .= $args->before;
                $item_output .= '<h4 class="block-title"><span>';
                $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
                $item_output .= $args->link_after;
                $item_output .= '</span></h4>';
                $item_output .= $args->after;
            }
             elseif($this->flag==1 ||  $depth>1){
                $item_output .= $args->before;
                $item_output .= '<a class="'.esc_attr( $class_names ).'" '. $attributes .'>';
                $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
                $item_output .= $args->link_after;
                $item_output .= '</a>';    
                $item_output .= $args->after;
            }
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
            function end_el(&$output, $item, $depth=0, $args=array()) {
                if($item->hasChildren && $depth>-1):
                    if($depth==0):
                        if($item->size!='simple'):
                        $output .=  '</li>';
                        $this->flag=1;   
                        else:
                        $output .='</li >'; 
                        endif;   
                    elseif($depth==1 && $this->flag==1):  
                        $parent_object= get_post_meta(intval($item->ID));
                        $parent_object= get_post_meta(intval($parent_object['_menu_item_menu_item_parent'][0]));
                        if(isset($parent_object['_menu_item_col'])):
                        $col=12/$parent_object['_menu_item_col'][0];
                        $output .= "</div>";
                        endif;
                    else:
                    $output .=  '</li>'; 
                    endif;
                else:
                     if($depth!=2):
                     $output .=  '</li >'; 
                     endif;
                endif;
            }
}
add_action('wp_update_nav_menu_item', 'bella_nav_update',10, 3);
function bella_nav_update($menu_id, $menu_item_db_id, $args ) {
if(array_key_exists('menu-item-col',$_REQUEST) && array_key_exists('menu-item-col',$_REQUEST) ) {
    if ( is_array($_REQUEST['menu-item-col']) && isset($_REQUEST['menu-item-size']) ) {
        $col_value = $_REQUEST['menu-item-col'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_col', $col_value );
    }
     if ( is_array($_REQUEST['menu-item-size']) && isset($_REQUEST['menu-item-size']) ) {
        $size_value = $_REQUEST['menu-item-size'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_size', $size_value );
    }
}
}
add_filter( 'wp_setup_nav_menu_item','bella_nav_item' );
function bella_nav_item($menu_item) {
    $menu_item->col = get_post_meta( $menu_item->ID, '_menu_item_col', true );
    $menu_item->size = get_post_meta( $menu_item->ID, '_menu_item_size', true );
    return $menu_item;
}
add_filter( 'wp_edit_nav_menu_walker', 'bella_nav_edit_walker',10,2 );
function bella_nav_edit_walker($walker,$menu_id) {
    return 'Walker_Nav_Menu_Edit_Bella';
}
class Walker_Nav_Menu_Edit_Bella extends Walker_Nav_Menu  {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {}
	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {}
	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);
		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}
		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);
		$title = $item->title;
		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)'), $item->title );
		}
		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;
		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';
		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item' ); ?></a>
					</span>
				</dt>
			</dl>
			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
					</label>
				</p>
 <p class="field-col description description-thin">
                <label for="edit-menu-item-custom-<?php echo $item_id; ?>">
                    <?php _e( 'Dropdown Menu Column' ); ?><br />
                    <select id="edit-menu-item-col-<?php echo $item_id; ?>" class="widefat code edit-menu-item-col" name="menu-item-col[<?php echo $item_id; ?>]"  >
                        <option value="1" <?php selected( esc_attr( $item->col ), '1' ); ?>><?php _e('1','bella'); ?></option>
                        <option value="2" <?php selected( esc_attr( $item->col ), '2' ); ?>><?php _e('2','bella'); ?></option>
                        <option value="3" <?php selected( esc_attr( $item->col ), '3' ); ?>><?php _e('3','bella'); ?></option>
                        <option value="4" <?php selected( esc_attr( $item->col ), '4' ); ?>><?php _e('4','bella'); ?></option>
                        <option value="6" <?php selected( esc_attr( $item->col ), '6'); ?>><?php _e('6','bella'); ?></option>
                    </select>
                </label>
            </p>
            <p class="field-size description description-thin">
                <label for="edit-menu-item-size-<?php echo $item_id; ?>">
                    <?php _e( 'Dropdown Menu Size' ); ?><br />
                    <select id="edit-menu-item-size-<?php echo $item_id; ?>" class="widefat code edit-menu-item-size" name="menu-item-size[<?php echo $item_id; ?>]"  >
                        <option value="simple" <?php selected( esc_attr( $item->size ), 'simple' ); ?>><?php _e('Simple','bella'); ?></option>
                        <option value="megamenu" <?php selected( esc_attr( $item->size ),  'megamenu'); ?>><?php _e('Megamenu','bella'); ?></option>
                    </select>
                </label>
            </p>
				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move' ); ?></span>
						<a href="#" class="menus-move menus-move-up" data-dir="up"><?php _e( 'Up one' ); ?></a>
						<a href="#" class="menus-move menus-move-down" data-dir="down"><?php _e( 'Down one' ); ?></a>
						<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
						<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
						<a href="#" class="menus-move menus-move-top" data-dir="top"><?php _e( 'To the top' ); ?></a>
					</label>
				</p>
				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
				</div>
				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
} // Walker_Nav_Menu_Edit
function bella_body_classes( $classes ) {
    if (!is_page_template('bella-page-builder.php') ) :
    $classes[] = 'multipage';
    endif;  
    return $classes;
}
add_filter( 'body_class', 'bella_body_classes' );
add_action( 'tgmpa_register', 'bella_register_required_plugins' );
function bella_register_required_plugins() {
 
    $plugins = array(
 
        array(
          'name'     => __( 'Page Builder by SiteOrigin', 'Bella' ),
          'slug'     => 'siteorigin-panels',
          'required' => true,
          ),
        array(
          'name'     => __( 'SiteOrigin Widgets Bundle', 'Bella' ),
          'slug'     => 'so-widgets-bundle',
          'required' => true,
        ),
       
        array(
            'name'               => 'Theme Addons', // The plugin name.
            'slug'               => 'bella-addons', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/inc/plugins/bella-addons.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ), 
        
        array(
          'name'      => 'MailChimp for WordPress',
          'slug'      => 'mailchimp-for-wp',
          'required'  => false,
        ), 
        array(
            'name'      => 'Contact Form Plugin ', 
            'slug'       => 'contact-form-7', 
            'required'    => true,
        ),      
        array(
            'name'      => 'Woocommerce - Shop Plugin', 
            'slug'      => 'woocommerce', 
            'required'   => true,
        ),
        array(
            'name'      => 'Yith Woocommerce Compare - Shop Plugin', 
            'slug'      => 'yith-woocommerce-compare', 
            'required'   => true,
        ), 
         array(
            'name'      => 'Yith Woocommerce Wishlist - Shop Plugin', 
            'slug'      => 'yith-woocommerce-wishlist', 
            'required'   => true,
        ), 
       
      
 
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}
//Builder functions
function bella_row_style_fields($fields) {
    
$fields['row_id'] = array(
      'name'        => __('Row ID', 'siteorigin-panels'),
      'type'        => 'text',
      'group'       => 'attributes',
      'description' => __('Please give an id(without #)', 'siteorigin-panels'),
      'priority'    => 10,
);
$fields['row_stretch'] = array(
      'name'        => __('', 'siteorigin-panels'),
      'type'        => 'hidden',
      'group'       => 'layout',   
      
);
$fields['row_container'] = array(
      'name'        => __('Row Styles', 'siteorigin-panels'),
      'type'        => 'select',
      'group'       => 'layout',
      'description' => __('Choose between contained or full row styple', 'siteorigin-panels'),
      'priority'    => 10,
      'options'     => array(
            'container-row'        => __('Container with row', 'siteorigin-panels'),
            'container'        => __('Container', 'siteorigin-panels'),
            'container full-width'        => __('Full-Width', 'siteorigin-panels'),
            ),
);
$fields['parallax'] = array(
      'name'        => __('Parallax', 'siteorigin-panels'),
      'type'        => 'checkbox',
      'group'       => 'design',
      'description' => __('If enabled, the background image will have a parallax effect.', 'siteorigin-panels'),
      'priority'    => 8,
);
  return $fields;
}
add_filter( 'siteorigin_panels_row_style_fields', 'bella_row_style_fields');
function bella_panels_row_container_start( $grid, $attributes ) {
 
    if(isset($attributes['style']['row_container']) && $attributes['style']['row_container']=='container-row'){
    echo '<div class="container">';
    echo '<div class="row">';
    }
}
add_filter('siteorigin_panels_before_row', 'bella_panels_row_container_start', 10, 2);
function bella_panels_row_container_end( $grid, $attributes ) { 
    if(isset($attributes['style']['row_container']) && $attributes['style']['row_container']=='container-row'){
      echo '</div>';
      echo '</div>';
    }
}
add_filter('siteorigin_panels_after_row', 'bella_panels_row_container_end', 10, 2);
function bella_row_style_attributes( $attributes, $args ) {
    if( !empty( $args['parallax'] ) ) {
        array_push($attributes['class'], 'image');
        array_push($attributes['class'], 'testimonials');       
       
    }
    return $attributes;
}
add_filter('siteorigin_panels_row_style_attributes', 'bella_row_style_attributes', 10, 2);
function bella_comment($comment, $args, $depth) {
   
      $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? 'media comment' : 'media comment parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
        <a href="#" class="pull-left comment-avatar">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </a>
        <div class="media-body"> 
            <p class="comment-meta"><span class="comment-author"> <?php printf( __( '<a href="#">%s</a>' ), get_comment_author_link() ); ?> <span class="comment-date"> <?php echo bella_time_ago(); ?> <i class="fa fa-flag"></i></span></span></p>
            <?php if ($comment->comment_approved == '0') : ?>
                <em><?php _e('Your comment is awaiting moderation.') ?></em>
                <br />
            <?php endif; ?>
            <p class="comment-text"><?php comment_text(); ?></p>
            <?php if($args['max_depth']!=$depth) { ?>
            <p class="comment-reply">
                <?php comment_reply_link(array ('reply_text' => 'Reply this comment', 'depth' => $depth, 'max_depth' => $args['max_depth'])) ?>
                <i class="fa fa-comment"></i>
            </p> 
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; 
}
   
}
 function bella_comment_end($comment, $args, $depth) {?>
                </div>
            </div>          
<?php }
add_filter('loop_shop_columns', 'bella_product_loop_columns');
function bella_product_loop_columns() {
    return 3; // 3 products per row
}
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );
add_filter( 'cmb_meta_boxes', 'bella_cmb_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function bella_cmb_metaboxes( array $meta_boxes ) {
    $prefix = 'bella_';
     $meta_boxes['page_metabox'] = array(
        'id'         => 'page_metabox',
        'title'      => __( 'Bella Page Settings', 'bella' ),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => 'Activate Page Title ',
                'desc' => 'Do you want to enable inner page settings.',
                'id' => $prefix . 'pagetitle_activate',
                'type' => 'checkbox'
            ),
           array(
                'name'    => __( 'Page Title', 'bella' ),
                'id'      => $prefix . 'pagetitle_text',
                'type'    => 'text',
            ),
          array(
                'name'    => __( 'Hide shop banners?', 'bella' ),
                'id'      => $prefix . 'shop_banner',
                'type'    => 'checkbox',
                'desc' => 'Hide shop banners in footer?',
            ),
           
        )
    );
 
    $meta_boxes['menu_metabox'] = array(
        'id'         => 'menu_metabox',
        'title'      => __( 'Menu Option', 'bella' ),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'side',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'     => __( 'Menus', 'bella' ),
                'desc'     => __( 'Select menu for this page', 'bella' ),
                'id'       => $prefix . 'menu_select',
                'type'     => 'taxonomy_select',
                'taxonomy' => 'nav_menu', // Taxonomy Slug
                'default' => 'bella-main-menu',
            ),
        )
    );
     $meta_boxes['details_meox'] = array(
        'id'         => 'details_meox',
        'title'      => __( 'Porject Details', 'bella' ),
        'pages'      => array( 'portfolio', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'     => __( 'Client', 'bella' ),
                'desc'     => __( 'Add client name', 'bella' ),
                'id'       => $prefix . 'add_client',
                'type'     => 'text',
                 ),
           
             array(
                'name'     => __( 'Release Date', 'bella' ),
                'desc'     => __( 'Add release date of project', 'bella' ),
                'id'       => $prefix . 'add_releasedate',
                'type' => 'text_date',
                
                
            ),
            )
    );
    return $meta_boxes;
}
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <div class="bella_popup">
     <div class="modal fade popup-cart" id="popup-cart" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
             <div class="container">
               <div class="cart-items">
                  <div class="cart-items-inner">
              <?php  if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                                  
                    $_product = $cart_item['data'];                                            
                    if ($_product->exists() && $cart_item['quantity']>0) : ?>
                      
                     <div class="media">
                        <?php echo '<a class="pull-left" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image(array(50,50)).'</a>';
                         echo '  <p class="pull-right item-price">'.woocommerce_price($_product->get_price()).'</p>';?>
                          <div class="media-body">
                         <?php $bella_product_title = $_product->get_title();
                          echo apply_filters( 'woocommerce_short_description', $_product->post_excerpt );
                         $bella_product_desc = $_product->post_excerpt;
                         echo wp_kses_post($bella_product_desc);
                          $bella_short_product_title = (strlen($bella_product_title) > 28) ? substr($bella_product_title, 0, 25) . '...' : $bella_product_title;
                          echo '<h4 class="media-heading item-title"><a href="'.get_permalink($cart_item['product_id']).'">' .$cart_item['quantity'].''.__('x ', 'bella'). apply_filters('woocommerce_cart_widget_product_title', $bella_short_product_title, $_product) . '</a></h4>';?>
                       <?php echo '<p class="item-desc">'.$_product->get_categories(', ','','').'</p>';?>
                          </div>  
                     </div>
               
                         
                     <?php endif; endforeach;?>                                         
                      <?php else: echo '<li class="empty">'.__('No products in the cart.','woothemes').'</li>'; endif;?>                                       
               <div class="media">
                      <p class="pull-right item-price"><?php echo $woocommerce->cart->get_cart_total(); ?></p>
                      <div class="media-body">
                          <h4 class="media-heading item-title summary"><?php _e('Subtotal', 'bella'); ?></h4>
                      </div>
                  </div>
                 <div class="media">
                        <div class="media-body">
                            <div>
                                <a href="#" class="btn btn-theme btn-theme-dark" data-dismiss="modal"><?php _e('Close', 'bella'); ?></a><!--
                                 --><a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="btn btn-theme btn-theme-transparent btn-call-checkout"><?php _e(' Checkout', 'bella'); ?></a>         
                            </div>
                        </div>
                    </div>  
                  </div>
               </div>          
            </div>
          </div>
          
      </div>
     <div class="header-cart">
          <div class="cart-wrapper">
           <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php') && function_exists( 'YITH_WCWL' )) :global $wishlist_url;
                 $wishlist_url = YITH_WCWL()->get_wishlist_url();?> 
        <a href="<?php echo esc_url($wishlist_url);?>" class="btn btn-theme-transparent hidden-xs hidden-sm"><i class="fa fa-heart"></i></a>
           <?php endif; 
           if (is_plugin_active('yith-woocommerce-compare/init.php')) :  ?>
              <a href="#" class="yith-woocompare-open btn btn-theme-transparent hidden-xs hidden-sm"><i class="fa fa-exchange"></i></a>                   
          <?php endif;?>   
          <?php  if(!empty($cart_item['data']))
              $_product = $cart_item['data']; ?>
                  <a href="#" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"> <?php echo WC()->cart->cart_contents_count ;?><?php _e(' item(s) - ','bella')?><?php echo $woocommerce->cart->get_cart_total(); ?> </span> <i class="fa fa-angle-down"></i></a>
                  <!-- Mobile menu toggle button -->
                  <a href="#" class="menu-toggle btn btn-theme-transparent"><i class="fa fa-bars"></i></a>
                  <!-- /Mobile menu toggle button -->                   
          </div>
      </div>
    </div>
    <?php
    $fragments['div.bella_popup' ] = ob_get_clean();
    return $fragments;
}
function removeDemoModeLink() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action( 'init', 'bella_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function bella_initialize_cmb_meta_boxes() {
    if ( ! class_exists( 'cmb_Meta_Box' ) )
        require_once 'inc/cmb/init.php';
}
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
function bella_detect_woocommerce()
{
    global $post;
    if ( has_shortcode( $post->post_content, 'woocommerce_cart' ) || has_shortcode( $post->post_content, 'woocommerce_my_account' ) || has_shortcode( $post->post_content, 'woocommerce_checkout' ) || get_query_var( 'wishlist-action',1 ) !=1)
    {
        return true;
    } 
    return false;
}
add_filter( 'login_url', 'bella_login_page' );
function bella_login_page( $login_url ) {
     $page=get_page_by_title('login');
    if($page!=NULL):
     return get_permalink( $page->ID );
    else:
    return $login_url;
    endif;
}
add_filter( 'register_url', 'bella_register_url' );
function bella_register_url( $register_url )
{
    $register_urlx = home_url( '/wp-signup.php');
    //wp_redirect( apply_filters( 'wp_signup_location', get_bloginfo('wpurl') . '/wp-signup.php' ) );
    return $register_urlx;
}
//displaying breadcrumb navigation
function bella_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '>'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = esc_url(home_url());
 ?>
  <ul class="breadcrumb">
 <?php 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>';
 
  } else {
 
    echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</li>';?>
    </ul>
    <?php
 
  }
} // end bella_breadcrumbs()
//for tabs in single product page
add_filter( 'woocommerce_product_tabs', 'bella_rename_tabs', 98 );
function bella_rename_tabs( $tabs ) {
    $count_reviews=get_comments_number();
    $tabs['description']['title'] = __( 'Item Description' );       // Rename the description tab
                  // Rename the reviews tab
    //$tabs['additional_information']['title'] = __( 'Product Data' );  // Rename the additional information tab
    return $tabs;
}
/* Code for category list widget*/
class WP_Widget_Category_Bella extends WP_Widget {
    
    function __construct() 
    {
         $widget_ops = array('classname' => 'Product Category', 'description' => __( "Gives list of different product categories with their counts.","flatty") );
        parent::__construct('category_widget', __('Product Category(Bella)','bella'), $widget_ops);
        $this->alt_option_name = 'category';
       
        
    }    
    public function widget( $args, $instance ) {?>
      <?php   $cache = wp_cache_get('category', 'widget');
      global $bella_options;
        if ( !is_array($cache) )
            $cache = array();
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        ob_start();
        extract($args); 
        $title='';
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );  
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;        
        echo $before_widget;
        ?>
        <?php if (isset($bella_options['cart']) && $bella_options['cart'] == 1 &&  is_plugin_active('woocommerce/woocommerce.php') ) :?>
        <div class="widget shop-categories">
            <?php  if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'Category', $instance['title'] ). $args['after_title'];
            }?>
             
            <div class="widget-content">
                <ul>
                <?php
                    $taxonomy     = 'product_cat';
                    $orderby      = 'name';  
                    $show_count   = 0;     // 1 for yes, 0 for no                      
                    $hierarchical = 1;      // 1 for yes, 0 for no  
                    $title        = '';  
                    $empty        = 0;                   
                    $args = array(
                    'taxonomy'     => $taxonomy,
                    'orderby'      => $orderby,
                    'show_count'   => $show_count,                   
                    'hierarchical' => $hierarchical,
                    'title_li'     => $title,
                    'hide_empty'   => $empty,
                    'number'        =>$number,
                    );
                    $all_categories = get_categories($args);                   
                    foreach ($all_categories as $cat) :                    
                        if($cat->category_parent == 0) :
                            $category_id = $cat->term_id;?> 
                           <li>                 
                               
                                <?php
                                echo '<a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>'; 
                                $args2 = array(
                                'taxonomy'     => $taxonomy,
                                'child_of'     => 0,
                                'parent'       => $category_id,
                                'orderby'      => $orderby,
                                'show_count'   => $show_count,
                                'hierarchical' => $hierarchical,
                                'title_li'     => $title,
                                'hide_empty'   => $empty
                                );
                                $sub_cats =get_categories( $args2 );
                                if(!empty ($sub_cats)) 
                                echo '<span class="arrow"><i class="fa fa-angle-down"></i></span>';?>
                                <ul class="children">
                                    <?php
                                    if($sub_cats) :
                                        foreach($sub_cats as $sub_category) :?>
                                        <li>
                                            <?php  echo '<a href="'. get_term_link($sub_category->slug, 'product_cat') .'">' .$sub_category->name;?>
                                                <span class="count"><?php echo $sub_category->count;?></span>
                                            </a>
                                        </li>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </li>                           
                        <?php endif;
                    endforeach;                
                    ?>
                   
                </ul>
            </div>
        </div>
        <?php endif;
        echo $after_widget;?>        
    <?php 
    }
    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
         $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
         $title = strip_tags($instance['title']);
         $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of categories to show:','flatty' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
    <?php
    
    }
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['Category']) )
            delete_option('Category');
        return $instance;
    }
function flush_widget_cache() {
        wp_cache_delete('category', 'widget');
    }
      
}
register_widget('WP_Widget_Category_Bella');
/*Code for Archive widget*/
class WP_Widget_Archive_Bella extends WP_Widget {
    /**
     * Sets up the widgets name etc
     */
    function __construct() {
         $widget_ops = array('classname' => 'Archive', 'description' => __( "A monthly archive of your site's Posts..","flatty") );
        parent::__construct('archive_widget', __('Archive(Bella)','bella'), $widget_ops);
        $this->alt_option_name = 'archive';
    }
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
         $cache = wp_cache_get('archive', 'widget');
         if ( !is_array($cache) )
            $cache = array();
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        ob_start();
        extract($args);
       
    $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Archives' ) : $instance['title'], $instance, $this->id_base );
       echo $before_widget; 
    ?>      
    <div class="widget shop-categories">
        <?php  if ( $title ) {
            echo $args['before_title'] . esc_attr($title) . $args['after_title'];
        }?>
        <div class="widget-content">
            <ul> 
                <?php global $wpdb;
                $limit = 0;
                $year_prev = null;
                $months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month , YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date ASC");
                foreach($months as $month) :
                    $year_current = $month->year;?>
                    
                    <li>
                        <span class="arrow"><i class="fa fa-angle-down"></i></span>
                        <a href="<?php the_permalink(); ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>"><?php echo date_i18n("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>
                        <span class="count"><?php echo $month->post_count; ?></span>
                        </a>
                        <ul class="children">
                            <?php  $args = array( 'posts_per_page' => '5',
                            'date_query' => array(
                            array(
                            'month'=>$month->month
                            ),
                            ),
                            );
                            $r = new WP_Query(  $args  );
                            if ($r->have_posts()) :
                                while ($r->have_posts() ) :$r->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                                    </li>
                                <?php endwhile;?>
                            <?php endif;?>
                        </ul>
                    </li>
                    <?php $year_prev = $year_current;
                    if(++$limit >= 18) { break; }
                endforeach; ?>
            </ul>         
         </div>
    </div>
                        
    <?php     echo $after_widget; 
    }
    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = strip_tags($instance['title']);        
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
    
   <?php  }
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);       
        $this->flush_widget_cache();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['Category']) )
            delete_option('Category');
        return $instance;
        
    }
function flush_widget_cache() {
        wp_cache_delete('archive', 'widget');
    }
      
}
register_widget('WP_Widget_Archive_Bella');
/*code for text&icons widget*/
class WP_Widget_Text_Bella extends WP_Widget {
    /**
     * Sets up the widgets name etc
     */
    function __construct() {
         $widget_ops = array('classname' => 'textnicon', 'description' => __( "Displays text with social icons","flatty") );
        parent::__construct('text_widget', __('Text & Icons(Bella)','bella'), $widget_ops);
        $this->alt_option_name = 'text';
        
        
    }
    public function widget( $args, $instance ) {
        
       global $bella_options;
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $si = ! empty( $instance['socialicons'] ) ? '1' : '0';
        $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
         echo $args['before_widget'];?>
        <?php if ( ! empty( $title ) ) {
            echo $args['before_title'] . esc_attr($instance['title']) . $args['after_title'];
         } 
       echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; 
      if($si) :?>       
               <ul class="social-icons">
                      <?php if (!empty($bella_options['social_facebook'])) : ?>
                        <li><a class="facebook" href="<?php  echo esc_url($bella_options['social_facebook']); ?>"  title=""><i class="fa fa-facebook"></i></a></li>
                        <?php endif; ?><?php if (!empty($bella_options['social_twitter'])) : ?>
                        <li><a class="twitter" href="<?php  echo esc_url($bella_options['social_twitter']); ?>"  title=""><i class="fa fa-twitter"></i></a></li>
                        <?php endif; ?><?php if (!empty($bella_options['social_googlep'])) : ?>
                        <li><a class="google" href="<?php  echo esc_url($bella_options['social_googlep']); ?>" title=""><i class="fa fa-google"></i></a></li>
                        <?php endif; ?><?php if (!empty($bella_options['social_pinterest'])) : ?>
                        <li><a class="pinterest" href="<?php  echo esc_url($bella_options['social_pinterest']); ?>"  title=""><i class="fa fa-pinterest"></i></a></li>
                        <?php endif; ?><?php if (!empty($bella_options['social_linkedin'])) : ?>
                        <li><a class="linkedin" href="<?php  echo esc_url($bella_options['social_linkedin']); ?>"  title=""><i class="fa fa-linkedin"></i></a></li>
                        <?php endif; ?><?php if (!empty($bella_options['social_instagram'])) : ?>
                        <li><a class="instagram" href="<?php  echo esc_url($bella_options['social_instagram']); ?>"  title=""><i class="fa fa-instagram"></i></a></li>
                        <?php endif; ?><?php if (!empty($bella_options['social_dribbble'])) : ?>
                        <li><a class="dribbble" href="<?php  echo esc_url($bella_options['social_dribbble']); ?>" title=""><i class="fa fa-dribbble"></i></a></li>
                        <?php endif; ?><?php if (!empty($bella_options['social_tumblr'])) : ?>
                        <li><a class="tumblr" href="<?php  echo esc_url($bella_options['social_tumblr']); ?>" title=""><i class="fa fa-tumblr"></i></a></li>
                        <?php endif; ?><?php if (!empty($bella_options['social_skype'])) : ?>
                        <li><a class="skype" href="<?php  echo esc_url($bella_options['social_skype']); ?>" title=""><i class="fa fa-skype"></i></a></li>
                        <?php endif; ?>                           
                </ul><!-- end right -->             
             
       <?php endif;
              echo $args['after_widget'];?>
        
    <?php }
    
public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','socialicons' => 'on' ) );
        $title = strip_tags($instance['title']);
        $text = esc_textarea($instance['text']);
        $socialicons = $instance['socialicons'] ? 'checked="checked"' : '';
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_attr($text); ?></textarea>
        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
        <p>
            
            <input class="checkbox" type="checkbox" <?php echo $socialicons; ?> id="<?php echo $this->get_field_id('socialicons'); ?>" name="<?php echo $this->get_field_name('socialicons'); ?>" /> <label for="<?php echo $this->get_field_id('socialicons'); ?>"><?php _e('Social Icons'); ?></label>
        </p>
<?php
    
    
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['socialicons'] = $new_instance['socialicons'] ? 1 : 0;
        if ( current_user_can('unfiltered_html') )
            $instance['text'] =  $new_instance['text'];
        else
            $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
        $instance['filter'] = isset($new_instance['filter']);
        $instance['socialicons'] = $new_instance['socialicons'] ? 1 : 0;
        return $instance;
    }
      
}
register_widget('WP_Widget_Text_Bella');
/* Code for popular post widget*/
class WP_Widget_Post_Tabs_Bella extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "A tab showing recent,popluar and random posts in sidebar.","flatty") );
        parent::__construct('popular-posts-bella', __('Post Tabs (Bella)','bella'), $widget_ops);
        $this->alt_option_name = 'widget_post_tabs';
        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }
    function widget($args, $instance) {
        $cache = wp_cache_get('widget_post_tabs', 'widget');
        if ( !is_array($cache) )
            $cache = array();
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        ob_start();
        extract($args);
        
        $title='';
        echo $before_widget; 
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;
        ?>
    <div class="widget widget-tabs alt">
      <div class="widget-content">
            <ul id="tabs" class="nav nav-justified">
                <li><a href="#tab-s1" data-toggle="tab"><?php echo __('Recent posts','bella');?></a></li>
                <li class="active"><a href="#tab-s2" data-toggle="tab"> <?php echo __('Popular post','bella');?></a></li>         
            </ul>
            
        <div class="tab-content">
         <div class="tab-pane fade" id="tab-s1">
            <div class="recent-post">
                <?php
                $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
                if ($r->have_posts()) :
                ?>
                    
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <div class="media">
                       
                        
                        <a class="pull-left media-link" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('recent-thumbnails'); ?>     <i class="fa fa-plus"></i>           
                       </a>      
                         
                        <div class="media-body">
                            <div class="media-meta">
                         <?php the_time('jS M Y') ?> 
                              
                                <span class="divider">/</span><a href="<?php echo the_permalink();?>"><i class="fa fa-comment"></i> <?php comments_number('0','1','%'); ?></a>
                            </div>
                           <h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h4>
                        </div>
                    </div>
                    <?php endwhile; ?>
            
            </div>
            
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();
            endif;
            ?>
        </div><!--recentpost-->
        <div class="tab-pane fade in active" id="tab-s2">
               <div class="recent-post">
                <?php
                $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'orderby' => 'comment_count','no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
                if ($r->have_posts()) :?>
                    
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                     
                    <div class="media">
                       <a class="pull-left media-link" href="<?php the_permalink(); ?>">
                       <?php the_post_thumbnail('recent-thumbnails'); ?>     <i class="fa fa-plus"></i>           </a>
                        
                         
                        <div class="media-body">
                            <div class="media-meta">
                         <?php the_time('jS M Y') ?> 
                              
                                <span class="divider">/</span><a href="<?php echo the_permalink();?>"><i class="fa fa-comment"></i> <?php comments_number('0','1','%'); ?></a>
                            </div>
                           <h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h4>
                        </div>
                    </div><!--media-->
                                                   
                                                    
                    <?php endwhile; ?>
               
            </div>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();
            endif; ?>
        </div><!--recentpost-->          
        </div><!--content--> 
     
      </div>
    </div>
    <?php echo $after_widget; ?> <!--widget alt-->
        <?php
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['number'] = (int) $new_instance['number'];
       $this->flush_widget_cache();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');
        return $instance;
    }
    function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts', 'widget');
    }
    function form( $instance ) {
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:','flatty' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
    <?php
    }   
}
register_widget('WP_Widget_Post_Tabs_Bella');
/*code for woocommerce  product tabs*/
class WP_Widget_Product_Tabs_Bella extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'widget_product_tabs', 'description' => __( "A tab showing top,saleoff and deals products in sidebar.","flatty") );
        parent::__construct('product_tabs-bella', __('Product Tabs (Bella)','bella'), $widget_ops);
        $this->alt_option_name = 'widget_product_tabs';
        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }
    function widget($args, $instance) {
        $cache = wp_cache_get('widget_product_tabs', 'widget');
        if ( !is_array($cache) )
            $cache = array();
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        ob_start();
        extract($args);        
        $title='';
        echo $before_widget; 
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;  ?>
         <div class="widget widget-tabs">
          <div class="widget-content">
              <ul id="tabs" class="nav nav-justified">
                <li><a href="#tab-s1" data-toggle="tab"><?php echo __('Top','bella');?></a></li>
                <li class="active"><a href="#tab-s2" data-toggle="tab"><?php echo __('Sale Off','bella');?></a></li>
                <li><a href="#tab-s3" data-toggle="tab"><?php echo __('Deals','bella');?></a></li>                          
             </ul>        
          <div class="tab-content">
            <div class="tab-pane fade" id="tab-s1">
                <div class="product-list">
                  <?php add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );              
                  $query_args = array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'post_type' => 'product' );              
                  $query_args['meta_query'] = WC()->query->get_meta_query();              
                  $r = new WP_Query( $query_args );
                    if ($r->have_posts()) : ?>                         
                      <?php while ( $r->have_posts() ) : $r->the_post();  ?>
                        <div class="media">
                            <?php wc_get_template( 'content-own_widget-product.php', array( 'show_rating' => true ) ); ?>                                
                        </div>
                      <?php endwhile; ?>                      
                </div>
                      
                  <?php    remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
                  wp_reset_postdata();
                  endif;    ?>
            </div><!--top-->
           <div class="tab-pane fade in active" id="tab-s2">
            <div class="product-list">
                <?php  
                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => $number,
                        'meta_query'     => array(
                            'relation' => 'OR',
                            array( // Simple products type
                                'key'           => '_sale_price',
                                'value'         => 0,
                                'compare'       => '>',
                                'type'          => 'numeric'
                            ),
                            array( // Variable products type
                                'key'           => '_min_variation_sale_price',
                                'value'         => 0,
                                'compare'       => '>',
                                'type'          => 'numeric'
                            )
                        )
                    );
            
                $r = new WP_Query( $args ); 
                if ($r->have_posts()) :?>            
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>             
                      <div class="media">
                            <?php wc_get_template( 'content-own_widget-product.php', array( 'show_rating' => true ) ); ?>                   
                     </div><!--media-->                                  
                    <?php endwhile; ?>
               
            </div>
            <?php  wp_reset_postdata();
            endif;     ?>
          </div><!--saleoff-->
        <div class="tab-pane fade" id="tab-s3">
            <div class="product-list">
             <?php  $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => $number,
                        'meta_key' => '_featured',
                        'meta_value' => 'yes',
                    );        
                $r = new WP_Query( $args ); 
                if ($r->have_posts()) : ?>          
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>            
                      <div class="media">
                            <?php wc_get_template( 'content-own_widget-product.php', array( 'show_rating' => true ) ); ?>                   
                     </div><!--media-->                                            
                    <?php endwhile; ?>                
            </div>
            <?php wp_reset_postdata();
            endif;       ?>
        </div><!--deal-->
       </div><!--content-->      
      </div>
    </div> <!--widget alt-->
<?php echo $after_widget;      
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['number'] = (int) $new_instance['number'];
       $this->flush_widget_cache();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');
        return $instance;
    }
    function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts', 'widget');
    }
    function form( $instance ) {
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;        ?>
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:','flatty' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
    <?php
    }   
}
register_widget('WP_Widget_Product_Tabs_Bella');
/*code for woocommerce top rated product tabs*/
class WP_Widget_Top_Products_Bella extends WP_Widget {
   
    function __construct() {
         $widget_ops = array('classname' => 'Top Products', 'description' => __( "Gives list of top rated products.","flatty") );
        parent::__construct('top_products_widget', __('Top Products(Bella)','bella'), $widget_ops);
        $this->alt_option_name = 'top_products';
    }
    
    public function widget( $args, $instance ) {
         $cache = wp_cache_get('top_products', 'widget');
        if ( !is_array($cache) )
            $cache = array();
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        ob_start();
        extract($args);
        $title='';
        echo $before_widget;              
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );        
        $number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];    ?>
         
        <?php if($number!=0):?> 
        <div class="widget">             
            <?php if ( ! empty( $title )) {
                echo $args['before_title'] ?><span><?php echo esc_attr($instance['title']);?> </span><?php echo $args['after_title'];
             }  
            add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
            $query_args = array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'post_type' => 'product','ignore_sticky_posts' => true  );
            $query_args['meta_query'] = WC()->query->get_meta_query();
            $r = new WP_Query( $query_args );
            if ( $r->have_posts() ) {                
                    if($number!=1):
                        echo ' <div class="sidebar-products-carousel">
                                <div class="owl-carousel" id="sidebar-products-carousel">';
                    endif;
                while ( $r->have_posts() ) {
                    $r->the_post();
                    wc_get_template( 'content-widget-product.php', array( 'show_rating' => true ) );
                }
                    if($number!=1):
                        echo '</div> </div>';
                    endif;                
            }
            remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
            wp_reset_postdata();
            $content = ob_get_clean();     
            wp_cache_set('top_products', $cache, 'widget');
            echo $content;?>       
        </div>
        <?php endif;
        echo $after_widget;  ?>    
    <?php }
    
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
        $title = strip_tags($instance['title']);
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of products to show:','flatty' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
   
<?php }   
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');
            return $instance;
        
    }
 function flush_widget_cache() {
        wp_cache_delete('top_products', 'widget');
    }      
}
register_widget('WP_Widget_Top_Products_Bella');
/*code for woocommerce top rated product tabs*/
class WP_Widget_Hot_Deals_Bella extends WP_Widget {
   
    function __construct() {
         $widget_ops = array('classname' => 'Hot Deals', 'description' => __( "Gives list of hot deal products.","flatty") );
        parent::__construct('hot_deals_widget', __('Hot Deals(Bella)','bella'), $widget_ops);
        $this->alt_option_name = 'hot_deals';
    }   
    public function widget( $args, $instance ) {
         $cache = wp_cache_get('hot_deals', 'widget');
        if ( !is_array($cache) )
            $cache = array();
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }
        ob_start();
        extract($args);
        $title='';        
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );        
        $number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];      
        echo $before_widget;
         if($number!=0):?>
        <div class="widget widget-shop-deals">
         
        <?php if ( ! empty( $title )) {
            echo $args['before_title'] ?><span><?php echo esc_attr($instance['title']);?> </span><?php echo $args['after_title'];
         } 
        $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => $number,
                    'meta_key' => '_featured',
                    'meta_value' => 'yes',
                );        
        $r = new WP_Query( $args ); 
        if ( $r->have_posts() ) {            
                if($number!=1):
                    echo '  <div class="hot-deals-carousel">
                                <div class="owl-carousel" id="hot-deals-carousel">';
                  endif;
            while ( $r->have_posts() ) {
                $r->the_post();?>
                 <?php global $product; ?>
                   <div class="thumbnail thumbnail-hot-deal no-border no-padding">
                        <div class="media">
                             <a class="media-link" href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('top-product-thumbnails'); ?>    
                                 <span class="icon-view">
                                    <strong><i class="fa fa-eye"></i></strong>
                                 </span>                                    
                            </a>
                           
                        </div>
                        <div class="caption text-center">
                            <h4 class="caption-title"><?php echo esc_attr($product->get_title()); ?></h4>                          
                            <?php $rating_count = $product->get_rating_count();
                                $review_count = $product->get_review_count();
                                $average      = $product->get_average_rating();                                
                                if ( $rating_count > 0 ) : ?>
                                <div class="rating">
                                    <?php                                     
                                    $args = array(
                                   'rating' => $average,
                                   'type' => 'rating'                                 
                                        );?>
                                <?php wp_star_rating( $args ); ?>
                                </div><?php endif; ?> 
                                 <span class="reviews"><?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), '' . $review_count . '' ); ?></span>
                            <div class="price">
                              <?php echo $product->get_price_html(); ?>
                            </div>
                            <div class="caption-text">
                                <?php $excerpt = get_the_content();
                                $excerpt = strip_shortcodes($excerpt);
                                $excerpt = strip_tags($excerpt);
                                echo substr($excerpt, 0,100);?>
                            </div>                
                        </div>
                    </div>
            <?php }
                if($number!=1):
                    echo '</div> </div>';
                endif;
            
        }
        wp_reset_postdata();
        endif;?>       
    </div>   
    <?php }   
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
        $title = strip_tags($instance['title']);
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of products to show:','flatty' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
   
<?php
    
    
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');
            return $instance;
        
    }
 function flush_widget_cache() {
        wp_cache_delete('hot_deals', 'widget');
    }
      
}
register_widget('WP_Widget_Hot_Deals_Bella');
//Time ago code
function bella_time_ago() {
 
    global $post;
 
    $date = get_comment_time('G', true, $post);
 
    $chunks = array(
        array( 60 * 60 * 24 * 365 , __( 'year', 'bella' ), __( 'years', 'bella' ) ),
        array( 60 * 60 * 24 * 30 , __( 'month', 'bella' ), __( 'months', 'bella' ) ),
        array( 60 * 60 * 24 * 7, __( 'week', 'bella' ), __( 'weeks', 'bella' ) ),
        array( 60 * 60 * 24 , __( 'day', 'bella' ), __( 'days', 'bella' ) ),
        array( 60 * 60 , __( 'hour', 'bella' ), __( 'hours', 'bella' ) ),
        array( 60 , __( 'minute', 'bella' ), __( 'minutes', 'bella' ) ),
        array( 1, __( 'second', 'bella' ), __( 'seconds', 'bella' ) )
    );
 
    if ( !is_numeric( $date ) ) {
        $time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
        $date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
        $date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
    }
 
    $current_time = current_time( 'mysql', $gmt = 0 );
    $newer_date = strtotime( $current_time );
 
   
    $since = $newer_date - $date;
 
    if ( 0 > $since )
        return __( 'sometime', 'bella' );
 
    for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
 
        if ( ( $count = floor($since / $seconds) ) != 0 )
            break;
    }
 
    $output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
 
 
    if ( !(int)trim($output) ){
        $output = '0 ' . __( 'seconds', 'bella' );
    }
 
    $output .= __(' ago', 'bella');
 
    return $output;
}
add_filter('the_comment_time', 'bella_time_ago');
//For excerpt
function bella_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'bella_excerpt_more');
 /*Shop*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb' , 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count' , 20);
WC_Admin_Notices::remove_all_notices();
//thumbnails
if ( function_exists( 'add_theme_support' ) ) { 
        add_theme_support( 'post-thumbnails' );
         } //Adds thumbnails compatibility to the theme
    set_post_thumbnail_size( 200, 170, true ); // Sets the Post Main Thumbnails
    add_image_size( 'recent-thumbnails', 100, 70, true ); // Sets Recent Posts Thumbnails
    add_image_size( 'related-posts-thumbnails', 262,156, true );
    add_image_size( 'product-thumbnails', 70,90, true );
    add_image_size( 'top-product-thumbnails', 263,360, true );
    add_image_size( 'portfolio-thumbnails', 359,500, true );
    add_image_size( 'portfolio-related-thumbnails', 262,359, true );
    add_image_size( 'portfolio-single-thumbnails', 750,405, true );
    add_image_size( 'post-alt', 360,214, true );
    add_image_size( 'post', 170.5,120,true );
//To display desired number of products thumbnail
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 15;' ), 20 );
add_filter( 'woocommerce_checkout_fields' , 'bella_custom_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function bella_custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
     $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
     $fields['billing']['billing_company']['placeholder'] = 'Company Name';
     $fields['billing']['billing_phone']['placeholder'] = 'Phone Number';
     $fields['billing']['billing_email']['placeholder'] = 'Email Address';
     $fields['billing']['billing_state']['placeholder'] = 'State';
     $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name';
     $fields['shipping']['shipping_last_name']['placeholder'] = 'Last Name';
     $fields['shipping']['shipping_company']['placeholder'] = 'Company Name';
     $fields['shipping']['shipping_state']['placeholder'] = 'State';
     return $fields;
}
/**
 * Load Theme SO Widgets.
 */
if ( class_exists( 'SiteOrigin_Widget' ) ) {
  // Theme widgets.
  $theme_widgets = array(
    'address',
    'banner',
    'client-slider',
    'contact-form',
    'infobanner',
    'messagebox',
    'post-widget',
    'product',
    'productcarousel',
    'producttab',
    'sale-item',
    'slider',
    'spacer',
    'testimonials',
    'title',
  );
  $template_dir = get_template_directory();
  foreach ( $theme_widgets as $widget ) {
    require $template_dir . '/inc/so-widgets/' . $widget . '/' . $widget . '.php';
  }
}
if ( ! function_exists( 'bella_customize_so_widgets_status' ) ) :
  /**
   * Customize to make widgets active.
   *
   * @since 1.0.0
   *
   * @param array $active Array of widgets.
   * @return array Modified array.
   */
  function bella_customize_so_widgets_status( $active ) {
    $active['so-features-widget']    = false;
    $active['so-slider-widget']      = false;
    $active['so-google-map-widget']  = false;
    $active['so-image-widget']       = false;
    $active['so-cta-widget']         = false;
    $active['so-contact-widget']     = false;
    $active['so-testimonial-widget'] = false;
    $active['so-hero-widget']        = false;
    return $active;
  }
endif;
add_filter( 'siteorigin_widgets_active_widgets', 'bella_customize_so_widgets_status' );
