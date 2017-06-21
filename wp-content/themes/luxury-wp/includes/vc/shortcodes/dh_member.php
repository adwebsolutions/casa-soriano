<?php
vc_map( 
	array( 
		'base' => 'dh_member', 
		'name' => __( 'Team Member', 'luxury-wp' ), 
		'description' => __( 'Display team member.', 'luxury-wp' ), 
		"category" => __( "Sitesao", 'luxury-wp' ), 
		'class' => 'dh-vc-element dh-vc-element-dh_member', 
		'icon' => 'dh-vc-icon-dh_member', 
		'show_settings_on_create' => true, 
		'params' => array( 
			array( 
				'type' => 'dropdown', 
				'param_name' => 'style', 
				'heading' => __( 'Style', 'luxury-wp' ), 
				'std'=>'below',
				'value' => array( 
					__( 'Default', 'luxury-wp' ) => 'default',
					__( 'Meta below', 'luxury-wp' ) => 'below', 
					__( 'Meta overlay', 'luxury-wp' ) => 'overlay', 
					__( 'Meta right', 'luxury-wp' ) => 'right' ), 
				"description" => __( "Team Member Stlye.", 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Name', 'luxury-wp' ), 
				'param_name' => 'name', 
				'admin_label' => true, 
				"description" => __( "Enter the name of team member.", 'luxury-wp' ) ), 
			array( 
				'type' => 'textfield', 
				'heading' => __( 'Job Position', 'luxury-wp' ), 
				'param_name' => 'job', 
				"description" => __( "Enter the job position for team member.", 'luxury-wp' ) ), 
			array( 
				'type' => 'attach_image', 
				'heading' => __( 'Avatar', 'luxury-wp' ), 
				'param_name' => 'avatar', 
				"description" => __( "Select avatar from media library.", 'luxury-wp' ) ), 
			array( 
				'type' => 'textarea_safe', 
				'heading' => __( 'Description', 'luxury-wp' ), 
				'param_name' => 'description', 
				"description" => __( "Enter the description for team member.", 'luxury-wp' ) ), 
			
			array( 'type' => 'href', 'heading' => __( 'Facebook URL', 'luxury-wp' ), 'param_name' => 'facebook' ), 
			
			array( 'type' => 'href', 'heading' => __( 'Twitter URL', 'luxury-wp' ), 'param_name' => 'twitter' ), 
			array( 'type' => 'href', 'heading' => __( 'Google+ URL', 'luxury-wp' ), 'param_name' => 'google' ), 
			array( 'type' => 'href', 'heading' => __( 'LinkedIn URL', 'luxury-wp' ), 'param_name' => 'linkedin' ) ) ) );

class WPBakeryShortCode_DH_Member extends DHWPBakeryShortcode {
}