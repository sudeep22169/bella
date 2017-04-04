<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
 if ( $price_html = $product->get_price_html() ) : 
 	echo '<div class="price">';
 	echo $price_html; 
 	echo '</div>' ;
 endif; ?>

