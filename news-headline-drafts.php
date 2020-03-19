<?php
/**
 * The plugin bootstrap file
 *
 * @link              http://www.adamkristopher.co/
 * @since             1.0.0
 * @package           Wizeline\NewsHeadlines\
 *
 * @wordpress-plugin
 * Plugin Name:       News Headlines
 * Plugin URI:        
 * Description:       
 * Version:           1.0.0
 * Author:            Adam Carter
 * Author URI:        https://www.adamkristopher.co/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       news-headlines
 * Domain Path:       /languages
 */
namespace Wizeline\NewsHeadlines;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217?' );
}

$plugin_url = plugin_dir_url( __FILE__ );
define( 'NEWSHEALINES_URL', $plugin_url );
define( 'NEWSHEALINES_DIR', plugin_dir_path( __DIR__ ) );
define( 'NEWSHEALINES_VER', '1.0.0' );

$plugin = new Init_Plugin;

/**
 * Class Init_Plugin
 */
class Init_Plugin {

	/**
	 * Construct function
	 *
	 * @return void
	 */
	public function __construct() {
		// Load public scripts and styles
		//add_action( 'wp_enqueue_scripts', array( $this, 'public_scripts' ) );

		register_activation_hook( __FILE__, array( $this, 'activate_plugin' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate_plugin' ) );
		register_uninstall_hook( __FILE__, array( $this, 'uninstall_plugin' ) );

		self::init_autoloader();
	}

	/**
	 * Enqueue public scripts and styles
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function public_scripts() {
		//wp_enqueue_style();
		//wp_enqueue_script();
	}

	/**
	 * Enqueue admin scripts and styles
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function admin_scripts() {

	}

	/**
	 * Plugin activation handler
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function activate_plugin() {
		self::init_autoloader();
		flush_rewrite_rules();
	}

	/**
	 * The plugin is deactivating.  Delete out the rewrite rules option.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function deactivate_plugin() {
		delete_option( 'rewrite_rules' );
	}

	/**
	 * Uninstall plugin handler
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function uninstall_plugin() {
		delete_option( 'rewrite_rules' );
	}

	/**
	 * Kick off the plugin by initializing the plugin files.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function init_autoloader() {
		// Admin files
		require_once 'admin/class-retrieve-headlines.php';
		//Public files
		// Testing
	}
}
