<?php
/**************************************************
* Post cache Maintenance
* ----------------------
* Clears out cached posts older than the maximum
* number of days specified in the Delxue Portal
* configuration.
* 
* Deluxe Portal Version 2.0
**************************************************/

if (!defined('DP_CRON'))
	die('This script can only be run from Deluxe Portal.');
$DP_TASK = true;

$query = db_query("select threadid from thread where redirect=0 and lastpostdate<".(mktime()-$config['post_cache']*86400).' and thread.sticky=0');
$threads = '';
while ($thread = db_fetch_array($query))
	$threads .= ($threads ? ',' : '').$thread['threadid'];
if ($threads)
	db_query("update post set parsed_message='' where threadid in ($threads)");
task_log($task, "Cached posts in threads with last post longer than $config[post_cache] day".($config['post_cache']==1 ? '' : 's').' ago removed.');
?>