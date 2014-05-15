<?php
/**
 * Print Combobox With Styles for Settings
 */
function highlightjs_for_wordpress_get_style_list($currentStyle) {

    $styleDir = '..' . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/highlight/' . 'styles'; # dirty hack

    if ($dir = opendir($styleDir))
    {
        while($file = readdir($dir))
        {
            if (($file == '.') or ($file == '..'))
                continue;

            if ($file != $currentStyle)
                echo "<option value=" . $file . ">$file</option>";
            else
                echo "<option selected=\"selected\">$file</option>";
        }
    }
    closedir($dir);
}
?>
