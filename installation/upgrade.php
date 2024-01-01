<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Upgrader");

db_connect();
db_select_db();
$config = db_fetch_array(db_query('select * from config'));

if ($config['version']=='2.0.0 Alpha 3')
{
	echo 'Deluxe Portal 2.0.1 Upgrade Script (Alpha 3 -> Beta 1)</b><br />';
	echo '<br />';
	echo '<form action="u200b1.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"import_icons\" type=\"checkbox\" value=\"1\" /> <b>Continue using old icons</b></td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><input name=\"import_smilies\" type=\"checkbox\" value=\"1\" /> <b>Continue using old smilies</b></td>";
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
elseif ($config['version']=='2.0.0 Beta 1')
{
	echo 'Deluxe Portal 2.0.1 Upgrade Script (Beta 1 -> Beta 2)</b><br />';
	echo '<br />';
	echo '<form action="u200b2.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"revert_styles\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Revert Dark, Mac, and Light styles</b></td>";
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
elseif ($config['version']=='2.0.0 Beta 2')
{
	$change = 'main_index, main_article, admin_index, redirect_header, user_index, permission_error, login_account_failed, header, footer, message_footer, register_account, configuration_index, forum_index, forums_index, profile_index, groups_index, edit_group, users_index, forumdisplay_index, forumdisplay_thread, icons_index, thread_index, thread_post, newthread_index, moderator, newreply_index, forumnav_link, editpost_index, edit_post_redirect, edit_icon, titles_index, edit_title, edit_forum, dpcode_index, edit_dpcode, smilies_index, edit_smilie, edit_user, add_user, editprofile_index, editoptions_index, password_index, memberlist_member, stylesets_index, close_thread_redirect, sticky_thread_redirect, add_moderator, fields_index, edit_field, topics_index, edit_topic, articles_index, edit_article, newpm_index, readpm_index, email_hidden, leaders_moderator, add_ignored_user_redirect, add_buddy_redirect, forumperm_index, add_link, link_showcategory, pagenav_first, pagenav_last, pagenav_link, pagenav_next, pagenav_prev, article_index, forumperm_edit, groupchanger_index, edit_rule, forumjump_forum, maintenance_index, search_index, add_poll, poll_result, edit_poll, mod_index, delete_poll_redirect, view_user, moderate_whovoted_result, add_announcement, announcement_index, announcement_announcement, edit_announcement, forumnav_nolink, nav_header, newthreads_thread, massmove_done, massdelete_done, massmail_users, smilie_column, smilie_box, faq_posting, moderate_delete_redirect, moderate_no_redirect, delete_redirect_redirect, markread_forum_redirect, forumjump, maintenance_imagestore, image_missing, announcements_date, login_account_password, login_account_attempts, post_codeblock, post_phpblock, massmail_users_continue, email_form, email_send_redirect, register_account_comma, masspm_users, masspm_users_continue, masspm_users_redirect.';
	$delete = 'thread_pagenav_link, thread_pagenav_first, thread_pagenav_last, thread_pagenav_prev, thread_pagenav_next, forumdisplay_pagenav_first, forumdisplay_pagenav_last, forumdisplay_pagenav_link, forumdisplay_pagenav_next, forumdisplay_pagenav_prev, memberlist_pagenav_first, memberlist_pagenav_link, memberlist_pagenav_next, memberlist_pagenav_last, memberlist_pagenav_prev, thread_moderator_options, open_thread_redirect, unstick_thread_redirect, stick_thread_redirect, thread_post_ignored, thread_poll, edit_poll_missing, modlog_pagenav_first, modlog_pagenav_last, modlog_pagenav_link, modlog_pagenav_next, modlog_pagenav_prev, thread_attachment, thread_attachment_image, preview_index, article_pagenav_first, article_pagenav_last, article_pagenav_link, article_pagenav_next, article_pagenav_prev, maintenance_templates_option, dp_info.';
	echo 'Deluxe Portal 2.0.1 Upgrade Script (Beta 2 -> Beta 3)</b><br />';
	echo '<br />';
	echo '<form action="u200b3.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"template_delete\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Delete unneeded templates:</b><br />$delete</td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><input name=\"template_edit\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Update templates changed in this release:</b><br />$change</td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><input name=\"group_display\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Use updated username display for the Users group</b></td>";
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
elseif ($config['version']=='2.0.0 Beta 3')
{
	$change = 'main_index, main_article, redirect_header, user_index, permission_error, header, footer, register_index, register_account, forum_index, profile_index, forum_forum_parent, forum_forum, forumdisplay_index, forumdisplay_thread, thread_index, thread_post, newthread_index, forumdisplay_forum, newreply_index, editpost_index, icon_column, ip_index, option_indention, smilie, forumdisplay_multipage_last, editprofile_index, editoptions_index, memberlist_index, close_thread_redirect, moderate_delete_thread, edit_thread, delete_thread, delete_post, pm_index, leaders_group, leaders_user, pm_message, newpm_index, forum_forum_parent_canpost, readpm_index, email_hidden, leaders_moderator, user_ignored_user, add_buddy_redirect, user_buddy, topic_index, topic_showtopic, section_index, section_showsection, section_section, download_index, download_showcategory, download_download, link_showcategory, link_link, link_index, pagenav, pagenav_first, pagenav_last, pagenav_link, pagenav_next, pagenav_prev, article_index, unsubscribe_thread_redirect, unsubscribe_email_redirect, user_subscribed_forum, unsubscribe_forum_redirect, moderate_copymove, forumdisplay_thread_redirect, online_index, online_user, search_index, add_poll, thread_poll_vote, reset_poll, moderate_poll_option, search_results, search_result_post, search_result_ignored, search_length, forumdisplay_announcement, announcement_announcement, activate_account_invalid, nav_header, newreply_post, newthreads_index, rules, replies_user, popup_header, replies_index, mail_emailreverify, search_result_article_full, search_result_article, smilie_column, smilie_box, smilie_index, send_pm_failed, report_index, unsubscribe_threads, unsubscribe_emails, printthread_index, printthread_pagenav, printthread_post, moderate_delete_redirect, forumjump, login_account_password, login_account_attempts, post_codeblock, post_phpblock, main_date, icon_row, icon_table, printthread_poll_result, server_busy, server_busy_guest, editprofile_signature, forum_forum_subforum, forumdisplay_forum_subforum, faq_index, faq_category, faq_item, invalid_faq, faq_show_category, faq_toc, faq_item_contents, faq_item_tree, faq_category_tree, faq_index_tree, faq_show_category_tree, server_busy_search, register_account_imageverify, invalid_page, add_ignored_user_redirect.';
	$delete = 'templates_index, admin_index, logout_redirect, login_account_redirect, templates_category, templates_template, add_template_redirect, templates_missing, delete_template, delete_template_redirect, edit_template, templates_duplicate, edit_template_redirect, configuration_index, edit_configuration_redirect, forums_index, groups_index, groups_group, groups_duplicate, add_group_redirect, groups_missing, edit_group, edit_group_redirect, delete_group, delete_group_redirect, delete_group_denied, users_index, icons_index, post_thread_redirect, post_reply_redirect, edit_post_redirect, styles_index, icons_missing, add_icon_redirect, icons_icon, edit_icon, edit_icon_redirect, delete_icon, delete_icon_redirect, invalid_icon, icon_choice, titles_index, edit_title, add_title_redirect, titles_title, titles_group, group_choice, invalid_title, titles_duplicate, edit_title_redirect, titles_missing, delete_title, delete_title_redirect, users_search_result, users_search, forums_forum, indent, delete_forum, delete_forum_redirect, add_forum_redirect, forums_missing, edit_forum, edit_forum_redirect, dpcode_index, dpcode_duplicate, add_dpcode_redirect, dpcode_dpcode, edit_dpcode, dpcode_missing, edit_dpcode_redirect, delete_dpcode, delete_dpcode_redirect, smilies_index, smilies_smilie, add_smilie_redirect, smilies_missing, edit_smilie, edit_smilie_redirect, delete_smilie, invalid_smilie, delete_smilie_redirect, edit_user, users_duplicate, edit_user_redirect, delete_user, delete_user_redirect, users_user, add_user, users_missing, users_password, add_user_redirect, edit_style_redirect, stylesets_index, templateset_choice, style_choice, stylesets_styleset, stylesets_missing, moderators_index, moderators_moderator, moderators_forum, add_moderator, add_moderator_redirect, invalid_moderator, delete_moderator, delete_moderator_redirect, edit_moderator, edit_moderator_redirect, fields_index, fields_duplicate, add_field_redirect, fields_field, edit_field, edit_field_redirect, fields_missing, delete_field, delete_field_redirect, invalid_customfield, usergroup_choice, topics_topic, add_topic_redirect, topics_missing, topics_index, edit_topic, edit_topic_redirect, delete_topic, delete_topic_redirect, viewgroup_choice, editowngroup_choice, editothersgroup_choice, deleteowngroup_choice, deleteothersgroup_choice, postgroup_choice, topics_duplicate, sections_duplicate, templates_separator, delete_section_redirect, delete_section, edit_section, edit_section_redirect, sections_section, sections_index, sections_missing, add_section_redirect, articles_article, articles_index, articles_missing, add_article_redirect, edit_article, edit_article_redirect, delete_article, delete_topic_denied, delete_section_denied, delete_article_redirect, guestgroup_choice, forum_online, add_styleset_redirect, stylesets_duplicate_templateset, stylesets_duplicate, edit_styleset, edit_styleset_redirect, delete_styleset, delete_styleset_denied, delete_styleset_redirect, forum_pm, moderators_duplicate, archive_messages_redirect, delete_messages_redirect, delete_buddy_redirect, delete_ignored_user_redirect, forumperm_index, forumperm_forum, downloads_index, downloads_category, add_download_category_redirect, downloads_category_missing, edit_download_category, edit_download_category_redirect, delete_download_category_denied, delete_download_category, delete_download_category_redirect, add_download_redirect, add_download, edit_download, edit_download_redirect, downloads_missing, delete_download, delete_download_redirect, downloadcategory_choice, downloads_download, add_link, add_link_category_redirect, add_link_redirect, delete_link_category_denied, delete_link_category_redirect, delete_link_category, delete_link_redirect, delete_link, links_category, linkcategory_choice, links_link, links_index, edit_link, edit_link_category, links_category_missing, edit_link_category_redirect, links_missing, edit_link_redirect, invalid_download, invalid_link, adminlog_index, adminlog_adminlog, styles_duplicate, invalid_style, delete_style, delete_style_denied, delete_style_redirect, forumperm_group, forumperm_end, forumperm_edit, invalid_forumperm, edit_forumperm_redirect, groupchanger_index, ingroup_choice, addgroup_choice, removegroup_choice, groupchanger_duplicate, add_rule_redirect, groupchanger_rule, invalid_dpcode, edit_rule, edit_rule_redirect, delete_rule, invalid_grouprule, delete_rule_redirect, maintenance_index, maintenance_threads, maintenance_users, faq_usercp, add_poll_redirect, vote_poll_redirect, mod_index, modlog_log, modlog_index, view_user, viewusers_index, viewusers_user, viewusers_search, viewusers_search_result, ban_user, ban_user_redirect, announcements_index, announcements_announcement, announcements_forum, search_pagenav_first, search_pagenav_last, search_pagenav_link, search_pagenav_next, search_pagenav_prev, add_announcement, announcements_missing, add_announcement_redirect, invalid_announcement, delete_announcement, delete_announcement_redirect, edit_announcement, edit_announcement_redirect, downloads_duplicate_category, links_duplicate_category, groupchanger_missing, invalid_addon, maintenance_usernames, emailgroup_choice, run_rule_redirect, edit_templateset, templates_duplicate_templateset, edit_templateset_redirect, templates_templateset_missing, add_style, styles_missing, add_style_redirect, style_default_invalid, style_import_invalid, revert_style, revert_style_redirect, invalid_templateset, revert_templateset, templateset_import_invalid, revert_templateset_redirect, delete_templateset_denied, delete_templateset, delete_templateset_redirect, revert_template, invalid_template, revert_template_redirect, import_template_missing, add_templateset, add_templateset_redirect, massmove_index, option_nomoving, massmove_done, massdelete_done, forum_nodeleting, massdelete_index, massdelete_users_redirect, massdelete_users, massmail_users, massmail_users_redirect, mass_number, check_ip, check_ip_result, check_ip_results, check_ip_results_mod, check_ip_mod, faq_posting, faq_smilie, faq_dpcode, faq_pm, logout_user_redirect, replace_templates_redirect, markread_allforums_redirect, maintenance_templates, markread_forum_redirect, maintenance_imagestore, announcements_date, massmail_users_continue, masspm_users, masspm_users_continue, masspm_users_redirect.';
	echo 'Deluxe Portal 2.0.1 Upgrade Script (Beta 3 -> Beta 4)</b><br />';
	echo '<br />';
	echo '<form action="u200b4.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"styleset_delete\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Delete old style sets</b></td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><input name=\"template_delete\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Delete unneeded templates:</b><br />$delete</td>";
	echo '</tr>';
	echo '<tr>';
	echo "<td><input name=\"template_edit\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Update templates changed in this release:</b><br />$change</td>";
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
elseif ($config['version']=='2.0.0 Beta 4')
{
	$change = 'redirect_header, permission_error, header, register_index, register_account, forum_forum, forumdisplay_index, forumdisplay_thread, thread_index, thread_post, newthread_index, forumdisplay_forum, newreply_index, editpost_index, editprofile_index, editoptions_index, memberlist_member, memberlist_index, newpm_index, forum_forum_parent_canpost, readpm_index, search_index, search_results, account_illegal_name, announcement_announcement, popup_header, smilie_column, smilie_index, report_index, printthread_index, post_codeblock, post_phpblock, faq_index_tree.';
	$delete = '';
	echo 'Deluxe Portal 2.0.1 Upgrade Script (Beta 4 -> Release Candidate 1)</b><br />';
	echo '<br />';
	echo '<form action="u200rc1.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"template_edit\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Update templates changed in this release:</b><br />$change</td>";
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
elseif ($config['version']=='2.0.0 RC 1')
{
	$change = 'main_article, redirect_header, header, footer, register_index, register_account, forum_index, profile_index, forumdisplay_index, thread_index, newthread_index, newreply_index, editpost_index, ip_index, editprofile_index, editoptions_index, password_index, moderate_delete_thread, edit_thread, delete_thread, delete_post, pm_index, leaders_group, newpm_index, readpm_index, user_subscribed_thread, moderate_copymove, search_index, add_poll, reset_poll, edit_poll, search_results, remind_password, announcement_announcement, newthreads_index, replies_user, popup_header, smilie_index, printthread_index, printthread_post, moderate_delete_redirect, forumjump, post_codeblock, post_phpblock, email_form, faq_index_tree.';
	$delete = '';
	echo 'Deluxe Portal 2.0.1 Upgrade Script (Release Candidate 1 -> Release Candidate 2)</b><br />';
	echo '<br />';
	echo '<form action="u200rc2.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"template_edit\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Update templates changed in this release:</b><br />$change</td>";
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
elseif ($config['version']=='2.0.0 RC 2')
{
	$change = 'footer, register_account, editoptions_index.';
	$delete = '';
	echo 'Deluxe Portal 2.0.1 Upgrade Script (Release Candidate 2 -> Release Candidate 3)</b><br />';
	echo '<br />';
	echo '<form action="u200rc3.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"template_edit\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Update templates changed in this release:</b><br />$change</td>";
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
elseif ($config['version']=='2.0.0 RC 3')
{
	$change = 'header.';
	$delete = '';
	echo 'Deluxe Portal 2.0.1 Upgrade Script (Release Candidate 3 -> 2.0.0)</b><br />';
	echo '<br />';
	echo '<form action="u201.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"template_edit\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Update templates changed in this release:</b><br />$change</td>";
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
elseif ($config['version']=='2.0.0')
{
	$change = 'footer, forum_forum, forumdisplay_forum, printthread_index.';
	$delete = '';
	echo 'Deluxe Portal 2.0.0 Upgrade Script (2.0.0 -> 2.0.1)</b><br />';
	echo '<br />';
	echo '<form action="u201.php" method="post">';
	echo '<div class="center"><table class="tableline" cellspacing="1" cellpadding="4">';
	echo '<tr>';
	echo '<td class="tableheader" colspan="2">Upgrade Options</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cellmain"><table cellspacing="0" cellpadding="4">';
	echo '<tr>';
	echo '<td><table class="cellmain" cellpadding="4">';
	echo '<tr>';
	echo "<td><input name=\"template_edit\" type=\"checkbox\" value=\"1\" checked=\"checked\" /> <b>Update templates changed in this release:</b><br />$change</td>";
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
elseif ($config['version']=='2.0.1')
{
	echo 'Upgrade Complete!<br />';
	echo '<br />';
	echo 'The upgrade is complete! <a href="../index.php">Click here</a> to go to your site. Be sure to delete the "installation" folder!';
}

print_footer();
?>