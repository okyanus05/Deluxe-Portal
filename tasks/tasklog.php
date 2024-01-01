<?php
/**************************************************
* Task Log Maintenance
* --------------------
* Clears entries older than two months from the
* scheduled task log, in order to save disk space.
* 
* Deluxe Portal Version 2.0
**************************************************/

if (!defined('DP_CRON'))
	die('This script can only be run from Deluxe Portal.');
$DP_TASK = true;

$logdate = $current_time - 5184000;
db_query("delete from tasklog where logdate<=$logdate");
task_log($task, 'Scheduled task log entries older than two months have been cleared.');
?>