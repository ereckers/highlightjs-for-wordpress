<?php
/*
 * Setup and processes WordPress Administrative Settings screen for plugin
 */
class HighlightJSForWordPressSettings {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page() {
		// This page will be under "Settings"
		add_options_page(
			'Highlight JS Settings', // Page Title 
			'Highlight JS', // Menu Title
			'manage_options', // Capability
			'highlightjs-for-wordpress-settings', // Menu Slug
			array( $this, 'create_admin_page' ) // Callback
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {
		// Set class property
		// TODO: understand if this contains all options as array
		$this->options = get_option( 'my_option_name' );
?>
		<div class="wrap">
			<h2>highlight.js for WordPress Settings</h2>           
			<form method="post" action="options.php">
<?php
		// This prints out all hidden setting fields
		settings_fields( 'my_option_group' );   
		do_settings_sections( 'my-setting-admin' );
		submit_button(); 
?>
			</form>
		</div>
<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init() {        

		register_setting(
			'my_option_group', // Option group
			'my_option_name', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'setting_section_id', // ID
			'My Custom Settings', // Title
			array( $this, 'print_section_info' ), // Callback
			'my-setting-admin' // Page
		);  

		/*
		add_settings_field(
			'id_number', // ID
			'ID Number', // Title 
			array( $this, 'id_number_callback' ), // Callback
			'my-setting-admin', // Page
			'setting_section_id' // Section           
		);      

		add_settings_field(
			'title', 
			'Title', 
			array( $this, 'title_callback' ), 
			'my-setting-admin', 
			'setting_section_id'
		);      
		 */

		add_settings_field(
			'custom_selector', 
			'Custom Selector', 
			array( $this, 'custom_selector_callback' ), 
			'my-setting-admin', 
			'setting_section_id'
		);      

		add_settings_field(
			'color_scheme', 
			'Color Scheme', 
			array( $this, 'color_scheme_callback' ), 
			'my-setting-admin', 
			'setting_section_id'
		);      
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
		$new_input = array();

		/*
		if( isset( $input['id_number'] ) )
			$new_input['id_number'] = absint( $input['id_number'] );

		if( isset( $input['title'] ) )
			$new_input['title'] = sanitize_text_field( $input['title'] );
		 */

		if( isset( $input['custom_selector'] ) )
			$new_input['custom_selector'] = sanitize_text_field( $input['custom_selector'] );

		if( isset( $input['color_scheme'] ) )
			$new_input['color_scheme'] = sanitize_text_field( $input['color_scheme'] );

		return $new_input;
	}

	/** 
	 * Print the Section text
	 */
	public function print_section_info() {
		print 'Enter your settings below:';
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function id_number_callback() {
		printf(
			'<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
			isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function title_callback() {
		printf(
			'<input type="text" id="title" name="my_option_name[title]" value="%s" />',
			isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function custom_selector_callback() {
		printf(
			'<input type="text" id="custom_selector" name="my_option_name[custom_selector]" value="%s" /><p class="description">If you use different markup for code blocks you can initialize them manually.</p>',
			isset( $this->options['custom_selector'] ) ? esc_attr( $this->options['custom_selector']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function color_scheme_callback() {

		// contains options building helpers
		require_once( 'utils.php' );

		print '<select name="my_option_name[color_scheme]" id="color_scheme">';
		highlightjs_for_wordpress_get_style_list( $this->options['color_scheme'] );
		print '</select>';

		/*
		printf(
			'<input type="text" id="color_scheme" name="my_option_name[color_scheme]" value="%s" /><p class="description">If you use different markup for code blocks you can initialize them manually.</p>',
			isset( $this->options['color_scheme'] ) ? esc_attr( $this->options['color_scheme']) : ''
		);
		 */
	}

}

if ( is_admin() ) {
	$highlightjs_for_wordpress_settings = new HighlightJSForWordPressSettings();
}

?>
