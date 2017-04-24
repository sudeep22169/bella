<?php

class SiteOrigin_Widget_Product_Category_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-product-category',
			__('SiteOrigin Product  Category', 'siteorigin-widgets'),
			array(
				'description' => __('Display your products with specific category .', 'siteorigin-widgets'),
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

					'product_categories' => array(
                    'type' => 'select',
                    'label' => __('Select a product category and filter on.', 'livemesh-so-widgets'),
                    'options' => bella_get_product_categories(),
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

siteorigin_widget_register('sow-product-category', __FILE__,'SiteOrigin_Widget_Product_Category_Widget');

function bella_get_product_categories(){

}
