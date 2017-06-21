<?php

// function: post_type BEGIN
register_activation_hook( __FILE__, function () {
    post_type();
    flush_rewrite_rules();
} );
register_deactivation_hook( __FILE__, function () {
    flush_rewrite_rules();
} );
add_action( 'init', 'post_type' );
function post_type() {
    $labels = array(
        'name'                  => __( 'Clients', 'porto-child' ),
        'singular_name'         => __( 'Client', 'porto-child' ),
        'menu_name'             => __( 'Clients', 'admin menu', 'porto-child' ),
        'add_new'               => __( 'Add New', 'client','porto-child' ),
        'add_new_item'          => __( 'Add New Client', 'porto-child' ),
        'edit_item'             => __( 'Edit Clients', 'porto-child' ),
        'new_item'              => __( 'New Clients', 'porto-child' ),
        'view_item'             => __( 'View Clients', 'porto-child' ),
        'all_items'             => __( 'All Clients', 'porto-child' ),
        'search_items'          => __( 'Search Clients', 'porto-child' ),
        'not_found'             => __( 'No Clients Found', 'porto-child' ),
        'not_found_in_trash'    => __( 'No Clients Found In Trash', 'porto-child' ),
        'parent_item_colon'     => '',
    );
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'client'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array( 'title','editor', 'thumbnail', 'excerpt' )
    );
    register_post_type('client', $args);
}

function client_messages($messages)
{
    $messages['client'] =
        array(
            0 => '',
            1 => sprintf(__('Client Updated. <a href="%s">View Client</a>','porto-child'), esc_url(get_permalink($post_ID))),
            2 => __('Custom Field Updated.', 'porto-child' ),
            3 => __('Custom Field Deleted.', 'porto-child' ),
            4 => __('Client Updated.', 'porto-child' ),
            5 => isset($_GET['revision']) ? sprintf( __('Client Restored To Revision From %s','porto-child'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
            6 => sprintf(__('Client Published. <a href="%s">View Client</a>','porto-child'), esc_url(get_permalink($post_ID))),
            7 => __('Clients Saved.'),
            8 => sprintf(__('Client Submitted. <a target="_blank" href="%s">Preview Client</a>','porto-child'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            9 => sprintf(__('Client Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Client</a>','porto-child'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
            10 => sprintf(__('Client Draft Updated. <a target="_blank" href="%s">Preview Client</a>','porto-child'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
        );
    return $messages;

} // function: Client_messages END
add_filter( 'post_updated_messages', 'client_messages' );

function taxonomy_slug_rewrite($wp_rewrite) {
    $rules = array();
    // get all custom taxonomies
    $taxonomies = get_taxonomies(array('_builtin' => false), 'objects');
    // get all custom post types
    $post_types = get_post_types(array('public' => true, '_builtin' => false), 'objects');

    foreach ($post_types as $post_type) {
        foreach ($taxonomies as $taxonomy) {

            // go through all post types which this taxonomy is assigned to
            foreach ($taxonomy->object_type as $object_type) {

                // check if taxonomy is registered for this custom type
                if ($object_type == $post_type->rewrite['slug']) {

                    // get category objects
                    $terms = get_categories(array('type' => $object_type, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0));

                    // make rules
                    foreach ($terms as $term) {
                        $rules[$object_type . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
                    }
                }
            }
        }
    }
    // merge with global rules
    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'taxonomy_slug_rewrite');
