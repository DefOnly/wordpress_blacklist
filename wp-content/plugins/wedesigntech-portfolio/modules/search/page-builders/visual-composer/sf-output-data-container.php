<?php
add_action( 'vc_before_init', 'wdt_sf_output_data_container_vc_map' );

function wdt_sf_output_data_container_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	$wdt_sf_output_data_container_vc_map_module_args = apply_filters('wdt_sf_output_data_container_vc_map_module_args', array ());

	vc_map( array (
		"name"     => esc_html__( 'Output Data Container','wdt-portfolio'),
		"base"     => "wdt_sf_output_data_container",
		"icon"     => "wdt_sf_output_data_container",
		"category" => WDT_PB_MODULE_SEARCHFORM_TITLE,
		"params"   => array (

						// Default Options

							// Type
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Type','wdt-portfolio'),
								'param_name' => 'type',
								'value' => array(
									esc_html__( 'Type 1','wdt-portfolio')  => 'type1',
									esc_html__( 'Type 2','wdt-portfolio')  => 'type2',
									esc_html__( 'Type 3','wdt-portfolio')  => 'type3',
									esc_html__( 'Type 4','wdt-portfolio')  => 'type4',
									esc_html__( 'Type 5','wdt-portfolio')  => 'type5',
									esc_html__( 'Type 6','wdt-portfolio')  => 'type6'
								),
								'description' => esc_html__('Choose type of layout you like to display.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Gallery
							array (
								'type' => 'dropdown',
								'heading' => esc_html__('Gallery','wdt-portfolio'),
								'param_name' => 'gallery',
								'value' => array(
									esc_html__('Featured Image','wdt-portfolio') => 'featured_image',
									esc_html__('Image Gallery','wdt-portfolio') => 'image_gallery',
									esc_html__('Image Gallery With Featured Image','wdt-portfolio') => 'gallery_with_featured',
								),
								'description' => esc_html__( 'Choose how you like to display image gallery.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'std' => 'featured_image',
							),

							// Post Per Page
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Post Per Page','wdt-portfolio'),
								'param_name' => 'post_per_page',
								'description' => esc_html__( 'Number of posts to show per page. Rest of the posts will be displayed in pagination.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Columns
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Columns','wdt-portfolio'),
								'param_name' => 'columns',
								'value' => array(
											esc_html__('I Column','wdt-portfolio') => 1 ,
											esc_html__('II Columns','wdt-portfolio') => 2 ,
											esc_html__('III Columns','wdt-portfolio') => 3
										),
								'description' => esc_html__( 'Number of columns you like to display your items.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'type', 'value' => array( 'type1', 'type2', 'type4', 'type6', 'type8')),
								'std' => 1
							),

							// Apply Isotope
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Apply Isotope','wdt-portfolio'),
								'param_name' => 'apply_isotope',
								'value' => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio') => 'true',
								),
								'description' => esc_html__('Choose true if you like to apply isotope for your items.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Excerpt Length
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Excerpt Length','wdt-portfolio'),
								'param_name' => 'excerpt_length',
								'description' => esc_html__( 'Provide excerpt length here.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'std' => 20
							),

							// Features Image or Icon
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Features Image or Icon','wdt-portfolio'),
								'param_name' => 'features_image_or_icon',
								'value' => array(
									esc_html__( 'None','wdt-portfolio') => '',
									esc_html__( 'Image','wdt-portfolio') => 'image',
									esc_html__( 'Icon','wdt-portfolio') => 'icon'
								),
								'description' => esc_html__('Choose any of the option available to display features.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'std' => '',
							),

							// Features Include
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Features Include','wdt-portfolio'),
								'param_name' => 'features_include',
								'description' => esc_html__('Give features id separated by comma. Only 4 maximum number of features allowed.','wdt-portfolio'),
								'std' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// No. Of Categories to Display
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('No. Of Categories to Display','wdt-portfolio'),
								'param_name' => 'no_of_cat_to_display',
								'value' => array(
									1  => 1,
									2  => 2,
									3  => 3,
									4  => 4
								),
								'description' => esc_html__( 'Number of categories you like to display on your items.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'std' => 2
							),

							// Apply Equal Height
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Apply Equal Height','wdt-portfolio'),
								'param_name' => 'apply_equal_height',
								'value' => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio') => 'true',
								),
								'description' => esc_html__('Apply equal height for you items.','wdt-portfolio'),
								'std' => 'false',
								'dependency' => array( 'element' => 'apply_isotope', 'value' =>'false' ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Apply Custom Height
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Apply Custom Height','wdt-portfolio'),
								'param_name' => 'apply_custom_height',
								'value' => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio') => 'true',
								),
								'description' => esc_html__('Apply custom height for your entire section.','wdt-portfolio'),
								'std' => 'false',
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Height
							array (
								'type' => 'textfield',
								'heading' => esc_html__( 'Height','wdt-portfolio'),
								'param_name' => 'vc_height',
								'description' => esc_html__( 'Provide height for your section in "px" here.','wdt-portfolio'),
								'dependency' => array( 'element' => 'apply_custom_height', 'value' =>'true' ),
								'edit_field_class' => 'vc_column vc_col-sm-6'
							),

							// Sidebar Widget
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Sidebar Widget','wdt-portfolio'),
								'param_name' => 'sidebar_widget',
								'value' => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio') => 'true',
								),
								'description' => esc_html__('If you wish to show these items in sidebar set this to "True". This options is not applicable for "Type 3", "Type 5" and "Type 7"','wdt-portfolio'),
								'std' => 'false',
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Class
							array (
								'type' => 'textfield',
								'heading' => esc_html__( 'Class','wdt-portfolio'),
								'param_name' => 'class',
								'description' => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

						// Module Options

							$wdt_sf_output_data_container_vc_map_module_args,

						// Filter Options

							// Category Ids
							array(
								'type' => 'textfield',
								'heading' => sprintf( esc_html__('%1$s Category Ids','wdt-portfolio'), $listing_singular_label ),
								'param_name' => 'category_ids',
								'value' => '',
								'description' => esc_html__( 'Enter category ids separated by commas.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Filters',
								'std' => ''
							),

					)

	) );

}
?>