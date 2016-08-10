<?php
/**
 * Genesis Header Nav
 *
 * @package   Genesis_Header_Nav
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @copyright 2013 Gary Jones, Gamajo Tech
 *
 * @wordpress-plugin
 * Plugin Name:       Genesis Header Nav
 * Plugin URI:        https://github.com/GaryJones/genesis-header-nav
 * Description:       Registers a menu location and displays it inside the header for a Genesis Framework child theme.
 * Version:           2.1.0
 * Author:            Gary Jones
 * Author URI:        https://gamajo.com
 * Text Domain:       genesis-header-nav
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/GaryJones/genesis-header-nav
 * GitHub Branch:     master
 * Requires WP:       3.9
 * Requires PHP:      5.3
 */

namespace Gamajo\GenesisHeaderNav;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Main class file.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-genesis-header-nav.php';

/**
 * Get plugin object.
 *
 * Instantiates it if necessary.
 *
 * @since 2.0.0
 *
 * @return Gamajo\GenesisHeaderNav\Plugin
 */
function get_plugin() {
	static $plugin = NULL;
	if ( is_null( $plugin ) ) {
		$plugin = new Plugin;
	}
	return $plugin;
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\genesis_header_nav_i18n' );
/**
 * Load Genesis Header Nav plugin text domain.
 *
 * @since 2.0.0
 */
function genesis_header_nav_i18n() {
	load_plugin_textdomain( 'genesis-header-nav', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\genesis_header_nav_run' );
/**
 * Run Genesis Header Nav plugin.
 *
 * @since 2.0.0
 */
function genesis_header_nav_run() {
	$plugin = get_plugin();
	$plugin->run();
}
