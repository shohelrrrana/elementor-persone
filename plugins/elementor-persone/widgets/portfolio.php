<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Portfolio extends Widget_Base {

    public function get_name () {
        return 'portfolio';
    }

    public function get_title () {
        return __( 'Portfolio', 'elementor-persone' );
    }

    public function get_icon () {
        return 'fa fa-briefcase';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control( 'image', [
            'label' => __( 'Image', 'elementor-persone' ),
            'type'  => \Elementor\Controls_Manager::MEDIA,
        ] );

        $repeater->add_control( 'title', [
            'label' => __( 'Title', 'elementor-persone' ),
            'type'  => \Elementor\Controls_Manager::WYSIWYG,
        ] );

        $repeater->add_control( 'description', [
            'label' => __( 'Description', 'elementor-persone' ),
            'type'  => \Elementor\Controls_Manager::WYSIWYG,
        ] );

        $repeater->add_control( 'link', [
            'label'   => __( 'Link', 'elementor-persone' ),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
        ] );

        $this->add_control( 'portfolio_columns', [
                'label'       => __( 'Portfolio Columns', 'elementor-persone' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{title}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render () {
        $settings = $this->get_settings_for_display();
        $portfolio_columns = $settings['portfolio_columns'];
        if ( ! empty( $portfolio_columns ) ):
            ?>
            <div id="portfolio">
                <div class="container text-center">
                    <div class="row wow fadeInUp" data-wow-delay=".5s"
                         style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">

                        <?php foreach ( $portfolio_columns as $portfolio ) : ?>
                            <div class="col-md-4 col-sm-6" style="margin-bottom: 28px;">
                                <figure class="effect">
                                    <img class="img-responsive"
                                         src="<?php echo esc_url( $portfolio['image']['url'] ); ?>"
                                         alt="img18">
                                    <figcaption>
                                        <h2>
                                            <?php echo wp_kses_post( strip_tags( $portfolio['title'], [ 'br', 'strong', 'span', 'em' ] ) ); ?>
                                        </h2>
                                        <p>
                                            <?php echo wp_kses_post( $portfolio['description'] ); ?>
                                        </p>
                                        <a href="<?php echo esc_url( $portfolio['link'] ); ?>">View more</a>
                                    </figcaption>
                                </figure>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        <?php
        endif;
    }

    public function _content_template () {

        ?>
        <div id="portfolio">
            <div class="container text-center">
                <div class="row wow fadeInUp" data-wow-delay=".5s"
                     style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                    <#
                    let portfolio_columns = settings.portfolio_columns;
                    console.log(portfolio_columns);
                    portfolio_columns.map(function (portfolio) {
                    let title = portfolio.title.replace( /(<([^>]+)>)/ig, '');
                    #>
                    <div class="col-md-4 col-sm-6 elementor-repeater-item-{{ portfolio._id }}"
                         style="margin-bottom: 28px;">
                        <figure class="effect">
                            <img class="img-responsive"
                                 src="{{{portfolio.image.url}}}"
                                 alt="img18">
                            <figcaption>
                                <h2>
                                    {{{title}}}
                                </h2>
                                <p>
                                    {{{portfolio.description}}}
                                </p>
                                <a href="{{{portfolio.link}}}">View more</a>
                            </figcaption>
                        </figure>
                    </div>
                    <# }) #>
                </div>
            </div>
        </div>
        <?php
    }

}
