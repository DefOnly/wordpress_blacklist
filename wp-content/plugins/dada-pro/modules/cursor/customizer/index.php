<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaProCustomizerCursor' ) ) {
    class DadaProCustomizerCursor {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_filter( 'dada_pro_customizer_default', array( $this, 'default' ) );
            add_action( 'dada_general_cutomizer_options', array( $this, 'register_general' ), 30 );
        }

        function default( $option ) {

            $option['enable_cursor_effect'] = '1';
            $option['cursor_type'] = 'type-1';
            $option['cursor_link_hover_effect'] = 'link-hover-effect-1';
            $option['cursor_lightbox_hover_effect'] = 'image-hover-effect-1';

            return $option;
        }

        function register_general( $wp_customize ) {

            $wp_customize->add_section(
                new Dada_Customize_Section(
                    $wp_customize,
                    'cursor-section',
                    array(
                        'title'    => esc_html__('Cursor & Dark Mode', 'dada-pro'),
                        'panel'    => 'site-general-main-panel',
                        'priority' => 30,
                    )
                )
            );

                /**
                 * Option : Enable Cursor
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[enable_cursor_effect]', array(
                        'type' => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Switch(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[enable_cursor_effect]', array(
                            'type'    => 'wdt-switch',
                            'section' => 'cursor-section',
                            'label'   => esc_html__( 'Enable Cursor Effect', 'dada-pro' ),
                            'choices' => array(
                                'on'  => esc_attr__( 'Yes', 'dada-pro' ),
                                'off' => esc_attr__( 'No', 'dada-pro' )
                            )
                        )
                    )
                );
                /**
                 * Option : Enable Dark mode
                 */
                 $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[enable_dark_mode]', array(
                        'type'    => 'option',
                    )
                );
                $wp_customize->add_control(
                    new Dada_Customize_Control_Switch(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[enable_dark_mode]', array(
                            'type'        => 'wdt-switch',
                            'section'     => 'cursor-section',
                            'label'       => esc_html__( 'Enable Dark Mode?', 'dada-plus' ),
                            'description' => esc_html__('YES! to enable dark mode.', 'dada-plus'),
                            'choices'     => array(
                                'on'  => esc_attr__( 'Yes', 'dada-plus' ),
                                'off' => esc_attr__( 'No', 'dada-plus' )
                            ),
                        )
                    )
                );

        }

    }
}

DadaProCustomizerCursor::instance();