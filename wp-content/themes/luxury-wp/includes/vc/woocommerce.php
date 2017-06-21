<?php
vc_map( 
	array( 
		'base' => 'dh_product_slider', 
		'name' => __( 'Product Slider', 'luxury-wp' ), 
		'description' => __( 'Animated products with carousel.', 'luxury-wp' ), 
		'as_parent' => array( 
			'only' => 'product_category,product_categories,dhwc_product_brands,dh_wc_product_sale_countdown,products,related_products,product_attribute,featured_products,top_rated_products,best_selling_products,sale_products,recent_products' ), 
		'content_element' => true, 
		"category" => __( "WooCommerce", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'js_view' => 'VcColumnView', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Carousel Title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'Enter text which will be used as widget title. Leave blank if no title is needed.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'heading' => __( 'Title color', 'luxury-wp' ), 
				'param_name' => 'title_color', 
				'default', 
				'dependency' => array( 'element' => "title", 'not_empty' => true ), 
				'value' => array( 
					__( 'Default', 'luxury-wp' ) => 'default', 
					__( 'Primary', 'luxury-wp' ) => 'primary', 
					__( 'Success', 'luxury-wp' ) => 'success', 
					__( 'Info', 'luxury-wp' ) => 'info', 
					__( 'Warning', 'luxury-wp' ) => 'warning', 
					__( 'Danger', 'luxury-wp' ) => 'danger' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'heading' => __( 'Transition', 'luxury-wp' ), 
				'param_name' => 'fx', 
				'std' => 'scroll', 
				'value' => array( 
					'Scroll' => 'scroll', 
					'Directscroll' => 'directscroll', 
					'Fade' => 'fade', 
					'Cross fade' => 'crossfade', 
					'Cover' => 'cover', 
					'Cover fade' => 'cover-fade', 
					'Uncover' => 'cover-fade', 
					'Uncover fade' => 'uncover-fade' ), 
				'description' => __( 'Indicates which effect to use for the transition.', 'luxury-wp' ) ), 
			
			array( 
				'save_always'=>true,
				'param_name' => 'scroll_speed', 
				'heading' => __( 'Transition Scroll Speed (ms)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '700', 
				'data_min' => '100', 
				'data_step' => '100', 
				'data_max' => '3000' ), 
			
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Easing", 'luxury-wp' ), 
				"param_name" => "easing", 
				'std' => 'linear', 
				"value" => array( 
					'linear' => 'linear', 
					'swing' => 'swing', 
					'easeInQuad' => 'easeInQuad', 
					'easeOutQuad' => 'easeOutQuad', 
					'easeInOutQuad' => 'easeInOutQuad', 
					'easeInCubic' => 'easeInCubic', 
					'easeOutCubic' => 'easeOutCubic', 
					'easeInOutCubic' => 'easeInOutCubic', 
					'easeInQuart' => 'easeInQuart', 
					'easeOutQuart' => 'easeOutQuart', 
					'easeInOutQuart' => 'easeInOutQuart', 
					'easeInQuint' => 'easeInQuint', 
					'easeOutQuint' => 'easeOutQuint', 
					'easeInOutQuint' => 'easeInOutQuint', 
					'easeInExpo' => 'easeInExpo', 
					'easeOutExpo' => 'easeOutExpo', 
					'easeInOutExpo' => 'easeInOutExpo', 
					'easeInSine' => 'easeInSine', 
					'easeOutSine' => 'easeOutSine', 
					'easeInOutSine' => 'easeInOutSine', 
					'easeInCirc' => 'easeInCirc', 
					'easeOutCirc' => 'easeOutCirc', 
					'easeInOutCirc' => 'easeInOutCirc', 
					'easeInElastic' => 'easeInElastic', 
					'easeOutElastic' => 'easeOutElastic', 
					'easeInOutElastic' => 'easeInOutElastic', 
					'easeInBack' => 'easeInBack', 
					'easeOutBack' => 'easeOutBack', 
					'easeInOutBack' => 'easeInOutBack', 
					'easeInBounce' => 'easeInBounce', 
					'easeOutBounce' => 'easeOutBounce', 
					'easeInOutBounce' => 'easeInOutBounce' ), 
				"description" => __( 
					"Select the animation easing you would like for slide transitions <a href=\"http://jqueryui.com/resources/demos/effect/easing.html\" target=\"_blank\"> Click here </a> to see examples of these.", 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'checkbox', 
				'heading' => __( 'Item no Padding ?', 'luxury-wp' ), 
				'param_name' => 'no_padding', 
				'description' => __( 'Item No Padding', 'luxury-wp' ), 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'checkbox', 
				'heading' => __( 'Autoplay ?', 'luxury-wp' ), 
				'param_name' => 'auto_play', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'checkbox', 
				'heading' => __( 'Hide Slide Pagination ?', 'luxury-wp' ), 
				'param_name' => 'hide_pagination', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'checkbox', 
				'heading' => __( 'Hide Previous/Next Control ?', 'luxury-wp' ), 
				'param_name' => 'hide_control', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'heading' => __( 'Previous/Next Control Position', 'luxury-wp' ), 
				'param_name' => 'control_position', 
				'std' => 'default', 
				'dependency' => array( 'element' => "title", 'not_empty' => true ), 
				'value' => array( 
					__( 'Default', 'luxury-wp' ) => 'default', 
					__( 'Center with Title', 'luxury-wp' ) => 'center', 
					__( 'Right with Title', 'luxury-wp' ) => 'right' ) ), 
			array( 
				'save_always'=>true,
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
				'save_always'=>true,
				'param_name' => 'el_class', 
				'heading' => __( '(Optional) Extra class name', 'luxury-wp' ), 
				'type' => 'textfield', 
				
				"description" => __( 
					"If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 
					'luxury-wp' ) ),
			array( 
				'save_always'=>true,
				'type' => 'css_editor', 
				'heading' => __( 'Css', 'luxury-wp' ), 
				'param_name' => 'css', 
				'group' => __( 'Design options', 'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "Products Sales Countdown", 'luxury-wp' ), 
		"base" => "dh_wc_product_sale_countdown", 
		"category" => __( "WooCommerce", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'List multiple products slider.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				"type" => "textfield", 
				"heading" => __( "Product Per Page", 'luxury-wp' ), 
				"param_name" => "posts_per_page", 
				"admin_label" => true, 
				"value" => 12 ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Columns", 'luxury-wp' ), 
				"param_name" => "columns", 
				"std" => 4, 
				"admin_label" => true, 
				"value" => array( 1, 2, 3, 4, 5, 6 ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Products Ordering", 'luxury-wp' ), 
				"param_name" => "orderby", 
				"value" => array( 
					__( 'Publish Date', 'luxury-wp' ) => 'date', 
					__( 'Modified Date', 'luxury-wp' ) => 'modified', 
					__( 'Random', 'luxury-wp' ) => 'rand', 
					__( 'Alphabetic', 'luxury-wp' ) => 'title', 
					__( 'Popularity', 'luxury-wp' ) => 'popularity', 
					__( 'Rate', 'luxury-wp' ) => 'rating', 
					__( 'Price', 'luxury-wp' ) => 'price' ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"class" => "", 
				"heading" => __( "Ascending or Descending", 'luxury-wp' ), 
				"param_name" => "order", 
				"value" => array( __( 'Ascending', 'luxury-wp' ) => 'ASC', __( 'Descending', 'luxury-wp' ) => 'DESC' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "Product Masonry", 'luxury-wp' ), 
		"base" => "dh_wc_product_mansory", 
		"category" => __( "WooCommerce", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'List products with Masonry layout.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'autocomplete',
				"heading" => __( "Categories", 'luxury-wp' ), 
				'settings' => array( 'multiple' => true, 'sortable' => true ),
				"param_name" => "category", 
				"admin_label" => true ), 
			array( 
				'save_always'=>true,
				"type" => "textfield", 
				"heading" => __( "Product Per Page", 'luxury-wp' ), 
				"param_name" => "per_page", 
				"admin_label" => true, 
				"value" => 12 ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Columns", 'luxury-wp' ), 
				"param_name" => "columns", 
				"std" => 4, 
				"admin_label" => true, 
				"value" => array( 2, 3, 4, 5, 6 ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'show', 
				'heading' => __( 'Show', 'luxury-wp' ), 
				
				'value' => array( 
					__( 'All Products', 'luxury-wp' ) => '', 
					__( 'Featured Products', 'luxury-wp' ) => 'featured', 
					__( 'On-sale Products', 'luxury-wp' ) => 'onsale' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'orderby', 
				'heading' => __( 'Order by', 'luxury-wp' ), 
				
				'std' => 'date', 
				'value' => array( 
					__( 'Date', 'luxury-wp' ) => 'date', 
					__( 'Price', 'luxury-wp' ) => 'price', 
					__( 'Random', 'luxury-wp' ) => 'rand', 
					__( 'Sales', 'luxury-wp' ) => 'sales' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'order', 
				'heading' => _x( 'Order', 'Sorting order', 'luxury-wp' ), 
				
				'std' => 'asc', 
				'value' => array( __( 'ASC', 'luxury-wp' ) => 'asc', __( 'DESC', 'luxury-wp' ) => 'desc' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'hide_all_filter', 
				'heading' => __( 'Hide All Filter Products', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'hide_free', 
				'heading' => __( 'Hide free products', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'show_hidden', 
				'heading' => __( 'Show hidden products', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "Product Tab", 'luxury-wp' ), 
		"base" => "dh_wc_product_tab", 
		"category" => __( "WooCommerce", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'List products with Tab layout.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'Enter text which will be used as widget title. Leave blank if no title is needed.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				"type" => "attach_image", 
				"heading" => __( "Title Badge", 'luxury-wp' ), 
				"param_name" => "title_badge", 
				"value" => "", 
				"description" => __( "Select image from media library.", 'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'colorpicker', 
				'heading' => __( 'Tab Color', 'luxury-wp' ), 
				'param_name' => 'tab_color', 
				'description' => __( 'Tab color.', 'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				"type" => "attach_image", 
				"heading" => __( "Tab Banner", 'luxury-wp' ), 
				"param_name" => "tab_banner", 
				"value" => "", 
				"description" => __( "Select image from media library.", 'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'href', 
				'dependency' => array( 'element' => 'tab_banner', 'not_empty' => true ), 
				'heading' => __( 'URL (Link)', 'luxury-wp' ), 
				'param_name' => 'href', 
				'description' => __( 'Banner link.', 'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'heading' => __( 'Target', 'luxury-wp' ), 
				'param_name' => 'target', 
				'std' => '_self', 
				'value' => array( __( 'Same window', 'luxury-wp' ) => '_self', __( 'New window', 'luxury-wp' ) => "_blank" ), 
				'dependency' => array( 
					'element' => 'href', 
					'not_empty' => true, 
					'callback' => 'vc_button_param_target_callback' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'autocomplete', 
				'heading' => __( 'Categories', 'luxury-wp' ), 
				'param_name' => 'category', 
				'admin_label' => true, 
				'settings' => array( 'multiple' => true, 'sortable' => true ), 
				'save_always' => true, 
				'description' => __( 'List of product categories', 'luxury-wp' ) ), 
			// array(
			// "type" => "product_category",
			// "heading" => __( "Categories", 'luxury-wp' ),
			// "param_name" => "category",
			// "admin_label" => true ),
			array( 
				'save_always'=>true,
				"type" => "textfield", 
				"heading" => __( "Product Per Page", 'luxury-wp' ), 
				"param_name" => "per_page", 
				"admin_label" => true, 
				"value" => 8 ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Columns", 'luxury-wp' ), 
				"param_name" => "columns", 
				"std" => 4, 
				"admin_label" => true, 
				"value" => array( 2, 3, 4, 5, 6 ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'show', 
				'heading' => __( 'Show', 'luxury-wp' ), 
				
				'value' => array( 
					__( 'All Products', 'luxury-wp' ) => '', 
					__( 'Featured Products', 'luxury-wp' ) => 'featured', 
					__( 'On-sale Products', 'luxury-wp' ) => 'onsale' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'orderby', 
				'heading' => __( 'Order by', 'luxury-wp' ), 
				
				'std' => 'date', 
				'value' => array( 
					__( 'Date', 'luxury-wp' ) => 'date', 
					__( 'Price', 'luxury-wp' ) => 'price', 
					__( 'Random', 'luxury-wp' ) => 'rand', 
					__( 'Sales', 'luxury-wp' ) => 'sales' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'order', 
				'heading' => _x( 'Order', 'Sorting order', 'luxury-wp' ), 
				
				'std' => 'asc', 
				'value' => array( __( 'ASC', 'luxury-wp' ) => 'asc', __( 'DESC', 'luxury-wp' ) => 'desc' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'hide_free', 
				'heading' => __( 'Hide free products', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'show_hidden', 
				'heading' => __( 'Show hidden products', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "Product Categories Grid", 'luxury-wp' ), 
		"base" => "dh_wc_product_categories_grid", 
		"category" => __( "WooCommerce", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Display categories with grid layout.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				"type" => "product_category", 
				"heading" => __( "Categories", 'luxury-wp' ), 
				"param_name" => "ids", 
				'select_field' => 'id', 
				"admin_label" => true ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"class" => "", 
				'std' => '1', 
				"heading" => __( "Grid Style", 'luxury-wp' ), 
				"param_name" => "style", 
				'admin_label' => true, 
				"value" => array( 
					__( 'Style 1', 'luxury-wp' ) => '1', 
					__( 'Style 2', 'luxury-wp' ) => '2', 
					__( 'Style 3', 'luxury-wp' ) => '3', 
					__( 'Style 4', 'luxury-wp' ) => '4' ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"class" => "", 
				'std' => '1', 
				"heading" => __( "Grid Gutter", 'luxury-wp' ), 
				"param_name" => "gutter", 
				"value" => array( __( 'Yes', 'luxury-wp' ) => '1', __( 'No', 'luxury-wp' ) => '0' ) ), 
			array( 
				'save_always'=>true,
				"type" => "textfield", 
				"heading" => __( "Number", 'luxury-wp' ), 
				"param_name" => "number", 
				"admin_label" => true, 
				'description' => __( 
					'You can specify the number of category to show (Leave blank to display all categories).', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Products Ordering", 'luxury-wp' ), 
				"param_name" => "orderby", 
				'std' => 'date', 
				"value" => array( 
					__( 'Category Order', 'luxury-wp' ) => 'order', 
					__( 'Name', 'luxury-wp' ) => 'name', 
					__( 'Term ID', 'luxury-wp' ) => 'term_id', 
					__( 'Taxonomy Count', 'luxury-wp' ) => 'count', 
					__( 'ID', 'luxury-wp' ) => 'id' ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"class" => "", 
				'std' => 'ASC', 
				"heading" => __( "Ascending or Descending", 'luxury-wp' ), 
				"param_name" => "order", 
				"value" => array( __( 'Ascending', 'luxury-wp' ) => 'ASC', __( 'Descending', 'luxury-wp' ) => 'DESC' ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"class" => "", 
				'std' => '1', 
				"heading" => __( "Hide Empty", 'luxury-wp' ), 
				"param_name" => "hide_empty", 
				"value" => array( __( 'Yes', 'luxury-wp' ) => '1', __( 'No', 'luxury-wp' ) => '0' ) ) ) ) );
if ( taxonomy_exists( 'product_lookbook' ) ) {
	vc_map( 
		array( 
			"name" => __( "Product Lookbooks", 'luxury-wp' ), 
			"base" => "dh_wc_product_lookbooks", 
			"category" => __( "WooCommerce", 'luxury-wp' ), 
			"icon" => "dh-vc-icon-dh_woo", 
			"class" => "dh-vc-element dh-vc-element-dh_woo", 
			'description' => __( 'List all products by lookbooks.', 'luxury-wp' ), 
			"params" => array( 
				array( 
					'save_always'=>true,
					"type" => "autocomplete", 
					"heading" => __( "Lookbooks", 'luxury-wp' ), 
					"param_name" => "ids", 
					'settings' => array( 'multiple' => true, 'sortable' => true ),
					"admin_label" => true ), 
				array( 
					'save_always'=>true,
					"type" => "dropdown", 
					"heading" => __( "Style", 'luxury-wp' ), 
					"param_name" => "style", 
					"std" => 'slider', 
					"admin_label" => true, 
					"value" => array( __( 'Slider', 'luxury-wp' ) => 'slider', __( 'Grid', 'luxury-wp' ) => 'grid' ) ) ) ) );
}
if ( taxonomy_exists( 'product_brand' ) ) {
	vc_map( 
		array( 
			"name" => __( "Product Brands", 'luxury-wp' ), 
			"base" => "dhwc_product_brands", 
			"category" => __( "WooCommerce", 'luxury-wp' ), 
			"icon" => "dh-vc-icon-dh_woo", 
			"class" => "dh-vc-element dh-vc-element-dh_woo", 
			'description' => __( 'List all (or limited) product brands.', 'luxury-wp' ), 
			"params" => array( 
				array( 
					'save_always'=>true,
					"type" => "product_brand", 
					"heading" => __( "Brands", 'luxury-wp' ), 
					"param_name" => "ids", 
					"admin_label" => true ), 
				array( 
					'save_always'=>true,
					"type" => "textfield", 
					"heading" => __( "Number", 'luxury-wp' ), 
					"param_name" => "number", 
					"admin_label" => true, 
					'description' => __( 
						'You can specify the number of brand to show (Leave blank to display all brands).', 
						'luxury-wp' ) ), 
				array( 
					'save_always'=>true,
					"type" => "dropdown", 
					"heading" => __( "Columns", 'luxury-wp' ), 
					"param_name" => "columns", 
					"std" => 4, 
					"admin_label" => true, 
					"value" => array( 2, 3, 4, 5, 6 ) ), 
				array( 
					'save_always'=>true,
					"type" => "dropdown", 
					"heading" => __( "Products Ordering", 'luxury-wp' ), 
					"param_name" => "orderby", 
					'std' => 'date', 
					"value" => array( 
						__( 'Publish Date', 'luxury-wp' ) => 'date', 
						__( 'Modified Date', 'luxury-wp' ) => 'modified', 
						__( 'Random', 'luxury-wp' ) => 'rand', 
						__( 'Alphabetic', 'luxury-wp' ) => 'title', 
						__( 'Popularity', 'luxury-wp' ) => 'popularity', 
						__( 'Rate', 'luxury-wp' ) => 'rating', 
						__( 'Price', 'luxury-wp' ) => 'price' ) ), 
				array( 
					'save_always'=>true,
					"type" => "dropdown", 
					"class" => "", 
					'std' => 'ASC', 
					"heading" => __( "Ascending or Descending", 'luxury-wp' ), 
					"param_name" => "order", 
					"value" => array( __( 'Ascending', 'luxury-wp' ) => 'ASC', __( 'Descending', 'luxury-wp' ) => 'DESC' ) ), 
				array( 
					'save_always'=>true,
					"type" => "dropdown", 
					"class" => "", 
					'std' => '1', 
					"heading" => __( "Hide Empty", 'luxury-wp' ), 
					"param_name" => "hide_empty", 
					"value" => array( __( 'Yes', 'luxury-wp' ) => '1', __( 'No', 'luxury-wp' ) => '0' ) ) ) ) );
}
vc_map( 
	array( 
		"name" => __( "Add To Cart URL", 'luxury-wp' ), 
		"base" => "add_to_cart_url", 
		"category" => __( "WooCommerce", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Show URL on the add to cart button.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				"type" => "products_ajax", 
				"heading" => __( "Select product", 'luxury-wp' ), 
				'single_select' => true, 
				'admin_label' => true, 
				"param_name" => "id" ) ) ) );
vc_map( 
	array( 
		"name" => __( "Products Grid", 'luxury-wp' ), 
		"base" => "dh_wc_products_grid", 
		"category" => __( "WooCommerce", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'List multiple products grid shortcode.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textarea_html', 
				'holder' => 'div', 
				'heading' => __( 'Text Description', 'luxury-wp' ), 
				'param_name' => 'content', 
				'value' => __( 
					'<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				"type" => "attach_image", 
				"heading" => __( "Image Description", 'luxury-wp' ), 
				"param_name" => "image_desc", 
				"value" => "", 
				"description" => __( "Select image from media library.", 'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				"type" => "products_ajax", 
				"heading" => __( "Select products", 'luxury-wp' ), 
				"param_name" => "ids", 
				"admin_label" => true ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Products Ordering", 'luxury-wp' ), 
				"param_name" => "orderby", 
				'std' => 'date', 
				"value" => array( 
					__( 'Publish Date', 'luxury-wp' ) => 'date', 
					__( 'Modified Date', 'luxury-wp' ) => 'modified', 
					__( 'Random', 'luxury-wp' ) => 'rand', 
					__( 'Alphabetic', 'luxury-wp' ) => 'title', 
					__( 'Popularity', 'luxury-wp' ) => 'popularity', 
					__( 'Rate', 'luxury-wp' ) => 'rating', 
					__( 'Price', 'luxury-wp' ) => 'price' ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"class" => "", 
				'std' => 'ASC', 
				"heading" => __( "Ascending or Descending", 'luxury-wp' ), 
				"param_name" => "order", 
				"value" => array( __( 'Ascending', 'luxury-wp' ) => 'ASC', __( 'Descending', 'luxury-wp' ) => 'DESC' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "Recent Products", 'luxury-wp' ), 
		"base" => "recent_products", 
		"category" => __( "WooCommerce", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Recent Products shortcode.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				"type" => "textfield", 
				"heading" => __( "Product Per Page", 'luxury-wp' ), 
				"param_name" => "per_page", 
				"admin_label" => true, 
				"value" => 12 ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Columns", 'luxury-wp' ), 
				"param_name" => "columns", 
				"std" => 4, 
				"admin_label" => true, 
				"value" => array( '', 1, 2, 3, 4, 5, 6 ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"heading" => __( "Products Ordering", 'luxury-wp' ), 
				"param_name" => "orderby", 
				'std' => 'date', 
				"value" => array( 
					__( 'Publish Date', 'luxury-wp' ) => 'date', 
					__( 'Modified Date', 'luxury-wp' ) => 'modified', 
					__( 'Random', 'luxury-wp' ) => 'rand', 
					__( 'Alphabetic', 'luxury-wp' ) => 'title', 
					__( 'Popularity', 'luxury-wp' ) => 'popularity', 
					__( 'Rate', 'luxury-wp' ) => 'rating', 
					__( 'Price', 'luxury-wp' ) => 'price' ) ), 
			array( 
				'save_always'=>true,
				"type" => "dropdown", 
				"class" => "", 
				'std' => 'ASC', 
				"heading" => __( "Ascending or Descending", 'luxury-wp' ), 
				"param_name" => "order", 
				"value" => array( __( 'Ascending', 'luxury-wp' ) => 'ASC', __( 'Descending', 'luxury-wp' ) => 'DESC' ) ) ) ) );

// Woocommerce Widgets
vc_map( 
	array( 
		"name" => __( "WC Cart", 'luxury-wp' ), 
		"base" => "dh_wc_cart", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Cart.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'hide_if_empty', 
				'heading' => __( 'Hide if cart is empty', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Layered Nav Filters", 'luxury-wp' ), 
		"base" => "dh_wc_layered_nav_filters", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Layered Nav Filters.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Active Filters', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );

$attribute_array = array();
$attribute_taxonomies = wc_get_attribute_taxonomies();
if ( $attribute_taxonomies )
	foreach ( $attribute_taxonomies as $tax )
		if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) )
			$attribute_array[$tax->attribute_name] = $tax->attribute_name;

vc_map( 
	array( 
		"name" => __( "WC Layered Nav", 'luxury-wp' ), 
		"base" => "dh_wc_layered_nav", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Layered Nav.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Filter by', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'attribute', 
				'heading' => __( 'Attribute', 'luxury-wp' ), 
				
				'value' => $attribute_array ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'display_type', 
				'std' => 'list', 
				'heading' => __( 'Display type', 'luxury-wp' ), 
				
				'value' => array( __( 'List', 'luxury-wp' ) => 'list', __( 'Dropdown', 'luxury-wp' ) => 'dropdown' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'query_type', 
				'heading' => __( 'Query type', 'luxury-wp' ), 
				
				'std' => 'and', 
				'value' => array( __( 'AND', 'luxury-wp' ) => 'and', __( 'OR', 'luxury-wp' ) => 'or' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Price Filter", 'luxury-wp' ), 
		"base" => "dh_wc_price_filter", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Price Filter.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Filter by price', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Product Categories", 'luxury-wp' ), 
		"base" => "dh_wc_product_categories", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Product Categories.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Product Categories', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'orderby', 
				'heading' => __( 'Order by', 'luxury-wp' ), 
				
				'std' => 'order', 
				'value' => array( __( 'Category Order', 'luxury-wp' ) => 'order', __( 'Name', 'luxury-wp' ) => 'name' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'dropdown', 
				'heading' => __( 'Show as dropdown', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'count', 
				'heading' => __( 'Show post counts', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'hierarchical', 
				'heading' => __( 'Show hierarchy', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'std' => '1', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'show_children_only', 
				'heading' => __( 'Only show children of the current category', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Product Search", 'luxury-wp' ), 
		"base" => "dh_wc_product_search", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Product Search.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Search Products', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Product Tags", 'luxury-wp' ), 
		"base" => "dh_wc_product_tag_cloud", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Product Tags.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Product Tags', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Products", 'luxury-wp' ), 
		"base" => "dh_wc_products", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Products.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Products', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => 5, 
				'heading' => __( 'Number of products to show', 'luxury-wp' ), 
				'param_name' => 'number' ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'show', 
				'heading' => __( 'Show', 'luxury-wp' ), 
				
				'value' => array( 
					__( 'All Products', 'luxury-wp' ) => '', 
					__( 'Featured Products', 'luxury-wp' ) => 'featured', 
					__( 'On-sale Products', 'luxury-wp' ) => 'onsale' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'orderby', 
				'std' => 'date', 
				'heading' => __( 'Order by', 'luxury-wp' ), 
				
				'value' => array( 
					__( 'Date', 'luxury-wp' ) => 'date', 
					__( 'Price', 'luxury-wp' ) => 'price', 
					__( 'Random', 'luxury-wp' ) => 'rand', 
					__( 'Sales', 'luxury-wp' ) => 'sales' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'dropdown', 
				'param_name' => 'order', 
				'std' => 'asc', 
				'heading' => _x( 'Order', 'Sorting order', 'luxury-wp' ), 
				'value' => array( __( 'ASC', 'luxury-wp' ) => 'asc', __( 'DESC', 'luxury-wp' ) => 'desc' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'hide_free', 
				'heading' => __( 'Hide free products', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'param_name' => 'show_hidden', 
				'heading' => __( 'Show hidden products', 'luxury-wp' ), 
				'type' => 'checkbox', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Recent Reviews", 'luxury-wp' ), 
		"base" => "dh_wc_recent_reviews", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Recent Reviews.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Recent Reviews', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => 5, 
				'heading' => __( 'Number of products to show', 'luxury-wp' ), 
				'param_name' => 'number' ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Recently Viewed", 'luxury-wp' ), 
		"base" => "dh_wc_recently_viewed_products", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Recently Viewed.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Recently Viewed Products', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => 5, 
				'heading' => __( 'Number of products to show', 'luxury-wp' ), 
				'param_name' => 'number' ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );
vc_map( 
	array( 
		"name" => __( "WC Top Rated Products", 'luxury-wp' ), 
		"base" => "dh_wc_top_rated_products", 
		"category" => __( "Woocommerce Widgets", 'luxury-wp' ), 
		"icon" => "dh-vc-icon-dh_woo", 
		"class" => "dh-vc-element dh-vc-element-dh_woo", 
		'description' => __( 'Woocommerce Widget Top Rated Products.', 'luxury-wp' ), 
		"params" => array( 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => __( 'Top Rated Products', 'luxury-wp' ), 
				'heading' => __( 'Widget title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'What text use as a widget title. Leave blank to use default widget title.', 
					'luxury-wp' ) ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'value' => 5, 
				'heading' => __( 'Number of products to show', 'luxury-wp' ), 
				'param_name' => 'number' ), 
			array( 
				'save_always'=>true,
				'type' => 'textfield', 
				'heading' => __( 'Extra class name', 'luxury-wp' ), 
				'param_name' => 'el_class', 
				'description' => __( 
					'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 
					'luxury-wp' ) ) ) ) );

class WPBakeryShortCode_DH_Product_Slider extends DHWPBakeryShortcodeContainer {
}

class WPBakeryShortCode_DH_WC_Cart extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Layered_Nav_Filters extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Layered_Nav extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Price_Filter extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Product_Categories extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Product_Lookbooks extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Product_Search extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Product_Tag_Cloud extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Product_Mansory extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Product_Tab extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Product_Sale_Countdown extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Products extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Products_Grid extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Product_Categories_Grid extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Recent_Reviews extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Recently_Viewed_Products extends DHWPBakeryShortcode {
}

class WPBakeryShortCode_DH_WC_Top_Rated_Products extends DHWPBakeryShortcode {
}