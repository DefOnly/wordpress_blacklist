<?php
use DadaElementor\Widgets\DadaElementorWidgetBase;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_Hamburger_Header_Menu extends DadaElementorWidgetBase {

    public function get_name() {
        return 'wdt-hamburger-header-menu';
    }

    public function get_title() {
        return esc_html__('Hamburger Header Menu', 'dada-plus');
    }

    public function get_icon() {
		return 'eicon-header wdt-icon';
	}

    public function get_style_depends() {
		return array( 'wdt-hamburger-menu');
	}

    public function get_script_depends() {
		return array( 'wdt-hamburger-menu');
	}

    protected function register_controls() {

		$nav_menus = array( 0 => esc_html__('Select Menu', 'dada-plus')  );
		$menus     = wp_get_nav_menus();

		foreach ($menus as $menu ) {
			$nav_menus[$menu->term_id] = $menu->name;
		}

        $this->start_controls_section( 'wdt_section_general', array(
            'label' => esc_html__( 'General', 'dada-plus'),
        ) );
            $this->add_control( 'nav_type', array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__('Navigation Type', 'dada-plus'),
				'default' => 'primary-nav',
				'options' => array(
                    'primary-nav' => esc_html__('Primary Nav','dada-plus'),
                    'secondary-nav' => esc_html__('Secondary Nav','dada-plus')
                )
            ) );

            $this->add_control( 'nav_id', array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__('Choose Menu', 'dada-plus'),
				'default' => '0',
				'options' => $nav_menus
            ) );

            $this->add_responsive_control( 'align', array(
                'label'        => esc_html__( 'Alignment', 'dada-plus' ),
                'type'         => Controls_Manager::CHOOSE,
                'prefix_class' => 'elementor%s-align-',
                'options'      => array(
                    'left'   => array( 'title' => esc_html__('Left','dada-plus'), 'icon' => 'eicon-h-align-left' ),
                    'center' => array( 'title' => esc_html__('Center','dada-plus'), 'icon' => 'eicon-h-align-center' ),
                    'right'  => array( 'title' => esc_html__('Right','dada-plus'), 'icon' => 'eicon-h-align-right' ),
                )
            ) );
        $this->end_controls_section();

        $this->start_controls_section( 'wdt_section_typography', array(
        	'label'      => esc_html__( 'Menu', 'dada-plus' ),
			'tab'        => Controls_Manager::TAB_STYLE,
			'show_label' => false,
		) );

			$this->add_group_control( Group_Control_Typography::get_type(), array(
                'label'      => esc_html__( 'Menu Typography', 'dada-plus' ),
				'name'     => 'menu_typography',
				'selector' => '{{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li > a',
				'separator' => 'before',
			) );

			$this->add_group_control( Group_Control_Typography::get_type(), array(
                'label'      => esc_html__( 'Sub Menu Typography', 'dada-plus' ),
				'name'     => 'sub_menu_typography',
				'selector' => '{{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav li ul.sub-menu li > a',
				'separator' => 'before',
			) );

        $this->end_controls_section();

        $this->start_controls_section( 'wdt_section_color', array(
        	'label'      => esc_html__( 'Colors', 'dada-plus' ),
			'tab'        => Controls_Manager::TAB_STYLE,
			'show_label' => false,
		) );

			$this->add_control( 'menu_color', array(
				'label'     => esc_html__( 'Menu Color', 'dada-plus' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => array( '{{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li > a' => 'color: {{VALUE}}' )
			) );

			$this->add_control( 'menu_hover_color', array(
				'label'     => esc_html__( 'Menu Hover Color', 'dada-plus' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => array( '
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.focus > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li:focus > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li:hover > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li > a.focus,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li > a:focus,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li > a:hover,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.current-menu-item > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.current-page-item > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.current-menu-ancestor > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.current-page-ancestor > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.current_menu_item > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.current_page_item > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.current_menu_ancestor > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li.current_page_ancestor > a' => 'color: {{VALUE}}' )
			) );

			$this->add_control( 'sub_menu_color', array(
				'label'     => esc_html__( 'Sub Menu Color', 'dada-plus' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => array( '{{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav li ul.sub-menu li > a' => 'color: {{VALUE}}' )
			) );

			$this->add_control( 'sub_menu_hover_color', array(
				'label'     => esc_html__( 'Sub Menu Hover Color', 'dada-plus' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => array( '
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.focus > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li:focus > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li:hover > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li > a.focus,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li > a:focus,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li > a:hover,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.current-menu-item > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.current-page-item > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.current-menu-ancestor > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.current-page-ancestor > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.current_menu_item > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.current_page_item > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.current_menu_ancestor > a,
                {{WRAPPER}} .wdt-header-menu .menu-container .wdt-primary-nav > li ul.sub-menu > li.current_page_ancestor > a' => 'color: {{VALUE}}' )
			) );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        extract($settings);
        $settings['module_id'] = $this->get_id();

        $nav_class = '';
        if($nav_type == 'secondary-nav') {
            $nav_class = 'wdt-secondary-nav';
        }

        $navigation = wp_nav_menu( array(
        	'menu'            => $nav_id,
			'container_class' => 'hamburger-menu-container',
			'items_wrap'      => '<ul id="%1$s" data-menu="'.esc_attr($nav_id).'">  %3$s </ul>',
			'menu_class'      => 'wdt-primary-nav '.$nav_class,
			'link_before'     => '<span data-text="%1$s">',
			'link_after'      => '</span>',
            'walker'          => new Dada_Walker_Nav_Menu,
            'echo'            => false
        ) );

        $out = '<div class="wdt-hamburger-header-menu"  id="menuToggle-'.$settings['module_id'].'" data-menu="'.esc_attr( $nav_id ).'" data-id="'.esc_attr( $settings['module_id'] ).'">';
            $out.='<input type="checkbox" />
                    <div class="wdt-trigger-item">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                            <path class="line line1" d="M20,29h60c0,0,14.5-0.2,14.5,37.7c0,11.3-3.6,15-9.3,15C79.6,81.7,75,75,75,75L25,25"></path>
                            <path class="line line2" d="M20,50h60"></path>
                            <path class="line line3" d="M20,71h60c0,0,14.5,0.2,14.5-37.7c0-11.3-3.6-15-9.3-15C79.6,18.3,75,25,75,25L25,75"></path>
                            </svg>
                        </i>
                    </div>';
            $out .= $navigation;


        $out .= '</div>';

        echo dada_html_output($out);
    }

}