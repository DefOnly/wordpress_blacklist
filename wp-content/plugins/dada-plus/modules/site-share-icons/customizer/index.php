<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusCustomizerSiteShareIcons' ) ) {
    class DadaPlusCustomizerSiteShareIcons {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

            add_filter( 'dada_plus_customizer_default', array( $this, 'default' ) );
            add_action( 'dada_general_cutomizer_options', array( $this, 'register_general' ), 40 );
        }

        function default( $option ) {
            $option['show_follow_us_icons'] = '0';
            return $option;
        }

        function register_general( $wp_customize ) {

            $wp_customize->add_section(
                new Dada_Customize_Section(
                    $wp_customize,
                    'site-share-icons-section',
                    array(
                        'title'    => esc_html__('Follow Us', 'dada-plus'),
                        'panel'    => 'site-general-main-panel',
                        'priority' => 40,
                    )
                )
            );

                /**
                 * Option : Enable Follow Us
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[show_follow_us_icons]', array(
                        'type' => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Switch(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[show_follow_us_icons]', array(
                            'type'    => 'wdt-switch',
                            'section' => 'site-share-icons-section',
                            'label'   => esc_html__( 'Enable Follow Us', 'dada-plus' ),
                            'choices' => array(
                                'on'  => esc_attr__( 'Yes', 'dada-plus' ),
                                'off' => esc_attr__( 'No', 'dada-plus' )
                            )
                        )
                    )
                );

                /**
                 * Option : Youtube Link
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[youtube_link]', array(
                        'type' => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[youtube_link]', array(
                            'type'    	  => 'text',
                            'section'     => 'site-share-icons-section',
                            'label'       => esc_html__( 'Youtube Link', 'dada-pro' ),
                            'description' => esc_html__( 'Put the youtube link here', 'dada-pro' ),
                            'input_attrs' => array(
                                'value'	=> esc_html__('Youtube Link', 'dada-pro'),
                            ),
                            'dependency' => array( 'show_follow_us_icons', '!=', '' )
                        )
                    )
                );

                /**
                 * Option : Facebook Link
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[facebook_link]', array(
                        'type' => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[facebook_link]', array(
                            'type'    	  => 'text',
                            'section'     => 'site-share-icons-section',
                            'label'       => esc_html__( 'Facebook Link', 'dada-pro' ),
                            'description' => esc_html__( 'Put the facebook profile link here', 'dada-pro' ),
                            'input_attrs' => array(
                                'value'	=> esc_html__('Facebook Link', 'dada-pro'),
                            ),
                            'dependency' => array( 'show_follow_us_icons', '!=', '' )
                        )
                    )
                );

                /**
                 * Option : Instagram Link
                 */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[instagram_link]', array(
                        'type' => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[instagram_link]', array(
                            'type'    	  => 'text',
                            'section'     => 'site-share-icons-section',
                            'label'       => esc_html__( 'Instagram Link', 'dada-pro' ),
                            'description' => esc_html__( 'Put the instagram profile link here', 'dada-pro' ),
                            'input_attrs' => array(
                                'value'	=> esc_html__('Instagram Link', 'dada-pro'),
                            ),
                            'dependency' => array( 'show_follow_us_icons', '!=', '' )
                        )
                    )
                );
            }
    }
}

DadaPlusCustomizerSiteShareIcons::instance();