<?php
/**************************************************
* Styles
* ------
* Contains the CSS for Deluxe Portal Pages
* 
* Deluxe Portal Version 2.0
**************************************************/
define('STYLE_FILE', '1', 0);
header('Content-Type: text/css');
header('Cache-Control: private, max-age=86400');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + (2 * 24 * 3600)) . ' GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time() - (12 * 3600)) . ' GMT');
require('./function.php');
/*************************************************/

function run_css_external(&$style)
{
	die(generate_css($style));
}

?>