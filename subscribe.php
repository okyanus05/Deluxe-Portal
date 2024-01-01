<?php
/**************************************************
* Subscriptions
* -------------
* Allows users to subscribe to and unsubscribe from
* threads and forums.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_forum,invalid_thread,subscribe_email_redirect,subscribe_forum_redirect,subscribe_thread_redirect,unsubscribe_email_redirect,unsubscribe_forum_redirect,unsubscribe_thread_redirect';

require('function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$op = $_REQUEST['op'];
/*************************************************/

if (!$user['userid'])
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}

if ($op=='subscribe')
{
	if ($thread = db_fetch_array(db_query("select * from thread where threadid='$id' and redirect=0")))
	{
		$forum = get_forum_store($thread['forumid']);
		$perm = get_forum_permissions($forum);
		if (!$perm['viewthreads'])
		{
			$pagetitle = 'Access denied';
			die(eval(get_template('permission_error')));
		}
		if (!db_num_rows(db_query("select * from subscribedthread where userid=$user[userid] and threadid=$thread[threadid]")))
			db_query("insert into subscribedthread (userid, threadid) values ($user[userid], $thread[threadid])");
		if (!$page)
			$page = 1;
		$pagetitle = 'Subscribing to thread';
		$redirect_url = "thread.php?id=$thread[threadid]&page=$page";
		eval(get_template('subscribe_thread_redirect'));
	}
	else
	{
		$pagetitle = 'Invalid thread';
		eval(get_template('invalid_thread'));
	}
}
elseif ($op=='subscribe_email')
{
	if ($thread = db_fetch_array(db_query("select * from thread where threadid='$id' and redirect=0")))
	{
		$forum = get_forum_store($thread['forumid']);
		$perm = get_forum_permissions($forum);
		if (!$perm['viewthreads'])
		{
			$pagetitle = 'Access denied';
			die(eval(get_template('permission_error')));
		}
		if (!db_num_rows(db_query("select * from subscribedemail where userid=$user[userid] and threadid=$thread[threadid]")))
			db_query("insert into subscribedemail (userid, threadid, lastsent) values ($user[userid], $thread[threadid], 0)");
		if (!$page)
			$page = 1;
		$redirect_url = "thread.php?id=$thread[threadid]&page=$page";
		$pagetitle = 'Subscribing to thread (email)';
		eval(get_template('subscribe_email_redirect'));
	}
	else
	{
		$pagetitle = 'Invalid thread';
		eval(get_template('invalid_thread'));
	}
}
elseif ($op=='unsubscribe')
{
	if ($thread = db_fetch_array(db_query("select * from thread where threadid='$id'")))
	{
		$forum = get_forum_store($thread['forumid']);
		$perm = get_forum_permissions($forum);
		if (!$perm['viewthreads'])
		{
			$pagetitle = 'Access denied';
			die(eval(get_template('permission_error')));
		}
		db_query("delete from subscribedthread where userid=$user[userid] and threadid=$thread[threadid]");
		if ($page)
			$redirect_url = "thread.php?id=$thread[threadid]&page=$page";
		else
			$redirect_url = 'user.php';
		$pagetitle = 'Unsubscribing from thread';
		eval(get_template('unsubscribe_thread_redirect'));
	}
	else
	{
		$pagetitle = 'Invalid thread';
		eval(get_template('invalid_thread'));
	}
}
elseif ($op=='unsubscribe_email')
{
	if ($thread = db_fetch_array(db_query("select * from thread where threadid='$id'")))
	{
		$forum = get_forum_store($thread['forumid']);
		$perm = get_forum_permissions($forum);
		if (!$perm['viewthreads'])
		{
			$pagetitle = 'Access denied';
			die(eval(get_template('permission_error')));
		}
		db_query("delete from subscribedemail where userid=$user[userid] and threadid=$thread[threadid]");
		if ($page)
			$redirect_url = "thread.php?id=$thread[threadid]&page=$page";
		else
			$redirect_url = 'user.php';
		$pagetitle = 'Unsubscribing from thread (email)';
		eval(get_template('unsubscribe_email_redirect'));
	}
	else
	{
		$pagetitle = 'Invalid thread';
		eval(get_template('invalid_thread'));
	}
}
elseif ($op=='subscribeforum')
{
	if (!$forum = get_forum_store($id))
	{
		$pagetitle = 'Invalid forum';
		die(eval(get_template('invalid_forum')));
	}
	$perm = get_forum_permissions($forum);
	if (!$perm['viewthreads'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	if (!db_num_rows(db_query("select * from subscribedforum where userid=$user[userid] and forumid=$forum[forumid]")))
		db_query("insert into subscribedforum (userid, forumid) values ($user[userid], $forum[forumid])");
	$redirect_url = "forum_display.php?id=$forum[forumid]";
	$pagetitle = 'Subscribing to forum';
	eval(get_template('subscribe_forum_redirect'));
}
elseif ($op=='unsubscribeforum')
{
	if (!$forum = get_forum_store($id))
	{
		$pagetitle = 'Invalid forum';
		die(eval(get_template('invalid_forum')));
	}
	$perm = get_forum_permissions($forum);
	if (!$perm['viewthreads'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	db_query("delete from subscribedforum where userid=$user[userid] and forumid=$forum[forumid]");
	if ($_REQUEST['usercp'])
		$redirect_url = 'user.php';
	else
		$redirect_url = "forum_display.php?id=$forum[forumid]";
	$pagetitle = 'Unsubscribing from forum';
	eval(get_template('unsubscribe_forum_redirect'));
}
else
{
	$pagetitle = 'Invalid thread';
	eval(get_template('invalid_thread'));
}
?>