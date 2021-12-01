<?php
/*
*
* XBlog pro woocommerce related functions
*
*
*/

function nbox_pro_woocommerce_setup() {
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'nbox_pro_woocommerce_setup' );

function nbox_pro_woocommerce_scripts() {
	wp_enqueue_style( 'news-box-pro-woocommerce-style', get_template_directory_uri() . '/assets/css/nbox-woocommerce.css' );

}
add_action( 'wp_enqueue_scripts', 'nbox_pro_woocommerce_scripts' );

if ( ! function_exists( 'nbox_pro_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function nbox_pro_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		nbox_pro_woocommerce_cart_link();
		$fragments['.xshoping-bag'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'nbox_pro_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'nbox_pro_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function nbox_pro_woocommerce_cart_link() {
		$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'news-box-pro' ),
				WC()->cart->get_cart_contents_count()
			);
		?>
		<div class="xshoping-bag" data-toggle="modal" data-target="#cartModal">
			<div class="xshoping-inner-bag">
				<i  class="fas fa-shopping-basket"></i>
				<span class="count cart-contents"><?php echo esc_html( $item_count_text ); ?></span>
			</div> 
		</div> 
		

		<?php
	}
}

if ( ! function_exists( 'nbox_pro_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function nbox_pro_woocommerce_header_cart() {
		if ( is_cart() || is_checkout() ) {
			$class = 'current-menu-item xcart-page';
		} else {
			$class = 'not-cart-page';
		}

		?>
		<div class="xshoping-cart <?php echo esc_attr($class); ?>">
		<?php nbox_pro_woocommerce_cart_link(); ?>
		<!-- Modal -->
		<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="xcartTitle" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="xcartTitle"><?php echo esc_html__( 'Shopping Cart ','news-box-pro' ); ?></h5>
			      </div>
			      <div class="modal-body">
			        <?php
							$instance = array(
								'title' => '',
							);

							the_widget( 'WC_Widget_Cart', $instance );
							?>
				
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php esc_html_e( 'Close', 'news-box-pro' ); ?>
				 </button>
			      </div>
			    </div>
			  </div>
			</div>

		</div>
		<?php
	}
}

