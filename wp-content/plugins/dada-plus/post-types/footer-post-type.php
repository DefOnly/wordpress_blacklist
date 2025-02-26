<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (! class_exists ( 'DadaPlusFooterPostType' ) ) {

	class DadaPlusFooterPostType {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

		function __construct() {

			add_action ( 'init', array( $this, 'dada_register_cpt' ) );
			add_filter ( 'template_include', array ( $this, 'dada_template_include' ) );
		}

		function dada_register_cpt() {

			$labels = array (
				'name'				 => __( 'Footers', 'dada-plus' ),
				'singular_name'		 => __( 'Footer', 'dada-plus' ),
				'menu_name'			 => __( 'Footers', 'dada-plus' ),
				'add_new'			 => __( 'Add Footer', 'dada-plus' ),
				'add_new_item'		 => __( 'Add New Footer', 'dada-plus' ),
				'edit'				 => __( 'Edit Footer', 'dada-plus' ),
				'edit_item'			 => __( 'Edit Footer', 'dada-plus' ),
				'new_item'			 => __( 'New Footer', 'dada-plus' ),
				'view'				 => __( 'View Footer', 'dada-plus' ),
				'view_item' 		 => __( 'View Footer', 'dada-plus' ),
				'search_items' 		 => __( 'Search Footers', 'dada-plus' ),
				'not_found' 		 => __( 'No Footers found', 'dada-plus' ),
				'not_found_in_trash' => __( 'No Footers found in Trash', 'dada-plus' ),
			);

			$args = array (
				'labels' 				=> $labels,
				'public' 				=> true,
				'exclude_from_search'	=> true,
				'show_in_nav_menus' 	=> false,
				'show_in_rest' 			=> true,
				'menu_position'			=> 26,
				'menu_icon' 			=> 'dashicons-editor-insertmore',
				'hierarchical' 			=> false,
				'supports' 				=> array ( 'title', 'editor', 'revisions' ),
			);

			register_post_type ( 'wdt_footers', $args );
		}

		function dada_template_include($template) {
			if ( is_singular( 'wdt_footers' ) ) {
				if ( ! file_exists ( get_stylesheet_directory () . '/single-wdt_footers.php' ) ) {
					$template = DADA_PLUS_DIR_PATH . 'post-types/templates/single-wdt_footers.php';
				}
			}

			return $template;
		}
	}
}

DadaPlusFooterPostType::instance();