<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Beta 4 -> Release Candidate 1");

db_connect();
db_select_db();

echo 'Upgrading from 2.0.0 Beta 4 to 2.0.0 Release Candidate 1<br />';
	
if (!$_REQUEST['op'])
{
	echo 'Step 1: Altering database<br /><br />';
	db_query("alter table style add wysiwygcss char(255) not null");
	db_query('update style set wysiwygcss=\'$relativeurl/javascript/wysiwyg.css\'');
	db_query("alter table dpcode add nosmilies tinyint unsigned not null");
	db_query("update dpcode set nosmilies=1 where tag='email'");
	db_query("CREATE TABLE search (
  searchid int(10) unsigned NOT NULL auto_increment,
  lastaccessed int(11) NOT NULL default '0',
  searchterms text NOT NULL,
  searchusername varchar(255) NOT NULL default '',
  type enum('post','title') NOT NULL default 'post',
  userid int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (searchid),
  KEY userid (userid)
)");
db_query("CREATE TABLE searchresult (
  resultid int(10) unsigned NOT NULL auto_increment,
  searchid int(10) unsigned NOT NULL default '0',
  forumid int(10) unsigned NOT NULL default '0',
  threadid int(10) unsigned NOT NULL default '0',
  postid int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (resultid),
  KEY searchid (searchid)
)");
	db_query("alter table thread add hasattachment tinyint unsigned not null");
	db_query("alter table forum add lastforumid int unsigned not null");
	db_query("alter table user add usergroups text not null");
	db_query("alter table config add clear_search int unsigned not null");
	db_query("update config set clear_search=1");
	db_query("update stylecss set selector='.cellmain, .cellmain td, .cellmain th, .cellalt .cellmain' where selector='.cellmain'");
	db_query("update stylecss set selector='.cellalt, .cellalt td, .cellalt th, .cellmain .cellalt' where selector='.cellalt'");
	db_query("update stylecss set selector='.small, .cellmain .small, .cellalt .small' where selector='.small'");
	db_query("update stylecss set selector='.heading, .cellmain .heading, .cellalt .heading' where selector='.heading'");
	db_query("update stylecss set selector='.tableheader, .cellmain .tableheader, .cellalt .tableheader' where selector='.tableheader'");
	db_query("update stylecss set selector='.tableline, .cellmain .tableline, .cellalt .tableline' where selector='.tableline'");
	$task_search = get_next_timestamp(0, 2, -1, -1);
	$next_task = min($task_search, $config['next_task']);
	db_query("update config set next_task='$next_task'");
	db_query("INSERT INTO task (name, script, minute, hour, day, dayofweek, enabled, late, log, nextrun, max_load, description) VALUES ('Prune search results', 'tasks/search.php', 0, 2, -1, -1, 1, 1, 1, '$task_search', '0', 'Clears old cached search results. You can configure this in the configuration panel, under Server Options.')");
	db_query("update config set max_wordlen=0 where max_wordlen=80");
	db_query("update dpcode set replacement='<blockquote><div class=\"small\">Quote:</div><div><hr />{param}<hr /></div></blockquote>' where tag='quote'");
	db_query("update faqitem set content='WYSIWYG, or What You See Is What You Get, is an exciting new way of posting. Instead of having to use a boring old text box to type your posts into, and having to type out DP Code tags to provide formatting, the new WYSIWYG input control allows you to post as if you were using a program such as Microsoft Word. Want to make text bold? Just click the <b>B</b> (bold) icon in the toolbar. Same goes for smilies. Once you see WYSIWYG, you won\'t want to post any other way!\n\nWYSIWYG only works in Internet Explorer 5.5 or higher for Windows, and Mozilla 1.3 or higher across any platform. If WYSIWYG works on your computer, you will see a box below, with a toolbar directly above it. Try it out!<br /><br />\n<form>\n<div class=\"center\">\n<script type=\"text/javascript\">\n<!--\ndocument.write(\'<div style=\"display:none\" id=\"messageDiv\"><iframe id=\"messageIframe\"></iframe></div>\');\n//-->\n</script><textarea name=\"message\" id=\"message\" rows=\"10\" cols=\"80\"></textarea>\n</div>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg.js\"></script>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg_en.js\"></script>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg_dialog.js\"></script>\n<script type=\"text/javascript\"><!--\ngenerate_wysiwyg(\'message\');\n-->\n</script>\n</form>' where name='What is WYSIWYG?'");
	redirect("u200rc1.php?op=2&template_edit=$template_edit");
}
elseif ($_REQUEST['op']==2)
{
	echo 'Step 2: Altering indexes<br /><br />';
	if ($config['fulltext'])
	{
		db_query("alter table thread drop index name");
		db_query("alter table thread add fulltext index name (name)");
	}
	redirect("u200rc1.php?op=3&template_edit=$template_edit&template_delete=$template_delete");
}
elseif ($_REQUEST['op']==3)
{
	echo 'Step 3: Setting up templates<br /><br />';
	
	if ($template_edit)
		$change = 'redirect_header,permission_error,header,register_index,register_account,forum_forum,forumdisplay_index,forumdisplay_thread,thread_index,thread_post,newthread_index,forumdisplay_forum,newreply_index,editpost_index,editprofile_index,editoptions_index,memberlist_member,memberlist_index,newpm_index,forum_forum_parent_canpost,readpm_index,search_index,search_results,account_illegal_name,announcement_announcement,popup_header,smilie_column,smilie_index,report_index,printthread_index,post_codeblock,post_phpblock,faq_index_tree';
	else
		$change = '';
	
	$delete = '';
	
	$new = 'login_account_redirect,logout_account_redirect,invalid_pm';
	
	$admin_change = 'templates_index,admin_index,edit_template,configuration_index,users_index,styles_index,dpcode_index,edit_dpcode,edit_user,add_user,articles_index,edit_article,adminlog_index,maintenance_index,mod_index,modlog_index,view_user,viewusers_index,add_announcement,edit_announcement,revert_template,masspm_users,header,redirect_header';

	$admin_delete = '';
	
	$admin_new = 'image_missing,post_codeblock,post_phpblock';
	
	db_query("truncate parsedtemplate");
	selective_import(1, $admin_new, $admin_change, $admin_delete);
	$query = db_query("select * from templateset where templatesetid>1");
	while ($tset = db_fetch_array($query))
		selective_import($tset['templatesetid'], $new, $change, $delete);
	
	redirect("u200rc1.php?op=4");
}
elseif ($_REQUEST['op']==4)
{
	echo 'Step 4: Updating user groups';
	if (!is_numeric($start))
		$start = 0;
	$query = db_query("select userid from user where userid>$start order by userid asc limit 500");
	$i = 0;
	$lastid = 0;
	while ($user = db_fetch_array($query))
	{
		unset($groups);
		$query2 = db_query("select groupid from usergroups where userid=$user[userid]");
		while ($usergroup = db_fetch_array($query2))
			$groups[] = $usergroup['groupid'];
		db_query("update user set usergroups='".implode(',', $groups)."' where userid=$user[userid]");
		$i++;
		$lastid = $user['userid'];
	}
	if ($i==500)
	{
		echo "<br /><br />Updated through user $lastid";
		redirect("u200rc1.php?op=4&start=$lastid");
	}
	else
	{
		echo "<br /><br />Finished updating users";
		db_query("drop table usergroups");
		db_query("update config set version='2.0.0 RC 1'");
		redirect("upgrade.php");
	}
}

print_footer();
?>