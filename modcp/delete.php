<?php
/**************************************************
* Mass Delete
* -----------
* Removes posts based on username or post date.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'forum_choice,forum_nodeleting,invalid_user,massdelete_done,massdelete_index,mass_number';
/**************************************************
* Global variable resetting                      */
unset($forums);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$days = $_POST['days'];
$forumid = $_POST['forumid'];
$op = $_POST['op'];
$username = $_POST['username'];
/*************************************************/

$pagetitle = 'Mass Delete';

if ($group['supermod_massdelete'] || $modperm['massdelete'])
{
	if ($op)
	{
		$username = trim(htmlspecialchars($username));
		if ($op=='user' && !$user_result = db_fetch_array(db_query("select userid from user where name='$username'")))
			die(eval(get_template('invalid_user')));
		if ($op=='date' && !is_numeric($days))
			die(eval(get_template('mass_number')));
		if (!$group['supermod_massdelete'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and massdelete=1"))!=db_num_rows(db_query('select forumid from forum')))
			$allforums = false;
		else
			$allforums = true;
		$query = db_query("select * from moderator where userid=$user[userid]");
		while ($moderator_result = db_fetch_array($query))
			$moderatorstore[$moderator_result['forumid']] = $moderator_result;
		if (!$forumid && !$allforums)
			die(eval(get_template('permission_error')));
		get_forum_store();
		if (!$group['supermod_massdelete'] && !$moderatorstore[$forum['forumid']]['massdelete'])
			eval(get_template('permission_error'));
		$threadquery = '';
		if ($forumid)
		{
			$forum = $forumstoreid[$forumid];
			if ($group['supermod_massdelete'] || $moderatorstore[$forum['forumid']]['massdelete'])
			{
				if ($op=='date')
				{
					$query = db_query("select threadid from thread where forumid=$forum[forumid] and lastpostdate<".($current_time-($days*86400)));
				}
				else
				{
					$query = db_query("select threadid from thread where forumid=$forum[forumid] and userid=$user_result[userid]");
				}
				while ($thread = db_fetch_array($query))
				{
					if ($threadquery)
						$threadquery .= " or threadid=$thread[threadid]";
					else
						$threadquery = "threadid=$thread[threadid]";
				}
				if ($op=='date')
					db_query("delete from thread where forumid=$forum[forumid] and lastpostdate<".($current_time-($days*86400)));
				else
					db_query("delete from thread where forumid=$forum[forumid] and userid=$user_result[userid]");
			}
		}
		$forumarray = get_forums($forum['forumid']);
		if ($forumarray && $_POST['subforums'])
		{
			while (list($forumextra, $forum) = each($forumarray))
			{
				if ($group['supermod_massmove'] || $moderatorstore[$forum['forumid']]['massmove'])
				{
					if ($op=='date')
					{
						$query = db_query("select threadid from thread where forumid=$forum[forumid] and lastpostdate<".($current_time-($days*86400)));
					}
					else
					{
						$query = db_query("select threadid from thread where forumid=$forum[forumid] and userid=$user_result[userid]");
					}
					while ($thread = db_fetch_array($query))
					{
						if ($threadquery)
							$threadquery .= " or threadid=$thread[threadid]";
						else
							$threadquery = "threadid=$thread[threadid]";
					}
					if ($op=='date')
						db_query("delete from thread where forumid=$forum[forumid] and lastpostdate<".($current_time-($days*86400)));
					else
						db_query("delete from thread where forumid=$forum[forumid] and userid=$user_result[userid]");
				}
			}
		}
		if ($threadquery)
		{
			db_query("delete from post where ($threadquery)");
			db_query("delete from markread where ($threadquery)");
			db_query("delete from poll where ($threadquery)");
			db_query("delete from whovoted where ($threadquery)");
			db_query("delete from subscribedthread where ($threadquery)");
			db_query("delete from subscribedemail where ($threadquery)");
			db_query("update article set replies=0,threadid=0 where ($threadquery)");
			$threadquery = str_replace('threadid', 'redirect', $threadquery);
			db_query("delete from thread where ($threadquery)");
		}
		db_query('update forum set threadiconid=0,lastthreadid=0,lastforumid=0,threadname=\'\',lastuserid=0,lastpostid=0,lastpostdate=0,posts=0,threads=0,lastusername=\'\'');
		$query = db_query('select * from forum');
		while ($forum = db_fetch_array($query))
		{
			unset($forumstore);
			if ($forumarray = get_forum_parents($forum['forumid']))
			{
				$count = db_fetch_array(db_query("select count(*) as numthreads,sum(posts) as numposts from thread where forumid=$forum[forumid] and redirect=0"));
				if (!$count['numposts'])
					$count['numposts'] = 0;
				$thread = db_fetch_array(db_query("select * from thread where forumid=$forum[forumid] and redirect=0 order by lastpostdate desc limit 1"));
				while (list($forumextra, $forumbump) = each($forumarray))
				{
					if (!$forumbump['forumid'])
						continue;
					if ($forumbump['lastpostdate']<=$thread['lastpostdate'])
						db_query("update forum set threadiconid='$thread[iconid]',lastthreadid='$thread[threadid]',lastforumid=$thread[forumid],threadname='".addslashes(htmlunspecialchars($thread['name']))."',lastuserid='$thread[lastuserid]',lastpostid='$thread[lastpostid]',lastpostdate='$thread[lastpostdate]',posts=posts+$count[numposts],threads=threads+$count[numthreads],lastusername='".addslashes($thread['lastusername'])."' where forumid=$forumbump[forumid]");
					else
						db_query("update forum set posts=posts+$count[numposts],threads=threads+$count[numthreads] where forumid=$forumbump[forumid]");
				}
			}
			else
				db_query("delete from thread where forumid=$forum[forumid]");
		}
		if ($op=='date')
			moderatorlog("Mass deleted threads older than <b>$days</b> days", 0, '');
		else
			moderatorlog("Mass deleted threads started by <b>$user_result[name]</b>", 0, '');
		$redirect_url = 'delete.php';
		eval(get_template('massdelete_redirect'));
	}
	else
	{
		$selected = false;
		moderatorlog('Viewed mass delete panel', 0, '');
		$query = db_query("select * from moderator where userid=$user[userid]");
		while ($moderator_result = db_fetch_array($query))
			$moderatorstore[$moderator_result['forumid']] = $moderator_result;
		get_forum_store();
		if ($forumarray = get_forums(0))
		{
			while (list($forumextra, $forum_result) = each($forumarray))
			{
				$perm = get_forum_permissions($forum_result);
				for ($i=0; $i<$forum_result['depth']; $i++)
				{
					eval(store_template('option_indention'));
					$forum_result['name'] = $option_indention.$forum_result['name'];
				}
				if ($perm['viewforums'] || $group['supermod_massdelete'] || $moderatorstore[$forum_result['forumid']]['massdelete'])
				{
					if (!$group['supermod_massdelete'] && !$moderatorstore[$forum_result['forumid']]['massdelete'])
					{
						eval(store_template('forum_nodeleting', '$forum_nodeleting'));
						$forum_result['name'] .= $forum_nodeleting;
					}
					eval(store_template('forum_choice'));
					$forums .= $forum_choice;
				}
			}
		}
		if (!$group['supermod_massdelete'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and massdelete=1"))!=db_num_rows(db_query('select forumid from forum')))
			$allforums = false;
		else
			$allforums = true;
		eval(get_template('massdelete_index'));
	}
}
else
	eval(get_template('permission_error'));
?>