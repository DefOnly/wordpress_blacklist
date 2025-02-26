<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSfOrderBy extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-searchform-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sf-orderby';
	}

	public function get_title() {
		return esc_html__( 'Order By','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ( 'wdt-fields', 'wdt-search-frontend');
	}

	public function get_script_depends() {
		return array ( 'wdt-search-frontend');
	}

	protected function register_controls() {

		$this->start_controls_section( 'orderby_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
		) );

            $this->add_control( 'field_type', array(
                'label'       => esc_html__( 'Field Type','wdt-portfolio'),
                'type'        => Controls_Manager::SELECT,
                'options'     => array(
                    ''         => esc_html__('List','wdt-portfolio'),
                    'dropdown' => esc_html__('Dropdown','wdt-portfolio'),
                ),
                'description' => esc_html__( 'Choose type of field you like to use.','wdt-portfolio'),
                'default'      => ''
            ) );

			$this->add_control( 'placeholder_text', array(
				'label'       => esc_html__( 'Placeholder Text','wdt-portfolio'),
				'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'You can provide your own text for placeholder of this item.','wdt-portfolio'),
                'condition'   => array( 'field_type' => 'dropdown' ),
				'default'     => ''
			) );

			$this->add_control( 'alphabetical_order', array(
				'label'       => esc_html__( 'Alphabetical Order','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to enable alphabetical order.','wdt-portfolio'),
				'default'      => 'true'
			) );

			$this->add_control( 'highestrated_order', array(
				'label'       => esc_html__( 'Highest Rated Order','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to enable highest rated order.','wdt-portfolio'),
				'default'      => 'true'
			) );

			$this->add_control( 'mostreviewed_order', array(
				'label'       => esc_html__( 'Most Reviewed Order','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to enable most reviewed order.','wdt-portfolio'),
				'default'      => 'true'
			) );

			$this->add_control( 'mostviewed_order', array(
				'label'       => esc_html__( 'Most Viewed Order','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Choose "True" if you like to enable most viewed order.','wdt-portfolio'),
				'default'      => 'true'
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

		$settings   = $this->get_settings();
		$attributes = wdtportfolio_elementor_instance()->wdt_parse_shortcode_attrs( $settings );
		$output     = do_shortcode('[wdt_sf_orderby_field '.$attributes.' /]');

		echo $output;

	}

}