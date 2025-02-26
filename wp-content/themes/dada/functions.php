<?php

if( !class_exists( 'Dada_Loader' ) ) {

    class Dada_Loader {

        private static $_instance = null;

        private $theme_defaults = array ();

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->define_constants();
            $this->load_helpers();

            $this->theme_defaults = dada_theme_defaults();

            add_action( 'after_setup_theme', array( $this, 'set_theme_support' ) );

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_js' ), 50 );

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ), 50 );
            add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_style' ), 60 );
            add_action( 'after_setup_theme', array( $this, 'include_module_helpers' ) );
            add_action( 'dada_before_main_css', array( $this, 'add_google_fonts' ) );
            add_filter( 'ocdi/import_files', array( $this, 'ocdi_import_files' ), 10);
            add_filter( 'ocdi/after_import', array( $this, 'import_elementor_on_theme_activation' ),11);
            add_filter( 'ocdi/import_files', array( $this, 'ocdi_before_widgets_import' ),9);
            add_action( 'after_switch_theme', array( $this, 'modify_xml_file' ));
            add_filter( 'woocommerce_create_pages', '__return_false' );
            add_filter( 'ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
        }

        function modify_xml_file() {
            global $wp_filesystem;
            $themeRootDirUri = get_template_directory_uri() . '/ocdi/uploads/';
            $themeRootDirUri1 = get_template_directory_uri();
            $themeRootDir = get_template_directory();
            $themeName = basename($themeRootDir); 
            $siteUrl = site_url(); // Get the site URL
            // URLs to replace in XML files
            $xmlFiles = [
                'theme-content.xml' => [
                    'search' => 'https://wdtdada.wpengine.com/wp-content/uploads/',
                    'replace' => $themeRootDirUri
                ],
                'rtl-theme-content.xml' => [
                    'search' => 'https://wdtdada.wpengine.com/rtl-demo/wp-content/uploads/sites/4/',
                    'replace' => $themeRootDirUri
                ]
            ];

            foreach ($xmlFiles as $fileName => $urls) {
                $xmlFilePath = $themeRootDir . '/ocdi/' . $fileName;

                if (file_exists($xmlFilePath)) {
                    $xmlContent = $wp_filesystem->get_contents($xmlFilePath);

                    // Replacements array
                    $replacements = [
                        '<wp:attachment_url><![CDATA[' . $urls['search'] => '<wp:attachment_url><![CDATA[' . $urls['replace'],
                        'src="' . $urls['search'] => 'src="' . $urls['replace'],
                        '<guid isPermaLink="false">' . $urls['search'] => '<guid isPermaLink="false">' . $urls['replace'],
                        '<link>' . rtrim($urls['search'], '/wp-content/uploads/') => '<link>' . $themeRootDirUri1,
                        'href="' . rtrim($urls['search'], '/wp-content/uploads') => 'href="' . $themeRootDirUri1,
                        'https:\/\/wdtdada.wpengine.com\/rtl-demo\/' => str_replace('/', '\\/', $siteUrl) . '\/',
                        'https:\/\/wdtdada.wpengine.com' => str_replace('/', '\\/', $siteUrl),
                        '\\/wp-content\\/uploads' => '\\/wp-content\\/themes\\/' . $themeName . '\\/ocdi\\/uploads',
                        '\/rtl-demo\/' => '', // Remove "/rtl-demo/"
                    ];
                    foreach ($replacements as $oldUrl => $newUrl) {
                        $xmlContent = str_replace($oldUrl, $newUrl, $xmlContent);
                    }
                    $newXmlFilePath = $themeRootDir . '/ocdi/' . str_replace('.xml', '-new.xml', $fileName);
                    if ($wp_filesystem->put_contents($newXmlFilePath, $xmlContent) !== false) {
                        echo "XML file '{$fileName}' has been modified and saved successfully.<br>";
                    } else {
                        echo "Failed to save the modified XML file '{$fileName}'.<br>";
                    }
                } else {
                    echo "XML file '{$fileName}' does not exist.<br>";
                }
            }
        }


        function ocdi_import_files(){
            return array(
                array(
                    'import_file_name'           => 'Default Demo',
                    'import_file_url'            => DADA_ROOT_URI.'/ocdi/theme-content-new.xml',
                    'import_customizer_file_url' => DADA_ROOT_URI.'/ocdi/theme-customizer.dat',
                    'import_widget_file_url'     => DADA_ROOT_URI.'/ocdi/theme-widgets.wie',
                    'import_preview_image_url'   => DADA_ROOT_URI.'/screenshot.png',
                    'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'dada' ),
                    'preview_url'                => 'https://wdtdada.wpengine.com',
                ),
                array(
                    'import_file_name'           => 'RTL Demo',
                    'import_file_url'            => DADA_ROOT_URI.'/ocdi/rtl-theme-content-new.xml',
                    'import_customizer_file_url' => DADA_ROOT_URI.'/ocdi/theme-customizer.dat',
                    'import_widget_file_url'     => DADA_ROOT_URI.'/ocdi/theme-widgets.wie',
                    'import_preview_image_url'   => DADA_ROOT_URI.'/rtl-screenshot.png',
                    'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'dada' ),
                    'preview_url'                => 'https://wdtdada.wpengine.com/rtl-demo',
                )
            );
        }
        function ocdi_before_widgets_import() {
            global $wp_filesystem;
            $widget_file_path = DADA_ROOT_DIR . '/ocdi/theme-widgets.wie';
            $json_data = $wp_filesystem->get_contents($widget_file_path);
            $settings = json_decode($json_data, true);
            $term = 'wdt-cw-';
            $newarr=array();
            foreach($settings as $key => $value )
            {
                if ( stripos( $key, $term ) !== false )
                {
                    $separated_string = str_replace($term, "", $key);
                    register_sidebar( array(
                        'name'          => $key,
                        'id'            => $key,
                        'before_widget' => '<div class="widget">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="widget-title">',
                        'after_title'   => '</h2>',
                    ) );
                    
                    $newarr[]=$key;
                }
            }
            $widget_areas_option = get_option( 'dada-widget-areas');
            if(!empty($widget_areas_option) && is_array( $widget_areas_option )){
            
                $widget_areas1['widget-areas'] = array_unique(array_merge($newarr, $widget_areas_option['widget-areas']));
                update_option( 'dada-widget-areas', $widget_areas1 ); 
                
            }else{
               
                add_option( 'dada-widget-areas', '' );
                $widget_areas_option = get_option( 'dada-widget-areas');
                $widget_empty = array();
                $widget_empty['widget-areas']= array();
                $widget_areas1['widget-areas']= array_unique(array_merge($newarr, $widget_empty['widget-areas']));
                update_option( 'dada-widget-areas', $widget_areas1 ); 
            
            }
        }

        function import_elementor_on_theme_activation() {

            global $wp_filesystem;
            global $post;
            $theme_dir = get_template_directory();
            $file_path = $theme_dir . '/ocdi/site-settings.json';
            if (file_exists($file_path))
            {
                $json_data = $wp_filesystem->get_contents($file_path);
                $settings = json_decode($json_data, true);
                $settings_data = $settings['settings'];
                unset($settings_data['template']);
                $args = array(
                    'post_type' => 'elementor_library',
                    'post_status' => 'publish',
                    'post_title' => 'Default Kit',
                    'fields' => 'ids',
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $post_id = get_the_ID();

                        $meta_data = array(
                            '_elementor_edit_mode' => 'builder',
                            '_wp_page_template' => 'default',
                            '_elementor_page_settings' => $settings_data,
                        );
                        foreach ($meta_data as $meta_key => $meta_value) {
                            add_post_meta($post_id, $meta_key, $meta_value);
                        }
                    }
                    wp_reset_postdata();
                }
            }

            // Assign menus to their locations.
            $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

            set_theme_mod( 'nav_menu_locations', array(
                    'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
                )
            );
            //Default Page settings        
            $front_page_id = new WP_Query(
                array(
                    'post_type'              => 'page',
                    'title'                  => 'Home 1',
                )
            );
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $front_page_id->post->ID );
        }
        function define_constants() {
            define( 'DADA_ROOT_DIR', get_template_directory() );
            define( 'DADA_ROOT_URI', get_template_directory_uri() );
            define( 'DADA_MODULE_DIR', DADA_ROOT_DIR.'/modules'  );
            define( 'DADA_MODULE_URI', DADA_ROOT_URI.'/modules' );
            define( 'DADA_LANG_DIR', DADA_ROOT_DIR.'/languages' );

            $theme = wp_get_theme();
            define( 'DADA_THEME_NAME', $theme->get('Name'));
            define( 'DADA_THEME_VERSION', $theme->get('Version'));
        }

        function load_helpers() {
            include_once DADA_ROOT_DIR . '/helpers/helper.php';
            include_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH.'/wp-load.php';
            WP_Filesystem();
            global $wp_filesystem;
        }
        
        function set_theme_support() {
            load_theme_textdomain( 'dada', DADA_LANG_DIR );
            add_theme_support( 'automatic-feed-links' );
            add_theme_support( 'title-tag' );
            add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
            add_theme_support( 'post-formats', array('status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat'));
            add_theme_support( 'post-thumbnails' );
            add_theme_support( 'custom-logo' );
            add_theme_support( 'custom-background', array( 'default-color' => '#d1e4dd' ) );
            add_theme_support( 'custom-header' );

			add_theme_support( 'align-wide' ); // Gutenberg wide images.
            add_theme_support( 'editor-color-palette', array(
                array(
                    'name'  => esc_html__( 'Primary Color', 'dada' ),
                    'slug'  => 'primary',
                    'color'	=> $this->theme_defaults['primary_color'],
                ),
                array(
                    'name'  => esc_html__( 'Secondary Color', 'dada' ),
                    'slug'  => 'secondary',
                    'color' => $this->theme_defaults['secondary_color'],
                ),
                array(
                    'name'  => esc_html__( 'Tertiary Color', 'dada' ),
                    'slug'  => 'tertiary',
                    'color' => $this->theme_defaults['tertiary_color'],
                ),
                array(
                    'name'  => esc_html__( 'Quaternary Color', 'dada' ),
                    'slug'  => 'quaternary',
                    'color' => $this->theme_defaults['quaternary_color'],
                ),
                array(
                    'name'  => esc_html__( 'Body Background Color', 'dada' ),
                    'slug'  => 'body-bg',
                    'color' => $this->theme_defaults['body_bg_color'],
                ),
                array(
                    'name'  => esc_html__( 'Body Text Color', 'dada' ),
                    'slug'  => 'body-text',
                    'color' => $this->theme_defaults['body_text_color'],
                ),
                array(
                    'name'  => esc_html__( 'Alternate Color', 'dada' ),
                    'slug'  => 'alternate',
                    'color' => $this->theme_defaults['headalt_color'],
                ),
                array(
                    'name'  => esc_html__( 'Transparent Color', 'dada' ),
                    'slug'  => 'transparent',
                    'color' => 'rgba(0,0,0,0)',
                )
            ) );

            add_theme_support( 'editor-styles' );
            add_editor_style( './assets/css/style-editor.css' );
            $GLOBALS['content_width'] = apply_filters( 'dada_set_content_width', 1230 );
            register_nav_menus( array(
                'main-menu' => esc_html__('Main Menu', 'dada'),
            ) );
        }

        function enqueue_js() {

            wp_enqueue_script('wc-cart-fragments');

            wp_enqueue_script('jquery-select2', get_theme_file_uri('/assets/lib/select2/select2.full.js'), array('jquery'), false, true);

            /**
             * Before Hook
             */
            do_action( 'dada_before_enqueue_js' );

                wp_enqueue_script('dada-jqcustom', get_theme_file_uri('/assets/js/custom.js'), array('jquery'), false, true);

                if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				    wp_enqueue_script( 'comment-reply' );
			    }

            /**
             * After Hook
             */
            do_action( 'dada_after_enqueue_js' );

        }

        function enqueue_css() {
            /**
             * Before Hook
             */
            do_action( 'dada_before_main_css' );

                wp_enqueue_style( 'dada', get_stylesheet_uri(), false, DADA_THEME_VERSION, 'all' );
                wp_enqueue_style( 'dada-icons', get_theme_file_uri('/assets/css/icons.css'), false, DADA_THEME_VERSION, 'all');

                $css = $this->generate_theme_default_css();
                if( !empty( $css ) ) {
                    wp_add_inline_style( 'dada', ':root {'.$css.'}' );
                }
                $lightcss = $this->light_generate_theme_default_css();
                if( !empty( $lightcss ) ) {
                    wp_add_inline_style( 'dada', 'html[data-theme="light"]:root {'.$lightcss.'}' );
                }

                $darkcss = $this->dark_generate_theme_default_css();
                if( !empty( $darkcss ) ) {
                    wp_add_inline_style( 'dada', 'html[data-theme="dark"]:root {'.$darkcss.'}' );
                }    
                wp_enqueue_style( 'dada-base', get_theme_file_uri('/assets/css/base.css'), false, DADA_THEME_VERSION, 'all');
                wp_enqueue_style( 'dada-rtl', get_theme_file_uri('/assets/css/rtl.css'), false, DADA_THEME_VERSION, 'all');
                wp_enqueue_style( 'dada-grid', get_theme_file_uri('/assets/css/grid.css'), false, DADA_THEME_VERSION, 'all');
                wp_enqueue_style( 'dada-layout', get_theme_file_uri('/assets/css/layout.css'), false, DADA_THEME_VERSION, 'all');
                wp_enqueue_style( 'dada-widget', get_theme_file_uri('/assets/css/widget.css'), false, DADA_THEME_VERSION, 'all');
                wp_enqueue_style( 'dada-additional', get_theme_file_uri('/assets/css/additional.css'), false, DADA_THEME_VERSION, 'all');

            /**
             * After Hook
             */
            do_action( 'dada_after_main_css' );

            wp_enqueue_style( 'jquery-select2', get_theme_file_uri('/assets/lib/select2/select2.css'), false, DADA_THEME_VERSION, 'all');

            wp_enqueue_style( 'dada-theme', get_theme_file_uri('/assets/css/theme.css'), false, DADA_THEME_VERSION, 'all');
        }

        function generate_theme_default_css() {

            $css = '';

            if(isset($this->theme_defaults['body_typo']) && !empty($this->theme_defaults['body_typo'])) {

                $body_typo_css_var = apply_filters( 'dada_body_typo_customizer_update',  $this->theme_defaults['body_typo'] );

                $css .=  '--wdtFontTypo_Base: '.$body_typo_css_var['font-fallback'].';';
                $css .=  '--wdtFontWeight_Base: '.$body_typo_css_var['font-weight'].';';
                $css .=  '--wdtFontSize_Base: '.$body_typo_css_var['fs-desktop'].$body_typo_css_var['fs-desktop-unit'].';';
                $css .=  '--wdtLineHeight_Base: '.$body_typo_css_var['lh-desktop'].$body_typo_css_var['lh-desktop-unit'].';';
            }

            if(isset($this->theme_defaults['h1_typo']) && !empty($this->theme_defaults['h1_typo'])) {

                $h1_typo_css_var = apply_filters( 'dada_h1_typo_customizer_update',  $this->theme_defaults['h1_typo'] );

                $css .= '--wdtFontTypo_Alt: '.$h1_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_Alt: '.$h1_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_Alt: '.$h1_typo_css_var['fs-desktop'].$h1_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_Alt: '.$h1_typo_css_var['lh-desktop'].$h1_typo_css_var['lh-desktop-unit'].';';

                $css .= '--wdtFontTypo_H1: '.$h1_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H1: '.$h1_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H1: '.$h1_typo_css_var['fs-desktop'].$h1_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H1: '.$h1_typo_css_var['lh-desktop'].$h1_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h2_typo']) && !empty($this->theme_defaults['h2_typo'])) {

                $h2_typo_css_var = apply_filters( 'dada_h2_typo_customizer_update',  $this->theme_defaults['h2_typo'] );

                $css .= '--wdtFontTypo_H2: '.$h2_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H2: '.$h2_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H2: '.$h2_typo_css_var['fs-desktop'].$h2_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H2: '.$h2_typo_css_var['lh-desktop'].$h2_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h3_typo']) && !empty($this->theme_defaults['h3_typo'])) {

                $h3_typo_css_var = apply_filters( 'dada_h3_typo_customizer_update',  $this->theme_defaults['h3_typo'] );

                $css .= '--wdtFontTypo_H3: '.$h3_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H3: '.$h3_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H3: '.$h3_typo_css_var['fs-desktop'].$h3_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H3: '.$h3_typo_css_var['lh-desktop'].$h3_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h4_typo']) && !empty($this->theme_defaults['h4_typo'])) {

                $h4_typo_css_var = apply_filters( 'dada_h4_typo_customizer_update',  $this->theme_defaults['h4_typo'] );

                $css .= '--wdtFontTypo_H4: '.$h4_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H4: '.$h4_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H4: '.$h4_typo_css_var['fs-desktop'].$h4_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H4: '.$h4_typo_css_var['lh-desktop'].$h4_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h5_typo']) && !empty($this->theme_defaults['h5_typo'])) {

                $h5_typo_css_var = apply_filters( 'dada_h5_typo_customizer_update',  $this->theme_defaults['h5_typo'] );

                $css .= '--wdtFontTypo_H5: '.$h5_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H5: '.$h5_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H5: '.$h5_typo_css_var['fs-desktop'].$h5_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H5: '.$h5_typo_css_var['lh-desktop'].$h5_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h6_typo']) && !empty($this->theme_defaults['h6_typo'])) {

                $h6_typo_css_var = apply_filters( 'dada_h6_typo_customizer_update',  $this->theme_defaults['h6_typo'] );

                $css .= '--wdtFontTypo_H6: '.$h6_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H6: '.$h6_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H6: '.$h6_typo_css_var['fs-desktop'].$h6_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H6: '.$h6_typo_css_var['lh-desktop'].$h6_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['extra_typo']) && !empty($this->theme_defaults['extra_typo'])) {

                $css .= apply_filters( 'dada_typo_font_family_css_var',  '--wdtFontTypo_Ext: '.$this->theme_defaults['extra_typo']['font-fallback'].';' );
                $css .= apply_filters( 'dada_typo_font_weight_css_var',  '--wdtFontWeight_Ext: '.$this->theme_defaults['extra_typo']['font-weight'].';' );
                $css .= apply_filters( 'dada_typo_fs_desktop_css_var',  '--wdtFontSize_Ext: '.$this->theme_defaults['extra_typo']['fs-desktop'].$this->theme_defaults['extra_typo']['fs-desktop-unit'].';' );
                $css .= apply_filters( 'dada_typo_lh_desktop_css_var',  '--wdtLineHeight_Ext: '.$this->theme_defaults['extra_typo']['lh-desktop'].$this->theme_defaults['extra_typo']['lh-desktop-unit'].';' );

            }

            return $css;

        }
        //Light Mode
        function light_generate_theme_default_css()
        {
            $css = '';
            $css .= apply_filters( 'dada_primary_color_css_var',  '--wdtPrimaryColor: '.$this->theme_defaults['primary_color'].';' );
            $css .= apply_filters( 'dada_primary_rgb_color_css_var',  '--wdtPrimaryColorRgb: '.$this->theme_defaults['primary_color_rgb'].';' );
            $css .= apply_filters( 'dada_secondary_color_css_var',  '--wdtSecondaryColor: '.$this->theme_defaults['secondary_color'].';' );
            $css .= apply_filters( 'dada_secondary_rgb_color_css_var',  '--wdtSecondaryColorRgb: '.$this->theme_defaults['secondary_color_rgb'].';' );
            $css .= apply_filters( 'dada_tertiary_color_css_var',  '--wdtTertiaryColor: '.$this->theme_defaults['tertiary_color'].';' );
            $css .= apply_filters( 'dada_tertiary_rgb_color_css_var',  '--wdtTertiaryColorRgb: '.$this->theme_defaults['tertiary_color_rgb'].';' );
            $css .= apply_filters( 'dada_quaternary_color_css_var',  '--wdtQuaternaryColor: '.$this->theme_defaults['quaternary_color'].';' );
            $css .= apply_filters( 'dada_quaternary_rgb_color_css_var',  '--wdtQuaternaryColorRgb: '.$this->theme_defaults['quaternary_color_rgb'].';' );
            $css .= apply_filters( 'dada_body_bg_color_css_var',  '--wdtBodyBGColor: '.$this->theme_defaults['body_bg_color'].';' );
            $css .= apply_filters( 'dada_body_bg_rgb_color_css_var',  '--wdtBodyBGColorRgb: '.$this->theme_defaults['body_bg_color_rgb'].';' );
            
            $css .= apply_filters( 'dada_body_text_color_css_var',  '--wdtBodyTxtColor:'.$this->theme_defaults['body_text_color'].';' );
            $css .= apply_filters( 'dada_body_text_rgb_color_css_var',  '--wdtBodyTxtColorRgb:'.$this->theme_defaults['body_text_color_rgb'].';' );
            $css .= apply_filters( 'dada_headalt_color_css_var',  '--wdtHeadAltColor: '.$this->theme_defaults['headalt_color'].';' );
            $css .= apply_filters( 'dada_headalt_rgb_color_css_var',  '--wdtHeadAltColorRgb: '.$this->theme_defaults['headalt_color_rgb'].';' );
            $css .= apply_filters( 'dada_link_color_css_var',  '--wdtLinkColor: '.$this->theme_defaults['link_color'].';' );
            $css .= apply_filters( 'dada_link_rgb_color_css_var',  '--wdtLinkColorRgb: '.$this->theme_defaults['link_color_rgb'].';' );
            $css .= apply_filters( 'dada_link_hover_color_css_var',  '--wdtLinkHoverColor: '.$this->theme_defaults['link_hover_color'].';' );
            $css .= apply_filters( 'dada_link_hover_rgb_color_css_var',  '--wdtLinkHoverColorRgb: '.$this->theme_defaults['link_hover_color_rgb'].';' );
            $css .= apply_filters( 'dada_border_color_css_var',  '--wdtBorderColor: '.$this->theme_defaults['border_color'].';' );
            $css .= apply_filters( 'dada_border_rgb_color_css_var',  '--wdtBorderColorRgb: '.$this->theme_defaults['border_color_rgb'].';' );
            $css .= apply_filters( 'dada_accent_text_color_css_var',  '--wdtAccentTxtColor: '.$this->theme_defaults['accent_text_color'].';' );
            $css .= apply_filters( 'dada_accent_text_rgb_color_css_var',  '--wdtAccentTxtColorRgb: '.$this->theme_defaults['accent_text_color_rgb'].';' );
            return $css;
        }
         function dark_generate_theme_default_css() {
            $css = '';
            $css .= apply_filters( 'dada_dark_primary_color_css_var',  '--wdtDarkPrimaryColor: '.$this->theme_defaults['dark_primary_color'].';' );
            $css .= apply_filters( 'dada_dark_primary_rgb_color_css_var',  '--wdtDarkPrimaryColorRgb: '.$this->theme_defaults['dark_primary_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_secondary_color_css_var',  '--wdtDarkSecondaryColor: '.$this->theme_defaults['dark_secondary_color'].';' );
            $css .= apply_filters( 'dada_dark_secondary_rgb_color_css_var',  '--wdtDarkSecondaryColorRgb: '.$this->theme_defaults['dark_secondary_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_tertiary_color_css_var',  '--wdtDarkTertiaryColor: '.$this->theme_defaults['dark_tertiary_color'].';' );
            $css .= apply_filters( 'dada_dark_tertiary_rgb_color_css_var',  '--wdtDarkTertiaryColorRgb: '.$this->theme_defaults['dark_tertiary_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_quaternary_color_css_var',  '--wdtDarkQuaternaryColor: '.$this->theme_defaults['dark_quaternary_color'].';' );
            $css .= apply_filters( 'dada_dark_quaternary_rgb_color_css_var',  '--wdtDarkQuaternaryColorRgb: '.$this->theme_defaults['dark_quaternary_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_body_bg_color_css_var',  '--wdtDarkBodyBGColor: '.$this->theme_defaults['dark_body_bg_color'].';' );
            $css .= apply_filters( 'dada_dark_body_bg_rgb_color_css_var',  '--wdtDarkBodyBGColorRgb: '.$this->theme_defaults['dark_body_bg_color_rgb'].';' );
            
            $css .= apply_filters( 'dada_dark_body_text_color_css_var',  '--wdtDarkBodyTxtColor:'.$this->theme_defaults['dark_body_text_color'].';' );
            $css .= apply_filters( 'dada_dark_body_text_rgb_color_css_var',  '--wdtDarkBodyTxtColorRgb:'.$this->theme_defaults['dark_body_text_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_headalt_color_css_var',  '--wdtDarkHeadAltColor: '.$this->theme_defaults['dark_headalt_color'].';' );
            $css .= apply_filters( 'dada_dark_headalt_rgb_color_css_var',  '--wdtDarkHeadAltColorRgb: '.$this->theme_defaults['dark_headalt_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_link_color_css_var',  '--wdtDarkLinkColor: '.$this->theme_defaults['dark_link_color'].';' );
            $css .= apply_filters( 'dada_dark_link_rgb_color_css_var',  '--wdtDarkLinkColorRgb: '.$this->theme_defaults['dark_link_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_link_hover_color_css_var',  '--wdtDarkLinkHoverColor: '.$this->theme_defaults['dark_link_hover_color'].';' );
            $css .= apply_filters( 'dada_dark_link_hover_rgb_color_css_var',  '--wdtDarkLinkHoverColorRgb: '.$this->theme_defaults['dark_link_hover_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_border_color_css_var',  '--wdtDarkBorderColor: '.$this->theme_defaults['dark_border_color'].';' );
            $css .= apply_filters( 'dada_dark_border_rgb_color_css_var',  '--wdtDarkBorderColorRgb: '.$this->theme_defaults['dark_border_color_rgb'].';' );
            $css .= apply_filters( 'dada_dark_accent_text_color_css_var',  '--wdtDarkAccentTxtColor: '.$this->theme_defaults['dark_accent_text_color'].';' );
            $css .= apply_filters( 'dada_dark_accent_text_rgb_color_css_var',  '--wdtDarkAccentTxtColorRgb: '.$this->theme_defaults['dark_accent_text_color_rgb'].';' );
            return $css;
         }
        function add_inline_style() {

            wp_register_style( 'dada-admin', '', array(), DADA_THEME_VERSION, 'all' );
            wp_enqueue_style( 'dada-admin' );

            $css = apply_filters( 'dada_add_inline_style', $css = '' );

            if( !empty( $css ) ) {
                wp_add_inline_style( 'dada-admin', $css );
            }

            /**
             * Responsive CSS
             */

                # Tablet Landscape
                    $tablet_landscape = apply_filters( 'dada_add_tablet_landscape_inline_style', $tablet_landscape = '' );
                    if( !empty( $tablet_landscape ) ) {
                        $tablet_landscape = '@media only screen and (min-width:1025px) and (max-width:1280px) {'."\n".$tablet_landscape."\n".'}';
                        wp_add_inline_style( 'dada-admin', $tablet_landscape );
                    }

                # Tablet Portrait
                    $tablet_portrait = apply_filters( 'dada_add_tablet_portrait_inline_style', $tablet_portrait = '' );
                    if( !empty( $tablet_portrait ) ) {
                        $tablet_portrait = '@media only screen and (min-width:768px) and (max-width:1024px) {'."\n".$tablet_portrait."\n".'}';
                        wp_add_inline_style( 'dada-admin', $tablet_portrait );
                    }

                # Mobile
                    $mobile_res = apply_filters( 'dada_add_mobile_res_inline_style', $mobile_res = '' );
                    if( !empty( $mobile_res ) ) {
                        $mobile_res = '@media (max-width: 767px) {'."\n".$mobile_res."\n".'}';
                        wp_add_inline_style( 'dada-admin', $mobile_res );
                    }

        }

        function add_google_fonts() {
            $subset = apply_filters( 'dada_google_font_supsets', 'latin-ext' );
            $fonts  = apply_filters( 'dada_google_fonts_list', array(
                'Poppins:100,200,300,400,500,600,700,800,900',
                'Outfit:100,200,300,400,500,600,700,800,900',
                'Syne:400,500,600,700,800'
            ) );

			foreach( $fonts as $font ) {
				$url = '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $font );
                $url .= !empty( $subset ) ? '&subset=' . $subset : '';

				$key = md5( $font . $subset );

				// check that the URL is valid. we're going to use transients to make this faster.
				$url_is_valid = get_transient( $key );

				// transient does not exist
				if ( false === $url_is_valid ) {
					$response = wp_remote_get( 'https:' . $url );
					if ( ! is_array( $response ) ) {
						// the url was not properly formatted,
						// cache for 12 hours and continue to the next field
						set_transient( $key, null, 12 * HOUR_IN_SECONDS );
						continue;
					}

					// check the response headers.
					if ( isset( $response['response'] ) && isset( $response['response']['code'] ) ) {
						if ( 200 == $response['response']['code'] ) {
							// URL was ok
							// set transient to true and cache for a week
							set_transient( $key, true, 7 * 24 * HOUR_IN_SECONDS );
							$url_is_valid = true;
						}
					}
				}

				// If the font-link is valid, enqueue it.
				if ( $url_is_valid ) {
					wp_enqueue_style( $key, $url, null, null );
				}
			}

        }

        function include_module_helpers() {

            /**
             * Before Hook
             */
            do_action( 'dada_before_load_module_helpers' );

            foreach( glob( DADA_ROOT_DIR. '/modules/*/helper.php'  ) as $helper ) {
                include_once $helper;
            }

            /**
             * After Hook
             */
            do_action( 'dada_after_load_module_helpers' );
        }

    }
    Dada_Loader::instance();
}