<?php
/**************************************************
* Session Maintenance
* -------------------
* Clears entries older than one day from the
* session table, in order to free up memory and
* make table access faster.
* 
* Deluxe Portal Version 2.0
**************************************************/

if (!defined('DP_CRON'))
	die('This script can only be run from Deluxe Portal.');
$DP_TASK = true;

$lastactivity = mktime() - 129600;
db_query("delete from session where lastactivity<=$lastactivity");
task_log($task, 'Session entries older than two days have been cleared.');
?>