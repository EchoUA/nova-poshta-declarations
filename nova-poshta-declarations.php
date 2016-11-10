<?php
/**
 * Plugin Name:       Nova poshta declarations
 * Plugin URI:        http://www.justcode.in.ua
 * Description:       Новая почта электронные декларации. Вывод электронных накладных в заказе (woocommerce). Нова пошта електроні декларації.
 * Version:           0.1
 * Author:            justcodeUA
 * Author URI:        http://www.justcode.in.ua
 * License:           MIT
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	define( 'WC_NP_DIR', plugin_dir_path( __FILE__ ) );
	define( 'WC_NP_URL', plugin_dir_url( __FILE__ ) );
	require_once( 'NpControllerClass.php' );
	include_once WC_NP_DIR . "wc_np_metbox.php";

	register_activation_hook( __FILE__, 'activate_woo_np_declaration' );
	register_deactivation_hook( __FILE__, 'deactivate_woo_np_declaration' );
	global $Wc_np_metabox;
	$Wc_np_metabox = new \NP\Wc_np_metabox();

}

function activate_woo_np_declaration() {
	\NP\NpControllerClass::activate_plugin();
}

function deactivate_woo_np_declaration() {
	\NP\NpControllerClass::deactivate_plugin();
}

?>