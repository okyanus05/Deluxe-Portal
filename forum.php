<?php
/**************************************************
* Forum index
* -----------
* Displays the forums and Who's Online list.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'forum_forum,forum_forum_parent,forum_forum_parent_canpost,forum_forum_subforum,forum_index,forum_online_user,forum_pm_message,moderator';
/**************************************************
* Global variable resetting                      */
unset($accessible);
unset($forums);
unset($privatemessage_display);
unset($privatemessages);
unset($users);
unset($whos_online);
/*************************************************/

require('function.php');

if ($_REQUEST['op']=='markread')
{
	db_query("update session set lastvisit='$current_time' where sessionid='$_COOKIE[sessionid]'");
	if ($user['userid'])
	{
		db_query("update user set lastvisit='$current_time' where userid=$user[userid]");
		db_query("delete from markread where userid=$user[userid]");
	}
	header('Location: forum.php');
}

$pagetitle = 'Forums';
$newforumposts = false;
function do_forum_list($parentid)
{
	global $newforumposts, $accessible, $forum_usercount, $color, $forum, $forums, $forumstore, $locked, $moderators, $newposts, $totalnewposts;
	foreach ($GLOBALS as $key => $value)
		$$key = $value;
	static $first = true;
	$i=0;
	while ($forum = $forumstore[$i++])
	{
		if (!$forum['ordered'])
		{
			$accessible++;
			continue;
		}
		if ($forum['parentid']!=$parentid)
			continue;
		$perm = get_forum_permissions($forum);
		if (!$perm['viewforums'] && $config['hideforums'])
			continue;
		$accessible++;
		$moderators = '';
		$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
		
		$forum['lastpost'] = $forum['lastpostdate'];
		if ($forum['lastpostdate'])
			$forum['lastpostdate'] = time_adjust($forum['lastpostdate'], $style['lastpost_date_format']);
		if ($config['markread'] && $user['markread'] && $config['markforumread'])
		{
			if ($markforumreadstore[$forum['forumid']])
				$newposts = true;
			else
			{
				$newposts = false;
				if ($frmarray = get_forums($forum['forumid']))
				{
					foreach ($frmarray as $subfrm)
					{
						if ($markforumreadstore[$subfrm['forumid']])
						{
							$newposts = true;
							break;
						}
					}
				}
			}
		}
		else
		{
			if ($user['lastvisit']<$forum['lastpost'])
				$newposts = true;
			else
				$newposts = false;
		}
		if ($newposts)
			$totalnewposts = true;
		if ($newposts && $_COOKIE['dp_settings'])
			setcookie('dp_settings',0,time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		
		if ($moderatorstore)
		{
			$r = 0;
			while ($moderator = $moderatorstore[$forum['forumid']][$r++])
			{
				$user_result['name'] = $moderator['username'];
				$user_result['userid'] = $moderator['userid'];
				eval('$moderator[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($moderator['online_template'])).'";');
				eval(store_template('moderator', '$moderator_result'));
				$moderators .= $moderator_result;
			}
		}
		
		if (!$perm['viewforums'])
			$locked = true;
		else
			$locked = false;
		
		$forum['usersonline'] = isset($forum_usercount[$forum['forumid']]) ? $forum_usercount[$forum['forumid']] : '';
		$forum['posts'] = number_format($forum['posts'], 0, '.', $style['separator']);
		$forum['threads'] = number_format($forum['threads'], 0, '.', $style['separator']);

		$subforums = '';
		if ($config['show_subforums'])
		{				
			if ($subforumarray = get_forums($forum['forumid'], 0, 1))
			{
				foreach ($subforumarray as $subforumkey => $subforum)
				{
					$subperm = get_forum_permissions($subforum);
					if ($subperm['viewforums'] || !$config['hideforums'])
					{
						eval(store_template('forum_forum_subforum'));
						$subforums .= $forum_forum_subforum;
					}
				}
			}
		}
		
		$threadperm = $perm;
		if ($forum['lastforumid']!=$forum['forumid'])
			$threadperm = get_forum_permissions($forumstoreid[$forum['lastforumid']]);
		ob_start();
			if (!$forum['parentid'] && $forum['allow_posting'])
				eval(get_template('forum_forum_parent_canpost'));
			elseif (!$forum['parentid'] && !$forum['allow_posting'])
				eval(get_template('forum_forum_parent'));
			else
				eval(get_template('forum_forum'));
			$forum_result = ob_get_contents();
		ob_end_clean();
		$forums .= $forum_result;
		$first = false;
		if ($newposts)
			$newforumposts = true;
		if (!$forum['parentid'] && ($perm['viewforums'] || !$config['hideforums']))
			do_forum_list($forum['forumid']);
	}
}

$forum_usercount = array();
if ($config['whos_online'])
{
	$config['most_online_date'] = time_adjust($config['most_online_date'], $style['most_online_date_format']);
	$timeout = $current_time-($config['online_timeout']*60);
	$num_guests_online_result = db_fetch_array(db_query("select COUNT(DISTINCT ip) from session where userid=0 and lastactivity>=$timeout"));
	$num_guests_online = $num_guests_online_result[0];
	$query = db_query("select session.forumids,user.*,groups.online_template from session,user,groups where user.groupid=groups.groupid and session.userid>0 and session.userid=user.userid and session.lastactivity>=$timeout group by userid,lastactivity order by name asc,lastactivity desc");
	$found_users = array();
	while ($user_result = db_fetch_array($query))
	{
		if (!isset($found_users[$user_result['userid']]))
		{
			$found_users[$user_result['userid']] = 1;
			if (!($user_result['invisible'] && !$group['users'] && !$group['supermod_viewfullprofiles'] && $user['userid']!=$user_result['userid']))
			{
				eval('$parsed_name = "' . str_replace('"', '\\"', $user_result['online_template']) . '";');
				eval(store_template('forum_online_user'));
				$users .= $forum_online_user;
			}
			if ($config['browsingforum'])
			{
				$user_result['forumids'] = explode(',', $user_result['forumids']);
				foreach ($user_result['forumids'] as $user_result['forumid'])
				{

					if ($user_result['forumid'])
					{
						$subperm = get_forum_permissions($user_result['forumid']);
						if ($subperm['veiwforums'])
						{
							if (!isset($forum_usercount[$user_result['forumid']]))
								$forum_usercount[$user_result['forumid']] = 1;
							else
								$forum_usercount[$user_result['forumid']]++;
						}
					}
				}
			}
		}
	}
	$num_users_online = count($found_users);
	$total_online = $num_guests_online + $num_users_online;
	if ($config['most_online'] < $total_online)
		db_query("update config set most_online=$total_online,most_online_date=$current_time");
}

$num_threads = 0;
$num_posts = 0;
$color = 'cellalt';
if ($config['show_moderators'])
	get_moderator_store();
get_forum_store();
if ($forumstore)
{
	foreach ($forumstore as $forum_result)
	{
		if (!$forum_result['parentid'])
		{
			$num_threads += $forum_result['threads'];
			$num_posts += $forum_result['posts'];
		}
	}
	reset($forumstore);
}
$num_threads = number_format($num_threads, 0, '.', $style['separator']);
$num_posts = number_format($num_posts, 0, '.', $style['separator']);
$config['stat_members'] = number_format($config['stat_members'], 0, '.', $style['separator']);
if ($config['markread'] && $user['markread'] && $config['markforumread'])
	get_markforumread_store();
$totalnewposts = false;
do_forum_list(0);

if (!$accessible && count($forumstore))
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}

if ($group['privatemessaging'] && $user['pm'])
{
	if ($user['num_pm'])
	{
		$pmquery = db_query("select * from privatemessage where userid=$user[userid] and folder='inbox' and isread=0 order by sentdate desc");
		$num_pm = db_num_rows($pmquery);
		while ($pm = db_fetch_array($pmquery))
		{
			$pm['sentdate'] = time_adjust($pm['sentdate'], $style['lastpost_date_format']);
			eval(store_template('forum_pm_message'));
			$privatemessages .= $forum_pm_message;
		}
	}
}

if ($config['markread'] && $user['markread'] && $config['markforumread'] && !$totalnewposts && !$_COOKIE['dp_settings'])
{
	db_query("delete from markread where userid=$user[userid]");
	db_query("update user set lastvisit=".mktime()." where userid=$user[userid]");
	setcookie('dp_settings',1,time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
}

eval('$config[description] = "' . str_replace('\\\'', '\'', addslashes($config['description'])) . '";');
eval(get_template('forum_index'));
?>