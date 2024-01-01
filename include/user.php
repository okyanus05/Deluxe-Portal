<?php
/**************************************************
* User API
* --------
* check_email($address)
* check_name($name)
* do_changer_rules($user, $prevposts, $newposts)
* get_groups($userid)
* get_title($user)
* is_online($user)
* online_parse($url)
* show_email($user)
* show_pm($user)
* show_search($user)
* start_session()
* get_offset()
* time_adjust($timestamp [, $format=false])
* month_get_fist($month, $year [, $format='z' [, $wantday = 0]])
* month_get_last($month, $year [, $format='z' [, $wantday = 0]])
* website_parse($website)
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache .= ',account_duplicate,account_illegal_name,account_length,account_missing';
/**************************************************
* Global variable resetting                      */
unset($articlestore);
unset($articlequery);
unset($changergroupstore);
unset($config);
unset($current_time);
unset($downloadstore);
unset($execution_time);
unset($forumstoreid);
unset($group);
unset($grouparray);
unset($groupquery);
unset($linkstore);
unset($query_counter);
unset($querylog);
unset($pagestyle);
unset($poststore);
unset($rulestore);
unset($sectionstore);
unset($style);
unset($threadstore);
unset($titlestore);
unset($topicstore);
unset($user);
/*************************************************/


function check_email($address)
{
	if (preg_match('/^[a-zA-Z0-9\-_\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $address))
		return true;
	else
		return false;
}

function check_name($name)
{
	global $pagetitle;
	foreach ($GLOBALS as $key => $value)
		${$key} = $value;
	if (!$name)
	{
		$pagetitle = 'Invalid name';
		die(eval(get_template('account_missing')));
	}
	elseif (censor($name, $config['illegal_usernames'])!=$name)
	{
		$pagetitle = 'Illegal name';
		die(eval(get_template('account_illegal_name')));
	}
	elseif (dp_strlen($name)<$config['min_username_length'] || dp_strlen($name)>$config['max_username_length'])
	{
		$pagetitle = 'Invalid name length';
		die(eval(get_template('account_length')));
	}
	elseif (db_num_rows(db_query("select userid from user where name='$name'")))
	{
		$pagetitle = 'Duplicate name';
		die(eval(get_template('account_duplicate')));
	}
}

function get_groups($userid)
{
	global $articlequery, $groupquery, $grouparray;
	if ($userid)
		$query = db_query("select groups.* from groups,user where userid=$userid and FIND_IN_SET(groups.groupid, usergroups)");
	else
		$query = db_query('select * from defaultgroups,groups where user=0 and defaultgroups.groupid=groups.groupid');
	$i = 0;
	while ($group_result = db_fetch_array($query))
	{
		$grouparray[$i++] = $group_result;
		if ($groupquery)
			$groupquery .= " or groupid=$group_result[groupid]";
		else
			$groupquery = "groupid=$group_result[groupid]";
		if ($articlequery)
			$articlequery .= " or topicpermissions.groupid=$group_result[groupid] or sectionpermissions.groupid=$group_result[groupid]";
		else
			$articlequery .= "topicpermissions.groupid=$group_result[groupid] or sectionpermissions.groupid=$group_result[groupid]";
		$group['max_recipients'] = ($group_result['max_recipients']>$group['max_recipients'] ? $group_result['max_recipients'] : $group['max_recipients']);
		$group['maxpm'] = ($group_result['maxpm']>$group['maxpm'] ? $group_result['maxpm'] : $group['maxpm']);
		$group['adminlog'] |= $group_result['adminlog'];
		$group['articles'] |= $group_result['articles'];
		$group['close'] |= $group_result['close'];
		$group['configuration'] |= $group_result['configuration'];
		$group['copymove'] |= $group_result['copymove'];
		$group['customavatar'] |= $group_result['customavatar'];
		$group['customsignature'] |= $group_result['customsignature'];
		$group['customfields'] |= $group_result['customfields'];
		$group['customtitle'] |= $group_result['customtitle'];
		$group['deleteposts'] |= $group_result['deleteposts'];
		$group['deletethreads'] |= $group_result['deletethreads'];
		$group['downloads'] |= $group_result['downloads'];
		$group['dpcode'] |= $group_result['dpcode'];
		$group['edit_profile'] |= $group_result['edit_profile'];
		$group['editposts'] |= $group_result['editposts'];
		$group['editthreads'] |= $group_result['editthreads'];
		$group['exempt_titlecensor'] |= $group_result['exempt_titlecensor'];
		$group['faq'] |= $group_result['faq'];
		$group['forumperm'] |= $group_result['forumperm'];
		$group['forums'] |= $group_result['forums'];
		$group['groupchanger'] |= $group_result['groupchanger'];
		$group['groups'] |= $group_result['groups'];
		$group['html'] |= $group_result['html'];
		$group['icons'] |= $group_result['icons'];
		$group['ignorelist'] |= $group_result['ignorelist'];
		$group['links'] |= $group_result['links'];
		$group['lockpostcount'] |= $group_result['lockpostcount'];
		$group['maintenance'] |= $group_result['maintenance'];
		$group['moderators'] |= $group_result['moderators'];
		$group['postattachments'] |= $group_result['postattachments'];
		$group['postthreads'] |= $group_result['postthreads'];
		$group['privatemessaging'] |= $group_result['privatemessaging'];
		$group['replytoother'] |= $group_result['replytoother'];
		$group['replytoown'] |= $group_result['replytoown'];
		$group['search'] |= $group_result['search'];
		$group['sections'] |= $group_result['sections'];
		$group['show_editedby'] |= $group_result['show_editedby'];
		$group['smilies'] |= $group_result['smilies'];
		$group['startpolls'] |= $group_result['startpolls'];
		$group['styles'] |= $group_result['styles'];
		$group['stylesets'] |= $group_result['stylesets'];
		$group['supermod_announcements'] |= $group_result['supermod_announcements'];
		$group['supermod_banusers'] |= $group_result['supermod_banusers'];
		$group['supermod_close'] |= $group_result['supermod_close'];
		$group['supermod_copymove'] |= $group_result['supermod_copymove'];
		$group['supermod_deleteposts'] |= $group_result['supermod_deleteposts'];
		$group['supermod_deletethreads'] |= $group_result['supermod_deletethreads'];
		$group['supermod_editpolls'] |= $group_result['supermod_editpolls'];
		$group['supermod_editposts'] |= $group_result['supermod_editposts'];
		$group['supermod_editthreads'] |= $group_result['supermod_editthreads'];
		$group['supermod_exemptfloodcheck'] |= $group_result['supermod_exemptfloodcheck'];
		$group['supermod_log'] |= $group_result['supermod_log'];
		$group['supermod_massdelete'] |= $group_result['supermod_massdelete'];
		$group['supermod_massmove'] |= $group_result['supermod_massmove'];
		$group['supermod_sticky'] |= $group_result['supermod_sticky'];
		$group['supermod_viewfullprofiles'] |= $group_result['supermod_viewfullprofiles'];
		$group['supermod_viewips'] |= $group_result['supermod_viewips'];
		$group['tasks'] |= $group_result['tasks'];
		$group['templates'] |= $group_result['templates'];
		$group['titles'] |= $group_result['titles'];
		$group['topics'] |= $group_result['topics'];
		$group['users'] |= $group_result['users'];
		$group['view_profile'] |= $group_result['view_profile'];
		$group['view_memberlist'] |= $group_result['view_memberlist'];
		$group['viewattachments'] |= $group_result['viewattachments'];
		$group['viewforums'] |= $group_result['viewforums'];
		$group['viewthreads'] |= $group_result['viewthreads'];
		$group['votepolls'] |= $group_result['votepolls'];
		$group['whos_online'] |= $group_result['whos_online'];
	}
	return $group;
}

function get_title($user)
{
	global $style, $titlestore;
	$i = 0;
	get_title_store();
	while ($utitle=$titlestore[$i++])
	{
		if ($utitle['groupid']==$user['groupid'])
		{
			if ($utitle['posts']>$user['posts'])
				break;
			else
			{
				$title = $utitle['title'];
				if ($utitle['image'] && $utitle['repeat'])
				{
					$image = '';
					$image .= '<br />';
					eval('$utitle[image] = "'.str_replace('"', '\\"', $utitle['image']).'";');
					for ($n=0; $n<$utitle['repeat']; $n++)
						$image .= "<img alt=\"$utitle[title]\" src=\"$utitle[image]\" />";
				}
			}
		}
	}
	if (!$user['title'])
		$user['title'] = $title;
	return $user['title'].$image;
}

function is_online($user_result)
{
	global $config, $current_time, $group, $user;
	$timeout = $current_time-($config['online_timeout']*60);
	if (($user_result['lastactivity']<$timeout) || ($user_result['invisible'] && !$group['users'] && !$group['supermod_viewfullprofiles'] && $user['userid']!=$user_result['userid']))
		$isonline = false;
	else
		$isonline = true;
	return $isonline;
}

function online_parse($url)
{
	global $admincp_dir, $modcp_dir, $forumstoreid, $threadstore, $poststore, $articlestore, $topicstore, $sectionstore, $downloadstore, $linkstore;
	get_forum_store();
	preg_match('/([^\/.]+?).php/', $url, $match);
	$activity['page']=$match[1];
	preg_match('/postid=([0-9]+)/', $url, $match);
	$activity['postid']=$match[1];
	preg_match('/id=([0-9]+)/', $url, $match);
	$activity['id']=$match[1];
	$online['url'] = $url;
	if ($activity['page']=='thread' || $activity['page']=='print_thread' || $activity['page']=='reply' || $activity['page']=='replies')
	{
		if ($activity['postid'])
		{
			$perm = get_forum_permissions($forumstoreid[$poststore[$activity['postid']]['forumid']]);
			$online['extra'] = $poststore[$activity['postid']]['name'];
		}
		elseif ($activity['id'])
		{
			$perm = get_forum_permissions($forumstoreid[$threadstore[$activity['id']]['forumid']]);
			$online['extra'] = $threadstore[$activity['id']]['name'];
		}
		if (!$perm['viewthreads'])
			$online['extra'] = '';
	}
	if ($activity['page']=='attachment')
	{
		$activity['postid'] = $activity['id'];
		if ($activity['id'])
		{
			$perm = get_forum_permissions($forumstoreid[$poststore[$activity['id']]['forumid']]);
			$online['extra'] = $poststore[$activity['id']]['name'];
		}
		if (!$perm['viewthreads'])
			$online['extra'] = '';
		$activity['id'] = '';
	}
	if ($activity['page']=='forum_display' || $activity['page']=='announcement' || $activity['page']=='newthread')
	{
		if ($activity['id'])
		{
			$perm = get_forum_permissions($forumstoreid[$activity['id']]);
			$online['extra'] = $forumstoreid[$activity['id']]['name'];
		}
		if (!$perm['viewforums'])
			$online['extra'] = '';
	}
	if ($activity['page']=='article')
	{
		$online['extra'] = $articlestore[$activity['id']]['title'];
		if ($articlestore[$activity['id']]['topicid'])
		{
			if (!$topicstore)
				get_online_topic_store();
			if (!$topicstore[$articlestore[$activity['id']]['topicid']])
				$online['extra'] = '';
		}
		elseif ($articlestore[$activity['id']]['sectionid'])
		{
			if (!$sectionstore)
				get_online_section_store();
			if (!$sectionstore[$articlestore[$activity['id']]['sectionid']])
				$online['extra'] = '';
		}
	}
	if ($activity['page']=='downloads')
	{
		if (!$downloadstore)
			get_online_download_store();
		$online['extra'] = $downloadstore[$activity['id']]['name'];
		if (!$downloadstore[$activity['id']])
			$online['extra'] = '';
	}
	if ($activity['page']=='links')
	{
		if (!$linkstore)
			get_online_link_store();
		$online['extra'] = $linkstore[$activity['id']]['name'];
		if (!$linkstore[$activity['id']])
			$online['extra'] = '';
	}
	if ($activity['page']=='sections')
	{
		if (!$sectionstore)
			get_online_section_store();
		$online['extra'] = $sectionstore[$activity['id']]['name'];
		if (!$sectionstore[$activity['id']])
			$online['extra'] = '';
	}
	if ($activity['page']=='topics')
	{
		if (!$topicstore)
			get_online_topic_store();
		$online['extra'] = $topicstore[$activity['id']]['name'];
		if (!$topicstore[$activity['id']])
			$online['extra'] = '';
	}
	if (!$online['extra'])
		$online['extra'] = '<i>unknown</i>';
	if (strstr($online['url'],"$admincp_dir/"))
		$online['activity'] = 'Viewing administrator control panel';
	elseif (strstr($online['url'],"$modcp_dir/"))
		$online['activity'] = 'Viewing moderator control panel';
	elseif ($activity['page']=='archive')
		$online['activity'] = 'Viewing archive';
	elseif ($activity['page']=='announcement')
		$online['activity'] = "Viewing announcements in forum <a href=\"$online[url]\">$online[extra]</a>";
	elseif ($activity['page']=='article')
		$online['activity'] = "Viewing article <a href=\"$online[url]\">$online[extra]</a>";
	elseif ($activity['page']=='display')
		$online['activity'] = "Viewing a <a href=\"$online[url]\">page</a>";
	elseif ($activity['page']=='downloads')
	{
		if ($activity['id'])
			$online['activity'] = "Viewing download category <a href=\"$online[url]\">$online[extra]</a>";
		else
			$online['activity'] = 'Viewing <a href="downloads.php">downloads</a>';
	}
	elseif ($activity['page']=='edit')
		$online['activity'] = 'Editing post';
	elseif ($activity['page']=='faq')
		$online['activity'] = "Viewing a <a href=\"$online[url]\">FAQ</a>";
	elseif ($activity['page']=='forum')
		$online['activity'] = 'Viewing <a href="forum.php">main forum page</a>';
	elseif ($activity['page']=='forum_display')
		$online['activity'] = "Viewing forum <a href=\"$online[url]\">$online[extra]</a>";
	elseif ($activity['page']=='imagestore')
		$online['activity'] = "Viewing an <a href=\"$online[url]\">image</a>";
	elseif ($activity['page']=='' || $activity['page']=='index')
		$online['activity'] = 'Viewing <a href="index.php">main page</a>';
	elseif ($activity['page']=='leaders')
		$online['activity'] = 'Viewing <a href="leaders.php">site/forum leaders</a>';
	elseif ($activity['page']=='links')
	{
		if ($activity['id'])
			$online['activity'] = "Viewing link category <a href=\"$online[url]\">$online[extra]</a>";
		else
			$online['activity'] = 'Viewing <a href="links.php">links</a>';
	}
	elseif ($activity['page']=='members')
		$online['activity'] = 'Viewing <a href="members.php">member list</a>';
	elseif ($activity['page']=='moderate' || $activity['page']=='ip')
		$online['activity'] = 'Moderating';
	elseif ($activity['page']=='newpm')
		$online['activity'] = 'Sending a private message';
	elseif ($activity['page']=='newthread')
		$online['activity'] = "Starting thread in forum <a href=\"forum_display.php?id=$activity[id]\">$online[extra]</a>";
	elseif ($activity['page']=='newthreads')
		$online['activity'] = 'Viewing <a href="newthreads.php">newest threads</a>';
	elseif ($activity['page']=='online')
		$online['activity'] = 'Viewing Who\'s Online';
	elseif ($activity['page']=='pm')
		$online['activity'] = 'Using <a href="pm.php">private messaging system</a>';
	elseif ($activity['page']=='preview')
		$online['activity'] = 'Previewing a post';
	elseif ($activity['page']=='print_thread')
		$online['activity'] = "Viewing printable version of <a href=\"$online[url]\">$online[extra]</a>";
	elseif ($activity['page']=='poll')
		$online['activity'] = 'Viewing the results of a poll';
	elseif ($activity['page']=='profile' || $activity['page']=='email')
		$online['activity'] = 'Viewing a user\'s profile';
	elseif ($activity['page']=='readpm')
		$online['activity'] = 'Reading a private message';
	elseif ($activity['page']=='register')
		$online['activity'] = 'Registering';
	elseif ($activity['page']=='replies')
		$online['activity'] = "Viewing who replied to thread <a href=\"thread.php?id=$activity[id]\">$online[extra]</a>";
	elseif ($activity['page']=='reply')
		$online['activity'] = "Replying to thread <a href=\"thread.php?id=$activity[id]&amp;postid=$activity[postid]\">$online[extra]</a>";
	elseif ($activity['page']=='report')
		$online['activity'] = 'Reporting a post to the moderators';
	elseif ($activity['page']=='search')
		$online['activity'] = '<a href="search.php">Searching</a>';
	elseif ($activity['page']=='sections')
	{
		if ($activity['id'])
			$online['activity'] = "Viewing section <a href=\"$online[url]\">$online[extra]</a>";
		else
			$online['activity'] = 'Viewing <a href="sections.php">sections</a>';
	}
	elseif ($activity['page']=='smilies')
		$online['activity'] = 'Viewing <a href="smilies.php">smilies</a>';
	elseif ($activity['page']=='thread' || $activity['page']=='attachment')
		$online['activity'] = "Viewing thread <a href=\"thread.php?postid=$activity[postid]&amp;id=$activity[id]\">$online[extra]</a>";
	elseif ($activity['page']=='topics')
	{
		if ($activity['id'])
			$online['activity'] = "Viewing topic <a href=\"$online[url]\">$online[extra]</a>";
		else
			$online['activity'] = 'Viewing <a href="topics.php">topics</a>';
	}
	elseif ($activity['page']=='user' || $activity['page']=='subscribe' || $activity['page']=='edit_profile' || $activity['page']=='edit_options' || $activity['page']=='change_password')
		$online['activity'] = 'Viewing <a href="user.php">user control panel</a>';
	else
		$online['activity'] = 'Unknown location';
	return $online['activity'];
}

function show_email($user)
{
	global $config, $group;
	if ($config['show_email']!='disable' && $user['userid'] && (!$user['hide_email'] || $group['supermod_viewusers'] || $group['users']))
		$showemail = true;
	else
		$showemail = false;
	return $showemail;
}

function show_pm($user_result)
{
	global $group, $user;
	if ($user['pm'] && $user['userid'] && $group['privatemessaging'] && $user_result['userid'] && $user_result['pm'])
		$showpm = true;
	else
		$showpm = false;
	return $showpm;
}

function show_search($user)
{
	global $group;
	if ($group['search'] && $user['posts'])
		$showsearch = true;
	else
		$showsearch = false;
	return $showsearch;
}

function start_session()
{
	global $_SERVER, $admincp_dir, $modcp_dir, $_COOKIE, $config, $current_time, $lastvisit, $group, $_SERVER, $user;
	$PARENT_DIR = basename(dirname($_SERVER['PHP_SELF']));
	$filename = basename($_SERVER['PHP_SELF']);
	$STORE_URI = (($PARENT_DIR==$admincp_dir || $PARENT_DIR==$modcp_dir) ? "$PARENT_DIR/" : '') . $filename . ($_SERVER['QUERY_STRING'] ? "?$_SERVER[QUERY_STRING]" : '');
	if (!$_COOKIE['sessionid'])
	{
		srand((double)microtime()*1000000);
	   	$_COOKIE['sessionid'] = md5(rand(0,32000) . $_SERVER['REMOTE_ADDR'] . rand(0,32000));
		db_query("insert ignore into session (userid, sessionid, ip, lastactivity, lastvisit, useragent, registerid) values (0, '$_COOKIE[sessionid]', '" . addslashes($_SERVER['REMOTE_ADDR']) . "', $current_time, 0, '$_SERVER[HTTP_USER_AGENT]', '" . addslashes(strtoupper(generate_salt(7))) . "')");
		setcookie('sessionid',$_COOKIE['sessionid'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_userid',0,time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_md5pass','',time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_joindate',0,time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
	}
	$user = db_fetch_array(db_query("select user.*,count(privatemessageid) as num_pm,moderatorid,session.registerid,session.lastvisit as ses_lastvisit,session.lastactivity as ses_lastactivity from session left join user on session.userid=user.userid left join privatemessage on privatemessage.userid=user.userid and folder='inbox' and isread=0 left join moderator on moderator.userid=user.userid and (announcements=1 or massdelete=1 or massmove=1) where sessionid='$_COOKIE[sessionid]' group by sessionid"));
	if (!$user)
	{
		if ($_COOKIE['dp_userid'] && $_COOKIE['dp_md5pass'] && ($user = db_fetch_array(db_query("SELECT * FROM user WHERE userid='$_COOKIE[dp_userid]' AND password='$_COOKIE[dp_md5pass]' AND joindate='$_COOKIE[dp_joindate]'"))))
		{
			db_query("insert ignore into session (forumids, userid, sessionid, ip, lastactivity, lastvisit) values ('', '$_COOKIE[dp_userid]', '$_COOKIE[sessionid]', '" . addslashes($_SERVER['REMOTE_ADDR']) . "', $current_time, $user[lastvisit])");
			setcookie('sessionid',$_COOKIE['sessionid'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_userid',$user['userid'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_md5pass',$user['password'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_joindate',$user['joindate'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		}
		else
		{
			db_query("insert ignore into session (forumids, userid, sessionid, ip, lastactivity, lastvisit, useragent, registerid) values ('', 0, '$_COOKIE[sessionid]', '" . addslashes($_SERVER['REMOTE_ADDR']) . "', $current_time, 0, '$_SERVER[HTTP_USER_AGENT]', '" . addslashes(strtoupper(generate_salt(7))) . "')");
			setcookie('sessionid',$_COOKIE['sessionid'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_userid',0,time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_md5pass','',time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_joindate',0,time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		}
	}
	if (!$user['userid'])
	{
		$user['name'] = $config['guest_name'];
		$user['stylesetid'] = $config['guest_stylesetid'];
		$user['time_zone'] = $config['guest_time_zone'];
		$user['userid'] = 0;
		$user['groupid'] = $config['guest_groupid'];
		$user['markread_time'] = 15;
		$user['img'] = 1;
		$user['displaysignatures'] = 1;
		$user['show_avatars'] = 1;
		$user['use_wysiwyg'] = 1;
		$user['lastactivity'] = $user['ses_lastactivity'];
		$user['lastvisit'] = ($user['ses_lastvisit'] ? $user['ses_lastvisit'] : mktime()-86400);
	}
	if ($user['markread_time'] && ($current_time-$user['lastactivity'])>($user['markread_time']*60))
		$lastvisit = $user['lastactivity'];
	else
		$lastvisit = $user['lastvisit'];
	$user['lastactivity'] = $current_time;
	$set_forumids_none = ($filename!='thread.php' && $filename!='forum_display.php') ? "forumids=''," : '';
	$set_threadid_none = ($filename!='thread.php') ? "viewthreadid=0," : '';
	if ($STORE_URI!='styles.php')
		db_query($var = "update session set {$set_threadid_none}{$set_forumids_none}lastvisit='$lastvisit',lastactivity=$current_time,ip='" . addslashes($_SERVER['REMOTE_ADDR']) . "',url='" . addslashes($STORE_URI) . "' where sessionid='$_COOKIE[sessionid]'");
	if ($user['userid'])
		db_query("update user set lastactivity=$current_time,lastvisit=$lastvisit where userid=$user[userid]");
	if ($user['userid'] && $lastvisit!=$user['lastvisit'])
		db_query("delete from markread where userid=$user[userid]");
	$user['lastvisit'] = $lastvisit;
	$group = get_groups($user['userid']);
}

function get_offset()
{
	global $user, $config;
	static $offset = false;
	
	if ($offset===false)
	{
		$_COOKIE['dp_timezone'] = isset($_COOKIE['dp_timezone']) ? ((int) $_COOKIE['dp_timezone']) : false;
		$_COOKIE['dp_timezone'] = ($_COOKIE['dp_timezone']<=720 && $_COOKIE['dp_timezone']>=-720) ? $_COOKIE['dp_timezone'] : false;
		if ($_COOKIE['dp_timezone'] && ($user['auto_time_zone'] || !$user['userid']))
			$offset = $_COOKIE['dp_timezone'] * 60;
		else
		{
			$offset = $user['time_zone'] * 3600;
			list($current_day, $current_year) = explode(' ', gmdate('z Y', time() + $offset));
			$dst_start = month_get_first(5, $current_year);
			$dst_end = month_get_last(10, $current_year);
			if ($current_day<=$dst_end && $current_day>=$dst_start)
				if ($user['southern_hemisphere'])
					$offset -= 3600;
				else
					$offset += 3600;
		}
		$offset += $config['time_offset'] * 60;
	}
	return $offset;
}

$timeformat_cache = array();

function time_adjust($timestamp, $format=false)
{
	global $user, $style, $config, $timeformat_cache;

	$offset = get_offset();

	$realdate = $timestamp + $offset;
	if ($realdate < 0)
		$realdate = 0;
	$timenow = time() + $offset;
	$format_md5 = md5($format);
	if ($format===false)
		return strtotime(gmdate('Y-m-d H:i:s', $realdate));
	elseif (isset($timeformat_cache[$format_md5]))
		$format = $timeformat_cache[$format_md5];
	else
	{
		$format = preg_replace('/\[text\](.*?)\[\/text\]/ei', 'date_quote(stripslashes("\1"))', $format);
		$timeformat_cache[$format_md5] = $format;
	}
	if (stristr($format, '[isday]') && stristr($format, '[/isday]'))
	{
		$full_format = $format;
		$format = preg_replace('/\[isday\](.*?)\[\/isday\]/i', '', $format);
		$format = str_ireplace('[day /]', '', $format);
		$date_day = gmdate('d m Y', $realdate);
		if ($date_day==gmdate('d m Y', $timenow))
			$day_text = $style['today_text'];
		elseif ($date_day==gmdate('d m Y', $timenow-86404))
			$day_text = $style['yesterday_text'];
		else
			return gmdate($format, $realdate);
		preg_match('/\[isday\](.*?)\[\/isday\]/i', $full_format, $format);
		$format = str_ireplace('[day /]', '[\d\a\y /]', $format[1]);
		$final = gmdate($format, $realdate);
		return str_replace('[day /]', $day_text, $final);
	}
	else
		return gmdate($format, $realdate);
}

function month_get_first($month, $year, $format='z', $wantday=0)
{
	for ($i=1; $i<=8; $i++)
	{
		$stamp = mktime(0,0,0,$month,$i,$year);
		$day = (int) date('w', $stamp);
		if ($day===$wantday)
		{
			$day = date($format, $stamp);
			break;
		}
	}
	return $day;
}

function month_get_last($month, $year, $format='z', $wantday=0)
{
	$days = date('t', mktime(0,0,0,$month,1,1998));
	for ($i=$days; $i>=($days-8); $i--)
	{
		$stamp = mktime(0,0,0,$month,$i,$year);
		$day = (int) date('w', $stamp);
		if ($day===$wantday)
		{
			$day = date($format, $stamp);
			break;
		}
	}
	return $day;
}

function date_quote($string)
{
	$search = array('a', 'A', 'B', 'd', 'D', 'F', 'g', 'G', 'h', 'H', 'i', 'I', 'j', 'l', 'L',
					'm', 'M', 'n', 'O', 'r', 's', 'S', 't', 'T', 'U', 'w', 'W', 'y', 'Y', 'z', 'Z');
	$replace = array('\\a', '\\A', '\\B', '\\d', '\\D', '\\F', '\\g', '\\G', '\\h', '\\H', 
					 '\\i', '\\I', '\\j', '\\l', '\\L', '\\m', '\\M', '\\n', '\\O', '\\r',
					 '\\s', '\\S', '\\t', '\\T', '\\U', '\\w', '\\W', '\\y', '\\Y', '\\z', '\\Z');
	$string = str_replace($search, $replace, $string);
	return $string;
}

function website_parse($website)
{
	global $config;
	$website = htmlspecialchars(censor($website, $config['censored_words']));
	$website = dp_trim($website);
	if ($website=='http://')
		return '';
	if (dp_substr($website, 0, 7)!='http://' && dp_substr($website, 0, 8)!='https://' && dp_substr($website, 0, 6)!='ftp://')
		return "http://$website";
	return $website;
}
?>