<?php
/**************************************************
* Announcements
* -------------
* Displays announcements for a given forum.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'announcement_announcement,announcement_index,invalid_forum';
/**************************************************
* Global variable resetting                      */
unset($announcements);
/*************************************************/

require('function.php');

$announcementquery = 'forumid=0';
if ($forumarray = get_forum_parents($_REQUEST['id']))
{
	$forumarray = array_reverse($forumarray);
	while (list($forumextra, $forumnav) = each($forumarray))
		$announcementquery .= " or forumid=$forumnav[forumid]";
}

if (!$forum = get_forum_nav($_REQUEST['id']))
{
	$pagetitle = 'Invalid forum';
	die(eval(get_template('invalid_forum')));
}

$perm = get_forum_permissions($forum);
if (!$perm['viewforums'])
{
	$pagetitle = 'Access denied';
	die(eval(get_template('permission_error')));
}

$pagetitle = "$forum[name] - Announcements";
$color = 'cellalt';

get_dpcode_store();
get_forum_jump($forum['forumid']);
get_smilie_store();

$query = db_query("select announcement.*,user.lastactivity,user.joindate,user.title,user.groupid,user.posts,user.location,user.pm,user.website,user.avatar,user.invisible,groups.online_template_large from announcement,user,groups where user.groupid=groups.groupid and announcement.start<=$current_time and announcement.end>=$current_time and user.userid=announcement.userid and ($announcementquery) order by start desc,announcementid desc");
while ($announcement = db_fetch_array($query))
{
	$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
	$user_result['name'] = $announcement['username'];
	$user_result['userid'] = $announcement['userid'];
	eval('$announcement[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($announcement['online_template_large'])).'";');
	$announcement['joindate'] = time_adjust($announcement['joindate'], $style['join_post_date_format']);
	$announcement['start'] = time_adjust($announcement['start'], $style['announcement_date_format']);
	$announcement['end'] = time_adjust($announcement['end'], $style['announcement_date_format']);
	$isonline = is_online($announcement);
	$announcement['title'] = get_title($announcement);
	if ($announcement['avatar'])
		$announcement['parsed_avatar'] = parse_image($announcement['avatar']);
	if ($announcement['dpcode'])
		$announcement['body'] = dpcode_parse($announcement['body'], true);
	if ($announcement['smilies'])
		$announcement['body'] = smilie_parse($announcement['body']);
	$showemail = show_email($announcement);
	$showpm = show_pm($announcement);
	$showsearch = show_search($announcement);
	$announcement['posts'] = number_format($announcement['posts'], 0, '.', $style['separator']);
	eval(store_template('announcement_announcement', '$announcement_result'));
	$announcements .= $announcement_result;
}
eval(get_template('announcement_index'));
?>