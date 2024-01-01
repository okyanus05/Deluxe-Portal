<?php
/**************************************************
* Report post to moderators
* -------------------------
* Reports a post to the moderators of a given
* forum, and to the administrators if there are no
* moderators.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_post,mail_pmnotification,report_index,report_post_redirect';
require('function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$message = $_POST['message'];
/*************************************************/

if (!$post = db_fetch_array(db_query("select * from post where postid='$id'")))
{
	$pagetitle = 'Invalid post';
	die(eval(get_template('invalid_post')));
}

$thread = db_fetch_array(db_query("select * from thread where threadid=$post[threadid]"));
$thread['name'] = censor($thread['name'], $config['censored_words']);
$post['subject'] = censor($post['subject'], $config['censored_words']);
$post['message'] = censor($post['message'], $config['censored_words']);
$forum = get_forum_nav($thread['forumid'], true);
$perm = get_forum_permissions($forum);
if (!$perm['viewthreads'])
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}

if ($op=='doreport')
{
	$reportmessage = dp_htmlspecialchars(stripslashes($message));
	$subject = "Reported post in thread: $thread[name]";
	$message = addslashes("[url=$config[url]/profile.php?id=$user[userid]]$user[name][/url] has reported the following post, made by [url=$config[url]/profile.php?id=$post[userid]]$post[username][/url]:<br /><br />$post[message]<br /><br />Reason given:<br /><br />$reportmessage<br /><br />You can view the thread by [url=$config[url]/thread.php?postid=$post[postid]#$post[postid]]clicking here[/url].");
	if (!db_num_rows($query = db_query("select user.* from moderator,user where forumid=$forum[forumid] and moderator.userid=user.userid order by userid asc")))
		$query = db_query('select user.* from groups,user where FIND_IN_SET(groups.groupid, usergroups) and groups.moderators=1 group by userid');
	while ($user_result = db_fetch_array($query))
	{
		$group_result = get_groups($user_result['userid']);
		if (!$group_result['privatemessaging'] || !$user_result['pm'])
			continue;
		db_query("insert into privatemessage (userid, touserid, fromuserid, iconid, subject, message, dpcode, smilies, isread, fromusername, tousername, sentdate, folder) values ($user_result[userid], $user_result[userid], $user[userid], 0, '$subject', '$message', 1, 1, 0, '".addslashes($user['name']).'\', \''.addslashes($user_result['name'])."', $current_time, 'inbox')");
		if ($user_result['notify_pm'])
		{
			$pm = db_fetch_array(db_query('select * from privatemessage order by privatemessageid desc limit 1'));
			$mailsubject = stripslashes($subject);
			eval(store_template('mail_pmnotification', '$mail_message'));
			dp_mail($user_result['email'], "$config[name] Private Message Notification", $mail_message, "From: \"$config[name] Mailer\" <$config[contact]>");
		}
	}
	$pagetitle = 'Reporting post';
	$redirect_url = "thread.php?postid=$post[postid]#$post[postid]";
	eval(get_template('report_post_redirect'));
}
else
{
	$pagetitle = 'Report post to moderators';
	eval(get_template('report_index'));
}
?>