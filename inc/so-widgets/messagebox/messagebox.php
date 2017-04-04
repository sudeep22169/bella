<?php

/*

Widget Name: Messagebox widget

Description: A very simple messagebox widget.

Author: jThemes Studio

Author URI: http://jthemesstudio.com

*/



class SiteOrigin_Widget_Messagebox_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'sow-messagebox',

			__('Messagebox', 'siteorigin-widgets'),

			array(

				'description' => __('A responsive messagebox widget that supports images and video.', 'siteorigin-widgets'),

				'help' => 'http://jthemesstudio.com/support/',

				'panels_title' => false,

			),

			array(



			),

			array(			

						



						'text' => array(

							'type' => 'textarea',

							'label' => __('Messagebox text', 'siteorigin-widgets'),

						),



						'btntext' => array(

							'type' => 'text',

							'label' => __('Button text', 'siteorigin-widgets'),

						),



						'btnurl' => array(

							'type' => 'text',

							'label' => __('Button url', 'siteorigin-widgets'),

						),

						'color' => array(

							'type' => 'color',

							'label' => __('Messagebox Color', 'siteorigin-widgets'),

						),





						'style' => array(

							'type' => 'select',

							'label' => __('Message Box style', 'siteorigin-widgets'),

							'options' => array(

								'clear' => __('Minimal Style No Button', 'siteorigin-widgets'),

								'normal' => __('Normal Style No Button', 'siteorigin-widgets'),

								'alt' => __('Alternative Style with Button', 'siteorigin-widgets'),

												

							)

						),

						'new_window' => array(

						'type' => 'checkbox',

						'label' => __('Open more URL in a new window', 'siteorigin-widgets'),

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



siteorigin_widget_register('messagebox', __FILE__);

