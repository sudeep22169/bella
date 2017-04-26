<?php

class SiteOrigin_Widget_Top_Sellers_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-product-sellers',
			__('Bella Top Sellers ', 'siteorigin-widgets'),
			array(
				'description' => __('Display top sellers products .', 'siteorigin-widgets'),
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
siteorigin_widget_register('sow-product-sellers', __FILE__,'SiteOrigin_Widget_Top_Sellers_Widget');