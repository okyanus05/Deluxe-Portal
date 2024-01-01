<?php
/**************************************************
* Forum display
* -------------
* Displays a particular forum and the posts in it.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'forumdisplay_forum_subforum,forumdisplay_announcement,forumdisplay_forum,forumdisplay_index,forumdisplay_multipage_last,forumdisplay_multipage_link,forumdisplay_thread,forumdisplay_thread_ignored,forumdisplay_thread_redirect,forum_online_user,hot_icons,invalid_forum,moderator,new_posts,new_posts_closed,new_posts_closed_hot,new_posts_hot,no_new_posts,no_new_posts_closed,no_new_posts_closed_hot,no_new_posts_hot';
/**************************************************
* Global variable resetting                      */
unset($doticon);
unset($forum_pagenav);
unset($forumdisplay_thread_ignore);
unset($hot_icons);
unset($isread);
unset($moderators);
unset($multipage);
unset($multipage_nav);
unset($newposts);
unset($nextpage);
unset($pagenav);
unset($prevpage);
unset($subforums);
unset($threads);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$order = $_REQUEST['order'];
$page = $_REQUEST['page'];
$sort = $_REQUEST['sort'];
/*************************************************/

function do_forum_list($parentid)
{
	global $ex, $forum_usercount, $color, $config, $forum, $forums, $forumstore, $locked, $markforumreadstore, $moderators, $moderatorstore, $newposts, $style, $subforum, $subforums, $user;
	$i = 0;
	while ($subforum = $forumstore[$i++])
	{
		$subforum['usercount'] = isset($forum_usercount[$subforum['forumid']]) ? $forum_usercount[$subforum['forumid']] : 0;
		if (!$subforum['ordered'] && $subforum['forumid']!=$forum['forumid'])
			continue;
		if ($subforum['parentid']!=$parentid)
			continue;
		$perm = get_forum_permissions($subforum);
		if (!$perm['viewforums'] && $config['hideforums'])
			continue;
		$moderators = '';
		$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
		
		$subforum['lastpost'] = $subforum['lastpostdate'];
		if ($subforum['lastpostdate'])
			$subforum['lastpostdate'] = time_adjust($subforum['lastpostdate'], $style['lastpost_date_format']);
		if ($user['lastvisit']<$subforum['lastpost'])
			$newposts = true;
		else
			$newposts = false;
		if ($config['markread'] && $user['markread'] && $config['markforumread'])
		{
			get_markforumread_store();
			if ($markforumreadstore[$subforum['forumid']])
				$newposts = true;
			else
				$newposts = false;
		}
		else
		{
			if ($user['lastvisit']<$subforum['lastpost'])
				$newposts = true;
			else
			{
				$newposts = false;
				if ($frmarray = get_forums($subforum['forumid']))
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
		
		if ($config['show_moderators'] && $moderatorstore)
		{
			$r = 0;
			while ($moderator = $moderatorstore[$subforum['forumid']][$r++])
			{
				$user_result['name'] = $moderator['username'];
				$user_result['userid'] = $moderator['userid'];
				eval('$moderator[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($moderator['online_template'])).'";');
				eval(store_template('moderator', '$moderator_result'));
				$moderators .= $moderator_result;
			}
		}
		
		$subforum['posts'] = number_format($subforum['posts'], 0, '.', $style['separator']);
		$subforum['threads'] = number_format($subforum['threads'], 0, '.', $style['separator']);
		if (!$perm['viewforums'])
			$locked = true;
		else
			$locked = false;

		$subsubforums = '';
		if ($config['show_subforums'])
		{				
			if ($subforumarray = get_forums($subforum['forumid'], 0, 1))
			{
				foreach ($subforumarray as $subsubforum)
				{
					$subperm = get_forum_permissions($subsubforum);
					if ($subperm['viewforums'] || !$config['hideforums'])
					{
						eval(store_template('forumdisplay_forum_subforum'));
						$subsubforums .= $forumdisplay_forum_subforum;
					}
				}
			}
		}

		$threadperm = $perm;
		if ($subforum['lastforumid']!=$subforum['forumid'])
			$threadperm = get_forum_permissions($forumstoreid[$subforum['lastforumid']]);
		eval(store_template('forumdisplay_forum', '$forum_result'));
		$subforums .= $forum_result;
		if (!$subforum['parentid'] && ($perm['viewforums'] || !$config['hideforums']))
		do_forum_list($subforum['forumid']);
	}
}

if ($config['whos_online'] && $config['browsingforum'])
{
	if ($user['userid'])
	{
		$currentuser_forumids = '';
		if ($forum_parents = get_forum_parents($id))
		{
			foreach ($forum_parents as $forum_forum)
				$currentuser_forumids .= addslashes("$forum_forum[forumid],");
			db_query("update session set forumids='$currentuser_forumids' where sessionid='$_COOKIE[sessionid]'");
		}
	}

	$timeout = $current_time-($config['online_timeout']*60);
	$query = db_query("select viewthreadid,forumids,userid,lastactivity from session where forumids<>'' and userid>0 and lastactivity>=$timeout group by userid order by lastactivity desc");
	$found_users = array();
	$forum_usercount = array();
	while ($browsing_user = db_fetch_array($query))
	{
		$browsing_user['forumids'] = explode(',', $browsing_user['forumids']);
		foreach ($browsing_user['forumids'] as $browsing_user['forumid'])
		{
			if ($browsing_user['forumid'])
			{
				if (!isset($forum_usercount[$browsing_user['forumid']]))
					$forum_usercount[$browsing_user['forumid']] = 1;
				else
					$forum_usercount[$browsing_user['forumid']]++;
			}
		}
		if (isset($found_users[$browsing_user['viewthreadid']]))
		{
			$found_users[$browsing_user['viewthreadid']]['count']++;
			$found_users[$browsing_user['viewthreadid']]['userids'] .= ",$browsing_user[userid]";
		}
		else
		{
			$found_users[$browsing_user['viewthreadid']]['count'] = 1;
			$found_users[$browsing_user['viewthreadid']]['userids'] = $browsing_user['userid'];
		}
	}
}

$announcementquery = 'forumid=0';
if ($forumarray = get_forum_parents($id))
{
	$forumarray = array_reverse($forumarray);
	foreach ($forumarray as $forumextra => $forumnav)
		$announcementquery .= " or forumid=$forumnav[forumid]";
}

if (!$forum = get_forum_nav($id, false))
{
	$pagetitle = 'Invalid forum';
	die(eval(get_template('invalid_forum')));
}

get_forum_jump($forum['forumid']);

$perm = get_forum_permissions($forum);
if (!$perm['viewforums'])
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}

if ($forum['link'])
	die(header("Location: $forum[link]"));

$pagetitle = $forum['name'];
$color = 'cellalt';
get_moderator_store();
do_forum_list($forum['forumid']);

if (!is_numeric($page))
	$page = 1;
if ($order!='asc' && $order!='desc')
	$order = 'desc';
if ($sort!='name' && $sort!='username' && $sort!='posts' && $sort!='views' && $sort!='lastpostdate')
	$sort = 'lastpostdate';
if ($config['doticons'] && $user['userid'])
	$query = db_query("select thread.*,icon.image,icon.name as icon_name,ignorelist.ignoreuserid,post.userid as doticon,markread.postid as markread_postid from thread left join ignorelist on ignorelist.userid=$user[userid] and ignorelist.ignoreuserid=thread.userid left join icon on thread.iconid=icon.iconid left join post on post.userid=$user[userid] and post.threadid=thread.threadid left join markread on markread.threadid=thread.threadid and markread.userid=$user[userid] where forumid='$forum[forumid]' group by threadid order by sticky desc,$sort $order limit ".($config['threads_per_page']*($page-1)).','.$config['threads_per_page']);
else
	$query = db_query("select thread.*,icon.image,icon.name as icon_name,ignorelist.ignoreuserid,markread.postid as markread_postid from thread left join ignorelist on ignorelist.userid=$user[userid] and ignorelist.ignoreuserid=thread.userid left join icon on thread.iconid=icon.iconid left join markread on markread.threadid=thread.threadid and markread.userid=$user[userid] where forumid='$forum[forumid]' order by sticky desc,$sort $order limit ".($config['threads_per_page']*($page-1)).','.$config['threads_per_page']);
$forumarray = get_forums($forum['forumid']);
$i = 0;
while ($subforum = $forumarray[$i++])
	$forum['threads'] -= $subforum['threads'];
$numpages = ceil($forum['threads']/$config['threads_per_page']);
$forum_pagenav = build_pagenav('forum_display', $page, $numpages, $config['numlinks_threadnav'], "id=$forum[forumid]&amp;sort=$sort&amp;order=$order");

$showthreads = false;
$announcement_display = '';
$announcement = db_fetch_array(db_query("select * from announcement where announcement.start<=$current_time and announcement.end>=$current_time and ($announcementquery) order by start desc,announcementid desc limit 1"));
if ($announcement)
{
	$showthreads = true;
	$announcement['start'] = time_adjust($announcement['start'], $style['announcement_date_format']);
	eval(store_template('forumdisplay_announcement', '$announcement_display'));
}

while ($thread = db_fetch_array($query))
{
	$showthreads = true;
	$thread['name'] = censor($thread['name'], $config['censored_words']);
	$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
	if (isset($found_users[$thread['threadid']]))
	{
		$thread['usercount'] = $found_users[$thread['threadid']]['count'];
		$thread['userids'] = $found_users[$thread['threadid']]['userids'];
	}
	else
		$thread['usercount'] = 0;
	
	if ($thread['ignoreuserid'])
	{
		if ($thread['redirect'])
			$forumdisplay_thread_ignore = '';
		else
			eval(store_template('forumdisplay_thread_ignored'));
		$threads .= $forumdisplay_thread_ignored;
	}
	else
	{
		if ($thread['poll'])
			$thread['iconid'] = 0;
		else
		{
			if ($thread['iconid'])
				$thread['image'] = parse_image($thread['image']);
		}
		$thread['lastpost'] = $thread['lastpostdate'];
		$thread['lastpostdate'] = time_adjust($thread['lastpostdate'], $style['lastpost_date_format']);
		if ($thread['redirect'])
			eval(store_template('forumdisplay_thread_redirect', '$forumdisplay_thread'));
		else
		{
			if ($user['lastvisit']<$thread['lastpost'])
				$newposts = true;
			else
				$newposts = false;
			if ($config['markread'] && $user['markread'])
			{
				$markread = $markreadstore[$thread['threadid']];
				if ($newposts && $thread['markread_postid']<$thread['lastpostid'])
					$newposts = true;
				else
					$newposts = false;
			}
			if ($config['doticons'] && $thread['doticon'])
				$doticon = true;
			else
				$doticon = false;
			ob_start();
				if ($thread['closed'])
				{
					if ($thread['posts'] >= $config['min_posts_hot'] || $thread['views'] >= $config['min_views_hot'])
					{
						if ($newposts)
							eval(get_template('new_posts_closed_hot'));
						else
							eval(get_template('no_new_posts_closed_hot'));
					}
					else
					{
						if ($newposts)
							eval(get_template('new_posts_closed'));
						else
							eval(get_template('no_new_posts_closed'));
					}
				}
				else
				{
					if ($thread['posts'] >= $config['min_posts_hot'] || $thread['views'] >= $config['min_views_hot'])
					{
						if ($newposts)
							eval(get_template('new_posts_hot'));
						else
							eval(get_template('no_new_posts_hot'));
					}
					else
					{
						if ($newposts)
							eval(get_template('new_posts'));
						else
							eval(get_template('no_new_posts'));
					}
				}
				$isread = ob_get_contents();
			ob_end_clean();
			
			$thread['replies'] = $thread['posts'] - 1;
			
			$numpages = ceil($thread['posts']/$config['posts_per_page']);
			if ($config['numlinks_multipage'] && $numpages>1)
			{
				for ($thread_page=1; $thread_page<=$config['numlinks_multipage']; $thread_page++)
				{
					if ($thread_page > $numpages)
						break;
					else
					{
						eval(store_template('forumdisplay_multipage_link'));
						$multipage_nav .= $forumdisplay_multipage_link;
					}
				}
				if ($numpages > $config['numlinks_multipage'])
				{
					eval(store_template('forumdisplay_multipage_last'));
					$multipage_nav .= $forumdisplay_multipage_last;
				}
			}
			$thread['replies'] = number_format($thread['replies'], 0, '.', $style['separator']);
			$thread['views'] = number_format($thread['views'], 0, '.', $style['separator']);
			
			eval(store_template('forumdisplay_thread'));
			$multipage_nav = '';
		}
		$threads .= $forumdisplay_thread;
		$multipage = '';
	}
}
if ($threads && ($config['min_posts_hot'] || $config['min_views_hot']))
	eval(store_template('hot_icons'));

$moderators = '';
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

$shownewthread = ($forum['allow_posting'] && $threads ? 1 : 0);

$users = '';
if ($config['whos_online'] && $config['browsingforum'])
{
	$timeout = $current_time-($config['online_timeout']*60);
	$query = db_query("select DISTINCT user.*,groups.online_template,session.forumids from user,groups,session where session.userid>0 and session.forumids like '$forum[forumid],%' and session.lastactivity>=$timeout and session.userid=user.userid and user.groupid=groups.groupid order by user.name asc");
	while ($user_result = db_fetch_array($query))
	{
		if (!($user_result['invisible'] && !$group['users'] && !$group['supermod_viewfullprofiles'] && $user['userid']!=$user_result['userid']))
		{
			eval('$parsed_name = "' . str_replace("\\'", "'", addslashes($user_result['online_template'])) . '";');
			eval(store_template('forum_online_user'));
			$users .= $forum_online_user;
		}
	}
}

eval(get_template('forumdisplay_index'));
?>