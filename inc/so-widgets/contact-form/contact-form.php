<?php

/*

Widget Name: Contact form  widget

Description: A very simple contact form widget.

Author: jThemes Studio	

Author URI: http://jthemesstudio.com

*/

class SiteOrigin_Widget_ContactForm_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'sow-contact-form',

			__('SiteOrigin Contact Form', 'siteorigin-widgets'),

			array(

				'description' => __('A very simple contact form widget.', 'siteorigin-widgets'),

				

			),

			array(),

			array(				),

				plugin_dir_path(__FILE__).'../'

				

		);

	}

	function get_template_name($instance) {

		return 'base';

	}

	function get_style_name($instance) {

		return false;

	}

	function form( $instance ) {

		global $wpdb;

		$instance = wp_parse_args( $instance, array(

			'id' => '',

		) );

		$contacts = $wpdb->get_results('SELECT id,post_name FROM '.$wpdb->posts.' where post_type="wpcf7_contact_form"');

		?>

		

		<p>

			<label for="<?php echo $this->get_field_id( 'id' ) ?>"><?php _e( 'Choose a Contact Form :', 'siteorigin-widgets' ) ?></label>

			<select name="<?php echo $this->get_field_name( 'id' ) ?>" id="<?php echo $this->get_field_id( 'id' ) ?>">



				<?php foreach($contacts as $contact) : ?>

				<option value="<?php echo esc_attr($contact->id); ?>" <?php selected($contact->id, $instance['id']) ?>><?php echo esc_attr($contact->post_name); ?></option>

				<?php endforeach; ?>

			</select>

		</p>

		

        

	<?php

	}	



}

siteorigin_widget_register('contact-form', __FILE__);