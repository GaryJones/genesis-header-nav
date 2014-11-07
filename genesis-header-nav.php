<?php
/**
 * Genesis Header Nav
 *
 * @package   Genesis_Header_Nav
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      https://github.com/GaryJones/genesis-header-nav
 * @copyright 2013 Gary Jones, Gamajo Tech
 *
 * @wordpress-plugin
 * Plugin Name:       Genesis Header Nav
 * Plugin URI:        https://github.com/GaryJones/genesis-header-nav
 * Description:       Registers a menu location and displays it inside the header for a Genesis Framework child theme.
 * Version:           1.3.0
 * Author:            Gary Jones
 * Author URI:        http://gamajo.com/
 * Text Domain:       genesis-header-nav
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/GaryJones/genesis-header-nav
 * GitHub Branch:     master
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-genesis-header-nav.php';

$genesis_header_nav = new Genesis_Header_Nav;

add_action( 'plugins_loaded', 'genesis_header_nav_i18n' );

function genesis_header_nav_i18n() {
	load_plugin_textdomain( 'genesis-header-nav', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action( 'init', 'genesis_header_nav_run' );

function genesis_header_nav_run() {
	global $genesis_header_nav;
	$genesis_header_nav->run();
}
