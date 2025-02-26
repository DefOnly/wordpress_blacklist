<?php

namespace DTElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class WDTPortfolioSfOutputDataContainer extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-searchform-widgets' ];
	}

	public function get_name() {
		return 'wdt-widget-sf-output-data-container';
	}

	public function get_title() {
		return esc_html__( 'Output Data Container','wdt-portfolio');
	}

	public function get_style_depends() {
		return array ( 'wdt-fields', 'wdt-search-frontend');
	}

	public function get_script_depends() {
		return array ( 'wdt-search-frontend');
	}

	public function wdt_dynamic_register_controls() {

	}

	protected function register_controls() {

		$listing_singular_label = apply_filters( 'listing_label', 'singular' );

		$this->start_controls_section( 'output_data_container_default_section', array(
			'label' => esc_html__( 'General','wdt-portfolio'),
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
					'type6' => esc_html__('Type 6','wdt-portfolio')
                ),
                'description' => esc_html__('Choose type of layout you like to display.','wdt-portfolio'),
                'default'      => 'type1',
            ) );

            $this->add_control( 'gallery', array(
                'label'       => esc_html__( 'Gallery','wdt-portfolio'),
                'type'        => Controls_Manager::SELECT,
                'options'     => array(
                    'featured_image'        => esc_html__('Featured Image','wdt-portfolio'),
                    'image_gallery'         => esc_html__('Image Gallery','wdt-portfolio'),
                    'gallery_with_featured' => esc_html__('Image Gallery With Featured Image','wdt-portfolio'),
                ),
                'description' => esc_html__( 'Choose how you like to display image gallery.','wdt-portfolio'),
                'default'      => 'featured_image',
            ) );

            $this->add_control( 'post_per_page', array(
                'label'   => esc_html__( 'Post Per Page','wdt-portfolio'),
                'type'    => Controls_Manager::TEXT,
                'description' => esc_html__( 'Number of posts to show per page. Rest of the posts will be displayed in pagination.','wdt-portfolio'),
                'default' => -1
            ) );

            $this->add_control( 'columns', array(
                'label'       => esc_html__( 'Columns','wdt-portfolio'),
                'type'        => Controls_Manager::SELECT,
                'options'     => array(
                    1  => esc_html__('I Column','wdt-portfolio'),
					2  => esc_html__('II Columns','wdt-portfolio'),
					3  => esc_html__('III Columns','wdt-portfolio')
                ),
				'description' => esc_html__( 'Number of columns you like to display your items.','wdt-portfolio'),
				'condition'   => array( 'type' => array( 'type1', 'type2', 'type4', 'type6', 'type8') ),
                'default'      => 1,
            ) );

            $this->add_control( 'apply_isotope', array(
                'label'       => esc_html__( 'Apply Isotope','wdt-portfolio'),
                'type'        => Controls_Manager::SELECT,
                'options'     => array(
                    'false' => esc_html__('False','wdt-portfolio'),
                    'true'  => esc_html__('True','wdt-portfolio'),
                ),
                'description' => esc_html__('Choose true if you like to apply isotope for your items.  Isotope won\'t work along with Carousel.','wdt-portfolio'),
                'default'      => 'false'
            ) );

			$this->add_control( 'excerpt_length', array(
				'label'   => esc_html__( 'Excerpt Length','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
				'description' => esc_html__( 'Provide excerpt length here.','wdt-portfolio'),
				'default' => 20
			) );

            $this->add_control( 'features_image_or_icon', array(
				'label'       => esc_html__( 'Features Image or Icon','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					''      => esc_html__('None','wdt-portfolio'),
					'image' => esc_html__('Image','wdt-portfolio'),
					'icon'  => esc_html__('Icon','wdt-portfolio')
				),
				'description' => esc_html__('Choose any of the option available to display features.','wdt-portfolio'),
				'default'      => '',
			) );

			$this->add_control( 'features_include', array(
				'label'       => esc_html__( 'Features Include','wdt-portfolio'),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Give features id separated by comma. Only 4 maximum number of features allowed.','wdt-portfolio'),
				'default'      => '',
			) );

			$this->add_control( 'no_of_cat_to_display', array(
				'label'       => esc_html__( 'No. Of Categories to Display','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					1  => 1,
					2  => 2,
					3  => 3,
					4  => 4
				),
				'description' => esc_html__( 'Number of categories you like to display on your items.','wdt-portfolio'),
				'default'      => 2,
			) );

			$this->add_control( 'apply_equal_height', array(
				'label'       => esc_html__( 'Apply Equal Height','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'condition'   => array( 'apply_isotope' => 'false' ),
				'description' => esc_html__('Apply equal height for you items.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_control( 'apply_custom_height', array(
				'label'       => esc_html__( 'Apply Custom Height','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => esc_html__('Apply custom height for your entire section.','wdt-portfolio'),
				'default'      => 'false'
			) );

			$this->add_responsive_control( 'height', array(
                'label' => esc_html__( 'Height','wdt-portfolio'),
                'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Provide height for your section in "px" here.','wdt-portfolio'),
				'condition'   => array( 'apply_custom_height' => 'true' ),
                'devices' => array( 'desktop', 'tablet', 'mobile' ),
                'selectors' => array(
					'{{WRAPPER}} .wdt-listing-output-data-container' => 'height: {{SIZE}}px;',
				),
			) );

			$this->add_control( 'sidebar_widget', array(
				'label'       => esc_html__( 'Sidebar Widget','wdt-portfolio'),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'false' => esc_html__('False','wdt-portfolio'),
					'true'  => esc_html__('True','wdt-portfolio'),
				),
				'description' => sprintf( esc_html__('%1$s 1) If you wish to show these items in sidebar set this to "True". %2$s %1$s 2) This options is not applicable for "Type 3", "Type 5" and "Type 7". %2$s','wdt-portfolio'), '<p>', '</p>' ),
				'default'      => 'false'
			) );

			$this->add_control( 'class', array(
				'label'   => esc_html__( 'Class','wdt-portfolio'),
				'type'    => Controls_Manager::TEXT,
				'description' => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
				'default' => ''
			) );

		$this->end_controls_section();

		$this->wdt_dynamic_register_controls();

		$this->start_controls_section( 'output_data_container_filter_section', array(
			'label' => esc_html__( 'Filter Options','wdt-portfolio'),
		) );

			$this->add_control( 'category_ids', array(
				'label'   => sprintf( esc_html__('%1$s Category Ids','wdt-portfolio'), $listing_singular_label ),
				'type'    => Controls_Manager::TEXT,
				'description' => sprintf( esc_html__( 'Enter %1$s category ids separated by commas.','wdt-portfolio'), $listing_singular_label ),
				'default' => ''
			) );

		$this->end_controls_section();

	}

	protected function render() {

		$settings   = $this->get_settings();
		$attributes = wdtportfolio_elementor_instance()->wdt_parse_shortcode_attrs( $settings );
		$output     = do_shortcode('[wdt_sf_output_data_container '.$attributes.' /]');

		echo $output;

	}

}