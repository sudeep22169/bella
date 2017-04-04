<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
 <section class="page-section">
    <div class="container">     
        <div class="tabs-wrapper content-tabs woocommerce-tabs">
            <ul class="nav nav-tabs tabs ">
                <?php foreach ( $tabs as $key => $tab ) : ?>    
                    <li class="active <?php echo $key ?>_tab">                    
                        <a href="#tab-<?php echo $key ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key. '_tab_title', $tab['title'], $key ) ?></a>
                    </li>    
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
              <?php foreach ( $tabs as $key => $tab ) : ?>    
                  <div class="panel entry-content" id="tab-<?php echo $key ?>">
                       <?php $content = get_the_content('Read more');
          					if($content!=null):
          					call_user_func( $tab['callback'], $key, $tab );
          					endif;?>	  
                  </div>
            <?php endforeach; ?>
           </div>
      </div>
		</div>
</section>
<!--tabs reviews and description-->
<?php endif; ?>
