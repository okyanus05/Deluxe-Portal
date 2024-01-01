<?php
/**************************************************
* View IP address
* ---------------
* Displays a user's IP address.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_post,ip_index';

require('function.php');

if ($post = db_fetch_array(db_query("select post.*,forum.forumid from post,thread,forum where post.postid='$_REQUEST[id]' and post.threadid=thread.threadid and thread.forumid=forum.forumid")))
{
	$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$post[forumid]"));
	if ($group['supermod_viewips'] || $moderator['viewips'])
	{
		$pagetitle = "IP Address - $post[username]";
		$hostname = @gethostbyaddr($post['ip']);
		if ($group['users'])
			$access = 'admin';
		elseif ($group['supermod_viewfullprofiles'])
			$access = 'mod';
		else
			$access = '';
		eval(get_template('ip_index'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
else
{
	$pagetitle = 'Invalid post';
	eval(get_template('invalid_post'));
}
?>