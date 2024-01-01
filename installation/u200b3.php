<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Beta 2 -> Beta 3");

function old_selective_import($templatesetid, $new, $change, $delete)
{
	if (!$fp = fopen('../data/template.dpt.php', 'r'))
		return false;
	$contents = trim(substr(fread($fp, filesize('../data/template.dpt.php')), 8, -5));
	fclose($fp);
	$contents = str_replace("\r\n", "\n", $contents);
	$contents = str_replace("\r", "\n", $contents);
	$templates = unserialize($contents);
	
	db_query("delete from parsedtemplate where templatesetid='$templatesetid'");
	
	if ($delete)
	{
		$list = explode(',', $delete);
		foreach ($list as $name)
			db_query("delete from template where name='$name' and templatesetid='$templatesetid'");
	}
	
	if ($new)
	{
		$list = explode(',', $new);
		foreach ($list as $name)
			db_query("delete from template where name='$name' and templatesetid='$templatesetid'");
	}
	
	if ($new)
	{
		$list = explode(',', $new);
		foreach ($list as $name)
		{
			$template = $templates[$name];
			$template['category'] = addslashes($template['category']);
			$parsed_template = addslashes(parse_template($template['body']));
			$template['body'] = addslashes($template['body']);
			$custom = 0;
			$name = addslashes($name);
			db_query("insert into template (name, category, body, templatesetid, custom) values ('$name', '$template[category]', '$template[body]', '$templatesetid', $custom)");
		}
	}
	
	if ($change)
	{
		$list = explode(',', $change);
		foreach ($list as $name)
		{
			$template = $templates[$name];
			$template['category'] = addslashes($template['category']);
			$parsed_template = addslashes(parse_template($template['body']));
			$template['body'] = addslashes($template['body']);
			$custom = 0;
			$name = addslashes($name);
			db_query("update template set category='$template[category]',body='$template[body]',custom=$custom where name='$name' and templatesetid='$templatesetid'");
		}
	}
	
	$query = db_query("select * from template where templatesetid='$templatesetid'");
	while ($oldtemp = db_fetch_array($query))
	{
		$parsed_template = addslashes(parse_template($oldtemp['body']));
		db_query("insert into parsedtemplate (templateid, name, body, templatesetid) values ($oldtemp[templateid], '".addslashes($oldtemp['name'])."', '$parsed_template', '$templatesetid')");
	}
	
	return $templatesetid;
}

db_connect();
db_select_db();

	echo 'Upgrading from 2.0.0 Beta 2 to 2.0.0 Beta 3<br />';
	echo '<br />';
	db_query("alter table config add max_titlelen int unsigned not null");
	db_query("update config set max_titlelen=80");
	db_query("alter table config add max_wordlen int unsigned not null");
	db_query("update config set max_wordlen=80");
	db_query("alter table user add show_avatars tinyint unsigned not null");
	db_query("update user set show_avatars=1 where img=1");
	db_query("alter table config add censored_img text not null");
	db_query("update config set censored_img='?'");
	db_query("alter table config add redirect_time int unsigned not null");
	db_query("update config set redirect_time=1");
	db_query("alter table config add sidebar_downloads tinyint unsigned not null");
	db_query("update config set sidebar_downloads=1");
	db_query("alter table config add sidebar_sections tinyint unsigned not null");
	db_query("update config set sidebar_sections=1");
	db_query("alter table config add sidebar_links tinyint unsigned not null");
	db_query("update config set sidebar_links=1");
	db_query("alter table config add sidebar_pm tinyint unsigned not null");
	db_query("update config set sidebar_pm=1");
	db_query("alter table config add sidebar_online tinyint unsigned not null");
	db_query("update config set sidebar_online=1");
	db_query("alter table smilie add `insensitive` tinyint unsigned not null");
	db_query("update smilie set `insensitive`=0");
	db_query("alter table dpcode drop useoption");
	db_query("alter table config add use_wysiwyg tinyint unsigned not null");
	db_query("update config set use_wysiwyg=1");
	db_query("alter table announcement drop linebreaks");
	db_query("alter table announcement add index start (start)");
	db_query("alter table announcement add index end (end)");
	db_query("alter table article drop linebreaks");
	db_query("alter table customfield add index ordered (ordered)");
	db_query("alter table customfield add index view (view)");
	db_query("alter table defaultgroups add index user (user)");
	db_query("alter table privatemessage add index isread (isread)");
	db_query("alter table privatemessage add index folder (folder)");
	db_query("alter table sectionpermissions add index view (view)");
	db_query("alter table thread add index name (name)");
	db_query("alter table thread add index redirect (redirect)");
	db_query("alter table topicpermissions add index view (view)");
	db_query("alter table parsedtemplate add index name (name)");
	db_query("alter table parsedtemplate drop admincp");
	db_query("alter table parsedtemplate drop modcp");
	db_query("alter table adminlog drop index userid");
	db_query("alter table announcement drop index userid");
	db_query("alter table article drop index threadid");
	db_query("alter table changergroups drop index groupid");
	db_query("alter table defaultgroups drop index groupid");
	db_query("alter table emailgroups drop index userid");
	db_query("alter table emailgroups drop index groupid");
	db_query("alter table forum drop index lastuserid");
	db_query("alter table forumpermission drop index forumid");
	db_query("alter table forumpermission drop index groupid");
	db_query("alter table grouprules drop index groupid");
	db_query("alter table icon add index ordered (ordered)");
	db_query("alter table moderatorlog drop index userid");
	db_query("alter table passwordreminder drop index userid");
	db_query("alter table post drop index editedby_userid");
	db_query("alter table privatemessage drop index touserid");
	db_query("alter table adminlog modify ip char(39) not null");
	db_query("alter table moderatorlog modify ip char(39) not null");
	db_query("alter table post modify ip char(39) not null");
	db_query("alter table session modify ip char(39) not null");
	db_query("alter table smilie add index ordered (ordered)");
	db_query("alter table template add index category (category)");
	db_query("alter table thread drop index lastuserid");
	db_query("alter table title drop index groupid");
	db_query("alter table topic drop index forumid");
	db_query("alter table user drop index stylesetid");
	db_query_noerror("alter table whovoted drop index threadid");
	db_query("alter table whovoted modify ip char(39) not null");
	db_query("alter table config add browsingforum tinyint unsigned not null");
	db_query("update config set browsingforum=1 where whos_online=1");
	db_query("alter table config modify censored_words text not null");
	db_query("alter table config modify censored_title text not null");
	db_query("alter table config modify illegal_usernames text not null");
	db_query("alter table thread add index lastpostdate (lastpostdate)");
	db_query("alter table session add index lastactivity (lastactivity)");
	db_query("drop table markforumread");
	db_query("alter table config add site_announcement text not null");
	db_query("alter table user add numfailed int unsigned not null");
	db_query("update user set numfailed=0");
	db_query("alter table user add lastfail int unsigned not null");
	db_query("update user set lastfail=0");
	db_query("alter table user add pm_popup tinyint unsigned not null");
	db_query("update user set pm_popup=1 where notify_pm=1");
	db_query("alter table config add login_fail int unsigned not null");
	db_query("update config set login_fail=5");
	db_query("alter table config add login_failtime int unsigned not null");
	db_query("update config set login_failtime=15");
	db_query("alter table user add nopopup tinyint unsigned not null");
	db_query("update user set nopopup=0");
	db_query("alter table config add markforumread tinyint unsigned not null");
	db_query("update config set markforumread=1 where markread=1");
	db_query("alter table config modify show_email enum('address','form','disable') not null");
	if ($config['show_email'])
		db_query("update config set show_email='address'");
	else
		db_query("update config set show_email='disable'");
	db_query("alter table config add max_usertitlelen int unsigned not null");
	db_query("update config set max_usertitlelen=25");
	$query = db_query("select * from user where name like '%<%' or name like '%>%' or name like '%\"%' or name like '%&%'");
	while ($user = db_fetch_array($query))
		db_query("update user set name='".addslashes(htmlspecialchars($user['name']))."' where userid=$user[userid]");
	
	if ($template_edit)
		$change = 'main_index,main_article,admin_index,redirect_header,user_index,permission_error,login_account_failed,header,footer,message_footer,register_account,configuration_index,forum_index,forums_index,profile_index,groups_index,edit_group,users_index,forumdisplay_index,forumdisplay_thread,icons_index,thread_index,thread_post,newthread_index,moderator,newreply_index,forumnav_link,editpost_index,edit_post_redirect,edit_icon,titles_index,edit_title,edit_forum,dpcode_index,edit_dpcode,smilies_index,edit_smilie,edit_user,add_user,editprofile_index,editoptions_index,password_index,memberlist_member,stylesets_index,close_thread_redirect,sticky_thread_redirect,add_moderator,fields_index,edit_field,topics_index,edit_topic,articles_index,edit_article,newpm_index,readpm_index,email_hidden,leaders_moderator,add_ignored_user_redirect,add_buddy_redirect,forumperm_index,add_link,link_showcategory,pagenav_first,pagenav_last,pagenav_link,pagenav_next,pagenav_prev,article_index,forumperm_edit,groupchanger_index,edit_rule,forumjump_forum,maintenance_index,search_index,add_poll,poll_result,edit_poll,mod_index,delete_poll_redirect,view_user,moderate_whovoted_result,add_announcement,announcement_index,announcement_announcement,edit_announcement,forumnav_nolink,nav_header,newthreads_thread,massmove_done,massdelete_done,massmail_users,smilie_column,smilie_box,faq_posting,moderate_delete_redirect,moderate_no_redirect,delete_redirect_redirect,markread_forum_redirect,forumjump,maintenance_imagestore,image_missing,announcements_date,login_account_password,login_account_attempts,post_codeblock,post_phpblock,massmail_users_continue,email_form,email_send_redirect,register_account_comma,masspm_users,masspm_users_continue,masspm_users_redirect';
	else
		$change = '';
	
	if ($template_delete)
		$delete = 'thread_pagenav_link,thread_pagenav_first,thread_pagenav_last,thread_pagenav_prev,thread_pagenav_next,forumdisplay_pagenav_first,forumdisplay_pagenav_last,forumdisplay_pagenav_link,forumdisplay_pagenav_next,forumdisplay_pagenav_prev,memberlist_pagenav_first,memberlist_pagenav_link,memberlist_pagenav_next,memberlist_pagenav_last,memberlist_pagenav_prev,thread_moderator_options,open_thread_redirect,unstick_thread_redirect,stick_thread_redirect,thread_post_ignored,thread_poll,edit_poll_missing,modlog_pagenav_first,modlog_pagenav_last,modlog_pagenav_link,modlog_pagenav_next,modlog_pagenav_prev,thread_attachment,thread_attachment_image,preview_index,article_pagenav_first,article_pagenav_last,article_pagenav_link,article_pagenav_next,article_pagenav_prev,maintenance_templates_option,dp_info';
	else
		$delete = '';
	
	$new = 'sticky_thread_redirect,forumjump_forum,delete_poll_redirect,moderate_delete_redirect,moderate_no_redirect,delete_redirect_redirect,markread_forum_redirect,maintenance_imagestore,image_missing,announcements_date,login_account_password,login_account_attempts,post_codeblock,post_phpblock,massmail_users_continue,email_form,email_send_redirect,register_account_comma,masspm_users,masspm_users_continue,masspm_users_redirect';
	
	$query = db_query("select * from templateset");
	while ($tset = db_fetch_array($query))
		old_selective_import($tset[templatesetid], $new, $change, $delete);
	
	if ($group_display)
		db_query("update groups set online_template_large='\$user_result[name]' where name='Users' or name='Banned' or name='Guests' or name='Awaiting Email Verification'");
	
	db_query("update config set version='2.0.0 Beta 3'");
	
	redirect('upgrade.php');

print_footer();
?>