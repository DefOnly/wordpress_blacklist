<?php
if( !class_exists('WDTPortfolioVisualComposer') ) {

	class WDTPortfolioVisualComposer {

		/**
		 * Instance variable
		 */
		private static $_instance = null;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 */
		public static function instance() {

			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		function __construct() {

			add_action( 'admin_enqueue_scripts', array ( $this, 'wdt_vc_admin_scripts') );
			add_action( 'after_setup_theme', array ( $this, 'wdt_vc_map_shortcodes' ) , 1000 );

		}

		function wdt_vc_admin_scripts( $hook ) {

			if($hook == "post.php" || $hook == "post-new.php") {
				wp_enqueue_style( 'wdt-vc-admin', WDT_PLUGIN_URL.'page-builders/visual-composer/admin.css', array(), false, 'all' );
			}

		}

		function wdt_vc_map_shortcodes() {

			global $pagenow;

			$vc_modules_path = WDT_PLUGIN_PATH . 'page-builders/visual-composer/modules/';

			// General Modules

				$modules['wdt_login_logout_links']             = $vc_modules_path . 'default/login-logout-links.php';
				$modules['wdt_listings_listing']               = $vc_modules_path . 'default/listings-listing.php';
				$modules['wdt_listings_taxonomy']              = $vc_modules_path . 'default/listings-taxonomy.php';


			// Single Page Modules

				$modules['wdt_sp_featured_image']              = $vc_modules_path . 'single-page/featured-image.php';
				$modules['wdt_sp_featured_item']               = $vc_modules_path . 'single-page/featured-item.php';
				$modules['wdt_sp_features']                    = $vc_modules_path . 'single-page/features.php';
				$modules['wdt_sp_contact_details']             = $vc_modules_path . 'single-page/contact-details.php';
				$modules['wdt_sp_social_links']                = $vc_modules_path . 'single-page/social-links.php';
				$modules['wdt_sp_comments']                    = $vc_modules_path . 'single-page/comments.php';
				$modules['wdt_sp_utils']                       = $vc_modules_path . 'single-page/utils.php';
				$modules['wdt_sp_taxonomy']                    = $vc_modules_path . 'single-page/taxonomy.php';
				$modules['wdt_sp_contact_form']                = $vc_modules_path . 'single-page/contact-form.php';
				$modules['wdt_sp_post_date']                   = $vc_modules_path . 'single-page/post-date.php';
				$modules['wdt_sp_mls_number']                  = $vc_modules_path . 'single-page/mls-number.php';
				$modules['wdt_sp_navigation']                  = $vc_modules_path . 'single-page/navigation.php';


			// Load Modules Visual Composer widgets

				$wdt_modules = wdtportfolio_instance()->active_modules;
				if(is_array($wdt_modules) && !empty($wdt_modules)) {
					foreach($wdt_modules as $wdt_module) {

						$module_epb_path = WDT_PLUGIN_MODULE_PATH . '/'.$wdt_module.'/page-builders/visual-composer/';
						$pb_files = glob($module_epb_path.'*.php');

						if(is_array($pb_files) && !empty($pb_files)) {
							foreach($pb_files as $pb_file) {

								$file_base_name = basename($pb_file, '.php');

								$pb_file_slug = str_replace('-', '_', strtolower($file_base_name));
								$pb_file_slug = 'wdt_'.$pb_file_slug;

								$modules[$pb_file_slug] = $pb_file;

							}
						}

					}
				}

			// Apply filters so you can easily modify the modules 100%

				$modules = apply_filters( 'wdt_vc_modules', $modules );


			// Load Modules
			if( !empty( $modules ) ){
				foreach ( $modules as $key => $val ) {
					require_once( $val );
				}
			}


			// Custom Param
			vc_add_shortcode_param( 'title_with_separator', array ( $this, 'wdt_title_with_separator_settings' ) );

		}

		function wdt_title_with_separator_settings( $settings, $value ) {

		   	return '<div class="wdt_' . esc_attr( $settings['param_name'] ) . '_block">
		            	<div class="wdt_param_separator"></div>
		          </div>';

		}


	}

	WDTPortfolioVisualComposer::instance();

}

?>