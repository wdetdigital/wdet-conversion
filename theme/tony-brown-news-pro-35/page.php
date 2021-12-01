<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package news-box-pro
 */


 $newsbox_page_heading = get_theme_mod( 'newsbox_page_heading', 'standard' );
 if( $newsbox_page_heading == 'standard' ){
 	$newsbox_page_heading_class = 'bg-light text-center';
 }elseif( $newsbox_page_heading == 'standard-img' ){
 	$newsbox_page_heading_class = 'img-bg overlay-balck text-center';
 }elseif( $newsbox_page_heading == 'standard-bg' ){
 	$newsbox_page_heading_class = 'img-bg overlay-balck text-center';
 }else{
 	$newsbox_page_heading_class = 'classic-header';
 }


//site container set
 $news_box_page_container = get_theme_mod( 'news_box_page_container', 'container' );
   //page layout 
 $news_box_page_layout = get_theme_mod( 'news_box_page_layout','right-sidebar' );
 if(  ($news_box_page_layout == 'left-sidebar' || $news_box_page_layout == 'right-sidebar' ) && is_active_sidebar( 'sidebar-1' )  ){
 	$news_box_column_class = 'col-xl-9 col-lg-8';
 }elseif ( $news_box_page_layout == 'full-center' ) {
 	$news_box_column_class = 'col-lg-10 col-sm-12 offset-lg-1';
 }else{
 	$news_box_column_class = 'col-sm-12';
 }

 $news_box_page_head_img_id = get_theme_mod( 'news_box_page_head_img');
if($news_box_page_head_img_id ){
 	$news_box_page_head_img = wp_get_attachment_image_url( $news_box_page_head_img_id,'slider-big');
}elseif( has_post_thumbnail() ){
	$news_box_page_head_img = get_the_post_thumbnail_url( get_the_ID(), 'slider-big' );
}else{
 	$news_box_page_head_img = get_template_directory_uri().'/assets/img/header-bg.jpg';
}

get_header();

?>
<?php if( $newsbox_page_heading != 'classic' ): ?>
	<header class="page-header single-page-head <?php echo esc_attr($newsbox_page_heading_class); ?> text-center">
		<?php if( $newsbox_page_heading == 'standard-img' ): ?>
		<div class="<?php echo esc_attr($news_box_page_container); ?>">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php if( function_exists('bcn_display' )): ?>
			<div class="xbreadcrumb"><?php bcn_display(); ?></div>
			<?php endif; ?>

		</div>
		<div class="bg-img">
			<img src="<?php echo esc_url($news_box_page_head_img); ?>" alt="<?php the_title(); ?>">
		</div>
		<?php endif; ?>
		<?php if( $newsbox_page_heading == 'standard-bg' ): ?>
			<div class="<?php echo esc_attr($news_box_page_container); ?>">
				<div class="x-overlay">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>	
				<?php if( function_exists('bcn_display' )): ?>
				<div class="xbreadcrumb"><?php bcn_display(); ?></div>
				<?php endif; ?>
				</div>
			</div>
			<div class="bg-img">
				<img src="<?php echo esc_url($news_box_page_head_img); ?>" alt="<?php the_title(); ?>">
			</div>
		<?php endif; ?>
		<?php if( $newsbox_page_heading == 'standard' ): ?>
			<div class="<?php echo esc_attr($news_box_page_container); ?>">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>	
			<?php if( function_exists('bcn_display' )): ?>
				<div class="xbreadcrumb"><?php bcn_display(); ?></div>
			<?php endif; ?>
			</div>
		<?php endif; ?>
	</header><!-- .page-header -->
	<?php endif; ?>
<div id="content" class="site-content">
<div class="<?php echo esc_attr($news_box_page_container); ?>">
	<div class="row">
		<?php if( $news_box_page_layout == 'left-sidebar' && is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-xl-3 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($news_box_column_class); ?>">
			<?php if(  $newsbox_page_heading == 'classic'  ): ?>
			<header class="entry-header text-center">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if( function_exists('bcn_display' )): ?>
				<div class="xbreadcrumb"><?php bcn_display(); ?></div>
				<?php endif; ?>
			</header><!-- .entry-header -->
			<?php endif; ?>
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<?php if( $news_box_page_layout == 'right-sidebar' && is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-xl-3 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
