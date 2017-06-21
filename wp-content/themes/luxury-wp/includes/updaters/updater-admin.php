<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class DH_Updater_Admin{
	
	public function __construct(){
		add_filter('dh_theme_option_sections', array(&$this,'theme_option_sections'));
	}
	
	public function theme_option_sections($section){
		$section['auto_updates'] = array(
			'icon' => 'fa fa-refresh',
			'title' => __ ( 'Auto Updates', 'luxury-wp' ), 
			'fields'=>array(
				array(
						'name' => 'tf_username',
						'type' => 'text',
						'label' => __('ThemeForest Username','luxury-wp'),
				),
				array(
					'name' => 'tf_api',
					'type' => 'text',
					'label' => __('ThemeForest Secret API Key','luxury-wp'),
					'desc'=>__('You can create one from ThemeForest User settings page. View a tutorial <a target="_blank" href="'.DHINC_ASSETS_URL.'/images/api-key-location.jpg">here</a>','luxury-wp'),
				),
				array(
					'name' => 'tf_purchase_code',
					'type' => 'text',
					'label' => __('ThemeForest Purchase Code','luxury-wp'),
				),
			)
		);
		return $section;
	}
}

new DH_Updater_Admin();