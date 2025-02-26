<?php
add_action( 'vc_before_init', 'wdt_sf_tags_field_vc_map' );

function wdt_sf_tags_field_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name"     => esc_html__( 'Tags','wdt-portfolio'),
		"base"     => "wdt_sf_tags_field",
		"icon"     => "wdt_sf_tags_field",
		"category" => WDT_PB_MODULE_SEARCHFORM_TITLE,
		"params"   => array(

			// Field Type
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Field Type','wdt-portfolio'),
				'param_name' => 'field_type',
				'value'      => array(
					esc_html__('List','wdt-portfolio')     => '',
					esc_html__('Dropdown','wdt-portfolio') => 'dropdown',
				),
				'description' => esc_html__( 'Choose type of field you like to use.','wdt-portfolio'),
				'std' => '',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Placeholder Text
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Placeholder Text','wdt-portfolio'),
				'param_name'       => 'placeholder_text',
				'description'      => esc_html__( 'You can provide your own text for placeholder of this item.','wdt-portfolio'),
				'dependency'       => array( 'element' => 'field_type', 'value' => 'dropdown'),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Dropdown Type
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Dropdown Type','wdt-portfolio'),
				'param_name' => 'dropdown_type',
				'value'      => array(
					esc_html__('Single','wdt-portfolio')   => '',
					esc_html__('Multiple','wdt-portfolio') => 'multiple',
				),
				'description' => esc_html__( 'Choose type of dropdown you like to use.','wdt-portfolio'),
				'dependency' => array( 'element' => 'field_type', 'value' => 'dropdown'),
				'std' => '',
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Ajax Load
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Ajax Load','wdt-portfolio'),
				'description' => esc_html__('If you want to display the output in same page choose "True" here.','wdt-portfolio'),
				'param_name'  => 'ajax_load',
				'value'       => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Class
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Class','wdt-portfolio'),
				'param_name'       => 'class',
				'description'      => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			)

		)
	) );
}
?>