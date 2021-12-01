<?php
/*
*
* Extra function for News Box WordPress theme
*
*/
// youtube video id from youtube video url
if ( ! function_exists( 'xpro_youtube_id' ) ) : 
    function xpro_youtube_id($url = '') {
    
        $match = array();
    
        $id = '';
    
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            $id = $match[1];
        }
    
        return $id;
    
    }
endif;
if ( ! function_exists( 'news_box_get_term_options' ) ) : 
function news_box_get_term_options( $taxonomy , $default = '',$name= '') {
 global $wp_version;
	if ( $wp_version >= 4.5 ) {
  	$args=array(
			'taxonomy' => $taxonomy,
			'orderby'    => 'count',
			'hide_empty' => 0,
		); 
		 $terms = get_terms($args ); 
	}else{ 
	$args=array(
		'orderby'    => 'count',
		'hide_empty' => 0,
		); 
	 $terms = get_terms( $taxonomy,$args ); 
		
		}

		$xblg_cat_name = !empty($name)? $name :__('category','news-box-pro'); 	
		$cat= array();
		if($default == 'all'){
		$cat['all']=  sprintf(__('Latest','news-box-pro') .' %s',$xblg_cat_name);
		}else{
		$cat['']= sprintf(__('Select ','news-box-pro') .' %s',$xblg_cat_name);
		}

		 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ):
        foreach ($terms as $term) :
			$cat[$term->slug ] = esc_html($term->name);
        endforeach;
		endif;
		 
    return $cat; 
}
endif;
 


if ( ! function_exists( 'news_box_comment_form_filed_change' ) ) :
function news_box_comment_form_filed_change($fields){
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_fields','news_box_comment_form_filed_change');
endif;

// news-box-pro post navigation 
if ( ! function_exists( 'news_box_single_navigation' ) ) :
function news_box_single_navigation(){
	$news_box_prev_post = get_previous_post();
	$news_box_prev_post_thumb = get_the_post_thumbnail($news_box_prev_post, 'thumbnail');
	$news_box_nav_imgclass = 'nav-text';
	if($news_box_prev_post_thumb){
		$news_box_nav_imgclass = 'nav-img'; 
	}

    $news_box_next_post = get_next_post();
    $news_box_prev_next_thumb = get_the_post_thumbnail($news_box_next_post, 'thumbnail');
	$news_box_navnext_imgclass = 'nav-text';
	if($news_box_prev_next_thumb){
		$news_box_navnext_imgclass = 'nav-img'; 
	}

?>
<?php if (!empty( $news_box_prev_post ) || !empty( $news_box_next_post )): ?>
<nav class="navigation post-navigation news-box-single-navigation mb-5" role="navigation">
	<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation','news-box-pro' ) ?></h2>
	<div class="nav-links">
		<?php if (!empty( $news_box_prev_post )): ?>
		<div class="nav-previous <?php echo esc_attr($news_box_nav_imgclass); ?>">
			<a class="no-opacity np-link" href="<?php echo esc_url(get_the_permalink($news_box_prev_post)); ?>" rel="prev">
				<?php if($news_box_prev_post_thumb): ?>
				<div class="img-icon">
				<?php
			   echo wp_kses_post($news_box_prev_post_thumb); ?>
			   <i class="fas fa-angle-left"></i>
				</div>
				<?php endif; ?>
				<div class="nav-link-text">
					<span><?php esc_html_e( 'Previous post', 'news-box-pro' ) ?></span>
				<h4><?php echo wp_kses_post(wp_trim_words(get_the_title($news_box_prev_post),3,'..')) ?></h4>
				</h4>
				</div>
			</a>
				
		</div>
		<?php endif; ?>
		<?php if (!empty( $news_box_next_post )): ?>
		<div class="nav-next <?php echo esc_attr($news_box_navnext_imgclass); ?>">
			<a class="no-opacity np-link" href="<?php echo esc_url(get_the_permalink($news_box_next_post)); ?>" rel="next">
				<div class="nav-link-text">
					<span><?php esc_html_e( 'Next post', 'news-box-pro' ) ?></span>
				<h4><?php echo wp_kses_post(wp_trim_words(get_the_title($news_box_next_post),3,'..')) ?></h4>
				</div>
				<?php if($news_box_prev_next_thumb): ?>
				<div class="img-icon">
					<i class="fas fa-angle-right"></i>
				<?php
			   echo wp_kses_post($news_box_prev_next_thumb); ?>
				</div>
				<?php endif; ?>
				
			</a>

		</div>
		<?php endif; ?>
	</div>
</nav>
<?php
endif;
}
endif;

if ( ! function_exists( 'news_box_related_post' ) ) :
function news_box_related_post(){

global $post;
$news_box_related_terms = get_the_terms( get_the_ID(), 'category' );
if(!$news_box_related_terms){
	return;
}
$news_box_term_list = wp_list_pluck( $news_box_related_terms, 'slug' );
$news_box_related_args= array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page' => 3,
	'post__not_in' => array(get_the_ID()),
	'orderby' => 'rand',
	'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => $news_box_term_list
		)
	)
);

$news_box_related_query = new WP_Query($news_box_related_args);
if( $news_box_related_query->have_posts() ): ?>

<div class="related-post mb-5">
	<h3 class="related-title text-center mb-4"><?php esc_html_e('You may also like','news-box-pro'); ?></h3>
	<div class="row">
<?php
while ($news_box_related_query->have_posts()) : $news_box_related_query->the_post();
 ?>
		<div class="col-xs-12 col-sm-4">
			<div class="related-single">
				<div class="related-thumb">
					<?php newsbox_video_icon_thumb(get_the_ID()); ?>
				</div>
				<div class="content">
					<div class="related post-meta">
						<?php news_box_posted_on();  ?>
					</div>
					<a href="<?php the_permalink(); ?>"><h4 class="text-capitalize"><?php the_title(); ?></h4></a>
				</div>
			</div>
		</div>
 <?php
endwhile; ?>
	</div>
</div>
<?php 
endif;
wp_reset_query();


}
endif;

if ( ! function_exists( 'news_box_pagination' ) ) :
function news_box_pagination(){
	global $wp_query;
	$links = get_the_posts_pagination( array(
		'current' => max(1,get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'type' =>'list',
		'mid_size' =>3,
		'prev_text'          => false,
    	'next_text'          => false,
	) );
	$links = str_replace("page-numbers", "pagination_num", $links);
	$links = str_replace("<ul class='pagination_num'>", "<ul>", $links);
	$links = str_replace("next pagination_num", "pagination_next", $links);
	$links = str_replace("prev pagination_num", "pagination_prev", $links);

	echo wp_kses_post($links);
}
endif;


//Ads shortcode 
function news_box_ads_shortcode($atts, $content= null){ 

    extract( shortcode_atts( array(
        'title' => '', 
        'type' => 'custom', 
        'code' => '', 
        'img' => '',
        'url' => '#',
    ), $atts) );

    $newsbox_img_src = wp_get_attachment_image_src( $img, 'large' );
?>
	<div class="ads-container mt-5 mb-5">
		<div class="news-box-ads text-center">
			<span class="ads-title"><?php echo esc_html($title); ?></span>
		<?php if($type == 'custom'): ?>
			<div class="news-box-ads-custom">
				<?php if($img): ?>
				<a target="_blank" href="<?php echo esc_url($url); ?>"><img src="<?php echo esc_url($newsbox_img_src[0]); ?>" alt="<?php echo esc_attr__( 'Ads Banner', 'news-box-pro' ); ?>"></a>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<div class="news-box-ads-gcode">
				<?php
				 if($content){
				 	echo wp_kses_post($content);
				 }
				 ?>
			</div>
		<?php endif; ?>
		</div>
	</div>

<?php
}
add_shortcode( 'news-box-ads', 'news_box_ads_shortcode');

//Ads shortcode 
/*function news_box_ads_shows( $title,$type,$code,$img,$url){ 

    $newsbox_img_src = wp_get_attachment_image_src( $img, 'large' );
?>
	<div class="ads-container mt-5 mb-5">
		<div class="news-box-ads text-center">
			<span class="ads-title"><?php echo esc_html($title); ?></span>
		<?php if($type == 'custom'): ?>
			<div class="news-box-ads-custom">
				<?php if($img): ?>
				<a target="_blank" href="<?php echo esc_url($url); ?>"><img src="<?php echo esc_url($newsbox_img_src[0]); ?>" alt="<?php echo esc_attr__( 'Ads Banner', 'news-box-pro' ); ?>"></a>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<div class="news-box-ads-gcode">
				<?php
				 if($code): 
				 	echo wp_kses_post($code);
				 endif; 
				 ?>
			</div>
		<?php endif; ?>
		</div>
	</div>

<?php
}
*/