<?php
/**************************************************
* Edit Options
* ------------
* Allows you to edit user options.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'editoptions_index,edit_options_avatar,edit_options_redirect,invalid_styleset,styleset_choice';
/**************************************************
* Global variable resetting                      */
unset($stylesets);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$markread_time = $_POST['markread_time'];
/*************************************************/

if ($group['edit_profile'] && $user['userid'])
{
	if ($_POST['op']=='doedit')
	{
		if (!db_num_rows(db_query("select * from styleset where enabled=1 and stylesetid='$_POST[stylesetid]'")))
			die(eval(get_template('invalid_styleset')));
		if ($group['customavatar'])
		{
			if (!$_POST['useavatar'])
			{
				$image = '';
				if (dp_substr($user['avatar'], 0, 1)==':')
					db_query('delete from imagestore where imageid=\''.dp_substr($user['avatar'], 1).'\'');
			}
			elseif (!$_FILES['image']['size'])
				$image = $user['avatar'];
			else
			{
				if (!check_image($config['avatar_size'], $config['avatar_types'], $config['avatar_width'], $config['avatar_height']))
				{
					$pagetitle = 'Avatar problem';
					die(eval(get_template('edit_options_avatar')));
				}
				$image = upload_image('avatar', 0);
				if (dp_substr($user['avatar'], 0, 1)==':')
					db_query('delete from imagestore where imageid=\''.dp_substr($user['avatar'], 1).'\'');
			}
		}
		$lastvisitquery = '';
		if ($user['markread_time']!=$markread_time)
		{
			if ($markread_time)
			{
				$newvisit = $current_time-($markread_time*60);
				if ($newvisit<$lastvisit)
				{
					$lastvisitquery = "lastvisit='$newvisit',";
					db_query("update session set lastvisit='$newvisit' where userid=$user[userid]");
				}
			}
		}
		$_POST['time_zone_dst'] = $_POST['time_zone_dst']==1 ? 1 : 0;
		$_POST['southern_hemisphere'] = $_POST['southern_hemisphere']==1 ? 1 : 0;
		db_query('update user set '.$lastvisitquery."notify_pm='$_POST[notify_pm]',pm_popup='$_POST[pm_popup]',show_avatars='$_POST[show_avatars]',img='$_POST[img]',massmail='$_POST[massmail]',quick_reply='$_POST[quick_reply]',pm='$_POST[pm]',usesignature='$_POST[usesignature]',displaysignatures='$_POST[displaysignatures]',subscribe='$_POST[subscribe]',subscribe_email='$_POST[subscribe_email]',avatar='$image',use_wysiwyg='$_POST[use_wysiwyg]',hide_email='$_POST[hide_email]',invisible='$_POST[invisible]',stylesetid='$_POST[stylesetid]',markread='$_POST[markread]',markread_time='$markread_time',time_zone='$_POST[time_zone]',time_zone_dst='$_POST[time_zone_dst]',southern_hemisphere='$_POST[southern_hemisphere]',auto_time_zone='$_POST[auto_time_zone]' where userid=$user[userid]");
		$pagetitle = 'Updating options';
		$redirect_url = 'user.php';
		eval(get_template('edit_options_redirect'));
	}
	else
	{
		$query = db_query('select * from styleset where enabled=1 order by name asc');
		while ($styleset_result = db_fetch_array($query))
		{
			if ($styleset_result['stylesetid']==$user['stylesetid'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('styleset_choice'));
			$stylesets .= $styleset_choice;
		}
		if ($user['avatar'])
			$user['parsed_avatar'] = parse_image($user['avatar']);
		$pagetitle = 'Edit options';
		eval(get_template('editoptions_index'));
	}
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>