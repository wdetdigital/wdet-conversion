<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package news-box-pro
 */
 $news_bonews_box_heading = get_theme_mod( 'news_bonews_box_heading', 'standard' );
 if( $news_bonews_box_heading == 'standard' ){
 	$news_box_single_header_class = 'bg-light text-center';
 }elseif( $news_bonews_box_heading == 'standard-img' ){
 	$news_box_single_header_class = 'img-bg overlay-balck text-center';
 }elseif( $news_bonews_box_heading == 'standard-bg' ){
 	$news_box_single_header_class = 'img-bg overlay-balck text-center';
 }else{
 	$news_box_single_header_class = 'classic-header';
 }

 //blog layout 
 $news_box_sblog_layout = get_theme_mod( 'news_box_sblog_layout','full-width' );
 if(  ($news_box_sblog_layout == 'left-sidebar' || $news_box_sblog_layout == 'right-sidebar' ) && is_active_sidebar( 'sidebar-1' )  ){
 	$news_box_scolumn_class = 'col-xl-9 col-lg-8';
 }elseif ( $news_box_sblog_layout == 'full-center' ) {
 	$news_box_scolumn_class = 'col-lg-10 col-sm-12 offset-lg-1';
 }else{
 	$news_box_scolumn_class = 'col-sm-12';
 }

//site container set
 $news_box_sblog_container = get_theme_mod( 'news_box_sblog_container', 'container' );

 $news_bonews_box_heading_img_src = get_theme_mod( 'news_bonews_box_heading_img_src', 'feature-img');

 $news_bonews_box_head_img_id = get_theme_mod( 'news_bonews_box_head_img');
 
// related post and nav prev section show hide
$news_box_post_single_related = get_theme_mod( 'news_box_post_single_related', true ); 
$news_box_post_single_nextprev = get_theme_mod( 'news_box_post_single_nextprev', true ); 

get_header();
?>
<?php if( $news_bonews_box_heading != 'classic' ): ?>
	<header class="page-header single-title single-header <?php echo esc_attr($news_box_single_header_class); ?>">
		<?php 
		//background src image select
if( $news_bonews_box_heading_img_src == 'feature-img' ){
	if( has_post_thumbnail() ){
 		$news_bonews_box_head_img = get_the_post_thumbnail_url(get_the_ID(),'large');
	}else{
		$news_bonews_box_head_img = get_template_directory_uri().'/assets/img/header-bg.jpg';
	}
}else{
	if( !empty($news_bonews_box_head_img_id) ){
 		$news_bonews_box_head_img = wp_get_attachment_image_url( $news_bonews_box_head_img_id,'large');
	}else{
		$news_bonews_box_head_img = get_template_directory_uri().'/assets/img/header-bg.jpg';
	}


}

		 ?>
		<?php if( $news_bonews_box_heading == 'standard-img' ): ?>
		<div class="<?php echo esc_attr($news_box_sblog_container); ?>">
			<?php
				the_title( '<h2 class="page-title single-post-title">', '</h2>' );
			 ?>	
			 <?php if( function_exists('bcn_display' )): ?>
			<div class="xbreadcrumb"><?php bcn_display(); ?></div>
			<?php endif; ?>
		</div>
		<div class="bg-img">
			<img src="<?php echo esc_url($news_bonews_box_head_img); ?>" alt="<?php the_title(); ?>">
		</div>
		<?php endif; ?>
		<?php if( $news_bonews_box_heading == 'standard-bg' ): ?>
			<div class="<?php echo esc_attr($news_box_sblog_container); ?>">
				<div class="x-overlay">
				<?php
					the_title( '<h2 class="page-title single-post-title">', '</h2>' );
				 ?>	
				 <?php if( function_exists('bcn_display' )): ?>
			<div class="xbreadcrumb"><?php bcn_display(); ?></div>
			<?php endif; ?>
				</div>
			</div>
			<div class="bg-img">
				<img src="<?php echo esc_url($news_bonews_box_head_img); ?>" alt="<?php the_title(); ?>">
			</div>
		<?php endif; ?>
		<?php if( $news_bonews_box_heading == 'standard' ): ?>
			<div class="<?php echo esc_attr($news_box_sblog_container); ?>">
			<?php
				the_title( '<h2 class="page-title single-post-title">', '</h2>' );
			 ?>	
			 <?php if( function_exists('bcn_display' )): ?>
			<div class="xbreadcrumb"><?php bcn_display(); ?></div>
			<?php endif; ?>
			</div>
		<?php endif; ?>
	</header><!-- .page-header -->
	<?php endif; ?>
<div id="content" class="site-content">
<div class="<?php echo esc_attr($news_box_sblog_container); ?>">
	<div class="row">
		<?php if( $news_box_sblog_layout == 'left-sidebar' && is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-xl-3 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($news_box_scolumn_class); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

		<?php
		 	
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/post/content', get_post_format() );
			?>
			
			<?php
			if(!empty($news_box_post_single_related)){
			 	news_box_related_post();
			 }
			  ?>
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
			<div class="single-navigation pt-5">
				<?php 
				if( $news_box_post_single_nextprev ){
				news_box_single_navigation();// the_post_navigation();
				}
				 ?>
			</div>
		<?php
		endwhile; // End of the loop.
		?>


				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<?php if( $news_box_sblog_layout == 'right-sidebar' && is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-xl-3 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
