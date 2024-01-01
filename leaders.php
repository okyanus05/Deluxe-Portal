<?php
/**************************************************
* Site/Forum Leaders
* ------------------
* Displays moderators, and any groups you have
* elected to show on the page.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'leaders_forum,leaders_group,leaders_index,leaders_moderator,leaders_user';
/**************************************************
* Global variable resetting                      */
unset($forums);
unset($groups);
unset($lastmod);
unset($lastuser);
unset($mods);
unset($users);
/*************************************************/

require('function.php');

$pagetitle = 'Site/Forum Leaders';
$color = 'cellalt';
$lastgroup = '';
$query = db_query("select user.*,groups.name as group_name,groups.online_template_large from user,groups where groups.ordered>0 and FIND_IN_SET(groups.groupid, user.usergroups) order by groups.ordered asc,groups.groupid asc,user.userid asc");
while ($user_result = db_fetch_array($query))
{
	if (!$group_name)
		$group_name = $user_result['group_name'];
	if ($group_name != $user_result['group_name'])
	{
		eval(store_template('leaders_group'));
		$groups .= $leaders_group;
		$group_name = $user_result['group_name'];
		$users = '';
	}
	$isonline = is_online($user_result);
	$showpm = show_pm($user_result);
	$showemail = show_email($user_result);
	eval('$user_result[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($user_result['online_template_large'])).'";');
	$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
	eval(store_template('leaders_user'));
	$users .= $leaders_user;
}
if ($users)
{
	eval(store_template('leaders_group'));
	$groups .= $leaders_group;
}

$query = db_query('select moderator.*,forum.*,user.invisible,user.hide_email,groups.online_template,user.lastactivity,user.pm from moderator,forum,user,groups where moderator.userid=user.userid and moderator.forumid=forum.forumid and user.groupid=groups.groupid group by moderatorid order by moderator.username,forum.name asc');
while ($mod = db_fetch_array($query))
{
	$perm = get_forum_permissions($mod);
	if (!$perm['viewforums'] && $config['hideforums'])
		continue;
	if ($lastmod['userid']==$mod['userid'])
	{
		eval(store_template('leaders_forum', '$forum'));
		$forums .= $forum;
	}
	else
	{
		if ($forums)
		{
			$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
			$user_result['name'] = $lastmod['username'];
			$user_result['userid'] = $lastmod['userid'];
			eval('$lastmod[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($lastmod['online_template'])).'";');
			eval(store_template('leaders_moderator', '$moderator'));
			$mods .= $moderator;
		}
		$lastmod = $mod;
		$forums = '';
		$isonline = is_online($lastmod);
		$showpm = show_pm($lastmod);
		$showemail = show_email($lastmod);
		eval(store_template('leaders_forum', '$forum'));
		$forums = $forum;
	}
}
if ($forums)
{
	$isonline = is_online($lastmod);
	$showpm = show_pm($lastmod);
	$showemail = show_email($lastmod);
	$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
	$user_result['name'] = $lastmod['username'];
	$user_result['userid'] = $lastmod['userid'];
	eval('$lastmod[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($lastmod['online_template'])).'";');
	eval(store_template('leaders_moderator', '$moderator'));
	$mods .= $moderator;
}

eval(get_template('leaders_index'));
?>