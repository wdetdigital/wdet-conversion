<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package news-box-pro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'news_box_body_classes' ) ) :
function news_box_body_classes( $classes ) {
	$news_bonews_box_style = get_theme_mod( 'news_bonews_box_style', 'grid-masonry' ); 
	$news_bonews_box_border = get_theme_mod( 'news_bonews_box_border', 'shadow' ); 

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for preloader 
		$classes[] = 'preloader';
	
	//News Box post style class
		$classes[] = 'post-style-'.$news_bonews_box_style;
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// add extra class for grid layout
	if ( !empty($news_bonews_box_border) ) {
		$classes[] = 'border-'.$news_bonews_box_border;
	}
	// add extra class for grid layout
	if ( $news_bonews_box_style == 'grid' || $news_bonews_box_style == 'grid-masonry' ) {
		$classes[] = 'grid-layout';
	}else{
		$classes[] = 'simple-layout';
	}

	return $classes;
}
add_filter( 'body_class', 'news_box_body_classes' );
endif;

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if ( ! function_exists( 'news_box_pingback_header' ) ) :
function news_box_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'news_box_pingback_header' );
endif;

if ( ! function_exists( 'news_box_header_search_form' ) ) :
function news_box_header_search_form($form){
	$homedir = home_url( '/');
	$label_value = __('Search','news-box-pro');
	
    $form = '<form class="search-form" role="search" method="get" action="'.esc_url($homedir).'">
        <div class="form-group" id="search">
          <input type="text" class="form-control xpro-serch-form" name="s" placeholder="'.$label_value.'">
          <button type="submit" class="form-control form-control-submit search-submit"><i class="fas fa-search"></i></button>
        </div>
		</form>';             
	 
	 return $form;
}
$news_box_header_style = get_theme_mod( 'news_box_header_style', 'one' );
if( $news_box_header_style=== 'two' ){
	add_filter( 'get_search_form', 'news_box_header_search_form');
}
endif;

if ( ! function_exists( 'news_box_count_post_visits' ) ) :
// popular post show 
function news_box_count_post_visits() {
 if( is_single() ) {
 global $post;
 $views = get_post_meta( $post->ID, 'newsbox_post_viewed', true );
 if( $views == '' ) {
 update_post_meta( $post->ID, 'newsbox_post_viewed', '1' ); 
 } else {
 $views_no = intval( $views );
 update_post_meta( $post->ID, 'newsbox_post_viewed', ++$views_no );
 }
 }
}
endif;
add_action( 'wp_head', 'news_box_count_post_visits' );

// post thumbnail item view set 
if ( ! function_exists( 'news_box_thumbnail_item_view' ) ) :
function news_box_thumbnail_item_view($post_id,$img_size = ''){
	$newsbox_post_format = get_post_format($post_id) ? : 'standard';
$xpro_metabox_videos = get_post_meta( $post_id,'xpro_metabox_videos',true ); 
$xpro_video_slider = !empty($xpro_metabox_videos['xpro_video_slider'])?$xpro_metabox_videos['xpro_video_slider']:'';
$xpro_metabox_audio = get_post_meta( get_the_ID(),'xpro_metabox_audio',true ); 
$xpro_audio_id = !empty($xpro_metabox_audio['xpro_audio_id'])?$xpro_metabox_audio['xpro_audio_id']:'';
// gallery meta
$xpro_metabox_gallery = get_post_meta( get_the_ID(),'xpro_metabox_gallery',true ); 
$xpro_gallery_ids = !empty($xpro_metabox_gallery['xpro_gallery'])?$xpro_metabox_gallery['xpro_gallery']:'';
			// for standard post format
			if($newsbox_post_format == 'standard'):

			   newsbox_video_icon_thumb($post_id);

			endif;
 			 ?>
	<?php if($newsbox_post_format == 'video'): ?>
		<?php if( !empty($xpro_video_slider) ): ?>
				<div class="xpro-video-container">
					<div class="owl-carousel xpro-video video-slider">
						<?php
						 foreach ($xpro_video_slider as $value):
						 	$xpro_videoid = xpro_youtube_id($value['xpro_youtbe_url']);
						  ?>
						  <div class="item">
						      <iframe src="//www.youtube.com/embed/<?php echo esc_attr($xpro_videoid); ?>?enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						  </div>
						
			  			<?php 
			  			endforeach;
			  			 ?>
					</div>
				</div>
				<?php else: ?>
					<?php the_post_thumbnail(); ?>
				<?php endif; ?>
	<?php endif; 

	if($newsbox_post_format == 'audio'): ?>
		<?php if( !empty($xpro_audio_id) ): ?>
		<div class="xpro-audio-container">
			<div class="xpro-audio">
	    		<iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="//w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo esc_attr($xpro_audio_id); ?>&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
			</div>
		</div>
		<?php else: ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
	<?php endif;

	if($newsbox_post_format == 'gallery' ): ?>
		<?php if(!empty($xpro_gallery_ids)): ?>
		<div class="xpro-gallery-container">
			<div class="xpro-gallery owl-carousel">
				<?php 
				 $xpro_gallery_ids = explode( ',', $xpro_gallery_ids );
				  foreach ( $xpro_gallery_ids as $id ):
				    $attachment = wp_get_attachment_image_src( $id, 'full' );
				    ?>
				<div class="item">
	    			<img src="<?php echo esc_url($attachment[0]); ?>" alt="<?php esc_html_e('Gallery image','news-box-pro'); ?>">
	    		</div>
			<?php
				 endforeach
				 ?>
	    		
	    
			</div>
		</div>
		<?php else: ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
	<?php endif; 

	if($newsbox_post_format == 'image'): 
	 the_post_thumbnail( 'post-thumbnail', array('class' => 'img-responsive img-zoom',) ); 
	 endif;
	
	if($newsbox_post_format == 'aside'):
		if(has_post_thumbnail()){
			the_post_thumbnail($img_size);
		}else{  ?>
	 <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/asid-img.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
	<?php
		}
	 endif;
	if($newsbox_post_format == 'link'):
		if(has_post_thumbnail()){
			the_post_thumbnail($img_size);
		}else{  ?>
	 <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/link-img.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
	<?php
		}
	 endif; 
	if($newsbox_post_format == 'quote'):
		if(has_post_thumbnail()){
			the_post_thumbnail($img_size);
		}else{  ?>
	 <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/quote-img.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
	<?php
		}
	 endif; 



}
endif;

//Admin notice 
/*function newsbox_main_base_text() {
	$newbox_page = !empty($_GET["page"])? $_GET["page"]: '';
	$news_boxlCode=get_option("NewsBoxPro_lic_Key","");
    $newsbox_mail=get_option( "NewsBoxPro_lic_email","");
    
	if(NewsBoxProBase::CheckWPPlugin($news_boxlCode,$newsbox_mail,$error,$responseObj,__FILE__) || $newbox_page == 'news-box-pro'  ){
        return;
    }
	$class = 'eye-notice notice notice-warning';
	$message = __( '<strong><span style="color:red">Warning: Need to activate the theme with your purchesed licence key for unloack all pro features. Inactive theme not secure for your site. So active your theme with licence key and secure your site with get full features, updates and premium support.</span></strong> ', 'news-box-pro' );

    $url1 = esc_url(get_admin_url().'themes.php?page=news-box-pro');
    

	printf( '<div class="%1$s" style="padding:10px 15px 20px;"><p>%2$s</p><a class="button button-danger" href="%3$s" style="margin-right:10px">'.__('Active Now','news-box-pro').'</a></div>', esc_attr( $class ), wp_kses_post( $message ),$url1 ); 
}
add_action( 'admin_notices', 'newsbox_main_base_text' );*/


if( !function_exists('newsbox_video_icon_thumb') ):
function newsbox_video_icon_thumb( $id, $size = 'post-thumbnail', $class = 'newsbox-pimg'){
	$newsbox_posts_video_url = get_post_meta( $id, 'newsbox_posts_video', true );
	$video_host = newsbox_video_host($newsbox_posts_video_url);
	$newsbox_video = $newsbox_posts_video_url;
	$title = get_the_title( $id );

	if(is_single( $post = $id )){
		$nb_video_size = 'maxresdefault.jpg';
	}else{
		$nb_video_size = 'hqdefault.jpg';
	}

if(! has_post_thumbnail( $id ) ):
?>
			<div class="single-post-video">
<?php if( $video_host != 'none' ): ?>
			<a class="newsbox-light video-light" data-autoplay="true" data-vbtype="video" href="<?php echo esc_url($newsbox_video); ?>" title="<?php echo esc_attr($title); ?>">
	<?php if( $video_host == 'youtube' ): ?>
			 <img src="<?php echo esc_url('//img.youtube.com/vi/'.news_box_youtube_id($newsbox_video).'/'.esc_attr($nb_video_size));?>" 
			 alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" />
 	<?php endif; ?>
	<?php if( $video_host == 'vimeo' ): ?>
			 <img src="<?php echo esc_url(newsbox_vimeo_img_thumb($newsbox_video));?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" />
 	<?php endif; ?>
			 <div class="play-btn"><i class="far fa-play-circle"></i></div>
			</a>
		
<?php else: ?>
	<img class="no-img" alt="<?php esc_html_e('No recent image','news-box-pro'); ?>" src="<?php echo get_template_directory_uri().'/assets/img/feature-cat-default.png'; ?>">
<?php endif; ?>
			</div>
<?php else: ?>
	<div class="post-video-img">
	<?php 
	echo get_the_post_thumbnail( $id,$size,array('class'=>$class) );
	
	 ?>
		<?php if( !empty($newsbox_posts_video_url) ): ?>
		<div class="single-video-icon">
			<a class="newsbox-light video-light" data-autoplay="true" data-vbtype="video" href="<?php echo esc_url($newsbox_video); ?>" title="<?php echo esc_attr($title); ?>">
				 <div class="play-btn"><i class="fas fa-video"></i></div>
			</a>
		</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php
}
endif;

if( ! function_exists( 'newsbox_video_host' ) ) :
function newsbox_video_host($url) {
    if(strpos($url, 'youtube') > 0) {
        return 'youtube';
    }elseif(strpos($url, 'youtu') > 0) {
        return 'youtube';
    }elseif(strpos($url, 'vimeo') > 0) {
        return 'vimeo';
    } else {
        return 'none';
    }
}
endif;

