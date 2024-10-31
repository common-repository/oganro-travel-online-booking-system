<?php

/**
 * Plugin Name: Oganro Travel Online Booking System
 * Plugin URI: https://www.oganro.com/
 * Description: Customizable Travel Website Search Box
 * Version: 1.0
 * Author: Oganro (Pvt) Ltd
 * Author URI: https://www.oganro.com
 * Text Domain: oganro-travel-online-booking-system
 * Domain Path: /i18n/languages/
 * Requires at least: 4.4
 * Tested up to: 4.8
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('OgTravelWidget')):

    define('OG_ABSPATH', dirname(__FILE__) . '/');
define('OG_FILEPATH', __FILE__);

final class OgTravelWidget
{

        /**
         * OgTravelWidget constructor.
         */
        public function __construct()
        {
            $this->includer();

            $this->load_plugin_textdomain();

            // Initialize Search Box Widget (short_code, method)
            add_shortcode('og_travel_widget', array($this, 'get_og_travel_widget'));
        }

        public function load_plugin_textdomain() {
            $locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
            $locale = apply_filters( 'plugin_locale', $locale, 'oganro-travel-online-booking-system' );

            unload_textdomain( 'oganro-travel-online-booking-system' );
            load_textdomain( 'oganro-travel-online-booking-system', WP_LANG_DIR . '/oganro-travel-online-booking-system/oganro-travel-online-booking-system-' . $locale . '.mo' );
            load_plugin_textdomain( 'oganro-travel-online-booking-system', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
        }


        /**
         * Include classes
         */
        public function includer()
        {
            /**
             * Core classes.
             */
            include_once(OG_ABSPATH . '/classes/admin/og-admin-menus.php');
            include_once(OG_ABSPATH . '/classes/admin/og-admin-page.php');
        }

        /*----------------------------------------------
         Initiating Methods to generate Search box
         ------------------------------------------------*/
         public function get_og_travel_widget()
         {
            /* STYLE SHEETS */
            wp_enqueue_style('og-travel-bootstrap', plugins_url('/css/bootstrap.css', __FILE__));
            wp_enqueue_style('og-travel', plugins_url('/css/og-travel-widget.css', __FILE__));
            wp_enqueue_style('og-travel-bootstrap-dpicker', plugins_url('/css/bootstrap-datepicker/bootstrap-datepicker.min.css', __FILE__));
            wp_enqueue_style('og-travel-font-awesome', plugins_url('/css/font-awesome/css/font-awesome.min.css', __FILE__));
            /* SCRIPTS */
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui');
            wp_enqueue_script('jquery-ui-autocomplete');
            wp_enqueue_script('og-travel-jquery.validate', plugins_url('js/jq-validation/jquery.validate.min.js', __FILE__));
            wp_enqueue_script('og-travel-bootstrap', plugins_url('/js/bootstrap.js', __FILE__));
            wp_enqueue_script('og-travel-bootstrap-date-picker', plugins_url('js/bootstrap-datepicker.min.js', __FILE__));
            wp_enqueue_script('og-travel-widget', plugins_url('/js/og-travel-widget.js', __FILE__));


            if (is_serialized(get_option('og_travel_options', ''))) {
                $data = unserialize(get_option('og_travel_options', ''));
            } else {
                $admin_form_data = include_once OG_ABSPATH . 'includes/og-travel-data.php';
                $data = $admin_form_data;
            }

            $loader_gif = plugins_url('img/loading_animated.gif', __FILE__);

            include_once(OG_ABSPATH . '/includes/og-travel-data.php');
            include_once(OG_ABSPATH . 'templates/og_travel_widget.php');
        }


    }

    endif;

/**
 * Main instance of OgTravelWidget.
 *
 * Returns the main instance of OgTravelWidget to prevent the need to use globals.
 *
 * @since  1.0
 * @return OgTravelWidget
 */
function OgTravelWidget()
{
    return new OgTravelWidget;
}

// Global for backwards compatibility.
$GLOBALS['ogtravel'] = OgTravelWidget();