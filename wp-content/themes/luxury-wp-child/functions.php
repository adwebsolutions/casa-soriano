<?php
/**
 * Child Theme Functions
 * Add custom code below
 */

if(!defined('DHINC_ASSETS_URL'))
    define( 'DHINC_ASSETS_URL', get_template_directory_uri().'/includes/assets' );

include_once get_template_directory().'/includes/functions.php';
include dirname(__FILE__) . '/includes/custom-theme-options.php';
include dirname(__FILE__) . '/includes/class-wc-widget-custom-products.php';

add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions() {
    // Require new custom Element
    require( dirname(__FILE__).'/vc-elements/wc_product_subcategory_tab.php' );
}

//Tab product
add_action( 'wp_ajax_custom_get_product_tab', array( &$this, 'get_category_tab_content' ) );
add_action( 'wp_ajax_nopriv_custom_get_product_tab', array( &$this, 'get_category_tab_content' ) );

function get_term_id ($slug){
    $term = get_term_by( 'slug', $slug, 'product_cat' );
    return $term->term_id;
}
function get_category_tab_content($cat_slug,$columns, $query){
    global $woocommerce_loop;
    global $wp_query;
    $defaults = array(
        'before'        => '',
        'after'         => '',
        'force_display' => false,
    );

    $args = wp_parse_args( $args, $defaults );
    extract( $args );

    $termId = get_term_id($cat_slug);
    if(!empty($cat_slug) && !empty($query)){
        $product_categories = get_categories( apply_filters( 'woocommerce_product_subcategories_args', array(
            'parent'       => $termId,
            'menu_order'   => 'ASC',
            'hide_empty'   => 0,
            'hierarchical' => 1,
            'taxonomy'     => 'product_cat',
            'pad_counts'   => 1,
        ) ) );
        if ( apply_filters( 'woocommerce_product_subcategories_hide_empty', true ) ) {
            $product_categories = wp_list_filter( $product_categories, array( 'count' => 0 ), 'NOT' );
        }
        if ( $product_categories ) {
            echo '<ul class="products columns-'.$columns.'" data-columns="'.$columns.'">';

            foreach ( $product_categories as $category ) {
                wc_get_template( 'content-product_cat.php', array(
                    'category' => $category,
                ) );
            }

            // If we are hiding products disable the loop and pagination
            if ( is_product_category() ) {
                $display_type = get_woocommerce_term_meta( $termId, 'display_type', true );

                switch ( $display_type ) {
                    case 'subcategories' :
                        $wp_query->post_count    = 0;
                        $wp_query->max_num_pages = 0;
                        break;
                    case '' :
                        if ( 'subcategories' === get_option( 'woocommerce_category_archive_display' ) ) {
                            $wp_query->post_count    = 0;
                            $wp_query->max_num_pages = 0;
                        }
                        break;
                }
            }

            echo '</ul>';

            return true;
        }
    }
}

/*Adapted for product brand*/
function wc_product_brand_dropdown_categories( $args = array(), $deprecated_hierarchical = 1, $deprecated_show_uncategorized = 1, $deprecated_orderby = '' ) {
    global $wp_query;

    if ( ! is_array( $args ) ) {
        wc_deprecated_argument( 'wc_product_brand_dropdown_categories()', '2.1', 'show_counts, hierarchical, show_uncategorized and orderby arguments are invalid - pass a single array of values instead.' );

        $args['show_count']         = $args;
        $args['hierarchical']       = $deprecated_hierarchical;
        $args['show_uncategorized'] = $deprecated_show_uncategorized;
        $args['orderby']            = $deprecated_orderby;
    }

    $current_product_brand = isset( $wp_query->query_vars['product_brand'] ) ? $wp_query->query_vars['product_brand'] : '';
    $defaults            = array(
        'pad_counts'         => 1,
        'show_count'         => 1,
        'hierarchical'       => 1,
        'hide_empty'         => 1,
        'show_uncategorized' => 1,
        'orderby'            => 'name',
        'selected'           => $current_product_brand,
        'menu_order'         => false,
    );

    $args = wp_parse_args( $args, $defaults );

    if ( 'order' === $args['orderby'] ) {
        $args['menu_order'] = 'asc';
        $args['orderby']    = 'name';
    }

    $terms = get_terms( 'product_brand', apply_filters( 'wc_product_dropdown_categories_get_terms_args', $args ) );

    if ( empty( $terms ) ) {
        return;
    }

    $output  = "<select name='product_brand' class='dropdown_product_cat'>";
    $output .= '<option value="" ' . selected( $current_product_brand, '', false ) . '>' . esc_html__( 'Select a brand', 'luxury-wp-child' ) . '</option>';
    $output .= wc_walk_category_dropdown_tree( $terms, 0, $args );
    if ( $args['show_uncategorized'] ) {
        $output .= '<option value="0" ' . selected( $current_product_brand, '0', false ) . '>' . esc_html__( 'Uncategorized', 'woocommerce' ) . '</option>';
    }
    $output .= "</select>";

    echo $output;
}

function wc_register_custom_widgets() {
    register_widget( 'WC_Widget_Custom_Products' );
}
add_action( 'widgets_init', 'wc_register_custom_widgets' );

function get_last_post_categories($product_id){
    $categories = get_the_terms( $product_id, 'product_cat' );

// wrapper to hide any errors from top level categories or products without category
    if ( $categories && ! is_wp_error( $categories ) ) :

        // loop through each cat
        foreach($categories as $category) :
            // get the children (if any) of the current cat
            $children = get_categories( array ('taxonomy' => 'product_cat', 'parent' => $category->term_id ));

            if ( count($children) == 0 ) {
                // if no children, then echo the category name.
                $child = '<span class="main-category"><a href="'.get_term_link($category->term_id).'">'.$category->name.'</a></span>';
            }
        endforeach;

    endif;
    echo $child;
}
add_action('woocommerce_single_product_summary','get_last_post_categories',1);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);

add_filter('woocommerce_product_tabs', 'woocommerce_remove_reviews_tab', 98);
function woocommerce_remove_reviews_tab($tabs) {
    unset( $tabs['additional_information'] );
    return $tabs;
}

function get_child_parent ($prodId){
    // get all product cats for the current post

}