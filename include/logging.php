<?php
/**************************************************
* Logging API
* -----------
* adminlog($entry)
* moderatorlog($entry, $threadid, $name)
* 
* Deluxe Portal Version 2.0
**************************************************/

/**************************************************
* Global variable resetting                      */
unset($current_time);
unset($user);
/*************************************************/

function adminlog($entry)
{
	global $_SERVER, $user, $current_time;
	$entry = addslashes($entry);
	db_query("insert into adminlog (logdate, action, userid, username, ip) values ($current_time, '$entry', $user[userid], '".addslashes($user['name'])."', '$_SERVER[REMOTE_ADDR]')");
}

function moderatorlog($entry, $threadid, $name)
{
	global $_SERVER, $user, $current_time;
	$entry = addslashes($entry);
	$name = addslashes($name);
	db_query("insert into moderatorlog (logdate, action, userid, username, ip, threadid, name) values ($current_time, '$entry', $user[userid], '".addslashes($user['name'])."', '$_SERVER[REMOTE_ADDR]', '$threadid', '$name')");
}
?>