<?php
/**************************************************
* Mini-function
* -------------
* 
* Stripped down version of function.php. Useful for
* pages that don't need templates or styles.
* 
* Deluxe Portal Version 2.0
**************************************************/

error_reporting(2039);

set_magic_quotes_runtime(0);
ini_set('magic_quotes_sybase', '0');
ini_set('gpc_order', 'gpc');
$magic_quotes_gpc = ini_get('magic_quotes_gpc') ? true : false;

if (isset($_REQUEST['doredirect']))
{
	$_REQUEST['doredirect'] = $magic_quotes_gpc ? stripslashes($_REQUEST['doredirect']) : $_REQUEST['doredirect'];
	header("Location: $_REQUEST[doredirect]");
	die;
}

if (((float) substr(phpversion(), 0, 3)) < 4)
	trigger_error('Deluxe Portal 2.0 requires PHP 4.0.6 or above.', E_USER_ERROR);
elseif (((float) substr(phpversion(), 0, 3)) < 4.1)
{
	global $HTTP_ENV_VARS, $HTTP_SERVER_VARS, $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $_GET, $_POST, $_COOKIE, $HTTP_POST_FILES, $_FILES, $_ENV;
	$_ENV =& $HTTP_ENV_VARS;
	$_SERVER =& $HTTP_SERVER_VARS;
	$_GET =& $HTTP_GET_VARS;
	$_POST =& $HTTP_POST_VARS;
	$_COOKIE =& $HTTP_COOKIE_VARS;
	$_FILES =& $HTTP_POST_FILES;
	$_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
}

$_SERVER['HTTP_X_FORWARDED_FOR'] = ($_ENV['HTTP_X_FORWARDED_FOR'] ? $_ENV['HTTP_X_FORWARDED_FOR'] : $_SERVER['HTTP_X_FORWARDED_FOR']);
$_SERVER['REMOTE_ADDR'] = ($_ENV['REMOTE_ADDR'] ? $_ENV['REMOTE_ADDR'] : $_SERVER['REMOTE_ADDR']);
$_SERVER['REMOTE_ADDR'] = ($_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
$_SERVER['REMOTE_ADDR'] = (is_array($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'][0] : $_SERVER['REMOTE_ADDR']);
$_SERVER['REMOTE_ADDR'] = (preg_match('/(\d{1,3}\.){3}(\d{1,3})/', $_SERVER['REMOTE_ADDR'], $match) ? $match[0] : 'Unknown');

if (!$_SERVER['REQUEST_URI'])
	$_SERVER['REQUEST_URI'] = $_SERVER['PHP_INFO'].($_SERVER['QUERY_STRING'] ? "?$_SERVER[QUERY_STRING]" : '');

if (!defined('DP_VERSION'))
{
	define('DP_VERSION', '2.0', 0);
	$_SERVER['SCRIPT_FILENAME'] = ($_SERVER['SCRIPT_FILENAME'] ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['PATH_TRANSLATED']);
	$_SERVER['SCRIPT_FILENAME'] = str_replace('\\\\', '\\', $_SERVER['SCRIPT_FILENAME']);
	
	// $USE_DIR = ($_SERVER['PATH_INFO'] ? $_SERVER['SCRIPT_FILENAME'] . $_SERVER['PATH_INFO'] : $_SERVER['SCRIPT_FILENAME']);
	$USE_DIR = $_SERVER['SCRIPT_FILENAME'];
	$USE_DIR = ((substr($USE_DIR, -1, 1)=='/') ? substr($USE_DIR, 0, -1) : dirname($USE_DIR));
	$USE_DIR = str_replace('\\', '/', $USE_DIR);
		
	$requireurl = str_replace('\\', '/', dirname(__FILE__) . '/');

	require($requireurl.'config.php');
	$admincp_dir = $admincp_dir ? $admincp_dir : 'admincp';
	$modcp_dir = $modcp_dir ? $modcp_dir : 'modcp';

	$check_use = $USE_DIR . '/';
	$check_use_len = strlen($check_use);
	$check_req = $requireurl;
	$check_req_len = strlen($check_req);
	
	if (substr($check_req, 0, $check_use_len)==$check_use || substr($check_use, 0, $check_req_len)==$check_req)
	{
		$repeatcount = (substr_count($USE_DIR . '/', '/') - substr_count($requireurl, '/'));
		if ($repeatcount < 0)
			$relativeurl = './' . substr(str_replace($USE_DIR, '', $requireurl), 1, -1);
		elseif ($repeatcount==0)
			$relativeurl = '.';
		else
		{
			$relativeurl = str_repeat('../', $repeatcount);
			$relativeurl = substr($relativeurl, 0, -1);
		}
	}
	else
	{
		if (strstr($_SERVER['SCRIPT_FILENAME'], "/$admincp_dir/") ||
			strstr($_SERVER['SCRIPT_FILENAME'], "/$modcp_dir/") ||
			strstr($_SERVER['SCRIPT_FILENAME'], '/include/'))
			$relativeurl = '..';
		else
			$relativeurl = '.';
	}
}

define('REQUIRE_PATH', $requireurl, 0);
$current_url = str_replace('&', '&amp;', $_SERVER['REQUEST_URI']);
mt_srand(time());
srand(time());

function array_walk_multi(&$array, $function, $type = 'string', $nocheck_input = false)
{
	$type_check_function = 'is_' . $type;
	if (!is_array($array) && $nocheck_input===false)
	{
		trigger_error('Argument passed to array_walk_multi() not an array.', E_USER_WARNING);
		return false;
	}
	if (!function_exists($type_check_function) && $type!='all' && $nocheck_input===false)
	{
		trigger_error('Type checking function for ' . $type . ' does not exist.', E_USER_WARNING);
		return false;
	}
	elseif (!function_exists($function) && $nocheck_input===false)
	{
		trigger_error('Function ' . $function . ' does not exist for use in array_walk_multi().', E_USER_WARNING);
		return false;
	}
	else
	{
		reset($array);
		while (list($var) = each($array))
		{
			if (($type=='all' || $type_check_function($array[$var])) && !is_array($array[$var]))
				$array[$var] = $function($array[$var]);
			elseif (is_array($array[$var]))
				$array[$var] = array_walk_multi($array[$var], $function, $type, true);
		}
		reset($array);
	}
	return $array;
}

if ($magic_quotes_gpc==false)
{
	if (is_array($_REQUEST))array_walk_multi($_REQUEST, 'addslashes');
	if (is_array($_GET))	array_walk_multi($_GET, 'addslashes');
	if (is_array($_POST))	array_walk_multi($_POST, 'addslashes');
	if (is_array($_COOKIE))	array_walk_multi($_COOKIE, 'addslashes');
}

require($requireurl.'include/database.php');
require($requireurl.'include/images.php');
require($requireurl.'include/image_handler.php');
require($requireurl.'include/mail.php');
require($requireurl.'include/string.php');

db_connect();
?>