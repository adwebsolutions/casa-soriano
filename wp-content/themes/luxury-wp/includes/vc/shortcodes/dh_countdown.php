<?php
vc_map( 
	array( 
		'base' => 'dh_countdown', 
		'name' => __( 'Coundown', 'luxury-wp' ), 
		'description' => __( 'Display Countdown.', 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_countdown', 
		'icon' => 'dh-vc-icon-dh_countdown', 
		'show_settings_on_create' => true, 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'params' => array( 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Style', 'luxury-wp' ), 
				'param_name' => 'style', 
				'admin_label' => true, 
				'value' => array( __( 'White', 'luxury-wp' ) => 'white', __( 'Black', 'luxury-wp' ) => 'black' ), 
				'description' => __( 'Select style.', 'luxury-wp' ) ), 
			array( 
				'type' => 'ui_datepicker', 
				'heading' => __( 'Countdown end', 'luxury-wp' ), 
				'param_name' => 'end', 
				'description' => __( 'Please select day to end.', 'luxury-wp' ), 
				'value' => '' ), 
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

class WPBakeryShortCode_DH_Countdown extends DHWPBakeryShortcode {
}