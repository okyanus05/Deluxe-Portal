<?php
/**************************************************
* Search Results Deletion Maintainence
* ------------------------------------
* Deletes old search results from the database.
* 
* Deluxe Portal Version 2.0
**************************************************/

if (!defined('DP_CRON'))
	die('This script can only be run from Deluxe Portal.');
$DP_TASK = true;

$deletebefore = time() - (3600 * $config['clear_search']);

$query = db_query("select searchid from search where lastaccessed<$deletebefore");
$searchids = '';

while ($result = db_fetch_array($query))
	$searchids .= ",$result[searchid]";

if (!empty($searchids))
{
	$deleteids = substr($searchids, 1);
	db_query("delete from search where searchid in ($deleteids)");
	db_query("delete from searchresult where searchid in ($deleteids)");
}

$currentsearchinfo = db_fetch_array(db_query("select count(*) from search"));
if ($currentsearchinfo[0]==0)
{
	db_query('truncate table search');
	db_query('truncate table searchresult');
}

task_log($task, "Search results older than $config[clear_search] hour" . ($config['clear_search']!=1 ? 's' : '') . " removed.");

?>