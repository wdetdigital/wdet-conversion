<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package news-box-pro
 */
//site container set
 $news_box_site_container = get_theme_mod( 'news_box_site_container', 'container-fluid' );
  //blog layout 
 $news_bonews_box_layout = get_theme_mod( 'news_bonews_box_layout','right-sidebar' );
 if(  ($news_bonews_box_layout == 'left-sidebar' || $news_bonews_box_layout == 'right-sidebar' ) && is_active_sidebar( 'sidebar-1' )  ){
 	$news_box_column_class = 'col-xl-9 col-lg-8';
 }elseif ( $news_bonews_box_layout == 'full-center' ) {
 	$news_box_column_class = 'col-lg-10 col-sm-12 offset-lg-1';
 }else{
 	$news_box_column_class = 'col-md-12';
 }

 $news_box_archive_heading = get_theme_mod( 'news_box_archive_heading', 'standard' );
 if( $news_box_archive_heading == 'standard' ){
 	$news_box_header_class = 'bg-light text-center';
 }elseif( $news_box_archive_heading == 'standard-img' ){
 	$news_box_header_class = 'img-bg overlay-balck text-center';
 }elseif( $news_box_archive_heading == 'standard-bg' ){
 	$news_box_header_class = 'img-bg overlay-balck text-center';
 }else{
 	$news_box_header_class = 'classic-header';
 }

 $news_box_archive_head_img_id = get_theme_mod( 'news_box_archive_head_img');
 if($news_box_archive_head_img_id ){
 $news_box_archive_head_img = wp_get_attachment_image_url( $news_box_archive_head_img_id,'slider-big');
}else{
 	$news_box_archive_head_img = get_template_directory_uri().'/assets/img/header-bg.jpg';
}

$news_bonews_box_style = get_theme_mod( 'news_bonews_box_style', 'grid-masonry' ); 
$news_box_author_desc = get_theme_mod('news_box_author_desc',1);
$news_box_author_social = get_theme_mod('news_box_author_social',1);

 $news_box_usre_facebook_url = get_the_author_meta('facebook_url');
 $news_box_usre_twitter_url = get_the_author_meta('twitter_url');
 $news_box_usre_linkedin_url = get_the_author_meta('linkedin_url');
 $news_box_usre_google_plus_url = get_the_author_meta('google_plus_url');
 $news_box_usre_instagram_url = get_the_author_meta('instagram_url');
 $news_box_usre_pinterest_url = get_the_author_meta('pinterest_url');
 $news_box_usre_web_url = get_the_author_meta('user_url');

get_header();
?>
<header class="archive-header <?php echo esc_attr($news_box_header_class); ?>">
	<div class="<?php echo esc_attr($news_box_site_container); ?> header-<?php echo esc_attr($news_box_archive_heading); ?>">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
			<?php if(  $news_box_archive_heading == 'standard-bg' ): ?>
			<div class="x-overlay">
			<?php endif; ?>
				<div class="author-img">
					<?php echo get_avatar( get_the_author_meta('ID'),100); ?>
				</div>
			<div class="author-text">
				<?php
				the_archive_title( '<h3 class="author-name">', '</h3>' );
				
				?>
				<div class="archive-desc">
					<?php if( $news_box_author_desc == 1 ): ?>
					<p><?php the_author_meta( 'description') ?></p>
					<?php endif; ?>
					<?php if( $news_box_author_social == 1 ): ?>
					<ul class="author-social list-none">
						<?php if( $news_box_usre_facebook_url ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $news_box_usre_facebook_url ); ?>"><i class="fab fa-facebook"></i></a></li>
						<?php endif; ?>
						<?php if( $news_box_usre_twitter_url ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $news_box_usre_twitter_url ); ?>"><i class="fab fa-twitter"></i></a></li>
						<?php endif; ?>
						<?php if( $news_box_usre_linkedin_url ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $news_box_usre_linkedin_url ); ?>"><i class="fab fa-linkedin"></i></a></li>
						<?php endif; ?>
						<?php if( $news_box_usre_google_plus_url ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $news_box_usre_google_plus_url ); ?>"><i class="fab fa-google-plus"></i></a></li>
						<?php endif; ?>
						<?php if( $news_box_usre_instagram_url ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $news_box_usre_instagram_url ); ?>"><i class="fab fa-instagram"></i></a></li>
						<?php endif; ?>
						<?php if( $news_box_usre_pinterest_url ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $news_box_usre_pinterest_url ); ?>"><i class="fab fa-pinterest"></i></a></li>
						<?php endif; ?>
						<?php if( $news_box_usre_web_url ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $news_box_usre_web_url ); ?>"><i class="fas fa-globe"></i></a></li>
						<?php endif; ?>
					</ul>
					<?php endif; ?>
				</div>
				<?php if(  $news_box_archive_heading == 'standard-bg' ): ?>
				</div>
			<?php endif; ?>
			</div>
			</div>
		</div>
	
	</div>
	<?php if( $news_box_archive_heading == 'standard-img' || $news_box_archive_heading == 'standard-bg' ): ?>
	<div class="bg-img">
		<img src="<?php echo esc_url($news_box_archive_head_img); ?>" alt="<?php esc_attr_e( 'Author background image', 'news-box-pro' ) ?>">
	</div>
	<?php endif; ?>
</header><!-- .page-header -->
<div id="content" class="site-content">
<div class="<?php echo esc_attr($news_box_site_container); ?>">
	<div class="row">
		<?php if( $news_bonews_box_layout == 'left-sidebar' && is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-xl-3 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($news_box_column_class); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

<?php
if ( have_posts() ) :
			//add row div for grid layout
if( !is_single() && ($news_bonews_box_style == 'grid' || $news_bonews_box_style == 'grid-masonry') ):
				 ?>
			<div class="row">
				<?php
				endif;
// add masonry id 
if( !is_single() && $news_bonews_box_style == 'grid-masonry' ):
				 ?>
			<div id="news-box-masonry">
				<?php
				endif; 
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', get_post_format() );

			endwhile;
						// add masonry id 				
if( !is_single() && $news_bonews_box_style == 'grid-masonry'  ):

					 ?>
			</div>
				<?php
			endif;

//add row div for grid layout
if( !is_single() && ($news_bonews_box_style == 'grid' || $news_bonews_box_style == 'grid-masonry')  ):

					 ?>
			</div>
				<?php
			endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<?php if( $news_bonews_box_layout == 'right-sidebar' && is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-xl-3 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
	</div>
	<?php news_box_pagination(); ?>
</div>
<?php
get_footer();
