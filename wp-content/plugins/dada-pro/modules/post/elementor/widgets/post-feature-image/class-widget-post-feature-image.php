<?php
use DadaElementor\Widgets\DadaElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Post_Feature_Image extends DadaElementorWidgetBase {

    public function get_name() {
        return 'wdt-post-feature-image';
    }

    public function get_title() {
        return esc_html__('Post - Feature Image', 'dada-pro');
    }

    protected function register_controls() {

        $this->start_controls_section( 'wdt_section_general', array(
            'label' => esc_html__( 'General', 'dada-pro'),
        ) );

            $this->add_control( 'enable_lightbox', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__('Enable Lightbox?', 'dada-pro'),
                'label_on'     => esc_html__( 'Yes', 'dada-pro' ),
                'label_off'    => esc_html__( 'No', 'dada-pro' ),
                'return_value' => 'yes',
                'default'      => '',
				'description' => esc_html__('YES! to enable lightbox preview feature.', 'dada-pro')
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
        $template_args['enable_image_lightbox'] = $enable_lightbox;

		$out .= '<div class="'.$el_class.'">';
            $out .= dada_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/image', '', $template_args );
		$out .= '</div>';

		echo $out;
	}

}