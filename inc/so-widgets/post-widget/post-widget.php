<?php
/*
Widget Name: Posts  widget
Description: Gives you a widget to display your posts list.
Author: jThemes Studio
Author URI: http://jthemesstudio.com
*/

class Bella_Widget_Post_Widget  extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'bella-post',
			__('Post List ', 'siteorigin-widgets'),
			array(
				'description' => __('Display your posts in a list.', 'siteorigin-widgets'),
				'help' => 'http://jthemesstudio.com/support/'
			),
			array(

			),
			array(
				
				'posts' => array(
					'type' => 'posts',
					'label' => __('Posts query', 'siteorigin-widgets'),
				),

				
				'alt' => array(
					'type' => 'checkbox',
					'label' => __('Display posts in alternate style', 'siteorigin-widgets'),
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


siteorigin_widget_register('bella-post', __FILE__,'Bella_Widget_Post_Widget');