<?php

if( ! function_exists('dada_event_breadcrumb_title') ) {
    function dada_event_breadcrumb_title($title) {
        if( get_post_type() == 'tribe_events' && is_single()) {
            $etitle = esc_html__( 'Event Detail', 'dada' );
            return '<h1>'.$etitle.'</h1>';
        } else {
            return $title;
        }
    }

    add_filter( 'dada_breadcrumb_title', 'dada_event_breadcrumb_title', 20, 1 );
}

?>