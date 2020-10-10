<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Contact_Section extends Widget_Base {

    public function get_name () {
        return 'contact_section';
    }

    public function get_title () {
        return __( 'Contact Section', 'elementor-persone' );
    }

    public function get_icon () {
        return 'fa fa-envelope';
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

        $this->add_control( 'heading', [
                'label' => __( 'Heading', 'elementor-persone' ),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control( 'description', [
                'label' => __( 'Description', 'elementor-persone' ),
                'type'  => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control( 'phone', [
                'label' => __( 'Phone', 'elementor-persone' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control( 'email', [
                'label' => __( 'Email', 'elementor-persone' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control( 'address', [
                'label' => __( 'Address', 'elementor-persone' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();
    }

    protected function render () {
        $settings = $this->get_settings_for_display();
        ?>
        <div id="contact"
             style="background:url('control/img/keyboard_contactus.jpg') no-repeat center center fixed; background-size:cover;">
            <div class="overlay">
                <div class="container text-center">
                    <h2>
                        <?php echo esc_html( $settings['heading'] ); ?>
                    </h2>
                    <p class="sub-title">
                        <?php echo wp_kses_post( $settings['description'] ); ?>
                    </p>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="contact-form">
                                    <form method="post">
                                        <div class="col-md-6">
                                            <input id="fullname" type="text" name="username" placeholder="Username">
                                        </div>
                                        <div class="col-md-6">
                                            <input id="email" type="email" name="email" placeholder="Email">
                                        </div>
                                        <div class="col-md-12">
                                            <textarea id="message" placeholder="Your Message"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="btn" style="padding-top: 8px;">
                                                <span>Send</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-12">
                                    <div id="response_brought"></div>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 tab">
                            <div class="info col-md-12">
                                <p>
                                    <i class="fa fa-phone"></i>
                                    <strong>Phone:</strong>
                                    <?php echo esc_html( $settings['phone'] ); ?>
                                </p>
                            </div>
                            <div class="info col-md-12">
                                <p>
                                    <i class="fa fa-envelope"></i>
                                    <strong>Email:</strong>
                                    <?php echo esc_html( $settings['email'] ); ?>
                                </p>
                            </div>
                            <div class="info col-md-12">
                                <p>
                                    <i class="fa fa-location-arrow"></i>
                                    <span>
                                        <strong>Address:</strong>
                                        <?php echo esc_html( $settings['address'] ); ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
