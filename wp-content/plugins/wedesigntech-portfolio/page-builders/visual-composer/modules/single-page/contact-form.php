<?php
add_action( 'vc_before_init', 'wdt_sp_contact_form_vc_map' );

function wdt_sp_contact_form_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name" => esc_html__( 'Contact Form','wdt-portfolio'),
		"base" => "wdt_sp_contact_form",
		"icon" => "wdt_sp_contact_form",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params" => array(

			// Listing Id
			array(
				'type' => 'textfield',
				'heading' => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name' => 'listing_id',
				'description' => sprintf( esc_html__('Provide %1$s id for which you have to contact form. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'admin_label' => true,
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Textarea Placeholder
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Textarea Placeholder','wdt-portfolio'),
				'param_name' => 'textarea_placeholder',
				'description' => sprintf( esc_html__( 'You can customize palceholder text here. Also you can use {{title}} shortcode replace it with %1$s title','wdt-portfolio'), strtolower($listing_singular_label) ),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Submit Button Label
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Submit Button Label','wdt-portfolio'),
				'param_name' => 'submit_label',
				'description' => esc_html__( 'You can customize submit button label here.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Contact Point
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Contact Point','wdt-portfolio'),
				'param_name' => 'contact_point',
				'value' => array(
					sprintf( esc_html__( '%1$s Email','wdt-portfolio'), $listing_singular_label ) => '',
					esc_html__('Author Email','wdt-portfolio') => 'author-email'
				),
				'description' => esc_html__( 'Choose design type for this item.','wdt-portfolio'),
				'std' => '',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Include Admin
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Include Admin','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to send copy of mail to administrator.','wdt-portfolio'),
				'param_name' => 'include_admin',
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