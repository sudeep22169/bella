<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>

<?php  

    global $bella_options;

    global $post;

    if(is_home()){

        $pageid=get_option('page_for_posts');

    } else {

        $pageid=get_the_ID();

    }

    

    if($menu=get_post_meta( $pageid, 'bella_menu_select',true)){

    $menu_object = get_term_by('term_taxonomy_id',$menu[0] , 'nav_menu');

    }

    global $woocommerce;



?>



<?php if (!empty($bella_options['topbar']) && $bella_options['topbar']==1) : ?>     

    <div class="top-bar">

        <div class="container">

            <div class="top-bar-left">

                <ul class="list-inline">

                     <?php $logo_login=get_template_directory_uri().'/assets/img/icon-1.png';

                     $logo_signup=get_template_directory_uri().'/assets/img/icon-2.png';?>

                     <?php if (!is_user_logged_in()) : ?>      

                        <li class="icon-user"><a href="<?php echo esc_url(wp_login_url()); ?>"><img src="<?php echo esc_url($logo_login);?>" alt=""/> <span><?php _e('Login','bella')?></span></a></li>

                        <li class="icon-form"><a href="<?php echo esc_url(wp_login_url()); ?>"><img src="<?php echo esc_url($logo_signup);?>" alt=""/> <span><?php _e('Not a Member? ','bella')?> <span class="colored"><?php _e('Sign Up','bella')?></span></span></a></li>

                     <?php else: ?>

                        <li class="icon-user"><a href="<?php echo esc_url(wp_logout_url()); ?>"><img src="<?php echo esc_url($logo_login);?>" alt=""/> <span><?php _e('Logout','bella')?></span></a></li>

                      <?php endif; ?>                   

                     <?php if (!empty($bella_options['topbar-email'])) : ?><li><a href="mailto:<?php echo esc_attr($bella_options['topbar-email']); ?>"><i class="fa fa-envelope"></i><span><?php echo esc_attr($bella_options['topbar-email']); ?></span></a></li><?php endif; ?> 

                     <!-- BEGIN: WPML MENU -->     

                    <li class="dropdown currency">

                       <?php do_action('icl_language_selector'); ?> 

                    </li>

                    

                </ul>

            </div>

        <?php

        if(isset($menu_object) && is_object($menu_object)){

            $args = array(

            'menu'            => $menu_object->slug,

            'items_wrap' => '<div class="top-bar-right "><ul class="list-inline">%3$s</ul></div>',

            'echo'            => true,

            'fallback_cb'     => 'wp_page_menu()',

            'walker'  => new description_walker()

            );

            } else {

            $args = array(

            'theme_location' => 'primary',

            'items_wrap' => '<div class="top-bar-right"><ul class="list-inline">%3$s</ul></div>',

            'echo'            => true,

            'fallback_cb'     => 'wp_page_menu()',

            'walker'  => new description_walker()



            );

        }

        wp_nav_menu($args);?>

        </div>

    </div>      

<?php endif; ?>          

<?php 
$header_style = get_post_meta( $pageid,'bella_header_style', true);
switch ($header_style) {

           case 'default':
               get_template_part('header-style/default');
               break;
                
           case 'header3':
               get_template_part('header-style/header3');
               break;

           case 'header4':
                get_template_part('header-style/header4');
               break;

           default:
               get_template_part('header-style/default');
               break;
       }
       ?>   

       





  

  







