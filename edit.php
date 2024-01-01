<?php
/**************************************************
* Edit Post
* ---------
* Allows you to edit and delete posts.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'delete_post,delete_post_redirect,delete_thread,delete_thread_redirect,editpost_index,edit_post_missing,edit_post_missing_subject,invalid_post';
/**************************************************
* Global variable resetting                      */
unset($poll_options);
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
$message = $_POST['message'];
$options = $_POST['options'];
$page = $_REQUEST['page'];
$poll = $_REQUEST['poll'];
$preset_poll_options = $_REQUEST['preset_poll_options'];
$preview_button = $_POST['preview_button'];
$showsignature = $_POST['showsignature'];
$smilies = $_POST['smilies'];
$subject = $_POST['subject'];
$subscribe = $_POST['subscribe'];
$subscribe_email = $_POST['subscribe_email'];
$url = $_POST['url'];
/*************************************************/

if (!is_numeric($preset_poll_options))
	$preset_poll_options = '';
if ($post = db_fetch_array(db_query("select post.*,user.posts,attachment.size,attachment.attachment,attachment.name as attachment_name from post left join attachment on attachment.postid=post.postid left join user on post.userid=user.userid where post.postid='$_REQUEST[id]'")))
{
	if (!$page)
		$page = 1;
	$thread = db_fetch_array(db_query("select * from thread where threadid=$post[threadid]"));
	$thread['name'] = censor($thread['name'], $config['censored_words']);
	$forum = get_forum_nav($thread['forumid']);
	$perm = get_forum_permissions($forum);
	$preset_poll_options = dp_htmlspecialchars($preset_poll_options);
	$options = dp_htmlspecialchars($options);
	$username = dp_htmlspecialchars($_POST['username']);
	$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$thread[forumid]"));
	if (!($moderator['editposts'] || $group['supermod_editposts'] || ($perm['editposts'] && !$config['edit_post_time'] && $post['userid']==$user['userid']) || ($perm['editposts'] && $post['userid']==$user['userid'] && $current_time-$post['postdate']<=($config['edit_post_time']*60))) || !$forum['allow_posting'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	if (!(!$thread['closed'] || $group['supermod_close'] || $moderator['close'] || ($thread['userid']==$user['userid'] && $perm['close'])))
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	if (!$html || !$group['html'])
		$html = 0;
	
	if ($_POST['delete'])
	{
		$firstpost = db_fetch_array(db_query("select postid from post where threadid=$thread[threadid] order by postid asc limit 1"));
		if ($firstpost['postid']==$post['postid'] && ($group['supermod_deletethreads'] || $moderator['deletethreads'] || ($perm['deletethreads'] && !$config['delete_thread_time']) || ($perm['deletethreads'] && $config['delete_thread_time'] && $current_time-$post['postdate']<=($config['delete_thread_time']*60))))
		{
			$pagetitle = "Delete thread - $thread[name]";
			eval(get_template('delete_thread'));
		}
		elseif ($firstpost['postid']!=$post['postid'] && ($group['supermod_deleteposts'] || $moderator['deleteposts'] || ($perm['deleteposts'] && !$config['delete_post_time']) || ($perm['deleteposts'] && $config['delete_post_time'] && $current_time-$post['postdate']<=($config['delete_post_time']*60))))
		{
			$pagetitle = "Delete post - $thread[name]";
			eval(get_template('delete_post'));
		}
		die();
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($preview_button)
		{
			if (!$user['userid'])
				$user['name'] = stripslashes($username);
			$subject = dp_htmlspecialchars(stripslashes($subject));
			$message = str_nl_normalize($message);
			if ($url)
				$message = auto_url($message);
			$message = stripslashes(dp_trim(add_word_breaks(wysiwyg_parse($message, ($smilies ? 0 : 1), $html))));
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
			$post['message'] = $message;
			$post['iconid'] = $iconid;
		}
		else
		{
			if (!$message = dp_trim($message))
			{
				$pagetitle = 'Missing post';
				die(eval(get_template('edit_post_missing')));
			}
			
			$firstpost = db_fetch_array(db_query("select postid from post where threadid=$thread[threadid] order by postid asc limit 1"));
			if ((!$subject = dp_trim($subject)) && $firstpost['postid']==$post['postid'] && ($moderator['editposts'] || $group['supermod_editposts'] || ($perm['editthreads'] && !$config['edit_thread_time']) || ($perm['editthreads'] && $current_time-$post['postdate']<($config['edit_thread_time']*60))))
			{
				$pagetitle = 'Missing subject';
				die(eval(get_template('edit_post_missing_subject')));
			}
			if ($perm['postattachments'] && $_FILES['attachment']['size'])
				attach_check();
			$url = ($url ? true : false);
			$dpcode = ($dpcode ? false : true);
			$showsignature = ($showsignature ? true : false);
			$smilies = ($smilies ? false : true);
			edit_post($post, $subject, $message, $iconid, $thread, $dpcode, $showsignature, $smilies, $url, $html, $forum);
			
			do_subscriptions($post, $subscribe, $subscribe_email);
			if ($perm['postattachments'] && $_FILES['attachment']['size'])
				attach($post['postid']);
			if ($_POST['delete_attachment'])
			{
				db_query("delete from attachment where postid=$post[postid]");
				update_thread_attachment($post['threadid']);
			}
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
			if ($poll)
				header("Location: poll.php?op=create&id=$thread[threadid]&options=$options");
			else
				header("Location: edit.php?doredirect=" . urlencode("thread.php?postid=$post[postid]#$post[postid]"));
		}
	}
	elseif ($_POST['op']=='dodelete')
	{
		$firstpost = db_fetch_array(db_query("select postid,userid from post where threadid=$thread[threadid] order by postid asc limit 1"));
		if ($firstpost['postid']==$post['postid'] && ($group['supermod_deletethreads'] || $moderator['deletethreads'] || ($perm['deletethreads'] && !$config['delete_thread_time']) || ($perm['deletethreads'] && $config['delete_thread_time'] && $current_time-$post['postdate']<=($config['delete_thread_time']*60))))
		{
			delete_thread($thread, $forum);
			$pagetitle = "Deleting thread - $thread[name]";
			$redirect_url = "forum_display.php?id=$thread[forumid]";
			eval(get_template('delete_thread_redirect'));
		}
		elseif ($firstpost['postid']!=$post['postid'] && ($group['supermod_deleteposts'] || $moderator['deleteposts'] || ($perm['deleteposts'] && !$config['delete_post_time']) || ($perm['deleteposts'] && $config['delete_post_time'] && $current_time-$post['postdate']<=($config['delete_post_time']*60))))
		{
			delete_post($post, $thread, $forum);
			$pagetitle = "Deleting post - $thread[name]";
			$redirect_url = "thread.php?id=$thread[threadid]&page=$page";
			eval(get_template('delete_post_redirect'));
		}
		else
		{
			$pagetitle = 'Access denied';
			eval(get_template('permission_error'));
		}
		die();
	}
	if ($user['userid'] && db_num_rows(db_query("select * from subscribedemail where userid=$user[userid] and threadid=$thread[threadid]")))
		$is_subscribe_email_checked = true;
	else
		$is_subscribe_email_checked = false;
	
	if ($user['userid'] && db_num_rows(db_query("select * from subscribedthread where userid=$user[userid] and threadid=$thread[threadid]")))
		$is_subscribe_checked = true;
	else
		$is_subscribe_checked = false;
	
	$deletepost = false;
	$deletethread = false;
	$firstpost = db_fetch_array(db_query("select postid from post where threadid=$thread[threadid] order by postid asc limit 1"));
	if ($firstpost['postid']==$post['postid'] && ($group['supermod_deletethreads'] || $moderator['deletethreads'] || ($perm['deletethreads'] && !$config['delete_thread_time']) || ($perm['deletethreads'] && $config['delete_thread_time'] && $current_time-$post['postdate']<=($config['delete_thread_time']*60))))
		$deletethread = true;
	elseif ($firstpost['postid']!=$post['postid'] && ($group['supermod_deleteposts'] || $moderator['deleteposts'] || ($perm['deleteposts'] && !$config['delete_post_time']) || ($perm['deleteposts'] && $config['delete_post_time'] && $current_time-$post['postdate']<=($config['delete_post_time']*60))))
		$deletepost = true;
	
	$icons = display_icons($post['iconid']);
	if ($perm['startpolls'] && $firstpost['postid']==$post['postid'] && !$thread['poll'])
		$startpoll = true;
	else
		$startpoll = false;
	
	$pagetitle = "Editing post - $thread[name]";
	if ($forum['smilies'] && $config['number_smilies'])
		$smilie_box = smilie_box();
	$canattach = ($perm['postattachments'] && !$post['attachment'] ? 1 : 0);
	edit_parse($post['message'], $forum['dpcode'], $forum['img'], $forum['smilies'], ($post['html'] && $group['html']));
	if (($thread['userid']==$user['userid'] && $group['close']) || $group['supermod_close'] || $moderator['close'])
		$mod_close = true;
	else
		$mod_close = false;
	if ($group['supermod_sticky'] || $moderator['sticky'])
		$mod_sticky = true;
	else
		$mod_sticky = false;
	eval(get_template('editpost_index'));
}
else
	eval(get_template('invalid_post'));
?>