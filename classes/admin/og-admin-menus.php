<?php

/**
 * Admin Menu
 *
 * Functions used for displaying menu in admin.
 *
 * @author      Oganro
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if (!class_exists('OG_Admin_Menus', false)) :

    /**
     * Class OG_Admin_Menus
     */
    class OG_Admin_Menus
    {

        /**
         * Hook in tabs.
         */


        /**
         * OG_Admin_Menus constructor.
         */
        public function __construct()
        {
            // Add menus
            add_action('admin_menu', array($this, 'admin_menu'), 10);
        }

        /**
         * Add menu items.
         */
        public function admin_menu()
        {
            global $menu;

            add_menu_page(
                __('travel Widget', 'menu-ogn-rw'),
                __('Oganro Travel', 'menu-ogn-rw'),
                'manage_options',
                'og_travel_admin_page',
                array($this,'og_travel_admin_page'));
        }

        public function og_travel_admin_page() {
            return new OG_Admin_Page();
        }
    }

    return new OG_Admin_Menus();
endif;



