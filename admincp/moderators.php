<?php
/**************************************************
* Moderators
* ----------
* Manages forum moderators (users with special
* permissions, such as the ability to edit other
* users' posts.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_moderator,delete_moderator,edit_moderator,forum_choice,indent,invalid_forum,invalid_moderator,invalid_user,moderators_duplicate,moderators_forum,moderators_index,moderators_moderator';
/**************************************************
* Global variable resetting                      */
unset($forum_choices);
unset($forums);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$announcements = $_POST['announcements'];
$close = $_POST['close'];
$copymove = $_POST['copymove'];
$deleteposts = $_POST['deleteposts'];
$deletethreads = $_POST['deletethreads'];
$editpolls = $_POST['editpolls'];
$editposts = $_POST['editposts'];
$editthreads = $_POST['editthreads'];
$exemptfloodcheck = $_POST['exemptfloodcheck'];
$forumid = $_POST['forumid'];
$id = $_REQUEST['id'];
$log = $_POST['log'];
$massdelete = $_POST['massdelete'];
$massmove = $_POST['massmove'];
$op = $_REQUEST['op'];
$sticky = $_POST['sticky'];
$viewips = $_POST['viewips'];
/*************************************************/

$pagetitle = 'Moderators';

if ($group['moderators'])
{
	if ($op=='add')
	{
		get_forum_store();
		if ($forumarray = get_forums(0))
		{
			while (list($forumextra, $forum_result) = each($forumarray))
			{
				if ($forum_result['forumid']==$id)
					$forum = $forum_result;
				for ($i=0; $i<$forum_result['depth']; $i++)
				{
					eval(store_template('option_indention'));
					$forum_result['name'] = $option_indention.$forum_result['name'];
				}
				if ($forum_result['forumid']==$forum['forumid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('forum_choice'));
				$forum_choices .= $forum_choice;
			}
		}
		eval(get_template('add_moderator'));
	}
	elseif ($_POST['op']=='doadd')
	{
		if ($user_result = db_fetch_array(db_query("select * from user where name='".htmlspecialchars($_POST['username'])."'")))
		{
			if ($forum = db_fetch_array(db_query("select * from forum where forumid='$forumid'")))
			{
				if ($duplicate = db_fetch_array(db_query("select * from moderator where userid=$user_result[userid] and forumid='$forumid'")))
					die(eval(get_template('moderators_duplicate')));
				adminlog("Added moderator - <b>$user_result[name] ($user_result[userid])</b> to forum <b>$forum[name] ($forum[forumid])</b>");
				$announcements = ($announcements ? 1 : 0);
				$close = ($close ? 1 : 0);
				$copymove = ($copymove ? 1 : 0);
				$deleteposts = ($deleteposts ? 1 : 0);
				$deletethreads = ($deletethreads ? 1 : 0);
				$editpolls = ($editpolls ? 1 : 0);
				$editposts = ($editposts ? 1 : 0);
				$editthreads = ($editthreads ? 1 : 0);
				$exemptfloodcheck = ($exemptfloodcheck ? 1 : 0);
				$log = ($log ? 1 : 0);
				$massdelete = ($massdelete ? 1 : 0);
				$massmove = ($massmove ? 1 : 0);
				$sticky = ($sticky ? 1 : 0);
				$viewips = ($viewips ? 1 : 0);
				db_query("insert into moderator (userid, username, forumid, editposts, editthreads, editpolls, deleteposts, close, massdelete, massmove, copymove, log, exemptfloodcheck, announcements, viewips, sticky, deletethreads) values ($user_result[userid], '".addslashes($user_result['name'])."', '$forumid', '$editposts', '$editthreads', '$editpolls', '$deleteposts', '$close', '$massdelete', '$massmove', '$copymove', '$log', '$exemptfloodcheck', '$announcements', '$viewips', '$sticky', '$deletethreads')");
				get_forum_store();
				if ($forumarray = get_forums($forumid))
				{
					while (list($forumextra, $forum) = each($forumarray))
					{
						if (!db_num_rows(db_query("select userid from moderator where forumid=$forum[forumid] and userid=$user_result[userid]")))
							db_query("insert into moderator (userid, username, forumid, editposts, editthreads, editpolls, deleteposts, close, massdelete, massmove, copymove, log, exemptfloodcheck, announcements, viewips, sticky, deletethreads) values ($user_result[userid], '".addslashes($user_result['name'])."', '$forum[forumid]', '$editposts', '$editthreads', '$editpolls', '$deleteposts', '$close', '$massdelete', '$massmove', '$copymove', '$log', '$exemptfloodcheck', '$announcements', '$viewips', '$sticky', '$deletethreads')");
					}
				}
				header('Location: moderators.php');
			}
			else
				eval(get_template('invalid_forum'));
		}
		else
			eval(get_template('invalid_user'));
	}
	elseif ($op=='delete')
	{
		if ($moderator = db_fetch_array(db_query("select * from moderator where moderatorid='$id'")))
		{
			$forum = db_fetch_array(db_query("select * from forum where forumid=$moderator[forumid]"));
			eval(get_template('delete_moderator'));
		}
		else
			eval(get_template('invalid_moderator'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($moderator = db_fetch_array(db_query("select * from moderator where moderatorid='$_POST[id]'")))
		{
			adminlog("Deleted moderator - <b>$moderator[moderatorid]</b>, user <b>$moderator[username] ($moderator[userid])</b> from forum <b>$moderator[forumid]</b>");
			db_query("delete from moderator where moderatorid='$moderator[moderatorid]'");
			if ($_POST['subforums'] && ($forumarray = get_forums($moderator['forumid'])))
			{
				foreach ($forumarray as $forum)
					db_query("delete from moderator where forumid='$forum[forumid]' and userid='$moderator[userid]'");
			}
			header('Location: moderators.php');
		}
		else
			eval(get_template('invalid_moderator'));
	}
	elseif ($op=='edit')
	{
		if ($moderator = db_fetch_array(db_query("select * from moderator where moderatorid='$id'")))
		{
			$forum = db_fetch_array(db_query("select * from forum where forumid=$moderator[forumid]"));
			adminlog("Edited moderator - <b>$moderator[moderatorid]</b>, user <b>$moderator[username] ($moderator[userid])</b> in forum <b>$forum[name] ($forum[forumid])</b>");
			get_forum_store();
			if ($forumarray = get_forums(0))
			{
				while (list($forumextra, $forum_result) = each($forumarray))
				{
					if ($forum_result['forumid']==$moderator['forumid'])
						$forum = $forum_result;
					for ($i=0; $i<$forum_result['depth']; $i++)
					{
						eval(store_template('option_indention'));
						$forum_result['name'] = $option_indention.$forum_result['name'];
					}
					if ($forum_result['forumid']==$moderator['forumid'])
						$selected = true;
					else
						$selected = false;
					eval(store_template('forum_choice'));
					$forum_choices .= $forum_choice;
				}
			}
			eval(get_template('edit_moderator'));
		}
		else
			eval(get_template('invalid_forum'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($moderator = db_fetch_array(db_query("select * from moderator where moderatorid='$id'")))
		{
			if ($user_result = db_fetch_array(db_query("select * from user where name='".htmlspecialchars($_POST['username'])."'")))
			{
				if ($forumid && db_num_rows(db_query("select * from forum where forumid='$forumid'")))
				{
					if ($duplicate = db_fetch_array(db_query("select * from moderator where userid=$user_result[userid] and forumid='$forumid' and moderatorid!='$moderator[moderatorid]'")))
						eval(get_template('moderators_duplicate'));
					else
					{
						adminlog("Updated moderator - <b>$moderator[moderatorid]</b>, user <b>$moderator[username] ($moderator[userid])</b> in forum <b>$moderator[forumid]</b>");
						$announcements = ($announcements ? 1 : 0);
						$close = ($close ? 1 : 0);
						$copymove = ($copymove ? 1 : 0);
						$deleteposts = ($deleteposts ? 1 : 0);
						$deletethreads = ($deletethreads ? 1 : 0);
						$editpolls = ($editpolls ? 1 : 0);
						$editposts = ($editposts ? 1 : 0);
						$editthreads = ($editthreads ? 1 : 0);
						$exemptfloodcheck = ($exemptfloodcheck ? 1 : 0);
						$log = ($log ? 1 : 0);
						$massdelete = ($massdelete ? 1 : 0);
						$massmove = ($massmove ? 1 : 0);
						$sticky = ($sticky ? 1 : 0);
						$viewips = ($viewips ? 1 : 0);
						db_query('update moderator set username=\''.addslashes($user_result['name'])."',userid=$user_result[userid],forumid='$forumid',announcements='$announcements',log='$log',close=$close,copymove=$copymove,deleteposts=$deleteposts,deletethreads='$deletethreads',editpolls='$editpolls',editposts=$editposts,editthreads=$editthreads,exemptfloodcheck=$exemptfloodcheck,massdelete='$massdelete',massmove='$massmove',sticky='$sticky',viewips='$viewips' where moderatorid='$moderator[moderatorid]'");
						if ($forumid != $moderator['forumid'])
						{
							get_forum_store();
							$forumarray = get_forums($forumid);
							if ($forumarray)
							{
								while (list($forumextra, $forum) = each($forumarray))
								if (!db_num_rows(db_query("select userid from moderator where forumid=$forum[forumid] and userid=$user_result[userid]")))
									db_query("insert into moderator (userid, username, forumid, editposts, editthreads, editpolls, deleteposts, close, massdelete, massmove, copymove, log, exemptfloodcheck, announcements, viewips, sticky, deletethreads) values ($user_result[userid], '".addslashes($user_result['name'])."', '$forum[forumid]', '$editposts', '$editthreads', '$editpolls', '$deleteposts', '$close', '$massdelete', '$massmove', '$copymove', '$log', '$exemptfloodcheck', '$announcements', '$viewips', '$sticky', '$deletethreads')");
							}
						}
						header('Location: moderators.php');
					}
				}
				else
					eval(get_template('invalid_forum'));
			}
			else
				eval(get_template('invalid_user'));
		}
		else
			eval(get_template('invalid_moderator'));
	}
	else
	{
		adminlog('Viewed moderators panel');
		$query = db_query('select * from moderator');
		$i = 0;
		while ($moderator_result = db_fetch_array($query))
			$moderatorstore[$i++] = $moderator_result;
		get_forum_store();
		if ($forumarray = get_forums(0))
		{
			while (list($forumextra, $forum) = each($forumarray))
			{
				$moderator_result = '';
				$moderator_indent = '';
				$moderators = '';
				for ($i=0; $i<$forum['depth']; $i++)
				{
					eval(store_template('indent'));
					$forums .= $indent;
					$moderator_indent .= $indent;
				}
				if ($moderatorstore)
				{
					while (list($key, $moderator) = each($moderatorstore))
					{
						if ($moderator['forumid']==$forum['forumid'])
						{
							eval(store_template('moderators_moderator', '$moderator_result'));
							$moderators .= $moderator_result;
						}
					}
					reset($moderatorstore);
				}
				eval(store_template('moderators_forum'));
				$forums .= $moderators_forum;
			}
		}
		eval(get_template('moderators_index'));
	}
}
else
	eval(get_template('permission_error'));
?>