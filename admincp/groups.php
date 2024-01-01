<?php
/**************************************************
* Admin CP - Groups
* -----------------
* Allows you to add, edit, or remove user groups.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_group,delete_group,delete_group_denied,edit_group,groups_duplicate,groups_group,groups_index,groups_missing,invalid_group';
/**************************************************
* Global variable resetting                      */
unset($groups);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$admin_groups = $_POST['admin_groups'];
$adminlog = $_POST['adminlog'];
$articles = $_POST['articles'];
$close = $_POST['close'];
$configuration = $_POST['configuration'];
$copymove = $_POST['copymove'];
$customavatar = $_POST['customavatar'];
$customfields = $_POST['customfields'];
$customsignature = $_POST['customsignature'];
$customtitle = $_POST['customtitle'];
$deleteposts = $_POST['deleteposts'];
$deletethreads = $_POST['deletethreads'];
$downloads = $_POST['downloads'];
$dpcode = $_POST['dpcode'];
$edit_profile = $_POST['edit_profile'];
$editposts = $_POST['editposts'];
$editthreads = $_POST['editthreads'];
$editthreads = $_POST['editthreads'];
$exempt_titlecensor = $_POST['exempt_titlecensor'];
$faq = $_POST['faq'];
$forumperm = $_POST['forumperm'];
$forums = $_POST['forums'];
$groupchanger = $_POST['groupchanger'];
$html = $_POST['html'];
$icons = $_POST['icons'];
$id = $_REQUEST['id'];
$ignorelist = $_POST['ignorelist'];
$links = $_POST['links'];
$lockpostcount = $_POST['lockpostcount'];
$maintenance = $_POST['maintenance'];
$moderators = $_POST['moderators'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$postattachments = $_POST['postattachments'];
$postthreads = $_POST['postthreads'];
$privatemessaging = $_POST['privatemessaging'];
$replytoother = $_POST['replytoother'];
$replytoown = $_POST['replytoown'];
$search = $_POST['search'];
$sections = $_POST['sections'];
$show_editedby = $_POST['show_editedby'];
$smilies = $_POST['smilies'];
$startpolls = $_POST['startpolls'];
$styles = $_POST['styles'];
$stylesets = $_POST['stylesets'];
$supermod_announcements = $_POST['supermod_announcements'];
$supermod_banusers = $_POST['supermod_banusers'];
$supermod_close = $_POST['supermod_close'];
$supermod_copymove = $_POST['supermod_copymove'];
$supermod_deleteposts = $_POST['supermod_deleteposts'];
$supermod_deletethreads = $_POST['supermod_deletethreads'];
$supermod_editpolls = $_POST['supermod_editpolls'];
$supermod_editposts = $_POST['supermod_editposts'];
$supermod_editthreads = $_POST['supermod_editthreads'];
$supermod_exemptfloodcheck = $_POST['supermod_exemptfloodcheck'];
$supermod_log = $_POST['supermod_log'];
$supermod_massdelete = $_POST['supermod_massdelete'];
$supermod_massmove = $_POST['supermod_massmove'];
$supermod_sticky = $_POST['supermod_sticky'];
$supermod_viewfullprofiles = $_POST['supermod_viewfullprofiles'];
$supermod_viewips = $_POST['supermod_viewips'];
$tasks = $_POST['tasks'];
$templates = $_POST['templates'];
$titles = $_POST['titles'];
$topics = $_POST['topics'];
$users = $_POST['users'];
$variables = $_POST['variables'];
$view_profile = $_POST['view_profile'];
$view_memberlist = $_POST['view_memberlist'];
$viewattachments = $_POST['viewattachments'];
$viewforums = $_POST['viewforums'];
$viewthreads = $_POST['viewthreads'];
$votepolls = $_POST['votepolls'];
$whos_online = $_POST['whos_online'];
/*************************************************/

$pagetitle = 'Groups';

if ($group['groups'])
{
	$query = db_query("select groups.groupid,count(*) as counted from groups,user where FIND_IN_SET(groups.groupid, usergroups) group by groups.groupid");
	while ($usercount = db_fetch_array($query))
		$userstore[$usercount['groupid']] = $usercount['counted'];
	$query = db_query('select * from groups order by name asc');
	while ($group_result = db_fetch_array($query))
	{
		$number = isset($userstore[$group_result['groupid']]) ? $userstore[$group_result['groupid']] : 0;
		eval(store_template('groups_group'));
		$groups .= $groups_group;
	}
	if ($_POST['op']=='doadd')
	{
		if ($name)
		{
			$name = htmlspecialchars($name);
			if (db_fetch_array(db_query("select name from groups where name='$name'")))
				eval(get_template('groups_duplicate'));
			else
			{
				$admin_groups = ($admin_groups ? 1 : 0);
				$adminlog = ($adminlog ? 1 : 0);
				$articles = ($articles ? 1 : 0);
				$close = ($close ? 1 : 0);
				$configuration = ($configuration ? 1 : 0);
				$copymove = ($copymove ? 1 : 0);
				$customavatar = ($customavatar ? 1 : 0);
				$customfields = ($customfields ? 1 : 0);
				$customsignature = ($customsignature ? 1 : 0);
				$customtitle = ($customtitle ? 1 : 0);
				$deleteposts = ($deleteposts ? 1 : 0);
				$deletethreads = ($deletethreads ? 1 : 0);
				$downloads = ($downloads ? 1 : 0);
				$dpcode = ($dpcode ? 1 : 0);
				$edit_profile = ($edit_profile ? 1 : 0);
				$editposts = ($editposts ? 1 : 0);
				$editthreads = ($editthreads ? 1 : 0);
				$editthreads = ($editthreads ? 1 : 0);
				$exempt_titlecensor = ($exempt_titlecensor ? 1 : 0);
				$faq = ($faq ? 1 : 0);
				$forumperm = ($forumperm ? 1 : 0);
				$forums = ($forums ? 1 : 0);
				$groupchanger = ($groupchanger ? 1 : 0);
				$html = ($html ? 1 : 0);
				$icons = ($icons ? 1 : 0);
				$ignorelist = ($ignorelist ? 1 : 0);
				$links = ($links ? 1 : 0);
				$maintenance = ($maintenance ? 1 : 0);
				$moderators = ($moderators ? 1 : 0);
				$postattachments = ($postattachments ? 1 : 0);
				$postthreads = ($postthreads ? 1 : 0);
				$privatemessaging = ($privatemessaging ? 1 : 0);
				$replytoother = ($replytoother ? 1 : 0);
				$replytoown = ($replytoown ? 1 : 0);
				$search = ($search ? 1 : 0);
				$sections = ($sections ? 1 : 0);
				$show_editedby = ($show_editedby ? 1 : 0);
				$smilies = ($smilies ? 1 : 0);
				$startpolls = ($startpolls ? 1 : 0);
				$styles = ($styles ? 1 : 0);
				$stylesets = ($stylesets ? 1 : 0);
				$supermod_announcements = ($supermod_announcements ? 1 : 0);
				$supermod_banusers = ($supermod_banusers ? 1 : 0);
				$supermod_close = ($supermod_close ? 1 : 0);
				$supermod_copymove = ($supermod_copymove ? 1 : 0);
				$supermod_deleteposts = ($supermod_deleteposts ? 1 : 0);
				$supermod_deletethreads = ($supermod_deletethreads ? 1 : 0);
				$supermod_editpolls = ($supermod_editpolls ? 1 : 0);
				$supermod_editposts = ($supermod_editposts ? 1 : 0);
				$supermod_editthreads = ($supermod_editthreads ? 1 : 0);
				$supermod_exemptfloodcheck = ($supermod_exemptfloodcheck ? 1 : 0);
				$supermod_log = ($supermod_log ? 1 : 0);
				$supermod_massdelete = ($supermod_massdelete ? 1 : 0);
				$supermod_massmove = ($supermod_massmove ? 1 : 0);
				$supermod_sticky = ($supermod_sticky ? 1 : 0);
				$supermod_viewfullprofiles = ($supermod_viewfullprofiles ? 1 : 0);
				$supermod_viewips = ($supermod_viewips ? 1 : 0);
				$templates = ($templates ? 1 : 0);
				$tasks = ($tasks ? 1 : 0);
				$titles = ($titles ? 1 : 0);
				$topics = ($topics ? 1 : 0);
				$users = ($users ? 1 : 0);
				$variables = ($variables ? 1 : 0);
				$view_profile = ($view_profile ? 1 : 0);
				$view_memberlist = ($view_memberlist ? 1 : 0);
				$viewattachments = ($viewattachments ? 1 : 0);
				$viewforums = ($viewforums ? 1 : 0);
				$viewthreads = ($viewthreads ? 1 : 0);
				$votepolls = ($votepolls ? 1 : 0);
				$whos_online = ($whos_online ? 1 : 0);
				db_query("insert into groups (name, html, maxpm, online_template, online_template_large, max_recipients, ordered, adminlog, articles, close, configuration, copymove, customavatar, customfields, customsignature, customtitle, deleteposts, deletethreads, downloads, dpcode, edit_profile, editposts, editthreads, exempt_titlecensor, forumperm, forums, groupchanger, groups, icons, ignorelist, links, lockpostcount, maintenance, moderators, postattachments, postthreads, privatemessaging, replytoother, replytoown, search, sections, show_editedby, smilies, startpolls, styles, stylesets, supermod_announcements, supermod_banusers, supermod_close, supermod_copymove, supermod_deleteposts, supermod_deletethreads, supermod_editpolls, supermod_editposts, supermod_editthreads, supermod_exemptfloodcheck, supermod_massdelete, supermod_log, supermod_massmove, supermod_sticky, supermod_viewfullprofiles, supermod_viewips, templates, titles, topics, users, view_memberlist, view_profile, viewattachments, viewforums, viewthreads, votepolls, whos_online, faq, tasks) values ('$name', $html, '$_POST[maxpm]', '$_POST[online_template]', '$_POST[online_template_large]', '$_POST[max_recipients]', '$_POST[ordered]', '$adminlog', $articles, '$close', '$configuration', '$copymove', '$customavatar', '$customfields', '$customsignature', '$customtitle', '$deleteposts', '$deletethreads', '$downloads', '$dpcode', '$edit_profile', '$editposts', '$editthreads', $exempt_titlecensor, '$forumperm', '$forums', '$groupchanger', '$admin_groups', '$icons', '$ignorelist', '$links', '$lockpostcount', '$maintenance', '$moderators', $postattachments, '$postthreads', '$privatemessaging', '$replytoother', '$replytoown', '$search', '$sections', '$show_editedby', '$smilies', '$startpolls', '$styles', '$stylesets', '$supermod_announcements', '$supermod_banusers', '$supermod_close', '$supermod_copymove', '$supermod_deleteposts', '$supermod_deletethreads', '$supermod_editpolls', '$supermod_editposts', '$supermod_editthreads', '$supermod_exemptfloodcheck', '$supermod_massdelete', $supermod_log, '$supermod_massmove', '$supermod_sticky', '$supermod_viewfullprofiles', '$supermod_viewips', '$templates', '$titles', '$topics', '$users', '$view_memberlist', '$view_profile', $viewattachments, '$viewforums', '$viewthreads', '$votepolls', '$whos_online', '$faq', '$tasks')");
				$group_result = db_fetch_array(db_query('select * from groups order by groupid desc limit 1'));
				adminlog("Added group - <b>$name ($group_result[groupid])</b>");
				$query = db_query('select * from forum');
				while ($forum = db_fetch_array($query))
					db_query("insert into forumpermission (forumid, groupid, type, close, copymove, deleteposts, deletethreads, editposts, editthreads, postattachments, postthreads, replytoother, replytoown, startpolls, viewattachments, viewforums, viewthreads, votepolls) values ($forum[forumid], $group_result[groupid], 'group', $group_result[close], $group_result[copymove], $group_result[deleteposts], $group_result[deletethreads], $group_result[editposts], $group_result[editthreads], $group_result[postattachments], $group_result[postthreads], $group_result[replytoother], $group_result[replytoown], $group_result[startpolls], $group_result[viewattachments], $group_result[viewforums], $group_result[viewthreads], $group_result[votepolls])");
				if ($articles)
					$canpost = 1;
				else
					$canpost = 0;
				if ($articles && $topics)
					$cantopic = 1;
				else
					$cantopic = 0;
				if ($articles && $sections)
					$cansection = 1;
				else
					$cansection = 0;
				$query = db_query('select topicid from topic');
				while ($topic = db_fetch_array($query))
					db_query("insert into topicpermissions (topicid, groupid, view, post, editown, editothers, deleteown, deleteothers) values ($topic[topicid], $group_result[groupid], 1, $canpost, $canpost, $cantopic, $canpost, $cantopic)");
				$query = db_query('select sectionid from section');
				while ($section = db_fetch_array($query))
					db_query("insert into sectionpermissions (sectionid, groupid, view, post, editown, editothers, deleteown, deleteothers) values ($section[sectionid], $group_result[groupid], 1, $canpost, $canpost, $cansection, $canpost, $cansection)");
				$query = db_query('select downloadcategoryid from downloadcategory');
				while ($category = db_fetch_array($query))
					db_query("insert into downloadpermissions (downloadcategoryid, groupid) values ($category[downloadcategoryid], $group_result[groupid])");
				$query = db_query('select linkcategoryid from linkcategory');
				while ($category = db_fetch_array($query))
					db_query("insert into linkpermissions (linkcategoryid, groupid) values ($category[linkcategoryid], $group_result[groupid])");
				$query = db_query('select groupruleid from grouprule');
				while ($rule = db_fetch_array($query))
					db_query("insert into changergroups (groupruleid, groupid, ingroup, addgroup, removegroup) values ($rule[groupruleid], $group_result[groupid], 0, 0, 0)");
				header('Location: groups.php');
			}
		}
		else
			eval(get_template('groups_missing'));
	}
	elseif ($op=='edit')
	{
		if ($group_result = db_fetch_array(db_query("select * from groups where groupid='$id'")))
		{
			adminlog("Edited group - <b>$group_result[name] ($group_result[groupid])</b>");
			$group_result['online_template_large'] = htmlspecialchars($group_result['online_template_large']);
			$group_result['online_template'] = htmlspecialchars($group_result['online_template']);
			eval(get_template('edit_group'));
		}
		else
			eval(get_template('invalid_group'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($name && $group_result = db_fetch_array(db_query("select * from groups where groupid='$id'")))
		{
			$name = htmlspecialchars($name);
			if ($duplicate = db_fetch_array(db_query("select groupid from groups where name='$name' and groupid!='$group_result[groupid]'")))
				eval(get_template('groups_duplicate'));
			else
			{
				adminlog("Updated group - <b>$name ($group_result[groupid])</b>");
				$admin_groups = ($admin_groups ? 1 : 0);
				$adminlog = ($adminlog ? 1 : 0);
				$articles = ($articles ? 1 : 0);
				$close = ($close ? 1 : 0);
				$configuration = ($configuration ? 1 : 0);
				$copymove = ($copymove ? 1 : 0);
				$customavatar = ($customavatar ? 1 : 0);
				$customfields = ($customfields ? 1 : 0);
				$customsignature = ($customsignature ? 1 : 0);
				$customtitle = ($customtitle ? 1 : 0);
				$deleteposts = ($deleteposts ? 1 : 0);
				$deletethreads = ($deletethreads ? 1 : 0);
				$downloads = ($downloads ? 1 : 0);
				$dpcode = ($dpcode ? 1 : 0);
				$edit_profile = ($edit_profile ? 1 : 0);
				$editposts = ($editposts ? 1 : 0);
				$editthreads = ($editthreads ? 1 : 0);
				$editthreads = ($editthreads ? 1 : 0);
				$exempt_titlecensor = ($exempt_titlecensor ? 1 : 0);
				$faq = ($faq ? 1 : 0);
				$forumperm = ($forumperm ? 1 : 0);
				$forums = ($forums ? 1 : 0);
				$groupchanger = ($groupchanger ? 1 : 0);
				$html = ($html ? 1 : 0);
				$icons = ($icons ? 1 : 0);
				$ignorelist = ($ignorelist ? 1 : 0);
				$links = ($links ? 1 : 0);
				$maintenance = ($maintenance ? 1 : 0);
				$moderators = ($moderators ? 1 : 0);
				$postattachments = ($postattachments ? 1 : 0);
				$postthreads = ($postthreads ? 1 : 0);
				$privatemessaging = ($privatemessaging ? 1 : 0);
				$replytoother = ($replytoother ? 1 : 0);
				$replytoown = ($replytoown ? 1 : 0);
				$search = ($search ? 1 : 0);
				$sections = ($sections ? 1 : 0);
				$show_editedby = ($show_editedby ? 1 : 0);
				$smilies = ($smilies ? 1 : 0);
				$startpolls = ($startpolls ? 1 : 0);
				$styles = ($styles ? 1 : 0);
				$stylesets = ($stylesets ? 1 : 0);
				$supermod_announcements = ($supermod_announcements ? 1 : 0);
				$supermod_banusers = ($supermod_banusers ? 1 : 0);
				$supermod_close = ($supermod_close ? 1 : 0);
				$supermod_copymove = ($supermod_copymove ? 1 : 0);
				$supermod_deleteposts = ($supermod_deleteposts ? 1 : 0);
				$supermod_deletethreads = ($supermod_deletethreads ? 1 : 0);
				$supermod_editpolls = ($supermod_editpolls ? 1 : 0);
				$supermod_editposts = ($supermod_editposts ? 1 : 0);
				$supermod_editthreads = ($supermod_editthreads ? 1 : 0);
				$supermod_exemptfloodcheck = ($supermod_exemptfloodcheck ? 1 : 0);
				$supermod_log = ($supermod_log ? 1 : 0);
				$supermod_massdelete = ($supermod_massdelete ? 1 : 0);
				$supermod_massmove = ($supermod_massmove ? 1 : 0);
				$supermod_sticky = ($supermod_sticky ? 1 : 0);
				$supermod_viewfullprofiles = ($supermod_viewfullprofiles ? 1 : 0);
				$supermod_viewips = ($supermod_viewips ? 1 : 0);
				$tasks = ($tasks ? 1 : 0);
				$templates = ($templates ? 1 : 0);
				$titles = ($titles ? 1 : 0);
				$topics = ($topics ? 1 : 0);
				$users = ($users ? 1 : 0);
				$variables = ($variables ? 1 : 0);
				$view_profile = ($view_profile ? 1 : 0);
				$view_memberlist = ($view_memberlist ? 1 : 0);
				$viewattachments = ($viewattachments ? 1 : 0);
				$viewforums = ($viewforums ? 1 : 0);
				$viewthreads = ($viewthreads ? 1 : 0);
				$votepolls = ($votepolls ? 1 : 0);
				$whos_online = ($whos_online ? 1 : 0);
				db_query("update groups set name='$name',tasks='$tasks',maxpm='$_POST[maxpm]',html=$html,online_template='$_POST[online_template]',online_template_large='$_POST[online_template_large]',max_recipients='$_POST[max_recipients]',ordered='$_POST[ordered]',adminlog='$adminlog',articles=$articles,close='$close',configuration='$configuration',copymove='$copymove',customavatar='$customavatar',customfields='$customfields',customsignature='$customsignature',customtitle='$customtitle',downloads='$downloads',dpcode='$dpcode',deleteposts='$deleteposts',deletethreads='$deletethreads',edit_profile='$edit_profile',editposts='$editposts',editthreads='$editthreads',exempt_titlecensor=$exempt_titlecensor,forumperm='$forumperm',forums='$forums',groupchanger='$groupchanger',groups='$admin_groups',icons='$icons',ignorelist='$ignorelist',links='$links',lockpostcount='$lockpostcount',maintenance='$maintenance',moderators='$moderators',postattachments=$postattachments,postthreads='$postthreads',privatemessaging='$privatemessaging',replytoother='$replytoother',replytoown='$replytoown',search='$search',sections='$sections',show_editedby='$show_editedby',smilies='$smilies',startpolls='$startpolls',styles='$styles',stylesets='$stylesets',supermod_announcements='$supermod_announcements',supermod_banusers='$supermod_banusers',supermod_close=$supermod_close,supermod_copymove=$supermod_copymove,supermod_deleteposts=$supermod_deleteposts,supermod_deletethreads='$supermod_deletethreads',supermod_editpolls='$supermod_editpolls',supermod_editposts=$supermod_editposts,supermod_editthreads=$supermod_editthreads,supermod_exemptfloodcheck=$supermod_exemptfloodcheck,supermod_log='$supermod_log',supermod_massdelete=$supermod_massdelete,supermod_massmove=$supermod_massmove,supermod_sticky='$supermod_sticky',supermod_viewfullprofiles=$supermod_viewfullprofiles,supermod_viewips=$supermod_viewips,templates=$templates,titles='$titles',topics='$topics',users='$users',view_memberlist='$view_memberlist',view_profile='$view_profile',viewattachments=$viewattachments,viewforums='$viewforums',viewthreads='$viewthreads',votepolls='$votepolls',whos_online='$whos_online',faq='$faq' where groupid=$group_result[groupid]");
				header('Location: groups.php');
			}
		}
		else
			eval(get_template('groups_missing'));
	}
	elseif ($op=='delete')
	{
		if (!$group_result = db_fetch_array(db_query("select * from groups where groupid='$id'")))
			die(eval(get_template('invalid_group')));
		if (db_num_rows(db_query("select userid from user where FIND_IN_SET('$group_result[groupid]', usergroups)")) || db_num_rows(db_query("select * from defaultgroups where groupid='$group_result[groupid]' and (user=0 or user=1)")))
			eval(get_template('delete_group_denied'));
		else
			eval(get_template('delete_group'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if (!$group_result = db_fetch_array(db_query("select * from groups where groupid='$id'")))
			die(eval(get_template('invalid_group')));
		if (db_num_rows(db_query("select userid from user where FIND_IN_SET('$group_result[groupid]', usergroups)")) || db_num_rows(db_query("select * from defaultgroups where groupid='$group_result[groupid]' and (user=0 or user=1)")))
			eval(get_template('delete_group_denied'));
		else
		{
			adminlog("Deleted group - <b>$group_result[name] ($group_result[groupid])</b>");
			db_query("delete from groups where groupid='$group_result[groupid]'");
			db_query("delete from changergroups where groupid='$group_result[groupid]'");
			db_query("delete from forumpermission where groupid='$group_result[groupid]'");
			db_query("delete from topicpermissions where groupid='$group_result[groupid]'");
			db_query("delete from sectionpermissions where groupid='$group_result[groupid]'");
			db_query("delete from downloadpermissions where groupid='$group_result[groupid]'");
			db_query("delete from linkpermissions where groupid='$group_result[groupid]'");
			header('Location: groups.php');
		}
	}
	elseif ($_REQUEST['op']=='add')
		eval(get_template('add_group'));
	else
	{
		adminlog('Viewed groups control panel');
		eval(get_template('groups_index'));
	}
}
else
	eval(get_template('permission_error'));
?>