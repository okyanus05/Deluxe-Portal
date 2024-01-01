<?php
/**************************************************
* Maintenance
* -----------
* Allows you to run scripts to fix various forum
* counters. This can be necessary if parts of your
* site become corrupted or out of sync.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'maintenance_forums,maintenance_imagestore,maintenance_index,maintenance_lastpost,maintenance_posts,maintenance_posts_disabled,maintenance_signatures,maintenance_templates,maintenance_threads,maintenance_usernames,maintenance_users,templateset_choice';
/**************************************************
* Global variable resetting                      */
unset($lastid);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$cycle = $_REQUEST['cycle'];
$op = $_REQUEST['op'];
$start = $_REQUEST['start'];
$templatesetid = $_REQUEST['templatesetid'];
/*************************************************/

$pagetitle = 'Maintenance';

if ($group['maintenance'])
{
	if ($op=='threads')
	{
		if (!is_numeric($start))
			$start = 0;
		$i = 0;
		$query = db_query("select * from thread where threadid>$start order by threadid asc limit $cycle");
		while ($thread = db_fetch_array($query))
		{
			update_thread_attachment($thread['threadid']);
			if ($thread['redirect'])
			{
				if ($lastpost = db_fetch_array(db_query("select * from post where threadid=$thread[redirect] order by postid desc limit 1")))
					db_query("update thread set posts=0,lastuserid='$lastpost[userid]',lastpostid='$lastpost[postid]',lastpostdate='$lastpost[postdate]',lastusername='".addslashes($lastpost['username'])."' where threadid=$thread[threadid]");
				else
					db_query("delete from thread where threadid=$thread[threadid]");
			}
			else
			{
				if ($lastpost = db_fetch_array(db_query("select * from post where threadid=$thread[threadid] order by postid desc limit 1")))
				{
					$count = db_fetch_array(db_query("select count(*) as numposts from post where threadid=$thread[threadid]"));
					db_query("update thread set posts=$count[numposts],lastuserid=$lastpost[userid],lastpostid=$lastpost[postid],lastpostdate=$lastpost[postdate],lastusername='".addslashes($lastpost['username'])."' where threadid=$thread[threadid]");
					db_query("update article set replies=$count[numposts]-1 where threadid=$thread[threadid]");
				}
				else
				{
					db_query("delete from thread where threadid=$thread[threadid]");
					db_query("delete from post where threadid=$thread[threadid]");
				}
			}
			$lastid = $thread['threadid'];
			$i++;
		}
		if (!$start)
			adminlog("Started thread maintenance (up to thread <b>$lastid</b>)");
		elseif ($i==$cycle)
			adminlog("Continued thread maintenance (up to thread <b>$lastid</b>)");
		else
			adminlog("Ended thread maintenance (last thread <b>$lastid</b>)");
		if ($i==$cycle)
			$redirect_url = "maintenance.php?op=threads&cycle=$cycle&start=$lastid";
		else
			$redirect_url = 'maintenance.php';
		eval(get_template('maintenance_threads'));
	}
	elseif ($op=='forums')
	{
		if (!is_numeric($start))
			$start = 0;
		if (!$start)
			db_query('update forum set threadiconid=0,lastthreadid=0,lastforumid=0,threadname=\'\',lastuserid=0,lastpostid=0,lastpostdate=0,posts=0,threads=0,lastusername=\'\'');
		$query = db_query("select * from forum where forumid>$start order by forumid asc limit $cycle");
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
						db_query("update forum set threadiconid='$thread[iconid]',lastthreadid='$thread[threadid]',lastforumid='$thread[forumid]',threadname='".addslashes(censor(htmlunspecialchars($thread['name'])))."',lastuserid='$thread[lastuserid]',lastpostid='$thread[lastpostid]',lastpostdate='$thread[lastpostdate]',posts=posts+$count[numposts],threads=threads+$count[numthreads],lastusername='".addslashes($thread['lastusername'])."' where forumid=$forumbump[forumid]");
					else
						db_query("update forum set posts=posts+$count[numposts],threads=threads+$count[numthreads] where forumid=$forumbump[forumid]");
				}
			}
			else
				db_query("delete from thread where forumid=$forum[forumid]");
			$lastid = $forum['forumid'];
			$i++;
		}
		if (!$start)
			adminlog("Started forum maintenance (up to forum <b>$lastid</b>)");
		elseif ($i==$cycle)
			adminlog("Continued forum maintenance (up to forum <b>$lastid</b>)");
		else
			adminlog("Ended forum maintenance (last forum <b>$lastid</b>)");
		if ($i==$cycle)
			$redirect_url = "maintenance.php?op=forums&cycle=$cycle&start=$lastid";
		else
			$redirect_url = 'maintenance.php';
		eval(get_template('maintenance_forums'));
	}
	elseif ($op=='usernames')
	{
		$i = 0;
		$query = db_query("select userid,name from user where userid>$start order by userid asc limit $cycle");
		while ($user_result = db_fetch_array($query))
		{
			$user_result['name'] = addslashes($user_result['name']);
			db_query("update article set username='$user_result[name]' where userid=$user_result[userid]");
			db_query("update announcement set username='$user_result[name]' where userid=$user_result[userid]");
			db_query("update buddylist set username='$user_result[name]' where buddyuserid=$user_result[userid]");
			db_query("update forum set lastusername='$user_result[name]' where lastuserid=$user_result[userid]");
			db_query("update ignorelist set username='$user_result[name]' where ignoreuserid=$user_result[userid]");
			db_query("update moderator set username='$user_result[name]' where userid=$user_result[userid]");
			db_query("update post set username='$user_result[name]' where userid=$user_result[userid]");
			db_query("update post set editedby_username='$user_result[name]' where editedby_userid=$user_result[userid]");
			db_query("update privatemessage set fromusername='$user_result[name]' where fromuserid=$user_result[userid]");
			db_query("update privatemessage set tousername='$user_result[name]' where touserid=$user_result[userid]");
			db_query("update thread set username='$user_result[name]' where userid=$user_result[userid]");
			db_query("update thread set lastusername='$user_result[name]' where lastuserid=$user_result[userid]");
			$lastid = $user_result['userid'];
			$i++;
		}
		if (!$start)
			adminlog("Started username maintenance (up to user <b>$lastid</b>)");
		elseif ($i==$cycle)
			adminlog("Continued username maintenance (up to user <b>$lastid</b>)");
		else
			adminlog("Ended username maintenance (last user <b>$lastid</b>)");
		if ($i==$cycle)
			$redirect_url = "maintenance.php?op=usernames&cycle=$cycle&start=$lastid";
		else
		{
			$count = db_fetch_array(db_query('select count(*) from user'));
			$result = db_fetch_array(db_query('select userid,name from user order by userid desc limit 1'));
			db_query("update config set stat_members=$count[0],stat_lastusername='$result[name]',stat_lastuserid='$result[userid]'");
			$user_result['name'] = addslashes($config['guest_name']);
			db_query("update article set username='$user_result[name]' where username=''");
			db_query("update announcement set username='$user_result[name]' where username=''");
			db_query("update buddylist set username='$user_result[name]' where username=''");
			db_query("update config set stat_lastusername='$user_result[name]' where stat_lastusername=''");
			db_query("update forum set lastusername='$user_result[name]' where lastusername=''");
			db_query("update ignorelist set username='$user_result[name]' where username=''");
			db_query("update moderator set username='$user_result[name]' where username=''");
			db_query("update post set username='$user_result[name]' where username=''");
			db_query("update post set editedby_username='$user_result[name]' where editedby_username=''");
			db_query("update privatemessage set fromusername='$user_result[name]' where fromusername=''");
			db_query("update privatemessage set tousername='$user_result[name]' where tousername=''");
			db_query("update thread set username='$user_result[name]' where username=''");
			db_query("update thread set lastusername='$user_result[name]' where lastusername=''");
			$redirect_url = 'maintenance.php';
		}
		eval(get_template('maintenance_usernames'));
	}
	elseif ($op=='lastpost')
	{
		$i = 0;
		$query = db_query("select userid from user where userid>$start order by userid asc limit $cycle");
		while ($user_result = db_fetch_array($query))
		{
			$post = db_fetch_array(db_query("select postid from post where userid=$user_result[userid] order by postdate desc limit 1"));
			if (!$post['postid'])
				$post['postid'] = 0;
			db_query("update user set lastpost='$post[postid]' where userid=$user_result[userid]");
			$lastid = $user_result['userid'];
			$i++;
		}
		if (!$start)
			adminlog("Started last post maintenance (up to user <b>$lastid</b>)");
		elseif ($i==$cycle)
			adminlog("Continued last post maintenance (up to user <b>$lastid</b>)");
		else
			adminlog("Ended last post maintenance (last user <b>$lastid</b>)");
		if ($i==$cycle)
			$redirect_url = "maintenance.php?op=lastpost&cycle=$cycle&start=$lastid";
		else
			$redirect_url = 'maintenance.php';
		eval(get_template('maintenance_lastpost'));
	}
	elseif ($op=='signatures')
	{
		$i = 0;
		$query = db_query("select * from user where userid>$start order by userid asc limit $cycle");
		while ($user_result = db_fetch_array($query))
		{
			if ($user_result['uncached_signature'])
			{
				$parsed_signature = $user_result['uncached_signature'];
				if ($config['signature_dpcode'])
					$parsed_signature = dpcode_parse($parsed_signature, $config['signature_img'], true, true);
				if ($config['signature_smilies'])
					$parsed_signature = smilie_parse($parsed_signature, true);
				$parsed_signature = addslashes(censor($parsed_signature, $config['censored_words']));
				db_query("update user set signature='$parsed_signature' where userid=$user_result[userid]");
			}
			$lastid = $user_result['userid'];
			$i++;
		}
		if (!$start)
			adminlog("Started signature reparsing (up to user <b>$lastid</b>)");
		elseif ($i==$cycle)
			adminlog("Continued signature reparsing (up to user <b>$lastid</b>)");
		else
			adminlog("Ended signature reparsing (last user <b>$lastid</b>)");
		if ($i==$cycle)
			$redirect_url = "maintenance.php?op=signatures&cycle=$cycle&start=$lastid";
		else
			$redirect_url = 'maintenance.php';
		eval(get_template('maintenance_signatures'));
	}
	elseif ($op=='posts')
	{
		if (!$config['post_cache'])
		{
			db_query('update post set parsed_message=\'\'');
			$redirect_url = 'maintenance.php';
			die(eval(get_template('maintenance_posts_disabled')));
		}
		if (!$start)
			db_query('update post set parsed_message=\'\'');
		$i = 0;
		$query = db_query("select post.*,forum.dpcode as forum_dpcode,forum.smilies as forum_smilies,forum.img from post,thread,forum where post.threadid=thread.threadid and thread.forumid=forum.forumid and thread.redirect=0 and (thread.lastpostdate>=".($current_time-$config['post_cache']*86400)." or thread.sticky=1) and postid>$start order by postid asc limit $cycle");
		while ($post = db_fetch_array($query))
		{
			$parsed_message = $post['message'];
			if ($post['dpcode'] && $post['forum_dpcode'])
				$parsed_message = dpcode_parse($parsed_message, $post['img'], true, true);
			if ($post['smilies'] && $post['forum_smilies'])
				$parsed_message = smilie_parse($parsed_message, true);
			$parsed_message = addslashes(censor($parsed_message, $config['censored_words']));
			db_query("update post set parsed_message='$parsed_message' where postid=$post[postid]");
			$lastid = $post['postid'];
			$i++;
		}
		if (!$start)
			adminlog("Started post cache reparsing (up to post <b>$lastid</b>)");
		elseif ($i==$cycle)
			adminlog("Continued post cache reparsing (up to post <b>$lastid</b>)");
		else
			adminlog("Ended post cache reparsing (last post <b>$lastid</b>)");
		if ($i==$cycle)
			$redirect_url = "maintenance.php?op=posts&cycle=$cycle&start=$lastid";
		else
			$redirect_url = 'maintenance.php';
		eval(get_template('maintenance_posts'));
	}
	elseif ($op=='users')
	{
		$i = 0;
		$query = db_query("select * from user where userid>$start order by userid asc limit $cycle");
		while ($user_result = db_fetch_array($query))
		{
			$group_result = get_groups($user_result['userid']);
			if (!$group_result['lockpostcount'])
			{
				$count = db_fetch_array(db_query("select count(*) from post,thread,forum where post.userid=$user_result[userid] and post.threadid=thread.threadid and thread.forumid=forum.forumid and forum.countposts=1"));
				db_query("update user set posts=$count[0] where userid=$user_result[userid]");
			}
			$lastid = $user_result['userid'];
			$i++;
		}
		if (!$start)
			adminlog("Started user post count maintenance (up to user <b>$lastid</b>)");
		elseif ($i==$cycle)
			adminlog("Continued user post count maintenance (up to user <b>$lastid</b>)");
		else
			adminlog("Ended user post count maintenance (last user <b>$lastid</b>)");
		if ($i==$cycle)
			$redirect_url = "maintenance.php?op=users&cycle=$cycle&start=$lastid";
		else
			$redirect_url = 'maintenance.php';
		eval(get_template('maintenance_users'));
	}
	elseif ($op=='templates')
	{
		if ($templatesetid==0)
		{
			$query = db_query("select * from template where templateid>$start order by templateid asc limit $cycle");
			$templatesetname = '<b>All Template Sets</b>';
		}
		else
		{
			$query = db_query("select * from template where templatesetid='$templatesetid' and templateid>$start order by templateid asc limit $cycle");
			$templatesetinfo = db_fetch_array(db_query("select name from templateset where templatesetid='$templatesetid'"));
			$templatesetname = 'template set <b>' . $templatesetinfo['name'] . '</b>';
		}
		
		$i = 0;
		while($template = db_fetch_array($query))
		{
			$check = db_fetch_array(db_query("select count(*) from parsedtemplate where templateid='$template[templateid]'"));
			$check = $check[0];
			
			$parsed_body = addslashes(parse_template($template['body']));
			$name = addslashes($template['name']);
			
			if ($check==0)
				db_query("insert into parsedtemplate (templateid, name, body, templatesetid) values ('$template[templateid]', '$name', '$parsed_body', '$template[templatesetid]')");
			else
				db_query("update parsedtemplate set body='$parsed_body',name='$template[name]',templatesetid='$template[templatesetid]' where templateid='$template[templateid]'");
			
			$lastid = $template['templateid'];
			$i++;
		}		
		
		if (!$start)
			adminlog("Started template re-parse maintenance (up to template <b>$lastid</b> in $templatesetname)");
		elseif ($i==$cycle)
			adminlog("Continued template re-parse maintenance (up to template <b>$lastid</b> in $templatesetname)");
		else
			adminlog("Ended template re-parse maintenance (last template <b>$lastid</b> in $templatesetname)");
		if ($i==$cycle)
			$redirect_url = "maintenance.php?op=templates&templatesetid=$templatesetid&cycle=$cycle&start=$lastid";
		else
			$redirect_url = 'maintenance.php';
		eval(get_template('maintenance_templates'));
	}
	elseif ($op=='imagestore')
	{
		$valid = ',';
		$query = db_query('select * from icon where image like \':%\'');
		while ($icon = db_fetch_array($query))
			$valid .= dp_substr($icon['image'], 1).',';
		$query = db_query('select * from smilie where image like \':%\'');
		while ($smilie = db_fetch_array($query))
			$valid .= dp_substr($smilie['image'], 1).',';
		$query = db_query('select * from topic where image like \':%\'');
		while ($topic = db_fetch_array($query))
			$valid .= dp_substr($topic['image'], 1).',';
		$query = db_query('select * from section where image like \':%\'');
		while ($section = db_fetch_array($query))
			$valid .= dp_substr($section['image'], 1).',';
		$query = db_query('select * from downloadcategory where image like \':%\'');
		while ($downloadcategory = db_fetch_array($query))
			$valid .= dp_substr($downloadcategory['image'], 1).',';
		$query = db_query('select * from linkcategory where image like \':%\'');
		while ($linkcategory = db_fetch_array($query))
			$valid .= dp_substr($linkcategory['image'], 1).',';
		$query = db_query('select * from user where avatar like \':%\'');
		while ($user_result = db_fetch_array($query))
			$valid .= dp_substr($user_result['avatar'], 1).',';
		if (dp_strlen($valid)<2)
			$valid = ',0,';
		db_query('delete from imagestore where imageid not in ('.dp_substr($valid, 1, -1).')');
		adminlog('Ended imagestore maintenance');
		$redirect_url = 'maintenance.php';
		eval(get_template('maintenance_imagestore'));
	}
	else
	{
		$selected = false;
		$query = db_query('select * from templateset');
		while ($templateset_result = db_fetch_array($query))
		{
			eval(store_template('templateset_choice'));
			$templatesets .= $templateset_choice;
		}
		adminlog('Viewed maintenance panel');
		eval(get_template('maintenance_index'));
	}
}
else
	eval(get_template('permission_error'));
?>