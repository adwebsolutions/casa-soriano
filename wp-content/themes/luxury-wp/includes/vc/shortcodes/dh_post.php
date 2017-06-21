<?php
vc_map( 
	array( 
		'base' => 'dh_post', 
		'name' => __( 'Post', 'luxury-wp' ), 
		'description' => __( 'Display post.', 'luxury-wp' ), 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_post', 
		'icon' => 'dh-vc-icon-dh_post', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Layout', 'luxury-wp' ), 
				'param_name' => 'layout', 
				'std' => 'default', 
				'admin_label' => true, 
				'value' => array( 
					__( 'Default', 'luxury-wp' ) => 'default', 
					__( 'Zigzag', 'luxury-wp' ) => 'zigzag', 
					__( 'Grid', 'luxury-wp' ) => 'grid', 
					__( 'Masonry', 'luxury-wp' ) => 'masonry', 
					__( 'Center', 'luxury-wp' ) => 'center' ), 
				'std' => 'default', 
				'description' => __( 'Select the layout for the blog shortcode.', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'grid_first', 
				'type' => 'checkbox', 
				'dependency' => array( 'element' => "layout", 'value' => array( 'grid' ) ), 
				'heading' => __( 'Full First Item', 'luxury-wp' ), 
				'description' => __( 'Show full item in Grid layout', 'luxury-wp' ), 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'param_name' => 'grid_no_border', 
				'type' => 'checkbox', 
				'dependency' => array( 'element' => "layout", 'value' => array( 'grid' ) ), 
				'heading' => __( 'Grid Style no Border', 'luxury-wp' ), 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Columns', 'luxury-wp' ), 
				'param_name' => 'columns', 
				'std' => 2, 
				'value' => array( __( '2', 'luxury-wp' ) => '2', __( '3', 'luxury-wp' ) => '3', __( '4', 'luxury-wp' ) => '4' ), 
				'dependency' => array( 'element' => "layout", 'value' => array( 'grid', 'masonry' ) ), 
				'description' => __( 'Select whether to display the layout in 2, 3 or 4 column.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Posts Per Page', 'luxury-wp' ), 
				'param_name' => 'posts_per_page', 
				'value' => 5, 
				'description' => __( 'Select number of posts per page.Set "-1" to display all', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Order by', 'luxury-wp' ), 
				'param_name' => 'orderby', 
				'std' => 'latest', 
				'value' => array( 
					__( 'Recent First', 'luxury-wp' ) => 'latest', 
					__( 'Older First', 'luxury-wp' ) => 'oldest', 
					__( 'Title Alphabet', 'luxury-wp' ) => 'alphabet', 
					__( 'Title Reversed Alphabet', 'luxury-wp' ) => 'ralphabet' ) ), 
			array( 
				'type' => 'post_category', 
				'heading' => __( 'Categories', 'luxury-wp' ), 
				'param_name' => 'categories', 
				'admin_label' => true, 
				'description' => __( 'Select a category or leave blank for all', 'luxury-wp' ) ), 
			array( 
				'type' => 'post_category', 
				'heading' => __( 'Exclude Categories', 'luxury-wp' ), 
				'param_name' => 'exclude_categories', 
				'description' => __( 'Select a category to exclude', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Post no padding', 'luxury-wp' ), 
				'param_name' => 'no_padding', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'dependency' => array( 'element' => "layout", 'value' => array( 'grid' ) ), 
				'description' => __( 'Disable padding of posts', 'luxury-wp' ) ), 
			
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Post Title', 'luxury-wp' ), 
				'param_name' => 'hide_post_title', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide the post title below the featured', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Link Title To Post', 'luxury-wp' ), 
				'param_name' => 'link_post_title', 
				'std' => 'yes', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes', __( 'No', 'luxury-wp' ) => 'no' ), 
				'description' => __( 'Choose if the title should be a link to the single post page.', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Thumbnail', 'luxury-wp' ), 
				'param_name' => 'hide_thumbnail', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide the post featured', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Excerpt', 'luxury-wp' ), 
				'param_name' => 'hide_excerpt', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'dependency' => array( 
					'element' => "layout", 
					'value' => array( 'default', 'medium', 'grid', 'masonry', 'zigzag', 'center' ) ), 
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
				'heading' => __( 'Hide Date', 'luxury-wp' ), 
				'param_name' => 'hide_date', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide date in post meta info', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Timeline Month', 'luxury-wp' ), 
				'param_name' => 'hide_month', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'dependency' => array( 'element' => "layout", 'value' => array( 'timeline' ) ), 
				'description' => __( 'Hide timeline month', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Comment', 'luxury-wp' ), 
				'param_name' => 'hide_comment', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide comment in post meta info', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Category', 'luxury-wp' ), 
				'param_name' => 'hide_category', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide category in post meta info', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Author', 'luxury-wp' ), 
				'param_name' => 'hide_author', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'dependency' => array( 
					'element' => "layout", 
					'value' => array( 'default', 'medium', 'grid', 'masonry', 'zigzag', 'center' ) ), 
				'description' => __( 'Hide author in post meta info', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Read More Link', 'luxury-wp' ), 
				'param_name' => 'hide_readmore', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'dependency' => array( 
					'element' => "layout", 
					'value' => array( 'default', 'medium', 'grid', 'masonry', 'zigzag', 'center' ) ), 
				'description' => __( 'Choose to hide the link', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Show Tags', 'luxury-wp' ), 
				'param_name' => 'show_tag', 
				'std' => 'no', 
				'value' => array( __( 'No', 'luxury-wp' ) => 'no', __( 'Yes', 'luxury-wp' ) => 'yes' ), 
				'dependency' => array( 
					'element' => "layout", 
					'value' => array( 'default', 'medium', 'grid', 'masonry', 'zigzag', 'center' ) ), 
				'description' => __( 'Choose to show the tags', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'std' => 'page_num', 
				'heading' => __( 'Pagination', 'luxury-wp' ), 
				'param_name' => 'pagination', 
				'value' => array( 
					__( 'Page Number', 'luxury-wp' ) => 'page_num', 
					__( 'Load More Button', 'luxury-wp' ) => 'loadmore', 
					__( 'Infinite Scrolling', 'luxury-wp' ) => 'infinite_scroll', 
					__( 'No', 'luxury-wp' ) => 'no' ), 
				'description' => __( 'Choose pagination type.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Load More Button Text', 'luxury-wp' ), 
				'param_name' => 'loadmore_text', 
				'dependency' => array( 'element' => "pagination", 'value' => array( 'loadmore' ) ), 
				'value' => __( 'Load More', 'luxury-wp' ) ), 
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

class WPBakeryShortCode_DH_Post extends DHWPBakeryShortcode {
}