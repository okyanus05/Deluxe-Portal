<?php
/**************************************************
* Poll
* ----
* Allows the creation and viewing of polls.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'add_poll,add_poll_denied,add_poll_missing,invalid_thread,poll_option,poll_options,poll_result,poll_results,vote_poll_missing';
/**************************************************
* Global variable resetting                      */
unset($poll_choices);
unset($poll_options);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$choice = $_POST['choice'];
$days = $_REQUEST['days'];
$id = $_REQUEST['id'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$options = $_REQUEST['options'];
/*************************************************/

if ($thread = db_fetch_array(db_query("select thread.*,post.postdate,post.postid,post.html from thread,post where thread.threadid='$id' and thread.redirect=0 and post.threadid=thread.threadid order by postid asc limit 1")))
{
	$thread['name'] = censor($thread['name'], $config['censored_words']);
	$forum = get_forum_store($thread['forumid']);
	get_forum_nav($forum['forumid']);
	$readquery = 'forumid=0';
	if ($forumarray = get_forum_parents($forum['forumid']))
	{
		$forumarray = array_reverse($forumarray);
		while (list($forumextra, $forumnav) = each($forumarray))
			$readquery .= " or forumid=$forumnav[forumid]";
	}
	reset($forumstore);
	
	$perm = get_forum_permissions($forum);
	if ($op=='create')
	{
		if ($perm['startpolls'] && is_numeric($options) && $options>0)
		{
			$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid='$thread[threadid]'"));
			$options = (($options>$config['max_poll_options'] && !$group['supermod_editpolls'] && !$moderator['editpolls'] && $config['max_poll_options']) ? $config['max_poll_options'] : $options);
			for ($i=1; $i<=$options; $i++)
			{
				eval(store_template('poll_option'));
				$poll_options .= $poll_option;
			}
			$pagetitle = "Add poll - $thread[name]";
			eval(get_template('add_poll'));
		}
		elseif (!is_numeric($options) || $options<=0)
		{
			$pagetitle = 'Enter number of options';
			die(eval(get_template('poll_options')));
		}
		else
		{
			$pagetitle = 'Access denied';
			eval(get_template('permission_error'));
		}
	}
	elseif ($op=='options')
	{
		$pagetitle = 'Enter number of options';
		die(eval(get_template('poll_options')));
	}
	elseif ($op=='docreate')
	{
		if ($thread['poll'])
		{
			$pagetitle = 'Poll creation error';
			die(eval(get_template('add_poll_denied')));
		}
		$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$thread[forumid]"));
		if (!(($thread['userid']==$user['userid'] && $perm['startpolls']) || $group['supermod_editpolls'] || $moderator['editpolls']))
		{
			$pagetitle = 'Access denied';
			die(eval(get_template('permission_error')));
		}
		if (!is_numeric($options) || $options<=0)
		{
			$pagetitle = 'Enter number of options';
			die(eval(get_template('poll_options')));
		}
		$options = (($options>$config['max_poll_options'] && !$group['supermod_editpolls'] && !$moderator['editpolls'] && $config['max_poll_options']) ? $config['max_poll_options'] : $options);
		for ($i=1; $i<=$options; $i++)
		{
			if (!dp_trim($_POST["poll_$i"]))
			{
				$pagetitle = 'Missing poll choice';
				die(eval(get_template('add_poll_missing')));
			}
		}
		for ($i=1; $i<=$options; $i++)
		{
			$choice = dp_trim($_POST["poll_$i"]);
			$choice = censor($choice, $config['censored_words']);
			if (!$thread['html'] || !$group['html'])
				$choice = dp_htmlspecialchars($choice);
			db_query("insert into poll (threadid, choice, votes, ordered) values ('$thread[threadid]', '$choice', 0, $i)");
		}
		if (!$name = dp_htmlspecialchars(dp_trim($name)))
			$name = '.';
		$name = censor($name, $config['censored_words']);
		$multiple = ($_POST['multiple'] ? 1 : 0);
		if (!$_POST['expire'])
			$days = 0;
		db_query("update thread set poll='$name',poll_multiple=$multiple,poll_days='$days' where threadid='$thread[threadid]'");
		header("Location: thread.php?id=$thread[threadid]");
	}
	elseif ($op=='dovote')
	{
		if (!$perm['votepolls'] || (($thread['closed'] && !$group['supermod_close'] && !$moderator['close']) || ($thread['poll_days'] && ($current_time-$thread['postdate'])>($thread['poll_days']*86400))))
		{
			$pagetitle = 'Access denied';
			die(eval(get_template('permission_error')));
		}
		if ($thread['poll_multiple'])
		{
			$num_options = db_num_rows(db_query("select ordered from poll where threadid='$thread[threadid]'"));
			$didvote = false;
			for ($i=1; $i<=$num_options; $i++)
			{
				if ($_POST["poll_$i"])
				{
					$didvote = true;
					break;
				}
			}
			if (!$didvote)
			{
				$pagetitle = 'Voting error';
				die(eval(get_template('vote_poll_missing')));
			}
			for ($i=1; $i<=$num_options; $i++)
			{
				if ($_POST["poll_$i"])
				{
					db_query("update poll set votes=votes+1 where threadid='$thread[threadid]' and ordered=$i");
					db_query("insert into whovoted (threadid, choice, userid, ip) values ('$thread[threadid]', $i, $user[userid], '$_SERVER[REMOTE_ADDR]')");
				}
			}
		}
		else
		{
			if (!$choice)
			{
				$pagetitle = 'Voting error';
				die(eval(get_template('vote_poll_missing')));
			}
			db_query("update poll set votes=votes+1 where threadid='$thread[threadid]' and ordered='$choice'");
			db_query("insert into whovoted (threadid, choice, userid, ip) values ('$thread[threadid]', '$choice', $user[userid], '$_SERVER[REMOTE_ADDR]')");
		}
		header("Location: thread.php?id=$thread[threadid]");
	}
	elseif ($op=='results')
	{
		$color = 'cellalt';
		$bar = '6';
		$showresults = true;
		$message = '';
		$poll_extra = '';
		if (!$perm['viewthreads'])
		{
			$pagetitle = 'Access denied';
			die(eval(get_template('permission_error')));
		}
		if ($thread['poll']=='.')
			$pollname = $thread['name'];
		else
			$pollname = $thread['poll'];
		$total = 0;
		$query = db_query("select * from poll where threadid=$thread[threadid] order by ordered asc");
		while ($choice = db_fetch_array($query))
			$total += $choice['votes'];
		db_data_seek($query, 0);
		while ($choice = db_fetch_array($query))
		{
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
			eval(store_template('poll_result', '$poll_choice'));
			$poll_choices .= $poll_choice;
		}
		$pagetitle = 'Poll results';
		eval(get_template('poll_results'));
	}
}
else
{
	$pagetitle = 'Invalid thread';
	eval(get_template('invalid_thread'));
}
?>