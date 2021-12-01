<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package news-box-pro bg-light for light bacground
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
 	$news_box_column_class = 'col-sm-12';
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
$news_bonews_box_style = get_theme_mod( 'news_bonews_box_style', 'grid-masonry' ); 

 $news_box_archive_head_img_id = get_theme_mod( 'news_box_archive_head_img');
if($news_box_archive_head_img_id ){
 $news_box_archive_head_img = wp_get_attachment_image_url( $news_box_archive_head_img_id,'slider-big');
}else{
 	$news_box_archive_head_img = get_template_directory_uri().'/assets/img/header-bg.jpg';
}

get_header();

?>
<?php if( $news_box_archive_heading != 'classic' ): ?>
	<header class="page-header archive-header <?php echo esc_attr($news_box_header_class); ?> text-center">
		<?php if( $news_box_archive_heading == 'standard-img' ): ?>
		<div class="<?php echo esc_attr($news_box_site_container); ?> header-<?php echo esc_attr($news_box_archive_heading); ?>">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description archive-desc">', '</div>' );
				?>
				<div class="xbreadcrumb"><?php if( function_exists('bcn_display' )){ bcn_display();} ?></div>	

		</div>
		<div class="bg-img">
			<img src="<?php echo esc_url($news_box_archive_head_img); ?>" alt="<?php the_title(); ?>">
		</div>
		<?php endif; ?>
		<?php if( $news_box_archive_heading == 'standard-bg' ): ?>
			<div class="<?php echo esc_attr($news_box_site_container); ?> header-<?php echo esc_attr($news_box_archive_heading); ?>">
				<div class="x-overlay">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>	
				<div class="xbreadcrumb"><?php if( function_exists('bcn_display' )){ bcn_display();} ?></div>	

				</div>
			</div>
			<div class="bg-img">
				<img src="<?php echo esc_url($news_box_archive_head_img); ?>" alt="<?php the_title(); ?>">
			</div>
		<?php endif; ?>
		<?php if( $news_box_archive_heading == 'standard' ): ?>
			<div class="<?php echo esc_attr($news_box_site_container); ?> header-<?php echo esc_attr($news_box_archive_heading); ?>">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
				<div class="xbreadcrumb"><?php if( function_exists('bcn_display' )){ bcn_display();} ?></div>	
			</div>
		<?php endif; ?>
	</header><!-- .page-header -->
	<?php endif; ?>
<div id="content" class="site-content">
<div class="<?php echo esc_attr($news_box_site_container); ?>">
	<!-- Classic header style bradcamp -->
	<?php if(  $news_box_archive_heading == 'classic'  ): ?>
	<div class="xbreadcrumb cbrad"><?php if( function_exists('bcn_display' )){ bcn_display();} ?></div>
	<?php endif; ?>
	<div class="row">
		<?php if( $news_bonews_box_layout == 'left-sidebar' && is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-xl-3 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($news_box_column_class); ?>">
			<?php if(  $news_box_archive_heading == 'classic'  ): ?>
			<header class="entry-header header-<?php echo esc_attr($news_box_archive_heading); ?>">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .entry-header -->
			<?php endif; ?>
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
