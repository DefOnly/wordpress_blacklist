<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSfSubmitButton extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-searchform-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sf-submit-button';
	}

	public function get_title() {
		return esc_html__( 'Submit Button','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ( 'wdt-fields', 'wdt-search-frontend');
	}

	public function get_script_depends() {
		return array ( 'wdt-search-frontend');
	}

	protected function register_controls() {

		$this->start_controls_section( 'submit_button_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
		) );

			$this->add_control( 'output_type', array(
				'label'       => esc_html__( 'Output Type','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					''              => esc_html__('Same Page - Ajax Load','wdt-portfolio'),
					'separate-page' => esc_html__('Separate Page','wdt-portfolio'),
				),
				'description' => esc_html__( 'Choose how you like to display search output.','wdt-portfolio'),
				'default'      => ''
			) );

			$this->add_control( 'separate_page_url', array(
				'label'   => esc_html__( 'Separate Page URL','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
                'description' => esc_html__( 'Separate page url in which search content have to displayed. You have to create that page with search form shortcode.','wdt-portfolio'),
                'condition'   => array( 'output_type' => 'separate-page' ),
				'default' => ''
			) );

			$this->add_control( 'class', array(
				'label'   => esc_html__( 'Class','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
				'description' => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
				'default' => ''
			) );

		$this->end_controls_section();
	}

	protected function render() {

		$settings   = $this->get_settings();
		$attributes = wdtportfolio_elementor_instance()->wdt_parse_shortcode_attrs( $settings );
		$output     = do_shortcode('[wdt_sf_submit_button '.$attributes.' /]');

		echo $output;

	}

}