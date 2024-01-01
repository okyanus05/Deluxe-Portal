<?php
/**************************************************
* Attachment
* ----------
* Displays an attachment, or allows you to download
* one.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_attachment,invalid_forum';

require('function.php');

if (!($forum = db_fetch_array(db_query("select forum.* from post,thread,forum where post.postid='$_REQUEST[id]' and post.threadid=thread.threadid and thread.forumid=forum.forumid"))))
{
	$pagetitle = 'Invalid forum';
	die(eval(get_template('invalid_forum')));
}
$perm = get_forum_permissions($forum);
if (!$perm['viewattachments'])
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}
if (!($attachment = db_fetch_array(db_query("select * from attachment where postid='$_REQUEST[id]'"))))
{
	$pagetitle = 'Invalid attachment';
	die(eval(get_template('invalid_attachment')));
}

if (dp_substr($attachment['attachment'], 0, 3)=='!:!')
	$attachment['attachment'] = file_get_contents(dp_substr($attachment['attachment'], 3));

header('Cache-control: private');
header("Content-type: $attachment[type]");
header("Content-Disposition: attachment; filename=\"$attachment[name]\"");
echo $attachment['attachment'];
?>