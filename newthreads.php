<?php
/**************************************************
* View New Threads
* ----------------
* Shows a list of unread threads.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'forumdisplay_multipage_last,forumdisplay_multipage_link,hot_icons,newthreads_index,newthreads_thread,new_posts,new_posts_closed,new_posts_closed_hot,new_posts_hot';
/**************************************************
* Global variable resetting                      */
unset($hot_icons);
unset($markreadstore);
unset($multipage);
unset($multipage_nav);
unset($nextpage);
unset($pagenav);
unset($prevpage);
unset($threads);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$page = $_REQUEST['page'];
/*************************************************/

$pagetitle = 'View New Threads';

get_forum_store();
$color = 'cellalt';
if (!is_numeric($page))
	$page = 1;

if ($config['doticons'] && $user['userid'])
	$query = db_query("select thread.*,post.userid as doticon,icon.image,icon.name as icon_name,markread.postid as markread_postid,ignorelist.ignoreuserid from thread left join ignorelist on ignorelist.userid=$user[userid] and ignorelist.ignoreuserid=thread.userid left join icon on icon.iconid=thread.iconid left join post on thread.threadid=post.threadid and post.userid=$user[userid] left join markread on markread.threadid=thread.threadid and markread.userid=$user[userid] where redirect=0 and lastpostdate>'$user[lastvisit]' group by threadid order by lastpostdate desc");
elseif ($user['userid'])
	$query = db_query("select thread.*,icon.image,icon.name as icon_name,markread.postid as markread_postid,ignorelist.ignoreuserid from thread left join ignorelist on ignorelist.userid=$user[userid] and ignorelist.ignoreuserid=thread.userid left join icon on icon.iconid=thread.iconid left join markread on markread.threadid=thread.threadid and markread.userid=$user[userid] where redirect=0 and lastpostdate>'$user[lastvisit]' order by lastpostdate desc");
else
	$query = db_query("select thread.*,icon.image,icon.name as icon_name,markread.postid as markread_postid from thread left join icon on icon.iconid=thread.iconid left join markread on markread.threadid=thread.threadid and markread.userid=$user[userid] where redirect=0 and lastpostdate>'$user[lastvisit]' order by lastpostdate desc");
$i = 0;
while ($thread = db_fetch_array($query))
{
	$forum = $forumstoreid[$thread['forumid']];
	$perm = get_forum_permissions($forum);
	if (!$perm['viewthreads'])
		continue;
	if ($thread['ignoreuserid'])
		continue;
	
	$forum['lastpost'] = $forum['lastpostdate'];
	if ($forum['lastpostdate'])
		$forum['lastpostdate'] = time_adjust($forum['lastpostdate'], $style['lastpost_date_format']);
	$newposts = true;
	if ($config['markread'] && $user['markread'])
	{
		if ($thread['markread_postid']<$thread['lastpostid'])
			$newposts = true;
		else
			$newposts = false;
	}
	if (!$newposts)
		continue;
	$threadstore[$i] = $thread;
	$threadstore[$i++]['forumname'] = $forum['name'];
}

$thispage = 'newthreads';
$numpages = ceil($i/$config['threads_per_page']);
$page--;
$i = $page*$config['threads_per_page'];
$page++;
$thread_pagenav = build_pagenav('newthreads', $page, $numpages, $config['numlinks_threadnav']);

$n = $i;
$p = 0;
while ($thread = $threadstore[$n++])
{
	if ($p++>=$config['threads_per_page'])
		break;
	$thread['name'] = censor($thread['name'], $config['censored_words']);
	
	if ($config['doticons'] && $thread['doticon'])
		$doticon = true;
	else
		$doticon = false;
	ob_start();
		if ($thread['closed'])
		{
			if ($thread['posts'] >= $config['min_posts_hot'] || $thread['views'] >= $config['min_views_hot'])
				eval(get_template('new_posts_closed_hot'));
			else
				eval(get_template('new_posts_closed'));
		}
		else
		{
			if ($thread['posts'] >= $config['min_posts_hot'] || $thread['views'] >= $config['min_views_hot'])
				eval(get_template('new_posts_hot'));
			else
				eval(get_template('new_posts'));
		}
		$isread = ob_get_contents();
	ob_end_clean();
	
	$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
	$thread['lastpostdate'] = time_adjust($thread['lastpostdate'], $style['lastpost_date_format']);
	$thread['replies'] = $thread['posts'] - 1;
	if ($thread['poll'])
		$thread['iconid'] = 0;
	if ($thread['iconid'])
		$thread['image'] = parse_image($thread['image']);
	if ($config['doticons'] && $thread['doticon'])
		$doticon = true;
	else
		$doticon = false;
	
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
	
	eval(store_template('newthreads_thread', '$thread_result'));
	$multipage_nav = '';
	$threads .= $thread_result;
	$multipage = '';
}
if ($config['min_posts_hot'] || $config['min_views_hot'])
	eval(store_template('hot_icons'));
eval(get_template('newthreads_index'));
?>