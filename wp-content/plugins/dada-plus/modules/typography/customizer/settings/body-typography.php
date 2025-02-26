<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusBodySettings' ) ) {
    class DadaPlusBodySettings {

        private static $_instance = null;
        private $settings         = null;
        private $selector         = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->selector = apply_filters( 'dada_body_selector', array( 'body' ) );
            $this->settings = dada_customizer_settings('body_typo');

            add_filter( 'dada_plus_customizer_default', array( $this, 'default' ) );
            add_action( 'customize_register', array( $this, 'register' ), 20);

            add_filter( 'dada_google_fonts_list', array( $this, 'fonts_list' ) );
            
            add_filter( 'dada_body_typo_customizer_update', array( $this, 'body_typo_customizer_update' ) );
            //Light Mode
            add_filter( 'dada_body_text_color_css_var', array( $this, 'body_text_color_var' ) );
            add_filter( 'dada_body_text_rgb_color_css_var', array( $this, 'body_text_rgb_color_var' ) );
            add_filter( 'dada_headalt_color_css_var', array( $this, 'body_headalt_color_var' ) );
            add_filter( 'dada_headalt_rgb_color_css_var', array( $this, 'body_headalt_rgb_color_var' ) );
            add_filter( 'dada_link_color_css_var', array( $this, 'body_link_color_var' ) );
            add_filter( 'dada_link_rgb_color_css_var', array( $this, 'body_link_rgb_color_var' ) );
            add_filter( 'dada_link_hover_color_css_var', array( $this, 'body_link_hover_color_var' ) );
            add_filter( 'dada_link_hover_rgb_color_css_var', array( $this, 'body_link_hover_rgb_color_var' ) );
            add_filter( 'dada_border_color_css_var', array( $this, 'body_border_color_var' ) );
            add_filter( 'dada_border_rgb_color_css_var', array( $this, 'body_border_rgb_color_var' ) );
            add_filter( 'dada_accent_text_color_css_var', array( $this, 'body_accent_text_color_var' ) );
            add_filter( 'dada_accent_text_rgb_color_css_var', array( $this, 'body_accent_text_rgb_color_var' ) );
            //Dark Mode starts
            add_filter( 'dada_dark_body_text_color_css_var', array( $this, 'dark_body_text_color_var' ) );
            add_filter( 'dada_dark_body_text_rgb_color_css_var', array( $this, 'dark_body_text_rgb_color_var' ) );
            add_filter( 'dada_dark_headalt_color_css_var', array( $this, 'dark_body_headalt_color_var' ) );
            add_filter( 'dada_dark_headalt_rgb_color_css_var', array( $this, 'dark_body_headalt_rgb_color_var' ) );
            add_filter( 'dada_dark_link_color_css_var', array( $this, 'dark_body_link_color_var' ) );
            add_filter( 'dada_dark_link_rgb_color_css_var', array( $this, 'dark_body_link_rgb_color_var' ) );
            add_filter( 'dada_dark_link_hover_color_css_var', array( $this, 'dark_body_link_hover_color_var' ) );
            add_filter( 'dada_dark_link_hover_rgb_color_css_var', array( $this, 'dark_body_link_hover_rgb_color_var' ) );
            add_filter( 'dada_dark_border_color_css_var', array( $this, 'dark_body_border_color_var' ) );
            add_filter( 'dada_dark_border_rgb_color_css_var', array( $this, 'dark_body_border_rgb_color_var' ) );
            add_filter( 'dada_dark_accent_text_color_css_var', array( $this, 'dark_body_accent_text_color_var' ) );
            add_filter( 'dada_dark_accent_text_rgb_color_css_var', array( $this, 'dark_body_accent_text_rgb_color_var' ) );
            //Dark mode ends
            add_filter( 'dada_add_inline_style', array( $this, 'base_style' ) );
            add_filter( 'dada_add_tablet_landscape_inline_style', array( $this, 'tablet_landscape_style' ) );
            add_filter( 'dada_add_tablet_portrait_inline_style', array( $this, 'tablet_portrait' ) );
            add_filter( 'dada_add_mobile_res_inline_style', array( $this, 'mobile_style' ) );
            //add_action( 'wp_enqueue_scripts', array( $this, 'my_theme_enqueue_scripts' ));
            }
        function my_theme_enqueue_scripts() {
            // Register the script
            wp_register_script( 'my-script', plugin_dir_url( __FILE__ ) . 'assets/js/site-customizer.js', array( 'jquery' ), '1.0.0', true );
            // Enqueue the script
            wp_enqueue_script( 'my-script' );
            $dark_mode_enabled = dada_customizer_settings('enable_dark_mode');
            if ($dark_mode_enabled == 1) {
                echo '<input type="hidden" class="dark_mode_enabled" id="dark_mode_enabled" value="'.$dark_mode_enabled.'">';
            } 
        }
        function default( $option ) {
            $theme_defaults = function_exists('dada_theme_defaults') ? dada_theme_defaults() : array ();
            $option['body_typo'] = $theme_defaults['body_typo'];
            $option['body_content_color'] = $theme_defaults['body_text_color'];
            $option['body_headalt_color'] = $theme_defaults['headalt_color'];
            $option['body_link_color'] = $theme_defaults['link_color'];
            $option['body_link_hover_color'] = $theme_defaults['link_hover_color'];
            $option['body_border_color'] = $theme_defaults['border_color'];
            $option['body_accent_text_color'] = $theme_defaults['accent_text_color'];
            //dark theme
            $option['dark_body_content_color'] = $theme_defaults['dark_body_text_color'];
            $option['dark_body_headalt_color'] = $theme_defaults['dark_headalt_color'];
            $option['dark_body_link_color'] = $theme_defaults['dark_link_color'];
            $option['dark_body_link_hover_color'] = $theme_defaults['dark_link_hover_color'];
            $option['dark_body_border_color'] = $theme_defaults['dark_border_color'];
            $option['dark_body_accent_text_color'] = $theme_defaults['dark_accent_text_color'];
            return $option;
        }


        function register( $wp_customize ) {

            $wp_customize->add_section(
                new Dada_Customize_Section(
                    $wp_customize,
                    'site-body-section',
                    array(
                        'title'    => esc_html__('Body Content Typography', 'dada-plus'),
                        'panel'    => 'site-typography-main-panel',
                        'priority' => 35,
                    )
                )
            );

            /**
             * Option :Body Typo
             */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[body_typo]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Typography(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[body_typo]', array(
                            'type'    => 'wdt-typography',
                            'section' => 'site-body-section',
                            'label'   => esc_html__( 'Body', 'dada-plus'),
                        )
                    )
                );
                
                /**
                 * Option : Body Content Color
                 */
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[body_content_color]', array(
                            'default' => '',
                            'type'    => 'option',
                        )
                    );
                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[body_content_color]', array(
                                'label'   => esc_html__( 'Color', 'dada-plus' ),
                                'section' => 'site-body-section',
                            )
                        )
                    );
                /**
                 * Option : Heading Color
                 */
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[body_headalt_color]', array(
                            'default' => '',
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[body_headalt_color]', array(
                                'label'   => esc_html__( 'Heading Color', 'dada-plus' ),
                                'section' => 'site-body-section',
                            )
                        )
                    );
                /**
                 * Option : Body Content Link Color
                 */
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[body_link_color]', array(
                            'default' => '',
                            'type'    => 'option',
                        )
                    );
                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[body_link_color]', array(
                                'label'   => esc_html__( 'Link Color', 'dada-plus' ),
                                'section' => 'site-body-section',
                            )
                        )
                    );
                /**
                 * Option : Body Content Link Hover Color
                 */
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[body_link_hover_color]', array(
                            'default' => '',
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[body_link_hover_color]', array(
                                'label'   => esc_html__( 'Link Hover Color', 'dada-plus' ),
                                'section' => 'site-body-section',
                            )
                        )
                    );
                /**
                 * Option : Body Border Color
                 */
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[body_border_color]', array(
                            'default' => '',
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[body_border_color]', array(
                                'label'   => esc_html__( 'Border Color', 'dada-plus' ),
                                'section' => 'site-body-section',
                            )
                        )
                    );

                /**
                 * Option : Accent Text Color
                 */
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[body_accent_text_color]', array(
                            'default' => '',
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[body_accent_text_color]', array(
                                'label'   => esc_html__( 'Accent Text Color', 'dada-plus' ),
                                'section' => 'site-body-section',
                            )
                        )
                    );
                    //Divider line 
                     $wp_customize->add_control(
                            new Dada_Customize_Control_Separator(
                                $wp_customize, DADA_CUSTOMISER_VAL . '[color-separator]', array(
                                    'type'     => 'wdt-separator',
                                    'section'  => 'site-body-section',
                                    'settings' => array(),
                                )
                            )
                        );
                    // Add the dark mode enable settings and controls
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[dark_body_content_color]', array(
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[dark_body_content_color]', array(
                                'type'    => 'wdt-color',
                                'section' => 'site-body-section',
                                'label'   => esc_html__( 'Dark Mode Color', 'dada-plus' ),
                                'dependency' => array( 'enable_dark_mode', '==', 'true' ),
                            )
                        )
                    );
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[dark_body_headalt_color]', array(
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[dark_body_headalt_color]', array(
                                'type'    => 'wdt-color',
                                'section' => 'site-body-section',
                                'label'   => esc_html__( 'Dark Mode Heading Color', 'dada-plus' ),
                                'dependency' => array( 'enable_dark_mode', '==', 'true' ),
                            )
                        )
                    );
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[dark_body_link_color]', array(
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[dark_body_link_color]', array(
                                'type'    => 'wdt-color',
                                'section' => 'site-body-section',
                                'label'   => esc_html__( 'Dark Mode Link color', 'dada-plus' ),
                                'dependency' => array( 'enable_dark_mode', '==', 'true' ),
                            )
                        )
                    );
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[dark_body_link_hover_color]', array(
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[dark_body_link_hover_color]', array(
                                'type'    => 'wdt-color',
                                'section' => 'site-body-section',
                                'label'   => esc_html__( 'Dark Mode link hover', 'dada-plus' ),
                                'dependency' => array( 'enable_dark_mode', '==', 'true' ),
                            )
                        )
                    );
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[dark_body_border_color]', array(
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[dark_body_border_color]', array(
                                'type'    => 'wdt-color',
                                'section' => 'site-body-section',
                                'label'   => esc_html__( 'Dark Mode Border Color', 'dada-plus' ),
                                'dependency' => array( 'enable_dark_mode', '==', 'true' ),
                            )
                        )
                    );
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[dark_body_accent_text_color]', array(
                            'type'    => 'option',
                        )
                    );

                    $wp_customize->add_control(
                        new Dada_Customize_Control_Color(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[dark_body_accent_text_color]', array(
                                'type'    => 'wdt-color',
                                'section' => 'site-body-section',
                                'label'   => esc_html__( 'Dark Mode Accent Text Color', 'dada-plus' ),
                                'dependency' => array( 'enable_dark_mode', '==', 'true' ),
                            )
                        )
                    );
        }
        
        function fonts_list( $fonts ) {
            return dada_customizer_frontend_font( $this->settings, $fonts );
        }

        function body_typo_customizer_update( $defaults ) {
            $body_typo = dada_customizer_settings( 'body_typo' );
            if( !empty( $body_typo ) ) {
                return  $body_typo;
            }
            return $defaults;
        }

        function body_text_color_var( $var ) {
            $body_content_color = dada_customizer_settings( 'body_content_color' );
            if( !empty( $body_content_color ) ) {
                $var = '--wdtBodyTxtColor:'.esc_attr($body_content_color).';';
            }

            return $var;
        }

        function body_text_rgb_color_var( $var ) {
            $body_content_color = dada_customizer_settings( 'body_content_color' );
            if( !empty( $body_content_color ) ) {
                $var = '--wdtBodyTxtColorRgb:'.dada_hex2rgba($body_content_color, false).';';
            }

            return $var;
        }

        function body_headalt_color_var( $var ) {
            $body_headalt_color = dada_customizer_settings( 'body_headalt_color' );
            if( !empty( $body_headalt_color ) ) {
                $var = '--wdtHeadAltColor:'.esc_attr($body_headalt_color).';';
            }

            return $var;
        }

        function body_headalt_rgb_color_var( $var ) {
            $body_headalt_color = dada_customizer_settings( 'body_headalt_color' );
            if( !empty( $body_headalt_color ) ) {
                $var = '--wdtHeadAltColorRgb:'.dada_hex2rgba($body_headalt_color, false).';';
            }

            return $var;
        }

        function body_link_color_var( $var ) {
            $body_link_color = dada_customizer_settings( 'body_link_color' );
            if( !empty( $body_link_color ) ) {
                $var = '--wdtLinkColor:'.esc_attr($body_link_color).';';
            }

            return $var;
        }

        function body_link_rgb_color_var( $var ) {
            $body_link_color = dada_customizer_settings( 'body_link_color' );
            if( !empty( $body_link_color ) ) {
                $var = '--wdtLinkColorRgb:'.dada_hex2rgba($body_link_color, false).';';
            }

            return $var;
        }

        function body_link_hover_color_var( $var ) {
            $body_link_hover_color = dada_customizer_settings( 'body_link_hover_color' );
            if( !empty( $body_link_hover_color ) ) {
                $var = '--wdtLinkHoverColor:'.esc_attr($body_link_hover_color).';';
            }

            return $var;
        }

        function body_link_hover_rgb_color_var( $var ) {
            $body_link_hover_color = dada_customizer_settings( 'body_link_hover_color' );
            if( !empty( $body_link_hover_color ) ) {
                $var = '--wdtLinkHoverColorRgb:'.dada_hex2rgba($body_link_hover_color, false).';';
            }

            return $var;
        }

        function body_border_color_var( $var ) {
            $body_border_color = dada_customizer_settings( 'body_border_color' );
            if( !empty( $body_border_color ) ) {
                $var = '--wdtBorderColor:'.esc_attr($body_border_color).';';
            }

            return $var;
        }

        function body_border_rgb_color_var( $var ) {
            $body_border_color = dada_customizer_settings( 'body_border_color' );
            if( !empty( $body_border_color ) ) {
                $var = '--wdtBorderColorRgb:'.dada_hex2rgba($body_border_color, false).';';
            }

            return $var;
        }

        function body_accent_text_color_var( $var ) {
            $body_accent_text_color = dada_customizer_settings( 'body_accent_text_color' );
            if( !empty( $body_accent_text_color ) ) {
                $var = '--wdtAccentTxtColor:'.esc_attr($body_accent_text_color).';';
            }

            return $var;
        }

        function body_accent_text_rgb_color_var( $var ) {
            $body_accent_text_color = dada_customizer_settings( 'body_accent_text_color' );
            if( !empty( $body_accent_text_color ) ) {
                $var = '--wdtAccentTxtColorRgb:'.dada_hex2rgba($body_accent_text_color, false).';';
            }

            return $var;
        }
        function dark_body_text_color_var( $var ) {
            $dark_body_content_color = dada_customizer_settings( 'dark_body_content_color' );
            if( !empty( $dark_body_content_color ) ) {
                $var = '--wdtDarkBodyTxtColor:'.esc_attr($dark_body_content_color).';';
            }

            return $var;
        }

    function dark_body_text_rgb_color_var( $var ) {
        $dark_body_content_color = dada_customizer_settings( 'dark_body_content_color' );
        if( !empty( $dark_body_content_color ) ) {
            $var = '--wdtDarkBodyTxtColorRgb:'.dada_hex2rgba($dark_body_content_color, false).';';
        }

        return $var;
    }

    function dark_body_headalt_color_var( $var ) {
        $dark_body_headalt_color = dada_customizer_settings( 'dark_body_headalt_color' );
        if( !empty( $dark_body_headalt_color ) ) {
            $var = '--wdtDarkHeadAltColor:'.esc_attr($dark_body_headalt_color).';';
        }

        return $var;
    }

    function dark_body_headalt_rgb_color_var( $var ) {
        $dark_body_headalt_color = dada_customizer_settings( 'dark_body_headalt_color' );
        if( !empty( $dark_body_headalt_color ) ) {
            $var = '--wdtDarkHeadAltColorRgb:'.dada_hex2rgba($dark_body_headalt_color, false).';';
        }

        return $var;
    }

    function dark_body_link_color_var( $var ) {
        $dark_body_link_color = dada_customizer_settings( 'dark_body_link_color' );
        if( !empty( $dark_body_link_color ) ) {
            $var = '--wdtDarkLinkColor:'.esc_attr($dark_body_link_color).';';
        }

        return $var;
    }

    function dark_body_link_rgb_color_var( $var ) {
        $dark_body_link_color = dada_customizer_settings( 'dark_body_link_color' );
        if( !empty( $dark_body_link_color ) ) {
            $var = '--wdtLinkColorRgb:'.dada_hex2rgba($dark_body_link_color, false).';';
        }

        return $var;
    }

    function dark_body_link_hover_color_var( $var ) {
        $dark_body_link_hover_color = dada_customizer_settings( 'dark_body_link_hover_color' );
        if( !empty( $dark_body_link_hover_color ) ) {
            $var = '--wdtDarkLinkHoverColor:'.esc_attr($dark_body_link_hover_color).';';
        }

        return $var;
    }

    function dark_body_link_hover_rgb_color_var( $var ) {
        $dark_body_link_hover_color = dada_customizer_settings( 'dark_body_link_hover_color' );
        if( !empty( $dark_body_link_hover_color ) ) {
            $var = '--wdtDarkLinkHoverColorRgb:'.dada_hex2rgba($dark_body_link_hover_color, false).';';
        }
        return $var;
    }
    function dark_body_border_color_var( $var ) {
            $dark_body_border_color = dada_customizer_settings( 'dark_body_border_color' );
            if( !empty( $body_border_color ) ) {
                $var = '--wdtDarkBorderColor:'.esc_attr($dark_body_border_color).';';
            }

            return $var;
        }

        function dark_body_border_rgb_color_var( $var ) {
            $dark_body_border_color = dada_customizer_settings( 'dark_body_border_color' );
            if( !empty( $body_border_color ) ) {
                $var = '--wdtDarkBorderColorRgb:'.dada_hex2rgba($dark_body_border_color, false).';';
            }

            return $var;
        }

     function dark_body_accent_text_color_var( $var ) {
            $body_accent_text_color = dada_customizer_settings( 'dark_body_accent_text_color' );
            if( !empty( $body_accent_text_color ) ) {
                $var = '--wdtDarkAccentTxtColor:'.esc_attr($body_accent_text_color).';';
            }

            return $var;
        }

    function dark_body_accent_text_rgb_color_var( $var ) {
        $dark_body_accent_text_color = dada_customizer_settings( 'dark_body_accent_text_color' );
        if( !empty( $dark_body_accent_text_color ) ) {
            $var = '--wdtDarkAccentTxtColorRgb:'.dada_hex2rgba($dark_body_accent_text_color, false).';';
        }

        return $var;
    }
        function base_style( $style ) {
            $css   = '';
            $color = dada_customizer_settings('body_content_color');

            $css .= dada_customizer_typography_settings( $this->settings );
            $css .= dada_customizer_color_settings( $color );

            $css = dada_customizer_dynamic_style( $this->selector, $css );

            $l_color = dada_customizer_settings('body_link_color');
            if( !empty( $l_color ) ) {
                $css .= 'a { color:'.esc_attr($l_color).';}'."\n";
            }

            $lh_color = dada_customizer_settings('body_link_hover_color');
            if( !empty( $lh_color ) ) {
                $css .= 'a:hover { color:'.esc_attr($lh_color).';}'."\n";
            }

            if( isset( $settings['text-decoration'] ) && !empty( $settings['text-decoration'] ) ) {
                $css .= 'body p { text-decoration:'.esc_attr($settings['text-decoration']).';}'."\n";
            }
            
           
            return $style.$css;
        }

        function tablet_landscape_style( $style ) {
            $css = dada_customizer_responsive_typography_settings( $this->settings, 'tablet-ls' );
            $css = dada_customizer_dynamic_style( $this->selector, $css );

            return $style.$css;
        }

        function tablet_portrait( $style ) {
            $css = dada_customizer_responsive_typography_settings( $this->settings, 'tablet' );
            $css = dada_customizer_dynamic_style( $this->selector, $css );

            return $style.$css;
        }

        function mobile_style( $style ) {
            $css = dada_customizer_responsive_typography_settings( $this->settings, 'mobile' );
            $css = dada_customizer_dynamic_style( $this->selector, $css );

            return $style.$css;
        }

    }
}

DadaPlusBodySettings::instance();