<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (! class_exists ( 'DadaPlusHeaderPostType' ) ) {

	class DadaPlusHeaderPostType {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

		function __construct() {

			add_action ( 'init', array( $this, 'dada_register_cpt' ), 5 );
			add_filter ( 'template_include', array ( $this, 'dada_template_include' ) );
		}

		function dada_register_cpt() {

			$labels = array (
				'name'				 => __( 'Headers', 'dada-plus' ),
				'singular_name'		 => __( 'Header', 'dada-plus' ),
				'menu_name'			 => __( 'Headers', 'dada-plus' ),
				'add_new'			 => __( 'Add Header', 'dada-plus' ),
				'add_new_item'		 => __( 'Add New Header', 'dada-plus' ),
				'edit'				 => __( 'Edit Header', 'dada-plus' ),
				'edit_item'			 => __( 'Edit Header', 'dada-plus' ),
				'new_item'			 => __( 'New Header', 'dada-plus' ),
				'view'				 => __( 'View Header', 'dada-plus' ),
				'view_item' 		 => __( 'View Header', 'dada-plus' ),
				'search_items' 		 => __( 'Search Headers', 'dada-plus' ),
				'not_found' 		 => __( 'No Headers found', 'dada-plus' ),
				'not_found_in_trash' => __( 'No Headers found in Trash', 'dada-plus' ),
			);

			$args = array (
				'labels' 				=> $labels,
				'public' 				=> true,
				'exclude_from_search'	=> true,
				'show_in_nav_menus' 	=> false,
				'show_in_rest' 			=> true,
				'menu_position'			=> 25,
				'menu_icon' 			=> 'dashicons-heading',
				'hierarchical' 			=> false,
				'supports' 				=> array ( 'title', 'editor', 'revisions' ),
			);

			register_post_type ( 'wdt_headers', $args );
		}

		function dada_template_include($template) {
			if ( is_singular( 'wdt_headers' ) ) {
				if ( ! file_exists ( get_stylesheet_directory () . '/single-wdt_headers.php' ) ) {
					$template = DADA_PLUS_DIR_PATH . 'post-types/templates/single-wdt_headers.php';
				}
			}

			return $template;
		}
	}
}

DadaPlusHeaderPostType::instance();