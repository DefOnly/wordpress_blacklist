<?php
add_action( 'vc_before_init', 'wdt_listings_listing_vc_map' );

function wdt_listings_listing_vc_map() {

	$listing_singular_label      = apply_filters( 'listing_label', 'singular' );
	$listing_plural_label        = apply_filters( 'listing_label', 'plural' );
	$amenity_singular_label      = apply_filters( 'amenity_label', 'singular' );
	$amenity_plural_label        = apply_filters( 'amenity_label', 'plural' );


	$wdt_listings_listing_vc_map_module_args = apply_filters('wdt_listings_listing_vc_map_module_args', array ());

	// From Location Module

	vc_map( array(
		"name"     => sprintf( esc_html__('%1$s Listing','wdt-portfolio'), $listing_plural_label ),
		"base"     => "wdt_listings_listing",
		"icon"     => "wdt_listings_listing",
		"category" => WDT_PB_MODULE_DEFAULT_TITLE,
		"params"   => array(

						// Default Options
							// Type
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Type','wdt-portfolio'),
								'param_name' => 'type',
								'value'      => array(
									esc_html__( 'Type 1','wdt-portfolio')  => 'type1',
									esc_html__( 'Type 2','wdt-portfolio')  => 'type2',
									esc_html__( 'Type 3','wdt-portfolio')  => 'type3',
									esc_html__( 'Type 4','wdt-portfolio')  => 'type4',
									esc_html__( 'Type 5','wdt-portfolio')  => 'type5',
									esc_html__( 'Type 6','wdt-portfolio')  => 'type6'
								),
								'description'      => esc_html__('Choose type of layout you like to display.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'std'              => 'type1',
							),

							// Post Per Page
							array(
								'type'             => 'textfield',
								'heading'          => esc_html__( 'Post Per Page','wdt-portfolio'),
								'param_name'       => 'post_per_page',
								'description'      => esc_html__( 'Number of posts to show per page. Rest of the posts will be displayed in pagination.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Columns
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Columns','wdt-portfolio'),
								'param_name' => 'columns',
								'value'      => array(
									esc_html__('I Column','wdt-portfolio')    => 1,
									esc_html__('II Columns','wdt-portfolio')  => 2,
									esc_html__('III Columns','wdt-portfolio') => 3,
									esc_html__('IV Columns','wdt-portfolio')  => 4
								),
								'description'      => esc_html__( 'Number of columns you like to display your items.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency'       => array( 'element' => 'type', 'value' => array( 'type1', 'type2', 'type3', 'type4', 'type5', 'type6', 'type8', 'type10')),
								'std'              => 1
							),

							// Apply Isotope
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Apply Isotope','wdt-portfolio'),
								'param_name' => 'apply_isotope',
								'value'      => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio')  => 'true',
								),
								'std'              => 'true',
								'description'      => esc_html__('Choose true if you like to apply isotope for your items.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Isotope Filter
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Isotope Filter','wdt-portfolio'),
								'param_name' => 'isotope_filter',
								'value'      => array(
									esc_html__( 'None','wdt-portfolio') => '',
									esc_html__( 'Category','wdt-portfolio') => 'category'
								),
								'std'              => '',
								'description'      => esc_html__('Choose isotope filter you like to use.','wdt-portfolio'),
								'dependency'       => array( 'element' => 'apply_isotope', 'value' =>'true' ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

                            // Show Isotope Filter Count
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Show Isotope Filter Count','wdt-portfolio'),
								'param_name' => 'show_isotope_filter_count',
								'value'      => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio')  => 'true',
								),
								'std'              => 'false',
								'description'      => esc_html__('Choose "True", if you like to show total items count for all categories along with filters.','wdt-portfolio'),
								'dependency'       => array( 'element' => 'apply_isotope', 'value' =>'true' ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Apply Child Of
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Apply Child Of','wdt-portfolio'),
								'param_name' => 'apply_child_of',
								'value'      => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio')  => 'true',
								),
								'std'              => 'false',
								'description'      => esc_html__('If you wish to apply child of specified categories in filters, choose "True". If no categories specified in "Filter Options" this option won\'t work.','wdt-portfolio'),
								'dependency'       => array( 'element' => 'apply_isotope', 'value' =>'true' ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Featured Items
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Featured Items','wdt-portfolio'),
								'param_name' => 'featured_items',
								'value'      => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio')  => 'true',
								),
								'description'      => esc_html__('Choose true if you like to display featured items.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Excerpt Length
							array(
								'type'             => 'textfield',
								'heading'          => esc_html__( 'Excerpt Length','wdt-portfolio'),
								'param_name'       => 'excerpt_length',
								'description'      => esc_html__( 'Provide excerpt length here.','wdt-portfolio'),
								'dependency'       => array( 'element' => 'type', 'value' => array ( 'type1', 'type2', 'type3', 'type4', 'type5', 'type7', 'type8', 'type9', 'type10' )),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'std'              => 20
							),

							// Features Image or Icon
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Features Image or Icon','wdt-portfolio'),
								'param_name' => 'features_image_or_icon',
								'value'      => array(
									esc_html__( 'None','wdt-portfolio')  => '',
									esc_html__( 'Image','wdt-portfolio') => 'image',
									esc_html__( 'Icon','wdt-portfolio')  => 'icon'
								),
								'description'      => esc_html__('Choose any of the option available to display features.','wdt-portfolio'),
								'dependency'       => array( 'element' => 'type', 'value' => array ( 'type1', 'type2', 'type3', 'type4', 'type5', 'type6', 'type8', 'type9' )),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'std'              => '',
							),

							// Features Include
							array(
								'type'             => 'dropdown',
								'heading'          => esc_html__('Features Include','wdt-portfolio'),
								'param_name'       => 'features_include',
								'description'      => esc_html__('Give features id separated by comma. Only 4 maximum number of features allowed.','wdt-portfolio'),
								'std'              => '',
								'dependency'       => array( 'element' => 'type', 'value' => array ( 'type1', 'type2', 'type3', 'type4', 'type5', 'type6', 'type8', 'type9' )),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// No. Of Categories to Display
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('No. Of Categories to Display','wdt-portfolio'),
								'param_name' => 'no_of_cat_to_display',
								'value'      => array(
									0 => 0,
									1 => 1,
									2 => 2,
									3 => 3,
									4 => 4
								),
								'description'      => esc_html__( 'Number of categories you like to display on your items.','wdt-portfolio'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'std'              => 2
							),

							// Apply Equal Height
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Apply Equal Height','wdt-portfolio'),
								'param_name' => 'apply_equal_height',
								'value'      => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio')  => 'true',
								),
								'description'      => esc_html__('Apply equal height for you items.','wdt-portfolio'),
								'std'              => 'false',
								'dependency'       => array( 'element' => 'apply_isotope', 'value' =>'false' ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),

							// Apply Custom Height
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Apply Custom Height','wdt-portfolio'),
								'param_name' => 'apply_custom_height',
								'value'      => array(
									esc_html__( 'False','wdt-portfolio') => 'false',
									esc_html__( 'True','wdt-portfolio')  => 'true',
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

							// Pagination Type
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Pagination Type','wdt-portfolio'),
								'param_name' => 'pagination_type',
								'value' => array(
                                    ''        => esc_html__('None','wdt-portfolio'),
                                    'numbered' => esc_html__('Numbered','wdt-portfolio'),
                                    'loadmore' => esc_html__('Load More','wdt-portfolio'),
                                    'infinity' => esc_html__('Infinity','wdt-portfolio')
								),
								'std' => '',
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

							$wdt_listings_listing_vc_map_module_args,

						// Filter Options

							// Listing Item Ids
							array(
								'type' => 'textfield',
								'heading' => sprintf( esc_html__('%1$s Item Ids','wdt-portfolio'), $listing_singular_label ),
								'param_name' => 'list_item_ids',
								'value' => '',
								'description' => sprintf( esc_html__( 'Enter %1$s item ids separated by commas.','wdt-portfolio'), $listing_singular_label ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Filters',
								'std' => ''
							),

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

							// Tag Ids
							array(
								'type' => 'textfield',
								'heading' => sprintf( esc_html__('%1$s %2$s','wdt-portfolio'), $listing_singular_label, $amenity_plural_label ),
								'param_name' => 'tag_ids',
								'value' => '',
								'description' => sprintf( esc_html__('Enter %1$s ids separated by commas','wdt-portfolio'), $amenity_plural_label ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Filters',
								'std' => ''
							),

						// Masonary Options

							// One Column Items
							array(
								'type' => 'textfield',
								'heading' => esc_html__('One Column Items','wdt-portfolio'),
								'param_name' => 'masonary_one_items',
								'value' => '',
								'description' => sprintf( esc_html__( 'Enter %1$s item positions separated by commas.','wdt-portfolio'), $listing_singular_label ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Masonary',
								'std' => ''
							),

							// One Half Column Items
							array(
								'type' => 'textfield',
								'heading' => esc_html__('One Half Column Items','wdt-portfolio'),
								'param_name' => 'masonary_one_half_items',
								'value' => '',
								'description' => sprintf( esc_html__( 'Enter %1$s item positions separated by commas.','wdt-portfolio'), $listing_singular_label ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Masonary',
								'std' => ''
							),

							// One Third Column Items
							array(
								'type' => 'textfield',
								'heading' => esc_html__('One Third Column Items','wdt-portfolio'),
								'param_name' => 'masonary_one_third_items',
								'value' => '',
								'description' => sprintf( esc_html__( 'Enter %1$s item positions separated by commas.','wdt-portfolio'), $listing_singular_label ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Masonary',
								'std' => ''
							),

							// Two Third Column Items
							array(
								'type' => 'textfield',
								'heading' => esc_html__('Two Third Column Items','wdt-portfolio'),
								'param_name' => 'masonary_two_third_items',
								'value' => '',
								'description' => sprintf( esc_html__( 'Enter %1$s item positions separated by commas.','wdt-portfolio'), $listing_singular_label ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Masonary',
								'std' => ''
							),

							// One Fourth Column Items
							array(
								'type' => 'textfield',
								'heading' => esc_html__('One Fourth Column Items','wdt-portfolio'),
								'param_name' => 'masonary_one_fourth_items',
								'value' => '',
								'description' => sprintf( esc_html__( 'Enter %1$s item positions separated by commas.','wdt-portfolio'), $listing_singular_label ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Masonary',
								'std' => ''
							),

							// Two Fourth Column Items
							array(
								'type' => 'textfield',
								'heading' => esc_html__('Two Fourth Column Items','wdt-portfolio'),
								'param_name' => 'masonary_three_fourth_items',
								'value' => '',
								'description' => sprintf( esc_html__( 'Enter %1$s item positions separated by commas.','wdt-portfolio'), $listing_singular_label ),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => 'Masonary',
								'std' => ''
							),

						// Carousel Options

							// Enable Carousel
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Enable Carousel','wdt-portfolio'),
								'param_name' => 'enable_carousel',
								'value' => array(
											esc_html__('False','wdt-portfolio') => '',
											esc_html__('True','wdt-portfolio') => 'true',
										),
								'description' => esc_html__( 'If you wish you can enable carousel for your item listings. Carousel won\'t work along with "Isotope" & "Equal Height" option.','wdt-portfolio'),
								'group' => 'Carousel',
								'dependency' => array( 'element' => 'apply_isotope', 'value' => 'false'),
								'std' => ''
							),

							// Effect
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Effect','wdt-portfolio'),
								'param_name' => 'carousel_effect',
								'value' => array(
											esc_html__('Default','wdt-portfolio') => '',
											esc_html__('Fade','wdt-portfolio') => 'fade',
										),
								'description' => esc_html__( 'Choose effect for your carousel. Slides Per View has to be 1 for Fade effect.','wdt-portfolio'),
								'group' => 'Carousel',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'enable_carousel', 'value' => 'true'),
								'std' => ''
							),

							// Auto Play
							array(
								'type' => 'textfield',
								'heading' => esc_html__('Auto Play','wdt-portfolio'),
								'param_name' => 'carousel_autoplay',
								'description' => esc_html__( 'Delay between transitions ( in ms ). Leave empty if you don\'t want to auto play.','wdt-portfolio'),
								'group' => 'Carousel',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'enable_carousel', 'value' => 'true'),
							),

							// Slides Per View
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Slides Per View','wdt-portfolio'),
								'param_name' => 'carousel_slidesperview',
								'value' => array(
											1 => 1,
											2 => 2,
											3 => 3,
											4 => 4,
										),
								'description' => esc_html__( 'Number slides of to show in view port. 2,3,4 options not applicable for "type 3", "type 5", "type 7" and "type9". If "Sidebar Widget" is set to "True", than "Slides Per View" will be set to "1".','wdt-portfolio'),
								'group' => 'Carousel',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'enable_carousel', 'value' => 'true'),
								'std' => 2
							),

							// Enable loop mode
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Enable Loop Mode','wdt-portfolio'),
								'param_name' => 'carousel_loopmode',
								'value' => array(
									esc_html__('False','wdt-portfolio') => 'false',
									esc_html__('True','wdt-portfolio') => 'true',
								),
								'description' => esc_html__( 'If you wish you can enable continous loop mode for your carousel.','wdt-portfolio'),
								'group' => 'Carousel',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'enable_carousel', 'value' => 'true'),
								'std' => ''
							),

							// Enable mousewheel control
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Enable Mousewheel Control','wdt-portfolio'),
								'param_name' => 'carousel_mousewheelcontrol',
								'value' => array(
									esc_html__('False','wdt-portfolio') => 'false',
									esc_html__('True','wdt-portfolio') => 'true',
								),
								'description' => esc_html__( 'If you wish you can enable mouse wheel control for your carousel.','wdt-portfolio'),
								'group' => 'Carousel',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'enable_carousel', 'value' => 'true'),
								'std' => ''
							),

							// Enable Bullet Pagination
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Enable Bullet Pagination','wdt-portfolio'),
								'param_name' => 'carousel_bulletpagination',
								'value' => array(
									esc_html__('False','wdt-portfolio') => 'false',
									esc_html__('True','wdt-portfolio') => 'true',
								),
								'description' => esc_html__( 'To enable bullet pagination.','wdt-portfolio'),
								'group' => 'Carousel',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'enable_carousel', 'value' => 'true'),
								'std' => ''
							),

							// Enable Arrow Pagination
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Enable Arrow Pagination','wdt-portfolio'),
								'param_name' => 'carousel_arrowpagination',
								'value' => array(
									esc_html__('False','wdt-portfolio') => 'false',
									esc_html__('True','wdt-portfolio') => 'true',
								),
								'description' => esc_html__( 'To enable arrow pagination.','wdt-portfolio'),
								'group' => 'Carousel',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'enable_carousel', 'value' => 'true'),
								'std' => ''
							),

							// Space Between Sliders
							array(
								'type' => 'textfield',
								'heading' => esc_html__('Space Between Sliders','wdt-portfolio'),
								'param_name' => 'carousel_spacebetween',
								'description' => esc_html__( 'Space between sliders can be given here.','wdt-portfolio'),
								'group' => 'Carousel',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array( 'element' => 'enable_carousel', 'value' => 'true'),
								'std' => 30
							)

					)

	) );
}
?>