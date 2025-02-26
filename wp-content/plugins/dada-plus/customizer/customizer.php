<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusCustomizer' ) ) {
    class DadaPlusCustomizer {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            /**
             * Before Hook
             */
            do_action( 'dada_plus_before_fw_customizer_load' );

                add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts') );
                add_filter( 'customize_previewable_devices', array( $this, 'previewable_devices' ) );

                add_action( 'customize_register', array( $this, 'extend_panels' ), 5 );
                add_action( 'customize_register', array( $this, 'extend_sections' ), 5 );
                add_action( 'customize_register', array( $this, 'extend_controls' ), 10 );

            /**
             * Adter Hook
             */
            do_action( 'dada_plus_after_fw_customizer_load' );
        }

        function enqueue_scripts() {
            wp_enqueue_style( 'dada-plus-customizer', DADA_PLUS_DIR_URL.'customizer/assets/css/customizer.css', array(), DADA_PLUS_VERSION, 'all' );

            wp_enqueue_script( 'dada-plus-customizer', DADA_PLUS_DIR_URL.'customizer/assets/js/customizer.js', array(), DADA_PLUS_VERSION, true );
            wp_enqueue_script( 'dada-plus-customizer-color-picker', DADA_PLUS_DIR_URL.'customizer/assets/js/wp-color-picker-alpha.js', array( 'jquery', 'wp-color-picker' ), DADA_PLUS_VERSION, true );
            wp_enqueue_script( 'dada-plus-customizer-interdependencies', DADA_PLUS_DIR_URL.'customizer/assets/js/jquery.interdependencies.js', array( 'jquery' ), DADA_PLUS_VERSION, true );
            wp_enqueue_script( 'dada-plus-customizer-dependencies', DADA_PLUS_DIR_URL.'customizer/assets/js/jquery.dependencies.js', array( 'dada-plus-customizer-interdependencies' ), DADA_PLUS_VERSION, true );
        }

        function previewable_devices( $devices ) {

			$devices = array(
				'desktop' => array(
					'label' => esc_html__( 'Enter desktop preview mode', 'dada-plus'),
					'default' => true,
				),
				'tablet-landscape' => array(
					'label' => esc_html__( 'Enter tablet landscape preview mode', 'dada-plus'),
				),
				'tablet' => array(
					'label' => esc_html__( 'Enter tablet preview mode', 'dada-plus'),
				),
				'mobile' => array(
					'label' => esc_html__( 'Enter mobile preview mode', 'dada-plus'),
				),
			);

            return $devices;
        }

        function extend_panels( $wp_customize ) {
            require_once DADA_PLUS_DIR_PATH . 'customizer/lib/class-wp-customize-panel.php';
            $wp_customize->register_panel_type( 'Dada_Customize_Panel' );
        }

        function extend_sections( $wp_customize ) {
            require_once DADA_PLUS_DIR_PATH . 'customizer/lib/class-wp-customize-section.php';
            $wp_customize->register_panel_type( 'Dada_Customize_Section' );
        }

        function extend_controls( $wp_customize ) {

			require DADA_PLUS_DIR_PATH . 'customizer/controls/class-base-control.php';
            $wp_customize->register_control_type('Dada_Customize_Control');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/separator/class-control-separator.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Separator');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/description/class-control-description.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Description');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/radio-image/class-control-radio-image.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Radio_Image');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/sortable/class-control-sortable.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Sortable');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/slider/class-control-slider.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Slider');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/responsive-slider/class-control-responsive-slider.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Responsive_Slider');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/responsive-number/class-control-responsive-number.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Responsive_Number');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/responsive-spacing/class-control-responsive-spacing.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Responsive_Spacing');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/spacing/class-control-spacing.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Spacing');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/color/class-control-color.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Color');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/background/class-control-background.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Background');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/typography/class-control-typography.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Typography');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/fontawesome/class-control-fontawesome.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Fontawesome');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/switch/class-control-switch.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Switch');

			require DADA_PLUS_DIR_PATH . 'customizer/controls/upload/class-control-upload.php';
			$wp_customize->register_control_type('Dada_Customize_Control_Upload');
        }
    }
}

DadaPlusCustomizer::instance();