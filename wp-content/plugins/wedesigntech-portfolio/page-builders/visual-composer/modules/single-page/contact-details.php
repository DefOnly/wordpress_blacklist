<?php
add_action( 'vc_before_init', 'wdt_sp_contact_details_vc_map' );

function wdt_sp_contact_details_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name" => esc_html__( 'Contact Details','wdt-portfolio'),
		"base" => "wdt_sp_contact_details",
		"icon" => "wdt_sp_contact_details",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params" => array(

			// Listing Id
			array(
				'type' => 'textfield',
				'heading' => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name' => 'listing_id',
				'description' => sprintf( esc_html__('Provide %1$s id for which you have to display contact details. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
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
					esc_html__('Type 2','wdt-portfolio') => 'type2'
				),
				'description' => esc_html__( 'Choose any of the available type.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true,
				'std' => 'type1'
			),

			// Contact Details
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Contact Details','wdt-portfolio'),
				'description' => esc_html__('Contact details that you like to display.','wdt-portfolio'),
				'param_name' => 'contact_details',
				'value' => array(
					sprintf( esc_html__('%1$s','wdt-portfolio'), $listing_singular_label ) => 'list',
					esc_html__( 'Author','wdt-portfolio') => 'author',
				),
				'std' => 'list',
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Include Address
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Include Address','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show address in this shortcode.','wdt-portfolio'),
				'param_name' => 'include_address',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Include Email
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Include Email','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show email id in this shortcode.','wdt-portfolio'),
				'param_name' => 'include_email',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Include Phone
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Include Phone','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show phone in this shortcode.','wdt-portfolio'),
				'param_name' => 'include_phone',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Include Mobile
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Include Mobile','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show mobile in this shortcode.','wdt-portfolio'),
				'param_name' => 'include_mobile',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Include Skype
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Include Skype','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show skype in this shortcode.','wdt-portfolio'),
				'param_name' => 'include_skype',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Include Website
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Include Website','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show website in this shortcode.','wdt-portfolio'),
				'param_name' => 'include_website',
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