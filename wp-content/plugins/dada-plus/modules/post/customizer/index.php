<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusCustomizerBlogPost' ) ) {
    class DadaPlusCustomizerBlogPost {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
			add_action( 'customize_register', array( $this, 'register' ), 15 );
        }

        function register( $wp_customize ) {

            $wp_customize->add_section(
                new Dada_Customize_Section(
                    $wp_customize,
                    'site-blog-post-section',
                    array(
                        'title'    => esc_html__('Single Post', 'dada-plus'),
                        'panel'    => 'site-blog-main-panel',
                        'priority' => 20,
                    )
                )
            );

			if ( ! defined( 'DADA_PRO_VERSION' ) ) {
				$wp_customize->add_control(
					new Dada_Customize_Control_Separator(
						$wp_customize, DADA_CUSTOMISER_VAL . '[dada-plus-site-single-blog-separator]',
						array(
							'type'        => 'wdt-separator',
							'section'     => 'site-blog-post-section',
							'settings'    => array(),
							'caption'     => DADA_PLUS_REQ_CAPTION,
							'description' => DADA_PLUS_REQ_DESC,
						)
					)
				);
			}

        }
    }
}

DadaPlusCustomizerBlogPost::instance();