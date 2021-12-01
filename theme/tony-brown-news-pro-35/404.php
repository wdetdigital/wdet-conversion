<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package news-box-pro
 */
//site container set
 $news_box_site_container = get_theme_mod( 'news_box_site_container', 'container-fluid' );

 $news_box_fourzerofour_heading = get_theme_mod( 'news_box_fourzerofour_heading', __('page not founded.','news-box-pro'));
$news_box_fourzerofour_desc = get_theme_mod( 'news_box_fourzerofour_desc',__('This page you are looking for could not be founded.','news-box-pro'));
$news_box_fourzerofour_search = get_theme_mod( 'news_box_fourzerofour_search',1);
$news_box_fourzerofour_img_use = get_theme_mod( 'news_box_fourzerofour_img_use', 'text');
$news_box_fourzerofour_txt = get_theme_mod( 'news_box_fourzerofour_txt', '404');
$news_box_fourzerofour_img_id = get_theme_mod( 'news_box_fourzerofour_img','');
$news_box_fourzerofour_img = wp_get_attachment_image_url( $news_box_fourzerofour_img_id, 'medium');

get_header();
?>
<div id="content" class="site-content">
<div class="<?php echo esc_attr($news_box_site_container); ?>">
	<div class="row">
				<div class="col-md-8 offset-md-2">
					<main id="main" class="site-main">

			<section class="error-404 not-found text-center">
				<div class="page-content">
					<?php if($news_box_fourzerofour_img_use == 'image' && !empty($news_box_fourzerofour_img_id)): ?>
					<img src="<?php echo esc_url($news_box_fourzerofour_img); ?>" alt="<?php esc_attr_e('404 Error','news-box-pro'); ?>" class="img-error-404 mb-5 mt-5">
					<?php else: ?>
						<h1 class="title-404"><?php echo esc_html($news_box_fourzerofour_txt); ?></h1>
					<?php endif; ?>
					<div class="error-content">
						<h4 class="mb-4"><?php echo esc_html($news_box_fourzerofour_heading); ?></h4>
						<p class="mb-5"><?php echo esc_html($news_box_fourzerofour_desc); ?></p>
					<?php
					if($news_box_fourzerofour_search == 1){
					get_search_form();
					}
					?>
					<a class="error-back-link" href="<?php echo esc_url(home_url('/')); ?>" class="mt-5"><i class="fas fa-arrow-left"></i><?php esc_html_e('back to homepage','news-box-pro'); ?></a>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->		
			</main>
			</div>
		</div>
</div>
<?php
get_footer();

