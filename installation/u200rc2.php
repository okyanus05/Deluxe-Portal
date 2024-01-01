<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Release Candidate 1 -> Release Candidate 2");

db_connect();
db_select_db();

echo 'Upgrading from 2.0.0 Release Candidate 1 to 2.0.0 Release Candidate 2<br />';
	
if (!$_REQUEST['op'])
{
	echo 'Step 1: Altering database<br /><br />';
	db_query("alter table styleset add charset char(255) not null");
	db_query("update styleset set charset='ISO-8859-1'");
	db_query("alter table search modify type enum ('post','title','postasthread')");
	db_query("alter table config add attachment_image_types char(255) not null");
	db_query("update config set attachment_image_types='image/bmp image/gif image/jpeg image/pjpeg image/png'");
	
	db_query("update style set extra=CONCAT(extra,'\nfieldset td {white-space:nowrap; vertical-align:middle;}\nfieldset td.small {width:80px;}\n.displayNone {display:none}')");
	db_query("update stylecss set selector='select, optgroup' where selector='select'");
	db_query("update stylecss set fontfamily=CONCAT(fontfamily,',sans-serif') where fontfamily!='' and !INSTR(fontfamily,'sans-serif')");
	db_query("update faqitem set content='DP Code is the safe way to add formatting to your posts without using HTML. For example, you could use <b>[b]Text[/b]</b> to make \"Text\" <b>bold</b>. Here is a list of the DP Code set up on this site:<br />\n<?php\n\$faqquery = db_query(\'select * from dpcode order by tag asc\');\n\$dpcode_list = \'\';\nwhile (\$dpcode = db_fetch_array(\$faqquery))\n{\n	\$dpcode[\'parsed_example\'] = dpcode_parse(\$dpcode[\'example\'], true);\n	\$dpcode_list .= \"<br />\n<table class=\\\\\"tableline\\\\\" cellspacing=\\\\\"\$style[cellspacing]\\\\\" cellpadding=\\\\\"\$style[cellpadding]\\\\\" width=\\\\\"100%\\\\\">\n<tr>\n<td class=\\\\\"cellalt\\\\\"><b>[\$dpcode[tag]]</b><br />\n<br />\n\$dpcode[description]<br />\n<br />\n<b>Example:</b> \$dpcode[example] becomes \$dpcode[parsed_example]</td>\n</tr>\n</table>\";\n}\n?>\n<if \$dpcode_list>\$dpcode_list\n<br />\n</if><table class=\"tableline\" cellspacing=\"\$style[cellspacing]\" cellpadding=\"\$style[cellpadding]\" width=\"100%\">\n<tr>\n<td class=\"cellalt\"><b>[code]</b><br />\n<br />\nThis is used to display code or monospaced text. If you would like line numbers to be added automatically, use <b>[code=num]</b>.<br />\n<br />\n<b>Example:</b> [code]This text is monospaced[/code] becomes <blockquote><div class=\"small\">Code:</div><div><hr /><pre style=\"white-space: pre; font:12px Courier New; margin:0; padding:0;\">This text is monospaced</pre><hr /></div></blockquote></td>\n</tr>\n</table><br />\n<table class=\"tableline\" cellspacing=\"\$style[cellspacing]\" cellpadding=\"\$style[cellpadding]\" width=\"100%\">\n<tr>\n<td class=\"cellalt\"><b>[html]</b><br />\n<br />\nThis is used to display HTML code with syntax highlighting. By default, line numbers are automatically added. To remove the line numbers, use <b>[html=nonum]</b>.<br />\n<br />\n<b>Example:</b> [html]&lt;b&gt;Bold&lt;/b&gt; text[/html] becomes <blockquote><div class=\"small\">HTML Code:</div><hr /><div style=\"color:black; white-space: pre; font-family:\'courier new\',courier,serif; font-size:12px\">1.&nbsp;<span style=\"color: darkblue\">&lt;b&gt;</span>Bold<span style=\"color: darkblue\">&lt;/b&gt;</span> text<br /></div><hr /></blockquote></td>\n</tr>\n</table><br />\n<table class=\"tableline\" cellspacing=\"\$style[cellspacing]\" cellpadding=\"\$style[cellpadding]\" width=\"100%\">\n<tr>\n<td class=\"cellalt\"><b>[php]</b><br />\n<br />\nThis is used to display PHP code with syntax highlighting. By default, line numbers are automatically added. To remove the line numbers, use <b>[php=nonum]</b>.<br />\n<br />\n<b>Example:</b> [php]echo \"Hello, \".\\\\\$username;[/php] becomes <blockquote><div class=\"small\">PHP:</div><div><hr /><pre style=\"white-space: pre; font:12px Courier New; margin:0; padding:0;\"><span style=\"background-color:transparent;\" class=\"cellmain\">1.</span>&nbsp;<code><span style=\"color:#000000;\"></span><span style=\"color:#007700;\">echo </span><span style=\"color:#DD0000;\">\"Hello, \"</span><span style=\"color:#007700;\">.</span><span style=\"color:#0000BB;\">\\\\\$username</span><span style=\"color:#007700;\">;</span><span style=\"color:#FF9900;\"></span></code><br /></pre><hr /></div></blockquote></td>\n</tr>\n</table>' where name='What is DP Code?'");
	db_query("update faqitem set content='WYSIWYG, or What You See Is What You Get, is an exciting new way of posting. Instead of having to use a boring old text box to type your posts into, and having to type out DP Code tags to provide formatting, the new WYSIWYG input control allows you to post as if you were using a program such as Microsoft Word. Want to make text bold? Just click the <b>B</b> (bold) icon in the toolbar. Same goes for smilies. Once you see WYSIWYG, you won\'t want to post any other way!\n\nWYSIWYG only works in Internet Explorer 5.5 or higher for Windows, and Mozilla 1.3 or higher across any platform. If WYSIWYG works on your computer, you will see a box below, with a toolbar directly above it. Try it out!<br /><br />\n<form action=\"faq.php\" method=\"post\">\n<div class=\"center\">\n<script type=\"text/javascript\">\n<!--\ndocument.write(\'<div style=\"display:none\" id=\"messageDiv\"><iframe id=\"messageIframe\"></iframe></div>\');\n//-->\n</script>\n<textarea name=\"message\" id=\"message\" rows=\"10\" cols=\"80\"></textarea></div>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg.js\"></script>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg_en.js\"></script>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg_dialog.js\"></script>\n<script type=\"text/javascript\">\n<!--\ngenerate_wysiwyg(\'message\');\n-->\n</script>\n</form>' where name='What is WYSIWYG?'");
	
	db_query("update post set message=replace(message,'\xC2\xA0','')");
	db_query("update article set body=replace(body,'\xC2\xA0','')");
	db_query("update announcement set body=replace(body,'\xC2\xA0','')");
	db_query("update privatemessage set message=replace(message,'\xC2\xA0','')");
	db_query("update user set uncached_signature=replace(uncached_signature,'\xC2\xA0','')");
	redirect("u200rc2.php?op=2&template_edit=$template_edit");
}
elseif ($_REQUEST['op']==2)
{
	echo 'Step 2: Setting up templates<br /><br />';
	
	if ($template_edit)
		$change = 'main_article,redirect_header,header,footer,register_index,register_account,forum_index,profile_index,forumdisplay_index,thread_index,newthread_index,newreply_index,editpost_index,ip_index,editprofile_index,editoptions_index,password_index,moderate_delete_thread,edit_thread,delete_thread,delete_post,pm_index,leaders_group,newpm_index,readpm_index,user_subscribed_thread,moderate_copymove,search_index,add_poll,reset_poll,edit_poll,search_results,remind_password,announcement_announcement,newthreads_index,replies_user,popup_header,smilie_index,printthread_index,printthread_post,moderate_delete_redirect,forumjump,post_codeblock,post_phpblock,email_form,faq_index_tree';
	else
		$change = '';
	
	$delete = '';
	
	$new = 'email_missing,pm_delete,poll_options,post_htmlblock';
	
	$admin_change = 'templates_index,admin_index,delete_template,edit_template,configuration_index,forums_index,groups_index,edit_group,delete_group,users_index,icons_index,styles_index,edit_icon,delete_icon,titles_index,edit_title,delete_title,users_search_result,users_search,delete_forum,edit_forum,dpcode_index,edit_dpcode,delete_dpcode,smilies_index,edit_smilie,delete_smilie,edit_user,delete_user,add_user,stylesets_index,moderators_index,add_moderator,delete_moderator,edit_moderator,fields_index,edit_field,delete_field,topics_index,edit_topic,delete_topic,delete_section,edit_section,sections_index,articles_article,articles_index,edit_article,delete_article,edit_styleset,delete_styleset,forumperm_index,downloads_index,edit_download_category,delete_download_category,add_download,edit_download,delete_download,add_link,delete_link_category,delete_link,links_index,edit_link,edit_link_category,adminlog_index,adminlog_adminlog,delete_style,forumperm_edit,groupchanger_index,edit_rule,delete_rule,maintenance_index,mod_index,modlog_log,modlog_index,view_user,ban_user,ban_user_redirect,announcements_index,add_announcement,delete_announcement,edit_announcement,edit_templateset,add_style,revert_style,revert_templateset,delete_templateset,revert_template,add_templateset,massmove_index,massdelete_index,massdelete_users,massmail_users,check_ip,check_ip_results,masspm_users,header,footer,group_choice,redirect_header,import_templateset,forumperm_reset,forumperm_deny,add_forum,add_rule,add_group,faqmanager_index,add_faq,edit_faq,delete_faq,add_faq_category,edit_faq_category,delete_faq_category,add_faq_item,edit_faq_item,delete_faq_item,tasks_index,edit_task,delete_task,tasks_show_log,tasks_log,prune_task_log,run_task,add_download_category,add_link_category,add_section,add_topic,styles_category,smilie_column,post_codeblock,post_phpblock';

	$admin_delete = 'viewusers_index,viewusers_user,viewusers_search,viewusers_search_result,check_ip_results_mod,check_ip_mod';
	
	$admin_new = 'modusers_index,modusers_user,modusers_search,modusers_search_result,mod_check_ip_results,mod_check_ip,register_account_comma,account_illegal_name,post_htmlblock';
	
	db_query("truncate parsedtemplate");
	selective_import(1, $admin_new, $admin_change, $admin_delete);
	$query = db_query("select * from templateset where templatesetid>1");
	while ($tset = db_fetch_array($query))
		selective_import($tset['templatesetid'], $new, $change, $delete);
	
	db_query("update config set version='2.0.0 RC 2'");
	redirect("upgrade.php");
}

print_footer();
?>