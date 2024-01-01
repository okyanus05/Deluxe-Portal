<?php
/**************************************************
* Users
* -----
* Allows you to add, edit, and remove user
* accounts. You can also search for users, and
* search for IP addresses.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'account_illegal_name,add_user,check_ip,check_ip_result,check_ip_results,custom_field,delete_user,delete_user_redirect,edit_user,edit_user_redirect,group_choice,invalid_user,logout_user_redirect,mail_pmnotification,massdelete_users,massdelete_users_redirect,massmail_users,massmail_users_continue,massmail_users_redirect,masspm_users,masspm_users_continue,masspm_users_redirect,register_account_comma,styleset_choice,usergroup_choice,users_duplicate,users_index,users_missing,users_password,users_search,users_search_result,users_user';
/**************************************************
* Global variable resetting                      */
unset($customfields);
unset($groups);
unset($lastuser);
unset($smilie_box);
unset($stylesets);
unset($usergroups);
unset($usergroups_col1);
unset($usergroups_col2);
unset($users);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$aol = $_POST['aol'];
$cycle = $_POST['cycle'];
$dpcode = $_POST['dpcode'];
$email = $_POST['email'];
$groupid = $_POST['groupid'];
$html = $_POST['html'];
$icq = $_POST['icq'];
$id = $_REQUEST['id'];
$location = $_POST['location'];
$markread_time = $_POST['markread_time'];
$maxjoin = $_POST['maxjoin'];
$maxposts = $_POST['maxposts'];
$message = $_POST['message'];
$minjoin = $_POST['minjoin'];
$minposts = $_POST['minposts'];
$msn = $_POST['msn'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$password = $_POST['password'];
$results = $_REQUEST['results'];
$signature = $_POST['signature'];
$smilies = $_POST['smilies'];
$start = $_POST['start'];
$stylesetid = $_REQUEST['stylesetid'];
$subject = $_POST['subject'];
$title = $_POST['title'];
$username = $_POST['username'];
$website = $_POST['website'];
$yahoo = $_POST['yahoo'];
/*************************************************/

$pagetitle = 'Users';

if ($group['users'])
{
	if ($op=='search')
	{
		adminlog('Viewed user search results');
		$color = 'cellalt';
		$usergroupquery = '';
		$query = db_query('select groupid from groups');
		while ($group_result = db_fetch_array($query))
		{
			if ($_REQUEST["group_$group_result[groupid]"] || $_REQUEST['all_groups'])
				$usergroupquery .= "FIND_IN_SET($group_result[groupid], usergroups) or ";
		}
		$usergroupquery = dp_substr($usergroupquery, 0, -4);
		if (!$usergroupquery)
			$usergroupquery = 'FIND_IN_SET(0, usergroups)';
		get_group_store();
		if (!$_REQUEST['all'])
		{
			$fieldquery = '';
			$tablelist = '';
			$i = 1;
			$query = db_query('select * from customfield');
			while ($field = db_fetch_array($query))
			{
				if ($_POST["field_$field[customfieldid]"])
				{
					$tablelist .= ",usercustomfield as c$i";
					$fieldquery .= " and (c$i.customfieldid=$field[customfieldid] and c$i.userid=user.userid and c$i.value like '%".escape_like($_POST["field_$field[customfieldid]"]).'%\')';
					$i++;
				}
			}
			$name = htmlspecialchars(addslashes($name));
			$query = db_query("select * from user$tablelist where user.name like '%".escape_like($name)."%' ".($stylesetid ? "and stylesetid='$stylesetid' " : '')."and website like '%".escape_like($website)."%' and email like '%".escape_like($email)."%' and aol like '%".escape_like($aol)."%' and icq like '%".escape_like($icq)."%' and msn like '%".escape_like($msn)."%' and yahoo like '%".escape_like($yahoo)."%' and title like '%".escape_like($title)."%' and posts>='$minposts' and posts<='$maxposts'".($minjoin && $minjoin!='1969-12-31' ? " and joindate>=UNIX_TIMESTAMP('$minjoin')" : '').($maxjoin && $maxjoin!='2029-12-31' ? " and joindate<=UNIX_TIMESTAMP('$maxjoin')" : '')." and uncached_signature like '%".escape_like($signature)."%' and location like '%".escape_like($location)."%' and ($usergroupquery)$fieldquery order by name");
		}
		else
			$query = db_query("select * from user where $usergroupquery order by user.name");
		$userids = '';
		while ($user_result = db_fetch_array($query))
		{
			if (db_num_rows($query)==1)
				die(header("Location: users.php?op=edit&id=$user_result[userid]"));
			if ($userids)
				$userids .= ',';
			$userids .= $user_result['userid'];
			$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
			eval('$user_result[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($groupstoreid[$user_result['groupid']]['online_template_large'])).'";');
			$user_result['joindate'] = time_adjust($user_result['joindate'], $style['join_date_format']);
			$showemail = show_email($user_result);
			$showpm = show_pm($user_result);
			$showsearch = show_search($user_result);
			eval(store_template('users_search_result', '$user_name'));
			$users .= $user_name;
		}
		eval(get_template('users_search'));
	}
	elseif ($_POST['op']=='mass')
	{
		if ($_POST['delete'])
			eval(get_template('massdelete_users'));
		elseif ($_POST['email'])
			eval(get_template('massmail_users'));
		elseif ($_POST['pm'])
		{
			$icons = display_icons();
			if ($config['pm_smilies'] && $config['number_smilies'])
				$smilie_box = smilie_box();
			eval(get_template('masspm_users'));
		}
	}
	elseif ($_POST['op']=='domassdelete')
	{
		$userids = explode(',', $results);
		while (list($key, $id) = each($userids))
		{
			db_query("update article set userid=0 where userid='$id'");
			db_query("update forum set lastuserid=0 where lastuserid='$id'");
			db_query("update post set userid=0 where userid='$id'");
			db_query("update thread set userid=0 where userid='$id'");
			db_query("update thread set lastuserid=0 where lastuserid='$id'");
			db_query("delete from buddylist where userid='$id'");
			db_query("delete from buddylist where buddyuserid='$id'");
			db_query("delete from ignorelist where userid='$id'");
			db_query("delete from ignorelist where ignoreuserid='$id'");
			db_query("delete from markread where userid='$id'");
			db_query("delete from moderator where userid='$id'");
			db_query("delete from session where userid='$id'");
			db_query("delete from user where userid='$id'");
			db_query("delete from usercustomfield where userid='$id'");
			db_query("delete from whovoted where userid='$id'");
			$lastuser = db_fetch_array(db_query('select userid,name from user order by userid desc limit 1'));
			db_query("update config set stat_members=stat_members-1,stat_lastusername='$lastuser[name]',stat_lastuserid='$lastuser[userid]'");
		}
		adminlog('Mass deleted users - <b>$results</b>');
		$redirect_url = 'users.php';
		eval(get_template('massdelete_users_redirect'));
	}
	elseif ($_POST['op']=='domassmail')
	{
		$query = db_query('select userid,email,massmail from user');
		while ($user_result = db_fetch_array($query))
			$userstore[$user_result['userid']] = $user_result;
		$userids = explode(',', $results);
		for ($z = 0; $z < $start; $z++)
			each($userids);
		$i = 0;
		while (list($key, $userid) = each($userids))
		{
			if (++$i > $cycle)
				break;
			if ($userstore[$userid]['massmail'])
				dp_mail($userstore[$userid]['email'], stripslashes($subject), stripslashes($message), "From: \"$config[name] Mailer\" <$config[contact]>");
		}
		$i--;
		$start += $i;
		$subject = htmlspecialchars(stripslashes($subject));
		$message = htmlspecialchars(stripslashes($message));
		if (!$start)
		{
			adminlog("Started mass mailing users(up to <b>$start</b>)");
			if ($i < $cycle)
				eval(get_template('massmail_users_redirect'));
			else
				eval(get_template('massmail_users_continue'));
		}
		elseif ($i==$cycle)
		{
			adminlog("Continued mass mailing users (up to <b>$start</b>)");
			eval(get_template('massmail_users_continue'));
		}
		else
		{
			adminlog("Ended mass mailing users (up to <b>$start</b>)");
			eval(get_template('massmail_users_redirect'));
		}
	}
	elseif ($_POST['op']=='domasspm')
	{
		$query = db_query("select userid,pm,notify_pm,groupid,name,email from user where userid in ($results)");
		while ($user_result = db_fetch_array($query))
			$userstore[$user_result['userid']] = $user_result;
		$userids = explode(',', $results);
		for ($z = 0; $z < $start; $z++)
			each($userids);
		$i = 0;
		$oldsubject = $subject;
		$oldmessage = $message;
		$subject = htmlspecialchars($subject);
		if ($_POST['url'])
			$message = auto_url($message);
		$smilies = ($smilies ? 0 : 1);
		$message = wysiwyg_parse($message, $smilies, $html);
		$dpcode = ($dpcode ? 0 : 1);
		while (list($key, $userid) = each($userids))
		{
			if (++$i > $cycle)
				break;
			if ($userstore[$userid]['pm'])
			{
				$usergroup = get_groups($userid);
				if ($usergroup['privatemessaging'])
				{
					db_query("insert into privatemessage (userid, touserid, fromuserid, iconid, subject, message, dpcode, smilies, isread, fromusername, tousername, sentdate, folder, html) values ('$userid', '$userid', $user[userid], '$_POST[iconid]', '$subject', '$message', $dpcode, $smilies, 0, '".addslashes($user['name']).'\', \''.addslashes($userstore[$userid]['name'])."', $current_time, 'inbox', '$html')");
					if ($userstore[$userid]['notify_pm'])
					{
						$pm = db_fetch_array(db_query('select * from privatemessage order by privatemessageid desc limit 1'));
						$mailsubject = stripslashes($subject);
						eval(store_template('mail_pmnotification', '$mail_message'));
						dp_mail($userstore[$userid]['email'], "$config[name] Private Message Notification", $mail_message, "From: \"$config[name] Mailer\" <$config[contact]>");
					}
				}
			}
		}
		$i--;
		$start += $i;
		$subject = htmlspecialchars(stripslashes($oldsubject));
		$message = htmlspecialchars(stripslashes($oldmessage));
		$dpcode = ($dpcode ? 0 : 1);
		$smilies = ($smilies ? 0 : 1);
		if (!$start)
		{
			adminlog("Started mass PMing users(up to <b>$start</b>)");
			if ($i < $cycle)
				eval(get_template('masspm_users_redirect'));
			else
				eval(get_template('masspm_users_continue'));
		}
		elseif ($i==$cycle)
		{
			adminlog("Continued mass PMing users (up to <b>$start</b>)");
			eval(get_template('masspm_users_continue'));
		}
		else
		{
			adminlog("Ended mass PMing users (up to <b>$start</b>)");
			eval(get_template('masspm_users_redirect'));
		}
	}
	elseif ($op=='logout')
	{
		if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
		{
			db_query("delete from session where userid='$user_result[userid]'");
			adminlog("Logged user off - <b>$user_result[name] ($user_result[userid])</b>");
			$redirect_url = 'users.php';
			eval(get_template('logout_user_redirect'));
		}
		else
			eval(get_template('invalid_user'));
	}
	elseif ($op=='add')
	{
		$query = db_query('select * from defaultgroups where user=1');
		while ($usergroup = db_fetch_array($query))
			$usergroups .= "$usergroup[groupid],";
		$query = db_query('select * from groups order by name asc');
		$num_col1 = ceil(db_num_rows($query)/2);
		$i = 0;
		$checked = false;
		while ($group_result = db_fetch_array($query))
		{
			if ($group_result['groupid']==$config['default_register_group'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('group_choice'));
			eval(store_template('usergroup_choice'));
			if (++$i<=$num_col1)
				$usergroups_col1 .= $usergroup_choice;
			else
				$usergroups_col2 .= $usergroup_choice;
			$groups .= $group_choice;
		}
		$query = db_query('select * from styleset order by name asc');
		while ($styleset_result = db_fetch_array($query))
		{
			if ($styleset_result['stylesetid']==$config['default_styleset'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('styleset_choice'));
			$stylesets .= $styleset_choice;
		}
		$query = db_query('select * from customfield order by ordered');
		while ($field = db_fetch_array($query))
		{
			eval(store_template('custom_field', '$customfield'));
			$customfields .= $customfield;
		}
		$joindate = time_adjust($current_time, 'Y-m-d H:i:s');
		eval(get_template('add_user'));
	}
	elseif ($_POST['op']=='doadd')
	{
		$name = trim($name);
		if (($name = trim(addslashes(htmlspecialchars(stripslashes($name))))) && ($email = trim($email)) && $groupid && $password && $_POST['password_confirm'])
		{
			if ($password != $_POST['password_confirm'])
				eval(get_template('users_password'));
			else
			{
				if ($duplicate = db_fetch_array(db_query("select * from user where name='$name'")))
					eval(get_template('users_duplicate'));
				elseif ($name==$config['guest_name'])
					eval(get_template('account_illegal_name'));
				elseif (strstr($name, ','))
					eval(get_template('register_account_comma'));
				else
				{
					$aol = htmlspecialchars($aol);
					$msn = htmlspecialchars($msn);
					$yahoo = htmlspecialchars($yahoo);
					$email = htmlspecialchars($email);
					$salt = generate_salt();
					$md5password = addslashes(dp_hash($salt, stripslashes($password)));
					$salt = addslashes($salt);
					if ($_FILES['image']['size'])
						$image = upload_image('avatar', true);
					if ($signature)
						$signature = wysiwyg_parse($signature, true, true);
					if ($signature == '<br />&nbsp; ')
						$signature = '';
					if ($signature)
					{
						$parsed_signature = stripslashes($signature);
						if ($config['signature_dpcode'])
							$parsed_signature = dpcode_parse($parsed_signature, $config['signature_img'], true, true);
						if ($config['signature_smilies'])
							$parsed_signature = smilie_parse($parsed_signature, true);
						$parsed_signature = addslashes($parsed_signature);
					}
					$website = website_parse($website);
					db_query("insert into user (user_salt, name, password, stylesetid, nopopup, massmail, quick_reply, pm, signature, usesignature, displaysignatures, subscribe, subscribe_email, avatar, time_zone, groupid, posts, title, joindate, markread, markread_time, email, hide_email, invisible, use_wysiwyg, location, website, img, notify_pm, lastvisit, show_avatars, pm_popup, auto_time_zone, time_zone_dst, southern_hemisphere, uncached_signature) values ('$salt', '$name', '$md5password', '$stylesetid', 0, '$_POST[massmail]', '$_POST[quick_reply]', '$_POST[pm]', '$parsed_signature', '$_POST[usesignature]', '$_POST[displaysignatures]', '$_POST[subscribe]', '$_POST[subscribe_email]', '$image', '$_POST[time_zone]', '$groupid', '$_POST[posts]', '$title', UNIX_TIMESTAMP('$_POST[joindate]'), '$_POST[markread]', '$markread_time', '$email', '$_POST[hide_email]', '$_POST[invisible]', '$_POST[use_wysiwyg]', '$location', '$website', '$_POST[img]', '$_POST[notify_pm]', 0, '$_POST[show_avatars]', '$_POST[pm_popup]', '$_POST[auto_time_zone]', '$_POST[time_zone_dst]', '$_POST[southern_hemisphere]', '$signature')");
					$user_result = db_fetch_array(db_query('select userid from user order by userid desc limit 1'));
					adminlog("Added user - <b>$name ($user_result[userid])</b>");
					$query = db_query('select groupid from groups');
					while ($group_result = db_fetch_array($query))
					{
						if ($_POST["group_$group_result[groupid]"] || $group_result['groupid']==$groupid)
							$usergroups .= ",$group_result[groupid]";
					}
					$usergroups = substr($usergroups, 1);
					db_query("update user set usergroups='$usergroups' where userid=$user_result[userid]");
					$query = db_query('select * from customfield');
					while ($field = db_fetch_array($query))
						db_query("insert into usercustomfield (customfieldid, userid, value) values ($field[customfieldid], $user_result[userid], '".$_POST["field_$field[customfieldid]"].'\')');
					db_query("update config set stat_members=stat_members+1,stat_lastusername='$name',stat_lastuserid=$user_result[userid]");
					header('Location: users.php');
				}
			}
		}
		else
			eval(get_template('users_missing'));
	}
	elseif ($op=='edit')
	{
		if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
		{
			adminlog("Edited user - <b>$user_result[name] ($user_result[userid])</b>");
			$query = db_query('select * from groups order by name asc');
			$num_col1 = ceil(db_num_rows($query)/2);
			$i = 0;
			while ($group_result = db_fetch_array($query))
			{
				if ($group_result['groupid']==$user_result['groupid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('group_choice'));
				if (in_array($group_result['groupid'], explode(',', $user_result['usergroups'])) && $group_result['groupid']!=$user_result['groupid'])
					$checked = true;
				else 
					$checked = false;
				eval(store_template('usergroup_choice'));
				if (++$i<=$num_col1)
					$usergroups_col1 .= $usergroup_choice;
				else
					$usergroups_col2 .= $usergroup_choice;
				$groups .= $group_choice;
			}
			
			$query = db_query("select * from customfield,usercustomfield where userid='$user_result[userid]' and customfield.customfieldid=usercustomfield.customfieldid order by ordered");
			while ($field = db_fetch_array($query))
			{
				$field['value'] = html_fix($field['value']);
				eval(store_template('custom_field', '$customfield'));
				$customfields .= $customfield;
			}
			
			$query = db_query('select * from styleset order by name asc');
			while ($styleset_result = db_fetch_array($query))
			{
				if ($styleset_result['stylesetid']==$user_result['stylesetid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('styleset_choice'));
				$stylesets .= $styleset_choice;
			}
			if ($user_result['avatar'])
				$user_result['parsed_avatar'] = parse_image($user_result['avatar']);
			$user_result['joindate'] = time_adjust($user_result['joindate'], 'Y-m-d H:i:s');
			$user_result['location'] = html_fix($user_result['location']);
			$user_result['title'] = html_fix($user_result['title']);
			edit_parse($user_result['uncached_signature'], $config['signature_dpcode'], $config['signature_img'], $config['signature_smilies'], true);
			eval(get_template('edit_user'));
		}
		else
			eval(get_template('invalid_user'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if (($name = trim(addslashes(htmlspecialchars(stripslashes($name))))) && $groupid)
		{
			if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
			{
				if ($password != $_POST['password_confirm'])
					eval(get_template('users_password'));
				else
				{
					if ($duplicate = db_fetch_array(db_query("select * from user where userid!='$user_result[userid]' and name='$name'")))
						eval(get_template('users_duplicate'));
					elseif ($name==$config['guest_name'])
						eval(get_template('account_illegal_name'));
					elseif (strstr($name, ','))
						eval(get_template('register_account_comma'));
					else
					{
						adminlog("Updated user - <b>$user_result[name] ($user_result[userid])</b>");
						if ($user_result['name']!=stripslashes($name))
						{
							db_query("update article set username='$name' where userid='$user_result[userid]'");
							db_query("update announcement set username='$name' where userid='$user_result[userid]'");
							db_query("update buddylist set username='$name' where buddyuserid='$user_result[userid]'");
							db_query("update config set stat_lastusername='$name' where stat_lastuserid='$user_result[userid]'");
							db_query("update forum set lastusername='$name' where lastuserid='$user_result[userid]'");
							db_query("update ignorelist set username='$name' where ignoreuserid='$user_result[userid]'");
							db_query("update moderator set username='$name' where userid='$user_result[userid]'");
							db_query("update post set username='$name' where userid='$user_result[userid]'");
							db_query("update post set editedby_username='$name' where editedby_userid='$user_result[userid]'");
							db_query("update privatemessage set fromusername='$name' where fromuserid='$user_result[userid]'");
							db_query("update privatemessage set tousername='$name' where touserid='$user_result[userid]'");
							db_query("update thread set username='$name' where userid='$user_result[userid]'");
							db_query("update thread set lastusername='$name' where lastuserid='$user_result[userid]'");
						}
						$aol = htmlspecialchars($aol);
						$msn = htmlspecialchars($msn);
						$yahoo = htmlspecialchars($yahoo);
						$email = htmlspecialchars($email);
						$querypart = '';
						if ($password)
						{
							$salt = generate_salt();
							$md5password = dp_hash($salt, $password);
							$salt = addslashes($salt);
							$querypart = ",user_salt='$salt',password='$md5password'";
						}
						if (!$_POST['useavatar'])
						{
							$image = '';
							if (dp_substr($user_result['avatar'], 0, 1)==':')
								db_query('delete from imagestore where imageid=\''.dp_substr($user_result['avatar'], 1).'\'');
						}
						elseif (!$_FILES['image']['size'])
							$image = $user_result['avatar'];
						else
						{
							$image = upload_image('avatar', true);
							if (dp_substr($user_result['avatar'], 0, 1)==':')
								db_query('delete from imagestore where imageid=\''.dp_substr($user_result['avatar'], 1).'\'');
						}
						if ($signature)
							$signature = wysiwyg_parse($signature, true, true);
						if ($signature == '<br />&nbsp; ')
							$signature = '';
						if ($signature)
						{
							$parsed_signature = stripslashes($signature);
							if ($config['signature_dpcode'])
								$parsed_signature = dpcode_parse($parsed_signature, $config['signature_img'], true, true);
							if ($config['signature_smilies'])
								$parsed_signature = smilie_parse($parsed_signature, true);
							$parsed_signature = addslashes($parsed_signature);
						}
						$website = website_parse($website);
						$lastvisitquery = '';
						if ($prev_user['markread_time']!=$markread_time)
						{
							if ($markread_time)
							{
								$newvisit = $current_time-($markread_time*60);
								if ($newvisit<$lastvisit)
								{
									$lastvisitquery = "lastvisit='$newvisit',";
									db_query("update session set lastvisit='$newvisit' where userid=$user_result[userid]");
								}
							}
						}
						db_query('update user set '.$lastvisitquery."name='$name',pm_popup='$_POST[pm_popup]',show_avatars='$_POST[show_avatars]',notify_pm='$_POST[notify_pm]',img='$_POST[img]',website='$website',email='$email',groupid='$groupid',massmail='$_POST[massmail]',quick_reply='$_POST[quick_reply]',pm='$_POST[pm]',signature='$parsed_signature',uncached_signature='$signature',usesignature='$_POST[usesignature]',displaysignatures='$_POST[displaysignatures]',subscribe='$_POST[subscribe]',subscribe_email='$_POST[subscribe_email]',avatar='$image',location='$location',use_wysiwyg='$_POST[use_wysiwyg]',invisible='$_POST[invisible]',hide_email='$_POST[hide_email]',stylesetid='$stylesetid',posts='$_POST[posts]',joindate=UNIX_TIMESTAMP('$_POST[joindate]'),title='$title',markread='$_POST[markread]',markread_time='$markread_time',auto_time_zone='$_POST[auto_time_zone]',time_zone_dst='$_POST[time_zone_dst]',southern_hemisphere='$_POST[southern_hemisphere]',time_zone='$_POST[time_zone]'$querypart where userid='$user_result[userid]'");$query = db_query('select groupid from groups');
						unset($usergroups);
						while ($group_result = db_fetch_array($query))
						{
							if ($_POST["group_$group_result[groupid]"] || $group_result['groupid']==$groupid)
								$usergroups .= ",$group_result[groupid]";
						}
						$usergroups = substr($usergroups, 1);
						db_query("update user set usergroups='$usergroups' where userid=$user_result[userid]");
						$query = db_query('select * from customfield');
						while ($field = db_fetch_array($query))
							db_query("update usercustomfield set value='".$_POST["field_$field[customfieldid]"]."' where userid='$user_result[userid]' and customfieldid=$field[customfieldid]");
						$redirect_url = 'users.php';
						eval(get_template('edit_user_redirect'));
					}
				}
			}
			else
				eval(get_template('invalid_user'));
		}
		else
			eval(get_template('users_missing'));
	}
	elseif ($op=='delete')
	{
		if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
			eval(get_template('delete_user'));
		else
			eval(get_template('invalid_user'));
	}
	elseif ($op=='ipcheck')
		eval(get_template('check_ip'));
	elseif ($op=='doipcheck')
	{
		if (!$username)
		{
			$user_result = db_fetch_array(db_query("select name from user where userid='$_REQUEST[userid]'"));
			$username = $user_result['name'];
		}
		adminlog("Checked IP Addresses - Username <b>$username</b>, IP address <b>$_REQUEST[ipaddress]</b>");
		$url = 'users.php';
		$query = db_query('select * from post where '.($username ? 'username=\''.addslashes($username)."' and " : '')."ip!=0 and ip!='' and ip like '".escape_like($_REQUEST['ipaddress'])."%' group by ".($username ? 'ip' : 'username').' order by postdate asc');
		$results = '';
		while ($ip = db_fetch_array($query))
		{
			$hostname = @gethostbyaddr($ip['ip']);
			eval(store_template('check_ip_result'));
			$results .= $check_ip_result;
		}
		eval(get_template('check_ip_results'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
		{
			adminlog("Deleted user - <b>$user_result[userid]</b>");
			db_query("update article set userid=0 where userid='$user_result[userid]'");
			db_query("update forum set lastuserid=0 where lastuserid='$user_result[userid]'");
			db_query("update post set userid=0 where userid='$user_result[userid]'");
			db_query("update thread set userid=0 where userid='$user_result[userid]'");
			db_query("update thread set lastuserid=0 where lastuserid='$user_result[userid]'");
			db_query("delete from buddylist where userid='$user_result[userid]'");
			db_query("delete from buddylist where buddyuserid='$user_result[userid]'");
			db_query("delete from ignorelist where userid='$user_result[userid]'");
			db_query("delete from ignorelist where ignoreuserid='$user_result[userid]'");
			db_query("delete from markread where userid='$user_result[userid]'");
			db_query("delete from moderator where userid='$user_result[userid]'");
			db_query("delete from session where userid='$user_result[userid]'");
			db_query("delete from user where userid='$user_result[userid]'");
			db_query("delete from usercustomfield where userid='$user_result[userid]'");
			db_query("delete from whovoted where userid='$user_result[userid]'");
			$lastuser = db_fetch_array(db_query('select userid,name from user order by userid desc limit 1'));
			db_query("update config set stat_members=stat_members-1,stat_lastusername='" . addslashes($lastuser['name']) . "',stat_lastuserid='$lastuser[userid]'");
			if (dp_substr($user_result['avatar'], 0, 1)==':')
				db_query('delete from imagestore where imageid=\''.dp_substr($user_result['avatar'], 1).'\'');
			$redirect_url = 'users.php';
			eval(get_template('delete_user_redirect'));
		}
		else
			eval(get_template('invalid_user'));
	}
	else
	{
		adminlog('Viewed users panel');
		$selected = false;
		$query = db_query('select * from groups order by name asc');
		$num_col1 = ceil(db_num_rows($query)/2);
		$i = 0;
		while ($group_result = db_fetch_array($query))
		{
			$checked = true;
			eval(store_template('usergroup_choice'));
			if (++$i<=$num_col1)
				$usergroups_col1 .= $usergroup_choice;
			else
				$usergroups_col2 .= $usergroup_choice;
		}
		$query = db_query('select * from user order by userid desc limit 20');
		while ($user_result = db_fetch_array($query))
		{
			eval(store_template('users_user', '$user_template'));
			$users .= $user_template;
		}
		$query = db_query('select * from customfield order by ordered');
		while ($field = db_fetch_array($query))
		{
			eval(store_template('custom_field', '$customfield'));
			$customfields .= $customfield;
		}
		$selected = false;
		$query = db_query('select * from styleset order by name asc');
		while ($styleset_result = db_fetch_array($query))
		{
			eval(store_template('styleset_choice'));
			$stylesets .= $styleset_choice;
		}
		eval(get_template('users_index'));
	}
}
else
	eval(get_template('permission_error'));
?>