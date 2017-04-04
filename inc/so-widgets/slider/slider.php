<?php

/*

Widget Name: Slider widget

Description: A very simple slider widget.

Author: jThemes Studio

Author URI: http://jthemesstudio.com

*/



class Bella_Widget_Slider_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'bella-slider',

			__('Bella Slider', 'siteorigin-widgets'),

			array(

				'description' => __('A responsive slider widget that supports images and video.', 'siteorigin-widgets'),

				'help' => 'http://siteorigin.com/widgets-bundle/slider-widget-documentation/',

				'panels_title' => false,

			),

			array(



			),

			array(



				'frames' => array(

					'type' => 'repeater',

					'label' => __('Slider frames', 'siteorigin-widgets'),

					'item_name' => __('Frame', 'siteorigin-widgets'),

					'item_label' => array(

						'selector' => "[id*='frames-layertitle']",

						'update_event' => 'change',

						'value_method' => 'val'

					),

					'fields' => array(	

						'id' => array(

							'type' => 'text',

							'label' => __('Slider ID', 'siteorigin-widgets'),

							'description' =>__('Give ID as 1,2, or 3', 'siteorigin-widgets'),

							'default' =>1							

						),					

						

						'background_image' => array(

							'type' => 'media',

							'library' => 'image',

							'label' => __('Background image', 'siteorigin-widgets'),

						),

				

						'layertitle' => array(

							'type' => 'textarea',

							'label' => __('Layer title', 'siteorigin-widgets'),

						),



						'layersubtitle' => array(

							'type' => 'textarea',

							'label' => __('Layer subtitle', 'siteorigin-widgets'),

						),

						'currency' => array(

							'type' => 'text',

							'label' => __('Currency', 'siteorigin-widgets'),

							'default'=>__('$', 'siteorigin-widgets')

						),

						'saleprice' => array(

							'type' => 'text',

							'label' => __('Sale Price', 'siteorigin-widgets'),

						),

						'regularprice' => array(

							'type' => 'text',

							'label' => __('Regular Price', 'siteorigin-widgets'),

						),

						

						'btntext' => array(

							'type' => 'text',

							'label' => __('More Button Text', 'siteorigin-widgets'),

							

						),

						'btneurl' => array(

							'type' => 'text',

							'label' => __('More Button URL', 'siteorigin-widgets'),

						

						),

						'new_window' => array(

							'type' => 'checkbox',

							'label' => __('Open Button URL in New Window', 'siteorigin-widgets'),

							'default' => false,

						),

					),

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



siteorigin_widget_register('bella-slider', __FILE__,'Bella_Widget_Slider_Widget');

