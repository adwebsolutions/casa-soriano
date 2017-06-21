<?php
vc_map( 
	array( 
		'base' => 'dh_counter', 
		'name' => __( 'Counter', 'luxury-wp' ), 
		'description' => __( 'Display Counter.', 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_counter', 
		'icon' => 'dh-vc-icon-dh_counter', 
		'show_settings_on_create' => true, 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'params' => array( 
			array( 
				'param_name' => 'speed', 
				'heading' => __( 'Counter Speed', 'luxury-wp' ), 
				'type' => 'textfield', 
				'value' => '2000' ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Number', 'luxury-wp' ), 
				'param_name' => 'number', 
				'description' => __( 'Enter the number.', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Format number displayed ?', 'luxury-wp' ), 
				'dependency' => array( 'element' => "number", 'not_empty' => true ), 
				'param_name' => 'format', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Thousand Separator', 'luxury-wp' ), 
				'param_name' => 'thousand_sep', 
				'dependency' => array( 'element' => "format", 'not_empty' => true ), 
				'value' => ',', 
				'description' => __( 'This sets the thousand separator of displayed number.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Decimal Separator', 'luxury-wp' ), 
				'param_name' => 'decimal_sep', 
				'dependency' => array( 'element' => "format", 'not_empty' => true ), 
				'value' => '.', 
				'description' => __( 'This sets the decimal separator of displayed number.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Number of Decimals', 'luxury-wp' ), 
				'param_name' => 'num_decimals', 
				'dependency' => array( 'element' => "format", 'not_empty' => true ), 
				'value' => 0, 
				'description' => __( 'This sets the number of decimal points shown in displayed number.', 'luxury-wp' ) ), 
			
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Custom Number Color', 'luxury-wp' ), 
				'param_name' => 'number_color', 
				'dependency' => array( 'element' => "number", 'not_empty' => true ), 
				'description' => __( 'Select color for number.', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'number_font_size', 
				'heading' => __( 'Custom Number Font Size (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '40', 
				'data_min' => '10', 
				'dependency' => array( 'element' => "number", 'not_empty' => true ), 
				'data_max' => '120' ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Units', 'luxury-wp' ), 
				'param_name' => 'units', 
				'description' => __( 
					'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 
					'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Custom Units Color', 'luxury-wp' ), 
				'param_name' => 'units_color', 
				'dependency' => array( 'element' => "units", 'not_empty' => true ), 
				'description' => __( 'Select color for number.', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'units_font_size', 
				'heading' => __( 'Custom Units Font Size (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '30', 
				'data_min' => '10', 
				'dependency' => array( 'element' => "units", 'not_empty' => true ), 
				'data_max' => '120' ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Icon', 'luxury-wp' ), 
				'param_name' => 'icon', 
				"param_holder_class" => 'dh-font-awesome-select', 
				"value" => dh_font_awesome_options(), 
				'description' => __( 'Button icon.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Custom Icon Color', 'luxury-wp' ), 
				'param_name' => 'icon_color', 
				'dependency' => array( 'element' => "icon", 'not_empty' => true ), 
				'description' => __( 'Select color for icon.', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'icon_font_size', 
				'heading' => __( 'Custom Icon Size (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '40', 
				'data_min' => '10', 
				'dependency' => array( 'element' => "icon", 'not_empty' => true ), 
				'data_max' => '120' ), 
			array( 
				'type' => 'dropdown', 
				'std' => 'top', 
				'heading' => __( 'Icon Postiton', 'luxury-wp' ), 
				'param_name' => 'icon_position', 
				'dependency' => array( 'element' => "icon", 'not_empty' => true ), 
				'value' => array( __( 'Top', 'luxury-wp' ) => 'top', __( 'Left', 'luxury-wp' ) => 'left' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Title', 'luxury-wp' ), 
				'param_name' => 'text', 
				'admin_label' => true ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Custom Title Color', 'luxury-wp' ), 
				'param_name' => 'text_color', 
				'dependency' => array( 'element' => "text", 'not_empty' => true ), 
				'description' => __( 'Select color for title.', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'text_font_size', 
				'heading' => __( 'Custom Title Font Size (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '18', 
				'data_min' => '10', 
				'dependency' => array( 'element' => "text", 'not_empty' => true ), 
				'data_max' => '120' ), 
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

class WPBakeryShortCode_DH_Counter extends DHWPBakeryShortcode {
}