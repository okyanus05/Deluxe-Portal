<?php /*
a:340:{s:15:"templates_index";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:3586:"<include template="header" />
<script type="text/javascript" src="tree.js"></script>
<script type="text/javascript" src="tree_tpl.js"></script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Templates</b><br />
<br />
<table cellspacing="5">
<tr>
<td colspan="2"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><form action="templates.php" method="post" style="margin:0">
<div><input type="hidden" value="$current_templateset" name="current_templateset" />
<b>Template set: </b><select name="current_templateset" onchange="window.location='templates.php?search=$search&amp;current_templateset='+this.options[this.selectedIndex].value">$templatesets</select> - <b>Search:</b> <input id="search" name="search" type="text" /> <input type="submit" value="Search" /> - <a href="templates.php?op=addset&amp;current_templateset=$current_templateset&amp;search=$search">Add</a> - <a href="templates.php?op=deleteset&amp;current_templateset=$current_templateset&amp;search=$search">Delete</a> - <a href="templates.php?op=editset&amp;current_templateset=$current_templateset&amp;search=$search">Edit</a> - <a href="templates.php?op=export&amp;current_templateset=$current_templateset&amp;search=$search">Export</a>
- <a href="templates.php?op=import&amp;current_templateset=$current_templateset&amp;search=$search">Import</a> - <a href="templates.php?op=revertset&amp;current_templateset=$current_templateset&amp;search=$search">Revert</a>
</div></form></td>
</tr>
</table></td>
</tr>
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><if $search><form style="margin:0" action="templates.php" method="post">
<div><input type="hidden" value="$current_templateset" name="current_templateset" />
<input type="hidden" value="replace" name="op" />
<input type="hidden" value="$search" name="search" />
<span class="small">Searching for <b>$searchterms</b> -</span> <a class="linksmall" href="templates.php?current_templateset=$current_templateset">Reset search</a><br />
<span class="small">Replace with:</span> <input name="replace" type="text" class="small" size="10" /> <input class="small" type="submit" value="Replace" /></div>
</form></if><script type="text/javascript">
<!--
var TREE_ITEMS = [['<b>$templateset_name</b>', null, $template_categories]];
new tree (TREE_ITEMS, tree_tpl);
//-->
</script></td>
</tr>
</table></td>
<td><form action="templates.php" method="post"><div><input name="op" type="hidden" value="add" />
<input name="current_templateset" type="hidden" value="$current_templateset" />
<input name="search" type="hidden" value="$search" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Template</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain">
<tr>
<td><b>Name:</b></td>
<td><input size="70" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Category:</b></td>
<td><input size="70" name="category" type="text" /></td>
</tr>
<tr>
<td><b>Content:</b></td>
<td><textarea rows="20" style="width:99%" cols="80" name="body" class="monospaced"></textarea></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Template" /></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table></form></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073709100";}s:11:"admin_index";a:4:{s:8:"category";s:8:"Admin CP";s:4:"body";s:8045:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt; Administrator Control Panel</b><br />
<br />
<if $installation_dir><span style="color: red"><b>Please remove the installation directory from your server immediately! Leaving it up is a security risk!</b></span><br />
<br /></if>
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Administrator Control Panel</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain" cellpadding="16">
<tr>
<td><div class="center"><a class="linksmall" href="adminlog.php"><img alt="Admin Log" src="$style[images]/adminlog.gif" />
<br />
Admin Log</a></div></td>
<td><div class="center"><a class="linksmall" href="$relativeurl/$modcp_dir/announcements.php"><img alt="Announcements" src="$style[images]/announcements.gif" />
<br />
Announcements</a></div></td>
<td><div class="center"><a class="linksmall" href="articles.php"><img alt="Articles" src="$style[images]/articles.gif" />
<br />
Articles</a></div></td>
<td><div class="center"><a class="linksmall" href="configuration.php"><img alt="Configuration" src="$style[images]/configuration.gif" />
<br />
Configuration</a></div></td>
<td><div class="center"><a class="linksmall" href="fields.php"><img alt="Custom Profile Fields" src="$style[images]/customfields.gif" />
<br />
Custom Fields</a></div></td>
<td><div class="center"><a class="linksmall" href="downloads.php"><img alt="Downloads" src="$style[images]/downloads.gif" />
<br />
Downloads</a></div></td>
</tr>
<tr>
<td><div class="center"><a class="linksmall" href="dpcode.php"><img alt="DP Code" src="$style[images]/dpcode.gif" />
<br />
DP Code</a></div></td>
<td><div class="center"><a class="linksmall" href="faqmgr.php"><img alt="FAQ Manager" src="$style[images]/faq.gif" />
<br />
FAQ Manager</a></div></td>
<td><div class="center"><a class="linksmall" href="forumperm.php"><img alt="Forum Permissions" src="$style[images]/forumperm.gif" />
<br />
Forum Permissions</a></div></td>
<td><div class="center"><a class="linksmall" href="forums.php"><img alt="Forums" src="$style[images]/forums.gif" />
<br />
Forums</a></div></td>
<td><div class="center"><a class="linksmall" href="groupchanger.php"><img alt="Group Changer" src="$style[images]/groupchanger.gif" />
<br />
Group Changer</a></div></td>
<td><div class="center"><a class="linksmall" href="groups.php"><img alt="Groups" src="$style[images]/groups.gif" />
<br />
Groups</a></div></td>
</tr>
<tr>
<td><div class="center"><a class="linksmall" href="$relativeurl/faq.php?faq=adminfaq"><img alt="Help" src="$style[images]/help.gif" />
<br />
Help</a></div></td>
<td><div class="center"><a class="linksmall" href="icons.php"><img alt="Icons" src="$style[images]/icons.gif" />
<br />
Icons</a></div></td>
<td><div class="center"><a class="linksmall" href="links.php"><img alt="Links" src="$style[images]/links.gif" />
<br />
Links</a></div></td>
<td><div class="center"><a class="linksmall" href="maintenance.php"><img alt="Maintenance" src="$style[images]/maintenance.gif" />
<br />
Maintenance</a></div></td>
<td><div class="center"><a class="linksmall" href="$relativeurl/$modcp_dir/delete.php"><img alt="Mass Delete" src="$style[images]/massdelete.gif" />
<br />
Mass Delete</a></div></td>
<td style="white-space: nowrap"><div class="center"><a class="linksmall" href="$relativeurl/$modcp_dir/move.php"><img alt="Mass Move" src="$style[images]/massmove.gif" />
<br />
Mass Move</a></div></td>
</tr>
<tr>
<td><div class="center"><a class="linksmall" href="$relativeurl/$modcp_dir/modlog.php"><img alt="Moderator Log" src="$style[images]/adminlog.gif" />
<br />
Moderator Log</a></div></td>
<td><div class="center"><a class="linksmall" href="moderators.php"><img alt="Moderators" src="$style[images]/moderators.gif" />
<br />
Moderators</a></div></td>
<td><div class="center"><a class="linksmall" href="tasks.php"><img alt="Scheduled Tasks" src="$style[images]/tasks.gif" />
<br />
Scheduled Tasks</a></div></td>
<td><div class="center"><a class="linksmall" href="sections.php"><img alt="Sections" src="$style[images]/sections.gif" />
<br />
Sections</a></div></td>
<td><div class="center"><a class="linksmall" href="smilies.php"><img alt="Smilies" src="$style[images]/smilies.gif" />
<br />
Smilies</a></div></td>
<td><div class="center"><a class="linksmall" href="stylesets.php"><img alt="Style Sets" src="$style[images]/stylesets.gif" />
<br />
Style Sets</a></div></td>
</tr>
<tr>
<td><div class="center"><a class="linksmall" href="styles.php"><img alt="Styles" src="$style[images]/styles.gif" />
<br />
Styles</a></div></td>
<td><div class="center"><a class="linksmall" href="templates.php"><img alt="Templates" src="$style[images]/templates.gif" />
<br />
Templates</a></div></td>
<td><div class="center"><a class="linksmall" href="titles.php"><img alt="Titles" src="$style[images]/titles.gif" />
<br />
Titles</a></div></td>
<td><div class="center"><a class="linksmall" href="topics.php"><img alt="Topics" src="$style[images]/topics.gif" />
<br />
Topics</a></div></td>
<td><div class="center"><a class="linksmall" href="<if !$group[users]>$relativeurl/$modcp_dir/</if>users.php"><img alt="Users" src="$style[images]/users.gif" />
<br />
Users</a></div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table><br />
<br />
<form action="<if !$group[users]>$relativeurl/$modcp_dir/</if>users.php" method="post">
<div><input name="all_groups" type="hidden" value="1" />
<input name="op" type="hidden" value="search" />
<input name="maxposts" type="hidden" value="4294967296" />
<input name="minjoin" type="hidden" value="1969-12-31" />
<input name="maxjoin" type="hidden" value="2029-12-31" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Deluxe Portal</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0" cellpadding="$style[cellpadding]">
<tr>
<td><table class="cellmain">
<tr>
<td colspan="2"><div class="center"><a href="http://www.deluxeportal.net" onclick="window.open(this.href);return false;"><b>Deluxe Portal Version $config[version]</b></a></div><br /></td>
</tr>
<tr>
<td><b>Project Manager:</b></td><td><a href="http://www.deluxeportal.net/profile.php?id=1" onclick="window.open(this.href);return false;">Andrew Harper</a></td>
</tr>
<tr>
<td><b>Developers:</b></td><td><a href="http://dp.nomative.com/profile.php?id=1" onclick="window.open(this.href);return false;">Andrew Harper</a>, <a href="http://www.deluxeportal.net/profile.php?id=141" onclick="window.open(this.href);return false;">Jeff Lange</a></td>
</tr>
<tr>
<td><b>Graphics/Styles:</b></td><td><a href="http://www.deluxeportal.net/profile.php?id=2" onclick="window.open(this.href);return false;">Shaun Boyland</a>, <a href="http://www.deluxeportal.net/profile.php?id=141" onclick="window.open(this.href);return false;">Jeff Lange</a></td>
</tr>
<tr>
<td><b>Documentation:</b></td><td><a href="http://www.deluxeportal.net/profile.php?id=1" onclick="window.open(this.href);return false;">Andrew Harper</a></td>
</tr>
<if $uptime><tr>
<td><br />
<b>Server load averages:</b></td><td><br />
$uptime</td>
</tr></if>
<if ($config[dp_info] || $group[configuration])><tr>
<td colspan="2" class="center"><if !$uptime><br />
</if><a href="$relativeurl/scripts/dp_info.php"><b>Click here for server information</b></a></td>
</tr></if>
<tr>
<td><br />
<b>Quick user search:</b></td><td><br />
<input name="name" type="text" size="30" />&nbsp;<input type="submit" value="Search" /></td>
</tr>
<if $new_version!=$config[version]><tr>
<td colspan="2"><br />
<b>You are not running running the most recent version of Deluxe Portal. The latest version is $new_version. <a href="http://www.deluxeportal.net/$new_announcement" onclick="window.open(this.href);return false;">Click here for more information.</a></td>
</tr></if>
<include template="form_footer" />
</table></form></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1144549941";}s:18:"templates_category";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:98:"<if $template_categories>,</if>['<span class="small">$previous_category</span>', null, $templates]";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1064380236";}s:18:"templates_template";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:576:"['<span class="small"<if $template_result[custom]> style="color: red"</if>>$template_result[name]</span> <span class="small">[</span><a class="linksmall" href="templates.php?op=edit&amp;id=$template_result[templateid]&amp;search=$search">Edit</a> <span class="small">-</span> <a class="linksmall" href="templates.php?op=delete&amp;id=$template_result[templateid]&amp;search=$search">Delete</a> <span class="small">-</span> <a class="linksmall" href="templates.php?op=revert&amp;id=$template_result[templateid]&amp;search=$search">Revert</a><span class="small">]</span>', null]";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"templates_missing";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:112:"<include template="message_header" />
You must specify a name and content.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"delete_template";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:533:"<include template="message_header" />
Are you sure you want to delete template <b>$template_result[name]</b>?<br />
<br />
<br />
<form action="templates.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$template_result[templateid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='templates.php?current_templateset=$template_result[templatesetid]'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073710001";}s:13:"edit_template";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:4326:"<include template="header" />
<script type="text/javascript" src="tree.js"></script>
<script type="text/javascript" src="tree_tpl.js"></script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="templates.php?current_templateset=$template[templatesetid]&amp;search=$search"><b>Templates</b></a> <b>&gt; Edit Template</b><br />
<br />
<table cellspacing="5">
<tr>
<td colspan="2"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><form action="templates.php" style="margin:0">
<div><input type="hidden" value="$current_templateset" name="current_templateset" />
<b>Template set: </b><select name="current_templateset" onchange="window.location='templates.php?search=$search&amp;current_templateset='+this.options[this.selectedIndex].value">$templatesets</select> - <b>Search:</b> <input id="search" name="search" type="text" /> <input type="submit" value="Search" /> - <a href="templates.php?op=addset&amp;current_templateset=$template[templatesetid]&amp;search=$search">Add</a> - <a href="templates.php?op=deleteset&amp;current_templateset=$template[templatesetid]&amp;search=$search">Delete</a> - <a href="templates.php?op=editset&amp;current_templateset=$template[templatesetid]&amp;search=$search">Edit</a> - <a href="templates.php?op=export&amp;current_templateset=$template[templatesetid]&amp;search=$search">Export</a>
- <a href="templates.php?op=import&amp;current_templateset=$template[templatesetid]&amp;search=$search">Import</a> - <a href="templates.php?op=revertset&amp;current_templateset=$template[templatesetid]&amp;search=$search">Revert</a>
</div></form></td>
</tr>
</table></td>
</tr>
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><if $search><form style="margin:0" action="templates.php">
<div><input type="hidden" value="$current_templateset" name="current_templateset" />
<input type="hidden" value="replace" name="op" />
<input type="hidden" value="$search" name="search" />
<span class="small">Searching for <b>$searchterms</b> -</span> <a class="linksmall" href="templates.php?current_templateset=$template[templatesetid]">Reset search</a><br />
<span class="small">Replace with:</span> <input name="replace" type="text" class="small" size="10" /> <input class="small" type="submit" value="Replace" /></div>
</form></if><script type="text/javascript">
<!--
var TREE_ITEMS = [['<b>$templateset_name</b> <span class="small">[</span><a class="linksmall" href="templates.php?op=add&amp;current_templateset=$template[templatesetid]">Add Template</a><span class="small">]</span>', null, $template_categories]];
new tree (TREE_ITEMS, tree_tpl);
//-->
</script></td>
</tr>
</table></td>
<td>
<form action="templates.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$template[templateid]" />
<input name="current_templateset" type="hidden" value="$template[current_templateset]" />
<input name="search" type="hidden" value="$search" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Template - $template[name]</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain">
<tr>
<td><b>Name:</b></td>
<td><input size="70" name="name" type="text" value="$template[name]" /></td>
</tr>
<tr>
<td><b>Category:</b></td>
<td><input size="70" name="category" type="text" value="$template[category]" /></td>
</tr>
<tr>
<td><b>Content:</b></td>
<td><textarea style="width:99%" rows="20" cols="80" name="body" class="monospaced">$template[body]</textarea></td>
</tr>
<tr>
<td><b>Additional information:</b></td>
<td><ul><li>This template has <if !$template[custom]>not </if>been modified</li>
<if $template[lastedit_username]><li>
This template was last edited by $template[lastedit_username] on $template[lastedit_date]</li></if></ul></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Template" /></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table></form></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073709883";}s:19:"templates_duplicate";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:145:"<include template="message_header" />
A template with that name already exists. Please choose another name.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"configuration_index";a:4:{s:8:"category";s:24:"Admin CP - Configuration";s:4:"body";s:76076:"<include template="header" />
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Configuration</b><br />
<br />
<form action="configuration.php" method="post">
<div class="center">
<input name="op" type="hidden" value="submit" />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" style="width:100%">
<tr>
<td class="tableheader" colspan="3">Configuration</td>
</tr>
<include template="form_header" />
<tr>
<td colspan="3"><table cellpadding="0" cellspacing="0" width="100%">
<tr valign="top">
<td style="width: 33%"><span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('general'); if (doHide) { return false; }" href="#general">General Information</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('open'); if (doHide) { return false; }" href="#open">Open/Closed</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('rules'); if (doHide) { return false; }" href="#rules">Rules</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('user'); if (doHide) { return false; }" href="#user">User Registration</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('guests'); if (doHide) { return false; }" href="#guests">Guests</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('banning'); if (doHide) { return false; }" href="#banning">Banning</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('signatures'); if (doHide) { return false; }" href="#signatures">Signatures</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('useropts'); if (doHide) { return false; }" href="#useropts">User Options</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('forum'); if (doHide) { return false; }" href="#forum">Forum Display</a></td>
<td style="width: 33%"><span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('thread'); if (doHide) { return false; }" href="#thread">Thread Display</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('posting'); if (doHide) { return false; }" href="#posting">Posting</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('sidebar'); if (doHide) { return false; }" href="#sidebar">Sidebar</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('members'); if (doHide) { return false; }" href="#members">Member List</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('articles'); if (doHide) { return false; }" href="#articles">Articles</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('categories'); if (doHide) { return false; }" href="#categories">Category Pages</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('search'); if (doHide) { return false; }" href="#search">Search</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('server'); if (doHide) { return false; }" href="#server">Server Options</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('avatars'); if (doHide) { return false; }" href="#avatars">Avatar Uploads</a></td>
<td style="width: 33%"><span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('messages'); if (doHide) { return false; }" href="#messages">Private Messages</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('attachments'); if (doHide) { return false; }" href="#attachments">Attachments</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('online'); if (doHide) { return false; }" href="#online">Who's Online</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('censoring'); if (doHide) { return false; }" href="#censoring">Censoring</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('logging'); if (doHide) { return false; }" href="#logging">Logging</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('debug'); if (doHide) { return false; }" href="#debug">Debugging</a><br />
<span class="small">&bull;</span> <a class="linksmall" onclick="configShowSection('images'); if (doHide) { return false; }" href="#images">Image Locations</a>
<script type="text/javascript">
<!--

	if (doHide) {
	document.writeln('<br /><span class="small">&bull;</span> <a class="linksmall" href="javascript:showAllSections(previousSection);">Show All</a><br />');
	document.writeln('<span class="small">&bull;</span> <a class="linksmall" href="javascript:hideAllSections(previousSection)">Hide All</a>');
	}
//-->
</script>
</td></tr>
</table></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="generaltable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td class="tableheader" colspan="3"><a name="general"></a>General Information</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Site name:</b><br />
<span class="small">Enter the name of your site here.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="name" type="text" size="60" value="$config[name]" /></td>
</tr>
<tr>
<td><b>Display Forum Description:</b><br />
<span class="small">Display the forum description box at the top of the main forums index</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="show_description" type="radio" value="1"<if $config[show_description]> checked="checked"</if> /> No:<input name="show_description" type="radio" value="0"<if !$config[show_description]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Forums description:</b><br />
<span class="small">Enter a brief description of your forums here.</span></td>
<td colspan="2" style="white-space:nowrap"><textarea class="small" name="description" cols="80" rows="10">$config[description_value]</textarea></td>
</tr>
<tr>
<td><b>URL:</b>
<br />
<div class="small">Enter the full URL (address) of your site here. Be sure to include <b>http://</b>, and do not include a slash at the end.</div>
</td>
<td colspan="2" style="white-space:nowrap"><input name="url" type="text" size="60" value="$config[url]" /></td>
</tr>
<tr>
<td><b>Contact Us:</b><br />
<span class="small">These are the email addresses that are given in the <b>Contact Us</b> link at the bottom of every page. If you would like to use more than one email address for that link, separate the email addresses with semicolons (<b>;</b>).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="contact" type="text" size="60" value="$config[contact]" /></td>
</tr>
<tr>
<td><b>Copyright notice:</b><br />
<span class="small">Enter an optional copyright notice to be displayed at the bottom of every page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="copyright" type="text" size="60" value="$config[copyright_value]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="opentable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td class="tableheader" colspan="3"><a name="open"></a>Open/Closed</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Site closed:</b><br />
<span class="small">If you would like to close the site to the public, you can close the site from here. Anyone with access to this configuration panel will still be able to access the site, even when closed.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="closed" type="radio" value="1"<if $config[closed]> checked="checked"</if> /> No:<input name="closed" type="radio" value="0"<if !$config[closed]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Reason for being closed:</b><br />
<span class="small">When the site is closed, this is the message that is displayed. Normally, you would want this message to have information about why the site is closed, and when it is expected to reopen.</span></td>
<td colspan="2" style="white-space:nowrap"><textarea class="small" name="closed_reason" cols="70" rows="5">$config[closed_reason_value]</textarea></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="rulestable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td class="tableheader" colspan="3"><a name="rules"></a>Rules</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Show rules:</b><br />
<span class="small">If you would like to display a small link to your forum rules on the forum home page, enable this option.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="show_rules" type="radio" value="1"<if $config[show_rules]> checked="checked"</if> /> No:<input name="show_rules" type="radio" value="0"<if !$config[show_rules]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Rules:</b><br />
<span class="small">Enter your forum rules here. These will be shown on the rules page (which can be optionally linked to on the forum index), and on the user registration page.</span></td>
<td colspan="2" style="white-space:nowrap"><textarea class="small" name="rules" cols="70" rows="10">$config[rules]</textarea></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="usertable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td class="tableheader" colspan="3"><a name="user"></a>User Registration</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Allow registration:</b><br />
<span class="small">This is where you can either allow or disallow new users to join your site.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="allow_registration" type="radio" value="1"<if $config[allow_registration]> checked="checked"</if> /> No:<input name="allow_registration" type="radio" value="0"<if !$config[allow_registration]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Require unique email addresses:</b><br />
<span class="small">If you enable this option, each user will have to have a unique, unused email address when registering.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="unique_email" type="radio" value="1"<if $config[unique_email]> checked="checked"</if> /> No:<input name="unique_email" type="radio" value="0"<if !$config[unique_email]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use image verification:</b><br />
<span class="small">Require users to enter the text shown in an image before registration can take place. This prevents attacks from spam bots. To be able to use this feature, the <b>GD</b> library must be present in your server's PHP configuration. Most servers have this.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="gd_registration" type="radio" value="1"<if $config[gd_registration]> checked="checked"</if> /> No:<input name="gd_registration" type="radio" value="0"<if !$config[gd_registration]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Primary group:</b><br />
<span class="small">This is the primary group that users will be placed into after they register.</span></td>
<td colspan="2" style="white-space:nowrap"><select name="groupid">$groups</select></td>
</tr>
<tr>
<td><b>Other groups:</b><br />
<span class="small">These are the other groups that users will be placed into after they register.</span></td>
<td class="small" style="white-space: nowrap">$usergroups_col1</td><td class="small" style="white-space: nowrap">$usergroups_col2</td>
</tr>
<tr>
<td><b>Styleset:</b><br />
<span class="small">This is the styleset that users will be given after they register.</span></td>
<td colspan="2" style="white-space:nowrap"><select name="default_styleset">$stylesets</select></td>
</tr>
<tr>
<td><b>Email verification group:</b><br />
<span class="small">This is the primary group that users will be placed into while they are awaiting email verification. You can disable email verification by changing this setting to <b>Disable Email Verification</b>.</span></td>
<td colspan="2" style="white-space:nowrap"><select name="email_groupid"><option value="0">Disable Email Verification</option>$email_groups</select></td>
</tr>
<tr>
<td><b>Do not reverify people in these groups:</b><br />
<span class="small">Normally, if email verification is on and someone changes their email address, they must be revalidated. This has the effect of removing them from whatever groups they're in and returning them to the group they were in when they registered. Here, you can prevent this from happening to people in certain groups.</span></td>
<td class="small" style="white-space: nowrap">$emailgroups_col1</td><td class="small" style="white-space: nowrap">$emailgroups_col2</td>
</tr>
<tr>
<td><b>Illegal usernames:</b><br />
<span class="small">Enter any usernames which you would like to block on this forum. Separate the names with spaces. To block a word only when it appears alone, and not as part of another word, surround it with <b>{ }</b> braces.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="illegal_usernames" type="text" size="60" value="$config[illegal_usernames]" /></td>
</tr>
<tr>
<td><b>Minimum username length:</b><br />
<span class="small">Specify the minimum number of characters that a user can use in his or her name.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="min_username_length" type="text" size="60" value="$config[min_username_length]" /></td>
</tr>
<tr>
<td><b>Maximum username length:</b><br />
<span class="small">Specify the maximum number of characters that a user can use in his or her name.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="max_username_length" type="text" size="60" value="$config[max_username_length]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="gueststable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="guests"></a>Guests</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b><br />
<span class="small">This is the default username given to guests.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="guest_name" type="text" size="60" value="$config[guest_name]" /></td>
</tr>
<tr>
<td><b>Primary group:</b><br />
<span class="small">This is the primary group that guests are placed into.</span></td>
<td colspan="2" style="white-space:nowrap"><select name="guest_groupid">$guest_groups</select></td>
</tr>
<tr>
<td><b>Other groups:</b><br />
<span class="small">These are the other groups that guests are placed into.</span></td>
<td class="small">$guestgroups_col1</td><td class="small">$guestgroups_col2</td>
</tr>
<tr>
<td><b>Styleset:</b><br />
<span class="small">This is the styleset that guests are given.</span></td>
<td colspan="2" style="white-space:nowrap"><select name="guest_stylesetid">$guest_stylesets</select></td>
</tr>
<tr>
<td><b>Timezone:</b><br />
<span class="small">This is the timezone that guests are given.</span></td>
<td colspan="2" style="white-space:nowrap"><select name="guest_time_zone"><option value="-12"<if $config[guest_time_zone]=="-12"> selected="selected"</if>>(GMT-12:00) International Date Line West</option><option value="-11"<if $config[guest_time_zone]=="-11"> selected="selected"</if>>(GMT-11:00) Midway Island, Samoa</option><option value="-10"<if $config[guest_time_zone]=="-10"> selected="selected"</if>>(GMT-10:00) Hawaii</option><option value="-9"<if $config[guest_time_zone]=="-9"> selected="selected"</if>>(GMT-9:00) Alaska</option><option value="-8"<if $config[guest_time_zone]=="-8"> selected="selected"</if>>(GMT-8:00) Pacific Time (US &amp; Canada); Tijuana</option><option value="-7"<if $config[guest_time_zone]=="-7"> selected="selected"</if>>(GMT-7:00) Mountain Time (US &amp; Canada)</option><option value="-6"<if $config[guest_time_zone]=="-6"> selected="selected"</if>>(GMT-6:00) Central Time (US &amp; Canada)</option><option value="-5"<if $config[guest_time_zone]=="-5"> selected="selected"</if>>(GMT-5:00) Eastern Time (US &amp; Canada)</option><option value="-4"<if $config[guest_time_zone]=="-4"> selected="selected"</if>>(GMT-4:00) Atlantic Time (Canada)</option><option value="-3"<if $config[guest_time_zone]=="-3"> selected="selected"</if>>(GMT-3:00) Greenland</option><option value="-2"<if $config[guest_time_zone]=="-2"> selected="selected"</if>>(GMT-2:00) Mid-Atlantic</option><option value="-1"<if $config[guest_time_zone]=="-1"> selected="selected"</if>>(GMT-1:00) Cape Verde Is.</option><option value="0"<if !$config[guest_time_zone]> selected="selected"</if>>(GMT) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option><option value="1"<if $config[guest_time_zone]=="1"> selected="selected"</if>>(GMT+1:00) Brussels, Copenhagen, Madrid, Paris</option><option value="2"<if $config[guest_time_zone]=="2"> selected="selected"</if>>(GMT+2:00) Cairo</option><option value="3"<if $config[guest_time_zone]=="3"> selected="selected"</if>>(GMT+3:00) Kuwait, Riyadh</option><option value="4"<if $config[guest_time_zone]=="4"> selected="selected"</if>>(GMT+4:00) Baku, Tbilisi, Yerevan</option><option value="5"<if $config[guest_time_zone]=="5"> selected="selected"</if>>(GMT+5:00) Islamabad, Karachi, Tashkent</option><option value="6"<if $config[guest_time_zone]=="6"> selected="selected"</if>>(GMT+6:00) Astana, Dhaka</option><option value="7"<if $config[guest_time_zone]=="7"> selected="selected"</if>>(GMT+7:00) Bangkok, Hanoi, Jakarta</option><option value="8"<if $config[guest_time_zone]=="8"> selected="selected"</if>>(GMT+8:00) Beijing, Chongqing, Hong Kong, Urumqi</option><option value="9"<if $config[guest_time_zone]=="9"> selected="selected"</if>>(GMT+9:00) Osaka, Sapporo, Tokyo</option><option value="10"<if $config[guest_time_zone]=="10"> selected="selected"</if>>(GMT+10:00) Canberra, Melbourne, Sydney</option><option value="11"<if $config[guest_time_zone]=="11"> selected="selected"</if>>(GMT+11:00) Magadan, Solomon Is., New Caledonia</option><option value="12"<if $config[guest_time_zone]=="12"> selected="selected"</if>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option></select></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="banningtable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="banning"></a>Banning</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Banned group:</b><br />
<span class="small">This is the group that into which users will be placed when banned by a super moderator.</span></td>
<td colspan="2" style="white-space:nowrap"><select name="ban_groupid">$banned_groups</select></td>
</tr>
<tr>
<td><b>Banned IP addresses:</b><br />
<span class="small">Enter a list of IP addresses that you wish to be banned, separated by line breaks. You can also specify partial IP addresses (i.e. <b>12.34.56.</b>) which will block entire ranges.</span></td>
<td colspan="2" style="white-space:nowrap"><textarea class="small" name="banned_ip" cols="70" rows="10">$config[banned_ip]</textarea></td>
</tr>
<tr>
<td><b>Banned email addresses:</b><br />
<span class="small">Enter a list of email addresses that you wish to be banned, separated by line breaks. You can also specify partial email addresses (i.e. <b>@hotmail.com</b>) which will block any address with that partial match in it.</span></td>
<td colspan="2" style="white-space:nowrap"><textarea class="small" name="banned_email" cols="70" rows="10">$config[banned_email]</textarea></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="signaturestable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="signatures"></a>Signatures</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Allow DP code:</b><br />
<span class="small">You can allow or disallow the use of DP Code within users' signatures.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="signature_dpcode" type="radio" value="1"<if $config[signature_dpcode]> checked="checked"</if> /> No:<input name="signature_dpcode" type="radio" value="0"<if !$config[signature_dpcode]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow image tags:</b><br />
<span class="small">Specify whether images are allowed in signatures.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="signature_img" type="radio" value="1"<if $config[signature_img]> checked="checked"</if> /> No:<input name="signature_img" type="radio" value="0"<if !$config[signature_img]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow smilies:</b><br />
<span class="small">Specify whether smilies are allowed in signatures.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="signature_smilies" type="radio" value="1"<if $config[signature_smilies]> checked="checked"</if> /> No:<input name="signature_smilies" type="radio" value="0"<if !$config[signature_smilies]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Maximum number of lines:</b><br />
<span class="small">This is the maximum number of lines a signature may contain. Enter a <b>0</b> (zero) to disable this limit.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="sig_lines" type="text" size="60" value="$config[sig_lines]" /></td>
</tr>
<tr>
<td><b>Maximum number of characters:</b><br />
<span class="small">This is the maximum number of characters a signature may contain. Enter a <b>0</b> (zero) to disable this limit.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="sig_chars" type="text" size="60" value="$config[sig_chars]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="useroptstable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="useropts"></a>User Options</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Display email addresses:</b><br />
<span class="small">If you choose <b>Show email addresses</b>, users will be able to see the email address of other users when clicking the email button. If you select <b>Show email form</b>, then users will not be able to see other users' email addresses, but will be able to use a form to send the email to that user. You can also disable the display and sending of email by choosing <b>Disable email sending/displaying</b>.</span></td>
<td colspan="2" style="white-space:nowrap">Show email addresses:<input name="show_email" type="radio" value="address"<if $config[show_email]=="address"> checked="checked"</if> /> Show email form:<input name="show_email" type="radio" value="form"<if $config[show_email]=="form"> checked="checked"</if> /> Disable email sending/displaying:<input name="show_email" type="radio" value="disable"<if $config[show_email]=="disable"> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow email updates to threads:</b><br />
<span class="small">Allows users to receive email notifications to threads when new posts are made, if they so desire.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="subscribe_email" type="radio" value="1"<if $config[subscribe_email]> checked="checked"</if> /> No:<input name="subscribe_email" type="radio" value="0"<if !$config[subscribe_email]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow forgotten password reminder:</b><br />
<span class="small">Allows users to have a new password generated if they forget their old one.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="password_reminder" type="radio" value="1"<if $config[password_reminder]> checked="checked"</if> /> No:<input name="password_reminder" type="radio" value="0"<if !$config[password_reminder]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Maximum number of failed login attempts:</b><br />
<span class="small">This is the maximum number of failed login attempts a user can have before the IP address is blocked for a specified amount of time. Enter a <b>0</b> (zero) to disable this feature.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="login_fail" type="text" size="60" value="$config[login_fail]" /></td>
</tr>
<tr>
<td><b>Amount of time account remains locked:</b><br />
<span class="small">This is the amount of time, in minutes, an IP address will remain blocked after the maximum number of failed login attempts has been reached. After this time is up, the IP address is unblocked and the number of failed attempts counter is reset.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="login_failtime" type="text" size="60" value="$config[login_failtime]" /></td>
</tr>
<tr>
<td><b>Maximum title length:</b><br />
<span class="small">This is the maximum number of characters long a custom user title can be.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="max_usertitlelen" type="text" size="60" value="$config[max_usertitlelen]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="forumtable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="forum"></a>Forum Display</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Allow users to mark threads as read after they are read:</b><br />
<span class="small">With this option enabled, users can have threads marked as read as soon as they read them. This can take up a fairly substantial amount of space in the database if you have a lot of users and threads.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="markread" type="radio" value="1"<if $config[markread]> checked="checked"</if> /> No:<input name="markread" type="radio" value="0"<if !$config[markread]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use smart mark forum read system:</b><br />
<span class="small">This will allow the forum new post indicators to turn off when all threads in a forum have been read, instead of waiting for the timeout period to end. This adds one additional query to forum display pages, so turn this off if you are having speed problems.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="markforumread" type="radio" value="1"<if $config[markforumread]> checked="checked"</if> /> No:<input name="markforumread" type="radio" value="0"<if !$config[markforumread]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Hide forums that users cannot view:</b><br />
<span class="small">Completely hide forums that users do not have permission to view.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="hideforums" type="radio" value="1"<if $config[hideforums]> checked="checked"</if> /> No:<input name="hideforums" type="radio" value="0"<if !$config[hideforums]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show dot icons:</b><br />
<span class="small">If dot icons are enabled, then the new post indicator beside each thread will have a dot in it if the user has replied to that thread.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="doticons" type="radio" value="1"<if $config[doticons]> checked="checked"</if> /> No:<input name="doticons" type="radio" value="0"<if !$config[doticons]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show users browsing each forum:</b><br />
<span class="small">Shows a list of users currently browsing the forum, at the top of the forum display page. <b>Who's Online</b> must also be enabled for this feature to work.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="browsingforum" type="radio" value="1"<if $config[browsingforum]> checked="checked"</if> /> No:<input name="browsingforum" type="radio" value="0"<if !$config[browsingforum]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show moderator column:</b><br />
<span class="small">Displays a list of forum moderators in the far right column, next to the forum display.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="show_moderators" type="radio" value="1"<if $config[show_moderators]> checked="checked"</if> /> No:<input name="show_moderators" type="radio" value="0"<if !$config[show_moderators]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show thread for last post:</b><br />
<span class="small">Displays the name of the thread in which the last post was made in a forum.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="lastpost_thread" type="radio" value="1"<if $config[lastpost_thread]> checked="checked"</if> /> No:<input name="lastpost_thread" type="radio" value="0"<if !$config[lastpost_thread]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show direct sub-forum list:</b><br />
<span class="small">Displays a small list of direct sub-forums on the forum display.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="show_subforums" type="radio" value="1"<if $config[show_subforums]> checked="checked"</if> /> No:<input name="show_subforums" type="radio" value="0"<if !$config[show_subforums]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Number of threads per page:</b><br />
<span class="small">Specify how many threads are shown on each page of the forum display page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="threads_per_page" type="text" size="60" value="$config[threads_per_page]" /></td>
</tr>
<tr>
<td><b>Number of links shown on each side of thread navigation bar:</b><br />
<span class="small">This allows you to choose how many page links should be shown on each side of the current page in the page navigation bar on the forum display page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="numlinks_threadnav" type="text" size="60" value="$config[numlinks_threadnav]" /></td>
</tr>
<tr>
<td><b>Number of page links shown for multipage threads:</b><br />
<span class="small">If a thread has more than one page, this feature allows you to show links to each page of the thread beside the thread's name on the forum display page. To disable this feature, type <b>0</b> (zero).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="numlinks_multipage" type="text" size="60" value="$config[numlinks_multipage]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="threadtable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="thread"></a>Thread Display</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Post order:</b><br />
<span class="small">Even though showing oldest posts first is the generally accepted method of showing posts, you can also choose to show posts in order from newest to oldest.</span></td>
<td colspan="2" style="white-space:nowrap">Oldest first:<input name="post_order" type="radio" value="asc"<if $config[post_order]=="asc"> checked="checked"</if> /> Newest first:<input name="post_order" type="radio" value="desc"<if $config[post_order]=="desc"> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show users viewing each thread:</b><br />
<span class="small">Shows a list of users currently viewing the thread, at the top of the thread display page. Also allows you to see how many users are viewing the thread by hovering over the view count on the forum display page. <b>Who's Online</b> must also be enabled for this feature to work.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="viewingthread" type="radio" value="1"<if $config[viewingthread]> checked="checked"</if> /> No:<input name="viewingthread" type="radio" value="0"<if !$config[viewingthread]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Number of posts per page:</b><br />
<span class="small">This option specifies how many posts are shown on each page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="posts_per_page" type="text" size="60" value="$config[posts_per_page]" /></td>
</tr>
<tr>
<td><b>Number of links shown on each side of page navigation bar:</b><br />
<span class="small">Specifies how many page links to display on each side of the current page in the page navigation bar.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="numlinks_pagenav" type="text" size="60" value="$config[numlinks_pagenav]" /></td>
</tr>
<tr>
<td><b>Minimum number of posts for a hot thread:</b><br />
<span class="small">Once a thread has this many posts, it will have a "hot" icon shown beside it, to show that it is an especially active topic. Enter a <b>0</b> (zero) here and in the next field to disable hot thread icons.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="min_posts_hot" type="text" size="60" value="$config[min_posts_hot]" /></td>
</tr>
<tr>
<td><b>Minimum number of views for a hot thread:</b><br />
<span class="small">Once a thread has this many views, it will have a "hot" icon shown beside it, to show that it is an especially active topic. Enter a <b>0</b> (zero) here and in the previous field to disable hot thread icons.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="min_views_hot" type="text" size="60" value="$config[min_views_hot]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="postingtable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="posting"></a>Posting</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Disable shouting in thread titles:</b><br />
<span class="small">Disables the posting of thread titles in all capital letters.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="disable_shouting" type="radio" value="1"<if $config[disable_shouting]> checked="checked"</if> /> No:<input name="disable_shouting" type="radio" value="0"<if !$config[disable_shouting]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Characters to block:</b><br />
<span class="small">Enter the ASCII character codes of the characters you wish to block, separated by spaces. These are normally characters that show up as white space, and allow users to make what appear to be blank posts, unless the characters are blocked.</span></td>
<td colspan="2"><input name="blocked_characters" type="text" size="60" value="$config[blocked_characters]" /></td>
</tr>
<tr>
<td><b>Maximum thread title length:</b><br />
<span class="small">This is the maximum number of characters long a thread title can be. Enter <b>0</b> (zero) to disable the limit.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="max_titlelen" type="text" size="60" value="$config[max_titlelen]" /></td>
</tr>
<tr>
<td><b>Maximum word length:</b><br />
<span class="small">This is the maximum number of characters long a word can be inside a post. Words longer than this will have a space inserted after the number of characters specified here, and URLs will be shortened with a ... shown inside them. Enter <b>0</b> (zero) to disable this feature.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="max_wordlen" type="text" size="60" value="$config[max_wordlen]" /></td>
</tr>
<tr>
<td><b>Number of smilies to show:</b><br />
<span class="small">This is the maximum number of smilies that will be shown on the posting pages.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="number_smilies" type="text" size="60" value="$config[number_smilies]" /></td>
</tr>
<tr>
<td><b>Number of smilies per row:</b><br />
<span class="small">This is the number of smilies that are shown in each row in the smilies box.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="smilies_row" type="text" size="60" value="$config[smilies_row]" /></td>
</tr>
<tr>
<td><b>Number of icons per row:</b><br />
<span class="small">This is the number of icons that are shown in each row.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="icons_row" type="text" size="60" value="$config[icons_row]" /></td>
</tr>
<tr>
<td><b>Minimum amount of time between posts:</b><br />
<span class="small">Enter the minimum number of seconds users must wait between posts.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="floodcheck_time" type="text" size="60" value="$config[floodcheck_time]" /></td>
</tr>
<tr>
<td><b>Maximum number of poll options:</b><br />
<span class="small">Enter a <b>0</b> (zero) here to allow for an unlimited number of options.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="max_poll_options" type="text" size="60" value="$config[max_poll_options]" /></td>
</tr>
<tr>
<td><b>Allowed time to delete posts:</b><br />
<span class="small">Amount of time allowed for a user to delete their post, starting from the time it's posted, specified in minutes. Enter a <b>0</b> (zero) to set this to an unlimited amount of time.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="delete_post_time" type="text" size="60" value="$config[delete_post_time]" /></td>
</tr>
<tr>
<td><b>Allowed time to delete threads:</b><br />
<span class="small">Amount of time allowed for a user to delete their thread, starting from the time it's posted, specified in minutes. Enter a <b>0</b> (zero) to set this to an unlimited amount of time.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="delete_thread_time" type="text" size="60" value="$config[delete_thread_time]" /></td>
</tr>
<tr>
<td><b>Allowed time to edit posts:</b><br />
<span class="small">Amount of time allowed for a user to edit their post, starting from the time it's posted, specified in minutes. Enter a <b>0</b> (zero) to set this to an unlimited amount of time.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="edit_post_time" type="text" size="60" value="$config[edit_post_time]" /></td>
</tr>
<tr>
<td><b>Time before "Edited by" message appears:</b><br />
<span class="small">Amount of time a user can edit their post, starting from the time it's posted, before the "Edited by" message appears. This time is specified in minutes. Enter a <b>0</b> (zero) to set this to an unlimited amount of time.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="edited_by_time" type="text" size="60" value="$config[edited_by_time]" /></td>
</tr>
<tr>
<td><b>Allowed time to edit threads:</b><br />
<span class="small">Amount of time allowed for a user to edit their thread title, starting from the time it's posted, specified in minutes. Enter a <b>0</b> (zero) to set this to an unlimited amount of time.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="edit_thread_time" type="text" size="60" value="$config[edit_thread_time]" /></td>
</tr>
<tr>
<td><b>Use WYSIWYG for Posting:</b><br />
<span class="small">This setting enables or disables WYSIWYG on a global level. If this option is turned off, WYSIWYG is disabled for all users. Enabling it allows users to use WYSIWYG for posting.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input type="radio" name="use_wysiwyg" <if $config[use_wysiwyg]==1>checked="checked" </if>value="1" /> No:<input type="radio" name="use_wysiwyg" <if $config[use_wysiwyg]==0>checked="checked" </if>value="0" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="sidebartable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="2" class="tableheader"><a name="sidebar"></a>Sidebar</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Show downloads:</b><br />
<span class="small">Show a list of download categories in the sidebar.</span></td>
<td style="white-space:nowrap">Yes:<input name="sidebar_downloads" type="radio" value="1"<if $config[sidebar_downloads]> checked="checked"</if> /> No:<input name="sidebar_downloads" type="radio" value="0"<if !$config[sidebar_downloads]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show links:</b><br />
<span class="small">Show a list of link categories in the sidebar.</span></td>
<td style="white-space:nowrap">Yes:<input name="sidebar_links" type="radio" value="1"<if $config[sidebar_links]> checked="checked"</if> /> No:<input name="sidebar_links" type="radio" value="0"<if !$config[sidebar_links]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show private messages:</b><br />
<span class="small">Shows current private message statistics in the sidebar.</span></td>
<td style="white-space:nowrap">Yes:<input name="sidebar_pm" type="radio" value="1"<if $config[sidebar_pm]> checked="checked"</if> /> No:<input name="sidebar_pm" type="radio" value="0"<if !$config[sidebar_pm]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show sections:</b><br />
<span class="small">Show a list of sections in the sidebar.</span></td>
<td style="white-space:nowrap">Yes:<input name="sidebar_sections" type="radio" value="1"<if $config[sidebar_sections]> checked="checked"</if> /> No:<input name="sidebar_sections" type="radio" value="0"<if !$config[sidebar_sections]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show Who's Online:</b><br />
<span class="small">Show a brief overview of current Who's Online information.</span></td>
<td style="white-space:nowrap">Yes:<input name="sidebar_online" type="radio" value="1"<if $config[sidebar_online]> checked="checked"</if> /> No:<input name="sidebar_online" type="radio" value="0"<if !$config[sidebar_online]> checked="checked"</if> /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="memberstable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="members"></a>Member List</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Number of members per page:</b><br />
<span class="small">Number of members to show on each page of the member list.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="members_per_page" type="text" size="60" value="$config[members_per_page]" /></td>
</tr>
<tr>
<td><b>Number of links shown on each side of member list navigation bar:</b><br />
<span class="small">This allows you to choose how many page links should be shown on each side of the current page in the page navigation bar in the member list.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="numlinks_memberlistnav" type="text" size="60" value="$config[numlinks_memberlistnav]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="articlestable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="articles"></a>Articles</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Show headlines:</b><br />
<span class="small">Show a list of article headlines on the front page.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="headlines" type="radio" value="1"<if $config[headlines]> checked="checked"</if> /> No:<input name="headlines" type="radio" value="0"<if !$config[headlines]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Number of articles to show on front page:</b><br />
<span class="small">Number of articles you wish to display on the main page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="num_frontpage_articles" type="text" size="60" value="$config[num_frontpage_articles]" /></td>
</tr>
<tr>
<td><b>Number of articles to show in the articles control panel:</b><br />
<span class="small">The number of most recent articles to show in the articles control panel.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="admin_articles_per_page" type="text" size="60" value="$config[admin_articles_per_page]" /></td>
</tr>
<tr>
<td><b>Number of links shown on each side of page navigation bar:</b><br />
<span class="small">Specifies how many page links to display on each side of the current page in the page navigation bar. This applies to articles within sections.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="numlinks_articlenav" type="text" size="60" value="$config[numlinks_articlenav]" /></td>
</tr>
<tr>
<td><b>Site announcement:</b><br />
<span class="small">You can choose to show an announcement, or message, on the top of the main articles page. This will stay on the top of the page until you clear this box.</span></td>
<td colspan="2"><textarea class="small" name="site_announcement" cols="80" rows="10">$config[site_announcement_value]</textarea></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="categoriestable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="categories"></a>Category Pages</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Number of download categories to show per row:</b><br />
<span class="small">The number of download category icons to show on each row on the main downloads page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="downloads_per_row" type="text" size="60" value="$config[downloads_per_row]" /></td>
</tr>
<tr>
<td><b>Number of link categories to show per row:</b><br />
<span class="small">Number of link category icons to show in each row on the links page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="links_per_row" type="text" size="60" value="$config[links_per_row]" /></td>
</tr>
<tr>
<td><b>Number of sections to show per row:</b><br />
<span class="small">Number of sections per row to display on the sections page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="sections_per_row" type="text" size="60" value="$config[sections_per_row]" /></td>
</tr>
<tr>
<td><b>Number of topics to show per row:</b><br />
<span class="small">The number of topics to show per row on the topics page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="topics_per_row" type="text" size="60" value="$config[topics_per_row]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="searchtable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="search"></a>Search</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Enable fulltext searching:</b><br />
<span class="small">Enable faster searching with the ability to sort results by relavence. This feature works <b>only</b> in MySQL 3.23.23 or later. Each time you turn this option on or off, you will have to reindex the database, which can take a long time. Therefore, if you plan to use this option, turn it on as soon as possible.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="fulltextsearch" type="radio" value="1"<if $config[fulltextsearch]> checked="checked"</if> /> No:<input name="fulltextsearch" type="radio" value="0"<if !$config[fulltextsearch]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Enable boolean mode searching:</b><br />
<span class="small">Enable advanced fulltext boolean mode searching, this allows inclusion or exclusion using '+' and '-' before words. This feature works <b>only</b> in MySQL 4.0.1 or later, and will only work with Fulltext searching enabled.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="booleansearch" type="radio" value="1"<if $config[booleansearch]> checked="checked"</if> /> No:<input name="booleansearch" type="radio" value="0"<if !$config[booleansearch]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Minimum length of search terms:</b><br />
<span class="small">To help server load, you may choose to disallow search keywords less than a certain number of characters long.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="min_search_length" type="text" size="60" value="$config[min_search_length]" /></td>
</tr>
<tr>
<td><b>Number of results per page:</b><br />
<span class="small">The number of search results to show per page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="search_per_page" type="text" size="60" value="$config[search_per_page]" /></td>
</tr>
<tr>
<td><b>Number of links shown on each side of search navigation bar:</b><br />
<span class="small">This allows you to choose how many page links should be shown on each side of the current page in the page navigation bar on the search results page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="numlinks_search" type="text" size="60" value="$config[numlinks_search]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="servertable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="server"></a>Server Options</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Enable compression:</b><br />
<span class="small">If your server has <b>zlib</b> enabled, you can use this feature to compress the content of your pages and save bandwidth.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="compression" type="radio" value="1"<if $config[compression]> checked="checked"</if> /> No:<input name="compression" type="radio" value="0"<if !$config[compression]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use external style sheet:</b><br />
<span class="small">If this is enabled, all CSS for the site will be included as an external style sheet, which saves bandwidth. Otherwise, the CSS will be included on every page, in the <b>&lt;head&gt;</b> section.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="external_style" type="radio" value="1"<if $config[external_style]> checked="checked"</if> /> No:<input name="external_style" type="radio" value="0"<if !$config[external_style]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Enable DP Info:</b><br />
<span class="small">This page contains useful debugging information, such as directory permissions and PHP settings. You can access it by going to <a href="$relativeurl/scripts/dp_info.php" onclick="window.open(this.href,'_blank');return false;"><b>$config[url]/scripts/dp_info.php</b></a>. Turning this option off will allow only users with admin configuration permissions to see the page.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="dp_info" type="radio" value="1"<if $config[dp_info]> checked="checked"</if> /> No:<input name="dp_info" type="radio" value="0"<if !$config[dp_info]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Load limit:</b><br />
<span class="small">If you specify a load limit, all users without admin configuration access will be blocked from the site once the server load reaches a specified limit. Enter this number in the form <i>x.xx</i>, for example, <i>5.00</i>. Enter <b>0</b> (zero) to disable this feature. For UNIX/Linux based servers only.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="load_limit" type="text" size="60" value="$config[load_limit]" /></td>
</tr>
<tr>
<td><b>Guest load limit:</b><br />
<span class="small">If you specify a load limit, all guests will be blocked from the site once the server load reaches a specified limit. Enter this number in the form <i>x.xx</i>, for example, <i>5.00</i>. Enter <b>0</b> (zero) to disable this feature. For UNIX/Linux based servers only.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="guest_load" type="text" size="60" value="$config[guest_load]" /></td>
</tr>
<tr>
<td><b>Search load limit:</b><br />
<span class="small">If you specify a load limit, all users without admin configuration access will be prevented from searching once the server load reaches a specified limit. Enter this number in the form <i>x.xx</i>, for example, <i>5.00</i>. Enter <b>0</b> (zero) to disable this feature. For UNIX/Linux based servers only.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="search_load" type="text" size="60" value="$config[search_load]" /></td>
</tr>
<tr>
<td><b>Number of days to cache posts:</b><br />
<span class="small">The post cache helps speed the display of threads. However, it also takes up disk space on the server. All cached posts in threads that have a last post date longer ago than the number of days ago specified here will be removed nightly. This is to free up disk space, but old threads will load more slowly. If you have a large amount of disk space, set this to a high value. Sticky threads are not pruned from the cache, regardless of last post date. Enter a <b>0</b> (zero) to disable the post cache.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="post_cache" type="text" size="60" value="$config[post_cache]" /></td>
</tr>
<tr>
<td><b>Number of hours to cache search results:</b><br />
<span class="small">Search results are stored in the database, this value sets how long a search result will stay in the database, from the time it was last accessed. Minimum value is 1 hour.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="clear_search" type="text" size="60" value="$config[clear_search]" /></td>
</tr>
<tr>
<td><b>Time Offset:</b><br />
<span class="small">Use this option if your server's time is off by a few minutes. (<i>Note: this value is in minutes.</i>)</span></td>
<td colspan="2" style="white-space:nowrap"><input name="time_offset" type="text" size="60" value="$config[time_offset]" /></td>
</tr>
<tr>
<td><b>Cookie expiration time:</b><br />
<span class="small">This is the number of days before a user's cookie expires.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="cookie_expiration_date" type="text" size="60" value="$config[cookie_expiration_date]" /></td>
</tr>
<tr>
<td><b>Cookie domain:</b><br />
<span class="small">You can enter the domain name for which the cookies will be used. Domain names must have at least two periods in them for the cookies to work. Examples are <b>dp.nomative.com</b> and <b>.deluxeportal.com</b> (notice the <b>.</b> before deluxeportal.com). This field can be left blank.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="cookie_domain" type="text" size="60" value="$config[cookie_domain]" /></td>
</tr>
<tr>
<td><b>Cookie path:</b><br />
<span class="small">If you have more than one copy of Deluxe Portal using this domain name, installed into separate directories, you will need to specify the directory this copy of Deluxe Portal is using. Otherwise, leave it as <b>/</b> (slash).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="cookie_path" type="text" size="60" value="$config[cookie_path]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="messagestable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="messages"></a>Private Messages</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Allow DP code:</b><br />
<span class="small">Allows the use of DP Code in private messages.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="pm_dpcode" type="radio" value="1"<if $config[pm_dpcode]> checked="checked"</if> /> No:<input name="pm_dpcode" type="radio" value="0"<if !$config[pm_dpcode]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow image tags:</b><br />
<span class="small">Allows images to be used in private messages.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="pm_img" type="radio" value="1"<if $config[pm_img]> checked="checked"</if> /> No:<input name="pm_img" type="radio" value="0"<if !$config[pm_img]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow smilies:</b><br />
<span class="small">Allows smilies to be used in private messages.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="pm_smilies" type="radio" value="1"<if $config[pm_smilies]> checked="checked"</if> /> No:<input name="pm_smilies" type="radio" value="0"<if !$config[pm_smilies]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Maximum length:</b><br />
<span class="small">Enter the maximum number of characters a private message can have. Enter a <b>0</b> (zero) to disable this limit.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="pm_max_length" type="text" size="60" value="$config[pm_max_length]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="avatarstable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="avatars"></a>Avatar Uploads</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Size:</b><br />
<span class="small">Enter the maximum avatar size in kilobytes (KB).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="avatar_size" type="text" size="60" value="$config[avatar_size]" /></td>
</tr>
<tr>
<td><b>Types:</b><br />
<span class="small">Enter the mime types of the images you would like to allow.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="avatar_types" type="text" size="60" value="$config[avatar_types]" /></td>
</tr>
<tr>
<td><b>Maximum width:</b><br />
<span class="small">Enter the maximum avatar width in pixels.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="avatar_width" type="text" size="60" value="$config[avatar_width]" /></td>
</tr>
<tr>
<td><b>Maximum height:</b><br />
<span class="small">Enter the maximum avatar height in pixels.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="avatar_height" type="text" size="60" value="$config[avatar_height]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="attachmentstable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="attachments"></a>Attachments</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Size:</b><br />
<span class="small">Enter the maximum attachment size in kilobytes (KB).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="attachmentsize" type="text" size="60" value="$config[attachment_size]" /></td>
</tr>
<tr>
<td><b>Types:</b><br />
<span class="small">Enter the mime types of the attachments you would like to allow.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="attachment_types" type="text" size="60" value="$config[attachment_types]" /></td>
</tr>
<tr>
<td><b>Image types:</b><br />
<span class="small">Enter the mime types of the attachments you would like to display as images. Note that you must still enter the mime type in the <b>Types</b> list above if you wish for it to be allowed.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="attachment_image_types" type="text" size="60" value="$config[attachment_image_types]" /></td>
</tr>
<tr>
<td><b>Maximum width:</b><br />
<span class="small">Enter the maximum image width in pixels. Type <b>0</b> to have no limit.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="attachment_width" type="text" size="60" value="$config[attachment_width]" /></td>
</tr>
<tr>
<td><b>Maximum height:</b><br />
<span class="small">Enter the maximum image height in pixels. Type <b>0</b> to have no limit.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="attachment_height" type="text" size="60" value="$config[attachment_height]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="onlinetable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="online"></a>Who's Online</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Show Who's Online:</b><br />
<span class="small">Displays a list of users who are currently online on the main forum page.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="whos_online" type="radio" value="1"<if $config[whos_online]> checked="checked"</if> /> No:<input name="whos_online" type="radio" value="0"<if !$config[whos_online]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show guests on Who's Online page:</b><br />
<span class="small">This option allows you to decide whether to show guests on the Who's Online listing.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="showguests" type="radio" value="1"<if $config[showguests]> checked="checked"</if> /> No:<input name="showguests" type="radio" value="0"<if !$config[showguests]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Identify spiders on Who's Online:</b><br />
<span class="small">This option allows Deluxe Portal to display the names of search engines spidering your site, instead of just displaying <b>Guest</b>.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="showspiders" type="radio" value="1"<if $config[showspiders]> checked="checked"</if> /> No:<input name="showspiders" type="radio" value="0"<if !$config[showspiders]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>List of spiders:</b><br />
<span class="small">List the name of the search engine to the left, and the user agent of the spider to the right.</span></td>
<td colspan="2" style="white-space:nowrap"><textarea class="small" rows="8" cols="30" name="spider_names">$config[spider_names]</textarea> <textarea class="small" rows="8" cols="30" name="spider_agents">$config[spider_agents]</textarea></td>
</tr>
<tr>
<td><b>Timeout:</b><br />
<span class="small">Amount of time in minutes a user has to be inactive before they are taken off the Who's Online list.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="online_timeout" type="text" size="60" value="$config[online_timeout]" /></td>
</tr>
<tr>
<td><b>Number of users per page:</b><br />
<span class="small">Number of users to show on each page of the Who's Online list.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="online_per_page" type="text" size="60" value="$config[online_per_page]" /></td>
</tr>
<tr>
<td><b>Number of links shown on each side of Who's Online navigation bar:</b><br />
<span class="small">This allows you to choose how many page links should be shown on each side of the current page in the page navigation bar in the Who's Online listing.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="numlinks_online" type="text" size="60" value="$config[numlinks_online]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="censoringtable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="censoring"></a>Censoring</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Replace censored words with:</b><br />
<span class="small">Choose the character(s) with which you would like to replace every character of each censored word.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="censor" type="text" size="60" value="$config[censor]" /></td>
</tr>
<tr>
<td><b>Words to censor:</b><br />
<span class="small">Enter any words which you would like to censor on this forum. Separate the words with spaces. To block a word only when it appears alone, and not as part of another word, surround it with <b>{ }</b> braces.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="censored_words" type="text" size="60" value="$config[censored_words]" /></td>
</tr>
<tr>
<td><b>Words to censor in custom titles:</b><br />
<span class="small">Enter any words which you would like to censor within custom titles. Separate the words with spaces. To block a word only when it appears alone, and not as part of another word, surround it with <b>{ }</b> braces.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="censored_title" type="text" size="60" value="$config[censored_title]" /></td>
</tr>
<tr>
<td><b>Words to censor in image tags:</b><br />
<span class="small">Enter any words which you would like to censor within image tags. Separate the words with spaces. To block a word only when it appears alone, and not as part of another word, surround it with <b>{ }</b> braces. It is recommended to at least censor &quot;?&quot; because of security issues.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="censored_img" type="text" size="60" value="$config[censored_img]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="loggingtable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="logging"></a>Logging</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Number of entries per page:</b><br />
<span class="small">Number of log entries to show per page in the admin, moderator, and scheduled tasks logs.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="log_per_page" type="text" size="60" value="$config[log_per_page]" /></td>
</tr>
<tr>
<td><b>Number of links shown on each side of page navigation bar:</b><br />
<span class="small">This allows you to choose how many page links should be shown on each side of the current page in the page navigation bar in the admin, moderator, and scheduled tasks logs.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="numlinks_log" type="text" size="60" value="$config[numlinks_log]" /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="debugtable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="debug"></a>Debugging</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Stop page redirects:</b><br />
<span class="small">If you are receiving PHP errors, you may wish to enable this option. This will cause all auto-redirecting pages to stop, so that you will have time to read the error messages.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="stop_redirect" type="radio" value="1"<if $config[stop_redirect]> checked="checked"</if> /> No:<input name="stop_redirect" type="radio" value="0"<if !$config[stop_redirect]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Redirect Time:</b><br />
<span class="small">Enter the number of seconds you to show the redirect message before redirecting to the next page.</span></td>
<td colspan="2" style="white-space:nowrap"><input name="redirect_time" type="text" size="60" value="$config[redirect_time]" maxlength="5" /></td>
</tr>
<tr>
<td><b>Show query counter:</b><br />
<span class="small">You may wish to display the number of database queries occuring on each page. The more queries you have, the greater the performance hit. This is especially helpful if you are writing add-ons or code hacks.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="show_querycounter" type="radio" value="1"<if $config[show_querycounter]> checked="checked"</if> /> No:<input name="show_querycounter" type="radio" value="0"<if !$config[show_querycounter]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Only show query list to admins:</b><br />
<span class="small">If <b>Show query counter</b> is enabled, there will be an <b>Explain</b> link on each page that lists all queries performed on that page, as well as other information about the queries. Since there is a chance that showing this information to users could be a security problem, enable this option to only allow admins to see it.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="listqueries" type="radio" value="1"<if $config[listqueries]> checked="checked"</if> /> No:<input name="listqueries" type="radio" value="0"<if !$config[listqueries]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show admin and mod cp templates in the templates control panel:</b><br />
<span class="small">If you set this to yes, the templates for the administrator and moderator control panels will be shown in the templates control panel. These template should normally never need to be edited, and doing so could break the control panels.</span></td>
<td colspan="2" style="white-space:nowrap">Yes:<input name="show_cptemplates" type="radio" value="1"<if $config[show_cptemplates]> checked="checked"</if> /> No:<input name="show_cptemplates" type="radio" value="0"<if !$config[show_cptemplates]> checked="checked"</if> /></td>
</tr>
<include template="form_footer" />
</table>
<table style="margin-top:14px; width:100%" id="imagestable" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" >
<tr>
<td colspan="3" class="tableheader"><a name="images"></a>Image Locations</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Avatars:</b><br />
<span class="small">Choose the location in which you want avatars to be stored. If you choose <b>File, in this directory</b>, the directory you specify must exist, and must be chmodded <b>777</b> (read+write+execute).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="avatar_location" type="radio" value="database"<if $config[avatar_location]=="database"> checked="checked"</if> /> Database <input name="avatar_location" type="radio" value="file"<if $config[avatar_location]=="file"> checked="checked"</if> /> File, in this directory: <input name="avatar_directory" type="text" size="15" value="$config[avatar_directory]" /></td>
</tr>
<tr>
<td><b>Attachments:</b><br />
<span class="small">Choose the location in which you want attachments to be stored. If you choose <b>File, in this directory</b>, the directory you specify must exist, and must be chmodded <b>777</b> (read+write+execute).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="attachment_location" type="radio" value="database"<if $config[attachment_location]=="database"> checked="checked"</if> /> Database <input name="attachment_location" type="radio" value="file"<if $config[attachment_location]=="file"> checked="checked"</if> /> File, in this directory: <input name="attachment_directory" type="text" size="15" value="$config[attachment_directory]" /></td>
</tr>
<tr>
<td><b>Download Categories:</b><br />
<span class="small">Choose the location in which you want download category images to be stored. If you choose <b>File, in this directory</b>, the directory you specify must exist, and must be chmodded <b>777</b> (read+write+execute).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="download_location" type="radio" value="database"<if $config[download_location]=="database"> checked="checked"</if> /> Database <input name="download_location" type="radio" value="file"<if $config[download_location]=="file"> checked="checked"</if> /> File, in this directory: <input name="download_directory" type="text" size="15" value="$config[download_directory]" /></td>
</tr>
<tr>
<td><b>Icons:</b><br />
<span class="small">Choose the location in which you want icons to be stored. If you choose <b>File, in this directory</b>, the directory you specify must exist, and must be chmodded <b>777</b> (read+write+execute).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="icon_location" type="radio" value="database"<if $config[icon_location]=="database"> checked="checked"</if> /> Database <input name="icon_location" type="radio" value="file"<if $config[icon_location]=="file"> checked="checked"</if> /> File, in this directory: <input name="icon_directory" type="text" size="15" value="$config[icon_directory]" /></td>
</tr>
<tr>
<td><b>Link Categories:</b><br />
<span class="small">Choose the location in which you want link category images to be stored. If you choose <b>File, in this directory</b>, the directory you specify must exist, and must be chmodded <b>777</b> (read+write+execute).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="link_location" type="radio" value="database"<if $config[link_location]=="database"> checked="checked"</if> /> Database <input name="link_location" type="radio" value="file"<if $config[link_location]=="file"> checked="checked"</if> /> File, in this directory: <input name="link_directory" type="text" size="15" value="$config[link_directory]" /></td>
</tr>
<tr>
<td><b>Section:</b><br />
<span class="small">Choose the location in which you want section images to be stored. If you choose <b>File, in this directory</b>, the directory you specify must exist, and must be chmodded <b>777</b> (read+write+execute).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="section_location" type="radio" value="database"<if $config[section_location]=="database"> checked="checked"</if> /> Database <input name="section_location" type="radio" value="file"<if $config[section_location]=="file"> checked="checked"</if> /> File, in this directory: <input name="section_directory" type="text" size="15" value="$config[section_directory]" /></td>
</tr>
<tr>
<td><b>Smilies:</b><br />
<span class="small">Choose the location in which you want smilies to be stored. If you choose <b>File, in this directory</b>, the directory you specify must exist, and must be chmodded <b>777</b> (read+write+execute).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="smilie_location" type="radio" value="database"<if $config[smilie_location]=="database"> checked="checked"</if> /> Database <input name="smilie_location" type="radio" value="file"<if $config[smilie_location]=="file"> checked="checked"</if> /> File, in this directory: <input name="smilie_directory" type="text" size="15" value="$config[smilie_directory]" /></td>
</tr>
<tr>
<td><b>Topics:</b><br />
<span class="small">Choose the location in which you want topic images to be stored. If you choose <b>File, in this directory</b>, the directory you specify must exist, and must be chmodded <b>777</b> (read+write+execute).</span></td>
<td colspan="2" style="white-space:nowrap"><input name="topic_location" type="radio" value="database"<if $config[topic_location]=="database"> checked="checked"</if> /> Database <input name="topic_location" type="radio" value="file"<if $config[topic_location]=="file"> checked="checked"</if> /> File, in this directory: <input name="topic_directory" type="text" size="15" value="$config[topic_directory]" /></td>
</tr>
<include template="form_footer" />
</table>
<script type="text/javascript">
<!--
	if (navigator.userAgent.indexOf('Opera')==-1)
		hideAllSections('<if $section=='open'>open<else />general</if>');
//-->
</script>
<br />
<input type="submit" value="Update Configuration" />
</div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1133120138";}s:27:"edit_configuration_redirect";a:4:{s:8:"category";s:24:"Admin CP - Configuration";s:4:"body";s:191:"<include template="redirect_header" />
The configuration has been successfully updated. You are now being taken back to the administrator control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"forums_index";a:4:{s:8:"category";s:17:"Admin CP - Forums";s:4:"body";s:634:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Forums</b>
<br />
<br />
<form action="forums.php" method="post">
<div><input name="op" type="hidden" value="order" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><div class="center">[<a href="forums.php?op=add">Add New Forum</a>]</div><br />
$forums<br />
<div class="center"><input type="submit" value="Update Order" /></div></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073366924";}s:12:"groups_index";a:4:{s:8:"category";s:17:"Admin CP - Groups";s:4:"body";s:522:"<include template="header" />
<input name="op" type="hidden" value="add" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Groups</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><div class="center">[<a href="groups.php?op=add">Add New Group</a>]</div><br />
$groups</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:12:"groups_group";a:4:{s:8:"category";s:17:"Admin CP - Groups";s:4:"body";s:433:"<b>$group_result[name]</b> <span class="small">(</span><a class="linksmall" href="users.php?op=search&amp;all=1&amp;group_$group_result[groupid]=1">$number users</a><span class="small">) [</span><a class="linksmall" href="groups.php?op=edit&amp;id=$group_result[groupid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="groups.php?op=delete&amp;id=$group_result[groupid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"groups_duplicate";a:4:{s:8:"category";s:17:"Admin CP - Groups";s:4:"body";s:142:"<include template="message_header" />
A group with that name already exists. Please choose another name.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"groups_missing";a:4:{s:8:"category";s:17:"Admin CP - Groups";s:4:"body";s:122:"<include template="message_header" />
You must specify a name when creating a group.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"edit_group";a:4:{s:8:"category";s:17:"Admin CP - Groups";s:4:"body";s:13883:"<include template="header" />
<form action="groups.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$id" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="groups.php"><b>Groups</b></a> <b>&gt; Edit Group</b>
<br />
<br /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="3">Edit Group - $group_result[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$group_result[name]" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Administrative Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('adminperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('adminperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table width="100%">
<include template="form_header" />
<tr id="adminperm" valign="top">
<td class="small" style="width: 33%"><input name="adminlog" type="checkbox" value="1"<if $group_result[adminlog]> checked="checked"</if> /> Admin Log<br />
<input name="articles" type="checkbox" value="1"<if $group_result[articles]> checked="checked"</if> /> Articles<br />
<input name="configuration" type="checkbox" value="1"<if $group_result[configuration]> checked="checked"</if> /> Configuration<br />
<input name="customfields" type="checkbox" value="1"<if $group_result[customfields]> checked="checked"</if> /> Custom Profile Fields<br />
<input name="downloads" type="checkbox" value="1"<if $group_result[downloads]> checked="checked"</if> /> Downloads<br />
<input name="dpcode" type="checkbox" value="1"<if $group_result[dpcode]> checked="checked"</if> /> DP Code<br />
<input name="faq" type="checkbox" value="1"<if $group_result[faq]> checked="checked"</if> /> FAQ Manager<br />
<input name="forumperm" type="checkbox" value="1"<if $group_result[forumperm]> checked="checked"</if> /> Forum Permissions</td>
<td class="small" style="width: 33%"><input name="forums" type="checkbox" value="1"<if $group_result[forums]> checked="checked"</if> /> Forums<br />
<input name="groupchanger" type="checkbox" value="1"<if $group_result[groupchanger]> checked="checked"</if> /> Group Changer<br />
<input name="admin_groups" type="checkbox" value="1"<if $group_result[groups]> checked="checked"</if> /> Groups<br />
<input name="icons" type="checkbox" value="1"<if $group_result[icons]> checked="checked"</if> /> Icons<br />
<input name="links" type="checkbox" value="1"<if $group_result[links]> checked="checked"</if> /> Links<br />
<input name="maintenance" type="checkbox" value="1"<if $group_result[maintenance]> checked="checked"</if> /> Maintenance<br />
<input name="moderators" type="checkbox" value="1"<if $group_result[moderators]> checked="checked"</if> /> Moderators<br />
<input name="sections" type="checkbox" value="1"<if $group_result[sections]> checked="checked"</if> /> Sections</td>
<td class="small" style="width: 33%"><input name="smilies" type="checkbox" value="1"<if $group_result[smilies]> checked="checked"</if> /> Smilies<br />
<input name="tasks" type="checkbox" value="1"<if $group_result[tasks]> checked="checked"</if> /> Scheduled Tasks<br />
<input name="stylesets" type="checkbox" value="1"<if $group_result[stylesets]> checked="checked"</if> /> Style Sets<br />
<input name="styles" type="checkbox" value="1"<if $group_result[styles]> checked="checked"</if> /> Styles<br />
<input name="templates" type="checkbox" value="1"<if $group_result[templates]> checked="checked"</if> /> Templates<br />
<input name="titles" type="checkbox" value="1"<if $group_result[titles]> checked="checked"</if> /> Titles<br />
<input name="topics" type="checkbox" value="1"<if $group_result[topics]> checked="checked"</if> /> Topics<br />
<input name="users" type="checkbox" value="1"<if $group_result[users]> checked="checked"</if> /> Users</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Super Moderator Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('supermodperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('supermodperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table width="100%">
<include template="form_header" />
<tr id="supermodperm" valign="top">
<td class="small" style="width: 33%"><input name="supermod_banusers" type="checkbox" value="1"<if $group_result[supermod_banusers]> checked="checked"</if> /> Ban users<br />
<input name="supermod_close" type="checkbox" value="1"<if $group_result[supermod_close]> checked="checked"</if> /> Close threads<br />
<input name="supermod_copymove" type="checkbox" value="1"<if $group_result[supermod_copymove]> checked="checked"</if> /> Copy/move threads<br />
<input name="supermod_deleteposts" type="checkbox" value="1"<if $group_result[supermod_deleteposts]> checked="checked"</if> /> Delete posts<br />
<input name="supermod_deletethreads" type="checkbox" value="1"<if $group_result[supermod_deletethreads]> checked="checked"</if> /> Delete threads<br />
<input name="supermod_editpolls" type="checkbox" value="1"<if $group_result[supermod_editpolls]> checked="checked"</if> /> Edit polls</td>
<td class="small" style="width: 33%"><input name="supermod_editposts" type="checkbox" value="1"<if $group_result[supermod_editposts]> checked="checked"</if> /> Edit posts<br />
<input name="supermod_editthreads" type="checkbox" value="1"<if $group_result[supermod_editthreads]> checked="checked"</if> /> Edit threads<br />
<input name="supermod_exemptfloodcheck" type="checkbox" value="1"<if $group_result[supermod_exemptfloodcheck]> checked="checked"</if> /> Exempt from flood check<br />
<input name="supermod_massdelete" type="checkbox" value="1"<if $group_result[supermod_massdelete]> checked="checked"</if> /> Mass delete threads<br />
<input name="supermod_massmove" type="checkbox" value="1"<if $group_result[supermod_massmove]> checked="checked"</if> /> Mass move threads</td>
<td class="small" style="width: 33%"><input name="supermod_announcements" type="checkbox" value="1"<if $group_result[supermod_announcements]> checked="checked"</if> /> Post announcements<br />
<input name="supermod_sticky" type="checkbox" value="1"<if $group_result[supermod_sticky]> checked="checked"</if> /> Stick threads<br />
<input name="supermod_viewfullprofiles" type="checkbox" value="1"<if $group_result[supermod_viewfullprofiles]> checked="checked"</if> /> View full user profiles<br />
<input name="supermod_viewips" type="checkbox" value="1"<if $group_result[supermod_viewips]> checked="checked"</if> /> View IP addresses<br />
<input name="supermod_log" type="checkbox" value="1"<if $group_result[supermod_log]> checked="checked"</if> /> View moderator log</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">User Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('userperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('userperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table width="100%">
<include template="form_header" />
<tr id="userperm" valign="top">
<td class="small" style="width: 33%"><input name="close" type="checkbox" value="1"<if $group_result[close]> checked="checked"</if> /> Close threads<br />
<input name="copymove" type="checkbox" value="1"<if $group_result[copymove]> checked="checked"</if> /> Copy/move threads<br />
<input name="deleteposts" type="checkbox" value="1"<if $group_result[deleteposts]> checked="checked"</if> /> Delete posts<br />
<input name="deletethreads" type="checkbox" value="1"<if $group_result[deletethreads]> checked="checked"</if> /> Delete threads<br />
<input name="editposts" type="checkbox" value="1"<if $group_result[editposts]> checked="checked"</if> /> Edit posts</td>
<td class="small" style="width: 33%"><input name="editthreads" type="checkbox" value="1"<if $group_result[editthreads]> checked="checked"</if> /> Edit threads<br />
<input name="postattachments" type="checkbox" value="1"<if $group_result[postattachments]> checked="checked"</if> /> Post attachments<br />
<input name="postthreads" type="checkbox" value="1"<if $group_result[postthreads]> checked="checked"</if> /> Post threads<br />
<input name="replytoother" type="checkbox" value="1"<if $group_result[replytoother]> checked="checked"</if> /> Reply to others' threads<br />
<input name="replytoown" type="checkbox" value="1"<if $group_result[replytoown]> checked="checked"</if> /> Reply to own threads</td>
<td class="small" style="width: 33%"><input name="startpolls" type="checkbox" value="1"<if $group_result[startpolls]> checked="checked"</if> /> Start polls<br />
<input name="viewattachments" type="checkbox" value="1"<if $group_result[viewattachments]> checked="checked"</if> /> View attachments<br />
<input name="viewforums" type="checkbox" value="1"<if $group_result[viewforums]> checked="checked"</if> /> View forums<br />
<input name="viewthreads" type="checkbox" value="1"<if $group_result[viewthreads]> checked="checked"</if> /> View threads<br />
<input name="votepolls" type="checkbox" value="1"<if $group_result[votepolls]> checked="checked"</if> /> Vote on polls</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Other&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('otherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('otherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table width="100%">
<include template="form_header" />
<tr id="otherperm" valign="top">
<td class="small" style="width: 33%"><input name="customtitle" type="checkbox" value="1"<if $group_result[customtitle]> checked="checked"</if> /> Can choose a custom title<br />
<input name="customsignature" type="checkbox" value="1"<if $group_result[customsignature]> checked="checked"</if> /> Can have a signature<br />
<input name="customavatar" type="checkbox" value="1"<if $group_result[customavatar]> checked="checked"</if> /> Can upload an avatar<br />
<input name="html" type="checkbox" value="1"<if $group_result[html]> checked="checked"</if> /> Can use HTML<br />
<input name="edit_profile" type="checkbox" value="1"<if $group_result[edit_profile]> checked="checked"</if> /> Edit profile</td>
<td class="small" style="width: 33%"><input name="exempt_titlecensor" type="checkbox" value="1"<if $group_result[exempt_titlecensor]> checked="checked"</if> /> Exempt from title censoring<br />
<input name="ignorelist" type="checkbox" value="1"<if $group_result[ignorelist]> checked="checked"</if> /> Exempt from ignore list<br />
<input name="show_editedby" type="checkbox" value="1"<if $group_result[show_editedby]> checked="checked"</if> /> Exempt from "Edited by" message<br />
<input name="privatemessaging" type="checkbox" value="1"<if $group_result[privatemessaging]> checked="checked"</if> /> Use private messaging</td>
<td class="small" style="width: 33%"><input name="search" type="checkbox" value="1"<if $group_result[search]> checked="checked"</if> /> Use search<br />
<input name="whos_online" type="checkbox" value="1"<if $group_result[whos_online]> checked="checked"</if> /> View full Who's Online<br />
<input name="view_memberlist" type="checkbox" value="1"<if $group_result[view_memberlist]> checked="checked"</if> /> View member list<br />
<input name="view_profile" type="checkbox" value="1"<if $group_result[view_profile]> checked="checked"</if> /> View user profiles</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td class="heading" colspan="2">Other Settings</td>
</tr>
<tr>
<td><b>Lock post count:</b></td>
<td>Yes:<input name="lockpostcount" type="radio" value="1"<if $group_result[lockpostcount]> checked="checked"</if> /> No:<input name="lockpostcount" type="radio" value="0"<if !$group_result[lockpostcount]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Username style (large):</b></td>
<td><input name="online_template_large" type="text" size="60" value="$group_result[online_template_large]" /></td>
</tr>
<tr>
<td><b>Username style (small):</b></td>
<td><input name="online_template" type="text" size="60" value="$group_result[online_template]" /></td>
</tr>
<tr>
<td><b>Maximum number of recipients of a PM:</b><br />
<span class="small">Maximum number of people a user can send a private message to at one time.</span></td>
<td><input name="max_recipients" type="text" size="60" value="$group_result[max_recipients]" /></td>
</tr>
<tr>
<td><b>Maximum number of saved PM's:</b><br />
<span class="small">Maximum number of private messages a user can store before "filling" their message box. Enter a <b>0</b> (zero) to disable this limit.</span></td>
<td><input name="maxpm" type="text" size="60" value="$group_result[maxpm]" /></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">This is the order in which this group will be displayed on the <b>Site/Forum Leaders</b> page. Set this to <b>0</b> (zero) if you would not like for this group to be displayed on that page.</span></td>
<td><input name="ordered" type="text" size="5" value="$group_result[ordered]" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Group" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073371075";}s:12:"delete_group";a:4:{s:8:"category";s:17:"Admin CP - Groups";s:4:"body";s:463:"<include template="message_header" />
Are you sure you want to delete group <b>$group_result[name]</b>?<br />
<br />
<br />
<form action="groups.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$group_result[groupid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='groups.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073371018";}s:19:"delete_group_denied";a:4:{s:8:"category";s:17:"Admin CP - Groups";s:4:"body";s:182:"<include template="message_header" />
The specified group is a default group, or is in use by one or more members. You cannot delete this group.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"users_index";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:3937:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Users</b><br />
<br />
<form action="users.php" method="post">
<div><input name="op" type="hidden" value="search" /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><b>Most Recent Users:</b><br />$users</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="0" cellpadding="1">
<tr>
<td><table class="cellmain" cellspacing="0" cellpadding="15">
<tr>
<td class="center"><a class="linksmall" href="users.php?op=add"><img alt="Add New User" src="$style[images]/users.gif" />
<br />
Add New User</a></td>
<td class="center"><a class="linksmall" href="users.php?op=ipcheck"><img alt="Check IP Addresses" src="$style[images]/users.gif" />
<br />
Check IP Addresses</a></td>
<td class="center"><a class="linksmall" href="users.php?op=search&amp;all=1&amp;all_groups=1"><img alt="View All Users" src="$style[images]/users.gif" />
<br />
View All Users</a></td>
</tr>
</table></td>
</tr>
</table><br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Search for Users</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td>
<td colspan="2"><input size="60" name="name" type="text" /></td>
</tr>
<tr id="ingroup" valign="top">
<td><b>In one of these groups:</b><br />
<br />
<div class="center"><a href="javascript:check_all(getElement('ingroup'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('ingroup'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></div></td><td class="small" style="white-space: nowrap">$usergroups_col1</td><td class="small" style="white-space: nowrap">$usergroups_col2</td>
</tr>
<tr>
<td><b>Style set:</b></td>
<td colspan="2"><select name="stylesetid"><option value="0" selected="selected">Any style set</option>$stylesets</select></td>
</tr>
<tr>
<td><b>Email address:</b></td>
<td colspan="2"><input size="60" name="email" type="text" /></td>
</tr>
<tr>
<td><b>AOL Instant Messenger:</b></td>
<td colspan="2"><input size="60" name="aol" type="text" /></td>
</tr>
<tr>
<td><b>ICQ:</b></td>
<td colspan="2"><input size="60" name="icq" type="text" /></td>
</tr>
<tr>
<td><b>MSN Messenger:</b></td>
<td colspan="2"><input size="60" name="msn" type="text" /></td>
</tr>
<tr>
<td><b>Yahoo Instant Messenger:</b></td>
<td colspan="2"><input size="60" name="yahoo" type="text" /></td>
</tr>
<tr>
<td><b>At least this many posts:</b></td>
<td colspan="2"><input size="60" name="minposts" type="text" value="0" /></td>
</tr>
<tr>
<td><b>At most this many posts:</b></td>
<td colspan="2"><input size="60" name="maxposts" type="text" value="4294967296" /></td>
</tr>
<tr>
<td><b>Custom title:</b></td>
<td colspan="2"><input size="60" name="title" type="text" /></td>
</tr>
<tr>
<td><b>Joined on or after this date:</b></td>
<td colspan="2"><input size="60" name="minjoin" type="text" value="1969-12-31" /></td>
</tr>
<tr>
<td><b>Joined on or before this date:</b></td>
<td colspan="2"><input size="60" name="maxjoin" type="text" value="2029-12-31" /></td>
</tr>
<tr>
<td><b>Website:</b></td>
<td colspan="2"><input size="60" name="website" type="text" /></td>
</tr>
<tr>
<td><b>Location:</b><br />
<span class="small">Where you live</span></td>
<td colspan="2"><input size="60" name="location" type="text" /></td>
</tr>
$customfields
<tr>
<td><b>Signature:</b></td>
<td colspan="2"><input size="60" name="signature" type="text" /></td>
</tr>
<tr>
<td colspan="3" class="center"><input type="submit" value="Search" /></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073716184";}s:11:"icons_index";a:4:{s:8:"category";s:16:"Admin CP - Icons";s:4:"body";s:1881:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Icons</b>
<br />
<br />
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><form action="icons.php" method="post"><div><input name="op" type="hidden" value="order" />$icons<br /></div>
<div class="center"><input type="submit" value="Update Order" /></div></form></td>
</tr>
</table></td>
<td><form enctype="multipart/form-data" action="icons.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="add" /></div><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Icon</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">Entering a <b>0</b> (zero) will hide the icon.</span></td>
<td><input size="60" name="ordered" type="text" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td style="white-space: nowrap"><input name="transfer" type="radio" value="upload" checked="checked" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Icon" /></div></td>
</tr>
<include template="form_footer" />
</table></form></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073371178";}s:12:"styles_index";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:3561:"<include template="header" />
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<script type="text/javascript">
<!--
var lastShown = 'cat$first_id';
function ShowColorPicker(inputId)
{
	if (document.all && document.getElement && document.body.filters)
		getElement(inputId).value = window.showModalDialog('$relativeurl/popups/color_picker.html', getElement(inputId).value, 'dialogHeight:455px;dialogWidth:370px;center:Yes;help:No;scroll:No;resizable:No;status:No;');
}
//-->
</script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Styles</b>
<br />
<br />
<form action="styles.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td class="cellmain"><b>Style: </b><select name="current_style" onchange="window.location='styles.php?current_style='+this.options[this.selectedIndex].value">$styles</select> - <a href="styles.php?op=add&amp;current_style=$currentstyle[styleid]">Add</a> - <a href="styles.php?op=delete&amp;current_style=$currentstyle[styleid]">Delete</a> - <a href="styles.php?op=export&amp;current_style=$currentstyle[styleid]">Export</a> - <a href="styles.php?op=revert&amp;current_style=$currentstyle[styleid]">Revert</a></td>
</tr>
</table>
<br /></div>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td style="vertical-align:top; padding-right:16px">
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%">
<include template="form_header" />
<tr>
<td class="heading">Categories</td>
</tr>
<tr>
<td class="small" style="white-space:nowrap">
$links
</td>
</tr>
<include template="form_footer" />
</table>
</td>
<td>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%">
<include template="form_header" />
$categories
<tbody>
<tr>
<td class="heading" colspan="2">Style Information</td>
</tr>
<tr>
<td><b>Name:</b></td>
<td><input name="name" type="text" size="66" value="$currentstyle[name]" /></td>
</tr>
<tr>
<td><b>WYSIWYG CSS File:</b></td>
<td><input name="wysiwygcss" type="text" size="66" value="$currentstyle[wysiwygcss]" /></td>
</tr>
<tr>
<td><b>Extra:</b></td>
<td><textarea class="small" name="extra" cols="66" rows="10">$currentstyle[extra]</textarea></td>
</tr>
<tr>
<td class="heading" colspan="2">PHP Syntax Highlighting<br />
<span class="small">Leave blank for default</span></td>
</tr>
<tr>
<td><b>Default Text Color:</b></td>
<td><input name="php_default" type="text" size="10" maxlength="7" value="$currentstyle[php_default]" /></td>
</tr>
<tr>
<td><b>Comment Text Color:</b></td>
<td><input name="php_comment" type="text" size="10" maxlength="7"value="$currentstyle[php_comment]" /></td>
</tr>
<tr>
<td><b>HTML Text Color:</b></td>
<td><input name="php_html" type="text" size="10" maxlength="7" value="$currentstyle[php_html]" /></td>
</tr>
<tr>
<td><b>Keyword Text Color:</b></td>
<td><input name="php_keyword" type="text" size="10" maxlength="7" value="$currentstyle[php_keyword]" /></td>
</tr>
<tr>
<td><b>String Text Color:</b></td>
<td><input name="php_string" type="text" size="10" maxlength="7" value="$currentstyle[php_string]" /></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Update Style" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073766202";}s:13:"icons_missing";a:4:{s:8:"category";s:16:"Admin CP - Icons";s:4:"body";s:141:"<include template="message_header" />
You must specify a name and an order number to create a new icon.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"icons_icon";a:4:{s:8:"category";s:16:"Admin CP - Icons";s:4:"body";s:412:"<input name="icon_$icon[iconid]" type="text" size="1" class="center" value="$icon[ordered]" /> <img alt="$icon[name]" src="$icon[parsed_image]" /> <b>$icon[name]</b> <span class="small">[</span><a class="linksmall" href="icons.php?op=edit&amp;id=$icon[iconid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="icons.php?op=delete&amp;id=$icon[iconid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:9:"edit_icon";a:4:{s:8:"category";s:16:"Admin CP - Icons";s:4:"body";s:2286:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="icons.php"><b>Icons</b></a> <b>&gt; Edit Icon</b><br />
<br />
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><form action="icons.php" method="post"><div class="center"><input name="op" type="hidden" value="order" />[<a href="icons.php">Add New Icon</a>]<br />
<br /></div>
<div>$icons<br /></div>
<div class="center"><input type="submit" value="Update Order" /></div></form></td>
</tr>
</table></td>
<td><form enctype="multipart/form-data" action="icons.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$icon[iconid]" /></div><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Icon - $icon[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$icon[name]" /></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">Entering a <b>0</b> (zero) will hide the icon.</span></td>
<td><input size="60" name="ordered" type="text" value="$icon[ordered]" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td style="white-space: nowrap"><input name="transfer" type="radio" value="current" checked="checked" /> <span class="small">Use current image:</span> <img alt="$icon[name]" src="$icon[parsed_image]" /><br />
<input name="transfer" type="radio" value="upload" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Icon" /></div></td>
</tr>
<include template="form_footer" />
</table></form></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073371281";}s:11:"delete_icon";a:4:{s:8:"category";s:16:"Admin CP - Icons";s:4:"body";s:489:"<include template="message_header" />
Are you sure you want to delete <b>$icon[name]</b> <img alt="$icon[name]" src="$icon[parsed_image]" />?<br />
<br />
<br />
<form action="icons.php" method="post">
<div class="center"><input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$icon[iconid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='icons.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073371298";}s:12:"titles_index";a:4:{s:8:"category";s:17:"Admin CP - Titles";s:4:"body";s:1838:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Titles</b>
<br />
<br />
<form action="titles.php" method="post">
<div><input name="op" type="hidden" value="add" /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap">$title_groups</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Title</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Title:</b></td>
<td><input size="40" name="title" type="text" /></td>
</tr>
<tr>
<td><b>Rank image:</b><br />
<span class="small">You can specify an image to display under the title. Use <b>\$style[images]</b> to refer to the images directory for your style set.</span></td>
<td><input size="40" name="image" type="text" /></td>
</tr>
<tr>
<td><b>Number of times to display image:</b><br />
<span class="small">You can force the image to repeat by specifying a number greater than <b>1</b>. Enter a <b>0</b> (zero) to disable the image.</span></td>
<td><input size="40" name="repeat" type="text" value="1" /></td>
</tr>
<tr>
<td><b>Minimum number of posts:</b></td>
<td><input size="40" name="posts" type="text" /></td>
</tr>
<tr>
<td><b>Group:</b><br />
<span class="small">This title will only apply to users who have their primary group set to this group.</span></td>
<td><select name="groupid">$groups</select></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Add Title" /></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073710882";}s:10:"edit_title";a:4:{s:8:"category";s:17:"Admin CP - Titles";s:4:"body";s:2049:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="titles.php"><b>Titles</b></a> <b>&gt; Edit Title</b>
<br />
<br />
<form action="titles.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$title[titleid]" /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap">$title_groups</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Title - $title[title]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Title:</b></td>
<td><input size="40" name="title" type="text" value="$title[title]" /></td>
</tr>
<tr>
<td><b>Rank image:</b><br />
<span class="small">You can specify an image to display under the title. Use <b>\$style[images]</b> to refer to the images directory for your style set.</span></td>
<td><input size="40" name="image" type="text" value="$title[image]" /></td>
</tr>
<tr>
<td><b>Number of times to display image:</b><br />
<span class="small">You can force the image to repeat by specifying a number greater than <b>1</b>. Enter a <b>0</b> (zero) to disable the image.</span></td>
<td><input size="40" name="repeat" type="text" value="$title[repeat]" /></td>
</tr>
<tr>
<td><b>Minimum number of posts:</b></td>
<td><input size="40" name="posts" type="text" value="$title[posts]" /></td>
</tr>
<tr>
<td><b>Group:</b><br />
<span class="small">This title will only apply to users who have their primary group set to this group.</span></td>
<td><select name="groupid">$groups</select></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Update Title" /></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073710916";}s:12:"titles_title";a:4:{s:8:"category";s:17:"Admin CP - Titles";s:4:"body";s:335:"&nbsp;&nbsp;&nbsp;<span class="small">$title_result[title] (Posts: $title_result[posts]) [</span><a class="linksmall" href="titles.php?id=$title_result[titleid]&amp;op=edit">Edit</a> <span class="small">-</span> <a class="linksmall" href="titles.php?id=$title_result[titleid]&amp;op=delete">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"titles_group";a:4:{s:8:"category";s:17:"Admin CP - Titles";s:4:"body";s:46:"<b>$group_result[name]</b><br />
$titles<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"titles_duplicate";a:4:{s:8:"category";s:17:"Admin CP - Titles";s:4:"body";s:154:"<include template="message_header" />
There is already a title for that group with the same minimum number of posts.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"titles_missing";a:4:{s:8:"category";s:17:"Admin CP - Titles";s:4:"body";s:131:"<include template="message_header" />
You must specify a title and a minimum number of posts.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"delete_title";a:4:{s:8:"category";s:17:"Admin CP - Titles";s:4:"body";s:492:"<include template="message_header" />
Are you sure you want to delete the title <b>$title[title]</b> (Minimum posts: <b>$title[posts]</b>)?<br />
<br />
<br />
<form action="titles.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$title[titleid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='titles.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073711171";}s:19:"users_search_result";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:1054:"<tr><td class="$color"><a href="$relativeurl/profile.php?id=$user_result[userid]">$user_result[parsed_name]</a></td><td class="$color"><if $showpm><div class="center"><a href="$relativeurl/newpm.php?id=$user_result[userid]"><img alt="Send $user_result[name] a private message" src="$style[images]/pm.gif" /></a></div></if></td><td class="$color"><if $showemail><div class="center"><a href="$relativeurl/email.php?id=$user_result[userid]"><img alt="Send $user_result[name] an email" src="$style[images]/email.gif" /></a></div></if></td><td class="$color"><if $showsearch><div class="center"><a href="$relativeurl/search.php?op=post&amp;type=post&amp;sort=desc&amp;userid=$user_result[userid]"><img alt="Search for posts made by $user_result[name]" src="$style[images]/search.gif" /></a></div></if></td><td class="$color">$user_result[joindate]</td><td class="$color">$user_result[posts]</td><td class="$color"><a href="users.php?op=edit&amp;id=$user_result[userid]">Edit</a> - <a href="users.php?op=delete&amp;id=$user_result[userid]">Delete</a></td></tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:12:"users_search";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:1218:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; Search Results</b><br />
<br />
<form action="users.php" method="post">
<div class="right">
<input name="op" type="hidden" value="mass" />
<input name="results" type="hidden" value="$userids" />
<b>With results:</b> <input name="delete" type="submit" value="Delete" /> <input name="email" type="submit" value="Email" /> <input name="pm" type="submit" value="PM" /></div></form>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr><td class="tableheader"><span class="small">Username</span></td><td class="tableheader"><span class="small">Private Message</span></td><td class="tableheader"><span class="small">Email</span></td><td class="tableheader"><span class="small">Search</span></td><td class="tableheader"><span class="small">Join Date</span></td><td class="tableheader"><span class="small">Posts</span></td><td class="tableheader"><span class="small">Administrative Options</span></td></tr>
$users
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073765663";}s:12:"forums_forum";a:4:{s:8:"category";s:17:"Admin CP - Forums";s:4:"body";s:535:"<input name="forum_$forum_result[forumid]" type="text" size="1" class="center" value="$forum_result[ordered]" /> <b>$forum_result[name]</b> <span class="small">[</span><a class="linksmall" href="forums.php?op=add&amp;parentid=$forum_result[forumid]">Add Sub-forum</a> <span class="small">-</span> <a class="linksmall" href="forums.php?op=edit&amp;id=$forum_result[forumid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="forums.php?op=delete&amp;id=$forum_result[forumid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"delete_forum";a:4:{s:8:"category";s:17:"Admin CP - Forums";s:4:"body";s:556:"<include template="message_header" />
Are you sure you want to delete forum <b>$forum[name]</b>?<br />
<br />
<div class="center"><b>Warning:</b> This will delete every post and thread made in this forum.</div><br />
<br />
<form action="forums.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$forum[forumid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='forums.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073367274";}s:14:"forums_missing";a:4:{s:8:"category";s:17:"Admin CP - Forums";s:4:"body";s:100:"<include template="message_header" />
You must specify a name.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062272724";}s:10:"edit_forum";a:4:{s:8:"category";s:17:"Admin CP - Forums";s:4:"body";s:3034:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="forums.php"><b>Forums</b></a> <b>&gt; Edit Forum</b>
<br />
<br />
<form action="forums.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$forum[forumid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Forum - $forum[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$forum[name]" /></td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><textarea class="small" rows="5" cols="70" name="description">$forum[description]</textarea></td>
</tr>
<tr>
<td><b>Link:</b><br />
<span class="small">If you would like this forum to act as a link to another URL, enter that URL here.</span></td>
<td><input size="60" name="link" type="text" value="$forum[link]" /></td>
</tr>
<tr>
<td><b>Parent forum:</b></td>
<td><select name="parentid" class="small"><option value="0">(No Parent)</option>$forum_choices</select></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">Enter a <b>0</b> (zero) to hide the forum. This will not stop people from browsing through the forum if they find it, however.</span></td>
<td><input size="6" name="ordered" type="text" value="$forum[ordered]" /></td>
</tr>
<tr>
<td><b>Allow posting:</b></td>
<td>Yes:<input name="allow_posting" type="radio" value="1"<if $forum[allow_posting]> checked="checked"</if> /> No:<input name="allow_posting" type="radio" value="0"<if !$forum[allow_posting]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow DP Code:</b></td>
<td>Yes:<input name="dpcode" type="radio" value="1"<if $forum[dpcode]> checked="checked"</if> /> No:<input name="dpcode" type="radio" value="0"<if !$forum[dpcode]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow image tags:</b></td>
<td>Yes:<input name="img" type="radio" value="1"<if $forum[img]> checked="checked"</if> /> No:<input name="img" type="radio" value="0"<if !$forum[img]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Allow smilies:</b></td>
<td>Yes:<input name="smilies" type="radio" value="1"<if $forum[smilies]> checked="checked"</if> /> No:<input name="smilies" type="radio" value="0"<if !$forum[smilies]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Count posts:</b><br />
<span class="small">Enabling this option will cause a user's post count to increment when they make a post in this forum.</span></td>
<td>Yes:<input name="countposts" type="radio" value="1"<if $forum[countposts]> checked="checked"</if> /> No:<input name="countposts" type="radio" value="0"<if !$forum[countposts]> checked="checked"</if> /></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Update Forum" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1090137877";}s:12:"dpcode_index";a:4:{s:8:"category";s:18:"Admin CP - DP Code";s:4:"body";s:2319:"<include template="header" />
<form action="dpcode.php" method="post">
<div><input name="op" type="hidden" value="add" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; DP Code</b>
<br />
<br /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap">$dpcodes</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New DP Code</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Code tag:</b><br />
<span class="small">Do not include the <b>[ ]</b> brackets.</span></td>
<td><input size="60" name="tag" type="text" /></td>
</tr>
<tr>
<td><b>Replacement:</b><br />
<span class="small">This is the HTML with which the DP Code will be replaced. <b>{param}</b> and <b>{option}</b> can be used here. <a class="linksmall" href="$relativeurl/faq.php?faq=adminfaq&amp;category=DP Code#How_do_I_add_DP_Code" onclick="window.open(this.href, '', 'scrollbars,resizable,width=700,height=500'); return false;">Check the Admin FAQ</a> for more information.</span></td>
<td><textarea class="small" rows="4" cols="72" name="replacement" ></textarea></td>
</tr>
<tr>
<td><b>Description:</b><br />
<span class="small">This description will be shown on the Frequently Asked Questions page.</span></td>
<td><textarea class="small" rows="4" cols="72" name="description"></textarea></td>
</tr>
<tr>
<td><b>Example:</b><br />
<span class="small">This example will also be shown on the Frequently Asked Questions page.</span></td>
<td><input size="60" name="example" type="text" /></td>
</tr>
<tr>
<td><b>Parse smilies:</b><br />
<span class="small">If this option is set to <b>No</b>, any smilie text within this DP Code will not be converted to an image.</span></td>
<td>Yes: <input name="nosmilies" value="0" type="radio" checked="checked" />
No: <input name="nosmilies" value="1" type="radio" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add DP Code" /></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1075188673";}s:16:"dpcode_duplicate";a:4:{s:8:"category";s:18:"Admin CP - DP Code";s:4:"body";s:140:"<include template="message_header" />
A DP Code with that tag already exists. Please choose a new one.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"dpcode_dpcode";a:4:{s:8:"category";s:18:"Admin CP - DP Code";s:4:"body";s:299:"<b>[$dpcode_result[tag]]</b> <span class="small">[</span><a class="linksmall" href="dpcode.php?op=edit&amp;id=$dpcode_result[dpcodeid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="dpcode.php?op=delete&amp;id=$dpcode_result[dpcodeid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"edit_dpcode";a:4:{s:8:"category";s:18:"Admin CP - DP Code";s:4:"body";s:2690:"<include template="header" />
<form action="dpcode.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$dpcode[dpcodeid]" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="dpcode.php"><b>DP Code</b></a> <b>&gt; Edit DP Code</b>
<br />
<br /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><div class="center">[<a href="dpcode.php">Add New DP Code</a>]</div><br />
$dpcodes</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit DP Code - $dpcode[tag]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Code tag:</b><br />
<span class="small">Do not include the <b>[ ]</b> brackets.</span></td>
<td><input size="60" name="tag" type="text" value="$dpcode[tag]" /></td>
</tr>
<tr>
<td><b>Replacement:</b><br />
<span class="small">This is the HTML with which the DP Code will be replaced. <b>{param}</b> and <b>{option}</b> can be used here. <a class="linksmall" href="$relativeurl/faq.php?faq=adminfaq&amp;category=DP Code#How_do_I_add_DP_Code" onclick="window.open(this.href, '', 'scrollbars,resizable,width=700,height=500'); return false;">Check the Admin FAQ</a> for more information.</span></td>
<td><textarea class="small" rows="4" cols="72" name="replacement" >$dpcode[replacement]</textarea></td>
</tr>
<tr>
<td><b>Description:</b><br />
<span class="small">This description will be shown on the Frequently Asked Questions page.</span></td>
<td><textarea class="small" rows="4" cols="72" name="description">$dpcode[description]</textarea></td>
</tr>
<tr>
<td><b>Example:</b><br />
<span class="small">This example will also be shown on the Frequently Asked Questions page.</span></td>
<td><input size="60" name="example" type="text" value="$dpcode[example]" /></td>
</tr>
<tr>
<td><b>Parse smilies:</b><br />
<span class="small">If this option is set to <b>No</b>, any smilie text within this DP Code will not be converted to an image.</span></td>
<td>Yes: <input name="nosmilies" value="0" type="radio"<if !$dpcode[nosmilies]> checked="checked"</if> />
No: <input name="nosmilies" value="1" type="radio"<if $dpcode[nosmilies]> checked="checked"</if> /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update DP Code" /></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1075188678";}s:14:"dpcode_missing";a:4:{s:8:"category";s:18:"Admin CP - DP Code";s:4:"body";s:117:"<include template="message_header" />
You must specify a tag and a replacement.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"delete_dpcode";a:4:{s:8:"category";s:18:"Admin CP - DP Code";s:4:"body";s:459:"<include template="message_header" />
Are you sure you want to delete the DP Code <b>[$dpcode[tag]]</b>?<br />
<br />
<br />
<form action="dpcode.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$dpcode[dpcodeid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='dpcode.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073363744";}s:13:"smilies_index";a:4:{s:8:"category";s:18:"Admin CP - Smilies";s:4:"body";s:2455:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Smilies</b><br />
<br />
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><form action="smilies.php" method="post"><div><input name="op" type="hidden" value="order" />$smilies<br /></div>
<div class="center"><input type="submit" value="Update Order" /></div></form></td>
</tr>
</table></td>
<td><form enctype="multipart/form-data" action="smilies.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="add" /></div><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Smilie</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Tag:</b><br />
<span class="small">This is the text that will be replaced with the smilie image.</span></td>
<td><input size="60" name="tag" type="text" /></td>
</tr>
<tr>
<td><b>Case insensitive:</b><br />
<span class="small">If this option is enabled, case will not be observed. For example, <i>:p</i> would be the same as <i>:P</i>.</span></td>
<td>Yes:<input value="1" name="insensitive" type="radio" /> No:<input name="insensitive" value="0" type="radio" checked="checked" /></td>
</tr>
<tr>
<td><b>Name:</b><br />
<span class="small">Give the smilie a name.</span></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">Entering a <b>0</b> (zero) will hide the smilie.</span></td>
<td><input size="60" name="ordered" type="text" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td style="white-space: nowrap"><input name="transfer" type="radio" value="upload" checked="checked" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Smilie" /></div></td>
</tr>
<include template="form_footer" />
</table></form></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073445407";}s:14:"smilies_smilie";a:4:{s:8:"category";s:18:"Admin CP - Smilies";s:4:"body";s:437:"<input name="smilie_$smilie[smilieid]" type="text" size="1" class="center" value="$smilie[ordered]" /> <img alt="$smilie[name]" src="$smilie[parsed_image]" /> <b>$smilie[tag]</b> <span class="small">[</span><a class="linksmall" href="smilies.php?op=edit&amp;id=$smilie[smilieid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="smilies.php?op=delete&amp;id=$smilie[smilieid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"smilies_missing";a:4:{s:8:"category";s:18:"Admin CP - Smilies";s:4:"body";s:131:"<include template="message_header" />
You must specify a tag, name, image, and display order.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"edit_smilie";a:4:{s:8:"category";s:18:"Admin CP - Smilies";s:4:"body";s:2987:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="smilies.php"><b>Smilies</b></a> <b>&gt; Edit Smilie</b><br />
<br />
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><form action="smilies.php" method="post"><div class="center">[<a href="smilies.php">Add New Smilie</a>]<br />
<br /></div>
<div><input name="op" type="hidden" value="order" />$smilies<br /></div>
<div class="center"><input type="submit" value="Update Order" /></div></form></td>
</tr>
</table></td>
<td><form enctype="multipart/form-data" action="smilies.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$smilie[smilieid]" /></div><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Smilie - $smilie[tag]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Tag:</b><br />
<span class="small">This is the text that will be replaced with the smilie image.</span></td>
<td><input size="60" name="tag" type="text" value="$smilie[tag]" /></td>
</tr>
<tr>
<td><b>Case insensitive:</b><br />
<span class="small">If this option is enabled, case will not be observed. For example, <i>:p</i> would be the same as <i>:P</i>.</span></td>
<td>Yes:<input value="1" name="insensitive" type="radio"<if $smilie[insensitive]==1> checked="checked"</if> /> No:<input name="insensitive" value="0" type="radio"<if $smilie[insensitive]==0> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Name:</b><br />
<span class="small">Give the smilie a name.</span></td>
<td><input size="60" name="name" type="text" value="$smilie[name]" /></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">Entering a <b>0</b> (zero) will hide the smilie.</span></td>
<td><input size="60" name="ordered" type="text" value="$smilie[ordered]" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td style="white-space: nowrap"><input name="transfer" type="radio" value="current" checked="checked" /> <span class="small">Use current image:</span> <img alt="$smilie[name]" src="$smilie[parsed_image]" /><br />
<input name="transfer" type="radio" value="upload" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Smilie" /></div></td>
</tr>
<include template="form_footer" />
</table></form></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073446235";}s:13:"delete_smilie";a:4:{s:8:"category";s:18:"Admin CP - Smilies";s:4:"body";s:503:"<include template="message_header" />
Are you sure you want to delete <b>$smilie[tag]</b> <img alt="$smilie[name]" src="$smilie[parsed_image]" />?<br />
<br />
<br />
<form action="smilies.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$smilie[smilieid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='smilies.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073446263";}s:9:"edit_user";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:17028:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_dialog.js"></script>
</if>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; Edit User</b><br />
<br />
<form enctype="multipart/form-data" action="users.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$user_result[userid]" />
<input id="parsed_signature" type="hidden" value="$parsedmessage" /></div>
<div class="center"><table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Edit User - $user_result[name]</td>
</tr>
<include template="form_header" />
<tr>
<td colspan="3" class="heading">Required Information</td>
</tr>
<tr>
<td><b>Username:</b></td><td colspan="2"><input name="name" type="text" size="60" value="$user_result[name]" /></td>
</tr>
<tr>
<td><b>Primary group:</b><br />
<span class="small">The user will receive his or her title and username display format from this group.</span></td><td colspan="2"><select name="groupid">$groups</select></td>
</tr>
<tr valign="top">
<td><b>Other groups:</b><br />
<span class="small">These are other groups to which the user belongs.</span></td><td class="small" style="white-space: nowrap">$usergroups_col1</td><td class="small" style="white-space: nowrap">$usergroups_col2</td>
</tr>
<tr>
<td><b>Email address:</b></td><td colspan="2"><input name="email" type="text" size="60" value="$user_result[email]" /></td>
</tr>
<tr>
<td colspan="3" class="heading">Instant Messengers</td>
</tr>
<tr>
<td><b>AOL Instant Messenger:</b></td><td colspan="2"><input name="aol" type="text" size="60" value="$user_result[aol]" /></td>
</tr>
<tr>
<td><b>ICQ:</b></td><td colspan="2"><input name="icq" type="text" size="60" value="$user_result[icq]" /></td>
</tr>
<tr>
<td><b>MSN Messenger:</b></td><td colspan="2"><input name="msn" type="text" size="60" value="$user_result[msn]" /></td>
</tr>
<tr>
<td><b>Yahoo Instant Messenger:</b></td><td colspan="2"><input name="yahoo" type="text" size="60" value="$user_result[yahoo]" /></td>
</tr>
<tr>
<td colspan="3" class="heading">Optional Information</td>
</tr>
<tr>
<td><b>Number of posts:</b><br />
<span class="small">This is the user's post count. You do not have to make it match the actual number of posts the user has.</span></td><td colspan="2"><input name="posts" type="text" size="60" value="$user_result[posts]" /></td>
</tr>
<tr>
<td><b>Custom title:</b></td><td colspan="2"><input name="title" type="text" size="60" value="$user_result[title]" /></td>
</tr>
<tr>
<td><b>Join date:</b><br />
<span class="small">You must enter this date in <b>YYYY-MM-DD HH:MM:SS</b> format.</span></td><td colspan="2"><input name="joindate" type="text" size="60" value="$user_result[joindate]" /></td>
</tr>
<tr>
<td><b>Hide email address:</b><br />
<span class="small">This option enables you to hide your email address from users on the site.</span></td><td>Yes:<input name="hide_email" type="radio" value="1"<if $user_result[hide_email]> checked="checked"</if> /> No:<input name="hide_email" type="radio" value="0"<if !$use_resultr[hide_email]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Invisible on Who's Online list:</b><br />
<span class="small">This option will prevent you from being displayed on the Who's Online list.</span></td><td>Yes:<input name="invisible" type="radio" value="1"<if $user_result[invisible]> checked="checked"</if> /> No:<input name="invisible" type="radio" value="0"<if !$user_result[invisible]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Mark threads as read after reading them:</b><br />
<span class="small">When this option is enabled, threads will be marked as read when you read them, instead of requiring you to leave the forum for a set amount of time first.</span></td><td colspan="2">Yes:<input name="markread" type="radio" value="1"<if $user_result[markread]> checked="checked"</if> /> No:<input name="markread" type="radio" value="0"<if !$user_result[markread]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Notify when a new private message is received:</b><br />
<span class="small">Enable this option if you wish to receive an email when you receive a private message.</span></td><td colspan="2">Yes:<input name="notify_pm" type="radio" value="1"<if $user_result[notify_pm]> checked="checked"</if> /> No:<input name="notify_pm" type="radio" value="0"<if !$user_result[notify_pm]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Quick reply:</b><br />
<span class="small">Enable quick reply to place a small reply box at the end of each thread.</span></td>
<td colspan="2">Multiline:<input name="quick_reply" type="radio" value="multi"<if $user_result[quick_reply]=="multi"> checked="checked"</if> /> Single line:<input name="quick_reply" type="radio" value="single"<if $user_result[quick_reply]=="single"> checked="checked"</if> /> None:<input name="quick_reply" type="radio" value="none"<if $user_result[quick_reply]=="none"> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Receive email notifications for threads by default:</b><br />
<span class="small">Enable this if you wish to receive email notification of new posts in threads in which you have posted, by default. This can also be enabled and disabled on an individual thread basis when posting.</span></td><td>Yes:<input name="subscribe_email" type="radio" value="1"<if $user_result[subscribe_email]> checked="checked"</if> /> No:<input name="subscribe_email" type="radio" value="0"<if !$user_result[subscribe_email]> checked="checked"</if>/></td>
</tr>
<tr>
<td><b>Receive mail from the administrators:</b><br /><span class="small">The administrators may wish to send out automated mailings to certain groups of members from time to time. If you wish not to receive these mailings, please set this to <b>No</b>.</span></td><td colspan="2">Yes:<input name="massmail" type="radio" value="1"<if $user_result[massmail]> checked="checked"</if> /> No:<input name="massmail" type="radio" value="0"<if !$user_result[massmail]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show avatars:</b><br />
<span class="small">Avatars are the small pictures that are shown under the names of some members. You can choose not to display them with this option.</span></td><td>Yes:<input name="show_avatars" type="radio" value="1"<if $user_result[show_avatars]> checked="checked"</if> /> No:<input name="show_avatars" type="radio" value="0"<if !$user_result[show_avatars]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show images:</b><br />
<span class="small">If you are on a slow internet connection, you may elect to show links to images, instead of actually displaying images inside posts.</span></td><td colspan="2">Yes:<input name="img" type="radio" value="1"<if $user_result[img]> checked="checked"</if> /> No:<input name="img" type="radio" value="0"<if !$user_result[img]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show popup box when a new private message is received:</b><br />
<span class="small">This will display a popup box when you receive a new private message.</span></td><td colspan="2">Yes:<input name="pm_popup" type="radio" value="1"<if $user_result[pm_popup]> checked="checked"</if> /> No:<input name="pm_popup" type="radio" value="0"<if !$user_result[pm_popup]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show signatures:</b><br />
<span class="small">You may turn the display of signatures under posts on or off with this option.</span></td><td>Yes:<input name="displaysignatures" type="radio" value="1"<if $user_result[displaysignatures]> checked="checked"</if> /> No:<input name="displaysignatures" type="radio" value="0"<if !$user_result[displaysignatures]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Subscribe to threads by default:</b><br />
<span class="small">With this option enabled, you will automatically subscribe to threads in which you post. Subscribing to threads causes them to be shown in your user control panel when new posts are made to the threads. This can also be enabled or disabled for each thread while posting.</span></td><td>Yes:<input name="subscribe" type="radio" value="1"<if $user_result[subscribe]> checked="checked"</if> /> No:<input name="subscribe" type="radio" value="0"<if !$user_result[subscribe]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use private messaging:</b><br />
<span class="small">Enables/disables the private messaging system, which allows you to talk privately with other forum members.</span></td><td colspan="2">Yes:<input name="pm" type="radio" value="1"<if $user_result[pm]> checked="checked"</if> /> No:<input name="pm" type="radio" value="0"<if !$user_result[pm]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use WYSIWYG for posting:</b><br />
<span class="small">This allows you to see the formatting in your post as you make the post, and allows you to use friendly toolbar controls to format text. Internet Explorer 6.0 or higher for Windows or Mozilla 1.3 across any platform is required.</span></td><td>Yes:<input name="use_wysiwyg" type="radio" value="1"<if $user_result[use_wysiwyg]> checked="checked"</if> /> No:<input name="use_wysiwyg" type="radio" value="0"<if !$user_result[use_wysiwyg]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use signature in posts by default:</b><br />
<span class="small"></span></td><td>Yes:<input name="usesignature" type="radio" value="1"<if $user_result[usesignature]> checked="checked"</if> /> No:<input name="usesignature" type="radio" value="0"<if !$user_result[usesignature]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Style:</b><br />
<span class="small">Choose the appearance you wish to have for the site.</span></td><td colspan="2"><select name="stylesetid">$stylesets</select></td>
</tr>
<tr>
<td><b>Time zone:</b><br />
<span class="small">Choose the method you would like to use to determine your timezone. Note that automatic timezone detection requires Javascript to be enabled.</span></td><td colspan="2">
<span class="small"><input type="radio" name="auto_time_zone" value="1"<if $user_result[auto_time_zone]> checked="checked"</if> /> Automatically Detect Your Timezone<br />
<input type="radio" name="auto_time_zone" value="0"<if !$user_result[auto_time_zone]> checked="checked"</if> /> Use the following Settings:
<br /><br /></span><div style="margin-left:35px">
<select name="time_zone"><option value="-12"<if $user_result[time_zone]=="-12"> selected="selected"</if>>(GMT-12:00) International Date Line West</option><option value="-11"<if $user_result[time_zone]=="-11"> selected="selected"</if>>(GMT-11:00) Midway Island, Samoa</option><option value="-10"<if $user_result[time_zone]=="-10"> selected="selected"</if>>(GMT-10:00) Hawaii</option><option value="-9"<if $user_result[time_zone]=="-9"> selected="selected"</if>>(GMT-9:00) Alaska</option><option value="-8"<if $user_result[time_zone]=="-8"> selected="selected"</if>>(GMT-8:00) Pacific Time (US &amp; Canada); Tijuana</option><option value="-7"<if $user_result[time_zone]=="-7"> selected="selected"</if>>(GMT-7:00) Mountain Time (US &amp; Canada)</option><option value="-6"<if $user_result[time_zone]=="-6"> selected="selected"</if>>(GMT-6:00) Central Time (US &amp; Canada)</option><option value="-5"<if $user_result[time_zone]=="-5"> selected="selected"</if>>(GMT-5:00) Eastern Time (US &amp; Canada)</option><option value="-4"<if $user_result[time_zone]=="-4"> selected="selected"</if>>(GMT-4:00) Atlantic Time (Canada)</option><option value="-3"<if $user_result[time_zone]=="-3"> selected="selected"</if>>(GMT-3:00) Greenland</option><option value="-2"<if $user_result[time_zone]=="-2"> selected="selected"</if>>(GMT-2:00) Mid-Atlantic</option><option value="-1"<if $user_result[time_zone]=="-1"> selected="selected"</if>>(GMT-1:00) Cape Verde Is.</option><option value="0"<if !$user_result[time_zone]> selected="selected"</if>>(GMT) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option><option value="1"<if $user_result[time_zone]=="1"> selected="selected"</if>>(GMT+1:00) Brussels, Copenhagen, Madrid, Paris</option><option value="2"<if $user_result[time_zone]=="2"> selected="selected"</if>>(GMT+2:00) Cairo</option><option value="3"<if $user_result[time_zone]=="3"> selected="selected"</if>>(GMT+3:00) Kuwait, Riyadh</option><option value="4"<if $user_result[time_zone]=="4"> selected="selected"</if>>(GMT+4:00) Baku, Tbilisi, Yerevan</option><option value="5"<if $user_result[time_zone]=="5"> selected="selected"</if>>(GMT+5:00) Islamabad, Karachi, Tashkent</option><option value="6"<if $user_result[time_zone]=="6"> selected="selected"</if>>(GMT+6:00) Astana, Dhaka</option><option value="7"<if $user_result[time_zone]=="7"> selected="selected"</if>>(GMT+7:00) Bangkok, Hanoi, Jakarta</option><option value="8"<if $user_result[time_zone]=="8"> selected="selected"</if>>(GMT+8:00) Beijing, Chongqing, Hong Kong, Urumqi</option><option value="9"<if $user_result[time_zone]=="9"> selected="selected"</if>>(GMT+9:00) Osaka, Sapporo, Tokyo</option><option value="10"<if $user_result[time_zone]=="10"> selected="selected"</if>>(GMT+10:00) Canberra, Melbourne, Sydney</option><option value="11"<if $user_result[time_zone]=="11"> selected="selected"</if>>(GMT+11:00) Magadan, Solomon Is., New Caledonia</option><option value="12"<if $user_result[time_zone]=="12"> selected="selected"</if>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option></select><br /><span class="small"><input type="checkbox" value="1" name="time_zone_dst" id="time_zone_dst"<if $user_result[time_zone_dst]> checked="checked"</if> /> User is affected by Daylight Savings Time<br /><input type="checkbox" value="1" name="southern_hemisphere" id="southern_hemisphere"<if $user_result[southern_hemisphere]> checked="checked"</if> /> User lives in the southern hemisphere</span>
</div></td>
</tr>
<tr>
<td><b>Mark threads as read after being inactive:</b><br />
<span class="small">If you'd like all threads to be marked as read after a certain period of inactivity, put this amount of time here in minutes. Otherwise, type <b>0</b> (zero).</span></td><td colspan="2"><input name="markread_time" type="text" size="60" value="$user_result[markread_time]" /></td>
</tr>
<tr>
<td><b>Website:</b></td><td colspan="2"><input name="website" type="text" size="60" value="<if $user_result[website]>$user_result[website]<else />http://</if>" /></td>
</tr>
<tr>
<td><b>Location:</b><br />
<span class="small">Where you live</span></td><td colspan="2"><input name="location" type="text" size="60" value="$user_result[location]" /></td>
</tr>
$customfields
<tr>
<td><b>Signature:</b></td>
<td colspan="2">
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="signatureDiv"><iframe id="signatureIframe"></iframe></div>');
//-->
</script>
<textarea name="signature" id="signature" style="width: 100%" rows="5" cols="50">$message</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('signature');
-->
</script></if>
</td>
</tr>
<tr>
<td colspan="3" class="heading">Avatar</td>
</tr>
<tr>
<td><b>Use an avatar:</b></td><td colspan="2">Yes:<input name="useavatar" type="radio" value="1" checked="checked" /> No:<input name="useavatar" type="radio" value="0" /></td>
</tr>
<if $user_result[parsed_avatar]>
<tr>
<td><b>Current avatar:</b></td><td colspan="2"><img alt="$user_result[name]'s avatar" src="$user_result[parsed_avatar]" /></td>
</tr>
</if>
<tr>
<td><b>Upload an avatar:</b></td><td colspan="2"><input name="image" type="file" size="47" /></td>
</tr>
<tr>
<td colspan="3" class="heading">Password</td>
</tr>
<tr>
<td><b>Password:</b><br />
<span class="small">Only enter a password here if you are changing the user's password.</span></td><td colspan="2"><input name="password" type="password" size="60" /></td>
</tr>
<tr>
<td><b>Confirm password:</b><br />
<span class="small">Only enter a password here if you are changing the user's password.</span></td><td colspan="2"><input name="password_confirm" type="password" size="60" /></td>
</tr>
<tr>
<td colspan="3" class="center"><input type="submit" value="Update User" /> <input type="button" onclick="window.location='users.php?op=doipcheck&amp;userid=$user_result[userid]'" value="Check IP" /> <input type="button" onclick="window.location='users.php?op=delete&amp;id=$user_result[userid]'" value="Delete User" /> <input type="button" onclick="window.location='users.php?op=logout&amp;id=$user_result[userid]'" value="Log User Off" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1077772157";}s:15:"users_duplicate";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:153:"<include template="message_header" />
A user with the name <b>$name</b> already exists. Please choose another name.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"edit_user_redirect";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:158:"<include template="redirect_header" />
The user has been edited. You are now being returned to the users control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"delete_user";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:457:"<include template="message_header" />
Are you sure you want to delete user <b>$user_result[name]</b>?<br />
<br />
<br />
<form action="users.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$user_result[userid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='users.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073765606";}s:20:"delete_user_redirect";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:159:"<include template="redirect_header" />
The user has been deleted. You are now being returned to the users control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"users_user";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:297:"&nbsp;&nbsp;&nbsp;<span class="small">$user_result[name] [</span><a class="linksmall" href="users.php?op=edit&amp;id=$user_result[userid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="users.php?op=delete&amp;id=$user_result[userid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:8:"add_user";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:12706:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_dialog.js"></script>
</if>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; Add User</b><br />
<br />
<form enctype="multipart/form-data" action="users.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doadd" />
<input id="parsed_signature" type="hidden" value="" /></div>
<div class="center"><table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Add User</td>
</tr>
<include template="form_header" />
<tr>
<td colspan="3" class="heading">Required Information</td>
</tr>
<tr>
<td><b>Username:</b></td><td colspan="2"><input name="name" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Primary group:</b><br />
<span class="small">The user will receive his or her title and username display format from this group.</span></td><td colspan="2"><select name="groupid">$groups</select></td>
</tr>
<tr valign="top">
<td><b>Other groups:</b><br />
<span class="small">These are other groups to which the user belongs.</span></td><td class="small" style="white-space: nowrap">$usergroups_col1</td><td class="small" style="white-space: nowrap">$usergroups_col2</td>
</tr>
<tr>
<td><b>Password:</b></td><td colspan="2"><input name="password" type="password" size="60" /></td>
</tr>
<tr>
<td><b>Confirm password:</b></td><td colspan="2"><input name="password_confirm" type="password" size="60" /></td>
</tr>
<tr>
<td><b>Email address:</b></td><td colspan="2"><input name="email" type="text" size="60" /></td>
</tr>
<tr>
<td colspan="3" class="heading">Instant Messengers</td>
</tr>
<tr>
<td><b>AOL Instant Messenger:</b></td><td colspan="2"><input name="aol" type="text" size="60" /></td>
</tr>
<tr>
<td><b>ICQ:</b></td><td colspan="2"><input name="icq" type="text" size="60" /></td>
</tr>
<tr>
<td><b>MSN Messenger:</b></td><td colspan="2"><input name="msn" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Yahoo Instant Messenger:</b></td><td colspan="2"><input name="yahoo" type="text" size="60" /></td>
</tr>
<tr>
<td colspan="3" class="heading">Optional Information</td>
</tr>
<tr>
<td><b>Number of posts:</b><br />
<span class="small">This is the user's post count. You do not have to make it match the actual number of posts the user has.</span></td><td colspan="2"><input name="posts" type="text" size="60" value="0" /></td>
</tr>
<tr>
<td><b>Custom title:</b></td><td colspan="2"><input name="title" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Join date:</b><br />
<span class="small">You must enter this date in <b>YYYY-MM-DD HH:MM:SS</b> format.</span></td><td colspan="2"><input name="joindate" type="text" size="60" value="$joindate" /></td>
</tr>
<tr>
<td><b>Hide email address:</b><br />
<span class="small">This option enables you to hide your email address from users on the site.</span></td><td>Yes:<input name="hide_email" type="radio" value="1" /> No:<input name="hide_email" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Invisible on Who's Online list:</b><br />
<span class="small">This option will prevent you from being displayed on the Who's Online list.</span></td><td colspan="2">Yes:<input name="invisible" type="radio" value="1" /> No:<input name="invisible" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Mark threads as read after reading them:</b><br />
<span class="small">When this option is enabled, threads will be marked as read when you read them, instead of requiring you to leave the forum for a set amount of time first.</span></td><td colspan="2">Yes:<input name="markread" type="radio" value="1" checked="checked" /> No:<input name="markread" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Notify when a new private message is received:</b><br />
<span class="small">Enable this option if you wish to receive an email when you receive a private message.</span></td><td colspan="2">Yes:<input name="notify_pm" type="radio" value="1" /> No:<input name="notify_pm" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Quick reply:</b><br />
<span class="small">Enable quick reply to place a small reply box at the end of each thread.</span></td>
<td colspan="2">Multiline:<input name="quick_reply" type="radio" value="multi" checked="checked" /> Single line:<input name="quick_reply" type="radio" value="single" /> None:<input name="quick_reply" type="radio" value="none" /></td>
</tr>
<tr>
<td><b>Receive email notifications for threads by default:</b><br />
<span class="small">Enable this if you wish to receive email notification of new posts in threads in which you have posted, by default. This can also be enabled and disabled on an individual thread basis when posting.</span></td><td colspan="2">Yes:<input name="subscribe_email" type="radio" value="1" /> No:<input name="subscribe_email" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Receive mail from the administrators:</b><br /><span class="small">The administrators may wish to send out automated mailings to certain groups of members from time to time. If you wish not to receive these mailings, please set this to <b>No</b>.</span></td><td colspan="2">Yes:<input name="massmail" type="radio" value="1" checked="checked" /> No:<input name="massmail" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Show avatars:</b><br />
<span class="small">Avatars are the small pictures that are shown under the names of some members. You can choose not to display them with this option.</span></td><td>Yes:<input name="show_avatars" type="radio" value="1" checked="checked" /> No:<input name="show_avatars" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Show images:</b><br />
<span class="small">If you are on a slow internet connection, you may elect to show links to images, instead of actually displaying images inside posts.</span></td><td colspan="2">Yes:<input name="img" type="radio" value="1" checked="checked" /> No:<input name="img" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Show popup box when a new private message is received:</b><br />
<span class="small">This will display a popup box when you receive a new private message.</span></td><td colspan="2">Yes:<input name="pm_popup" type="radio" value="1" /> No:<input name="pm_popup" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Show signatures:</b><br />
<span class="small">You may turn the display of signatures under posts on or off with this option.</span></td><td colspan="2">Yes:<input name="displaysignatures" type="radio" value="1" checked="checked" /> No:<input name="displaysignatures" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Subscribe to threads by default:</b><br />
<span class="small">With this option enabled, you will automatically subscribe to threads in which you post. Subscribing to threads causes them to be shown in your user control panel when new posts are made to the threads. This can also be enabled or disabled for each thread while posting.</span></td><td colspan="2">Yes:<input name="subscribe" type="radio" value="1" checked="checked" /> No:<input name="subscribe" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Use private messaging:</b><br />
<span class="small">Enables/disables the private messaging system, which allows you to talk privately with other forum members.</span></td><td colspan="2">Yes:<input name="pm" type="radio" value="1" checked="checked" /> No:<input name="pm" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Use signature in posts by default:</b><br />
<span class="small">This option allows you to decide whether the Show signature box is checked by default when posting.</span></td><td>Yes:<input name="usesignature" type="radio" value="1" checked="checked" /> No:<input name="usesignature" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Use WYSIWYG for posting:</b><br />
<span class="small">This allows you to see the formatting in your post as you make the post, and allows you to use friendly toolbar controls to format text. Internet Explorer 6.0 or higher for Windows or Mozilla 1.3 or higher across any platform is required.</span></td><td>Yes:<input name="use_wysiwyg" type="radio" value="1" checked="checked" /> No:<input name="use_wysiwyg" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Style:</b><br />
<span class="small">Choose the appearance you wish to have for the site.</span></td><td colspan="2"><select name="stylesetid">$stylesets</select></td>
</tr>
<tr>
<td><b>Time zone:</b><br />
<span class="small">Choose the method you would like to use to determine your timezone. Note that automatic timezone detection requires Javascript to be enabled.</span></td><td colspan="2">
<span class="small"><input type="radio" name="auto_time_zone" value="1" checked="checked" /> Automatically Detect Your Timezone<br />
<input type="radio" name="auto_time_zone" value="0" /> Use the following Settings:<br /><br /></span><div style="margin-left:35px">
<select name="time_zone"><option value="-12">(GMT-12:00) International Date Line West</option><option value="-11">(GMT-11:00) Midway Island, Samoa</option><option value="-10">(GMT-10:00) Hawaii</option><option value="-9">(GMT-9:00) Alaska</option><option value="-8">(GMT-8:00) Pacific Time (US &amp; Canada); Tijuana</option><option value="-7">(GMT-7:00) Mountain Time (US &amp; Canada)</option><option value="-6">(GMT-6:00) Central Time (US &amp; Canada)</option><option value="-5">(GMT-5:00) Eastern Time (US &amp; Canada)</option><option value="-4">(GMT-4:00) Atlantic Time (Canada)</option><option value="-3">(GMT-3:00) Greenland</option><option value="-2">(GMT-2:00) Mid-Atlantic</option><option value="-1">(GMT-1:00) Cape Verde Is.</option><option value="0" selected="selected">(GMT) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option><option value="1">(GMT+1:00) Brussels, Copenhagen, Madrid, Paris</option><option value="2">(GMT+2:00) Cairo</option><option value="3">(GMT+3:00) Kuwait, Riyadh</option><option value="4">(GMT+4:00) Baku, Tbilisi, Yerevan</option><option value="5">(GMT+5:00) Islamabad, Karachi, Tashkent</option><option value="6">(GMT+6:00) Astana, Dhaka</option><option value="7">(GMT+7:00) Bangkok, Hanoi, Jakarta</option><option value="8">(GMT+8:00) Beijing, Chongqing, Hong Kong, Urumqi</option><option value="9">(GMT+9:00) Osaka, Sapporo, Tokyo</option><option value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option><option value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option><option value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option></select><br /><span class="small"><input type="checkbox" value="1" name="time_zone_dst" id="time_zone_dst" checked="checked" /> User is affected by Daylight Savings Time<br /><input type="checkbox" value="1" name="southern_hemisphere" id="southern_hemisphere" /> User lives in the southern hemisphere</span>
</div></td>
</tr>
<tr>
<td><b>Mark threads as read after being inactive:</b><br />
<span class="small">If you'd like all threads to be marked as read after a certain period of inactivity, put this amount of time here in minutes. Otherwise, type <b>0</b> (zero).</span></td><td colspan="2"><input name="markread_time" type="text" size="60" value="0" /></td>
</tr>
<tr>
<td><b>Website:</b></td><td colspan="2"><input name="website" type="text" size="60" value="http://" /></td>
</tr>
<tr>
<td><b>Upload an avatar:</b></td><td colspan="2"><input name="image" type="file" size="46" /></td>
</tr>
<tr>
<td><b>Location:</b><br />
<span class="small">Where you live</span></td><td colspan="2"><input name="location" type="text" size="60" /></td>
</tr>
$customfields
<tr>
<td><b>Signature:</b></td>
<td colspan="2">
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="signatureDiv"><iframe id="signatureIframe"></iframe></div>');
//-->
</script>
<textarea name="signature" id="signature" style="width: 100%" rows="5" cols="50">$user_result[signature]</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('signature');
-->
</script></if>
</td>
</tr>
<tr>
<td colspan="3" class="center"><input type="submit" value="Add User" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1077772157";}s:13:"users_missing";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:129:"<include template="message_header" />
You must specify a name, password, and email address.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"users_password";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:113:"<include template="message_header" />
The specified passwords do not match.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"edit_style_redirect";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:161:"<include template="redirect_header" />
The style has been updated. You are now being returned to the styles control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"stylesets_index";a:4:{s:8:"category";s:21:"Admin CP - Style Sets";s:4:"body";s:6780:"<include template="header" />
<form enctype="multipart/form-data" action="stylesets.php" method="post">
<div><input name="op" type="hidden" value="add" />
<input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Style Sets</b>
<br />
<br /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap">$stylesets</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="2">Add New Style Set</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td><td><input size="60" name="name" type="text" value="" /></td>
</tr>
<tr>
<td><b>Logo:</b></td><td><input size="60" name="logo" type="text" value="images/logo.gif" /></td>
</tr>
<tr>
<td><b>Images directory:</b><br />
<span class="small">Do <b>not</b> include a closing <b>/</b> (slash).</span></td><td><input size="60" name="images" type="text" value="images" /></td>
</tr>
<tr>
<td><b>Number separator:</b><br />
<span class="small">Enter the character with which you wish to separate large numbers, in groups of three.</span></td><td><input size="10" name="separator" type="text" value="," /></td>
</tr>
<tr>
<td><b>Character Coding:</b><br />
<span class="small">Use this to set the character set the users browser will use to view this site. <i>(Example: <b>UTF-8</b> (Unicode) or <b>ISO-8859-1</b> (Western Encoding))</i></span></td><td><input size="60" name="charset" type="text" value="ISO-8859-1" /></td>
</tr>
<tr>
<td><b>Enabled:</b></td><td>Yes:<input size="60" name="enabled" type="radio" value="1" checked="checked" /> No:<input size="60" name="enabled" type="radio" value="0" /></td>
</tr>
<tr>
<td class="heading" colspan="2">Style</td>
</tr>
<tr>
<td colspan="2"><input name="style_select" type="radio" value="default" checked="checked" /><span class="small">Create a new copy of the default Deluxe Portal style, and name it:</span> <input name="style_default_name" type="text" size="10" class="small" /><br />
<input name="style_select" type="radio" value="copy" /><span class="small">Copy an existing style:</span> <select name="style_copy" class="small">$styles</select><span class="small">, and name it:</span> <input name="style_copy_name" type="text" size="10" class="small" /><br />
<input name="style_select" type="radio" value="import" /><span class="small">Import a style:</span> <input name="import" type="file" class="small" size="24" /><span class="small">, and name it:</span> <input name="style_import_name" type="text" size="10" class="small" /><br />
<input name="style_select" type="radio" value="existing" /><span class="small">Use an existing style:</span> <select name="style_existing" class="small">$styles</select></td>
</tr>
<tr>
<td class="heading" colspan="2">Templates</td>
</tr>
<tr>
<td colspan="2"><input name="templateset_select" type="radio" value="default" checked="checked" /><span class="small">Create a new copy of the default Deluxe Portal templates, and name it:</span> <input name="templateset_default_name" type="text" size="10" class="small" /><br />
<input name="templateset_select" type="radio" value="copy" /><span class="small">Copy an existing set of templates:</span> <select name="templateset_copy" class="small">$templatesets</select><span class="small">, and name it:</span> <input name="templateset_copy_name" type="text" size="10" class="small" /><br />
<input name="templateset_select" type="radio" value="import" /><span class="small">Import a set of templates:</span> <input name="import_template" type="file" class="small" size="24" /><span class="small">, and name it:</span> <input name="templateset_import_name" type="text" size="10" class="small" /><br />
<input name="templateset_select" type="radio" value="existing" /><span class="small">Use an existing set of templates:</span> <select name="templateset_existing" class="small">$templatesets</select></td>
</tr>
<tr>
<td class="heading" colspan="2">Spacing</td>
</tr>
<tr>
<td><b>Cell spacing:</b><br />
<span class="small">Enter the width of the lines that separate the table cells in pixels.</span></td><td><input size="60" name="cellspacing" type="text" value="1" /></td>
</tr>
<tr>
<td><b>Cell padding:</b><br />
<span class="small">Enter the distance from the edge of table cells to the beginning of the cell content in pixels.</span></td><td><input size="60" name="cellpadding" type="text" value="4" /></td>
</tr>
<tr>
<td><b>Sidebar width:</b></td><td><input size="60" name="sidebar" type="text" value="200px" /></td>
</tr>
<tr>
<td class="heading" colspan="2">Date Formats</td>
</tr>
<tr>
<td><b>Announcements:</b></td><td><input size="60" name="announcement_date_format" type="text" value="n-d-Y" /></td>
</tr>
<tr>
<td><b>Articles:</b></td><td><input size="60" name="frontpage_date_format" type="text" value="l, F j, g:i A" /></td>
</tr>
<tr>
<td><b>Date joined:</b></td><td><input size="60" name="join_date_format" type="text" value="n-d-Y" /></td>
</tr>
<tr>
<td><b>Date joined (in posts):</b></td><td><input size="60" name="join_post_date_format" type="text" value="F Y" /></td>
</tr>
<tr>
<td><b>Edited by:</b></td><td><input size="60" name="editedby_date_format" type="text" value="[isday][day /] [text]at[/text] g:i A[/isday] [text]on[/text] n-d-Y g:i A" /></td>
</tr>
<tr>
<td><b>Front page day separator:</b></td><td><input size="60" name="frontpage_day_date_format" type="text" value="[isday][day /][/isday]l, F d, Y" /></td>
</tr>
<tr>
<td><b>Last post:</b></td><td><input size="60" name="lastpost_date_format" type="text" value="[isday][day /] [text]at[/text] g:i A[/isday]n-d-Y g:i A" /></td>
</tr>
<tr>
<td><b>Log entries:</b></td><td><input size="60" name="log_date_format" type="text" value="n-d-Y [text]at[/text] g:i A" /></td>
</tr>
<tr>
<td><b>Most online:</b></td><td><input size="60" name="most_online_date_format" type="text" value="n-d-Y [text]at[/text] g:i A" /></td>
</tr>
<tr>
<td><b>Post:</b></td><td><input size="60" name="post_date_format" type="text" value="[isday][day /] [text]at[/text] g:i A[/isday]n-d-Y g:i A" /></td>
</tr>
<tr>
<td><b>[day /] Today:</b></td><td><input size="60" name="today_text" type="text" value="Today" /></td>
</tr>
<tr>
<td><b>[day /] Yesterday:</b></td><td><input size="60" name="yesterday_text" type="text" value="Yesterday" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Style Set" /></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1075170520";}s:18:"stylesets_styleset";a:4:{s:8:"category";s:21:"Admin CP - Style Sets";s:4:"body";s:480:"<b>$styleset_result[name]</b> <span class="small">(</span><a class="linksmall" href="users.php?op=search&amp;all=1&amp;all_groups=1&amp;stylesetid=$styleset_result[stylesetid]">$number users</a><span class="small">) [</span><a class="linksmall" href="stylesets.php?op=edit&amp;id=$styleset_result[stylesetid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="stylesets.php?op=delete&amp;id=$styleset_result[stylesetid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1063941856";}s:17:"stylesets_missing";a:4:{s:8:"category";s:21:"Admin CP - Style Sets";s:4:"body";s:148:"<include template="message_header" />
You must fill out a name and all other appropriate sections of the form.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061778589";}s:16:"moderators_index";a:4:{s:8:"category";s:21:"Admin CP - Moderators";s:4:"body";s:460:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Moderators</b>
<br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="0">
<tr>
<td><table class="cellmain" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td>$forums</td>
</tr>
</table></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:20:"moderators_moderator";a:4:{s:8:"category";s:21:"Admin CP - Moderators";s:4:"body";s:339:"$moderator_indent&nbsp;&nbsp;&nbsp;<i>$moderator[username]</i> <span class="small">[</span><a class="linksmall" href="moderators.php?op=edit&amp;id=$moderator[moderatorid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="moderators.php?op=delete&amp;id=$moderator[moderatorid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"moderators_forum";a:4:{s:8:"category";s:21:"Admin CP - Moderators";s:4:"body";s:183:"<b>$forum[name]</b> <span class="small">[</span><a class="linksmall" href="moderators.php?op=add&amp;id=$forum[forumid]">Add Moderator</a><span class="small">]</span><br />$moderators";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"add_moderator";a:4:{s:8:"category";s:21:"Admin CP - Moderators";s:4:"body";s:2895:"<include template="header" />
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="moderators.php"><b>Moderators</b></a> <b>&gt; Add Moderator</b><br />
<br />
<form action="moderators.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doadd" />
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Add Moderator - $forum[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td><td><input name="username" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Forum:</b></td><td><select name="forumid">$forum_choices</select></td>
</tr>
<tr>
<td colspan="2" class="heading">Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('modperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('modperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="modperm" valign="top">
<td class="small" style="white-space: nowrap"><input name="close" type="checkbox" value="1" checked="checked" /> Close threads<br />
<input name="copymove" type="checkbox" value="1" checked="checked" /> Copy/move threads<br />
<input name="deleteposts" type="checkbox" value="1" checked="checked" /> Delete posts<br />
<input name="deletethreads" type="checkbox" value="1" checked="checked" /> Delete threads<br />
<input name="editpolls" type="checkbox" value="1" checked="checked" /> Edit polls</td>
<td class="small" style="white-space: nowrap"><input name="editposts" type="checkbox" value="1" checked="checked" /> Edit posts<br />
<input name="editthreads" type="checkbox" value="1" checked="checked" /> Edit threads<br />
<input name="exemptfloodcheck" type="checkbox" value="1" checked="checked" /> Exempt from flood check<br />
<input name="massdelete" type="checkbox" value="1" /> Mass delete threads<br />
<input name="massmove" type="checkbox" value="1" /> Mass move threads</td>
<td class="small" style="white-space: nowrap"><input name="announcements" type="checkbox" value="1" checked="checked" /> Post announcements<br />
<input name="sticky" type="checkbox" value="1" checked="checked" /> Stick threads<br />
<input name="viewips" type="checkbox" value="1" checked="checked" /> View IP addresses<br />
<input name="log" type="checkbox" value="1" checked="checked" /> View moderator log</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Add Moderator" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073436809";}s:16:"delete_moderator";a:4:{s:8:"category";s:21:"Admin CP - Moderators";s:4:"body";s:653:"<include template="message_header" />
Are you sure you want to remove moderator <b>$moderator[username]</b> from <b>$forum[name]</b>?<br />
<br />
<br />
<form action="moderators.php" method="post">
<div>
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$moderator[moderatorid]" />
<input name="subforums" type="checkbox" value="1" checked="checked" /> Remove this moderator from all sub-forums of this forum<br />
<br /></div>
<div class="center"><input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='moderators.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073437494";}s:14:"edit_moderator";a:4:{s:8:"category";s:21:"Admin CP - Moderators";s:4:"body";s:3492:"<include template="header" />
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="moderators.php"><b>Moderators</b></a> <b>&gt; Edit Moderator</b><br />
<br />
<form action="moderators.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$moderator[moderatorid]" />
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Edit Moderator - $moderator[username] ($forum[name])</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td><td><input name="username" type="text" size="60" value="$moderator[username]" /></td>
</tr>
<tr>
<td><b>Forum:</b></td><td><select name="forumid">$forum_choices</select></td>
</tr>
<tr>
<td colspan="2" class="heading">Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('modperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('modperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="modperm" valign="top">
<td class="small" style="white-space: nowrap"><input name="close" type="checkbox" value="1"<if $moderator[close]> checked="checked"</if> /> Close threads<br />
<input name="copymove" type="checkbox" value="1"<if $moderator[copymove]> checked="checked"</if> /> Copy/move threads<br />
<input name="deleteposts" type="checkbox" value="1"<if $moderator[deleteposts]> checked="checked"</if> /> Delete posts<br />
<input name="deletethreads" type="checkbox" value="1"<if $moderator[deletethreads]> checked="checked"</if> /> Delete threads<br />
<input name="editpolls" type="checkbox" value="1"<if $moderator[editpolls]> checked="checked"</if> /> Edit polls</td>
<td class="small" style="white-space: nowrap"><input name="editposts" type="checkbox" value="1"<if $moderator[editposts]> checked="checked"</if> /> Edit posts<br />
<input name="editthreads" type="checkbox" value="1"<if $moderator[editthreads]> checked="checked"</if> /> Edit threads<br />
<input name="exemptfloodcheck" type="checkbox" value="1"<if $moderator[exemptfloodcheck]> checked="checked"</if> /> Exempt from flood check<br />
<input name="massdelete" type="checkbox" value="1"<if $moderator[massdelete]> checked="checked"</if> /> Mass delete threads<br />
<input name="massmove" type="checkbox" value="1"<if $moderator[massmove]> checked="checked"</if> /> Mass move threads</td>
<td class="small" style="white-space: nowrap"><input name="announcements" type="checkbox" value="1"<if $moderator[announcements]> checked="checked"</if> /> Post announcements<br />
<input name="sticky" type="checkbox" value="1"<if $moderator[sticky]> checked="checked"</if> /> Stick threads<br />
<input name="viewips" type="checkbox" value="1"<if $moderator[viewips]> checked="checked"</if> /> View IP addresses<br />
<input name="log" type="checkbox" value="1"<if $moderator[log]> checked="checked"</if> /> View moderator log</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Update Moderator" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073436883";}s:12:"fields_index";a:4:{s:8:"category";s:24:"Admin CP - Custom Fields";s:4:"body";s:1896:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Custom Profile Fields</b><br />
<br />
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><form action="fields.php" method="post"><div><input name="op" type="hidden" value="order" />$custom_fields<br /></div>
<div class="center"><input type="submit" value="Update Order" /></div></form></td>
</tr>
</table></td>
<td><form action="fields.php" method="post"><div><input name="op" type="hidden" value="add" /></div><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Profile Field</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Description:</b><br />
<span class="small">This will be displayed underneath the custom field title.</span></td>
<td><input size="60" name="description" type="text" /></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">Enter the order in which you want this field to be displayed, in relation to the others. Must be a number.</span></td>
<td><input size="60" name="ordered" type="text" /></td>
</tr>
<tr>
<td><b>Options:</b></td>
<td class="small"><input name="edit" type="checkbox" value="1" checked="checked" /> Users can edit this field<br />
<input name="view" type="checkbox" value="1" checked="checked" /> Other users can view the contents of this field</td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Profile Field" /></td>
</tr>
<include template="form_footer" />
</table></form></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:16:"fields_duplicate";a:4:{s:8:"category";s:24:"Admin CP - Custom Fields";s:4:"body";s:129:"<include template="message_header" />
A custom profile field with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"fields_field";a:4:{s:8:"category";s:24:"Admin CP - Custom Fields";s:4:"body";s:389:"<input name="field_$field[customfieldid]" type="text" size="1" value="$field[ordered]" class="center" /> <b>$field[name]</b> <span class="small">[</span><a class="linksmall" href="fields.php?op=edit&amp;id=$field[customfieldid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="fields.php?op=delete&amp;id=$field[customfieldid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"edit_field";a:4:{s:8:"category";s:24:"Admin CP - Custom Fields";s:4:"body";s:2248:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="fields.php"><b>Custom Profile Fields</b></a> <b>&gt; Edit Profile Field</b><br />
<br />
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><form action="fields.php" method="post"><div class="center">[<a href="fields.php">Add New Profile Field</a>]<br />
<br /></div>
<div><input name="op" type="hidden" value="order" />$custom_fields<br /></div>
<div class="center"><input type="submit" value="Update Order" /></div></form></td>
</tr>
</table></td>
<td><form action="fields.php" method="post"><div>
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$field[customfieldid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Profile Field - $field[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$field[name]" /></td>
</tr>
<tr>
<td><b>Description:</b><br />
<span class="small">This will be displayed underneath the custom field title.</span></td>
<td><input size="60" name="description" type="text" value="$field[description]" /></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">Enter the order in which you want this field to be displayed, in relation to the others. Must be a number.</span></td>
<td><input size="60" name="ordered" type="text" value="$field[ordered]" /></td>
</tr>
<tr>
<td><b>Options:</b></td>
<td class="small"><input name="edit" type="checkbox" value="1"<if $field[edit]> checked="checked"</if> /> Users can edit this field<br />
<input name="view" type="checkbox" value="1"<if $field[view]> checked="checked"</if> /> Other users can view the contents of this field</td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Profile Field" /></td>
</tr>
<include template="form_footer" />
</table></form></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073446414";}s:14:"fields_missing";a:4:{s:8:"category";s:24:"Admin CP - Custom Fields";s:4:"body";s:130:"<include template="message_header" />
You must specify a name for your custom profile field.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"delete_field";a:4:{s:8:"category";s:24:"Admin CP - Custom Fields";s:4:"body";s:470:"<include template="message_header" />
Are you sure you want to delete custom profile field <b>$field[name]</b>?<br />
<br />
<br />
<form action="fields.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$field[customfieldid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='fields.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073289619";}s:12:"topics_topic";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:381:"<td class="center"><if $topic[topicid]><img alt="$topic[name]" src="$topic[parsed_image]" /><br />
<b>$topic[name]</b><br />
<span class="small">[</span><a class="linksmall" href="topics.php?op=edit&amp;id=$topic[topicid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="topics.php?op=delete&amp;id=$topic[topicid]">Delete</a><span class="small">]</span></if></td>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058020451";}s:14:"topics_missing";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:115:"<include template="message_header" />
You must specify a name for your topic.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"topics_index";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:474:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Topics</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><div class="center">[<a href="topics.php?op=add">Add New Topic</a>]</div>
<table cellpadding="15">$topics</table></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:10:"edit_topic";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:6129:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="topics.php"><b>Topics</b></a> <b>&gt; Edit Topic</b>
<br />
<br />
<form enctype="multipart/form-data" action="topics.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$topic[topicid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Topic - $topic[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$topic[name]" /></td>
</tr>
<tr>
<td><b>Also post articles into forum:</b><br />
<span class="small">If this option is set, all articles placed into this topic will be posted in the specified forum.</span></td>
<td><select name="forumid"><option value="0">No Forum</option>$forum_choices</select></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td style="white-space: nowrap"><input name="transfer" type="radio" value="current" checked="checked" /> <span class="small">Use current image</span><br />
<input name="transfer" type="radio" value="upload" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Viewing Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('viewperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('viewperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="viewperm" valign="top">
<td class="small" style="white-space: nowrap">$view_groups_col1</td><td class="small" style="white-space: nowrap">$view_groups_col2</td><td class="small" style="white-space: nowrap">$view_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Posting Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('postperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('postperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="postperm" valign="top">
<td class="small" style="white-space: nowrap">$post_groups_col1</td><td class="small" style="white-space: nowrap">$post_groups_col2</td><td class="small" style="white-space: nowrap">$post_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Edit Own Article Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('editperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('editperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="editperm" valign="top">
<td class="small" style="white-space: nowrap">$editown_groups_col1</td><td class="small" style="white-space: nowrap">$editown_groups_col2</td><td class="small" style="white-space: nowrap">$editown_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Edit Others' Articles Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('editotherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('editotherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="editotherperm" valign="top">
<td class="small" style="white-space: nowrap">$editothers_groups_col1</td><td class="small" style="white-space: nowrap">$editothers_groups_col2</td><td class="small" style="white-space: nowrap">$editothers_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Delete Own Article Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('deleteown'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('deleteown'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="deleteown" valign="top">
<td class="small" style="white-space: nowrap">$deleteown_groups_col1</td><td class="small" style="white-space: nowrap">$deleteown_groups_col2</td><td class="small" style="white-space: nowrap">$deleteown_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Delete Others' Articles Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('deleteotherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('deleteotherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="deleteotherperm" valign="top">
<td class="small" style="white-space: nowrap">$deleteothers_groups_col1</td><td class="small" style="white-space: nowrap">$deleteothers_groups_col2</td><td class="small" style="white-space: nowrap">$deleteothers_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Topic" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073713469";}s:12:"delete_topic";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:529:"<include template="message_header" />
Are you sure you want to delete <b>$topic[name]</b>?<br />
<br />
<div class="center"><img alt="$topic[name]" src="$topic[parsed_image]" /></div><br />
<br />
<form action="topics.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$topic[topicid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='topics.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073713563";}s:16:"topics_duplicate";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:114:"<include template="message_header" />
A topic with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"sections_duplicate";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:116:"<include template="message_header" />
A section with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"templates_separator";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:1:",";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"delete_section";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:543:"<include template="message_header" />
Are you sure you want to delete <b>$section[name]</b>?<br />
<br />
<div class="center"><img alt="$section[name]" src="$section[parsed_image]" /></div><br />
<br />
<form action="sections.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$section[sectionid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='sections.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073445306";}s:12:"edit_section";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:6108:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="sections.php"><b>Sections</b></a> <b>&gt; Edit Section</b><br />
<br />
<form enctype="multipart/form-data" action="sections.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$section[sectionid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Section - $section[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$section[name]" /></td>
</tr>
<tr>
<td><b>Show in sidebar:</b></td>
<td>Yes:<input name="sidebar" type="radio" value="1"<if $section[sidebar]> checked="checked"</if> /> No:<input name="smilies" type="radio" value="0"<if !$section[sidebar]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td><input name="transfer" type="radio" value="current" checked="checked" /> <span class="small">Use current image</span><br />
<input name="transfer" type="radio" value="upload" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Viewing Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('viewperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('viewperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="viewperm" valign="top">
<td class="small" style="white-space: nowrap">$view_groups_col1</td><td class="small" style="white-space: nowrap">$view_groups_col2</td><td class="small" style="white-space: nowrap">$view_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Posting Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('postperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('postperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="postperm" valign="top">
<td class="small" style="white-space: nowrap">$post_groups_col1</td><td class="small" style="white-space: nowrap">$post_groups_col2</td><td class="small" style="white-space: nowrap">$post_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Edit Own Article Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('editownperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('editownperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="editownperm" valign="top">
<td class="small" style="white-space: nowrap">$editown_groups_col1</td><td class="small" style="white-space: nowrap">$editown_groups_col2</td><td class="small" style="white-space: nowrap">$editown_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Edit Others' Articles Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('editotherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('editotherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="editotherperm" valign="top">
<td class="small" style="white-space: nowrap">$editothers_groups_col1</td><td class="small" style="white-space: nowrap">$editothers_groups_col2</td><td class="small" style="white-space: nowrap">$editothers_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Delete Own Article Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('deleteownperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('deleteownperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="deleteownperm" valign="top">
<td class="small" style="white-space: nowrap">$deleteown_groups_col1</td><td class="small" style="white-space: nowrap">$deleteown_groups_col2</td><td class="small" style="white-space: nowrap">$deleteown_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Delete Others' Articles Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('deleteotherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('deleteotherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="deleteotherperm" valign="top">
<td class="small" style="white-space: nowrap">$deleteothers_groups_col1</td><td class="small" style="white-space: nowrap">$deleteothers_groups_col2</td><td class="small" style="white-space: nowrap">$deleteothers_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Section" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1144686884";}s:16:"sections_section";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:403:"<td class="center"><if $section[sectionid]><img alt="$section[name]" src="$section[parsed_image]" /><br />
<b>$section[name]</b><br />
<span class="small">[</span><a class="linksmall" href="sections.php?op=edit&amp;id=$section[sectionid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="sections.php?op=delete&amp;id=$section[sectionid]">Delete</a><span class="small">]</span></if></td>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058011537";}s:14:"sections_index";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:482:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Sections</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><div class="center">[<a href="sections.php?op=add">Add New Section</a>]</div>
<table cellpadding="20">$sections</table></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:16:"sections_missing";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:100:"<include template="message_header" />
You must specify a name.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"articles_article";a:4:{s:8:"category";s:19:"Admin CP - Articles";s:4:"body";s:938:"<tr>
<td class="$color"><div class="center">$article_result[articleid]</div></td><td class="$color"><a href="$relativeurl/article.php?id=$article_result[articleid]">$article_result[title]</a></td><td class="$color"><a href="$relativeurl/profile.php?id=$article_result[userid]">$article_result[username]</a></td><td class="$color" style="white-space: nowrap">$article_result[date_posted]</td><td class="$color"><if $article_result[topicid]><a href="$relativeurl/topics.php?id=$article_result[topicid]">$article_result[topicname]</a><else />(none)</if></td><td class="$color"><if $article_result[sectionid]><a href="$relativeurl/sections.php?id=$article_result[sectionid]">$article_result[sectionname]</a><else />(none)</if></td><td class="$color" style="white-space: nowrap"><a href="articles.php?op=edit&amp;id=$article_result[articleid]">Edit</a> - <a href="articles.php?op=delete&amp;id=$article_result[articleid]">Delete</a></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:14:"articles_index";a:4:{s:8:"category";s:19:"Admin CP - Articles";s:4:"body";s:3614:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_dialog.js"></script>
</if>
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<form action="articles.php" method="post" onsubmit="return article_submit()">
<div><input name="op" type="hidden" value="add" />
<input name="parsed_message" type="hidden" value="" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Articles</b>
<br />
<br /></div>
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Article</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="80" id="title" name="title" type="text" /></td>
</tr>
<tr>
<td><b>Location:</b><br />
<span class="small">You must select a topic or a section. You may not have one article in both a topic and a section. Only articles with topics will be shown on the front page.</span></td>
<td><input name="location" id="topic" type="radio" value="topic" checked="checked" /> <select class="small" name="topicid" id="topicid"><option value="0">Choose a Topic</option>$topics</select><br />
<input name="location" id="section" type="radio" value="section" /> <select class="small" name="sectionid" id="sectionid"><option value="0">Choose a Section</option>$sections</select></td>
</tr>
<tr>
<td><b>Article:</b><br />
<span class="small">First time news posters:</span> <a class="linksmall" href="$relativeurl/faq.php?faq=adminfaq&amp;category=Articles#Can_I_split_articles_up_into_more_than_one_page" onclick="window.open(this.href, '', 'scrollbars,resizable,width=700,height=500'); return false;">How to create and use page breaks.</a>
$smilie_box</td>
<td colspan="2">
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" rows="15" cols="80"></textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script></if>
</td>
</tr>
<tr>
<td><b>Options:</b></td><td class="small"><input name="url" type="checkbox" value="1" checked="checked" /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1" /> Disable DP Code<br />
<input name="smilies" type="checkbox" value="1" /> Disable Smilies</td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Article" /></td>
</tr>
<include template="form_footer" />
</table><br />
<b>Last $config[admin_articles_per_page] Articles:</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader"><span class="small" style="white-space: nowrap">Article ID</span></td><td class="tableheader"><span class="small">Title</span></td><td class="tableheader"><span class="small">Author</span></td><td class="tableheader"><span class="small">Posted</span></td><td class="tableheader"><span class="small">Topic</span></td><td class="tableheader"><span class="small">Section</span></td><td class="tableheader"><span class="small">Options</span></td>
</tr>
$articles
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074829252";}s:16:"articles_missing";a:4:{s:8:"category";s:19:"Admin CP - Articles";s:4:"body";s:132:"<include template="message_header" />
You must specify a name, body text, and a topic/section.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"edit_article";a:4:{s:8:"category";s:19:"Admin CP - Articles";s:4:"body";s:3344:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_dialog.js"></script>
</if>
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<form action="articles.php" method="post" onsubmit="return article_submit()">
<div><input name="op" type="hidden" value="doedit" />
<input id="parsed_message" name="parsed_message" type="hidden" value="$parsedmessage" />
<input name="id" type="hidden" value="$article[articleid]" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="articles.php"><b>Articles</b></a> <b>&gt; Edit Article</b><br />
<br /></div>
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Article - $article[title]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="80" name="title" id="title" type="text" value="$article[title]" /></td>
</tr>
<tr>
<td><b>Location:</b><br />
<span class="small">You must select a topic or a section. You may not have one article in both a topic and a section. Only articles with topics will be shown on the front page.</span></td>
<td><input name="location" id="topic" type="radio" value="topic"<if $article[topicid]> checked="checked"</if> /> <select class="small" name="topicid" id="topicid"><option value="0">Choose a Topic</option>$topics</select><br />
<input name="location" id="section" type="radio" value="section"<if $article[sectionid]> checked="checked"</if> /> <select class="small" name="sectionid" id="sectionid"><option value="0">Choose a Section</option>$sections</select></td>
</tr>
<tr>
<td><b>Article:</b><br />
<span class="small">First time news posters:</span> <a class="linksmall" href="$relativeurl/faq.php?faq=adminfaq&amp;category=Articles#Can_I_split_articles_up_into_more_than_one_page" onclick="window.open(this.href, '', 'scrollbars,resizable,width=700,height=500'); return false;">How to create and use page breaks.</a>
$smilie_box</td>
<td colspan="2">
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" rows="15" cols="80">$message</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script></if>
</td>
</tr>
<tr>
<td><b>Options:</b></td><td class="small"><input name="url" type="checkbox" value="1"<if $article[url]> checked="checked"</if> /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1"<if !$article[dpcode]> checked="checked"</if> /> Disable DP Code<br />
<input name="smilies" type="checkbox" value="1"<if !$article[smilies]> checked="checked"</if> /> Disable Smilies</td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Article" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074829276";}s:14:"delete_article";a:4:{s:8:"category";s:19:"Admin CP - Articles";s:4:"body";s:455:"<include template="message_header" />
Are you sure you want to delete article <b>$article[title]</b>?
<br />
<br />
<form action="articles.php" method="post">
<div class="center"><input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$article[articleid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='articles.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073289649";}s:19:"delete_topic_denied";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:193:"<include template="message_header" />
There are one or more articles using this topic. You must change or remove these articles before removing this topic.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"delete_section_denied";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:197:"<include template="message_header" />
There are one or more articles using this section. You must change or remove these articles before removing this section.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:31:"stylesets_duplicate_templateset";a:4:{s:8:"category";s:21:"Admin CP - Style Sets";s:4:"body";s:121:"<include template="message_header" />
A template set with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"stylesets_duplicate";a:4:{s:8:"category";s:21:"Admin CP - Style Sets";s:4:"body";s:118:"<include template="message_header" />
A style set with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"edit_styleset";a:4:{s:8:"category";s:21:"Admin CP - Style Sets";s:4:"body";s:7328:"<include template="header" />
<form enctype="multipart/form-data" action="stylesets.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$styleset_result[stylesetid]" />
<input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="stylesets.php"><b>Style Sets</b></a> <b>&gt; Edit Style Set</b>
<br />
<br /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap">$stylesets</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="2">Edit Style Set - $styleset_result[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td><td><input size="60" name="name" type="text" value="$styleset_result[name]" /></td>
</tr>
<tr>
<td><b>Logo:</b></td><td><input size="60" name="logo" type="text" value="$styleset_result[logo]" /></td>
</tr>
<tr>
<td><b>Images directory:</b><br />
<span class="small">Do <b>not</b> include a closing <b>/</b> (slash).</span></td><td><input size="60" name="images" type="text" value="$styleset_result[images]" /></td>
</tr>
<tr>
<td><b>Number separator:</b><br />
<span class="small">Enter the character with which you wish to separate large numbers, in groups of three.</span></td><td><input size="10" name="separator" type="text" value="$styleset_result[separator]" /></td>
</tr>
<tr>
<td><b>Character Coding:</b><br />
<span class="small">Use this to set the character set the users browser will use to view this site. <i>(Example: <b>UTF-8</b> (Unicode) or <b>ISO-8859-1</b> (Western Encoding))</i></span></td><td><input size="60" name="charset" type="text" value="$styleset_result[charset]" /></td>
</tr>
<tr>
<td><b>Enabled:</b></td><td>Yes:<input size="60" name="enabled" type="radio" value="1"<if $styleset_result[enabled]> checked="checked"</if> /> No:<input size="60" name="enabled" type="radio" value="0"<if !$styleset_result[enabled]> checked="checked"</if> /></td>
</tr>
<tr>
<td class="heading" colspan="2">Style</td>
</tr>
<tr>
<td colspan="2"><input name="style_select" type="radio" value="default" /><span class="small">Create a new copy of the default Deluxe Portal style, and name it:</span> <input name="style_default_name" type="text" size="10" class="small" /><br />
<input name="style_select" type="radio" value="copy" /><span class="small">Copy an existing style:</span> <select name="style_copy" class="small">$styles</select><span class="small">, and name it:</span> <input name="style_copy_name" type="text" size="10" class="small" /><br />
<input name="style_select" type="radio" value="import" /><span class="small">Import a style:</span> <input name="import" type="file" class="small" size="24" /><span class="small">, and name it:</span> <input name="style_import_name" type="text" size="10" class="small" /><br />
<input name="style_select" type="radio" value="existing" checked="checked" /><span class="small">Use an existing style:</span> <select name="style_existing" class="small">$styles</select></td>
</tr>
<tr>
<td class="heading" colspan="2">Templates</td>
</tr>
<tr>
<td colspan="2"><input name="templateset_select" type="radio" value="default" /><span class="small">Create a new copy of the default Deluxe Portal templates, and name it:</span> <input name="templateset_default_name" type="text" size="10" class="small" /><br />
<input name="templateset_select" type="radio" value="copy" /><span class="small">Copy an existing set of templates:</span> <select name="templateset_copy" class="small">$templatesets</select><span class="small">, and name it:</span> <input name="templateset_copy_name" type="text" size="10" class="small" /><br />
<input name="templateset_select" type="radio" value="import" /><span class="small">Import a set of templates:</span> <input name="import_template" type="file" class="small" size="24" /><span class="small">, and name it:</span> <input name="templateset_import_name" type="text" size="10" class="small" /><br />
<input name="templateset_select" type="radio" value="existing" checked="checked" /><span class="small">Use an existing set of templates:</span> <select name="templateset_existing" class="small">$templatesets</select></td>
</tr>
<tr>
<td class="heading" colspan="2">Spacing</td>
</tr>
<tr>
<td><b>Cell spacing:</b><br />
<span class="small">Enter the width of the lines that separate the table cells in pixels.</span></td><td><input size="60" name="cellspacing" type="text" value="$styleset_result[cellspacing]" /></td>
</tr>
<tr>
<td><b>Cell padding:</b><br />
<span class="small">Enter the distance from the edge of table cells to the beginning of the cell content in pixels.</span></td><td><input size="60" name="cellpadding" type="text" value="$styleset_result[cellpadding]" /></td>
</tr>
<tr>
<td><b>Sidebar width:</b></td><td><input size="60" name="sidebar" type="text" value="$styleset_result[sidebar]" /></td>
</tr>
<tr>
<td class="heading" colspan="2">Date Formats</td>
</tr>
<tr>
<td><b>Announcements:</b></td><td><input size="60" name="announcement_date_format" type="text" value="$styleset_result[announcement_date_format]" /></td>
</tr>
<tr>
<td><b>Articles:</b></td><td><input size="60" name="frontpage_date_format" type="text" value="$styleset_result[frontpage_date_format]" /></td>
</tr>
<tr>
<td><b>Date joined:</b></td><td><input size="60" name="join_date_format" type="text" value="$styleset_result[join_date_format]" /></td>
</tr>
<tr>
<td><b>Date joined (in posts):</b></td><td><input size="60" name="join_post_date_format" type="text" value="$styleset_result[join_post_date_format]" /></td>
</tr>
<tr>
<td><b>Edited by:</b></td><td><input size="60" name="editedby_date_format" type="text" value="$styleset_result[editedby_date_format]" /></td>
</tr>
<tr>
<td><b>Front page day separator:</b></td><td><input size="60" name="frontpage_day_date_format" type="text" value="$styleset_result[frontpage_day_date_format]" /></td>
</tr>
<tr>
<td><b>Last post:</b></td><td><input size="60" name="lastpost_date_format" type="text" value="$styleset_result[lastpost_date_format]" /></td>
</tr>
<tr>
<td><b>Log entries:</b></td><td><input size="60" name="log_date_format" type="text" value="$styleset_result[log_date_format]" /></td>
</tr>
<tr>
<td><b>Most online:</b></td><td><input size="60" name="most_online_date_format" type="text" value="$styleset_result[most_online_date_format]" /></td>
</tr>
<tr>
<td><b>Post:</b></td><td><input size="60" name="post_date_format" type="text" value="$styleset_result[post_date_format]" /></td>
</tr>
<tr>
<td><b>[day /] Today:</b></td><td><input size="60" name="today_text" type="text" value="$styleset_result[today_text]" /></td>
</tr>
<tr>
<td><b>[day /] Yesterday:</b></td><td><input size="60" name="yesterday_text" type="text" value="$styleset_result[yesterday_text]" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Style Set" /></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074809322";}s:15:"delete_styleset";a:4:{s:8:"category";s:21:"Admin CP - Style Sets";s:4:"body";s:798:"<include template="message_header" />
<form action="stylesets.php" method="post">
<div><input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$styleset_result[stylesetid]" />
Are you sure you want to delete style set <b>$styleset_result[name]</b>?<br />
<br />
<if $delete_style><input name="delete_style" type="checkbox" value="1" /> Delete corresponding style (<b>$style_result[name]</b>)<br /></if>
<if $delete_templateset><input name="delete_templateset" type="checkbox" value="1" /> Delete corresponding template set (<b>$templateset_result[name]</b>)<br /></if><br /></div>
<div class="center"><input type="submit" value="Yes" /> <input type="button" onclick="window.location='stylesets.php'" value="No" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073704642";}s:22:"delete_styleset_denied";a:4:{s:8:"category";s:21:"Admin CP - Style Sets";s:4:"body";s:156:"<include template="message_header" />
This style set is in use by one or more users, or is set as a default style set.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062390293";}s:20:"moderators_duplicate";a:4:{s:8:"category";s:21:"Admin CP - Moderators";s:4:"body";s:132:"<include template="message_header" />
A moderator with that name already exists in that forum.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"forumperm_index";a:4:{s:8:"category";s:28:"Admin CP - Forum Permissions";s:4:"body";s:782:"<include template="header" />
<script type="text/javascript" src="tree.js"></script>
<script type="text/javascript" src="tree_tpl.js"></script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Forum Permissions</b>
<br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><script type="text/javascript">
<!--
var TREE_ITEMS = [['<b>Forums</b>', null, $forums]];
new tree (TREE_ITEMS, tree_tpl);
//-->
</script>
<ul><li><span style="color: red">Custom permissions</span></li>
<li>Group permissions</li>
<li><span style="color: blue">Parent permissions</span></li></ul></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073365990";}s:15:"forumperm_forum";a:4:{s:8:"category";s:28:"Admin CP - Forum Permissions";s:4:"body";s:322:"<if $forums>,</if>['<b>$forum_result[name]</b> <span class="small">[</span><a class="linksmall" href="forumperm.php?op=deny&amp;id=$forum_result[forumid]">Deny All</a> <span class="small">-</span> <a class="linksmall" href="forumperm.php?op=reset&amp;id=$forum_result[forumid]">Reset</a><span class="small">]</span>', null";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"downloads_index";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:487:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Downloads</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><div class="center">[<a href="downloads.php?op=addcategory">Add New Download Category</a>]</div><br />
$download_categories</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:18:"downloads_category";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:485:"<b>$category_result[name]</b> <span class="small">[</span><a class="linksmall" href="downloads.php?op=add&amp;id=$category_result[downloadcategoryid]">Add Download</a> <span class="small">-</span> <a class="linksmall" href="downloads.php?op=editcategory&amp;id=$category_result[downloadcategoryid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="downloads.php?op=deletecategory&amp;id=$category_result[downloadcategoryid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:26:"downloads_category_missing";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:127:"<include template="message_header" />
You must specify a name for your download category.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:22:"edit_download_category";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:2273:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="downloads.php"><b>Downloads</b></a> <b>&gt; Edit Download Category</b>
<br />
<br />
<form enctype="multipart/form-data" action="downloads.php" method="post">
<div>
<input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doeditcategory" />
<input name="id" type="hidden" value="$category[downloadcategoryid]" />
</div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Download Category - $category[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$category[name]" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td><input name="transfer" type="radio" value="current" checked="checked" /> <span class="small">Use current image</span><br />
<input name="transfer" type="radio" value="upload" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Viewing/Downloading Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('download'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('download'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="download" valign="top">
<td class="small" style="white-space: nowrap">$groups_col1</td><td class="small" style="white-space: nowrap">$groups_col2</td><td class="small" style="white-space: nowrap">$groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Download Category" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073365302";}s:31:"delete_download_category_denied";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:128:"<include template="message_header" />
There are one or more downloads using this category.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"delete_download_category";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:585:"<include template="message_header" />
Are you sure you want to delete download category <b>$category[name]</b>?<br />
<br />
<div class="center"><img alt="$category[name]" src="$category[parsed_image]" /><br />
<br />
<br />
<form action="downloads.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodeletecategory" />
<input name="id" type="hidden" value="$category[downloadcategoryid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='downloads.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073289537";}s:12:"add_download";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:1460:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="downloads.php"><b>Downloads</b></a> <b>&gt; Add Download</b><br />
<br />
<form action="downloads.php" method="post">
<div><input name="op" type="hidden" value="doadd" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Download</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>Download category:</b></td>
<td><select name="downloadcategoryid">$category_choices</select></td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><textarea class="small" name="description" cols="72" rows="5"></textarea></td>
</tr>
<tr>
<td><b>Location:</b></td>
<td><input size="60" name="location" type="text" value="http://" /></td>
</tr>
<tr>
<td><b>Author:</b></td>
<td><input size="60" name="author" type="text" /></td>
</tr>
<tr>
<td><b>Email:</b></td>
<td><input size="60" name="email" type="text" /></td>
</tr>
<tr>
<td><b>Version:</b></td>
<td><input size="60" name="version" type="text" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Download" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:13:"edit_download";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:1679:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="downloads.php"><b>Downloads</b></a> <b>&gt; Edit Download</b><br />
<br />
<form action="downloads.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$download[downloadid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Download - $download[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$download[name]" /></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>Download category:</b></td>
<td><select name="downloadcategoryid">$category_choices</select></td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><textarea class="small" name="description" cols="72" rows="5">$download[description]</textarea></td>
</tr>
<tr>
<td><b>Location:</b></td>
<td><input size="60" name="location" type="text" value="$download[location]" /></td>
</tr>
<tr>
<td><b>Author:</b></td>
<td><input size="60" name="author" type="text" value="$download[author]" /></td>
</tr>
<tr>
<td><b>Email:</b></td>
<td><input size="60" name="email" type="text" value="$download[email]" /></td>
</tr>
<tr>
<td><b>Version:</b></td>
<td><input size="60" name="version" type="text" value="$download[version]"/></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Download" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:17:"downloads_missing";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:124:"<include template="message_header" />
You must specify a name and a download location.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"delete_download";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:467:"<include template="message_header" />
Are you sure you want to delete download <b>$download[name]</b>?<br />
<br />
<br />
<form action="downloads.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$download[downloadid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='downloads.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073289506";}s:18:"downloads_download";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:332:"&nbsp;&nbsp;&nbsp;<b>$download_result[name]</b> <span class="small">[</span><a class="linksmall" href="downloads.php?op=edit&amp;id=$download_result[downloadid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="downloads.php?op=delete&amp;id=$download_result[downloadid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:8:"add_link";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:1150:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="links.php"><b>Links</b></a> <b>&gt; Add Link</b><br />
<br />
<form action="links.php" method="post">
<div><input name="op" type="hidden" value="doadd" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Link</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>Link category:</b></td>
<td><select name="linkcategoryid">$category_choices</select></td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><textarea class="small" name="description" cols="72" rows="5"></textarea></td>
</tr>
<tr>
<td><b>Link:</b></td>
<td><input size="60" name="link" type="text" value="http://" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Link" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073372630";}s:27:"delete_link_category_denied";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:124:"<include template="message_header" />
There are one or more links using this category.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"delete_link_category";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:462:"<include template="message_header" />
Are you sure you want to delete <b>$category[name]</b>?<br />
<br />
<br />
<form action="links.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodeletecategory" />
<input name="id" type="hidden" value="$category[linkcategoryid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='links.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073372579";}s:11:"delete_link";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:437:"<include template="message_header" />
Are you sure you want to delete <b>$link[name]</b>?<br />
<br />
<br />
<form action="links.php" method="post">
<div class="center"><input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$link[linkid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='links.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073372589";}s:14:"links_category";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:457:"<b>$category_result[name]</b> <span class="small">[</span><a class="linksmall" href="links.php?op=add&amp;id=$category_result[linkcategoryid]">Add Link</a> <span class="small">-</span> <a class="linksmall" href="links.php?op=editcategory&amp;id=$category_result[linkcategoryid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="links.php?op=deletecategory&amp;id=$category_result[linkcategoryid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"links_link";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:304:"&nbsp;&nbsp;&nbsp;<b>$link_result[name]</b> <span class="small">[</span><a class="linksmall" href="links.php?op=edit&amp;id=$link_result[linkid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="links.php?op=delete&amp;id=$link_result[linkid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"links_index";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:471:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Links</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><div class="center">[<a href="links.php?op=addcategory">Add New Link Category</a>]</div><br />
$link_categories</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:9:"edit_link";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:1236:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="links.php"><b>Links</b></a> <b>&gt; Edit Link</b><br />
<br />
<form action="links.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$link[linkid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Link - $link[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$link[name]" /></td>
</tr>
<tr>
<td><b>Link Category:</b></td>
<td><select name="linkcategoryid">$category_choices</select></td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><textarea class="small" name="description" cols="72" rows="5">$link[description]</textarea></td>
</tr>
<tr>
<td><b>Link:</b></td>
<td><input size="60" name="link" type="text" value="$link[link]" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Link" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073372667";}s:18:"edit_link_category";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:2292:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="links.php"><b>Links</b></a> <b>&gt; Edit Link Category</b>
<br />
<br />
<form enctype="multipart/form-data" action="links.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doeditcategory" />
<input name="id" type="hidden" value="$category[linkcategoryid]" /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain">$link_categories</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Link Category - $category[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td colspan="2"><input size="60" name="name" type="text" value="$category[name]" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td colspan="2"><input name="transfer" type="radio" value="current" checked="checked" /> <span class="small">Use current image</span><br />
<input name="transfer" type="radio" value="upload" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="3" class="heading">Viewing/Linking Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('viewperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('viewperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr id="viewperm" valign="top">
<td class="small">$groups_col1</td><td class="small">$groups_col2</td><td class="small">$groups_col3</td>
</tr>
<tr>
<td colspan="3"><div class="center"><input type="submit" value="Update Link Category" /></div></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073372550";}s:22:"links_category_missing";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:100:"<include template="message_header" />
You must specify a name.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"links_missing";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:111:"<include template="message_header" />
You must specify a name and a link.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"adminlog_index";a:4:{s:8:"category";s:20:"Admin CP - Admin Log";s:4:"body";s:1654:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Admin Log</b><br />
<br />
<form action="adminlog.php" method="post">
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Search</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td><td><input name="username" type="text" size="60" value="$user_result[name]" /></td>
<td><b>Action performed after:</b></td><td><input name="after" type="text" value="$after" /></td>
</tr>
<tr>
<td><b>Action:</b></td><td><input name="action" type="text" size="60" value="$action" /></td>
<td><b>Action performed before:</b></td><td><input name="before" type="text" value="$before" /></td>
</tr>
<tr>
<td><b>IP Address:</b></td><td><input name="ip" type="text" size="60" value="$ip" /></td>
</tr>
<tr>
<td colspan="4" class="center"><input type="submit" value="Search" /> <input name="showall" type="submit" value="Show All" /></td>
</tr>
<include template="form_footer" />
</table></form>
<if $adminlog_pagenav><br />
$adminlog_pagenav</if><br />
<br />
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader"><span class="small">Username</span></td><td class="tableheader"><span class="small">Action</span></td><td class="tableheader"><span class="small">Date</span></td><td class="tableheader"><span class="small">IP Address</span></td>
</tr>
$logs
</table><br />
$adminlog_pagenav<br />
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:17:"adminlog_adminlog";a:4:{s:8:"category";s:20:"Admin CP - Admin Log";s:4:"body";s:294:"<tr>
<td class="$color" style="white-space: nowrap"><a href="$relativeurl/profile.php?id=$adminlog[userid]">$adminlog[username]</a></td><td class="$color">$adminlog[action]</td><td class="$color" style="white-space: nowrap">$adminlog[parsed_date]</td><td class="$color">$adminlog[ip]</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:16:"styles_duplicate";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:114:"<include template="message_header" />
A style with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"delete_style";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:511:"<include template="message_header" />
Are you sure you want to delete style <b>$style_result[name]</b>?<br />
<br />
<br />
<form action="styles.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="current_style" type="hidden" value="$style_result[styleid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='styles.php?current_style=$style_result[styleid]'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073766259";}s:19:"delete_style_denied";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:126:"<include template="message_header" />
There are one or more style sets using this style.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"forumperm_group";a:4:{s:8:"category";s:28:"Admin CP - Forum Permissions";s:4:"body";s:366:"<if $forums>,</if>['<span class="small"<if $permnav[type]=="custom"> style="color: red"</if><if $permnav[type]=="parent"> style="color: blue"</if>>$group_result[name]</span> <span class="small">[</span><a class="linksmall" href="forumperm.php?op=edit&amp;forumid=$forum_result[forumid]&amp;groupid=$group_result[groupid]">Edit</a><span class="small">]</span>', null]";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"forumperm_end";a:4:{s:8:"category";s:28:"Admin CP - Forum Permissions";s:4:"body";s:1:"]";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"forumperm_edit";a:4:{s:8:"category";s:28:"Admin CP - Forum Permissions";s:4:"body";s:4655:"<include template="header" />
<script type="text/javascript" src="tree.js"></script>
<script type="text/javascript" src="tree_tpl.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="forumperm.php"><b>Forum Permissions</b></a> <b>&gt; Edit Forum Permission</b><br />
<br />
<table cellpadding="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><script type="text/javascript">
<!--
var TREE_ITEMS = [['<b>Forums</b>', null, $forums]];
new tree (TREE_ITEMS, tree_tpl);
//-->
</script>
<ul><li><span style="color: red">Custom permissions</span></li>
<li>Group permissions</li>
<li><span style="color: blue">Parent permissions</span></li></ul></td>
</tr>
</table></td>
<td><form action="forumperm.php" method="post">
<div><input name="op" type="hidden" value="doedit" /></div>
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader" style="white-space: nowrap">Edit Forum Permission - $group_result[name] in $forum[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Forum:</b></td><td colspan="2"><select class="small" name="forumid">$forum_choices</select></td>
</tr>
<tr>
<td><b>Group:</b></td><td colspan="2"><select class="small" name="groupid">$group_choices</select></td>
</tr>
<tr>
<td><b>Type:</b></td><td colspan="2">Custom:<input id="custom_type" name="type" type="radio" value="custom"<if $perm[type]=="custom"> checked="checked"</if><if $forum[parentid]> /> Parent:<input name="type" type="radio" value="parent"<if $perm[type]=="parent"> checked="checked"</if></if> /> Group:<input name="type" type="radio" value="group"<if $perm[type]=="group"> checked="checked"</if> /></td>
</tr>
<tr>
<td colspan="3" class="heading">Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('permission'))"><img id="check_all" alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('permission'))"><img id="uncheck_all" alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr id="permission" valign="top">
<td class="small" style="width: 33%; white-space: nowrap"><input name="close" type="checkbox" value="1"<if $perm[close]> checked="checked"</if> /> Close threads<br />
<input name="copymove" type="checkbox" value="1"<if $perm[copymove]> checked="checked"</if> /> Copy/move threads<br />
<input name="deleteposts" type="checkbox" value="1"<if $perm[deleteposts]> checked="checked"</if> /> Delete posts<br />
<input name="deletethreads" type="checkbox" value="1"<if $perm[deletethreads]> checked="checked"</if> /> Delete threads<br />
<input name="editposts" type="checkbox" value="1"<if $perm[editposts]> checked="checked"</if> /> Edit posts</td>
<td class="small" style="width: 33%; white-space: nowrap"><input name="editthreads" type="checkbox" value="1"<if $perm[editthreads]> checked="checked"</if> /> Edit threads<br />
<input name="postattachments" type="checkbox" value="1"<if $perm[postattachments]> checked="checked"</if> /> Post attachments<br />
<input name="postthreads" type="checkbox" value="1"<if $perm[postthreads]> checked="checked"</if> /> Post threads<br />
<input name="replytoother" type="checkbox" value="1"<if $perm[replytoother]> checked="checked"</if> /> Reply to others' threads<br />
<input name="replytoown" type="checkbox" value="1"<if $perm[replytoown]> checked="checked"</if> /> Reply to own threads</td>
<td class="small" style="width: 33%; white-space: nowrap"><input name="startpolls" type="checkbox" value="1"<if $perm[startpolls]> checked="checked"</if> /> Start polls<br />
<input name="viewattachments" type="checkbox" value="1"<if $perm[viewattachments]> checked="checked"</if> /> View attachments<br />
<input name="viewforums" type="checkbox" value="1"<if $perm[viewforums]> checked="checked"</if> /> View forum<br />
<input name="viewthreads" type="checkbox" value="1"<if $perm[viewthreads]> checked="checked"</if> /> View threads<br />
<input name="votepolls" type="checkbox" value="1"<if $perm[votepolls]> checked="checked"</if> /> Vote on polls<br /></td>
</tr>
<tr>
<td colspan="3" class="center"><input type="submit" value="Update Forum Permission" /></td>
</tr>
<include template="form_footer" />
</table></form></td>
</tr>
</table>
<script type="text/javascript">
forumperm_custom_radio();
</script>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073366640";}s:18:"groupchanger_index";a:4:{s:8:"category";s:24:"Admin CP - Group Changer";s:4:"body";s:505:"<include template="header" />
<input name="op" type="hidden" value="add" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Group Changer</b>
<br />
<br /><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><div class="center">[<a href="groupchanger.php?op=add">Add New Rule</a>]</div><br />
$rules</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:22:"groupchanger_duplicate";a:4:{s:8:"category";s:24:"Admin CP - Group Changer";s:4:"body";s:113:"<include template="message_header" />
A rule with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"groupchanger_rule";a:4:{s:8:"category";s:24:"Admin CP - Group Changer";s:4:"body";s:310:"<b>$rule_result[name]</b> <span class="small">[</span><a class="linksmall" href="groupchanger.php?op=edit&amp;id=$rule_result[groupruleid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="groupchanger.php?op=delete&amp;id=$rule_result[groupruleid]">Delete</a><span class="small">]</span><br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058152968";}s:9:"edit_rule";a:4:{s:8:"category";s:24:"Admin CP - Group Changer";s:4:"body";s:3464:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="groupchanger.php"><b>Group Changer</b></a> <b>&gt; Edit Group Changer Rule</b><br />
<br />
<form name="groupchanger" action="groupchanger.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$rule[groupruleid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="3">Edit Rule - $rule[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td colspan="2"><input size="60" name="name" type="text" value="$rule[name]" /></td>
</tr>
<tr>
<td><b>When user has been a member for at least this many days:</b></td>
<td colspan="2"><input size="60" name="days" type="text" value="$rule[days]" /></td>
</tr>
<tr>
<td><select name="and_or"><option value="and"<if $rule[and_or]=="and"> selected="selected"</if>>And</option><option value="or"<if $rule[and_or]=="or"> selected="selected"</if>>Or</option></select> <b>post count:</b></td>
<td colspan="2"><select name="post_condition"><option value="reaches"<if $rule[post_condition]=="reaches"> selected="selected"</if>>Reaches</option><option value="drops"<if $rule[post_condition]=="drops"> selected="selected"</if>>Drops below</option></select> <input size="27" name="posts" type="text" value="$rule[posts]" /></td>
</tr>
<tr id="ingroups" valign="top">
<td><b>And user is in one of the following groups:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('ingroups'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('ingroups'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
<td class="small" style="white-space: nowrap">$ingroups_col1</td><td class="small" style="white-space: nowrap">$ingroups_col2</td>
</tr>
<tr>
<td><b>Move user to primary group:</b></td>
<td><select name="groupid"><option value="0">Don't change primary group</option>$primary_groups</select></td><td class="small"><input name="dont_remove" type="checkbox" value="1"<if $rule[dont_remove]> checked="checked"</if> /> Leave user in group</td>
</tr>
<tr id="addgroups" valign="top">
<td><b>Add user to these groups:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('addgroups'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('addgroups'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
<td class="small" style="white-space: nowrap">$addgroups_col1</td><td class="small" style="white-space: nowrap">$addgroups_col2</td>
</tr>
<tr id="removegroups" valign="top">
<td><b>Remove user from these groups:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('removegroups'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('removegroups'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
<td class="small" style="white-space: nowrap">$removegroups_col1</td><td class="small" style="white-space: nowrap">$removegroups_col2</td>
</tr>
<tr>
<td class="center" colspan="3"><input type="submit" value="Update Rule" /></td>
</tr>
<include template="form_footer" />
</table></form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073369126";}s:11:"delete_rule";a:4:{s:8:"category";s:24:"Admin CP - Group Changer";s:4:"body";s:476:"<include template="message_header" />
Are you sure you want to delete group changer rule <b>$rule[name]</b>?<br />
<br />
<br />
<form action="groupchanger.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$rule[groupruleid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='groupchanger.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073369200";}s:17:"maintenance_index";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:7504:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Maintenance</b><br />
<br />
<div class="center"><form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="usernames" />
<input name="start" type="hidden" value="0" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Update Usernames</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="Usernames" src="$style[images]/usernames.gif" /></td>
<td>This updates the cached usernames. This ensures that all usernames are correct in posts, articles, etc.<br />
<br />
Number of users per cycle: <input name="cycle" type="text" size="10" value="100" /> <input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="threads" />
<input name="start" type="hidden" value="0" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Update Thread Counters</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="Thread Maintenance" src="$style[images]/threads.gif" /></td>
<td>This updates the thread counters. This includes the number of replies to each thread, and the last post information.<br />
<br />
Number of threads per cycle: <input name="cycle" type="text" size="10" value="500" /> <input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="forums" />
<input name="start" type="hidden" value="0" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Update Forum Counters</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="Forum Maintenance" src="$style[images]/forums.gif" /></td>
<td>This updates the forum counters. This includes the number of posts and threads, and the last thread information.<br />
<br />
Number of forums per cycle: <input name="cycle" type="text" size="10" value="500" /> <input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="lastpost" />
<input name="start" type="hidden" value="0" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Update User Last Post Information</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="Last Post Maintenance" src="$style[images]/users.gif" /></td>
<td>This updates the user last post information. Running this script will ensure that the profile last post cache is up to date.<br />
<br />
Number of users per cycle: <input name="cycle" type="text" size="10" value="500" /> <input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="users" />
<input name="start" type="hidden" value="0" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Update User Post Counts</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="User Maintenance" src="$style[images]/users.gif" /></td>
<td>This updates the user post counters. This will make sure that each user's post count accurately reflects the number of posts that user has. For users that you wish not to be updated, add them to a group that has the <b>Lock Post Count</b> option set.<br />
<br />
Number of users per cycle: <input name="cycle" type="text" size="10" value="100" /> <input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="posts" />
<input name="start" type="hidden" value="0" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Reparse Post Cache</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="Post Maintenance" src="$style[images]/adminlog.gif" /></td>
<td>Some posts are cached in Deluxe Portal for performance reasons. This script reparses all posts that are in threads that have a last post date newer than the number of days specified in the configuration panel. You may want to do this if you make DP code, smilie, or censoring changes that affect current cached posts, and you wish for them to reflect these changes.<br />
<br />
Number of posts per cycle: <input name="cycle" type="text" size="10" value="500" /> <input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="signatures" />
<input name="start" type="hidden" value="0" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Reparse Signatures</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="Signature Maintenance" src="$style[images]/edit_profile.gif" /></td>
<td>Signatures are cached in Deluxe Portal for performance reasons. This script reparses all signatures. You may want to do this if you make DP code, smilie, or censoring changes that affect current signatures, and you wish for them to reflect these changes.<br />
<br />
Number of users per cycle: <input name="cycle" type="text" size="10" value="500" /> <input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="templates" />
<input name="start" type="hidden" value="0" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Reparse Templates</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="Reparse Templates" src="$style[images]/templates.gif" /></td>
<td>This reparses all templates from a specific template set; required if the <b>parsedtemplate</b> database table becomes corrupt.<br />
<br />
Template Set: <select name="templatesetid">
<option value="0">All template sets</option>
$templatesets
</select><br />
Number of templates per cycle: <input type="text" name="cycle" value="100" size="10" />
<input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="maintenance.php" method="post">
<div><input name="op" type="hidden" value="imagestore" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Clean Imagestore</td>
</tr>
<include template="form_header" />
<tr>
<td><img alt="Clean Imagestore" src="$style[images]/stylesets.gif" /></td>
<td>This clears unused images out of the imagestore. This helps save database space. <input type="submit" value="Go" />
</td>
</tr>
<include template="form_footer" />
</table>
</form>
</div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1079832107";}s:19:"maintenance_threads";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:287:"<include template="redirect_header" />
Thread maintenance 
<if $i==$cycle>
is continuing... (last thread was <b>$lastid</b>)
<else />
has completed (last thread was <b>$lastid</b>). You are now being returned to the maintenance control panel.
</if>
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"maintenance_users";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:281:"<include template="redirect_header" />
User maintenance 
<if $i==$cycle>
is continuing... (last user was <b>$lastid</b>)
<else />
has completed (last user was <b>$lastid</b>). You are now being returned to the maintenance control panel.
</if>
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:9:"mod_index";a:4:{s:8:"category";s:6:"Mod CP";s:4:"body";s:3498:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt; Moderator Control Panel</b>
<br />
<br />
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="5">Moderator Control Panel</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain" cellpadding="16">
<tr>
<td><div class="center"><a class="linksmall" href="announcements.php"><img alt="Announcements" src="$style[images]/announcements.gif" />
<br />
Announcements</a></div></td>
<td><div class="center"><a class="linksmall" href="$relativeurl/faq.php?faq=modfaq"><img alt="Help" src="$style[images]/help.gif" />
<br />
Help</a></div></td>
<td><div class="center"><a class="linksmall" href="delete.php"><img alt="Mass Delete" src="$style[images]/massdelete.gif" />
<br />
Mass Delete</a></div></td>
<td><div class="center"><a class="linksmall" href="move.php"><img alt="Mass Move" src="$style[images]/massmove.gif" />
<br />
Mass Move</a></div></td>
<td><div class="center"><a class="linksmall" href="modlog.php"><img alt="Moderator Log" src="$style[images]/adminlog.gif" />
<br />
Moderator Log</a></div></td>
<td><div class="center"><a class="linksmall" href="users.php"><img alt="Users" src="$style[images]/users.gif" />
<br />
Users</a></div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table><br />
<br />
<form action="users.php" method="post">
<div><input name="all_groups" type="hidden" value="1" />
<input name="op" type="hidden" value="search" />
<input name="maxposts" type="hidden" value="4294967296" />
<input name="minjoin" type="hidden" value="1969-12-31" />
<input name="maxjoin" type="hidden" value="2029-12-31" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Deluxe Portal</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0" cellpadding="$style[cellpadding]">
<tr>
<td><table class="cellmain">
<tr>
<td colspan="2"><div class="center"><a href="http://www.deluxeportal.net" onclick="window.open(this.href);return false;"><b>Deluxe Portal Version $config[version]</b></a></div><br /></td>
</tr>
<tr>
<td><b>Project Manager:</b></td><td><a href="http://www.deluxeportal.net/profile.php?id=1" onclick="window.open(this.href);return false;">Andrew Harper</a></td>
</tr>
<tr>
<td><b>Developers:</b></td><td><a href="http://www.deluxeportal.net/profile.php?id=1" onclick="window.open(this.href);return false;">Andrew Harper</a>, <a href="http://www.deluxeportal.net/profile.php?id=141" onclick="window.open(this.href);return false;">Jeff Lange</a></td>
</tr>
<tr>
<td><b>Graphics/Styles:</b></td><td><a href="http://www.deluxeportal.net/profile.php?id=2" onclick="window.open(this.href);return false;">Shaun Boyland</a>, <a href="http://www.deluxeportal.net/profile.php?id=141" onclick="window.open(this.href);return false;">Jeff Lange</a></td>
</tr>
<tr>
<td><b>Documentation:</b></td><td><a href="http://www.deluxeportal.net/profile.php?id=1" onclick="window.open(this.href);return false;">Andrew Harper</a></td>
</tr>
<if $uptime><tr>
<td><br />
<b>Server load averages:</b></td><td><br />
$uptime</td>
</tr></if>
<tr>
<td><br />
<b>Quick user search:</b></td><td><br />
<input name="name" type="text" size="30" />&nbsp;<input type="submit" value="Search" /></td>
</tr>
<include template="form_footer" />
</table></form></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1144552247";}s:10:"modlog_log";a:4:{s:8:"category";s:22:"Mod CP - Moderator Log";s:4:"body";s:373:"<tr>
<td class="$color" style="white-space: nowrap"><a href="profile.php?id=$modlog[userid]">$modlog[username]</a></td><td class="$color">$modlog[action]<if $modlog[threadid]> - <a href="$relativeurl/thread.php?id=$modlog[threadid]">$modlog[name]</a></if></td><td class="$color" style="white-space: nowrap">$modlog[parsed_date]</td><td class="$color">$modlog[ip]</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:12:"modlog_index";a:4:{s:8:"category";s:22:"Mod CP - Moderator Log";s:4:"body";s:1644:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt; Moderator Log</b><br />
<br />
<form action="modlog.php" method="post">
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Search</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td><td><input name="username" type="text" size="60" value="$user_result[name]" /></td>
<td><b>Action performed after:</b></td><td><input name="after" type="text" value="$after" /></td>
</tr>
<tr>
<td><b>Action:</b></td><td><input name="action" type="text" size="60" value="$action" /></td>
<td><b>Action performed before:</b></td><td><input name="before" type="text" value="$before" /></td>
</tr>
<tr>
<td><b>IP Address:</b></td><td><input name="ip" type="text" size="60" value="$ip" /></td>
</tr>
<tr>
<td colspan="4" class="center"><input type="submit" value="Search" /> <input name="showall" type="submit" value="Show All" /></td>
</tr>
<include template="form_footer" />
</table></form>
<if $modlog_pagenav><br />
$modlog_pagenav</if><br />
<br />
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr><td class="tableheader"><span class="small">Username</span></td><td class="tableheader"><span class="small">Action</span></td><td class="tableheader"><span class="small">Date</span></td><td class="tableheader"><span class="small">IP Address</span></td></tr>
$logs
</table><br />
$modlog_pagenav<br />
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:9:"view_user";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:15987:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_dialog.js"></script>
</if>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; View User</b><br />
<br />
<form action="users.php" method="post">
<div class="center">
<input id="parsed_signature" type="hidden" value="$parsedmessage" />
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">View User - $user_result[name]</td>
</tr>
<include template="form_header" />
<tr>
<td colspan="3" class="heading">Required Information</td>
</tr>
<tr>
<td><b>Username:</b></td><td colspan="2"><input name="name" type="text" size="60" value="$user_result[name]" /></td>
</tr>
<tr>
<td><b>Primary group:</b><br />
<span class="small">The user will receive his or her title and username display format from this group.</span></td><td colspan="2"><select name="groupid">$groups</select></td>
</tr>
<tr valign="top">
<td><b>Other groups:</b><br />
<span class="small">These are other groups to which the user belongs.</span></td><td class="small" style="white-space: nowrap">$usergroups_col1</td><td class="small"style="white-space: nowrap">$usergroups_col2</td>
</tr>
<tr>
<td><b>Email address:</b></td><td colspan="2"><input name="email" type="text" size="60" value="$user_result[email]" /></td>
</tr>
<tr>
<td colspan="3" class="heading">Instant Messengers</td>
</tr>
<tr>
<td><b>AOL Instant Messenger:</b></td><td colspan="2"><input name="aol" type="text" size="60" value="$user_result[aol]" /></td>
</tr>
<tr>
<td><b>ICQ:</b></td><td colspan="2"><input name="icq" type="text" size="60" value="$user_result[icq]" /></td>
</tr>
<tr>
<td><b>MSN Messenger:</b></td><td colspan="2"><input name="msn" type="text" size="60" value="$user_result[msn]" /></td>
</tr>
<tr>
<td><b>Yahoo Instant Messenger:</b></td><td colspan="2"><input name="yahoo" type="text" size="60" value="$user_result[yahoo]" /></td>
</tr>
<tr>
<td colspan="3" class="heading">Optional Information</td>
</tr>
<tr>
<td><b>Number of posts:</b><br />
<span class="small">This is the user's post count. You do not have to make it match the actual number of posts the user has.</span></td><td colspan="2"><input name="posts" type="text" size="60" value="$user_result[posts]" /></td>
</tr>
<tr>
<td><b>Custom title:</b></td><td colspan="2"><input name="title" type="text" size="60" value="$user_result[title]" /></td>
</tr>
<tr>
<td><b>Join date:</b><br />
<span class="small">You must enter this date in <b>YYYY-MM-DD HH:MM:SS</b> format.</span></td><td colspan="2"><input name="joindate" type="text" size="60" value="$user_result[joindate]" /></td>
</tr>
<tr>
<td><b>Hide email address:</b><br />
<span class="small">This option enables you to hide your email address from users on the site.</span></td><td>Yes:<input name="hide_email" type="radio" value="1"<if $user_result[hide_email]> checked="checked"</if> /> No:<input name="hide_email" type="radio" value="0"<if !$use_resultr[hide_email]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Invisible on Who's Online list:</b><br />
<span class="small">This option will prevent you from being displayed on the Who's Online list.</span></td><td>Yes:<input name="invisible" type="radio" value="1"<if $user_result[invisible]> checked="checked"</if> /> No:<input name="invisible" type="radio" value="0"<if !$user_result[invisible]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Mark threads as read after reading them:</b><br />
<span class="small">When this option is enabled, threads will be marked as read when you read them, instead of requiring you to leave the forum for a set amount of time first.</span></td><td colspan="2">Yes:<input name="markread" type="radio" value="1"<if $user_result[markread]> checked="checked"</if> /> No:<input name="markread" type="radio" value="0"<if !$user_result[markread]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Notify when a new private message is received:</b><br />
<span class="small">Enable this option if you wish to receive an email when you receive a private message.</span></td><td colspan="2">Yes:<input name="notify_pm" type="radio" value="1"<if $user_result[notify_pm]> checked="checked"</if> /> No:<input name="notify_pm" type="radio" value="0"<if !$user_result[notify_pm]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Quick reply:</b><br />
<span class="small">Enable quick reply to place a small reply box at the end of each thread.</span></td>
<td colspan="2">Multiline:<input name="quick_reply" type="radio" value="multi"<if $user_result[quick_reply]=="multi"> checked="checked"</if> /> Single line:<input name="quick_reply" type="radio" value="single"<if $user_result[quick_reply]=="single"> checked="checked"</if> /> None:<input name="quick_reply" type="radio" value="none"<if $user_result[quick_reply]=="none"> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Receive email notifications for threads by default:</b><br />
<span class="small">Enable this if you wish to receive email notification of new posts in threads in which you have posted, by default. This can also be enabled and disabled on an individual thread basis when posting.</span></td><td>Yes:<input name="subscribe_email" type="radio" value="1"<if $user_result[subscribe_email]> checked="checked"</if> /> No:<input name="subscribe_email" type="radio" value="0"<if !$user_result[subscribe_email]> checked="checked"</if>/></td>
</tr>
<tr>
<td><b>Receive mail from the administrators:</b><br /><span class="small">The administrators may wish to send out automated mailings to certain groups of members from time to time. If you wish not to receive these mailings, please set this to <b>No</b>.</span></td><td>Yes:<input name="massmail" type="radio" value="1"<if $user_result[massmail]> checked="checked"</if> /> No:<input name="massmail" type="radio" value="0"<if !$user_result[massmail]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show avatars:</b><br />
<span class="small">Avatars are the small pictures that are shown under the names of some members. You can choose not to display them with this option.</span></td><td>Yes:<input name="show_avatars" type="radio" value="1"<if $user_result[show_avatars]> checked="checked"</if> /> No:<input name="show_avatars" type="radio" value="0"<if !$user_result[show_avatars]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show images:</b><br />
<span class="small">If you are on a slow internet connection, you may elect to show links to images, instead of actually displaying images inside posts.</span></td><td>Yes:<input name="img" type="radio" value="1"<if $user_result[img]> checked="checked"</if> /> No:<input name="img" type="radio" value="0"<if !$user_result[img]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show popup box when a new private message is received:</b><br />
<span class="small">This will display a popup box when you receive a new private message.</span></td><td colspan="2">Yes:<input name="pm_popup" type="radio" value="1"<if $user_result[pm_popup]> checked="checked"</if> /> No:<input name="pm_popup" type="radio" value="0"<if !$user_result[pm_popup]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show signatures:</b><br />
<span class="small">You may turn the display of signatures under posts on or off with this option.</span></td><td>Yes:<input name="displaysignatures" type="radio" value="1"<if $user_result[displaysignatures]> checked="checked"</if> /> No:<input name="displaysignatures" type="radio" value="0"<if !$user_result[displaysignatures]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Subscribe to threads by default:</b><br />
<span class="small">With this option enabled, you will automatically subscribe to threads in which you post. Subscribing to threads causes them to be shown in your user control panel when new posts are made to the threads. This can also be enabled or disabled for each thread while posting.</span></td><td>Yes:<input name="subscribe" type="radio" value="1"<if $user_result[subscribe]> checked="checked"</if> /> No:<input name="subscribe" type="radio" value="0"<if !$user_result[subscribe]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use private messaging:</b><br />
<span class="small">Enables/disables the private messaging system, which allows you to talk privately with other forum members.</span></td><td colspan="2">Yes:<input name="pm" type="radio" value="1"<if $user_result[pm]> checked="checked"</if> /> No:<input name="pm" type="radio" value="0"<if !$user_result[pm]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use WYSIWYG for posting:</b><br />
<span class="small">This allows you to see the formatting in your post as you make the post, and allows you to use friendly toolbar controls to format text. Internet Explorer 6.0 or higher for Windows or Mozilla 1.3 or higher across any platform is required.</span></td><td>Yes:<input name="use_wysiwyg" type="radio" value="1"<if $user_result[use_wysiwyg]> checked="checked"</if> /> No:<input name="use_wysiwyg" type="radio" value="0"<if !$user_result[use_wysiwyg]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use signature in posts by default:</b></td><td>Yes:<input name="usesignature" type="radio" value="1"<if $user_result[usesignature]> checked="checked"</if> /> No:<input name="usesignature" type="radio" value="0"<if !$user_result[usesignature]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Style:</b><br />
<span class="small">Choose the appearance you wish to have for the site.</span></td><td colspan="2"><select name="stylesetid">$stylesets</select></td>
</tr>
<tr>
<td><b>Time zone:</b><br />
<span class="small">Choose the method you would like to use to determine your timezone. Note that automatic timezone detection requires Javascript to be enabled.</span></td><td colspan="2">
<span class="small"><input type="radio" name="auto_time_zone" value="1"<if $user_result[auto_time_zone]> checked="checked"</if> /> Automatically Detect Your Timezone<br />
<input type="radio" name="auto_time_zone" value="0"<if !$user_result[auto_time_zone]> checked="checked"</if> /> Use the following Settings:
<br /><br /></span><div style="margin-left:35px">
<select name="time_zone"><option value="-12"<if $user_result[time_zone]=="-12"> selected="selected"</if>>(GMT-12:00) International Date Line West</option><option value="-11"<if $user_result[time_zone]=="-11"> selected="selected"</if>>(GMT-11:00) Midway Island, Samoa</option><option value="-10"<if $user_result[time_zone]=="-10"> selected="selected"</if>>(GMT-10:00) Hawaii</option><option value="-9"<if $user_result[time_zone]=="-9"> selected="selected"</if>>(GMT-9:00) Alaska</option><option value="-8"<if $user_result[time_zone]=="-8"> selected="selected"</if>>(GMT-8:00) Pacific Time (US &amp; Canada); Tijuana</option><option value="-7"<if $user_result[time_zone]=="-7"> selected="selected"</if>>(GMT-7:00) Mountain Time (US &amp; Canada)</option><option value="-6"<if $user_result[time_zone]=="-6"> selected="selected"</if>>(GMT-6:00) Central Time (US &amp; Canada)</option><option value="-5"<if $user_result[time_zone]=="-5"> selected="selected"</if>>(GMT-5:00) Eastern Time (US &amp; Canada)</option><option value="-4"<if $user_result[time_zone]=="-4"> selected="selected"</if>>(GMT-4:00) Atlantic Time (Canada)</option><option value="-3"<if $user_result[time_zone]=="-3"> selected="selected"</if>>(GMT-3:00) Greenland</option><option value="-2"<if $user_result[time_zone]=="-2"> selected="selected"</if>>(GMT-2:00) Mid-Atlantic</option><option value="-1"<if $user_result[time_zone]=="-1"> selected="selected"</if>>(GMT-1:00) Cape Verde Is.</option><option value="0"<if !$user_result[time_zone]> selected="selected"</if>>(GMT) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option><option value="1"<if $user_result[time_zone]=="1"> selected="selected"</if>>(GMT+1:00) Brussels, Copenhagen, Madrid, Paris</option><option value="2"<if $user_result[time_zone]=="2"> selected="selected"</if>>(GMT+2:00) Cairo</option><option value="3"<if $user_result[time_zone]=="3"> selected="selected"</if>>(GMT+3:00) Kuwait, Riyadh</option><option value="4"<if $user_result[time_zone]=="4"> selected="selected"</if>>(GMT+4:00) Baku, Tbilisi, Yerevan</option><option value="5"<if $user_result[time_zone]=="5"> selected="selected"</if>>(GMT+5:00) Islamabad, Karachi, Tashkent</option><option value="6"<if $user_result[time_zone]=="6"> selected="selected"</if>>(GMT+6:00) Astana, Dhaka</option><option value="7"<if $user_result[time_zone]=="7"> selected="selected"</if>>(GMT+7:00) Bangkok, Hanoi, Jakarta</option><option value="8"<if $user_result[time_zone]=="8"> selected="selected"</if>>(GMT+8:00) Beijing, Chongqing, Hong Kong, Urumqi</option><option value="9"<if $user_result[time_zone]=="9"> selected="selected"</if>>(GMT+9:00) Osaka, Sapporo, Tokyo</option><option value="10"<if $user_result[time_zone]=="10"> selected="selected"</if>>(GMT+10:00) Canberra, Melbourne, Sydney</option><option value="11"<if $user_result[time_zone]=="11"> selected="selected"</if>>(GMT+11:00) Magadan, Solomon Is., New Caledonia</option><option value="12"<if $user_result[time_zone]=="12"> selected="selected"</if>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option></select><br /><span class="small"><input type="checkbox" value="1" name="time_zone_dst" id="time_zone_dst"<if $user_result[time_zone_dst]> checked="checked"</if> /> User is affected by Daylight Savings Time<br /><input type="checkbox" value="1" name="southern_hemisphere" id="southern_hemisphere"<if $user_result[southern_hemisphere]> checked="checked"</if> /> User lives in the southern hemisphere</span>
</div></td>
</tr>
<tr>
<td><b>Mark threads as read after being inactive:</b><br />
<span class="small">If you'd like all threads to be marked as read after a certain period of inactivity, put this amount of time here in minutes. Otherwise, type <b>0</b> (zero).</span></td><td colspan="2"><input name="markread_time" type="text" size="60" value="$user_result[markread_time]" /></td>
</tr>
<tr>
<td><b>Website:</b></td><td colspan="2"><input name="website" type="text" size="60" value="<if $user_result[website]>$user_result[website]<else />http://</if>" /></td>
</tr>
<tr>
<td><b>Location:</b><br />
<span class="small">Where you live</span></td><td colspan="2"><input name="location" type="text" size="60" value="$user_result[location]" /></td>
</tr>
$customfields
<tr>
<td><b>Signature:</b></td>
<td colspan="2">
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="signatureDiv"><iframe id="signatureIframe"></iframe></div>');
//-->
</script>
<textarea name="signature" id="signature" style="width: 100%" rows="5" cols="50">$message</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('signature');
-->
</script></if>
</td>
</tr>
<tr>
<td colspan="3" class="heading">Avatar</td>
</tr>
<tr>
<td><b>Use an avatar:</b></td><td colspan="2">Yes:<input name="useavatar" type="radio" value="1" checked="checked" /> No:<input name="useavatar" type="radio" value="0" /></td>
</tr>
<if $user_result[parsed_avatar]>
<tr>
<td><b>Current avatar:</b></td><td colspan="2"><img alt="$user_result[name]'s avatar" src="$user_result[parsed_avatar]" /></td>
</tr>
</if>
<tr>
<td colspan="3" class="center"><input type="button" onclick="window.location='users.php?op=ban&amp;id=$user_result[userid]'" value="Ban User" /> <input type="button" onclick="window.location='users.php?op=doipcheck&amp;userid=$user_result[userid]'" value="Check IP" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1077772157";}s:14:"modusers_index";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:3734:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt; Users</b><br />
<br />
<form action="users.php" method="post">
<div><input name="op" type="hidden" value="search" /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><b>Most Recent Users:</b><br />$users</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="0" cellpadding="1">
<tr>
<td><table class="cellmain" cellspacing="0" cellpadding="15">
<tr>
<td class="center"><a class="linksmall" href="users.php?op=ipcheck"><img alt="Check IP Addresses" src="$style[images]/users.gif" />
<br />
Check IP Addresses</a></td>
<td class="center"><a class="linksmall" href="users.php?op=search&amp;all=1&amp;all_groups=1"><img alt="View All Users" src="$style[images]/users.gif" />
<br />
View All Users</a></td>
</tr>
</table></td>
</tr>
</table><br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Search for Users</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td>
<td colspan="2"><input size="60" name="name" type="text" /></td>
</tr>
<tr id="ingroup" valign="top">
<td><b>In one of these groups:</b><br />
<br />
<div class="center"><a href="javascript:check_all(getElement('ingroup'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('ingroup'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></div></td><td class="small" style="white-space: nowrap">$usergroups_col1</td><td class="small" style="white-space: nowrap">$usergroups_col2</td>
</tr>
<tr>
<td><b>Style set:</b></td>
<td colspan="2"><select name="stylesetid"><option value="0" selected="selected">Any style set</option>$stylesets</select></td>
</tr>
<tr>
<td><b>Email address:</b></td>
<td colspan="2"><input size="60" name="email" type="text" /></td>
</tr>
<tr>
<td><b>AOL Instant Messenger:</b></td>
<td colspan="2"><input size="60" name="aol" type="text" /></td>
</tr>
<tr>
<td><b>ICQ:</b></td>
<td colspan="2"><input size="60" name="icq" type="text" /></td>
</tr>
<tr>
<td><b>MSN Messenger:</b></td>
<td colspan="2"><input size="60" name="msn" type="text" /></td>
</tr>
<tr>
<td><b>Yahoo Instant Messenger:</b></td>
<td colspan="2"><input size="60" name="yahoo" type="text" /></td>
</tr>
<tr>
<td><b>At least this many posts:</b></td>
<td colspan="2"><input size="60" name="minposts" type="text" value="0" /></td>
</tr>
<tr>
<td><b>At most this many posts:</b></td>
<td colspan="2"><input size="60" name="maxposts" type="text" value="4294967296" /></td>
</tr>
<tr>
<td><b>Custom title:</b></td>
<td colspan="2"><input size="60" name="title" type="text" /></td>
</tr>
<tr>
<td><b>Joined on or after this date:</b></td>
<td colspan="2"><input size="60" name="minjoin" type="text" value="1969-12-31" /></td>
</tr>
<tr>
<td><b>Joined on or before this date:</b></td>
<td colspan="2"><input size="60" name="maxjoin" type="text" value="2029-12-31" /></td>
</tr>
<tr>
<td><b>Website:</b></td>
<td colspan="2"><input size="60" name="website" type="text" /></td>
</tr>
<tr>
<td><b>Location:</b></td>
<td colspan="2"><input size="60" name="location" type="text" /></td>
</tr>
$customfields
<tr>
<td><b>Signature:</b></td>
<td colspan="2"><input size="60" name="signature" type="text" /></td>
</tr>
<tr>
<td colspan="3" class="center"><input type="submit" value="Search" /></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073768129";}s:13:"modusers_user";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:326:"&nbsp;&nbsp;&nbsp;<span class="small">$user_result[name] [</span><if $group[supermod_banusers]><a class="linksmall" href="users.php?op=ban&amp;id=$user_result[userid]">Ban</a> <span class="small">-</span> </if><a class="linksmall" href="users.php?op=view&amp;id=$user_result[userid]">View</a><span class="small">]</span><br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073767900";}s:15:"modusers_search";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:863:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; Search Results</b><br />
<br />
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr><td class="tableheader"><span class="small">Username</span></td><td class="tableheader"><span class="small">Private Message</span></td><td class="tableheader"><span class="small">Email</span></td><td class="tableheader"><span class="small">Search</span></td><td class="tableheader"><span class="small">Join Date</span></td><td class="tableheader"><span class="small">Posts</span></td><td class="tableheader"><span class="small">Moderator Options</span></td></tr>
$users
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073767806";}s:22:"modusers_search_result";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:1083:"<tr><td class="$color"><a href="$relativeurl/profile.php?id=$user_result[userid]">$user_result[parsed_name]</a></td><td class="$color"><if $showpm><div class="center"><a href="$relativeurl/newpm.php?id=$user_result[userid]"><img alt="Send $user_result[name] a private message" src="$style[images]/pm.gif" /></a></div></if></td><td class="$color"><if $showemail><div class="center"><a href="$relativeurl/email.php?id=$user_result[userid]"><img alt="Send $user_result[name] an email" src="$style[images]/email.gif" /></a></div></if></td><td class="$color"><if $showsearch><div class="center"><a href="$relativeurl/search.php?op=post&amp;type=post&amp;sort=desc&amp;userid=$user_result[userid]"><img alt="Search for posts made by $user_result[name]" src="$style[images]/search.gif" /></a></div></if></td><td class="$color">$user_result[joindate]</td><td class="$color">$user_result[posts]</td><td class="$color"><if $group[supermod_banusers]><a href="users.php?op=ban&amp;id=$user_result[userid]">Ban</a> - </if><a href="users.php?op=view&amp;id=$user_result[userid]">View</a></td></tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073767857";}s:8:"ban_user";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:444:"<include template="message_header" />
Are you sure you want to ban user <b>$user_result[name]</b>?
<br />
<br />
<form action="users.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doban" />
<input name="id" type="hidden" value="$user_result[userid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='users.php'" /></div></form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073767508";}s:17:"ban_user_redirect";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:158:"<include template="redirect_header" />
The user has been banned. You are now being returned to the users control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073767533";}s:19:"announcements_index";a:4:{s:8:"category";s:22:"Mod CP - Announcements";s:4:"body";s:663:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt; Announcements</b>
<br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="0">
<tr>
<td><table class="cellmain" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td><b>All forums</b><if $allforums> <span class="small">[</span><a class="linksmall" href="announcements.php?op=add&amp;id=0">Add Announcement</a><span class="small">]</span></if><br />
$announcements<br />
$forums</td>
</tr>
</table></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:26:"announcements_announcement";a:4:{s:8:"category";s:22:"Mod CP - Announcements";s:4:"body";s:381:"$announcement_indent&nbsp;&nbsp;&nbsp;<i>$announcement[name]</i><if $canannounce> <span class="small">[</span><a class="linksmall" href="announcements.php?op=edit&amp;id=$announcement[announcementid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="announcements.php?op=delete&amp;id=$announcement[announcementid]">Delete</a><span class="small">]</span></if><br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"announcements_forum";a:4:{s:8:"category";s:22:"Mod CP - Announcements";s:4:"body";s:214:"<b>$forum[name]</b><if $canannounce> <span class="small">[</span><a class="linksmall" href="announcements.php?op=add&amp;id=$forum[forumid]">Add Announcement</a><span class="small">]</span></if><br />$announcements";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"add_announcement";a:4:{s:8:"category";s:22:"Mod CP - Announcements";s:4:"body";s:2790:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_dialog.js"></script>
</if>
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<form action="announcements.php" method="post" onsubmit="return announcement_submit()">
<div><input name="op" type="hidden" value="doadd" />
<input name="parsed_message" type="hidden" value="" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt;</b> <a href="announcements.php"><b>Announcements</b></a> <b>&gt; Add Announcement</b>
<br />
<br /></div>
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Announcement</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" id="name" type="text" /></td>
</tr>
<tr>
<td><b>Start date:</b><br />
<span class="small">Enter the date on which you want your announcement to start. Please specify the date in <b>YYYY-MM-DD</b> format.</span></td>
<td><input size="60" name="start" id="start" type="text" value="$start_date" /></td>
</tr>
<tr>
<td><b>End date:</b><br />
<span class="small">Enter the date on which you want your announcement to end. Please specify the date in <b>YYYY-MM-DD</b> format.</span></td>
<td><input size="60" name="end" id="end" type="text" value="$end_date" /></td>
</tr>
<tr>
<td><b>Forum:</b></td>
<td><select class="small" name="forumid"><if $allforums><option value="0">All Forums</option></if>$forum_choices</select></td>
</tr>
<tr>
<td><b>Message:</b>
$smilie_box</td>
<td colspan="2">
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" rows="15" cols="80"></textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script></if>
</td>
</tr>
<tr>
<td><b>Options:</b></td><td class="small">
<input name="url" type="checkbox" value="1" checked="checked" /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1" /> Disable DP Code<br />
<input name="smilies" type="checkbox" value="1" /> Disable Smilies</td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Announcement" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073356939";}s:21:"announcements_missing";a:4:{s:8:"category";s:22:"Mod CP - Announcements";s:4:"body";s:157:"<include template="message_header" />
You must specify a name, start date, end date, and message for your announcement.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"delete_announcement";a:4:{s:8:"category";s:22:"Mod CP - Announcements";s:4:"body";s:491:"<include template="message_header" />
Are you sure you want to remove announcement <b>$announcement[name]</b>?<br />
<br />
<br />
<form action="announcements.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$announcement[announcementid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='announcements.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073357001";}s:17:"edit_announcement";a:4:{s:8:"category";s:22:"Mod CP - Announcements";s:4:"body";s:3102:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_dialog.js"></script>
</if>
<script type="text/javascript" src="$relativeurl/javascript/admin.js"></script>
<form action="announcements.php" method="post" onsubmit="return announcement_submit()">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$announcement[announcementid]" />
<input id="parsed_message" name="parsed_message" type="hidden" value="$parsedmessage" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt;</b> <a href="announcements.php"><b>Announcements</b></a> <b>&gt; Edit Announcement</b>
<br />
<br /></div>
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Announcement - $announcement[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" id="name" name="name" type="text" value="$announcement[name]" /></td>
</tr>
<tr>
<td><b>Start date:</b><br />
<span class="small">Enter the date on which you want your announcement to start. Please specify the date in <b>YYYY-MM-DD</b> format.</span></td>
<td><input size="60" id="start" name="start" type="text" value="$announcement[start]" /></td>
</tr>
<tr>
<td><b>End date:</b><br />
<span class="small">Enter the date on which you want your announcement to end. Please specify the date in <b>YYYY-MM-DD</b> format.</span></td>
<td><input size="60" id="end" name="end" type="text" value="$announcement[end]" /></td>
</tr>
<tr>
<td><b>Forum:</b></td>
<td><select class="small" name="forumid"><if $allforums><option value="0">All Forums</option></if>$forum_choices</select></td>
</tr>
<tr>
<td><b>Message:</b>
$smilie_box</td>
<td colspan="2">
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" rows="15" cols="80">$message</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script></if>
</td>
</tr>
<tr>
<td><b>Options:</b></td><td class="small"><input name="url" type="checkbox" value="1"<if $announcement[url]> checked="checked"</if> /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1"<if !$announcement[dpcode]> checked="checked"</if> /> Disable DP Code<br />
<input name="smilies" type="checkbox" value="1"<if !$announcement[smilies]> checked="checked"</if> /> Disable Smilies</td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Announcement" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073356716";}s:28:"downloads_duplicate_category";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:126:"<include template="message_header" />
A download category with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"links_duplicate_category";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:122:"<include template="message_header" />
A link category with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"groupchanger_missing";a:4:{s:8:"category";s:24:"Admin CP - Group Changer";s:4:"body";s:132:"<include template="message_header" />
You must specify a name, condition, and number of posts.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"maintenance_usernames";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:285:"<include template="redirect_header" />
Username maintenance 
<if $i==$cycle>
is continuing... (last user was <b>$lastid</b>)
<else />
has completed (last user was <b>$lastid</b>). You are now being returned to the maintenance control panel.
</if>
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"edit_templateset";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:2437:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="templates.php?current_templateset=$templateset_res[templatesetid]&amp;search=$search"><b>Templates</b></a> <b>&gt; Edit Template Set</b>
<br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><form action="templates.php" method="post" style="margin:0">
<div><input type="hidden" value="$current_templateset" name="current_templateset" />
<b>Template set: </b><select name="current_templateset" onchange="window.location='templates.php?search=$search&amp;current_templateset='+this.options[this.selectedIndex].value">$templatesets</select> - <b>Search:</b> <input id="search" name="search" type="text" /> <input type="submit" value="Search" /> - <a href="templates.php?op=addset&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Add</a> - <a href="templates.php?op=deleteset&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Delete</a> - <a href="templates.php?op=editset&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Edit</a> - <a href="templates.php?op=export&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Export</a>
- <a href="templates.php?op=import&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Import</a> - <a href="templates.php?op=revertset&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Revert</a>
</div></form></td>
</tr>
</table><br />
<form action="templates.php" method="post">
<div><input name="op" type="hidden" value="doeditset" />
<input name="current_templateset" type="hidden" value="$templateset_res[templatesetid]" />
<input name="search" type="hidden" value="$search" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Template Set - $templateset_res[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$templateset_res[name]" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Template Set" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073708824";}s:31:"templates_duplicate_templateset";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:121:"<include template="message_header" />
A template set with that name already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:29:"templates_templateset_missing";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:122:"<include template="message_header" />
You must specify a name for your template set.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:9:"add_style";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:1929:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="styles.php"><b>Styles</b></a> <b>&gt; Add Style</b>
<br />
<br />
<form enctype="multipart/form-data" action="styles.php" method="post">
<div><input name="op" type="hidden" value="doadd" />
<input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><b>Style: </b><select name="current_style" onchange="window.location='styles.php?current_style='+this.options[this.selectedIndex].value">$styles</select> <a href="styles.php?op=add&amp;current_style=$current_style">Add</a> - <a href="styles.php?op=delete&amp;current_style=$current_style">Delete</a> - <a href="styles.php?op=export&amp;current_style=$current_style">Export</a> - <a href="styles.php?op=revert&amp;current_style=$current_style">Revert</a></td>
</tr>
</table>
<br /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add Style</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="80" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Options:</b></td>
<td style="white-space: nowrap"><input name="style_select" type="radio" value="default" checked="checked" />Create a new copy of the default Deluxe Portal style<br />
<input name="style_select" type="radio" value="copy" />Copy an existing style: <select name="style_copy">$styles</select><br />
<input name="style_select" type="radio" value="import" />Import a style: <input name="import" type="file" size="46" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Style" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073766233";}s:14:"styles_missing";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:115:"<include template="message_header" />
You must specify a name for your style.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"style_default_invalid";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:183:"<include template="message_header" />
The default style file is missing. Please redownload Deluxe Portal and upload style.dps.php to your server.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"style_import_invalid";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:111:"<include template="message_header" />
You must upload a valid style file.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"revert_style";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:526:"<include template="message_header" />
Are you sure you want to revert <b>$style_result[name]</b> to the default style?<br />
<br />
<br />
<form action="styles.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dorevert" />
<input name="current_style" type="hidden" value="$style_result[styleid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='styles.php?current_style=$style_result[styleid]'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073766290";}s:21:"revert_style_redirect";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:188:"<include template="redirect_header" />
The style has been reverted back to the default style. You are now being returned to the styles control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"revert_templateset";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:584:"<include template="message_header" />
Are you sure you want to revert <b>$templateset_result[name]</b> to the default template set?<br />
<br />
<br />
<form action="templates.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dorevertset" />
<input name="current_templateset" type="hidden" value="$templateset_result[templatesetid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='templates.php?current_templateset=$templateset_result[templatesetid]'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073709265";}s:26:"templateset_import_invalid";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:118:"<include template="message_header" />
You must upload a valid template set file.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:27:"revert_templateset_redirect";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:197:"<include template="redirect_header" />
The template set has been reverted to the default templates. You are now being returned to the templates control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"delete_templateset_denied";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:144:"<include template="message_header" />
This template set is currently being used by one or more style sets.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"delete_templateset";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:569:"<include template="message_header" />
Are you sure you want to delete template set <b>$templateset_result[name]</b>?<br />
<br />
<br />
<form action="templates.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodeleteset" />
<input name="current_templateset" type="hidden" value="$templateset_result[templatesetid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='templates.php?current_templateset=$templateset_result[templatesetid]'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073708416";}s:15:"revert_template";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:599:"<include template="message_header" />
Are you sure you want to revert <b>$template_result[name]</b> to its default state?<br />
<br />
<br />
<form action="templates.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dorevert" />
<input name="id" type="hidden" value="$template_result[templateid]" />
<input name="search" type="hidden" value="$search" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='templates.php?current_templateset=$template_result[templatesetid]'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073710016";}s:16:"invalid_template";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:114:"<include template="message_header" />
The specified template does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056268891";}s:24:"revert_template_redirect";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:178:"<include template="redirect_header" />
The specified template has been reverted. You are now being returned to the templates control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:23:"import_template_missing";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:161:"<include template="message_header" />
The specified template is not a default Deluxe Portal template. You cannot revert it.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"add_templateset";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:2890:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="templates.php?current_templateset=$current_templateset&amp;search=$search"><b>Templates</b></a> <b>&gt; Add Template Set</b>
<br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><form action="templates.php" method="post" style="margin:0">
<div><input type="hidden" value="$current_templateset" name="current_templateset" />
<b>Template set: </b><select name="current_templateset" onchange="window.location='templates.php?search=$search&amp;current_templateset='+this.options[this.selectedIndex].value">$templatesets</select> - <b>Search:</b> <input id="search" name="search" type="text" /> <input type="submit" value="Search" /> - <a href="templates.php?op=addset&amp;current_templateset=$current_templateset&amp;search=$search">Add</a> - <a href="templates.php?op=deleteset&amp;current_templateset=$current_templateset&amp;search=$search">Delete</a> - <a href="templates.php?op=editset&amp;current_templateset=$current_templateset&amp;search=$search">Edit</a> - <a href="templates.php?op=export&amp;current_templateset=$current_templateset&amp;search=$search">Export</a>
- <a href="templates.php?op=import&amp;current_templateset=$current_templateset&amp;search=$search">Import</a> - <a href="templates.php?op=revertset&amp;current_templateset=$current_templateset&amp;search=$search">Revert</a>
</div></form></td>
</tr>
</table><br />
<form enctype="multipart/form-data" action="templates.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doaddset" />
<input name="current_templateset" type="hidden" value="$current_templateset" />
<input name="search" type="hidden" value="$search" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add Template Set</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="80" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Options:</b></td>
<td style="white-space: nowrap"><input name="templateset_select" type="radio" value="default" checked="checked" />Create a new copy of the default Deluxe Portal templates<br />
<input name="templateset_select" type="radio" value="copy" />Copy an existing set of templates: <select name="templateset_copy">$templatesets</select><br />
<input name="templateset_select" type="radio" value="import" />Import a set of templates: <input name="import" type="file" size="46" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Template Set" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073708676";}s:14:"massmove_index";a:4:{s:8:"category";s:18:"Mod CP - Mass Move";s:4:"body";s:1988:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt; Mass Move</b><br />
<br />
<div class="center"><form action="move.php" method="post">
<div><input name="op" type="hidden" value="date" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Mass Move by Date</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Move threads with last post older than x days:</b></td><td><input name="days" type="text" size="60" /></td>
</tr>
<tr>
<td><b>From:</b></td><td><select name="from"><option value="0">All Forums</option>$from_forums</select><br />
<input name="subforums" type="checkbox" value="1" checked="checked" /> <span class="small">Include sub-forums</span></td>
</tr>
<tr>
<td><b>To:</b></td><td><select name="to">$to_forums</select></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Move" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="move.php" method="post">
<div><input name="op" type="hidden" value="user" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Mass Move by User</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Move threads started by user:</b></td><td><input name="username" type="text" size="60" /></td>
</tr>
<tr>
<td><b>From:</b></td><td><select name="from"><option value="0">All Forums</option>$from_forums</select><br />
<input name="subforums" type="checkbox" value="1" checked="checked" /> <span class="small">Include sub-forums</span></td>
</tr>
<tr>
<td><b>To:</b></td><td><select name="to">$to_forums</select></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Move" /></td>
</tr>
<include template="form_footer" />
</table>
</form></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073373014";}s:17:"massmove_redirect";a:4:{s:8:"category";s:18:"Mod CP - Mass Move";s:4:"body";s:161:"<include template="redirect_header" />
Mass move has completed. You are now being returned to the mass move control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062307230";}s:19:"massdelete_redirect";a:4:{s:8:"category";s:20:"Mod CP - Mass Delete";s:4:"body";s:165:"<include template="redirect_header" />
Mass delete has completed. You are now being returned to the mass delete control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062298771";}s:16:"massdelete_index";a:4:{s:8:"category";s:20:"Mod CP - Mass Delete";s:4:"body";s:1850:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt; Mass Delete</b><br />
<br />
<div class="center"><form action="delete.php" method="post">
<div><input name="op" type="hidden" value="date" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Mass Delete by Date</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Delete threads with last post older than x days:</b></td><td><input name="days" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Forum:</b></td><td><select name="forumid"><option value="0">All Forums</option>$forums</select><br />
<input name="subforums" type="checkbox" value="1" checked="checked" /> <span class="small">Include sub-forums</span></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Delete" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="delete.php" method="post">
<div><input name="op" type="hidden" value="user" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="95%">
<tr>
<td class="tableheader">Mass Delete by User</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Delete threads started by user:</b></td><td><input name="username" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Forum:</b></td><td><select name="forumid"><option value="0">All Forums</option>$forums</select><br />
<input name="subforums" type="checkbox" value="1" checked="checked" /> <span class="small">Include sub-forums</span></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Delete" /></td>
</tr>
<include template="form_footer" />
</table>
</form></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073372967";}s:25:"massdelete_users_redirect";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:170:"<include template="redirect_header" />
The selected users have been deleted. You are now being returned to the users control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"massdelete_users";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:436:"<include template="message_header" />
Are you sure you want to delete the selected users?
<br />
<br />
<form action="users.php" method="post">
<div class="center">
<input name="results" type="hidden" value="$results" />
<input name="op" type="hidden" value="domassdelete" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='users.php'" />
</div></form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073765815";}s:14:"massmail_users";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:1123:"<include template="header" />
<form action="users.php" method="post">
<div><input name="op" type="hidden" value="domassmail" />
<input name="results" type="hidden" value="$results" />
<input name="start" type="hidden" value="0" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; Mass Mail</b>
<br />
<br /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Mass Mail</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Subject:</b></td>
<td><input size="80" name="subject" type="text" /></td>
</tr>
<tr>
<td><b>Message:</b></td>
<td><textarea rows="20" cols="70" name="message"></textarea></td>
</tr>
<tr>
<td><b>Number of users to mail per cycle:</b></td>
<td><input size="10" name="cycle" type="text" value="500" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Send Email" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073765905";}s:23:"massmail_users_redirect";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:171:"<include template="redirect_header" />
The specified users have been emailed. You are now being returned to the users control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:8:"check_ip";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:1045:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; Check IP Addresses</b><br />
<br />
<form action="users.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doipcheck" />
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Check IP Addresses</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td><td><input name="username" type="text" size="60" /></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>IP address:</b><br />
<span class="small">You can enter a partial ip address (i.e. <b>66.26.</b>).</span></td><td><input name="ipaddress" type="text" size="60" /></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Check IP Addresses" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073766090";}s:16:"check_ip_results";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:582:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt;</b> <a href="users.php?op=ipcheck"><b>Check IP Addresses</b></a> <b>&gt; Results</b><br />
<br />
<div class="center"><table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">IP Address Check Results</td>
</tr>
<tr>
<td class="cellalt">$results</td>
</tr>
</table></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:20:"mod_check_ip_results";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:578:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt;</b> <a href="users.php?op=ipcheck"><b>Check IP Addresses</b></a> <b>&gt; Results</b><br />
<br />
<div class="center"><table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">IP Address Check Results</td>
</tr>
<tr>
<td class="cellalt">$results</td>
</tr>
</table></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073767665";}s:12:"mod_check_ip";a:4:{s:8:"category";s:14:"Mod CP - Users";s:4:"body";s:1041:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Moderator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; Check IP Addresses</b><br />
<br />
<form action="users.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doipcheck" />
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Check IP Addresses</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td><td><input name="username" type="text" size="60" /></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>IP address:</b><br />
<span class="small">You can enter a partial ip address (i.e. <b>66.26.</b>).</span></td><td><input name="ipaddress" type="text" size="60" /></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Check IP Addresses" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073768400";}s:20:"logout_user_redirect";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:124:"<include template="redirect_header" />
<b>$user_result[name]</b> has been logged out.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:26:"replace_templates_redirect";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:219:"<include template="redirect_header" />
All instances of <b>$searchterms</b> have been replaced with <b>$replaceterms</b>. You are now being returned to the templates control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062393319";}s:21:"maintenance_templates";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:293:"<include template="redirect_header" />

Template re-parsing
<if $i==$cycle>
is continuing... (last template was <b>$lastid</b>)
<else />
has completed (last template was <b>$lastid</b>). You are now being returned to the maintenance control panel.
</if>

<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:22:"maintenance_imagestore";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:176:"<include template="redirect_header" />
Imagestore maintenance has completed. You are now being returned to the maintenance control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"announcements_date";a:4:{s:8:"category";s:22:"Mod CP - Announcements";s:4:"body";s:127:"<include template="message_header" />
The end date cannot be earlier than the start date.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:23:"massmail_users_continue";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:636:"<include template="message_header" />
<form action="users.php" method="post">
<input name="op" type="hidden" value="domassmail" />
<input name="results" type="hidden" value="$results" />
<input name="start" type="hidden" value="$start" />
<input name="cycle" type="hidden" value="$cycle" />
<input name="subject" type="hidden" value="$subject" />
<input name="message" type="hidden" value="$message" />
Mass mailing in progress (mailed <b>$start</b> users so far). Click next to email the next batch of users.<br />
<br />
<div class="center"><input type="submit" value="Next &gt;" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"masspm_users";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:2473:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg_dialog.js"></script>
</if>
<form action="users.php" method="post">
<div><input name="op" type="hidden" value="domasspm" />
<input name="parsed_message" type="hidden" value="" />
<input name="results" type="hidden" value="$results" />
<input name="start" type="hidden" value="0" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="users.php"><b>Users</b></a> <b>&gt; Mass PM</b>
<br />
<br /></div>
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Mass PM</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Subject:</b></td>
<td><input name="subject" type="text" size="80" /></td>
</tr>
$icons
<tr>
<td><b>Message:</b><br />
<span class="small">DP Code is <b><if $config[pm_dpcode]>en<else />dis</if>abled</b><br />
Images are <b><if $config[pm_img]>en<else />dis</if>abled</b><br />
Smilies are <b><if $config[pm_smilies]>en<else />dis</if>abled</b></span>
$smilie_box</td>
<td><script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" rows="15" cols="80"></textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script></if></td>
</tr>
<tr>
<td><b>Options:</b></td>
<td class="small"><input name="html" value="1" type="checkbox" /> Allow HTML in this message<br />
<input name="url" type="checkbox" value="1" checked="checked" /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1" /> Disable DP Code<br />
<input name="smilies" type="checkbox" value="1" /> Disable Smilies</td>
</tr>
<tr>
<td><b>Number of users to PM per cycle:</b></td>
<td><input name="cycle" type="text" size="10" value="100" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Send Messages" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073765987";}s:21:"masspm_users_continue";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:785:"<include template="message_header" />
<form action="users.php" method="post">
<input name="op" type="hidden" value="domasspm" />
<input name="results" type="hidden" value="$results" />
<input name="start" type="hidden" value="$start" />
<input name="cycle" type="hidden" value="$cycle" />
<input name="subject" type="hidden" value="$subject" />
<input name="message" type="hidden" value="$message" />
<input name="url" type="hidden" value="$url" />
<input name="dpcode" type="hidden" value="$dpcode" />
<input name="smilies" type="hidden" value="$smilies" />
Mass PMing in progress (PMed <b>$start</b> users so far). Click next to PM the next batch of users.<br />
<br />
<div class="center"><input type="submit" value="Next &gt;" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"masspm_users_redirect";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:168:"<include template="redirect_header" />
The specified users have been PMed. You are now being returned to the users control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:6:"header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:3890:"<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=$style[charset]" />
<if $pagestyle && !$config[external_style]><style type="text/css" media="all">
$pagestyle
</style><else /><link rel="stylesheet" media="all" type="text/css" href="$relativeurl/styles.php" /></if>
<link rel="stylesheet" media="all" type="text/css" href="$style[wysiwygcss]" />
<title>
$config[name] - $pagetitle
</title>
</head>
<body>
<script type="text/javascript" src="$relativeurl/javascript/javascript.js"></script>
<script type="text/javascript">
<!--
function smilie_popup () {
	window.open("$relativeurl/smilies.php", "replies", "toolbar=no,scrollbars=yes,resizable=yes,width=320,height=320") }
<if $dopmpopup>
if (confirm('You have one or more new private messages. Click OK to view your inbox, or Cancel to ignore this message.'))
{
   if (confirm('Click OK to open your inbox in a new window, or Cancel to open it in this window.'))
      window.open('$relativeurl/pm.php', '_blank');
   else
      window.location.href='$relativeurl/pm.php';
}
</if>
relativeUrl = '$relativeurl';
clientDate = new Date();
cookieDate = new Date();
cookieDate.setDate(cookieDate.getDate() + 365);
document.cookie = 'dp_timezone=' + (clientDate.getTimezoneOffset() * -1) + '; expires=' + cookieDate.toGMTString() + ';';
dst1 = new Date('March 20, 1999 2:59:59');
dst2 = new Date('April 15, 1999 2:59:59');
dst1 = dst1.getTimezoneOffset();
dst2 = dst2.getTimezoneOffset();
southernHemisphere = 0;
dst = 0;
if (dst1!=dst2)
{
	dst = 1;

	if (dst1<dst2)
		southernHemisphere = 1;
}
//-->
</script>
<div id="logodiv"><a name="top" id="top"></a><a href="$relativeurl/index.php"><img alt="$config[name]" src="$style[logo]" /></a></div>
<table id="navbartable" cellspacing="0" cellpadding="3" class="foreground" width="100%">
<tr>
<td><div id="loggedindiv"><a href="$relativeurl/user.php"><if $user[userid]>You are logged in as $user[name]</a> (<a href="$relativeurl/user.php?op=logout">Log out</a>)<else />You are not currently logged in.</a></if></div></td>
<td align="right"><if $load_limit><img alt="Server load too high: $avg[1]" src="$style[images]/serverload.gif" /></a> </if><if $closed_admin><a href="$relativeurl/$admincp_dir/configuration.php?section=open#open"><img alt="$closed_reason" src="$style[images]/site_closed.gif" /></a> </if><a href="$relativeurl/user.php"><img alt="User Control Panel" src="$style[images]/top_profile.gif" /></a><if !$user[userid]><a href="$relativeurl/register.php"><img alt="Register" src="$style[images]/top_register.gif" /></a></if><if $nonewmessages><a href="$relativeurl/pm.php"><img alt="Private Messages" src="$style[images]/top_messages.gif" /></a></if><if $newmessages><a href="$relativeurl/pm.php"><img alt="You have new messages" src="$style[images]/top_newmessages.gif" /></a></if><a href="$relativeurl/members.php"><img alt="Member list" src="$style[images]/top_members.gif" /></a><a  href="$relativeurl/search.php"><img alt="Search" src="$style[images]/top_search.gif" /></a><if $admin_button><a href="$relativeurl/$admincp_dir/index.php"><img alt="Administrator Control Panel" src="$style[images]/top_admin.gif" /></a></if><if $mod_button><a href="$relativeurl/$modcp_dir/index.php"><img alt="Moderator Control Panel" src="$style[images]/top_mod.gif" /></a></if><a href="$relativeurl/forum.php"><img alt="Forum" src="$style[images]/top_forum.gif" /></a><a href="$relativeurl/index.php"><img alt="Home" src="$style[images]/top_home.gif" /></a></td>
</tr>
</table>
<div style="text-align:center;"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" id="contenttable" class="foreground contenttable" width="95%">
<tr>
<td id="contentcell" class="contentcell"><br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1082836686";}s:6:"footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:1400:"<br /></td>
</tr>
</table>
</div>
<div id="footerdiv" class="center">
<if $config[show_querycounter]>Number of queries: $query_counter<br />
Execution time: $execution_time ($php_execution_percentage% PHP - $sql_execution_percentage% SQL)<br />
Number of Templates Included: $totaltemplates<br />
<if $alltemplates><b>There were uncached templates on this page!</b><br /></if>
<br /></if>
<if ($config[show_querycounter] && (!$config[listqueries] || $group[configuration]))>[<a class="backgroundlink" href="<if (strstr($listqueries_url, '?'))>$listqueries_url&amp;explain=1<else />$listqueries_url?explain=1</if>">List Queries</a>]<br />
<br /></if>
&laquo; <a class="backgroundlink" href="mailto:$config[contact]"><b>Contact Us</b></a> - <a class="backgroundlink" href="$relativeurl/faq.php?faq=userfaq"><b>FAQ</b></a> - <a class="backgroundlink" href="$relativeurl/index.php"><b>$config[name]</b></a> - <a class="backgroundlink" href="$relativeurl/forum.php"><b>$config[name] Forums</b></a> &raquo;
<br />
<br />
Powered by <a class="backgroundlink" href="http://www.deluxeportal.net" onclick="window.open(this.href,'_blank');return false;">Deluxe Portal</a>, Version $config[version]<br />
Copyright &copy;2002-2006 <a class="backgroundlink" href="http://www.nomative.com" onclick="window.open(this.href,'_blank');return false;">Nomative Systems</a><br />
$config[copyright]
</div>
</body>
</html>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1144549957";}s:11:"form_footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:39:"</table></td>
</tr>
</table></td>
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"form_header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:216:"<tr>
<td class="cellmain" style="width: 100%"><table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td style="width:100%"><table class="cellmain" cellpadding="$style[cellpadding]" width="100%">";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"message_header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:244:"<include template="header" />
<div class="center"><table class="tableline" width="75%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">$config[name] Message</td>
</tr>
<tr>
<td class="cellmain">";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"message_footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:179:"<br />
<br />
<div class="center"><a class="small" href="javascript:history.back()">Go back to the previous page</a></div>
</td>
</tr>
</table></div>
<include template="footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"templateset_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:124:"<option value="$templateset_result[templatesetid]"<if $selected> selected="selected"</if>>$templateset_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"addgroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:131:"<input name="add_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"deleteothersgroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:140:"<input name="deleteothers_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"deleteowngroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:137:"<input name="deleteown_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:23:"downloadcategory_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:123:"<option value="$category_result[downloadcategoryid]"<if $selected> selected="selected"</if>>$category_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:22:"editothersgroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:138:"<input name="editothers_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"editowngroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:135:"<input name="editown_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"emailgroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:138:"<input name="emailgroup_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"forum_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:106:"<option value="$forum_result[forumid]"<if $selected> selected="selected"</if>>$forum_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"forum_nodeleting";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:14:" (No Deleting)";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"group_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:106:"<option value="$group_result[groupid]"<if $selected> selected="selected"</if>>$group_result[name]</option>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073352300";}s:17:"guestgroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:138:"<input name="guestgroup_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"ingroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:130:"<input name="in_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"linkcategory_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:119:"<option value="$category_result[linkcategoryid]"<if $selected> selected="selected"</if>>$category_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"option_indention";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:2:"--";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"option_noposting";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:13:" (No posting)";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"postgroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:132:"<input name="post_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"removegroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:134:"<input name="remove_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"section_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:98:"<option value="$section[sectionid]"<if $selected> selected="selected"</if>>$section[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"styleset_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:115:"<option value="$styleset_result[stylesetid]"<if $selected> selected="selected"</if>>$styleset_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"style_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:106:"<option value="$style_result[styleid]"<if $selected> selected="selected"</if>>$style_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"topic_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:92:"<option value="$topic[topicid]"<if $selected> selected="selected"</if>>$topic[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"usergroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:133:"<input name="group_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"viewgroup_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:132:"<input name="view_$group_result[groupid]" type="checkbox" value="1"<if $checked> checked="checked"</if> /> $group_result[name]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"redirect_footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:293:"<br />
<br />
<a class="linksmall" href="$redirect_url">You are now being redirected to another page. If your browser does not redirect you, please click here</a></div></td>
</tr>
</table><if $config[show_querycounter]><br />
<br />
Number of queries: $query_counter</if></div>
</body>
</html>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"redirect_header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:889:"<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=$style[charset]" />
<if !$config[stop_redirect]><script type="text/javascript">
	function move() {
	window.location = '$redirect_url' }
	setTimeout('move()',$config[redirect_time])
</script></if>
<if $pagestyle><style type="text/css" media="all">
$pagestyle
</style><else /><link rel="stylesheet" media="all" type="text/css" href="$relativeurl/styles.php" /></if>
<title>
$config[name] - $pagetitle
</title>
</head>
<body>
<div style="width:100%; height:100%; padding-top:25%" class="center"><table class="tableline" width="75%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><div class="center">";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074809532";}s:16:"permission_error";a:4:{s:8:"category";s:8:"Messages";s:4:"body";s:2013:"<include template="header" />
<form action="$relativeurl/user.php" method="post">
<div class="center"><input name="op" type="hidden" value="login" />
<input name="redirect_url" type="hidden" value="$current_url" />
<table class="tableline" width="75%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Access Denied</td>
</tr>
<tr>
<td class="cellmain">You are not allowed to view this page. Please read the following list and see if any of these apply:
<br />
<br />
<ul>
<li>You are not logged in. To login, enter your login information below.</li>
<li>You have not registered. To register, please <a href="$relativeurl/register.php">click here</a>.</li>
<li>You do not have permission to view this page. The administrators may have blocked access to this page. If you have further questions about this, please <a href="mailto:$config[contact]">contact an administrator</a>.</li>
</ul>
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td colspan="2" class="tableheader">Login</td>
</tr>
<include template="form_header" />
<tr>
<td colspan="2"><if $user[userid]>
<span class="small">You are logged in as</span> <a class="linksmall" href="$relativeurl/profile.php?id=$user[userid]">$user[name]</a> <span class="small">(</span><a class="linksmall" href="$relativeurl/user.php?op=logout">Log out</a><span class="small">)
<else />
<a class="linksmall" href="$relativeurl/register.php">Click here to register.</a></if><br />
<a class="linksmall" href="$relativeurl/user.php?op=remind">Forgotten your password?</a></td>
</tr>
<tr>
<td><b>Username:</b></td>
<td><input name="name" type="text" /></td>
</tr>
<tr>
<td><b>Password:</b></td>
<td><input name="password" type="password" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Login" /></td>
</tr>
<include template="form_footer" />
</table></div><br />
</td>
</tr>
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1063252999";}s:11:"site_closed";a:4:{s:8:"category";s:8:"Messages";s:4:"body";s:98:"<include template="message_header" />
$config[closed_reason]
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"invalid_announcement";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:118:"<include template="message_header" />
The specified announcement does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"invalid_article";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:113:"<include template="message_header" />
The specified article does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"invalid_customfield";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:126:"<include template="message_header" />
The specified custom profile field does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"invalid_download";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:114:"<include template="message_header" />
The specified download does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"invalid_download_category";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:123:"<include template="message_header" />
The specified download category does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"invalid_dpcode";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:113:"<include template="message_header" />
The specified DP Code does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"invalid_forum";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:111:"<include template="message_header" />
The specified forum does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"invalid_forumperm";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:117:"<include template="message_header" />
The specified forum/group does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"invalid_grouprule";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:124:"<include template="message_header" />
The group changer rule specified does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"invalid_icon";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:110:"<include template="message_header" />
The specified icon does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"invalid_link";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:110:"<include template="message_header" />
The specified link does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"invalid_link_category";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:119:"<include template="message_header" />
The specified link category does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"invalid_moderator";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:115:"<include template="message_header" />
The specified moderator does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"invalid_section";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:113:"<include template="message_header" />
The specified section does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"invalid_smilie";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:112:"<include template="message_header" />
The specified smilie does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"invalid_style";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:111:"<include template="message_header" />
The specified style does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"invalid_styleset";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:115:"<include template="message_header" />
The specified style set does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"invalid_templateset";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:118:"<include template="message_header" />
The specified template set does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"invalid_title";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:111:"<include template="message_header" />
The specified title does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"invalid_topic";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:111:"<include template="message_header" />
The specified topic does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"invalid_user";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:110:"<include template="message_header" />
The specified user does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:6:"banned";a:4:{s:8:"category";s:8:"Messages";s:4:"body";s:216:"<include template="message_header" />
You have been banned from this site. If you have further questions, please <a href="mailto:$config[contact]">contact the administrators</a>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"icon_column";a:4:{s:8:"category";s:5:"Icons";s:4:"body";s:166:"<td><input name="iconid" type="radio" value="$icon[iconid]"<if $checked> checked="checked"</if> /> <img alt="$icon[name]" src="$icon[image]" />&nbsp;&nbsp;&nbsp;</td>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:8:"icon_row";a:4:{s:8:"category";s:5:"Icons";s:4:"body";s:18:"<tr>$icon_row</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"icon_table";a:4:{s:8:"category";s:5:"Icons";s:4:"body";s:226:"<tr>
<td><b>Icon:</b><br />
<input name="iconid" type="radio" value="0"<if !$iconid> checked="checked"</if> /> <span class="small">No icon</span></td>
<td><table style="text-align:left; margin-left:0">$icons</table></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058021642";}s:18:"import_templateset";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:3032:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="templates.php?current_templateset=$current_templateset&amp;search=$search"><b>Templates</b></a> <b>&gt; Import Template Set</b>
<br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><form action="templates.php" method="post" style="margin:0">
<div><input type="hidden" value="$current_templateset" name="current_templateset" />
<b>Template set: </b><select name="current_templateset" onchange="window.location='templates.php?search=$search&amp;current_templateset='+this.options[this.selectedIndex].value">$templatesets</select> - <b>Search:</b> <input id="search" name="search" type="text" /> <input type="submit" value="Search" /> - <a href="templates.php?op=addset&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Add</a> - <a href="templates.php?op=deleteset&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Delete</a> - <a href="templates.php?op=editset&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Edit</a> - <a href="templates.php?op=export&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Export</a>
- <a href="templates.php?op=import&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Import</a> - <a href="templates.php?op=revertset&amp;current_templateset=$templateset_res[templatesetid]&amp;search=$search">Revert</a>
</div></form></td>
</tr>
</table><br />
<form enctype="multipart/form-data" action="templates.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doimport" />
<input name="current_templateset" type="hidden" value="$current_templateset" />
<input name="search" type="hidden" value="$search" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Import Template Set</td>
</tr>
<include template="form_header" />
<tr>
<td style="white-space: nowrap"><b>Import from:</b></td>
<td style="white-space: nowrap"><input name="templateset_select" type="radio" value="default" checked="checked" />The default Deluxe Portal templates<br />
<input name="templateset_select" type="radio" value="copy" />An existing set of templates: <select name="templateset_copy">$templateset_choices</select><br />
<input name="templateset_select" type="radio" value="import" />An exported template set: <input name="import" type="file" size="46" /></td>
</tr>
<tr>
<td><b>Options:</b></td>
<td><input name="delete_old" type="checkbox" value="1" /> Delete current templates before importing</td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Import Template Set" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073709013";}s:11:"server_busy";a:4:{s:8:"category";s:8:"Messages";s:4:"body";s:134:"<include template="message_header" />
The server is currently too busy. Please check back later.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056267333";}s:17:"server_busy_guest";a:4:{s:8:"category";s:8:"Messages";s:4:"body";s:219:"<include template="message_header" />
The server is currently too busy, so guest access has been blocked. Please register for an account by <a href="register.php">clicking here</a>.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056267399";}s:15:"forumperm_reset";a:4:{s:8:"category";s:28:"Admin CP - Forum Permissions";s:4:"body";s:599:"<include template="message_header" />
Are you sure you wish to reset all groups to their default permissions in forum <b>$forum[name]</b>?<br />
<br />
<form action="forumperm.php" method="post">
<div><input name="op" type="hidden" value="doreset" />
<input name="id" type="hidden" value="$forum[forumid]" />
<input name="subforums" type="checkbox" value="1" checked="checked" /> Reset subforums<br />
<br /></div>
<div class="center">
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='forumperm.php'" /></div></form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073366857";}s:14:"forumperm_deny";a:4:{s:8:"category";s:28:"Admin CP - Forum Permissions";s:4:"body";s:610:"<include template="message_header" />
Are you sure you wish to deny access to all groups in forum <b>$forum[name]</b>?<br />
<br />
<form action="forumperm.php" method="post">
<div><input name="op" type="hidden" value="dodeny" />
<input name="id" type="hidden" value="$forum[forumid]" />
<input name="subforums" type="checkbox" value="1" checked="checked" /> Make subforums inherit settings from this forum<br />
<br /></div>
<div class="center">
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='forumperm.php'" /></div></form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073366797";}s:27:"import_templateset_redirect";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:182:"<include template="redirect_header" />
The specified template set has been imported. You are now being returned to the templates control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"check_ip_result";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:211:"<if $results><br /></if>
<if $ip[userid]><a href="$url?op=doipcheck&amp;userid=$ip[userid]">$ip[username]</a><else />$ip[username]</if> - <a href="$url?op=doipcheck&amp;ipaddress=$ip[ip]">$ip[ip]</a> ($hostname)";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056267301";}s:9:"add_forum";a:4:{s:8:"category";s:17:"Admin CP - Forums";s:4:"body";s:2561:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="forums.php"><b>Forums</b></a> <b>&gt; Add Forum</b>
<br />
<br />
<form action="forums.php" method="post">
<div><input name="op" type="hidden" value="doadd" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Forum</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><textarea class="small" rows="5" cols="70" name="description"></textarea></td>
</tr>
<tr>
<td><b>Link:</b><br />
<span class="small">If you would like this forum to act as a link to another URL, enter that URL here.</span></td>
<td><input size="60" name="link" type="text" /></td>
</tr>
<tr>
<td><b>Parent forum:</b></td>
<td><select name="parentid" class="small"><option value="0"<if !$parentid> selected="selected"</if>>(No Parent)</option>$forum_choices</select></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">Enter a <b>0</b> (zero) to hide the forum. This will not stop people from browsing through the forum if they find it, however.</span></td>
<td><input size="6" name="ordered" type="text" /></td>
</tr>
<tr>
<td><b>Allow posting:</b></td>
<td>Yes:<input name="allow_posting" type="radio" value="1" checked="checked" /> No:<input name="allow_posting" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Allow DP Code:</b></td>
<td>Yes:<input name="dpcode" type="radio" value="1" checked="checked" /> No:<input name="dpcode" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Allow image tags:</b></td>
<td>Yes:<input name="img" type="radio" value="1" checked="checked" /> No:<input name="img" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Allow smilies:</b></td>
<td>Yes:<input name="smilies" type="radio" value="1" checked="checked" /> No:<input name="smilies" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Count posts:</b><br />
<span class="small">Enabling this option will cause a user's post count to increment when they make a post in this forum.</span></td>
<td>Yes:<input name="countposts" type="radio" value="1" checked="checked" /> No:<input name="countposts" type="radio" value="0" /></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Add Forum" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1090137844";}s:8:"add_rule";a:4:{s:8:"category";s:24:"Admin CP - Group Changer";s:4:"body";s:3073:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="groupchanger.php"><b>Group Changer</b></a> <b>&gt; Add Rule</b><br />
<br />
<form action="groupchanger.php" method="post">
<div><input name="op" type="hidden" value="doadd" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="3">Add New Rule</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td colspan="2"><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>When user has been a member for at least this many days:</b></td>
<td colspan="2"><input size="60" name="days" type="text" value="0" /></td>
</tr>
<tr>
<td><select name="and_or"><option value="and">And</option><option value="or">Or</option></select> <b>post count:</b></td>
<td colspan="2"><select name="post_condition"><option value="reaches">Reaches</option><option value="drops">Drops below</option></select> <input size="27" name="posts" type="text" value="0" /></td>
</tr>
<tr id="ingroups" valign="top">
<td style="white-space: nowrap"><b>And user is in one of the following groups:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('ingroups'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('ingroups'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
<td class="small" style="white-space: nowrap">$ingroups_col1</td><td class="small" style="white-space: nowrap">$ingroups_col2</td>
</tr>
<tr>
<td><b>Move user to primary group:</b></td>
<td><select name="groupid"><option value="0">Don't change primary group</option>$primary_groups</select></td><td class="small"><input name="dont_remove" type="checkbox" value="1" /> Leave user in group</td>
</tr>
<tr id="addgroups" valign="top">
<td><b>Add user to these groups:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('addgroups'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('addgroups'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
<td class="small" style="white-space: nowrap">$addgroups_col1</td><td class="small" style="white-space: nowrap">$addgroups_col2</td>
</tr>
<tr id="removegroups" valign="top">
<td><b>Remove user from these groups:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('removegroups'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('removegroups'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
<td class="small" style="white-space: nowrap">$removegroups_col1</td><td class="small" style="white-space: nowrap">$removegroups_col2</td>
</tr>
<tr>
<td class="center" colspan="3"><input type="submit" value="Add Rule" /></td>
</tr>
<include template="form_footer" />
</table></form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073368733";}s:9:"add_group";a:4:{s:8:"category";s:17:"Admin CP - Groups";s:4:"body";s:9875:"<include template="header" />
<form action="groups.php" method="post">
<div><input name="op" type="hidden" value="doadd" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="groups.php"><b>Groups</b></a> <b>&gt; Add Group</b>
<br />
<br /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="2">Add New Group</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Administrative Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('adminperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('adminperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table width="100%">
<include template="form_header" />
<tr id="adminperm" valign="top">
<td class="small" style="width: 33%"><input name="adminlog" type="checkbox" value="1" /> Admin Log<br />
<input name="articles" type="checkbox" value="1" /> Articles<br />
<input name="configuration" type="checkbox" value="1" /> Configuration<br />
<input name="customfields" type="checkbox" value="1" /> Custom Profile Fields<br />
<input name="downloads" type="checkbox" value="1" /> Downloads<br />
<input name="dpcode" type="checkbox" value="1" /> DP Code<br />
<input name="faq" type="checkbox" value="1" /> FAQ Manager<br />
<input name="forumperm" type="checkbox" value="1" /> Forum Permissions</td>
<td class="small" style="width: 33%"><input name="forums" type="checkbox" value="1" /> Forums<br />
<input name="groupchanger" type="checkbox" value="1" /> Group Changer<br />
<input name="admin_groups" type="checkbox" value="1" /> Groups<br />
<input name="icons" type="checkbox" value="1" /> Icons<br />
<input name="links" type="checkbox" value="1" /> Links<br />
<input name="maintenance" type="checkbox" value="1" /> Maintenance<br />
<input name="moderators" type="checkbox" value="1" /> Moderators<br />
<input name="sections" type="checkbox" value="1" /> Sections</td>
<td class="small" style="width: 33%"><input name="smilies" type="checkbox" value="1" /> Smilies<br />
<input name="tasks" type="checkbox" value="1" /> Scheduled Tasks<br />
<input name="stylesets" type="checkbox" value="1" /> Style Sets<br />
<input name="styles" type="checkbox" value="1" /> Styles<br />
<input name="templates" type="checkbox" value="1" /> Templates<br />
<input name="titles" type="checkbox" value="1" /> Titles<br />
<input name="topics" type="checkbox" value="1" /> Topics<br />
<input name="users" type="checkbox" value="1" /> Users</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Super Moderator Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('supermodperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('supermodperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table width="100%">
<include template="form_header" />
<tr id="supermodperm" valign="top">
<td class="small" style="width: 33%"><input name="supermod_banusers" type="checkbox" value="1" /> Ban users<br />
<input name="supermod_close" type="checkbox" value="1" /> Close threads<br />
<input name="supermod_copymove" type="checkbox" value="1" /> Copy/move threads<br />
<input name="supermod_deleteposts" type="checkbox" value="1" /> Delete posts<br />
<input name="supermod_deletethreads" type="checkbox" value="1" /> Delete threads<br />
<input name="supermod_editpolls" type="checkbox" value="1" /> Edit polls</td>
<td class="small" style="width: 33%"><input name="supermod_editposts" type="checkbox" value="1" /> Edit posts<br />
<input name="supermod_editthreads" type="checkbox" value="1" /> Edit threads<br />
<input name="supermod_exemptfloodcheck" type="checkbox" value="1" /> Exempt from flood check<br />
<input name="supermod_massdelete" type="checkbox" value="1" /> Mass delete threads<br />
<input name="supermod_massmove" type="checkbox" value="1" /> Mass move threads</td>
<td class="small" style="width: 33%"><input name="supermod_announcements" type="checkbox" value="1" /> Post announcements<br />
<input name="supermod_sticky" type="checkbox" value="1" /> Stick threads<br />
<input name="supermod_viewfullprofiles" type="checkbox" value="1" /> View full user profiles<br />
<input name="supermod_viewips" type="checkbox" value="1" /> View IP addresses<br />
<input name="supermod_log" type="checkbox" value="1" /> View moderator log</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">User Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('userperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('userperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table width="100%">
<include template="form_header" />
<tr id="userperm" valign="top">
<td class="small" style="width: 33%"><input name="close" type="checkbox" value="1" /> Close threads<br />
<input name="copymove" type="checkbox" value="1" /> Copy/move threads<br />
<input name="deleteposts" type="checkbox" value="1" /> Delete posts<br />
<input name="deletethreads" type="checkbox" value="1" /> Delete threads<br />
<input name="editposts" type="checkbox" value="1" /> Edit posts</td>
<td class="small" style="width: 33%"><input name="editthreads" type="checkbox" value="1" /> Edit threads<br />
<input name="postattachments" type="checkbox" value="1" /> Post attachments<br />
<input name="postthreads" type="checkbox" value="1" /> Post threads<br />
<input name="replytoother" type="checkbox" value="1" /> Reply to others' threads<br />
<input name="replytoown" type="checkbox" value="1" /> Reply to own threads</td>
<td class="small" style="width: 33%"><input name="startpolls" type="checkbox" value="1" /> Start polls<br />
<input name="viewattachments" type="checkbox" value="1" /> View attachments<br />
<input name="viewforums" type="checkbox" value="1" /> View forums<br />
<input name="viewthreads" type="checkbox" value="1" /> View threads<br />
<input name="votepolls" type="checkbox" value="1" /> Vote on polls</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Other&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('otherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('otherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table width="100%">
<include template="form_header" />
<tr id="otherperm" valign="top">
<td class="small" style="width: 33%"><input name="customtitle" type="checkbox" value="1" /> Can choose a custom title<br />
<input name="customsignature" type="checkbox" value="1" /> Can have a signature<br />
<input name="customavatar" type="checkbox" value="1" /> Can upload an avatar<br />
<input name="html" type="checkbox" value="1" /> Can use HTML<br />
<input name="edit_profile" type="checkbox" value="1" /> Edit profile</td>
<td class="small" style="width: 33%"><input name="exempt_titlecensor" type="checkbox" value="1" /> Exempt from title censoring<br />
<input name="ignorelist" type="checkbox" value="1" /> Exempt from ignore list<br />
<input name="show_editedby" type="checkbox" value="1" /> Exempt from "Edited by" message<br />
<input name="privatemessaging" type="checkbox" value="1" /> Use private messaging</td>
<td class="small" style="width: 33%"><input name="search" type="checkbox" value="1" /> Use search<br />
<input name="whos_online" type="checkbox" value="1" /> View full Who's Online<br />
<input name="view_memberlist" type="checkbox" value="1" /> View member list<br />
<input name="view_profile" type="checkbox" value="1" /> View user profiles</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td class="heading" colspan="2">Other Settings</td>
</tr>
<tr>
<td><b>Lock post count:</b></td>
<td>Yes:<input name="lockpostcount" type="radio" value="1" /> No:<input name="lockpostcount" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Username style (large):</b></td>
<td><input name="online_template_large" type="text" size="60" value="\$user_result[name]" /></td>
</tr>
<tr>
<td><b>Username style (small):</b></td>
<td><input name="online_template" type="text" size="60" value="\$user_result[name]" /></td>
</tr>
<tr>
<td><b>Maximum number of recipients of a PM:</b><br />
<span class="small">Maximum number of people a user can send a private message to at one time.</span></td>
<td><input name="max_recipients" type="text" size="60" value="5" /></td>
</tr>
<tr>
<td><b>Maximum number of saved PM's:</b><br />
<span class="small">Maximum number of private messages a user can store before "filling" their message box. Enter a <b>0</b> (zero) to disable this limit.</span></td>
<td><input name="maxpm" type="text" size="60" value="50" /></td>
</tr>
<tr>
<td><b>Display order:</b><br />
<span class="small">This is the order in which this group will be displayed on the <b>Site/Forum Leaders</b> page. Set this to <b>0</b> (zero) if you would not like for this group to be displayed on that page.</span></td>
<td><input name="ordered" type="text" size="5" value="0" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Group" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073370377";}s:16:"faqmanager_index";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:689:"<include template="header" />
<script type="text/javascript" src="tree.js"></script>
<script type="text/javascript" src="tree_tpl.js"></script>
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; FAQ Manager</b>
<br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><div class="center">[<a href="faqmgr.php?op=addfaq">Add New FAQ</a>]</div><br />
<if $faqs><script type="text/javascript">
<!--
var TREE_ITEMS = [$faqs];
new tree (TREE_ITEMS, tree_tpl);
//-->
</script></if>
</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073363965";}s:15:"faqmanager_item";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:302:"<if $items>,</if>['<i>$item[name]</i> <span class="small">[</span><a class="linksmall" href="faqmgr.php?op=edititem&amp;id=$item[faqitemid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="faqmgr.php?op=deleteitem&amp;id=$item[faqitemid]">Delete</a><span class="small">]</span>', null]";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055833228";}s:19:"faqmanager_category";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:476:"<if $categories>,</if>['$category[name] <span class="small">[</span><a class="linksmall" href="faqmgr.php?op=additem&amp;id=$category[faqcategoryid]">Add Item</a> <span class="small">-</span> <a class="linksmall" href="faqmgr.php?op=editcategory&amp;id=$category[faqcategoryid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="faqmgr.php?op=deletecategory&amp;id=$category[faqcategoryid]">Delete</a><span class="small">]</span>', null<if $items>, $items</if>]";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055832835";}s:14:"faqmanager_faq";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:438:"<if $faqs>,</if>['<b>$faq[name]</b> ($faq[shortname]) <span class="small">[</span><a class="linksmall" href="faqmgr.php?op=addcategory&amp;id=$faq[faqid]">Add Category</a> <span class="small">-</span> <a class="linksmall" href="faqmgr.php?op=editfaq&amp;id=$faq[faqid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="faqmgr.php?op=deletefaq&amp;id=$faq[faqid]">Delete</a><span class="small">]</span>', null, $categories]";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055825508";}s:7:"add_faq";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:1343:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="faqmgr.php"><b>FAQ Manager</b></a> <b>&gt; Add FAQ</b>
<br />
<br />
<form action="faqmgr.php" method="post">
<div><input name="op" type="hidden" value="doaddfaq" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New FAQ</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input name="name" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Short name:</b><br />
<span class="small">This is the name used to identify the FAQ, when displaying it with faq.php. <b>Please use letters, numbers, and underscores only.</b></span></td>
<td><input name="shortname" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Use tree display:</b><br />
<span class="small">This will cause the FAQ to use a branching tree to separate various categories and items.</span></td>
<td>Yes:<input name="tree" type="radio" value="1" /> No:<input name="tree" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add FAQ" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073364766";}s:20:"faqmanager_duplicate";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:135:"<include template="message_header" />
A FAQ with the short name <b>$shortname</b> already exists.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055820507";}s:18:"faqmanager_missing";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:126:"<include template="message_header" />
Please enter a name and a short name for this FAQ.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055820587";}s:11:"invalid_faq";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:109:"<include template="message_header" />
The specified FAQ does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055869056";}s:8:"edit_faq";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:1514:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="faqmgr.php"><b>FAQ Manager</b></a> <b>&gt; Edit FAQ</b>
<br />
<br />
<form action="faqmgr.php" method="post">
<div><input name="op" type="hidden" value="doeditfaq" />
<input name="id" type="hidden" value="$faq[faqid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit FAQ - $faq[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input name="name" type="text" size="60" value="$faq[name]" /></td>
</tr>
<tr>
<td><b>Short name:</b><br />
<span class="small">This is the name used to identify the FAQ, when displaying it with faq.php. <b>Please use letters, numbers, and underscores only.</b></span></td>
<td><input name="shortname" type="text" size="60" value="$faq[shortname]" /></td>
</tr>
<tr>
<td><b>Use tree display:</b><br />
<span class="small">This will cause the FAQ to use a branching tree to separate various categories and items.</span></td>
<td>Yes:<input name="tree" type="radio" value="1"<if $faq[tree]> checked="checked"</if> /> No:<input name="tree" type="radio" value="0"<if !$faq[tree]> checked="checked"</if> /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update FAQ" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073364900";}s:10:"delete_faq";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:440:"<include template="message_header" />
Are you sure you want to delete <b>$faq[name]</b>?<br />
<br />
<br />
<form action="faqmgr.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodeletefaq" />
<input name="id" type="hidden" value="$faq[faqid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='faqmgr.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073364921";}s:16:"add_faq_category";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:1010:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="faqmgr.php"><b>FAQ Manager</b></a> <b>&gt; Add Category</b>
<br />
<br />
<form action="faqmgr.php" method="post">
<div><input name="op" type="hidden" value="doaddcategory" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Category</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input name="name" type="text" size="60" /></td>
</tr>
<tr>
<td><b>FAQ:</b></td>
<td><select name="faqid">$faqs</select></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>Display order:</b></td>
<td><input name="ordered" type="text" size="10" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Category" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073364796";}s:10:"faq_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:86:"<option value="$faq[faqid]"<if $selected> selected="selected"</if>>$faq[name]</option>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055824512";}s:27:"faqmanager_missing_category";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:114:"<include template="message_header" />
Please enter a name for this category.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055824745";}s:17:"edit_faq_category";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:1148:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="faqmgr.php"><b>FAQ Manager</b></a> <b>&gt; Edit Category</b>
<br />
<br />
<form action="faqmgr.php" method="post">
<div><input name="op" type="hidden" value="doeditcategory" />
<input name="id" type="hidden" value="$category[faqcategoryid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Category - $category[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input name="name" type="text" size="60" value="$category[name]" /></td>
</tr>
<tr>
<td><b>FAQ:</b></td>
<td><select name="faqid">$faqs</select></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>Display order:</b></td>
<td><input name="ordered" type="text" size="10" value="$category[ordered]" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Category" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073364970";}s:20:"invalid_faq_category";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:118:"<include template="message_header" />
The specified FAQ category does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055827823";}s:19:"delete_faq_category";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:463:"<include template="message_header" />
Are you sure you want to delete <b>$category[name]</b>?<br />
<br />
<br />
<form action="faqmgr.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodeletecategory" />
<input name="id" type="hidden" value="$category[faqcategoryid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='faqmgr.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073364994";}s:12:"add_faq_item";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:1219:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="faqmgr.php"><b>FAQ Manager</b></a> <b>&gt; Add Item</b>
<br />
<br />
<form action="faqmgr.php" method="post">
<div><input name="op" type="hidden" value="doadditem" />
<input name="id" type="hidden" value="$id" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Item</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input name="name" type="text" size="60" /></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>Display order:</b></td>
<td><input name="ordered" type="text" size="10" /></td>
</tr>
<tr>
<td><b>Content:</b><br />
<span class="small">You may use HTML, or any other special tags that can be used in templates, such as <b>&lt;if&gt;</b>.</span></td>
<td><textarea name="content" cols="70" style="width: 99%" rows="15"></textarea></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Add Item" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073364837";}s:16:"invalid_faq_item";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:114:"<include template="message_header" />
The specified FAQ item does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055833543";}s:23:"faqmanager_missing_item";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:122:"<include template="message_header" />
Please enter a name and content for this item.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055833585";}s:13:"edit_faq_item";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:1305:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="faqmgr.php"><b>FAQ Manager</b></a> <b>&gt; Edit Item</b>
<br />
<br />
<form action="faqmgr.php" method="post">
<div><input name="op" type="hidden" value="doedititem" />
<input name="id" type="hidden" value="$item[faqitemid]" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Item - $item[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input name="name" type="text" size="60" value="$item[name]" /></td>
</tr>
<tr>
<td style="white-space: nowrap"><b>Display order:</b></td>
<td><input name="ordered" type="text" size="10" value="$item[ordered]" /></td>
</tr>
<tr>
<td><b>Content:</b><br />
<span class="small">You may use HTML, or any other special tags that can be used in templates, such as <b>&lt;if&gt;</b>.</span></td>
<td><textarea name="content" cols="70" style="width: 99%" rows="15">$item[content]</textarea></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Item" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073365064";}s:15:"delete_faq_item";a:4:{s:8:"category";s:22:"Admin CP - FAQ Manager";s:4:"body";s:447:"<include template="message_header" />
Are you sure you want to delete <b>$item[name]</b>?<br />
<br />
<br />
<form action="faqmgr.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodeleteitem" />
<input name="id" type="hidden" value="$item[faqitemid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='faqmgr.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073365039";}s:11:"tasks_index";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:3870:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt; Scheduled Tasks</b>
<br />
<br />
<form action="tasks.php" method="post">
<div><input name="op" type="hidden" value="add" /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><div class="center">[<a href="tasks.php?op=log">View Log</a>]</div><br />
$tasks</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Scheduled Task</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><textarea name="description" cols="60" rows="3" class="small"></textarea></td>
</tr>
<tr>
<td><b>Path to script:</b><br />
<span class="small">This must point to a PHP script. You may use an absolute path (starting with a <b>/</b>), or a path relative to the root Deluxe Portal directory.</span></td>
<td><input size="60" name="script" type="text" /></td>
</tr>
<tr>
<td><b>Enabled:</b><br />
<span class="small">If you disable this task, it will not run.</span></td>
<td>Yes:<input name="enabled" type="radio" value="1" checked="checked" /> No:<input name="enabled" value="0" type="radio" /></td>
</tr>
<tr>
<td><b>Run if late:</b><br />
<span class="small">Because of the inherent limitations of PHP, tasks cannot always be run at precisely the correct time. This is especially true if your site has few visitors. If you want to ensure that your script is run, even if it may mean running it a bit late, enable this option.</span></td>
<td>Yes:<input value="1" name="late" type="radio" checked="checked" /> No:<input name="late" value="0" type="radio" /></td>
</tr>
<tr>
<td><b>Log task:</b><br />
<span class="small">This will allow you to keep track of when the task is run, as well as any additional information the task may log.</span></td>
<td>Yes:<input name="log" type="radio" value="1" checked="checked" /> No:<input name="log" value="0" type="radio" /></td>
</tr>
<tr>
<td><b>Only run if server load is below:</b><br />
<span class="small">If the server load rises above the specified value, the task will not run, and will instead be rescheduled. Enter <b>0</b> (zero) to disable this. This feature only works on UNIX/Linux based systems.</span></td>
<td><input name="max_load" type="text" value="0" size="10" /></td>
</tr>
<tr>
<td><b>Minute:</b><br />
<span class="small">Valid entries are <b>0</b>-<b>59</b>, or <b>Any</b>.</span></td>
<td><input name="minute" type="text" value="Any" size="5" /></td>
</tr>
<tr>
<td><b>Hour:</b><br />
<span class="small">Valid entries are <b>0</b>-<b>23</b>, or <b>Any</b>.</span></td>
<td><input name="hour" type="text" value="Any" size="5" /></td>
</tr>
<tr>
<td><b>Day of week:</b><br />
<span class="small">This overrides the <b>day of month</b> setting.</span></td>
<td><select name="dayofweek"><option value="-1">Any Day</option>
<option value="0">Sunday</option>
<option value="1">Monday</option>
<option value="2">Tuesday</option>
<option value="3">Wednesday</option>
<option value="4">Thursday</option>
<option value="5">Friday</option>
<option value="6">Saturday</option></select></td>
</tr>
<tr>
<td><b>Day of month:</b><br />
<span class="small">Valid entries are <b>1</b>-<b>31</b>, or <b>Any</b>.</span></td>
<td><input name="day" type="text" value="Any" size="5" /></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Scheduled Task" /></div></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073437725";}s:10:"tasks_task";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:389:"<if $tasks><br />
</if><b>$task[name]</b> <span class="small">[</span><a class="linksmall" href="tasks.php?op=edit&amp;id=$task[taskid]">Edit</a> <span class="small">-</span> <a class="linksmall" href="tasks.php?op=delete&amp;id=$task[taskid]">Delete</a> <span class="small">-</span> <a class="linksmall" href="tasks.php?op=run&amp;id=$task[taskid]">Run Now</a><span class="small">]</span>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056141437";}s:13:"tasks_missing";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:146:"<include template="message_header" />
Please enter a name, script, and scheduling information for this task.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055992423";}s:15:"tasks_duplicate";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:153:"<include template="message_header" />
A task with the name <b>$name</b> already exists. Please choose another name.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056006124";}s:11:"tasks_range";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:202:"<include template="message_header" />
One of the values you entered is out of range. Please make sure that the hour, minute, and day of month are all set correctly.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1059087818";}s:9:"edit_task";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:4990:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="tasks.php"><b>Scheduled Tasks</b></a> <b>&gt; Edit Task</b><br />
<br />
<form action="tasks.php" method="post">
<div><input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$task[taskid]" /></div>
<table cellspacing="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><div class="center">[<a href="tasks.php">Add New Task</a>]<br />
[<a href="tasks.php?op=log">View Log</a>]</div><br />
$tasks</td>
</tr>
</table></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Edit Scheduled Task - $task[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" value="$task[name]" /></td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><textarea name="description" cols="60" rows="3" class="small">$task[description]</textarea></td>
</tr>
<tr>
<td><b>Path to script:</b><br />
<span class="small">This must point to a PHP script. You may use an absolute path (starting with a <b>/</b>), or a path relative to the root Deluxe Portal directory.</span></td>
<td><input size="60" name="script" type="text" value="$task[script]" /></td>
</tr>
<tr>
<td><b>Enabled:</b><br />
<span class="small">If you disable this task, it will not run.</span></td>
<td>Yes:<input name="enabled" type="radio" value="1"<if $task[enabled]> checked="checked"</if> /> No:<input name="enabled" value="0" type="radio"<if !$task[enabled]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Run if late:</b><br />
<span class="small">Because of the inherent limitations of PHP, tasks cannot always be run at precisely the correct time. This is especially true if your site has few visitors. If you want to ensure that your script is run, even if it may mean running it a bit late, enable this option.</span></td>
<td>Yes:<input value="1" name="late" type="radio"<if $task[late]> checked="checked"</if> /> No:<input name="late" value="0" type="radio"<if !$task[late]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Log task:</b><br />
<span class="small">This will allow you to keep track of when the task is run, as well as any additional information the task may log.</span></td>
<td>Yes:<input name="log" type="radio" value="1"<if $task[log]> checked="checked"</if> /> No:<input name="log" value="0" type="radio"<if !$task[log]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Only run if server load is below:</b><br />
<span class="small">If the server load rises above the specified value, the task will not run, and will instead be rescheduled. Enter <b>0</b> (zero) to disable this. This feature only works on UNIX/Linux based systems.</span></td>
<td><input name="max_load" type="text" value="$task[max_load]" size="10" /></td>
</tr>
<tr>
<td><b>Minute:</b><br />
<span class="small">Valid entries are <b>0</b>-<b>59</b>, or <b>Any</b>.</span></td>
<td><input name="minute" type="text" value="<if $task[minute]==-1>Any<else />$task[minute]</if>" size="5" /></td>
</tr>
<tr>
<td><b>Hour:</b><br />
<span class="small">Valid entries are <b>0</b>-<b>23</b>, or <b>Any</b>.</span></td>
<td><input name="hour" type="text" value="<if $task[hour]==-1>Any<else />$task[hour]</if>" size="5" /></td>
</tr>
<tr>
<td><b>Day of week:</b><br />
<span class="small">This overrides the <b>day of month</b> setting.</span></td>
<td><select name="dayofweek"><option value="-1"<if $task[dayofweek]==-1> selected="selected"</if>>Any Day</option>
<option value="0"<if !$task[dayofweek]> selected="selected"</if>>Sunday</option>
<option value="1"<if $task[dayofweek]==1> selected="selected"</if>>Monday</option>
<option value="2"<if $task[dayofweek]==2> selected="selected"</if>>Tuesday</option>
<option value="3"<if $task[dayofweek]==3> selected="selected"</if>>Wednesday</option>
<option value="4"<if $task[dayofweek]==4> selected="selected"</if>>Thursday</option>
<option value="5"<if $task[dayofweek]==5> selected="selected"</if>>Friday</option>
<option value="6"<if $task[dayofweek]==6> selected="selected"</if>>Saturday</option></select></td>
</tr>
<tr>
<td><b>Day of month:</b><br />
<span class="small">Valid entries are <b>1</b>-<b>31</b>, or <b>Any</b>.</span></td>
<td><input name="day" type="text" value="<if $task[day]==-1>Any<else />$task[day]</if>" size="5" /></td>
</tr>
<tr>
<td colspan="2">This task is currently scheduled to next run at $task[nextrun] (local time).</td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Update Scheduled Task" /> <input name="run_now" type="submit" value="Run Now" /></div></td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073438975";}s:12:"invalid_task";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:120:"<include template="message_header" />
The specified scheduled task does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056009841";}s:11:"delete_task";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:438:"<include template="message_header" />
Are you sure you want to delete <b>$task[name]</b>?<br />
<br />
<br />
<form action="tasks.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$task[taskid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='tasks.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073439014";}s:14:"tasks_show_log";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:773:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="tasks.php"><b>Scheduled Tasks</b></a> <b>&gt; Log</b><br />
<br />
<table width="100%">
<tr>
<td>$tasklog_pagenav</td><td class="right">[<a href="tasks.php?op=prunelog">Remove Log Entries</a>]</td>
</tr>
</table><br />
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader"><span class="small">Task</span></td><td class="tableheader"><span class="small">Action</span></td><td class="tableheader"><span class="small">Date</span></td>
</tr>
$logs
</table><br />
$tasklog_pagenav<br />
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073354257";}s:9:"tasks_log";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:186:"<tr>
<td class="$color" style="white-space: nowrap">$tasklog[name]</td><td class="$color">$tasklog[action]</td><td class="$color" style="white-space: nowrap">$tasklog[logdate]</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073439434";}s:14:"prune_task_log";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:413:"<include template="message_header" />
Are you sure you want to remove all entries from the Scheduled Tasks log?<br />
<br />
<br />
<form action="tasks.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doprunelog" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='tasks.php?op=log'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073439874";}s:11:"mass_number";a:4:{s:8:"category";s:8:"Messages";s:4:"body";s:106:"<include template="message_header" />
You must input a valid number.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056130435";}s:8:"run_task";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:445:"<include template="message_header" />
Are you sure you want to run the task <b>$task[name]</b> now?<br />
<br />
<br />
<form action="tasks.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dorun" />
<input name="id" type="hidden" value="$task[taskid]" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='tasks.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073439050";}s:17:"run_task_redirect";a:4:{s:8:"category";s:26:"Admin CP - Scheduled Tasks";s:4:"body";s:127:"<include template="redirect_header" />
<b>$task[name]</b> is being scheduled to run now.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056141163";}s:21:"add_download_category";a:4:{s:8:"category";s:20:"Admin CP - Downloads";s:4:"body";s:2049:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="downloads.php"><b>Downloads</b></a> <b>&gt; Add Download Category</b><br />
<br />
<form enctype="multipart/form-data" action="downloads.php" method="post">
<div>
<input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doaddcategory" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Download Category</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td><input name="transfer" type="radio" value="upload" checked="checked" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Viewing/Downloading Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('download'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('download'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="download" valign="top">
<td class="small" style="white-space: nowrap">$groups_col1</td><td class="small" style="white-space: nowrap">$groups_col2</td><td class="small" style="white-space: nowrap">$groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Download Category" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073365291";}s:17:"add_link_category";a:4:{s:8:"category";s:16:"Admin CP - Links";s:4:"body";s:2020:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="links.php"><b>Links</b></a> <b>&gt; Add Link Category</b><br />
<br />
<form enctype="multipart/form-data" action="links.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doaddcategory" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Link Category</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td><input name="transfer" type="radio" value="upload" checked="checked" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Viewing/Linking Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('viewperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('viewperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="viewperm" valign="top">
<td class="small" style="white-space: nowrap">$groups_col1</td><td class="small" style="white-space: nowrap">$groups_col2</td><td class="small" style="white-space: nowrap">$groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Link Category" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073372187";}s:12:"sections_row";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:39:"<tr valign="bottom">
$section_col
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058010987";}s:11:"add_section";a:4:{s:8:"category";s:19:"Admin CP - Sections";s:4:"body";s:5814:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="sections.php"><b>Sections</b></a> <b>&gt; Add Section</b><br />
<br />
<form enctype="multipart/form-data" action="sections.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doadd" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Section</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Show in sidebar:</b></td>
<td>Yes:<input name="sidebar" type="radio" value="1" checked="checked" /> No:<input name="sidebar" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td><input name="transfer" type="radio" value="upload" checked="checked" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Viewing Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('viewperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('viewperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="viewperm" valign="top">
<td class="small" style="white-space: nowrap">$view_groups_col1</td><td class="small" style="white-space: nowrap">$view_groups_col2</td><td class="small" style="white-space: nowrap">$view_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Posting Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('postperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('postperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="postperm" valign="top">
<td class="small" style="white-space: nowrap">$post_groups_col1</td><td class="small" style="white-space: nowrap">$post_groups_col2</td><td class="small" style="white-space: nowrap">$post_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Edit Own Article Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('editownperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('editownperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="editownperm" valign="top">
<td class="small" style="white-space: nowrap">$editown_groups_col1</td><td class="small" style="white-space: nowrap">$editown_groups_col2</td><td class="small" style="white-space: nowrap">$editown_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Edit Others' Articles Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('editotherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('editotherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="editotherperm" valign="top">
<td class="small" style="white-space: nowrap">$editothers_groups_col1</td><td class="small" style="white-space: nowrap">$editothers_groups_col2</td><td class="small" style="white-space: nowrap">$editothers_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Delete Own Article Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('deleteownperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('deleteownperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="deleteownperm" valign="top">
<td class="small" style="white-space: nowrap">$deleteown_groups_col1</td><td class="small" style="white-space: nowrap">$deleteown_groups_col2</td><td class="small" style="white-space: nowrap">$deleteown_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Delete Others' Articles Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('deleteotherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('deleteotherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="deleteotherperm" valign="top">
<td class="small" style="white-space: nowrap">$deleteothers_groups_col1</td><td class="small" style="white-space: nowrap">$deleteothers_groups_col2</td><td class="small" style="white-space: nowrap">$deleteothers_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Add Section" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1144686658";}s:10:"topics_row";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:37:"<tr valign="bottom">
$topic_col
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058015543";}s:9:"add_topic";a:4:{s:8:"category";s:17:"Admin CP - Topics";s:4:"body";s:5967:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="index.php"><b>Administrator Control Panel</b></a> <b>&gt;</b> <a href="topics.php"><b>Topics</b></a> <b>&gt; Add Topic</b><br />
<br />
<form enctype="multipart/form-data" action="topics.php" method="post">
<div><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doadd" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Add New Topic</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>Also post articles into forum:</b><br />
<span class="small">If this option is set, all articles placed into this topic will be posted in the specified forum.</span></td>
<td><select name="forumid"><option value="0" selected="selected">No Forum</option>$forum_choices</select></td>
</tr>
<tr>
<td><b>Image:</b></td>
<td style="white-space: nowrap"><input name="transfer" type="radio" value="upload" checked="checked" /> <span class="small">Upload an image:</span> <input class="small" name="image" type="file" size="34" /><br />
<input name="transfer" type="radio" value="location" /> <span class="small">Specify an existing image:</span> <input class="small" name="image_location" type="text" size="38" value="http://" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Viewing Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('viewperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('viewperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="viewperm" valign="top">
<td class="small" style="white-space: nowrap">$view_groups_col1</td><td class="small" style="white-space: nowrap">$view_groups_col2</td><td class="small" style="white-space: nowrap">$view_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Posting Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('postperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('postperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="postperm" valign="top">
<td class="small" style="white-space: nowrap">$post_groups_col1</td><td class="small" style="white-space: nowrap">$post_groups_col2</td><td class="small" style="white-space: nowrap">$post_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Edit Own Article Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('editownperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('editownperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="editownperm" valign="top">
<td class="small" style="white-space: nowrap">$editown_groups_col1</td><td class="small" style="white-space: nowrap">$editown_groups_col2</td><td class="small" style="white-space: nowrap">$editown_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Edit Others' Articles Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('editotherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('editotherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="editotherperm" valign="top">
<td class="small" style="white-space: nowrap">$editothers_groups_col1</td><td class="small" style="white-space: nowrap">$editothers_groups_col2</td><td class="small" style="white-space: nowrap">$editothers_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Delete Own Article Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('deleteownperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('deleteownperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="deleteownperm" valign="top">
<td class="small" style="white-space: nowrap">$deleteown_groups_col1</td><td class="small" style="white-space: nowrap">$deleteown_groups_col2</td><td class="small" style="white-space: nowrap">$deleteown_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2" class="heading">Delete Others' Articles Permissions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:check_all(getElement('deleteotherperm'))"><img alt="Check All" src="$style[images]/check.gif" /></a> <a href="javascript:uncheck_all(getElement('deleteotherperm'))"><img alt="Uncheck All" src="$style[images]/uncheck.gif" /></a></td>
</tr>
<tr>
<td colspan="2"><table>
<include template="form_header" />
<tr id="deleteotherperm" valign="top">
<td class="small" style="white-space: nowrap">$deleteothers_groups_col1</td><td class="small" style="white-space: nowrap">$deleteothers_groups_col2</td><td class="small" style="white-space: nowrap">$deleteothers_groups_col3</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
<tr>
<td colspan="2"><div class="center"><input type="submit" value="Add Topic" /></div></td>
</tr>
<include template="form_footer" />
</table>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073712145";}s:22:"maintenance_signatures";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:284:"<include template="redirect_header" />
Signature reparsing 
<if $i==$cycle>
is continuing... (last user was <b>$lastid</b>)
<else />
has completed (last user was <b>$lastid</b>). You are now being returned to the maintenance control panel.
</if>
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058250291";}s:17:"maintenance_posts";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:285:"<include template="redirect_header" />
Post cache reparsing 
<if $i==$cycle>
is continuing... (last post was <b>$lastid</b>)
<else />
has completed (last post was <b>$lastid</b>). You are now being returned to the maintenance control panel.
</if>
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058315657";}s:26:"maintenance_posts_disabled";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:111:"<include template="redirect_header" />
You have disabled the post cache.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058315698";}s:18:"maintenance_forums";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:284:"<include template="redirect_header" />
Forum maintenance 
<if $i==$cycle>
is continuing... (last forum was <b>$lastid</b>)
<else />
has completed (last forum was <b>$lastid</b>). You are now being returned to the maintenance control panel.
</if>
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058676368";}s:15:"styles_category";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:13828:"<tbody id="cat$cat[selectorid]"<if $not_first> class="displayNone"</if>>
<tr>
<td class="heading" colspan="2">$cat[name]</td>
</tr>
<tr>
<td colspan="2">
<fieldset><legend>Font</legend>
<table cellspacing="0" cellpadding="3" border="0">
<tr>
	<td class="small"><b>Family:</b></td>
	<td><input name="category$cat[selectorid][fontfamily]" type="text" size="66" value="$cat[fontfamily]" /></td>
</tr>
<tr>
	<td class="small"><b>Size:</b></td>
	<td class="small">
		<input name="category$cat[selectorid][fontsize]" type="text" size="20" value="$cat[fontsize]" />
		<b>Letter-Spacing:</b>
		<input name="category$cat[selectorid][letterspacing]" type="text" size="20" value="$cat[letterspacing]" />
	</td>
</tr>
<tr>
	<td class="small"><b>Style:</b></td>
	<td>
		<input value="1" type="checkbox" name="category$cat[selectorid][italic]"<if $cat[italic]> checked="checked"</if> /> <i>Italic</i>
		<input value="1" type="checkbox" name="category$cat[selectorid][oblique]"<if $cat[oblique]> checked="checked"</if> /> <span style="font-style:oblique;">Oblique</span>
		<input value="1" type="checkbox" name="category$cat[selectorid][bold]"<if $cat[bold]> checked="checked"</if> /> <b>Bold</b>
	</td>
</tr>
</table>
</fieldset><br />
<fieldset><legend>Text</legend>
<table cellspacing="0" cellpadding="3" border="0">
<tr>
	<td class="small"><b>Transform:</b></td>
	<td>
		<select name="category$cat[selectorid][texttransform]" size="1">
			<option value="">None</option>
			<option value="lowercase"<if $cat[texttransform]=="lowercase"> selected="selected"</if>>Lower-case</option>
			<option value="uppercase"<if $cat[texttransform]=="uppercase"> selected="selected"</if>>Upper-case</option>
			<option value="capitalize"<if $cat[texttransform]=="capitalize"> selected="selected"</if>>Capitalize</option>
		</select>
		<input value="1" type="checkbox" name="category$cat[selectorid][smallcaps]"<if $cat[smallcaps]> checked="checked"</if> /> Small-Caps
	</td>
</tr>
<tr>
	<td class="small"><b>Color:</b></td>
	<td>
		<input name="category$cat[selectorid][color]" type="text" size="20" value="$cat[color]" />
		<script type="text/javascript">
		<!--
			if (document.all && document.getElement && document.body.filters)
				document.write('<a href="javascript:ShowColorPicker(\'category$cat[selectorid][color]\');">Pick Color</span>');
		//-->
		</script>
	</td>
</tr>
<tr>
	<td class="small"><b>Align:</b></td>
	<td class="small">
		<select name="category$cat[selectorid][textalign]" size="1">
			<option value="">(Default)</option>
			<option value="left"<if $cat[textalign]=="left"> selected="selected"</if>>Left</option>
			<option value="center"<if $cat[textalign]=="center"> selected="selected"</if>>Center</option>
			<option value="right"<if $cat[textalign]=="right"> selected="selected"</if>>Right</option>
			<option value="justify"<if $cat[textalign]=="justify"> selected="selected"</if>>Justify</option>
		</select>
		<b>Line-Height:</b>
		<input name="category$cat[selectorid][lineheight]" type="text" size="20" value="$cat[lineheight]" />
	</td>
</tr>
<tr>
	<td class="small"><b>White-space:</b></td>
	<td>
		<input type="radio" value="" name="category$cat[selectorid][whitespace]"<if !$cat[whitespace]> checked="checked"</if> /> (Default)
		<input type="radio" value="nowrap" name="category$cat[selectorid][whitespace]"<if $cat[whitespace]=='nowrap'> checked="checked"</if> /> No-wrap
		<input type="radio" value="pre" name="category$cat[selectorid][whitespace]"<if $cat[whitespace]=='pre'> checked="checked"</if> /> Preserve
	</td>
</tr>
<tr>
	<td class="small"><b>Decoration:</b></td>
	<td>
		<input value="1" type="checkbox" name="category$cat[selectorid][textdecoration_none]"<if $cat[textdecoration_none]> checked="checked"</if> /> None
		<input value="1" type="checkbox" name="category$cat[selectorid][underline]"<if $cat[underline]> checked="checked"</if> /> <span style="text-decoration:underline">Underline</span>
		<input value="1" type="checkbox" name="category$cat[selectorid][overline]"<if $cat[overline]> checked="checked"</if> /> <span style="text-decoration:overline">Overline</span>
		<input value="1" type="checkbox" name="category$cat[selectorid][linethrough]"<if $cat[linethrough]> checked="checked"</if> /> <span style="text-decoration:line-through">Strike Through</span>
	</td>
</tr>
</table>
</fieldset><br />
<fieldset><legend>Background</legend>
<table cellspacing="0" cellpadding="3" border="0">
<tr>
	<td class="small"><b>Color:</b></td>
	<td>
		<input name="category$cat[selectorid][backgroundcolor]" type="text" size="20" value="$cat[backgroundcolor]" />
		<script type="text/javascript">
		<!--
			if (document.all && document.getElement && document.body.filters)
				document.write('<a href="javascript:ShowColorPicker(\'category$cat[selectorid][backgroundcolor]\');">Pick Color</span>');
		//-->
		</script>
	</td>
</tr>
<tr>
	<td class="small"><b>Image:</b></td>
	<td><input name="category$cat[selectorid][backgroundimage]" type="text" size="66" value="$cat[backgroundimage]" /></td>
</tr>
<tr>
	<td class="small"><b>Attachment:</b></td>
	<td class="small">
		<select name="category$cat[selectorid][backgroundattachment]" size="1">
			<option value="">(Default)</option>
			<option value="scroll"<if $cat[backgroundattachment]=="scroll"> selected="selected"</if>>Scroll</option>
			<option value="fixed"<if $cat[backgroundattachment]=="fixed"> selected="selected"</if>>Fixed</option>
		</select>
		<b>Tile:</b>
		<select name="category$cat[selectorid][backgroundrepeat]" size="1">
			<option value="">(Default)</option>
			<option value="repeat"<if $cat[backgroundrepeat]=="repeat"> selected="selected"</if>>Tile</option>
			<option value="no-repeat"<if $cat[backgroundrepeat]=="no-repeat"> selected="selected"</if>>No Tile</option>
			<option value="repeat-x"<if $cat[backgroundrepeat]=="repeat-x"> selected="selected"</if>>Horizontal Tile</option>
			<option value="repeat-y"<if $cat[backgroundrepeat]=="repeat-y"> selected="selected"</if>>Vertical Tile</option>
		</select>
	</td>
</tr>
</table>
</fieldset><br />
<fieldset><legend>Positioning</legend>
<table cellspacing="0" cellpadding="3" border="0">
<tr>
	<td class="small"><b>Position:</b></td>
	<td colspan="3" class="small">
		<select name="category$cat[selectorid][position]">
			<option value="">(Default)</option>
			<option value="absolute"<if $cat[position]=="absolute"> selected="selected"</if>>Absolute</option>
			<option value="relative"<if $cat[position]=="relative"> selected="selected"</if>>Relative</option>
			<option value="static"<if $cat[position]=="static"> selected="selected"</if>>Static</option>
		</select>
		<b>Float:</b>
		<select name="category$cat[selectorid][floatposition]">
			<option value="">(Default)</option>
			<option value="left"<if $cat[floatposition]=="left"> selected="selected"</if>>Left</option>
			<option value="right"<if $cat[floatposition]=="right"> selected="selected"</if>>Right</option>
		</select>
		<b>Clear:</b>
		<select name="category$cat[selectorid][clear]">
			<option value="">(Default)</option>
			<option value="left"<if $cat[clear]=="left"> selected="selected"</if>>Left</option>
			<option value="right"<if $cat[clear]=="right"> selected="selected"</if>>Right</option>
			<option value="both"<if $cat[clear]=="both"> selected="selected"</if>>Both</option>
		</select>
	</td>
</tr>
<tr>
	<td class="small"><b>Top:</b></td>
	<td><input name="category$cat[selectorid][toppos]" type="text" size="20" value="$cat[toppos]" /></td>
	<td class="small"><b>Bottom:</b></td>
	<td><input name="category$cat[selectorid][bottompos]" type="text" size="20" value="$cat[bottompos]" /></td>
</tr>
<tr>
	<td class="small"><b>Left:</b></td>
	<td><input name="category$cat[selectorid][leftpos]" type="text" size="20" value="$cat[leftpos]" /></td>
	<td class="small"><b>Right:</b></td>
	<td><input name="category$cat[selectorid][rightpos]" type="text" size="20" value="$cat[rightpos]" /></td>
</tr>
</table>
</fieldset><br />
<fieldset><legend>Box</legend>
<table cellspacing="0" cellpadding="3" border="0">
<tr>
	<td class="small"><b>Width:</b></td>
	<td><input name="category$cat[selectorid][width]" type="text" size="21" value="$cat[width]" /></td>
	<td class="small"><b>Height:</b></td>
	<td><input name="category$cat[selectorid][height]" type="text" size="21" value="$cat[height]" /></td>
</tr>
<tr>
	<td class="small"><b>Margin:</b></td>
	<td><input name="category$cat[selectorid][margin]" type="text" size="21" value="$cat[margin]" /></td>
	<td class="small"><b>Padding:</b></td>
	<td><input name="category$cat[selectorid][padding]" type="text" size="21" value="$cat[padding]" /></td>
</tr>
<tr>
	<td class="small"><b>Display:</b></td>
	<td>
		<select name="category$cat[selectorid][display]">
			<option value="">(Default)</option>
			<option value="none"<if $cat[display]=='none'> selected="selected"</if>>None</option>
			<option value="inline"<if $cat[display]=='inline'> selected="selected"</if>>Inline</option>
			<option value="block"<if $cat[display]=='block'> selected="selected"</if>>Block</option>
			<option value="list-item"<if $cat[display]=='list-item'> selected="selected"</if>>List Item</option>
			<option value="run-in"<if $cat[display]=='run-in'> selected="selected"</if>>Run-in</option>
			<option value="compact"<if $cat[display]=='compact'> selected="selected"</if>>Compact</option>
			<option value="marker"<if $cat[display]=='marker'> selected="selected"</if>>Marker</option>
			<option value="table"<if $cat[display]=='table'> selected="selected"</if>>Table</option>
			<option value="inline-table"<if $cat[display]=='inline-table'> selected="selected"</if>>Inline Table</option>
			<option value="table-row-group"<if $cat[display]=='table-row-group'> selected="selected"</if>>Table Row Group</option>
			<option value="table-header-group"<if $cat[display]=='table-header-group'> selected="selected"</if>>Table Header Group</option>
			<option value="table-footer-group"<if $cat[display]=='table-footer-group'> selected="selected"</if>>Table Footer Group</option>
			<option value="table-row"<if $cat[display]=='table-row'> selected="selected"</if>>Table Row</option>
			<option value="table-column-group"<if $cat[display]=='table-column-group'> selected="selected"</if>>Table Column Group</option>
			<option value="table-column"<if $cat[display]=='table-column'> selected="selected"</if>>Table Column</option>
			<option value="table-cell"<if $cat[display]=='table-cell'> selected="selected"</if>>Table Cell</option>
			<option value="table-caption"<if $cat[display]=='table-caption'> selected="selected"</if>>Table Caption</option>
		</select>
	</td>
	<td class="small"><b>Vertical Align:</b></td>
	<td>
		<select id="category$cat[selectorid]_verticalalign" name="category$cat[selectorid][verticalalign]" onchange="if(this.value=='value'){getElement('cat$cat[selectorid]valignvalue').disabled=false;getElement('cat$cat[selectorid]valignvalue').focus();}else{getElement('cat$cat[selectorid]valignvalue').disabled=true}">
			<option value="">(Default)</option>
			<option value="baseline"<if $cat[verticalalign]=='baseline'> selected="selected"</if>>Baseline</option>
			<option value="sub"<if $cat[verticalalign]=='sub'> selected="selected"</if>>Subscript</option>
			<option value="super"<if $cat[verticalalign]=='super'> selected="selected"</if>>Superscript</option>
			<option value="top"<if $cat[verticalalign]=='top'> selected="selected"</if>>Top</option>
			<option value="text-top"<if $cat[verticalalign]=='text-top'> selected="selected"</if>>Text-Top</option>
			<option value="middle"<if $cat[verticalalign]=='middle'> selected="selected"</if>>Middle</option>
			<option value="bottom"<if $cat[verticalalign]=='bottom'> selected="selected"</if>>Bottom</option>
			<option value="text-bottom"<if $cat[verticalalign]=='text-bottom'> selected="selected"</if>>Text-Bottom</option>
		</select>
		<script type="text/javascript">
		<!--
			var newOption = document.createElement('option');
			newOption.value = 'value';
			newOption.appendChild(document.createTextNode('(Value)'));
			<if $cat[verticalalign]=='value'>
				newOption.selected = true;
			</if>
			getElement('category$cat[selectorid]_verticalalign').appendChild(newOption);
			document.write('<input id="cat$cat[selectorid]valignvalue" name="category$cat[selectorid][verticalalign_value]" type="text" size="20" value="$cat[verticalalign_value]"<if $cat[verticalalign]!='value'> disabled="disabled"</if>/>');
		-->
		</script>
		<noscript><div style="display:inline">
			Value:
			<input id="cat$cat[selectorid]valignvalue" name="category$cat[selectorid][verticalalign_value]" type="text" size="20" value="$cat[verticalalign_value]" />
		</div></noscript>
	</td>
</tr>
</table>
</fieldset><br />
<fieldset><legend>Borders</legend>
<table cellspacing="0" cellpadding="3" border="0">
<tr>
	<td class="small"><b>Top: <input value="1" onclick="" title="Same for all" type="checkbox" name="category$cat[selectorid][bordersame]"<if $cat[bordersame]> checked="checked"</if> /></b></td>
	<td><input name="category$cat[selectorid][bordertop]" type="text" size="20" value="$cat[bordertop]" /></td>
	<td class="small"><b>Bottom:</b></td>
	<td><input name="category$cat[selectorid][borderbottom]" type="text" size="20" value="$cat[borderbottom]" /></td>
</tr>
<tr>
	<td class="small"><b>Left:</b></td>
	<td><input name="category$cat[selectorid][borderleft]" type="text" size="20" value="$cat[borderleft]" /></td>
	<td class="small"><b>Right:</b></td>
	<td><input name="category$cat[selectorid][borderright]" type="text" size="20" value="$cat[borderright]" /></td>
</tr>
</table>
</fieldset><br />
<fieldset><legend>Extra CSS</legend>
<div class="center">
<textarea style="overflow:auto" name="category$cat[selectorid][extra]" cols="55" rows="6">$cat[extra]</textarea>
</div>
</fieldset>
</td>
</tr>
</tbody>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074825459";}s:20:"styles_category_link";a:4:{s:8:"category";s:17:"Admin CP - Styles";s:4:"body";s:136:"&bull; <a class="linksmall" href="#cat$cat[selectorid]" onclick="showSection('cat$cat[selectorid]'); return false;">$cat[name]</a><br />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1058900240";}s:6:"indent";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:18:"&nbsp;&nbsp;&nbsp;";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061350353";}s:10:"smilie_box";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:618:"<br />
<br />
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="$config[smilies_row]">Smilies</td>
</tr>
<include template="form_header" />
$smilies
<include template="form_footer" />
<if $showmore><tr>
<td class="tableheader" colspan="$config[smilies_row]" style="white-space: nowrap"><span class="small">Showing: $config[number_smilies] of $total</span><br />
<a class="linkheader" href="javascript://" onclick="smilie_popup(); return false;"><span class="small">Show more</span></a></td>
</tr></if>
</table></div>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061350802";}s:10:"smilie_row";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:22:"<tr>
$smilie_row
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061351164";}s:13:"smilie_column";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:277:"<td class="center"><a href="javascript://" onclick="smilie('$smilie[escaped_tag]', this.getElementsByTagName('img')[0].src); return false;"><img alt="<if $showtags>$smilie[name]<else />$smilie[tag]</if>" src="$smilie[image]" /></a></td>
<if $showtags><td>$smilie[tag]</td></if>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1073754380";}s:7:"pagenav";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:54:"<span class="small">Pages ($numpages):</span> $pagenav";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061608472";}s:13:"pagenav_first";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:126:"<a rel="page1" class="linksmall" href="$thispage.php?page=1<if $params>&amp;$params</if>"><b>&laquo; First</b></a> <b>...</b> ";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061608576";}s:12:"pagenav_last";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:140:"<b>...</b> <a rel="page$numpages" class="linksmall" href="$thispage.php?page=$numpages<if $params>&amp;$params</if>"><b>Last &raquo;</b></a>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061608612";}s:12:"pagenav_link";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:127:"<a rel="page$pagelink" class="linksmall" href="$thispage.php?page=$pagelink<if $params>&amp;$params</if>"><b>$pagelink</b></a> ";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061608629";}s:12:"pagenav_next";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:122:"<a rel="page$nextpage" class="linksmall" href="$thispage.php?page=$nextpage<if $params>&amp;$params</if>"><b>&gt;</b></a> ";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061608646";}s:14:"pagenav_nolink";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:15:"<b>[$page]</b> ";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061608665";}s:12:"pagenav_prev";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:122:"<a rel="page$prevpage" class="linksmall" href="$thispage.php?page=$prevpage<if $params>&amp;$params</if>"><b>&lt;</b></a> ";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061608681";}s:6:"smilie";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:100:"<img <if $add_tag>rel="smilie[$smilie[tag]]" </if>alt="$smilie[name]" src="$smilie[parsed_image]" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062730702";}s:12:"custom_field";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:202:"<tr>
<td><b>$field[name]:</b><br />
<span class="small">$field[description]</span></td><td colspan="2"><input name="field_$field[customfieldid]" type="text" size="60" value="$field[value]" /></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062293665";}s:19:"mail_pmnotification";a:4:{s:8:"category";s:13:"Mail Messages";s:4:"body";s:385:"$user[name] has sent you a private message, entitled "$mailsubject".

You can view the message at $config[url]/readpm.php?id=$pm[privatemessageid]

AOL users, click here: <a href="$config[url]/readpm.php?id=$pm[privatemessageid]">$config[url]/readpm.php?id=$pm[privatemessageid]</a>

You can turn off these notifications by going to your user control panel and clicking "Edit Options".";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062639415";}s:24:"delete_templateset_admin";a:4:{s:8:"category";s:20:"Admin CP - Templates";s:4:"body";s:124:"<include template="message_header" />
You cannot delete the Admin/Mod CP template set.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1063948807";}s:13:"image_missing";a:4:{s:8:"category";s:8:"Messages";s:4:"body";s:102:"<include template="message_header" />
You must provide an image.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1068954560";}s:14:"post_codeblock";a:4:{s:8:"category";s:7:"DP Code";s:4:"body";s:184:"<blockquote><div class="small">Code:</div><div><hr /><pre style="white-space: pre; font:12px Courier New, courier, serif; margin:0; padding:0;">$codetext</pre><hr /></div></blockquote>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074975540";}s:13:"post_phpblock";a:4:{s:8:"category";s:7:"DP Code";s:4:"body";s:182:"<blockquote><div class="small">PHP:</div><div><hr /><pre style="white-space: pre; font:12px Courier New, courier, serif; margin:0; padding:0;">$phptext</pre><hr /></div></blockquote>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074975518";}s:22:"register_account_comma";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:202:"<include template="message_header" />
You may not have a comma (<b>,</b>) in your name. This character is used to separate user names when sending private messages.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1072841705";}s:20:"account_illegal_name";a:4:{s:8:"category";s:16:"Admin CP - Users";s:4:"body";s:127:"<include template="message_header" />
The specified username is not allowed on this site.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073194513";}s:14:"post_htmlblock";a:4:{s:8:"category";s:7:"DP Code";s:4:"body";s:189:"<blockquote><div class="small">HTML Code:</div><div><hr /><pre style="white-space: pre; font:12px Courier New, courier, serif; margin:0; padding:0;">$htmltext</pre><hr /></div></blockquote>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074975502";}s:20:"maintenance_lastpost";a:4:{s:8:"category";s:22:"Admin CP - Maintenance";s:4:"body";s:286:"<include template="redirect_header" />
Last post maintenance 
<if $i==$cycle>
is continuing... (last user was <b>$lastid</b>)
<else />
has completed (last user was <b>$lastid</b>). You are now being returned to the maintenance control panel.
</if>
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1079831904";}s:4:"demo";a:4:{s:8:"category";s:9:"Demo Mode";s:4:"body";s:153:"<include template="message_header" /> 
Sorry, some functions have been disabled on the demo for security purposes. 
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1087964800";}}
*/ ?>