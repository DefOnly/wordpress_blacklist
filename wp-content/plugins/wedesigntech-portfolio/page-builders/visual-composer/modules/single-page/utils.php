<?php
add_action( 'vc_before_init', 'wdt_sp_utils_vc_map' );

function wdt_sp_utils_vc_map() {

	$listing_singular_label      = apply_filters( 'listing_label', 'singular' );
	$amenity_singular_label      = apply_filters( 'amenity_label', 'singular' );

	vc_map( array(
		"name"     => esc_html__( 'Utils','wdt-portfolio'),
		"base"     => "wdt_sp_utils",
		"icon"     => "wdt_sp_utils",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params"   => array(

			// Listing Id
			array(
				'type' => 'textfield',
				'heading' => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name' => 'listing_id',
				'description' => sprintf( esc_html__('Provide %1$s id for which you have to display favourites, share,... No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'admin_label' => true
			),

			// Show Title
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Title','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show title.','wdt-portfolio'),
				'param_name' => 'show_title',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Favourite
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Favourite','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show favourite option.','wdt-portfolio'),
				'param_name' => 'show_favourite',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Page View
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Page View','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show page view.','wdt-portfolio'),
				'param_name' => 'show_pageview',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Print
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Print','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show print option.','wdt-portfolio'),
				'param_name' => 'show_print',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Social Share
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Social Share','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show social share option.','wdt-portfolio'),
				'param_name' => 'show_socialshare',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Average Rating
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Average Rating','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show average rating.','wdt-portfolio'),
				'param_name' => 'show_averagerating',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Featured Item
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Featured Item','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show featured item.','wdt-portfolio'),
				'param_name' => 'show_featured',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Categories
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Categories','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show categories.','wdt-portfolio'),
				'param_name' => 'show_categories',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Amenity
			array(
				'type' => 'dropdown',
				'heading' => sprintf( esc_html__('Show %1$s','wdt-portfolio'), $amenity_singular_label ),
				'description' =>sprintf( esc_html__('Choose "True" if you like to show %1$s','wdt-portfolio'), strtolower($amenity_singular_label) ),
				'param_name' => 'show_amenity',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Address
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Address','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show address.','wdt-portfolio'),
				'param_name' => 'show_address',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Excerpt
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Excerpt','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show excerpt.','wdt-portfolio'),
				'param_name' => 'show_excerpt',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Class
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Class','wdt-portfolio'),
				'param_name' => 'class',
				'description' => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
			)

		)
	) );
}
?>