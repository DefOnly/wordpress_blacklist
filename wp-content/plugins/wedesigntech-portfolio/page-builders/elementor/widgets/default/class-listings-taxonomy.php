<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioDfListingsTaxonomy extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-default-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-df-listings-taxonomy';
	}

	public function get_title() {
		$listing_plural_label = apply_filters( 'listing_label', 'plural' );
		return sprintf( esc_html__('%1$s Taxonomy','wdt-portfolio'), $listing_plural_label );
	}

	public function get_style_depends() {
		return array ( 'wdt-modules-default' );
	}

	public function get_script_depends() {
		return array ( 'wdt-frontend' );
	}

	protected function register_controls() {

		$listing_singular_label      = apply_filters( 'listing_label', 'singular' );
		$listing_plural_label        = apply_filters( 'listing_label', 'plural' );

		$taxonomies = apply_filters( 'wdt_taxonomies', array () );

		$this->start_controls_section( 'listings_taxonomy_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
		) );

			$this->add_control( 'taxonomy', array(
				'label'       => esc_html__( 'Taxonomy','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => $taxonomies,
				'description' => esc_html__( 'Choose type of taxonomy you would like to display.','wdt-portfolio'),
				'default'      => 'wdt_listings_category',
			) );

			$this->add_control( 'type', array(
				'label'       => esc_html__( 'Type','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'type1' => esc_html__('Type 1','wdt-portfolio'),
					'type2' => esc_html__('Type 2','wdt-portfolio'),
					'type3' => esc_html__('Type 3','wdt-portfolio'),
					'type4' => esc_html__('Type 4','wdt-portfolio'),
					'type5' => esc_html__('Type 5','wdt-portfolio'),
					'type6' => esc_html__('Type 6','wdt-portfolio'),
					'type7' => esc_html__('Type 7','wdt-portfolio')
				),
				'description' => esc_html__( 'Choose type of taxonomy to display.','wdt-portfolio'),
				'default'      => 'type1',
			) );

			$this->add_control( 'media_type', array(
				'label'       => esc_html__( 'Media Type','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'image'      => esc_html__('Image','wdt-portfolio'),
					'icon'       => esc_html__('Icon','wdt-portfolio'),
					'icon_image' => esc_html__('Icon Image','wdt-portfolio')
				),
				'description' => esc_html__( 'Choose whether to display image or icon.','wdt-portfolio'),
				'condition'   => array( 'type' => array ('type1', 'type2', 'type3', 'type4') ),
				'default'      => 'image',
			) );

			$this->add_control( 'columns', array(
				'label'       => esc_html__( 'Columns','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					''  => esc_html__('None','wdt-portfolio'),
					1  => esc_html__('I Column','wdt-portfolio'),
					2  => esc_html__('II Columns','wdt-portfolio'),
					3  => esc_html__('III Columns','wdt-portfolio')
				),
				'description' => esc_html__( 'Number of columns you like to display your taxonomies.','wdt-portfolio'),
				'default'      => '',
			) );

			$this->add_control( 'include', array(
				'label'   => esc_html__( 'Include','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
				'description' => esc_html__( 'List of taxonomy ids separated by commas.','wdt-portfolio'),
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

		echo do_shortcode('[wdt_listings_taxonomy '.$attributes.' /]');
	}

}