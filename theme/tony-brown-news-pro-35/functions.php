<?php

// enqueue the patent style for child theme

function news_box_pro_child_enqueue_scripts() {
  wp_enqueue_style("parent-style", get_parent_theme_file_uri("/style.css"));
  wp_enqueue_script("captions", get_stylesheet_directory_uri()."/captions.js", array("jquery"), false, true);
}
add_action( 'wp_enqueue_scripts', 'news_box_pro_child_enqueue_scripts');

// add excerpt filter

function add_excerpt($content) {
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
add_filter('the_content', 'add_excerpt');
