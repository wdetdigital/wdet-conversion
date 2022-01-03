<?php
/*
*
* Popular post show by this template 
*
*/

$news_box_bottom_title = get_theme_mod( 'news_box_bottom_title',__('Popular News','news-box-pro') );
$news_box_feature_type = get_theme_mod( 'news_box_bottom_post_from', 'popular' );
$news_box_cat_select = get_theme_mod( 'news_box_bottom_category', 'all' );
$newsbox_fbottom_post_number = get_theme_mod( 'newsbox_bottom_items', 4 );
$newsbox_bottoms_column = get_theme_mod( 'newsbox_bottoms_column', '3' );
$newsbox_bottom_style = get_theme_mod( 'news_box_bottoms_style', 'two' );
$newsbox_feature_bottom_cat = get_theme_mod( 'news_box_bottom_category', 'all' );
$newsbox_feature_bottom_author = get_theme_mod( 'news_box_bottom_show_author', 1 );
$newsbox_feature_bottom_date = get_theme_mod( 'newsbox_feature_bottom_date', 1 );
$newsbox_feature_bottom_icons = get_theme_mod( 'newsbox_bottom_advance', 1 );
$newsbox_feature_bottom_imghover = get_theme_mod( 'newsbox_bottom_imghover', 1 );
$newsbox_feature_bottom_readmore = get_theme_mod( 'newsbox_bottom_redmore', 1 );
$newsbox_feature_bottom_border = get_theme_mod( 'newsbox_bottom_border', 1 );




if( $news_box_feature_type== 'cat' ){
	if($news_box_cat_select == 'all'){
			$terms ='';
		}
		else{
			$terms = array(
				array(
					'taxonomy'  => 'category',
					'field'  => 'slug',
					'terms'  => $news_box_cat_select
				)
			);
		}
		$newsbox_feature_bottom_args = array(
			'post_type'  		=>	'post',
			'post_status'  		=>	'publish',
			'posts_per_page' 	=> $newsbox_fbottom_post_number,
			'tax_query' 	    =>	$terms,
		);
}elseif( $news_box_feature_type== 'popular' ){
	$newsbox_feature_bottom_args = array(
		'post_type'  		=>	'post',
		'post_status'  		=>	'publish',
		'posts_per_page' => $newsbox_fbottom_post_number,
		 'meta_key' => 'newsbox_post_viewed',
		 'orderby' => 'meta_value_num',
		 'order'=> 'DESC'
	);

}else{
	$newsbox_feature_bottom_args = array(
		'post_type'  		=>	'post',
		'post_status'  		=>	'publish',
		'posts_per_page' => $newsbox_fbottom_post_number,
		 'order'=> 'DESC'
	);

}



 
$newsbox_feature_bottom_posts_loop = new WP_Query( $newsbox_feature_bottom_args );
?>

<center>
<!-- /127394106/WDET_middle_970x250 -->
<div id="div-gpt-ad-1641174661582-0" style="min-width: 728px; min-height: 90px;"><script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1641174661582-0'); });
  </script></div>
</center>
<div class="<?php echo esc_attr($newsbox_feature_bottom_border); ?>">
	<div class="section-title bottom-title">
		<h2><?php echo esc_html($news_box_bottom_title); ?></h2>
	</div>
<div class="row">
	
<?php
while( $newsbox_feature_bottom_posts_loop->have_posts() ):
 $newsbox_feature_bottom_posts_loop->the_post();

//random category
$news_box_categories = get_the_category();
	if($news_box_categories){
		$news_box_category = $news_box_categories[mt_rand(0,count( $news_box_categories)-1)];
	}else{
		$news_box_category = '';
	}
$newsbox_post_format = get_post_format(get_the_ID()) ? : 'standard';
$newsbox_metabox_videos = get_post_meta( get_the_ID(),'newsbox_metabox_videos',true ); 
$newsbox_video_slider = !empty($newsbox_metabox_videos['newsbox_video_slider'])?$newsbox_metabox_videos['newsbox_video_slider']:'';
  ?>
 	
 	<div class="col-md-<?php echo esc_attr($newsbox_bottoms_column); ?>">
 		<div <?php post_class('bottom-feature'); ?>>
<?php if($newsbox_bottom_style == 'one'): ?>

		<div class="single-grid popular-two grid1 <?php if($newsbox_feature_bottom_imghover): ?>hvr-img <?php endif; ?>">
			<div class="grid-img">
				<figure>
				<?php // the_post_thumbnail(); ?>
				    <?php newsbox_video_icon_thumb( get_the_ID(),'post-thumbnail' ); ?>

				</figure>
			</div>
			<div class="grid-content">
				<?php if(!empty($newsbox_feature_bottom_icons)): ?>
				<div class="grid-advance show-item">
					<?php news_box_post_advance_feature_two(get_the_ID()); ?>
					<a class="adshow" href="#"><i class="fas fa-plus"></i></a>
				</div>
				<?php endif; ?>
				<div class="grid-text">
					<?php if( $newsbox_feature_bottom_cat != 'hide' ): ?>
					<div class="card-meta">
					<?php if( $newsbox_feature_bottom_cat == 'all' ): ?>
					<?php news_box_category_link(); ?>
					<?php endif; ?>
					<?php if( $newsbox_feature_bottom_cat == 'one' ): ?>
					<span class="cat-links"><a href="<?php echo esc_url(get_category_link($news_box_category)); ?>"><?php echo esc_html($news_box_category->name); ?></a>
						</span>
					<?php endif; ?>
					</div>
				<?php endif; ?>
					<h4 class="grid-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php echo wp_trim_words( get_the_title(), 6, '..' ); ?></a>
					</h4>
					<div class="card-meta title-bottom">
					<?php
					if(!empty($newsbox_feature_bottom_author)){ 
						news_box_posted_by(); 
					} 
					if(!empty($newsbox_feature_bottom_date)){
						news_box_posted_on(); 
					}
					?>
					</div>
					<div class="entry-content">
						<p class="card-text">
							<?php echo wp_trim_words( get_the_content(), 20, '..' ); ?>
								
							</p>
						<?php if(!empty($newsbox_feature_bottom_readmore)): ?>
						<a class="readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'news-box-pro' ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php elseif(($newsbox_bottom_style == 'two')): ?>
		<div class="single-grid popular-item grid2 <?php if($newsbox_feature_bottom_imghover): ?>hvr-img <?php endif; ?>">
			<div class="grid-img">
				<figure>
				<?php //the_post_thumbnail(); ?>
				<?php newsbox_video_icon_thumb( get_the_ID(),'post-thumbnail' ); ?>

				</figure>
				<?php 
				if(!empty($newsbox_feature_bottom_icons)){
				news_box_post_advance_feature_two(get_the_ID());
				}

				 ?>
			</div>
			<div class="grid-content">
				<div class="grid-text">
					<div class="card-meta">
					<?php if( $newsbox_feature_bottom_cat == 'all' ): ?>
					<?php news_box_category_link(); ?>
					<?php endif; ?>
					<?php if( $newsbox_feature_bottom_cat == 'one' ): ?>
					<span class="cat-links"><a href="<?php echo esc_url(get_category_link($news_box_category)); ?>"><?php echo esc_html($news_box_category->name); ?></a>
						</span>
					<?php endif; ?>
					</div>
					<h4 class="grid-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php echo wp_trim_words( get_the_title(), 6, '..' ); ?></a>
					</h4>
					<div class="card-meta title-bottom">
					<?php
					if(!empty($newsbox_feature_bottom_author)){ 
						news_box_posted_by(); 
					}  
					if(!empty($newsbox_feature_bottom_date)){
						news_box_posted_on(); 
					}
					?>
					</div>
					<div class="entry-content">
						<p class="card-text">
							<?php echo wp_trim_words( get_the_content(), 20, '..' ); ?>
								
							</p>
						<?php if(!empty($newsbox_feature_bottom_readmore)): ?>
						<a class="readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'news-box-pro' ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php else: ?>
		<div class="single-grid grid3 <?php if($newsbox_feature_bottom_imghover): ?>hvr-img <?php endif; ?>">
			<div class="grid-img">
				<div class="single-post-thumb">
				<?php // the_post_thumbnail(); ?>
				<?php newsbox_video_icon_thumb( get_the_ID(),'post-thumbnail' ); ?>

				</div>	
			</div>
			<div class="grid-content">
				<?php if($newsbox_post_format != 'video'): ?>
				<div class="post-meta grid-meta">
					<div class="slider-meta post-category">
					<?php if(!empty($newsbox_feature_bottom_date)): ?>
					<span class="slider-time"><?php echo get_the_date( 'M j, Y'); ?></span>
					<?php endif; ?>
					<?php if($newsbox_feature_bottom_cat == 'one' || $newsbox_feature_bottom_cat == 'all'): ?>
						<span class="slider-cat">
							<a href="<?php echo esc_url(get_category_link($news_box_category)); ?>"><?php echo esc_html($news_box_category->name); ?></a>
						</span>
					<?php endif; ?>

					</div>
				</div>
				
				<center>
<!-- /127394106/WDET_middle_970x250 -->
<div id="div-gpt-ad-1641174661582-0" style="min-width: 728px; min-height: 90px;"><script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1641174661582-0'); });
  </script></div>
</center>
				<?php endif; ?>
				
					
				
				<div class="grid-text">
					<h4 class="grid-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php echo wp_trim_words( get_the_title(), 6, '..' ); ?></a>
					</h4>
					 <div class="entry-content">
					 	<?php if($newsbox_post_format == 'video'): ?>
						<?php echo wp_trim_words( get_the_content(), 20, '...' ) ?>
						<?php else: ?>
						<?php echo wp_trim_words( get_the_content(), 25, '...' ) ?>
						<?php endif; ?>
						<?php if(!empty($newsbox_feature_bottom_readmore)): ?>
						<a class="readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'news-box-pro' ); ?></a>
						<?php endif; ?>
					</div><!-- .entry-content -->
					<div class="grid-footer-meta advance-options text-center">
					<?php
					if(!empty($newsbox_feature_bottom_icons)){
				news_box_post_advance_feature_two(get_the_ID());
				}
					 ?>
					</div>	
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
	</div>
	

	
	
<?php
endwhile;
wp_reset_query();
?>
</div>
</div>
