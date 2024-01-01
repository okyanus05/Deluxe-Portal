<?php
/**************************************************
* User Control Panel
* ------------------
* Handles logins
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'activate_account_invalid,activate_account_redirect,add_buddy_duplicate,add_buddy_redirect,add_ignored_user_denied,add_ignored_user_duplicate,add_ignored_user_redirect,forumdisplay_multipage_last,forumdisplay_multipage_link,get_password_complete,get_password_invalid,invalid_user,login_account_attempts,login_account_failed,login_account_password,login_account_redirect,logout_account_redirect,mail_passwordreminder,new_posts,new_posts_closed,new_posts_closed_hot,new_posts_hot,remind_password,remind_password_complete,remind_password_disabled,remind_password_invalid,unsubscribe_emails,unsubscribe_emails_redirect,unsubscribe_threads,unsubscribe_threads_redirect,user_buddy,user_ignored_user,user_index,user_subscribed_forum,user_subscribed_thread';
/**************************************************
* Global variable resetting                      */
unset($userids);
unset($buddies);
unset($forums);
unset($multipage);
unset($multipage_nav);
unset($threads);
unset($user_ignored_user);
unset($userids);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$op = $_REQUEST['op'];
$password = $_POST['password'];
$redirect_url = $_POST['redirect_url'];
$userid = $_REQUEST['userid'];
/*************************************************/

if ($op=='login')
{
	$name = dp_htmlspecialchars($_POST['name']);
	if ($config['login_fail'] && ($ipcheck = db_fetch_array(db_query("select * from iplock where ip='$_SERVER[REMOTE_ADDR]'"))) && ($current_time-$ipcheck['lastfail'])<($config['login_failtime']*60))
	{
		$seconds = ($config['login_failtime']*60)-($current_time-$ipcheck['lastfail']);
		$failtime = ceil($seconds/60);
		$pagetitle = 'Login failed';
		die(eval(get_template('login_account_attempts')));
	}
	$query = db_query("select * from user where name='$name'");
	if ($usercheck = db_fetch_array($query))
	{
		$password = dp_hash($usercheck['user_salt'], $password);
		if ($password != $usercheck['password'])
		{
			if ($config['login_fail'])
			{
				if (!$ipcheck)
					$ipcheck['numfailed'] = 0;
				$numfailed = ++$ipcheck['numfailed'];
				if ($numfailed>=$config['login_fail'])
					db_query("replace into iplock (ip, numfailed, lastfail) values ('$_SERVER[REMOTE_ADDR]', 0, $current_time)");
				else
					db_query("replace into iplock (ip, numfailed, lastfail) values ('$_SERVER[REMOTE_ADDR]', $numfailed, 0)");
			}
			$pagetitle = 'Login failed';
			die(eval(get_template('login_account_password')));
		}
		db_query("delete from iplock where ip='$_SERVER[REMOTE_ADDR]'");
		srand((double)microtime()*1000000);
		$sessionid = md5(rand(0,32000).$_SERVER['REMOTE_ADDR'].rand(0,32000));
		db_query("delete from session where sessionid='$_COOKIE[sessionid]'");
		db_query("insert ignore into session (userid, sessionid, ip, lastactivity, lastvisit) values ($usercheck[userid], '$sessionid', '$_SERVER[REMOTE_ADDR]', $current_time, 0)");
		setcookie('sessionid',$sessionid,time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_userid',$usercheck['userid'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_md5pass',$usercheck['password'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_joindate',$usercheck['joindate'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
		if (!$redirect_url)
			$redirect_url = "$relativeurl/user.php";
		$pagetitle = 'Login';
		eval(get_template('login_account_redirect'));
	}
	else
	{
		$pagetitle = 'Login failed';
		eval(get_template('login_account_failed'));
	}
}
elseif ($op=='logout')
{
	if ($user['userid'])
	{
		db_query("delete from session where sessionid='$sessionid'");
		setcookie('dp_settings','',time()-43200,$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_joindate','',time()-43200,$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_md5pass','',time()-43200,$config['cookie_path'],$config['cookie_domain']);
		setcookie('dp_userid','',time()-43200,$config['cookie_path'],$config['cookie_domain']);
		setcookie('sessionid','',time()-43200,$config['cookie_path'],$config['cookie_domain']);
	}
	$redirect_url = (strstr($_SERVER['HTTP_REFERER'], 'logout.php') ? 'index.php' : $_SERVER['HTTP_REFERER']);
	$pagetitle = 'Logout';
	eval(get_template('logout_account_redirect'));
}
elseif ($op=='remind')
{
	if ($config['password_reminder'])
	{
		$pagetitle = 'Password reminder';
		eval(get_template('remind_password'));
	}
	else
	{
		$pagetitle = 'Password reminder disabled';
		eval(get_template('remind_password_disabled'));
	}
}
elseif ($_POST['op']=='dounsubscribe_email')
{
	if (!$user['userid'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	db_query("delete from subscribedemail where userid=$user[userid]");
	$pagetitle = 'Removing email subscribtions';
	$redirect_url = 'user.php';
	eval(get_template('unsubscribe_emails_redirect'));
}
elseif ($_POST['op']=='dounsubscribe')
{
	if (!$user['userid'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	db_query("delete from subscribedthread where userid=$user[userid]");
	$pagetitle = 'Removing thread subscribtions';
	$redirect_url = 'user.php';
	eval(get_template('unsubscribe_threads_redirect'));
}
elseif ($op=='unsubscribe')
{
	if (!$user['userid'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	$pagetitle = 'Remove all thread subscribtions';
	eval(get_template('unsubscribe_threads'));
}
elseif ($op=='unsubscribe_email')
{
	if (!$user['userid'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	$pagetitle = 'Remove all email subscribtions';
	eval(get_template('unsubscribe_emails'));
}
elseif ($op=='doremind')
{
	if ($config['password_reminder'])
	{
		$query = db_query("select * from user where email='$_REQUEST[email]'");
		if (db_num_rows($query))
		{
			while ($user_result = db_fetch_array($query))
			{
				$key = md5(rand(0,32000).$_SERVER['REMOTE_ADDR'].rand(0,32000));
				db_query("insert into passwordreminder (userid, activationkey) values ($user_result[userid], '$key')");
				eval(store_template('mail_passwordreminder', '$message'));
				dp_mail($user_result['email'], "$config[name] Password Reminder", $message, "From: \"$config[name] Mailer\" <$config[contact]>");
			}
			$email = $_REQUEST['email'];
			$pagetitle = 'Password reminder sent';
			eval(get_template('remind_password_complete'));
		}
		else
		{
			$pagetitle = 'Invalid email address';
			eval(get_template('remind_password_invalid'));
		}
	}
	else
	{
		$pagetitle = 'Password reminder disabled';
		eval(get_template('remind_password_disabled'));
	}
}
elseif ($op=='getpassword')
{
	if ($config['password_reminder'])
	{
		if ($user_result = db_fetch_array(db_query("select user.* from passwordreminder,user where passwordreminder.userid='$userid' and passwordreminder.userid=user.userid and passwordreminder.activationkey='$_REQUEST[key]'")))
		{
			$password = generate_salt(8);
			$salt = generate_salt();
			$md5password = addslashes(dp_hash($salt, $password));
			$salt = addslashes($salt);
			db_query("update user set user_salt='$salt',password='$md5password' where userid='$user_result[userid]'");
			$pagetitle = 'New password created';
			eval(get_template('get_password_complete'));
		}
		else
		{
			$pagetitle = 'Invalid password reminder key';
			eval(get_template('get_password_invalid'));
		}
	}
	else
	{
		$pagetitle = 'Password reminder disabled';
		eval(get_template('remind_password_disabled'));
	}
}
elseif ($op=='emailverify' || $op=='emailreverify')
{
	if ($user_result = db_fetch_array(db_query("select user.* from emailverify,user where emailverify.userid='$userid' and emailverify.userid=user.userid and emailverify.activationkey='$_REQUEST[key]'")))
	{
		if ($user_result['usergroups']==$config['email_groupid'])
		{
			unset($usergroups);
			$groupid = $user_result['groupid'];
			$query = db_query("select * from emailgroups where userid='$user_result[userid]'");
			if (db_num_rows($query))
			{
				while ($group_result = db_fetch_array($query))
				{
					$usergroups[] = $group_result['groupid'];
					if ($group_result['isprimary'])
						$groupid = $group_result['groupid'];
				}
			}
			else
			{
				$query = db_query('select * from defaultgroups where user=1');
				while ($group_result = db_fetch_array($query))
					$usergroups[] = $group_result['groupid'];
				$groupid = $config['default_register_group'];
			}
			db_query("update user set groupid='$groupid',usergroups='".implode(',', $usergroups)."' where userid='$user_result[userid]'");
		}
		db_query("delete from emailverify where userid=$user_result[userid]");
		db_query("delete from emailgroups where userid=$user_result[userid]");
		$redirect_url = 'user.php';
		$pagetitle = 'Account activated';
		eval(get_template('activate_account_redirect'));
	}
	else
	{
		$pagetitle = 'Invalid activation key';
		eval(get_template('activate_account_invalid'));
	}
}
elseif ($op=='add_buddy')
{
	if (!$user['userid'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	$buddy_name = dp_htmlspecialchars($_REQUEST['buddy_name']);
	if ($id)
		$user_result = db_fetch_array(db_query("select * from user where userid='$id'"));
	else
		$user_result = db_fetch_array(db_query("select * from user where name='$buddy_name'"));
	if ($user_result['userid'])
	{
		if ($duplicate = db_fetch_array(db_query("select * from buddylist where userid=$user[userid] and buddyuserid=$user_result[userid]")))
		{
			$pagetitle = 'Duplicate buddy';
			die(eval(get_template('add_buddy_duplicate')));
		}
		db_query("insert into buddylist (userid, buddyuserid, username) values ($user[userid], $user_result[userid], '".addslashes($user_result['name']).'\')');
		$pagetitle = 'Buddy added';
		if ($profile)
			$redirect_url = "profile.php?id=$user_result[userid]";
		else
			$redirect_url = 'user.php';
		eval(get_template('add_buddy_redirect'));
	}
	else
	{
		$pagetitle = 'Invalid user';
		eval(get_template('invalid_user'));
	}
}
elseif ($op=='add_ignore')
{
	if (!$user['userid'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	$ignore_name = dp_htmlspecialchars($_REQUEST['ignore_name']);
	if ($id)
		$user_result = db_fetch_array(db_query("select * from user where userid='$id'"));
	else
		$user_result = db_fetch_array(db_query("select * from user where name='$ignore_name'"));
	if ($user_result['userid'])
	{
		if ($duplicate = db_fetch_array(db_query("select * from ignorelist where userid=$user[userid] and ignoreuserid=$user_result[userid]")))
		{
			$pagetitle = 'Duplicate ignored user';
			die(eval(get_template('add_ignored_user_duplicate')));
		}
		$group_result = get_groups($user_result['userid']);
		if ($group_result['ignorelist'])
		{
			$pagetitle = 'Ignore list error';
			die(eval(get_template('add_ignored_user_denied')));
		}
		db_query("insert into ignorelist (userid, ignoreuserid, username) values ($user[userid], $user_result[userid], '".addslashes($user_result['name']).'\')');
		if ($profile)
			$redirect_url = "profile.php?id=$user_result[userid]";
		else
			$redirect_url = 'user.php';
		eval(get_template('add_ignored_user_redirect'));
	}
	else
	{
		$pagetitle = 'Invalid user';
		eval(get_template('invalid_user'));
	}
}
elseif ($op=='delete_buddy')
{
	if (!$user['userid'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
	{
		db_query("delete from buddylist where userid=$user[userid] and buddyuserid='$user_result[userid]'");
		header('Location: user.php');
	}
	else
	{
		$pagetitle = 'Invalid user';
		eval(get_template('invalid_user'));
	}
}
elseif ($op=='delete_ignore')
{
	if (!$user['userid'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
	{
		db_query("delete from ignorelist where userid=$user[userid] and ignoreuserid='$user_result[userid]'");
		header('Location: user.php');
	}
	else
	{
		$pagetitle = 'Invalid user';
		eval(get_template('invalid_user'));
	}
}
else
{
	if ($user['userid'])
	{
		$color = 'cellalt';
		$query = db_query("select user.* from buddylist,user where buddylist.userid=$user[userid] and buddylist.buddyuserid=user.userid order by username asc");
		while ($buddy = db_fetch_array($query))
		{
			$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
			$isonline = is_online($buddy);
			$showpm = show_pm($buddy);
			if ($group['max_recipients']>1 && $showpm && db_num_rows($query)>1)
			{
				if ($userids)
					$userids .= ",$buddy[userid]";
				else
					$userids = $buddy['userid'];
			}
			eval(store_template('user_buddy'));
			$buddies .= $user_buddy;
		}
		$color = 'cellalt';
		$query = db_query("select * from ignorelist where userid=$user[userid] order by username asc");
		while ($ignore = db_fetch_array($query))
		{
			$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
			eval(store_template('user_ignored_user'));
			$ignored .= $user_ignored_user;
		}
		get_forum_store();
		if ($forumstore)
		{
			$color = 'cellalt';
			if ($config['doticons'])
				$query = db_query("select thread.*,post.userid as doticon,icon.image,icon.name as icon_name,markread.postid as markread_postid from subscribedthread,thread left join icon on icon.iconid=thread.iconid left join post on thread.threadid=post.threadid and post.userid=$user[userid] left join markread on markread.threadid=thread.threadid and markread.userid=$user[userid] where subscribedthread.threadid=thread.threadid and subscribedthread.userid=$user[userid] and $user[lastvisit]<lastpostdate group by thread.threadid order by lastpostdate desc");
			else
				$query = db_query("select thread.*,icon.image,icon.name as icon_name,markread.postid as markread_postid from subscribedthread,thread left join icon on icon.iconid=thread.iconid left join markread on markread.threadid=thread.threadid and markread.userid=$user[userid] where subscribedthread.threadid=thread.threadid and subscribedthread.userid=$user[userid] and $user[lastvisit]<lastpostdate order by lastpostdate desc");
			while ($thread = db_fetch_array($query))
			{
				$thread['name'] = censor($thread['name'], $config['censored_words']);
				$stop = false;
				
				while (list($forumextra, $forum) = each($forumstore))
					if ($forum['forumid']==$thread['forumid'])
						break;
				reset($forumstore);
				$perm = get_forum_permissions($forum);
				if (!$perm['viewthreads'])
					continue;
				
				$forum['lastpost'] = $forum['lastpostdate'];
				if ($forum['lastpostdate'])
					$forum['lastpostdate'] = time_adjust($forum['lastpostdate'], $style['lastpost_date_format']);
				if ($user['lastvisit']<$thread['lastpostdate'])
					$newposts = true;
				else
					$newposts = false;
				if ($config['doticons'] && $thread['doticon'])
					$doticon = true;
				else
					$doticon = false;
				if ($config['markread'] && $user['markread'])
				{
					if ($newposts && $thread['markread_postid']<$thread['lastpostid'])
						$newposts = true;
					else
						$newposts = false;
				}
				if (!$newposts)
					continue;
				if ($thread['poll'])
					$thread['iconid'] = 0;
				else
				{
					if ($thread['iconid'])
						$thread['image'] = parse_image($thread['image']);
				}
				ob_start();
					if ($thread['closed'])
					{
						if ($thread['posts'] >= $config['min_posts_hot'] || $thread['views'] >= $config['min_views_hot'])
							eval(get_template('new_posts_closed_hot'));
						else
							eval(get_template('new_posts_closed'));
					}
					else
					{
						if ($thread['posts'] >= $config['min_posts_hot'] || $thread['views'] >= $config['min_views_hot'])
							eval(get_template('new_posts_hot'));
						else
							eval(get_template('new_posts'));
					}
					$isread = ob_get_contents();
				ob_end_clean();
				
				$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
				$thread['lastpostdate'] = time_adjust($thread['lastpostdate'], $style['lastpost_date_format']);
				$thread['replies'] = $thread['posts'] - 1;
				$numpages = ceil($thread['posts']/$config['posts_per_page']);
				if ($config['numlinks_multipage'] && $numpages>1)
				{
					for ($thread_page=1; $thread_page<=$config['numlinks_multipage']; $thread_page++)
					{
						if ($thread_page > $numpages)
							break;
						else
						{
							eval(store_template('forumdisplay_multipage_link'));
							$multipage_nav .= $forumdisplay_multipage_link;
						}
					}
					if ($numpages > $config['numlinks_multipage'])
					{
						eval(store_template('forumdisplay_multipage_last'));
						$multipage_nav .= $forumdisplay_multipage_last;
					}
				}
				$thread['posts'] = number_format($thread['posts'], 0, '.', $style['separator']);
				$thread['views'] = number_format($thread['views'], 0, '.', $style['separator']);
				eval(store_template('user_subscribed_thread', '$thread_result'));
				$multipage_nav = '';
				$threads .= $thread_result;
				$multipage = '';
			}
			reset($forumstore);
			
			if ($config['markread'] && $user['markread'])
				get_markforumread_store();
			$query = db_query("select * from subscribedforum where userid=$user[userid]");
			while ($subscribedforum = db_fetch_array($query))
				$subscribedforumstore[$subscribedforum['forumid']] = 1;
			
			$color = 'cellalt';
			$i = 0;
			while ($forum = $forumstore[$i++])
			{
				if (!$subscribedforumstore[$forum['forumid']])
					continue;
				$forum['lastpost'] = $forum['lastpostdate'];
				if ($forum['lastpostdate'])
					$forum['lastpostdate'] = time_adjust($forum['lastpostdate'], $style['lastpost_date_format']);
				if ($config['markread'] && $user['markread'])
				{
					if ($markforumreadstore[$forum['forumid']])
						$newposts = true;
					else
						$newposts = false;
				}
				else
				{
					if ($user['lastvisit']<$forum['lastpost'])
						$newposts = true;
					else
						$newposts = false;
				}
				
				$perm = get_forum_permissions($forum);
				if (!$perm['viewforums'] && $config['hideforums'])
					continue;
				if (!$perm['viewforums'])
					$locked = true;
				else
					$locked = false;
				$moderators = '';
				$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
				
				eval(store_template('user_subscribed_forum', '$forum_result'));
				$forums .= $forum_result;
			}
		}
		$pagetitle = 'User control panel';
		eval(get_template('user_index'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
?>