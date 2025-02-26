<?php

namespace DadaElementor\Widgets;
use DadaElementor\Widgets\Dada_Shop_Widget_Product_Summary;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class Dada_Shop_Widget_Product_Summary_Extend extends Dada_Shop_Widget_Product_Summary {

	function dynamic_register_controls() {

		$this->start_controls_section( 'product_summary_extend_section', array(
			'label' => esc_html__( 'Social Options', 'dada-pro' ),
		) );

			$this->add_control( 'share_follow_type', array(
				'label'   => esc_html__( 'Share / Follow Type', 'dada-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'share',
				'options' => array(
					''       => esc_html__('None', 'dada-pro'),
					'share'  => esc_html__('Share', 'dada-pro'),
					'follow' => esc_html__('Follow', 'dada-pro'),
				),
				'description' => esc_html__( 'Choose between Share / Follow you would like to use.', 'dada-pro' ),
			) );

			$this->add_control( 'social_icon_style', array(
				'label'   => esc_html__( 'Social Icon Style', 'dada-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'simple'        => esc_html__( 'Simple', 'dada-pro' ),
					'bgfill'        => esc_html__( 'BG Fill', 'dada-pro' ),
					'brdrfill'      => esc_html__( 'Border Fill', 'dada-pro' ),
					'skin-bgfill'   => esc_html__( 'Skin BG Fill', 'dada-pro' ),
					'skin-brdrfill' => esc_html__( 'Skin Border Fill', 'dada-pro' ),
				),
				'description' => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dada-pro' ),
				'condition'   => array( 'share_follow_type' => array ('share', 'follow') )
			) );

			$this->add_control( 'social_icon_radius', array(
				'label'   => esc_html__( 'Social Icon Radius', 'dada-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'square'  => esc_html__( 'Square', 'dada-pro' ),
					'rounded' => esc_html__( 'Rounded', 'dada-pro' ),
					'circle'  => esc_html__( 'Circle', 'dada-pro' ),
				),
				'condition'   => array(
					'social_icon_style' => array ('bgfill', 'brdrfill', 'skin-bgfill', 'skin-brdrfill'),
					'share_follow_type' => array ('share', 'follow')
				),
			) );

			$this->add_control( 'social_icon_inline_alignment', array(
				'label'        => esc_html__( 'Social Icon Inline Alignment', 'dada-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'yes', 'dada-pro' ),
				'label_off'    => esc_html__( 'no', 'dada-pro' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dada-pro' ),
				'condition'   => array( 'share_follow_type' => array ('share', 'follow') )
			) );

		$this->end_controls_section();

	}

}