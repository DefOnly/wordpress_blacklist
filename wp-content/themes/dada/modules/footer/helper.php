<?php
add_action( 'dada_after_main_css', 'footer_style' );
function footer_style() {
    wp_enqueue_style( 'dada-footer', get_theme_file_uri('/modules/footer/assets/css/footer.css'), false, DADA_THEME_VERSION, 'all');
}

add_action( 'dada_footer', 'footer_content' );
function footer_content() {
    dada_template_part( 'content', 'content', 'footer' );
}