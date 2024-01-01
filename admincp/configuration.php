<?php
/**************************************************
* Configuration
* -------------
* Allows you to manage global forum and site
* settings.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'configuration_index,edit_configuration_redirect,emailgroup_choice,group_choice,guestgroup_choice,styleset_choice,usergroup_choice';
/**************************************************
* Global variable resetting                      */
unset($banned_groups);
unset($email_groups);
unset($emailgroups);
unset($emailgroups_col1);
unset($emailgroups_col2);
unset($groups);
unset($guest_groups);
unset($guest_stylesets);
unset($guestgroups);
unset($guestgroups_col1);
unset($guestgroups_col2);
unset($stylesets);
unset($usergroups);
unset($usergroups_col1);
unset($usergroups_col2);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$section = $_REQUEST['section'];
/*************************************************/

function create_index()
{
	db_query('drop index name on thread');
	db_query('create fulltext index message on post (message)');
	db_query('create fulltext index name on thread (name)');
}

function drop_index()
{
	db_query('drop index message on post');
	db_query('drop index name on thread');
}

$pagetitle = 'Configuration';

if ($group['configuration'])
{
	if ($_POST['op']=='submit')
	{
		adminlog('Updated configuration');
		$query = db_query('select groupid from groups');
		db_query('delete from defaultgroups');
		while ($group_result = db_fetch_array($query))
		{
			if ($group_result['groupid']==$_POST['groupid'] || $_POST["group_$group_result[groupid]"])
				db_query("insert into defaultgroups (groupid, user) values ($group_result[groupid], 1)");
			if ($group_result['groupid']==$_POST['guest_groupid'] || $_POST["guestgroup_$group_result[groupid]"])
				db_query("insert into defaultgroups (groupid, user) values ($group_result[groupid], 0)");
			if ($_POST["emailgroup_$group_result[groupid]"])
				db_query("insert into defaultgroups (groupid, user) values ($group_result[groupid], 2)");
		}
		if ($config['fulltextsearch'] && !$_POST['fulltextsearch'])
			register_shutdown_function('drop_index');
		elseif (!$config['fulltextsearch'] && $_POST['fulltextsearch'])
			register_shutdown_function('create_index');
		
		$name = htmlspecialchars($_POST['name']);
		$url = htmlspecialchars($_POST['url']);
		$contact = htmlspecialchars($_POST['contact']);
		$redirect_time = $_POST['redirect_time'] * 1000;
		$clear_search = (int) $_POST['clear_search'];
		$clear_search = ($clear_search > 1 ? $clear_search : 1);
		if ($demo_mode)
		{
			$_POST['avatar_location'] = 'database';
			$_POST['attachment_location'] = 'database';
			$_POST['download_location'] = 'database';
			$_POST['icon_location'] = 'database';
			$_POST['link_location'] = 'database';
			$_POST['section_location'] = 'database';
			$_POST['smilie_location'] = 'database';
			$_POST['topic_location'] = 'database';
		}
		db_query("update config set clear_search='$clear_search',external_style='$_POST[external_style]',gd_registration='$_POST[gd_registration]',showspiders='$_POST[showspiders]',spider_names='$_POST[spider_names]',spider_agents='$_POST[spider_agents]',dp_info='$_POST[dp_info]',lastpost_thread='$_POST[lastpost_thread]',show_subforums='$_POST[show_subforums]',viewingthread='$_POST[viewingthread]',show_rules='$_POST[show_rules]',rules='$_POST[rules]',sig_chars='$_POST[sig_chars]',load_limit='$_POST[load_limit]',guest_load='$_POST[guest_load]',search_load='$_POST[search_load]',sig_lines='$_POST[sig_lines]',show_moderators='$_POST[show_moderators]',copyright='$_POST[copyright]',blocked_characters='$_POST[blocked_characters]',booleansearch='$_POST[booleansearch]',show_description='$_POST[show_description]',icons_row='$_POST[icons_row]',time_offset='$_POST[time_offset]',description='$_POST[description]',max_usertitlelen='$_POST[max_usertitlelen]',markforumread='$_POST[markforumread]',login_fail='$_POST[login_fail]',login_failtime='$_POST[login_failtime]',site_announcement='$_POST[site_announcement]',browsingforum='$_POST[browsingforum]',use_wysiwyg='$_POST[use_wysiwyg]',sidebar_downloads='$_POST[sidebar_downloads]',sidebar_links='$_POST[sidebar_links]',sidebar_pm='$_POST[sidebar_pm]',sidebar_sections='$_POST[sidebar_sections]',sidebar_online='$_POST[sidebar_online]',max_titlelen='$_POST[max_titlelen]',max_wordlen='$_POST[max_wordlen]',cookie_expiration_date='$_POST[cookie_expiration_date]',cookie_domain='$_POST[cookie_domain]',cookie_path='$_POST[cookie_path]',censor='$_POST[censor]',listqueries='$_POST[listqueries]',numlinks_articlenav='$_POST[numlinks_articlenav]',show_cptemplates='$_POST[show_cptemplates]',stop_redirect='$_POST[stop_redirect]',show_querycounter='$_POST[show_querycounter]',number_smilies='$_POST[number_smilies]',smilies_row='$_POST[smilies_row]',doticons='$_POST[doticons]',headlines='$_POST[headlines]',ban_groupid='$_POST[ban_groupid]',name='$name',url='$url',contact='$contact',attachment_directory='$_POST[attachment_directory]',attachment_location='$_POST[attachment_location]',censored_title='$_POST[censored_title]',signature_img='$_POST[signature_img]',pm_max_length='$_POST[pm_max_length]',pm_dpcode='$_POST[pm_dpcode]',pm_smilies='$_POST[pm_smilies]',pm_img='$_POST[pm_img]',censored_words='$_POST[censored_words]',banned_email='$_POST[banned_email]',banned_ip='$_POST[banned_ip]',floodcheck_time='$_POST[floodcheck_time]',min_search_length='$_POST[min_search_length]',post_order='$_POST[post_order]',disable_shouting='$_POST[disable_shouting]',min_username_length='$_POST[min_username_length]',max_username_length='$_POST[max_username_length]',illegal_usernames='$_POST[illegal_usernames]',password_reminder='$_POST[password_reminder]',unique_email='$_POST[unique_email]',numlinks_search='$_POST[numlinks_search]',search_per_page='$_POST[search_per_page]',attachment_size='$_POST[attachmentsize]',attachment_types='$_POST[attachment_types]',attachment_width='$_POST[attachment_width]',attachment_height='$_POST[attachment_height]',max_poll_options='$_POST[max_poll_options]',fulltextsearch='$_POST[fulltextsearch]',signature_dpcode='$_POST[signature_dpcode]',signature_smilies='$_POST[signature_smilies]',subscribe_email='$_POST[subscribe_email]',avatar_size='$_POST[avatar_size]',avatar_types='$_POST[avatar_types]',avatar_width='$_POST[avatar_width]',avatar_height='$_POST[avatar_height]',compression='$_POST[compression]',hideforums='$_POST[hideforums]',log_per_page='$_POST[log_per_page]',numlinks_log='$_POST[numlinks_log]',sections_per_row='$_POST[sections_per_row]',topics_per_row='$_POST[topics_per_row]',downloads_per_row='$_POST[downloads_per_row]',links_per_row='$_POST[links_per_row]',link_location='$_POST[link_location]',link_directory='$_POST[link_directory]',download_location='$_POST[download_location]',download_directory='$_POST[download_directory]',show_email='$_POST[show_email]',online_timeout='$_POST[online_timeout]',whos_online='$_POST[whos_online]',guest_time_zone='$_POST[guest_time_zone]',guest_name='$_POST[guest_name]',default_styleset='$_POST[default_styleset]',guest_stylesetid='$_POST[guest_stylesetid]',default_register_group='$_POST[groupid]',guest_groupid='$_POST[guest_groupid]',admin_articles_per_page='$_POST[admin_articles_per_page]',num_frontpage_articles='$_POST[num_frontpage_articles]',allow_registration='$_POST[allow_registration]',closed='$_POST[closed]',closed_reason='$_POST[closed_reason]',icon_location='$_POST[icon_location]',icon_directory='$_POST[icon_directory]',smilie_location='$_POST[smilie_location]',smilie_directory='$_POST[smilie_directory]',avatar_location='$_POST[avatar_location]',avatar_directory='$_POST[avatar_directory]',section_location='$_POST[section_location]',section_directory='$_POST[section_directory]',topic_location='$_POST[topic_location]',topic_directory='$_POST[topic_directory]',posts_per_page='$_POST[posts_per_page]',numlinks_pagenav='$_POST[numlinks_pagenav]',threads_per_page='$_POST[threads_per_page]',numlinks_threadnav='$_POST[numlinks_threadnav]',numlinks_multipage='$_POST[numlinks_multipage]',min_posts_hot='$_POST[min_posts_hot]',min_views_hot='$_POST[min_views_hot]',members_per_page='$_POST[members_per_page]',numlinks_memberlistnav='$_POST[numlinks_memberlistnav]',edited_by_time='$_POST[edited_by_time]',edit_thread_time='$_POST[edit_thread_time]',edit_post_time='$_POST[edit_post_time]',delete_post_time='$_POST[delete_post_time]',delete_thread_time='$_POST[delete_thread_time]',markread='$_POST[markread]',numlinks_online='$_POST[numlinks_online]',online_per_page='$_POST[online_per_page]',showguests='$_POST[showguests]',email_groupid='$_POST[email_groupid]',censored_img='$_POST[censored_img]',redirect_time='$redirect_time',post_cache='$_POST[post_cache]',attachment_image_types='$_POST[attachment_image_types]'");
		$redirect_url = 'index.php';
		eval(get_template('edit_configuration_redirect'));
	}
	else
	{
		adminlog('Viewed configuration panel');
		$config['closed_reason_value'] = htmlspecialchars($config['closed_reason']);
		$config['site_announcement_value'] = htmlspecialchars($config['site_announcement']);
		$config['description_value'] = htmlspecialchars($config['description']);
		$config['copyright_value'] = htmlspecialchars($config['copyright']);
		$config['rules'] = htmlspecialchars($config['rules']);
		$config['redirect_time'] = $config['redirect_time']/1000;
		
		$query = db_query('select * from defaultgroups');
		$usergroups = ',';
		$emailgroups = ',';
		$guestgroups = ',';
		while ($usergroup = db_fetch_array($query))
		{
			if ($usergroup['user']==1)
				$usergroups .= "$usergroup[groupid],";
			elseif ($usergroup['user']==2)
				$emailgroups .= "$usergroup[groupid],";
			else
				$guestgroups .= "$usergroup[groupid],";
		}
		
		$query = db_query('select * from styleset order by name asc');
		while ($styleset_result = db_fetch_array($query))
		{
			if ($styleset_result['stylesetid']==$config['default_styleset'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('styleset_choice', '$userstyleset'));
			if ($styleset_result['stylesetid']==$config['guest_stylesetid'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('styleset_choice', '$gueststyleset'));
			$stylesets .= $userstyleset;
			$guest_stylesets .= $gueststyleset;
		}
		
		$query = db_query('select * from groups order by name asc');
		$num_col1 = ceil(db_num_rows($query)/2);
		$i = 0;
		while ($group_result = db_fetch_array($query))
		{
			if ($group_result['groupid']==$config['default_register_group'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('group_choice'));
			if ($group_result['groupid']==$config['ban_groupid'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('group_choice', '$bangroup_choice'));
			if ($group_result['groupid']==$config['guest_groupid'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('group_choice', '$guestgroup_choice'));
			if ($group_result['groupid']==$config['email_groupid'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('group_choice', '$emailgroup_choice'));
			if (strstr($usergroups, ",$group_result[groupid],") && $group_result['groupid']!=$config['default_register_group'])
				$checked = true;
			else
				$checked = false;
			eval(store_template('usergroup_choice'));
			if (strstr($guestgroups, ",$group_result[groupid],") && $group_result['groupid']!=$config['guest_groupid'])
				$checked = true;
			else
				$checked = false;
			eval(store_template('guestgroup_choice', '$other_guestgroup_choice'));
			if (strstr($emailgroups, ",$group_result[groupid],") && $group_result['groupid']!=$config['emailgroup_groupid'])
				$checked = true;
			else
				$checked = false;
			eval(store_template('emailgroup_choice', '$other_emailgroup_choice'));
			if (++$i<=$num_col1)
			{
				$usergroups_col1 .= $usergroup_choice;
				$guestgroups_col1 .= $other_guestgroup_choice;
				$emailgroups_col1 .= $other_emailgroup_choice;
			}
			else
			{
				$usergroups_col2 .= $usergroup_choice;
				$guestgroups_col2 .= $other_guestgroup_choice;
				$emailgroups_col2 .= $other_emailgroup_choice;
			}
			$groups .= $group_choice;
			$banned_groups .= $bangroup_choice;
			$guest_groups .= $guestgroup_choice;
			$email_groups .= $emailgroup_choice;
		}
		eval(get_template('configuration_index'));
	}
}
else
	eval(get_template('permission_error'));
?>