<?php
vc_map( 
	array( 
		'base' => 'dh_video', 
		'name' => __( 'Video Player', 'luxury-wp' ), 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_video', 
		'icon' => 'dh-vc-icon-dh_video', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'param_name' => 'type', 
				'heading' => __( 'Video Type', 'luxury-wp' ), 
				'type' => 'dropdown', 
				'admin_label' => true, 
				'std' => 'inline', 
				'value' => array( __( 'Iniline', 'luxury-wp' ) => 'inline', __( 'Popup', 'luxury-wp' ) => 'popup' ) ), 
			array( 
				'type' => 'attach_image', 
				'heading' => __( 'Background', 'luxury-wp' ), 
				'param_name' => 'background', 
				'dependency' => array( 'element' => "type", 'value' => array( 'popup' ) ), 
				'description' => __( 'Video Background.', 'luxury-wp' ) ), 
			array( 
				'type' => 'colorpicker', 
				'heading' => __( 'Icon Play color', 'luxury-wp' ), 
				'param_name' => 'icon_color', 
				'dependency' => array( 'element' => "type", 'value' => array( 'popup' ) ),
				'description' => __( 'Select Icon Play color.', 'luxury-wp' ) ), 
			array( 
				'param_name' => 'video_embed', 
				'heading' => __( 'Embedded Code', 'luxury-wp' ), 
				'type' => 'textfield', 
				'value' => '', 
				'description' => __( 
					'Used when you select Video format. Enter a Youtube, Vimeo, Soundcloud, etc URL. See supported services at <a href="http://codex.wordpress.org/Embeds" target="_blank">http://codex.wordpress.org/Embeds</a>.', 
					'luxury-wp' ) ) ) ) );

class WPBakeryShortCode_DH_Video extends DHWPBakeryShortcode {
}
