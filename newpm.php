<?php
/**************************************************
* New Private Message
* -------------------
* Allows you to compose and send a private message.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'mail_pmnotification,newpm_index,pm_disabled,send_pm_failed,send_pm_length,send_pm_missing,send_pm_recipients,send_pm_redirect';
/**************************************************
* Global variable resetting                      */
unset($userstore);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$dpcode = $_POST['dpcode'];
$folder = $_REQUEST['folder'];
$html = $_POST['html'];
$iconid = $_POST['iconid'];
$id = $_REQUEST['id'];
$message = $_POST['message'];
$preview_button = $_POST['preview_button'];
$savecopy = $_POST['savecopy'];
$showsignature = $_POST['showsignature'];
$smilies = $_POST['smilies'];
$subject = $_POST['subject'];
$url = $_POST['url'];
$userids = $_REQUEST['userids'];
$users = $_POST['users'];
/*************************************************/

if ($group['privatemessaging'])
{
	if (!$html || !$group['html'])
		$html = 0;
	if (!$user['pm'])
	{
		$pagetitle = 'Private messaging is disabled';
		die(eval(get_template('pm_disabled')));
	}
	if ($_POST['op']=='dosend')
	{
		if ($preview_button)
		{
			$subject = dp_htmlspecialchars(stripslashes($subject));
			$message = str_nl_normalize($message);
			if ($url)
				$message = auto_url($message);
			$message = stripslashes(wysiwyg_parse($message, ($smilies ? 0 : 1), $html));
			$preview_subject = censor($subject, $config['censored_words']);
			$preview_message = censor($message, $config['censored_words']);
			if (!$dpcode && $config['pm_dpcode'])
				$preview_message = dpcode_parse($preview_message, $config['pm_img']);
			if (!$smilies && $config['pm_smilies'])
				$preview_message = smilie_parse($preview_message);
			if ($iconid)
			{
				$preview_icon = db_fetch_array(db_query("select * from icon where iconid='$iconid'"));
				$preview_icon['image'] = parse_image($preview_icon['image']);
			}
			$pm['iconid'] = $iconid;
			$pm['subject'] = $subject;
			$pm['fromusername'] = dp_htmlspecialchars(stripslashes($users));
			edit_parse($message, $config['pm_dpcode'] && !$dpcode, $config['pm_img'], $config['pm_smilies'] && !$smilies);
		}
		else
		{
			if (!(($subject = dp_trim($subject)) && ($message = dp_trim($message))))
			{
				$pagetitle = 'Missing subject/message';
				die(eval(get_template('send_pm_missing')));
			}
			if ($config['pm_max_length'] && dp_strlen($message)>$config['pm_max_length'])
			{
				$pagetitle = 'Message too long';
				die(eval(get_template('send_pm_length')));
			}
			$subject = dp_htmlspecialchars($subject);
			if ($url)
				$message = auto_url($message);
			$dpcode = ($dpcode ? 0 : 1);
			$smilies = ($smilies ? 0 : 1);
			$message = wysiwyg_parse($message, $smilies, $html);
			$usernames = '';
			if ($userids = explode(',', stripslashes(dp_htmlspecialchars($users))))
			{
				foreach ($userids as $user_result)
					$usernames .= ($usernames ? ',' : '').'\''.addslashes(trim($user_result)).'\'';
			}
			$num_users = count($userids);
			if ($num_users>$group['max_recipients'])
			{
				$pagetitle = 'Maximum number of recipients exceeded';
				die(eval(get_template('send_pm_recipients')));
			}
			$failed = '';
			$numfailed = 0;
			$query = db_query("select user.*,ignorelist.ignoreuserid from user left join ignorelist on user.userid=ignorelist.userid and ignorelist.ignoreuserid=$user[userid] where name in ($usernames)");
			while ($user_result = db_fetch_array($query))
				$userstore[strtolower($user_result['name'])] = $user_result;
			if ($savecopy)
				$storedmessages = db_num_rows(db_query("select privatemessageid from privatemessage where userid=$user[userid]"));
			reset($userids);
			while (list($key, $username) = each($userids))
			{
				$username = trim($username);
				$user_result = $userstore[strtolower($username)];
				if (!$user_result)
				{
					$failed .= stripslashes($username)."<br />";
					$numfailed++;
					continue;
				}
				$group_result = get_groups($user_result['userid']);
				if (!$group_result['privatemessaging'] || !$user_result['pm'])
				{
					$failed .= "$user_result[name]<br />";
					$numfailed++;
					continue;
				}
				if (!$group['groups'] && $group_result['maxpm'] && db_num_rows(db_query("select privatemessageid from privatemessage where userid=$user_result[userid]"))>=$group_result['maxpm'])
				{
					$failed .= "$user_result[name]<br />";
					$numfailed++;
					continue;
				}
				if ($user_result['ignoreuserid'])
					continue;
				if ($savecopy)
				{
					if (!($group['maxpm'] && $storedmessages++>=$group['maxpm']))
						db_query("insert into privatemessage (userid, touserid, fromuserid, iconid, subject, message, dpcode, smilies, isread, fromusername, tousername, sentdate, folder, showsignature, html) values ($user[userid], $user_result[userid], $user[userid], '$iconid', '$subject', '$message', $dpcode, $smilies, 0, '".addslashes($user['name']).'\', \''.addslashes($user_result['name'])."', $current_time, 'sent', '$showsignature', '$html')");
				}
				db_query("insert into privatemessage (userid, touserid, fromuserid, iconid, subject, message, dpcode, smilies, isread, fromusername, tousername, sentdate, folder, showsignature, html) values ($user_result[userid], $user_result[userid], $user[userid], '$iconid', '$subject', '$message', $dpcode, $smilies, 0, '".addslashes($user['name']).'\', \''.addslashes($user_result['name'])."', $current_time, 'inbox', '$showsignature', '$html')");
				if ($user_result['notify_pm'])
				{
					$pm = db_fetch_array(db_query('select * from privatemessage order by privatemessageid desc limit 1'));
					$mailsubject = stripslashes($subject);
					eval(store_template('mail_pmnotification', '$mail_message'));
					dp_mail($user_result['email'], "$config[name] Private Message Notification", $mail_message, "From: \"$config[name] Mailer\" <$config[contact]>");
				}
			}
			
			if ($numfailed)
			{
				$pagetitle = 'Error while sending messages';
				eval(get_template('send_pm_failed'));
			}
			else
			{
				$pagetitle = 'Sending messages';
				$redirect_url = "pm.php?folder=$folder";
				eval(get_template('send_pm_redirect'));
			}
			die();
		}
	}
	
	if (!$preview_button)
	{
		$pm = db_fetch_array(db_query("select * from privatemessage where userid=$user[userid] and privatemessageid='$_REQUEST[id]'"));
		if ($_REQUEST['userid'] && $user_result = db_fetch_array(db_query("select name from user where userid='$_REQUEST[userid]'")))
			$pm['fromusername'] = $user_result['name'];
		if ($pm['privatemessageid'])
		{
			$pm['message'] = preg_replace('/\[quote\](.*?)\[\/quote\]/si', '', $pm['message']);
			$pm['message'] = "[quote][i]Originally posted by $pm[fromusername][/i]<br /><br />$pm[message][/quote]<br /><br />";
			if (dp_substr($pm['subject'], 0, 4)!='Re: ')
				$pm['subject'] = "Re: $pm[subject]";
			edit_parse($pm['message'], $config['pm_dpcode'], $config['pm_img'], $config['pm_smilies'], $pm['html'] && $group['html']);
		}
		if ($userids)
		{
			$query = db_query('select userid,name from user');
			while ($user_result = db_fetch_array($query))
				$userstore[$user_result['userid']] = $user_result['name'];
			$userids = explode(',', $userids);
			while (list($key, $userid) = each($userids))
			{
				if ($pm['fromusername'])
					$pm['fromusername'] .= ",$userstore[$userid]";
				else
					$pm['fromusername'] = $userstore[$userid];
			}
		}
	}
	$icons = display_icons($iconid);
	if ($config['pm_smilies'] && $config['number_smilies'])
		$smilie_box = smilie_box();
	if ($group['maxpm'] && db_num_rows(db_query("select privatemessageid from privatemessage where userid=$user[userid]"))>=$group['maxpm'])
		$overlimit = true;
	else
		$overlimit = false;
	
	$pagetitle = 'New Private Message';
	eval(get_template('newpm_index'));
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>