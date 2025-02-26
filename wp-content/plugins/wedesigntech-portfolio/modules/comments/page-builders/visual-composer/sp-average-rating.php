<?php
add_action( 'vc_before_init', 'wdt_sp_average_rating_vc_map' );

function wdt_sp_average_rating_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name"     => esc_html__( 'Average Rating','wdt-portfolio'),
		"base"     => "wdt_sp_average_rating",
		"icon"     => "wdt_sp_average_rating",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params"   => array(

			// Listing Id
			array(
				'type'             => 'textfield',
				'heading'          => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name'       => 'listing_id',
				'description'      => sprintf( esc_html__('Provide %1$s id for which you have to display favourites, share,... No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label'      => true
			),

			// Display
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Display','wdt-portfolio'),
				'param_name' => 'display',
				'value'      => array(
					esc_html__('Both','wdt-portfolio')           => 'both',
					esc_html__('Star Rating','wdt-portfolio')    => 'star-rating',
					esc_html__('Overall Rating','wdt-portfolio') => 'overall-rating',
				),
				'description'      => esc_html__( 'Choose type of content to display.','wdt-portfolio'),
				'std'              => 'both',
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
					esc_html__('Type 3','wdt-portfolio') => 'type3'
				),
				'description'      => esc_html__( 'Choose any of the available type.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label'      => true,
				'std'              => 'type1'
			),

			// Class
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Class','wdt-portfolio'),
				'param_name'       => 'class',
				'description'      => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),


		)
	) );
}
?>