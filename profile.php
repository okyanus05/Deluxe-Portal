<?php
/**************************************************
* Profile
* -------
* Shows the profile of a given user.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_user,profile_customfield,profile_index';
/**************************************************
* Global variable resetting                      */
unset($articlestore);
unset($customfields);
unset($lastpost);
unset($poststore);
unset($threadstore);
/*************************************************/

require('function.php');

if ($group['view_profile'])
{
	if ($user_result = db_fetch_array(db_query("select user.*,groups.online_template_large,session.url,session.sessionid from groups,user left join session on session.userid=user.userid where user.userid='$_REQUEST[id]' and user.groupid=groups.groupid order by session.lastactivity desc limit 1")))
	{
		eval('$username = "'.str_replace('\\\'', '\'', addslashes($user_result['online_template_large'])).'";');
		$user_result['posts_per_day'] = round($user_result['posts']/(($current_time-$user_result['joindate'])/86400), 2);
		$user_result['posts_per_day'] = (($user_result['posts_per_day'] >$user_result['posts'] || $user_result['posts_per_day'] < 0) ? $user_result['posts'] : $user_result['posts_per_day']);
		$user_result['posts_per_day'] = number_format($user_result['posts_per_day'], 2, '.', $style['separator']);
		$user_result['joindate'] = time_adjust($user_result['joindate'], $style['join_date_format']);
		$user_result['title'] = get_title($user_result);
		if ($user_result['avatar'])
			$user_result['parsed_avatar'] = parse_image($user_result['avatar']);
		if ($isonline = is_online($user_result))
		{
			if (stristr($user_result['url'], 'thread.php') || stristr($user_result['url'], 'reply.php') || stristr($user_result['url'], 'replies.php'))
			{
				if (preg_match('/postid=([0-9]+)/', $user_result['url'], $match))
				{
					$thread_result = db_fetch_array(db_query("select thread.forumid,thread.name from thread,post where post.threadid=thread.threadid and post.postid='$match[1]'"));
					$poststore[$match[1]]=$thread_result;
				}
				elseif (preg_match('/id=([0-9]+)/', $user_result['url'], $match))
				{
					$thread_result = db_fetch_array(db_query("select threadid,forumid,name from thread where threadid='$match[1]'"));
					$threadstore[$thread_result['threadid']]=$thread_result;
				}
			}
			if (stristr($user_result['url'], 'article.php'))
			{
				if (preg_match('/id=([0-9]+)/', $user_result['url'], $match))
				{
					$article = db_fetch_array(db_query("select articleid,topicid,sectionid,title from article where articleid='$match[1]'"));
					$articlestore[$article['articleid']] = $article;
				}
			}
			$user_result['activity'] = online_parse($user_result['url']);
		}
		else
			$user_result['activity'] = 'Not online';
		$query = db_query("select * from customfield,usercustomfield where customfield.customfieldid=usercustomfield.customfieldid and userid=$user_result[userid] and customfield.view=1 and ordered>0 order by ordered asc");
		while ($field = db_fetch_array($query))
		{
			eval(store_template('profile_customfield'));
			$customfields .= $profile_customfield;
		}
		
		$forumperms = '';
		get_forum_store();
		$i = 0;
		while ($forum = $forumstore[$i++])
		{
			$perm = get_forum_permissions($forum);
			if ($perm['viewthreads'])
			{
				if ($forumperms)
					$forumperms .= ",$forum[forumid]";
				else
					$forumperms = $forum['forumid'];
			}
		}
		reset ($forumstore);

		unset($lastpost);
		if ($user_result['lastpost'])
		{
			$lastpost = db_fetch_array(db_query("select post.postid,thread.name,post.postdate,thread.forumid from thread,post where thread.threadid=post.threadid and post.postid=$user_result[lastpost]"));
			if (!in_set($lastpost['forumid'], $forumperms))
				unset($lastpost);
		}
		if ($forumperms && !$lastpost)
			$lastpost = db_fetch_array(db_query("select post.postid,thread.name,post.postdate from post,thread where post.threadid=thread.threadid and post.userid='$user_result[userid]' and thread.forumid in ($forumperms) order by postdate desc limit 1"));
		$lastpost['name'] = censor($lastpost['name'], $config['censored_words']);
		if ($lastpost['postdate'])
			$lastpost['postdate'] = str_replace(' ', "&nbsp;", time_adjust($lastpost['postdate'], $style['lastpost_date_format']));
		if ($user['invisible'] && !$group['users'] && !$group['supermod_viewfullprofiles'])
			$user['lastactivity'] = 0;
		$user_result['parsed_lastactivity'] = time_adjust($user_result['lastactivity'], $style['log_date_format']);
		$user_result['signature'] = disable_images($user_result['signature']);
		if (!$user_result['icq'])
			$user_result['icq'] = '';
		
		$showemail = show_email($user_result);
		$showpm = show_pm($user_result);
		$showsearch = show_search($user_result);
		$user_result['posts'] = number_format($user_result['posts'], 0, '.', $style['separator']);
		
		$pagetitle = "User profile page - $user_result[name]";
		eval(get_template('profile_index'));
	}
	else
	{
		$pagetitle = 'Invalid user';
		eval(get_template('invalid_user'));
	}
}
else
{
	$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
}
?>