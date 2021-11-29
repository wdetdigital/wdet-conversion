<?php
/*
*
* Single content open for News Box pro theme
*
*
*/

 $news_bonews_box_heading = get_theme_mod( 'news_bonews_box_heading', 'standard' );
 $news_box_img_top_bottom = get_theme_mod( 'news_box_img_top_bottom', 'bottom-img' );

$news_box_categories = get_the_category();
	if($news_box_categories){
		$news_box_category = $news_box_categories[mt_rand(0,count( $news_box_categories)-1)];
	}else{
		$news_box_category = '';
	}
$news_bonews_box_style = get_theme_mod( 'news_bonews_box_style', 'grid-masonry' ); 
$news_box_post_social = get_theme_mod( 'news_box_post_social', true ); 
$newsbox_single_post_time = get_theme_mod( 'newsbox_single_post_time', true ); 
$newsbox_single_post_cat = get_theme_mod( 'newsbox_single_post_cat', true ); 
$news_box_post_single_tag = get_theme_mod( 'news_box_post_single_tag', true ); 
$news_box_post_single_author = get_theme_mod( 'news_box_post_single_author', true ); 


?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<?php if(  $news_bonews_box_heading == 'classic'  ): ?>
		
		<?php if( $news_box_img_top_bottom == 'top-img' ): ?>
		<figure class="ingle-ctimg">
			<?php 
			 news_box_thumbnail_item_view(get_the_ID());
			?>
		</figure>
		<?php endif; ?>
	<header class="entry-header text-center">
		<div class="post-meta post-category">
		<?php
		if ( 'post' === get_post_type() && !empty($newsbox_single_post_cat) ) :

			news_box_category_link()

			 ?>
    		<?php endif; ?>
		</div>
		<?php
			the_title( '<h2 class="entry-title">', '</h2>' );
		 ?>
		<div class="post-meta">
			<?php
			if( !empty($newsbox_single_post_time) ){
			 news_box_posted_on();  
			}
			?>
		</div>
	<?php
		if ( get_field('featured_audio') ) :
		?>
		<audio controls>
  			<source src="<?php the_field('featured_audio'); ?>" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio>
		<?php endif; ?>	
		
	</header><!-- .entry-header -->
		<?php if( $news_box_img_top_bottom == 'bottom-img' ): ?>
		<figure class="single-cbimg">
			<?php 
			 news_box_thumbnail_item_view(get_the_ID());
			?>
		</figure>
		<?php endif; ?>
	<?php endif; ?>
	<?php if( $news_bonews_box_heading != 'classic' ): ?>
	<div class="single-img-meta">
		<figure class="single-smart-img">
		<?php news_box_thumbnail_item_view(get_the_ID()); ?>
		</figure>
		<div class="single-top-meta">
			<div class="meta-single">
			<?php
			if( !empty($newsbox_single_post_time) ){
			 news_box_posted_on();  
			}
			?>
			</div>
			<?php if ( 'post' === get_post_type() && !empty($newsbox_single_post_cat) ) : ?>
			<div class="meta-single post-category xdot">
				<?php news_box_category_link(); ?>
			</div>
			<?php endif; ?>
			<?php if ( ! post_password_required() && ( comments_open() && get_comments_number() ) ): ?>
			<div class="meta-single xdot">
			<?php news_box_single_comment_icon(); ?>
			</div>
			<?php endif; ?>	
		</div>
	</div>
	<?php endif; ?>
	<div class="entry-content">
	<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading...<span class="screen-reader-text"> "%s"</span>', 'news-box-pro' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'news-box-pro' ),
			'after'  => '</div>',
		) );
	


		?>
	</div><!-- .entry-content -->

	<div class="post-footer-meta">
		<div class="row">
			<div class="col-sm-8">
				<?php if($news_box_post_single_tag): ?>
				<div class="single-post-tags">
				<?php news_box_tag_link(); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-4">
				<div class="post-footer-right text-right">
				<?php news_box_post_advance_feature(get_the_ID()); ?>
				</div>
			</div>
		</div>
	
	</div>
	<footer class="entry-footer">
		<?php 
		if(!empty($news_box_post_social)){
			news_box_post_share_links('social-icons');
			}  
		?>
	</footer><!-- .entry-footer -->
	<?php if(!empty($news_box_post_single_author)): ?>
	<div class="author-details">
	<?php 
	get_template_part( 'template-parts/post/single-post','author'); 
	
	?>
	</div>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->