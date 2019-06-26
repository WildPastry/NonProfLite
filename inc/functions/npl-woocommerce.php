<?php
/**
 * npl woocommerce
 * @package nonproflite
 */

// woocommerce support –––––––––––––––––––––––––––––––––––––––––––––––––––
function mytheme_add_woocommerce_support()
{
	add_theme_support('woocommerce', array(
		'thumbnail_image_width' => 600,
		'gallery_thumbnail_image_width' => 600,
		'single_image_width'    => 1200,

		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 4,
			'min_columns'     => 1,
			'max_columns'     => 4,
		),
	));
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// add to cart button (single product) –––––––––––––––––––––––––––––––––––
add_filter('add_to_cart_text', 'woo_custom_single_add_to_cart_text');
add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text');

function woo_custom_single_add_to_cart_text()
{

	return __('Add to cart', 'woocommerce');
}
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// add to cart button (product archives) –––––––––––––––––––––––––––––––––
add_filter('add_to_cart_text', 'woo_custom_product_add_to_cart_text');
add_filter('woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text');

function woo_custom_product_add_to_cart_text()
{

	return __('Add to cart', 'woocommerce');
}
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// cart icon –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
function my_header_add_to_cart_fragment( $fragments ) {

	ob_start();
	$count = WC()->cart->cart_contents_count;
	?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View Your Cart' ); ?>"><?php
	if ( $count > 0 ) {
			?>
			<span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
			<?php
	}
			?></a><?php

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––