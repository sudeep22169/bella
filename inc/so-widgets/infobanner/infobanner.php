<?php

/*

Widget Name: Infobanner widget

Description: A very simple infobanner widget.

Author: jThemes Studio

Author URI: http://jthemesstudio.com

*/



class SiteOrigin_Widget_Infobanner_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'sow-infobanner',

			__('SiteOrigin Infobanner', 'siteorigin-widgets'),

			array(

				'description' => __('A responsive infobanner widget that supports images and video.', 'siteorigin-widgets'),

				'help' => 'http://siteorigin.com/widgets-bundle/infobanner-widget-documentation/',

				'panels_title' => false,

			),

			array(



			),

			array(			

						

						'icon' => array(

							'type' => 'icon',

							'label' => __('Icon', 'siteorigin-widgets'),

						),



				

						'title' => array(

							'type' => 'text',

							'label' => __('Infobanner title', 'siteorigin-widgets'),

						),





						'subtitle' => array(

							'type' => 'textarea',

							'label' => __('Layer subtitle', 'siteorigin-widgets'),

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



siteorigin_widget_register('infobanner', __FILE__);

