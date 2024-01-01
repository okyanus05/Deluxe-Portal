<?php
/**************************************************
* Read Private Message
* --------------------
* Shows a private message.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_pm,pm_disabled,readpm_index,readpm_invalid';
/**************************************************
* Global variable resetting                      */
unset($articlestore);
unset($customfields);
unset($lastpost);
unset($poststore);
unset($threadstore);
/*************************************************/

require('function.php');

if (!$user['userid'])
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}
if (!$user['pm'])
{
	$pagetitle = 'Private messaging disabled';
	die(eval(get_template('pm_disabled')));
}

if ($pm = db_fetch_array(db_query("select user.lastactivity,user.signature,user.name,user.avatar,user.pm,user.joindate,user.title,user.groupid,user.website,user.posts,user.location,user.invisible,groups.online_template_large,privatemessage.*,user.userid,icon.image,icon.name as icon_name from privatemessage left join user on user.userid=privatemessage.fromuserid left join groups on user.groupid=groups.groupid left join icon on icon.iconid=privatemessage.iconid where privatemessageid='$_REQUEST[id]' and privatemessage.userid=$user[userid]")))
{
	$pm['subject'] = censor($pm['subject'], $config['censored_words']);
	$pm['message'] = censor($pm['message'], $config['censored_words']);
	
	db_query("update privatemessage set isread=1 where privatemessageid='$pm[privatemessageid]' and folder='inbox'");
	db_query("update privatemessage set isread=1 where folder='sent' and userid=$pm[fromuserid] and touserid=$user[userid] and sentdate=$pm[sentdate]");
	
	$user_result['name'] = $pm['fromusername'];
	$user_result['userid'] = $pm['fromuserid'];
	eval('$pm[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($pm['online_template_large'])).'";');
	$pm['joindate'] = time_adjust($pm['joindate'], $style['join_post_date_format']);
	$pm['sentdate'] = time_adjust($pm['sentdate'], $style['post_date_format']);
	$pm['title'] = get_title($pm);
	if ($pm['iconid'])
		$pm['image'] = parse_image($pm['image']);
	if ($pm['dpcode'] && $config['pm_dpcode'])
		$pm['message'] = dpcode_parse($pm['message'], $config['pm_img']);
	if ($pm['smilies'] && $config['pm_smilies'])
		$pm['message'] = smilie_parse($pm['message']);
	if ($pm['avatar'])
		$pm['parsed_avatar'] = parse_image($pm['avatar']);
	if ($pm['showsignature'] && $pm['signature'] && $user['displaysignatures'])
	{
		$pm['signature'] = disable_images($pm['signature']);
		$showsig = true;
	}
	else
		$showsig = false;
	
	$isonline = is_online($pm);
	$showemail = show_email($pm);
	$showpm = show_pm($pm);
	$showsearch = show_search($pm);
	$pm['posts'] = number_format($pm['posts'], 0, '.', $style['separator']);
	
	$pagetitle = $pm['subject'];
	if ($pm['folder']=='inbox')
		$pm['parsed_folder'] = 'Inbox';
	if ($pm['folder']=='sent')
		$pm['parsed_folder'] = 'Sent Messages';
	if ($pm['folder']=='archive')
		$pm['parsed_folder'] = 'Archive';
	eval(get_template('readpm_index'));
}
else
{
	$pagetitle = 'Invalid private message';
	eval(get_template('invalid_pm'));
}
?>