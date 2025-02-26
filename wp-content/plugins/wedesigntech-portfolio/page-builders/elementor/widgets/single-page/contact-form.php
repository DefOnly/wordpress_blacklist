<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSpContactForm extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-singlepage-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sp-contact-form';
	}

	public function get_title() {
		return esc_html__( 'Contact Form','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ( 'wdt-modules-singlepage' );
	}

	public function get_script_depends() {
		return array ( 'wdt-modules-singlepage' );
	}

	protected function register_controls() {

		$listing_singular_label = apply_filters( 'listing_label', 'singular' );

		$this->start_controls_section( 'contact_form_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
		) );

			$this->add_control( 'listing_id', array(
				'label'       => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'type'        => Controls_Manager::TEXT,
				'description' => sprintf( esc_html__('Provide %1$s id to display your item. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'default'     => ''
			) );

			$this->add_control( 'textarea_placeholder', array(
				'label'       => esc_html__( 'Textarea Placeholder','wdt-portfolio'),
				'type'        => Controls_Manager::TEXT,
				'description' => sprintf( esc_html__( 'You can customize palceholder text here. Also you can use {{title}} shortcode replace it with %1$s title','wdt-portfolio'), strtolower($listing_singular_label) ),
				'default'     => ''
			) );

			$this->add_control( 'submit_label', array(
				'label'   => esc_html__( 'Submit Button Label','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
				'description' => esc_html__( 'You can customize submit button label here.','wdt-portfolio'),
				'default' => ''
			) );

			$this->add_control( 'contact_point', array(
				'label'       => esc_html__( 'Contact Point','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'' => sprintf( esc_html__( '%1$s Email','wdt-portfolio'), $listing_singular_label ),
					'author-email' => esc_html__('Author Email','wdt-portfolio')
				),
				'description' => esc_html__( 'Choose design type for this item.','wdt-portfolio'),
				'default'      => '',
			) );

			$this->add_control( 'include_admin', array(
				'label'       => esc_html__( 'Include Admin','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to send copy of mail to administrator.','wdt-portfolio'),
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
		echo do_shortcode('[wdt_sp_contact_form '.$attributes.' /]');
	}

}