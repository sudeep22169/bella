<?php

/*

Widget Name: Sale Item widget

Description: A very simple sale item widget.

Author: jThemes Studio

Author URI: http://jthemesstudio.com

*/



class SiteOrigin_Widget_SaleItem_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'sow-saleitem',

			__('SiteOrigin Sale Item', 'siteorigin-widgets'),

			array(

				'description' => __('A simple sale item widget with image', 'siteorigin-widgets'),				

				'panels_title' => false,

			),

			array(



			),

			array(											

						

						'background_image' => array(

							'type' => 'media',

							'library' => 'image',

							'label' => __('Background image', 'siteorigin-widgets'),

						),

						'sale' => array(

							'type' => 'number',

							'label' => __('Percent in sale', 'siteorigin-widgets'),

							'description'=> __('Give a percent value of sale eg:50', 'siteorigin-widgets'),

						),

				

						'title' => array(

							'type' => 'text',

							'label' => __('Title', 'siteorigin-widgets'),

						),



						'item' => array(

							'type' => 'number',

							'label' => __('Number of items', 'siteorigin-widgets'),

						),

						

						'btntext' => array(

							'type' => 'text',

							'label' => __('Button Text', 'siteorigin-widgets'),

							

						),

						'btneurl' => array(

							'type' => 'text',

							'label' => __('Button URL', 'siteorigin-widgets'),

						

						),

						'new_window' => array(

							'type' => 'checkbox',

							'label' => __('Open Button URL in New Window', 'siteorigin-widgets'),

							'default' => false,

						),

					),

			



				

			

			plugin_dir_path(__FILE__).'../'

		);

	}





	function get_style_name($instance){

		return false;

	}



	function get_template_name($instance){

		return 'base';

	}



	



}



siteorigin_widget_register('saleitem', __FILE__);

