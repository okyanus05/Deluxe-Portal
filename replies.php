<?php
/**************************************************
* Who Replied
* -----------
* Lists everyone who replied to a given thread, and
* how many posts each person contributed to the 
* thread.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_thread,replies_index,replies_user';
/**************************************************
* Global variable resetting                      */
unset($replystore);
unset($users);
unset($userstore);
/*************************************************/

require('function.php');

if (!$thread = db_fetch_array(db_query("select * from thread where threadid='$_REQUEST[id]' and redirect=0")))
{
	$pagetitle = 'Invalid thread';
	die(eval(get_template('invalid_thread')));
}
$thread['name'] = censor($thread['name'], $config['censored_words']);
$forum = db_fetch_array(db_query("select * from forum where forumid=$thread[forumid]"));
$perm = get_forum_permissions($forum);
if (!$perm['viewthreads'])
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}
$query = db_query("select username,userid from post where threadid='$thread[threadid]'");
while ($post = db_fetch_array($query))
{
	$replystore[$post['userid']]++;
	$userstore[$post['userid']] = $post;
}
arsort($replystore);
$color = 'cellalt';
while (list($key, $replies) = each($replystore))
{
	$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
	$user_result = $userstore[$key];
	eval(store_template('replies_user'));
	$users .= $replies_user;
}
$pagetitle = "Who Replied - $thread[name]";
eval(get_template('replies_index'));
?>