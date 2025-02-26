<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusGlobalSibarSettings' ) ) {
    class DadaPlusGlobalSibarSettings {

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
        }

        function default( $option ) {
            $option['global_sidebar_layout'] = 'content-full-width';
            $option['global_sidebar']        = '';
            $option['hide_standard_sidebar'] = '';
            return $option;
        }

        function register( $wp_customize ) {

            /**
             * Global Sidebar Panel
             */
            $wp_customize->add_section(
                new Dada_Customize_Section(
                    $wp_customize,
                    'site-global-sidebar-section',
                    array(
                        'title'    => esc_html__('Global Sidebar', 'dada-plus'),
                        'panel'    => 'site-widget-main-panel',
                        'priority' => 5
                    )
                )
            );

                /**
                 * Option: Global Sidebar Layout
                 */
                    $wp_customize->add_setting(
                        DADA_CUSTOMISER_VAL . '[global_sidebar_layout]', array(
                            'type' => 'option',
                        )
                    );

                    $wp_customize->add_control( new Dada_Customize_Control_Radio_Image(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[global_sidebar_layout]', array(
                            'type'    => 'wdt-radio-image',
                            'label'   => esc_html__( 'Global Sidebar Layout', 'dada-plus'),
                            'section' => 'site-global-sidebar-section',
                            'choices' => apply_filters( 'dada_global_sidebar_layouts', array(
                                'content-full-width' => array(
                                    'label' => esc_html__( 'Without Sidebar', 'dada-plus' ),
                                    'path'  =>  DADA_PLUS_DIR_URL . 'modules/sidebar/customizer/images/without-sidebar.png'
                                ),
                                'with-left-sidebar'  => array(
                                    'label' => esc_html__( 'With Left Sidebar', 'dada-plus' ),
                                    'path'  =>  DADA_PLUS_DIR_URL . 'modules/sidebar/customizer/images/left-sidebar.png'
                                ),
                                'with-right-sidebar' => array(
                                    'label' => esc_html__( 'With Right Sidebar', 'dada-plus' ),
                                    'path'  =>  DADA_PLUS_DIR_URL . 'modules/sidebar/customizer/images/right-sidebar.png'
                                ),
                            ) )
                        )
                    ) );

                /**
                 * Option : Hide Standard Sidebar
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[hide_standard_sidebar]', array(
                        'type' => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Switch(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[hide_standard_sidebar]', array(
                            'type'    => 'wdt-switch',
                            'section' => 'site-global-sidebar-section',
                            'label'   => esc_html__( 'Hide Standard Sidebar', 'dada-plus' ),
                            'choices' => array(
                                'on'  => esc_attr__( 'Yes', 'dada-plus' ),
                                'off' => esc_attr__( 'No', 'dada-plus' )
                            )
                        )
                    )
                );

                if ( ! defined( 'DADA_PRO_VERSION' ) ) {
                    $wp_customize->add_control(
                        new Dada_Customize_Control_Separator(
                            $wp_customize, DADA_CUSTOMISER_VAL . '[dada-plus-site-global-sidebar-separator]',
                            array(
                                'type'        => 'wdt-separator',
                                'section'     => 'site-global-sidebar-section',
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

DadaPlusGlobalSibarSettings::instance();