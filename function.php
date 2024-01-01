<?php
/**************************************************
* Function
* --------
* 
* Required include file for Deluxe Portal pages.
* Imports and sets up all necessary services,
* functions, and variables.
* 
* Deluxe Portal Version 2.0
**************************************************/
error_reporting(2039);
$templatecache .= ',server_busy,server_busy_guest,banned,footer,form_footer,form_header,forumjump,header,message_footer,message_header,permission_error,site_closed,nav_footer,nav_header,sidebar_download,sidebar_link,sidebar_section,redirect_footer,redirect_header';
if ($admincache)
	$admincache .= ',server_busy,server_busy_guest,banned,footer,form_footer,form_header,header,message_footer,message_header,permission_error,site_closed,redirect_footer,redirect_header';
/**************************************************
* Global variable resetting                      */
unset($current_directory);
unset($execution_time);
unset($pagestyle);
unset($pagetitle);
unset($pmquery);
unset($requireurl);
/*************************************************/

define('DP_VERSION', '2.0', 0);
function gm($e=0){list($a,$b)=explode(' ',microtime());$r=$a+$b;if($e)$r=round($r-$e,5);return $r;}
$ex=0;

$time = microtime();
$time = explode(' ', $time);
$start_time = $time[1] + $time[0];

function end_timer()
{
	global $execution_time, $php_execution_percentage, $sql_execution_percentage, $sql_time, $start_time;
	$time = microtime();
	$time = explode(' ', $time);
	$end_time = $time[1] + $time[0];
	$execution_time = $end_time - $start_time;
	$sql_execution_percentage = round((($sql_time/$execution_time)*100), 2);
	$php_execution_percentage = 100-$sql_execution_percentage;
	$execution_time = round($execution_time, 5);
}

$_SERVER['SCRIPT_FILENAME'] = ($_SERVER['SCRIPT_FILENAME'] ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['PATH_TRANSLATED']);
$_SERVER['SCRIPT_FILENAME'] = str_replace('\\\\', '\\', $_SERVER['SCRIPT_FILENAME']);

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

require($requireurl.'minifunction.php');
require($requireurl.'include/forum.php');
require($requireurl.'include/import_export.php');
require($requireurl.'include/logging.php');
require($requireurl.'include/posting.php');
require($requireurl.'include/stores.php');
require($requireurl.'include/tasks.php');
require($requireurl.'include/templates.php');
require($requireurl.'include/user.php');

$listqueries_url = str_replace('&', '&amp;', $_SERVER['REQUEST_URI']);

$config = db_fetch_array(db_query('select * from config'));
ob_start($config['compression'] ? 'ob_gzhandler' : NULL);

$current_time = mktime();

if ($config['next_task']<=$current_time)
{
	$current_directory = getcwd();
	register_shutdown_function('run_task');
}

start_session();

$style = db_fetch_array(db_query("select styleset.*,style.* from styleset,style where styleset.stylesetid=$user[stylesetid] and styleset.styleid=style.styleid"));
if (dp_substr($style['images'],0,7)!='http://' && dp_substr($style['images'],0,6)!='ftp://' && dp_substr($style['images'],0,1)!='/')
	$style['images'] = "$relativeurl/$style[images]";
if (dp_substr($style['logo'],0,7)!='http://' && dp_substr($style['logo'],0,6)!='ftp://' && dp_substr($style['logo'],0,1)!='/')
	$style['logo'] = "$relativeurl/$style[logo]";
eval('$style["wysiwygcss"] = "' . str_replace("\\'", "'", addslashes($style['wysiwygcss'])) . '";');

if ($config['external_style'])
{
	if (defined('STYLE_FILE'))
		run_css_external($style);
	$pagestyle = '';
}
else
	$pagestyle = generate_css($style);

set_php_highlighting($style['php_default'], $style['php_comment'], $style['php_html'], $style['php_keyword'], $style['php_string']);

get_template_store();

$admin_button = false;
$mod_button = false;
if ($group['addons'] || $group['adminlog'] || $group['articles'] || $group['configuration'] || $group['customfields'] || $group['downloads'] || $group['dpcode'] || $group['faq'] || $group['forumperm'] || $group['forums'] || $group['groupchanger'] || $group['groups'] || $group['icons'] || $group['links'] || $group['maintenance'] || $group['moderators'] || $group['sections'] || $group['smilies'] || $group['styles'] || $group['stylesets'] || $group['tasks'] || $group['templates'] || $group['titles'] || $group['topics'] || $group['users'])
	$admin_button = true;

if (($group['supermod_massdelete'] || $group['supermod_massmove'] || $group['supermod_banusers'] || $group['supermod_log'] || $group['supermod_announcements'] || $group['supermod_viewfullprofiles'] || $user['moderatorid']) && !($group['addons'] || $group['adminlog'] || $group['articles'] || $group['configuration'] || $group['customfields'] || $group['downloads'] || $group['dpcode'] || $group['faq'] || $group['forumperm'] || $group['forums'] || $group['groupchanger'] || $group['groups'] || $group['icons'] || $group['links'] || $group['maintenance'] || $group['moderators'] || $group['sections'] || $group['smilies'] || $group['styles'] || $group['stylesets'] || $group['tasks'] || $group['templates'] || $group['titles'] || $group['topics'] || $group['users']))
	$mod_button = true;

$newmessages = '';
$nonewmessages = '';
if ($group['privatemessaging'] && $user['userid'])
{
	if ($user['num_pm'])
		$newmessages = true;
	else
		$nonewmessages = true;
}
$dopmpopup = false;
if ($user['pm_popup'] && $newmessages && !$user['nopopup'] && basename($_SERVER['PHP_SELF'])!='pm.php' && basename($_SERVER['PHP_SELF'])!='readpm.php' && basename($_SERVER['PHP_SELF'])!='newpm.php')
{
	$dopmpopup = true;
	db_query("update user set nopopup=1 where userid=$user[userid]");
}
elseif (!$newmessages && $user['nopopup'])
	db_query("update user set nopopup=0 where userid=$user[userid]");

if ($config['closed'] && $group['configuration'])
	$closed_admin = true;
else
	$closed_admin = false;
$closed_reason = htmlspecialchars($config['closed_reason']);
if ($config['closed'] && !$group['configuration'] && !strstr($_SERVER['PHP_SELF'], 'user.php') && !strstr($_SERVER['PHP_SELF'], "/$admincp_dir/index.php"))
{
	$pagetitle = 'Site Closed';
	die(eval(get_template('site_closed')));
}

$ip = explode("\n", $config['banned_ip']);
$i = 0;
while ($banned = $ip[$i++])
{
	if (substr($_SERVER['REMOTE_ADDR'], 0, strlen($banned)) == $banned)
	{
		$pagetitle = 'Banned';
		die(eval(get_template('banned')));
	}
}

$load_limit = false;
if ($config['load_limit'] || $config['guest_limit'])
{
	if ($average = @exec('uptime'))
	{
		preg_match('/([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/', $average, $avg);
		if ($config['load_limit'] && $config['load_limit']!='0.00' && (float)$avg[1] > (float)$config['load_limit'])
		{
			if ($group['configuration'])
				$load_limit = true;
			else
			{
				$pagetitle = 'Server too busy';
				die(eval(get_template('server_busy')));
			}
		}

		if ($config['guest_load'] && $config['guest_load']!='0.00' && !strstr($_SERVER['REQUEST_URI'], 'register.php') && !strstr($_SERVER['REQUEST_URI'], 'user.php') && (float)$avg[1] > (float)$config['guest_load'] && !$user['userid'])
		{
			$pagetitle = 'Server too busy';
			die(eval(get_template('server_busy_guest')));
		}
	}
}
?>