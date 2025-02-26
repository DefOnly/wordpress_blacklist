<?php
add_action( 'vc_before_init', 'wdt_sf_open_now_field_vc_map' );

function wdt_sf_open_now_field_vc_map() {

	vc_map( array(
		"name" => esc_html__( 'Open Now','wdt-portfolio'),
		"base" => "wdt_sf_open_now",
		"icon" => "wdt_sf_open_now",
		"category" => WDT_PB_MODULE_SEARCHFORM_TITLE,
		"params" => array(

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
			),

			// Class
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Class','wdt-portfolio'),
				'param_name' => 'class',
				'description' => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
			),

		)

	) );

}
?>