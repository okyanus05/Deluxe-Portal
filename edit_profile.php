<?php
/**************************************************
* Edit Options
* ------------
* Allows you to edit user options.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'editprofile_customfield,editprofile_index,editprofile_signature,edit_profile_email,edit_profile_missing,edit_profile_redirect,email_banned,email_duplicate,email_invalid,mail_emailreverify';
/**************************************************
* Global variable resetting                      */
unset($customfields);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$email = $_POST['email'];
$title = $_POST['title'];
/*************************************************/

if ($group['edit_profile'] && $user['userid'])
{
	if ($_POST['op']=='doedit')
	{
		if ($email)
		{
			$email = dp_htmlspecialchars($email);
			if (!check_email($email))
			{
				$pagetitle = 'Invalid email address';
				die(eval(get_template('email_invalid')));
			}
			$ip = explode('\n', $config['banned_email']);
			$i = 0;
			while ($banned = $ip[$i++])
			{
				if (strstr($email, $banned))
				{
					$pagetitle = 'Email address banned';
					die(eval(get_template('email_banned')));
				}
			}
			if ($config['unique_email'] && db_num_rows(db_query("select userid from user where email='$email' and userid!=$user[userid]")))
			{
				$pagetitle = 'Duplicate email address';
				die(eval(get_template('email_duplicate')));
			}
			$location = dp_htmlspecialchars(censor($_POST['location'], $config['censored_words']));
			$email = dp_htmlspecialchars($_POST['email']);
			$aol = dp_htmlspecialchars(censor($_POST['aol'], $config['censored_words']));
			$msn = dp_htmlspecialchars(censor($_POST['msn'], $config['censored_words']));
			$yahoo = dp_htmlspecialchars(censor($_POST['yahoo'], $config['censored_words']));
			if ($group['customsignature'])
			{
				$signature = censor(wysiwyg_parse(dp_trim($_POST['signature']), $config['signature_smilies'], $group['html']), $config['censored_words']);
				if (($config['sig_lines'] && substr_count($signature, '<br />') > $config['sig_lines']-1) || ($config['sig_chars'] && strlen($signature) > $config['sig_chars']))
					die(eval(get_template('editprofile_signature')));
			}
			else
				$signature = '';
			if ($signature == '<br />&nbsp; ')
				$signature = '';
			if ($signature)
			{
				$parsed_signature = stripslashes($signature);
				if ($config['signature_dpcode'])
					$parsed_signature = dpcode_parse($parsed_signature, $config['signature_img'], true, true);
				if ($config['signature_smilies'])
					$parsed_signature = smilie_parse($parsed_signature);
				$parsed_signature = addslashes(censor($parsed_signature, $config['censored_words']));
			}
			if ($group['customtitle'])
			{
				if (!$group['exempt_titlecensor'])
					$title = censor($title, $config['censored_title']);
				$title = ',title=\''.dp_htmlspecialchars(substr($title, 0, $config['max_usertitlelen'])).'\'';
			}
			else
				$title = '';
			$website = website_parse($_POST['website']);
			db_query("update user set website='$website',aol='$aol',icq='$_POST[icq]',msn='$msn',yahoo='$yahoo',signature='$parsed_signature',uncached_signature='$signature',email='$email',location='$location'$title where userid=$user[userid]");
			$query = db_query('select * from customfield where edit=1');
			while ($field = db_fetch_array($query))
			{
				$var = dp_htmlspecialchars($_POST["field_$field[customfieldid]"]);
				$var = censor($var, $config['censored_words']);
				db_query("update usercustomfield set value='$var' where userid=$user[userid] and customfieldid=$field[customfieldid]");
			}
			$exempt = false;
			if (($email != $user['email']) && $config['email_groupid'])
			{
				$query = db_query('select * from defaultgroups where user=2');
				while ($group_result = db_fetch_array($query))
				{
					if (strstr(" $groupquery ", "groupid=$group_result[groupid]"))
					{
						$exempt = true;
						break;
					}
				}
				if (!$exempt)
				{
					db_query("delete from emailverify where userid=$user[userid]");
					if ($user['usergroups']!=$config['email_groupid'])
					{
						db_query("delete from emailgroups where userid=$user[userid]");
						reset($grouparray);
						while (list($key, $group_result) = each($grouparray))
						{
							if ($group_result['groupid'] == $user['groupid'])
								db_query("insert into emailgroups (userid, groupid, isprimary) values ($user[userid], $group_result[groupid], 1)");
							else
								db_query("insert into emailgroups (userid, groupid, isprimary) values ($user[userid], $group_result[groupid], 0)");
						}
						db_query("update user set groupid=$config[email_groupid],usergroups=$config[email_groupid] where userid=$user[userid]");
					}
					$key = md5(rand(0,32000).$_SERVER['REMOTE_ADDR'].rand(0,32000));
					db_query("insert into emailverify (userid, activationkey) values ($user[userid], '$key')");
					eval(store_template('mail_emailreverify', '$message'));
					dp_mail($email, "$config[name] Email Verification", $message, "From: \"$config[name] Mailer\" <$config[contact]>");
					$pagetitle = 'Profile updated';
					die(eval(get_template('edit_profile_email')));
				}
			}
			$pagetitle = 'Updating profile';
			$redirect_url = 'user.php';
			eval(get_template('edit_profile_redirect'));
		}
		else
		{
			$pagetitle = 'Missing profile fields';
			eval(get_template('edit_profile_missing'));
		}
	}
	else
	{
		$query = db_query("select * from customfield,usercustomfield where userid=$user[userid] and customfield.customfieldid=usercustomfield.customfieldid and customfield.edit=1 and ordered>0 order by ordered");
		while ($field = db_fetch_array($query))
		{
			$field['value'] = html_fix($field['value']);
			eval(store_template('editprofile_customfield'));
			$customfields .= $editprofile_customfield;
		}
		$user['location'] = html_fix($user['location']);
		$user['title'] = html_fix($user['title']);
		edit_parse($user['uncached_signature'], $config['signature_dpcode'], $config['signature_img'], $config['signature_smilies'], $group['html']);
		$pagetitle = 'Edit profile';
		eval(get_template('editprofile_index'));
	}
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>