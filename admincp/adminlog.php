<?php
/**************************************************
* Admin Log
* ---------
* Displays a log of all administrator actions
* performed on the site.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'adminlog_adminlog,adminlog_index';
/**************************************************
* Global variable resetting                      */
unset($logs);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$action = $_REQUEST['action'];
$after = $_REQUEST['after'];
$before = $_REQUEST['before'];
$ip = $_REQUEST['ip'];
$page = $_REQUEST['page'];
$userid = $_REQUEST['userid'];
$username = $_POST['username'];
/*************************************************/

$pagetitle = 'Admin Log';

if ($group['adminlog'])
{
	adminlog('Viewed admin log');
	if ($_POST['showall'])
	{
		$username = '';
		$userid = '';
		$after = '';
		$before = '';
		$ip = '';
		$action = '';
	}
	$username = addslashes(htmlspecialchars(stripslashes($username)));
	$action = addslashes(htmlspecialchars(stripslashes($action)));
	if ($username)
		$user_result = db_fetch_array(db_query("select * from user where name='$username'"));
	elseif ($userid)
		$user_result = db_fetch_array(db_query("select * from user where userid='$userid'"));
	if (!$after)
		$after = '1969-12-31';
	if (!$before)
		$before = '2029-12-31';
	if (!$ip)
		$ip = '';
	$query = db_query('select * from adminlog where '.($user_result['userid'] ? "userid='$user_result[userid]' and " : '')."REPLACE(REPLACE(action, '<b>', ''), '</b>', '') like '%".escape_like($action)."%' and ip like '".escape_like($ip)."%' and logdate<=UNIX_TIMESTAMP('$before') and logdate>=UNIX_TIMESTAMP('$after') order by logdate desc");
	$action = stripslashes($action);
	$ip = stripslashes($ip);
	$before = stripslashes($before);
	$after = stripslashes($after);
		
	$page--;
	for ($i=0; $i<$page*$config['log_per_page']; $i++)
		db_fetch_array($query);
	$page++;
	$numpages = ceil(db_num_rows($query)/$config['log_per_page']);
	$adminlog_pagenav = build_pagenav('adminlog', $page, $numpages, $config['numlinks_log'], "userid=$user_result[userid]&amp;action=$action&amp;ip=$ip&amp;after=$after&amp;before=$before");
	
	$i = 0;
	while ($adminlog = db_fetch_array($query))
	{
		if ($i++<$config['log_per_page'])
		{
			$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
			$adminlog['parsed_date'] = time_adjust($adminlog['logdate'], $style['log_date_format']);
			eval(store_template('adminlog_adminlog', '$log'));
			$logs .= $log;
		}
		else
			break;
	}
	eval(get_template('adminlog_index'));
	$user_result['name'] = addslashes($user_result['name']);
}
else
	eval(get_template('permission_error'));
?>