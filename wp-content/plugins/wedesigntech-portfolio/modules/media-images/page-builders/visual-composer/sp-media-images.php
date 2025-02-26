<?php
add_action( 'vc_before_init', 'wdt_sp_media_images_vc_map' );

function wdt_sp_media_images_vc_map() {

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );

	vc_map( array(
		"name"     => esc_html__( 'Media - Images','wdt-portfolio'),
		"base"     => "wdt_sp_media_images",
		"icon"     => "wdt_sp_media_images",
		"category" => WDT_PB_MODULE_SINGLEPAGE_TITLE,
		"params"   => array(

			// Listing Id
			array(
				'type'             => 'textfield',
				'heading'          => sprintf( esc_html__('%1$s Id','wdt-portfolio'), $listing_singular_label ),
				'param_name'       => 'listing_id',
				'description'      => sprintf( esc_html__('Provide %1$s id for which you have to display featured image. No need to provide ID if it is used in %1$s single page.','wdt-portfolio'), strtolower($listing_singular_label) ),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label'      => true
			),

			// Thumbnail Sizes
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Thumbnail Sizes','wdt-portfolio'),
				'param_name' => 'image_size',
				'value'      => array(
					esc_html__('Thumbnail','wdt-portfolio')    => 'thumbnail',
					esc_html__('Medium','wdt-portfolio')       => 'medium',
					esc_html__('Medium Large','wdt-portfolio') => 'medium_large',
					esc_html__('Large','wdt-portfolio')        => 'large',
					esc_html__('Full','wdt-portfolio')         => 'full',
				),
				'description'      => esc_html__( 'Choose any of the above image sizes.','wdt-portfolio'),
				'std'              => 'full',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'admin_label'      => true
			),

			// Show Image Description
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Show Image Description','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to show image description in carousel.','wdt-portfolio'),
				'param_name'  => 'show_image_description',
				'value'       => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio')  => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Include Feature Image
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Include Feature Image','wdt-portfolio'),
				'description' => esc_html__('Choose "True" if you like to include featured image in this gallery.','wdt-portfolio'),
				'param_name'  => 'include_featured_image',
				'value'       => array(
					esc_html__( 'False','wdt-portfolio') => 'false',
					esc_html__( 'True','wdt-portfolio')  => 'true',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			// Class
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Class','wdt-portfolio'),
				'param_name'       => 'class',
				'description'      => esc_html__( 'If you wish you can add additional class name here.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6'
			),

			/* Carousel Tab */

			// Effect
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Effect','wdt-portfolio'),
				'param_name' => 'carousel_effect',
				'value'      => array(
					esc_html__('Default','wdt-portfolio') => '',
					esc_html__('Fade','wdt-portfolio')    => 'fade',
				),
				'description'      => esc_html__( 'Choose effect for your carousel. Slides Per View has to be 1 for Fade effect.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
				'std'              => ''
			),

			// Auto Play
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__('Auto Play','wdt-portfolio'),
				'param_name'       => 'carousel_autoplay',
				'description'      => esc_html__( 'Delay between transitions ( in ms ). Leave empty if you don\'t want to auto play.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
			),

			// Slides Per View
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Slides Per View','wdt-portfolio'),
				'param_name' => 'carousel_slidesperview',
				'value'      => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'description'      => esc_html__( 'Number slides of to show in view port.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
				'std'              => ''
			),

			// Enable loop mode
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable Loop Mode','wdt-portfolio'),
				'param_name' => 'carousel_loopmode',
				'value'      => array(
					esc_html__('False','wdt-portfolio') => 'false',
					esc_html__('True','wdt-portfolio')  => 'true',
				),
				'description'      => esc_html__( 'If you wish you can enable continous loop mode for your carousel.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
				'std'              => ''
			),

			// Enable mousewheel control
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable Mousewheel Control','wdt-portfolio'),
				'param_name' => 'carousel_mousewheelcontrol',
				'value'      => array(
					esc_html__('False','wdt-portfolio') => 'false',
					esc_html__('True','wdt-portfolio')  => 'true',
				),
				'description'      => esc_html__( 'If you wish you can enable mouse wheel control for your carousel.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
				'std'              => ''
			),

			// Enable vertical direction
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable Vertical Direction','wdt-portfolio'),
				'param_name' => 'carousel_verticaldirection',
				'value'      => array(
					esc_html__('False','wdt-portfolio') => 'false',
					esc_html__('True','wdt-portfolio')  => 'true',
				),
				'description'      => esc_html__( 'To make your slides to navigate vertically.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
				'std'              => ''
			),

			// Pagination Type
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Pagination Type','wdt-portfolio'),
				'param_name' => 'carousel_paginationtype',
				'value'      => array(
					esc_html__('None','wdt-portfolio')         => '',
					esc_html__('Bullets','wdt-portfolio')      => 'bullets',
					esc_html__('Fraction','wdt-portfolio')     => 'fraction',
					esc_html__('Progress Bar','wdt-portfolio') => 'progressbar',
					esc_html__('Scroll Bar','wdt-portfolio')   => 'scrollbar',
					esc_html__('Thumbnail','wdt-portfolio')    => 'thumbnail'
				),
				'description'      => esc_html__( 'Choose pagination type you like to use.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
				'std'              => ''
			),

			// Number of Thumbnails
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Number of Thumbnails','wdt-portfolio'),
				'param_name' => 'carousel_numberofthumbnails',
				'value'      => array(
					3 => 3,
					4 => 4,
					5 => 5,
					6 => 6,
				),
				'description'      => esc_html__( 'Number of thumbnails to show.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency'       => array( 'element' => 'carousel_paginationtype', 'value' =>'thumbnail' ),
				'group'            => 'Carousel',
				'std'              => 3
			),

			// Enable Arrow Pagination
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable Arrow Pagination','wdt-portfolio'),
				'param_name' => 'carousel_arrowpagination',
				'value'      => array(
					esc_html__('False','wdt-portfolio') => 'false',
					esc_html__('True','wdt-portfolio')  => 'true',
				),
				'description'      => esc_html__( 'To enable arrow pagination.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
				'std'              => ''
			),

			// Arrow Type
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Arrow Type','wdt-portfolio'),
				'param_name' => 'carousel_arrowpagination_type',
				'value'      => array(
					esc_html__('Type 1','wdt-portfolio') => 'type1',
					esc_html__('Type 2','wdt-portfolio') => 'type2',
					esc_html__('Type 3','wdt-portfolio') => 'type3'
				),
				'description'      => esc_html__( 'Choose arrow pagination type for your carousel.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
				'std'              => 'type1'
			),

			// Space Between Sliders
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__('Space Between Sliders','wdt-portfolio'),
				'param_name'       => 'carousel_spacebetween',
				'description'      => esc_html__( 'Space between sliders can be given here.','wdt-portfolio'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'            => 'Carousel',
			),

		)
	) );
}
?>