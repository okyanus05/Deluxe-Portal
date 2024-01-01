<?php
/**************************************************
* Moderate
* --------
* Contains the moderating functions, such as thread
* deleting and poll editing.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'close_thread_redirect,copy_thread_redirect,delete_poll_redirect,delete_redirect_redirect,edit_poll,edit_poll_redirect,edit_thread,edit_thread_missing,edit_thread_redirect,forum_choice,invalid_thread,moderate_copymove,moderate_delete_redirect,moderate_delete_thread,moderate_delete_thread_redirect,moderate_log,moderate_no_redirect,moderate_poll_option,moderate_showlog,moderate_voter,moderate_whovoted,moderate_whovoted_result,move_thread_redirect,option_noposting,redirect_thread_redirect,reset_poll,reset_poll_redirect,sticky_thread_redirect';
/**************************************************
* Global variable resetting                      */
unset($poll_choices);
unset($poll_options);
unset($readquery);
unset($whovotedstore);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$days = $_REQUEST['days'];
$forumid = $_REQUEST['forumid'];
$id = $_REQUEST['id'];
$multiple = $_REQUEST['multiple'];
$name = $_REQUEST['name'];
$op = $_REQUEST['op'];
$page = $_REQUEST['page'];
$postid = $_REQUEST['postid'];
/*************************************************/

if ($thread = db_fetch_array(db_query("select * from thread where threadid='$id' and redirect=0")))
{
	$thread['uncensored_name'] = $thread['name'];
	$thread['name'] = censor($thread['name'], $config['censored_words']);
	$redirect_url = "thread.php?postid=$postid&id=$thread[threadid]&page=$page";
	$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$thread[forumid]"));
}
else
{
	$pagetitle = 'Invalid thread';
	die(eval(get_template('invalid_thread')));
}

$forum = get_forum_store($thread['forumid']);
get_forum_nav($forum['forumid']);
$forumarray = get_forum_parents($thread['forumid']);
$forumarray = array_reverse($forumarray);
while (list($forumextra, $forumnav) = each($forumarray))
{
	if (!$readquery)
		$readquery = "forumid=$forumnav[forumid]";
	else
		$readquery .= " or forumid=$forumnav[forumid]";
}
reset($forumstore);

$perm = get_forum_permissions($forum);
if ($op=='close' && ($group['supermod_close'] || $moderator['close'] || ($thread['userid']==$user['userid'] && $perm['close'])))
{
	if ($thread['closed'])
	{
		moderatorlog('Opened thread', $thread['threadid'], $thread['name']);
		db_query("update thread set closed=0 where threadid='$thread[threadid]'");
		$pagetitle = "Opening thread - $thread[name]";
		eval(get_template('close_thread_redirect'));
	}
	else
	{
		moderatorlog('Closed thread', $thread['threadid'], $thread['name']);
		db_query("update thread set closed=1 where threadid='$thread[threadid]'");
		$pagetitle = "Closing thread - $thread[name]";
		eval(get_template('close_thread_redirect'));
	}
}
elseif ($op=='delete' && ($group['supermod_deletethreads'] || $moderator['deletethreads']))
{
	if (!$thread['closed'] || $group['supermod_close'] || $moderator['close'])
	{
		$pagetitle = "Delete thread - $thread[name]";
		eval(get_template('moderate_delete_thread'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
elseif ($_POST['op']=='dodelete' && ($group['supermod_deletethreads'] || $moderator['deletethreads']))
{
	if (!$thread['closed'] || $group['supermod_close'] || $moderator['close'])
	{
		moderatorlog('Deleted thread', $thread['threadid'], $thread['name']);
		delete_thread($thread, $forum);
		$pagetitle = "Deleting thread - $thread[name]";
		$redirect_url = "forum_display.php?id=$thread[forumid]";
		eval(get_template('moderate_delete_thread_redirect'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
elseif ($op=='resetpoll' && ($group['supermod_editpolls'] || $moderator['editpolls']) && $thread['poll'])
{
	if (!$thread['closed'] || $group['supermod_close'] || $moderator['close'])
	{
		$pagetitle = "Reset poll - $thread[name]";
		eval(get_template('reset_poll'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
elseif ($_POST['op']=='doresetpoll' && ($group['supermod_editpolls'] || $moderator['editpolls']) && $thread['poll'])
{
	if (!$thread['closed'] || $group['supermod_close'] || $moderator['close'])
	{
		db_query("update poll set votes=0 where threadid='$thread[threadid]'");
		db_query("delete from whovoted where threadid='$thread[threadid]'");
		moderatorlog('Reset poll', $thread['threadid'], $thread['name']);
		$pagetitle = "Resetting poll - $thread[name]";
		eval(get_template('reset_poll_redirect'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
elseif ($op=='whovoted' && ($group['supermod_editpolls'] || $moderator['editpolls']) && $thread['poll'])
{
	moderatorlog('Viewed Who Voted', $thread['threadid'], $thread['name']);
	$query = db_query("select whovoted.*,user.name,groups.online_template from whovoted,user,groups where user.groupid=groups.groupid and whovoted.threadid=$thread[threadid] and whovoted.userid=user.userid and whovoted.userid>0 order by choice asc,name asc");
	$i = 0;
	while ($whovoted = db_fetch_array($query))
		$whovotedstore[$i++] = $whovoted;
	$query = db_query("select * from poll where threadid=$thread[threadid] order by ordered asc");
	$color = 'cellalt';
	$bar = '6';
	$message = '';
	$poll_extra = '';
	if ($thread['poll']=='.')
		$pollname = $thread['name'];
	else
		$pollname = $thread['poll'];
	$total = 0;
	db_data_seek($query, 0);
	while ($choice = db_fetch_array($query))
		$total += $choice['votes'];
	db_data_seek($query, 0);
	while ($choice = db_fetch_array($query))
	{
		$voters = '';
		$i = 0;
		while ($whovoted = $whovotedstore[$i++])
		{
			if ($whovoted['choice']==$choice['ordered'])
			{
				$user_result['name'] = $whovoted['name'];
				$user_result['userid'] = $whovoted['userid'];
				eval('$parsed_name = "'.addslashes($whovoted['online_template']).'";');
				eval(store_template('moderate_voter', '$voter'));
				$voters .= $voter;
			}
		}
		$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
		if ($forum['dpcode'])
			$choice['choice'] = dpcode_parse($choice['choice'], $forum['img']);
		if ($forum['smilies'])
			$choice['choice'] = smilie_parse($choice['choice']);
		if ($bar==6)
			$bar = 1;
		elseif ($bar==5)
			$bar = 6;
		elseif ($bar==4)
			$bar = 5;
		elseif ($bar==3)
			$bar = 4;
		elseif ($bar==2)
			$bar = 3;
		else
			$bar = 2;
		if ($total)
			$percent = round($choice['votes']/$total*100, 0);
		else
			$percent = 0;
		$width = ($percent*3).'px';
		
		eval(store_template('moderate_whovoted_result', '$poll_choice'));
		$poll_choices .= $poll_choice;
	}
	$pagetitle = "Who voted - $thread[name]";
	eval(get_template('moderate_whovoted'));
}
elseif ($op=='editpoll' && ($group['supermod_editpolls'] || $moderator['editpolls']) && $thread['poll'])
{
	if (!$thread['closed'] || $group['supermod_close'] || $moderator['close'])
	{
		moderatorlog('Edited poll', $thread['threadid'], $thread['name']);
		$firstpost = db_fetch_array(db_query("select html from post where threadid=$thread[threadid] order by postid asc limit 1"));
		$query = db_query("select * from poll where threadid=$thread[threadid] order by ordered asc");
		while ($choice = db_fetch_array($query))
		{
			$choice['choice'] = html_fix($choice['choice']);
			eval(store_template('moderate_poll_option'));
			$poll_options .= $moderate_poll_option;
		}
		$pagetitle = "Edit poll - $thread[name]";
		eval(get_template('edit_poll'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
elseif ($_POST['op']=='doeditpoll' && ($group['supermod_editpolls'] || $moderator['editpolls']) && $thread['poll'])
{
	if (!$thread['closed'] || $group['supermod_close'] || $moderator['close'])
	{
		moderatorlog('Updated poll', $thread['threadid'], $thread['name']);
		$firstpost = db_fetch_array(db_query("select html from post where threadid=$thread[threadid] order by postid asc limit 1"));
		$query = db_query("select * from poll where threadid=$thread[threadid] order by ordered asc");
		$presentoptions = 0;
		while ($choice = db_fetch_array($query))
		{
			if (trim($_POST["choice_$choice[ordered]"]))
				$presentoptions++;
		}
		if (!$presentoptions || $_POST['delete_poll'])
		{
			db_query("delete from poll where threadid='$thread[threadid]'");
			db_query("delete from whovoted where threadid='$thread[threadid]'");
			db_query("update thread set poll='' where threadid='$thread[threadid]'");
			$pagetitle = 'Deleting poll';
			die(eval(get_template('delete_poll_redirect')));
		}
		db_data_seek($query, 0);
		while ($poll_choice = db_fetch_array($query))
		{
			$choice = trim($_POST["choice_$poll_choice[ordered]"]);
			if (!$group['html'] || !$firstpost['html'])
				$choice = dp_htmlspecialchars($choice);
			$votes = $_POST["votes_$poll_choice[ordered]"];
			if (!$choice)
			{
				db_query("delete from poll where threadid='$thread[threadid]' and ordered=$poll_choice[ordered]");
				db_query("delete from whovoted where threadid='$thread[threadid]' and choice=$poll_choice[ordered]");
			}
			else
				db_query("update poll set choice='$choice',votes='$votes' where threadid='$thread[threadid]' and ordered=$poll_choice[ordered]");
			$ordered = $poll_choice['ordered'];
		}
		$ordered++;
		if ($_POST['add_1'])
		{
			$choice = trim($_POST['add_1']);
			if (!$group['html'] || !$firstpost['html'])
				$choice = dp_htmlspecialchars($choice);
			$votes = $_POST['add_votes_1'];
			db_query("insert into poll (threadid, choice, votes, ordered) values ('$thread[threadid]', '$choice', '$votes', $ordered)");
			$ordered++;
		}
		if ($_POST['add_2'])
		{
			$choice = trim($_POST['add_2']);
			if (!$group['html'] || !$firstpost['html'])
				$choice = dp_htmlspecialchars($choice);
			$votes = $_POST['add_votes_2'];
			db_query("insert into poll (threadid, choice, votes, ordered) values ('$thread[threadid]', '$choice', '$votes', $ordered)");
		}
		if (!$name = dp_htmlspecialchars(trim($name)))
			$name = '.';
		$multiple = ($multiple ? 1 : 0);
		if (!$_POST['expire'])
			$days = 0;
		db_query("update thread set poll='$name',poll_multiple=$multiple,poll_days='$days' where threadid='$thread[threadid]'");
		$pagetitle = 'Updating poll';
		eval(get_template('edit_poll_redirect'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
elseif ($op=='edit' && ($group['supermod_editthreads'] || $moderator['editthreads']))
{
	if (!$thread['closed'] || $group['supermod_close'] || $moderator['close'])
	{
		moderatorlog('Edited thread', $thread['threadid'], $thread['name']);
		$icons = display_icons($thread['iconid']);
		$pagetitle = "Edit thread - $thread[name]";
		eval(get_template('edit_thread'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
elseif ($op=='doedit' && ($group['supermod_editthreads'] || $moderator['editthreads']))
{
	if (!$thread['closed'] || $group['supermod_close'] || $moderator['close'])
	{
		if (!$name = trim($name))
		{
			$pagetitle = 'Thread subject missing';
			die(eval(get_template('edit_thread_missing')));
		}
		moderatorlog('Updated thread', $thread['threadid'], $thread['name']);
		$name = dp_htmlspecialchars($name);
		db_query("update thread set name='$name',iconid='$_POST[iconid]' where threadid='$thread[threadid]'");
		$forumarray = get_forum_parents($thread['forumid']);
		$inforums = '';
		while (list($forumextra, $forumbump) = each($forumarray))
			$inforums .= ",$forumbump[forumid]";
		if ($inforums)
			db_query("update forum set threadiconid='$_POST[iconid]',lastthreadid=$thread[threadid],threadname='".censor(htmlunspecialchars($name)).'\' where forumid in ('.substr($inforums, 1).") and lastthreadid=$thread[threadid]");
		$pagetitle = 'Updating thread';
		eval(get_template('edit_thread_redirect'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
elseif ($op=='stick' && ($group['supermod_sticky'] || $moderator['sticky']))
{
	if ($thread['sticky'])
	{
		moderatorlog('Unstuck thread', $thread['threadid'], $thread['name']);
		db_query("update thread set sticky=0 where threadid='$thread[threadid]'");
		$pagetitle = 'Unsticking thread';
		eval(get_template('sticky_thread_redirect'));
	}
	else
	{
		moderatorlog('Stuck thread', $thread['threadid'], $thread['name']);
		db_query("update thread set sticky=1 where threadid='$thread[threadid]'");
		$pagetitle = 'Sticking thread';
		eval(get_template('sticky_thread_redirect'));
	}
}
elseif ($op=='deleteredirect' && ($group['supermod_copymove'] || $moderator['copymove'] || ($thread['userid']==$user['userid'] && $perm['copymove'])))
{
	if ($redirect = db_fetch_array(db_query("select * from thread where redirect=$thread[threadid]")))
	{
		$pagetitle = "Delete redirect - $thread[name]";
		eval(get_template('moderate_delete_redirect'));
	}
	else
	{
		$pagetitle = 'No redirect';
		eval(get_template('moderate_no_redirect'));
	}
}
elseif ($_POST['op']=='dodeleteredirect' && ($group['supermod_copymove'] || $moderator['copymove'] || ($thread['userid']==$user['userid'] && $perm['copymove'])))
{
	if ($redirect = db_fetch_array(db_query("select * from thread where redirect=$thread[threadid]")))
	{
		moderatorlog('Deleted redirect', $thread['threadid'], $thread['name']);
		db_query("delete from thread where redirect='$thread[threadid]'");
		db_query("update thread set redirected=0 where threadid=$thread[threadid]");
		$pagetitle = 'Deleting redirect';
		eval(get_template('delete_redirect_redirect'));
	}
	else
	{
		$pagetitle = 'No redirect';
		eval(get_template('moderate_no_redirect'));
	}
}
elseif ($op=='move' && ($group['supermod_copymove'] || $moderator['copymove'] || ($thread['userid']==$user['userid'] && $perm['copymove'])))
{
	$selected = false;
	reset($forumstore);
	if ($forumarray = get_forums(0))
	{
		while (list($forumextra, $forum_result) = each($forumarray))
		{
			if ($forum_result['forumid']==$forum['forumid'])
				continue;
			$perm = get_forum_permissions($forum_result);
			if (!$perm['viewforums'])
				continue;
			for ($i=0; $i<$forum_result['depth']; $i++)
			{
				eval(store_template('option_indention'));
				$forum_result['name'] = $option_indention.$forum_result['name'];
			}
			if (!$perm['postthreads'])
			{
				eval(store_template('option_noposting'));
				$forum_result['name'] .= $option_noposting;
			}
			eval(store_template('forum_choice'));
			$forum_choices .= $forum_choice;
		}
	}
	$pagetitle = "Copy/move $thread[name]";
	eval(get_template('moderate_copymove'));
}
elseif ($op=='domove')
{
	get_forum_store();
	while (list($forumextra, $forum_result) = each($forumstore))
	{
		if ($forum_result['forumid']==$forumid)
		{
			$newforum = $forum_result;
			break;
		}
	}
	reset($forumstore);
	$perm = get_forum_permissions($newforum);
	if (!$perm['postthreads'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	reset($forumstore);
	$query = db_query("select groupid from groups where lockpostcount=1");
	while ($group_result = db_fetch_array($query))
		$groups[] = $group_result['groupid'];
	if ($_POST['operation']=='copy')
	{
		moderatorlog("Copied thread from <b>$forum[name]</b> (<b>$forum[forumid]</b>) to <b>$newforum[name]</b> (<b>$newforum[forumid]</b>)", $thread['threadid'], $thread['name']);
		$thread['name'] = addslashes($thread['name']);
		$thread['username'] = addslashes($thread['username']);
		$thread['lastusername'] = addslashes($thread['lastusername']);
		$thread['poll'] = addslashes($thread['poll']);
		db_query("insert into thread (name, iconid, userid, lastpostdate, lastuserid, posts, views, forumid, lastusername, username, lastpostid, closed, sticky, redirect, poll, poll_days, poll_multiple, hasattachment) values ('$thread[name]', $thread[iconid], $thread[userid], $thread[lastpostdate], $thread[userid], $thread[posts], $thread[views], '$newforum[forumid]', '$thread[lastusername]', '$thread[username]', $thread[lastpostid], $thread[closed], $thread[sticky], 0, '$thread[poll]', $thread[poll_days], $thread[poll_multiple], '$thread[hasattachment]')");
		$newthread = db_fetch_array(db_query("select * from thread where forumid='$newforum[forumid]' order by threadid desc limit 1"));
		$query = db_query("select * from poll where threadid=$thread[threadid]");
		while ($poll = db_fetch_array($query))
			db_query("insert into poll (threadid, choice, votes, ordered) values ($newthread[threadid], '$poll[choice]', $poll[votes], $poll[ordered])");
		$query = db_query("select * from whovoted where threadid=$thread[threadid]");
		while ($whovoted = db_fetch_array($query))
			db_query("insert into whovoted (userid, threadid, choice, ip) values ($whovoted[userid], $newthread[threadid], $whovoted[choice], '$whovoted[ip]')");
		$query = db_query("select user.posts,attachment.*,post.*,usergroups from user,post left join attachment on post.postid=attachment.postid where post.userid=user.userid and post.threadid='$thread[threadid]' group by post.postid order by post.postid asc");
		while ($post = db_fetch_array($query))
		{
			$post['subject'] = addslashes($post['subject']);
			$post['message'] = addslashes($post['message']);
			$post['username'] = addslashes($post['username']);
			$post['editedby_username'] = addslashes($post['editedby_username']);
			$post['parsed_message'] = addslashes($post['parsed_message']);
			$query2 = db_query("insert into post (threadid, iconid, subject, message, userid, postdate, ip, username, dpcode, smilies, showsignature, editedby_userid, editedby_username, editedby_date, url, html, parsed_message) values ($newthread[threadid], $post[iconid], '$post[subject]', '$post[message]', $post[userid], $post[postdate], '$post[ip]', '$post[username]', '$post[dpcode]', '$post[smilies]', '$post[showsignature]', '$post[editedby_userid]', '$post[editedby_username]', '$post[editedby_date]', '$post[url]', '$post[html]', '$post[parsed_message]')");
			if ($post['size'])
			{
				$post['type'] = addslashes($post['type']);
				$post['name'] = addslashes($post['name']);
				$post['attachment'] = addslashes($post['attachment']);
				$id = db_insert_id();
				db_query("insert into attachment (postid, name, attachment, type, size) values ('$id', '$post[name]', '$post[attachment]', '$post[type]', '$post[size]')");
			}
			if ($newforum['countposts'])
			{
				$lock = false;
				if ($groups)
				{
					foreach ($groups as $group_result)
					{
						if (in_set($group_result, $post['usergroups']))
							$lock = true;
					}
				}
				if (!$lock)
					db_query("update user set posts=posts+1 where userid=$post[userid]");
			}
		}
		$lastpost = db_fetch_array(db_query("select * from post where threadid=$newthread[threadid] order by postid desc limit 1"));
		db_query("update thread set lastpostid='$lastpost[postid]' where threadid=$newthread[threadid]");
		$forumarray = get_forum_parents($newforum['forumid']);
		while (list($forumextra, $forumbump) = each($forumarray))
		{
			if ($forumbump['lastpostdate']<=$thread['lastpostdate'])
				db_query("update forum set threadiconid=$newthread[iconid],lastthreadid=$newthread[threadid],lastforumid=$newthread[forumid],threadname='".addslashes(htmlunspecialchars($newthread['name']))."',lastuserid=$newthread[lastuserid],lastpostid=$lastpost[postid],lastpostdate=$newthread[lastpostdate],posts=posts+$thread[posts],threads=threads+1,lastusername='$newthread[lastusername]' where forumid=$forumbump[forumid]");
			else
				db_query("update forum set posts=posts+$thread[posts],threads=threads+1 where forumid=$forumbump[forumid]");
		}
		$redirect_url = "thread.php?id=$newthread[threadid]";
		$pagetitle = "Copying $thread[name]";
		die(eval(get_template('copy_thread_redirect')));
	}
	elseif ($_POST['operation']=='redirect')
	{
		moderatorlog("Moved thread with redirect from <b>$forum[name]</b> (<b>$forum[forumid]</b>) to <b>$newforum[name]</b> (<b>$newforum[forumid]</b>)", $thread['threadid'], $thread['name']);
		$thread['name'] = addslashes($thread['name']);
		$thread['username'] = addslashes($thread['username']);
		$thread['lastusername'] = addslashes($thread['lastusername']);
		db_query("delete from thread where redirect=$thread[threadid]");
		db_query("insert into thread (name, iconid, userid, lastpostdate, lastuserid, posts, views, forumid, lastusername, username, lastpostid, closed, sticky, redirect, poll, poll_days, poll_multiple, redirected) values ('$thread[name]', $thread[iconid], $thread[userid], $thread[lastpostdate], $thread[userid], 0, 0, $thread[forumid], '$thread[lastusername]', '$thread[username]', $thread[lastpostid], 0, 0, '$thread[threadid]', '', 0, 0, 0)");
		db_query("update thread set forumid='$newforum[forumid]',redirected=1 where threadid='$thread[threadid]'");
		if ($forum['countposts'] && !$newforum['countposts'])
		{
			$query = db_query("select user.userid,usergroups from post,user where post.threadid='$thread[threadid]' and post.userid=user.userid");
			while ($user_result = db_fetch_array($query))
			{
				$lock = false;
				if ($groups)
				{
					foreach ($groups as $group_result)
					{
						if (in_set($group_result, $user_result['usergroups']))
							$lock = true;
					}
				}
				if (!$lock)
					db_query("update user set posts=posts-1 where userid=$user_result[userid]");
			}
		}
		elseif (!$forum['countposts'] && $newforum['countposts'])
		{
			$query = db_query("select user.userid,usergroups from post,user where post.threadid='$thread[threadid]' and post.userid=user.userid");
			while ($user_result = db_fetch_array($query))
			{
				$lock = false;
				if ($groups)
				{
					foreach ($groups as $group_result)
					{
						if (in_set($group_result, $user_result['usergroups']))
							$lock = true;
					}
				}
				if (!$lock)
					db_query("update user set posts=posts+1 where userid=$user_result[userid]");
			}
		}
		$lastthread = db_fetch_array(db_query("select * from thread where forumid=$thread[forumid] and redirect=0 order by lastpostdate desc limit 1"));
		if (!$lastthread['lastpostid'])
		{
			$lastthread['lastuserid'] = 0;
			$lastthread['iconid'] = 0;
			$lastthread['threadid'] = 0;
			$lastthread['lastpostid'] = 0;
			$lastthread['forumid'] = 0;
			$lastthread['lastpostdate'] = 0;
			$lastthread['lastusername'] = '';
		}
		$forumarray = get_forum_parents($thread['forumid']);
		while (list($forumextra, $forumbump) = each($forumarray))
		{
			if ($forumbump['lastpostdate']<$lastthread['lastpostdate'] || $forumbump['lastpostid']==$thread['lastpostid'])
				db_query("update forum set threadiconid=$lastthread[iconid],lastthreadid=$lastthread[threadid],lastforumid=$lastthread[forumid],threadname='".addslashes(htmlunspecialchars($lastthread['name']))."',lastuserid=$lastthread[lastuserid],lastpostid=$lastthread[lastpostid],lastpostdate=$lastthread[lastpostdate],posts=posts-$thread[posts],threads=threads-1,lastusername='".addslashes($lastthread['lastusername'])."' where forumid=$forumbump[forumid]");
			else
				db_query("update forum set posts=posts-$thread[posts],threads=threads-1 where forumid=$forumbump[forumid]");
		}
		unset($forumarray);
		$forumarray_nav = '';
		$forumindex_nav = 0;
		unset($forumstore);
		$forumarray = get_forum_parents($newforum['forumid']);
		while (list($forumextra, $forumbump) = each($forumarray))
		{
			if ($forumbump['lastpostdate']<=$thread['lastpostdate'])
				db_query("update forum set threadiconid=$thread[iconid],lastthreadid=$thread[threadid],lastforumid=$thread[forumid],threadname='".addslashes(htmlunspecialchars($thread['name']))."',lastuserid=$thread[lastuserid],lastpostid=$thread[lastpostid],lastpostdate=$thread[lastpostdate],posts=posts+$thread[posts],threads=threads+1,lastusername='$thread[lastusername]' where forumid=$forumbump[forumid]");
			else
				db_query("update forum set posts=posts+$thread[posts],threads=threads+1 where forumid=$forumbump[forumid]");
		}
		$redirect_url = "thread.php?id=$thread[threadid]";
		$pagetitle = "Moving $thread[name]";
		die(eval(get_template('redirect_thread_redirect')));
	}
	else
	{
		moderatorlog("Moved thread from <b>$forum[name]</b> (<b>$forum[forumid]</b>) to <b>$newforum[name]</b> (<b>$newforum[forumid]</b>)", $thread['threadid'], $thread['name']);
		db_query("update thread set forumid='$newforum[forumid]' where threadid='$thread[threadid]'");
		if ($forum['countposts'] && !$newforum['countposts'])
		{
			$query = db_query("select user.userid,usergroups from post,user where post.threadid='$thread[threadid]' and post.userid=user.userid");
			while ($user_result = db_fetch_array($query))
			{
				$lock = false;
				if ($groups)
				{
					foreach ($groups as $group_result)
					{
						if (in_set($group_result, $user_result['usergroups']))
							$lock = true;
					}
				}
				if (!$lock)
					db_query("update user set posts=posts-1 where userid=$user_result[userid]");
			}
		}
		elseif (!$forum['countposts'] && $newforum['countposts'])
		{
			$query = db_query("select user.userid,usergroups from post,user where post.threadid='$thread[threadid]' and post.userid=user.userid");
			while ($user_result = db_fetch_array($query))
			{
				$lock = false;
				if ($groups)
				{
					foreach ($groups as $group_result)
					{
						if (in_set($group_result, $user_result['usergroups']))
							$lock = true;
					}
				}
				if (!$lock)
					db_query("update user set posts=posts+1 where userid=$user_result[userid]");
			}
		}
		$lastthread = db_fetch_array(db_query("select * from thread where forumid=$thread[forumid] and redirect=0 order by lastpostdate desc limit 1"));
		if (!$lastthread['lastpostid'])
		{
			$lastthread['lastuserid'] = 0;
			$lastthread['lastpostid'] = 0;
			$lastthread['forumid'] = 0;
			$lastthread['iconid'] = 0;
			$lastthread['threadid'] = 0;
			$lastthread['lastpostdate'] = 0;
			$lastthread['lastusername'] = '';
		}
		$forumarray = get_forum_parents($thread['forumid']);
		while (list($forumextra, $forumbump) = each($forumarray))
		{
			if ($forumbump['lastpostdate']<$lastthread['lastpostdate'] || $forumbump['lastpostid']==$thread['lastpostid'])
				db_query("update forum set threadiconid=$lastthread[iconid],lastthreadid=$lastthread[threadid],lastforumid=$lastthread[forumid],threadname='".addslashes(htmlunspecialchars($lastthread['name']))."',lastuserid=$lastthread[lastuserid],lastpostid=$lastthread[lastpostid],lastpostdate=$lastthread[lastpostdate],posts=posts-$thread[posts],threads=threads-1,lastusername='".addslashes($lastthread['lastusername'])."' where forumid=$forumbump[forumid]");
			else
				db_query("update forum set posts=posts-$thread[posts],threads=threads-1 where forumid=$forumbump[forumid]");
		}
		unset($forumarray);
		$forumarray_nav = '';
		$forumindex_nav = 0;
		unset($forumstore);
		$forumarray = get_forum_parents($newforum['forumid']);
		while (list($forumextra, $forumbump) = each($forumarray))
		{
			if ($forumbump['lastpostdate']<=$thread['lastpostdate'])
				db_query("update forum set threadiconid=$thread[iconid],lastthreadid=$thread[threadid],lastforumid=$thread[forumid],threadname='".addslashes(htmlunspecialchars($thread['name']))."',lastuserid=$thread[lastuserid],lastpostid=$thread[lastpostid],lastpostdate=$thread[lastpostdate],posts=posts+$thread[posts],threads=threads+1,lastusername='".addslashes($thread['lastusername'])."' where forumid=$forumbump[forumid]");
			else
				db_query("update forum set posts=posts+$thread[posts],threads=threads+1 where forumid=$forumbump[forumid]");
		}
		db_query("delete from thread where redirect=$thread[threadid] and forumid='$newforum[forumid]'");
		$redirect_url = "thread.php?id=$thread[threadid]";
		$pagetitle = "Moving $thread[name]";
		die(eval(get_template('move_thread_redirect')));
	}
}
elseif ($op=='log' && ($group['supermod_log'] || $moderator['log']))
{
	moderatorlog('Viewed thread log', $thread['threadid'], $thread['name']);
	$query = db_query("select * from moderatorlog where threadid='$thread[threadid]' order by logdate desc");
	$color = 'cellalt';
	while ($modlog = db_fetch_array($query))
	{
		$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
		$modlog['parsed_date'] = time_adjust($modlog['logdate'], $style['log_date_format']);
		eval(store_template('moderate_log', '$log'));
		$logs .= $log;
	}
	$pagetitle = "Moderator log - $thread[name]";
	eval(get_template('moderate_showlog'));
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>