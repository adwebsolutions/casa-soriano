<?php
$sliders = get_terms( 'dh_slider' );
$slider_option = array();
$slider_option[__( 'None', 'luxury-wp' )] = '';
foreach ( (array) $sliders as $slider ) {
	$slider_option[$slider->name] = $slider->slug;
}
vc_map( 
	array( 
		'base' => 'dh_slider', 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'name' => __( 'DH Slider', 'luxury-wp' ), 
		'description' => __( 'Display DH Slider.', 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_slider', 
		'icon' => 'dh-vc-icon-dh_slider', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'type' => 'dropdown', 
				'admin_label' => true, 
				'heading' => __( 'Slider', 'luxury-wp' ), 
				'param_name' => 'slider_slug', 
				'value' => $slider_option, 
				'description' => __( 'Select a slider.', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'visibility', 
				'heading' => __( 'Visibility', 'luxury-wp' ), 
				'type' => 'dropdown', 
				'std' => 'all', 
				'value' => array( 
					__( 'All Devices', 'luxury-wp' ) => "all", 
					__( 'Hidden Phone', 'luxury-wp' ) => "hidden-phone", 
					__( 'Hidden Tablet', 'luxury-wp' ) => "hidden-tablet", 
					__( 'Hidden PC', 'luxury-wp' ) => "hidden-pc", 
					__( 'Visible Phone', 'luxury-wp' ) => "visible-phone", 
					__( 'Visible Tablet', 'luxury-wp' ) => "visible-tablet", 
					__( 'Visible PC', 'luxury-wp' ) => "visible-pc" ) ), 
			array( 
				'param_name' => 'el_class', 
				'heading' => __( '(Optional) Extra class name', 'luxury-wp' ), 
				'type' => 'textfield', 
				'value' => '', 
				"description" => __( 
					"If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 
					'luxury-wp' ) ) ) ) );