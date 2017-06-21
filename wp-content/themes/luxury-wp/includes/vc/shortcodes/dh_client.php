<?php
vc_map( 
	array( 
		'base' => 'dh_client', 
		'name' => __( 'Client', 'luxury-wp' ), 
		'description' => __( 'Display list clients.', 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_client', 
		'icon' => 'dh-vc-icon-dh_client', 
		'show_settings_on_create' => true, 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'params' => array( 
			array( 
				'type' => 'attach_images', 
				'heading' => __( 'Images', 'luxury-wp' ), 
				'param_name' => 'images', 
				'value' => '', 
				'description' => __( 'Select images from media library.', 'luxury-wp' ) ), 
			array( 
				'type' => 'exploded_textarea', 
				'heading' => __( 'Custom links', 'luxury-wp' ), 
				'param_name' => 'custom_links', 
				'description' => __( 
					'Enter links for each image here. Divide links with linebreaks (Enter) . ', 
					'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Display type', 'luxury-wp' ), 
				'param_name' => 'display', 
				'value' => array( __( 'Slider', 'luxury-wp' ) => 'slider', __( 'Image grid', 'luxury-wp' ) => 'grid' ), 
				'description' => __( 'Select display type.', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Slide Pagination ?', 'luxury-wp' ), 
				'param_name' => 'hide_pagination', 
				'dependency' => array( 'element' => 'display', 'value' => array( 'slider' ) ), 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'param_name' => 'visible', 
				'heading' => __( 'The number of visible items on a slide or on a grid row', 'luxury-wp' ), 
				'type' => 'dropdown', 
				'value' => array( 2, 3, 4, 5, 6 ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Image style', 'luxury-wp' ), 
				'param_name' => 'style', 
				'value' => array( 
					__( 'Normal', 'luxury-wp' ) => 'normal', 
					__( 'Grayscale and Color on hover', 'luxury-wp' ) => 'grayscale' ), 
				'description' => __( 'Select image style.', 'luxury-wp' ) ), 
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

class WPBakeryShortCode_DH_Client extends DHWPBakeryShortcode {
}