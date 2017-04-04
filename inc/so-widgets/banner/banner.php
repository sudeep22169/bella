<?php

/*

Widget Name: Banner widget

Description: A very simple banner widget.

Author: jThemes Studio

Author URI: http://jthemesstudio.com

*/



class SiteOrigin_Widget_Banner_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'sow-banner',

			__('SiteOrigin Banner', 'siteorigin-widgets'),

			array(

				'description' => __('A responsive banner widget that supports images and video.', 'siteorigin-widgets'),

				'help' => 'http://siteorigin.com/widgets-bundle/banner-widget-documentation/',

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





						'align' => array(

							'type' => 'select',

							'label' => __('Text alignment', 'siteorigin-widgets'),

							'options' => array(

								'left' => __('Left', 'siteorigin-widgets'),

								'right' => __('Right', 'siteorigin-widgets'),

								'center' => __('Center', 'siteorigin-widgets'),								

							)

						),

						'style' => array(

							'type' => 'select',

							'label' => __('Text Style', 'siteorigin-widgets'),

							'options' => array(

								'normal' => __('Normal Style', 'siteorigin-widgets'),

								'alt' => __('Alternate Style', 'siteorigin-widgets'),

								'big-text' => __('Big Text Style', 'siteorigin-widgets'),								

							)

						),

		

				

						'title' => array(

							'type' => 'textarea',

							'label' => __('Banner title', 'siteorigin-widgets'),

						),





						'subtitle' => array(

							'type' => 'textarea',

							'label' => __('Layer subtitle', 'siteorigin-widgets'),

						),

						

						'btntext' => array(

							'type' => 'text',

							'label' => __('More Button Text', 'siteorigin-widgets'),

							

						),

						'btnurl' => array(

							'type' => 'text',

							'label' => __('More Button URL', 'siteorigin-widgets'),

						

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



siteorigin_widget_register('banner', __FILE__);

