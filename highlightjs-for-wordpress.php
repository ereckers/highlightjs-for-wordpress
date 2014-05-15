<?php
/*
Plugin Name: highlight.js for WordPress
Plugin URI: https://github.com/ereckers/highlightjs-for-wordpress
Description: highlight.js as a WordPress plugin.
Version: 1.0.0
Author: Ed Reckers (Red Bridge Internet)
Author URI: http://www.redbridgenet.com
License: GPL2

----------------------------------------------------------------------------

	Thanks to highlightjs.org

----------------------------------------------------------------------------

	Copyright (c) 2014 Ed Reckers. (email : ed@redbridgenet.com)

	This plugin, like WordPress, is licensed under the GPL.
	Use it to make something cool, have fun, and share what you've learned with others.
*/

class HighlightJSForWordPress {

	// to store a reference to the plugin, allows other plugins to remove actions
	static $instance;

	/**
	 * Constructor, entry point of the plugin
	 */
	function __construct() {
		self::$instance = $this;
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Initialization, Hooks, and localization
	 */
	function init() {
		require_once( 'settings.php' );

		add_action( 'wp_enqueue_scripts', array( $this, 'highlightjs_fwp_enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'highlightjs_fwp_insert_script' ) );

	}

	/**
	 * Enqueue highlight.js Script and Style site-wide.
	 */
	function highlightjs_fwp_enqueue_scripts() {

		// allow custom css selection
		$options = get_option('my_option_name');

		if ( $options['color_scheme'] != "" ) {
			$selected_style = $options['color_scheme'];
		} else {
			$selected_style = "default.css";
		}

		wp_enqueue_style(
			'highlightjs',
			plugins_url( '/highlight/styles/'.$selected_style , __FILE__ ),
			array(),
			'1.0.0'
		);
		wp_enqueue_script(
			'highlightjs',
			plugins_url( '/highlight/highlight.pack.js' , __FILE__ ),
			array(),
			'1.0.0',
			'true'
		);
	}

	/**
	 * Hook highlight.js highlighting to the page load event 
	 */
	function highlightjs_fwp_insert_script() {

		// allow custom selector option
		$options = get_option('my_option_name');

		if ( $options['custom_selector'] != "" ) { 
			include_once( plugin_dir_path( __FILE__ ) . "/templates/initialize-custom.php" );
		} else {
			include_once( plugin_dir_path( __FILE__ ) . "/templates/initialize.php" );
		}

	}

}

$highlightjs_for_wordpress = new HighlightJSForWordPress;

?>
