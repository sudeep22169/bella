<?php

/*

Widget Name: Adress widget

Description: Displays a contact address.

Author: jThemes Studio

Author URI: http://jthemesstudio.com

*/

class SiteOrigin_Widget_Address_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'sow-address',

			__( 'SiteOrigin Address', 'siteorigin-widgets' ),

			array(

				'description' => __('Displays an contact address', 'siteorigin-widgets' ),

				

			),

			array(),

			array(

			    

			    

				'address' => array(

					'type' => 'text',

					'label' => __('Street Address', 'siteorigin-widgets'),

				),

				'telephone' => array(

					'type' => 'text',

					'label' => __('Phone number', 'siteorigin-widgets'),

				),

				'fax' => array(

					'type' => 'text',

					'label' => __('Fax', 'siteorigin-widgets'),

				),

				

				'service_email' => array(

					'type' => 'text',

					'label' => __('Email address', 'siteorigin-widgets'),

				),

				'extra_email' => array(

					'type' => 'text',

					'label' => __('Alternate Email address', 'siteorigin-widgets'),

				),

				'text' => array(

					'type' => 'text',

					'label' => __('Description', 'siteorigin-widgets'),

				),			



			)

		);	

	}



function initialize() {

		$this->register_frontend_styles(

			array(

				array(

					'siteorigin-address',

					siteorigin_widget_get_plugin_dir_url( 'address' ) . 'css/style.css',

					array(),

					SOW_BUNDLE_VERSION

				)

			)

		);

	}



	function get_style_name($instance){

		return false;

	}



	function get_template_name($instance){

		return 'base';

	}



	

}

siteorigin_widget_register('address', __FILE__);