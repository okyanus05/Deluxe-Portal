<?php
/**************************************************
* Register
* --------
* Used to create a new user account.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'custom_field,email_banned,email_duplicate,email_invalid,invalid_styleset,mail_emailverify,register_account,register_account_comma,register_account_emailverify,register_account_imageverify,register_account_password,register_account_redirect,register_disabled,register_index,styleset_choice';
/**************************************************
* Global variable resetting                      */
unset($customfields);
unset($stylesets);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$email = $_POST['email'];
$name = $_POST['name'];
$website = $_POST['website'];
/*************************************************/

if ($user['userid'])
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}

if ($config['allow_registration'])
{
	$use_gd = $config['gd_registration'] && ImageVerification::check_gd();
	
	if ($_REQUEST['op']=='register')
	{
		if ($use_gd && !$user['registerid'])
		{
			$pagetitle = 'Access denied';
			die(eval(get_template('permission_error')));
		}
		if ($use_gd && $_COOKIE['sessionid'])
			db_query("update session set registerid='" . addslashes(strtoupper(generate_salt(7))) . "' where sessionid='$_COOKIE[sessionid]'");

		$query = db_query('select * from styleset where enabled=1 order by name asc');
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
		$pagetitle = 'Register';
		eval(get_template('register_account'));
	}
	elseif ($_POST['op']=='doregister')
	{
		if ($use_gd && strtoupper(dp_trim(stripslashes($_POST['registerid'])))!=$user['registerid'])
		{
			$pagetitle = 'Image Verification Failed';
			die(eval(get_template('register_account_imageverify')));
		}
		$name = dp_trim($name);
		if (!check_email($email))
		{
			$pagetitle = 'Invalid email address';
			die(eval(get_template('email_invalid')));
		}
		$query = db_query("select userid from user where name='$name'");
		$ip = explode("\n", $config['banned_email']);
		$i = 0;
		while ($banned = $ip[$i++])
		{
			if (strstr($email, $banned))
			{
				$pagetitle = 'Email address banned';
				die(eval(get_template('email_banned')));
			}
		}
		if (!$name || !$email || !$_POST['password'] || !$_POST['password_confirm'])
		{
			$pagetitle = 'Required fields missing';
			eval(get_template('account_missing'));
		}
		elseif (db_num_rows($query))
		{
			$pagetitle = 'Duplicate account';
			eval(get_template('account_duplicate'));
		}
		elseif ($_POST['password'] != $_POST['password_confirm'])
		{
			$pagetitle = 'Password error';
			eval(get_template('register_account_password'));
		}
		elseif ((censor($name, $config['illegal_usernames'])!=$name) || ($name==$config['guest_name']))
		{
			$pagetitle = 'Illegal username';
			eval(get_template('account_illegal_name'));
		}
		elseif (dp_strlen($name)<$config['min_username_length'] || dp_strlen($name)>$config['max_username_length'])
		{
			$pagetitle = 'Username length error';
			eval(get_template('account_length'));
		}
		elseif ($config['unique_email'] && db_num_rows(db_query("select userid from user where email='$email'")))
		{
			$pagetitle = 'Duplicate email address';
			eval(get_template('email_duplicate'));
		}
		elseif (strstr($name, ','))
		{
			$pagetitle = 'Invalid username';
			eval(get_template('register_account_comma'));
		}
		else
		{
			if (!db_num_rows(db_query("select * from styleset where enabled=1 and stylesetid='$_POST[stylesetid]'")))
			{
				$pagetitle = 'Invalid style set';
				die(eval(get_template('invalid_styleset')));
			}
			$salt = generate_salt();
			$md5password = dp_hash($salt, $_POST['password']);
			$salt = addslashes($salt);
			$location = dp_htmlspecialchars(censor($_POST['location'], $config['censored_words']));
			$aol = dp_htmlspecialchars(censor($_POST['aol'], $config['censored_words']));
			$msn = dp_htmlspecialchars(censor($_POST['msn'], $config['censored_words']));
			$yahoo = dp_htmlspecialchars(censor($_POST['yahoo'], $config['censored_words']));
			$website = website_parse($website);
			$name = addslashes(dp_htmlspecialchars(stripslashes($name)));
			if ($config['email_groupid'])
				$groupid = $config['email_groupid'];
			else
				$groupid = $config['default_register_group'];
			unset($usergroups);
			if ($config['email_groupid'])
				$usergroups[] = $config['email_groupid'];
			else
			{
				$query = db_query('select * from defaultgroups where user=1');
				while ($usergroup = db_fetch_array($query))
					$usergroups[] = $usergroup['groupid'];
			}
			db_query("insert into user (lastactivity, user_salt, name, password, stylesetid, nopopup, website, massmail, quick_reply, pm, signature, usesignature, displaysignatures, subscribe, subscribe_email, avatar, time_zone, groupid, posts, title, joindate, markread, markread_time, email, hide_email, invisible, use_wysiwyg, icq, aol, msn, yahoo, img, location, notify_pm, lastvisit, show_avatars, pm_popup, auto_time_zone, time_zone_dst, southern_hemisphere, usergroups) values (0, '$salt', '$name', '$md5password', '$_POST[stylesetid]', 0, '$website', '$_POST[massmail]', '$_POST[quick_reply]', '$_POST[pm]', '', '$_POST[usesignature]', '$_POST[displaysignatures]', '$_POST[subscribe]', '$_POST[subscribe_email]', '', '$_POST[time_zone]', $groupid, 0, '', $current_time, '$_POST[markread]', '$_POST[markread_time]', '$email', '$_POST[hide_email]', '$_POST[invisible]', '$_POST[use_wysiwyg]', '$_POST[icq]', '$aol', '$msn', '$yahoo', '$_POST[img]', '$location', '$_POST[notify_pm]', 0, '$_POST[show_avatars]', '$_POST[pm_popup]', '$_POST[auto_time_zone]', '$_POST[time_zone_dst]', '$_POST[southern_hemisphere]', '".implode(',', $usergroups)."')");
			$user = db_fetch_array(db_query('select * from user order by userid desc limit 1'));
			$query = db_query('select * from customfield where edit=1');
			while ($field = db_fetch_array($query))
			{
				$var = dp_htmlspecialchars($_POST["field_$field[customfieldid]"]);
				$var = censor($var, $config['censored_words']);
				db_query("insert into usercustomfield (customfieldid, userid, value) values ($field[customfieldid], $user[userid], '$var')");
			}
			db_query("update config set stat_members=stat_members+1,stat_lastusername='$name',stat_lastuserid=$user[userid]");
			
			srand((double)microtime()*1000000);
			$sessionid = md5(rand(0,32000).$_SERVER['REMOTE_ADDR'].rand(0,32000));
			db_query("insert ignore into session (userid, sessionid, ip, lastactivity, lastvisit) values ($user[userid], '$sessionid', '$_SERVER[REMOTE_ADDR]', $current_time, 0)");
			setcookie('sessionid',$sessionid,time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_userid',$user['userid'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_md5pass',$user['password'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			setcookie('dp_joindate',$user['joindate'],time()+($config['cookie_expiration_date']*3600),$config['cookie_path'],$config['cookie_domain']);
			
			if ($config['email_groupid'])
			{
				$key = md5(rand(0,32000).$_SERVER['REMOTE_ADDR'].rand(0,32000));
				db_query("insert into emailverify (userid, activationkey) values ($user[userid], '$key')");
				$query = db_query('select * from defaultgroups where user=1');
				while ($usergroup = db_fetch_array($query))
				{
					if ($config['default_register_group']==$usergroup['groupid'])
						db_query("insert into emailgroups (userid, groupid, isprimary) values ($user[userid], $usergroup[groupid], 1)");
					else
						db_query("insert into emailgroups (userid, groupid, isprimary) values ($user[userid], $usergroup[groupid], 0)");
				}
				eval(store_template('mail_emailverify', '$message'));
				dp_mail($email, "$config[name] Email Verification", $message, "From: \"$config[name] Mailer\" <$config[contact]>");
				$pagetitle = 'Registration complete';
				eval(get_template('register_account_emailverify'));
			}
			else
			{
				$redirect_url = 'user.php';
				$pagetitle = 'Creating account';
				eval(get_template('register_account_redirect'));
			}
		}
	}
	else
	{
		$pagetitle = 'Register';
		eval(get_template('register_index'));
	}
}
else
{
	$pagetitle = 'Registration disabled';
	eval(get_template('register_disabled'));
}
?>