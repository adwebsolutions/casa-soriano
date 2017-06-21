<?php
vc_map( 
	array( 
		'base' => 'dh_instagram', 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'name' => __( 'Instagram', 'luxury-wp' ), 
		'description' => __( 'Instagram.', 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_instagram', 
		'icon' => 'dh-vc-icon-dh_instagram', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'param_name' => 'username', 
				'heading' => __( 'Instagram Username', 'luxury-wp' ), 
				'description' => '', 
				'type' => 'textfield', 
				'admin_label' => true ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Style', 'luxury-wp' ), 
				'param_name' => 'style', 
				'std' => 'slider', 
				'value' => array( __( 'Slider', 'luxury-wp' ) => 'slider', __( 'Grid', 'luxury-wp' ) => 'grid' ) ), 
			array( 
				'param_name' => 'grid_column', 
				'heading' => __( 'Grid Columns', 'luxury-wp' ), 
				'type' => 'dropdown', 
				'std' => '4', 
				'value' => array( 
					__( '2', 'luxury-wp' ) => '2', 
					__( '3', 'luxury-wp' ) => '3', 
					__( '4', 'luxury-wp' ) => '4', 
					__( '5', 'luxury-wp' ) => '5', 
					__( '6', 'luxury-wp' ) => '6' ), 
				'dependency' => array( 'element' => "style", 'value' => array( 'grid' ) ) ), 
			array( 
				'param_name' => 'images_number', 
				'heading' => __( 'Number of Images to Show', 'luxury-wp' ), 
				'type' => 'textfield', 
				'value' => '12' ), 
			array( 
				'param_name' => 'refresh_hour', 
				'heading' => __( 'Check for new images on every (hours)', 'luxury-wp' ), 
				'type' => 'textfield', 
				'value' => '5' ), 
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

class WPBakeryShortCode_DH_Instagram extends DHWPBakeryShortcode {
}