<?php
/*
Plugin Name: highlight.js for WordPress
Plugin URI: https://github.com/ereckers/highlightjs-for-wordpress
Description: highlight.js as a WordPress plugin.
Version: 1.0.1
Author: Ed Reckers (Red Bridge Internet)
Author URI: http://www.redbridgenet.com
License: GPL2

----------------------------------------------------------------------------

Thanks to highlightjs.org and its authors:
: https://github.com/isagalaev/highlight.js/blob/master/AUTHORS.en.txt

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
		add_action( 'wp_enqueue_scripts', array( $this, 'highlightjs_fwp_enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'highlightjs_fwp_insert_script' ) );
		self::settings();
	}

	/**
	 * Setup the plugin WP settings and options
	 */
	function settings() {
		// Create array of default settings
		$this->defaultsettings = array(
			'color_scheme'    => 'default.css',
			'custom_selector' => 'pre'
		);

		// Create the settings array by merging the user's settings and the defaults
		$usersettings = (array) get_option('highlightjs_fwp_settings');
		$this->settings = wp_parse_args( $usersettings, $this->defaultsettings );
	}

	/**
	 * Enqueue highlight.js Script and Style site-wide.
	 */
	function highlightjs_fwp_enqueue_scripts() {
		wp_enqueue_style( 'highlightjs', plugins_url( '/highlight/styles/'.$this->settings['color_scheme'], __FILE__ ), array(), '1.0.1' );
		wp_register_script( 'highlightjs', plugins_url( '/highlight/highlight.pack.js' , __FILE__ ), array(), '1.0.1', 'true' );
	}

	/**
	 * Hook highlight.js highlighting to the page load event 
	 */
	function highlightjs_fwp_insert_script() {
		if ( $this->settings['custom_selector'] != "" ) { 
			include_once( plugin_dir_path( __FILE__ ) . "/templates/initialize-custom.php" );
		} else {
			include_once( plugin_dir_path( __FILE__ ) . "/templates/initialize.php" );
		}
	}

}

$highlightjs_for_wordpress = new HighlightJSForWordPress;

/*
 * Load WordPress options Setting screen
 */
if ( is_admin() ) {
    require_once( 'settings.php' );
}

?>
