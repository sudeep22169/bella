<?php $shortcode_attr = array();
	foreach($instance as $k => $v){
	if(empty($v)) continue;
	$shortcode_attr[] = $k.'="'.esc_attr($v).'"';
	}
	echo do_shortcode('[contact-form-7 '.implode(' ', $shortcode_attr).']');
?> 
