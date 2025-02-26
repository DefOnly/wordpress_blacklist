<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSfFeatures extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-searchform-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sf-features';
	}

	public function get_title() {
		return esc_html__( 'Features','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ( 'jquery-ui', 'chosen', 'wdt-fields', 'wdt-search-frontend');
	}

	public function get_script_depends() {
		return array ( 'jquery-ui-slider', 'chosen', 'wdt-search-frontend');
	}

	protected function register_controls() {

		$this->start_controls_section( 'features_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
		) );

            $this->add_control( 'tab_id', array(
                'label'   => esc_html__( 'Tab Id','wdt-portfolio'),
                'type'    => Controls_Manager::TEXT,
                'description' => esc_html__( 'Provide tab id for features item that you want to use in search form. Without this tab id shortcode doesn\'t work.','wdt-portfolio'),
                'default' => ''
            ) );

            $this->add_control( 'field_type', array(
                'label'       => esc_html__( 'Field Type','wdt-portfolio'),
                'type'        => Controls_Manager::SELECT,
                'options'     => array(
                    'range'    => esc_html__('Range','wdt-portfolio'),
                    'list'     => esc_html__('List','wdt-portfolio'),
                    'dropdown' => esc_html__('Dropdown','wdt-portfolio'),
                ),
                'description' => esc_html__('Choose field type that you like to use for this feature item.','wdt-portfolio'),
                'default'      => 'range'
            ) );

			$this->add_control( 'placeholder_text', array(
				'label'       => esc_html__( 'Placeholder Text','wdt-portfolio'),
				'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'You can provide your own text for placeholder of this item.','wdt-portfolio'),
                'condition'   => array( 'field_type' => 'dropdown' ),
				'default'     => ''
			) );

            $this->add_control( 'min_value', array(
				'label'   => esc_html__( 'Minimum Value','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
                'description' => esc_html__( 'Set minimum value range.','wdt-portfolio'),
                'condition'   => array( 'field_type' => 'range' ),
				'default' => 1
            ) );

            $this->add_control( 'max_value', array(
				'label'   => esc_html__( 'Maximum Value','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
                'description' => esc_html__( 'Set maximum value range.','wdt-portfolio'),
                'condition'   => array( 'field_type' => 'range' ),
				'default' => 100
            ) );

            $this->add_control( 'dropdownlist_options', array(
				'label'   => esc_html__( 'Dropdown Options','wdt-portfolio'),
				'type'    => Controls_Manager::TEXTAREA,
                'description' => esc_html__('Add dropdown options in comma separated values.','wdt-portfolio'),
                'condition'   => array( 'field_type' => array ('dropdown', 'list') ),
				'default' => ''
			) );

			$this->add_control( 'dropdown_type', array(
				'label'       => esc_html__( 'Dropdown Type','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					''         => esc_html__('Single','wdt-portfolio'),
					'multiple' => esc_html__('Multiple','wdt-portfolio'),
				),
                'description' => esc_html__( 'Choose type of dropdown you like to use.','wdt-portfolio'),
                'condition'   => array( 'field_type' => 'dropdown' ),
				'default'      => ''
            ) );

            $this->add_control( 'item_unit', array(
				'label'   => esc_html__( 'Item Unit','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
				'description' => esc_html__( 'You can provide item unit for your label here.','wdt-portfolio'),
				'default' => ''
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
		$output     = do_shortcode('[wdt_sf_features_field '.$attributes.' /]');

		echo $output;

	}

}