<?php

// enqueue the patent style for child theme

function news_box_pro_child_enqueue_scripts() {
  wp_enqueue_style("parent-style", get_parent_theme_file_uri("/style.css"));
  wp_enqueue_script("captions", get_stylesheet_directory_uri()."/captions.js", array("jquery"), false, true);
}
add_action( 'wp_enqueue_scripts', 'news_box_pro_child_enqueue_scripts');
