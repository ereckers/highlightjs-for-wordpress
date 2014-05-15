<?php
/*
Plugin Name: highlight.js for WordPress
Plugin URI: https://github.com/ereckers/highlightjs-for-wordpress
Description: highlight.js as a WordPress plugin.
Version: 1.0.0
Author: Ed Reckers (Red Bridge Internet)
Author URI: http://www.redbridgenet.com
License: GPL2
*/

/*  Copyright 2014 Ed Reckers (email : ed@redbridgenet.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Enqueue highlight.js Script and Style site-wide.
 */
function highlightjs_fwp_enqueue_scripts() {

	// allow custom css selection
	$selected_style = "atelier-dune.dark.css";

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
add_action( 'wp_enqueue_scripts', 'highlightjs_fwp_enqueue_scripts' );

/**
 * Add to wp_head: Hook highlighting to the page load event 
 */
function highlightjs_fwp_insert_script() {

	// allow custom selector option
	$custom_selector = "pre";

	// break out to print script
	if ( $custom_selector != "" ) { ?>
<script>
$(document).ready(function() {
	$('<?php echo $custom_selector; ?>').each(function(i, e) {hljs.highlightBlock(e)});
});
</script>
	<?php } else { ?>
<script>hljs.initHighlightingOnLoad();</script>
	<?php }
}
add_action( 'wp_head', 'highlightjs_fwp_insert_script' );

?>
