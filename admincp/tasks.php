<?php
/**************************************************
* Scheduled Tasks
* ---------------
* Manages scheduled tasks; scripts which can be run
* at regular intervals.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'delete_task,edit_task,invalid_task,prune_task_log,run_task,run_task_redirect,tasks_duplicate,tasks_index,tasks_log,tasks_missing,tasks_range,tasks_show_log,tasks_task';

require('../function.php');

$pagetitle = 'Scheduled Tasks';

if($group['tasks'])
{
	if ($_POST['op']=='add')
	{
		if (($name = trim(htmlspecialchars($_POST['name']))) && $_POST['script'])
		{
			if ($duplicate = db_fetch_array(db_query("select * from task where name='$name'")))
				eval(get_template('tasks_duplicate'));
			else
			{
				$minute = $_POST['minute'];
				if (strtolower($minute)=='any')
					$minute = -1;
				$hour = $_POST['hour'];
				if (strtolower($hour)=='any')
					$hour = -1;
				$day = $_POST['day'];
				if (strtolower($day)=='any')
					$day = -1;
				
				if ($hour<-1 || $hour>23 || ($day!=-1 && ($day<1 || $day>31)) || $minute<-1 || $minute>59 || $_POST['dayofweek']<-1 || $_POST['dayofweek']>6)
					eval(get_template('tasks_range'));
				else
				{
					adminlog("Added scheduled task - <b>$name</b>");
					$nextrun = get_next_timestamp($minute, $hour, $day, $_POST['dayofweek']);
					$description = trim(htmlspecialchars($_POST['description']));
					$max_load = trim(htmlspecialchars($_POST['max_load']));
					db_query("insert into task (name, script, enabled, late, hour, minute, day, dayofweek, log, nextrun, max_load, description) values ('$name', '$_POST[script]', '$_POST[enabled]', '$_POST[late]', '$hour', '$minute', '$day', '$_POST[dayofweek]', '$_POST[log]', $nextrun, '$max_load', '$description')");
					if ($config['next_task'] > $nextrun)
						db_query("update config set next_task='$nextrun'");
					header('Location: tasks.php');
				}
			}
		}
		else
			eval(get_template('tasks_missing'));
	}
	elseif ($_REQUEST['op']=='edit')
	{
		$query = db_query('select * from task order by name asc');
		$tasks = '';
		while ($task = db_fetch_array($query))
		{
			if ($task['taskid']==$_REQUEST['id'])
				$newtask = $task;
			eval(store_template('tasks_task'));
			$tasks .= $tasks_task;
		}
		$task = $newtask;
		
		if ($task['taskid'])
		{
			$task['script'] = htmlspecialchars($task['script']);
			$task['nextrun'] = time_adjust($task['nextrun'], $style['log_date_format']);
			adminlog("Edited scheduled task - <b>$task[name] ($task[taskid])</b>");
			eval(get_template('edit_task'));
		}
		else
			eval(get_template('invalid_task'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($_POST['run_now'])
			die(header("Location: tasks.php?op=run&id=$_POST[id]"));
		if (($name = trim(htmlspecialchars($_POST['name']))) && $_POST['script'])
		{
			if ($task = db_fetch_array(db_query("select * from task where taskid='$_POST[id]'")))
			{
				if ($duplicate = db_fetch_array(db_query("select * from task where taskid!=$task[taskid] and name='$name'")))
					eval(get_template('tasks_duplicate'));
				else
				{
					$minute = $_POST['minute'];
					if (strtolower($minute)=='any')
						$minute = -1;
					$hour = $_POST['hour'];
					if (strtolower($hour)=='any')
						$hour = -1;
					$day = $_POST['day'];
					if (strtolower($day)=='any')
						$day = -1;
					
					if ($hour<-1 || $hour>23 || ($day!=-1 && ($day<1 || $day>31)) || $minute<-1 || $minute>59 || $_POST['dayofweek']<-1 || $_POST['dayofweek']>6)
						eval(get_template('tasks_range'));
					else
					{
						adminlog("Updated scheduled task - <b>$task[name] ($task[taskid])</b>");
						$nextrun = get_next_timestamp($minute, $hour, $day, $_POST['dayofweek']);
						$description = trim(htmlspecialchars($_POST['description']));
						$max_load = trim(htmlspecialchars($_POST['max_load']));
						db_query("update task set name='$name',script='$_POST[script]',enabled='$_POST[enabled]',late='$_POST[late]',hour='$hour',minute='$minute',day='$day',dayofweek='$_POST[dayofweek]',log='$_POST[log]',nextrun=$nextrun,max_load='$max_load',description='$description' where taskid=$task[taskid]");
						if ($config['next_task'] > $nextrun)
							db_query("update config set next_task='$nextrun'");
						header('Location: tasks.php');
					}
				}
			}
			else
				eval(get_template('invalid_task'));
		}
		else
			eval(get_template('tasks_missing'));
	}
	elseif ($_REQUEST['op']=='delete')
	{
		if ($task = db_fetch_array(db_query("select * from task where taskid='$_REQUEST[id]'")))
			eval(get_template('delete_task'));
		else
			eval(get_template('invalid_task'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($task = db_fetch_array(db_query("select * from task where taskid='$_POST[id]'")))
		{
			adminlog("Deleted scheduled task - <b>$task[name] ($task[taskid])</b>");
			db_query("delete from task where taskid=$task[taskid]");
			header('Location: tasks.php');
		}
		else
			eval(get_template('invalid_task'));
	}
	elseif ($_REQUEST['op']=='log')
	{
		adminlog('Viewed scheduled tasks log');
		$pagecount = db_fetch_array(db_query('select count(*) from tasklog'));
		$page = $_REQUEST['page'];
		if (!is_numeric($page))
			$page = 1;
		$query = db_query('select * from tasklog order by taskid desc limit '.($config['log_per_page']*($page-1)).",$config[log_per_page]");
		$numpages = ceil($pagecount[0]/$config['log_per_page']);
		$tasklog_pagenav = build_pagenav('tasks', $page, $numpages, $config['numlinks_log'], 'op=log');
		$color = 'cellalt';
		$logs = '';
		while ($tasklog = db_fetch_array($query))
		{
			$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
			$tasklog['logdate'] = time_adjust($tasklog['logdate'], $style['log_date_format']);
			eval(store_template('tasks_log'));
			$logs .= $tasks_log;
		}
		eval(get_template('tasks_show_log'));
	}
	elseif ($_REQUEST['op']=='prunelog')
		eval(get_template('prune_task_log'));
	elseif ($_POST['op']=='doprunelog')
	{
		db_query('truncate table tasklog');
		header('Location: tasks.php');
	}
	elseif ($_REQUEST['op']=='run')
	{
		if ($task = db_fetch_array(db_query("select * from task where taskid='$_REQUEST[id]'")))
			eval(get_template('run_task'));
		else
			eval(get_template('invalid_task'));
	}
	elseif ($_POST['op']=='dorun')
	{
		if ($task = db_fetch_array(db_query("select * from task where taskid='$_POST[id]'")))
		{
			db_query("update task set nextrun=$current_time where taskid=$task[taskid]");
			db_query("update config set next_task=$current_time");
			adminlog("Manually started scheduled task - <b>$task[name] ($task[taskid])</b>");
			$redirect_url = 'tasks.php';
			eval(get_template('run_task_redirect'));
		}
		else
			eval(get_template('invalid_task'));
	}
	else
	{
		$query = db_query('select * from task order by name asc');
		$tasks = '';
		while ($task = db_fetch_array($query))
		{
			eval(store_template('tasks_task'));
			$tasks .= $tasks_task;
		}
		adminlog('Viewed scheduled tasks');
		eval(get_template('tasks_index'));
	}
}
else
	eval(get_template('permission_error'));
?>