<?php

/**
 * Admin Pages
 *
 * Functions used for displaying pages in admin.
 *
 * @author      Oganro
 * @version     1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


if (!class_exists('OG_Admin_Pages', false)) :

    class OG_Admin_Page
    {
        private $message = '';

        /**
         * OG_Admin_Page constructor.
         */
        public function __construct()
        {
            if(isset($_POST['form-data'])) {
                unset($_POST['form-data']);
                $this->setOptions($_POST);
                $this->message = "Records have been updated successfully";
            }

            $this->loadView();
        }

        private function loadView()
        {
            $this->loadStyles();
            $this->loadScripts();

            $widget_data = $this->getOptions();

            if(is_array($widget_data)) {
                $data = $widget_data;

            } else {
                $admin_form_data = include_once OG_ABSPATH . 'includes/og-travel-data.php';
                $data = $admin_form_data;
            }

            $message = $this->message;

            include_once OG_ABSPATH . 'templates/og-admin-html-form.php';
        }

        private function loadStyles()
        {
            wp_enqueue_style('og-travel-bootstrap.css', plugins_url('css/bootstrap.css',OG_FILEPATH));
            wp_enqueue_style('og-travel.css', plugins_url('css/og-travel.css',OG_FILEPATH));
        }

        private function loadScripts()
        {
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_script('jquery-ui-autocomplete');
            wp_enqueue_script('og-travel-bootstrap', plugins_url('js/bootstrap.js',OG_FILEPATH));
            wp_enqueue_script('og-travel-colorpicker', plugins_url('js/jqColorPicker/jqColorPicker.min.js',OG_FILEPATH));
            wp_enqueue_script('og-travel', plugins_url('js/og-travel.js',OG_FILEPATH));

        }

        /**
         * Save OG Travel Widget Data
         */
        private function setOptions($data) {
            if(is_array($data)) {
                $data = serialize($data);
            } else {
                $data = false;
            }

            update_option('og_travel_options',$data);
        }


        /**
         * Get OG Travel Widget Data
         */
        private function getOptions() {
            if(is_serialized(get_option( 'og_travel_options',''))) {
                return unserialize(get_option( 'og_travel_options',''));
            } else {
                return false;
            }

        }

    }


endif;