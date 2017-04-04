<?php
/*
Widget Name: Spacer  widget
Description: A very simple spacer widget.
Author: jThemes Studio	
Author URI: http://jthemesstudio.com
*/
class SiteOrigin_Widget_Spacer_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-spacer',
			__('SiteOrigin Spacer', 'siteorigin-widgets'),
			array(
				'description' => __('A very simple spacer widget.', 'siteorigin-widgets'),
				
			),
			array(),
			array(
				'padding' => array(
					'type' => 'text',
					'label' => __('Margin value (just value without px)', 'siteorigin-panels'),
				),
				
			)
		);
	}
	function get_template_name($instance) {
		return 'simple';
	}
	function get_style_name($instance) {
		return false;
	}

}
siteorigin_widget_register('spacer', __FILE__);