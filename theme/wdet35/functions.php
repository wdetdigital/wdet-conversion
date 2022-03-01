<?php

function add_authors($content) {
	do_action('pp_multiple_authors_show_author_box', false, 'inline');
	return $content;
}
add_filter('the_content', 'add_authors');

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

add_post_type_support( 'page', 'excerpt' );
