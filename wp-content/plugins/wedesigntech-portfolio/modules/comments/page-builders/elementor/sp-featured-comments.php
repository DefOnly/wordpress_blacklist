<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSpFeaturedComments extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-singlepage-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sp-featured-comments';
	}

	public function get_title() {
		return esc_html__( 'Comments - Featured','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ('wdt-comments-frontend');
	}

	public function get_script_depends() {
		return array ('wdt-comments-common', 'wdt-comments-frontend');
	}

	protected function register_controls() {

		$this->start_controls_section( 'featured_comments_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
		) );

			$this->add_control( 'enable_title', array(
				'label'       => esc_html__( 'Enable Title','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'default'      => 'false'
			) );

			$this->add_control( 'enable_rating', array(
				'label'       => esc_html__( 'Enable Rating','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'default'      => 'false'
			) );

			$this->add_control( 'enable_media', array(
				'label'       => esc_html__( 'Enable Media','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
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
		$settings   = $this->get_settings();
		$attributes = wdtportfolio_elementor_instance()->wdt_parse_shortcode_attrs( $settings );
		$output     = do_shortcode('[wdt_sp_featured_comments '.$attributes.' /]');

		echo $output;

	}

}