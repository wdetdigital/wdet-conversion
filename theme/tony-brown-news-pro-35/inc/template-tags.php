<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package news-box-pro
 */

if ( ! function_exists( 'news_box_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the News Box post-date/time.
	 */
	function news_box_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'news-box-pro' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="far fa-clock"></i> ' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'news_box_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the News Box author.
	 */
	function news_box_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'news-box-pro' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> <i class="far fa-user-circle"></i>' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'news_box_card_meta' ) ) :
	/**
	 * Prints HTML with meta information for the News Box author.
	 */
	function news_box_card_meta() {
		?>
	<ul class="card-meta">
		<li class="author">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo esc_html( get_the_author() );  ?></a>
		</li>
		<li><?php echo get_the_date(); ?></li>
	</ul>
		<?php


	}
endif;

if ( ! function_exists( 'news_box_category_link' ) ) :
	/**
	 * Prints HTML with meta information for the News Box author.
	 */
	function news_box_category_link() {
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'news-box-pro' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><i class="far fa-folder-open"></i>' . esc_html__( ' %1$s', 'news-box-pro' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

		} 

	}
endif;

if ( ! function_exists( 'news_box_tag_link' ) ) :
	/**
	 * Prints HTML with meta information for the News Box author.
	 */
	function news_box_tag_link() {
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'news-box-pro' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tag: %1$s', 'news-box-pro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		} 

	}
endif;


if ( ! function_exists( 'news_box_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function news_box_entry_footer() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() && get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( '<span class="screen-reader-text"> on %s</span>', 'news-box-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			,'<i class="far fa-comment-dots"></i> '.__('1','news-box-pro'),'<i class="far fa-comment-dots"></i> '.__('%','news-box-pro'),'comments-link', ' ');
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of News Box post. Only visible to screen readers */
					__( '<i class="far fa-edit"></i><span class="screen-reader-text">%s</span>', 'news-box-pro' ),
					array(
						'span' => array(
							'class' => array(),
						),
						'i' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'news_box_single_comment_icon' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function news_box_single_comment_icon() {
		if ( ! post_password_required() && ( comments_open() && get_comments_number() ) ) {
			echo '<span class="single-comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( '<span class="screen-reader-text"> on %s</span>', 'news-box-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			,__('1 Comment','news-box-pro'),__('% Comments','news-box-pro'),'comments-link', ' ');
			echo '</span>';
		}

	}
endif;

if ( ! function_exists( 'news_box_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function news_box_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		
			?>

			<div class="post-thumbnail">
				<?php newsbox_video_icon_thumb( get_the_ID(),'post-thumbnail'); ?>

			</div><!-- .post-thumbnail -->

<?php 
	}
endif;

if ( ! function_exists( 'news_box_post_share_links' ) ) :
function news_box_post_share_links($main_class){
	?>
	<div class="<?php echo esc_attr($main_class); ?>">
		<?php 
		$xpro_facebookurl_share = 'https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink();
		$xpro_twitter_share = 'https://twitter.com/intent/tweet?url='.get_the_permalink().'&text='.get_the_title();
		$xpro_linkedin_share = 'https://www.linkedin.com/shareArticle?mini=true&url='.get_the_permalink().'&title='.get_the_title().'&summary='.get_the_excerpt();
		$xpro_gplus_share = 'https://plus.google.com/share?url='.get_the_permalink();
		$xpro_pinit_share = 'https://pinterest.com/pin/create/button/?url='.get_the_permalink().'&media='.get_the_post_thumbnail_url(get_the_ID(),'medium').'&description='.get_the_title();
		 ?>
		 
		<ul class="clearfix list-none">
			<li><a data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Facebook share', 'news-box-pro') ?>" href="<?php echo esc_html($xpro_facebookurl_share); ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
			<li><a data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Twitter share', 'news-box-pro') ?>" href="<?php echo esc_html($xpro_twitter_share); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
			<li><a data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Linkedin share', 'news-box-pro') ?>"  href="<?php echo esc_html($xpro_linkedin_share); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
			<li><a data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Google-plus share', 'news-box-pro') ?>" href="<?php echo esc_html($xpro_gplus_share); ?>" target="_blank"><i class="fab fa-google-plus"></i></a></li>
			<li><a data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Pinterest share', 'news-box-pro') ?>" href="<?php echo esc_html($xpro_pinit_share); ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li>
			
		</ul>
	</div>
<?php
}
endif;

if ( ! function_exists( 'news_box_content_word_count' ) ) :
function news_box_content_word_count(){
	$news_box_post_id = get_the_ID();
	$newsbox_content = get_the_content();
	$newsbox_striped_tag = strip_tags($newsbox_content);
	$newsbox_word_count = str_word_count($newsbox_striped_tag);
	$newsbox_count_text = __('Total Words: ','news-box-pro').$newsbox_word_count;
	return $newsbox_count_text;
}
endif;

if ( ! function_exists( 'news_box_content_reading_time' ) ) :
function news_box_content_reading_time(){
	$news_box_post_id = get_the_ID();
	$newsbox_content = get_the_content($news_box_post_id);
	$newsbox_striped_tag = strip_tags( $newsbox_content );
	$newsbox_word_count = str_word_count( $newsbox_striped_tag );
	$newsbox_reading_minute = ceil( $newsbox_word_count / 200 );
	$newsbox_reading_second = ceil( $newsbox_word_count % 200 / (200 / 60) );
	$newsbox_second_zero = $newsbox_reading_second <10? 0: '';
	$newsbox_reading_time = sprintf('%s '.__('Minute','news-box-pro').' : %s%s '.__('Second','news-box-pro'),$newsbox_reading_minute,$newsbox_second_zero,$newsbox_reading_second);
	return $newsbox_reading_time;
}
endif;

if ( ! function_exists( 'news_box_content_qr_code' ) ) :
function news_box_content_qr_code(){
		$newsbox_post_id = get_the_ID();
		$newsbox_post_title = get_the_title( $newsbox_post_id);
		$newsbox_post_url = urlencode(get_the_permalink( $newsbox_post_id));
		$newsbox_post_qr_img = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%sx%s&ecc=L&qzone=1&data=%s', 100,100, $newsbox_post_url);
		$newsbox_qr_img = sprintf('<img class="qrcode" src="%s" alt="%s">', $newsbox_post_qr_img, $newsbox_post_title);
		return $newsbox_qr_img;
}
endif;

if ( ! function_exists( 'news_box_post_advance_feature' ) ) :
function news_box_post_advance_feature($newsbox_post_id){
	$newsbox_post_title = get_the_title( $newsbox_post_id);
	$newsbox_content = get_the_content($newsbox_post_id);
	$newsbox_post_url = urlencode(get_the_permalink( $newsbox_post_id));

	//post word count
	$newsbox_striped_tag = strip_tags($newsbox_content);
	$newsbox_word_count = str_word_count($newsbox_striped_tag);
	$newsbox_count_text = __('Total Words: ','news-box-pro').$newsbox_word_count;

	// post read time
	if( $newsbox_word_count < 100 ){
	$newsbox_reading_minute = floor( $newsbox_word_count / 200 );
	}else{
	$newsbox_reading_minute = ceil( $newsbox_word_count / 200 );
	}
	$newsbox_reading_second = ceil( $newsbox_word_count % 200 / (200 / 60) );
	$newsbox_second_zero = $newsbox_reading_second <10? 0: '';
	$newsbox_reading_time = sprintf('%s '.__('Minute','news-box-pro').' : %s%s '.__('Second','news-box-pro'),$newsbox_reading_minute,$newsbox_second_zero,$newsbox_reading_second);

	// post qr code
	$newsbox_post_qr_img = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%sx%s&ecc=L&qzone=1&data=%s', 100,100, $newsbox_post_url);
	$newsbox_qr_img = sprintf('<img class="qrcode" src="%s" alt="%s">', $newsbox_post_qr_img, $newsbox_post_title);

 $news_box_wordcount = get_theme_mod( 'news_box_wordcount', true );
 $news_box_readingtime = get_theme_mod( 'news_box_readingtime', true );
 $news_box_post_qrcode = get_theme_mod( 'news_box_post_qrcode', true );
 $news_box_post_like_icon = get_theme_mod( 'news_box_post_like_icon', true );

	?>
<ul class="list-none list-inline advance-meta">
	<?php if(!empty($news_box_wordcount)): ?>
	<li><p data-toggle="popover" data-placement="top" data-content='<?php echo esc_html($newsbox_count_text); ?>'><i class="far fa-file-word"></i></p></li>
	<?php endif; ?>
	<?php if(!empty($news_box_readingtime)): ?>
	<li><p data-toggle="popover" data-placement="top" title="<?php esc_html_e('Reading time','news-box-pro'); ?>" data-content='<?php echo esc_html($newsbox_reading_time); ?>'><i class="fas fa-tachometer-alt"></i></p></li>
	<?php endif; ?>
	<?php if(!empty($news_box_post_qrcode)): ?>
	<li><p data-toggle="popover" data-placement="top" data-content='<?php echo wp_kses_post($newsbox_qr_img); ?>'><i class="fas fa-qrcode"></i></p></li>
		<?php endif; ?>
		<?php if(function_exists('wp_ulike') && !empty($news_box_post_like_icon)): ?>
	<li><p data-toggle="popover" data-content='<div class="news-box-like"><?php wp_kses_post(wp_ulike('get')); ?></div>'><i class="fas fa-heart"></i></p></li>
		<?php endif; ?>
</ul>


<?php	
}
endif;

if ( ! function_exists( 'news_box_post_advance_feature_two' ) ) :
function news_box_post_advance_feature_two($newsbox_post_id){
	$newsbox_post_title = get_the_title( $newsbox_post_id);
	$newsbox_content = get_the_content($newsbox_post_id);
	$newsbox_post_url = urlencode(get_the_permalink( $newsbox_post_id));

	//post word count
	$newsbox_striped_tag = strip_tags($newsbox_content);
	$newsbox_word_count = str_word_count($newsbox_striped_tag);
	$newsbox_count_text = __('Total Words: ','news-box-pro').$newsbox_word_count;

	// post read time
	if( $newsbox_word_count < 100 ){
	$newsbox_reading_minute = floor( $newsbox_word_count / 200 );
	}else{
	$newsbox_reading_minute = ceil( $newsbox_word_count / 200 );
	}
	$newsbox_reading_second = ceil( $newsbox_word_count % 200 / (200 / 60) );
	$newsbox_second_zero = $newsbox_reading_second <10? 0: '';
	$newsbox_reading_time = sprintf('%s '.__('Minute','news-box-pro').' : %s%s '.__('Second','news-box-pro'),$newsbox_reading_minute,$newsbox_second_zero,$newsbox_reading_second);

	// post qr code
	$newsbox_post_qr_img = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%sx%s&ecc=L&qzone=1&data=%s', 100,100, $newsbox_post_url);
	$newsbox_qr_img = sprintf('<img class="qrcode" src="%s" alt="%s">', $newsbox_post_qr_img, $newsbox_post_title);

 $news_box_wordcount = get_theme_mod( 'news_box_wordcount', true );
 $news_box_readingtime = get_theme_mod( 'news_box_readingtime', true );
 $news_box_post_qrcode = get_theme_mod( 'news_box_post_qrcode', true );
 $news_box_post_social = get_theme_mod( 'news_box_post_social', true );
 $news_box_post_like_icon = get_theme_mod( 'news_box_post_like_icon', true );


	?>
<ul class="list-none list-inline advance-meta">
	<?php if(!empty($news_box_wordcount)): ?>
	<li><p data-toggle="popover" data-placement="top" data-content='<?php echo esc_html($newsbox_count_text); ?>'><i class="far fa-file-word"></i></p></li>
	<?php endif; ?>
	<?php if(!empty($news_box_readingtime)): ?>
	<li><p data-toggle="popover" data-placement="top" title="<?php esc_html_e('Reading time','news-box-pro'); ?>" data-content='<?php echo esc_html($newsbox_reading_time); ?>'><i class="fas fa-tachometer-alt"></i></p></li>
	<?php endif; ?>
	<?php if(!empty($news_box_post_qrcode)): ?>
	<li><p data-toggle="popover" data-placement="top" data-content='<?php echo wp_kses_post($newsbox_qr_img); ?>'><i class="fas fa-qrcode"></i></p></li>
	<?php endif; ?>
	<?php if(!empty($news_box_post_social)): ?>
	<li><p data-toggle="popover" data-placement="top" data-content='<?php echo wp_kses_post(news_box_post_share_links('social-share')); ?>'><i class="fas fa-share-alt"></i></p></li>
	<?php endif; ?>
		<?php if(function_exists('wp_ulike') && !empty($news_box_post_like_icon)): ?>
	<li><p data-toggle="popover" data-content='<div class="news-box-like"><?php wp_kses_post(wp_ulike('get')); ?></div>'><i class="fas fa-heart"></i></p></li>
		<?php endif; ?>
</ul>


<?php	
}
endif;