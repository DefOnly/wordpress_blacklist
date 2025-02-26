<?php
add_action( 'vc_before_init', 'wdt_sf_orderby_field_vc_map' );

function wdt_sf_orderby_field_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name" => esc_html__( 'Order By','wdt-portfolio'),
		"base" => "wdt_sf_orderby_field",
		"icon" => "wdt_sf_orderby_field",
		"category" => WDT_PB_MODULE_SEARCHFORM_TITLE,
		"params" => array(

			// Field Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Field Type','wdt-portfolio'),
				'param_name' => 'field_type',
				'value' => array(
					esc_html__('List','wdt-portfolio') => '',
					esc_html__('Dropdown','wdt-portfolio') => 'dropdown',
				),
				'description' => esc_html__( 'Choose type of field you like to use.','wdt-portfolio'),
				'std' => '',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Placeholder Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Placeholder Text','wdt-portfolio'),
				'param_name' => 'placeholder_text',
				'description' => esc_html__( 'You can provide your own text for placeholder of this item.','wdt-portfolio'),
				'dependency' => array( 'element' => 'field_type', 'value' => 'dropdown'),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Alphabetical Order
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Alphabetical Order','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to enable alphabetical order.','wdt-portfolio'),
				'param_name' => 'alphabetical_order',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'std' => 'true',
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Highest Rated Order
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Highest Rated Order','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to enable highest rated order.','wdt-portfolio'),
				'param_name' => 'highestrated_order',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'std' => 'true',
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Most Reviewed Order
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Most Reviewed Order','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to enable most reviewed order.','wdt-portfolio'),
				'param_name' => 'mostreviewed_order',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'std' => 'true',
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Most Viewed Order
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Most Viewed Order','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to enable most viewed order.','wdt-portfolio'),
				'param_name' => 'mostviewed_order',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'std' => 'true',
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