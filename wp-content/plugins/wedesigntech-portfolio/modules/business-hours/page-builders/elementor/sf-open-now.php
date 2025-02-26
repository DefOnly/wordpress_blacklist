<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSfOpenNow extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-searchform-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sf-open-now';
	}

	public function get_title() {
		return esc_html__( 'Open Now','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ('wdt-business-hours-frontend');
	}

	public function get_script_depends() {
		return array ();
	}

	protected function register_controls() {

		$this->start_controls_section( 'open_now_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
		) );

			$this->add_control( 'ajax_load', array(
				'label'       => esc_html__( 'Ajax Load','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('If you want to display the output in same page choose "True" here.','wdt-portfolio'),
				'default'      => 'false'
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

		$settings = $this->get_settings();
		$attributes = wdtportfolio_elementor_instance()->wdt_parse_shortcode_attrs( $settings );
		$output = do_shortcode('[wdt_sf_open_now_field '.$attributes.' /]');

		echo $output;

	}

}