<?php
/*
Widget Name: Product  widget
Description: Gives you a widget to display your products.
Author: jThemes Studio
Author URI: http://jthemesstudio.com
*/



class SiteOrigin_Widget_Product_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-product',
			__('SiteOrigin Product ', 'siteorigin-widgets'),
			array(
				'description' => __('Display your products .', 'siteorigin-widgets'),
				'help' => 'http://siteorigin.com/widgets-bundle/'
			),
			array(

			),
			array(	
					'title' => array(
					'type' => 'text',
					'label' => __('Title', 'siteorigin-widgets'),					
					),

					'num' => array(
					'type' => 'number',
					'label' => __('Product number', 'siteorigin-widgets'),
					'default' => '3',
					),

					
				
				),
			
			plugin_dir_path(__FILE__).'../'
		);
	}

	function get_template_name($instance){
		return 'base';
	}

	function get_style_name($instance){
		return false;
	}
}

siteorigin_widget_register('product', __FILE__);