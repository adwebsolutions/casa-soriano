<?php
vc_map( 
	array( 
		'base' => 'dh_mailchimp', 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'name' => __( 'Mailchimp Subscribe', 'luxury-wp' ), 
		'description' => __( 'Widget Mailchimp Subscribe.', 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_mailchimp', 
		'icon' => 'dh-vc-icon-dh_mailchimp', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Title', 'luxury-wp' ), 
				'param_name' => 'title', 
				'description' => __( 
					'Enter text which will be used as widget title. Leave blank if no title is needed.', 
					'luxury-wp' ) ) ) ) );

class WPBakeryShortCode_DH_Mailchimp extends DHWPBakeryShortcode {
}