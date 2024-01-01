<?php
/**************************************************
* Mass Move
* ---------
* Moves threads to other forums, based on thread
* starter or last post date.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'forum_choice,forum_nomoving,forum_noposting,invalid_forum,invalid_user,massmove_index,massmove_redirect,mass_number';
/**************************************************
* Global variable resetting                      */
unset($from_forums);
unset($to_forums);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$days = $_POST['days'];
$from = $_POST['from'];
$op = $_POST['op'];
$to = $_POST['to'];
$username = $_POST['username'];
/*************************************************/

$pagetitle = 'Mass Move';

if ($group['supermod_massmove'] || $modperm['massmove'])
{
	if ($op)
	{
		$username = htmlspecialchars($username);
		if ($op=='user' && !$user_result = db_fetch_array(db_query("select userid from user where name='$username'")))
			die(eval(get_template('invalid_user')));
		if ($op=='date' && !is_numeric($days))
			die(eval(get_template('mass_number')));
		if (!$group['supermod_massmove'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and massmove=1"))!=db_num_rows(db_query('select forumid from forum')))
			$allforums = false;
		else
			$allforums = true;
		$query = db_query("select * from moderator where userid=$user[userid]");
		$i = 0;
		while ($moderator_result = db_fetch_array($query))
			$moderatorstore[$moderator_result['forumid']] = $moderator_result;
		if (!$from && !$allforums)
			die(eval(get_template('permission_error')));
		get_forum_store();
		if (!$to_forum = $forumstoreid[$to])
			die(eval(get_template('invalid_forum')));
		$perm = get_forum_permissions($to_forum);
		if (!$perm['postthreads'])
			die(eval(get_template('permission_error')));
		if ($from)
		{
			$forum = $forumstoreid[$from];
			if ($group['supermod_massmove'] || $moderatorstore[$forum['forumid']]['massmove'])
			{
				if ($op=='date')
					db_query("update thread set forumid='$to_forum[forumid]' where forumid=$forum[forumid] and lastpostdate<".($current_time-($days*86400)));
				else
					db_query("update thread set forumid='$to_forum[forumid]' where forumid=$forum[forumid] and userid=$user_result[userid]");
			}
		}
		else
			$forum['forumid'] = 0;
		$forumarray = get_forums($forum['forumid']);
		if ($forumarray && $_POST['subforums'])
		{
			while (list($forumextra, $forum) = each($forumarray))
			{
				if ($group['supermod_massmove'] || $moderatorstore[$forum['forumid']]['massmove'])
				{
					if ($op=='date')
						db_query("update thread set forumid='$to_forum[forumid]' where forumid=$forum[forumid] and lastpostdate<".($current_time-($days*86400)));
					else
						db_query("update thread set forumid='$to_forum[forumid]' where forumid=$forum[forumid] and userid=$user_result[userid]");
				}
			}
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
			moderatorlog("Mass moved threads older than <b>$days</b> days", 0, '');
		else
			moderatorlog("Mass moved threads started by than <b>$user_result[name]</b>", 0, '');
		$redirect_url = 'move.php';
		eval(get_template('massmove_redirect'));
	}
	else
	{
		$selected = false;
		moderatorlog('Viewed mass move panel', 0, '');
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
				if ($perm['viewforums'] || $group['supermod_massmove'] || $moderatorstore[$forum_result['forumid']]['massmove'])
				{
					if (!$group['supermod_massmove'] && !$moderatorstore[$forum_result['forumid']]['massmove'])
					{
						eval(store_template('forum_nomoving'));
						$forum_result['name'] .= $forum_nomoving;
					}
					eval(store_template('forum_choice'));
					$from_forums .= $forum_choice;
				}
				if ($perm['viewforums'])
				{
					if (!$perm['postthreads'])
					{
						eval(store_template('forum_noposting'));
						$forum_result['name'] .= $forum_noposting;
					}
					eval(store_template('forum_choice'));
					$to_forums .= $forum_choice;
				}
			}
		}
		if (!$group['supermod_massmove'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and massmove=1"))!=db_num_rows(db_query('select forumid from forum')))
			$allforums = false;
		else
			$allforums = true;
		eval(get_template('massmove_index'));
	}
}
else
	eval(get_template('permission_error'));
?>