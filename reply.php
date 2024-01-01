<?php
/**************************************************
* Reply
* -----
* Allows users to post replies to threads.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'floodcheck,invalid_thread,mail_emailnotification,newreply_index,newreply_post,newreply_post_ignored,post_reply_missing';
/**************************************************
* Global variable resetting                      */
unset($lastposts);
unset($post);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$do_close = $_POST['do_close'];
$do_open = $_POST['do_open'];
$do_stick = $_POST['do_stick'];
$do_unstick = $_POST['do_unstick'];
$dpcode = $_POST['dpcode'];
$html = $_POST['html'];
$iconid = $_POST['iconid'];
$id = $_REQUEST['id'];
$message = $_POST['message'];
$postid = $_REQUEST['postid'];
$preview_button = $_POST['preview_button'];
$showsignature = $_POST['showsignature'];
$smilies = $_POST['smilies'];
$subject = $_POST['subject'];
$subscribe = $_POST['subscribe'];
$subscribe_email = $_POST['subscribe_email'];
$url = $_POST['url'];
$username = $_POST['username'];
$quotepostid = $_POST['quotepostid'];
$quoteselected = $_POST['quoteselected'];
/*************************************************/

if ($thread = db_fetch_array(db_query("select * from thread where threadid='$id' and redirect=0")))
{
	$thread['name'] = censor($thread['name'], $config['censored_words']);
	$forum = get_forum_store($thread['forumid']);
	$perm = get_forum_permissions($forum);
	if (($thread['userid']==$user['userid'] && !$perm['replytoown']) || ($thread['userid']!=$user['userid'] && !$perm['replytoother']) || !$forum['allow_posting'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	
	$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$thread[forumid]"));
	if ($thread['closed'] && !$group['supermod_close'] && !$moderator['close'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	
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
	
	$username = dp_htmlspecialchars($username);
	$parsedmessage = '';
	if (!$html || !$group['html'])
		$html = 0;
	
	if ($_POST['op']=='dopost')
	{
		if ($preview_button)
		{
			if (!$user['userid'])
				$user['name'] = stripslashes($username);
			$subject = dp_htmlspecialchars(stripslashes($subject));
			$message = str_nl_normalize($message);
			if ($url)
				$message = auto_url($message);
			$message = stripslashes(wysiwyg_parse($message, ($smilies ? 0 : 1), $html));
			$preview_subject = censor($subject, $config['censored_words']);
			$preview_message = censor($message, $config['censored_words']);
			if (!$dpcode && $forum['dpcode'])
				$preview_message = dpcode_parse($preview_message, $forum['img']);
			if (!$smilies && $forum['smilies'])
				$preview_message = smilie_parse($preview_message);
			if ($iconid)
			{
				$preview_icon = db_fetch_array(db_query("select * from icon where iconid='$iconid'"));
				$preview_icon['image'] = parse_image($preview_icon['image']);
			}
			edit_parse($message, $forum['dpcode'] && !$dpcode, $forum['img'], $forum['smilies'] && !$smilies);
		}
		else
		{
			if ($quotepostid && $quoteselected && ($quotepost = db_fetch_array(db_query("select * from post where postid='$quotepostid'"))) && $quotepost['threadid']==$thread['threadid'])
			{
				$quotedmessage = dp_trim(addslashes(preg_replace('/\[quote\](.*?)\[\/quote\]/si', '', str_replace('<br />', "\n", htmlunspecialchars($quotepost['message'])))));
				$quotepost['username'] = htmlunspecialchars($quotepost['username']);
				if ($quotedmessage)
					$message = "[quote][i]Originally Posted by $quotepost[username][/i]\n\n$quotedmessage [/quote]\n$message";
			}
			if (!$message = dp_trim($message))
			{
				$pagetitle = 'Message cannot be blank';
				die(eval(get_template('post_reply_missing')));
			}
			if (!$user['userid'])
			{
				check_name($username);
				$user['name'] = $username;
			}
			if ($config['floodcheck_time'] && !$group['supermod_exemptfloodcheck'] && !$moderator['exemptfloodcheck'] && $user['userid'])
			{
				$lastpost = db_fetch_array(db_query("select postdate from post where userid=$user[userid] order by postdate desc limit 1"));
				if (($current_time-$lastpost['postdate'])<$config['floodcheck_time'])
				{
					$pagetitle = 'Flood check';
					die(eval(get_template('floodcheck')));
				}
			}
			if ($perm['postattachments'] && $_FILES['attachment']['size'])
				attach_check();
			$url = ($url ? 1 : 0);
			$subject = dp_trim($subject);
			$dpcode = ($dpcode ? 0 : 1);
			$showsignature = ($showsignature ? 1 : 0);
			$smilies = ($smilies ? 0 : 1);
			$post = post_message($subject, $message, $iconid, $thread, $dpcode, $showsignature, $smilies, $url, $html, $forum);
			
			if ($user['userid'] && $subscribe && !db_num_rows(db_query("select * from subscribedthread where userid=$user[userid] and threadid='$thread[threadid]'")))
				db_query("insert into subscribedthread (userid, threadid) values ($user[userid], '$thread[threadid]')");
			if ($user['userid'] && $subscribe_email && !db_num_rows(db_query("select * from subscribedemail where userid=$user[userid] and threadid='$thread[threadid]'")))
				db_query("insert into subscribedemail (userid, threadid, lastsent) values ($user[userid], '$thread[threadid]', 0)");
			
			if ($config['subscribe_email'])
			{
				$message = stripslashes($message);
				unset($grouplist);
				$query = db_query("select * from groups");
				while ($group_result = db_fetch_array($query))
					$grouplist[$group_result['groupid']] = $group_result;
				$query = db_query("select subscribedemail.*,user.email,user.lastactivity,user.usergroups from subscribedemail,user where subscribedemail.threadid=$thread[threadid] and user.userid=subscribedemail.userid and subscribedemail.userid!=$user[userid] and lastactivity<".(mktime()-($config['online_timeout']*60))." and lastactivity>lastsent order by subscribedemail.userid asc");
				$update = '';
				while ($notify = db_fetch_array($query))
				{
					unset ($grouparray);
					if ($usergroups = explode(',', $notify['usergroups']))
					{
						foreach ($usergroups as $usrgrp)
							$grouparray[] = $grouplist[$usrgrp];
					}
					$perm = get_forum_permissions($forum);
					if (!$perm['viewthreads'])
						continue;
					$update .= "userid=$notify[userid] or ";
					$message = str_replace('<br />', "\n", $message);
					eval(store_template('mail_emailnotification', '$mail_message'));
					dp_mail($notify['email'], "$config[name] Subscribed Thread Notification - $thread[name]", $mail_message, "From: \"$config[name] Mailer\" <$config[contact]>");
				}
				if (!$update)
					$update = 'userid=0 or ';
				db_query("update subscribedemail set lastsent=".mktime()." where (".dp_substr($update, 0, -4).") and threadid=$thread[threadid]");
			}
			
			if ($perm['postattachments'] && $_FILES['attachment']['size'])
				attach($post['postid']);
			if ($do_close && !$thread['closed'] && (($thread['userid']==$user['userid'] && $group['close']) || $group['supermod_close'] || $moderator['close']))
			{
				moderatorlog('Closed thread', $thread['threadid'], $thread['name']);
				db_query("update thread set closed=1 where threadid=$thread[threadid]");
			}
			elseif ($do_open && $thread['closed'] && (($thread['userid']==$user['userid'] && $group['close']) || $group['supermod_close'] || $moderator['close']))
			{
				moderatorlog('Opened thread', $thread['threadid'], $thread['name']);
				db_query("update thread set closed=0 where threadid=$thread[threadid]");
			}
			if ($do_stick && !$thread['sticky'] && ($group['supermod_sticky'] || $moderator['sticky']))
			{
				moderatorlog('Stuck thread', $thread['threadid'], $thread['name']);
				db_query("update thread set sticky=1 where threadid=$thread[threadid]");
			}
			elseif ($do_unstick && $thread['sticky'] && ($group['supermod_sticky'] || $moderator['sticky']))
			{
				moderatorlog('Unstuck thread', $thread['threadid'], $thread['name']);
				db_query("update thread set sticky=0 where threadid=$thread[threadid]");
			}
			header("Location: reply.php?doredirect=" . urlencode("thread.php?postid=$post[postid]#$post[postid]"));
		}
	}
	
	get_forum_nav($forum['forumid'], true);
	$icons = display_icons();
	$pagetitle = "Post reply - $thread[name]";
	if ($forum['smilies'] && $config['number_smilies'])
		$smilie_box = smilie_box();
	if ($postid)
	{
		$post = db_fetch_array(db_query("select * from post where postid='$postid'"));
		if ($post['message'])
		{
			$thrd = db_fetch_array(db_query("select * from thread where threadid=$post[threadid]"));
			$frm = db_fetch_array(db_query("select * from forum where forumid=$thrd[forumid]"));
			$perm = get_forum_permissions($frm);
			if ($perm['viewthreads'])
			{
				$post['subject'] = censor($post['subject'], $config['censored_words']);
				$post['message'] = censor($post['message'], $config['censored_words']);
				$post['message'] = dp_trim(preg_replace('/\[quote\].*?\[\/quote\]/si', '', $post['message']));
				$post['message'] = "[quote][i]Originally posted by $post[username][/i]<br /><br />$post[message] [/quote]<br />";
				$html = $post['html'];
			}
			else
			{
				$post['message'] = '';
				$post['subject'] = '';
			}
		}
		edit_parse($post['message'], $forum['dpcode'], $forum['img'], $forum['smilies']);
	}
	
	$query = db_query("select post.*,icon.image,icon.name as icon_name,user.groupid,ignorelist.ignoreuserid,groups.online_template_large from post left join ignorelist on ignorelist.userid=$user[userid] and ignorelist.ignoreuserid=post.userid left join icon on post.iconid=icon.iconid left join user on post.userid=user.userid left join groups on user.groupid=groups.groupid where threadid='$thread[threadid]' group by postid order by post.postid desc limit $config[posts_per_page]");
	$color = 'cellalt';
	while ($post = db_fetch_array($query))
	{
		$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
		$user_result['name'] = $post['username'];
		$user_result['userid'] = $post['userid'];
		eval('$post[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($post['online_template_large'])).'";');
		$icon = $iconstore[$post['iconid']];
		if ($post['iconid'])
			$post['image'] = parse_image($post['image']);
		$post['message'] = censor($post['message'], $config['censored_words']);
		$post['subject'] = censor($post['subject'], $config['censored_words']);
		if ($post['dpcode'] && $forum['dpcode'])
			$post['message'] = dpcode_parse($post['message'], $forum['img']);
		if ($post['smilies'] && $forum['smilies'])
			$post['message'] = smilie_parse($post['message']);
		
		if ($post['subject'] || $post['iconid'])
			$showbreaks = true;
		else
			$showbreaks = false;
		if ($post['ignoreuserid'] && !$_REQUEST['ignore'])
		{
			eval(store_template('newreply_post_ignored', '$post_ignore'));
			$lastposts .= $post_ignore;
		}
		else
		{
			eval(store_template('newreply_post', '$post_result'));
			$lastposts .= $post_result;
		}
	}
	if (($thread['userid']==$user['userid'] && $group['close']) || $group['supermod_close'] || $moderator['close'])
		$mod_close = true;
	else
		$mod_close = false;
	if ($group['supermod_sticky'] || $moderator['sticky'])
		$mod_sticky = true;
	else
		$mod_sticky = false;
	eval(get_template('newreply_index'));
}
else
{
	$pagetitle = 'Invalid thread';
	eval(get_template('invalid_thread'));
}
?>