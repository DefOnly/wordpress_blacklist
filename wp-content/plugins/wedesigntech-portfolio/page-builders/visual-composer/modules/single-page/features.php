<?php
add_action( 'vc_before_init', 'wdt_sp_features_vc_map' );

function wdt_sp_features_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name" => esc_html__( 'Features','wdt-portfolio'),
		"base" => "wdt_sp_features",
		"icon" => "wdt_sp_features",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params" => array(

			// Listing Id
			array(
				'type' => 'textfield',
				'heading' => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name' => 'listing_id',
				'description' => sprintf( esc_html__('Provide %1$s id for which you have to display features. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Type','wdt-portfolio'),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Type 1','wdt-portfolio') => 'type1',
					esc_html__('Type 2','wdt-portfolio') => 'type2',
					esc_html__('Type 3','wdt-portfolio') => 'type3',
					esc_html__('Type 4','wdt-portfolio') => 'type4',
					esc_html__('Type 5','wdt-portfolio') => 'type5',
					esc_html__('Type 6','wdt-portfolio') => 'type6',
					esc_html__('Type 7','wdt-portfolio') => 'type7'
				),
				'description' => esc_html__( 'Choose any of the available type.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true,
				'std' => 'type1'
			),

			// Include
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Include','wdt-portfolio'),
				'param_name' => 'include',
				'description' => esc_html__( 'If you like, you can include only certain items. Leave empty if you like to display all.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Columns
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Columns','wdt-portfolio'),
				'param_name' => 'columns',
				'value' => array(
							esc_html__('No Column','wdt-portfolio') => -1,
							esc_html__('I Column','wdt-portfolio') => 1,
							esc_html__('II Columns','wdt-portfolio') => 2,
							esc_html__('III Columns','wdt-portfolio') => 3,
							esc_html__('IV Columns','wdt-portfolio') => 4,
						),
				'description' => esc_html__( 'Number of columns you like to display your features.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'std' => 4
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