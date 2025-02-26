<?php
add_action( 'vc_before_init', 'wdt_listings_taxonomy_vc_map' );

function wdt_listings_taxonomy_vc_map() {

	$listing_singular_label      = apply_filters( 'listing_label', 'singular' );
	$listing_plural_label        = apply_filters( 'listing_label', 'plural' );

	$taxonomies = apply_filters( 'wdt_taxonomies', array () );
	$taxonomies = array_flip($taxonomies);

	vc_map( array(
		"name" => sprintf( esc_html__('%1$s Taxonomy','wdt-portfolio'), $listing_plural_label ),
		"base" => "wdt_listings_taxonomy",
		"icon" => "wdt_listings_taxonomy",
		"category" => WDT_PB_MODULE_DEFAULT_TITLE,
		"params" => array(

			// Taxonomy
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Taxonomy','wdt-portfolio'),
				'param_name' => 'taxonomy',
				'value' => $taxonomies,
				'description' => esc_html__( 'Choose type of taxonomy you would like to display.','wdt-portfolio'),
				'std' => 'wdt_listings_category',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Type','wdt-portfolio'),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Type 1','wdt-portfolio')  => 'type1',
					esc_html__('Type 2','wdt-portfolio')  => 'type2',
					esc_html__('Type 3','wdt-portfolio')  => 'type3',
					esc_html__('Type 4','wdt-portfolio')  => 'type4',
					esc_html__('Type 5','wdt-portfolio')  => 'type5',
					esc_html__('Type 6','wdt-portfolio')  => 'type6',
					esc_html__('Type 7','wdt-portfolio')  => 'type7',
				),
				'description' => esc_html__( 'Choose type of taxonomy to display.','wdt-portfolio'),
				'std' => 'type1',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Image or Icon
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Media Type','wdt-portfolio'),
				'param_name' => 'media_type',
				'value' => array(
					esc_html__('Image','wdt-portfolio')      => 'image',
					esc_html__('Icon','wdt-portfolio')       => 'icon',
					esc_html__('Icon Image','wdt-portfolio') => 'icon_image'
				),
				'description' => esc_html__( 'Choose whether to display image or icon.','wdt-portfolio'),
				'std' => 'image',
				'dependency' => array( 'element' => 'type', 'value' => array ('type1', 'type2', 'type3', 'type4') ),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label' => true
			),

			// Columns
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Columns','wdt-portfolio'),
				'param_name' => 'columns',
				'value' => array(
							esc_html__('None','wdt-portfolio') => '' ,
							esc_html__('I Column','wdt-portfolio') => 1 ,
							esc_html__('II Columns','wdt-portfolio') => 2 ,
							esc_html__('III Columns','wdt-portfolio') => 3,
						),
				'description' => esc_html__( 'Number of columns you like to display your taxonomies.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'std' => ''
			),

			// Include
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Include','wdt-portfolio'),
				'param_name' => 'include',
				'description' => esc_html__( 'List of taxonomy ids separated by commas.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Show Parent Items Alone
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Parent Items Alone','wdt-portfolio'),
				'param_name' => 'show_parent_items_alone',
				'value' => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio') => 'true',
				),
				'description' => esc_html__( 'If you like to show parent items alone choose "True".','wdt-portfolio'),
				'std' => 'false',
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),

			// Child Of
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Child Of','wdt-portfolio'),
				'param_name' => 'child_of',
				'description' => esc_html__( 'If you like to show child of any parent item, provide id of your taxonomy here.','wdt-portfolio'),
				'dependency' => array( 'element' => 'show_parent_items_alone', 'value' => 'false' ),
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