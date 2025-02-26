<?php
add_action( 'vc_before_init', 'wdt_sp_featured_comments_vc_map' );

function wdt_sp_featured_comments_vc_map() {

	vc_map( array(
		"name"     => esc_html__( 'Comments - Featured','wdt-portfolio'),
		"base"     => "wdt_sp_featured_comments",
		"icon"     => "wdt_sp_featured_comments",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params"   => array(

			// Enable Title
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable Title','wdt-portfolio'),
				'param_name' => 'enable_title',
				'value'      => array(
					esc_html__('False','wdt-portfolio') => 'false',
					esc_html__('True','wdt-portfolio')  => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'std'              => 'false'
			),

			// Enable Rating
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable Rating','wdt-portfolio'),
				'param_name' => 'enable_rating',
				'value'      => array(
					esc_html__('False','wdt-portfolio') => 'false',
					esc_html__('True','wdt-portfolio')  => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'std'              => 'false'
			),

			// Enable Media
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable Media','wdt-portfolio'),
				'param_name' => 'enable_media',
				'value'      => array(
					esc_html__('False','wdt-portfolio') => 'false',
					esc_html__('True','wdt-portfolio')  => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'std'              => 'false'
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