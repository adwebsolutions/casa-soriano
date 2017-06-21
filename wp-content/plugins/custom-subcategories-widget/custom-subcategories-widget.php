<?php
/**
 * Custom Subcategories Widget
 *
 * @package Custom_Subcategories_Widget
 *
 * @license     http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @version     1.2
 * Plugin Name: Custom Subcategories Widget
 * Description: Show subcategories if parent or sibling if childcategory.
 * Version:     1.0
 * Author:      Yailet
 * Text Domain: custom-subcategories-widget
 * Domain Path: /lang
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


define( 'CUSTOM_CATS_WIDGET_FILE', __FILE__ );

class custom_subcat_widget extends WP_Widget {

	// constructor
	public function custom_subcat_widget() {
		parent::WP_Widget(false, $name = __('Custom Post Categories Widget', 'wp_widget_plugin') );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
	}

	// widget form creation
	public function form($instance) {
		if( $instance) {
			$title = esc_attr($instance['title']);
		} else {
			$title = '';
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
	<?php }

	// widget update
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
    public function woocommerce_subcats_from_parent_cat_by_ID($parent_cat_ID, $current_cat_ID) {
        $args = array(
            'hierarchical' => 1,
            'show_option_none' => '',
            'hide_empty' => true,
            'parent' => $parent_cat_ID,
            'taxonomy' => 'product_cat'
        );

        $subcats = get_categories($args);

        echo '<ul class="wooc_sclist">';
        foreach ($subcats as $sc) {
            $link = get_term_link( $sc->slug, $sc->taxonomy );
            $class = ($sc->term_id == $current_cat_ID) ? 'active':'';
            echo '<li class="'.$class.'"><a href="'. $link .'">'.$sc->name.'</a></li>';
        }
        echo '</ul>';

    }
	// widget display
	public function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;?>

		<div class="widget-subcategories wp_widget_plugin_box">

	<?php
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

        $currtermid = get_queried_object()->term_id;
        $term = get_term($currtermid, 'product_cat' );

        $termid = ($term->parent > 0)?$termid = $term->parent:$currtermid;

        $this->woocommerce_subcats_from_parent_cat_by_ID($termid,$currtermid);

		echo $after_widget;
	}

	public function register_plugin_styles() {
		wp_register_style( 'custom-subcategories-widget', plugins_url( 'custom-categories-widget/inc/style.css' ) );
		wp_enqueue_style( 'custom-subcategories-widget' );
		//wp_enqueue_style('font-awesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_register_script( 'custom', plugins_url('custom-categories-widget/inc/custom.js'), array(), '1.0.0', true );
		wp_enqueue_script( 'custom' );
	}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("custom_subcat_widget");'));