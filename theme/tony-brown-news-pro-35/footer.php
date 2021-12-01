<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package news-box-pro
 */
//site container set
 $news_box_site_container = get_theme_mod( 'news_box_site_container', 'container-fluid' );
 $news_box_footer_position = get_theme_mod( 'news_box_footer_position', 'default' );

?>

	</div><!-- #content -->

	<?php if ( is_active_sidebar( 'footer-banner' ) ): ?>
	<div class="footer-ads text-center">
		<div class="<?php echo esc_attr($news_box_site_container); ?>">
			<?php dynamic_sidebar( 'footer-banner' );  ?>
		</div>
	</div>
	<?php endif; ?>
	<footer id="colophon" class="site-footer">
		<?php if(is_active_sidebar( 'footer-top' )): ?>
		<div class="footer-top-widget widget-footer">
			<div class="<?php echo esc_attr($news_box_site_container); ?>">
				<div class="row">
					<?php dynamic_sidebar( 'footer-top' );  ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if(is_active_sidebar( 'footer-middle' )): ?>
		<div class="footer-middle-widget widget-footer">
			<div class="<?php echo esc_attr($news_box_site_container); ?>">
				<div class="row">
					<?php dynamic_sidebar( 'footer-middle' );  ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if( $news_box_footer_position == 'center' ): ?>
	<?php get_template_part('template-parts/footer/center-footer'); ?>
		<?php else: ?>
	<?php get_template_part('template-parts/footer/default-footer'); ?>
		<?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php
		if ( function_exists( 'nbox_pro_woocommerce_header_cart' ) ) {
			$nbox_pro_cart_icon = get_theme_mod( 'nbox_pro_cart_icon', 'all' );

			if($nbox_pro_cart_icon == 'all'){
			nbox_pro_woocommerce_header_cart();
			}
			if($nbox_pro_cart_icon == 'shop' && is_woocommerce() ){
			nbox_pro_woocommerce_header_cart();
			}

		}
	?>
<?php wp_footer(); ?>

</body>
</html>
