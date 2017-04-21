<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
global $bella_options, $woocommerce;
?>
<header class="header <?php echo $bella_options['header']? '':'fixed';?> <?php echo $bella_options['menu-style'];?> ">
    <div class="header-wrapper">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <?php if (isset($bella_options['logo']) && $bella_options['logo']['url']!='') : ?>
                    <a href="<?php echo esc_url(site_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        <img src="<?php echo esc_url($bella_options['logo']['url']); ?>"  data-at2x="<?php echo esc_url($bella_options['retinalogo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                    </a>
                <?php else :?>          
                    <a href="<?php echo esc_url(site_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="name">
                        <?php echo esc_attr(get_bloginfo('name')); ?><br>     
                    </a>         
                <?php endif; ?>            
            </div>
            <!-- /Logo -->
            <!-- Header search -->              
            <?php if (isset($bella_options['search']) && $bella_options['search'] == 1):?>
                <div class="header-search">
                    <form method="get" id="searchform_top" autocomplete="off" action="<?php echo esc_url(home_url( '/' )); ?>">
                        <input class="form-control" name="s" type="text" placeholder="What are you looking?"/>
                        <button><i class="fa fa-search"></i></button>  
                    </form>
                </div>
            <?php endif; ?>
            <!-- /Header search -->
        </div>
    </div>
    <div class="navigation-wrapper">
        <div class="container">
            <!-- Navigation -->
            <nav class="navigation <?php echo bella_header_class('nav'); ?> closed clearfix">
                <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
                <?php
                $args = array(
                    'theme_location' => 'secondary',
                    'container' => false,
                    'items_wrap' => '<ul class="nav sf-menu">%3$s</ul>',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu()',
                    'walker'  => new Bella_Menu_Walker()
                    );
                    wp_nav_menu($args);?>
                </nav>
                <!-- /Navigation -->
                <!-- Header shopping cart -->
                <?php if (isset($bella_options['cart']) && $bella_options['cart'] == 1 &&  is_plugin_active('woocommerce/woocommerce.php') ) :?>
                    <!-- Popup: Shopping cart items -->
                    <!-- /Popup: Shopping cart items -->
                    <div class="cart-wrapper visible-lg">
                        <?php if ( class_exists( 'YITH_WCWL' )) : ?> 
                            <a href="<?php echo do_shortcode('[yith_wcwl_wishlist_ur]');?>" class="btn btn-theme-transparent hidden-xs hidden-sm"><i class="fa fa-heart"></i></a>
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
                                                    $bella_short_product_title = (strlen($bella_product_title) > 28) ? substr($bella_product_title, 0, 25) . '...' : $bella_product_title;
                                                    echo '<h4 class="media-heading item-title"><a href="'.get_permalink($cart_item['product_id']).'">' .$cart_item['quantity'].''.__('x ', 'bella'). apply_filters('woocommerce_cart_widget_product_title', $bella_short_product_title, $_product) . '</a></h4>';?>
                                                    <?php echo '<p class="item-desc">'.$_product->get_categories(', ','','').'</p>';?>
                                                </div>  
                                            </div>
                                        <?php endif; 
                                        endforeach;?>                                         
                                    <?php else: echo __('No products in the cart.','bella'); endif;?>  
                                        <div class="media">
                                            <p class="pull-right item-price"><?php echo $woocommerce->cart->get_cart_total(); ?></p>
                                            <div class="media-body">
                                                <h4 class="media-heading item-title summary"><?php _e('Subtotal', 'bella'); ?></h4>
                                            </div>
                                        </div>                                     
                                        <div class="media">
                                            <div class="media-body">
                                                <div>
                                                    <a href="#" class="btn btn-theme btn-theme-dark" data-dismiss="modal"><?php _e('Close', 'bella'); ?></a>
                                                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="btn btn-theme btn-theme-transparent btn-call-checkout"><?php _e(' Checkout', 'bella'); ?></a>         
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    
                    </div>
            <!-- Header shopping cart -->
        <?php endif; ?>
    </div>
</div>
</header>
<!-- /HEADER -->          