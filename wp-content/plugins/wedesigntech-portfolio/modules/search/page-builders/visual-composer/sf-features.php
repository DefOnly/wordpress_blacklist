<?php
add_action( 'vc_before_init', 'wdt_sf_features_field_vc_map' );

function wdt_sf_features_field_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name"     => esc_html__( 'Features','wdt-portfolio'),
		"base"     => "wdt_sf_features_field",
		"icon"     => "wdt_sf_features_field",
		"category" => WDT_PB_MODULE_SEARCHFORM_TITLE,
		"params"   => array(

			// Tab Id
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Tab Id','wdt-portfolio'),
				'param_name' => 'tab_id',
				'description' => esc_html__( 'Provide tab id for features item that you want to use in search form. Without this tab id shortcode doesn\'t work.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Field Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Field Type','wdt-portfolio'),
				'description' => esc_html__('Choose field type that you like to use for this feature item.','wdt-portfolio'),
				'param_name' => 'field_type',
				'value' => array(
					esc_html__( 'Range','wdt-portfolio') => 'range',
					esc_html__( 'Dropdown','wdt-portfolio') => 'dropdown',
					esc_html__( 'List','wdt-portfolio') => 'list',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'std' => 'range',
			),

			// Placeholder Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Placeholder Text','wdt-portfolio'),
				'param_name' => 'placeholder_text',
				'description' => esc_html__( 'You can provide your own text for placeholder of this item.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array( 'element' => 'field_type', 'value' => 'dropdown'),
			),

			// Minimum Value
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Minimum Value','wdt-portfolio'),
				'param_name' => 'min_value',
				'description' => esc_html__( 'Set minimum value range.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'value' => 1,
				'dependency' => array( 'element' => 'field_type', 'value' => 'range'),
			),

			// Maximum Value
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Maximum Value','wdt-portfolio'),
				'param_name' => 'max_value',
				'description' => esc_html__( 'Set maximum value range.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'value' => 100,
				'dependency' => array( 'element' => 'field_type', 'value' => 'range'),
			),

			// Dropdown Options
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Dropdown Options','wdt-portfolio'),
				'description' => esc_html__('Add dropdown options in comma separated values.','wdt-portfolio'),
				'param_name' => 'dropdownlist_options',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array( 'element' => 'field_type', 'value' => array ('dropdown', 'list')),
			),

			// Dropdown Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Dropdown Type','wdt-portfolio'),
				'param_name' => 'dropdown_type',
				'value' => array(
					esc_html__('Single','wdt-portfolio') => '',
					esc_html__('Multiple','wdt-portfolio') => 'multiple',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'description' => esc_html__( 'Choose type of dropdown you like to use.','wdt-portfolio'),
				'dependency' => array( 'element' => 'field_type', 'value' => 'dropdown'),
				'std' => '',
			),

			// Item Unit
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Item Unit','wdt-portfolio'),
				'param_name' => 'item_unit',
				'description' => esc_html__( 'You can provide item unit for your label here.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Ajax Load
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Ajax Load','wdt-portfolio'),
				'description' => esc_html__('If you want to display the output in same page choose "True" here.','wdt-portfolio'),
				'param_name' => 'ajax_load',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Class
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Class','wdt-portfolio'),
				'param_name' => 'class',
				'description' => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			)

		)
	) );
}
?>