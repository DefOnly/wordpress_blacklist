<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSpContactDetails extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-singlepage-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sp-contact-details';
	}

	public function get_title() {
		return esc_html__( 'Contact Details','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ( 'wdt-modules-singlepage' );
	}

	public function get_script_depends() {
		return array ( 'wdt-modules-singlepage' );
	}

	protected function register_controls() {

		$listing_singular_label = apply_filters( 'listing_label', 'singular' );

		$this->start_controls_section( 'features_default_section', array(
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
					'type1' => esc_html__('Type 1','wdt-portfolio'),
					'type2' => esc_html__('Type 2','wdt-portfolio')
				),
				'description' => esc_html__( 'Choose any of the available type.','wdt-portfolio'),
				'default'      => 'type1',
			) );

			$this->add_control( 'contact_details', array(
				'label'       => esc_html__( 'Contact Details','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'list'   => sprintf( esc_html__('%1$s','wdt-portfolio'), $listing_singular_label ),
					'author' => esc_html__('Author','wdt-portfolio')
				),
				'description' => esc_html__('Contact details that you like to display.','wdt-portfolio'),
				'default'      => 'list',
			) );

			$this->add_control( 'include_address', array(
				'label'       => esc_html__( 'Include Address','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show address in this shortcode.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'include_email', array(
				'label'       => esc_html__( 'Include Email','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show email id in this shortcode.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'include_phone', array(
				'label'       => esc_html__( 'Include Phone','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show phone in this shortcode.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'include_mobile', array(
				'label'       => esc_html__( 'Include Mobile','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show mobile in this shortcode.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'include_skype', array(
				'label'       => esc_html__( 'Include Skype','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show skype in this shortcode.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'include_website', array(
				'label'       => esc_html__( 'Include Website','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to show website in this shortcode.','wdt-portfolio'),
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
		echo do_shortcode('[wdt_sp_contact_details '.$attributes.' /]');

	}

}