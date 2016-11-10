<?php
namespace NP;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class NpControllerClass {
	public function __construct() {
		// Запуск плагина: добавьте хуки на нужные функции


		// indicates we are running the admin
		if ( is_admin() ) {

			// called just before the woocommerce template functions are included
			add_action( 'init', array( $this, 'include_template_functions' ), 20 );

			// called only after woocommerce has finished loading
			add_action( 'woocommerce_init', array( $this, 'woocommerce_loaded' ) );

			// called after all plugins have loaded
			add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );


		}
		// add the action 
		add_action( 'woocommerce_order_items_table',
			array( $this, 'action_woocommerce_order_items_table' ) );
	}

	// define the woocommerce_order_items_table callback 
	function action_woocommerce_order_items_table( $order ) {
		// make action magic happen here... 
		$data = get_post_meta( $order->id, '_metatest_data', true );
		echo '<tr>
				<th scope="row"><span class="np_forudpdate">Накладная (Новая почта):</span></th>
					<td>' . $data . '</td>
				</tr>';
	}


	protected static $instance;

	public static function init() {
		is_null( self::$instance ) AND self::$instance = new self;

		return self::$instance;
	}

	public static function activate_plugin() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "activate-plugin_{$plugin}" );


	}

	public static function deactivate_plugin() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "deactivate-plugin_{$plugin}" );


	}

	/**
	 *
	 */
	public static function on_uninstall() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		check_admin_referer( 'bulk-plugins' );

		// Важно: проверим тот ли это файл, который
		// был зарегистрирован во время удаления плагина.
		if ( __FILE__ != WP_UNINSTALL_PLUGIN ) {
			return;
		}

	}

	/**
	 * Override any of the template functions from woocommerce/woocommerce-template.php
	 * with our own template functions file
	 */
	public function include_template_functions() {

	}

	/**
	 * Take care of anything that needs woocommerce to be loaded.
	 * For instance, if you need access to the $woocommerce global
	 */
	public function woocommerce_loaded() {
		// подключаем нужные css стили
		
	}

	/**
	 * Take care of anything that needs all plugins to be loaded
	 */
	public function plugins_loaded() {
		/**
		 * create metabox for make NPEN
		 */
		add_action( 'add_meta_boxes', array( $this, 'wc_order_NP_meta_box_add' ) );
	}

	public function wc_order_NP_meta_box_add() {
		global $Wc_np_metabox;
		$Wc_np_metabox->NPEN_meta_box_add();
	}

}

new NpControllerClass();


