<?php
use DadaElementor\Widgets\DadaElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Post_Tags extends DadaElementorWidgetBase {

    public function get_name() {
        return 'wdt-post-tags';
    }

    public function get_title() {
        return esc_html__('Post - Tags', 'dada-pro');
    }

    protected function register_controls() {

        $this->start_controls_section( 'wdt_section_general', array(
            'label' => esc_html__( 'General', 'dada-pro'),
        ) );

            $this->add_control( 'style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__('Style', 'dada-pro'),
                'default' => '',
                'options' => array(
                    ''  => esc_html__('Default', 'dada-pro'),
                    'meta-elements-space'		 => esc_html__('Space', 'dada-pro'),
                    'meta-elements-boxed'  		 => esc_html__('Boxed', 'dada-pro'),
                    'meta-elements-boxed-curvy'  => esc_html__('Curvy', 'dada-pro'),
                    'meta-elements-boxed-round'  => esc_html__('Round', 'dada-pro'),
					'meta-elements-filled'  	 => esc_html__('Filled', 'dada-pro'),
					'meta-elements-filled-curvy' => esc_html__('Filled Curvy', 'dada-pro'),
					'meta-elements-filled-round' => esc_html__('Filled Round', 'dada-pro'),
                ),
            ) );

            $this->add_control( 'el_class', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__('Extra class name', 'dada-pro'),
                'description' => esc_html__('Style particular element differently - add a class name and refer to it in custom CSS', 'dada-pro')
            ) );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        extract($settings);

		$out = '';

        global $post;
        $post_id =  $post->ID;

        $Post_Style = dada_get_single_post_style( $post_id );

        $template_args['post_ID'] = $post_id;
        $template_args['post_Style'] = $Post_Style;

		$out .= '<div class="entry-tags-wrapper '.$style.' '.$el_class.'">';
            $out .= dada_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/tag', '', $template_args );
		$out .= '</div>';

		echo $out;
	}

}