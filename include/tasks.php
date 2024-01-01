<?php
/**************************************************
* Scheduled Tasks API
* -------------------
* get_next_timestamp($minute, $hour, $day, $dayofweek)
* next_run_today($minute, hour, $after_current=true)
* run_task()
* 
* Deluxe Portal Version 2.0
**************************************************/

function task_log($task, $action)
{
	global $current_time;
	if (!$task['log'])
		return;
	$name = addslashes($task['name']);
	$action = addslashes($action);
	db_query("insert into tasklog (name, action, logdate) values ('$name', '$action', '$current_time')");
}

function get_next_timestamp($minute, $hour, $day, $dayofweek)
{
	$current = getdate();
	
	if ($dayofweek==-1)
	{
		if ($day==-1)
		{
			$firstday = $current['mday'];
			$secondday = $current['mday'] + 1;
		}
		else
		{
			$firstday = $day;
			$secondday = $day + date('t');
		}
	}
	else
	{
		$firstday = $current['mday'] + ($dayofweek - $current['wday']);
		$secondday = $firstday + 7;
	}

	if ($firstday<$current['mday'])
		$firstday = $secondday;
	
	if ($firstday==$current['mday'])
	{
		$today = next_run_today($minute, $hour);
		if ($today['hour']==-1 && $today['minute']==-1)
		{
			$day = $secondday;
			$new = next_run_today($minute, $hour, false);
			$hour = $new['hour'];
			$minute = $new['minute'];
		}
		else
		{
			$day = $firstday;
			$hour = $today['hour'];
			$minute = $today['minute'];
		}
	}
	else
	{
		$day = $firstday;
		$today = next_run_today($minute, $hour, false);
		$hour = $today['hour'];
		$minute = $today['minute'];
	}
	
	return mktime($hour, $minute, 0, $current['mon'], $day, $current['year']);
}

function next_run_today($minute, $hour, $after_current=true)
{
	if ($after_current)
	{
		$current = getdate();
		$pasthour = $current['hours'];
		$pastminute = $current['minutes'];
	}
	else
	{
		$pasthour = 0;
		$pastminute = -1;
	}
	
	if ($hour==-1 && $minute==-1)
	{
		$new['hour'] = $pasthour;
		$new['minute'] = $pastminute + 1;
	}
	elseif ($hour==-1 && $minute!=-1)
	{
		$new['hour'] = $pasthour;
		if ($minute<=$pastminute)
			$new['hour']++;
		$new['minute'] = $minute;
	}
	elseif ($hour!=-1 && $minute==-1)
	{
		if ($hour<$pasthour)
		{
			$new['hour'] = -1;
			$new['minute'] = -1;
		}
		elseif ($hour==$pasthour)
		{
			$new['hour'] = $hour;
			$new['minute'] = $pastminute + 1;
		}
		else
		{
			$new['hour'] = $hour;
			$new['minute'] = 0;
		}
	}
	elseif ($hour!=-1 && $minute!=-1)
	{
		if ($hour<$pasthour || ($hour==$pasthour && $minute<=$pastminute))
		{
			$new['hour'] = -1;
			$new['minute'] = -1;
		}
		else
		{
			$new['hour'] = $hour;
			$new['minute'] = $minute;
		}
	}
	return $new;
}

function run_task()
{
	global $config, $current_directory, $current_time, $requireurl;
	db_query('update config set next_task=4294967296');
	chdir($current_directory);
	define('DP_CRON', 1);
	$query = db_query("select * from task where nextrun<=".mktime()." order by nextrun asc");
	while ($task = db_fetch_array($query))
	{
		if (!$task['enabled'])
		{
			$nextrun = get_next_timestamp($task['minute'], $task['hour'], $task['day'], $task['dayofweek']);
			db_query("update task set nextrun='$nextrun' where taskid=$task[taskid]");
			continue;
		}
		
		if (!$task['late'])
		{
			$current = getdate();
			$taskdate = getdate($task['nextrun']);
			if ($current['minutes']!=$taskdate['minutes'] || $current['hours']!=$taskdate['hours'] || $current['mday']!=$taskdate['mday'] || $current['mon']!=$taskdate['mon'] || $current['year']!=$taskdate['year'])
			{
				$nextrun = get_next_timestamp($task['minute'], $task['hour'], $task['day'], $task['dayofweek']);
				db_query("update task set nextrun='$nextrun' where taskid=$task[taskid]");
				task_log($task, "Task did not run. The scheduled time was missed.");
				continue;
			}
		}
		
		if ($task['max_load'] && $task['max_load']!='0.00')
		{
			if (!$avg)
			{
				if ($average = @exec('uptime'))
					preg_match('/([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/', $average, $avg);
			}
			if ($avg[1] && (float)$avg[1] > (float)$task['max_load'])
			{
				$nextrun = get_next_timestamp($task['minute'], $task['hour'], $task['day'], $task['dayofweek']);
				db_query("update task set nextrun='$nextrun' where taskid=$task[taskid]");
				task_log($task, "Task did not run. Server load too high ($avg[1]).");
				continue;
			}
		}
		
		task_log($task, 'Started task');
		$DP_TASK = false;
		if (strpos($task['script'], '?') !== false)
		{
			$_GET = $_POST = $_REQUEST = $_COOKIE = array();
			$task['script'] = explode('?', $task['script'], 2);
			$task['query_string'] = $task['script'][1];
			$task['query_string'] = explode('&', $task['query_string']);
			foreach ($task['query_string'] as $variable)
			{
				$variable = explode('=', $variable, 2);
				$var_index = urldecode($variable[0]);
				$_GET[$var_index] = $_REQUEST[$var_index] = urldecode($variable[1]);
			}
			$task['script'] = $task['script'][0];
		}
		if (substr($task['script'], 0, 1)=='.' || substr($task['script'], 0, 1)=='/')
			include($task['script']);
		else
			include($requireurl.$task['script']);
		if ($DP_TASK)
			task_log($task, 'Ended task');
		else
			task_log($task, 'Script does not exist. Task failed.');
		
		$nextrun = get_next_timestamp($task['minute'], $task['hour'], $task['day'], $task['dayofweek']);
		db_query("update task set nextrun='$nextrun' where taskid=$task[taskid]");
	}
	
	$next_task = db_fetch_array(db_query('select min(nextrun) as nxtrun from task'));
	db_query("update config set next_task='$next_task[nxtrun]'");
}
?>