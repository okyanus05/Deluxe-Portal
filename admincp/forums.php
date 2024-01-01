<?php
/**************************************************
* Forums
* ------
* Allows you to add, edit, and delete forums.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_forum,delete_forum,edit_forum,forums_forum,forums_index,forums_missing,forum_choice,indent,invalid_forum';
/**************************************************
* Global variable resetting                      */
unset($forum_choices);
unset($forums);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$parentid = $_POST['parentid'];
/*************************************************/

$pagetitle = 'Forums';

if ($group['forums'])
{
	if ($_POST['op']=='doadd')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if ($link = trim(htmlspecialchars($_POST['link'])))
			{
				if (!strstr($link, '://'))
					$link = "http://$_POST[link]";
				$_POST['allow_posting'] = 0;
			}
			db_query("insert into forum (name, parentid, ordered, allow_posting, description, lastuserid, lastpostid, lastpostdate, posts, threads, lastusername, countposts, dpcode, smilies, img, link) values ('$name', '$parentid', '$_POST[ordered]', '$_POST[allow_posting]', '$_POST[description]', 0, 0, 0, 0, 0, '', '$_POST[countposts]', '$_POST[dpcode]', '$_POST[smilies]', '$_POST[img]', '$link')");
			$forum = db_fetch_array(db_query('select forumid from forum order by forumid desc limit 1'));
			adminlog("Added forum - <b>$forum[name] ($forum[forumid])</b>");
			if (!$parentid)
			{
				$query = db_query('select * from groups');
				while ($group_result = db_fetch_array($query))
					db_query("insert into forumpermission (forumid, groupid, type, close, copymove, deleteposts, deletethreads, editposts, editthreads, postattachments, postthreads, replytoother, replytoown, startpolls, viewattachments, viewforums, viewthreads, votepolls) values ($forum[forumid], $group_result[groupid], 'group', $group_result[close], $group_result[copymove], $group_result[deleteposts], $group_result[deletethreads], $group_result[editposts], $group_result[editthreads], $group_result[postattachments], $group_result[postthreads], $group_result[replytoother], $group_result[replytoown], $group_result[startpolls], $group_result[viewattachments], $group_result[viewforums], $group_result[viewthreads], $group_result[votepolls])");
			}
			else
			{
				$query = db_query("select * from forumpermission where forumid='$parentid'");
				while ($perm_result = db_fetch_array($query))
				{
					if ($perm_result['type']=='custom')
						$perm_result['type'] = 'parent';
					db_query("insert into forumpermission (forumid, groupid, type, close, copymove, deleteposts, deletethreads, editposts, editthreads, postattachments, postthreads, replytoother, replytoown, startpolls, viewattachments, viewforums, viewthreads, votepolls) values ($forum[forumid], $perm_result[groupid], '$perm_result[type]', $perm_result[close], $perm_result[copymove], $perm_result[deleteposts], $perm_result[deletethreads], $perm_result[editposts], $perm_result[editthreads], $perm_result[postattachments], $perm_result[postthreads], $perm_result[replytoother], $perm_result[replytoown], $perm_result[startpolls], $perm_result[viewattachments], $perm_result[viewforums], $perm_result[viewthreads], $perm_result[votepolls])");
				}
			}
			$query = db_query("select * from moderator where forumid='$parentid'");
			while ($mod = db_fetch_array($query))
				db_query("insert into moderator (userid, username, forumid, editposts, editthreads, editpolls, deleteposts, close, massdelete, massmove, copymove, log, exemptfloodcheck, announcements, viewips, sticky, deletethreads) values ($mod[userid], '".addslashes($mod['username'])."', $forum[forumid], '$mod[editposts]', '$mod[editthreads]', '$mod[editpolls]', '$mod[deleteposts]', '$mod[close]', '$mod[massdelete]', '$mod[massmove]', '$mod[copymove]', '$mod[log]', '$mod[exemptfloodcheck]', '$mod[announcements]', '$mod[viewips]', '$mod[sticky]', '$mod[deletethreads]')");
			header('Location: forums.php');
		}
		else
			eval(get_template('forums_missing'));
	}
	elseif ($_POST['op']=='order')
	{
		$query = db_query('select * from forum');
		while ($forum = db_fetch_array($query))
			db_query('update forum set ordered=\''.$_POST["forum_$forum[forumid]"]."' where forumid=$forum[forumid]");
		header('Location: forums.php');
	}
	elseif ($_REQUEST['op']=='add')
	{
		get_forum_store();
		$parentid = $_REQUEST['parentid'];
		if ($forumarray = get_forums(0))
		{
			while (list($forumextra, $forum_result) = each($forumarray))
			{
				for ($i=0; $i<$forum_result['depth']; $i++)
				{
					eval(store_template('option_indention'));
					$forum_result['name'] = $option_indention.$forum_result['name'];
				}
				if ($parentid==$forum_result['forumid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('forum_choice'));
				$forum_choices .= $forum_choice;
			}
		}
		eval(get_template('add_forum'));
	}
	elseif ($op=='delete')
	{
		if ($forum = db_fetch_array(db_query("select * from forum where forumid='$id'")))
			eval(get_template('delete_forum'));
		else
			eval(get_template('invalid_forum'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($forum = db_fetch_array(db_query("select * from forum where forumid='$id'")))
		{
			adminlog("Deleted forum - <b>$forum[name] ($forum[forumid])</b>");
			db_query("update forum set parentid='$forum[parentid]' where parentid='$forum[forumid]'");
			$query = db_query("select threadid from thread where forumid='$forum[forumid]'");
			$threadcount = 0;
			$postcount = 0;
			while ($thread = db_fetch_array($query))
			{
				$threadcount++;
				$pcount = db_fetch_array(db_query("select count(*) from post where threadid='$thread[threadid]'"));
				$postcount += $pcount[0];
				db_query("delete from post where threadid='$thread[threadid]'");
			}
			$query = db_query("select threadid from thread where forumid='$forum[forumid]'");
			while ($thread = db_fetch_array($query))
			{
				db_query("delete from post where threadid=$thread[threadid]");
				db_query("delete from markread where threadid=$thread[threadid]");
				db_query("delete from subscribedthread where threadid=$thread[threadid]");
				db_query("delete from subscribedemail where threadid=$thread[threadid]");
				db_query("delete from poll where threadid=$thread[threadid]");
				db_query("delete from whovoted where threadid=$thread[threadid]");
			}
			db_query("delete from thread where forumid=$forum[forumid]");
			$forumarray = get_forum_parents($forum['forumid']);
			$forumarray = array_reverse($forumarray);
			while (list($forumextra, $forumbump) = each($forumarray))
			{
				$lastthread = '';
				if (!$lastthread = db_fetch_array(db_query("select * from thread where forumid='$forumbump[forumid]' order by lastpostdate desc limit 1")))
				{
					$lastthread['lastpostdate'] = 0;
					$lastthread['lastuserid'] = 0;
					$lastthread['lastusername'] = '';
					$lastthread['lastpostid'] = 0;
					$lastthread['iconid'] = 0;
					$lastthread['threadid'] = 0;
					$lastthread['name'] = '';
				}
				db_query("update forum set lastusername='".addslashes($lastthread['lastusername'])."',threadiconid='$lastthread[iconid]',lastthreadid='$lastthread[threadid]',lastforumid='$lastthread[forumid]',threadname='".addslashes(htmlunspecialchars($lastthread['name']))."',threads=threads-$threadcount,posts=posts-$postcount,lastpostdate='$lastthread[lastpostdate]',lastuserid='$lastthread[lastuserid]',lastpostid='$lastthread[lastpostid]' where forumid='$forumbump[forumid]'");
			}
			db_query("delete from announcement where forumid='$forum[forumid]'");
			db_query("delete from forum where forumid='$forum[forumid]'");
			db_query("delete from forumpermission where forumid='$forum[forumid]'");
			db_query("delete from subscribedforum where forumid='$forum[forumid]'");
			header('Location: forums.php');
		}
		else
			eval(get_template('invalid_forum'));
	}
	elseif ($op=='edit')
	{
		if ($forum = db_fetch_array(db_query("select * from forum where forumid='$id'")))
		{
			adminlog("Edited forum - <b>$forum[name] ($forum[forumid])</b>");
			get_forum_store();
			if ($forumarray = get_forums(0))
			{
				while (list($forumextra, $forum_result) = each($forumarray))
				{
					for ($i=0; $i<$forum_result['depth']; $i++)
					{
						eval(store_template('indent'));
						$forums .= $indent;
					}
					eval(store_template('forums_forum'));
					$forums .= $forums_forum;
				}
				reset($forumarray);
				while (list($forumextra, $forum_result) = each($forumarray))
				{
					for ($i=0; $i<$forum_result['depth']; $i++)
					{
						eval(store_template('option_indention'));
						$forum_result['name'] = $option_indention.$forum_result['name'];
					}
					if ($forum_result['forumid']==$forum['forumid'])
						continue;
					if ($forum_result['forumid']==$forum['parentid'])
						$selected = true;
					else
						$selected = false;
					eval(store_template('forum_choice'));
					$forum_choices .= $forum_choice;
				}
			}
			$forum['description'] = htmlspecialchars($forum['description']);
			eval(get_template('edit_forum'));
		}
		else
			eval(get_template('invalid_forum'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if ($forum = db_fetch_array(db_query("select * from forum where forumid='$_POST[id]'")))
			{
				adminlog("Updated forum - <b>$forum[name] ($forum[forumid])</b>");
				if ($forum['forumid']==$parentid)
					$parentid = $forum['parentid'];
				if ($forumarray = get_forum_parents($forum['parentid']))
				{
					if (!$thread = db_fetch_array(db_query("select * from thread where forumid=$forum[forumid] order by threadid desc limit 1")))
					{
						$thread['lastpostid'] = 0;
						$thread['lastpostdate'] = 0;
						$thread['lastuserid'] = 0;
						$thread['lastusername'] = '';
					}
					while (list($forumextra, $forumbump) = each($forumarray))
					{
						if (!$lastthread = db_fetch_array(db_query("select * from thread where forumid=$forumbump[forumid] order by threadid desc limit 1")))
						{
							$lastthread['lastpostid'] = 0;
							$lastthread['lastpostdate'] = 0;
							$lastthread['lastuserid'] = 0;
							$lastthread['lastusername'] = '';
							$lastthread['iconid'] = 0;
							$lastthread['threadid'] = 0;
							$lastthread['name'] = '';
						}
						if (!$forumbump['forumid'])
							continue;
						if ($forumbump['lastpostid']==$thread['lastpostid'])
						{
							if ($lastforum = db_fetch_array(db_query("select * from forum where parentid=$forumbump[forumid] and forumid!=$forum[forumid] order by lastpostdate desc limit 1")))
							{
								if ($lastforum['lastpostid']>$lastthread['lastpostid'])
									$lastthread = $lastforum;
							}
							db_query("update forum set threadiconid='$lastthread[iconid]',lastthreadid='$lastthread[threadid]',lastforumid='$lastthread[forumid]',threadname='".addslashes(htmlunspecialchars($lastthread['name']))."',lastuserid=$lastthread[lastuserid],lastpostid=$lastthread[lastpostid],lastpostdate=$lastthread[lastpostdate],posts=posts-$forum[posts],threads=threads-$forum[threads],lastusername='".addslashes($lastthread['lastusername'])."' where forumid=$forumbump[forumid]");
						}
						else
							db_query("update forum set posts=posts-$forum[posts],threads=threads-$forum[threads] where forumid=$forumbump[forumid]");
					}
				}
				if ($forumarray = get_forum_parents($parentid))
				{
					if (!$lastthread = db_fetch_array(db_query("select * from thread where forumid=$forum[forumid] order by threadid desc limit 1")))
					{
						$lastthread['lastpostid'] = 0;
						$lastthread['lastpostdate'] = 0;
						$lastthread['lastuserid'] = 0;
						$lastthread['lastusername'] = '';
						$lastthread['iconid'] = 0;
							$lastthread['threadid'] = 0;
							$lastthread['name'] = '';
					}
					while (list($forumextra, $forumbump) = each($forumarray))
					{
						if (!$forumbump['forumid'])
							continue;
						if ($forumbump['lastpostdate']<=$lastthread['lastpostdate'])
							db_query("update forum set threadiconid='$lastthread[iconid]',lastthreadid='$lastthread[threadid]',lastforumid='$lastthread[forumid]',threadname='".addslashes(htmlunspecialchars($lastthread['name']))."',lastuserid=$lastthread[lastuserid],lastpostid=$lastthread[lastpostid],lastpostdate=$lastthread[lastpostdate],posts=posts+$forum[posts],threads=threads+$forum[threads],lastusername='".addslashes($lastthread['lastusername'])."' where forumid=$forumbump[forumid]");
						else
							db_query("update forum set posts=posts+$forum[posts],threads=threads+$forum[threads] where forumid=$forumbump[forumid]");
					}
				}
				$fourmquery = '';
				if ($forumarray = get_forums($forum['forumid']))
				{
					while (list($forumextra, $sub) = each($forumarray))
					{
						if (!$forumquery)
							$forumquery = "forumid=$sub[forumid]";
						$forumquery .= " or forumid=$sub[forumid]";
					}
				}
				if (!$forumquery)
					$forumquery = 'forumid=0';
				db_query("update forum set parentid=$forum[parentid] where forumid='$parentid' and ($forumquery)");
				if ($forum['parentid']!=$parentid)
				{
					$query = db_query("select * from moderator where forumid='$parentid'");
					while ($mod = db_fetch_array($query))
					{
						if (!db_num_rows(db_query("select userid from moderator where forumid=$forum[forumid] and userid=$mod[userid]")))
							db_query("insert into moderator (userid, username, forumid, editposts, editthreads, editpolls, deleteposts, close, massdelete, massmove, copymove, log, exemptfloodcheck, announcements, viewips, sticky, deletethreads) values ($mod[userid], '".addslashes($mod['username'])."', $forum[forumid], '$mod[editposts]', '$mod[editthreads]', '$mod[editpolls]', '$mod[deleteposts]', '$mod[close]', '$mod[massdelete]', '$mod[massmove]', '$mod[copymove]', '$mod[log]', '$mod[exemptfloodcheck]', '$mod[announcements]', '$mod[viewips]', '$mod[sticky]', '$mod[deletethreads]')");
					}
				}
				if ($link = trim(htmlspecialchars($_POST['link'])))
				{
					if (!strstr($link, '://'))
						$link = "http://$_POST[link]";
					$_POST['allow_posting'] = 0;
				}
				db_query("update forum set name='$name',ordered='$_POST[ordered]',allow_posting='$_POST[allow_posting]',parentid='$parentid',description='$_POST[description]',countposts='$_POST[countposts]',dpcode='$_POST[dpcode]',smilies='$_POST[smilies]',img='$_POST[img]',link='$link' where forumid='$forum[forumid]'");
				header('Location: forums.php');
			}
			else
				eval(get_template('invalid_forum'));
		}
		else
			eval(get_template('forums_missing'));
	}
	else
	{
		adminlog('Viewed forums panel');
		get_forum_store();
		if ($forumarray = get_forums(0))
		{
			while (list($forumextra, $forum_result) = each($forumarray))
			{
				for ($i=0; $i<$forum_result['depth']; $i++)
				{
					eval(store_template('indent'));
					$forums .= $indent;
				}
				eval(store_template('forums_forum'));
				$forums .= $forums_forum;
			}
			reset($forumarray);
			$selected = false;
			while (list($forumextra, $forum_result) = each($forumarray))
			{
				for ($i=0; $i<$forum_result['depth']; $i++)
				{
					eval(store_template('option_indention'));
					$forum_result['name'] = $option_indention.$forum_result['name'];
				}
				eval(store_template('forum_choice'));
				$forum_choices .= $forum_choice;
			}
		}
		eval(get_template('forums_index'));
	}
}
else
	eval(get_template('permission_error'));
?>