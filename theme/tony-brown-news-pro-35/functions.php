<?php

// enqueue the patent style for child theme

function news_box_pro_child_enqueue_scripts() {
  wp_enqueue_style("parent-style", get_parent_theme_file_uri("/style.css"));
  wp_enqueue_script("captions", get_stylesheet_directory_uri()."/captions.js", array("jquery"), false, true);
}
add_action( 'wp_enqueue_scripts', 'news_box_pro_child_enqueue_scripts');

// add excerpt filter

function add_authors_excerpt($content) {
	do_action('pp_multiple_authors_show_author_box', false, 'inline');
	if (has_excerpt()) {
		$excerpt = get_the_excerpt();
		$content = <<<EOT
<div class="article-preview margin-leader margin-trailer clearfix text-center">
	<strong>
		$excerpt
	</strong>
</div>
$content
EOT;
	}
	return $content;
}
add_filter('the_content', 'add_authors_excerpt');

function add_audio($html) {
	$audio = get_field('featured_audio');
	if ( $audio && is_single() ) {
		$html = <<<EOT
<audio controls style="width: 100%">
  	<source src="$audio" type="audio/mpeg">
	Your browser does not support the audio element.
</audio>
$html
EOT;
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'add_audio' );
