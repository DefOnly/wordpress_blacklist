<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WeDesignTech_Widget_Base_Advanced_Heading {

	private static $_instance = null;

	private $cc_repeater_contents;
	private $cc_content_position;
	private $cc_layout;
	private $cc_style;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	function __construct() {

		// Initialize depandant class
			$this->cc_repeater_contents = new WeDesignTech_Common_Controls_Repeater_Contents(array (), array (), array (), array ());
			$this->cc_style = new WeDesignTech_Common_Controls_Style();

		// Actions & Filters
			add_filter( 'wdt_elementor_localize_settings', array( $this, 'wdt_register_elementor_localize_settings' )  );

	}

	public function name() {
		return 'wdt-advanced-heading';
	}

	public function title() {
		return esc_html__( 'Advanced Heading', 'wdt-elementor-addon' );
	}

	public function icon() {
		return 'eicon-apps';
	}

	public function init_styles() {
		return array (
				$this->name() =>  WEDESIGNTECH_ELEMENTOR_ADDON_DIR_URL.'inc/widgets/advanced-heading/assets/css/style.css'
			);
	}

	public function init_inline_styles() {
		return array ();
	}

	public function init_scripts() {
		return array (
			'gsap' => WEDESIGNTECH_ELEMENTOR_ADDON_DIR_URL .'inc/widgets/advanced-heading/assets/gsap/gsap.min.js',
			'splittext-min' => WEDESIGNTECH_ELEMENTOR_ADDON_DIR_URL .'inc/widgets/advanced-heading/assets/gsap/SplitText.min.js',
			$this->name() =>  WEDESIGNTECH_ELEMENTOR_ADDON_DIR_URL.'inc/widgets/advanced-heading/assets/js/script.js'
		);
	}

	public function wdt_register_elementor_localize_settings($settings) {
		$settings['wdtHeaderItems'] = array(
			'title' => esc_html__( 'Title', 'wdt-elementor-addon'),
		);
		return $settings;
	}


	public function create_elementor_controls($elementor_object) {

		// Header

			$elementor_object->start_controls_section( 'wdt_section_item', array(
				'label' => esc_html__( 'Item', 'wdt-elementor-addon'),
			));

				// Title
					$elementor_object->add_control( 'title', array(
						'label'       => esc_html__( 'Title', 'wdt-elementor-addon' ),
						'type'        => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'placeholder' => esc_html__( 'Your title goes here', 'wdt-elementor-addon' ),
						'default'     => esc_html__( 'Heading', 'wdt-elementor-addon' )
					));

					$elementor_object->add_control(
						'content',
						array (
							'label' => esc_html__( 'Content', 'elementor' ),
							'type' => \Elementor\Controls_Manager::TEXTAREA,
							'default' => esc_html__( 'Few lines to well describe your content supporting headline.', 'wdt-elementor-addon' ),
							'description' => esc_html__( 'Enter pipe symbol "|" to add the span for the content.', 'wdt-elementor-addon' )
						)
					);

					$elementor_object->add_control( 'heading_tag', array(
						'label'   => esc_html__( 'Title Tag', 'wdt-elementor-addon' ),
						'type'    => \Elementor\Controls_Manager::SELECT,
						'default' => 'h2',
						'options' => array(
							'div'  => esc_html__( 'Div', 'wdt-elementor-addon' ),
							'h1'   => esc_html__( 'H1', 'wdt-elementor-addon' ),
							'h2'   => esc_html__( 'H2', 'wdt-elementor-addon' ),
							'h3'   => esc_html__( 'H3', 'wdt-elementor-addon' ),
							'h4'   => esc_html__( 'H4', 'wdt-elementor-addon' ),
							'h5'   => esc_html__( 'H5', 'wdt-elementor-addon' ),
							'h6'   => esc_html__( 'H6', 'wdt-elementor-addon' ),
							'span' => esc_html__( 'Span', 'wdt-elementor-addon' ),
							'p'    => esc_html__( 'P', 'wdt-elementor-addon' )
						)
					));

					$elementor_object->add_control( 'heading_animation', array(
						'label'   => esc_html__( 'Title Animation', 'wdt-elementor-addon' ),
						'type'    => \Elementor\Controls_Manager::SELECT,
						'default' => 'default',
						'options' => array(
							'default'  		   => esc_html__( 'Default', 'wdt-elementor-addon' ),
							'splitanimation'   => esc_html__( 'Split Animation', 'wdt-elementor-addon' ),
							'charsplit'   => esc_html__( 'Letter Animation', 'wdt-elementor-addon' ),
						),
						'description' => esc_html__( 'Enable InView Status ', 'wdt-elementor-addon' )
					));

					$elementor_object->add_control( 'content_animation', array(
						'label'   => esc_html__( 'Content Animation', 'wdt-elementor-addon' ),
						'type'    => \Elementor\Controls_Manager::SELECT,
						'default' => 'default',
						'options' => array(
							'default'  		   => esc_html__( 'Default', 'wdt-elementor-addon' ),
							'translate'   => esc_html__( 'Skew Fade', 'wdt-elementor-addon' ),
							'fadeleft'   => esc_html__( 'Fade Left', 'wdt-elementor-addon' ),
							'faderight'   => esc_html__( 'Fade Right', 'wdt-elementor-addon' )
						),
						'description' => esc_html__( 'Enable InView Status.', 'wdt-elementor-addon' )
					));

			$elementor_object->end_controls_section();

		// Styles

			// Item
				$this->cc_style->get_style_controls($elementor_object, array (
					'slug' => 'item',
					'title' => esc_html__( 'Item', 'wdt-elementor-addon' ),
					'styles' => array (
						'alignment' => array (
							'field_type' => 'alignment',
							'control_type' => 'responsive',
							'default' => 'center',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder, {{WRAPPER}} .wdt-heading-holder > .wdt-heading-title-wrapper .wdt-heading-title' => 'text-align: {{VALUE}}; justify-content: {{VALUE}}; justify-items: {{VALUE}};'
							),
							'condition' => array ()
						),
						'margin' => array (
							'field_type' => 'margin',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							),
							'condition' => array ()
						),
						'padding' => array (
							'field_type' => 'padding',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							),
							'condition' => array ()
						),
						'typography' => array (
							'field_type' => 'typography',
							'selector' => '{{WRAPPER}} .wdt-heading-holder .wdt-heading-title-wrapper .wdt-heading-title',
							'condition' => array ()
						),
						'color' => array (
							'field_type' => 'color',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder .wdt-heading-title-wrapper .wdt-heading-title' => 'color: {{VALUE}};'
							),
							'condition' => array ()
						),
						'background' => array (
							'field_type' => 'background',
							'selector' => '{{WRAPPER}} .wdt-heading-holder .wdt-heading-title-wrapper .wdt-heading-title',
							'condition' => array ()
						),
						'border' => array (
							'field_type' => 'border',
							'selector' => '{{WRAPPER}} .wdt-heading-holder',
							'condition' => array ()
						),
						'border_radius' => array (
							'field_type' => 'border_radius',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							),
							'condition' => array ()
						),
						'box_shadow' => array (
							'field_type' => 'box_shadow',
							'selector' => '{{WRAPPER}} .wdt-heading-holder',
							'condition' => array ()
						)
					)
				));

			// Content
				$this->cc_style->get_style_controls($elementor_object, array (
					'slug' => 'content',
					'title' => esc_html__( 'Content', 'wdt-elementor-addon' ),
					'styles' => array (
						'alignment' => array (
							'field_type' => 'alignment',
							'control_type' => 'responsive',
							'default' => 'center',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper' => 'text-align: {{VALUE}}; justify-content: {{VALUE}}; justify-items: {{VALUE}};'
							),
							'condition' => array ()
						),
						'margin' => array (
							'field_type' => 'margin',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							),
							'condition' => array ()
						),
						'padding' => array (
							'field_type' => 'padding',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							),
							'condition' => array ()
						),
						'typography' => array (
							'field_type' => 'typography',
							'selector' => '{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper',
							'condition' => array ()
						),
						'color' => array (
							'field_type' => 'color',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper .wdt-advanced-heading-content' => 'color: {{VALUE}};'
							),
							'condition' => array ()
						),
						'background' => array (
							'field_type' => 'background',
							'selector' => '{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper .wdt-advanced-heading-content',
							'condition' => array ()
						),
						'border' => array (
							'field_type' => 'border',
							'selector' => '{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper',
							'condition' => array ()
						),
						'border_radius' => array (
							'field_type' => 'border_radius',
							'selector' => array (
								'{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							),
							'condition' => array ()
						),
						'box_shadow' => array (
							'field_type' => 'box_shadow',
							'selector' => '{{WRAPPER}} .wdt-heading-holder > .wdt-heading-content-wrapper',
							'condition' => array ()
						)
					)
				));
	}

	public function render_html($widget_object, $settings) {

		if($widget_object->widget_type != 'elementor') {
			return;
		}
		$settings['module_id'] = $widget_object->get_id();

		$output = '';	

		$output .= '<div class="wdt-heading-holder" data-id="'.esc_attr($settings['module_id']).'">';
			if(isset($settings['title']) && !empty($settings['title'])) {
				$output .= '<div class="wdt-heading-title-wrapper">';
					$output .= '<'.esc_attr($settings['heading_tag']).'>';
						if($settings['heading_animation'] == 'default'){
							$output .= '<span class="wdt-heading-title defaultanimation-'.$settings['module_id'].'">'. wp_kses_post($settings['title']) .'</span>';
						}elseif($settings['heading_animation'] == 'splitanimation'){
							$output .= '<span class="wdt-heading-title splitanimation-'.$settings['module_id'].'">'. wp_kses_post($settings['title']) .'</span>';
						}elseif($settings['heading_animation'] == 'charsplit'){
							$output .= '<span class="wdt-heading-title charsplit-'.$settings['module_id'].'">'. wp_kses_post($settings['title']) .'</span>';
						}
						$output .= '</'.esc_attr($settings['heading_tag']).'>';
				$output .= '</div>';
			}

			if(isset($settings['content']) && !empty($settings['content'])) {
				$output .= '<div class="wdt-heading-content-wrapper">';

					if($settings['content_animation'] == 'default'){
						$output .= '<div class="wdt-content-animation-default"><p>'. esc_attr($settings['content']) .'</p></div>';
					}elseif($settings['content_animation'] == 'translate'){
						$output .= '<div class="wdt-content-animation skew-'.$settings['module_id'].'">'. esc_attr($settings['content']) .'</div>';
					}elseif($settings['content_animation'] == 'fadeleft'){
						$output .= '<div class="wdt-content-animation fadeleft-'.$settings['module_id'].'">'. esc_attr($settings['content']) .'</div>';
					}elseif($settings['content_animation'] == 'faderight'){
						$output .= '<div class="wdt-content-animation faderight-'.$settings['module_id'].'">'. esc_attr($settings['content']) .'</div>';
					}
					
				$output .= '</div>';
			}
		$output .= '</div>';

		return $output;

		}
	}

if( !function_exists( 'wedesigntech_widget_base_advanced_heading' ) ) {
    function wedesigntech_widget_base_advanced_heading() {
		return WeDesignTech_Widget_Base_Advanced_Heading::instance();
    }
}