<?php
/*
Plugin Name: Instapromo
Plugin URI:  http://uritochangelater.com
Description: Plugin to order for instagram promotion packages
Version:     1.0.0
Author:      Poetic_Code
Author URI:  http://fiverr.com/poetic_code
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    include "WCIntegration.php";
    include "Api.php";
    include "Forms.php";
    include "Order.php";
    include "ApiService.php";
    $instap_forms = new Forms("/instagram_view.php");
    $insta_followers = new Order();

    function instapromo_options_page()
    {
        add_menu_page(
            'Instapromo',
            'Instapromo',
            'manage_options',
            'insta_p',
            'instapromo_options_page_html',
            plugin_dir_url(__FILE__) . 'images/instagram-logo.png',
            20
        );
    }
    add_action('admin_menu', 'instapromo_options_page');

    function instapromo_settings_page()
    {
        add_submenu_page(
            'edit.php?post_type=page',
            'insta-settings',
            'insta-settings',
            'manage_options',
            'insta_settings',
            'instapromo_settings_page_html'
        );
    }
    add_action('admin_menu', 'instapromo_settings_page');

    function instapromo_options_page_html()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()); ?></h1>
        </div>
        <?php
    }

    function instapromo_settings_page_html(){
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1>Welcome to instapromo settings</h1>
        </div>
        <?php
    }

}


