<?php
/**************************************************
* Announcements
* -------------
* Allows the management of forum announcements.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_announcement,announcements_announcement,announcements_date,announcements_forum,announcements_index,announcements_missing,delete_announcement,edit_announcement,forum_choice,forum_noposting,indent,invalid_announcement,invalid_forum,option_noposting';
/**************************************************
* Global variable resetting                      */
unset($forum_choices);
unset($forums);
unset($smilie_box);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$dpcode = $_POST['dpcode'];
$end = $_POST['end'];
$forumid = $_POST['forumid'];
$id = $_REQUEST['id'];
$message = $_POST['message'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$smilies = $_POST['smilies'];
$start = $_POST['start'];
$url = $_POST['url'];
/*************************************************/

$pagetitle = 'Announcements';

if ($group['supermod_announcements'] || $modperm['announcements'])
{
	if ($op=='add')
	{
		$query = db_query("select * from moderator where userid=$user[userid]");
		$i = 0;
		while ($moderator_result = db_fetch_array($query))
			$moderatorstore[$moderator_result['forumid']] = $moderator_result;
		get_forum_store();
		if ($forumarray = get_forums(0))
		{
			reset($forumstore);
			while (list($forumextra, $forum_result) = each($forumarray))
			{
				$perm = get_forum_permissions($forum_result);
				if (!$perm['viewforums'] && !$group['supermod_announcements'] && !$moderatorstore[$forum['forumid']]['announcements'])
					continue;
				for ($i=0; $i<$forum_result['depth']; $i++)
				{
					eval(store_template('option_indention'));
					$forum_result['name'] = $option_indention.$forum_result['name'];
				}
				if (!$group['supermod_announcements'] && !$moderatorstore[$forum_result['forumid']]['announcements'])
				{
					eval(store_template('forum_noposting'));
					$forum_result['name'] .= $forum_noposting;
				}
				if ($forum_result['forumid']==$id)
					$selected = true;
				else
					$selected = false;
				eval(store_template('forum_choice'));
				$forum_choices .= $forum_choice;
			}
		}
		if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
			$allforums = false;
		else
			$allforums = true;
		$start_date = date('Y-m-d');
		$end_date = date('Y-m-d', $current_time+2592000);
		if ($config['number_smilies'])
			$smilie_box = smilie_box();
		eval(get_template('add_announcement'));
	}
	elseif ($op=='doadd')
	{
		if (($name=trim(htmlspecialchars($name))) && $start && $end && ($message=trim($message)))
		{
			if (strtotime($end)<strtotime($start))
				die(eval(get_template('announcements_date')));
			if ($forumid)
			{
				if (!$forum = db_fetch_array(db_query("select * from forum where forumid='$forumid'")))
					die(eval(get_template('invalid_forum')));
				if (!$group['supermod_announcements'])
				{
					$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid='$forumid'"));
					if (!$moderator['attachments'])
						die(eval(get_template('permission_error')));
				}
			}
			else
			{
				$forum['name'] = 'All forums';
				if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
					die(eval(get_template('permission_error')));
			}
			moderatorlog("Added announcement - <b>$name</b> to forum <b>$forum[name] ($forumid)</b>", 0, '');
			$url = ($url ? 1 : 0);
			if ($url)
				$message = auto_url($message);
			$dpcode = ($dpcode ? 0 : 1);
			$smilies = ($smilies ? 0 : 1);
			$body = wysiwyg_parse($message, $smilies, true);
			db_query("insert into announcement (name, forumid, body, start, end, dpcode, smilies, userid, username, url) values ('$name', '$forumid', '$body', UNIX_TIMESTAMP('$start'), UNIX_TIMESTAMP('$end'), $dpcode, $smilies, $user[userid], '".addslashes($user['name'])."', $url)");
			header('Location: announcements.php');
		}
		else
			eval(get_template('announcements_missing'));
	}
	elseif ($op=='delete')
	{
		if ($announcement = db_fetch_array(db_query("select * from announcement where announcementid='$id'")))
		{
			if ($announcement['forumid'])
			{
				if (!$group['supermod_announcements'])
				{
					$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$announcement[forumid]"));
					if (!$moderator['announcements'])
						die(eval(get_template('permission_error')));
				}
			}
			else
			{
				if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
					die(eval(get_template('permission_error')));
			}
			eval(get_template('delete_announcement'));
		}
		else
			eval(get_template('invalid_announcement'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($announcement = db_fetch_array(db_query("select * from announcement where announcementid='$_POST[id]'")))
		{
			if ($announcement['forumid'])
			{
				if (!$group['supermod_announcements'])
				{
					$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$announcement[forumid]"));
					if (!$moderator['announcements'])
						die(eval(get_template('permission_error')));
				}
			}
			else
			{
				if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
					die(eval(get_template('permission_error')));
			}
			moderatorlog("Deleted announcement <b>$announcement[name] ($announcement[announcementid])</b>", 0, '');
			db_query("delete from announcement where announcementid='$announcement[announcementid]'");
			header('Location: announcements.php');
		}
		else
			eval(get_template('invalid_announcement'));
	}
	elseif ($op=='edit')
	{
		if ($announcement = db_fetch_array(db_query("select * from announcement where announcementid='$id'")))
		{
			if ($announcement['forumid'])
			{
				if (!$group['supermod_announcements'])
				{
					$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$announcement[forumid]"));
					if (!$moderator['announcements'])
						die(eval(get_template('permission_error')));
				}
			}
			else
			{
				if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
					die(eval(get_template('permission_error')));
			}
			if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
				$allforums = false;
			else
				$allforums = true;
			get_forum_store();
			if ($forumarray = get_forums(0))
			{
				reset($forumstore);
				while (list($forumextra, $forum_result) = each($forumarray))
				{
					$perm = get_forum_permissions($forum_result);
					if (!$perm['viewforums'] && !$group['supermod_announcements'] && !$moderatorstore[$forum['forumid']]['announcements'])
						continue;
					for ($i=0; $i<$forum_result['depth']; $i++)
					{
						eval(store_template('option_indention'));
						$forum_result['name'] = $option_indention.$forum_result['name'];
					}
					if (!$group['supermod_announcements'] && !$moderatorstore[$forum_result['forumid']]['announcements'])
					{
						eval(store_template('option_noposting', '$forum_noposting'));
						$forum_result['name'] .= $forum_noposting;
					}
					if ($forum_result['forumid']==$announcement['forumid'])
						$selected = true;
					else
						$selected = false;
					eval(store_template('forum_choice'));
					$forum_choices .= $forum_choice;
				}
			}
			edit_parse($announcement['body'], $announcement['dpcode'], true, $announcement['smilies'], true);
			moderatorlog("Edited announcement - <b>$announcement[name] ($announcement[announcementid])</b>", 0, '');
			$announcement['start'] = date('Y-m-d', $announcement['start']);
			$announcement['end'] = date('Y-m-d', $announcement['end']);
			if ($config['number_smilies'])
				$smilie_box = smilie_box();
			eval(get_template('edit_announcement'));
		}
		else
			eval(get_template('invalid_announcement'));
	}
	elseif ($op=='doedit')
	{
		if (!(($name=trim(htmlspecialchars($name))) && $start && $end && ($message=trim($message))))
			die(eval(get_template('announcements_missing')));
		if (strtotime($end)<strtotime($start))
			die(eval(get_template('announcements_date')));
		if ($announcement = db_fetch_array(db_query("select * from announcement where announcementid='$id'")))
		{
			if ($announcement['forumid'])
			{
				if (!$group['supermod_announcements'])
				{
					$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$announcement[forumid]"));
					if (!$moderator['announcements'])
						die(eval(get_template('permission_error')));
				}
			}
			else
			{
				if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
					die(eval(get_template('permission_error')));
			}
			if ($forumid)
			{
				if (!$group['supermod_announcements'])
				{
					$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid='$forumid'"));
					if (!$moderator['attachments'])
						die(eval(get_template('permission_error')));
				}
			}
			else
			{
				if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
					die(eval(get_template('permission_error')));
			}
			moderatorlog("Updated announcement - <b>$announcement[name] ($announcement[announcementid])</b>", 0, '');
			$url = ($url ? 1 : 0);
			if ($url)
				$message = auto_url($message);
			$dpcode = ($dpcode ? 0 : 1);
			$smilies = ($smilies ? 0 : 1);
			$body = wysiwyg_parse($message, $smilies, true);
			db_query("update announcement set url='$url',name='$name',dpcode=$dpcode,smilies=$smilies,body='$body',start=UNIX_TIMESTAMP('$start'),end=UNIX_TIMESTAMP('$end'),forumid='$forumid' where announcementid='$announcement[announcementid]'");
			header('Location: announcements.php');
		}
		else
			eval(get_template('invalid_announcement'));
	}
	else
	{
		moderatorlog('Viewed announcements panel', 0, '');
		$query = db_query("select * from moderator where userid=$user[userid]");
		$i = 0;
		while ($moderator_result = db_fetch_array($query))
			$moderatorstore[$moderator_result['forumid']] = $moderator_result;
		$query = db_query("select * from announcement order by start desc, end desc");
		$i = 0;
		while ($announcement_result = db_fetch_array($query))
			$announcementstore[$i++] = $announcement_result;
		get_forum_store();
		if ($forumarray = get_forums(0))
		{
			reset($forumstore);
			while (list($forumextra, $forum) = each($forumarray))
			{
				$perm = get_forum_permissions($forum);
				if (!$perm['viewforums'] && !$group['supermod_announcements'] && !$moderatorstore[$forum['forumid']]['announcements'])
					continue;
				$announcement_result = '';
				$announcement_indent = '';
				$announcements = '';
				for ($i=0; $i<$forum['depth']; $i++)
				{
					eval(store_template('indent', '$announcements_forum_list_indent'));
					$forums .= $announcements_forum_list_indent;
					$announcement_indent .= $announcements_forum_list_indent;
				}
				$canannounce = false;
				if ($group['supermod_announcements'] || $moderatorstore[$forum['forumid']]['announcements'])
					$canannounce = true;
				if ($announcementstore)
				{
					while (list($key, $announcement) = each($announcementstore))
					{
						if ($announcement['forumid']==$forum['forumid'])
						{
							eval(store_template('announcements_announcement'));
							$announcements .= $announcements_announcement;
						}
					}
					reset($announcementstore);
				}
				eval(store_template('announcements_forum', '$announcements_forum_list'));
				$forums .= $announcements_forum_list;
			}
		}
		if (!$group['supermod_announcements'] && db_num_rows(db_query("select * from moderator where userid=$user[userid] and announcements=1"))!=db_num_rows(db_query('select forumid from forum')))
			$allforums = false;
		else
			$allforums = true;
		$announcements = '';
		if ($announcementstore)
		{
			while (list($key, $announcement) = each($announcementstore))
			{
				if ($announcement['forumid']==0)
				{
					$canannounce = $allforums;
					eval(store_template('announcements_announcement'));
					$announcements .= $announcements_announcement;
				}
			}
			reset($announcementstore);
		}
		eval(get_template('announcements_index'));
	}
}
else
	eval(get_template('permission_error'));
?>