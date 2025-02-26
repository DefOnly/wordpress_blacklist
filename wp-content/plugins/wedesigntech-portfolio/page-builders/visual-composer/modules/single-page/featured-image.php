<?php
add_action( 'vc_before_init', 'wdt_sp_featured_image_vc_map' );

function wdt_sp_featured_image_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name" => esc_html__( 'Featured Image','wdt-portfolio'),
		"base" => "wdt_sp_featured_image",
		"icon" => "wdt_sp_featured_image",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params" => array(

			// Listing Id
			array(
				'type' => 'textfield',
				'heading' => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name' => 'listing_id',
				'description' => sprintf( esc_html__('Provide %1$s id for which you have to display featured image. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Thumbnail Sizes
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Thumbnail Sizes','wdt-portfolio'),
				'param_name' => 'image_size',
				'value' => array(
					esc_html__('Thumbnail','wdt-portfolio') => 'thumbnail',
					esc_html__('Medium','wdt-portfolio') => 'medium',
					esc_html__('Medium Large','wdt-portfolio') => 'medium_large',
					esc_html__('Large','wdt-portfolio') => 'large',
					esc_html__('Full','wdt-portfolio') => 'full',
				),
				'description' => esc_html__( 'Choose any of the above image sizes.','wdt-portfolio'),
				'std' => 'full',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Class
			array (
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