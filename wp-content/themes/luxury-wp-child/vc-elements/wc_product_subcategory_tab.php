<?php
/*
Element Description: WC Product Subcategory Tab
*/

// Element Class
class wcProductSubcategoryTab extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'wc_product_subcategory_tab_mapping' ) );
        add_shortcode( 'wc_product_subcategory_tab', array( $this, 'wc_product_subcategory_tab_html' ) );
    }

    // Element Mapping
    public function wc_product_subcategory_tab_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                "name" => __( "Product Subcategory Tab", 'luxury-wp-child' ),
                "base" => "wc_product_subcategory_tab",
                "category" => __( "WooCommerce", 'luxury-wp-child' ),
                "icon" => "dh-vc-icon-dh_woo",
                "class" => "dh-vc-element dh-vc-element-dh_woo",
                'description' => __( 'List subcategorys of selected categories with Tab layout.', 'luxury-wp-child' ),
                "params" => array(
                    array(
                        'save_always'=>true,
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'luxury-wp-child' ),
                        'param_name' => 'title',
                        'description' => __(
                            'Enter text which will be used as widget title. Leave blank if no title is needed.',
                            'luxury-wp-child' ) ),
                    array(
                        'save_always'=>true,
                        "type" => "attach_image",
                        "heading" => __( "Title Badge", 'luxury-wp-child' ),
                        "param_name" => "title_badge",
                        "value" => "",
                        "description" => __( "Select image from media library.", 'luxury-wp-child' ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'colorpicker',
                        'heading' => __( 'Tab Color', 'luxury-wp-child' ),
                        'param_name' => 'tab_color',
                        'description' => __( 'Tab color.', 'luxury-wp-child' ) ),
                    array(
                        'save_always'=>true,
                        "type" => "attach_image",
                        "heading" => __( "Tab Banner", 'luxury-wp-child' ),
                        "param_name" => "tab_banner",
                        "value" => "",
                        "description" => __( "Select image from media library.", 'luxury-wp-child' ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'href',
                        'dependency' => array( 'element' => 'tab_banner', 'not_empty' => true ),
                        'heading' => __( 'URL (Link)', 'luxury-wp-child' ),
                        'param_name' => 'href',
                        'description' => __( 'Banner link.', 'luxury-wp-child' ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'dropdown',
                        'heading' => __( 'Target', 'luxury-wp-child' ),
                        'param_name' => 'target',
                        'std' => '_self',
                        'value' => array( __( 'Same window', 'luxury-wp-child' ) => '_self', __( 'New window', 'luxury-wp-child' ) => "_blank" ),
                        'dependency' => array(
                            'element' => 'href',
                            'not_empty' => true,
                            'callback' => 'vc_button_param_target_callback' ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'textfield',
                        'heading' => __( 'Categories', 'luxury-wp-child' ),
                        'param_name' => 'category',
                        'admin_label' => true,
                        'settings' => array( 'multiple' => true, 'sortable' => true ),
                        'save_always' => true,
                        'description' => __( 'Write the categories slug separate by ","', 'luxury-wp-child' ) ),
                    array(
                        'save_always'=>true,
                        "type" => "textfield",
                        "heading" => __( "Categories Per Page", 'luxury-wp-child' ),
                        "param_name" => "per_page",
                        "admin_label" => true,
                        "value" => 8 ),
                    array(
                        'save_always'=>true,
                        "type" => "dropdown",
                        "heading" => __( "Columns", 'luxury-wp-child' ),
                        "param_name" => "columns",
                        "std" => 4,
                        "admin_label" => true,
                        "value" => array( 2, 3, 4, 5, 6 ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        'heading' => _x( 'Order', 'Sorting order', 'luxury-wp-child' ),
                        'std' => 'asc',
                        'value' => array( __( 'ASC', 'luxury-wp-child' ) => 'asc', __( 'DESC', 'luxury-wp-child' ) => 'desc' ) ),
                    array(
                        'save_always'=>true,
                        'param_name' => 'show_hidden',
                        'heading' => __( 'Show empty categories', 'luxury-wp-child' ),
                        'type' => 'checkbox',
                        'value' => array( __( 'Yes,please', 'luxury-wp-child' ) => '1' ) ) ) ) );

    }

    // Element HTML
    public function wc_product_subcategory_tab_html( $atts ) {

        $output ='';
        extract(shortcode_atts(array(
            'title'=>'',
            'title_badge'=>'',
            'tab_color'=>'',
            'tab_banner'=>'',
            'href'=>'',
            'target'=>'',
            'category'=>'',
            'per_page'=>'8',
            'columns'=>'4',
            'order'=>'asc',
            'show_hidden'=>'',
            'el_class' => ''
        ),$atts));

        $tab_color = dh_format_color($tab_color);
        $title_badge = wp_get_attachment_url(absint($title_badge));
        $tab_banner = wp_get_attachment_url(absint($tab_banner));
        if ( $target == 'same' || $target == '_self' ) {
            $target = '';
        }
        $target = ( $target != '' ) ? ' target="' . $target . '"' : '';

        global $woocommerce_loop;
        $woocommerce_loop['columns'] = $columns;


        $category_arr = explode(',', $category);
//$category_arr = array_filter($category_arr);
        $category_arr = array_map( 'trim', $category_arr );
        /**
         * script
         * {{
         */
        wp_enqueue_script( 'wc-add-to-cart-variation' );
        wp_enqueue_script('carouFredSel');

        $query_args = array(
            'posts_per_page' => $per_page,
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'order'          => $order,
            'meta_query'     => array(),
        );

        /*revisar!!*/
        if ( !empty( $show_hidden ) ) {
            $query_args['meta_query'][] = WC()->query->visibility_meta_query();
            $query_args['post_parent']  = 0;
        }

        $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
        $query_args['meta_query']   = array_filter( $query_args['meta_query'] );


        $itemSelector = '';
        if(is_array($category_arr) && count($category_arr) > 0):
            ?>
            <div class="woocommerce categories-tab clearfix <?php echo esc_attr($el_class)?>">
                <div class="categories-tab-control col-sm-3">
                    <?php if(!empty($title)){?>
                        <h3 class="el-heading"<?php if(!empty($tab_color)){?> style="background-color:<?php echo esc_attr($tab_color)?>"<?php }?>>
                            <?php if(!empty($title_badge)):?>
                                <img src="<?php echo esc_attr($title_badge)?>" alt="">
                            <?php endif;?>
                            <?php echo esc_html($title)?>
                        </h3>
                    <?php }?>
                    <ul class="nav nav-tabs" role="tablist">
                        <?php $i = 0;?>
                        <?php foreach ($category_arr as $cat):?>
                            <?php if($cat):?>
                                <?php $category = get_term_by('slug',$cat, 'product_cat'); ?>
                                <?php if($category): ?>
                                    <li<?php if($i == 0) echo ' class="active"'?> role="presentation">
                                        <a class="categories-tab-control" data-columns="<?php echo esc_attr($columns)?>" data-query="<?php echo esc_attr(json_encode($query_args))?>" data-cat_slug="<?php echo esc_attr($category->slug)?>" <?php if(!empty($tab_color)){?> data-color="<?php echo esc_attr($tab_color)?>" onmouseout="this.style.color=''" onmouseover="this.style.color='<?php echo esc_attr($tab_color)?>'" <?php }?> href="<?php echo '#'.$category->slug ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo esc_html($category->name); ?></a>
                                    </li>
                                    <?php $i++;?>
                                <?php endif;?>
                            <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                    <?php if(!empty($tab_banner)):?>
                        <div class="tab-banner">
                            <a <?php echo !empty($href) ? 'href="'.esc_attr($href).'"':''?> <?php echo esc_attr($target)?>>
                                <img src="<?php echo esc_attr($tab_banner)?>" alt="">
                            </a>
                        </div>
                    <?php endif;?>
                </div>
                <div class="tab-content col-sm-9">
                    <?php
                    $j = 0;
                    foreach ($category_arr as $cat):
                        ?>
                        <div role="tabpanel" class="tab-pane<?php if($j  == 0) echo ' active'?>" id="<?php echo esc_attr($cat)?>">
                            <?php get_category_tab_content($cat,$columns, $query_args)?>
                        </div>
                        <?php
                        $j++;
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
        endif;
        wp_reset_postdata();
        echo $output;
    }

    private function get_subcategories_by_id (){

    }
} // End Element Class


// Element Class Init
new wcProductSubcategoryTab();