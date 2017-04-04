<?php

/*

Widget Name: Testimonials widget

Description: Displays testimonials with client image.

Author: jThemes Studio

Author URI: http://jthemesstudio.com

*/



class SiteOrigin_Widget_Testimonials_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'sow-testimonials',

			__( 'SiteOrigin Testimonials', 'siteorigin-widgets' ),

			array(

				'description' => __( 'Displays feedback from client.', 'siteorigin-widgets' ),

				

			),

			array(),

			array(

					

				'testimonials' => array(

					'type' => 'repeater',

					'label' => __('Testimonials', 'siteorigin-widgets'),

					'item_name' => __('Testimonial', 'siteorigin-widgets'),

					'item_label' => array(

						'selector' => "[id*='testimonials-name']",

						'update_event' => 'change',

						'value_method' => 'val'

					),

					'fields' => array(

											



						'text' => array(

							'type' => 'text',

							'label' => __('Text', 'siteorigin-widgets'),

						),



						'name' => array(

							'type' => 'text',

							'label' => __('Name', 'siteorigin-widgets')

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



siteorigin_widget_register('testimonials', __FILE__);