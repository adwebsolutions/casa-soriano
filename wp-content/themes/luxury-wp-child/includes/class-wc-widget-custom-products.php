<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * List products. One widget to rule them all.
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class WC_Widget_Custom_Products extends WC_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_products';
		$this->widget_description = __( 'Display a list of your products on your site.', 'woocommerce' );
		$this->widget_id          = 'woocommerce_custom_products';
		$this->widget_name        = __( 'WooCommerce Custom Products', 'woocommerce' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Products', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' ),
			),
			'show' => array(
				'type'  => 'select',
				'std'   => '',
				'label' => __( 'Show', 'woocommerce' ),
				'options' => array(
					''         => __( 'All products', 'woocommerce' ),
					'selected' => __( 'Select products', 'woocommerce' ),
				),
			),
			'products' => array (
				'type' => 'text',
				'label' => __( 'List separated by "," your products id', 'woocommerce' ),
				'dependency' => array('element'=>'show','value'=>array('selected')),
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => __( 'Order by', 'woocommerce' ),
				'options' => array(
					'date'   => __( 'Date', 'woocommerce' ),
					'price'  => __( 'Price', 'woocommerce' ),
					'rand'   => __( 'Random', 'woocommerce' ),
					'sales'  => __( 'Sales', 'woocommerce' ),
				),
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'desc',
				'label' => _x( 'Order', 'Sorting order', 'woocommerce' ),
				'options' => array(
					'asc'  => __( 'ASC', 'woocommerce' ),
					'desc' => __( 'DESC', 'woocommerce' ),
				),
			),
		);

		parent::__construct();
	}

	/**
	 * Query the products and return them.
	 * @param  array $args
	 * @param  array $instance
	 * @return WP_Query
	 */
	public function get_products( $args, $instance ) {
		$show                        = ! empty( $instance['show'] ) ? sanitize_title( $instance['show'] )       : $this->settings['show']['std'];
		$orderby                     = ! empty( $instance['orderby'] ) ? sanitize_title( $instance['orderby'] ) : $this->settings['orderby']['std'];
		$order                       = ! empty( $instance['order'] ) ? sanitize_title( $instance['order'] )     : $this->settings['order']['std'];
		$product_visibility_term_ids = wc_get_product_visibility_term_ids();
		$post_in					 = ! empty( $instance['products'] ) ? explode(',', $instance['products']) : "";

		$query_args = array(
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'no_found_rows'  => 1,
			'order'          => $order,
			'meta_query'     => array(),
			'tax_query'      => array(
				'relation' => 'AND',
			),
		);


		if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => $product_visibility_term_ids['outofstock'],
					'operator' => 'NOT IN',
				),
			);
		}

		switch ( $show ) {
			case 'selected' :
				if(!empty($post_in))
					$query_args['post__in'] = $post_in;
				break;
		}

		switch ( $orderby ) {
			case 'price' :
				$query_args['meta_key'] = '_price';
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand' :
				$query_args['orderby']  = 'rand';
				break;
			case 'sales' :
				$query_args['meta_key'] = 'total_sales';
				$query_args['orderby']  = 'meta_value_num';
				break;
			default :
				$query_args['orderby']  = 'date';
		}
		return new WP_Query( $query_args);
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		if ( ( $products = $this->get_products( $args, $instance ) ) && $products->have_posts() ) {
			$this->widget_start( $args, $instance );

			echo apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_list_widget">' );

			while ( $products->have_posts() ) {
				$products->the_post();
				wc_get_template( 'content-widget-product.php', array( 'show_rating' => false ) );
			}

			echo apply_filters( 'woocommerce_after_widget_product_list', '</ul>' );

			$this->widget_end( $args );
		}

		wp_reset_postdata();

		echo $this->cache_widget( $args, ob_get_clean() );
	}
}
