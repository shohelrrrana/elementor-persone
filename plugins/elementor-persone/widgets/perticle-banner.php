<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Perticle_Banner extends Widget_Base {

    public function get_name () {
        return 'perticle_banner';
    }

    public function get_title () {
        return __( 'Perticle Banner', 'elementor-persone' );
    }

    public function get_icon () {
        return 'fa fa-image';
    }

    public function get_categories () {
        return [ 'basic', 'custom' ];
    }

    protected function _register_controls () {
        $this->register_content_controls();

    }

    protected function register_content_controls () {
        $this->start_controls_section( 'section_content', [
                'label' => __( 'Content', 'elementor-persone' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control( 'sub_heading', [
                'label' => __( 'Sub Heading', 'elementor-persone' ),
                'type'  => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );
        $this->add_control( 'heading', [
                'label' => __( 'Heading', 'elementor-persone' ),
                'type'  => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );
        $this->add_control( 'button_title', [
                'label'   => __( 'Button Title', 'elementor-persone' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'See my work', 'elementor-persone' ),
            ]
        );
        $this->add_control( 'button_link', [
                'label'   => __( 'Button Link', 'elementor-persone' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '#',
            ]
        );
        $this->end_controls_section();
    }

    protected function render () {
        $settings = $this->get_settings_for_display();
        ?>
        <div id="home" class="demo-1">
            <div id="large-header" class="large-header"
                 style="background-image: url(https://persone.herokuapp.com/control/img/bg.jpg); height: 569px; display: block;">
                <!-- Edit Header Background Image ex url('control/img/image-name.jpg') -->
                <canvas id="demo-canvas" width="1848" height="569"></canvas>
                <div class="table">
                    <div class="table-cell">
                        <div class="container">
                            <div class="wow fadeIn" data-wow-delay="0.4s"
                               style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                                <?php echo wp_kses_post($settings['sub_heading']); ?>
                            </div>
                            <h1 class="wow fadeIn" data-wow-delay="1s"
                                style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;">
                                <?php echo wp_kses_post($settings['heading']); ?>
                            </h1>
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="smoothScroll wow fadeIn" data-wow-delay="1.2s"
                               style="visibility: visible; animation-delay: 1.2s; animation-name: fadeIn;">
                                <?php echo esc_html($settings['button_title']); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
