<?php
vc_map( 
	array( 
		'base' => 'dh_testimonial', 
		'name' => __( 'Testimonial', 'luxury-wp' ), 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'description' => __( 'Animated Testimonial with slider', 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_testimonial', 
		'icon' => 'dh-vc-icon-dh_testimonial', 
		'show_settings_on_create' => true, 
		'is_container' => true, 
		'js_view' => 'DHVCTestimonial', 
		'params' => array( 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Background Transparent?', 'luxury-wp' ), 
				'param_name' => 'background_transparent', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Color', 'luxury-wp' ), 
				'param_name' => 'color', 
				'description' => __( 'Custom color.', 'luxury-wp' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Columns', 'luxury-wp' ), 
				'param_name' => 'columns', 
				'std' => '1', 
				'value' => array( __( '1 Column', 'luxury-wp' ) => '1', __( '2 Columns', 'luxury-wp' ) => '2', __( '3 Columns', 'luxury-wp' ) => '3' ) ), 
			array( 
				'type' => 'dropdown', 
				'heading' => __( 'Style', 'luxury-wp' ), 
				'param_name' => 'style', 
				'std' => 'style-1', 
				'value' => array( __( 'Style 1', 'luxury-wp' ) => 'style-1', __( 'Style 2', 'luxury-wp' ) => 'style-2', __( 'Style 3', 'luxury-wp' ) => 'style-3', __( 'Style 4', 'luxury-wp' ) => 'style-4' ) ), 
			array( 
				'type' => 'checkbox', 
				'heading' => __( 'Hide Pagination', 'luxury-wp' ), 
				'param_name' => 'hide_pagination', 
				'value' => array( __( 'Yes,please', 'luxury-wp' ) => 'yes' ), 
				'description' => __( 'Hide pagination of slider', 'luxury-wp' ) ), 
			array( 
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
					  [dh_testimonial_item title="' . __( 'Item 1', 'luxury-wp' ) . '" tab_id="' . time() . '-1-' . rand( 0, 100 ) . '"][/dh_testimonial_item]
					  [dh_testimonial_item title="' . __( 'Item 2', 'luxury-wp' ) . '" tab_id="' . time() . '-2-' . rand( 0, 100 ) . '"][/dh_testimonial_item]
					  [dh_testimonial_item title="' . __( 'Item 3', 'luxury-wp' ) . '" tab_id="' . time() . '-3-' . rand( 0, 100 ) . '"][/dh_testimonial_item]
					  ' ) );
vc_map( 
	array( 
		'name' => __( 'Testimonial Item', 'luxury-wp' ), 
		'base' => 'dh_testimonial_item', 
		'allowed_container_element' => 'vc_row', 
		'is_container' => true, 
		'content_element' => false, 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'params' => array( 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 'Item title.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textarea_safe', 
				'holder' => 'div', 
				'heading' => __( 'Text', 'luxury-wp' ), 
				'param_name' => 'text', 
				'value' => __( 
					'I am testimonial. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 
					'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Author', 'luxury-wp' ), 
				'param_name' => 'author', 
				'description' => __( 'Testimonial author.', 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Company', 'luxury-wp' ), 
				'param_name' => 'company', 
				'description' => __( 'Author company.', 'luxury-wp' ) ), 
			array( 
				'type' => 'attach_image', 
				'heading' => __( 'Avatar', 'luxury-wp' ), 
				'param_name' => 'avatar', 
				'description' => __( 'Avatar author.', 'luxury-wp' ) ) ), 
		'js_view' => 'DHVCTestimonialItem' ) );

class WPBakeryShortCode_DH_Testimonial extends WPBakeryShortCode_DH_Carousel {

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
			'/dh_testimonial_item title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', 
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
		return '<div class="wpb_template">' .
			 do_shortcode( '[dh_testimonial_item title="' . DHVC_ITEM_TITLE . '" tab_id=""][/dh_testimonial_item]' ) .
			 '</div>';
	}
}

class WPBakeryShortCode_DH_Testimonial_Item extends DHWPBakeryShortcode {
}