<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!class_exists('DH_ThemeOptions')):
class DH_ThemeOptions {
	
	protected  $_sections            = array(); // Sections and fields
	protected static $_option_name;
	
	public function __construct(){
		$this->_sections = $this->get_sections();
		
		self::$_option_name = dh_get_theme_option_name();
		
		add_action('admin_init', array(&$this,'admin_init'));
		add_action( 'admin_menu', array(&$this,'admin_menu') );
		//Download theme option
		add_action("wp_ajax_dh_download_theme_option",array(&$this, "download_theme_option"));
			
	}
	
	public static function get_options($key,$default = null){
		global $dh_theme_options;
		if ( empty( $dh_theme_options ) ) {
			$dh_theme_options = get_option(self::$_option_name);
		}
		if(isset($dh_theme_options[$key])){
			return $dh_theme_options[$key];
		}else{
			return $default;
		}
	}
	
	public function admin_init(){
		register_setting(self::$_option_name,self::$_option_name,array(&$this,'register_setting_callback'));
		$_opions = get_option(self::$_option_name);
		if(empty($_opions)){
			$default_options = array();
			foreach ($this->_sections as $key=>$sections){
				if(is_array($sections['fields']) && !empty($sections['fields'])){
					foreach ($sections['fields'] as $field){
						if(isset($field['name']) && isset($field['value'])){
							$default_options[$field['name']] = $field['value'];
						}
					}
				}
			}
			if(!empty($default_options)){
				$options = array();
				foreach($default_options as $key => $value) {
					$options[$key] = $value;
				}
			}
			$r = update_option(self::$_option_name, $options);
		}
	}
	
	protected static function buildCustomCss(){
		$url = wp_nonce_url( 'admin.php?page=theme-options', 'dh_theme_option_save_setting' );
		self::getFileSystem( $url );
		global $wp_filesystem;
		
		/**
		 * Building css file.
		 */
		if ( false === ( $sitesao_upload_dir = self::checkCreateUploadDir( $wp_filesystem, 'custom_css', 'custom.css' ) ) ) {
			return true;
		}
		
		
		$filename = $sitesao_upload_dir . '/custom.css';
		ob_start();
		require_once( DHINC_DIR . '/custom-css/brand-primary.php' );
		require_once( DHINC_DIR . '/custom-css/style.php' );
		$custom_css = ob_get_clean();
		$custom_css = trim($custom_css);
		$custom_css = dh_css_minify($custom_css);
		if ( ! $wp_filesystem->put_contents( $filename, $custom_css, FS_CHMOD_FILE ) ) {
			delete_option('sitesao_custom');
			if ( is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
				add_settings_error( 'sitesao_custom_css', $wp_filesystem->errors->get_error_code(), __( 'Something went wrong: custom.css could not be created.', 'luxury-wp' ) . $wp_filesystem->errors->get_error_message(), 'error' );
			} elseif ( ! $wp_filesystem->connect() ) {
				add_settings_error( 'sitesao_custom_css', $wp_filesystem->errors->get_error_code(), __( 'custom.css could not be created. Connection error.', 'luxury-wp' ), 'error' );
			} elseif ( ! $wp_filesystem->is_writable( $filename ) ) {
				add_settings_error( 'sitesao_custom_css', $wp_filesystem->errors->get_error_code(), __( 'custom.css could not be created. Cannot write custom css to "' . $filename . '".', 'luxury-wp' ), 'error' );
			} else {
				add_settings_error( 'sitesao_custom_css', $wp_filesystem->errors->get_error_code(), __( 'custom.css could not be created. Problem with access.', 'luxury-wp' ), 'error' );
			}
		
			return false;
		}
		update_option('sitesao_custom', '1');
		return true;
	}
	
	
	/**
	 * @return string
	 */
	public static function uploadDir() {
		$upload_dir = wp_upload_dir();
		global $wp_filesystem;
	
		return $wp_filesystem->find_folder( $upload_dir['basedir'] ) . 'sitesao-theme';
	}
	
	public static function checkCreateUploadDir( $wp_filesystem, $option, $filename ) {
		$sitesao_upload_dir = self::uploadDir();
		if ( ! $wp_filesystem->is_dir( $sitesao_upload_dir ) ) {
			if ( ! $wp_filesystem->mkdir( $sitesao_upload_dir, 0777 ) ) {
				add_settings_error( self::$field_prefix . $option, $wp_filesystem->errors->get_error_code(), __( sprintf( '%s could not be created. Not available to create sitesao directory in uploads directory (' . $sitesao_upload_dir . ').', $filename ), 'luxury-wp' ), 'error' );
				return false;
			}
		}
	
		return $sitesao_upload_dir;
	}
	
	protected static function getFileSystem( $url = '' ) {
		if ( empty( $url ) ) {
			$url = wp_nonce_url( 'admin.php?page=theme-options', 'dh_theme_option_save_setting' );
		}
		if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
			_e( 'This is required to enable file writing', 'luxury-wp' );
			exit(); // stop processing here
		}
		$assets_dir = get_template_directory();
		if ( ! WP_Filesystem( $creds, $assets_dir ) ) {
			request_filesystem_credentials( $url, '', true, false, null );
			_e( 'This is required to enable file writing', 'luxury-wp' );
			exit();
		}
	}
	
	public function register_setting_callback($options){
		$less_flag = false;
		
		do_action('dh_theme_option_before_setting_callback',$options);
		
		if(isset($options['dh_opt_import'])){
			$import_code = $options['import_code'];
			if(!empty($import_code)){
				$imported_options = json_decode($import_code,true);
				if( !empty( $imported_options ) && is_array( $imported_options )){
					foreach($imported_options as $key => $value) {
						$options[$key] = $value;
					}
				}
			}
		}elseif(isset($options['dh_opt_reset'])){
			$default_options = array();
			foreach ($this->_sections as $key=>$sections){
				if(is_array($sections['fields']) && !empty($sections['fields'])){
					foreach ($sections['fields'] as $field){
						if(isset($field['name']) && isset($field['value'])){
							$default_options[$field['name']] = $field['value'];
						}
					}
				}
			}
			if(!empty($default_options)){
				$options = array();
				foreach($default_options as $key => $value) {
					$options[$key] = $value;
				}
			}
		}else{
			$update_options = array();
			foreach ($this->_sections as $key=>$sections){
				if(is_array($sections['fields']) && !empty($sections['fields'])){
					foreach ($sections['fields'] as $field){
						if(isset($field['name'])){
							if(isset($options[$field['name']])){
								$option_value = $options[$field['name']];
								$option_value = wp_unslash($option_value);
								if(is_array($option_value)){
									$option_value = array_filter( array_map( 'sanitize_text_field', (array) $option_value ) );
								}else{
									if($field['type']=='textarea'){
										$option_value = wp_kses_post(trim($option_value));
									}elseif($field['type'] == 'ace_editor' || $field['type'] == 'textarea_code'){ 
										$option_value = $option_value;
									}else{
										$option_value =  wp_kses_post(trim($option_value));
									}
								}
								$update_options[$field['name']] = $option_value;
							}else{
								if('muitl-select'==$field['type'])
									$update_options[$field['name']] = array();
								else 
									$update_options[$field['name']] = '';
							}
						}
					}
				}
			}
			if(!empty($update_options)){
				foreach($update_options as $key => $value) {
					$options[$key] = $value;
				}
			}
		}
		
		unset($options['import_code']);
		do_action('dh_theme_option_after_setting_callback',$options);
		return $options;
	}
	
	public function get_default_option(){
		return apply_filters('dh_theme_option_default','');
	}
	
	public function option_page(){
		?>
		<?php settings_errors(); ?>
		<div class="clear"></div>
		<div class="wrap">
			<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce( 'dh_theme_option_ajax_security' ) ?>" />
			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields( self::$_option_name ); ?>
				<div class="dh-opt-header">
					<div class="dh-opt-heading"><h2><?php echo DH_THEME_NAME?> <span><?php echo DH_THEME_VERSION?></span></h2> <a target="_blank" href="http://sitesao.com/luxury/document"><?php _e('Online Document','luxury-wp')?></a></div>
				</div>
				<div class="clear"></div>
				<div class="dh-opt-actions">
					<em style="float: left; margin-top: 5px;"><?php echo esc_html('Theme customizations are done here. Happy styling!','luxury-wp')?></em>
					<button id="dh-opt-submit" name="dh_opt_save" class="button-primary" type="submit"><?php echo __('Save All Change','luxury-wp') ?></button>
				</div>
				<div class="clear"></div>
				<div id="dh-opt-tab" class="dh-opt-wrap">
					<div class="dh-opt-sidebar">
						<ul id="dh-opt-menu" class="dh-opt-menu">
							<?php $i = 0;?>
							<?php foreach ((array) $this->_sections as $key=>$sections):?>
								<li<?php echo ($i == 0 ? ' class="current"': '')?>>
									<a href="#<?php echo esc_attr($key)?>" title="<?php echo esc_attr($sections['title']) ?>"><?php echo (isset($sections['icon']) ? '<i class="'.$sections['icon'].'"></i> ':'')?><?php echo esc_html($sections['title']) ?></a>
								</li>
							<?php $i++?>
							<?php endforeach;?>
						</ul>
					</div>
					<div id="dh-opt-content" class="dh-opt-content">
						<?php $i = 0;?>
						<?php foreach ((array) $this->_sections as $key=>$sections):?>
							<div id=<?php echo esc_attr($key)?> class="dh-opt-section" <?php echo ($i == 0 ? ' style="display:block"': '') ?>>
								<h3><?php echo esc_html($sections['title']) ?></h3>
								<?php if(isset($sections['desc'])):?>
								<div class="dh-opt-section-desc">
									<?php echo dh_print_string($sections['desc'])?>
								</div>
								<?php endif;?>
								<table class="form-table">
									<tbody>
										<?php foreach ( (array) $sections['fields'] as $field ) { ?>
										<tr>
											<?php if ( !empty($field['label']) ): ?>
											<th scope="row">
												<div class="dh-opt-label">
													<?php echo esc_html($field['label'])?>
													<?php if ( !empty($field['desc']) ): ?>
													<span class="description"><?php echo dh_print_string($field['desc'])?></span>
													<?php endif;?>
												</div>
											</th>
											<?php endif;?>
											<td <?php if(empty($field['label'])):?>colspan="2" <?php endif;?>>
												<div class="dh-opt-field-wrap">
													<?php 
													if(isset($field['callback']))
														call_user_func($field['callback'], $field);
													?>
													<?php echo dh_print_string($this->_render_field($field))?>
												</div>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						<?php $i++?>
						<?php endforeach;?>
					</div>
				</div>
				<div class="clear"></div>
				<div class="dh-opt-actions2">
					<button id="dh-opt-submit2" name="dh_opt_save" class="button-primary" type="submit"><?php echo __('Save All Change','luxury-wp') ?></button>
					<button id="dh-opt-reset" name="<?php echo self::$_option_name?>[dh_opt_reset]" class="button" type="submit"><?php echo __('Reset Options','luxury-wp') ?></button>
				</div>
				<div class="clear"></div>
			</form>
		</div>
		<?php
	}
	
	public function _render_field($field = array()){
		if(!isset($field['type']))
			echo '';
		
		$field['name']          = isset( $field['name'] ) ? esc_attr($field['name']) : '';
		
		
		$field['value']         = isset( $field['value'] ) ? $field['value'] : '';
		$value = self::get_options($field['name'],$field['value']);
		$field['value'] = apply_filters('dh_theme_option_field_std',$field['value'],$field);
		$field['default_value'] = $field['value'];
		$field['value']         = $value;
		
		$field['id'] 			= isset( $field['id'] ) ? esc_attr($field['id']) : $field['name'];
		$field['desc'] 	= isset($field['desc']) ? $field['desc'] : '';
		$field['label'] 		= isset( $field['label'] ) ? $field['label'] : '';
		$field['placeholder']   = isset( $field['placeholder'] ) ? esc_attr($field['placeholder']) : esc_attr($field['label']);
		
		
		$data_name = ' data-name="'.$field['name'].'"';
		$field_name = self::$_option_name.'['.$field['name'].']';
		
		$dependency_cls = isset($field['dependency']) ? ' dh-dependency-field':'';
		$dependency_data = '';
		if(!empty($dependency_cls)){
			$dependency_default = array('element'=>'','value'=>array());
			$field['dependency'] = wp_parse_args($field['dependency'],$dependency_default);
			if(!empty($field['dependency']['element']) && !empty($field['dependency']['value']))
				$dependency_data = ' data-master="'.esc_attr($field['dependency']['element']).'" data-master-value="'.esc_attr(implode(',',$field['dependency']['value'])).'"';
		}
		
		if(isset($field['field-label'])){
			echo '<p class="field-label">'.$field['field-label'].'</p>';
		}
		
		switch ($field['type']){
			case 'heading':
				echo '<h4>'.(isset($field['text']) ? $field['text'] : '').'</h4>';
			break;
			case 'hr':
				echo '<hr/>';
			break;
			case 'datetimepicker':
				wp_enqueue_script('datetimepicker');
				wp_enqueue_style('datetimepicker');
				echo '<div class="dh-field-text ' . $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<input type="text" readonly class="dh-opt-value input_text" name="' . $field_name . '" id="' .  $field['id'] . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' .  $field['placeholder'] . '" style="width:99%" /> ';
				echo '</div>';
				?>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('#<?php echo esc_attr($field['id']); ?>').datetimepicker({
						 scrollMonth: false,
						 scrollTime: false,
						 scrollInput: false,
						 step:15,
						 format:'m/d/Y H:i'
						});
					});
				</script>
				<?php
			break;
			case 'image':
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}else{
					wp_enqueue_style('thickbox');
					wp_enqueue_script('media-upload');
					wp_enqueue_script('thickbox');
				}
				
				$image = $field['value'];
				$output = !empty( $image ) ? '<img src="'.$image.'" with="200">' : '';
				
				$btn_text = !empty( $image_id ) ? __( 'Change Image', 'luxury-wp' ) : __( 'Select Image', 'luxury-wp' );
				echo '<div  class="dh-field-image ' . $field['id'] . '-field'.$dependency_cls.'"'.$dependency_data.'>';
					echo '<div class="dh-field-image-thumb">' . $output . '</div>';
					echo '<input type="hidden" class="dh-opt-value" name="' . $field_name . '" id="' . $field['id'] . '" value="' . esc_attr($field['value']) . '" />';
					echo '<input type="button" class="button button-primary" id="' . $field['id'] . '_upload" value="' . $btn_text . '" /> ';
					echo '<input type="button" class="button" id="' . $field['id'] . '_clear" value="' . __( 'Clear Image', 'luxury-wp' ) . '" '.(empty($field['value']) ? ' style="display:none"':'').' />';
				?>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('#<?php echo esc_attr($field['id']); ?>_upload').on('click', function(event) {
							event.preventDefault();
							var $this = $(this);
	
							// if media frame exists, reopen
							if(dh_meta_image_frame) {
								dh_meta_image_frame.open();
				                return;
				            }
	
							// create new media frame
							// I decided to create new frame every time to control the selected images
							var dh_meta_image_frame = wp.media.frames.wp_media_frame = wp.media({
								title: "<?php echo esc_js(__( 'Select or Upload your Image', 'luxury-wp' )); ?>",
								button: {
									text: "<?php echo esc_js(__( 'Select', 'luxury-wp' )); ?>"
								},
								library: { type: 'image' },
								multiple: false
							});
	
							// when image selected, run callback
							dh_meta_image_frame.on('select', function(){
								var attachment = dh_meta_image_frame.state().get('selection').first().toJSON();
								$this.closest('.dh-field-image').find('input#<?php echo esc_attr($field['id']); ?>').val(attachment.url);
								var thumbnail = $this.closest('.dh-field-image').find('.dh-field-image-thumb');
								thumbnail.html('');
								thumbnail.append('<img src="' + attachment.url + '" alt="" />');
	
								$this.attr('value', '<?php echo esc_js(__( 'Change Image', 'luxury-wp' )); ?>');
								$('#<?php echo esc_attr($field['id']); ?>_clear').css('display', 'inline-block');
							});
	
							// open media frame
							dh_meta_image_frame.open();
						});
	
						$('#<?php echo esc_attr($field['id']); ?>_clear').on('click', function(event) {
							var $this = $(this);
							$this.hide();
							$('#<?php echo esc_attr($field['id']); ?>_upload').attr('value', '<?php echo esc_js(__( 'Select Image', 'luxury-wp' )); ?>');
							$this.closest('.dh-field-image').find('input#<?php echo esc_attr($field['id']); ?>').val('');
							$this.closest('.dh-field-image').find('.dh-field-image-thumb').html('');
						});
					});
				</script>
							
				<?php
				echo '</div>';
			break;
			case 'color':
				wp_enqueue_style( 'wp-color-picker');
				wp_enqueue_script( 'wp-color-picker');
			
				echo '<div  class="dh-field-color ' . $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<input type="text" class="dh-opt-value" name="' . $field_name . '" id="' . $field['id'] . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' .  $field['placeholder'] . '" /> ';
				echo '<script type="text/javascript">
					jQuery(document).ready(function($){
					    $("#'. ( $field['id'] ).'").wpColorPicker();
					});
				 </script>
				';
				echo '</div>';
			break;
			case 'nav_select':
			case 'muitl-select':
			case 'select':
				if($field['type'] == 'muitl-select'){
					$field_name = $field_name.'[]';
				}
				if($field['type'] == 'nav_select'){
					$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
					$menu_options[''] = __('Select Menu...','luxury-wp');
					foreach ( $menus as $menu ) {
						$menu_options[$menu->term_id] = $menu->name;
					}
					$field['options'] = $menu_options;
				}
				$field['options']       = isset( $field['options'] ) ? $field['options'] : array();
				echo '<div  class="dh-field-select ' .  $field['id'] . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<select '.($field['type'] == 'muitl-select' ? 'multiple="multiple"': $data_name).' data-placeholder="' . $field['label'] . '" class="dh-opt-value dh-chosen-select"  id="' . $field['id'] . '" name="' . $field_name . '">';
				foreach ( $field['options'] as $key => $value ) {
					if($field['type'] == 'muitl-select'){
						if(!is_array($field['value'])){
							$field['value'] = (array)$field['value'];
						}
						echo '<option value="' . esc_attr( $key ) . '" ' . ( in_array(esc_attr($key), $field['value']) ? 'selected="selected"':''). '>' . esc_html( $value ) . '</option>';
					}else{
						echo '<option value="' . esc_attr( $key ) . '" ' . selected( ( $field['value'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
					}
				}
				echo '</select> ';
				echo '</div>';
			break;
			case 'textarea_code':
			case 'textarea':
				echo '<div class="dh-field-textarea ' .  $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<textarea class="dh-opt-value" name="' . $field_name . '" id="' .  $field['id']  . '" placeholder="' . $field['placeholder'] . '" rows="5" cols="20" style="width: 99%;">' . esc_textarea( $field['value'] ) . '</textarea> ';
				echo '</div>';
			break;
			case 'ace_editor':
				echo '<div class="dh-field-textarea ' .  $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<pre id="' .  $field['id']  . '-editor" class="dh-opt-value" style="height: 205px;border:1px solid #ccc">'. $field['value'].'</pre>';
				echo '<textarea class="dh-opt-value" id="' .  $field['id']  . '" name="' . $field_name . '" placeholder="' . $field['placeholder'] . '" style="width: 99%;display:none">' .  $field['value'] . '</textarea> ';
				echo '</div>';
			break;
			case 'switch':
				$cb_enabled = $cb_disabled = '';//no errors, please
				if ( (int) $field['value'] == 1 ){
					$cb_enabled = ' selected';
				}else {
					$field['value'] = 0;
					$cb_disabled = ' selected';
				}
				//Label On
				if(!isset($field['on'])){
					$on = __('On','luxury-wp');
				}else{
					$on = $field['on'];
				}
				
				//Label OFF
				if(!isset($field['off'])){
					$off = __('Off','luxury-wp');
				} else{
					$off = $field['off'];
				}
				
				echo '<div class="dh-field-switch ' .  $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<label class="cb-enable'. $cb_enabled .'" data-id="'.$field['id'].'">'. $on .'</label>';
				echo '<label class="cb-disable'. $cb_disabled .'" data-id="'.$field['id'].'">'. $off .'</label>';
				echo '<input '.$data_name.' type="hidden"  class="dh-opt-value switch-input" id="'.$field['id'].'" name="' . $field_name .'" value="'.esc_attr($field['value']).'" />';
				echo '</div>';
			break;
			case 'buttonset':
				$field['options']       = isset( $field['options'] ) ? $field['options'] : array();
				echo '<div class="dh-field-buttonset ' .  $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<div class="dh-buttonset">';
				foreach ( $field['options'] as $key => $value ) {
					echo '<input '.$data_name.' name="' . $field_name  . '"
								id="' . esc_attr($field['name'].'-'.$key)  . '"
				        		value="' . esc_attr( $key ) . '"
				        		type="radio"
								class="dh-opt-value"
				        		' . checked(  $field['value'], esc_attr( $key ), false ) . '
				        		/><label for="'.esc_attr($field['name'].'-'.$key).'">' . esc_html( $value ) . '</label>';
				}
				echo '</div>';
				echo '</div>';
			break;
			case 'radio':
				$field['options']       = isset( $field['options'] ) ? $field['options'] : array();
				echo '<div class="dh-field-radio ' .  $field['id'] . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<ul>';
				foreach ( $field['options'] as $key => $value ) {
					echo '<li><label><input
				        		name="' . $field_name . '"
				        		value="' . esc_attr( $key ) . '"
				        		type="radio"
								'.$data_name.'
								class="dh-opt-value radio"
				        		' . checked( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '
				        		/> ' . esc_html( $value ) . '</label>
				    	</li>';
				}
				echo '</ul>';
				echo '</div>';
			break;
			case 'text':
				echo '<div class="dh-field-text ' . $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<input type="text" class="dh-opt-value input_text" name="' . $field_name . '" id="' .  $field['id'] . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' .  $field['placeholder'] . '" style="width:99%" /> ';
				echo '</div>';
			break;
			case 'background':
				wp_enqueue_style( 'wp-color-picker');
				wp_enqueue_script( 'wp-color-picker');
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}else{
					wp_enqueue_style('thickbox');
					wp_enqueue_script('media-upload');
					wp_enqueue_script('thickbox');
				}
				$value_default = array(
						'background-color'      => '',
						'background-repeat'     => '',
						'background-attachment' => '',
						'background-position'   => '',
						'background-image'      => '',
						'background-clip'       => '',
						'background-origin'     => '',
						'background-size'       => '',
						'media' => array(),
				);
				$values = wp_parse_args( $field['value'], $value_default );
				echo '<div class="dh-field-background ' . $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				//background color
				echo '<div  class="dh-background-color">';
				echo '<input type="text" class="dh-opt-value" name="' .  $field_name . '[background-color]" id="' .  $field['id'] . '_background_color" value="' . esc_attr( $values['background-color'] ) . '" /> ';
				echo '<script type="text/javascript">
					jQuery(document).ready(function($){
					    $("#'. ( $field['id'] ).'_background_color").wpColorPicker();
					});
				 </script>
				';
				echo '</div>';
				echo '<br>';
				//background repeat
				echo '<div  class="dh-background-repeat">';
				$bg_repeat_options = array('no-repeat'=>'No Repeat','repeat'=>'Repeat All','repea-x'=>'Repeat Horizontally','repeat-y'=>'Repeat Vertically','inherit'=>'Inherit');
				echo '<select class="dh-opt-value dh-chosen-select-nostd" id="' . $field['id'] . '_background_repeat" data-placeholder="' . __( 'Background Repeat', 'luxury-wp' ) . '" name="' . $field_name . '[background-repeat]">';
				echo '<option value=""></option>';
				foreach ( $bg_repeat_options as $key => $value ) {
					echo '<option value="' . esc_attr( $key ) . '" ' . selected( $values['background-repeat'] , esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				echo '</select> ';
				echo '</div>';
				//background size
				echo '<div  class="dh-background-size">';
				$bg_size_options = array('inherit'=>'Inherit','cover'=>'Cover','contain'=>'Contain');
				echo '<select class="dh-opt-value dh-chosen-select-nostd" id="' . $field['id'] . '_background_size" data-placeholder="' . __( 'Background Size', 'luxury-wp' ) . '" name="' . $field_name . '[background-size]">';
				echo '<option value=""></option>';
				foreach ( $bg_size_options as $key => $value ) {
					echo '<option value="' . esc_attr( $key ) . '" ' . selected( $values['background-size'] , esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				echo '</select> ';
				echo '</div>';
				//background attachment
				echo '<div  class="dh-background-attachment">';
				$bg_attachment_options = array('fixed'=>'Fixed','scroll'=>'Scroll','inherit'=>'Inherit');
				echo '<select class="dh-opt-value dh-chosen-select-nostd" id="' . $field['id'] . '_background_attachment" data-placeholder="' . __( 'Background Attachment', 'luxury-wp' ) . '"  name="' . $field_name . '[background-attachment]">';
				echo '<option value=""></option>';
				foreach ( $bg_attachment_options as $key => $value ) {
					echo '<option value="' . esc_attr( $key ) . '" ' . selected( $values['background-attachment'] , esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				echo '</select> ';
				echo '</div>';
				//background position
				echo '<div  class="dh-background-position">';
				$bg_position_options = array(
					'left top' => 'Left Top',
                    'left center' => 'Left center',
                    'left bottom' => 'Left Bottom',
                    'center top' => 'Center Top',
                    'center center' => 'Center Center',
                    'center bottom' => 'Center Bottom',
                    'right top' => 'Right Top',
                    'right center' => 'Right center',
                    'right bottom' => 'Right Bottom'
				);
				echo '<select class="dh-opt-value dh-chosen-select-nostd"  id="' . $field['id'] . '_background_position" data-placeholder="' . __( 'Background Position', 'luxury-wp' ) . '" name="' . $field_name . '[background-position]">';
				echo '<option value=""></option>';
				foreach ( $bg_position_options as $key => $value ) {
					echo '<option value="' . esc_attr( $key ) . '" ' . selected( $values['background-position'] , esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				echo '</select> ';
				echo '</div>';
				//background image
				
				$image = $values['background-image'];
				$output = !empty( $image ) ? '<img src="'.$image.'" with="100">' : '';
				$btn_text = !empty( $image_id ) ? __( 'Change Image', 'luxury-wp' ) : __( 'Select Image', 'luxury-wp' );
				echo '<br>';
				echo '<div  class="dh-background-image">';
				echo '<div class="dh-field-image-thumb">' . $output . '</div>';
				echo '<input type="hidden" class="dh-opt-value" name="' . $field_name . '[background-image]" id="' . $field['id'] . '_background_image" value="' . esc_attr($values['background-image']) . '" />';
				echo '<input type="button" class="button button-primary" id="' . $field['id'] . '_background_image_upload" value="' . $btn_text . '" /> ';
				echo '<input type="button" class="button" id="' . $field['id'] . '_background_image_clear" value="' . __( 'Clear Image', 'luxury-wp' ) . '" '.(empty($field['value']) ? ' style="display:none"':'').' />';
				?>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('#<?php echo esc_attr($field['id']); ?>_background_image_upload').on('click', function(event) {
							event.preventDefault();
							var $this = $(this);
	
							// if media frame exists, reopen
							if(dh_meta_image_frame) {
								dh_meta_image_frame.open();
				                return;
				            }
	
							// create new media frame
							// I decided to create new frame every time to control the selected images
							var dh_meta_image_frame = wp.media.frames.wp_media_frame = wp.media({
								title: "<?php echo esc_js(__( 'Select or Upload your Image', 'luxury-wp' )); ?>",
								button: {
									text: "<?php echo esc_js(__( 'Select', 'luxury-wp' )); ?>"
								},
								library: { type: 'image' },
								multiple: false
							});
	
							// when image selected, run callback
							dh_meta_image_frame.on('select', function(){
								var attachment = dh_meta_image_frame.state().get('selection').first().toJSON();
								$this.closest('.dh-background-image').find('input#<?php echo esc_attr($field['id']); ?>_background_image').val(attachment.url);
								var thumbnail = $this.closest('.dh-background-image').find('.dh-field-image-thumb');
								thumbnail.html('');
								thumbnail.append('<img src="' + attachment.url + '" alt="" />');
	
								$this.attr('value', '<?php echo esc_js(__( 'Change Image', 'luxury-wp' )); ?>');
								$('#<?php echo esc_attr($field['id']); ?>_background_image_clear').css('display', 'inline-block');
							});
	
							// open media frame
							dh_meta_image_frame.open();
						});
	
						$('#<?php echo esc_attr($field['id']); ?>_background_image_clear').on('click', function(event) {
							var $this = $(this);
							$this.hide();
							$('#<?php echo esc_attr($field['id']); ?>_background_image_upload').attr('value', '<?php echo esc_js(__( 'Select Image', 'luxury-wp' )); ?>');
							$this.closest('.dh-background-image').find('input#<?php echo esc_attr($field['id']); ?>_background_image').val('');
							$this.closest('.dh-background-image').find('.dh-field-image-thumb').html('');
						});
					});
				</script>
							
				<?php
				echo '</div>';
				echo '</div>';
			break;
			case 'custom_font':
				$value_default = array(
						'font-family'      		=> '',
						'font-size'     		=> '',
						'font-style'      		=> '',
						'text-transform'   		=> '',
						'letter-spacing'      	=> '',
						'subset'       			=> '',
				);
				$values = wp_parse_args( $field['value'], $value_default );
				global $google_fonts;
				if(empty($google_fonts))
					include_once (DHINC_DIR . '/lib/google-fonts.php');
				
				$google_fonts_object = json_decode($google_fonts);
				$google_faces = array();
				foreach($google_fonts_object as $obj => $props) {
					$google_faces[$props->family] =  $props->family;
				}
				echo '<div class="dh-field-custom-font ' . ( $field['id'] ) . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				//font-family
				echo '<div  class="custom-font-family">';
				echo '<select data-placeholder="' . __('Select a font family','luxury-wp') . '" class="dh-opt-value dh-chosen-select-nostd"  id="' . $field['id'] . '" name="' . $field_name  . '[font-family]">';
				echo '<option value=""></option>';
				foreach ( $google_faces as $key => $value ) {
					echo '<option value="' . ( $key ) . '" ' . selected( ( $values['font-family'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				echo '</select> ';
				echo '</div>';
				//font-size
				echo '<div  class="custom-font-size">';
				echo '<select data-placeholder="' . __('Font size','luxury-wp') . '" class="dh-opt-value dh-chosen-select-nostd"  id="' . $field['id'] . '" name="' . $field_name  . '[font-size]">';
				echo '<option value=""></option>';
				foreach ( (array) dh_custom_font_size(true) as $key => $value ) {
					echo '<option value="' . ( $key ) . '" ' . selected( ( $values['font-size'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				echo '</select> ';
				echo '</div>';
				//font-style
				echo '<div  class="custom-font-style">';
				echo '<select data-placeholder="' . __('Font style','luxury-wp') . '" class="dh-opt-value dh-chosen-select-nostd"  id="' . $field['id'] . '" name="' . $field_name  . '[font-style]">';
				echo '<option value=""></option>';
				foreach ( (array) dh_custom_font_style(true) as $key => $value ) {
					echo '<option value="' . ( $key ) . '" ' . selected( ( $values['font-style'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				echo '</select> ';
				echo '</div>';
				
				//subset
				$subset = array(
					"latin" => "Latin",
				    "latin-ext" => "Latin Ext",
				    "cyrillic" => "Cyrillic",
				    "cyrillic-ext" => "Cyrillic Ext",
				    "greek" => "Greek",
				    "greek-ext" => "Greek Ext",
				    "vietnamese" => "Vietnamese"
				);
				echo '<div  class="custom-font-subset">';
				echo '<select data-placeholder="' . __('Subset','luxury-wp') . '" class="dh-opt-value dh-chosen-select-nostd"  id="' . $field['id'] . '" name="' . $field_name  . '[subset]">';
				echo '<option value=""></option>';
				foreach ( (array) $subset as $key => $value ) {
					echo '<option value="' . ( $key ) . '" ' . selected( ( $values['subset'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				echo '</select> ';
				echo '</div>';
				
				echo '</div>';
			break;
			case 'list_color':
				wp_enqueue_style( 'wp-color-picker');
				wp_enqueue_script( 'wp-color-picker');
				echo '<div class="dh-field-list-color ' . ( $field['id'] ) . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				$field['options']       = isset( $field['options'] ) ? $field['options'] : array();
				foreach ($field['options'] as $key=>$label){
					$values[$key] = isset($field['value'][$key]) ? $field['value'][$key] : '';
					echo '<div>'.$label.'<br>';
					echo '<input type="text" class="dh-opt-value" name="' .  $field_name . '['.$key.']" id="' . $field['id'] . '_'.$key .'" value="' . esc_attr( $values[$key] ) . '" /> ';
					echo '<script type="text/javascript">
						jQuery(document).ready(function($){
						    $("#'. $field['id'] . '_'.$key.'").wpColorPicker();
						});
					 </script>
					';
					echo '</div>';
				}
				echo '</div>';
			break;
			case 'image_select':
				$field['options']       = isset( $field['options'] ) ? $field['options'] : array();
				echo '<div class="dh-field-image-select ' . ( $field['id'] ) . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<ul class="dh-image-select">';
				foreach ( $field['options'] as $key => $value ) {
					echo '<li'.($field['value'] == $key ? ' class="selected"':'').'><label for="' . esc_attr( $key ) . '"><input
			        		name="' . $field_name . '"
							id="' . esc_attr( $key ) . '"
			        		value="' . esc_attr( $key ) . '"
			        		type="radio"
							'.$data_name.'
							class="dh-opt-value"
			        		' . checked( $field['value'], esc_attr( $key ), false ) . '
			        		/><img title="'.esc_attr(@$value['alt']).'" alt="'.esc_attr(@$value['alt']).'" src="'.esc_url(@$value['img']).'"></label>
				    </li>';
				}
				echo '</ul>';
				echo '</div>';
			break;
			case 'import':
				echo '<div class="dh-field-import ' .  $field['id']  . '-field'.$dependency_cls.'"'.$dependency_data.'>';
				echo '<textarea id="' .  $field['id']  . '" name="' .  self::$_option_name  . '[import_code]" placeholder="' . $field['placeholder'] . '" rows="5" cols="20" style="width: 99%;"></textarea><br><br>';
				echo '<button id="dh-opt-import" class="button-primary" name="'.self::$_option_name.'[dh_opt_import]" type="submit">'.__('Import','luxury-wp').'</button>';
				echo ' <em style="font-size:11px;color:#f00">'.esc_html__('WARNING! This will overwrite all existing option values, please proceed with caution!','luxury-wp').'</em>';
				echo '</div>';
			break;
			case 'export':
				$secret = md5( AUTH_KEY . SECURE_AUTH_KEY );
				$link = admin_url('admin-ajax.php?action=dh_download_theme_option&secret=' . $secret);
				echo '<a id="dh-opt-export" class="button-primary" href="'.esc_url($link).'">'.__('Export','luxury-wp').'</a>';
			break;
			default:
			break;
		}
		
	}
	
	public function get_sections(){
		$section = array(
			'general' => array (
					'icon' => 'fa fa-home',
					'title' => __ ( 'General', 'luxury-wp' ),
					'desc' => __ ( '<p class="description">Here you will set your site-wide preferences.</p>', 'luxury-wp' ),
					'fields' => array (
							array (
									'name' => 'logo',
									'type' => 'image',
									'value'=>get_template_directory_uri().'/assets/images/logo.png',
									'label' => __ ( 'Logo', 'luxury-wp' ),
									'desc' => __ ( 'Upload your own logo.', 'luxury-wp' ),
							),
							array (
									'name' => 'logo-fixed',
									'type' => 'image',
									'value'=>get_template_directory_uri().'/assets/images/logo-fixed.png',
									'label' => __ ( 'Fixed Menu Logo', 'luxury-wp' ),
									'desc' => __ ( 'Upload your own logo.This is optional use when fixed menu', 'luxury-wp' ),
							),
							array (
								'name' => 'logo-transparent',
								'type' => 'image',
								'value'=>get_template_directory_uri().'/assets/images/logo-transparent.png',
								'label' => __ ( 'Transparent Menu Logo', 'luxury-wp' ),
								'desc' => __ ( 'Upload your own logo.This is optional use for menu transparent', 'luxury-wp' ),
							),
							array (
								'name' => 'logo-mobile',
								'type' => 'image',
								'value'=>get_template_directory_uri().'/assets/images/logo-mobile.png',
								'label' => __ ( 'Mobile Version Logo', 'luxury-wp' ),
								'desc' => __ ( 'Use this option to change your logo for mobile devices if your logo width is quite long to fit in mobile device screen.', 'luxury-wp' ),
							),
							array (
									'name' => 'favicon',
									'type' => 'image',
									'value'=>get_template_directory_uri().'/assets/images/favicon.png',
									'label' => __ ( 'Favicon', 'luxury-wp' ),
									'desc' => __ ( 'Image that will be used as favicon (32px32px).', 'luxury-wp' ),
							),
							array (
									'name' => 'apple57',
									'type' => 'image',
									'label' => __ ( 'Apple Iphone Icon', 'luxury-wp' ),
									'desc' => __ ( 'Apple Iphone Icon (57px 57px).', 'luxury-wp' ),
							),	
							array (
									'name' => 'apple72',
									'type' => 'image',
									'label' => __ ( 'Apple iPad Icon', 'luxury-wp' ),
									'desc' => __ ( 'Apple Iphone Retina Icon (72px 72px).', 'luxury-wp' ),
							),
							array (
									'name' => 'apple114',
									'type' => 'image',
									'label' => __ ( 'Apple Retina Icon', 'luxury-wp' ),
									'desc' => __ ( 'Apple iPad Retina Icon (144px 144px).', 'luxury-wp' ),
							),
							array (
								'name' => 'preloader',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __ ( 'Preloader', 'luxury-wp' ),
								'value'	=> 0,
								'desc' => __ ( 'Toggle whether or not to enable Preloader on your pages.', 'luxury-wp' ),
							),
							array (
								'name' => 'back-to-top',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __ ( 'Back To Top Button', 'luxury-wp' ),
								'value'	=> 1,
								'desc' => __ ( 'Toggle whether or not to enable a back to top button on your pages.', 'luxury-wp' ),
							),
							
							array (
								'name' => 'popup_newsletter',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __ ( 'Newsletter', 'luxury-wp' ),
								'value'	=> 1,
								'desc' => __ ( 'Toggle whether or not to enable modal Newsletter in your site.', 'luxury-wp' ),
							),
							array(
								'name' => 'popup_newsletter_interval',
								'type' => 'text',
								'dependency' => array('element'=>'popup_newsletter','value'=>array('1')),
								'label' => __('Newsletter refresh interval','luxury-wp'),
								'value'=>'1',
								'desc'=>__('Enter day number to refresh newsletter. value 0 will be shown every page','luxury-wp')
							),
							array(
								'name' => 'newsletter_heading',
								'type' => 'text',
								'dependency' => array('element'=>'popup_newsletter','value'=>array('1')),
								'label' => __('Newsletter Heading','luxury-wp'),
								'value'=>'Newsletter',
								'desc'=>__('Enter Newsletter Heading','luxury-wp')
							),
							array(
								'name' => 'newsletter_desc',
								'type' => 'text',
								'dependency' => array('element'=>'popup_newsletter','value'=>array('1')),
								'label' => __('Newsletter Description','luxury-wp'),
								'value'=>'Get timely updates from your favorite products',
								'desc'=>__('Enter Newsletter Description','luxury-wp')
							),
							array (
								'name' => 'newsletter_bg',
								'type' => 'image',
								'dependency' => array('element'=>'popup_newsletter','value'=>array('1')),
								'label' => __ ( 'Newsletter Background', 'luxury-wp' ),
							),
					)
			),
			'design_layout' => array(
					'icon' => 'fa fa-columns',
					'title' => __ ( 'Design and Layout', 'luxury-wp' ),
					'desc' => __ ( '<p class="description">Customize Design and Layout.</p>', 'luxury-wp' ),
					'fields'=>array(
						array (
							'name' => 'site-layout',
							'type' => 'buttonset',
							'label' => __ ( 'Site Layout', 'luxury-wp' ),
							'desc'=>__('Select between wide or boxed site layout','luxury-wp'),
							'value'=>'wide',
							'options'=>array(
								'wide'=> __('Wide','luxury-wp'),
								'boxed'=> __('Boxed','luxury-wp'),
								'padding'=> __('Full Padding','luxury-wp')
							)
						),
						array(
							'name'=>'body-bg',
							'type' => 'background',
							'dependency' => array('element'=>'site-layout','value'=>array('boxed')),
							'label' => __('Background', 'luxury-wp'),
							'desc'=> __('Select your boxed background', 'luxury-wp'),
							'value' => array('background-color'=>'#fff','background-image'=>get_template_directory_uri().'/assets/images/bg-body.png', 'background-repeat' => 'repeat' ),
						),
						array (
							'name' => 'wide-container',
							'type' => 'buttonset',
							'label' => __ ( 'Wide Layout Width', 'luxury-wp' ),
							'desc'=>__('Select between Full Width (full width container - spanning the entire width of your viewport. ) or Fixed Width ( fixed width container. ) for Wide layout width','luxury-wp'),
							'value'=>'fixedwidth',
							'dependency' => array('element'=>'site-layout','value'=>array('wide','padding')),
							'options'=>array(
								'fullwidth'=> __('Full Width','luxury-wp'),
								'fixedwidth'=> __('Fixed Width','luxury-wp')
							)
						),
						array(
							'name' => 'modern-background',
							'type' => 'switch',
							'label' => __('Modern Background','luxury-wp'),
							'value' => '0',
							'desc'=> __('Use Modern Background for Theme', 'luxury-wp'),
						),
						array(
								'dependency' => array('element'=>'modern-background','value'=>array('0')),
								'name' => 'layout-border',
								'type' => 'buttonset',
								'label' => __('Layout Border','luxury-wp'),
								'value' => 'content',
								'options'=>array(
									'sidebar'=> __(' All Sidebar border','luxury-wp'),
									'content'=> __('Content Border','luxury-wp'),
									'no'=> __('No Border','luxury-wp')
								),
								'desc'=> __('Layout with border and padding', 'luxury-wp'),
						),
						array(
							'name' => 'smartsidebar',
							'type' => 'switch',
							'label' => __('Smart Sidebar','luxury-wp'),
							'value' => '0',
							'desc'=> __('Sticky Sidebar when scroll', 'luxury-wp'),
						),
						
					)
			),
			'color_typography' => array(
					'icon' => 'fa fa-font',
					'title' => __ ( 'Color and Typography', 'luxury-wp' ),
					'desc' => __ ( '<p class="description">Customize Color and Typography.</p>', 'luxury-wp' ),
					'fields'=>array(
								array(
										'name' => 'brand-primary',
										'type' => 'color',
										'label' => __('Brand primary','luxury-wp'),
										'value'=>'#9fce4e'
								),
								array(
										'name' => 'body-typography',
										'type' => 'custom_font',
										'field-label' => __('Body','luxury-wp'),
										'value' => array()
								),
								array(
										'name' => 'navbar-typography',
										'type' => 'custom_font',
										'field-label' => __('Navigation','luxury-wp'),
										'value' => array()
								),
								array(
										'name' => 'h1-typography',
										'type' => 'custom_font',
										'field-label' => __('Heading H1','luxury-wp'),
										'value' => array()
								),
								array(
										'name' => 'h2-typography',
										'type' => 'custom_font',
										'field-label' => __('Heading H2','luxury-wp'),
										'value' => array()
								),
								array(
										'name' => 'h3-typography',
										'type' => 'custom_font',
										'field-label' => __('Heading H3','luxury-wp'),
										'value' => array()
								),
								array(
										'name' => 'h4-typography',
										'type' => 'custom_font',
										'field-label' => __('Heading H4','luxury-wp'),
										'value' => array()
								),
								array(
										'name' => 'h5-typography',
										'type' => 'custom_font',
										'field-label' => __('Heading H5','luxury-wp'),
										'value' => array()
								),
								array(
										'name' => 'h6-typography',
										'type' => 'custom_font',
										'field-label' => __('Heading H6','luxury-wp'),
										'value' => array()
								),
					)
			),
			'header'=>array(
					'icon' => 'fa fa-header',
					'title' => __ ( 'Header', 'luxury-wp' ),
					'desc' => __ ( '<p class="description">Customize Header.</p>', 'luxury-wp' ),
					'fields'=>array(
							array(
									'name' => 'header-style',
									'type' => 'select',
									'label' => __('Header Style', 'luxury-wp'),
									'desc' => __('Please select your header style here.', 'luxury-wp'),
									'options' => array(
										'classic'=>__('Classic','luxury-wp'),
										'classic-right'=>__('Classic Right','luxury-wp'),
										'center'=>__('Center','luxury-wp'),
										'center-logo'=>__('Center Logo','luxury-wp'),
										'market'=>__('Market','luxury-wp'),
										'toggle-offcanvas'=>__('Off Canvas','luxury-wp'),
										'overlay'=>__('Menu Overlay','luxury-wp'),
									),
									'value'=>'classic'
							),
							array(
								'name' => 'center-logo-nav-left',
								'type' => 'nav_select',
								'dependency' => array('element'=>'header-style','value'=>array('center-logo')),
								'label' => __('Select Left Menu', 'luxury-wp'),
								'value'=>''
							),
							array(
								'name' => 'center-logo-nav-right',
								'type' => 'nav_select',
								'dependency' => array('element'=>'header-style','value'=>array('center-logo')),
								'label' => __('Select Right Menu', 'luxury-wp'),
								'value'=>''
							),
							array(
								'name' => 'overlay-menu-content',
								'type' => 'textarea',
								'dependency' => array('element'=>'header-style','value'=>array('overlay')),
								'label' => __('Overlay Menu Content Custom HTML', 'luxury-wp'),
								'value'=>'Copyright © 2015 Designed by Sitesao. All rights reserved.'
							),
							array(
								'name' => 'overlay-menu-social',
								'type' => 'muitl-select',
								'label' => __('Overlay Menu Social Icon','luxury-wp'),
								'dependency' => array('element'=>'header-style','value'=>array('overlay')),
								'value' => array('facebook','twitter','google-plus','pinterest','rss','instagram'),
								'options'=>array(
									'facebook'=>'Facebook',
									'twitter'=>'Twitter',
									'google-plus'=>'Google Plus',
									'pinterest'=>'Pinterest',
									'linkedin'=>'Linkedin',
									'rss'=>'Rss',
									'instagram'=>'Instagram',
									'github'=>'Github',
									'behance'=>'Behance',
									'stack-exchange'=>'Stack Exchange',
									'tumblr'=>'Tumblr',
									'soundcloud'=>'SoundCloud',
									'dribbble'=>'Dribbble',
									'youtube'=>'Youtube'
								),
							),
							array(
								'name' => 'header-offcanvas',
								'type' => 'buttonset',
								'dependency' => array('element'=>'header-style','value'=>array('toggle-offcanvas')),
								'label' => __('Show Sidebar Offcanvas', 'luxury-wp'),
								'options' => array(
									'click'=>__('When Click','luxury-wp'),
									'always'=>__('Always','luxury-wp'),
								),
								'value'=>'click'
							),
							array(
								'name' => 'usericon',
								'type' => 'switch',
								'label' => __('User icon in header','luxury-wp'),
								'desc' => __('Show or hide user icon in menu.', 'luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'ajaxsearch',
								'type' => 'switch',
								'label' => __('Search icon in menu','luxury-wp'),
								'desc' => __('Enable or disable search icon in menu.', 'luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'logo-position',
								'type' => 'buttonset',
								'dependency' => array('element'=>'header-style','value'=>array('overlay')),
								'label' => __('Logo Positon', 'luxury-wp'),
								'options' => array(
									'center'=>__('Center','luxury-wp'),
									'left'=>__('Left','luxury-wp'),
								),
								'value'=>'center'
							),
// 							array(
// 								'name' => 'offcanvas-color',
// 								'type' => 'switch',
// 								'label' => __('Custom OffCanvas Color','luxury-wp'),
// 								'value' => '0' // 1 = checked | 0 = unchecked
// 							),
// 							array(
// 								'name' => 'offcanvas-custom-color',
// 								'type' => 'list_color',
// 								'dependency' => array('element'=>'offcanvas-color','value'=>array('1')),
// 								'options' => array(
// 									'offcanvas-bg'=>__('Offcanvas Background','luxury-wp'),
// 									'offcanvas-color'=>__('Offcanvas Color','luxury-wp'),
// 									'offcanvas-link'=>__('Offcanvas Link Color','luxury-wp'),
// 									'offcanvas-link-hover'=>__('Offcanvas Link Hover Color','luxury-wp'),
// 								)
// 							),
							array(
								'name' => 'show-navbar-offcanvas',
								'type' => 'switch',
								'dependency' => array('element'=>'header-style','value'=>array('center','classic','center-logo','classic-right')),
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Display Side Menu in Main Menu', 'luxury-wp'),
								'desc' => __('Display Side Menu in Main Menu, and it not working with Header Off-Canvas', 'luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'topbar_setting',
								'type' => 'heading',
								'text' => __('Topbar Settings','luxury-wp'),
							),
							array(
									'name' => 'show-topbar',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Display top bar', 'luxury-wp'),
									'desc' => __('Enable or disable the top bar.<br> See Social icons tab to enable the social icons inside it.<br> Set a Top menu from  Appearance - Menus ', 'luxury-wp'),
									'value' => '0' // 1 = checked | 0 = unchecked
							),
						array(
							'name' => 'left-topbar-content',
							'type' => 'buttonset',
							'dependency' => array('element'=>'show-topbar','value'=>array('1')),
							'label' => __('Left topbar content', 'luxury-wp'),
							'options' => array(
								'none'=>__('None','luxury-wp'),
								'menu_social'=>__('Social','luxury-wp'),
								'info'=>__('Site Info','luxury-wp'),
								'custom'=>__('Custom HTML','luxury-wp'),
							),
							'value'=>'custom'
						),
						array(
							'name' => 'left-topbar-social',
							'type' => 'muitl-select',
							'label' => __('Top Social Icon','luxury-wp'),
							'dependency' => array('element'=>'left-topbar-content','value'=>array('menu_social')),
							'value' => array('facebook','twitter','google-plus','pinterest','rss','instagram'),
							'options'=>array(
								'facebook'=>'Facebook',
								'twitter'=>'Twitter',
								'google-plus'=>'Google Plus',
								'pinterest'=>'Pinterest',
								'linkedin'=>'Linkedin',
								'rss'=>'Rss',
								'instagram'=>'Instagram',
								'github'=>'Github',
								'behance'=>'Behance',
								'stack-exchange'=>'Stack Exchange',
								'tumblr'=>'Tumblr',
								'soundcloud'=>'SoundCloud',
								'dribbble'=>'Dribbble',
								'youtube'=>'Youtube'
							),
						),
						array(
							'name' => 'left-topbar-phone',
							'type' => 'text',
							'dependency' => array('element'=>'left-topbar-content','value'=>array('info')),
							'label' => __('Phone number','luxury-wp'),
							'value'=>'(123) 456 789'
						),
						array(
							'name' => 'left-topbar-email',
							'type' => 'text',
							'dependency' => array('element'=>'left-topbar-content','value'=>array('info')),
							'label' => __('Email','luxury-wp'),
							'value'=>'info@domain.com'
						),
						array(
							'name' => 'left-topbar-skype',
							'type' => 'text',
							'dependency' => array('element'=>'left-topbar-content','value'=>array('info')),
							'label' => __('Skype','luxury-wp'),
							'value'=>'skype.name'
						),
						array(
							'name' => 'left-topbar-custom-content',
							'type' => 'textarea',
							'dependency' => array('element'=>'left-topbar-content','value'=>array('custom')),
							'label' => __('Left Topbar Content Custom HTML', 'luxury-wp'),
							'value'=>'Shop unique and handmade items directly'
						),
							array(
								'name' => 'main_navbar_setting',
								'type' => 'heading',
								'text' => __('Main Navbar Settings','luxury-wp'),
							),
							array(
									'name' => 'sticky-menu',
									'type' => 'switch',
									'label' => __('Sticky Top menu', 'luxury-wp'),
									'desc' => __('Enable or disable the sticky menu.', 'luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'custom-sticky-color',
									'type' => 'switch',
									'label' => __('Custom Sticky Color', 'luxury-wp'),
									'dependency' => array('element'=>'sticky-menu','value'=>array('1')),
									'desc' => __('Custom sticky menu color scheme ?', 'luxury-wp'),
									'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'sticky-menu-bg',
									'type' => 'color',
									'label' => __('Sticky menu background', 'luxury-wp'),
									'dependency' => array('element'=>'custom-sticky-color','value'=>array('1')),
									'value' => ''
							),
							array(
									'name' => 'sticky-menu-color',
									'type' => 'color',
									'label' => __('Sticky menu color', 'luxury-wp'),
									'dependency' => array('element'=>'custom-sticky-color','value'=>array('1')),
									'value' => ''
							),
							array(
								'name' => 'sticky-menu-hover-color',
								'type' => 'color',
								'label' => __('Sticky menu hover color', 'luxury-wp'),
								'dependency' => array('element'=>'custom-sticky-color','value'=>array('1')),
								'value' => ''
							),
// 							array(
// 									'name' => 'menu-transparent',
// 									'type' => 'switch',
// 									'label' => __('Transparent Main Menu', 'luxury-wp'),
// 									'desc' => __('Enable or disable main menu background transparency', 'luxury-wp'),
// 									'value' => '0' // 1 = checked | 0 = unchecked
// 							),
							
							array(
								'name' => 'header-left-social',
								'type' => 'muitl-select',
								'label' => __('Header Social Icon','luxury-wp'),
								'dependency' => array(),
								'value' => array('facebook','twitter','google-plus','pinterest','rss','instagram'),
								'options'=>array(
									'facebook'=>'Facebook',
									'twitter'=>'Twitter',
									'google-plus'=>'Google Plus',
									'pinterest'=>'Pinterest',
									'linkedin'=>'Linkedin',
									'rss'=>'Rss',
									'instagram'=>'Instagram',
									'github'=>'Github',
									'behance'=>'Behance',
									'stack-exchange'=>'Stack Exchange',
									'tumblr'=>'Tumblr',
									'soundcloud'=>'SoundCloud',
									'dribbble'=>'Dribbble',
									'youtube'=>'Youtube'
								),
							),
							array(
								'name' => 'show-heading',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Show Heading','luxury-wp'),
								'desc' => __('Show or hide heading in site.', 'luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array (
								'name' => 'heading-bg',
								'type' => 'image',
								'dependency' => array('element'=>'show-heading','value'=>array('1')),
								'desc'=>__('Change Heading background','luxury-wp'),
								'label' => __ ( 'Heading background', 'luxury-wp' ),
							),
							array(
								'name' => 'breadcrumb',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'dependency' => array('element'=>'show-heading','value'=>array('1')),
								'label' => __('Show breadcrumb','luxury-wp'),
								'desc' => __('Enable or disable the site path under the page title.', 'luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'header_color_setting',
								'type' => 'heading',
								'text' => __('Header Color Scheme','luxury-wp'),
							),
							array(
									'name' => 'header-color',
									'type' => 'switch',
									'label' => __('Header Color Scheme', 'luxury-wp'),
									'desc' => __('Custom Topbar and Main menu color scheme .', 'luxury-wp'),
									'value'=>'0'
							),
							array(
									'name' => 'header-custom-color',
									'type' => 'list_color',
									'dependency' => array('element'=>'header-color','value'=>array('1')),
									'options' => array(
										'topbar-bg'=>__('Topbar Background','luxury-wp'),
										'topbar-font'=>__('Topbar Color','luxury-wp'),
										'topbar-link'=>__('Topbar Link Color','luxury-wp'),
										'header-bg'=>__('Header Background','luxury-wp'),
										'header-color'=>__('Header Color','luxury-wp'),
										'header-hover-color'=>__('Header Hover Color','luxury-wp'),
										'navbar-bg'=>__('Navbar Background','luxury-wp'),
										'navbar-font'=>__('Navbar Color','luxury-wp'),
										'navbar-font-hover'=>__('Navbar Color Hover','luxury-wp'),
										'navbar-dd-border'=>__('Navbar Dropdown Border','luxury-wp'),
										'navbar-dd-link-border'=>__('Navbar Dropdown Item Border','luxury-wp'),
										'navbar-dd-bg'=>__('Navbar Dropdown Background','luxury-wp'),
										'navbar-dd-hover-bg'=>__('Navbar Dropdown Hover Background','luxury-wp'),
										'navbar-dd-font'=>__('Navbar Dropdown Color','luxury-wp'),
										'navbar-dd-font-hover'=>__('Navbar Dropdown Color Hover','luxury-wp'),
										'navbar-dd-mm-title'=>__('Navbar Dropdown Mega Menu Title','luxury-wp'),
									)
							),
					)
			),
			'footer'=>array(
					'icon' => 'fa fa-list-alt',
					'title' => __ ( 'Footer', 'luxury-wp' ),
					'desc' => __ ( '<p class="description">Customize Footer.</p>', 'luxury-wp' ),
					'fields'=>array(
						array(
							'name' => 'footer-fixed',
							'type' => 'switch',
							'on'	=> __('Yes','luxury-wp'),
							'off'	=> __('No','luxury-wp'),
							'label' => __('Footer Fixed','luxury-wp'),
							'desc' => __('Do you want use Footer Fixed style.', 'luxury-wp'),
							'value' => '0' // 1 = checked | 0 = unchecked
						),
						array(
							'name' => 'footer-instagram',
							'type' => 'switch',
							'label' => __('Show Instagram in Footer','luxury-wp'),
							'value' => '0' // 1 = checked | 0 = unchecked
						),
						array(
							'name' => 'footer-instagram-title',
							'type' => 'text',
							'value'=>'Instagram',
							'dependency' => array('element'=>'footer-instagram','value'=>array('1')),
							'label' => __('Instagram Titlte','luxury-wp'),
						),
						array(
							'name' => 'footer-instagram-user',
							'type' => 'text',
							'value'=>'Sitesao_fashion',
							'dependency' => array('element'=>'footer-instagram','value'=>array('1')),
							'label' => __('Instagram User','luxury-wp'),
						),
						array(
								'name' => 'footer-area',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Footer Widget Area','luxury-wp'),
								'desc' => __('Do you want use the main footer that contains all the widgets areas.', 'luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
								'name' => 'footer-area-columns',
								'type' => 'image_select',
								'label' => __('Footer Area Columns', 'luxury-wp'),
								'desc' => __('Please select the number of columns you would like for your footer.', 'luxury-wp'),
								'dependency' => array('element'=>'footer-area','value'=>array('1')),
								'options' => array(
										'2' => array('alt' => '2 Column', 'img' => DHINC_ASSETS_URL.'/images/2col.png'),
										'3' => array('alt' => '3 Column', 'img' => DHINC_ASSETS_URL.'/images/3col.png'),
										'4' => array('alt' => '4 Column', 'img' => DHINC_ASSETS_URL.'/images/4col.png'),
										'5' => array('alt' => '5 Column', 'img' => DHINC_ASSETS_URL.'/images/5col.png'),
								),
								'value' => '4'
						),
						array (
								'name' => 'footer-area-columns-bg',
								'type' => 'image',
								'dependency' => array('element'=>'footer-area','value'=>array('1')),
								'desc'=>__('Footer Area Columns Background Image','luxury-wp'),
								'label' => __ ( 'Footer Area Background', 'luxury-wp' ),
							),
						array(
							'name' => 'footer-newsletter',
							'type' => 'switch',
							'on'	=> __('Show','luxury-wp'),
							'off'	=> __('Hide','luxury-wp'),
							'label' => __('Footer Newsletter','luxury-wp'),
							'desc' => __('Do you want use Mailchimp newsletter form in footer.', 'luxury-wp'),
							'value' => '0' // 1 = checked | 0 = unchecked
						),
						array(
							'name' => 'footer-menu',
							'type' => 'switch',
							'on'	=> __('Show','luxury-wp'),
							'off'	=> __('Hide','luxury-wp'),
							'label' => __('Footer Menu','luxury-wp'),
							'desc' => __('Do you want use menu in footer.', 'luxury-wp'),
							'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
							'name' => 'footer-info',
							'type' => 'text',
							'label' => __('Footer Info','luxury-wp'),
							'value' => 'Copyright © 2015 Designed by <a href="http://sitesao.com/">Sitesao</a>. All rights reserved.'
						),
						array(
							'name' => 'footer-social',
							'type' => 'muitl-select',
							'label' => __('Footer Social Icon','luxury-wp'),
							'options'=>array(
								'facebook'=>'Facebook',
								'twitter'=>'Twitter',
								'google-plus'=>'Google Plus',
								'pinterest'=>'Pinterest',
								'linkedin'=>'Linkedin',
								'rss'=>'Rss',
								'instagram'=>'Instagram',
								'github'=>'Github',
								'behance'=>'Behance',
								'stack-exchange'=>'Stack Exchange',
								'tumblr'=>'Tumblr',
								'soundcloud'=>'SoundCloud',
								'dribbble'=>'Dribbble',
								'youtube'=>'Youtube'
							),
						),
						
						array(
							'name' => 'footer_color_setting',
							'type' => 'heading',
							'text' => __('Footer Color Scheme','luxury-wp'),
						),
						array(
								'name' => 'footer-color',
								'type' => 'switch',
								'label' => __('Custom Footer Color Scheme','luxury-wp'),
								'value' => '0' // 1 = checked | 0 = unchecked
						),
						array(
								'name' => 'footer-custom-color',
								'type' => 'list_color',
								'dependency' => array('element'=>'footer-color','value'=>array('1')),
								'options' => array(
										'footer-widget-bg'=>__('Footer Widget Area Background','luxury-wp'),
										'footer-widget-color'=>__('Footer Widget Area Color','luxury-wp'),
										'footer-widget-link'=>__('Footer Widget Area Link','luxury-wp'),
										'footer-widget-link-hover'=>__('Footer Widget Area Link Hover','luxury-wp'),
										'footer-bg'=>__('Footer Info Background','luxury-wp'),
										'footer-color'=>__('Footer Info Color','luxury-wp'),
										'footer-link'=>__('Footer Info Link','luxury-wp'),
										'footer-link-hover'=>__('Footer Info Link Hover','luxury-wp'),
								)
						),
					)
			),
			'blog'=>array(
					'icon' => 'fa fa-pencil',
					'title' => __ ( 'Blog', 'luxury-wp' ),
					'desc' => __ ( '<p class="description">Customize Blog.</p>', 'luxury-wp' ),
					'fields'=>array(
							array(
								'name' => 'list_blog_setting',
								'type' => 'heading',
								'text' => __('Main Blog Settings','luxury-wp'),
							),
							array(
									'name' => 'blog-layout',
									'type' => 'image_select',
									'label' => __('Main Blog Layout', 'luxury-wp'),
									'desc' => __('Select main blog layout. Choose between 1, 2 or 3 column layout.', 'luxury-wp'),
									'options' => array(
											'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
											'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
											'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
									),
									'value' => 'full-width'
							),
							array(
								'name' => 'blogs-main-style',
								'type' => 'select',
								'label' => __('Main Blog Style', 'luxury-wp'),
								'desc' => __('How your blog posts will display.', 'luxury-wp'),
								'options' => array(
									'default'=>__('Default','luxury-wp'),
									'zigzag'=>__('Zigzag','luxury-wp'),
									'grid'=>__('Grid','luxury-wp'),
									'masonry'=>__('Masonry','luxury-wp'),
									'center'=>__('Center','luxury-wp'),
								),
								'value' => 'default'
							),
							array(
								'name' => 'blogs-main-grid-first',
								'type' => 'switch',
								'dependency' => array('element'=>'blogs-main-style','value'=>array('grid')),
								'on'	=> __('Yes','luxury-wp'),
								'off'	=> __('No','luxury-wp'),
								'label' => __('Full First Item','luxury-wp'),
								'desc'=>__('Show full item in Grid layout','luxury-wp'),
								'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blogs-main-grid-no-border',
								'type' => 'switch',
								'dependency' => array('element'=>'blogs-main-style','value'=>array('grid')),
								'on'	=> __('Yes','luxury-wp'),
								'off'	=> __('No','luxury-wp'),
								'label' => __('Grid Style no Border','luxury-wp'),
								'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'archive_blog_setting',
								'type' => 'heading',
								'text' => __('Archive Page Settings','luxury-wp'),
							),
							array(
								'name' => 'archive-layout',
								'type' => 'image_select',
								'label' => __('Archive Layout', 'luxury-wp'),
								'desc' => __('Select Archive layout. Choose between 1, 2 or 3 column layout.', 'luxury-wp'),
								'options' => array(
									'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
									'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
									'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
								),
								'value' => 'full-width'
							),
							array(
									'name' => 'blogs-style',
									'type' => 'select',
									'label' => __('Archive Style', 'luxury-wp'),
									'desc' => __('How your blog posts will display.', 'luxury-wp'),
									'options' => array(
											'default'=>__('Default','luxury-wp'),
											'zigzag'=>__('Zigzag','luxury-wp'),
											'grid'=>__('Grid','luxury-wp'),
											'masonry'=>__('Masonry','luxury-wp'),
											'center'=>__('Center','luxury-wp'),
									),
									'value' => 'default'
							),
							array(
									'name' => 'blogs-grid-first',
									'type' => 'switch',
									'dependency' => array('element'=>'blogs-style','value'=>array('grid')),
									'on'	=> __('Yes','luxury-wp'),
									'off'	=> __('No','luxury-wp'),
									'label' => __('Full First Item','luxury-wp'),
									'desc'=>__('Show full item in Grid layout','luxury-wp'),
									'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blogs-grid-no-border',
								'type' => 'switch',
								'dependency' => array('element'=>'blogs-style','value'=>array('grid')),
								'on'	=> __('Yes','luxury-wp'),
								'off'	=> __('No','luxury-wp'),
								'label' => __('Grid Style no Border','luxury-wp'),
								'value' => '0' // 1 = checked | 0 = unchecked
							),
							
							array(
								'name' => 'blog_setting',
								'type' => 'heading',
								'text' => __('Blog Meta Settings','luxury-wp'),
							),
							array(
								'name' => 'blogs-columns',
								'type' => 'image_select',
								'label' => __('Blogs Grid/Masonry Columns', 'luxury-wp'),
								'desc' => __('Select blogs columns.', 'luxury-wp'),
								'options' => array(
									'2' => array('alt' => '2 Column', 'img' => DHINC_ASSETS_URL.'/images/2col.png'),
									'3' => array('alt' => '3 Column', 'img' => DHINC_ASSETS_URL.'/images/3col.png'),
									'4' => array('alt' => '4 Column', 'img' => DHINC_ASSETS_URL.'/images/4col.png'),
								),
								'value' => '3'
							),
							array(
									'type' => 'select',
									'label' => __( 'Pagination', 'luxury-wp' ),
									'name' => 'blogs-pagination',
									'options'=>array(
											'page_num'=>__('Page Number','luxury-wp'),
											'next_prev'=>__('Next/Previous Button','luxury-wp'),
											'loadmore'=>__('Load More Button','luxury-wp'),
											'infinite_scroll'=>__('Infinite Scrolling','luxury-wp'),
											'no'=>__('No','luxury-wp'),
									),
									'value'=>'page_num',
									'desc' => __( 'Choose pagination type.', 'luxury-wp' ),
							),
							array(
									'type' => 'text',
									'label' => __( 'Load More Button Text', 'luxury-wp' ),
									'name' => 'blogs-loadmore-text',
									'dependency'  => array( 'element' => "blog-pagination", 'value' => array( 'loadmore' ) ),
									'value'		=>__('Load More','luxury-wp')
							),
							
							array(
									'name' => 'blogs-show-post-title',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Show/Hide Title','luxury-wp'),
									'desc'=>__('In Archive Blog. Show/Hide the post title below the featured','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'blogs-link-post-title',
									'type' => 'switch',
									'label' => __('Link Title To Post','luxury-wp'),
									'desc'=>__('In Archive Blog. Choose if the title should be a link to the single post page.','luxury-wp'),
									'dependency' => array('element'=>'blogs-show-post-title','value'=>array('1')),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'blogs-show-featured',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Show Featured Image','luxury-wp'),
									'desc'=>__('In Archive Blog. Show/Hide the post featured Image','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blogs-excerpt-length',
								'type' => 'text',
								'label' => __('Excerpt Length','luxury-wp'),
								'dependency' => array( 'element' => "blog-style", 'value' => array( 'default','medium','grid','masonry' ) ),
								'desc'=>__('In Archive Blog. Enter the number words excerpt','luxury-wp'),
								'value' => 30
							),
							array(
									'name' => 'blogs-show-date',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Date Meta','luxury-wp'),
									'desc'=>__('In Archive Blog. Show/Hide the date meta','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'blogs-show-comment',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Comment Meta','luxury-wp'),
									'desc'=>__('In Archive Blog. Show/Hide the comment meta','luxury-wp'),
									'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'blogs-show-category',
									'type' => 'switch',
									'label' => __('Show/Hide Category','luxury-wp'),
									'desc'=>__('In Archive Blog. Show/Hide the category meta','luxury-wp'),
									'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blogs-show-author',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'dependency' => array( 'element' => "blog-style", 'value' => array( 'default','medium','grid','masonry' ) ),
								'label' => __('Author Meta','luxury-wp'),
								'desc'=>__('In Archive Blog. Show/Hide the author meta','luxury-wp'),
								'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'blogs-show-tag',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'dependency' => array( 'element' => "blog-style", 'value' => array( 'default','medium','grid','masonry' ) ),
									'label' => __('Tags','luxury-wp'),
									'desc'=>__('In Archive Blog. If enabled it will show tag.','luxury-wp'),
									'value' => '0' // 1 = checked | 0 = unchecked
							),
							
							array(
									'name' => 'blogs-show-readmore',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'dependency' => array( 'element' => "blog-style", 'value' => array( 'default','medium','grid','masonry' ) ),
									'label' => __('Show/Hide Readmore','luxury-wp'),
									'desc'=>__('In Archive Blog. Show/Hide the post readmore','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'single_page_setting',
								'type' => 'heading',
								'text' => __('Single Page Settings','luxury-wp'),
							),
							//as--
							array(
								'name' => 'comment-page',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Page Comment','luxury-wp'),
								'desc'=>__('Show/hide comment form in single page ?','luxury-wp'),
								'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'single_blog_setting',
								'type' => 'heading',
								'text' => __('Single Blog Settings','luxury-wp'),
							),
							array(
								'name' => 'single-layout',
								'type' => 'image_select',
								'label' => __('Single Blog Layout', 'luxury-wp'),
								'desc' => __('Select single content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'luxury-wp'),
								'options' => array(
									'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
									'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
									'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
								),
								'value' => 'right-sidebar'
							),
							array(
								'name' => 'blog-show-feature',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Feature Image','luxury-wp'),
								'desc'=>__('In Single Blog. Show/Hide the feature image','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blog-show-date',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Date Meta','luxury-wp'),
								'desc'=>__('In Single Blog. Show/Hide the date meta','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blog-show-comment',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Comment Meta','luxury-wp'),
								'desc'=>__('In Single Blog. Show/Hide the comment meta','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blog-show-category',
								'type' => 'switch',
								'label' => __('Show/Hide Category','luxury-wp'),
								'desc'=>__('In Single Blog. Show/Hide the category','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blog-show-author',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Author Meta','luxury-wp'),
								'desc'=>__('In Single Blog. Show/Hide the author meta','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
								'name' => 'blog-show-tag',
								'type' => 'switch',
								'on'	=> __('Show','luxury-wp'),
								'off'	=> __('Hide','luxury-wp'),
								'label' => __('Show/Hide Tag','luxury-wp'),
								'desc'=>__('In Single Blog. If enabled it will show tag.','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
							),
						//as--
							array(
									'name' => 'show-authorbio',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Show Author Bio','luxury-wp'),
									'desc'=>__('Display the author bio at the bottom of post on single post page ?','luxury-wp'),
									'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'show-postnav',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Show Next/Prev Post Link On Single Post Page','luxury-wp'),
									'desc'=>__('Using this will add a link at the bottom of every post page that leads to the next/prev post.','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'show-related',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Show Related Post On Single Post Page','luxury-wp'),
									'desc'=>__('Display related post the bottom of posts?','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'show-post-share',
									'type' => 'switch',
									'on'	=> __('Show','luxury-wp'),
									'off'	=> __('Hide','luxury-wp'),
									'label' => __('Show Sharing Button','luxury-wp'),
									'desc'=>__('Activate this to enable social sharing buttons on single post page.','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'post-fb-share',
									'type' => 'switch',
									'dependency' => array('element'=>'show-post-share','value'=>array('1')),
									'label' => __('Share on Facebook','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'post-tw-share',
									'type' => 'switch',
									'dependency' => array('element'=>'show-post-share','value'=>array('1')),
									'label' => __('Share on Twitter','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'post-go-share',
									'type' => 'switch',
									'dependency' => array('element'=>'show-post-share','value'=>array('1')),
									'label' => __('Share on Google+','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'post-pi-share',
									'type' => 'switch',
									'dependency' => array('element'=>'show-post-share','value'=>array('1')),
									'label' => __('Share on Pinterest','luxury-wp'),
									'value' => '0' // 1 = checked | 0 = unchecked
							),
							array(
									'name' => 'post-li-share',
									'type' => 'switch',
									'dependency' => array('element'=>'show-post-share','value'=>array('1')),
									'label' => __('Share on LinkedIn','luxury-wp'),
									'value' => '1' // 1 = checked | 0 = unchecked
							),
					)
			),
		); 
		if(defined('WOOCOMMERCE_VERSION')){
			$section['woocommerce'] = array(
				'icon' => 'fa fa-shopping-cart',
				'title' => __ ( 'Woocommerce', 'luxury-wp' ),
				'desc' => __ ( '<p class="description">Customize Woocommerce.</p>', 'luxury-wp' ),
				'fields'=>array(
						array(
							'name' => 'woo-cart-nav',
							'type' => 'switch',
							'on'	=> __('Show','luxury-wp'),
							'off'	=> __('Hide','luxury-wp'),
							'label' => __('Cart In header','luxury-wp'),
							'desc'=>__('This will show cat in header.','luxury-wp'),
							'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
							'name' => 'woo-cart-mobile',
							'type' => 'switch',
							'on'	=> __('Show','luxury-wp'),
							'off'	=> __('Hide','luxury-wp'),
							'label' => __('Mobile Cart Icon','luxury-wp'),
							'desc'=>__('This will show on mobile menu a shop icon with the number of cart items.','luxury-wp'),
							'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
							'name' => 'woo-minicart-style',
							'type' => 'select',
							'label' => __('Minicart Style', 'luxury-wp'),
							'desc' => __('Minicart Style.', 'luxury-wp'),
							'dependency'  => array( 'element' => "woo-cart-nav", 'value' => array( '1' ) ),
							'options' => array(
								'side' => __('Side','luxury-wp'),
								'mini' => __('Mini','luxury-wp'),
							),
							'value' => 'mini'
						),
						array(
							'name' => 'woo-lazyload',
							'type' => 'switch',
							'on'	=> __('Yes','luxury-wp'),
							'off'	=> __('No','luxury-wp'),
							'label' => __('Product Image Lazy Loading','luxury-wp'),
							'desc'=>__('Lazy load product catalog images when scrolling down the page.','luxury-wp'),
							'value' => '0' // 1 = checked | 0 = unchecked
						),
						array(
							'name' => 'list_product_setting',
							'type' => 'heading',
							'text' => __('List Product Settings','luxury-wp'),
						),
						array(
								'name' => 'woo-shop-layout',
								'type' => 'image_select',
								'label' => __('Shop Layout', 'luxury-wp'),
								'desc' => __('Select shop layout.', 'luxury-wp'),
								'options' => array(
										'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
										'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
										'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
								),
								'value' => 'left-sidebar'
						),	
						array(
								'name' => 'woo-category-layout',
								'type' => 'image_select',
								'label' => __('Product Category Layout', 'luxury-wp'),
								'desc' => __('Select product category layout.', 'luxury-wp'),
								'options' => array(
										'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
										'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
										'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
								),
								'value' => 'left-sidebar'
						),
						array(
							'name' => 'woo-tag-layout',
							'type' => 'image_select',
							'label' => __('Product Tag Layout', 'luxury-wp'),
							'desc' => __('Select product tag layout.', 'luxury-wp'),
							'options' => array(
								'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
								'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
								'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
							),
							'value' => 'left-sidebar'
						),
						array(
							'name' => 'woo-brand-layout',
							'type' => 'image_select',
							'label' => __('Product Brand Layout', 'luxury-wp'),
							'desc' => __('Select product brand layout.', 'luxury-wp'),
							'options' => array(
								'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
								'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
								'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
							),
							'value' => 'left-sidebar'
						),
						array(
							'name' => 'woo-lookbook-layout',
							'type' => 'image_select',
							'label' => __('Product lookbook Layout', 'luxury-wp'),
							'desc' => __('Select product lookbook layout.', 'luxury-wp'),
							'options' => array(
								'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
								'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
								'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
							),
							'value' => 'left-sidebar'
						),
						array (
							'name' => 'dh_woocommerce_view_mode',
							'type' => 'buttonset',
							'label' => __ ( 'Default View Mode', 'luxury-wp' ),
							'desc'=>__('Select default view mode','luxury-wp'),
							'value'=>'grid',
							'options'=>array(
								'grid'=> __('Grid','luxury-wp'),
								'list'=> __('List','luxury-wp')
							)
						),
						array(
							'type' => 'select',
							'label' => __( 'Grid Product Style', 'luxury-wp' ),
							'name' => 'woo-grid-product-style',
							'options' => array(
									'style-1'=>__('Style 1','luxury-wp'),
									'style-2'=>__('Style 2','luxury-wp'),
									'style-3'=>__('Style 3','luxury-wp'),
							),
							'dependency'  => array( 'element' => "dh_woocommerce_view_mode", 'value' => array( 'grid' ) ),
							'value'=>'style-1',
							'desc' => __( 'Choose grid product style.', 'luxury-wp' ),
						),
						array(
							'name' => 'woo-list-rating',
							'type' => 'switch',
							'on'	=> __('Show','luxury-wp'),
							'off'	=> __('Hide','luxury-wp'),
							'label' => __('Product List Rating','luxury-wp'),
							'desc'=>__('This will show on rating on list products.','luxury-wp'),
							'value' => '0' // 1 = checked | 0 = unchecked
						),
						array(
							'name' => 'woo-shop-filter',
							'type' => 'select',
							'label' => __('User Shop Ajax Filter','luxury-wp'),
							'desc'=>__('Show/hide shop ajax filter in shop or Product Taxonomy archive page.','luxury-wp'),
							'options' => array(
								'0'=>__('Hide','luxury-wp'),
								'shop'=>__('Only Shop','luxury-wp'),
								'taxonomy'=>__('Only Product Taxonomy archive Page','luxury-wp'),
								'all'=>__('Shop and Category Page','luxury-wp'),
							),
							'value' => '0' // 1 = checked | 0 = unchecked
						),
						
						array(
							'type' => 'select',
							'label' => __( 'Pagination', 'luxury-wp' ),
							'name' => 'woo-products-pagination',
							'options'		=>array(
								'page_num'=>__('Page Number','luxury-wp'),
								'loadmore'=>__('Load More Button','luxury-wp'),
								'infinite_scroll'=>__('Infinite Scrolling','luxury-wp'),
							),
							'value'=>'page_num',
							'desc' => __( 'Choose pagination type.', 'luxury-wp' ),
						),
						array(
							'type' => 'text',
							'label' => __( 'Load More Button Text', 'luxury-wp' ),
							'name' => 'woo-products-loadmore-text',
							'dependency'  => array( 'element' => "woo-products-pagination", 'value' => array( 'loadmore' ) ),
							'value'		=>__('Load More','luxury-wp')
						),
						array(
							'type' => 'select',
							'label' => __( 'List Products per Rows', 'luxury-wp' ),
							'name' => 'woo-per-row',
							'value'=>3,
							'options'=>array(
								'2'=>2,
								'3'=>3,
								'4'=>4,
								'5'=>5,
								'6'=>6,
							),
							'desc' => __( 'Choose Products per Rows.', 'luxury-wp' ),
						),
							
						array(
							'name' => 'woo-gap',
							'type' => 'text',
							'value'=>15,
							'label' => __('Products Gap (px)','luxury-wp'),
							'desc'=>__('Enter gap for each product in lists.','luxury-wp')
						),
						array(
								'name' => 'woo-per-page',
								'type' => 'text',
								'value'=>12,	
								'label' => __('Number of Products per Page','luxury-wp'),
								'desc'=>__('Enter the products of posts to display per page.','luxury-wp')
						),
						array(
							'name' => 'single_product_setting',
							'type' => 'heading',
							'text' => __('Single Product Settings','luxury-wp'),
						),
						array(
							'name' => 'woo-product-layout',
							'type' => 'image_select',
							'label' => __('Single Product Layout', 'luxury-wp'),
							'desc' => __('Select single product layout.', 'luxury-wp'),
							'options' => array(
								'full-width' => array('alt' => 'No sidebar', 'img' => DHINC_ASSETS_URL.'/images/1col.png'),
								'left-sidebar' => array('alt' => '2 Column Left', 'img' => DHINC_ASSETS_URL.'/images/2cl.png'),
								'right-sidebar' => array('alt' => '2 Column Right', 'img' => DHINC_ASSETS_URL.'/images/2cr.png'),
							),
							'value' => 'full-width'
						),
						array(
							'name' => 'single-product-style',
							'type' => 'select',
							'label' => __('Single Product style', 'luxury-wp'),
							'desc' => __('Select Single Product style.', 'luxury-wp'),
							'value'=>'style-1',
							'options' => array(
								'style-1' => __('Default','luxury-wp'),
								'style-2' => __('Classic','luxury-wp'),
								'style-3' => __('Full width and No Thumbnails','luxury-wp'),
							),
						),
						array(
							'name' => 'single-product-popup',
							'type' => 'select',
							'label' => __('Single Product Popup Type', 'luxury-wp'),
							'desc' => __('Select Single Product Popup Type.', 'luxury-wp'),
							'value'=>'popup',
							'options' => array(
								'popup' => __('Popup','luxury-wp'),
								'easyzoom' => __('Zoom','luxury-wp'),
							),
						),
						array(
								'name' => 'show-woo-meta',
								'type' => 'switch',
								'label' => __('Show Single Product Meta','luxury-wp'),
								'desc'=>__('Activate this to enable product meta.','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
								'name' => 'show-woo-share',
								'type' => 'switch',
								'label' => __('Show Sharing Button','luxury-wp'),
								'desc'=>__('Activate this to enable social sharing buttons.','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
								'name' => 'woo-fb-share',
								'type' => 'switch',
								'dependency' => array('element'=>'show-woo-share','value'=>array('1')),
								'label' => __('Share on Facebook','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
								'name' => 'woo-tw-share',
								'type' => 'switch',
								'dependency' => array('element'=>'show-woo-share','value'=>array('1')),
								'label' => __('Share on Twitter','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
								'name' => 'woo-go-share',
								'type' => 'switch',
								'dependency' => array('element'=>'show-woo-share','value'=>array('1')),
								'label' => __('Share on Google+','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
						),
						array(
								'name' => 'woo-pi-share',
								'type' => 'switch',
								'dependency' => array('element'=>'show-woo-share','value'=>array('1')),
								'label' => __('Share on Pinterest','luxury-wp'),
								'value' => '0' // 1 = checked | 0 = unchecked
						),
						array(
								'name' => 'woo-li-share',
								'type' => 'switch',
								'dependency' => array('element'=>'show-woo-share','value'=>array('1')),
								'label' => __('Share on LinkedIn','luxury-wp'),
								'value' => '1' // 1 = checked | 0 = unchecked
						),
						
				)
			);
		}
		$section['social_api'] = array(
			'icon' => 'fa fa-cloud-upload',
			'title' => __ ( 'Social API', 'luxury-wp' ),
			'desc' => __ ( '<p class="description">Social API', 'luxury-wp' ),
			'fields'=>array(
				array(
					'name' => 'facebbook_login_heading',
					'type' => 'heading',
					'text' => __('Facebook Login Settings','luxury-wp'),
				),
				array(
					'name' => 'facebook_login',
					'type' => 'switch',
					'value'=>'0',
					'label' => __('Use Facebook login','luxury-wp'),
					'desc'=>__('Enable or disable Login/Register with Facebook','luxury-wp')
				),
				array(
					'name' => 'facebook_app_id',
					'type' => 'text',
					'dependency' => array('element'=>'facebook_login','value'=>array('1')),
					'label' => __('Facebook App ID','luxury-wp'),
					'desc'=>sprintf(__('Use Facebook login you need to enter your Facebook App ID. If you don\'t have one, you can create it from: <a target="_blank" href="%s">Here</a>','luxury-wp'),'https://developers.facebook.com/apps')
				),
				array(
					'name' => 'mailchimp_heading',
					'type' => 'heading',
					'text' => __('MailChimp Settings','luxury-wp'),
				),
				array(
					'name' => 'mailchimp_api',
					'type' => 'text',
					'label' => __('MailChimp API Key','luxury-wp'),
					'desc'=>sprintf(__('Enter your API Key.<a target="_blank" href="%s">Get your API key</a>','luxury-wp'),'http://admin.mailchimp.com/account/api-key-popup')
				),
				array(
					'name' => 'mailchimp_list',
					'type' => 'select',
					'options'=>dh_get_mailchimplist(),
					'label' => __('MailChimp List','luxury-wp'),
					'desc'=>__('After you add your MailChimp API Key above and save it this list will be populated.','luxury-wp')
				),
				array(
					'name' => 'mailchimp_opt_in',
					'type' => 'switch',
					'label' => __('Enable Double Opt-In','luxury-wp'),
					'desc'=>sprintf(__('Learn more about <a target="_blank" href="%s">Double Opt-in</a>.','luxury-wp'),'http://kb.mailchimp.com/article/how-does-confirmed-optin-or-double-optin-work')
				),
				array(
					'name' => 'mailchimp_welcome_email',
					'type' => 'switch',
					'label' => __('Send Welcome Email','luxury-wp'),
					'desc'=>sprintf(__('If your Double Opt-in is false and this is true, MailChimp will send your lists Welcome Email if this subscribe succeeds - this will not fire if MailChimp ends up updating an existing subscriber. If Double Opt-in is true, this has no effect. Learn more about <a target="_blank" href="%s">Welcome Emails</a>.','luxury-wp'),'http://blog.mailchimp.com/sending-welcome-emails-with-mailchimp/')
				),
				array(
					'name' => 'mailchimp_group_name',
					'type' => 'text',
					'label' => __('MailChimp Group Name','luxury-wp'),
					'desc'=>sprintf(__('Optional: Enter the name of the group. Learn more about <a target="_blank" href="%s">Groups</a>','luxury-wp'),'http://mailchimp.com/features/groups/')
				),
				array(
					'name' => 'mailchimp_group',
					'type' => 'text',
					'label' => __('MailChimp Group','luxury-wp'),
					'desc'=>__('Optional: Comma delimited list of interest groups to add the email to.','luxury-wp')
				),
				array(
					'name' => 'mailchimp_replace_interests',
					'type' => 'switch',
					'label' => __('MailChimp Replace Interests','luxury-wp'),
					'desc'=>__('Whether MailChimp will replace the interest groups with the groups provided or add the provided groups to the member interest groups.','luxury-wp')
				),
				array(
					'name' => 'mailchimp_hr',
					'type' => 'hr',
				)
			)
		);
		$section['social'] = array(
			'icon' => 'fa fa-twitter',
			'title' => __ ( 'Social Profile', 'luxury-wp' ),
			'desc' => __ ( '<p class="description">Enter in your profile media locations here.<br><strong>Remember to include the "http://" in all URLs!</strong></p>', 'luxury-wp' ),
			'fields'=>array(
				array(
						'name' => 'facebook-url',
						'type' => 'text',
						'label' => __('Facebook URL','luxury-wp'),
				),
				array(
						'name' => 'twitter-url',
						'type' => 'text',
						'label' => __('Twitter URL','luxury-wp'),
				),
				array(
						'name' => 'google-plus-url',
						'type' => 'text',
						'label' => __('Google+ URL','luxury-wp'),
				),
				array(
						'name' => 'pinterest-url',
						'type' => 'text',
						'label' => __('Pinterest URL','luxury-wp'),
				),
				array(
						'name' => 'linkedin-url',
						'type' => 'text',
						'label' => __('LinkedIn URL','luxury-wp'),
				),
				array(
						'name' => 'rss-url',
						'type' => 'text',
						'label' => __('RSS URL','luxury-wp'),
				),
				array(
						'name' => 'instagram-url',
						'type' => 'text',
						'label' => __('Instagram URL','luxury-wp'),
				),
				array(
					'name' => 'youtube-url',
					'type' => 'text',
					'label' => __('Youtube URL','luxury-wp'),
				),
				array(
						'name' => 'github-url',
						'type' => 'text',
						'label' => __('GitHub URL','luxury-wp'),
				),		
				array(
						'name' => 'behance-url',
						'type' => 'text',
						'label' => __('Behance URL','luxury-wp'),
				),
				array(
						'name' => 'stack-exchange-url',
						'type' => 'text',
						'label' => __('Stack Exchange URL','luxury-wp'),
				),
				array(
						'name' => 'tumblr-url',
						'type' => 'text',
						'label' => __('Tumblr URL','luxury-wp'),
				),
				array(
						'name' => 'soundcloud-url',
						'type' => 'text',
						'label' => __('SoundCloud URL','luxury-wp'),
				),
				array(
						'name' => 'dribbble-url',
						'type' => 'text',
						'label' => __('Dribbble URL','luxury-wp'),
				),
			)
		);
		$section['import_export'] = array(
				'icon' => 'fa fa-download',
				'title' => __ ( 'Import and Export', 'luxury-wp' ),
				'fields'=>array(
					array(
							'name' => 'import',
							'type' => 'import',
							'field-label'=>__('Input your backup file below and hit Import to restore your sites options from a backup.','luxury-wp'),
					),
					array(
							'name' => 'export',
							'type' => 'export',
							'field-label'=>__('Here you can download your current option settings.You can use it to restore your settings on this site (or any other site).','luxury-wp'),
					),
				)
		);
		$section['custom_code'] = array(
				'icon' => 'fa fa-code',
				'title' => __ ( 'Custom Code', 'luxury-wp' ),
				'fields'=>array(
					array(
						'name' => 'custom-css',
						'type' => 'ace_editor',
						'label' => __('Custom CSS Code','luxury-wp'),
						'desc'=>__('Paste your CSS code, do not include any tags or HTML in thie field. Any custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed.','luxury-wp'),
					),
					array(
						'name' => 'space-head',
						'type' => 'textarea_code',
						'label' => __('Space before </head>','luxury-wp'),
						'desc'=>__('Add code before the </head> tag.','luxury-wp'),
					),
					array(
						'name' => 'space-body',
						'type' => 'textarea_code',
						'label' => __('Space before </body>','luxury-wp'),
						'desc'=>__('Add code before the </body> tag.','luxury-wp'),
					),
				)
		);
		return apply_filters('dh_theme_option_sections', $section);
	}
	
	public function enqueue_scripts(){
		wp_enqueue_style('chosen');
		wp_enqueue_style('font-awesome');
		wp_enqueue_style('jquery-ui-bootstrap');
		wp_enqueue_style('dh-theme-options',DHINC_ASSETS_URL.'/css/theme-options.css',null,DHINC_VERSION);
		wp_register_script('dh-theme-options',DHINC_ASSETS_URL.'/js/theme-options.js',array('jquery','underscore','jquery-ui-button','jquery-ui-tooltip','chosen','ace-editor'),DHINC_VERSION,true);
		$dhthemeoptionsL10n = array(
			'reset_msg'=>esc_js(__('You want reset all options ?','luxury-wp'))
		);
		wp_localize_script('dh-theme-options', 'dhthemeoptionsL10n', $dhthemeoptionsL10n);
		wp_enqueue_script('dh-theme-options');
	}
	
	public function admin_menu(){
		$option_page = add_theme_page( __('Theme Options','luxury-wp'), __('Theme Options','luxury-wp'), 'edit_theme_options', 'theme-options', array(&$this,'option_page'));
		// Add framework functionaily to the head individually
		add_action("admin_print_styles-$option_page", array(&$this,'admin_load_page'));
	}
	
	public function admin_load_page(){
		if (isset( $_GET['settings-updated'] ) && ( '1' === $_GET['settings-updated'] || 'true' === $_GET['settings-updated'] )) {
			self::buildCustomCss();
		}
		$this->enqueue_scripts();
	}
	
	public function download_theme_option(){
		if( !isset( $_GET['secret'] ) || $_GET['secret'] != md5( AUTH_KEY . SECURE_AUTH_KEY ) ) {
			wp_die( 'Invalid Secret for options use' );
			exit;
		}
		$options = get_option(self::$_option_name);
		$content = json_encode($options);
		header( 'Content-Description: File Transfer' );
		header( 'Content-type: application/txt' );
		header( 'Content-Disposition: attachment; filename="' . self::$_option_name . '_backup_' . date( 'd-m-Y' ) . '.json"' );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		echo $content;
		exit;
	}
}
new DH_ThemeOptions();
endif;