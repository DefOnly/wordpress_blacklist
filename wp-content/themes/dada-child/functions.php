<?php
add_action( 'wp_enqueue_scripts', 'dada_child_enqueue_styles', 100);
function dada_child_enqueue_styles() {
	wp_enqueue_style( 'dada-parent', get_theme_file_uri('/style.css') );
}