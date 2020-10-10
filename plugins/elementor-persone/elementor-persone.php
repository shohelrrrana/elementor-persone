<?php
/**
 * Plugin Name: Elementor Persone
 * Description: Elementor plugin.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Shohel Rana
 * Author URI:  https://elementor.com/
 * Text Domain: elementor-persone
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Elementor_Persone {

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const MINIMUM_PHP_VERSION = '7.0';


    private static $_instance = null;

    public static function instance () {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct () {
        // Init Plugin
        add_action( 'plugins_loaded', array( $this, 'init' ) );
    }

    public function init () {
        load_plugin_textdomain( 'elementor-persone' );

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        // Add Plugin actions
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'test_category' ] );
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'elementor_start_styles' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'elementor_start_scripts' ] );
    }

    public function init_widgets () {
        // Include Widget files
        require_once( __DIR__ . '/widgets/perticle-banner.php' );
        require_once( __DIR__ . '/widgets/portfolio.php' );
        require_once( __DIR__ . '/widgets/contact-section.php' );

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Perticle_Banner() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Portfolio() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Contact_Section() );
    }

    function elementor_start_styles () {
        wp_enqueue_style( 'fonts.googleapis', '//fonts.googleapis.com/css?family=Raleway:300,400,500,700', null, time() );
        wp_enqueue_style( 'animate-css', plugins_url( '/assets/css/animate.css', __FILE__ ), null, time() );
        wp_enqueue_style( 'ie10-viewport-bug-workaround-css', plugins_url( '/assets/css/ie10-viewport-bug-workaround.css', __FILE__ ), null, time() );
        wp_enqueue_style( 'style-css', plugins_url( '/assets/css/style.css', __FILE__ ), null, time() );
        wp_enqueue_style( 'color-css', plugins_url( '/assets/css/color.css', __FILE__ ), null, time() );
    }

    function elementor_start_scripts () {
        wp_enqueue_script( 'wow-js', plugins_url( '/assets/js/wow.min.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'TweenLite-js', plugins_url( '/assets/js/TweenLite.min.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'EasePack-js', plugins_url( '/assets/js/EasePack.min.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'rAF-js', plugins_url( '/assets/js/rAF.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'header-js', plugins_url( '/assets/js/header.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'main-js', plugins_url( '/assets/js/main.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'scripts-js', plugins_url( '/assets/js/scripts.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'smoothscroll-js', plugins_url( '/assets/js/smoothscroll.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'SmoothScrollm-js', plugins_url( '/assets/js/SmoothScrollm.js', __FILE__ ), null, time(), true );

    }

    public function test_category ( $manager ) {
        $manager->add_category( 'custom', [
            'title' => __( 'Test Category', 'elementor-persone' ),
            'icon'  => 'fa fa-edit',
        ] );
    }


    //Here Some Notice
    public function admin_notice_missing_main_plugin () {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-persone' ),
            '<strong>' . esc_html__( 'Elementor Persone', 'elementor-persone' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'elementor-persone' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_elementor_version () {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-persone' ),
            '<strong>' . esc_html__( 'Elementor Persone', 'elementor-persone' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'elementor-persone' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_php_version () {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-persone' ),
            '<strong>' . esc_html__( 'Elementor Persone', 'elementor-persone' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'elementor-persone' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

}

// Instantiate Elementor_Start.
Elementor_Persone::instance();
