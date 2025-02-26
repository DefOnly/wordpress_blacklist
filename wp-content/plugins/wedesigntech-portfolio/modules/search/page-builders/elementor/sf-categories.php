<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSfCategories extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-searchform-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sf-categories';
	}

	public function get_title() {
		return esc_html__( 'Categories','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ( 'chosen', 'wdt-fields', 'wdt-search-frontend');
	}

	public function get_script_depends() {
		return array ( 'chosen', 'wdt-search-frontend');
	}

	protected function register_controls() {

		$this->start_controls_section( 'categories_default_section', array(
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

			$this->add_control( 'default_item_id', array(
				'label'   => esc_html__( 'Default Item Id','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
				'description' => esc_html__( 'Set item id here, by default it will be set.','wdt-portfolio'),
				'default' => ''
			) );

			$this->add_control( 'show_parent_items_alone', array(
				'label'       => esc_html__( 'Show Parent Items Alone','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__( 'If you like to show parent items alone choose "True".','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'child_of', array(
				'label'   => esc_html__( 'Child Of','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
				'description' => esc_html__( 'If you like to show child of any parent item, provide id of your taxonomy here.','wdt-portfolio'),
				'condition'   => array( 'show_parent_items_alone' =>'false' ),
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
		$output     = do_shortcode('[wdt_sf_categories_field '.$attributes.' /]');

		echo $output;

	}

}