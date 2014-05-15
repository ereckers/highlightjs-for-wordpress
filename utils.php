<?php
/**
 * Print Combobox With Styles for Settings
 */
function highlightjs_fwp_get_style_list( $style = "default.css" ) {

	$options = "";
	//$style = "default.css";

    //$styleDir = '..' . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/highlight/' . 'styles'; # dirty hack

    //if ( $dir = opendir( $styleDir ) ) {
    if ( $dir = opendir( plugin_dir_path( __FILE__ ) . '/highlight/styles' ) ) {
        while ( $file = readdir( $dir ) ) {
            if ( ( $file == '.' ) or ( $file == '..' ) ) continue;

            if ( $file != $style ) {
                $options .= "<option value=" . $file . ">$file</option>";
			} else {
                $options .= "<option selected=\"selected\">$file</option>";
			}
        }
    }
    closedir( $dir );
	return $options;
}
?>
