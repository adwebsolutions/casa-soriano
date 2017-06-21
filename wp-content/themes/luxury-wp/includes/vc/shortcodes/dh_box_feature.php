<?php
vc_map( 
	array( 
		'base' => 'dh_box_feature', 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'name' => __( 'Box Feature', 'luxury-wp' ), 
		'description' => __( 'Box Feature.', 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_box_feature', 
		'icon' => 'dh-vc-icon-dh_box_feature', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Style', 'luxury-wp' ), 
				'param_name' => 'style', 
				'std' => '1', 
				'value' => array( 
					__( 'Style 1', 'luxury-wp' ) => '1', 
					__( 'Style 2', 'luxury-wp' ) => "2", 
					__( 'Style 3', 'luxury-wp' ) => "3", 
					__( 'Style 4', 'luxury-wp' ) => "4",
					__( 'Style 5', 'luxury-wp' ) => "5" ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Content Position', 'sitesao' ), 
				'param_name' => 'content_position', 
				'std' => 'default', 
				'dependency' => array( 'element' => 'style', 'value' => array( '5' ) ), 
				'value' => array( 
					__( 'Default', 'sitesao' ) => 'default', 
					__( 'Top', 'sitesao' ) => "top", 
					__( 'Bottom', 'sitesao' ) => "bottom", 
					__( 'Left', 'sitesao' ) => "left", 
					__( 'Right', 'sitesao' ) => "right", 
					__( 'Full Box', 'sitesao' ) => "full-box" ) ), 
			array( 
						'param_name' => 'link_title', 
						'heading' => __( 'Button Text', 'sitesao' ), 
						'type' => 'textfield', 
						'value' => '', 
						'dependency' => array( 'element' => 'style', 'value' => array( '5' ) ), 
						'description' => __( 'Button link text', 'sitesao' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Full Box with Primary Soild Background ?', 'luxury-wp' ), 
				'param_name' => 'primary_background', 
				'dependency' => array( 'element' => 'content_position', 'value' => array( 'full-box' ) ), 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Text color', 'luxury-wp' ), 
				'param_name' => 'text_color', 
				'dependency' => array( 'element' => 'style', 'value' => array( '5' ) ), 
				'std' => 'white', 
				'value' => array( __( 'White', 'luxury-wp' ) => "white", __( 'Black', 'luxury-wp' ) => "black" ) ), 
			array( 
				'type' => 'attach_image', 
				'heading' => __( 'Image Background', 'luxury-wp' ), 
				'param_name' => 'bg', 
				'description' => __( 'Image Background.', 'luxury-wp' ) ), 
			array( 
				'type' => 'href', 
				'heading' => __( 'Image URL (Link)', 'luxury-wp' ), 
				'param_name' => 'href', 
				'description' => __( 'Image Link.', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Target', 'luxury-wp' ), 
				'param_name' => 'target', 
				'std' => '_self', 
				'value' => array( __( 'Same window', 'luxury-wp' ) => '_self', __( 'New window', 'luxury-wp' ) => "_blank" ), 
				'dependency' => array( 'element' => 'href', 'not_empty' => true ) ), 
			
			array( 
				'param_name' => 'title', 
				'heading' => __( 'Title', 'luxury-wp' ), 
				'admin_label' => true, 
				'type' => 'textfield', 
				'value' => '', 
				'description' => __( 'Box Title', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'sub_title', 
				'heading' => __( 'Sub Title', 'luxury-wp' ), 
				'type' => 'textfield', 
				'value' => '', 
				'description' => __( 'Box Sub Title', 'luxury-wp' ) ), 
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

class WPBakeryShortCode_DH_Box_Feature extends DHWPBakeryShortcode {
}
