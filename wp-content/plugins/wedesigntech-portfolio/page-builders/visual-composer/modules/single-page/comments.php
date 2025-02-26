<?php
add_action( 'vc_before_init', 'wdt_sp_comments_vc_map' );

function wdt_sp_comments_vc_map() {

	vc_map( array(
		"name" => esc_html__( 'Comments','wdt-portfolio'),
		"base" => "wdt_sp_comments",
		"icon" => "wdt_sp_comments",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params" => array(

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