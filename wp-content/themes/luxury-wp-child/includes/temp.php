<?php
/**

function woocommerce_subcats_from_parentcat_by_ID($parent_cat_ID) {
    $args = array(
        'hierarchical' => 1,
        'show_option_none' => '',
        'hide_empty' => 0,
        'parent' => $parent_cat_ID,
        'taxonomy' => 'product_cat'
    );
    $subcats = get_categories($args);
    echo '<ul class="wooc_sclist">';
    foreach ($subcats as $sc) {
        $link = get_term_link( $sc->slug, $sc->taxonomy );
        echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
    }
    echo '</ul>';
}
function woocommerce_subcats_from_parentcat_by_NAME($parent_cat_NAME) {
    $IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');
    $product_cat_ID = $IDbyNAME->term_id;
    $args = array(
        'hierarchical' => 1,
        'show_option_none' => '',
        'hide_empty' => 0,
        'parent' => $product_cat_ID,
        'taxonomy' => 'product_cat'
    );

    $subcats = get_categories($args);
    echo '<ul class="wooc_sclist">';
    foreach ($subcats as $sc) {
        $link = get_term_link( $sc->slug, $sc->taxonomy );
        echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
    }
    echo '</ul>';
} */
vc_map(
    array(
        "name" => __( "Product Subcategories Tab", 'luxury-wp' ),
        "base" => "wc_product_subcategory_tab",
        "category" => __( "Custom", 'luxury-wp' ),
        "icon" => "dh-vc-icon-dh_woo",
        "class" => "dh-vc-element dh-vc-element-dh_woo",
        'description' => __( 'List products with Tab layout.', 'luxury-wp' ),
        "params" => array(
            array(
                'save_always'=>true,
                'type' => 'textfield',
                'heading' => __( 'Title', 'luxury-wp' ),
                'param_name' => 'title',
                'description' => __(
                    'Enter text which will be used as widget title. Leave blank if no title is needed.',
                    'luxury-wp' ) ),
            array(
                'save_always'=>true,
                "type" => "attach_image",
                "heading" => __( "Title Badge", 'luxury-wp' ),
                "param_name" => "title_badge",
                "value" => "",
                "description" => __( "Select image from media library.", 'luxury-wp' ) ),
            array(
                'save_always'=>true,
                'type' => 'colorpicker',
                'heading' => __( 'Tab Color', 'luxury-wp' ),
                'param_name' => 'tab_color',
                'description' => __( 'Tab color.', 'luxury-wp' ) ),
            array(
                'save_always'=>true,
                "type" => "attach_image",
                "heading" => __( "Tab Banner", 'luxury-wp' ),
                "param_name" => "tab_banner",
                "value" => "",
                "description" => __( "Select image from media library.", 'luxury-wp' ) ),
            array(
                'save_always'=>true,
                'type' => 'href',
                'dependency' => array( 'element' => 'tab_banner', 'not_empty' => true ),
                'heading' => __( 'URL (Link)', 'luxury-wp' ),
                'param_name' => 'href',
                'description' => __( 'Banner link.', 'luxury-wp' ) ),
            array(
                'save_always'=>true,
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
                'save_always'=>true,
                'type' => 'autocomplete',
                'heading' => __( 'Categories', 'luxury-wp' ),
                'param_name' => 'category',
                'admin_label' => true,
                'settings' => array( 'multiple' => true, 'sortable' => true ),
                'save_always' => true,
                'description' => __( 'List of product categories', 'luxury-wp' ) ),
            array(
                'save_always'=>true,
                "type" => "textfield",
                "heading" => __( "Product Per Page", 'luxury-wp' ),
                "param_name" => "per_page",
                "admin_label" => true,
                "value" => 8 ),
            array(
                'save_always'=>true,
                "type" => "dropdown",
                "heading" => __( "Columns", 'luxury-wp' ),
                "param_name" => "columns",
                "std" => 4,
                "admin_label" => true,
                "value" => array( 2, 3, 4, 5, 6 ) ),
            array(
                'save_always'=>true,
                'type' => 'dropdown',
                'param_name' => 'show',
                'heading' => __( 'Show', 'luxury-wp' ),

                'value' => array(
                    __( 'All Products', 'luxury-wp' ) => '',
                    __( 'Featured Products', 'luxury-wp' ) => 'featured',
                    __( 'On-sale Products', 'luxury-wp' ) => 'onsale' ) ),
            array(
                'save_always'=>true,
                'type' => 'dropdown',
                'param_name' => 'orderby',
                'heading' => __( 'Order by', 'luxury-wp' ),

                'std' => 'date',
                'value' => array(
                    __( 'Date', 'luxury-wp' ) => 'date',
                    __( 'Price', 'luxury-wp' ) => 'price',
                    __( 'Random', 'luxury-wp' ) => 'rand',
                    __( 'Sales', 'luxury-wp' ) => 'sales' ) ),
            array(
                'save_always'=>true,
                'type' => 'dropdown',
                'param_name' => 'order',
                'heading' => _x( 'Order', 'Sorting order', 'luxury-wp' ),

                'std' => 'asc',
                'value' => array( __( 'ASC', 'luxury-wp' ) => 'asc', __( 'DESC', 'luxury-wp' ) => 'desc' ) ),
            array(
                'save_always'=>true,
                'param_name' => 'hide_free',
                'heading' => __( 'Hide free products', 'luxury-wp' ),
                'type' => 'checkbox',
                'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ),
            array(
                'save_always'=>true,
                'param_name' => 'show_hidden',
                'heading' => __( 'Show hidden products', 'luxury-wp' ),
                'type' => 'checkbox',
                'value' => array( __( 'Yes,please', 'luxury-wp' ) => '1' ) ) ) ) );