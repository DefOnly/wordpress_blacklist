<?php
add_action( 'vc_before_init', 'wdt_sp_taxonomy_vc_map' );

function wdt_sp_taxonomy_vc_map() {

	$listing_singular_label      = apply_filters( 'listing_label', 'singular' );

	$taxonomies = apply_filters( 'wdt_taxonomies', array () );
	$taxonomies = array_flip($taxonomies);

	vc_map( array(
		"name"     => esc_html__( 'Taxonomy','wdt-portfolio'),
		"base"     => "wdt_sp_taxonomy",
		"icon"     => "wdt_sp_taxonomy",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params"   => array(

			// Listing Id
			array(
				'type'             => 'textfield',
				'heading'          => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name'       => 'listing_id',
				'description'      => sprintf( esc_html__('Provide %1$s id for which you have to display categories. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label'      => true
			),

			// Taxonomy
			array(
				'type'             => 'dropdown',
				'heading'          => esc_html__('Taxonomy','wdt-portfolio'),
				'param_name'       => 'taxonomy',
				'value'            => $taxonomies,
				'description'      => esc_html__( 'Choose type of taxonomy you would like to display.','wdt-portfolio'),
				'std'              => 'wdt_listings_category',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label'      => true
			),

			// Type
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Type','wdt-portfolio'),
				'param_name' => 'type',
				'value'      => array(
					esc_html__('Type 1','wdt-portfolio') => 'type1',
					esc_html__('Type 2','wdt-portfolio') => 'type2',
					esc_html__('Type 3','wdt-portfolio') => 'type3',
					esc_html__('Type 4','wdt-portfolio') => 'type4',
					esc_html__('Type 5','wdt-portfolio') => 'type5',
					esc_html__('Type 6','wdt-portfolio') => 'type6',
					esc_html__('Type 7','wdt-portfolio') => 'type7',
					esc_html__('Type 8','wdt-portfolio') => 'type8',
				),
				'description'      => esc_html__( 'Choose type of taxonomy to display.','wdt-portfolio'),
				'std'              => 'type1',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label'      => true
			),

			// Show Label
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Show Label','wdt-portfolio'),
				'param_name' => 'show_label',
				'value'      => array(
					esc_html__('False','wdt-portfolio') => 'false',
					esc_html__('True','wdt-portfolio') => 'true',
				),
				'description'      => esc_html__( 'Choose "True" if you like to show label.','wdt-portfolio'),
				'std'              => 'false',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label'      => true
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