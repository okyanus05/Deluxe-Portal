<?php
/**************************************************
* Thread
* ------
* Displays a thread.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'forum_online_user,invalid_thread,poll_result,thread_index,thread_poll_vote,thread_post';
/**************************************************
* Global variable resetting                      */
unset($markread);
unset($moderator_options);
unset($nextpage);
unset($pagenav);
unset($prevpage);
unset($poll);
unset($poll_choices);
unset($post);
unset($posts);
unset($runquery);
unset($thread_pagenav);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$id = (int) $_REQUEST['id'];
$ignore = $_REQUEST['ignore'];
$op = $_REQUEST['op'];
$page = $_REQUEST['page'];
$postid = (int) $_REQUEST['postid'];
/*************************************************/

if ($op=='newpost')
{
	if ($postid)
		$query = db_query("select thread.*,post.postdate from thread,post where thread.redirect=0 and post.threadid=thread.threadid and post.postid='$postid' order by postid asc limit 1");
	else
		$query = db_query("select thread.*,post.postdate from thread,post where thread.redirect=0 and thread.threadid='$id' and post.threadid=thread.threadid order by postid asc limit 1");
	$thread = db_fetch_array($query);
	if ($config['markread'] && $user['markread'])
		$post = db_fetch_array(db_query("select post.postid from post,markread where markread.userid=$user[userid] and markread.threadid='$thread[threadid]' and markread.threadid=post.threadid and post.postid>markread.postid order by postid asc limit 1"));
	$post2 = db_fetch_array(db_query("select postid from post where threadid='$thread[threadid]' and postdate>'$user[lastvisit]' order by postid asc limit 1"));
	if ($post2['postid'] > $post['postid'])
		$post = $post2;
	die(header("Location: thread.php?doredirect=".urlencode("thread.php?postid=$post[postid]#$post[postid]")));
}

if ($postid)
	$query = db_query("select thread.*,post.postdate from thread,post where thread.redirect=0 and post.threadid=thread.threadid and post.postid='$postid' order by postid asc limit 1");
else
	$query = db_query("select thread.*,post.postdate from thread,post where thread.redirect=0 and thread.threadid='$id' and post.threadid=thread.threadid order by postid asc limit 1");
if ($thread = db_fetch_array($query))
{
	$thread['name'] = censor($thread['name'], $config['censored_words']);
	if ($ignore!=1)
		$ignore=0;
	$color = 'cellalt';
	
	db_query("update thread set views=views+1 where threadid=$thread[threadid]");
	$forum = get_forum_store($thread['forumid']);
	$readquery = 'forumid=0';
	if ($forumarray = get_forum_parents($forum['forumid']))
	{
		$forumarray = array_reverse($forumarray);
		while (list($forumextra, $forumnav) = each($forumarray))
			$readquery .= " or forumid=$forumnav[forumid]";
	}
	
	get_forum_nav($forum['forumid'], true);
	$perm = get_forum_permissions($forum);
	if (!$perm['viewthreads'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	get_forum_jump($forum['forumid']);
	
	if ($user['lastvisit'] < $thread['lastpost'])
		$newposts = true;
	else
		$newposts = false;
	if ($postid)
	{
		$postsinfo = db_fetch_array(db_query("select count(*) as numposts from post where postid" . ($config['post_order']=='asc' ? '<' : '>') . "='$postid' and threadid=$thread[threadid]"));
		$page = ceil($postsinfo['numposts'] / $config['posts_per_page']);
	}
	if (!is_numeric($page))
		$page = 1;
	$numpages = ceil($thread['posts'] / $config['posts_per_page']);
	if ($page > $numpages)
		$page = $numpages;
	$query = db_query("select post.*,user.lastactivity,user.signature,user.joindate,user.pm,user.website,user.title,user.groupid,user.posts,user.location,user.avatar,user.invisible,groups.online_template_large,attachment.size,attachment.attachment,attachment.type,attachment.name as attachment_name,icon.image,icon.name as icon_name,ignorelist.ignoreuserid from post left join ignorelist on ignorelist.userid=$user[userid] and ignorelist.ignoreuserid=post.userid left join icon on post.iconid=icon.iconid left join user on post.userid=user.userid left join attachment on post.postid=attachment.postid left join groups on user.groupid=groups.groupid where threadid=$thread[threadid] order by post.postid $config[post_order] limit ".($config['posts_per_page']*($page-1)).','.$config['posts_per_page']);
	
	if ($thread['poll'])
	{
		$color = 'cellalt';
		$bar = 6;
		$showresults = true;
		$message = '';
		$poll_extra = '';
		if (($thread['closed'] && !$group['supermod_close'] && !$moderator['close']) || ($thread['poll_days'] && (mktime()-$thread['postdate'])>($thread['poll_days']*86400)))
			$message = 'closed';
		else
		{
			if (!$perm['votepolls'])
				$message = 'noperm';
			else
			{
				if ($user['userid'])
					$runquery = "select threadid from whovoted where threadid=$thread[threadid] and userid=$user[userid] limit 1";
				else
					$runquery = "select threadid from whovoted where threadid=$thread[threadid] and ip='$_SERVER[REMOTE_ADDR]' limit 1";
				if (db_num_rows(db_query($runquery)))
					$message = 'alreadyvoted';
				else
					$showresults = false;
			}
		}
		if ($thread['poll']=='.')
			$name = $thread['name'];
		else
			$name = $thread['poll'];
		$total = 0;
		$query2 = db_query("select * from poll where threadid=$thread[threadid] order by ordered asc");
		while ($choice = db_fetch_array($query2))
			$total += $choice['votes'];
		db_data_seek($query2, 0);
		while ($choice = db_fetch_array($query2))
		{
			$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
			if ($forum['dpcode'])
				$choice['choice'] = dpcode_parse($choice['choice'], $forum['img']);
			if ($forum[smilies])
				$choice['choice'] = smilie_parse($choice['choice']);
			if ($showresults)
			{
				if ($bar==6)
					$bar = 1;
				elseif ($bar==5)
					$bar = 6;
				elseif ($bar==4)
					$bar = 5;
				elseif ($bar==3)
					$bar = 4;
				elseif ($bar==2)
					$bar = 3;
				else
					$bar = 2;
				if ($total)
					$percent = round($choice['votes'] / $total * 100, 0);
				else
					$percent = 0;
				$width = ($percent * 3) . 'px';
				eval(store_template('poll_result', '$poll_choice'));
			}
			else
				eval(store_template('thread_poll_vote', '$poll_choice'));
			$poll_choices .= $poll_choice;
		}
	}
	
	$thread_pagenav = build_pagenav('thread', $page, $numpages, $config['numlinks_pagenav'], "id=$thread[threadid]&amp;ignore=$ignore");
	$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$thread[forumid]"));

	$ex = 0;
	while ($post = db_fetch_array($query))
	{
		$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
		$post['number'] =& $i;
		$user_result['name'] = $post['username'];
		$user_result['userid'] = $post['userid'];
		eval('$post[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($post['online_template_large'])).'";');
		$post['joindate'] = time_adjust($post['joindate'], $style['join_post_date_format']);
		$post['postdate'] = time_adjust($post['postdate'], $style['post_date_format']);
		$isonline = is_online($post);
		$showemail = show_email($post);
		$showpm = show_pm($post);
		$showsearch = show_search($post);
		$post['title'] = get_title($post);
		$post['posts'] = number_format($post['posts'], 0, '.', $style['separator']);

		if ($post['iconid'])
			$post['image'] = parse_image($post['image']);
		if ($post['avatar'])
			$post['parsed_avatar'] = parse_image($post['avatar']);
		if ($post['parsed_message'])
			$post['message'] = disable_images($post['parsed_message']);
		else
		{
			if ($post['dpcode'] && $forum['dpcode'])
				$post['message'] = dpcode_parse($post['message'], $forum['img'], true);
			if ($post['smilies'] && $forum['smilies'])
				$post['message'] = smilie_parse($post['message']);
			$post['message'] = censor($post['message'], $config['censored_words']);
		}
		if ($post['editedby_date'])
			$post['editedby_date'] = time_adjust($post['editedby_date'], $style['editedby_date_format']);
		$post['subject'] = censor($post['subject'], $config['censored_words']);

		if ($post['subject'] || $post['iconid'])
			$showbreaks = true;
		else
			$showbreaks = false;
		
		if ($post['showsignature'] && $post['signature'] && $user['displaysignatures'])
		{
			$post['signature'] = disable_images($post['signature']);
			$showsig = true;
		}
		else
			$showsig = false;

		if ($perm['viewattachments'] && $post['attachment'] && $user['img'] && in_set($post['type'], $config['attachment_image_types'], ' '))
			$image_attachment = true;
		else
			$image_attachment = false;
		eval(store_template('thread_post', '$post_result'));
		$posts .= $post_result;
	}

	if (($thread['userid']==$user['userid'] && $group['close']) || ($thread['userid']==$user['userid'] && $group['copymove']) || $group['supermod_close'] || $group['supermod_editthreads'] || $group['supermod_deletethreads'] || $group['supermod_copymove'] || $group['supermod_sticky'] || $moderator['close'] || $moderator['editthreads'] || $moderator['deletethreads'] || $moderator['copymove'] || $moderator['sticky'] || $group['supermod_editpolls'] || $moderator['editpolls'] || $group['supermod_log'] || $moderator['log'])
		$moderator_options = true;
	else
		$moderator_options = false;

	if ($config['whos_online'] && ($config['browsingforum'] || $config['viewingthread']) && $user['userid'])
	{
		$currentuser_forumids = '';
		if ($config['browsingforum'])
		{
			$forum_parents = get_forum_parents($forum['forumid']);
			foreach ($forum_parents as $forum_forum)
				$currentuser_forumids .= addslashes("$forum_forum[forumid],");
		}
		$update_threadid = ($config['viewingthread'] ? $thread['threadid'] : 0);
		db_query("update session set viewthreadid=$update_threadid,forumids='$currentuser_forumids' where sessionid='$_COOKIE[sessionid]'");
	}

	if ($config['whos_online'] && $config['viewingthread'])
	{
		$timeout = $current_time-($config['online_timeout']*60);
		$query3 = db_query("select DISTINCT user.*,groups.online_template,session.viewthreadid from user,groups,session where session.userid>0 and session.viewthreadid=$thread[threadid] and session.lastactivity>=$timeout and session.userid=user.userid and user.groupid=groups.groupid order by user.name asc");
		while ($user_result = db_fetch_array($query3))
		{
			if (!($user_result['invisible'] && !$group['users'] && !$group['supermod_viewfullprofiles'] && $user['userid']!=$user_result['userid']))
			{
				eval('$parsed_name = "' . str_replace("\\'", "'", addslashes($user_result['online_template'])) . '";');
				eval(store_template('forum_online_user'));
				$users .= $forum_online_user;
			}
		}
	}

	if ($user['markread'] && $config['markread'])
	{
		if ($markread = db_fetch_array(db_query("select * from markread where threadid=$thread[threadid] and userid=$user[userid]")))
			db_query("update markread set postid=$thread[lastpostid] where userid=$user[userid] and threadid=$thread[threadid]");
		else
			db_query("insert into markread (userid, threadid, postid) values ($user[userid], $thread[threadid], $thread[lastpostid])");
	}

	$pagetitle = $thread['name'];
	eval(get_template('thread_index'));
}
else
{
	$pagetitle = 'Invalid thread';
	eval(get_template('invalid_thread'));
}
?>