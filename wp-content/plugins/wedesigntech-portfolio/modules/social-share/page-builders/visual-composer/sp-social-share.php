<?php
add_action( 'vc_before_init', 'wdt_sp_social_share_vc_map' );

function wdt_sp_social_share_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name" => esc_html__( 'Social Share','wdt-portfolio'),
		"base" => "wdt_sp_social_share",
		"icon" => "wdt_sp_social_share",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params" => array(

			// Listing Id
			array(
				'type' => 'textfield',
				'heading' => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name' => 'listing_id',
				'description' => sprintf( esc_html__('Provide %1$s id for which you have to display favourites, share,... No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Type','wdt-portfolio'),
				'param_name' => 'type',
				'value' => array(
					esc_html__( 'Type 1','wdt-portfolio')  => 'type1',
					esc_html__( 'Type 2','wdt-portfolio')  => 'type2'
				),
				'description' => esc_html__('Choose type of social share like to display.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'std' => 'type1',
			),

			// Show Facebook
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Facebook','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show facebook share.','wdt-portfolio'),
				'param_name' => 'show_facebook',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Show Delicious
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Delicious','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show delicious share.','wdt-portfolio'),
				'param_name' => 'show_delicious',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Show Digg
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Digg','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show digg share.','wdt-portfolio'),
				'param_name' => 'show_digg',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Show Stumble Upon
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Stumble Upon','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show stumble upon share.','wdt-portfolio'),
				'param_name' => 'show_stumbleupon',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Show Twitter
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Twitter','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show twitter share.','wdt-portfolio'),
				'param_name' => 'show_twitter',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Show Google Plus
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Google Plus','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show google plus share.','wdt-portfolio'),
				'param_name' => 'show_googleplus',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Show LinkedIn
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show LinkedIn','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show linkedin share.','wdt-portfolio'),
				'param_name' => 'show_linkedin',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Show Pinterest
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Pinterest','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show pinterest share.','wdt-portfolio'),
				'param_name' => 'show_pinterest',
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
			)

		)
	) );
}
?>