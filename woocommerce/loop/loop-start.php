<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
 
  
global $bella_options;  
	$shop_layout=$bella_options['shop_layout'];
	if($shop_layout=='list-view')
	{
	 	echo'<div class="products list">';		
	}
	else
	{

		echo '<div class="row products grid">';
			
		}
	?> 