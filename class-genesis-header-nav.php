<?php
/**
 * Genesis Header Nav
 *
 * @package   GenesisHeaderNav
 * @author    Gary Jones <gary@garyjones.co.uk>
 * @license   GPL-2.0+
 * @link      https://github.com/GaryJones/genesis-header-nav
 * @copyright 2013 Gary Jones, Gamajo Tech
 */

/**
 * Plugin class.
 *
 * @package GenesisHeaderNav
 * @author  Gary Jones <gary@garyjones.co.uk>
 */
class Genesis_Header_Nav {

	/**
	 * Instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * Applies `genesis_header_nav_priority` filter. Use a value of 6-9 to add the nav before title + widget area, or
	 * 11-14 to add it after. If you want to add it in between, you'll need to remove and re-build `genesis_do_header()`
	 * so that the output of the widget area is in a different function that can be hooked to a later priority.
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'genesis_setup', array( $this, 'register_nav_menu' ), 15 );
		add_action( 'genesis_header', array( $this, 'show_menu' ), apply_filters( 'genesis_header_nav_priority', 12 ) );
		add_filter( 'body_class', array( $this, 'body_classes' ), 15 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {
		$domain = 'genesis-header-nav';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Register the menu location.
	 *
	 * @since 1.0.0
	 */
	public function register_nav_menu() {
		register_nav_menu( 'header', __( 'Header', 'genesis-header-nav' ) );
	}

	/**
	 * Display the menu.
	 *
	 * @since 1.0.0
	 */
	public function show_menu() {
		//* If menu is assigned to theme location, output
		if ( ! has_nav_menu( 'header' ) )
			return;

		$class = 'menu genesis-nav-menu menu-header';
		if ( genesis_superfish_enabled() )
			$class .= ' js-superfish';

		$args = array(
			'theme_location' => 'header',
			'container'      => '',
			'menu_class'     => $class,
			'echo'           => 0,
		);

		$nav = wp_nav_menu( $args );

		//* Do nothing if there is nothing to show
		if ( ! $nav )
			return;

		$nav_markup_open = genesis_markup( array(
			'html5'   => '<nav %s>',
			'xhtml'   => '<div id="nav">',
			'context' => 'nav-header',
			'echo'    => false,
		) );
		$nav_markup_open .= genesis_structural_wrap( 'menu-header', 'open', 0 );

		$nav_markup_close  = genesis_structural_wrap( 'menu-header', 'close', 0 );
		$nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';

		$nav_output = $nav_markup_open . $nav . $nav_markup_close;

		echo apply_filters( 'genesis_do_header_nav', $nav_output, $nav, $args );
	}

	/**
	 * Remove then conditionally re-add header-full-width body class.
	 *
	 * As well as just checking for something being in the header right widget area, or the action having something
	 * hooked* in, we also need to check to see if the header navigation has a menu assigned to it. Only if all are
	 * false can we* proceed with saying the header-full-width class should be applied.
	 *
	 * Function must be hooked after priority 10, so Genesis has had a chance to do the filtering first.
	 *
	 * @since 1.0.0
	 *
	 * @param array $classes Existing classes.
	 *
	 * @return array Amended classes.
	 */
	public function body_classes( array $classes ) {
		// Loop through existing classes to remove 'header-full-width'
		foreach ( $classes as $index => $class ) {
			if ( 'header-full-width' === $class ) {
				unset( $classes[$index] );
				break; // No need to check the rest.
			}
		}

		// Do all the checks
		if ( ! is_active_sidebar( 'header-right' ) && ! has_action( 'genesis_header_right' ) && ! has_nav_menu( 'header' ) )
			$classes[] = 'header-full-width';

		return $classes;
	}

}
