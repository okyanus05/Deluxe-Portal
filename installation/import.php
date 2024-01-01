<?php
require('functions.php');
print_header("Deluxe Portal 1.1.x -> Deluxe Portal 2.0 Importer");

function import_redirect($op)
{
	global $dphost,$dpuser,$dppass,$dpname,$dptype,$start,$import_icons,$import_smilies;
	redirect("import.php?op=$op&dphost=$dphost&dpname=$dpname&dpuser=$dpuser&dppass=$dppass&dptype=$dptype&start=$start&import_icons=$import_icons&import_smilies=$import_smilies");
}

function dbvar_1x()
{
	global $dphost,$dpuser,$dppass,$dpname,$dptype,$dbhost,$dbuser,$dbpass,$dbname,$dbtype,$i;
	$dbname = $dpname;
	$dbuser = $dpuser;
	$dbpass = $dppass;
	$dbhost = $dphost;
	$dbtype = $dptype;
	db_connect();
	db_select_db();
	$i = 0;
}

function dbvar_2x()
{
	global $dbhost,$dbuser,$dbpass,$dbname,$dbtype;
	require('../config.php');
	db_connect();
	db_select_db();
}

if ($op==1)
{
	dbvar_1x();
	db_query_noerror('alter table config rename dp1x_config');
	db_query_noerror('alter table groups rename dp1x_groups');
	dbvar_2x();
	echo 'Step 1: Preparing Deluxe Portal 2.0.0 Database<br />';
	echo '<br />';
	db_query('delete from announcement');
	db_query('delete from article');
	db_query('delete from changergroups');
	db_query('delete from download');
	db_query('delete from downloadcategory');
	db_query('delete from downloadpermissions');
	db_query('delete from emailverify');
	db_query('delete from grouprule');
	db_query('delete from link');
	db_query('delete from linkcategory');
	db_query('delete from linkpermissions');
	db_query('delete from passwordreminder');
	db_query('delete from post');
	db_query('delete from section');
	db_query('delete from sectionpermissions');
	db_query('delete from subscribedemail');
	db_query('delete from subscribedthread');
	db_query('delete from subscribedforum');
	db_query('delete from thread');
	echo 'Emptying <b>defaultgroups</b>... ';
	db_query('delete from defaultgroups');
	echo 'done<br />';
	echo 'Emptying <b>emailgroups</b>... ';
	db_query('delete from emailgroups');
	echo 'done<br />';
	echo 'Emptying <b>forum</b>... ';
	db_query('delete from forum');
	echo 'done<br />';
	echo 'Emptying <b>forumpermission</b>... ';
	db_query('delete from forumpermission');
	echo 'done<br />';
	echo 'Emptying <b>groups</b>... ';
	db_query('delete from groups');
	echo 'done<br />';
	if ($import_icons)
	{
	echo 'Emptying <b>icon</b>... ';
	db_query('delete from icon');
	echo 'done<br />';
	}
	echo 'Emptying <b>markread</b>... ';
	db_query('delete from markread');
	echo 'done<br />';
	echo 'Emptying <b>moderator</b>... ';
	db_query('delete from moderator');
	echo 'done<br />';
	echo 'Emptying <b>poll</b>... ';
	db_query('delete from poll');
	echo 'done<br />';
	echo 'Emptying <b>privatemessage</b>... ';
	db_query('delete from privatemessage');
	echo 'done<br />';
	echo 'Emptying <b>session</b>... ';
	db_query('delete from session');
	echo 'done<br />';
	if ($import_smilies)
	{
	echo 'Emptying <b>smilie</b>... ';
	db_query('delete from smilie');
	echo 'done<br />';
	}
	echo 'Emptying <b>title</b>... ';
	db_query('delete from title');
	echo 'done<br />';
	echo 'Emptying <b>topic</b>... ';
	db_query('delete from topic');
	echo 'done<br />';
	echo 'Emptying <b>topicpermissions</b>... ';
	db_query('delete from topicpermissions');
	echo 'done<br />';
	echo 'Emptying <b>user</b>... ';
	db_query('delete from user');
	echo 'done<br />';
	echo 'Emptying <b>usercustomfield</b>... ';
	db_query('delete from usercustomfield');
	echo 'done<br />';
	echo 'Emptying <b>whovoted</b>... ';
	db_query('delete from whovoted');
	echo 'done<br />';
	import_redirect(2);
}
elseif ($op==2)
{
	echo 'Step 2: Importing Announcements<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from announcements order by announcementid asc');
	while ($ann = db_fetch_array($query))
		$annstore[$i++] = $ann;
	dbvar_2x();
	$i = 0;
	while ($ann = $annstore[$i++])
	{
		echo "Importing announcement $ann[announcementid]... ";
		$name = addslashes($ann[subject]);
		$body = addslashes($ann[message]);
		$dpcode = ($ann[bb_code]=='yes' ? 1 : 0);
		$smilies = ($ann[smilies]=='yes' ? 1 : 0);
		$body = str_replace('<br>', '<br />', $body);
		db_query("insert into announcement (announcementid, name, forumid, body, start, end, dpcode, smilies, userid, username, url) values ($ann[announcementid], '$name', $ann[forumid], '$body', UNIX_TIMESTAMP('$ann[start]'), UNIX_TIMESTAMP('$ann[end]'), $dpcode, $smilies, $ann[userid], '', 1)");
		echo 'done<br />';
	}
	import_redirect(3);
}
elseif ($op==3)
{
	echo 'Step 3: Importing Download Categories<br />';
	echo '<br />';
	dbvar_1x();
	$i = 0;
	$query = db_query('select * from category order by categoryid asc');
	while ($category = db_fetch_array($query))
		$categorystore[$i++] = $category;
	$i = 0;
	$query = db_query('select groupid from dp1x_groups order by groupid asc');
	while ($group = db_fetch_array($query))
		$groupstore[$i++] = $group;
	dbvar_2x();
	$i = 0;
	while ($category = $categorystore[$i++])
	{
		echo "Importing download category $category[categoryid]... ";
		$name = addslashes($category[name]);
		$image = addslashes($category[image]);
		db_query("insert into downloadcategory (downloadcategoryid, name, image) values ($category[categoryid], '$name', '$image')");
		$n = 0;
		while ($group = $groupstore[$n++])
			db_query("insert into downloadpermissions (downloadcategoryid, groupid) values ($category[categoryid], $group[groupid])");
		echo 'done<br />';
	}
	import_redirect(4);
}
elseif ($op==4)
{
	echo 'Step 4: Setting Configuration<br />';
	echo '<br />';
	dbvar_1x();
	$config = db_fetch_array(db_query('select * from dp1x_config'));
	$online = db_fetch_array(db_query('select * from most_online'));
	$groups = db_fetch_array(db_query('select * from default_groups'));
	$guest = db_fetch_array(db_query("select * from dp1x_groups where groupid=$groups[unregistered]"));
	$announcement = db_fetch_array(db_query('select * from site_announcements'));
	$name = addslashes($config[name]);
	$url = addslashes(substr($config[url], 0, -1));
	$guest_name = addslashes($guest[name]);
	$allow_registration = ($config[allow_reg]=='yes' ? 1 : 0);
	$post_order = ($config[post_order]=='oldest' ? 'asc' : 'desc');
	$contact = addslashes($config[contact]);
	$whos_online = ($config[display_logged]=='yes' ? 1 : 0);
	$show_email = ($config[disp_email]=='yes' ? 'address' : 'disable');
	$hideforums = ($config[hide_private]=='yes' ? 1 : 0);
	$avatar_size = round($config[avatar_size]/1024, 0);
	$subscribe_email = ($config[notify_email]=='yes' ? 1 : 0);
	$signature_dpcode = ($config[code_sig]=='yes' ? 1 : 0);
	$signature_smilies = ($config[smile_sig]=='yes' ? 1 : 0);
	$password_reminder = ($config[pass_reminder]=='yes' ? 1 : 0);
	$unique_email = ($config[unique_email]=='yes' ? 1 : 0);
	$illegal_usernames = addslashes($config[illegal_name]);
	$disable_shouting = ($config[no_title_shouting]=='yes' ? 1 : 0);
	$censored_words = addslashes($config[censor_words]);
	$banned_email = addslashes($config[banned_email]);
	$banned_ip = addslashes($config[banned_ip]);
	$pm_dpcode = ($config[pm_code]=='yes' ? 1 : 0);
	$pm_img = ($config[pm_img]=='yes' ? 1 : 0);
	$pm_smilies = ($config[pm_smile]=='yes' ? 1 : 0);
	$signature_img = ($config[img_sig]=='yes' ? 1 : 0);
	$censored_title = addslashes($config[title_censor]);
	$doticons = ($config[dot_icons]=='yes' ? 1 : 0);
	$site_announcement = addslashes(str_replace("<br>", "<br />", ($announcement['title'].'<br /><br />'.$announcement['message'])));
	if ($site_announcement=='<br /><br />')
		$site_announcement = '';
	dbvar_2x();
	db_query("update config set show_moderators=1,max_usertitlelen='$config[max_title_len]',site_announcement='$site_announcement',number_smilies=$config[smilie_total],smilies_row=$config[smilie_row],doticons=$doticons,ban_groupid=$groups[banned],email_groupid=$groups[email],name='$name',url='$url',guest_name='$guest_name',guest_groupid=$groups[unregistered],allow_registration=$allow_registration,threads_per_page=$config[threads_per_page],post_order='$post_order',posts_per_page=$config[posts_per_page],default_register_group=$groups[registered],numlinks_pagenav=$config[num_pages_nav],min_posts_hot=$config[posts_hot],min_views_hot=$config[view_hot],members_per_page=$config[mem_per_page],contact='$contact',edit_post_time=$config[edit_time],edit_thread_time=$config[title_edit_time],edited_by_time=$config[time_without_edited],whos_online=$whos_online,most_online=$online[number],most_online_date=UNIX_TIMESTAMP('$online[record]'),show_email='$show_email',hideforums=$hideforums,avatar_size=$avatar_size,avatar_width=$config[avatar_x],avatar_height=$config[avatar_y],subscribe_email=$subscribe_email,signature_dpcode=$signature_dpcode,signature_smilies=$signature_smilies,max_poll_options=$config[max_poll],search_per_page=$config[search_posts_per_page],password_reminder=$password_reminder,unique_email=$unique_email,illegal_usernames='$illegal_usernames',min_username_length=$config[min_name_len],max_username_length=$config[max_name_len],disable_shouting=$disable_shouting,min_search_length=$config[min_search_length],censored_words='$censored_words',floodcheck_time=$config[flood_time],banned_email='$banned_email',banned_ip='$banned_ip',pm_dpcode=$pm_dpcode,pm_img=$pm_img,pm_smilies=$pm_smilies,signature_img=$signature_img,pm_max_length=$config[pm_char],censored_title='$censored_title'");
	db_query("insert into defaultgroups (groupid, user) values ($groups[unregistered], 0)");
	db_query("insert into defaultgroups (groupid, user) values ($groups[registered], 1)");
	import_redirect(5);
}
elseif ($op==5)
{
	echo 'Step 5: Importing Downloads<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from downloads order by downloadid asc');
	while ($download = db_fetch_array($query))
		$downloadstore[$i++] = $download;
	dbvar_2x();
	$i = 0;
	while ($download = $downloadstore[$i++])
	{
		echo "Importing download $download[downloadid]... ";
		$name = addslashes($download[name]);
		$description = addslashes($download[description]);
		$version = addslashes($download[version]);
		$author = addslashes($download[author]);
		$location = addslashes($download[file]);
		$email = addslashes($download[email]);
		db_query("insert into download (downloadid, downloadcategoryid, name, description, version, author, location, email) values ($download[downloadid], $download[categoryid], '$name', '$description', '$version', '$author', '$location', '$email')");
		echo 'done<br />';
	}
	import_redirect(6);
}
elseif ($op==6)
{
	echo 'Step 6: Importing Forum Permissions<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from forum_perms order by forumid asc,groupid asc');
	while ($perm = db_fetch_array($query))
		$permstore[$i++] = $perm;
	dbvar_2x();
	$i = 0;
	while ($perm = $permstore[$i++])
	{
		echo "Importing forum permission - forum $perm[forumid], group $perm[groupid]... ";
		$close = ($perm[close]=='yes' ? 1 : 0);
		$copymove = ($perm[move]=='yes' ? 1 : 0);
		$deleteposts = ($perm[del]=='yes' ? 1 : 0);
		$deletethreads = ($perm[delete_thread]=='yes' ? 1 : 0);
		$editposts = ($perm[edit]=='yes' ? 1 : 0);
		$postthreads = ($perm[post_thread]=='yes' ? 1 : 0);
		$replytoother = ($perm[reply_to_other]=='yes' ? 1 : 0);
		$replytoown = ($perm[reply_to_own]=='yes' ? 1 : 0);
		$viewforums = ($perm[view_forum]=='yes' ? 1 : 0);
		$viewthreads = ($perm[view_thread]=='yes' ? 1 : 0);
		$startpolls = ($perm[post_poll]=='yes' ? 1 : 0);
		$votepolls = ($perm[vote_poll]=='yes' ? 1 : 0);
		db_query("insert into forumpermission (forumid, groupid, type, close, copymove, deleteposts, deletethreads, editposts, editthreads, postthreads, replytoother, replytoown, viewforums, viewthreads, startpolls, votepolls, postattachments, viewattachments) values ($perm[forumid], $perm[groupid], '$perm[perm]', $close, $copymove, $deleteposts, $deletethreads, $editposts, $editposts, $postthreads, $replytoother, $replytoown, $viewforums, $viewthreads, $startpolls, $votepolls, 1, 1)");
		echo 'done<br />';
	}
	import_redirect(7);
}
elseif ($op==7)
{
	echo 'Step 7: Importing Forums<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from forums order by forumid asc');
	while ($forum = db_fetch_array($query))
		$forumstore[$i++] = $forum;
	dbvar_2x();
	$i = 0;
	while ($forum = $forumstore[$i++])
	{
		echo "Importing forum $forum[forumid]... ";
		$name = addslashes($forum[name]);
		$description = addslashes($forum[description]);
		$countposts = ($forum[count_posts]=='yes' ? 1 : 0);
		$allow_posting = ($forum[open]=='yes' && $forum[parentid] ? 1 : 0);
		$dpcode = ($forum[code]=='yes' ? 1 : 0);
		$img = ($forum[img]=='yes' ? 1 : 0);
		$smilies = ($forum[smilie]=='yes' ? 1 : 0);
		db_query("insert into forum (forumid, name, parentid, ordered, description, lastuserid, lastpostid, lastpostdate, posts, threads, lastusername, countposts, allow_posting, dpcode, img, smilies, lastforumid) values ($forum[forumid], '$name', $forum[parentid], $forum[ordered], '$description', 0, 0, 0, 0, 0, '', $countposts, $allow_posting, $dpcode, $img, $smilies, 0)");
		echo 'done<br />';
	}
	import_redirect(8);
}
elseif ($op==8)
{
	echo 'Step 8: Importing Groups<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from dp1x_groups order by groupid asc');
	while ($group = db_fetch_array($query))
		$groupstore[$i++] = $group;
	$config = db_fetch_array(db_query('select * from dp1x_config'));
	$i = 0;
	$query = db_query('select * from titles order by posts asc');
	while ($title = db_fetch_array($query))
		$titlestore[$i++] = $title;
	dbvar_2x();
	$i = 0;
	while ($group = $groupstore[$i++])
	{
		echo "Importing group $group[groupid]... ";
		$name = addslashes($group[name]);
		if ($name == "Site Administrator" || $name == "Site Administrator" || $name == "Forum Administrator" || $name == "Super Administrator" || $name == "Moderator" || $name == "Super Moderator" || $name == "User" || $name == "Guest")
			$name = $name.'s';
		$forum_admin = ($group[forum_admin]=='yes' ? 1 : 0);
		$site_admin = ($group[site_admin]=='yes' ? 1 : 0);
		$super_mod = ($group[super_mod]=='yes' ? 1 : 0);
		$view_profile = ($group[view_profile]=='yes' ? 1 : 0);
		$edit_profile = ($group[modify_profile]=='yes' ? 1 : 0);
		$view_memberlist = ($config[mem_list]=='yes' ? 1 : 0);
		$editposts = ($group[edit]=='yes' ? 1 : 0);
		$deleteposts = ($group[del]=='yes' ? 1 : 0);
		$deletethreads = ($group[delete_thread]=='yes' ? 1 : 0);
		$copymove = ($group[move]=='yes' ? 1 : 0);
		$close = ($group[close]=='yes' ? 1 : 0);
		$show_editedby = ($config[edited_by_admins]=='yes' && ($group[forum_admin]=='yes' || $group[super_mod]=='yes') ? 1 : 0);
		$postthreads = ($group[post_thread]=='yes' ? 1 : 0);
		$replytoown = ($group[reply_to_own]=='yes' ? 1 : 0);
		$replytoother = ($group[reply_to_other]=='yes' ? 1 : 0);
		if ($group[forum_admin]=='yes' && $group[site_admin]=='yes')
		{
			$ordered = 1;
			$online_template = '<b><i>$user_result[name]</i></b>';
			$online_template_large = '<b><i>$user_result[name]</i></b>';
			$ignorelist = 1;
			$customtitle = ($config[allow_mod_title]=='yes' ? 1 : 0);
			$pm_saved = 4294967295;
			db_query("insert into defaultgroups (groupid, user) values ($group[groupid], 2)");
		}
		elseif ($group[forum_admin]=='yes')
		{
			$ordered = 2;
			$online_template = '<b><i>$user_result[name]</i></b>';
			$online_template_large = '<b><i>$user_result[name]</i></b>';
			$ignorelist = 1;
			$customtitle = ($config[allow_mod_title]=='yes' ? 1 : 0);
			$pm_saved = $config[pm_saved];
			db_query("insert into defaultgroups (groupid, user) values ($group[groupid], 2)");
		}
		elseif ($group[site_admin]=='yes')
		{
			$ordered = 3;
			$online_template = '<b><i>$user_result[name]</i></b>';
			$online_template_large = '<b><i>$user_result[name]</i></b>';
			$ignorelist = 1;
			$customtitle = ($config[allow_mod_title]=='yes' ? 1 : 0);
			$pm_saved = $config[pm_saved];
			db_query("insert into defaultgroups (groupid, user) values ($group[groupid], 2)");
		}
		elseif ($group[super_mod]=='yes')
		{
			$ordered = 4;
			$online_template = '<b>$user_result[name]</b>';
			$online_template_large = '<b>$user_result[name]</b>';
			$ignorelist = 1;
			$customtitle = ($config[allow_mod_title]=='yes' ? 1 : 0);
			$pm_saved = $config[pm_saved];
			db_query("insert into defaultgroups (groupid, user) values ($group[groupid], 2)");
		}
		else
		{
			$ordered = 0;
			$online_template = '$user_result[name]';
			$online_template_large = '$user_result[name]';
			$ignorelist = 0;
			$customtitle = 0;
			$pm_saved = $config[pm_saved];
		}
		$privatemessaging = ($group[pm]=='yes' ? 1 : 0);
		$viewforums = ($group[view_forum]=='yes' ? 1 : 0);
		$viewthreads = ($group[view_thread]=='yes' ? 1 : 0);
		$startpolls = ($group[post_poll]=='yes' ? 1 : 0);
		$votepolls = ($group[vote_poll]=='yes' ? 1 : 0);
		$search = ($group[search]=='yes' ? 1 : 0);
		$exempt_titlecensor = ($config[exempt_mod_censor]=='yes' && ($group[forum_admin]=='yes' || $group[site_admin]=='yes' || $group[super_mod]=='yes') ? 1 : 0);
		db_query("insert into groups (groupid, name, forums, templates, topics, configuration, users, view_profile, groups, icons, styles, supermod_editposts, supermod_editthreads, supermod_deleteposts, supermod_deletethreads, supermod_editpolls, supermod_close, supermod_massdelete, supermod_massmove, supermod_copymove, supermod_banusers, supermod_exemptfloodcheck, supermod_announcements, supermod_viewips, supermod_viewfullprofiles, titles, lockpostcount, dpcode, smilies, edit_profile, view_memberlist, stylesets, supermod_sticky, moderators, editposts, editthreads, deleteposts, deletethreads, copymove, close, show_editedby, postthreads, replytoown, replytoother, customfields, ordered, sections, online_template, customavatar, customtitle, privatemessaging, online_template_large, max_recipients, ignorelist, forumperm, downloads, links, groupchanger, maintenance, whos_online, adminlog, viewforums, viewthreads, startpolls, votepolls, customsignature, supermod_log, search, articles, postattachments, viewattachments, exempt_titlecensor, maxpm, html, faq, tasks) values ($group[groupid], '$name', $forum_admin, $forum_admin, $site_admin, $forum_admin, $forum_admin, $view_profile, $forum_admin, $forum_admin, $site_admin, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $super_mod, $forum_admin, 0, $forum_admin, $forum_admin, $edit_profile, $view_memberlist, $site_admin, $super_mod, $forum_admin, $editposts, $editposts, $deleteposts, $deletethreads, $copymove, $close, $show_editedby, $postthreads, $replytoown, $replytoother, $forum_admin, $ordered, $site_admin, '$online_template', 0, 0, $privatemessaging, '$online_template_large', 5, $ignorelist, $forum_admin, $site_admin, $site_admin, $forum_admin, $forum_admin, 1, $forum_admin, $viewforums, $viewthreads, $startpolls, $votepolls, $edit_profile, $super_mod, $search, $site_admin, $postthreads, $postthreads, $exempt_titlecensor, '$pm_saved', $forum_admin, $site_admin, $forum_admin)");
		$z = 0;
		if ($group[title])
		{
			$title = addslashes($group[title]);
			db_query("insert into title (title, posts, groupid, image, `repeat`) values ('$title', 0, $group[groupid], '\$style[images]/star.gif', 0)");
		}
		else
			while ($title = $titlestore[$z++])
			{
				$title_res = addslashes($title[name]);
				db_query("insert into title (title, posts, groupid, image, `repeat`) values ('$title_res', $title[posts], $group[groupid], '\$style[images]/star.gif', 0)");
			}
		echo 'done<br />';
	}
	db_query("insert into groups (name, forums, templates, topics, configuration, users, view_profile, groups, icons, styles, supermod_editposts, supermod_editthreads, supermod_deleteposts, supermod_deletethreads, supermod_editpolls, supermod_close, supermod_massdelete, supermod_massmove, supermod_copymove, supermod_banusers, supermod_exemptfloodcheck, supermod_announcements, supermod_viewips, supermod_viewfullprofiles, titles, lockpostcount, dpcode, smilies, edit_profile, view_memberlist, stylesets, supermod_sticky, moderators, editposts, editthreads, deleteposts, deletethreads, copymove, close, show_editedby, postthreads, replytoown, replytoother, customfields, ordered, sections, online_template, customavatar, customtitle, privatemessaging, online_template_large, max_recipients, ignorelist, forumperm, downloads, links, groupchanger, maintenance, whos_online, adminlog, viewforums, viewthreads, startpolls, votepolls, customsignature, supermod_log, search, articles, postattachments, viewattachments, exempt_titlecensor, maxpm, html, faq, tasks) values ('Custom Titles', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '<b>\$user_result[name]</b>', 0, 1, 0, '\$user_result[name]', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)");
	db_query("insert into groups (name, forums, templates, topics, configuration, users, view_profile, groups, icons, styles, supermod_editposts, supermod_editthreads, supermod_deleteposts, supermod_deletethreads, supermod_editpolls, supermod_close, supermod_massdelete, supermod_massmove, supermod_copymove, supermod_banusers, supermod_exemptfloodcheck, supermod_announcements, supermod_viewips, supermod_viewfullprofiles, titles, lockpostcount, dpcode, smilies, edit_profile, view_memberlist, stylesets, supermod_sticky, moderators, editposts, editthreads, deleteposts, deletethreads, copymove, close, show_editedby, postthreads, replytoown, replytoother, customfields, ordered, sections, online_template, customavatar, customtitle, privatemessaging, online_template_large, max_recipients, ignorelist, forumperm, downloads, links, groupchanger, maintenance, whos_online, adminlog, viewforums, viewthreads, startpolls, votepolls, customsignature, supermod_log, search, articles, postattachments, viewattachments, exempt_titlecensor, maxpm, html, faq, tasks) values ('Custom Avatars', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '<b>\$user_result[name]</b>', 1, 0, 0, '\$user_result[name]', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)");
	if ($config[custom_title]=='yes')
		db_query("update grouprule set posts=$config[title_posts] and days=$config[title_days] where groupruleid=1 or groupruleid=2");
	else
		db_query('delete from grouprule where groupruleid=1 or groupruleid=2');
	if ($config[avatars]=='yes')
		db_query("update grouprule set posts=$config[min_avatar] where groupruleid=3 or groupruleid=4");
	else
		db_query('delete from grouprule where groupruleid=3 or groupruleid=4');
	import_redirect(9);
}
elseif ($op==9)
{
	echo 'Step 9: Importing Who Voted<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from guest_polls order by threadid asc');
	while ($guest = db_fetch_array($query))
		$gueststore[$i++] = $guest;
	$i = 0;
	$query = db_query('select * from user_polls order by threadid asc');
	while ($user = db_fetch_array($query))
		$userstore[$i++] = $user;
	dbvar_2x();
	$i = 0;
	while ($guest = $gueststore[$i++])
	{
		echo "Importing who voted - thread $guest[threadid], guest $guest[ip]... ";
		db_query("insert into whovoted (userid, threadid, choice, ip) values (0, $guest[threadid], 0, '$guest[ip]')");
		echo 'done<br />';
	}
	$i = 0;
	while ($user = $userstore[$i++])
	{
		echo "Importing who voted - thread $user[threadid], user $user[userid]... ";
		db_query("insert into whovoted (userid, threadid, choice, ip) values ($user[userid], $user[threadid], 0, '')");
		echo 'done<br />';
	}
	import_redirect(10);
}
elseif ($op==10)
{
	echo 'Step 10: Importing Icons<br />';
	echo '<br />';
	if ($import_icons==1)
	{
	dbvar_1x();
	$query = db_query('select * from icons order by iconid asc');
	while ($icon = db_fetch_array($query))
		$iconstore[$i++] = $icon;
	dbvar_2x();
	$i = 0;
	while ($icon = $iconstore[$i++])
	{
		echo "Importing icon $icon[iconid]... ";
		$name = addslashes($icon[name]);
		$image = addslashes($icon[image]);
		db_query("insert into icon (iconid, name, image, ordered) values ($icon[iconid], '$name', '$image', $icon[iconid])");
		echo 'done<br />';
	}
	}
	import_redirect(11);
}
elseif ($op==11)
{
	echo 'Step 11: Importing Link Categories<br />';
	echo '<br />';
	dbvar_1x();
	$i = 0;
	$query = db_query('select * from linkcat order by categoryid asc');
	while ($category = db_fetch_array($query))
		$categorystore[$i++] = $category;
	$i = 0;
	dbvar_2x();
	$query = db_query('select groupid from groups order by groupid asc');
	while ($group = db_fetch_array($query))
		$groupstore[$i++] = $group;
	$i = 0;
	while ($category = $categorystore[$i++])
	{
		echo "Importing link category $category[categoryid]... ";
		$name = addslashes($category[name]);
		$image = addslashes($category[image]);
		db_query("insert into linkcategory (linkcategoryid, name, image) values ($category[categoryid], '$name', '$image')");
		$n = 0;
		while ($group = $groupstore[$n++])
			db_query("insert into linkpermissions (linkcategoryid, groupid) values ($category[categoryid], $group[groupid])");
		echo 'done<br />';
	}
	import_redirect(12);
}
elseif ($op==12)
{
	echo 'Step 12: Importing Links<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from links order by linkid asc');
	while ($link = db_fetch_array($query))
		$linkstore[$i++] = $link;
	dbvar_2x();
	$i = 0;
	while ($link = $linkstore[$i++])
	{
		echo "Importing link $link[linkid]... ";
		$name = addslashes($link[name]);
		$description = addslashes($link[description]);
		$link_res = addslashes($link[link]);
		db_query("insert into link (linkid, linkcategoryid, name, description, link) values ($link[linkid], $link[categoryid], '$name', '$description', '$link_res')");
		echo 'done<br />';
	}
	import_redirect(13);
}
elseif ($op==13)
{
	echo 'Step 13: Importing Moderators<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from moderators order by forumid asc,userid asc');
	while ($mod = db_fetch_array($query))
		$modstore[$i++] = $mod;
	dbvar_2x();
	$i = 0;
	while ($mod = $modstore[$i++])
	{
		echo "Importing moderator - forum $mod[forumid], user $mod[userid]... ";
		$editposts = ($mod[edit]=='yes' ? 1 : 0);
		$editthreads = ($mod[edit_thread]=='yes' ? 1 : 0);
		$deleteposts = ($mod[del]=='yes' ? 1 : 0);
		$editpolls = ($mod[poll]=='yes' ? 1 : 0);
		$close = ($mod[close]=='yes' ? 1 : 0);
		$massmove = ($mod[move]=='yes' ? 1 : 0);
		$massdelete = ($mod[prune]=='yes' ? 1 : 0);
		$copymove = ($mod[manage]=='yes' ? 1 : 0);
		$announcements = ($mod[announce]=='yes' ? 1 : 0);
		$viewips = ($mod[ip]=='yes' ? 1 : 0);
		db_query("insert into moderator (forumid, userid, username, editposts, editthreads, deleteposts, editpolls, close, massdelete, massmove, copymove, exemptfloodcheck, announcements, viewips, sticky, deletethreads, log) values ($mod[forumid], $mod[userid], '', $editposts, $editthreads, $deleteposts, $editpolls, $close, $massdelete, $massmove, $copymove, 1, $announcements, $viewips, $copymove, $copymove, 1)");
		echo 'done<br />';
	}
	import_redirect(14);
}
elseif ($op==14)
{
	echo 'Step 14: Importing Private Messages<br />';
	echo '<br />';
	dbvar_1x();
	if (!$start)
		$start = 0;
	$p = 0;
	$query = db_query("select * from pm where pmid>$start order by pmid asc limit 1000");
	while ($pm = db_fetch_array($query))
		$pmstore[$i++] = $pm;
	dbvar_2x();
	$i = 0;
	while ($pm = $pmstore[$i++])
	{
		echo "Importing private message $pm[pmid]... ";
		$subject = addslashes($pm[subject]);
		$message = addslashes(str_replace('<br>', '<br />', $pm[message]));
		$smilies = ($pm[smilies]=='yes' ? 1 : 0);
		$isread = ($pm[isread]=='yes' ? 1 : 0);
		$showsignature = ($pm['sig']=='yes' ? 1 : 0);
		db_query("insert into privatemessage (privatemessageid, userid, touserid, fromuserid, iconid, subject, message, dpcode, smilies, isread, fromusername, tousername, sentdate, folder, showsignature, html) values ($pm[pmid], $pm[touserid], $pm[touserid], $pm[fromuserid], $pm[icon], '$subject', '$message', 1, $smilies, $isread, '', '', UNIX_TIMESTAMP('$pm[sent]'), 'inbox', $showsignature, 0)");
		echo 'done<br />';
		$p++;
	}
	if ($p==1000)
	{
		$start = $lastid;
		import_redirect(14);
	}
	else
	{
		$start = 0;
		import_redirect(15);
	}
}
elseif ($op==15)
{
	echo 'Step 15: Importing Polls<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from polls order by threadid asc,pollid asc');
	while ($poll = db_fetch_array($query))
		$pollstore[$i++] = $poll;
	dbvar_2x();
	$i = 0;
	while ($poll = $pollstore[$i++])
	{
		echo "Importing poll - thread $poll[threadid], choice $poll[pollid]... ";
		$choice = addslashes($poll[opt]);
		db_query("insert into poll (threadid, choice, votes, ordered) values ($poll[threadid], '$choice', $poll[votes], $poll[pollid])");
		echo 'done<br />';
	}
	import_redirect(16);
}
elseif ($op==16)
{
	echo 'Step 16: Importing Posts<br />';
	echo '<br />';
	if (!$start)
		$start = 0;
	dbvar_1x();
	$p = 0;
	$query = db_query("select * from posts where postid>$start order by postid asc limit 1000");
	while ($post = db_fetch_array($query))
		$poststore[$i++] = $post;
	dbvar_2x();
	$i = 0;
	while ($post = $poststore[$i++])
	{
		echo "Importing post $post[postid]... ";
		$subject = addslashes($post[subject]);
		$message = addslashes(str_replace('<br>', '<br />', $post[message]));
		$smilies = ($post[smilies]=='yes' ? 1 : 0);
		$showsignature = ($post[sig]=='yes' ? 1 : 0);
		$url = ($post[url]=='yes' ? 1 : 0);
		db_query("insert into post (postid, threadid, subject, message, userid, postdate, iconid, ip, username, dpcode, smilies, editedby_userid, editedby_username, editedby_date, showsignature, url, html) values ($post[postid], $post[threadid], '$subject', '$message', $post[userid], UNIX_TIMESTAMP('$post[posted]'), '$post[icon]', '$post[ip]', '', 1, $smilies, '$post[edited_by]', '', UNIX_TIMESTAMP('$post[edited_date]'), $showsignature, $url, 0)");
		echo 'done<br />';
		$lastid = $post[postid];
		$p++;
	}
	if ($p==1000)
	{
		$start = $lastid;
		import_redirect(16);
	}
	else
	{
		$start = 0;
		import_redirect(17);
	}
}
elseif ($op==17)
{
	echo 'Step 17: Importing Sections<br />';
	echo '<br />';
	dbvar_1x();
	$i = 0;
	$query = db_query('select * from sections order by sectionid asc');
	while ($section = db_fetch_array($query))
		$sectionstore[$i++] = $section;
	$i = 0;
	dbvar_2x();
	$query = db_query('select * from groups order by groupid asc');
	while ($group = db_fetch_array($query))
		$groupstore[$i++] = $group;
	$i = 0;
	while ($section = $sectionstore[$i++])
	{
		echo "Importing section $section[sectionid]... ";
		$name = addslashes($section[name]);
		$image = addslashes($section[image]);
		db_query("insert into section (sectionid, name, image) values ($section[sectionid], '$name', '$image')");
		$n = 0;
		while ($group = $groupstore[$n++])
		{
			$post = ($group[articles] ? 1 : 0);
			db_query("insert into sectionpermissions (sectionid, groupid, view, post, editown, editothers, deleteown, deleteothers) values ($section[sectionid], $group[groupid], 1, $post, $post, $post, $post, $post)");
		}
		echo 'done<br />';
	}
	import_redirect(18);
}
elseif ($op==18)
{
	echo 'Step 18: Importing Smilies<br />';
	echo '<br />';
	if ($import_smilies==1)
	{
	dbvar_1x();
	$query = db_query('select * from smilies order by smilieid asc');
	while ($smilie = db_fetch_array($query))
		$smiliestore[$i++] = $smilie;
	dbvar_2x();
	$i = 0;
	while ($smilie = $smiliestore[$i++])
	{
		echo "Importing smilie $smilie[smilieid]... ";
		$tag = addslashes($smilie[tag]);
		$name = addslashes($smilie[name]);
		$image = addslashes($smilie[image]);
		db_query("insert into smilie (smilieid, tag, name, image, ordered, `insensitive`) values ($smilie[smilieid], '$tag', '$name', '$image', $smilie[smilieid], 0)");
		echo 'done<br />';
	}
	}
	import_redirect(19);
}
elseif ($op==19)
{
	echo 'Step 19: Importing Articles<br />';
	echo '<br />';
	if (!$start)
		$start = 0;
	dbvar_1x();
	$query = db_query("select * from stories where storyid>$start order by storyid asc limit 1000");
	while ($story = db_fetch_array($query))
		$storystore[$i++] = $story;
	dbvar_2x();
	$i = 0;
	$p = 0;
	while ($story = $storystore[$i++])
	{
		echo "Importing article $story[storyid]... ";
		$title = addslashes($story[title]);
		$body = addslashes(str_replace('<br>', '<br />', $story[basictext]));
		if ($story[extendedtext])
			$body .= '[page /]'.addslashes(str_replace('<br>', '<br />', $story[extendedtext]));
		$smilies = ($story[smilies]=='yes' ? 1 : 0);
		db_query("insert into article (articleid, title, body, topicid, userid, posted, username, sectionid, smilies, dpcode, threadid, replies) values ($story[storyid], '$title', '$body', $story[topicid], $story[userid], UNIX_TIMESTAMP('$story[posted]'), '', $story[sectionid], $smilies, 1, '$story[comments]', 0)");
		echo 'done<br />';
		$lastid = $story[storyid];
		$p++;
	}
	if ($p==1000)
	{
		$start = $lastid;
		import_redirect(19);
	}
	else
	{
		$start = 0;
		import_redirect(20);
	}
}
elseif ($op==20)
{
	echo 'Step 20: Importing Subscribed Threads<br />';
	echo '<br />';
	dbvar_1x();
	$query = db_query('select * from subscribed order by threadid asc,userid asc');
	while ($sub = db_fetch_array($query))
		$substore[$i++] = $sub;
	dbvar_2x();
	$i = 0;
	while ($sub = $substore[$i++])
	{
		echo "Importing subscribed thread - thread $sub[threadid], user $sub[userid]... ";
		db_query("insert into subscribedthread (userid, threadid) values ($sub[userid], $sub[threadid])");
		echo 'done<br />';
	}
	import_redirect(21);
}
elseif ($op==21)
{
	echo 'Step 21: Importing Threads<br />';
	echo '<br />';
	if (!$start)
		$start = 0;
	dbvar_1x();
	$query = db_query("select threads.*,t2.moved as t_moved from threads left join threads as t2 on t2.moved=threads.threadid where threads.threadid>$start group by threads.threadid order by threads.threadid asc limit 1000");
	while ($thread = db_fetch_array($query))
		$threadstore[$i++] = $thread;
	dbvar_2x();
	$i = 0;
	$p = 0;
	while ($thread = $threadstore[$i++])
	{
		echo "Importing thread $thread[threadid]... ";
		$name = addslashes($thread[subject]);
		$closed = ($thread[closed]=='yes' ? 1 : 0);
		$sticky = ($thread[sticky]=='yes' ? 1 : 0);
		$poll = ($thread[poll]=='yes' ? '.' : '');
		$redirected = ($thread['t_moved'] ? 1 : 0);
		db_query("insert into thread (threadid, name, iconid, userid, lastpostdate, lastuserid, posts, views, forumid, username, lastusername, lastpostid, closed, sticky, redirect, poll, poll_days, poll_multiple, redirected, hasattachment) values ($thread[threadid], '$name', '$thread[icon]', $thread[userid], 0, 0, 0, $thread[views], $thread[forumid], '', '', '', $closed, $sticky, $thread[moved], '$poll', 0, 0, '$redirected', 0)");
		echo 'done<br />';
		$lastid = $thread[threadid];
		$p++;
	}
	if ($p==1000)
	{
		$start = $lastid;
		import_redirect(21);
	}
	else
	{
		$start = 0;
		import_redirect(22);
	}
}
elseif ($op==22)
{
	echo 'Step 22: Importing Topics<br />';
	echo '<br />';
	dbvar_1x();
	$i = 0;
	$query = db_query('select * from topics order by topicid asc');
	while ($topic = db_fetch_array($query))
		$topicstore[$i++] = $topic;
	$config = db_fetch_array(db_query('select * from dp1x_config'));
	$i = 0;
	dbvar_2x();
	$query = db_query('select * from groups order by groupid asc');
	while ($group = db_fetch_array($query))
		$groupstore[$i++] = $group;
	$i = 0;
	while ($topic = $topicstore[$i++])
	{
		echo "Importing topic $topic[topicid]... ";
		$name = addslashes($topic[name]);
		$image = addslashes($topic[image]);
		db_query("insert into topic (topicid, name, image, forumid) values ($topic[topicid], '$name', '$image', $config[autoforum])");
		$n = 0;
		while ($group = $groupstore[$n++])
		{
			$post = ($group[articles] ? 1 : 0);
			db_query("insert into topicpermissions (topicid, groupid, view, post, editown, editothers, deleteown, deleteothers) values ($topic[topicid], $group[groupid], 1, $post, $post, $post, $post, $post)");
		}
		echo 'done<br />';
	}
	import_redirect(23);
}
elseif ($op==23)
{
	echo 'Step 23: Importing Users<br />';
	echo '<br />';
	if (!$start)
		$start = 0;
	dbvar_1x();
	$query = db_query("select * from users where userid>$start order by userid asc limit 1000");
	while ($user = db_fetch_array($query))
		$userstore[$i++] = $user;
	dbvar_2x();
	$i = 0;
	$p = 0;
	while ($user = $userstore[$i++])
	{
		echo "Importing user $user[userid]... ";
		$name = addslashes($user['username']);
		$aol = addslashes($user['AIM']);
		$icq = addslashes($user['ICQ']);
		$msn = addslashes($user['MSN']);
		$yahoo = addslashes($user['Yahoo']);
		$title = addslashes($user['title']);
		$email = addslashes($user['email']);
		$location = addslashes($user['location']);
		$avatar = addslashes($user['avatar']);
		$signature = addslashes(str_replace('<br>', '<br />', $user['signature']));
		$biography = addslashes($user['biography']);
		$interests = addslashes($user['interests']);
		$occupation = addslashes($user['occupation']);
		$website = addslashes($user[home]);
		$hide_email = ($user[hide_email]=='yes' ? 1 : 0);
		$subscribe = ($user[subscribe]=='yes' ? 1 : 0);
		$img = ($user[show_img]=='yes' ? 1 : 0);
		$img = ($user[show_img]=='yes' ? 1 : 0);
		$email_notify = ($user[email_notify]=='yes' ? 1 : 0);
		$show_avatars = ($user[show_avatar]=='yes' ? 1 : 0);
		$displaysignatures = ($user['show_sig']=='yes' ? 1 : 0);
		$salt = generate_salt();
		$md5password = addslashes(dp_hash($salt, $user['password'], true));
		$salt = addslashes($salt);
		db_query("insert into user (userid, aol, icq, msn, yahoo, name, password, stylesetid, time_zone, groupid, posts, title, joindate, markread, markread_time, email, location, invisible, hide_email, use_wysiwyg, avatar, subscribe, subscribe_email, uncached_signature, displaysignatures, usesignature, quick_reply, pm, massmail, website, img, notify_pm, lastvisit, show_avatars, pm_popup, nopopup, auto_time_zone, time_zone_dst, southern_hemisphere, lastactivity, user_salt, usergroups, lastpost) values ($user[userid], '$aol', '$icq', '$msn', '$yahoo', '$name', '$md5password', 1, '$user[timezone]', $user[groupid], $user[posts], '$title', UNIX_TIMESTAMP('$user[joined]'), 1, 15, '$email', '$location', 0, $hide_email, 1, '$avatar', $subscribe, $email_notify, '$signature', $displaysignatures, 1, 'multi', 1, 1, '$website', '$img', '$email_notify', UNIX_TIMESTAMP('$user[lastvisit]'), '$show_avatars', '$email_notify', 0, 1, 1, 0, UNIX_TIMESTAMP('$user[lastact]'), '$salt', '$user[groupid]', 0)");
		db_query("insert into usercustomfield (customfieldid, userid, value) values (1, $user[userid], '$biography')");
		db_query("insert into usercustomfield (customfieldid, userid, value) values (2, $user[userid], '$interests')");
		db_query("insert into usercustomfield (customfieldid, userid, value) values (3, $user[userid], '$occupation')");
		$lastid = $user['userid'];
		echo "done<br />";
		$p++;
	}
	if ($p==1000)
	{
		$start = $lastid;
		import_redirect(23);
	}
	else
	{
		$start = 0;
		import_redirect(24);
	}
}
elseif ($op==24)
{
	echo 'Import Complete!<br />';
	echo '<br />';
	dbvar_1x();
	db_query_noerror('alter table dp1x_config rename config');
	db_query_noerror('alter table dp1x_groups rename groups');
	echo 'The Deluxe Portal 1.1.x to Deluxe Portal 2.0.0 import script has finished. Please double-check ALL settings, especially group and permission settings. Also, delete the installation directory, for security reasons. Finally, run the following scripts in the maintenance control panel, in the order listed below:';
	echo '<ul><li>Update Usernames</li><li>Update Thread Counters</li><li>Update Forum Counters</li><li>Reparse Signatures</li><li>Reparse Post Cache</li></ul>';
}
else
{
	echo 'Deluxe Portal 1.1.x to Deluxe Portal 2.0.0 Importer</b><br />';
	echo '<br />';
	echo '<form action="import.php" method="post">';
	echo '<input name="op" type="hidden" value="1" />';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Database Information for Deluxe Portal 1.1.x Database</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><b>Host:</b></td><td><input name=\"dphost\" type=\"text\" value=\"$dbhost\" size=\"60\" /></td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><b>Database name:</b></td><td><input name=\"dpname\" type=\"text\" value=\"$dbname\" size=\"60\" /></td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><b>Username:</b></td><td><input name=\"dpuser\" type=\"text\" value=\"$dbuser\" size=\"60\" /></td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><b>Password:</b></td><td><input name=\"dppass\" type=\"password\" value=\"$dbpass\" size=\"60\" /></td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><b>Type:</b></td><td><select name=\"dptype\"><option value=\"mssql\">MS SQL</option><option value=\"mysql\" selected=\"selected\">MySQL</option><option value=\"sybase\">Sybase</option></select></td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><input name=\"import_icons\" type=\"checkbox\" value=\"1\" /> <b>Import old icons</b></td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><input name=\"import_smilies\" type=\"checkbox\" value=\"1\" /> <b>Import old smilies</b></td>";
	echo '</tr>';
	echo '<tr>';
	echo '<td class="center" colspan="2"><input type="submit" value="Next &gt;" /></td>';
	echo '</tr>';
	echo '</table></td>';
	echo '</tr>';
	echo '</table></td>';
	echo '</tr>';
	echo '</table></div>';
	echo '</form>';
}

print_footer();
?>