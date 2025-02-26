<?php
add_action( 'vc_before_init', 'wdt_sp_post_date_vc_map' );

function wdt_sp_post_date_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name" => esc_html__( 'Post Date','wdt-portfolio'),
		"base" => "wdt_sp_post_date",
		"icon" => "wdt_sp_post_date",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params" => array(

			// Listing Id
			array(
				'type' => 'textfield',
				'heading' => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name' => 'listing_id',
				'description' => sprintf( esc_html__('Provide %1$s id for which you have to display dates. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
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
					esc_html__('Type 4','wdt-portfolio') => 'type4'
				),
				'description' => esc_html__( 'Choose any of the available type.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true,
				'admintype_label' => 'type1'
			),

			// Include Post Time
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Include Post Time','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to display post time along with date.','wdt-portfolio'),
				'param_name' => 'include_posttime',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// With Label
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('With Label','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to display label along with date.','wdt-portfolio'),
				'param_name' => 'with_label',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// With Icon
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('With Icon','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to display icon along with date.','wdt-portfolio'),
				'param_name' => 'with_icon',
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
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

		)
	) );
}
?>