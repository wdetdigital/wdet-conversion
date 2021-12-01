<?php

// enqueue the patent style for child theme

Function news_box_pro_child_enqueue_scripts() {

wp_enqueue_style("parent-style",get_parent_theme_file_uri("/style.css"));

}
add_action( 'wp_enqueue_scripts', 'news_box_pro_child_enqueue_scripts');
