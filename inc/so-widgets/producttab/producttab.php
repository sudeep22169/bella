<?php
/*
Widget Name: Products Tab  widget
Description: Gives you a widget to display your product tabs .
Author: jThemes Studio
Author URI: http://jthemesstudio.com
*/



class SiteOrigin_Widget_Producttab_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-producttab',
			__('Product Fullpage tabs ', 'siteorigin-widgets'),
			array(
				'description' => __('Display your full tabs of recent,featured and bestselling products.', 'siteorigin-widgets'),
				'help' => 'http://jthemesstudio.com/support/'
			),
			array(

			),
			array(
				
				'num' => array(
					'type' => 'number',
					'label' => __('Product number', 'siteorigin-widgets'),
					'default' => '4',
				),

				'featured' => array(
					'type' => 'checkbox',
					'label' => __('Show featured Products tab', 'siteorigin-widgets'),
					'default' => true,
				),

				'recent' => array(
					'type' => 'checkbox',
					'label' => __('Show Recent Products tab', 'siteorigin-widgets'),
					'default' => true,
				),
				'topseller' => array(
					'type' => 'checkbox',
					'label' => __('Show Top Seller Products tab', 'siteorigin-widgets'),
					'default' => true,
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

siteorigin_widget_register('producttab', __FILE__);