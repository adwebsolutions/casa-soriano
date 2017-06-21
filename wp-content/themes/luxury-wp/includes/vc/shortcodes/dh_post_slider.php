<?php
vc_map( 
	array( 
		'base' => 'dh_post_slider', 
		'name' => __( 'Post Slider', 'luxury-wp' ), 
		'description' => __( 'Display posts with slider.', 'luxury-wp' ), 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_post_slider', 
		'icon' => 'dh-vc-icon-dh_post_slider', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Columns', 'luxury-wp' ), 
				'param_name' => 'columns', 
				'std' => 2, 
				'value' => array( 
					__( '1', 'luxury-wp' ) => '1', 
					__( '2', 'luxury-wp' ) => '2', 
					__( '3', 'luxury-wp' ) => '3', 
					__( '4', 'luxury-wp' ) => '4' ), 
				'description' => __( 'Select whether to display the layout in 1, 2, 3 or 4 column.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Posts Per Page', 'luxury-wp' ), 
				'param_name' => 'posts_per_page', 
				'value' => 12, 
				'description' => __( 'Select number of posts per page.Set "-1" to display all', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Order by', 'luxury-wp' ), 
				'param_name' => 'orderby', 
				'value' => array( 
					__( 'Recent First', 'luxury-wp' ) => 'latest', 
					__( 'Older First', 'luxury-wp' ) => 'oldest', 
					__( 'Title Alphabet', 'luxury-wp' ) => 'alphabet', 
					__( 'Title Reversed Alphabet', 'luxury-wp' ) => 'ralphabet' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Pagination', 'luxury-wp' ), 
				'param_name' => 'hide_pagination', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide pagination of slider', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Previous/Next Control ?', 'luxury-wp' ), 
				'param_name' => 'hide_nav', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Date', 'luxury-wp' ), 
				'param_name' => 'hide_date', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide date in post meta info', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Author', 'luxury-wp' ), 
				'param_name' => 'hide_author', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide author in post meta info', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Category', 'luxury-wp' ), 
				'param_name' => 'hide_category', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide category in post meta info', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Comment', 'luxury-wp' ), 
				'param_name' => 'hide_comment', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide comment in post meta info', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Excerpt', 'luxury-wp' ), 
				'param_name' => 'hide_excerpt', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide excerpt', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Number of words in Excerpt', 'luxury-wp' ), 
				'param_name' => 'excerpt_length', 
				'value' => 30, 
				'dependency' => array( 'element' => 'hide_excerpt', 'is_empty' => true ), 
				'description' => __( 'The number of words', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Read More Link', 'luxury-wp' ), 
				'param_name' => 'hide_readmore', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Choose to hide the link', 'luxury-wp' ) ), 
			array( 
				'type' => 'post_category', 
				'heading' => __( 'Categories', 'luxury-wp' ), 
				'param_name' => 'categories', 
				'admin_label' => true, 
				'description' => __( 'Select a category or leave blank for all', 'luxury-wp' ) ), 
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

class WPBakeryShortCode_DH_Post_Slider extends DHWPBakeryShortcode {
}