<?php
/**
 * Genesis Header Nav
 *
 * @package   GenesisHeaderNav
 * @author    Gary Jones <gary@garyjones.co.uk>
 * @license   GPL-2.0+
 * @link      https://github.com/GaryJones/genesis-header-nav
 * @copyright 2013 Gary Jones, Gamajo Tech
 *
 * @wordpress-plugin
 * Plugin Name: Genesis Header Nav
 * Plugin URI:  https://github.com/GaryJones/genesis-header-nav
 * Description: Registers a menu location and displays it inside the header for a Genesis Framework child theme.
 * Version:     1.0.0
 * Author:      Gary Jones
 * Author URI:  http://gamajo.com/
 * Text Domain: genesis-header-nav
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'class-genesis-header-nav.php';

Genesis_Header_Nav::get_instance();
