<?php
/**************************************************
* Email address display
* ---------------------
* Displays users' email addresses.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'email_form,email_hidden,email_index,email_missing,email_send_redirect,invalid_user';

require('function.php');

if ($group['view_profile'])
{
	if ($user_result = db_fetch_array(db_query("select * from user where userid='$_REQUEST[id]'")))
	{
		if (!$user_result['hide_email'] || $group['users'])
		{
			if ($_POST['op'] == 'doemail')
			{
				if (!$_POST['subject'] || !$_POST['message'])
				{
					$pagetitle = 'Subject and message required';
					die(eval(get_template('email_missing')));
				}
				if ($user['userid'])
					$from = "From: \"$user[name]\" <$user[email]>";
				else
					$from = "From: \"Guest at $config[name]\" <$config[contact]>";
				dp_mail($user_result['email'], stripslashes($_POST['subject']), stripslashes($_POST['message']), $from);
				$pagetitle = 'Sending email';
				$redirect_url = "profile.php?id=$user_result[userid]";
				die(eval(get_template('email_send_redirect')));
			}
			if ($config['show_email'] == 'address')
			{
				$pagetitle = "Email address - $user_result[name]";
				eval(get_template('email_index'));
			}
			elseif ($config['show_email'] == 'form')
			{
				$pagetitle = "Email $user_result[name]";
				eval(get_template('email_form'));
			}
			else
			{
				$pagetitle = 'Email address - $user_result[name]';
				eval(get_template('email_hidden'));
			}
		}
		else
		{
			$pagetitle = 'Email address - $user_result[name]';
			eval(get_template('email_hidden'));
		}
	}
	else
	{
		$pagetitle = 'Invalid user';
		eval(get_template('invalid_user'));
	}
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>