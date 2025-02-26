<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSpSocialShare extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-singlepage-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sp-social-share';
	}

	public function get_title() {
		return esc_html__( 'Social Share','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ('wdt-social-share-frontend');
	}

	public function get_script_depends() {
		return array ('wdt-social-share-frontend');
	}

	protected function register_controls() {

		$listing_singular_label = apply_filters( 'listing_label', 'singular' );

		$this->start_controls_section( 'social_share_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
		) );

			$this->add_control( 'listing_id', array(
				'label'       => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'type'        => Controls_Manager::TEXT,
				'description' => sprintf( esc_html__('Provide %1$s id to display your item. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'default'     => ''
			) );

			$this->add_control( 'type', array(
				'label'       => esc_html__( 'Type','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'type1'  => esc_html__('Type 1','wdt-portfolio'),
					'type2'  => esc_html__('Type 2','wdt-portfolio')
				),
				'description' => esc_html__('Choose type of social share like to display.','wdt-portfolio'),
				'default'      => 'type1',
			) );

			$this->add_control( 'show_facebook', array(
				'label'       => esc_html__( 'Show Facebook','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show facebook share.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'show_delicious', array(
				'label'       => esc_html__( 'Show Delicious','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show delicious share.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'show_digg', array(
				'label'       => esc_html__( 'Show Digg','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show digg share.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'show_stumbleupon', array(
				'label'       => esc_html__( 'Show Stumble Upon','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show stumble upon share.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'show_twitter', array(
				'label'       => esc_html__( 'Show Twitter','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show twitter share.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'show_googleplus', array(
				'label'       => esc_html__( 'Show Google Plus','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show google plus share.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'show_linkedin', array(
				'label'       => esc_html__( 'Show LinkedIn','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show linkedin share.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'show_pinterest', array(
				'label'       => esc_html__( 'Show Pinterest','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show pinterest share.','wdt-portfolio'),
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
		$output = do_shortcode('[wdt_sp_social_share '.$attributes.' /]');

		echo $output;

	}

}