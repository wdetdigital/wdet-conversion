<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package news-box-pro
 */

// check page number 
$newsbox_current_page = max(1,get_query_var('paged'));
//site container set
 $news_box_site_container = get_theme_mod( 'news_box_site_container', 'container-fluid' );
 $news_bonews_box_title = get_theme_mod( 'news_bonews_box_title');
 $news_bonews_box_desc = get_theme_mod( 'news_bonews_box_desc');
 $newsbonews_box_head_position = get_theme_mod( 'newsbonews_box_head_position','left');
  //blog layout 
 $news_bonews_box_layout = get_theme_mod( 'news_bonews_box_layout','right-sidebar' );
 if(  ($news_bonews_box_layout == 'left-sidebar' || $news_bonews_box_layout == 'right-sidebar' ) && is_active_sidebar( 'sidebar-1' )  ){
 	$news_box_column_class = 'col-xl-9 col-lg-8';
 }elseif ( $news_bonews_box_layout == 'full-center' ) {
 	$news_box_column_class = 'col-lg-10 col-md-12 offset-lg-1';
 }else{
 	$news_box_column_class = 'col-md-12';
 }
$news_bonews_box_style = get_theme_mod( 'news_bonews_box_style', 'grid-masonry' ); 
$news_box_laetst_show = get_theme_mod( 'news_box_laetst_show', 1); 

get_header();
?>
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
		//check first page and home
		if(is_home() && ( $newsbox_current_page == 1 )):
		$news_box_tab1_show = get_theme_mod( 'news_box_tab1_show');
		$news_box_tab2_show = get_theme_mod( 'news_box_tab2_show' );
		$news_box_tab3_show = get_theme_mod( 'news_box_tab3_show' );
		
		if( $news_box_tab1_show == 1 ){
		  get_template_part('template-parts/home-page/home-tab-one'); 
		}
		// ads template
		 get_template_part('template-parts/home-page/home-ads'); 
		if( $news_box_tab2_show == 1 ){
		  get_template_part('template-parts/home-page/home-tab-two'); 
		}
		// ads template two
		 get_template_part('template-parts/home-page/home-ads2'); 
		if( $news_box_tab3_show == 1 ){
		  get_template_part('template-parts/home-page/home-tab-three');
		}
		// ads template three
		 get_template_part('template-parts/home-page/home-ads3'); 
		endif; // check first page and home end
		  ?>
<div class="nboxcontent <?php if( $newsbox_current_page == 1 && empty($news_box_laetst_show)): ?>dnone<?php endif; ?>">
<?php if($news_bonews_box_title): ?>
	<div class="section-title text-<?php echo esc_attr($newsbonews_box_head_position); ?> mb-5">
		<h2><?php echo esc_html( $news_bonews_box_title ); ?></h2>
		<?php if($news_bonews_box_desc): ?>
		<p><?php echo esc_html( $news_bonews_box_desc ); ?></p>
		<?php endif; ?>
	</div>
<?php endif; ?>

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;
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
				$newsbox_count = 0;
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the post format 
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post format name) and that will be used instead.
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

					get_template_part( 'template-parts/post/content', 'none' );

				endif;
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<div class="nboxpage <?php if( $newsbox_current_page == 1 && empty($news_box_laetst_show)): ?>dnone<?php endif; ?>">
				<?php news_box_pagination(); ?>

			</div>
		</div>
		<?php if( $news_bonews_box_layout == 'right-sidebar' && is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-xl-3 col-lg-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
	</div>

	<?php 
	$news_box_bottom_show = get_theme_mod( 'news_box_bottom_show' );
	if($news_box_bottom_show == 1 && is_home() && ( $newsbox_current_page == 1 ) ):
	 ?>
	<div class="home-bottom-section">
	<?php get_template_part('template-parts/home-page/home-bottom'); ?>
	</div>
	<?php endif; ?>
</div>
<?php
get_footer();
