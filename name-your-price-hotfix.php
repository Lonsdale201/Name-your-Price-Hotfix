<?php
/**
 * Plugin Name: WooCommerce Name Your Price Hotfix
 * Plugin URI: https://github.com/Lonsdale201/Name-your-Price-Hotfix
 * Description: A hotfix plugin to prevent the Name Your Price plugin from adding a thousands separator. Kaboom baby :)
 * Author: Soczó Kristóf
 * Version: 1.0
 */

function nyp_hotfix_enqueue_scripts() {
    if (is_product() && function_exists('WC_Name_Your_Price')) {
        wp_enqueue_script('nyp-hotfix', plugins_url('js/nmprice-hotfix.js', __FILE__), array('jquery'), '1.0', true);
    }
}

function nyp_hotfix_activation_check() {
    if (!function_exists('WC_Name_Your_Price')) {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', 'nyp_hotfix_admin_notice');
    }
}

function nyp_hotfix_admin_notice() {
    $class = 'notice notice-warning is-dismissible';
    $message = __('A Name Your Price Hotfix bővítmény megfelelő működéséhez először telepítsük és aktiváljuk a Name Your Price bővítményt.', 'nyp-hotfix');

    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
}

add_action('wp_enqueue_scripts', 'nyp_hotfix_enqueue_scripts');
add_action('admin_init', 'nyp_hotfix_activation_check');
