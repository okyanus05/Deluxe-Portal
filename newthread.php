<?php
/**************************************************
* New Thread
* ----------
* Used to post new threads within forums.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'floodcheck,invalid_forum,newthread_index,post_thread_missing';
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
$id = $_REQUEST['id'];
$message = $_POST['message'];
$options = $_POST['options'];
$poll = $_REQUEST['poll'];
$preset_poll_options = $_REQUEST['preset_poll_options'];
$preview_button = $_POST['preview_button'];
$showsignature = $_POST['showsignature'];
$smilies = $_POST['smilies'];
$subject = $_POST['subject'];
$subscribe = $_POST['subscribe'];
$subscribe_email = $_POST['subscribe_email'];
$url = $_POST['url'];
$username = $_POST['username'];
$html = $_POST['html'];
/*************************************************/

if (!$forum = get_forum_store($id))
{
	$pagetitle = 'Invalid forum';
	die(eval(get_template('invalid_forum')));
}

$perm = get_forum_permissions($forum);
if (!$perm['postthreads'] || !$forum['allow_posting'])
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}

if ($config['whos_online'] && $config['browsingforum'] && $user['userid'])
{
	$currentuser_forumids = '';
	$forum_parents = get_forum_parents($forum['forumid']);
	foreach ($forum_parents as $forum_forum)
		$currentuser_forumids .= addslashes("$forum_forum[forumid],");
	db_query("update session set forumids='$currentuser_forumids' where sessionid='$_COOKIE[sessionid]'");
}

$preset_poll_options = dp_htmlspecialchars($preset_poll_options);
$options = dp_htmlspecialchars($options);
$username = dp_htmlspecialchars($username);
$parsedmessage = '';
if ($_POST['op']=='dopost')
{
	if (!$html || !$group['html'])
		$html = 0;
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
		if (!(($subject = dp_trim($subject)) && ($message = dp_trim($message))))
		{
			$pagetitle = 'Required fields missing';
			die(eval(get_template('post_thread_missing')));
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
		if ($config['max_titlelen'] && dp_strlen($subject)>$config['max_titlelen'])
			$subject = dp_substr($subject, 0, $config['max_titlelen']);
		if ($perm['postattachments'] && $_FILES['attachment']['size'])
			attach_check();
		if ($config['disable_shouting'] && !preg_match('/[a-z]+/', $subject))
			$subject = ucfirst(strtolower($subject));
		$url = ($url ? 1 : 0);
		$dpcode = ($dpcode ? 0 : 1);
		$showsignature = ($showsignature ? 1 : 0);
		$smilies = ($smilies ? 0 : 1);
		$thread = post_thread($subject, $message, $iconid, $forum, $dpcode, $showsignature, $smilies, $url, $html);
		if ($user['userid'] && $subscribe)
			db_query("insert into subscribedthread (userid, threadid) values ($user[userid], $thread[threadid])");
		if ($user['userid'] && $subscribe_email)
			db_query("insert into subscribedemail (userid, threadid, lastsent) values ($user[userid], $thread[threadid], 0)");
		$query = db_query('select * from post order by postid desc limit 1');
		$post = db_fetch_array($query);
		if ($perm['postattachments'] && $_FILES['attachment']['size'])
			attach($post['postid']);
		if ($do_close && ($group['close'] || $group['supermod_close'] || $moderator['close']))
		{
			moderatorlog('Closed thread', $thread['threadid'], $thread['name']);
			db_query("update thread set closed=1 where threadid=$thread[threadid]");
		}
		if ($do_stick && ($group['supermod_sticky'] || $moderator['sticky']))
		{
			moderatorlog('Stuck thread', $thread['threadid'], $thread['name']);
			db_query("update thread set sticky=1 where threadid=$thread[threadid]");
		}
		$pagetitle = 'Posting new thread';
		if ($poll)
			die(header("Location: poll.php?op=create&id=$thread[threadid]&options=$options"));
		else
			die(header("Location: thread.php?id=$thread[threadid]"));
	}
}
get_forum_nav($forum['forumid']);
$icons = display_icons();
$pagetitle = "Posting thread - $forum[name]";
if ($forum['smilies'] && $config['number_smilies'])
	$smilie_box = smilie_box();
if ($group['close'] || $group['supermod_close'] || $moderator['close'])
	$mod_close = true;
else
	$mod_close = false;
if ($group['supermod_sticky'] || $moderator['sticky'])
	$mod_sticky = true;
else
	$mod_sticky = false;
eval(get_template('newthread_index'));
?>