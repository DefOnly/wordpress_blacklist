<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusDarkColor' ) ) {
    class DadaPlusDarkColor {
        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_filter( 'dada_plus_customizer_default', array( $this, 'default' ) );
            add_action( 'customize_register', array( $this, 'register' ), 15);

           //Dark Mode starts
            add_filter( 'dada_dark_body_bg_color_css_var', array( $this, 'dark_body_bg_color_var' ) );
            add_filter( 'dada_dark_body_bg_rgb_color_css_var', array( $this, 'dark_body_bg_rgb_color_var' ) );
            add_filter( 'dada_dark_primary_color_css_var', array( $this, 'dark_primary_color_var' ) );
            add_filter( 'dada_dark_primary_rgb_color_css_var', array( $this, 'dark_primary_rgb_color_var' ) );
             add_filter( 'dada_dark_secondary_color_css_var', array( $this, 'dark_secondary_color_var' ) );
            add_filter( 'dada_dark_secondary_rgb_color_css_var', array( $this, 'dark_secondary_rgb_color_var' ) );
            add_filter( 'dada_dark_tertiary_color_css_var', array( $this, 'dark_tertiary_color_var' ) );
            add_filter( 'dada_dark_tertiary_rgb_color_css_var', array( $this, 'dark_tertiary_rgb_color_var' ) );
            //Dark mode ends
            
            add_filter( 'dada_add_inline_style', array( $this, 'base_style' ) );
        }

        function default( $option ) {
            $theme_defaults = function_exists('dada_theme_defaults') ? dada_theme_defaults() : array ();
            
            if (isset($theme_defaults['dark_body_bg_color_var'])) {
                $option['dark_body_bg_color_var'] = $theme_defaults['dark_body_bg_color_var'];
            }
            
            if (isset($theme_defaults['dark_primary_color_var'])) {
                $option['dark_primary_color_var'] = $theme_defaults['dark_primary_color_var'];
            }
            
            if (isset($theme_defaults['dark_secondary_color_var'])) {
                $option['dark_secondary_color_var'] = $theme_defaults['dark_secondary_color_var'];
            }
            
            if (isset($theme_defaults['dark_tertiary_color_var'])) {
                $option['dark_tertiary_color_var'] = $theme_defaults['dark_tertiary_color_var'];
            }
            
            return $option;
        }

        function register( $wp_customize ) {

            $dark_mode_enabled = dada_customizer_settings('enable_dark_mode');
            if($dark_mode_enabled == 1)
            {
                
                //Divider line 
                $wp_customize->add_control(
                    new Dada_Customize_Control_Separator(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[color-separator1]', array(
                            'type'     => 'wdt-separator',
                            'section'  => 'site-skin-main-section',
                            'settings' => array(),
                        )
                    )
                );
                $wp_customize->add_setting(
                DADA_CUSTOMISER_VAL . '[dark_body_bg_color]', array(
                    'type'    => 'option',
                )
                );
                $wp_customize->add_control(
                    new Dada_Customize_Control_Color(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[dark_body_bg_color]', array(
                            'section' => 'site-skin-main-section',
                            'label'   => esc_html__( 'Dark Background Color', 'dada-plus' ),
                        )
                    )
                );
                /**
                 * Option : Primary Color
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[dark_primary_color]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Color(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[dark_primary_color]', array(
                            'section' => 'site-skin-main-section',
                            'label'   => esc_html__( 'Dark Primary Color', 'dada-plus' ),
                        )
                    )
                );
                 /**
                 * Option : Secondary Color
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[dark_secondary_color]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Color(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[dark_secondary_color]', array(
                            'section' => 'site-skin-main-section',
                            'label'   => esc_html__( 'Dark Secondary Color', 'dada-plus' ),
                        )
                    )
                );
                /**
                 * Option : Tertiary Color
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[dark_tertiary_color]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Color(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[dark_tertiary_color]', array(
                            'section' => 'site-skin-main-section',
                            'label'   => esc_html__( 'Dark Tertiary Color', 'dada-plus' ),
                        )
                    )
                );
            }
        }

        function dark_body_bg_color_var( $var ) {
            $body_bg_color = dada_customizer_settings( 'dark_body_bg_color' );
            if( !empty( $body_bg_color ) ) {
                $var = '--wdtDarkBodyBGColor:'.esc_attr($body_bg_color).';';
            }

            return $var;
        }

        function dark_body_bg_rgb_color_var( $var ) {
            $body_bg_color = dada_customizer_settings( 'dark_body_bg_color' );
            if( !empty( $body_bg_color ) ) {
                $var = '--wdtDarkBodyBGColorRgb:'.dada_hex2rgba($body_bg_color, false).';';
            }

            return $var;
        }
        function dark_primary_color_var( $var ) {
            $primary_color = dada_customizer_settings( 'dark_primary_color' );
            if( !empty( $primary_color ) ) {
                $var = '--wdtDarkPrimaryColor:'.esc_attr($primary_color).';';
            }

            return $var;
        }

        function dark_primary_rgb_color_var( $var ) {
            $primary_color = dada_customizer_settings( 'dark_primary_color' );
            if( !empty( $primary_color ) ) {
                $var = '--wdtDarkPrimaryColorRgb:'.dada_hex2rgba($primary_color, false).';';
            }

            return $var;
        }
          function dark_secondary_color_var( $var ) {
            $secondary_color = dada_customizer_settings( 'dark_secondary_color' );
            if( !empty( $secondary_color ) ) {
                $var = '--wdtDarkSecondaryColor:'.esc_attr($secondary_color).';';
            }
            return $var;
        }

        function dark_secondary_rgb_color_var( $var ) {
            $secondary_color = dada_customizer_settings( 'dark_secondary_color' );
            if( !empty( $secondary_color ) ) {
                $var = '--wdtDarkSecondaryColorRgb:'.dada_hex2rgba($secondary_color, false).';';
            }
            return $var;
        }
        function dark_tertiary_color_var( $var ) {
            $tertiary_color = dada_customizer_settings( 'dark_tertiary_color' );
            if( !empty( $tertiary_color ) ) {
                $var = '--wdtDarkTertiaryColor:'.esc_attr($tertiary_color).';';
            }

            return $var;
        }

        function dark_tertiary_rgb_color_var( $var ) {
            $tertiary_color = dada_customizer_settings( 'dark_tertiary_color' );
            if( !empty( $tertiary_color ) ) {
                $var = '--wdtDarkTertiaryColorRgb:'.dada_hex2rgba($tertiary_color, false).';';
            }

            return $var;
        }

        function base_style( $style ) {
            return $style;
        }
    }
}

DadaPlusDarkColor::instance();