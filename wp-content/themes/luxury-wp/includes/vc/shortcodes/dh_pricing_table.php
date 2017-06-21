<?php
vc_map( 
	array( 
		'base' => 'dh_pricing_table', 
		'name' => __( 'Pricing Table', 'luxury-wp' ), 
		'description' => __( 'Create pricing table', 'luxury-wp' ), 
		'weight' => 720, 
		'class' => 'dh-vc-element dh-vc-element-dh_pricing_table', 
		'icon' => 'dh-vc-icon-dh_pricing_table', 
		'show_settings_on_create' => false, 
		'is_container' => true, 
		'js_view' => 'DHVCPricingTable', 
		'params' => array( 
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
					'luxury-wp' ) ) ), 
		"custom_markup" => '
					  <div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
					  <ul class="tabs_controls">
					  </ul>
					  %content%
					  </div>', 
		'default_content' => '
					  [dh_pricing_table_item title="' .
			 __( 'Item 1', 'luxury-wp' ) . '" tab_id="' . time() . '-1-' . rand( 0, 100 ) .
			 '"][/dh_pricing_table_item]
					  [dh_pricing_table_item title="' .
			 __( 'Item 2', 'luxury-wp' ) . '" tab_id="' . time() . '-2-' . rand( 0, 100 ) .
			 '"][/dh_pricing_table_item]
					  [dh_pricing_table_item title="' .
			 __( 'Item 3', 'luxury-wp' ) . '" tab_id="' . time() . '-3-' . rand( 0, 100 ) . '"][/dh_pricing_table_item]
					  ' ) );
vc_map( 
	array( 
		'name' => __( 'Pricing Table Item', 'luxury-wp' ), 
		'base' => 'dh_pricing_table_item', 
		'allowed_container_element' => 'vc_row', 
		'is_container' => true, 
		'content_element' => false, 
		'params' => array( 
			array( 
				"type" => "checkbox", 
				"heading" => __( "Recommend", 'luxury-wp' ), 
				"param_name" => "recommend", 
				"value" => array( __( 'Yes, please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 'Item title.', 'luxury-wp' ) ), 
			array( 'type' => 'textfield', 'heading' => __( 'Price', 'luxury-wp' ), 'param_name' => 'price' ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Currency Symbol', 'luxury-wp' ), 
				'param_name' => 'currency', 
				'value' => '$', 
				'description' => __( 'Enter the currency symbol that will display for your price', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Units', 'luxury-wp' ), 
				'param_name' => 'units', 
				'value' => '/month', 
				'description' => __( 'Enter measurement units (if needed) Eg. /month /year etc.', 'luxury-wp' ) ), 
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
					__( 'Custom', 'luxury-wp' ) => 'custom' ), 
				'description' => __( 'color.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Title Background Color', 'luxury-wp' ), 
				'param_name' => 'title_background_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Custom background color for title.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Title Color', 'luxury-wp' ), 
				'param_name' => 'title_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Custom color for title.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Price Background Color', 'luxury-wp' ), 
				'param_name' => 'price_background_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Custom background color for price.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Price Color', 'luxury-wp' ), 
				'param_name' => 'price_color', 
				'dependency' => array( 'element' => "color", 'value' => array( 'custom' ) ), 
				'description' => __( 'Custom color for price.', 'luxury-wp' ) ), 
			array( 
				'type' => 'pricing_table_feature', 
				'heading' => __( 'Features', 'luxury-wp' ), 
				'param_name' => 'features' ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Features Alignment', 'luxury-wp' ), 
				'param_name' => 'features_alignment', 
				'std' => 'left', 
				'value' => array( 
					__( 'Left', 'luxury-wp' ) => 'left', 
					__( 'Center', 'luxury-wp' ) => 'center', 
					__( 'Right', 'luxury-wp' ) => 'right' ) ), 
			array( 
				'type' => 'href', 
				'heading' => __( 'URL (Link)', 'luxury-wp' ), 
				'param_name' => 'href', 
				'description' => __( 'Button link.', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Target', 'luxury-wp' ), 
				'param_name' => 'target', 
				'value' => array( __( 'Same window', 'luxury-wp' ) => '_self', __( 'New window', 'luxury-wp' ) => "_blank" ), 
				'dependency' => array( 
					'element' => 'href', 
					'not_empty' => true, 
					'callback' => 'vc_button_param_target_callback' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Text on the button', 'luxury-wp' ), 
				'param_name' => 'btn_title', 
				'value' => __( 'Buy Now', 'luxury-wp' ), 
				'description' => __( 'Text on the button.', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Button Style', 'luxury-wp' ), 
				'param_name' => 'btn_style', 
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
				'heading' => __( 'Button Size', 'luxury-wp' ), 
				'param_name' => 'btn_size', 
				'std' => '', 
				'value' => array( 
					__( 'Default', 'luxury-wp' ) => '', 
					__( 'Large', 'luxury-wp' ) => 'lg', 
					__( 'Small', 'luxury-wp' ) => 'sm', 
					__( 'Extra small', 'luxury-wp' ) => 'xs', 
					__( 'Custom size', 'luxury-wp' ) => 'custom' ), 
				'description' => __( 'Button size.', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Button Color', 'luxury-wp' ), 
				'param_name' => 'btn_color', 
				'std' => 'default', 
				'value' => array( 
					__( 'Default', 'luxury-wp' ) => 'default', 
					__( 'Primary', 'luxury-wp' ) => 'primary', 
					__( 'Success', 'luxury-wp' ) => 'success', 
					__( 'Info', 'luxury-wp' ) => 'info', 
					__( 'Warning', 'luxury-wp' ) => 'warning', 
					__( 'Danger', 'luxury-wp' ) => 'danger', 
					__( 'White', 'luxury-wp' ) => 'white', 
					__( 'Black', 'luxury-wp' ) => 'black' ), 
				'description' => __( 'Button color.', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Button Show Tooltip/Popover', 'luxury-wp' ), 
				'param_name' => 'btn_tooltip', 
				'value' => array( 
					__( 'No', 'luxury-wp' ) => '', 
					__( 'Tooltip', 'luxury-wp' ) => 'tooltip', 
					__( 'Popover', 'luxury-wp' ) => 'popover' ), 
				'description' => __( 'Display a tooltip or popover with descriptive text.', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Button Tip position', 'luxury-wp' ), 
				'param_name' => 'btn_tooltip_position', 
				'std' => 'top', 
				'value' => array( 
					__( 'Top', 'luxury-wp' ) => 'top', 
					__( 'Bottom', 'luxury-wp' ) => 'bottom', 
					__( 'Left', 'luxury-wp' ) => 'left', 
					__( 'Right', 'luxury-wp' ) => 'right' ), 
				'dependency' => array( 'element' => "btn_tooltip", 'value' => array( 'tooltip', 'popover' ) ), 
				'description' => __( 'Choose the display position.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Button Popover Title', 'luxury-wp' ), 
				'param_name' => 'btn_tooltip_title', 
				'dependency' => array( 'element' => "btn_tooltip", 'value' => array( 'popover' ) ) ), 
			array( 
				'type' => 'textarea', 
				'heading' => __( 'Button Tip/Popover Content', 'luxury-wp' ), 
				'param_name' => 'btn_tooltip_content', 
				'dependency' => array( 'element' => "btn_tooltip", 'value' => array( 'tooltip', 'popover' ) ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Button Tip/Popover trigger', 'luxury-wp' ), 
				'param_name' => 'btn_tooltip_trigger', 
				'std' => 'hover', 
				'value' => array( __( 'Hover', 'luxury-wp' ) => 'hover', __( 'Click', 'luxury-wp' ) => 'click' ), 
				'dependency' => array( 'element' => "btn_tooltip", 'value' => array( 'tooltip', 'popover' ) ), 
				'description' => __( 'Choose action to trigger the tooltip.', 'luxury-wp' ) ) ), 
		'js_view' => 'DHVCPricingTableItem' ) );

$vc_params_js = DHVC_ASSETS_URL . '/js/vc-params.js';
vc_add_shortcode_param( 'pricing_table_feature', 'dh_pricing_table_feature_param', $vc_params_js );

function dh_pricing_table_feature_param( $settings, $value ) {
	$value_64 = base64_decode( $value );
	$value_arr = json_decode( $value_64 );
	if ( empty( $value_arr ) && ! is_array( $value_arr ) ) {
		for ( $i = 0; $i < 2; $i++ ) {
			$option = new stdClass();
			$option->content = '<i class="fa fa-check"></i> I am a feature';
			$value_arr[] = $option;
		}
	}
	$param_line = '';
	$param_line .= '<div class="pricing-table-feature-list clearfix">';
	$param_line .= '<table>';
	$param_line .= '<thead>';
	$param_line .= '<tr>';
	$param_line .= '<td>';
	$param_line .= __( 'Content (<em>Add Arbitrary text or HTML.</em>)', 'luxury-wp' );
	$param_line .= '</td>';
	$param_line .= '<td>';
	$param_line .= '</td>';
	$param_line .= '</tr>';
	$param_line .= '</thead>';
	$param_line .= '<tbody>';
	if ( is_array( $value_arr ) && ! empty( $value_arr ) ) {
		foreach ( $value_arr as $k => $v ) {
			$param_line .= '<tr>';
			$param_line .= '<td>';
			$param_line .= '<textarea id="content">' . esc_textarea( $v->content ) . '</textarea>';
			$param_line .= '</td>';
			$param_line .= '<td align="left" style="padding:5px;">';
			$param_line .= '<a href="#" class="pricing-table-feature-remove" onclick="return pricing_table_feature_remove(this);"  title="' .
				 __( 'Remove', 'luxury-wp' ) . '">-</a>';
			$param_line .= '</td>';
			$param_line .= '</tr>';
		}
	}
	$param_line .= '</tbody>';
	$param_line .= '<tfoot>';
	$param_line .= '<tr>';
	$param_line .= '<td colspan="3">';
	$param_line .= '<a href="#" onclick="return pricing_table_feature_add(this);" class="button" title="' .
		 __( 'Add', 'luxury-wp' ) . '">' . __( 'Add', 'luxury-wp' ) . '</a>';
	$param_line .= '</td>';
	$param_line .= '</tfoot>';
	$param_line .= '</table>';
	$param_line .= '<input type="hidden" name="' . $settings['param_name'] . '" class="wpb_vc_param_value' .
		 $settings['param_name'] . ' ' . $settings['type'] . '" value="' . $value . '">';
	$param_line .= '</div>';
	return $param_line;
}

class WPBakeryShortCode_DH_Pricing_Table extends WPBakeryShortCode_VC_Tabs {

	static $filter_added = false;

	public function __construct( $settings ) {
		parent::__construct( $settings );
		if ( ! self::$filter_added ) {
			$this->addFilter( 'vc_inline_template_content', 'setCustomTabId' );
			self::$filter_added = true;
		}
	}

	protected $predefined_atts = array( 'tab_id' => DHVC_ITEM_TITLE, 'title' => '' );

	public function contentAdmin( $atts, $content = null ) {
		$width = $custom_markup = '';
		$shortcode_attributes = array( 'width' => '1/1' );
		foreach ( $this->settings['params'] as $param ) {
			if ( $param['param_name'] != 'content' ) {
				if ( isset( $param['value'] ) && is_string( $param['value'] ) ) {
					$shortcode_attributes[$param['param_name']] = $param['value'];
				} elseif ( isset( $param['value'] ) ) {
					$shortcode_attributes[$param['param_name']] = $param['value'];
				}
			} else 
				if ( $param['param_name'] == 'content' && $content == NULL ) {
					$content = $param['value'];
				}
		}
		extract( shortcode_atts( $shortcode_attributes, $atts ) );
		
		// Extract tab titles
		
		preg_match_all( 
			'/dh_pricing_table_item title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', 
			$content, 
			$matches, 
			PREG_OFFSET_CAPTURE );
		
		$output = '';
		$tab_titles = array();
		
		if ( isset( $matches[0] ) ) {
			$tab_titles = $matches[0];
		}
		$tmp = '';
		if ( count( $tab_titles ) ) {
			$tmp .= '<ul class="clearfix tabs_controls">';
			foreach ( $tab_titles as $tab ) {
				preg_match( 
					'/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', 
					$tab[0], 
					$tab_matches, 
					PREG_OFFSET_CAPTURE );
				if ( isset( $tab_matches[1][0] ) ) {
					$tmp .= '<li><a href="#tab-' .
						 ( isset( $tab_matches[3][0] ) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .
						 '">' . $tab_matches[1][0] . '</a></li>';
				}
			}
			$tmp .= '</ul>' . "\n";
		} else {
			$output .= do_shortcode( $content );
		}
		$elem = $this->getElementHolder( $width );
		
		$iner = '';
		foreach ( $this->settings['params'] as $param ) {
			$custom_markup = '';
			$param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
			if ( is_array( $param_value ) ) {
				// Get first element from the array
				reset( $param_value );
				$first_key = key( $param_value );
				$param_value = $param_value[$first_key];
			}
			$iner .= $this->singleParamHtmlHolder( $param, $param_value );
		}
		if ( isset( $this->settings["custom_markup"] ) && $this->settings["custom_markup"] != '' ) {
			if ( $content != '' ) {
				$custom_markup = str_ireplace( "%content%", $tmp . $content, $this->settings["custom_markup"] );
			} else 
				if ( $content == '' && isset( $this->settings["default_content_in_template"] ) &&
					 $this->settings["default_content_in_template"] != '' ) {
					$custom_markup = str_ireplace( 
						"%content%", 
						$this->settings["default_content_in_template"], 
						$this->settings["custom_markup"] );
				} else {
					$custom_markup = str_ireplace( "%content%", '', $this->settings["custom_markup"] );
				}
			$iner .= do_shortcode( $custom_markup );
		}
		$elem = str_ireplace( '%wpb_element_content%', $iner, $elem );
		$output = $elem;
		
		return $output;
	}

	/**
	 * Find html template for shortcode output.
	 */
	protected function findShortcodeTemplate() {
		// Check template path in shortcode's mapping settings
		if ( ! empty( $this->settings['html_template'] ) && is_file( $this->settings( 'html_template' ) ) ) {
			return $this->setTemplate( $this->settings['html_template'] );
		}
		// Check template in theme directory
		$user_template = vc_manager()->getShortcodesTemplateDir( $this->getFilename() . '.php' );
		if ( is_file( $user_template ) ) {
			return $this->setTemplate( $user_template );
		}
	}

	protected function getFileName() {
		return $this->shortcode;
	}

	public function getTabTemplate() {
		return '<div class="wpb_template">' . do_shortcode( 
			'[dh_pricing_table_item title="' . DHVC_ITEM_TITLE . '" tab_id=""][/dh_pricing_table_item]' ) . '</div>';
	}
}

class WPBakeryShortCode_DH_Pricing_Table_Item extends DHWPBakeryShortcode {
}