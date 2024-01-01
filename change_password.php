<?php
/**************************************************
* Change Password
* ---------------
* Allows a user to change his or her password.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'password_denied,password_index,password_missing,password_password,password_redirect';

require('function.php');

if ($group['edit_profile'] && $user['userid'])
{
	if ($_POST['op']=='doedit')
	{
		if ($_POST['password'] && $_POST['password_confirm'] && $_POST['old_password'])
		{
			if (dp_hash($user['user_salt'], $_POST['old_password']) == $user['password'])
			{
				if ($_POST['password'] != $_POST['password_confirm'])
				{
					$pagetitle = 'Passwords do not match';
					eval(get_template('password_password'));
				}
				else
				{
					$pagetitle = 'Password updated';
					$salt = generate_salt();
					$md5password = addslashes(dp_hash($salt, stripslashes($_POST['password'])));
					$salt = addslashes($salt);
					db_query("update user set user_salt='$salt', password='$md5password' where userid=$user[userid]");
					db_query("delete from session where sessionid<>'$_COOKIE[sessionid]' and userid='$user[userid]'");
					$redirect_url = 'user.php';
					eval(get_template('password_redirect'));
				}
			}
			else
			{
				$pagetitle = 'Incorrect password';
				eval(get_template('password_denied'));
			}
		}
		else
		{
			$pagetitle = 'Missing password';
			eval(get_template('password_missing'));
		}
	}
	else
	{
		$pagetitle = 'Change password';
		eval(get_template('password_index'));
	}
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>