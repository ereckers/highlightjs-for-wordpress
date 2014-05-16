<?php
/**
 * Print Color Scheme stylesheet options
 */
function highlightjs_fwp_get_style_list( $style = "default.css" ) {
	$options = "";

	if ( $dir = opendir( plugin_dir_path( __FILE__ ) . '/highlight/styles' ) ) {
		while ( $file = readdir( $dir ) ) {
			if ( ( $file == '.' ) or ( $file == '..' ) ) continue;
			$options .= "<option value=\"".$file."\" ".selected( $file, $style, false ).">".$file."</option>";
		}
	}
	closedir( $dir );
	return $options;
}
?>
