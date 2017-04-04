<?php
/*
Widget Name: Products Tab  widget
Description: Gives you a widget to display your product as a carousel.
Author: jThemes Studio
Author URI: http://jthemesstudio.com
*/



class SiteOrigin_Widget_Productcarousel_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-productcarousel',
			__(' Product Carousel ', 'siteorigin-widgets'),
			array(
				'description' => __('Display a carousel of latest products.', 'siteorigin-widgets'),
				'help' => 'http://jthemesstudio.com/support/'
			),
			array(

			),
			array(
				'product-type' => array(
						'type' => 'select',
						'label' => __('Product Type', 'siteorigin-widgets'),
						'options' => array(
							'featured' => __('Featured', 'siteorigin-widgets'),
							'top' => __('Top Rated', 'siteorigin-widgets'),						
											
						)
					),
				
				'num' => array(
					'type' => 'number',
					'label' => __('Product number', 'siteorigin-widgets'),
					'default' => '10',
				),
				'style' => array(
					'type' => 'checkbox',
					'label' => __('Big style of Product Carousel', 'siteorigin-widgets'),
					
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

siteorigin_widget_register('productcarousel', __FILE__);