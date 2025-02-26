<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package Dada WordPress theme
 */

function dada_tgmpa_plugins_register() {

	$plugins_list = array(
        array(
            'name'               => esc_html__('Dada Plus', 'dada'),
            'slug'               => 'dada-plus',
            'source'             => DADA_MODULE_DIR . '/plugins/dada-plus.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('Dada Pro', 'dada'),
            'slug'               => 'dada-pro',
            'source'             => DADA_MODULE_DIR . '/plugins/dada-pro.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Elementor', 'dada'),
            'slug'     => 'elementor',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Elementor Addon', 'dada'),
            'slug'               => 'wedesigntech-elementor-addon',
            'source'             => DADA_MODULE_DIR . '/plugins/wedesigntech-elementor-addon.zip',
            'required'           => true,
            'version'            => '1.0.2',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Portfolio', 'dada'),
            'slug'               => 'wedesigntech-portfolio',
            'source'             => DADA_MODULE_DIR . '/plugins/wedesigntech-portfolio.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Contact Form 7', 'dada'),
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('One Click Demo Importer', 'dada'),
            'slug'     => 'one-click-demo-import',
            'required' => true,
        )
	);
    $plugins = apply_filters('dada_required_plugins_list', $plugins_list);

	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'dada_theme',
		'domain'       => 'dada',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );

}
add_action( 'tgmpa_register', 'dada_tgmpa_plugins_register' );