<?php
/**************************************************
* Forum Permissions
* -----------------
* Manages forum permissions, allowing you to
* override default group permissions on a forum by
* forum basis.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'forumperm_deny,forumperm_edit,forumperm_end,forumperm_forum,forumperm_group,forumperm_index,forumperm_reset,forum_choice,group_choice,invalid_forum,invalid_forumperm';
/**************************************************
* Global variable resetting                      */
unset($forums);
unset($group_choices);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$forumid = $_REQUEST['forumid'];
$groupid = $_REQUEST['groupid'];
$close = $_POST['close'];
$copymove = $_POST['copymove'];
$deleteposts = $_POST['deleteposts'];
$deletethreads = $_POST['deletethreads'];
$editposts = $_POST['editposts'];
$editthreads = $_POST['editthreads'];
$postattachments = $_POST['postattachments'];
$postthreads = $_POST['postthreads'];
$replytoother = $_POST['replytoother'];
$replytoown = $_POST['replytoown'];
$startpolls = $_POST['startpolls'];
$viewattachments = $_POST['viewattachments'];
$viewforums = $_POST['viewforums'];
$viewthreads = $_POST['viewthreads'];
$votepolls = $_POST['votepolls'];
/*************************************************/

$pagetitle = 'Forum Permissions';

if ($group['forumperm'])
{
	if ($_REQUEST['op']=='edit')
	{
		if (!($perm = db_fetch_array(db_query("select * from forumpermission where groupid='$groupid' and forumid='$forumid'"))))
			die(eval(get_template('invalid_forumperm')));
		get_group_store();
		get_forum_store();
		get_permission_store();
		$previous_depth=-1;
		if ($forumarray = get_forums(0))
		{
			while(list($forumextra, $forum_result) = each($forumarray))
			{
				$oldforum = $forum_result;
				for ($i=0; $i<$forum_result['depth']; $i++)
				{
					eval(store_template('option_indention'));
					$forum_result['name'] = $option_indention.$forum_result['name'];
				}
				if ($forum_result['forumid']==$forumid)
				{
					$selected = true;
					$forum = $oldforum;
				}
				else
					$selected = false;
				eval(store_template('forum_choice'));
				$forum_choices .= $forum_choice;
				$forum_result['name'] = str_replace('\'', '\\\'', $oldforum['name']);
				$depth = $previous_depth - $forum_result['depth'];
				if ($depth>=0)
				{
					for ($i=0; $i<=$depth; $i++)
					{
						eval(store_template('forumperm_end'));
						$forums .= $forumperm_end;
					}
				}
				$previous_depth = $forum_result['depth'];
				eval(store_template('forumperm_forum', '$forum_res'));
				$forums .= $forum_res;
				$groups = '';
				while (list($groupextra, $group_result) = each($groupstore))
				{
					$group_result['name'] = str_replace('\'', '\\\'', $group_result['name']);
					$permnav = $permissionstore[$forum_result['forumid']][$group_result['groupid']];
					eval(store_template('forumperm_group', '$group_res'));
					$forums .= $group_res;
				}
				reset($groupstore);
			}
			$depth = $previous_depth + 1;
			if ($depth>0)
			{
				for ($i=0; $i<$depth; $i++)
				{
					eval(store_template('forumperm_end'));
					$forums .= $forumperm_end;
				}
			}
			while (list($groupextra, $group_result) = each($groupstore))
			{
				if ($group_result['groupid']==$groupid)
				{
					$groupres = $group_result;
					$selected = true;
				}
				else
					$selected = false;
				eval(store_template('group_choice'));
				$group_choices .= $group_choice;
			}
			$group_result = $groupres;
		}
		adminlog("Edited forum permission - <b>$perm[forumpermissionid]</b>, group <b>$group_result[name] ($perm[groupid])</b> in forum <b>$forum[name] ($perm[forumid])</b>");
		$type = $perm['type'];
		$perm = get_forum_permissions_group($forum, $groupres);
		$perm['type'] = $type;
		eval(get_template('forumperm_edit'));
	}
	elseif ($_POST['op']=='doedit')
	{
		$oldperm = db_fetch_array(db_query("select * from forumpermission where forumid='$forumid' and groupid='$groupid'"));
		adminlog("Updated forum permission - group <b>$groupid</b> in forum <b>$forumid</b>");
		$close = ($close ? 1 : 0);
		$copymove = ($copymove ? 1 : 0);
		$deleteposts = ($deleteposts ? 1 : 0);
		$deletethreads = ($deletethreads ? 1 : 0);
		$editposts = ($editposts ? 1 : 0);
		$editthreads = ($editthreads ? 1 : 0);
		$postattachments = ($postattachments ? 1 : 0);
		$postthreads = ($postthreads ? 1 : 0);
		$replytoother = ($replytoother ? 1 : 0);
		$replytoown = ($replytoown ? 1 : 0);
		$startpolls = ($startpolls ? 1 : 0);
		$viewattachments = ($viewattachments ? 1 : 0);
		$viewforums = ($viewforums ? 1 : 0);
		$viewthreads = ($viewthreads ? 1 : 0);
		$votepolls = ($votepolls ? 1 : 0);
		$forum = db_fetch_array(db_query("select * from forum where forumid='$forumid'"));
		
		if ($_POST['type']=='custom')
		{
			if ($oldperm['type']=='group')
			{
				if ($forumarray = get_forums($forumid))
				{
					while(list($forumextra, $forum_result) = each($forumarray))
						db_query("update forumpermission set type='parent' where forumid=$forum_result[forumid] and groupid='$groupid' and type='group'");
				}
			}
			db_query("update forumpermission set close=$close,copymove=$copymove,deleteposts=$deleteposts,deletethreads=$deletethreads,editposts=$editposts,editthreads=$editthreads,postattachments=$postattachments,postthreads=$postthreads,replytoother=$replytoother,replytoown=$replytoown,startpolls=$startpolls,viewattachments=$viewattachments,viewforums=$viewforums,viewthreads=$viewthreads,votepolls=$votepolls,type='custom' where groupid='$groupid' and forumid='$forumid'");
		}
		elseif ($_POST['type']=='group')
			db_query("update forumpermission set type='group' where forumid='$forumid' and groupid='$groupid'");
		else
		{
			if ($forum['parentid'])
			{
				if ($oldperm['type']=='group')
				{
					if ($forumarray = get_forums(0))
					{
						while(list($forumextra, $forum_result) = each($forumarray))
							db_query("update forumpermission set type='parent' where forumid=$forum_result[forumid] and groupid='$groupid' and type='group'");
					}
				}
				db_query("update forumpermission set type='parent' where forumid='$forumid' and groupid='$groupid'");
			}
		}
		header('Location: forumperm.php');
	}
	elseif ($_REQUEST['op']=='reset')
	{
		if (!$forum = db_fetch_array(db_query("select * from forum where forumid='$_REQUEST[id]'")))
			die(eval(get_template('invalid_forum')));
		eval(get_template('forumperm_reset'));
	}
	elseif ($_POST['op']=='doreset')
	{
		if (!$forum = db_fetch_array(db_query("select * from forum where forumid='$_POST[id]'")))
			die(eval(get_template('invalid_forum')));
		adminlog("Reset forum permissions - <b>$forum[name] ($forum[forumid])</b>".($_POST['subforums'] ? ' (including subforums)' : ''));
		if ($_POST['subforums'])
		{
			if ($forumarray = get_forums($forum['forumid']))
			{
				while(list($forumextra, $forum_result) = each($forumarray))
					db_query("update forumpermission set type='group' where forumid=$forum_result[forumid]");
			}
		}
		db_query("update forumpermission set type='group' where forumid=$forum[forumid]");
		header('Location: forumperm.php');
	}
	elseif ($_REQUEST['op']=='deny')
	{
		if (!$forum = db_fetch_array(db_query("select * from forum where forumid='$_REQUEST[id]'")))
			die(eval(get_template('invalid_forum')));
		eval(get_template('forumperm_deny'));
	}
	elseif ($_POST['op']=='dodeny')
	{
		if (!$forum = db_fetch_array(db_query("select * from forum where forumid='$_POST[id]'")))
			die(eval(get_template('invalid_forum')));
		adminlog("Quick deny forum permissions - <b>$forum[name] ($forum[forumid])</b>".($_POST['subforums'] ? ' (including subforums)' : ''));
		if ($_POST['subforums'])
		{
			if ($forumarray = get_forums($forum['forumid']))
			{
				while(list($forumextra, $forum_result) = each($forumarray))
					db_query("update forumpermission set type='parent' where forumid='$forum_result[forumid]'");
			}
		}
		db_query("update forumpermission set close=0,copymove=0,deleteposts=0,deletethreads=0,editposts=0,editthreads=0,postattachments=0,postthreads=0,replytoother=0,replytoown=0,startpolls=0,viewattachments=0,viewforums=0,viewthreads=0,votepolls=0,type='custom' where forumid='$forum[forumid]'");
		header('Location: forumperm.php');
	}
	else
	{
		adminlog('Viewed forum permissions panel');
		get_group_store();
		get_forum_store();
		get_permission_store();
		$previous_depth=-1;
		if ($forumarray = get_forums(0))
		{
			while(list($forumextra, $forum_result) = each($forumarray))
			{
				$forum_result['name'] = str_replace('\'', '\\\'', $forum_result['name']);
				$depth = $previous_depth - $forum_result['depth'];
				if ($depth>=0)
				{
					for ($i=0; $i<=$depth; $i++)
					{
						eval(store_template('forumperm_end'));
						$forums .= $forumperm_end;
					}
				}
				$previous_depth = $forum_result['depth'];
				eval(store_template('forumperm_forum', '$forum_res'));
				$forums .= $forum_res;
				$groups = '';
				while (list($groupextra, $group_result) = each($groupstore))
				{
					$group_result['name'] = str_replace('\'', '\\\'', $group_result['name']);
					$permnav = $permissionstore[$forum_result['forumid']][$group_result['groupid']];
					eval(store_template('forumperm_group', '$group_res'));
					$forums .= $group_res;
				}
				reset($groupstore);
			}
			$depth = $previous_depth + 1;
			if ($depth>0)
			{
				for ($i=0; $i<$depth; $i++)
				{
					eval(store_template('forumperm_end'));
					$forums .= $forumperm_end;
				}
			}
		}
		eval(get_template('forumperm_index'));
	}
}
else
	eval(get_template('permission_error'));
?>