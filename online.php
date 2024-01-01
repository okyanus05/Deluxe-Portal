<?php
/**************************************************
* Who's Online
* ------------
* Shows a list of users and guests who are
* currently online, as well as what they're doing.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'online_index,online_user';
/**************************************************
* Global variable resetting                      */
unset($list);
unset($nextpage);
unset($online_pagenav);
unset($onlinestore);
unset($pagenav);
unset($prevpage);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$page = $_REQUEST['page'];
/*************************************************/

if ($group['whos_online'])
{
	$pagetitle = 'Who\'s Online';
	if (!is_numeric($page))
		$page = 1;
	$i = 0;
	$timeout = $current_time-($config['online_timeout']*60);
	if ($_REQUEST['userids'])
	{
		$userids = explode(',', $_REQUEST['userids']);
		foreach ($userids as $userid)
		{
			$userid = (int) $userid;
			if ($userid)
			{
				if (isset($userid_query))
					$userid_query .= " or session.userid=$userid";
				else
					$userid_query = "session.userid=$userid";
			}
		}
		$userid_query = "and ($userid_query)";
	}
	else
		$userid_query = '';

	$query = db_query("select session.*,user.name,user.invisible,groups.online_template_large,user.pm,user.hide_email from session,user,groups where session.lastactivity>=$timeout and session.userid>0 $userid_query and user.groupid=groups.groupid and session.userid=user.userid group by userid,lastactivity order by name asc, lastactivity desc");
	$userids = ',';
	while ($online = db_fetch_array($query))
	{
		if (strstr($userids, ",$online[userid],"))
			continue;
		$userids .= "$online[userid],";
		$onlinestore[$i++] = $online;
	}
	if ($config['showguests'] && !$_REQUEST['userids'])
	{
		$query = db_query("select DISTINCT ip,url,lastactivity,sessionid,useragent from session where userid=0 and lastactivity>=$timeout order by lastactivity desc");
		$guests = ',';
		while ($online = db_fetch_array($query))
		{
			if (strstr($guests, ",$online[ip],"))
				continue;
			$guests .= "$online[ip],";
			$onlinestore[$i++] = $online;
		}
	}
	$page--;
	$n=$page*$config['online_per_page'];
	$page++;
	$numpages = ceil($i/$config['online_per_page']);
	$online_pagenav = build_pagenav('online', $page, $numpages, $config['numlinks_online']);
	
	$color = 'cellalt';
	$i = 0;
	$z = $n;
	$threadquery = '';
	$postquery = '';
	$articlequery = '';
	while ($online = $onlinestore[$n++])
	{
		if ($i++<$config['online_per_page'])
		{
			if ($online['invisible'] && !$group['users'] && !$group['supermod_viewfullprofiles'] && $user['userid']!=$online['userid'])
				continue;
			if (stristr($online['url'], 'thread.php') || stristr($online['url'], 'reply.php') || stristr($online['url'], 'replies.php'))
			{
				if (preg_match('/postid=([0-9]+)/', $online['url'], $match))
					$postquery .= "post.postid='$match[1]' or ";
				elseif (preg_match('/id=([0-9]+)/', $online['url'], $match))
					$threadquery .= "threadid='$match[1]' or ";
			}
			if (stristr($online['url'], 'attachment.php'))
			{
				if (preg_match('/id=([0-9]+)/', $online['url'], $match))
					$postquery .= "post.postid='$match[1]' or ";
			}
			if (stristr($online['url'], 'article.php'))
			{
				if (preg_match('/id=([0-9]+)/', $online['url'], $match))
					$articlequery .= "articleid='$match[1]' or ";
			}
		}
		else
			break;
	}
	if ($postquery)
	{
		$query = db_query('select post.postid,thread.forumid,thread.name from thread,post where post.threadid=thread.threadid and ('.dp_substr($postquery, 0, -4).')');
		while ($thread_result = db_fetch_array($query))
			$poststore[$thread_result['postid']]=$thread_result;
	}
	if ($threadquery)
	{
		$query = db_query('select threadid,forumid,name from thread where '.dp_substr($threadquery, 0, -4));
		while ($thread_result = db_fetch_array($query))
			$threadstore[$thread_result['threadid']]=$thread_result;
	}
	if ($articlequery)
	{
		$query = db_query('select articleid,topicid,sectionid,title from article where '.dp_substr($articlequery, 0, -4));
		while ($article = db_fetch_array($query))
			$articlestore[$article['articleid']]=$article;
	}
	$n = $z;
	$i = 0;	
	$names = explode("\n", $config['spider_names']);
	$agents = explode("\n", $config['spider_agents']);
	while ($online = $onlinestore[$n++])
	{
		if ($i++<$config['online_per_page'])
		{
			if ($online['invisible'] && !$group['users'] && !$group['supermod_viewfullprofiles'] && $user['userid']!=$online['userid'])
				continue;
			$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
			if (!$online['userid'])
			{
				$guest = 'Guest';
				if ($config['showspiders'])
				{
					for ($r = 0; $r < count($agents); $r++)
					{
						if (stristr($online['useragent'], trim($agents[$r])))
						{
							$guest = $names[$r];
							break;
						}
					}
				}
			}
			$user_result['name'] = $online['name'];
			$user_result['userid'] = $online['userid'];
			eval('$online[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($online['online_template_large'])).'";');
			$online['lastactivity'] = time_adjust($online['lastactivity'], $style['log_date_format']);
			$online['activity'] = online_parse($online['url']);
			$showemail = show_email($online);
			$showpm = show_pm($online);
			eval(store_template('online_user'));
			$list .= $online_user;
		}
		else
			break;
	}
	eval(get_template('online_index'));
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>