<?php
/**************************************************
* Group Changer Rule Manager
* --------------------------
* Runs all group changer rules.
* 
* Deluxe Portal Version 2.0
**************************************************/

if (!defined('DP_CRON'))
	die('This script can only be run from Deluxe Portal.');
$DP_TASK = true;

$runcount = 0;

$query = db_query('select * from changergroups');
while ($group_result = db_fetch_array($query))
{
	if ($group_result['ingroup'])
		$changer[$group_result['groupruleid']]['in'] .= ($changer[$group_result['groupruleid']]['in'] ? ' or ' : '')."FIND_IN_SET($group_result[groupid], usergroups)";
	if ($group_result['addgroup'])
	{
		$changer[$group_result['groupruleid']]['add'] .= ($changer[$group_result['groupruleid']]['add'] ? ' and ' : '')."FIND_IN_SET($group_result[groupid], usergroups)";
		$changer[$group_result['groupruleid']]['addlist'] .= ($changer[$group_result['groupruleid']]['addlist'] ? ',' : '').$group_result['groupid'];
	}
	if ($group_result['removegroup'])
	{
		$changer[$group_result['groupruleid']]['remove'] .= ($changer[$group_result['groupruleid']]['remove'] ? ' or ' : '')."FIND_IN_SET($group_result[groupid], usergroups)";
		$changer[$group_result['groupruleid']]['removelist'] .= ($changer[$group_result['groupruleid']]['removelist'] ? ',' : '').$group_result['groupid'];
	}		
}

$query = db_query('select * from grouprule');
while ($rule = db_fetch_array($query))
{
	if (!$changer[$rule['groupruleid']]['in'])
		continue;
	$runquery = 'select userid,groupid,usergroups from user where lastactivity>='.(mktime() - 3600).' and (joindate<='.(mktime() - $rule['days']*86400)." $rule[and_or] posts";
	if ($rule['post_condition']=='reaches')
		$runquery .= '>=';
	else
		$runquery .= '<';
	$runquery .= "$rule[posts]) and (".$changer[$rule['groupruleid']]['in'].')';
	if ($rule['groupid'] || $changer[$rule['groupruleid']]['add'] || $changer[$rule['groupruleid']]['remove'])
		$runquery .= " and (";
	if ($rule['groupid'])
		$runquery .= "user.groupid!=$rule[groupid] or ";
	if ($changer[$rule['groupruleid']]['add'])
		$runquery .= '!('.$changer[$rule['groupruleid']]['add'].') or ';
	if ($changer[$rule['groupruleid']]['remove'])
		$runquery .= '('.$changer[$rule['groupruleid']]['remove'].') or ';
	if ($rule['groupid'] || $changer[$rule['groupruleid']]['add'] || $changer[$rule['groupruleid']]['remove'])
		$runquery = substr($runquery, 0, -4).")";
	$runquery .= ' group by userid';
	$query2 = db_query($runquery);
	while ($user_result = db_fetch_array($query2))
	{
		$usergroups = explode(',', $user_result['usergroups']);
		if ($rule['groupid'] && $user_result['groupid']!=$rule['groupid'])
		{
			db_query("update user set groupid=$rule[groupid] where userid=$user_result[userid]");
			if (!in_array($rule['groupid'], $usergroups))
				$usergroups[] = $rule['groupid'];
			if (!$rule['dont_remove'])
				unset($usergroups[array_search($user_result['groupid'], $usergroups)]);
		}
		if ($changer[$rule['groupruleid']]['addlist'])
		{
			$add = explode(',', $changer[$rule['groupruleid']]['addlist']);
			foreach ($add as $group_result)
			{
				if (!in_array($group_result, $usergroups))
					$usergroups[] = $group_result;
			}
		}
		if ($changer[$rule['groupruleid']]['remove'])
		{
			$remove = explode(',', $changer[$rule['groupruleid']]['removelist']);
			foreach ($remove as $group_result)
				unset($usergroups[array_search($group_result, $usergroups)]);
		}
		db_query("update user set usergroups='".implode(',', $usergroups)."' where userid=$user_result[userid]");
		$runcount++;
	}
}

if ($runcount)
	task_log($task, "$runcount user".($runcount==1 ? '' : 's').' processed.');
else
	task_log($task, 'No users processed.');
?>