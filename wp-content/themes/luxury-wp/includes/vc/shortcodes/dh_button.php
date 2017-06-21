<?php
vc_map( 
	array( 
		'base' => 'dh_button', 
		'name' => __( 'Button', 'luxury-wp' ), 
		'description' => __( 'Eye catching button.', 'luxury-wp' ), 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_button', 
		'icon' => 'dh-vc-icon-dh_button', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Text', 'luxury-wp' ), 
				'holder' => 'button', 
				'class' => 'wpb_button', 
				'admin_label' => true, 
				'param_name' => 'title', 
				'value' => __( 'Button', 'luxury-wp' ), 
				'description' => __( 'Text on the button.', 'luxury-wp' ) ), 
			
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'luxury-wp' ),
				'std'=>'',
				'value' => array(
					__( 'None', 'luxury-wp' ) => '',
					__( 'Font Awesome', 'luxury-wp' ) => 'fontawesome',
					__( 'Open Iconic', 'luxury-wp' ) => 'openiconic',
					__( 'Typicons', 'luxury-wp' ) => 'typicons',
					__( 'Entypo', 'luxury-wp' ) => 'entypo',
					__( 'Linecons', 'luxury-wp' ) => 'linecons',
				),
				'param_name' => 'btn_icon_type',
				'description' => __( 'Select icon library.', 'luxury-wp' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Button Icon Alignment', 'luxury-wp' ),
				'param_name' => 'btn_icon_align',
				'dependency' => array(
					'element' => 'btn_icon_type',
					'not_empty' => true
				),
				'std' => 'left',
				'value' => array(
					__( 'Left', 'luxury-wp' ) => 'left',
					__( 'Right', 'luxury-wp' ) => 'right' ),
				'description' => __( 'Button Icon alignment', 'luxury-wp' ) ),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Button icon Slide In', 'luxury-wp' ),
				'param_name' => 'btn_icon_slide_in',
				'dependency' => array(
					'element' => 'btn_icon_type',
					'value' => 'right',
				),
				'dependency' => array(
					'element' => 'btn_icon_type',
					'not_empty' => true
				),
				'value' => array( __( 'Yes, please', 'luxury-wp' ) => 'yes' ),
				'description' => __( 'Use button icon slide in', 'luxury-wp' ) ),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'luxury-wp' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
				),
				'dependency' => array(
					'element' => 'btn_icon_type',
					'value' => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'luxury-wp' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'luxury-wp' ),
				'param_name' => 'icon_openiconic',
				'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'btn_icon_type',
					'value' => 'openiconic',
				),
				'description' => __( 'Select icon from library.', 'luxury-wp' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'luxury-wp' ),
				'param_name' => 'icon_typicons',
				'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'btn_icon_type',
					'value' => 'typicons',
				),
				'description' => __( 'Select icon from library.', 'luxury-wp' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'luxury-wp' ),
				'param_name' => 'icon_entypo',
				'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'btn_icon_type',
					'value' => 'entypo',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'luxury-wp' ),
				'param_name' => 'icon_linecons',
				'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'btn_icon_type',
					'value' => 'linecons',
				),
				'description' => __( 'Select icon from library.', 'luxury-wp' ),
			),
			array( 
				'type' => 'href', 
				'heading' => __( 'URL (Link)', 'luxury-wp' ), 
				'param_name' => 'href', 
				'description' => __( 'Button link.', 'luxury-wp' ) ), 
			array( 
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
				'type' => 'dropdown', 
				'heading' => __( 'Style', 'luxury-wp' ), 
				'param_name' => 'style', 
				'value' => array( 'Default' => '', 'Outlined' => 'outline' ), 
				'description' => __( 'Button style.', 'luxury-wp' ) ), 
			array(
				'type' => 'checkbox',
				'heading' => __( 'Button Round', 'luxury-wp' ),
				'param_name' => 'btn_round',
				'value' => array( __( 'Yes, please', 'luxury-wp' ) => 'yes' ),
				'description' => __( 'Use button round', 'luxury-wp' ) ),
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Size', 'luxury-wp' ), 
				'param_name' => 'size', 
				'std' => '', 
				'value' => array( 
					__( 'Default', 'luxury-wp' ) => '', 
					__( 'Large', 'luxury-wp' ) => 'lg', 
					__( 'Small', 'luxury-wp' ) => 'sm', 
					__( 'Extra small', 'luxury-wp' ) => 'xs', 
					__( 'Custom size', 'luxury-wp' ) => 'custom' ), 
				'description' => __( 'Button size.', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'font_size', 
				'heading' => __( 'Font Size (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '14', 
				'data_min' => '0', 
				'dependency' => array( 'element' => "size", 'value' => array( 'custom' ) ), 
				'data_max' => '50' ), 
			array( 
				'param_name' => 'border_width', 
				'heading' => __( 'Border Width (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '1', 
				'data_min' => '0', 
				'dependency' => array( 'element' => "size", 'value' => array( 'custom' ) ), 
				'data_max' => '20' ), 
			array( 
				'param_name' => 'padding_top', 
				'heading' => __( 'Padding Top (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '6', 
				'data_min' => '0', 
				'dependency' => array( 'element' => "size", 'value' => array( 'custom' ) ), 
				'data_max' => '100' ), 
			array( 
				'param_name' => 'padding_right', 
				'heading' => __( 'Padding Right (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '30', 
				'data_min' => '0', 
				'dependency' => array( 'element' => "size", 'value' => array( 'custom' ) ), 
				'data_max' => '100' ), 
			array( 
				'param_name' => 'padding_bottom', 
				'heading' => __( 'Padding Bottom (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '6', 
				'data_min' => '0', 
				'dependency' => array( 'element' => "size", 'value' => array( 'custom' ) ), 
				'data_max' => '100' ), 
			array( 
				'param_name' => 'padding_left', 
				'heading' => __( 'Padding Right (px)', 'luxury-wp' ), 
				'type' => 'ui_slider', 
				'value' => '30', 
				'data_min' => '0', 
				'dependency' => array( 'element' => "size", 'value' => array( 'custom' ) ), 
				'data_max' => '100' ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Color', 'luxury-wp' ), 
				'param_name' => 'color', 
				'std' => 'default', 
				'value' => array( 
					__( 'Default', 'luxury-wp' ) => 'default', 
					__( 'Primary', 'luxury-wp' ) => 'primary', 
					__( 'Success', 'luxury-wp' ) => 'success', 
					__( 'Info', 'luxury-wp' ) => 'info', 
					__( 'Warning', 'luxury-wp' ) => 'warning', 
					__( 'Danger', 'luxury-wp' ) => 'danger', 
					__( 'White', 'luxury-wp' ) => 'white', 
					__( 'Black', 'luxury-wp' ) => 'black', 
					__( 'Custom', 'luxury-wp' ) => 'custom' ), 
				'description' => __( 'Button color.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Background Color', 'luxury-wp' ), 
				'param_name' => 'background_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Select background color for button.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Border Color', 'luxury-wp' ), 
				'param_name' => 'border_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Select border color for button.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Text Color', 'luxury-wp' ), 
				'param_name' => 'text_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Select text color for button.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Hover Background Color', 'luxury-wp' ), 
				'param_name' => 'hover_background_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Select background color for button when hover.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Hover Border Color', 'luxury-wp' ), 
				'param_name' => 'hover_border_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Select border color for button when hover.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Hover Text Color', 'luxury-wp' ), 
				'param_name' => 'hover_text_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Select text color for button when hover.', 'luxury-wp' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Button Full Width', 'luxury-wp' ), 
				'param_name' => 'block_button', 
				'value' => array( __( 'Yes, please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Button full width of a parent', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Alignment', 'luxury-wp' ), 
				'param_name' => 'alignment', 
				'std' => 'left', 
				'value' => array( 
					__( 'Left', 'luxury-wp' ) => 'left', 
					__( 'Center', 'luxury-wp' ) => 'center', 
					__( 'Right', 'luxury-wp' ) => 'right' ), 
				'description' => __( 'Button alignment (Not use for Button full width)', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Show Tooltip/Popover', 'luxury-wp' ), 
				'param_name' => 'tooltip', 
				'value' => array( 
					__( 'No', 'luxury-wp' ) => '', 
					__( 'Tooltip', 'luxury-wp' ) => 'tooltip', 
					__( 'Popover', 'luxury-wp' ) => 'popover' ), 
				'description' => __( 'Display a tooltip or popover with descriptive text.', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Tip position', 'luxury-wp' ), 
				'param_name' => 'tooltip_position', 
				'std' => 'top', 
				'value' => array( 
					__( 'Top', 'luxury-wp' ) => 'top', 
					__( 'Bottom', 'luxury-wp' ) => 'bottom', 
					__( 'Left', 'luxury-wp' ) => 'left', 
					__( 'Right', 'luxury-wp' ) => 'right' ), 
				'dependency' => array( 'element' => "tooltip", 'value' => array( 'tooltip', 'popover' ) ), 
				'description' => __( 'Choose the display position.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Popover Title', 'luxury-wp' ), 
				'param_name' => 'tooltip_title', 
				'dependency' => array( 'element' => "tooltip", 'value' => array( 'popover' ) ) ), 
			array( 
				'type' => 'textarea', 
				'heading' => __( 'Tip/Popover Content', 'luxury-wp' ), 
				'param_name' => 'tooltip_content', 
				'dependency' => array( 'element' => "tooltip", 'value' => array( 'tooltip', 'popover' ) ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Tip/Popover trigger', 'luxury-wp' ), 
				'param_name' => 'tooltip_trigger', 
				'std' => 'hover', 
				'value' => array( __( 'Hover', 'luxury-wp' ) => 'hover', __( 'Click', 'luxury-wp' ) => 'click' ), 
				'dependency' => array( 'element' => "tooltip", 'value' => array( 'tooltip', 'popover' ) ), 
				'description' => __( 'Choose action to trigger the tooltip.', 'luxury-wp' ) ), 
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

class WPBakeryShortCode_DH_Button extends DHWPBakeryShortcode {
}