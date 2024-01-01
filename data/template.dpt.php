<?php /*
a:297:{s:10:"main_index";a:4:{s:8:"category";s:9:"Main Page";s:4:"body";s:848:"<include template="nav_header" />
<if $config[site_announcement]>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" style="width: 95%">
<tr>
<td class="tableheader">Announcement</td>
</tr>
<tr>
<td class="cellalt">$config[site_announcement]</td>
</tr>
</table><br />
<br />
</if>
<if $headlines>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" style="width: 95%">
<tr>
<td class="tableheader">Headlines</td>
</tr>
<tr>
<td class="cellalt">$headlines</td>
</tr>
</table><br />
<br />
</if>
<if $articles>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" style="width: 95%">
<tr>
<td class="tableheader">Articles</td>
</tr>
<tr>
<td class="cellalt">$articles</td>
</tr>
</table>
</if>
<include template="nav_footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1056479790";}s:12:"main_article";a:4:{s:8:"category";s:9:"Main Page";s:4:"body";s:1033:"<div style="clear:both; width:95%; margin:auto; padding-bottom:20px;">
<div style="border-bottom:1px solid" class="center"><b><a name="article_$article[articleid]"></a><a href="article.php?id=$article[articleid]">$article[title]</a></b></div>
<div class="center"><span class="small">Posted by <a href="profile.php?id=$article[userid]">$article[username]</a> on $article[date_posted]<br /><a href="#top">Back to Top</a>
<if $article[threadid]>
- <a href="thread.php?id=$article[threadid]">$article[replies] Comment<if $article[replies]!=1>s</if></a>
</if><br /><br /></span>
</div>
<table cellspacing="0" cellpadding="1" border="0" style="width:100%">
<tr>
<td style="width:2%; white-space:nowrap; vertical-align:top"><a href="topics.php?id=$article[topicid]"><img style="float:left; margin-left:3px; margin-right:10px" alt="$article[name]" src="$article[parsed_image]" /></a></td>
<td style="vertical-align:top" class="cellalt">$article[body]<if $readmore><br /><a href="$link"><b>Read More...</b></a></if></td>
</tr>
</table>
</div>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1075188258";}s:15:"redirect_header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:889:"<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<td class="cellmain"><div class="center">";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074809588";}s:10:"user_index";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:4398:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt; User Control Panel</b>
<br />
<br />
<table cellpadding="5">
<tr valign="top">
<td><form action="user.php" method="post">
<div><input name="op" type="hidden" value="add_buddy" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Buddy List<if $userids> <a href="newpm.php?userids=$userids"><img alt="Send a private message to everyone on your buddy list" src="$style[images]/pm.gif" /></a></if></td>
</tr>
<tr>
<td class="cellmain"><if $buddies>$buddies<else />You have no users in your buddy list.</if></td>
</tr>
<tr>
<td class="tableheader" style="white-space: nowrap"><span class="small">Add user:</span> <input class="small" name="buddy_name" type="text" size="20" /> <input class="small" type="submit" value="Add User" /></td>
</tr>
</table></form>
<form action="user.php" method="post">
<div><input name="op" type="hidden" value="add_ignore" /></div>
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Ignore List</td>
</tr>
<tr>
<td class="cellmain"><if $ignored>$ignored<else />You have no users in your ignore list.</if></td>
</tr>
<tr>
<td class="tableheader" style="white-space: nowrap"><span class="small">Add user:</span> <input class="small" name="ignore_name" type="text" size="20" /> <input class="small" type="submit" value="Add User" /></td>
</tr>
</table></form></td>
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">User Control Panel for $user[name]</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain" cellpadding="16">
<tr>
<td><div class="center"><a class="linksmall" href="edit_profile.php"><img alt="Edit profile" src="$style[images]/edit_profile.gif" />
<br />
Edit Profile</a></div></td>
<td><div class="center"><a class="linksmall" href="edit_options.php"><img alt="Edit options" src="$style[images]/edit_options.gif" />
<br />
Edit Options</a></div></td>
<td><div class="center"><a class="linksmall" href="change_password.php"><img alt="Change password" src="$style[images]/change_password.gif" />
<br />
Change Password</a></div></td>
<td><div class="center"><a class="linksmall" href="profile.php?id=$user[userid]"><img alt="View profile" src="$style[images]/viewprofile.gif" />
<br />
View Profile</a></div></td>
<td><div class="center"><a class="linksmall" href="user.php?op=logout"><img alt="Log out" src="$style[images]/logout.gif" />
<br />
Log out</a></div></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table><br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td colspan="7" class="tableheader">Subscribed Threads</td>
</tr>
<if $threads><tr>
<td colspan="3" class="tableheader"><span class="small">Thread Name</span></td>
<td class="tableheader"><span class="small">Thread Starter</span></td>
<td class="tableheader"><span class="small">Replies</span></td>
<td class="tableheader"><span class="small">Views</span></td>
<td class="tableheader"><span class="small">Last Post</span></td>
</tr>
$threads<else /><tr>
<td class="cellmain" colspan="7">There are no new subscribed threads.</td>
</tr></if>
<tr>
<td colspan="7" class="tableheader"><div class="center"><span class="small"><a class="linkheader" href="user.php?op=unsubscribe">Unsubscribe from all threads</a> - <a class="linkheader" href="user.php?op=unsubscribe_email">Stop receiving email notifications</a></span></div></td>
</tr>
</table><br />
<if $forums><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td colspan="6" class="tableheader">Subscribed Forums</td>
</tr>
<tr>
<td colspan="2" class="tableheader"><span class="small">Forum</span></td>
<td class="tableheader"><span class="small">Posts</span></td>
<td class="tableheader"><span class="small">Threads</span></td>
<td class="tableheader" style="white-space: nowrap"><span class="small">Last Post</span></td>
</tr>
$forums
</table></if></td>
</tr>
</table><br /><div class="center"><a href="#top">Back to Top</a> - <a href="forum.php">Back to Main Forums</a></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1063161316";}s:16:"permission_error";a:4:{s:8:"category";s:0:"";s:4:"body";s:1875:"<include template="header" />
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
<td colspan="2">
<if $user[userid]>
You are logged in as</span> <a href="$relativeurl/profile.php?id=$user[userid]">$user[name]</a> (<a href="$relativeurl/user.php?op=logout">Log out</a>)
<else />
<a href="$relativeurl/register.php">Click here to register.</a></if><br />
<a href="$relativeurl/user.php?op=remind">Forgotten your password?</a></td>
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
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1069897119";}s:20:"login_account_failed";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:173:"<include template="message_header" />
The username specified was not valid. Please press the back button on your browser and try again.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:6:"header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:3889:"<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<td id="contentcell" class="contentcell"><br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1082836647";}s:6:"footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:1400:"<br /></td>
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
</html>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1144549988";}s:15:"redirect_footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:293:"<br />
<br />
<a class="linksmall" href="$redirect_url">You are now being redirected to another page. If your browser does not redirect you, please click here</a></div></td>
</tr>
</table><if $config[show_querycounter]><br />
<br />
Number of queries: $query_counter</if></div>
</body>
</html>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"message_header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:244:"<include template="header" />
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
<include template="footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"styleset_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:115:"<option value="$styleset_result[stylesetid]"<if $selected> selected="selected"</if>>$styleset_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"register_index";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:487:"<include template="message_header" />
Thank you for visiting $config[name]! Registration is free. Before you proceed, you must agree to the rules stated below.
<br />
<br />
$config[rules]
<br />
<br />
<form method="post" action="register.php">
<div class="center">
<input name="op" type="hidden" value="register" />
<input type="submit" value="Accept" /> <input type="button" value="Decline" onclick="window.location='index.php'" />
</div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073280780";}s:17:"register_disabled";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:111:"<include template="message_header" />
Registration is currently disabled.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"register_account";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:11671:"<include template="header" />
<form action="register.php" method="post">
<div><input name="op" type="hidden" value="doregister" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Register</b>
<br />
<br /></div>
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Registration Form</td>
</tr>
<include template="form_header" />
<tr>
<td colspan="2" class="heading">Required Information</td>
</tr>
<tr>
<td><b>Username:</b></td><td><input name="name" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Password:</b></td><td><input name="password" type="password" size="60" /></td>
</tr>
<tr>
<td><b>Confirm password:</b></td><td><input name="password_confirm" type="password" size="60" /></td>
</tr>
<if $use_gd>
<tr>
<td><b>Image Verification:</b><br /><img src="include/gd_registration.php" alt="" /></td><td><input name="registerid" type="text" size="60" /></td>
</tr>
</if>
<tr>
<td><b>Email address:</b></td><td><input name="email" type="text" size="60" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Instant Messengers</td>
</tr>
<tr>
<td><b>AOL Instant Messenger:</b></td><td><input name="aol" type="text" size="60" /></td>
</tr>
<tr>
<td><b>ICQ:</b></td><td><input name="icq" type="text" size="60" /></td>
</tr>
<tr>
<td><b>MSN Messenger:</b></td><td><input name="msn" type="text" size="60" /></td>
</tr>
<tr>
<td><b>Yahoo Instant Messenger:</b></td><td><input name="yahoo" type="text" size="60" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Optional Information</td>
</tr>
<tr>
<td><b>Hide email address:</b><br />
<span class="small">This option enables you to hide your email address from users on the site.</span></td><td>Yes:<input name="hide_email" type="radio" value="1" /> No:<input name="hide_email" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Invisible on Who's Online list:</b><br />
<span class="small">This option will prevent you from being displayed on the Who's Online list.</span></td><td>Yes:<input name="invisible" type="radio" value="1" /> No:<input name="invisible" type="radio" value="0" checked="checked" /></td>
</tr>
<if $config[markread]><tr>
<td><b>Mark threads as read after reading them:</b><br />
<span class="small">When this option is enabled, threads will be marked as read when you read them, instead of requiring you to leave the forum for a set amount of time first.</span></td><td>Yes:<input name="markread" type="radio" value="1" checked="checked" /> No:<input name="markread" type="radio" value="0" /></td>
</tr></if>
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
<span class="small">Enable this if you wish to receive email notification of new posts in threads in which you have posted, by default. This can also be enabled and disabled on an individual thread basis when posting.</span></td><td>Yes:<input name="subscribe_email" type="radio" value="1" /> No:<input name="subscribe_email" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Receive mail from the administrators:</b><br /><span class="small">The administrators may wish to send out automated mailings to certain groups of members from time to time. If you wish not to receive these mailings, please set this to <b>No</b>.</span></td><td>Yes:<input name="massmail" type="radio" value="1" checked="checked" /> No:<input name="massmail" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Show avatars:</b><br />
<span class="small">Avatars are the small pictures that are shown under the names of some members. You can choose not to display them with this option.</span></td><td>Yes:<input name="show_avatars" type="radio" value="1" checked="checked" /> No:<input name="show_avatars" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Show images:</b><br />
<span class="small">If you are on a slow internet connection, you may elect to show links to images, instead of actually displaying images inside posts.</span></td><td>Yes:<input name="img" type="radio" value="1" checked="checked" /> No:<input name="img" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Show popup box when a new private message is received:</b><br />
<span class="small">This will display a popup box when you receive a new private message.</span></td><td>Yes:<input name="pm_popup" type="radio" value="1" /> No:<input name="pm_popup" type="radio" value="0" checked="checked" /></td>
</tr>
<tr>
<td><b>Show signatures:</b><br />
<span class="small">You may turn the display of signatures under posts on or off with this option.</span></td><td>Yes:<input name="displaysignatures" type="radio" value="1" checked="checked" /> No:<input name="displaysignatures" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Subscribe to threads by default:</b><br />
<span class="small">With this option enabled, you will automatically subscribe to threads in which you post. Subscribing to threads causes them to be shown in your user control panel when new posts are made to the threads. This can also be enabled or disabled for each thread while posting.</span></td><td>Yes:<input name="subscribe" type="radio" value="1" checked="checked" /> No:<input name="subscribe" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Use private messaging:</b><br />
<span class="small">Enables/disables the private messaging system, which allows you to talk privately with other forum members.</span></td><td>Yes:<input name="pm" type="radio" value="1" checked="checked" /> No:<input name="pm" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Use signature in posts by default:</b><br />
<span class="small"></span></td><td>Yes:<input name="usesignature" type="radio" value="1" checked="checked" /> No:<input name="usesignature" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Use WYSIWYG for posting:</b><br />
<span class="small">This allows you to see the formatting in your post as you make the post, and allows you to use friendly toolbar controls to format text. Internet Explorer 6.0 or higher for Windows or Mozilla 1.3 or higher across any platform is required.</span></td><td>Yes:<input name="use_wysiwyg" type="radio" value="1" checked="checked" /> No:<input name="use_wysiwyg" type="radio" value="0" /></td>
</tr>
<tr>
<td><b>Style:</b><br />
<span class="small">Choose the appearance you wish to have for the site.</span></td><td><select name="stylesetid">$stylesets</select></td>
</tr>

<tr>
<td><b>Time zone:</b><br />
<span class="small">Choose the method you would like to use to determine your timezone. Note that automatic timezone detection requires Javascript to be enabled.</span></td><td>
<span class="small"><input type="radio" name="auto_time_zone" value="1" checked="checked" /> Automatically Detect Your Timezone<br />
<input type="radio" name="auto_time_zone" value="0" /> Use the following Settings:<script type="text/javascript">
<!--
	function detectTimeSettings()
	{
		getElement('time_zone_dst').checked = false;
		getElement('southern_hemisphere').checked = false;
		if (dst==1)
			getElement('time_zone_dst').checked = true;
		if (southernHemisphere==1)
		{
			getElement('southern_hemisphere').checked = true;
			userDetectedTimezone = Math.round((clientDate.getTimezoneOffset() - (clientDate.getTimezoneOffset() + dst1)) / -60);
		}
		else
			userDetectedTimezone = Math.round((clientDate.getTimezoneOffset() - (clientDate.getTimezoneOffset() - dst1)) / -60);
		if (userDetectedTimezone==0) elementName = 'gmt00';
		else if (userDetectedTimezone<0) elementName = 'neg' + (userDetectedTimezone * -1);
		else elementName = 'pos' + userDetectedTimezone;
		elementName = 'tz' + elementName;
		if (getElement(elementName))
			getElement(elementName).selected = true;
	}
	document.write(' (<a href="javascript:detectTimeSettings()" class="linksmall">Detect Settings</a>)');
//-->
</script><br /><br /></span><div style="margin-left:35px">
<select name="time_zone"><option id="tzneg12" value="-12">(GMT-12:00) International Date Line West</option><option id="tzneg11" value="-11">(GMT-11:00) Midway Island, Samoa</option><option id="tzneg10" value="-10">(GMT-10:00) Hawaii</option><option id="tzneg9" value="-9">(GMT-9:00) Alaska</option><option id="tzneg8" value="-8">(GMT-8:00) Pacific Time (US &amp; Canada); Tijuana</option><option id="tzneg7" value="-7">(GMT-7:00) Mountain Time (US &amp; Canada)</option><option id="tzneg6" value="-6">(GMT-6:00) Central Time (US &amp; Canada)</option><option id="tzneg5" value="-5">(GMT-5:00) Eastern Time (US &amp; Canada)</option><option id="tzneg4" value="-4">(GMT-4:00) Atlantic Time (Canada)</option><option id="tzneg3" value="-3">(GMT-3:00) Greenland</option><option id="tzneg2" value="-2">(GMT-2:00) Mid-Atlantic</option><option id="tzneg1" value="-1">(GMT-1:00) Cape Verde Is.</option><option id="tzgmt00" value="0" selected="selected">(GMT) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option><option id="tzpos1" value="1">(GMT+1:00) Brussels, Copenhagen, Madrid, Paris</option><option id="tzpos2" value="2">(GMT+2:00) Cairo</option><option id="tzpos3" value="3">(GMT+3:00) Kuwait, Riyadh</option><option id="tzpos4" value="4">(GMT+4:00) Baku, Tbilisi, Yerevan</option><option id="tzpos5" value="5">(GMT+5:00) Islamabad, Karachi, Tashkent</option><option id="tzpos6" value="6">(GMT+6:00) Astana, Dhaka</option><option id="tzpos7" value="7">(GMT+7:00) Bangkok, Hanoi, Jakarta</option><option id="tzpos8" value="8">(GMT+8:00) Beijing, Chongqing, Hong Kong, Urumqi</option><option id="tzpos9" value="9">(GMT+9:00) Osaka, Sapporo, Tokyo</option><option id="tzpos10" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option><option id="tzpos11" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option><option id="tzpos12" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option></select><br /><span class="small"><input type="checkbox" value="1" name="time_zone_dst" id="time_zone_dst" /> I am affected by Daylight Savings Time<br /><input type="checkbox" value="1" name="southern_hemisphere" id="southern_hemisphere" /> I live in the southern hemisphere</span>
</div><script type="text/javascript">
<!--
	detectTimeSettings();
//-->
</script></td>
</tr>
<tr>
<td><b>Mark threads as read after being inactive:</b><br />
<span class="small">If you'd like all threads to be marked as read after a certain period of inactivity, put this amount of time here in minutes. Otherwise, type <b>0</b> (zero).</span></td><td><input name="markread_time" type="text" size="60" value="15" /></td>
</tr>
<tr>
<td><b>Website:</b></td><td><input name="website" type="text" size="60" value="http://" /></td>
</tr>
<tr>
<td><b>Location:</b><br />
<span class="small">Where you live</span></td><td><input name="location" type="text" size="60" /></td>
</tr>
$customfields
<tr>
<td colspan="2" align="center"><input type="submit" value="Register" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1077772144";}s:11:"forum_index";a:4:{s:8:"category";s:11:"Forum Index";s:4:"body";s:4823:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Forum</b><br />
<br />
<table width="100%">
<tr valign="top">
<td class="foreground"><span class="small">Number of members: $config[stat_members]<br />
$num_threads threads. $num_posts posts.</span><if $config[show_rules]><br />
<a class="linksmall" href="display.php?page=rules">Forum rules for $config[name]</a></if></td>
<td class="foreground right"><span class="small"><if $user[userid]>Welcome back,</span> <a class="linksmall" href="profile.php?id=$user[userid]">$user[name]</a><span class="small">!<br /></if>
Please welcome our newest member,</span> <a class="linksmall" href="profile.php?id=$config[stat_lastuserid]">$config[stat_lastusername]</a><span class="small">.</span><if $newforumposts><br />
<a class="linksmall" href="newthreads.php">View Newest Threads</a></if></td>
</tr>
</table>
<br />
<if $config[show_description]>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td class="cellmain"><if !$user[userid]><form action="user.php" method="post" style="margin:0px; padding:0px; float:right"><div><input name="redirect_url" type="hidden" value="$relativeurl/forum.php" /><input name="op" type="hidden" value="login" /><span class="small">Username:</span> <input class="small" name="name" type="text" size="15" />&nbsp;&nbsp;&nbsp;<span class="small">Password:</span> <input class="small" name="password" type="password" size="15" />&nbsp;&nbsp;<input class="small" type="submit" value="Login" /></div></form></if>
<strong style="font-size:110%">Welcome to $config[name]!</strong>
<hr style="clear:both; height:1px" />
<span class="small">$config[description]</span></td>
</tr>
</table><br />
</if>
<if $forums>$forums
</table><else /><div class="center">There are currently no forums on this site.</div></if>
<br />
<if ($group[privatemessaging] && $user[pm] && $user[num_pm])><table class="tableline" width="100%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader"><a class="linkheader" href="pm.php">Private Messages</a></td>
</tr>
<tr>
<td class="cellmain"><span class="small">You have $num_pm unread message<if $num_pm!="1">s</if>.</span><ul>$privatemessages</ul></td>
</tr>
</table><br /></if>
<if $config[whos_online]><table class="tableline" width="100%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader"><a class="linkheader" href="online.php"><b>Who's Online</b></a></td>
</tr>
<tr>
<td class="cellmain"><span class="small">There <if $num_users_online=="1">is<else />are</if> currently $num_users_online user<if $num_users_online!="1">s</if> and $num_guests_online guest<if $num_guests_online!="1">s</if> online, for a total of $total_online <if $total_online=="1">person<else />people</if> online. Most ever online was $config[most_online] on $config[most_online_date].</span><br />
$users</td>
</tr>
</table></if><br />
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td style="text-align:center" class="cellmain"><if $user[userid]><a class="linksmall" href="user.php?op=logout">Log out</a> <span class="small">|</span> </if><a class="linksmall" href="faq.php?faq=userfaq">Frequently Asked Questions</a> <span class="small">|</span> <a class="linksmall" href="forum.php?op=markread">Mark all forums read</a> <span class="small">|</span> <a class="linksmall" href="leaders.php">Site/Forum Leaders</a><if !$user[userid]><form action="user.php" method="post"><div><input name="redirect_url" type="hidden" value="forum.php" /><input name="op" type="hidden" value="login" /><span class="small">Username:</span> <input class="small" name="name" type="text" size="15" />&nbsp;&nbsp;&nbsp;<span class="small">Password:</span> <input class="small" name="password" type="password" size="15" />&nbsp;&nbsp;<input class="small" type="submit" value="Login" /></div></form></if></td>
</tr>
</table>
</td>
</tr>
</table>
<br />
<table width="95%">
<tr>
<td style="width: 20%" class="right"><span class="small">New posts:</span></td><td><img alt="New posts" src="$style[images]/on.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts:</span></td><td><img alt="No new posts" src="$style[images]/off.gif" /></td>
<td style="width: 20%" class="right"><span class="small">New posts (closed):</span></td><td><img alt="New posts (closed)" src="$style[images]/on_locked.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts (closed):</span></td><td><img alt="No new posts (closed)" src="$style[images]/off_locked.gif" /></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1075187718";}s:13:"profile_index";a:4:{s:8:"category";s:12:"User Profile";s:4:"body";s:5431:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt; Viewing $user_result[name]'s Profile</b>
<br />
<br />
<table cellspacing="1" cellpadding="5" width="100%" class="tableline">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="2" width="100%">
<tr>
<if $user[userid]><td class="center" width="14%"><a class="linksmall" href="user.php?op=add_buddy&amp;id=$user_result[userid]&amp;profile=1"><img alt="Add $user_result[name] to your buddy list" src="$style[images]/buddy.gif" />
<br />Add to buddy list</a></td>
<td class="center" width="14%"><a class="linksmall" href="user.php?op=add_ignore&amp;id=$user_result[userid]&amp;profile=1"><img alt="Add $user_result[name] to your ignore list" src="$style[images]/ignore.gif" />
<br />Add to ignore list</a></td></if>
<if $showemail><td class="center" width="14%"><a class="linksmall" href="email.php?id=$user_result[userid]"><img alt="Send $user_result[name] an email" src="$style[images]/profile_email.gif" />
<br />Send an email</a></td></if>
<if $showpm><td class="center" width="14%"><a class="linksmall" href="newpm.php?userid=$user_result[userid]"><img alt="Send $user_result[name] a private message" src="$style[images]/profile_pm.gif" />
<br />Send a private message</a></td></if>
<if $showsearch><td class="center" width="14%"><a class="linksmall" href="search.php?op=post&amp;type=post&amp;sort=desc&amp;userid=$user_result[userid]"><img alt="Search for posts made by $user_result[name]" src="$style[images]/profile_search.gif" />
<br />Search for posts</a></td></if>
<if $group[users]><td class="center" width="14%"><a class="linksmall" href="$admincp_dir/users.php?op=edit&amp;id=$user_result[userid]"><img alt="Edit $user_result[name]'s profile" src="$style[images]/edituser.gif" /><br />
Edit User</a></td></if>
<if ($group[supermod_viewfullprofiles] && !$group[users])><td class="center" width="15%"><a class="linksmall" href="$modcp_dir/users.php?op=view&amp;id=$user_result[userid]"><img alt="View $user_result[name]'s full profile" src="$style[images]/users.gif" /><br />
View full profile</a></td></if>
<if ($group[supermod_viewfullprofiles] || $group[users])><td class="center" width="15%"><a class="linksmall" href="<if $group[users]>$admincp_dir/<else />$modcp_dir/view</if>users.php?op=doipcheck&amp;userid=$user_result[userid]"><img alt="Check IP addresses" src="$style[images]/profile_search.gif" /><br />
Check IP Addresses</a></td></if>
</tr>
</table>
</td>
</tr>
</table>
<br />
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td style="padding-right:10px; width:285px; vertical-align:top">
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellpadding="2">
<tr>
<td style="white-space:nowrap"><b>Name:</b></td><td>$username</td>
</tr>
<tr>
<td style="white-space:nowrap"><b>Status:</b></td><td class="small">$user_result[title]</td>
</tr>
<if ($user_result[parsed_avatar] && $user[show_avatars])>
<tr>
<td style="white-space:nowrap"><b>Avatar:</b></td><td><img alt="$user_result[name]'s avatar" src="$user_result[parsed_avatar]" /></td>
</tr>
</if>
<tr>
<td style="white-space:nowrap"><b>Posts:</b></td><td>$user_result[posts] ($user_result[posts_per_day] post<if $user_result[posts_per_day]!="1">s</if> per day)</td>
</tr>
<if $lastpost[postid]><tr>
<td style="white-space:nowrap"><b>Last post:</b></td><td><a href="thread.php?postid=$lastpost[postid]#$lastpost[postid]">$lastpost[name]</a> on $lastpost[postdate]</td>
</tr></if>
<if ($user_result[lastactivity] && $config[whos_online])><tr>
<td style="white-space:nowrap"><b>Last online:</b></td><td>$user_result[parsed_lastactivity]</td>
</tr>
<tr>
<td style="white-space:nowrap"><b>Currently:</b></td><td><if $user_result[activity]>$user_result[activity]<else />Not online</if></td>
</tr></if>
<tr>
<td style="white-space:nowrap"><b>Join date:</b></td><td>$user_result[joindate]</td>
</tr></table>
</td>
</tr>
</table>
</td>
<td valign="top">
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td class="tableheader">Other Information</td>
</tr>
<tr>
<td class="cellalt">
<table cellpadding="2">
<tr>
<td width="100"><b>Website:</b></td><td><a href="$user_result[website]" onclick="window.open(this.href); return false;">$user_result[website]</a></td>
</tr>
<tr>
<td><b>Location:</b></td><td>$user_result[location]</td>
</tr>
$customfields
</table>
</td>
</tr>
</table><br />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td class="tableheader">Instant Messengers</td>
</tr>
<tr>
<td class="cellalt">
<table cellpadding="2">
<tr>
<td width="100"><b>AIM:</b></td><td>$user_result[aol]</td>
</tr>
<tr>
<td><b>ICQ:</b></td><td><a href="http://web.icq.com/wwp?Uin=$user_result[icq]">$user_result[icq]</a></td>
</tr>
<tr>
<td><b>MSN:</b></td><td>$user_result[msn]</td>
</tr>
<tr>
<td><b>Yahoo:</b></td><td>$user_result[yahoo]</td>
</tr>
</table>
</td>
</tr>
</table><br />
<if $user_result[signature]>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td class="tableheader">Signature</td>
</tr>
<tr>
<td class="cellalt">$user_result[signature]</td>
</tr>
</table></if>
</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1075778510";}s:12:"invalid_user";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:110:"<include template="message_header" />
The specified user does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"site_closed";a:4:{s:8:"category";s:0:"";s:4:"body";s:98:"<include template="message_header" />
$config[closed_reason]
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"forum_forum_parent";a:4:{s:8:"category";s:11:"Forum Index";s:4:"body";s:994:"<if !$first></table><br /></if>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%" class="tableline">
<tr>
<td class="tableheader" colspan="4" style="text-align:left; padding:8px"><a class="linkheader" href="forum_display.php?id=$forum[forumid]"><b>$forum[name]</b></a><if $forum[description]><br />
<span style="font-weight: normal" class="small">$forum[description]</span></if></td>
<td class="tableheader small" colspan="2"><if $forum[usersonline]>$forum[usersonline] User<if $forum[usersonline]!=1>s</if> Browsing<else />&nbsp;</if></td>
</tr>
<tr>
<td colspan="2" class="heading" style="text-align:left"><span class="small">Forum</span></td>
<td class="heading"><span class="small">Posts</span></td>
<td class="heading"><span class="small">Threads</span></td>
<td class="heading" style="white-space: nowrap"><span class="small">Last Post</span></td>
<if $config[show_moderators]><td class="heading"><span class="small">Moderators</span></td></if>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:11:"forum_forum";a:4:{s:8:"category";s:11:"Forum Index";s:4:"body";s:1925:"<tr>
<td class="$color" style="width: 18px"><div class="center"><img alt="<if $forum[link]>Link to $forum[link]" src="$style[images]/forumlink<else /><if $newposts>New posts" src="$style[images]/on<else />No new posts" src="$style[images]/off</if></if><if $locked>_locked</if>.gif" /></div></td>
<td class="$color"><a href="forum_display.php?id=$forum[forumid]"><b>$forum[name]</b></a><if $forum[usersonline]> <span class="small">($forum[usersonline] User<if $forum[usersonline]!=1>s</if> Browsing)</span></if><br /><span class="small">$forum[description]</span>
<if $subforums><br /><span class="small"><b>Sub-forums:</b> $subforums</span></if></td>
<td class="$color" style="width:48px"><div class="center"><if $forum[link]>-<else />$forum[posts]</if></div></td>
<td class="$color" style="width:48px"><div class="center"><if $forum[link]>-<else />$forum[threads]</if></div></td>
<td class="$color" style="width:210px"><if $forum[link]><div class="center">-</div><else /><if $forum[lastpostdate]>
<table cellspacing="0" cellpadding="2" width="100%">
<tr>
<td style="width:1%"><a href="thread.php?postid=$forum[lastpostid]#post$forum[lastpostid]"><img src="$style[images]/right.gif" alt="Jump to last Post" /></a></td>
<td><div class="small"><if $threadperm[viewthreads] && $config[lastpost_thread]><a class="linksmall" href="thread.php?id=$forum[lastthreadid]" title="View Thread &quot;$forum[threadfullname]&quot;"><b>$forum[threadname]</b></a><br /></if>
$forum[lastpostdate]<br />by <a class="linksmall" href="profile.php?id=$forum[lastuserid]">$forum[lastusername]</a>
</div></td>
<if $forum[threadiconid] && $threadperm[viewthreads] && $config[lastpost_thread]><td style="width:1%"><img alt="$forum[icon_name]" src="$forum[icon_image]" /></td></if>
</tr>
</table><else /><div class="center small">Never</div></if></if></td>
<if $config[show_moderators]><td class="$color" style="width:130px">$moderators</td></if>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1090140089";}s:18:"forumdisplay_index";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:8947:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums<br />
<br />
<if $moderators><br />
<span class="small">(Moderated by:</span> <b>$moderators</b><span class="small">)</span><br /></if>
<if $users><span class="small">(Currently browsing forum:</span> $users<span class="small">)</span><br /></if><br />
<if $subforums><br />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%" class="tableline">
<tr>
<td class="tableheader" style="text-align:left; padding:8px" colspan="6"><a class="linkheader" href="forum_display.php?id=$forum[forumid]">Sub-Forums</a></td>
</tr>
<tr>
<td colspan="2" class="heading" style="text-align:left"><span class="small">Forum</span></td>
<td class="heading"><span class="small">Posts</span></td>
<td class="heading"><span class="small">Threads</span></td>
<td class="heading" style="white-space: nowrap"><span class="small">Last Post</span></td>
<if $config[show_moderators]><td class="heading"><span class="small">Moderators</span></td></if>
</tr>
$subforums
</table><br />
</if>
<form action="search.php" method="post">
<div><input name="op" type="hidden" value="post" />
<input name="type" type="hidden" value="post" />
<input name="sort" type="hidden" value="relavence" />
<input name="forumid" type="hidden" value="$forum[forumid]" /></div>
<if ($forum[allow_posting] || ($forum_pagenav && $showthreads) || $threads)>
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td style="width:33%" class="cellmain"><if $forum[allow_posting]><a href="newthread.php?id=$forum[forumid]"><img alt="New Thread" src="$style[images]/newthread.gif" /></a></if></td>
<if $forum_pagenav && $showthreads><td style="text-align:center; white-space:nowrap" class="cellmain">$forum_pagenav</td></if>
<td class="cellmain right" style="width:50%"><if $threads><span class="small"><b>Search in this forum:</b></span> <input class="small" name="terms" type="text" size="20" /> <input class="small" type="submit" value="Go" /></if></td>
</tr>
</table>
</td>
</tr>
</table><div><br /></div>
</if></form>
<if $showthreads>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td class="tableheader" style="text-align:left; padding:8px" colspan="8"><a class="linkheader" href="forum_display.php?id=$forum[forumid]">$forum[name]</a></td>
</tr>
<tr>
<td colspan="3" class="heading"><span class="small">Thread Name</span> <a href="forum_display.php?sort=name&amp;order=asc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by thread name in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="forum_display.php?sort=name&amp;order=desc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by thread name in descending order" src="$style[images]/down.gif"style="vertical-align: middle"  /></a></td>
<td class="heading" style="white-space: nowrap"><span class="small">Thread Starter</span> <a href="forum_display.php?sort=username&amp;order=asc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by thread starter in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="forum_display.php?sort=username&amp;order=desc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by thread starter in descending order" src="$style[images]/down.gif"style="vertical-align: middle"  /></a></td>
<td class="heading" style="white-space: nowrap"><span class="small">Replies</span> <a href="forum_display.php?sort=posts&amp;order=asc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by number of replies in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="forum_display.php?sort=posts&amp;order=desc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by number of replies in descending order" src="$style[images]/down.gif"style="vertical-align: middle"  /></a></td>
<td class="heading" style="white-space: nowrap"><span class="small">Views</span> <a href="forum_display.php?sort=views&amp;order=asc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by number of views in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="forum_display.php?sort=views&amp;order=desc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by number of views in descending order" src="$style[images]/down.gif"style="vertical-align: middle"  /></a></td>
<td class="heading" style="white-space: nowrap"><span class="small">Last Post</span> <a href="forum_display.php?sort=lastpostdate&amp;order=asc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by last post date in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="forum_display.php?sort=lastpostdate&amp;order=desc&amp;id=$forum[forumid]&amp;page=$page"><img alt="Sort by last post date in descending order" src="$style[images]/down.gif"style="vertical-align: middle"  /></a></td>
</tr>
$announcement_display
$threads
</table></if>
<if $forum_pagenav || ($showthreads && $forum[allow_posting])>
<br />
<form action="search.php" method="post">
<div><input name="op" type="hidden" value="post" />
<input name="type" type="hidden" value="post" />
<input name="sort" type="hidden" value="relavence" />
<input name="forumid" type="hidden" value="$forum[forumid]" /></div>
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td style="width:33%" class="cellmain"><if $forum[allow_posting]><a href="newthread.php?id=$forum[forumid]"><img alt="New Thread" src="$style[images]/newthread.gif" /></a></if></td>
<if $forum_pagenav && $showthreads><td style="text-align:center; white-space:nowrap" class="cellmain">$forum_pagenav</td></if>
<td class="cellmain right" style="width:50%"><if $threads><span class="small"><b>Search in this forum:</b></span> <input class="small" name="terms" type="text" size="20" /> <input class="small" type="submit" value="Go" /></if></td>
</tr>
</table>
</td>
</tr>
</table>
</form>
<else /><if (!$subforums && !$showthreads)>
<div class="center"><b>There are currently no posts in this forum.</b></div><br /></if>
</if><br />
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td class="cellmain"><include template="forumjump" /></td>
<if $user[userid]><td class="cellmain right"><span class="small">Subscriptions:</span><br />
<select class="small" name="subscribe" onchange="window.location='subscribe.php?op='+this.options[this.selectedIndex].value+'forum&amp;id=$forum[forumid]'">
<option value="subscribe" selected="selected">--Subscription Options--</option>
<option value="subscribe">Subscribe to this forum</option>
<option value="unsubscribe">Unsubscribe from this forum</option>
</select> <input type="button" value="Go" class="small" onclick="window.location='subscribe.php?op='+getElement('subscribe').value+'forum&amp;id=$forum[forumid]'" /></td></if>
</tr>
</table>
</td>
</tr>
</table><br />
<if $subforums>
<table width="95%" class="foreground">
<tr>
<td style="width: 20%" class="right"><span class="small">New posts:</span></td><td><img alt="New posts" src="$style[images]/on.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts:</span></td><td><img alt="No new posts" src="$style[images]/off.gif" /></td>
<td style="width: 20%" class="right"><span class="small">New posts (closed):</span></td><td><img alt="New posts (closed)" src="$style[images]/on_locked.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts (closed):</span></td><td><img alt="No new posts (closed)" src="$style[images]/off_locked.gif" /></td>
</tr>
</table>
</if>
<if $threads>
<table width="95%" class="foreground">
<tr>
<td style="width: 20%" class="right"><span class="small">New posts:</span></td><td><img alt="New posts" src="$style[images]/unread.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts:</span></td><td><img alt="No new posts" src="$style[images]/read.gif" /></td>
<td style="width: 20%" class="right"><span class="small">New posts (closed):</span></td><td><img alt="New posts (closed)" src="$style[images]/unread_closed.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts (closed):</span></td><td><img alt="No new posts (closed)" src="$style[images]/read_closed.gif" /></td>
</tr>
$hot_icons
</table>
</if><br />
<div class="center"><a href="#top">Back to Top</a> - <a href="forum.php">Back to Main Forums</a></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073281500";}s:19:"forumdisplay_thread";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:1706:"<tr>
<td class="$color"><div class="center">$isread</div></td>
<td class="$color"><div class="center"><if $thread[iconid]><img alt="$thread[icon_name]" src="$thread[image]" /></if><if $thread[poll]><img alt="Poll" src="$style[images]/poll.gif" /></if></div></td>
<td class="$color"><if $newposts><a href="thread.php?id=$thread[threadid]&amp;op=newpost"><img alt="Jump to first unread post" src="$style[images]/right.gif" /></a> </if><if $thread[hasattachment] && $group[viewattachments]><img alt="Thread has an attachment" src="$style[images]/paperclip.gif" /> </if><if $thread[sticky]>Sticky: </if><if $thread[poll]>Poll: </if><a href="thread.php?id=$thread[threadid]">$thread[name]</a><if $multipage_nav> <span class="small">(</span> $multipage_nav<span class="small">)</span></if></td>
<td class="$color"><a href="profile.php?id=$thread[userid]">$thread[username]</a></td>
<td class="$color" style="text-align: center"><a href="javascript:replies($thread[threadid])">$thread[replies]</a></td>
<td class="$color" style="text-align: center"><if $config[whos_online] && $config[viewingthread]><a href="online.php<if $thread[userids]>?userids=$thread[userids]</if>" title="$thread[usercount] User<if $thread[usercount]!=1>s</if> Viewing Thread">$thread[views]</a><else />$thread[views]</if></td>
<td class="$color"><table>
<tr>
<td class="$color"><a href="thread.php?postid=$thread[lastpostid]#$thread[lastpostid]"><img style="vertical-align: middle" alt="Jump to last post" src="$style[images]/right.gif" /></a></td><td class="$color"><span class="small">$thread[lastpostdate] by</span> <a class="linksmall" href="profile.php?id=$thread[lastuserid]">$thread[lastusername]</a></td>
</tr>
</table></td>
</tr>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1065083476";}s:12:"thread_index";a:4:{s:8:"category";s:14:"Thread Display";s:4:"body";s:9250:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <b>$thread[name]</b>
<br />
<br />
<if $users><span class="small">(Currently viewing thread:</span> $users<span class="small">)</span><br /></if><br />
<if $thread[poll]><div class="center"><if !$showresults><form action="poll.php" method="post">
<div><input name="op" type="hidden" value="dovote" />
<input name="id" type="hidden" value="$thread[threadid]" /></div></if>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td colspan="4" class="tableheader">$name<if $message><br />
<span class="small"></if><if $message=="closed">This poll is closed.</if><if $message=="noperm">You are not allowed to vote on this poll.</if><if $message=="alreadyvoted">You have already voted on this poll.</if><if $message></span></if></td>
</tr>
$poll_choices
<if $showresults><tr>
<td class="tableheader" colspan="2" style="text-align: right">Total:</td><td class="tableheader" style="white-space: nowrap">$total votes</td><td class="tableheader">100%</td>
</tr></if>
</table>
<if !$showresults><table width="100%" class="foreground" style="font-size: 95%"><tr><td><input type="submit" value="Vote" /></td><td class="right"><a href="poll.php?op=results&amp;id=$thread[threadid]">Show poll results</a></td></tr></table></form><else /><br /></if></div></if>
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td class="cellmain"><a href="newthread.php?id=$thread[forumid]"><img alt="New Thread" src="$style[images]/newthread.gif" /></a> <a href="reply.php?id=$thread[threadid]&amp;ignore=$ignore"><if $thread[closed]>
<img alt="Thread Closed" src="$style[images]/closed.gif" /><else />
<img alt="Post Reply" src="$style[images]/reply.gif" /></if></a></td>
<if $thread_pagenav><td class="cellmain" style="text-align:center">$thread_pagenav</td></if>
<td class="cellmain right">
<a href="print_thread.php?id=$thread[threadid]&amp;page=$page&amp;ignore=$ignore"><img alt="Show a printable version of this thread" src="$style[images]/print.gif" /></a> <a class="linksmall" href="print_thread.php?id=$thread[threadid]&amp;page=$page">Show a printable version of this thread</a><br /><a href="thread.php?id=$thread[threadid]"><img alt="" title="Link to this thread" src="$style[images]/link.gif" /></a> <a class="linksmall" href="thread.php?id=$thread[threadid]">Link to this thread</a>
</td></tr>
</table>
</td>
</tr>
</table><br />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%" class="tableline">
<tr>
<td class="tableheader" style="width:175px"><span class="small">Poster</span></td>
<td class="tableheader"><span class="small">Post</span></td>
</tr>
</table>
$posts
<if $forum[allow_posting]><if $user[quick_reply]=="single"><form id="replyform" action="reply.php" method="post" style="margin:0px; padding:0px;">
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%" class="tableline">
<tr>
<td class="tableheader" style="width:175px">
<input name="op" type="hidden" value="dopost" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input name="subscribe_email" type="hidden" value="$user[subscribe_email]" />
<input name="showsignature" type="hidden" value="$user[usesignature]" />
<input name="url" type="hidden" value="1" />
<input name="subscribe" type="hidden" value="$user[subscribe]" /><span class="small"><b>Quick Reply:</b></span></td><td class="tableheader"><span class="small">Message:</span> <input class="small" id="message" name="message" size="70" /> <input class="small" type="submit" value="Reply" onclick="if (messageNotEmpty()) { this.disabled=true; this.form.submit(); } else {return false;}" /></td>
</tr>
</table>
</form><br />
<else /><if $user[quick_reply]=="multi"><br />
<form id="replyform" action="reply.php" method="post" style="margin:0px; padding:0px;">
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td class="cellmain" style="width:175px"><div class="small"><div class="center">
<input id="quotepostid" name="quotepostid" type="hidden" value="0" />
<input name="op" type="hidden" value="dopost" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input name="subscribe_email" type="hidden" value="$user[subscribe_email]" />
<input name="url" type="hidden" value="1" />
<input name="subscribe" type="hidden" value="$user[subscribe]" />
<b>Quick Reply:</b><br /><br /></div>
<div class="right" style="margin:4px; white-space:nowrap;">
<if $group[html]>Allow HTML in Post: <input type="checkbox" name="html" value="1" /><br /></if>
Include Signature: <input name="showsignature" type="checkbox" value="1"<if $user[usesignature]> checked="checked"</if> /><br />
<script type="text/javascript">
<!--
if (getElement('quotepostid'))
	document.write('Quote Selected Message: <input title="You must select a message to Quick Quote" id="quoteselected" name="quoteselected" type="checkbox" value="1" disabled="disabled" />');
//-->
</script>
</div></div></td>
<td class="cellmain"><div class="center">
<img src="$style[images]/smilies.gif" alt="Show Smilies" onclick="smilie_popup();" style="cursor:pointer; vertical-align:middle" />
<textarea style="vertical-align:middle" id="message" name="message" cols="65" rows="6"></textarea><br />
<input type="submit" value="Post Message" onclick="if (messageNotEmpty()) { this.disabled=true; this.form.submit(); } else {return false;}" />
</div></td>
</tr>
</table>
</form></if></if></if><br />
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td class="cellmain"><a href="newthread.php?id=$thread[forumid]"><img alt="New Thread" src="$style[images]/newthread.gif" /></a> <a href="reply.php?id=$thread[threadid]&amp;ignore=$ignore"><if $thread[closed]>
<img alt="Thread Closed" src="$style[images]/closed.gif" /><else />
<img alt="Post Reply" src="$style[images]/reply.gif" /></if></a></td>
<if $thread_pagenav><td class="cellmain" style="text-align:center">$thread_pagenav</td></if>
<td class="cellmain right">
<a href="print_thread.php?id=$thread[threadid]&amp;page=$page&amp;ignore=$ignore"><img alt="Show a printable version of this thread" src="$style[images]/print.gif" /></a> <a class="linksmall" href="print_thread.php?id=$thread[threadid]&amp;page=$page">Show a printable version of this thread</a>
<if $moderator_options><br /><form action="moderate.php" method="post" style="margin:0px; padding:0px"><div><span class="small">Moderator options:</span> <select class="small" name="op" id="threadop" onchange="window.location='moderate.php?op='+this.value+'&amp;id=$thread[threadid]&amp;page=$page&amp;postid=$postid'"><option value="edit">--Thread Options--</option><option value="close"><if $thread[closed]>Open<else />Close</if> Thread</option><option value="move">Copy/Move Thread</option><if $thread[redirected]><option value="deleteredirect">Delete Redirect</option></if><option value="delete">Delete Thread</option><if $thread[poll]><option value="editpoll">Edit Poll</option></if><option value="edit">Edit Thread</option><if $thread[poll]><option value="resetpoll">Reset Poll</option></if><option value="stick"><if $thread[sticky]>Unstick<else />Stick</if> Thread</option><option value="log">View Thread Log</option><if $thread[poll]><option value="whovoted">Who Voted</option></if></select> <input type="button" onclick="window.location='moderate.php?op='+getElement('threadop').value+'&amp;id=$thread[threadid]'" value="Go" class="small" /></div></form></if></td></tr>
</table>
</td>
</tr>
</table><br />
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td class="cellmain"><include template="forumjump" /></td>
<if $user[userid]><td class="cellmain right"><span class="small">Subscriptions:</span><br />
<select class="small" name="subscribemenu" id="subscribemenu" onchange="window.location='subscribe.php?op='+this.value+'&amp;id=$thread[threadid]&amp;page=$page'">
<option value="subscribe" selected="selected">--Subscription Options--</option>
<option value="subscribe_email">Receive email updates to this thread</option>
<option value="unsubscribe_email">Stop receiving email updates to this thread</option>
<option value="subscribe">Subscribe to this thread</option>
<option value="unsubscribe">Unsubscribe from this thread</option>
</select> <input type="button" onclick="window.location='subscribe.php?op='+getElement('subscribemenu').value+'&amp;id=$thread[threadid]'" value="Go" class="small" /></td></if>
</tr>
</table>
</td>
</tr>
</table><br />
<div class="center"><a href="#top">Back to Top</a> - <a href="forum_display.php?id=$forum[forumid]">Back to $forum[name]</a> - <a href="thread.php?id=$thread[threadid]">Link to Thread</a></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1075440484";}s:11:"thread_post";a:4:{s:8:"category";s:14:"Thread Display";s:4:"body";s:4196:"<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%" class="tableline">
<tr valign="top">
<td class="$color" style="width:175px; text-align:center">
<if ($post[ignoreuserid] && !$ignore)>
<a href="profile.php?id=$post[userid]"><b>$post[parsed_name]</b></a></td>
<td class="$color" id="post$post[postid]"><a name="$post[postid]"></a>You are ignoring this post. If you would like to see all ignored posts in this thread, <a href="thread.php?postid=$post[postid]&amp;ignore=1#$post[postid]">click here</a>.
<else />
<if $post[parsed_name]><a href="profile.php?id=$post[userid]"><b>$post[parsed_name]</b></a><else /><b>$post[username]</b></if>
<br />
<span class="small">$post[title]
<br />
<br />
<if ($post[parsed_avatar] && $user[show_avatars])>
<img alt="$post[username]'s avatar" src="$post[parsed_avatar]" /><br />
</if>
<br />Joined: <if $post[userid]>$post[joindate]<else />Never</if><br />
<if $post[location]>Location: $post[location]<br /></if>
Posts: <if $post[userid]>$post[posts]<else />N/A</if><br />
Status: <if $isonline><b>Online</b><else />Offline</if></span><br />
<img alt="" src="$style[images]/spacer.gif" /></td>
<td class="$color" id="post$post[postid]"><a name="$post[postid]"></a>
<if $post[iconid]><img alt="$post[icon_name]" src="$post[image]" /></if><if $post[subject]>
 <b>$post[subject]</b></if><if $showbreaks><br /><br /></if>
$post[message]
<if ($perm[viewattachments] && $post[attachment])>
<br />
<br />
<if $image_attachment><img alt="$post[attachment_name]" src="attachment.php?id=$post[postid]" />
<else />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Attachment</td>
</tr>
<tr>
<td class="cellmain"><a href="attachment.php?id=$post[postid]">$post[attachment_name]</a> ($post[size] KB)</td>
</tr>
</table>
</if></if>
<if $showsig><br />
<br />
______________________________<br />
$post[signature]</if>
<if $post[editedby_date]><br />
<br />
<i><span class="small">Last edited by</span> <a class="linksmall" href="profile.php?id=$post[editedby_userid]">$post[editedby_username]</a> <span class="small">$post[editedby_date]</span></i></if></td>
</tr>
<tr><td class="$color" style="text-align:center; width: 175px; white-space: nowrap"><span class="small">Posted: $post[postdate]</span></td>
<td class="$color"><table width="100%"><tr><td><a href="thread.php?postid=$post[postid]#$post[postid]"><img title="Link to this post" alt="" src="$style[images]/link.gif" /></a><if $user[quick_reply]=="multi"><script type="text/javascript">
<!--
	document.write(' <a href="javascript://" onclick="setQuickQuote($post[postid]); return false;"><img title="Quick Quote this Message" alt="&nbsp;&quot;&nbsp;" src="$style[images]/quick_quote.gif" /></a>');
//-->
</script></if><if $post[userid]> <a href="profile.php?id=$post[userid]"><img alt="View profile for $post[username]" src="$style[images]/profile.gif" /></a></if><if $showpm> <a href="newpm.php?userid=$post[userid]"><img alt="Send $post[username] a private message" src="$style[images]/pm.gif" /></a></if><if $showemail> <a href="email.php?id=$post[userid]"><img alt="Send $post[username] an email" src="$style[images]/email.gif" /></a></if><if $post[website]> <a href="$post[website]" onclick="window.open(this.href,'_blank');return false;"><img alt="$post[website]" src="$style[images]/website.gif" /></a></if><if $showsearch> <a href="search.php?op=post&amp;type=post&amp;sort=desc&amp;userid=$post[userid]"><img alt="Search for posts made by $post[username]" src="$style[images]/search.gif" /></a></if></td><td style="text-align: right"><a href="reply.php?id=$thread[threadid]&amp;postid=$post[postid]"><img alt="Quote post" src="$style[images]/quote.gif" /></a> <a href="edit.php?id=$post[postid]"><img alt="Edit post" src="$style[images]/edit.gif" /></a>&nbsp;&nbsp;&nbsp;<a href="report.php?id=$post[postid]"><img alt="Report post to moderators" title="Report post to moderators" src="$style[images]/report.gif" /></a><a href="ip.php?op=post&amp;id=$post[postid]"><img alt="View IP Address" title="View IP Address" src="$style[images]/ip.gif" /></a></td></tr></table>
</if>
</td>
</tr>
</table>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1071792361";}s:15:"account_missing";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:141:"<include template="message_header" />
Please fill in all required fields before attempting to register.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"account_duplicate";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:153:"<include template="message_header" />
A user with the name you selected already exists. Please choose another name.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"register_account_password";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:185:"<include template="message_header" />
The passwords you specified do not match. Please make sure you have entered the same password in both spaces.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"register_account_redirect";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:163:"<include template="redirect_header" />
You have successfully registered! You are now being taken to your user control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"newthread_index";a:4:{s:8:"category";s:10:"New Thread";s:4:"body";s:7118:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_dialog.js"></script>
</if>
<form enctype="multipart/form-data" action="newthread.php" method="post">
<div><input name="op" type="hidden" value="dopost" />
<input name="id" type="hidden" value="$forum[forumid]" />
<input id="parsed_message" name="parsed_message" type="hidden" value="$parsedmessage" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <b>New Thread</b>
<br />
<br />
<if $preview_button>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Preview</td>
</tr>
<tr>
<td class="cellmain"><if $iconid><img alt="$preview_icon[name]" src="$preview_icon[image]" /> </if><b>$preview_subject</b><if ($preview_subject || $iconid)><br />
<br /></if>
$preview_message</td>
</tr>
</table><br />
</if>
</div>
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">New Thread in $forum[name]</td>
</tr>
<include template="form_header" />
<if !$user[userid]><tr>
<td><b>Name:</b><br />
<span class="small">Choose the name under which you want your post to appear.</span></td>
<td><input name="username" type="text" size="80" value="$user[name]" /></td>
</tr></if>
<tr>
<td><b>Subject:</b></td>
<td><input id="subject" name="subject" type="text" size="80" value="$preview_subject" /></td>
</tr>
$icons
<tr>
<td><b>Message:</b><br />
<span class="small">DP Code is <b><if $forum[dpcode]>en<else />dis</if>abled</b><br />
Images are <b><if $forum[img]>en<else />dis</if>abled</b><br />
Smilies are <b><if $forum[smilies]>en<else />dis</if>abled</b></span>
$smilie_box</td>
<td>
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" rows="20" cols="80">$message</textarea>
</td>
</tr>
<tr>
<td><b>Options:</b></td>
<td>
<if $preview_button>
<span class="small">
<if $group[html]><input name="html" value="1" type="checkbox"<if $html> checked="checked"</if> /> Allow HTML in this post<br /></if>
<if $forum[dpcode]><input name="url" type="checkbox" value="1"<if $url> checked="checked"</if> /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1"<if $dpcode> checked="checked"</if> /> Disable DP Code<br /></if>
<if $forum[smilies]><input name="smilies" type="checkbox" value="1"<if $smilies> checked="checked"</if> /> Disable Smilies<br /></if>
<if $user[userid]><input name="subscribe_email" type="checkbox" value="1"<if $subscribe_email> checked="checked"</if> /> Receive email updates to this thread<br /></if>
<if $group[customsignature]><input name="showsignature" type="checkbox" value="1"<if $showsignature> checked="checked"</if> /> Show signature<br /></if>
</span>
<if $perm[startpolls]><a name="start_poll"></a><input name="poll" type="checkbox" value="1"<if $poll> checked="checked"</if> /> <span class="small">Start poll, with</span> <input class="small" name="options" size="3" value="$options" /> <span class="small">options</span><br /></if>
<if $user[userid]><input name="subscribe" type="checkbox" value="1"<if $subscribe> checked="checked"</if> /> <span class="small">Subscribe to this thread</span></if></td>
</tr>
<if ($mod_close || $mod_sticky)><tr>
<td><b>Moderator Options:</b></td>
<td class="small"><if $mod_close><input name="do_close" type="checkbox" value="1"<if $do_close> checked="checked"</if> /> Close thread<br /></if>
<if $mod_sticky><input name="do_stick" type="checkbox" value="1"<if $do_stick> checked="checked"</if> /> Stick thread</if></td>
</tr></if>
<if $perm[postattachments]><tr>
<td style="white-space: nowrap"><b>Attachment:</b><br />
<span class="small"><b>You MUST reupload your attachment if you use the Post Preview function!</b><br />
<if (($config[attachment_width] && $config[attachment_height]) || $config[attachment_size])>Maximum size: </if><if ($config[attachment_width] && $config[attachment_height])><b>$config[attachment_width]x$config[attachment_height]</b><if $config[attachment_size]>, </if></if><if $config[attachment_size]><b>$config[attachment_size] KB</b></if></span></td>
<td><input name="attachment" type="file" size="60" /></td>
</tr></if>
<else />
<span class="small">
<if $group[html]><input name="html" value="1" type="checkbox" /> Allow HTML in this post<br /></if>
<if $forum[dpcode]><input name="url" type="checkbox" value="1" checked="checked" /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1" /> Disable DP Code<br /></if>
<if $forum[smilies]><input name="smilies" type="checkbox" value="1" /> Disable Smilies<br /></if>
<if $user[userid]><input name="subscribe_email" type="checkbox" value="1"<if $user[subscribe_email]> checked="checked"</if> /> Receive email updates to this thread<br /></if>
<if $group[customsignature]><input name="showsignature" type="checkbox" value="1"<if $user[usesignature]> checked="checked"</if> /> Show signature<br />
</if>
</span>
<if $perm[startpolls]><a name="start_poll"></a><input name="poll" type="checkbox" value="1"<if $preset_poll_options> checked="checked"</if> /> <span class="small">Start poll, with</span> <input class="small" name="options" size="3" value="$preset_poll_options" /> <span class="small">options</span><br /></if>
<if $user[userid]><input name="subscribe" type="checkbox" value="1"<if $user[subscribe]> checked="checked"</if> /> <span class="small">Subscribe to this thread</span></if></td>
</tr>
<if ($mod_close || $mod_sticky)><tr>
<td><b>Moderator Options:</b></td>
<td class="small"><if ($mod_close)><input name="do_close" type="checkbox" value="1" /> Close thread<br /></if>
<if ($mod_sticky)><input name="do_stick" type="checkbox" value="1" /> Stick thread<br /></if></td>
</tr></if>
<if $perm[postattachments]><tr>
<td style="white-space: nowrap"><b>Attachment:</b><br />
<span class="small"><if (($config[attachment_width] && $config[attachment_height]) || $config[attachment_size])>Maximum size: </if><if ($config[attachment_width] && $config[attachment_height])><b>$config[attachment_width]x$config[attachment_height]</b><if $config[attachment_size]>, </if></if><if $config[attachment_size]><b>$config[attachment_size] KB</b></if></span></td>
<td><input name="attachment" type="file" size="60" /></td>
</tr></if>
</if>
<tr>
<td class="center" colspan="2"><input type="submit" onclick="return thread_submit(this)" value="Post Thread" /> <input name="preview_button" type="submit" value="Preview Message" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script>
</if>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074829022";}s:18:"forumdisplay_forum";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:1883:"<tr>
<td class="$color" style="width: 18px"><div class="center"><img alt="<if $subforum[link]>Link to $subforum[link]" src="$style[images]/forumlink<else /><if $newposts>New posts" src="$style[images]/on<else />No new posts" src="$style[images]/off</if></if><if $locked>_locked</if>.gif" /></div></td>
<td class="$color"><a href="forum_display.php?id=$subforum[forumid]"><b>$subforum[name]</b></a><if $subforum[usercount]> <span class="small">($subforum[usercount] Users Browsing)</span></if><br /><span class="small">$subforum[description]<if $subsubforums><br /><b>Sub-forums:</b> $subsubforums</if></span></td>
<td class="$color"><div class="center"><if $subforum[link]>-<else />$subforum[posts]</if></div></td>
<td class="$color"><div class="center"><if $subforum[link]>-<else />$subforum[threads]</if></div></td>
<td class="$color" style="width:210px"><if $subforum[link]><div class="center">-</div><else /><if $subforum[lastpostdate]>
<table cellspacing="0" cellpadding="2" width="100%">
<tr>
<td style="width: 1%"><a href="thread.php?postid=$subforum[lastpostid]#post$subforum[lastpostid]"><img src="$style[images]/right.gif" alt="Jump to last Post" /></a></td>
<td><div class="small"><if $threadperm[viewthreads] && $config[lastpost_thread]><a class="linksmall" href="thread.php?id=$subforum[lastthreadid]" title="View Thread &quot;$subforum[threadfullname]&quot;"><b>$subforum[threadname]</b></a><br /></if>
$subforum[lastpostdate]<br />by <a class="linksmall" href="profile.php?id=$subforum[lastuserid]">$subforum[lastusername]</a>
</div></td>
<if $subforum[threadiconid] && $threadperm[viewthreads] && $config[lastpost_thread]><td style="width: 1%"><img alt="$subforum[icon_name]" src="$subforum[icon_image]" /></td></if>
</tr>
</table><else /><div class="center small">Never</div></if></if></td>
<if $config[show_moderators]><td class="$color">$moderators</td></if>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1090139275";}s:9:"moderator";a:4:{s:8:"category";s:0:"";s:4:"body";s:139:"<if $moderators><span class="small">,</span> </if><a class="linksmall" href="profile.php?id=$moderator[userid]">$moderator[parsed_name]</a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"newreply_index";a:4:{s:8:"category";s:9:"New Reply";s:4:"body";s:7628:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_dialog.js"></script>
</if>
<form enctype="multipart/form-data" action="reply.php" method="post">
<div><input name="op" type="hidden" value="dopost" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input id="parsed_message" name="parsed_message" type="hidden" value="$parsedmessage" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$id"><b>$thread[name]</b></a> <b>&gt; Reply to Thread</b>
<br />
<br />
<if $preview_button>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Preview</td>
</tr>
<tr>
<td class="cellmain"><if $iconid><img alt="$preview_icon[name]" src="$preview_icon[image]" /> </if><b>$preview_subject</b><if ($preview_subject || $iconid)><br />
<br /></if>
$preview_message</td>
</tr>
</table><br />
</if>
</div>
<div class="center">
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Reply to $thread[name]</td>
</tr>
<include template="form_header" />
<if !$user[userid]><tr>
<td><b>Name:</b><br />
<span class="small">Choose the name under which you want your post to appear.</span></td>
<td><input name="username" type="text" size="80" value="$user[name]" /></td>
</tr></if>
<tr>
<td><b>Subject:</b></td>
<td style="white-space: nowrap"><input name="subject" type="text" size="80"<if $preview_subject> value="$subject"</if><if $post[subject]> value="Re: $post[subject]"</if> /> <span class="small">(optional)</span></td>
</tr>
$icons
<tr>
<td><b>Message:</b><br />
<span class="small">DP Code is <b><if $forum[dpcode]>en<else />dis</if>abled</b><br />
Images are <b><if $forum[img]>en<else />dis</if>abled</b><br />
Smilies are <b><if $forum[smilies]>en<else />dis</if>abled</b></span>
$smilie_box</td>
<td>
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" rows="20" cols="80">$message</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script>
</if>
</td>
</tr>
<tr>
<td><b>Options:</b></td>
<td class="small">
<if $preview_button>
<if $group[html]><input name="html" value="1" type="checkbox"<if $html> checked="checked"</if> /> Allow HTML in this post<br /></if>
<if $forum[dpcode]><input name="url" type="checkbox" value="1"<if $url> checked="checked"</if> /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1"<if $dpcode> checked="checked"</if> /> Disable DP Code<br /></if>
<if $forum[smilies]><input name="smilies" type="checkbox" value="1"<if $smilies> checked="checked"</if> /> Disable Smilies<br /></if>
<if $user[userid]><input name="subscribe_email" type="checkbox" value="1"<if $subscribe_email> checked="checked"</if> /> Receive email updates to this thread<br /></if>
<if $group[customsignature]><input name="showsignature" type="checkbox" value="1"<if $showsignature> checked="checked"</if> /> Show signature<br /></if>
<if $user[userid]><input name="subscribe" type="checkbox" value="1"<if $subscribe> checked="checked"</if> /> Subscribe to this thread</if></td>
</tr>
<if ($mod_close || $mod_sticky)><tr>
<td><b>Moderator Options:</b></td>
<td class="small"><if (!$thread[closed] && $mod_close)><input name="do_close" type="checkbox" value="1"<if $do_close> checked="checked"</if> /> Close thread<br /></if>
<if ($thread[closed] && $mod_close)><input name="do_open" type="checkbox" value="1"<if $do_open> checked="checked"</if> /> Open thread<br /></if>
<if (!$thread[sticky] && $mod_sticky)><input name="do_stick" type="checkbox" value="1"<if $do_stick> checked="checked"</if> /> Stick thread<br /></if>
<if ($thread[sticky] && $mod_sticky)><input name="do_unstick" type="checkbox" value="1"<if $do_unstick> checked="checked"</if> /> Unstick thread<br /></if></td>
</tr></if>
<if $perm[postattachments]><tr>
<td style="white-space: nowrap"><b>Attachment:</b><br />
<span class="small"><b>You MUST reupload your attachment if you use the Post Preview function!</b><br />
<if (($config[attachment_width] && $config[attachment_height]) || $config[attachment_size])>Maximum size: </if><if ($config[attachment_width] && $config[attachment_height])><b>$config[attachment_width]x$config[attachment_height]</b><if $config[attachment_size]>, </if></if><if $config[attachment_size]><b>$config[attachment_size] KB</b></if></span></td>
<td><input name="attachment" type="file" size="60" /></td>
</tr></if>
<else />
<if $group[html]><input name="html" value="1" type="checkbox"<if $html> checked="checked"</if> /> Allow HTML in this post<br /></if>
<if $forum[dpcode]><input name="url" type="checkbox" value="1" checked="checked" /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1" /> Disable DP Code<br /></if>
<if $forum[smilies]><input name="smilies" type="checkbox" value="1" /> Disable Smilies<br /></if>
<if $user[userid]><input name="subscribe_email" type="checkbox" value="1"<if $user[subscribe_email]> checked="checked"</if> /> Receive email updates to this thread<br /></if>
<if $group[customsignature]><input name="showsignature" type="checkbox" value="1"<if $user[usesignature]> checked="checked"</if> /> Show signature<br /></if>
<if $user[userid]><input name="subscribe" type="checkbox" value="1"<if $user[subscribe]> checked="checked"</if> /> Subscribe to this thread</if></td>
</tr>
<if ($mod_close || $mod_sticky)><tr>
<td><b>Moderator Options:</b></td>
<td class="small"><if (!$thread[closed] && $mod_close)><input name="do_close" type="checkbox" value="1" /> Close thread<br /></if>
<if ($thread[closed] && $mod_close)><input name="do_open" type="checkbox" value="1" /> Open thread<br /></if>
<if (!$thread[sticky] && $mod_sticky)><input name="do_stick" type="checkbox" value="1" /> Stick thread<br /></if>
<if ($thread[sticky] && $mod_sticky)><input name="do_unstick" type="checkbox" value="1" /> Unstick thread<br /></if></td>
</tr></if>
<if $perm[postattachments]><tr>
<td style="white-space: nowrap"><b>Attachment:</b><br />
<span class="small"><if (($config[attachment_width] && $config[attachment_height]) || $config[attachment_size])>Maximum size: </if><if ($config[attachment_width] && $config[attachment_height])><b>$config[attachment_width]x$config[attachment_height]</b><if $config[attachment_size]>, </if></if><if $config[attachment_size]><b>$config[attachment_size] KB</b></if></span></td>
<td><input name="attachment" type="file" size="60" /></td>
</tr></if>
</if>
<tr>
<td class="center" colspan="2">
<input type="submit" value="Post Message" onclick="return reply_submit(this)" /> <input type="submit" name="preview_button" value="Preview Message" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form><br />
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="2">Last $config[posts_per_page] Posts</td>
</tr>
<tr>
<td class="tableheader"><span class="small">Username</span></td><td class="tableheader"><span class="small">Post</span></td>
</tr>
$lastposts
</table></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074829104";}s:13:"forumnav_link";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:120:" <a href="forum_display.php?id=$forumnav[forumid]"><b title="$forumnav[description]">$forumnav[name]</b></a> <b>&gt;</b>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"editpost_index";a:4:{s:8:"category";s:9:"Edit Post";s:4:"body";s:9343:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_dialog.js"></script>
</if>
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?postid=$post[postid]#$post[postid]"><b>$thread[name]</b></a> <b>&gt; Edit Post</b>
<br />
<br />
<if $preview_button>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Preview</td>
</tr>
<tr>
<td class="cellmain"><if $iconid><img alt="$preview_icon[name]" src="$preview_icon[image]" /> </if><b>$preview_subject</b><if ($preview_subject || $iconid)><br />
<br /></if>
$preview_message</td>
</tr>
</table><br />
</if>
<form enctype="multipart/form-data" action="edit.php" method="post" onsubmit="return <if $firstpost[postid]==$post[postid]>thread_submit();<else />reply_submit();</if>">
<div class="center">
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$post[postid]" />
<input name="page" type="hidden" value="$page" />
<input name="parsed_message" id="parsed_message" type="hidden" value="$parsedmessage" />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Editing $post[title]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Subject:</b></td>
<td><input id="subject" name="subject" type="text" size="80" value="$post[subject]" /> <span class="small">(optional)</span></td>
</tr>
$icons
<tr>
<td><b>Message:</b><br />
<span class="small">DP Code is <b><if $forum[dpcode]>en<else />dis</if>abled</b><br />
Images are <b><if $forum[img]>en<else />dis</if>abled</b><br />
Smilies are <b><if $forum[smilies]>en<else />dis</if>abled</b></span>
$smilie_box</td>
<td>
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" cols="80" rows="20">$message</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script>
</if>
</td>
</tr>
<tr>
<td><b>Options:</b></td>
<td>
<span class="small">
<if $preview_button>
<if $group[html]><input name="html" value="1" type="checkbox"<if $html> checked="checked"</if> /> Allow HTML in this post<br /></if>
<if $forum[dpcode]><input name="url" type="checkbox" value="1"<if $url> checked="checked"</if> /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1"<if $dpcode> checked="checked"</if> /> Disable DP Code<br /></if>
<if $forum[smilies]><input name="smilies" type="checkbox" value="1"<if $smilies> checked="checked"</if> /> Disable Smilies<br /></if>
<if $user[userid]><input name="subscribe_email" type="checkbox" value="1"<if $subscribe_email> checked="checked"</if> /> Receive email updates to this thread<br /></if>
<if $group[customsignature]><input name="showsignature" type="checkbox" value="1"<if $showsignature> checked="checked"</if> /> Show signature<br /></if>
</span>
<if $startpoll><a name="start_poll"></a><input name="poll" type="checkbox" value="1"<if $poll> checked="checked"</if> /> <span class="small">Start poll, with</span> <input class="small" name="options" size="3" value="$options" /> <span class="small">options</span><br /></if>
<if $user[userid]><input name="subscribe" type="checkbox" value="1"<if $subscribe> checked="checked"</if> /> <span class="small">Subscribe to this thread</span></if></td>
</tr>
<if ($mod_close || $mod_sticky)><tr>
<td><b>Moderator Options:</b></td>
<td class="small"><if (!$thread[closed] && $mod_close)><input name="do_close" type="checkbox" value="1"<if $do_close> checked="checked"</if> /> Close thread<br /></if>
<if ($thread[closed] && $mod_close)><input name="do_open" type="checkbox" value="1"<if $do_open> checked="checked"</if> /> Open thread<br /></if>
<if (!$thread[sticky] && $mod_sticky)><input name="do_stick" type="checkbox" value="1"<if $do_stick> checked="checked"</if> /> Stick thread<br /></if>
<if ($thread[sticky] && $mod_sticky)><input name="do_unstick" type="checkbox" value="1"<if $do_unstick> checked="checked"</if> /> Unstick thread<br /></if></td>
</tr></if>
<if $perm[postattachments]><tr>
<td style="white-space: nowrap"><b>Attachment:</b><br />
<span class="small"><b>You MUST reupload your attachment if you use the Post Preview function!</b><br />
<if (($config[attachment_width] && $config[attachment_height]) || $config[attachment_size])>Maximum size: </if><if ($config[attachment_width] && $config[attachment_height])><b>$config[attachment_width]x$config[attachment_height]</b><if $config[attachment_size]>, </if></if><if $config[attachment_size]><b>$config[attachment_size] KB</b></if></span></td>
<td><input name="attachment" type="file" size="60" /></td>
</tr></if>
<if $post[attachment]><tr>
<td><b>Attachment:</b></td>
<td><input name="delete_attachment" type="checkbox" value="1" /> <span class="small">Delete attachment:</span> <a class="linksmall" href="attachment.php?id=$post[postid]">$post[attachment_name]</a> <span class="small">($post[size] KB)</span></td>
</tr></if>
<else />
<if $group[html]><input name="html" value="1" type="checkbox"<if $post[html]> checked="checked"</if> /> Allow HTML in this post<br /></if>
<if $forum[dpcode]><input name="url" type="checkbox" value="1"<if $post[url]> checked="checked"</if> /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1"<if !$post[dpcode]> checked="checked"</if> /> Disable DP Code<br /></if>
<if $forum[smilies]><input name="smilies" type="checkbox" value="1"<if !$post[smilies]> checked="checked"</if> /> Disable Smilies<br /></if>
<if $user[userid]><input name="subscribe_email" type="checkbox" value="1"<if $is_subscribe_email_checked> checked="checked"</if> /> Receive email updates to this thread<br /></if>
<if $group[customsignature]><input name="showsignature" type="checkbox" value="1"<if $post[showsignature]> checked="checked"</if> /> Show signature<br /></if>
</span>
<if $startpoll><a name="start_poll"></a><input name="poll" type="checkbox" value="1"<if $preset_poll_options> checked="checked"</if> /> <span class="small">Start poll, with</span> <input class="small" name="options" size="3" value="$preset_poll_options" /> <span class="small">options</span><br /></if>
<if $user[userid]><input name="subscribe" type="checkbox" value="1"<if $is_subscribe_checked> checked="checked"</if> /> <span class="small">Subscribe to this thread</span></if></td>
</tr>
<if ($mod_close || $mod_sticky)><tr>
<td><b>Moderator Options:</b></td>
<td class="small"><if (!$thread[closed] && $mod_close)><input name="do_close" type="checkbox" value="1" /> Close thread<br /></if>
<if ($thread[closed] && $mod_close)><input name="do_open" type="checkbox" value="1" /> Open thread<br /></if>
<if (!$thread[sticky] && $mod_sticky)><input name="do_stick" type="checkbox" value="1" /> Stick thread<br /></if>
<if ($thread[sticky] && $mod_sticky)><input name="do_unstick" type="checkbox" value="1" /> Unstick thread<br /></if></td>
</tr></if>
<if $canattach><tr>
<td style="white-space: nowrap"><b>Attachment:</b><br />
<span class="small"><if (($config[attachment_width] && $config[attachment_height]) || $config[attachment_size])>Maximum size: </if><if ($config[attachment_width] && $config[attachment_height])><b>$config[attachment_width]x$config[attachment_height]</b><if $config[attachment_size]>, </if></if><if $config[attachment_size]><b>$config[attachment_size] KB</b></if></span></td>
<td><input name="attachment" type="file" size="60" /></td>
</tr></if>
<if $post[attachment]><tr>
<td><b>Attachment:</b></td>
<td><input name="delete_attachment" type="checkbox" value="1" /> <span class="small">Delete attachment:</span> <a class="linksmall" href="attachment.php?id=$post[postid]">$post[attachment_name]</a> <span class="small">($post[size] KB)</span></td>
</tr></if>
</if>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Post" /> <input name="preview_button" type="submit" value="Preview Message" /></td>
</tr>
<include template="form_footer" />
</table><if $deletepost><br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<include template="form_header" />
<tr>
<td><b>Delete Post</b><br />
<span class="small">If you want to delete this post, please click the Delete Post button.</span><br />
<br />
<div class="center"><input name="delete" type="submit" value="Delete Post" /></div></td>
</tr>
<include template="form_footer" />
</table></if><if $deletethread><br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<include template="form_header" />
<tr>
<td><b>Delete Thread</b><br />
<span class="small">If you want to delete this thread, please click the Delete Thread button.</span><br />
<br />
<div class="center"><input name="delete" type="submit" value="Delete Thread" /></div></td>
</tr>
<include template="form_footer" />
</table></if></div></form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074828796";}s:12:"invalid_post";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:110:"<include template="message_header" />
The specified post does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:11:"icon_column";a:4:{s:8:"category";s:5:"Icons";s:4:"body";s:166:"<td><input name="iconid" type="radio" value="$icon[iconid]"<if $checked> checked="checked"</if> /> <img alt="$icon[name]" src="$icon[image]" />&nbsp;&nbsp;&nbsp;</td>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:8:"ip_index";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:903:"<include template="message_header" />
<div class="center"><table cellpadding="0" cellspacing="0">
<tr>
<td><table cellpadding="0" cellspacing="0">
<include template="form_header" />
<tr>
<td><b>Username:</b></td>
<td><a href="<if $access=="admin">$admincp_dir/users.php?op=doipcheck&amp;userid=$post[userid]</if><if $access=="mod">$modcp_dir/users.php?op=doipcheck&amp;userid=$post[userid]</if><if !$access>profile.php?id=$post[userid]</if>">$post[username]</a></td>
</tr>
<tr>
<td><b>IP address:</b></td>
<td><if $access=="admin"><a href="$admincp_dir/users.php?op=doipcheck&amp;ipaddress=$post[ip]"></if><if $access=="mod"><a href="$modcp_dir/users.php?op=doipcheck&amp;ipaddress=$post[ip]"></if>$post[ip]<if $access></a></if></td>
</tr>
<tr>
<td><b>Hostname:</b></td>
<td>$hostname</td>
</tr>
<include template="form_footer" />
</table></td>
</tr>
</table></div>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074573970";}s:16:"option_indention";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:30:"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"forum_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:106:"<option value="$forum_result[forumid]"<if $selected> selected="selected"</if>>$forum_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:6:"smilie";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:100:"<img <if $add_tag>rel="smilie[$smilie[tag]]" </if>alt="$smilie[name]" src="$smilie[parsed_image]" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062730720";}s:9:"new_posts";a:4:{s:8:"category";s:0:"";s:4:"body";s:77:"<img alt="New posts" src="$style[images]/<if $doticon>dot_</if>unread.gif" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:12:"no_new_posts";a:4:{s:8:"category";s:0:"";s:4:"body";s:78:"<img alt="No new posts" src="$style[images]/<if $doticon>dot_</if>read.gif" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:13:"new_posts_hot";a:4:{s:8:"category";s:0:"";s:4:"body";s:87:"<img alt="New posts (hot)" src="$style[images]/<if $doticon>dot_</if>unread_hot.gif" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:16:"no_new_posts_hot";a:4:{s:8:"category";s:0:"";s:4:"body";s:88:"<img alt="No new posts (hot)" src="$style[images]/<if $doticon>dot_</if>read_hot.gif" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:9:"hot_icons";a:4:{s:8:"category";s:0:"";s:4:"body";s:628:"<tr>
<td class="right"><span class="small">New posts (hot):</span></td><td><img alt="New posts (hot)" src="$style[images]/unread_hot.gif" /></td>
<td class="right"><span class="small">No new posts (hot):</span></td><td><img alt="No new posts (hot)" src="$style[images]/read_hot.gif" /></td>
<td class="right"><span class="small">New posts (hot, closed):</span></td><td><img alt="New posts (hot, closed)" src="$style[images]/unread_closed_hot.gif" /></td>
<td class="right"><span class="small">No new posts (hot, closed):</span></td><td><img alt="No new posts (hot, closed)" src="$style[images]/read_closed_hot.gif" /></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:27:"forumdisplay_multipage_link";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:99:"<a class="linksmall" href="thread.php?id=$thread[threadid]&amp;page=$thread_page">$thread_page</a> ";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:27:"forumdisplay_multipage_last";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:120:"... <a class="linksmall" href="thread.php?id=$thread[threadid]&amp;page=$numpages#$thread[lastpostid]">Last &raquo;</a> ";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:17:"editprofile_index";a:4:{s:8:"category";s:12:"Edit Profile";s:4:"body";s:3048:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_dialog.js"></script>
</if>
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Edit Profile</b><br />
<br />
<form action="edit_profile.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doedit" />
<input id="parsed_signature" type="hidden" value="$parsedmessage" />
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Edit Profile</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Email address:</b></td><td><input name="email" type="text" size="60" value="$user[email]" /></td>
</tr>
<tr>
<td colspan="2" class="heading">Optional Information</td>
</tr>
<if $group[customtitle]>
<tr>
<td><b>Custom Title:</b></td><td><input name="title" type="text" size="60" value="$user[title]" maxlength="$config[max_usertitlelen]" /></td>
</tr>
</if>
<tr>
<td><b>Website:</b></td><td><input name="website" type="text" size="60" value="<if $user[website]>$user[website]<else />http://</if>" /></td>
</tr>
<tr>
<td><b>Location:</b><br />
<span class="small">Where you live</span></td><td><input name="location" type="text" size="60" value="$user[location]" /></td>
</tr>
$customfields
<tr>
<td colspan="2" class="heading">Instant Messengers</td>
</tr>
<tr>
<td><b>AOL Instant Messenger:</b></td><td><input name="aol" type="text" size="60" value="$user[aol]" /></td>
</tr>
<tr>
<td><b>ICQ:</b></td><td><input name="icq" type="text" size="60" value="$user[icq]" /></td>
</tr>
<tr>
<td><b>MSN Messenger:</b></td><td><input name="msn" type="text" size="60" value="$user[msn]" /></td>
</tr>
<tr>
<td><b>Yahoo Instant Messenger:</b></td><td><input name="yahoo" type="text" size="60" value="$user[yahoo]" /></td>
</tr>
<if $group[customsignature]>
<tr>
<td><b>Signature:</b><br />
<span class="small">DP Code is <b><if $config[signature_dpcode]>en<else />dis</if>abled</b><br />
Images are <b><if $config[signature_img]>en<else />dis</if>abled</b><br />
Smilies are <b><if $config[signature_smilies]>en<else />dis</if>abled</b></span></td>
<td>
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="signatureDiv"><iframe id="signatureIframe"></iframe></div>');
//-->
</script>
<textarea name="signature" id="signature" style="width: 100%" rows="5" cols="40">$message</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('signature');
-->
</script>
</td>
</tr><else /></td>
</tr>
</if></if>
<tr>
<td colspan="2" class="center"><input type="submit" value="Update Profile" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form><br /><div class="center"><a href="#top">Back to Top</a> - <a href="user.php">Back to User Control Panel</a></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073882340";}s:21:"edit_profile_redirect";a:4:{s:8:"category";s:12:"Edit Profile";s:4:"body";s:161:"<include template="redirect_header" />
Your profile has been edited. You are now being returned to the user control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"edit_options_redirect";a:4:{s:8:"category";s:12:"Edit Options";s:4:"body";s:162:"<include template="redirect_header" />
Your options have been edited. You are now being returned to the user control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"editoptions_index";a:4:{s:8:"category";s:12:"Edit Options";s:4:"body";s:14003:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Edit Options</b><br />
<br />
<form enctype="multipart/form-data" action="edit_options.php" method="post">
<div class="center"><input name="MAX_FILE_SIZE" type="hidden" value="16777216" />
<input name="op" type="hidden" value="doedit" />
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Edit Options</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Hide email address:</b><br />
<span class="small">This option enables you to hide your email address from users on the site.</span></td><td>Yes:<input name="hide_email" type="radio" value="1"<if $user[hide_email]> checked="checked"</if> /> No:<input name="hide_email" type="radio" value="0"<if !$user[hide_email]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Invisible on Who's Online list:</b><br />
<span class="small">This option will prevent you from being displayed on the Who's Online list.</span></td><td>Yes:<input name="invisible" type="radio" value="1"<if $user[invisible]> checked="checked"</if> /> No:<input name="invisible" type="radio" value="0"<if !$user[invisible]> checked="checked"</if> /></td>
</tr>
<if $config[markread]><tr>
<td><b>Mark threads as read after reading them:</b><br />
<span class="small">When this option is enabled, threads will be marked as read when you read them, instead of requiring you to leave the forum for a set amount of time first.</span></td><td>Yes:<input name="markread" type="radio" value="1"<if $user[markread]> checked="checked"</if> /> No:<input name="markread" type="radio" value="0"<if !$user[markread]> checked="checked"</if> /></td>
</tr></if>
<tr>
<td><b>Notify when a new private message is received:</b><br />
<span class="small">Enable this option if you wish to receive an email when you receive a private message.</span></td><td colspan="2">Yes:<input name="notify_pm" type="radio" value="1"<if $user[notify_pm]> checked="checked"</if> /> No:<input name="notify_pm" type="radio" value="0"<if !$user[notify_pm]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Quick reply:</b><br />
<span class="small">Enable quick reply to place a small reply box at the end of each thread.</span></td>
<td colspan="2">Multiline:<input name="quick_reply" type="radio" value="multi"<if $user[quick_reply]=="multi"> checked="checked"</if> /> Single line:<input name="quick_reply" type="radio" value="single"<if $user[quick_reply]=="single"> checked="checked"</if> /> None:<input name="quick_reply" type="radio" value="none"<if $user[quick_reply]=="none"> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Receive email notifications for threads by default:</b><br />
<span class="small">Enable this if you wish to receive email notification of new posts in threads in which you have posted, by default. This can also be enabled and disabled on an individual thread basis when posting.</span></td><td>Yes:<input name="subscribe_email" type="radio" value="1"<if $user[subscribe_email]> checked="checked"</if> /> No:<input name="subscribe_email" type="radio" value="0"<if !$user[subscribe_email]> checked="checked"</if>/></td>
</tr>
<tr>
<td><b>Receive mail from the administrators:</b><br /><span class="small">The administrators may wish to send out automated mailings to certain groups of members from time to time. If you wish not to receive these mailings, please set this to <b>No</b>.</span></td><td>Yes:<input name="massmail" type="radio" value="1"<if $user[massmail]> checked="checked"</if> /> No:<input name="massmail" type="radio" value="0"<if !$user[massmail]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show avatars:</b><br />
<span class="small">Avatars are the small pictures that are shown under the names of some members. You can choose not to display them with this option.</span></td><td>Yes:<input name="show_avatars" type="radio" value="1"<if $user[show_avatars]> checked="checked"</if> /> No:<input name="show_avatars" type="radio" value="0"<if !$user[show_avatars]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show images:</b><br />
<span class="small">If you are on a slow internet connection, you may elect to show links to images, instead of actually displaying images inside posts.</span></td><td>Yes:<input name="img" type="radio" value="1"<if $user[img]> checked="checked"</if> /> No:<input name="img" type="radio" value="0"<if !$user[img]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show popup box when a new private message is received:</b><br />
<span class="small">This will display a popup box when you receive a new private message.</span></td><td>Yes:<input name="pm_popup" type="radio" value="1"<if $user[pm_popup]> checked="checked"</if> /> No:<input name="pm_popup" type="radio" value="0"<if !$user[pm_popup]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Show signatures:</b><br />
<span class="small">You may turn the display of signatures under posts on or off with this option.</span></td><td>Yes:<input name="displaysignatures" type="radio" value="1"<if $user[displaysignatures]> checked="checked"</if> /> No:<input name="displaysignatures" type="radio" value="0"<if !$user[displaysignatures]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Subscribe to threads by default:</b><br />
<span class="small">With this option enabled, you will automatically subscribe to threads in which you post. Subscribing to threads causes them to be shown in your user control panel when new posts are made to the threads. This can also be enabled or disabled for each thread while posting.</span></td><td>Yes:<input name="subscribe" type="radio" value="1"<if $user[subscribe]> checked="checked"</if> /> No:<input name="subscribe" type="radio" value="0"<if !$user[subscribe]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use private messaging:</b><br />
<span class="small">Enables/disables the private messaging system, which allows you to talk privately with other forum members.</span></td><td>Yes:<input name="pm" type="radio" value="1"<if $user[pm]> checked="checked"</if> /> No:<input name="pm" type="radio" value="0"<if !$user[pm]> checked="checked"</if> /></td>
</tr>
<tr>
<td><b>Use signature in posts by default:</b><br />
<span class="small">This option allows you to decide whether the <b>Show signature</b> box is checked by default when posting.</span></td><td>Yes:<input name="usesignature" type="radio" value="1"<if $user[usesignature]> checked="checked"</if> /> No:<input name="usesignature" type="radio" value="0"<if !$user[usesignature]> checked="checked"</if> /></td>
</tr>
<if $config[use_wysiwyg]>
<tr>
<td><b>Use WYSIWYG for posting:</b><br />
<span class="small">This allows you to see the formatting in your post as you make the post, and allows you to use friendly toolbar controls to format text. Internet Explorer 6.0 or higher for Windows or Mozilla 1.3 or higher across any platform is required.</span></td><td>Yes:<input name="use_wysiwyg" type="radio" value="1"<if $user[use_wysiwyg]> checked="checked"</if> /> No:<input name="use_wysiwyg" type="radio" value="0"<if !$user[use_wysiwyg]> checked="checked"</if> /></td>
</tr>
</if>
<tr>
<td><b>Style:</b><br />
<span class="small">Choose the appearance you wish to have for the site.</span></td><td><select name="stylesetid">$stylesets</select></td>
</tr>
<tr>
<td><b>Time zone:</b><br />
<span class="small">Choose the method you would like to use to determine your timezone. Note that automatic timezone detection requires Javascript to be enabled.</span></td><td>
<span class="small"><input type="radio" name="auto_time_zone" value="1"<if $user[auto_time_zone]> checked="checked"</if> /> Automatically Detect Your Timezone<br />
<input type="radio" name="auto_time_zone" value="0"<if !$user[auto_time_zone]> checked="checked"</if> /> Use the following Settings:<script type="text/javascript">
<!--
	function detectTimeSettings()
	{
		getElement('time_zone_dst').checked = false;
		getElement('southern_hemisphere').checked = false;
		if (dst==1)
			getElement('time_zone_dst').checked = true;
		if (southernHemisphere==1)
		{
			getElement('southern_hemisphere').checked = true;
			userDetectedTimezone = Math.round((clientDate.getTimezoneOffset() - (clientDate.getTimezoneOffset() + dst1)) / -60);
		}
		else
			userDetectedTimezone = Math.round((clientDate.getTimezoneOffset() - (clientDate.getTimezoneOffset() - dst1)) / -60);
		if (userDetectedTimezone==0) elementName = 'gmt00';
		else if (userDetectedTimezone<0) elementName = 'neg' + (userDetectedTimezone * -1);
		else elementName = 'pos' + userDetectedTimezone;
		elementName = 'tz' + elementName;
		if (getElement(elementName))
			getElement(elementName).selected = true;
	}
	document.write(' (<a href="javascript:detectTimeSettings()" class="linksmall">Detect Settings</a>)');
//-->
</script><br /><br /></span><div style="margin-left:35px">
<select name="time_zone"><option id="tzneg12" value="-12"<if $user[time_zone]=="-12"> selected="selected"</if>>(GMT-12:00) International Date Line West</option><option id="tzneg11" value="-11"<if $user[time_zone]=="-11"> selected="selected"</if>>(GMT-11:00) Midway Island, Samoa</option><option id="tzneg10" value="-10"<if $user[time_zone]=="-10"> selected="selected"</if>>(GMT-10:00) Hawaii</option><option id="tzneg9" value="-9"<if $user[time_zone]=="-9"> selected="selected"</if>>(GMT-9:00) Alaska</option><option id="tzneg8" value="-8"<if $user[time_zone]=="-8"> selected="selected"</if>>(GMT-8:00) Pacific Time (US &amp; Canada); Tijuana</option><option id="tzneg7" value="-7"<if $user[time_zone]=="-7"> selected="selected"</if>>(GMT-7:00) Mountain Time (US &amp; Canada)</option><option id="tzneg6" value="-6"<if $user[time_zone]=="-6"> selected="selected"</if>>(GMT-6:00) Central Time (US &amp; Canada)</option><option id="tzneg5" value="-5"<if $user[time_zone]=="-5"> selected="selected"</if>>(GMT-5:00) Eastern Time (US &amp; Canada)</option><option id="tzneg4" value="-4"<if $user[time_zone]=="-4"> selected="selected"</if>>(GMT-4:00) Atlantic Time (Canada)</option><option id="tzneg3" value="-3"<if $user[time_zone]=="-3"> selected="selected"</if>>(GMT-3:00) Greenland</option><option id="tzneg2" value="-2"<if $user[time_zone]=="-2"> selected="selected"</if>>(GMT-2:00) Mid-Atlantic</option><option id="tzneg1" value="-1"<if $user[time_zone]=="-1"> selected="selected"</if>>(GMT-1:00) Cape Verde Is.</option><option id="tzgmt00" value="0"<if !$user[time_zone]> selected="selected"</if>>(GMT) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option><option id="tzpos1" value="1"<if $user[time_zone]=="1"> selected="selected"</if>>(GMT+1:00) Brussels, Copenhagen, Madrid, Paris</option><option id="tzpos2" value="2"<if $user[time_zone]=="2"> selected="selected"</if>>(GMT+2:00) Cairo</option><option id="tzpos3" value="3"<if $user[time_zone]=="3"> selected="selected"</if>>(GMT+3:00) Kuwait, Riyadh</option><option id="tzpos4" value="4"<if $user[time_zone]=="4"> selected="selected"</if>>(GMT+4:00) Baku, Tbilisi, Yerevan</option><option id="tzpos5" value="5"<if $user[time_zone]=="5"> selected="selected"</if>>(GMT+5:00) Islamabad, Karachi, Tashkent</option><option id="tzpos6" value="6"<if $user[time_zone]=="6"> selected="selected"</if>>(GMT+6:00) Astana, Dhaka</option><option id="tzpos7" value="7"<if $user[time_zone]=="7"> selected="selected"</if>>(GMT+7:00) Bangkok, Hanoi, Jakarta</option><option id="tzpos8" value="8"<if $user[time_zone]=="8"> selected="selected"</if>>(GMT+8:00) Beijing, Chongqing, Hong Kong, Urumqi</option><option id="tzpos9" value="9"<if $user[time_zone]=="9"> selected="selected"</if>>(GMT+9:00) Osaka, Sapporo, Tokyo</option><option id="tzpos10" value="10"<if $user[time_zone]=="10"> selected="selected"</if>>(GMT+10:00) Canberra, Melbourne, Sydney</option><option id="tzpos11" value="11"<if $user[time_zone]=="11"> selected="selected"</if>>(GMT+11:00) Magadan, Solomon Is., New Caledonia</option><option id="tzpos12" value="12"<if $user[time_zone]=="12"> selected="selected"</if>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option></select><br /><span class="small"><input type="checkbox" value="1" name="time_zone_dst" id="time_zone_dst"<if $user[time_zone_dst]> checked="checked"</if> /> I am affected by Daylight Savings Time<br /><input type="checkbox" value="1" name="southern_hemisphere" id="southern_hemisphere"<if $user[southern_hemisphere]> checked="checked"</if> /> I live in the southern hemisphere</span>
</div></td>
</tr>
<tr>
<td><b>Mark threads as read after being inactive:</b><br />
<span class="small">If you would like for all threads to be marked as read after a certain period of inactivity, put this amount of time here in minutes. Otherwise, type <b>0</b> (zero).</span></td><td><input name="markread_time" type="text" size="60" value="$user[markread_time]" /></td>
</tr>
<if $group[customavatar]>
<tr>
<td colspan="2" class="heading">Avatar</td>
</tr>
<tr>
<td><b>Use an avatar:</b><br />
<span class="small">If you wish to have an image displayed under your name in posts, enable this option.</span></td><td>Yes:<input name="useavatar" type="radio" value="1" checked="checked" /> No:<input name="useavatar" type="radio" value="0" /></td>
</tr>
</if>
<if $user[parsed_avatar]>
<tr>
<td><b>Current avatar:</b><br />
<span class="small">This is your current avatar.</span></td><td><img alt="Your avatar" src="$user[parsed_avatar]" /></td>
</tr>
</if>
<if $group[customavatar]>
<tr>
<td><b>Upload an avatar:</b><br />
<span class="small">Upload your avatar here. Maximum size is <b>$config[avatar_width]x$config[avatar_height], $config[avatar_size] KB</b>.</span></td><td><input name="image" type="file" size="46" /></td>
</tr>
</if>
<tr>
<td colspan="2" class="center"><input type="submit" value="Update Options" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form><br /><div class="center"><a href="#top">Back to Top</a> - <a href="user.php">Back to User Control Panel</a></div>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1077772144";}s:17:"password_redirect";a:4:{s:8:"category";s:15:"Change Password";s:4:"body";s:171:"<include template="redirect_header" />
Your password has been changed. Please remember to use your new password next time you login.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"password_index";a:4:{s:8:"category";s:15:"Change Password";s:4:"body";s:1005:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Change Password</b><br />
<br />
<form action="change_password.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doedit" />
<table class="tableline" cellpadding="$style[cellpadding]" cellspacing="$style[cellspacing]">
<tr>
<td class="tableheader">Change Password</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Old password:</b><br />
<a class="linksmall" href="user.php?op=remind">Forgot your password?</a></td><td><input name="old_password" type="password" size="60" /></td>
</tr>
<tr>
<td><b>New password:</b></td><td><input name="password" type="password" size="60" /></td>
</tr>
<tr>
<td><b>Confirm new password:</b></td><td><input name="password_confirm" type="password" size="60" /></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Change Password" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073769060";}s:20:"edit_profile_missing";a:4:{s:8:"category";s:12:"Edit Profile";s:4:"body";s:110:"<include template="message_header" />
You must specify an email address.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"password_password";a:4:{s:8:"category";s:15:"Change Password";s:4:"body";s:113:"<include template="message_header" />
The specified passwords do not match.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"password_missing";a:4:{s:8:"category";s:15:"Change Password";s:4:"body";s:156:"<include template="message_header" />
You must enter your old password, a new password, and confirm your new password.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"password_denied";a:4:{s:8:"category";s:15:"Change Password";s:4:"body";s:138:"<include template="message_header" />
The old password entered does not match your current password.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"memberlist_member";a:4:{s:8:"category";s:11:"Member List";s:4:"body";s:1088:"<tr><td class="$color"><a href="profile.php?id=$user_result[userid]">$user_result[parsed_name]</a></td><td class="$color"><if $showpm><div class="center"><a href="newpm.php?userid=$user_result[userid]"><img alt="Send $user_result[name] a private message" src="$style[images]/pm.gif" /></a></div></if></td><td class="$color"><if $showemail><div class="center"><a href="email.php?id=$user_result[userid]"><img alt="Send $user_result[name] an email" src="$style[images]/email.gif" /></a></div></if></td><td class="$color"><if $user_result[website]><div class="center"><a href="$user_result[website]" onclick="window.open(this.href,'_blank');return false;"><img alt="$user_result[website]" src="$style[images]/website.gif" /></a></div></if></td><td class="$color"><if $showsearch><div class="center"><a href="search.php?op=post&amp;type=post&amp;sort=desc&amp;userid=$user_result[userid]"><img alt="Search for posts made by $user_result[name]" src="$style[images]/search.gif" /></a></div></if></td><td class="$color">$user_result[joindate]</td><td class="$color">$user_result[posts]</td></tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1069545138";}s:16:"memberlist_index";a:4:{s:8:"category";s:11:"Member List";s:4:"body";s:9794:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt; Member List</b><br />
<br />
<br />
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="0">
<include template="form_header" />
<tr>
<td><if !$letter><b>[All]</b><else /><a href="members.php?sort=$sort&amp;order=$order">All</a></if></td><td style="white-space: nowrap"><if $letter=="1"><b>[0-9]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=1">0-9</a></if></td><td class="cellmain"><if $letter=="a"><b>[A]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=a">A</a></if></td><td><if $letter=="b"><b>[B]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=b">B</a></if></td><td><if $letter=="c"><b>[C]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=c">C</a></if></td><td><if $letter=="d"><b>[D]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=d">D</a></if></td><td><if $letter=="e"><b>[E]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=e">E</a></if></td><td><if $letter=="f"><b>[F]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=f">F</a></if></td><td><if $letter=="g"><b>[G]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=g">G</a></if></td><td><if $letter=="h"><b>[H]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=h">H</a></if></td><td><if $letter=="i"><b>[I]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=i">I</a></if></td><td><if $letter=="j"><b>[J]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=j">J</a></if></td><td><if $letter=="k"><b>[K]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=k">K</a></if></td><td><if $letter=="l"><b>[L]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=l">L</a></if></td><td><if $letter=="m"><b>[M]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=m">M</a></if></td><td><if $letter=="n"><b>[N]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=n">N</a></if></td><td><if $letter=="o"><b>[O]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=o">O</a></if></td><td><if $letter=="p"><b>[P]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=p">P</a></if></td><td><if $letter=="q"><b>[Q]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=q">Q</a></if></td><td><if $letter=="r"><b>[R]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=r">R</a></if></td><td><if $letter=="s"><b>[S]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=s">S</a></if></td><td><if $letter=="t"><b>[T]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=t">T</a></if></td><td><if $letter=="u"><b>[U]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=u">U</a></if></td><td><if $letter=="v"><b>[V]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=v">V</a></if></td><td><if $letter=="w"><b>[W]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=w">W</a></if></td><td><if $letter=="x"><b>[X]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=x">X</a></if></td><td><if $letter=="y"><b>[Y]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=y">Y</a></if></td><td><if $letter=="z"><b>[Z]</b><else /><a href="members.php?sort=$sort&amp;order=$order&amp;letter=z">Z</a></if></td>
</tr>
<include template="form_footer" />
</table></div><br />
<if ($memberlist_pagenav || $group[search])>
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<if $memberlist_pagenav><td class="cellmain">$memberlist_pagenav</td></if>
<if $group[search]><td class="cellmain right"><form style="margin: 0" action="members.php" method="post">
<div><input name="sort" type="hidden" value="$sort" />
<input name="order" type="hidden" value="$order" />
<input name="minposts" type="hidden" value="0" />
<input name="maxposts" type="hidden" value="429496729" />
<input name="search" type="hidden" value="1" />
<span class="small"><b>Search for user:</b></span> <input class="small" name="name" type="text" size="20" />&nbsp;<input class="small" type="submit" value="Go" /><br />
<a class="linksmall" href="search.php#users"><b>Advanced search</b></a></div></form></td></if>
</tr>
</table>
</td>
</tr>
</table><br />
</if>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr><td class="tableheader"><span class="small">Username</span> <a href="members.php?order=name&amp;sort=asc&amp;page=$page&amp;name=$name&amp;email=$_REQUEST[email]&amp;aol=$_REQUEST[aol]&amp;icq=$_REQUEST[icq]&amp;msn=$_REQUEST[msn]&amp;yahoo=$_REQUEST[yahoo]&amp;minposts=$minposts&amp;maxposts=$maxposts&amp;title=$_REQUEST[title]&amp;minjoin=$minjoin&amp;maxjoin=$maxjoin&amp;signature=$_REQUEST[signature]&amp;location=$_REQUEST[location]&amp;website=$_REQUEST[website]&amp;fields=$fields&amp;letter=$letter"><img alt="Sort by username in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="members.php?order=name&amp;sort=desc&amp;page=$page&amp;name=$name&amp;email=$_REQUEST[email]&amp;aol=$_REQUEST[aol]&amp;icq=$_REQUEST[icq]&amp;msn=$_REQUEST[msn]&amp;yahoo=$_REQUEST[yahoo]&amp;minposts=$minposts&amp;maxposts=$maxposts&amp;title=$_REQUEST[title]&amp;minjoin=$minjoin&amp;maxjoin=$maxjoin&amp;signature=$_REQUEST[signature]&amp;location=$_REQUEST[location]&amp;website=$_REQUEST[website]&amp;fields=$fields&amp;letter=$letter"><img alt="Sort by username in descending order" src="$style[images]/down.gif" style="vertical-align: middle" /></a></td><td class="tableheader"><span class="small">Private Message</span></td><td class="tableheader"><span class="small">Email</span></td><td class="tableheader"><span class="small">Website</span></td><td class="tableheader"><span class="small">Search</span></td><td class="tableheader"><span class="small">Join Date</span> <a href="members.php?order=joindate&amp;sort=asc&amp;page=$page&amp;name=$name&amp;email=$_REQUEST[email]&amp;aol=$_REQUEST[aol]&amp;icq=$_REQUEST[icq]&amp;msn=$_REQUEST[msn]&amp;yahoo=$_REQUEST[yahoo]&amp;minposts=$minposts&amp;maxposts=$maxposts&amp;title=$_REQUEST[title]&amp;minjoin=$minjoin&amp;maxjoin=$maxjoin&amp;signature=$_REQUEST[signature]&amp;location=$_REQUEST[location]&amp;website=$_REQUEST[website]&amp;fields=$fields&amp;letter=$letter"><img alt="Sort by join date in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="members.php?order=joindate&amp;sort=desc&amp;page=$page&amp;name=$name&amp;email=$_REQUEST[email]&amp;aol=$_REQUEST[aol]&amp;icq=$_REQUEST[icq]&amp;msn=$_REQUEST[msn]&amp;yahoo=$_REQUEST[yahoo]&amp;minposts=$minposts&amp;maxposts=$maxposts&amp;title=$_REQUEST[title]&amp;minjoin=$minjoin&amp;maxjoin=$maxjoin&amp;signature=$_REQUEST[signature]&amp;location=$_REQUEST[location]&amp;website=$_REQUEST[website]&amp;fields=$fields&amp;letter=$letter"><img alt="Sort by join date in descending order" src="$style[images]/down.gif" style="vertical-align: middle" /></a></td><td class="tableheader"><span class="small">Posts</span> <a href="members.php?order=posts&amp;sort=asc&amp;page=$page&amp;name=$name&amp;email=$_REQUEST[email]&amp;aol=$_REQUEST[aol]&amp;icq=$_REQUEST[icq]&amp;msn=$_REQUEST[msn]&amp;yahoo=$_REQUEST[yahoo]&amp;minposts=$minposts&amp;maxposts=$maxposts&amp;title=$_REQUEST[title]&amp;minjoin=$minjoin&amp;maxjoin=$maxjoin&amp;signature=$_REQUEST[signature]&amp;location=$_REQUEST[location]&amp;website=$_REQUEST[website]&amp;fields=$fields&amp;letter=$letter"><img alt="Sort by post count in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="members.php?order=posts&amp;sort=desc&amp;page=$page&amp;name=$name&amp;email=$_REQUEST[email]&amp;aol=$_REQUEST[aol]&amp;icq=$_REQUEST[icq]&amp;msn=$_REQUEST[msn]&amp;yahoo=$_REQUEST[yahoo]&amp;minposts=$minposts&amp;maxposts=$maxposts&amp;title=$_REQUEST[title]&amp;minjoin=$minjoin&amp;maxjoin=$maxjoin&amp;signature=$_REQUEST[signature]&amp;location=$_REQUEST[location]&amp;website=$_REQUEST[website]&amp;fields=$fields&amp;letter=$letter"><img alt="Sort by post count in descending order" src="$style[images]/down.gif"style="vertical-align: middle"  /></a></td></tr>
$members
</table>
<if ($memberlist_pagenav || $group[search])><br />
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<if $memberlist_pagenav><td class="cellmain">$memberlist_pagenav</td></if>
<if $group[search]><td class="cellmain right"><form style="margin:0" action="members.php" method="post">
<div><input name="sort" type="hidden" value="$sort" />
<input name="order" type="hidden" value="$order" />
<input name="minposts" type="hidden" value="0" />
<input name="maxposts" type="hidden" value="429496729" />
<input name="search" type="hidden" value="1" />
<span class="small"><b>Search for user:</b></span> <input class="small" name="name" type="text" size="20" />&nbsp;<input class="small" type="submit" value="Go" /><br />
<a class="linksmall" href="search.php#users"><b>Advanced search</b></a></div></form></td></if>
</tr>
</table>
</td>
</tr>
</table>
</if>
<br />
<div class="center"><a href="#top">Back to Top</a> - <a href="forum.php">Back to Main Forums</a></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1069545382";}s:21:"close_thread_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:186:"<include template="redirect_header" />
The thread has been <if $thread[closed]>opened<else />closed</if>. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"new_posts_closed";a:4:{s:8:"category";s:0:"";s:4:"body";s:93:"<img alt="New posts (closed)" src="$style[images]/<if $doticon>dot_</if>unread_closed.gif" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:20:"new_posts_closed_hot";a:4:{s:8:"category";s:0:"";s:4:"body";s:102:"<img alt="New posts (closed, hot)" src="$style[images]/<if $doticon>dot_</if>unread_closed_hot.gif" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:23:"no_new_posts_closed_hot";a:4:{s:8:"category";s:0:"";s:4:"body";s:103:"<img alt="No new posts (closed, hot)" src="$style[images]/<if $doticon>dot_</if>read_closed_hot.gif" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:19:"no_new_posts_closed";a:4:{s:8:"category";s:0:"";s:4:"body";s:94:"<img alt="No new posts (closed)" src="$style[images]/<if $doticon>dot_</if>read_closed.gif" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:22:"sticky_thread_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:173:"<include template="redirect_header" />
The thread has been <if $thread[sticky]>un</if>stuck. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:22:"moderate_delete_thread";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:614:"<include template="message_header" />
Are you sure you want to delete thread <b>$thread[name]</b>?<br />
<br />
<br />
<form action="moderate.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input name="page" type="hidden" value="$page" />
<input name="postid" type="hidden" value="$postid" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='thread.php?id=$thread[threadid]&amp;page=$page&amp;postid=$postid'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074574814";}s:31:"moderate_delete_thread_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:170:"<include template="redirect_header" />
The thread has been deleted. You are now being returned to the forum that the thread was in.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"edit_thread";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:1005:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$thread[threadid]&amp;page=$page&amp;postid=$postid"><b>$thread[name]</b></a> <b>&gt; Edit Thread</b>
<br />
<br />
<form action="moderate.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doedit" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input name="page" type="hidden" value="$page" />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Editing $thread[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Subject:</b></td>
<td><input name="name" type="text" size="80" value="$thread[uncensored_name]" /></td>
</tr>
$icons
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Thread" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074574646";}s:20:"edit_thread_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:148:"<include template="redirect_header" />
The thread has been updated. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"delete_thread";a:4:{s:8:"category";s:9:"Edit Post";s:4:"body";s:512:"<include template="message_header" />
Are you sure you want to delete thread <b>$thread[name]</b>?<br />
<br />
<br />
<form action="edit.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$post[postid]" />
<input name="page" type="hidden" value="$page" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='edit.php?id=$post[postid]'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073769840";}s:11:"delete_post";a:4:{s:8:"category";s:9:"Edit Post";s:4:"body";s:503:"<include template="message_header" />
Are you sure you want to delete the specified post?<br />
<br />
<br />
<form action="edit.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodelete" />
<input name="id" type="hidden" value="$post[postid]" />
<input name="page" type="hidden" value="$page" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='edit.php?id=$post[postid]'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073769780";}s:22:"delete_thread_redirect";a:4:{s:8:"category";s:9:"Edit Post";s:4:"body";s:154:"<include template="redirect_header" />
The thread has been deleted. You are now being returned to the parent forum.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"delete_post_redirect";a:4:{s:8:"category";s:9:"Edit Post";s:4:"body";s:156:"<include template="redirect_header" />
The specified post has been deleted. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:23:"editprofile_customfield";a:4:{s:8:"category";s:12:"Edit Profile";s:4:"body";s:190:"<tr>
<td><b>$field[name]:</b><br />
<span class="small">$field[description]</span></td><td><input name="field_$field[customfieldid]" type="text" size="60" value="$field[value]" /></td>
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"profile_customfield";a:4:{s:8:"category";s:12:"User Profile";s:4:"body";s:62:"<tr>
<td><b>$field[name]:</b></td><td>$field[value]</td>
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"form_header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:216:"<tr>
<td class="cellmain" style="width: 100%"><table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td style="width:100%"><table class="cellmain" cellpadding="$style[cellpadding]" width="100%">";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"form_footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:39:"</table></td>
</tr>
</table></td>
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"topic_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:92:"<option value="$topic[topicid]"<if $selected> selected="selected"</if>>$topic[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"section_choice";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:98:"<option value="$section[sectionid]"<if $selected> selected="selected"</if>>$section[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"invalid_article";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:113:"<include template="message_header" />
The specified article does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"custom_field";a:4:{s:8:"category";s:0:"";s:4:"body";s:202:"<tr>
<td><b>$field[name]:</b><br />
<span class="small">$field[description]</span></td><td colspan="2"><input name="field_$field[customfieldid]" type="text" size="60" value="$field[value]" /></td>
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"invalid_styleset";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:115:"<include template="message_header" />
The specified style set does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"post_thread_missing";a:4:{s:8:"category";s:10:"New Thread";s:4:"body";s:122:"<include template="message_header" />
You must enter a thread subject and a message.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"post_reply_missing";a:4:{s:8:"category";s:9:"New Reply";s:4:"body";s:100:"<include template="message_header" />
You must have a message.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"edit_post_missing_subject";a:4:{s:8:"category";s:9:"Edit Post";s:4:"body";s:117:"<include template="message_header" />
You must specify a subject for your post.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:17:"edit_post_missing";a:4:{s:8:"category";s:9:"Edit Post";s:4:"body";s:114:"<include template="message_header" />
You must have a message for your post.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:19:"edit_thread_missing";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:110:"<include template="message_header" />
You must specify a thread subject.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"forum_pm_message";a:4:{s:8:"category";s:11:"Forum Index";s:4:"body";s:253:"<li><a class="linksmall" href="readpm.php?id=$pm[privatemessageid]">$pm[subject]</a><span class="small">, from</span> <a class="linksmall" href="profile.php?id=$pm[fromuserid]">$pm[fromusername]</a><span class="small">, sent on $pm[sentdate]</span></li>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:8:"pm_index";a:4:{s:8:"category";s:16:"Private Messages";s:4:"body";s:6031:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt; Private Messages</b><br />
<br />
<if $overlimit><div class="center"><b>You have met or exceeded your stored message limit of $group[maxpm] stored messages. Until you delete some of your old messages, you will not be able to receive any further messages.</b></div><br /></if>
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td style="width:33%" class="cellmain"><a href="newpm.php?folder=$folder"><img alt="New private message" src="$style[images]/newpm.gif" /></a></td>
<td class="cellmain"><form style="margin:0px; padding:0x" action="pm.php" method="post"><div class="right"><span class="small">Change folder:</span> <select name="folder" onchange="window.location='pm.php?folder='+this.options[this.selectedIndex].value"><option value="archive"<if $folder=="archive"> selected="selected"</if>>Archive</option><option value="inbox"<if $folder=="inbox"> selected="selected"</if>>Inbox</option><option value="sent"<if $folder=="sent"> selected="selected"</if>>Sent Messages</option></select> <input type="submit" name="go" class="small" value="Go" /></div></form></td>
</tr>
</table>
</td>
</tr>
</table><br />
<form action="pm.php" method="post">
<div><input name="folder" type="hidden" value="$folder" />
<table id="pm_boxes" class="tableline" width="100%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="<if $folder=="archive">2<else />3</if>" style="white-space: nowrap"><span class="small">Message Subject</span> <a href="pm.php?folder=$folder&amp;order=subject&amp;sort=asc"><img alt="Sort by message subject in ascending order" src="$style[images]/up.gif" /></a><a href="pm.php?folder=$folder&amp;order=subject&amp;sort=desc"><img alt="Sort by message subject in descending order" src="$style[images]/down.gif" /></a></td><if $folder=="archive"><td class="tableheader" style="white-space: nowrap"><span class="small">Sender <a href="pm.php?folder=$folder&amp;order=fromusername&amp;sort=asc"><img alt="Sort by sender in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="pm.php?folder=$folder&amp;order=fromusername&amp;sort=desc"><img alt="Sort by sender in descending order" src="$style[images]/down.gif" style="vertical-align: middle" /></a></span></td></if><td class="tableheader" style="white-space: nowrap"><span class="small"><if $folder=="inbox">Sender</span> <a href="pm.php?folder=$folder&amp;order=fromusername&amp;sort=asc"><img alt="Sort by sender in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="pm.php?folder=$folder&amp;order=fromusername&amp;sort=desc"><img alt="Sort by sender in descending order" src="$style[images]/down.gif" style="vertical-align: middle" /></a><else />Recipient</span> <a href="pm.php?folder=$folder&amp;order=tousername&amp;sort=asc"><img alt="Sort by recipient in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="pm.php?folder=$folder&amp;order=tousername&amp;sort=desc"><img alt="Sort by recipient in descending order" src="$style[images]/down.gif" style="vertical-align: middle" /></a></if></td><td class="tableheader" style="white-space: nowrap"><span class="small">Time Sent</span> <a href="pm.php?folder=$folder&amp;order=sentdate&amp;sort=asc"><img alt="Sort by date sent in ascending order" src="$style[images]/up.gif" style="vertical-align: middle" /></a><a href="pm.php?folder=$folder&amp;order=sentdate&amp;sort=desc"><img alt="Sort by date sent in ascending order" src="$style[images]/down.gif"style="vertical-align: middle" /></a></td><td class="tableheader" style="width: 18px"><span class="small"><input name="checkall" type="checkbox" onclick="check_uncheck_all(this, 'pm_boxes')" /></span></td>
</tr>
<if $private_messages>$private_messages<else /><tr><td colspan="6" class="cellmain"><div class="center">This folder contains no messages.</div></td></tr></if>
</table>
<br />
</div>
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td class="cellmain" style="width:33%"><a href="newpm.php?folder=$folder"><img alt="New private message" src="$style[images]/newpm.gif" /></a></td>
<td class="cellmain" style="text-align:center"><span class="small">Change folder:</span> <select name="folder" onchange="window.location='pm.php?folder='+this.options[this.selectedIndex].value"><option value="archive"<if $folder=="archive"> selected="selected"</if>>Archive</option><option value="inbox"<if $folder=="inbox"> selected="selected"</if>>Inbox</option><option value="sent"<if $folder=="sent"> selected="selected"</if>>Sent Messages</option></select> <input type="submit" name="go" value="Go" class="small" /></td>
<td class="cellmain right" style="width:33%"><span class="small">With Selected:</span> <if $folder!="archive"><input name="archive" type="submit" value="Archive" /> </if><input name="delete" type="submit" value="Delete" /></td>
</tr>
</table>
</td>
</tr>
</table>
</form>
<table width="95%" class="foreground">
<tr>
<td style="width: 30%" class="right"><span class="small"><if $folder=="sent">Unread by recipient:</span></td><td><img alt="Unread by recipient" src="$style[images]/unread.gif" /></td>
<td style="width: 30%" class="right"><span class="small">Read by recipient:</span></td><td><img alt="Read by recipient" src="$style[images]/read.gif" /><else />Unread message:</span></td><td><img alt="Unread message" src="$style[images]/unread.gif" /></td>
<td style="width: 30%" class="right"><span class="small">Read message:</span></td><td><img alt="Read message" src="$style[images]/read.gif" /></if></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074813147";}s:13:"leaders_index";a:4:{s:8:"category";s:18:"Site/Forum Leaders";s:4:"body";s:670:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt; Site/Forum Leaders</b><br />
<br />
<div class="center">$groups
<if $mods><table class="tableline" width="75%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="5">$config[name] Moderators</td>
</tr>
<tr>
<td class="tableheader" colspan="2"><span class="small">Username</span></td><td class="tableheader"><span class="small">Forums</span></td><td class="tableheader" colspan="2"><span class="small">Contact</span></td>
</tr>
$mods
</table></if>
</div>
<include template="footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"leaders_group";a:4:{s:8:"category";s:18:"Site/Forum Leaders";s:4:"body";s:438:"<table class="tableline" width="75%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="5">$config[name] $group_name</td>
</tr>
<tr>
<td class="tableheader" colspan="2"><span class="small">Username</span></td><td class="tableheader"><span class="small">Location</span></td><td class="tableheader" colspan="2"><span class="small">Contact</span></td>
</tr>
$users
</table><br /><br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1075616020";}s:12:"leaders_user";a:4:{s:8:"category";s:18:"Site/Forum Leaders";s:4:"body";s:746:"<tr>
<td class="$color" style="width: 18px"><div class="center"><img alt="$user_result[name] is o<if $isonline>nline" src="$style[images]/on<else />ffline" src="$style[images]/off</if>.gif" /></div></td><td class="$color"><a href="profile.php?id=$user_result[userid]"><b>$user_result[parsed_name]</b></a></td><td class="$color">$user_result[location]</td><td class="$color" style="width: 64px"><if $showpm><a href="newpm.php?userid=$user_result[userid]"><img alt="Send $user_result[name] a private message" src="$style[images]/pm.gif" /></a></if></td><td class="$color" style="width: 64px"><if $showemail><a href="email.php?id=$user_result[userid]"><img alt="Send $user_result[name] an email" src="$style[images]/email.gif" /></a></if></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055920679";}s:10:"pm_message";a:4:{s:8:"category";s:16:"Private Messages";s:4:"body";s:1079:"<tr>
<if $folder!="archive"><td class="$color" style="width: 18px"><div class="center"><img alt="<if $pm[isread]>Read message" src="$style[images]/<else />Unread message" src="$style[images]/un</if>read.gif" /></div></td></if><td class="$color" style="width: 18px"><if $pm[iconid]><div class="center"><img alt="$pm[icon_name]" src="$pm[image]" /></div></if></td><td class="$color" style="width: 99%"><a href="readpm.php?id=$pm[privatemessageid]">$pm[subject]</a></td><if $folder=="archive"><td class="$color" style="white-space: nowrap"><a href="profile.php?id=$pm[fromuserid]">$pm[fromusername]</a></td><td class="$color" style="white-space: nowrap"><a href="profile.php?id=$pm[touserid]">$pm[tousername]</a></td><else /><td class="$color" style="white-space: nowrap"><a href="profile.php?id=<if $pm[userid]==$pm[fromuserid]>$pm[touserid]">$pm[tousername]<else />$pm[fromuserid]">$pm[fromusername]</if></a></td></if><td class="$color" style="white-space: nowrap">$pm[sentdate]</td><td class="$color"><input name="pm_$pm[privatemessageid]" type="checkbox" value="1" /></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058416478";}s:11:"newpm_index";a:4:{s:8:"category";s:6:"New PM";s:4:"body";s:4425:"<include template="header" />
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript" src="$relativeurl/javascript/wysiwyg.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_en.js"></script>
<script type="text/javascript" src="javascript/wysiwyg_dialog.js"></script>
</if>
<form action="newpm.php" method="post" onsubmit="return pm_submit()">
<div><input name="op" type="hidden" value="dosend" />
<input name="folder" type="hidden" value="$folder" />
<input id="parsed_message" name="parsed_message" type="hidden" value="$parsedmessage" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b> <a href="pm.php"><b>Private Messages</b></a> <b>&gt; New Private Message</b>
<br />
<br /></div>
<if $preview_button>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Preview</td>
</tr>
<tr>
<td class="cellmain"><if $iconid><img alt="$preview_icon[name]" src="$preview_icon[image]" /> </if><b>$preview_subject</b><if ($preview_subject || $iconid)><br />
<br /></if>
$preview_message</td>
</tr>
</table><br />
</if>
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">New Private Message</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Usernames:</b><br />
<span class="small">Enter the names of the users you would like to send this message to. Separate the names with commas (<b>,</b>).</span></td>
<td><input id="users" name="users" type="text" size="80" value="$pm[fromusername]" /></td>
</tr>
<tr>
<td><b>Subject:</b></td>
<td><input id="subject" name="subject" type="text" size="80" value="$pm[subject]" /></td>
</tr>
$icons
<tr>
<td><b>Message:</b><br />
<span class="small">DP Code is <b><if $config[pm_dpcode]>en<else />dis</if>abled</b><br />
Images are <b><if $config[pm_img]>en<else />dis</if>abled</b><br />
Smilies are <b><if $config[pm_smilies]>en<else />dis</if>abled</b></span>
$smilie_box</td>
<td>
<script type="text/javascript">
<!--
document.write('<div style="display:none" id="messageDiv"><iframe id="messageIframe"></iframe></div>');
//-->
</script>
<textarea name="message" id="message" style="width: 100%" rows="20" cols="80">$message</textarea>
<if $config[use_wysiwyg] && $user[use_wysiwyg]>
<script type="text/javascript">
<!--
generate_wysiwyg('message', true);
-->
</script>
</if></td>
</tr>
<tr>
<td><b>Options:</b></td>
<td class="small">
<if $preview_button>
<if $group[html]><input name="html" value="1" type="checkbox"<if $html> checked="checked"</if> /> Allow HTML in this message<br /></if>
<input name="url" type="checkbox" value="1"<if $url> checked="checked"</if> /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1"<if $dpcode> checked="checked"</if> /> Disable DP Code<br />
<input name="smilies" type="checkbox" value="1"<if $smilies> checked="checked"</if> /> Disable Smilies<br />
<input name="savecopy" type="checkbox" value="1"<if $overlimit> disabled="disabled"<else /><if $savecopy> checked="checked"</if></if> /> Save a copy of this message<if $overlimit> <b>(Disabled: you are over your stored message limit)</b></if><br />
<if $group[customsignature]><input name="showsignature" type="checkbox" value="1"<if $showsignature> checked="checked"</if> /> Show signature</if>
<else />
<if $group[html]><input name="html" value="1" type="checkbox"<if $pm[html]> checked="checked"</if> /> Allow HTML in this message<br /></if>
<input name="url" type="checkbox" value="1" checked="checked" /> Automatically add url tags<br />
<input name="dpcode" type="checkbox" value="1" /> Disable DP Code<br />
<input name="smilies" type="checkbox" value="1" /> Disable Smilies<br />
<input name="savecopy" type="checkbox" value="1"<if $overlimit> disabled="disabled"<else /> checked="checked"</if> /> Save a copy of this message<if $overlimit> <b>(Disabled: you are over your stored message limit)</b></if><br />
<if $group[customsignature]><input name="showsignature" type="checkbox" value="1" checked="checked" /> Show signature</if>
</if></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Send Message" /> <input name="preview_button" type="submit" value="Preview Message" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074828827";}s:26:"forum_forum_parent_canpost";a:4:{s:8:"category";s:11:"Forum Index";s:4:"body";s:2137:"<if !$first></table><br /></if>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%" class="tableline">
<tr>
<td colspan="2" class="tableheader" style="text-align:left"><span class="small">Forum</span></td>
<td class="tableheader"><span class="small">Posts</span></td>
<td class="tableheader"><span class="small">Threads</span></td>
<td class="tableheader" style="white-space: nowrap"><span class="small">Last Post</span></td>
<if $config[show_moderators]><td class="tableheader"><span class="small">Moderators</span></td></if>
</tr>
<tr>
<td class="$color" colspan="2"><img alt="<if $newposts>New posts" src="$style[images]/on<else />No new posts" src="$style[images]/off</if><if $locked>_locked</if>.gif" /> <a href="forum_display.php?id=$forum[forumid]"><b>$forum[name]</b></a><if $forum[usersonline]> <span class="small">($forum[usersonline] User<if $forum[usersonline]!=1>s</if> Browsing)</span></if><br /><span class="small">$forum[description]</span></td>
<td class="$color" style="width:48px"><div class="center">$forum[posts]</div></td>
<td class="$color" style="width:48px"><div class="center">$forum[threads]</div></td>
<td class="$color" style="width:210px"><if $forum[lastpostdate]>
<table cellspacing="0" cellpadding="2" width="100%">
<tr>
<td style="width:1%"><a href="thread.php?postid=$forum[lastpostid]#$forum[lastpostid]"><img src="$style[images]/right.gif" alt="Jump to last Post" /></a></td>
<td><div class="small"><if $perm[viewthreads] && $config[lastpost_thread]><a class="linksmall" href="thread.php?id=$forum[lastthreadid]" title="View Thread &quot;$forum[threadfullname]&quot;"><b>$forum[threadname]</b></a><br /></if>
$forum[lastpostdate]<br />by <a class="linksmall" href="profile.php?id=$forum[lastuserid]">$forum[lastusername]</a>
</div></td>
<if $forum[threadiconid] && $perm[viewthreads] && $config[lastpost_thread]><td style="width:1%"><img alt="$forum[icon_name]" src="$forum[icon_image]" /></td></if>
</tr>
</table><else /><div class="center small">Never</div></if></td>
<if $config[show_moderators]><td class="$color" style="width:130px">$moderators</td></if>
</tr>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1071098540";}s:15:"send_pm_missing";a:4:{s:8:"category";s:6:"New PM";s:4:"body";s:115:"<include template="message_header" />
You must enter a subject and a message.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"send_pm_redirect";a:4:{s:8:"category";s:6:"New PM";s:4:"body";s:162:"<include template="redirect_header" />
Your message has been sent. You are now being returned to your private message list.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"readpm_index";a:4:{s:8:"category";s:12:"Read Message";s:4:"body";s:4125:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b> <a href="pm.php"><b>Private Messages</b></a> <b>&gt; $pm[subject]</b>
<br />
<br />
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td><a href="newpm.php?folder=$pm[folder]"><img alt="New Message" src="$style[images]/newpm.gif" /></a> <a href="newpm.php?folder=$pm[folder]&amp;id=$pm[privatemessageid]"><img alt="Reply to Message" src="$style[images]/replypm.gif" /></a></td>
<td class="right"><if $pm[folder]!="archive"><a href="pm.php?folder=$pm[folder]&amp;archive=1&amp;pm_$pm[privatemessageid]=1"><img alt="Archive Message" src="$style[images]/archive.gif" /></a> </if><a href="pm.php?folder=$pm[folder]&amp;delete=1&amp;pm_$pm[privatemessageid]=1"><img alt="Delete Message" src="$style[images]/delete.gif" /></a></td>
</tr>
</table>
</td>
</tr>
</table>
<br />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%" class="tableline">
<tr>
<td class="tableheader"><span class="small">Sender</span></td><td class="tableheader"><span class="small">Message</span></td>
</tr>
<tr valign="top">
<td class="cellmain" style="width: 175px; text-align:center"><if $pm[parsed_name]><a href="profile.php?id=$pm[fromuserid]"><b>$pm[parsed_name]</b></a><else /><b>$pm[fromusername]</b></if>
<br />
<span class="small">$pm[title]
<br />
<br />
<if ($pm[parsed_avatar] && $user[show_avatars])>
<img alt="$pm[username]'s avatar" src="$pm[parsed_avatar]" /><br />
</if>
<br />
Joined: <if $pm[fromuserid]>$pm[joindate]<else />Never</if><br />
<if $pm[location]>Location: $pm[location]<br /></if>
Posts: <if $pm[fromuserid]>$pm[posts]<else />N/A</if><br />
Status: <if $isonline><b>Online</b><else />Offline</if></span></td>
<td class="cellmain"><if $icon[iconid]><img alt="$pm[icon_name]" src="$pm[image]" /> </if><b>$pm[subject]</b><br /><br />
$pm[message]
<if $showsig><br />
<br />
______________________________<br />
$pm[signature]</if></td>
</tr>
<tr><td class="cellmain" style="width: 175px; white-space:nowrap; text-align:center"><span class="small">Sent: $pm[sentdate]</span></td>
<td class="cellmain"><if $pm[fromuserid]><a href="profile.php?id=$pm[fromuserid]"><img alt="View profile for $pm[fromusername]" src="$style[images]/profile.gif" /></a></if><if $showpm> <a href="newpm.php?userid=$pm[fromuserid]"><img alt="Send $pm[fromusername] a private message" src="$style[images]/pm.gif" /></a></if><if $showemail> <a href="email.php?id=$pm[fromuserid]"><img alt="Send $pm[fromusername] an email" src="$style[images]/email.gif" /></a></if><if $pm[website]> <a href="$pm[website]" onclick="window.open(this.href,'_blank');return false;"><img alt="$pm[website]" src="$style[images]/website.gif" /></a></if><if $showsearch> <a href="search.php?op=post&amp;type=post&amp;sort=desc&amp;userid=$pm[fromuserid]"><img alt="Search for posts made by $pm[fromusername]" src="$style[images]/search.gif" /></a></if></td>
</tr>
</table><br />
<table cellspacing="$style[cellspacing]" cellpadding="0" class="tableline" width="100%">
<tr>
<td class="cellmain">
<table cellspacing="0" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td><a href="newpm.php?folder=$pm[folder]"><img alt="New Message" src="$style[images]/newpm.gif" /></a> <a href="newpm.php?folder=$pm[folder]&amp;id=$pm[privatemessageid]"><img alt="Reply to Message" src="$style[images]/replypm.gif" /></a></td>
<td class="right"><if $pm[folder]!="archive"><a href="pm.php?folder=$pm[folder]&amp;archive=1&amp;pm_$pm[privatemessageid]=1"><img alt="Archive Message" src="$style[images]/archive.gif" /></a> </if><a href="pm.php?folder=$pm[folder]&amp;delete=1&amp;pm_$pm[privatemessageid]=1"><img alt="Delete Message" src="$style[images]/delete.gif" /></a></td>
</tr>
</table>
</td>
</tr>
</table><br />
<div class="center"><a href="#top">Back to Top</a> - <a href="pm.php?folder=$pm[folder]">Back to $pm[parsed_folder]</a></div>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074815578";}s:11:"email_index";a:4:{s:8:"category";s:13:"Email Display";s:4:"body";s:182:"<include template="message_header" />
<b>$user_result[name]</b>'s email address is <a href="mailto:$user_result[email]">$user_result[email]</a>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"email_hidden";a:4:{s:8:"category";s:13:"Email Display";s:4:"body";s:240:"<include template="message_header" />
<if $config[show_email]=="disable">Email functionality has been disabled.<else /><b>$user_result[name]</b> has chosen to keep their email address confidential.</if>
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"leaders_moderator";a:4:{s:8:"category";s:18:"Site/Forum Leaders";s:4:"body";s:715:"<tr>
<td class="$color" style="width: 18px"><div class="center"><img alt="$lastmod[username] is o<if $isonline>nline" src="$style[images]/on<else />ffline" src="$style[images]/off</if>.gif" /></div></td><td class="$color"><a href="profile.php?id=$lastmod[userid]"><b>$lastmod[parsed_name]</b></a></td><td class="$color">$forums</td><td class="$color" style="width: 64px"><if $showpm><a href="newpm.php?userid=$lastmod[userid]"><img alt="Send $lastmod[username] a private message" src="$style[images]/pm.gif" /></a></if></td><td class="$color" style="width: 64px"><if $showemail><a href="email.php?id=$lastmod[userid]"><img alt="Send $lastmod[username] an email" src="$style[images]/email.gif" /></a></if></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055920679";}s:13:"leaders_forum";a:4:{s:8:"category";s:18:"Site/Forum Leaders";s:4:"body";s:100:"<if $forums><br /></if><a class="linksmall" href="forum_display.php?id=$mod[forumid]">$mod[name]</a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:23:"add_ignored_user_denied";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:137:"<include template="message_header" />
You cannot add <b>$user_result[name]</b> to your ignore list.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:26:"add_ignored_user_duplicate";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:133:"<include template="message_header" />
<b>$user_result[name]</b> is already on your ignore list.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"user_ignored_user";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:243:"<if $ignored><br />
</if><a href="profile.php?id=$ignore[ignoreuserid]">$ignore[username]</a> <span class="small">[</span><a class="linksmall" href="user.php?op=delete_ignore&amp;id=$ignore[ignoreuserid]">Delete</a><span class="small">]</span>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1056265798";}s:19:"add_buddy_duplicate";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:138:"<include template="message_header" />
You already have <b>$user_result[name]</b> on your buddy list.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"add_buddy_redirect";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:274:"<include template="redirect_header" />
<b>$user_result[name]</b> has been added to your buddy list. <if $profile>You are now being returned to that user's profile page.<else />You are now being returned to your user control panel.</if>
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"user_buddy";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:464:"<if $buddies><br />
</if><img alt="$buddy[name] is o<if $isonline>nline" src="$style[images]/on<else />ffline" src="$style[images]/off</if>.gif" /> <a href="profile.php?id=$buddy[userid]">$buddy[name]</a> <span class="small">[</span><if $showpm><a class="linksmall" href="newpm.php?userid=$buddy[userid]">Send PM</a> <span class="small">-</span> </if><a class="linksmall" href="user.php?op=delete_buddy&amp;id=$buddy[userid]">Delete</a><span class="small">]</span>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055920679";}s:27:"forumdisplay_thread_ignored";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:383:"<tr>
<td class="$color" colspan="7"><div class="center"><span class="small">You are ignoring this thread, posted by</span> <a class="linksmall" href="profile.php?id=$thread[userid]">$thread[username]</a><span class="small">.</span> <a class="linksmall" href="thread.php?id=$thread[threadid]&amp;ignore=1">Click here</a> <span class="small">to read the thread.</span></div></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:11:"topic_topic";a:4:{s:8:"category";s:6:"Topics";s:4:"body";s:203:"<td><if $topic[topicid]><div class="center"><a href="topics.php?id=$topic[topicid]"><img alt="$topic[name]" src="$topic[parsed_image]" /><br />
<span class="small">$topic[name]</span></a></div></if></td>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:9:"topic_row";a:4:{s:8:"category";s:6:"Topics";s:4:"body";s:37:"<tr valign="bottom">
$topic_col
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"topic_index";a:4:{s:8:"category";s:6:"Topics";s:4:"body";s:441:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Topics</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Topics</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain" cellpadding="20">$topics</table></td>
</tr>
</table></td>
</tr>
</table>
<include template="nav_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058011947";}s:15:"topic_showtopic";a:4:{s:8:"category";s:6:"Topics";s:4:"body";s:1180:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="topics.php"><b>Topics</b></a> <b>&gt; $topic[name]</b><br />
<br />
<form action="topics.php" method="post">
<div><input name="id" type="hidden" value="$topic[topicid]" /></div>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Articles in $topic[name]</td>
</tr>
<tr>
<td class="cellmain"><if $articles>$articles<else />This topic contains no articles.</if></td>
</tr>
<tr>
<td class="tableheader">Sort by <select name="order"><option value="username"<if $order=="username"> selected="selected"</if>>Author</option>
<option value="posted"<if $order=="posted"> selected="selected"</if>>Post Date</option>
<option value="title"<if $order=="title"> selected="selected"</if>>Title</option></select> in <select name="sort"><option value="asc"<if $sort=="asc"> selected="selected"</if>>Ascending</option>
<option value="desc"<if $sort=="desc"> selected="selected"</if>>Descending</option></select> order <input type="submit" value="Go" /></td>
</tr>
</table></form>
<include template="nav_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:13:"topic_article";a:4:{s:8:"category";s:6:"Topics";s:4:"body";s:173:"<a href="article.php?id=$article[articleid]"><b>$article[title]</b></a>, posted by <a href="profile.php?id=$article[userid]">$article[username]</a> on $article[posted]<br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:13:"invalid_topic";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:111:"<include template="message_header" />
The specified topic does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"section_index";a:4:{s:8:"category";s:8:"Sections";s:4:"body";s:447:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Sections</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Sections</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain" cellpadding="20">$sections</table></td>
</tr>
</table></td>
</tr>
</table>
<include template="nav_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058011843";}s:15:"invalid_section";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:113:"<include template="message_header" />
The specified section does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"section_showsection";a:4:{s:8:"category";s:8:"Sections";s:4:"body";s:1196:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="sections.php"><b>Sections</b></a> <b>&gt; $section[name]</b><br />
<br />
<form action="sections.php" method="post">
<div><input name="id" type="hidden" value="$section[sectionid]" /></div>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Articles in $section[name]</td>
</tr>
<tr>
<td class="cellmain"><if $articles>$articles<else />This section contains no articles.</if></td>
</tr>
<tr>
<td class="tableheader">Sort by <select name="order"><option value="username"<if $order=="username"> selected="selected"</if>>Author</option>
<option value="posted"<if $order=="posted"> selected="selected"</if>>Post Date</option>
<option value="title"<if $order=="title"> selected="selected"</if>>Title</option></select> in <select name="sort"><option value="asc"<if $sort=="asc"> selected="selected"</if>>Ascending</option>
<option value="desc"<if $sort=="desc"> selected="selected"</if>>Descending</option></select> order <input type="submit" value="Go" /></td>
</tr>
</table></form>
<include template="nav_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:15:"section_article";a:4:{s:8:"category";s:8:"Sections";s:4:"body";s:173:"<a href="article.php?id=$article[articleid]"><b>$article[title]</b></a>, posted by <a href="profile.php?id=$article[userid]">$article[username]</a> on $article[posted]<br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:11:"section_row";a:4:{s:8:"category";s:8:"Sections";s:4:"body";s:39:"<tr valign="bottom">
$section_col
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"section_section";a:4:{s:8:"category";s:8:"Sections";s:4:"body";s:192:"<td><if $section[sectionid]><div class="center"><a href="sections.php?id=$section[sectionid]"><img alt="$section[name]" src="$section[parsed_image]" /><br />
$section[name]</a></div></if></td>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058011566";}s:14:"download_index";a:4:{s:8:"category";s:9:"Downloads";s:4:"body";s:450:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Downloads</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Downloads</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain" cellpadding="20">$downloads</table></td>
</tr>
</table></td>
</tr>
</table>
<include template="nav_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058011891";}s:21:"download_showcategory";a:4:{s:8:"category";s:9:"Downloads";s:4:"body";s:1244:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="downloads.php"><b>Downloads</b></a> <b>&gt; $category[name]</b><br />
<br />
<div class="center"><form action="downloads.php" method="post">
<div><input name="id" type="hidden" value="$category[downloadcategoryid]" /></div>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Downloads in $category[name]</td>
</tr>
<tr>
<td class="cellmain"><if $downloads>$downloads<else />This category does not contain any downloads.</if></td>
</tr>
<tr>
<td class="tableheader">Sort by <select name="order"><option value="author"<if $order=="author"> selected="selected"</if>>Author</option>
<option value="name"<if $order=="name"> selected="selected"</if>>Name</option>
<option value="version"<if $order=="version"> selected="selected"</if>>Version</option></select> in <select name="sort"><option value="asc"<if $sort=="asc"> selected="selected"</if>>Ascending</option>
<option value="desc"<if $sort=="desc"> selected="selected"</if>>Descending</option></select> order <input type="submit" value="Go" /></td>
</tr>
</table></form></div>
<include template="nav_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:17:"download_download";a:4:{s:8:"category";s:9:"Downloads";s:4:"body";s:399:"<if $downloads><br />
<br />
</if><a href="$download[location]"><b>$download[name]</b></a><br />
<span class="small">$download[description]</span><if $download[description]><br /></if>
<if $download[author]>Author: <if $download[email]><a href="mailto:$download[email]">$download[author]</a><else />$download[author]</if></if><if $both> - </if><if $download[version]>Version: $download[version]</if>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062723477";}s:12:"download_row";a:4:{s:8:"category";s:9:"Downloads";s:4:"body";s:40:"<tr valign="bottom">
$download_col
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"download_category";a:4:{s:8:"category";s:9:"Downloads";s:4:"body";s:243:"<td><if $category[downloadcategoryid]><div class="center"><a href="downloads.php?id=$category[downloadcategoryid]"><img alt="$category[name]" src="$category[parsed_image]" /><br />
<span class="small">$category[name]</span></a></div></if></td>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"link_showcategory";a:4:{s:8:"category";s:5:"Links";s:4:"body";s:508:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="links.php"><b>Links</b></a> <b>&gt; $category[name]</b><br />
<br />
<div class="center"><table width="100%"class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">$category[name]</td>
</tr>
<tr>
<td class="cellmain"><if $links>$links<else />This category does not contain any links.</if></td>
</tr>
</table></div>
<include template="nav_footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1055955221";}s:9:"link_link";a:4:{s:8:"category";s:5:"Links";s:4:"body";s:210:"<if $links><br />
<br />
</if><a href="$link[link]" onclick="window.open(this.href,'_blank');return false;"><b>$link[name]</b></a><if $link[description]><br />
<span class="small">$link[description]</span></if>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062823799";}s:13:"link_category";a:4:{s:8:"category";s:5:"Links";s:4:"body";s:231:"<td><if $category[linkcategoryid]><div class="center"><a href="links.php?id=$category[linkcategoryid]"><img alt="$category[name]" src="$category[parsed_image]" /><br />
<span class="small">$category[name]</span></a></div></if></td>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"link_index";a:4:{s:8:"category";s:5:"Links";s:4:"body";s:438:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; Links</b><br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Links</td>
</tr>
<tr>
<td class="cellmain"><table cellspacing="0">
<tr>
<td><table class="cellmain" cellpadding="20">$links</table></td>
</tr>
</table></td>
</tr>
</table>
<include template="nav_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058011929";}s:8:"link_row";a:4:{s:8:"category";s:5:"Links";s:4:"body";s:36:"<tr valign="bottom">
$link_col
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:7:"pagenav";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:54:"<span class="small">Pages ($numpages):</span> $pagenav";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"pagenav_first";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:126:"<a rel="page1" class="linksmall" href="$thispage.php?page=1<if $params>&amp;$params</if>"><b>&laquo; First</b></a> <b>...</b> ";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"pagenav_last";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:140:"<b>...</b> <a rel="page$numpages" class="linksmall" href="$thispage.php?page=$numpages<if $params>&amp;$params</if>"><b>Last &raquo;</b></a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"pagenav_link";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:127:"<a rel="page$pagelink" class="linksmall" href="$thispage.php?page=$pagelink<if $params>&amp;$params</if>"><b>$pagelink</b></a> ";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"pagenav_next";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:122:"<a rel="page$nextpage" class="linksmall" href="$thispage.php?page=$nextpage<if $params>&amp;$params</if>"><b>&gt;</b></a> ";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"pagenav_nolink";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:15:"<b>[$page]</b> ";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"pagenav_prev";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:122:"<a rel="page$prevpage" class="linksmall" href="$thispage.php?page=$prevpage<if $params>&amp;$params</if>"><b>&lt;</b></a> ";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"article_index";a:4:{s:8:"category";s:15:"Article Display";s:4:"body";s:1310:"<include template="nav_header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt; $article[title]</b><br />
<br />
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="95%">
<tr>
<td class="tableheader">$article[title]</td>
</tr>
<tr>
<td class="cellalt"><table width="100%">
<tr>
<td><i>Originally posted by <a href="profile.php?id=$article[userid]">$article[username]</a> on $article[date_posted]</i>
<if $article[threadid]><br />
<a href="thread.php?id=$article[threadid]">Read comments ($article[replies])</a></if></td>
<if ($numpages>1)><td class="right"><select class="small" name="page_dropdown" onchange="window.location='article.php?id=$article[articleid]&amp;page='+this.options[this.selectedIndex].value">$pages</select></td></if>
</tr>
</table><br />
$article[body]<if $article_pagenav><br />
<br />
<br />$article_pagenav<br /></if></td>
</tr>
</table>
<if ($editlink || $deletelink)><br />
<if $editlink><a class="linksmall" href="$admincp_dir/articles.php?op=edit&amp;id=$article[articleid]">Edit</a><if $deletelink> <span class="small">-</span> </if></if><if $deletelink><a class="linksmall" href="$admincp_dir/articles.php?op=delete&amp;id=$article[articleid]">Delete</a></if></if></div>
<include template="nav_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1063168458";}s:19:"edit_options_avatar";a:4:{s:8:"category";s:12:"Edit Options";s:4:"body";s:285:"<include template="message_header" />
Your image must be no larger than <b>$config[avatar_width]</b>x<b>$config[avatar_height]</b> pixels and <b>$config[avatar_size] KB</b>. It also must be one of the following types: <b>$config[avatar_types]</b>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"subscribe_thread_redirect";a:4:{s:8:"category";s:13:"Subscriptions";s:4:"body";s:159:"<include template="redirect_header" />
You have been subscribed to the thread. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"subscribe_email_redirect";a:4:{s:8:"category";s:13:"Subscriptions";s:4:"body";s:170:"<include template="redirect_header" />
You will now receive email updates to this thread. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:27:"unsubscribe_thread_redirect";a:4:{s:8:"category";s:13:"Subscriptions";s:4:"body";s:229:"<include template="redirect_header" />
You have been unsubscribed from the thread. You are now being returned to <if $redirect_url=="user.php">your user control panel<else />the thread</if>.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:26:"unsubscribe_email_redirect";a:4:{s:8:"category";s:13:"Subscriptions";s:4:"body";s:242:"<include template="redirect_header" />
You will no longer receive email updates to this thread. You are now being returned to <if $redirect_url=="user.php">your user control panel<else />the thread</if>.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:22:"user_subscribed_thread";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:1398:"<tr>
<td class="$color"><div class="center">$isread</div></td>
<td class="$color"><div class="center"><if $thread[iconid]><img alt="$thread[icon_name]" src="$thread[image]" /></if><if $thread[poll]><img alt="Poll" src="$style[images]/poll.gif" /></if></div></td>
<td class="$color"><a href="thread.php?id=$thread[threadid]&amp;op=newpost"><img alt="Jump to first unread post" src="$style[images]/right.gif" /></a> <a href="thread.php?id=$thread[threadid]">$thread[name]</a><if $multipage_nav> <span class="small">(</span> $multipage_nav<span class="small">)</span></if><br />
<a class="linksmall" href="reply.php?id=$thread[threadid]"><b>Reply</b></a> <span class="small">-</span> <a class="linksmall" href="subscribe.php?op=unsubscribe&amp;id=$thread[threadid]"><b>Unsubscribe</b></a></td>
<td class="$color"><a href="profile.php?id=$thread[userid]">$thread[username]</a></td>
<td class="$color"><div class="center"><a href="javascript:replies($thread[threadid])">$thread[replies]</a></div></td>
<td class="$color"><div class="center">$thread[views]</div></td>
<td class="$color"><span class="small"><a href="thread.php?postid=$thread[lastpostid]#$thread[lastpostid]"><img style="vertical-align: middle" alt="Jump to last post" src="$style[images]/right.gif" /></a> $thread[lastpostdate] by</span> <a class="linksmall" href="profile.php?id=$thread[lastuserid]">$thread[lastusername]</a></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074974949";}s:21:"user_subscribed_forum";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:1146:"<tr>
<td class="$color" style="width: 18px"><div class="center"><img alt="<if $newposts>New posts" src="$style[images]/on<else />No new posts" src="$style[images]/off</if><if $locked>_locked</if>.gif" /></div></td>
<td class="$color"><a href="forum_display.php?id=$forum[forumid]"><b>$forum[name]</b></a><br /><span class="small">$forum[description]</span><br />
<a class="linksmall" href="newthread.php?id=$forum[forumid]"><b>New Thread</b></a> <span class="small">-</span> <a class="linksmall" href="subscribe.php?op=unsubscribeforum&amp;usercp=1&amp;id=$forum[forumid]"><b>Unsubscribe</b></a></td>
<td class="$color"><div class="center">$forum[posts]</div></td>
<td class="$color"><div class="center">$forum[threads]</div></td>
<td class="$color"><if $forum[lastpostdate]><table>
<tr>
<td><a href="thread.php?postid=$forum[lastpostid]#$forum[lastpostid]"><img alt="Jump to last post" src="$style[images]/right.gif" /></a></td><td><span class="small">$forum[lastpostdate] by</span> <a class="linksmall" href="profile.php?id=$forum[lastuserid]">$forum[lastusername]</a></td>
</tr>
</table><else /><span class="small">Never</span></if></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1063161331";}s:24:"subscribe_forum_redirect";a:4:{s:8:"category";s:13:"Subscriptions";s:4:"body";s:157:"<include template="redirect_header" />
You have been subscribed to the forum. You are now being returned to the forum.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:26:"unsubscribe_forum_redirect";a:4:{s:8:"category";s:13:"Subscriptions";s:4:"body";s:227:"<include template="redirect_header" />
You have been unsubscribed from the forum. You are now being returned to <if $redirect_url=="user.php">your user control panel<else />the forum</if>.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"forumjump_forum";a:4:{s:8:"category";s:10:"Forum Jump";s:4:"body";s:127:"<option value="forum_display.php?id=$forum_result[forumid]"<if $selected> selected="selected"</if>>$forum_result[name]</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"moderate_copymove";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:1353:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?postid=$postid&amp;id=$thread[threadid]&amp;page=$page"><b>$thread[name]</b></a> <b>&gt; Copy/Move Thread</b>
<br />
<br />
<form action="moderate.php" method="post">
<div class="center">
<input name="op" type="hidden" value="domove" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input name="page" type="hidden" value="$page" />
<input name="postid" type="hidden" value="$postid" />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Copy/Move $thread[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Operation:</b></td>
<td class="small"><input name="operation" type="radio" value="copy" /> Copy thread<br />
<input name="operation" type="radio" value="move" /> Move thread<br />
<input name="operation" type="radio" value="redirect" checked="checked" /> Move thread (with redirect)</td>
</tr>
<tr>
<td><b>To forum:</b></td>
<td><select class="small" name="forumid">$forum_choices</select></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Copy/Move Thread" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074574505";}s:16:"option_noposting";a:4:{s:8:"category";s:13:"Form Controls";s:4:"body";s:13:" (No posting)";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:20:"copy_thread_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:173:"<include template="redirect_header" />
The specified thread has been copied to a new forum. You are now being taken to the new thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"redirect_thread_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:220:"<include template="redirect_header" />
The specified thread has been moved to a new forum, and a redirect has been placed in the old forum. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"move_thread_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:171:"<include template="redirect_header" />
The specified thread has been moved to a new forum. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:28:"forumdisplay_thread_redirect";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:985:"<tr>
<td class="$color"><div class="center"><img alt="Moved thread" src="$style[images]/redirect.gif" /></div></td>
<td class="$color"><div class="center"><img alt="<if $icon[iconid]>
$icon[name]" src="$icon[parsed_image]<else />
Blank icon" src="$style[images]/blank.gif</if>" /></div></td>
<td class="$color">Moved: <a href="thread.php?id=$thread[redirect]">$thread[name]</a></td>
<td class="$color"><a href="profile.php?id=$thread[userid]">$thread[username]</a></td>
<td class="$color"><div class="center">-</div></td>
<td class="$color"><div class="center">-</div></td>
<td class="$color"><table>
<tr>
<td class="$color"><a href="thread.php?postid=$thread[lastpostid]#$thread[lastpostid]"><img style="vertical-align: middle" alt="Jump to last post" src="$style[images]/right.gif" /></a></td><td class="$color"><span class="small">$thread[lastpostdate] by</span> <a class="linksmall" href="profile.php?id=$thread[lastuserid]">$thread[lastusername]</a></td>
</tr>
</table></td>
</tr>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1064013693";}s:12:"online_index";a:4:{s:8:"category";s:12:"Who's Online";s:4:"body";s:782:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt; Who's Online</b><br />
<br />
<if $online_pagenav><br />$online_pagenav<br /><br /></if>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr><td class="tableheader"><span class="small">Username</span></td><td class="tableheader"><span class="small">Activity</span></td><td class="tableheader"><span class="small">Last Activity</span></td><td colspan="2" class="tableheader"><span class="small">Contact</span></td><if $group[supermod_viewips]><td class="tableheader"><span class="small">IP Address</span></td></if></tr>
$list
</table>
<br />$online_pagenav<br />
<include template="footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"online_user";a:4:{s:8:"category";s:12:"Who's Online";s:4:"body";s:772:"<tr>
<td class="$color" style="white-space: nowrap"><if $online[userid]><a href="profile.php?id=$online[userid]">$online[parsed_name]</a><else />$guest</if><if $online[invisible]>*</if></td><td class="$color">$online[activity]</td><td class="$color" style="white-space: nowrap">$online[lastactivity]</td><td class="$color" style="width: 64px"><if $showpm><a href="newpm.php?userid=$online[userid]"><img alt="Send $online[name] a private message" src="$style[images]/pm.gif" /></a></if></td><td class="$color" style="width: 64px"><if $showemail><a href="email.php?id=$online[userid]"><img alt="Send $online[name] an email" src="$style[images]/email.gif" /></a></if></td><if $group[supermod_viewips]><td class="$color" style="white-space: nowrap">$online[ip]</td></if>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058331605";}s:16:"moderate_showlog";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:693:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$thread[threadid]&amp;page=$page&amp;postid=$postid"><b>$thread[name]</b></a> <b>&gt; Thread Log</b><br />
<br />
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr><td class="tableheader"><span class="small">Username</span></td><td class="tableheader"><span class="small">Action</span></td><td class="tableheader"><span class="small">Date</span></td><td class="tableheader"><span class="small">IP Address</span></td></tr>
$logs
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:12:"moderate_log";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:271:"<tr>
<td class="$color" style="white-space: nowrap"><a href="profile.php?id=$modlog[userid]">$modlog[username]</a></td><td class="$color">$modlog[action]</td><td class="$color" style="white-space: nowrap">$modlog[parsed_date]</td><td class="$color">$modlog[ip]</td>
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"search_index";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:6216:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt; Search</b><br />
<br />
<form action="search.php?" method="post">
<div><input name="op" type="hidden" value="post" /></div>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Search for Posts</td>
</tr>
<include template="form_header" />
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" style="border:0">
<tr>
<td class="cellmain" style="vertical-align:top;"><b>Enter your search terms here:</b><if $config[fulltextsearch] && $config[booleansearch]>
<div class="small"><a class="small" href="javascript://" onclick="alert('You may use a \'-\' before a word to exclude it from the search.\nYou may use a \'*\' as a wildcard.\nYou may enclose multiple words within quotes to search for them together.');">Advanced Searching Tips</a></div></if></td>
<td class="cellmain"><input name="terms" type="text" size="48" /></td>
</tr>
<tr>
<td class="cellmain" style="vertical-align:top;"><b>Search for posts made by user:</b></td>
<td class="cellmain"><input name="username" type="text" size="48" /><br />
<span class="small" title="Checking this will allow 'Jeff' to match 'Jeff', 'Jeffrey', 'Jefferson', etc."><input type="checkbox" name="name_partial" value="1" /> Allow Partial Username</span></td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td class="cellmain small" style="width:50%; vertical-align:top;">
<input name="type" type="radio" value="title" /> Search titles only<br />
<input name="type" type="radio" value="post" checked="checked" /> Search titles and posts (view as posts)<br />
<input name="type" type="radio" value="postasthread" /> Search titles and posts (view as threads)
</td>
<td class="cellmain small" style="vertical-align:top;">
<if $config[fulltextsearch]><input name="sort" type="radio" value="relavence" checked="checked" /> Sort by relavence<br /></if>
<input name="sort" type="radio" value="desc"<if !$config[fulltextsearch]> checked="checked"</if> /> Sort by post date in descending order<br />
<input name="sort" type="radio" value="asc" /> Sort by post date in ascending order
</td>
</tr>
</table>
</td>
<td class="center" style="vertical-align:top">
<b>Search in forum(s):</b><br />
<select multiple="multiple" name="forumid[]" class="small" size="10"><option value="0" selected="selected" title="Select this to search every forum.">All Forums</option>$forums</select><br />
<input type="checkbox" name="search_subforums" value="1" checked="checked" /> <span class="small">Search in subforum(s)</span>
</td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Search" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<form action="search.php?1" method="post">
<div><input name="op" type="hidden" value="article" /></div>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Search for Articles</td>
</tr>
<include template="form_header" />
<tr>
<td><table>
<include template="form_header" />
<tr>
<td><b>Enter your search terms here:</b></td><td><input name="terms" type="text" size="48" /></td>
</tr>
<tr>
<td><b>Search in topics:</b></td><td><select name="topicid"><option value="0" selected="selected">All Topics</option>$topics</select></td>
</tr>
<tr>
<td><b>Search in sections:</b></td><td><select name="sectionid"><option value="0" selected="selected">All Sections</option>$sections</select></td>
</tr>
<tr>
<td><b>Search for articles written by:</b></td><td><input name="username" type="text" size="48" /></td>
</tr>
<include template="form_footer" />
</table></td>
<td class="small"><input name="type" type="radio" value="title" /> Search article titles only<br />
<input name="type" type="radio" value="content" checked="checked" /> Search article titles and contents<br />
<br />
<input name="sort" type="radio" value="desc" checked="checked" /> Sort by post date in descending order<br />
<input name="sort" type="radio" value="asc" /> Sort by post date in ascending order</td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Search" /></td>
</tr>
<include template="form_footer" />
</table>
</form>
<if $group[view_memberlist]><form action="members.php" method="post">
<div><input name="search" type="hidden" value="1" /></div>
<table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader"><a name="users"></a>Search for Users</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Username:</b></td>
<td><input size="60" name="name" type="text" /></td>
</tr>
<tr>
<td><b>AOL Instant Messenger:</b></td>
<td><input size="60" name="aol" type="text" /></td>
</tr>
<tr>
<td><b>ICQ:</b></td>
<td><input size="60" name="icq" type="text" /></td>
</tr>
<tr>
<td><b>MSN Messenger:</b></td>
<td><input size="60" name="msn" type="text" /></td>
</tr>
<tr>
<td><b>Yahoo Instant Messenger:</b></td>
<td><input size="60" name="yahoo" type="text" /></td>
</tr>
<tr>
<td><b>At least this many posts:</b></td>
<td><input size="60" name="minposts" type="text" value="0" /></td>
</tr>
<tr>
<td><b>At most this many posts:</b></td>
<td><input size="60" name="maxposts" type="text" value="4294967296" /></td>
</tr>
<tr>
<td><b>Custom title:</b></td>
<td><input size="60" name="title" type="text" /></td>
</tr>
<tr>
<td><b>Joined on or after this date:</b></td>
<td><input size="60" name="minjoin" type="text" value="1969-12-31" /></td>
</tr>
<tr>
<td><b>Joined on or before this date:</b></td>
<td><input size="60" name="maxjoin" type="text" value="2029-12-31" /></td>
</tr>
<tr>
<td><b>Location:</b></td>
<td><input size="60" name="location" type="text" /></td>
</tr>
$customfields
<tr>
<td><b>Signature:</b></td>
<td><input size="60" name="signature" type="text" /></td>
</tr>
<tr>
<td><b>Website:</b></td>
<td><input size="60" name="website" type="text" /></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Search" /></td>
</tr>
<include template="form_footer" />
</table>
</form></if>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1078804048";}s:8:"add_poll";a:4:{s:8:"category";s:5:"Polls";s:4:"body";s:1529:"<include template="header" />
<form action="poll.php" method="post">
<div><input name="op" type="hidden" value="docreate" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input name="options" type="hidden" value="$options" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$thread[threadid]"><b>$thread[name]</b></a> <b>&gt; Create Poll</b>
<br />
<br /></div>
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Poll for $thread[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b><br />
<span class="small">You can give your poll a name here.</span></td>
<td><input name="name" type="text" size="60" /> <span class="small">(optional)</span></td>
</tr>
<tr>
<td><b>Poll choices:</b><br />
<a class="linksmall" href="poll.php?id=$thread[threadid]&amp;op=options">Change the number of poll options</a></td><td>$poll_options</td>
</tr>
<tr>
<td><b>Options:</b></td>
<td><input name="expire" type="checkbox" value="1" /> <span class="small">Expire after</span> <input class="small" name="days" value="0" size="3" /> <span class="small">days<br />
<input name="multiple" type="checkbox" value="1" /> Multiple choice poll</span></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Create Poll" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074815163";}s:11:"poll_option";a:4:{s:8:"category";s:5:"Polls";s:4:"body";s:76:"<if $poll_options><br />
</if><input name="poll_$i" type="text" size="60" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"thread_poll_vote";a:4:{s:8:"category";s:14:"Thread Display";s:4:"body";s:277:"<tr>
<td class="$color"><if $thread[poll_multiple]><input name="poll_$choice[ordered]" type="checkbox" value="1" /><else /><input name="choice" type="radio" value="$choice[ordered]" /></if></td><td colspan="3" class="$color" style="width: 99%"><b>$choice[choice]</b></td>
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:11:"poll_result";a:4:{s:8:"category";s:5:"Polls";s:4:"body";s:495:"<tr>
<td class="$color" style="width: 99%; text-align: right"><b>$choice[choice]</b></td>
<td class="$color" style="white-space: nowrap"><img alt="$percent%" src="$style[images]/left_$bar.gif" /><img alt="$percent%" src="$style[images]/$bar.gif" style="width: $width; height: 10px" /><img alt="$percent%" src="$style[images]/right_$bar.gif" /></td>
<td class="$color" style="text-align: center"><b>$choice[votes]</b></td>
<td class="$color" style="text-align: center"><b>$percent%</b></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055920679";}s:12:"poll_results";a:4:{s:8:"category";s:5:"Polls";s:4:"body";s:669:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$id"><b>$thread[name]</b></a> <b>&gt; Poll Results</b>
<br />
<br />
<div class="center"><table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td colspan="4" class="tableheader">$pollname</td>
</tr>
$poll_choices
<tr>
<td class="tableheader" colspan="2" style="text-align: right">Total:</td><td class="tableheader" style="white-space: nowrap">$total votes</td><td class="tableheader">100%</td>
</tr>
</table></div>
<include template="footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"reset_poll";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:621:"<include template="message_header" />
Are you sure you want to reset the poll for <b>$thread[name]</b>?<br />
<br />
<br />
<form action="moderate.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doresetpoll" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input name="page" type="hidden" value="$page" />
<input name="postid" type="hidden" value="$postid" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='thread.php?id=$thread[threadid]&amp;page=$page&amp;postid=$postid'" /></div>
</form><include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074574961";}s:19:"reset_poll_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:160:"<include template="redirect_header" />
The poll for this thread has been reset. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"moderate_poll_option";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:200:"<if $poll_options><br />
</if><input name="choice_$choice[ordered]" type="text" size="60" value="$choice[choice]" /> <input name="votes_$choice[ordered]" type="text" size="5" value="$choice[votes]" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:9:"edit_poll";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:2083:"<include template="header" />
<form action="moderate.php" method="post">
<div><input name="op" type="hidden" value="doeditpoll" />
<input name="id" type="hidden" value="$thread[threadid]" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$thread[threadid]"><b>$thread[name]</b></a> <b>&gt; Edit Poll</b>
<br />
<br /></div>
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Poll for $thread[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Name:</b><br />
<span class="small">You can give your poll a name here.</span></td>
<td><input name="name" type="text" size="60"<if $thread[poll]!="."> value="$thread[poll]"</if> /> <span class="small">(optional)</span></td>
</tr>
<tr>
<td><b>Poll choices:</b><br />
<span class="small">You can remove poll choices by clearing the field containing the choice you wish to remove. You can remove the entire poll by removing all of the choices.</span></td><td style="white-space: nowrap">$poll_options</td>
</tr>
<tr>
<td><b>Additional choices:</b></td><td><input name="add_1" type="text" size="60" /> <input name="add_votes_1" type="text" size="5" value="0" /><br />
<input name="add_2" type="text" size="60" /> <input name="add_votes_2" type="text" size="5" value="0" /></td>
</tr>
<tr>
<td><b>Options:</b></td>
<td><input name="delete_poll" type="checkbox" value="1" /> <span class="small">Delete poll<br />
<input name="expire" type="checkbox" value="1"<if $thread[poll_days]> checked="checked"</if> /> Expire after</span> <input class="small" name="days" value="$thread[poll_days]" size="3" /> <span class="small">days<br />
<input name="multiple" type="checkbox" value="1"<if $thread[poll_multiple]> checked="checked"</if> /> Multiple choice poll</span></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Update Poll" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074574583";}s:18:"edit_poll_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:146:"<include template="redirect_header" />
The poll has been updated. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"add_poll_missing";a:4:{s:8:"category";s:5:"Polls";s:4:"body";s:110:"<include template="message_header" />
You must fill in all poll choices.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"delete_poll_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:146:"<include template="redirect_header" />
The poll has been removed. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"vote_poll_missing";a:4:{s:8:"category";s:5:"Polls";s:4:"body";s:117:"<include template="message_header" />
You must choose a poll choice to vote on.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"forum_online_user";a:4:{s:8:"category";s:11:"Forum Index";s:4:"body";s:159:"<if $users><span class="small">, </span></if><a class="linksmall" href="profile.php?id=$user_result[userid]">$parsed_name</a><if $user_result[invisible]>*</if>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:6:"banned";a:4:{s:8:"category";s:0:"";s:4:"body";s:216:"<include template="message_header" />
You have been banned from this site. If you have further questions, please <a href="mailto:$config[contact]">contact the administrators</a>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"add_poll_denied";a:4:{s:8:"category";s:5:"Polls";s:4:"body";s:107:"<include template="message_header" />
This thread already has a poll.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"search_results";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:2444:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b> <a href="search.php"><b>Search</b></a> <b>&gt; Search Results</b><br />
<br />
<if $search[searchterms]>
Search for: <b>&quot;$search[searchterms]&quot;</b><if $search[searchusername]> in <if $search[type]!='title'>posts made<else />threads started</if> by: <b>&quot;$search[searchusername]&quot;</b></if><br /><br />
<else /><if $search[searchusername]>
Search for <if $search[type]!='title'>posts made<else />threads started</if> by: <b>&quot;$search[searchusername]&quot;</b><br /><br />
</if></if>
<span class="small">Number of results: $numresults</span>
<br />$search_pagenav<br /><br />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<if $op=="post"><td colspan="3" class="tableheader"><span class="small">Thread Name</span></td>
<td class="tableheader"><span class="small">Forum</span></td>
<td class="tableheader"><span class="small">Thread Starter</span></td>
<td class="tableheader"><span class="small">Replies</span></td>
<td class="tableheader"><span class="small">Views</span></td>
<td class="tableheader"><span class="small"><if $type!="post">Last </if>Post</span></td></if>
<if $op=="article"><td class="tableheader"><span class="small">Article Name</span></td><td class="tableheader"><span class="small">Author</span></td><td class="tableheader"><span class="small">Topic</span></td><td class="tableheader"><span class="small">Section</span></td><td class="tableheader"><span class="small">Posted</span></td></if>
</tr>
$results
</table>
<br />$search_pagenav<br /><br />
<if $op=="post"><table width="95%" class="foreground">
<tr>
<td style="width: 20%" class="right"><span class="small">New posts:</span></td><td><img alt="New posts" src="$style[images]/unread.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts:</span></td><td><img alt="No new posts" src="$style[images]/read.gif" /></td>
<td style="width: 20%" class="right"><span class="small">New posts (closed):</span></td><td><img alt="New posts (closed)" src="$style[images]/unread_closed.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts (closed):</span></td><td><img alt="No new posts (closed)" src="$style[images]/read_closed.gif" /></td>
</tr>
$hot_icons
</table></if>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1075075823";}s:18:"search_result_post";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:1558:"<tr>
<td class="$color"><div class="center">$isread</div></td>
<td class="$color"><div class="center"><if $result[iconid]><img alt="$result[icon_name]" src="$result[image]" /></if><if $result[poll]><img alt="Poll" src="$style[images]/poll.gif" /></if></div></td>
<td class="$color"><if $newposts><a href="thread.php?id=$result[threadid]&amp;op=newpost"><img alt="Jump to first unread post" src="$style[images]/right.gif" /></a> </if><span class="small">Thread:</span> <a class="small" href="thread.php?id=$result[threadid]">$result[name]</a><br />
<a class="linksmall" href="thread.php?postid=$result[postid]#$result[postid]">Post</a><span class="small">: (Posted by</span> <a class="linksmall" href="profile.php?id=$result[userid]">$result[username]</a> <span class="small">on $result[parsed_date])<br />
<br />
$result[shortpost]<if $dodots>...</if></span></td>
<td class="$color"><a href="forum_display.php?id=$result[forumid]">$result[forumname]</a></td>
<td class="$color"><a href="profile.php?id=$result[threaduserid]">$result[threadusername]</a></td>
<td class="$color" style="text-align: center"><a href="javascript:replies($result[threadid])">$result[replies]</a></td>
<td class="$color" style="text-align: center">$result[views]</td>
<td class="$color"><span class="small"><a href="thread.php?postid=$result[postid]#$result[postid]"><img style="vertical-align: middle" alt="Jump to post" src="$style[images]/right.gif" /></a> $result[parsed_date] by</span> <a class="linksmall" href="profile.php?id=$result[userid]">$result[username]</a></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062993336";}s:20:"search_result_thread";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:1202:"<tr>
<td class="$color"><div class="center">$isread</div></td>
<td class="$color"><div class="center"><if $result[iconid]><img alt="$result[icon_name]" src="$result[image]" /></if><if $result[poll]><img alt="Poll" src="$style[images]/poll.gif" /></if></div></td>
<td class="$color"><if $newposts><a href="thread.php?id=$result[threadid]&amp;op=newpost"><img alt="Jump to first unread post" src="$style[images]/right.gif" /></a> </if><a href="thread.php?id=$result[threadid]">$result[name]</a></td>
<td class="$color"><a href="forum_display.php?id=$result[forumid]">$result[forumname]</a></td>
<td class="$color"><a href="profile.php?id=$result[userid]">$result[username]</a></td>
<td class="$color" style="text-align: center"><a href="javascript:replies($result[threadid])">$result[replies]</a></td>
<td class="$color" style="text-align: center">$result[views]</td>
<td class="$color"><span class="small"><a href="thread.php?postid=$result[lastpostid]#$result[lastpostid]"><img style="vertical-align: middle" alt="Jump to last post" src="$style[images]/right.gif" /></a> $result[lastpostdate] by</span> <a class="linksmall" href="profile.php?id=$result[lastuserid]">$result[lastusername]</a></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:21:"search_result_ignored";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:1397:"<tr>
<td class="$color"><div class="center">$isread</div></td>
<td class="$color"><div class="center"><if $icon[iconid]><img alt="$icon[name]" src="$icon[parsed_image]" /></if><if $thread[poll]><img alt="Poll" src="$style[images]/poll.gif" /></if></div></td>
<td class="$color"><span class="small">You are ignoring this <if $type=="post">post<else />thread</if>, posted by</span> <a class="linksmall" href="profile.php?id=$result[threaduserid]">$result[threadusername]</a><span class="small">.</span> <a class="linksmall" href="thread.php?ignore=1&amp;<if $type=="post">postid=$result[postid]#$result[postid]<else />id=$result[threadid]</if>">Click here</a> <span class="small">to read the <if $type=="post">post<else />thread</if>.</span></td>
<td class="$color"><a href="forum_display.php?id=$result[forumid]">$result[forumname]</a></td>
<td class="$color"><a href="profile.php?id=$result[userid]">$result[username]</a></td>
<td class="$color" style="text-align: center">$result[replies]</td>
<td class="$color" style="text-align: center">$result[views]</td>
<td class="$color"><span class="small"><a href="thread.php?postid=$result[lastpostid]#$result[lastpostid]"><img style="vertical-align: middle" alt="Jump to last post" src="$style[images]/right.gif" /></a> $result[lastpostdate] by</span> <a class="linksmall" href="profile.php?id=$result[lastuserid]">$result[lastusername]</a></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:14:"moderate_voter";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:123:"<if $voters><span class="small">, </span></if><a class="linksmall" href="profile.php?id=$whovoted[userid]">$parsed_name</a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"moderate_whovoted_result";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:509:"<tr>
<td class="$color" style="width: 99%; text-align: right"><b>$choice[choice]</b><br />
$voters</td>
<td class="$color" style="white-space: nowrap"><img alt="$percent%" src="$style[images]/left_$bar.gif" /><img alt="$percent%" src="$style[images]/$bar.gif" style="width: $width; height: 10px" /><img alt="$percent%" src="$style[images]/right_$bar.gif" /></td>
<td class="$color" style="text-align: center"><b>$choice[votes]</b></td>
<td class="$color" style="text-align: center"><b>$percent%</b></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055920679";}s:17:"moderate_whovoted";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:666:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$id"><b>$thread[name]</b></a> <b>&gt; Who Voted</b>
<br />
<br />
<div class="center"><table width="100%" class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td colspan="4" class="tableheader">$pollname</td>
</tr>
$poll_choices
<tr>
<td class="tableheader" colspan="2" style="text-align: right">Total:</td><td class="tableheader" style="white-space: nowrap">$total votes</td><td class="tableheader">100%</td>
</tr>
</table></div>
<include template="footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"remind_password";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:476:"<include template="message_header" />
Please enter the email address you used when you registered for your account. A new password will be sent to you at this email address.<br />
<br />
<form action="user.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doremind" />
<b>Email address:</b> <input name="email" type="text" size="60" /><br />
<br />
<input type="submit" value="Send Password" />
</div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073350920";}s:24:"remind_password_disabled";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:222:"<include template="message_header" />
The forgotten password reminder has been disabled. Please <a href="mailto:$config[contact]">contact the administrators</a> for further assistance.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:23:"remind_password_invalid";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:122:"<include template="message_header" />
A user with that email address does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"remind_password_complete";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:133:"<include template="message_header" />
A password reminder email has been sent to <b>$email</b>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"get_password_complete";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:181:"<include template="message_header" />
Your new password is <b>$password</b>. <a href="user.php">Click here</a> to go to the user control panel.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"get_password_invalid";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:139:"<include template="message_header" />
The userid/activation key combination specified does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"email_duplicate";a:4:{s:8:"category";s:0:"";s:4:"body";s:113:"<include template="message_header" />
That email address is already in use.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"account_illegal_name";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:127:"<include template="message_header" />
The specified username is not allowed on this site.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1071348286";}s:14:"account_length";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:198:"<include template="message_header" />
Your username must be between <b>$config[min_username_length]</b> and <b>$config[max_username_length]</b> characters long.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"search_length";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:190:"<include template="message_header" />
Search terms must be at least <b>$config[min_search_length]</b> characters long, and specified user(s) must exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"floodcheck";a:4:{s:8:"category";s:0:"";s:4:"body";s:153:"<include template="message_header" />
You must wait at least <b>$config[floodcheck_time]</b> seconds between posts.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:12:"email_banned";a:4:{s:8:"category";s:0:"";s:4:"body";s:111:"<include template="message_header" />
Your email address has been banned.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"send_pm_length";a:4:{s:8:"category";s:6:"New PM";s:4:"body";s:160:"<include template="message_header" />
Your private message cannot be longer than <b>$config[pm_max_length]</b> characters.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"attachment_type";a:4:{s:8:"category";s:11:"Attachments";s:4:"body";s:213:"<include template="message_header" />
Your attachment was of type <b>$attachment_type</b>. Your attachment must be one of the following types: <b>$config[attachment_types]</b>
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"attachment_dimensions";a:4:{s:8:"category";s:11:"Attachments";s:4:"body";s:182:"<include template="message_header" />
Your attachment must be no larger than <b>$config[attachment_width]</b>x<b>$config[attachment_height]</b>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:15:"attachment_size";a:4:{s:8:"category";s:11:"Attachments";s:4:"body";s:149:"<include template="message_header" />
Your attachment can be no larger than <b>$config[attachment_size] KB</b>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"invalid_forum";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:111:"<include template="message_header" />
The specified forum does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"forumdisplay_announcement";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:548:"<tr>
<td class="$color"><div class="center"><img alt="Announcement" src="$style[images]/announcement.gif" /></div></td><td class="$color"></td>
<td class="$color"><b>Announcement:</b> <a href="announcement.php?id=$forum[forumid]"><b>$announcement[name]</b></a></td>
<td class="$color"><a href="profile.php?id=$announcement[userid]">$announcement[username]</a></td>
<td class="$color" style="text-align: center">-</td>
<td class="$color" style="text-align: center">-</td>
<td class="$color"><span class="small">$announcement[start]</span></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055920679";}s:18:"announcement_index";a:4:{s:8:"category";s:20:"Announcement Display";s:4:"body";s:597:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <b>Announcements</b>
<br />
<br />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" width="100%" class="tableline">
<tr>
<td class="tableheader"><span class="small">Poster</span></td>
<td class="tableheader"><span class="small">Post</span></td>
</tr>
$announcements
</table><br />
<table class="foreground" width="100%">
<tr valign="bottom">
<td><include template="forumjump" /></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:25:"announcement_announcement";a:4:{s:8:"category";s:20:"Announcement Display";s:4:"body";s:1742:"<tr valign="top">
<td class="$color" style="width: 175px; text-align:center"><a href="profile.php?id=$announcement[userid]"><b>$announcement[parsed_name]</b></a>
<br />
<span class="small">$announcement[title]
<br />
<br />
<if ($announcement[parsed_avatar] && $user[show_avatars])>
<img alt="$announcement[username]'s avatar" src="$announcement[parsed_avatar]" /><br />
</if>
<br />
Joined: $announcement[joindate]<br />
<if $announcement[location]>Location: $announcement[location]<br /></if>
Posts: $announcement[posts]<br />
Status: <if $isonline><b>Online</b><else />Offline</if></span></td>
<td class="$color"><b>$announcement[name]</b><br />
<br />
$announcement[body]</td>
</tr>
<tr><td class="$color" style="width: 175px; white-space: nowrap"><span class="small">$announcement[start] to $announcement[end]</span></td>
<td class="$color"><if $announcement[userid]><a href="profile.php?id=$announcement[userid]"><img alt="View profile for $announcement[username]" src="$style[images]/profile.gif" /></a></if><if $showpm> <a href="newpm.php?userid=$announcement[userid]"><img alt="Send $announcement[username] a private message" src="$style[images]/pm.gif" /></a></if><if $showemail> <a href="email.php?id=$announcement[userid]"><img alt="Send $announcement[username] an email" src="$style[images]/email.gif" /></a></if><if $announcement[website]> <a href="$announcement[website]" onclick="window.open(this.href,'_blank');return false;"><img alt="$announcement[website]" src="$style[images]/website.gif" /></a></if><if $showsearch> <a href="search.php?op=post&amp;type=post&amp;sort=desc&amp;userid=$announcement[userid]"><img alt="Search for posts made by $announcement[username]" src="$style[images]/search.gif" /></a></if></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073768820";}s:15:"forumnav_nolink";a:4:{s:8:"category";s:10:"Navigation";s:4:"body";s:54:" <b title="$forumnav[description]">$forumnav[name]</b>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:14:"invalid_thread";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:112:"<include template="message_header" />
The specified thread does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"invalid_download_category";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:123:"<include template="message_header" />
The specified download category does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"invalid_link_category";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:119:"<include template="message_header" />
The specified link category does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"mail_emailverify";a:4:{s:8:"category";s:13:"Mail Messages";s:4:"body";s:399:"Welcome to $config[name]! Before you can participate in certain activities on the forum, you must verify your email address. To do this, simply go to this page: $config[url]/user.php?op=emailverify&userid=$user[userid]&key=$key

AOL users, click here: <a href="$config[url]/user.php?op=emailverify&userid=$user[userid]&key=$key">$config[url]/user.php?op=emailverify&userid=$user[userid]&key=$key</a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:28:"register_account_emailverify";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:356:"<include template="message_header" />
Thank you for registering! Before doing certain things on the forum, you must verify your email address. An email has been sent to the address you used to sign up, with instructions on how to verify your account. <a href="user.php">Click here</a> to go to your user control panel.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:25:"activate_account_redirect";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:161:"<include template="redirect_header" />
Your account has been activated. You are now being taken to the user control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"activate_account_invalid";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:111:"<include template="message_header" />
That activation key does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1057714552";}s:10:"nav_header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:2154:"<include template="header" />
<table cellpadding="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="0" style="width: $style[sidebar]">
<tr>
<td class="cellalt"><table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td><table class="cellalt" cellpadding="$style[cellpadding]" width="100%">
<tr>
<td class="tableheader"><a href="$relativeurl/index.php" class="linkheader">Main Menu</a></td>
</tr>
<tr>
<td><a href="$relativeurl/index.php">Home</a><br />
<a href="$relativeurl/forum.php">Forum</a><br />
<a href="$relativeurl/downloads.php">Downloads</a><br />
<a href="$relativeurl/links.php">Links</a><br />
<a href="$relativeurl/sections.php">Sections</a><br />
<a href="$relativeurl/topics.php">Topics</a><br />
<a href="$relativeurl/user.php">User control panel</a></td>
</tr>
<if $nav_downloads><tr>
<td class="tableheader"><a href="$relativeurl/downloads.php" class="linkheader">Downloads</a></td>
</tr>
<tr>
<td class="cellalt">$nav_downloads</td>
</tr></if>
<if $nav_links><tr>
<td class="tableheader"><a href="$relativeurl/links.php" class="linkheader">Links</a></td>
</tr>
<tr>
<td class="cellalt">$nav_links</td>
</tr></if>
<if $nav_sections><tr>
<td class="tableheader"><a href="$relativeurl/sections.php" class="linkheader">Sections</a></td>
</tr>
<tr>
<td>$nav_sections</td>
</tr></if>
<if $pmenabled><tr>
<td class="tableheader"><a href="$relativeurl/pm.php" class="linkheader">Private Messages</a></td>
</tr>
<tr>
<td class="cellalt">You have <b>$num_pm</b> unread message<if $num_pm!=1>s</if>.</td>
</tr></if>
<if ($config[whos_online] && $config[sidebar_online])><tr>
<td class="tableheader"><a href="$relativeurl/online.php" class="linkheader">Who's Online</a></td>
</tr>
<tr>
<td class="cellalt">There <if $num_users_online==1>is<else />are</if> currently <b>$num_users_online</b> user<if $num_users_online!=1>s</if> and <b>$num_guests_online</b> guest<if $num_guests_online!=1>s</if> online, for a total of <b>$total_online</b> <if $total_online==1>person<else />people</if>.</td>
</tr></if>
<include template="form_footer" />
</table></td>
<td class="foreground" style="width: 95%">";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"nav_footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:50:"</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"newreply_post";a:4:{s:8:"category";s:9:"New Reply";s:4:"body";s:354:"<tr valign="top">
<td class="$color"><if $post[userid]><a href="profile.php?id=$post[userid]">$post[parsed_name]</a><else /><b>$post[username]</b></if></td>
<td class="$color"><if $post[iconid]><img alt="$post[icon_name]" src="$post[image]" /></if><if $post[subject]>
 <b>$post[subject]</b></if><if $showbreaks><br /><br /></if>
$post[message]</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:21:"newreply_post_ignored";a:4:{s:8:"category";s:9:"New Reply";s:4:"body";s:168:"<tr valign="top">
<td class="$color"><a href="profile.php?id=$post[userid]"><b>$post[parsed_name]</b></a></td>
<td class="$color">You are ignoring this post.</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:16:"newthreads_index";a:4:{s:8:"category";s:16:"View New Threads";s:4:"body";s:1727:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt; New Threads</b><br />
<br />
<if $threads><if $thread_pagenav><br />$thread_pagenav<br /></if><br />
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td colspan="3" class="tableheader"><span class="small">Thread Name</span></td>
<td class="tableheader"><span class="small">Forum</span></td>
<td class="tableheader"><span class="small">Thread Starter</span></td>
<td class="tableheader"><span class="small">Replies</span></td>
<td class="tableheader"><span class="small">Views</span></td>
<td class="tableheader"><span class="small">Last Post</span></td>
</tr>
$threads
</table>
<br />$thread_pagenav
<div class="center"><a href="forum.php?op=markread">Mark all forums as read</a></div>
<br />
<else />
<div class="center"><b>There have been no new posts since your last visit.</b></div></if><br />
<table width="95%" class="foreground">
<tr>
<td style="width: 20%" class="right"><span class="small">New posts:</span></td><td><img alt="New posts" src="$style[images]/unread.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts:</span></td><td><img alt="No new posts" src="$style[images]/read.gif" /></td>
<td style="width: 20%" class="right"><span class="small">New posts (closed):</span></td><td><img alt="New posts (closed)" src="$style[images]/unread_closed.gif" /></td>
<td style="width: 20%" class="right"><span class="small">No new posts (closed):</span></td><td><img alt="No new posts (closed)" src="$style[images]/read_closed.gif" /></td>
</tr>
$hot_icons
</table>
<include template="footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074791449";}s:17:"newthreads_thread";a:4:{s:8:"category";s:16:"View New Threads";s:4:"body";s:1279:"<tr>
<td class="$color"><div class="center">$isread</div></td>
<td class="$color"><div class="center"><if $thread[iconid]><img alt="$thread[icon_name]" src="$thread[image]" /></if><if $thread[poll]><img alt="Poll" src="$style[images]/poll.gif" /></if></div></td>
<td class="$color"><a href="thread.php?id=$thread[threadid]&amp;op=newpost"><img alt="Jump to first unread post" src="$style[images]/right.gif" /></a> <a href="thread.php?id=$thread[threadid]">$thread[name]</a><if $multipage_nav> <span class="small">(</span> $multipage_nav<span class="small">)</span></if></td>
<td class="$color"><a href="forum_display.php?id=$thread[forumid]">$thread[forumname]</a></td>
<td class="$color"><a href="profile.php?id=$thread[userid]">$thread[username]</a></td>
<td class="$color" style="text-align: center"><a href="javascript:replies($thread[threadid])">$thread[replies]</a></td>
<td class="$color" style="text-align: center">$thread[views]</td>
<td class="$color"><span class="small"><a href="thread.php?postid=$thread[lastpostid]#$thread[lastpostid]"><img style="vertical-align: middle" alt="Jump to last post" src="$style[images]/right.gif" /></a> $thread[lastpostdate] by</span> <a class="linksmall" href="profile.php?id=$thread[lastuserid]">$thread[lastusername]</a></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:5:"rules";a:4:{s:8:"category";s:0:"";s:4:"body";s:105:"//*Forum Rules
<include template="message_header" />
$config[rules]
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062645408";}s:13:"main_headline";a:4:{s:8:"category";s:9:"Main Page";s:4:"body";s:92:"<if $headlines><br />
</if>&bull; <a href="#article_$article[articleid]">$article[title]</a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:22:"mail_emailnotification";a:4:{s:8:"category";s:13:"Mail Messages";s:4:"body";s:389:"$user[name] has replied to a thread you subscribed to, entitled "$thread[name]":

$message

You can view the post at $config[url]/thread.php?postid=$post[postid]#$post[postid]

AOL users, click here: <a href="$config[url]/thread.php?postid=$post[postid]#$post[postid]">$config[url]/thread.php?postid=$post[postid]#$post[postid]</a>

You can also unsubscribe from the thread from that page.";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:21:"mail_passwordreminder";a:4:{s:8:"category";s:13:"Mail Messages";s:4:"body";s:468:"Someone has requested a new password for your account ($user_result[name]) at $config[name]. If you did not request a new password, simply ignore this email; your password has not been given out or modified. If you would like a new password, please click the following link:

$config[url]/user.php?op=getpassword&userid=$user_result[userid]&key=$key

AOL users, <a href="$config[url]/user.php?op=getpassword&userid=$user_result[userid]&key=$key">please click here</a>.";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"replies_user";a:4:{s:8:"category";s:11:"Who Replied";s:4:"body";s:195:"<tr>
<td class="$color"><a href="profile.php?id=$user_result[userid]" onclick="window.open(this.href,'_blank');return false;">$user_result[username]</a></td><td class="$color">$replies</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074821021";}s:12:"popup_header";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:637:"<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=$style[charset]" />
<if $pagestyle && !$config[external_style]><style type="text/css" media="all">
$pagestyle
</style><else /><link rel="stylesheet" media="all" type="text/css" href="$relativeurl/styles.php" /></if>
<title>
$config[name] - $pagetitle
</title>
</head>
<body>
<table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="foreground" width="100%">
<tr>
<td>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074809574";}s:12:"popup_footer";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:42:"<br /></td>
</tr>
</table>
</body>
</html>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"replies_index";a:4:{s:8:"category";s:11:"Who Replied";s:4:"body";s:593:"<include template="popup_header" />
<b>Who Replied - <a href="thread.php?id=$thread[threadid]" onclick="window.open(this.href,'_blank');return false;">$thread[name]</a></b><br />
<br />
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline" width="100%">
<tr>
<td class="tableheader"><span class="small">Username</span></td><td class="tableheader"><span class="small">Replies</span></td>
</tr>
$users
</table><br />
<a class="linksmall" href="javascript:window.close()">[Close this window]</a></div>
<include template="popup_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062967279";}s:11:"pm_disabled";a:4:{s:8:"category";s:0:"";s:4:"body";s:133:"<include template="message_header" />
You have disabled private messaging in your user options.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"edit_profile_email";a:4:{s:8:"category";s:12:"Edit Profile";s:4:"body";s:380:"<include template="message_header" />
Your profile has been successfully edited. However, you changed your email address, and as a result, you must verify your new address. An email has been dispatched to your new address with instructions on how to reactivate your account. <a href="user.php">Click here</a> to go to your user control panel.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"mail_emailreverify";a:4:{s:8:"category";s:13:"Mail Messages";s:4:"body";s:353:"Because you have changed your email address, you must verify your new address. To do this, simply go to this page: $config[url]/user.php?op=emailverify&userid=$user[userid]&key=$key

AOL users, click here: <a href="$config[url]/user.php?op=emailverify&userid=$user[userid]&key=$key">$config[url]/user.php?op=emailverify&userid=$user[userid]&key=$key</a>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1057713959";}s:15:"sidebar_section";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:107:"<if $nav_sections><br />
</if><a href="$relativeurl/sections.php?id=$section[sectionid]">$section[name]</a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:16:"sidebar_download";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:120:"<if $nav_downloads><br />
</if><a href="$relativeurl/downloads.php?id=$category[downloadcategoryid]">$category[name]</a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:27:"templateset_default_invalid";a:4:{s:8:"category";s:0:"";s:4:"body";s:189:"<include template="message_header" />
The default template file is missing. Please redownload Deluxe Portal and upload template.dpt.php to your server.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:26:"search_result_article_full";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:531:"<tr>
<td class="$color"><a href="article.php?id=$result[articleid]"><b>$result[title]</b></a><br />
<span class="small">$result[shortbody]<if $dodots>...</if></span></td>
<td class="$color"><a href="profile.php?id=$result[userid]">$result[username]</a></td>
<td class="$color"><if $topic><a href="topics.php?id=$result[topicid]">$topic[name]</a><else />None</if></td>
<td class="$color"><if $section><a href="sections.php?id=$result[sectionid]">$section[name]</a><else />None</if></td>
<td class="$color">$result[posted]</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062993224";}s:21:"search_result_article";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:452:"<tr>
<td class="$color"><a href="article.php?id=$result[articleid]">$result[title]</a></td>
<td class="$color"><a href="profile.php?id=$result[userid]">$result[username]</a></td>
<td class="$color"><if $topic><a href="topics.php?id=$result[topicid]">$topic[name]</a><else />None</if></td>
<td class="$color"><if $section><a href="sections.php?id=$result[sectionid]">$section[name]</a><else />None</if></td>
<td class="$color">$result[posted]</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062993187";}s:13:"smilie_column";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:277:"<td class="center"><a href="javascript://" onclick="smilie('$smilie[escaped_tag]', this.getElementsByTagName('img')[0].src); return false;"><img alt="<if $showtags>$smilie[name]<else />$smilie[tag]</if>" src="$smilie[image]" /></a></td>
<if $showtags><td>$smilie[tag]</td></if>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1071715508";}s:10:"smilie_row";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:22:"<tr>
$smilie_row
</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"smilie_box";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:618:"<br />
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
</table></div>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1060802243";}s:18:"send_pm_recipients";a:4:{s:8:"category";s:6:"New PM";s:4:"body";s:169:"<include template="message_header" />
You may send private messages to no more than <b>$group[max_recipients]</b> people at a time.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"smilie_index";a:4:{s:8:"category";s:7:"Smilies";s:4:"body";s:584:"<include template="popup_header" />
<script type="text/javascript" src="$relativeurl/javascript/smilies.js"></script>
<div class="center"><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader" colspan="$config[smilies_row]">Smilies</td>
</tr>
<include template="form_header" />
$smilies
<include template="form_footer" />
</table></div><br />
<div class="center"><a class="linksmall" href="javascript://" onclick="window.opener=self; window.close();">[Close this window]</a></div>
<include template="popup_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074969900";}s:14:"send_pm_failed";a:4:{s:8:"category";s:6:"New PM";s:4:"body";s:373:"<include template="message_header" />
<if $numfailed==$num_users>None of the recipients listed were able to receive your message. <else />The following users were not able to receive the message:<br />
<br />
<b>$failed</b><br /></if>
This may be because they do not have private messaging enabled, or the specified users do not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"report_index";a:4:{s:8:"category";s:11:"Report Post";s:4:"body";s:933:"<include template="header" />
<form action="report.php" method="post">
<div><input name="op" type="hidden" value="doreport" />
<input name="id" type="hidden" value="$post[postid]" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$thread[threadid]"><b>$thread[name]</b></a> <b>&gt; Report Post</b>
<br />
<br /></div>
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Report post to a moderator</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Reason for reporting post: (optional)</b></td>
<td><textarea name="message" cols="70" rows="20"></textarea></td>
</tr>
<tr>
<td class="center" colspan="2">
<input type="submit" value="Report Post" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1066488016";}s:20:"report_post_redirect";a:4:{s:8:"category";s:11:"Report Post";s:4:"body";s:179:"<include template="redirect_header" />
The moderators have been notified of the post you reported. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:12:"sidebar_link";a:4:{s:8:"category";s:19:"Headers and Footers";s:4:"body";s:108:"<if $nav_links><br />
</if><a href="$relativeurl/links.php?id=$category[linkcategoryid]">$category[name]</a>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:18:"invalid_attachment";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:116:"<include template="message_header" />
The specified attachment does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:12:"article_page";a:4:{s:8:"category";s:15:"Article Display";s:4:"body";s:89:"<option value="$i"<if $page==$i> selected="selected"</if>>Page $i - $articlepage</option>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"mail_pmnotification";a:4:{s:8:"category";s:13:"Mail Messages";s:4:"body";s:385:"$user[name] has sent you a private message, entitled "$mailsubject".

You can view the message at $config[url]/readpm.php?id=$pm[privatemessageid]

AOL users, click here: <a href="$config[url]/readpm.php?id=$pm[privatemessageid]">$config[url]/readpm.php?id=$pm[privatemessageid]</a>

You can turn off these notifications by going to your user control panel and clicking "Edit Options".";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:19:"unsubscribe_threads";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:406:"<include template="message_header" />
Are you sure you want to unsubscribe from all of your subscribed threads?<br />
<br />
<br />
<form action="user.php" method="post">
<input name="op" type="hidden" value="dounsubscribe" />
<div class="center"><input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='user.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1063167150";}s:18:"unsubscribe_emails";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:411:"<include template="message_header" />
Are you sure you want to stop receiving all current email notifications?<br />
<br />
<br />
<form action="user.php" method="post">
<input name="op" type="hidden" value="dounsubscribe_email" />
<div class="center"><input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='user.php'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1063166416";}s:27:"unsubscribe_emails_redirect";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:183:"<include template="redirect_header" />
All current email subscriptions have been removed. You are now being returned to your user control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:28:"unsubscribe_threads_redirect";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:176:"<include template="redirect_header" />
All thread subscriptions have been removed. You are now being returned to your user control panel.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:13:"email_invalid";a:4:{s:8:"category";s:0:"";s:4:"body";s:117:"<include template="message_header" />
The specified email address is not valid.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"printthread_index";a:4:{s:8:"category";s:12:"Print Thread";s:4:"body";s:2654:"<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=$style[charset]" />
<style type="text/css" media="all">
img {border: 0}
</style>
<title>
$config[name] - $pagetitle
</title>
</head>
<body>
<div>
<a href="$relativeurl/index.php"><img alt="$config[name]" src="$style[logo]" /></a><br />
<br />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$thread[threadid]&amp;page=$page"><b>$thread[name]</b></a><br />
<br />
<br />
<if $thread[poll]><div class="center"><table width="100%" style="background-color: #A0A0A0" cellspacing="1" cellpadding="4">
<tr>
<td colspan="4" style="background-color: #E9E9E9; text-align: center"><b>$name</b></td>
</tr>
$poll_choices
<tr>
<td colspan="2" style="text-align: right; background-color: #E9E9E9"><b>Total:</b></td><td style="white-space: nowrap; background-color: #E9E9E9"><b>$total votes</b></td><td style="background-color: #E9E9E9"><b>100%</b></td>
</tr>
</table></div><br />
<br /></if>
<if $thread_pagenav>$thread_pagenav<br /><br /></if>
<table cellspacing="1" cellpadding="4" width="100%" style="background-color: #A0A0A0">
$posts
</table>
<if $thread_pagenav><br />$thread_pagenav<br /><br /></if>
</div>
<div style="text-align: center"><br />
<br />
<if $config[show_querycounter]>Number of queries: $query_counter<br />
Execution time: $execution_time ($php_execution_percentage% PHP - $sql_execution_percentage% SQL)<br />
Number of Templates Included: $totaltemplates<br />
<if $alltemplates><b>There were uncached templates on this page!</b><br /></if>
<br /></if>
<if ($config[show_querycounter] && (!$config[listqueries] || $group[configuration]))>[<a class="backgroundlink" href="<if (strstr($listqueries_url, '?'))>$listqueries_url&amp;explain=1<else />$listqueries_url?explain=1</if>">List Queries</a>]<br />
<br /></if>
&laquo; <a href="mailto:$config[contact]"><b>Contact Us</b></a> - <a href="$relativeurl/faq.php?faq=userfaq"><b>FAQ</b></a> - <a href="index.php"><b>$config[name]</b></a> - <a href="forum.php"><b>$config[name] Forums</b></a> &raquo;
<br />
<br />
Powered by <a href="http://www.deluxeportal.net" onclick="window.open(this.href,'_blank');return false;">Deluxe Portal</a>, Version $config[version]
<br />
Copyright &copy;2002-2006 <a href="http://www.nomative.com" onclick="window.open(this.href,'_blank');return false;">Nomative Systems<br />
$config[copyright]<br />
<br />
</div>
</body>
</html>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1144561570";}s:19:"printthread_pagenav";a:4:{s:8:"category";s:12:"Print Thread";s:4:"body";s:109:"Pages ($numpages): $pagenav - <a href="print_thread.php?id=$thread[threadid]&amp;page=all">Show all posts</a>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058154179";}s:16:"printthread_post";a:4:{s:8:"category";s:12:"Print Thread";s:4:"body";s:327:"<tr>
<td style="background-color: #E9E9E9">Posted by <b>$post[username]</b> on $post[postdate]</td>
</tr>
<tr>
<td style="background-color: #FFFFFF"><if $post[iconid]><img alt="$post[icon_name]" src="$post[image]" /></if><if $post[subject]>
 <b>$post[subject]</b></if><if $showbreaks><br /><br /></if>
$post[message]</td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073282400";}s:24:"moderate_delete_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:639:"<include template="message_header" />
Are you sure you want to delete the redirect for thread <b>$thread[name]</b>?<br />
<br />
<br />
<form action="moderate.php" method="post">
<div class="center">
<input name="op" type="hidden" value="dodeleteredirect" />
<input name="id" type="hidden" value="$thread[threadid]" />
<input name="page" type="hidden" value="$page" />
<input name="postid" type="hidden" value="$postid" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="window.location='thread.php?id=$thread[threadid]&amp;page=$page&amp;postid=$postid'" /></div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074575063";}s:20:"moderate_no_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:123:"<include template="message_header" />
The specified thread has no redirect to delete.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:24:"delete_redirect_redirect";a:4:{s:8:"category";s:17:"Moderator Options";s:4:"body";s:175:"<include template="redirect_header" />
The redirect for the specified thread has been deleted. You are now being returned to the thread.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:9:"forumjump";a:4:{s:8:"category";s:10:"Forum Jump";s:4:"body";s:959:"<span class="small">Forum Jump:</span><br />
<script type="text/javascript">
<!--
	function forumJump(page)
	{
		if (page!='-1')
			window.location.href = page;
	}
//-->
</script>
<select id="forumjump" onchange="forumJump(this.options[this.selectedIndex].value)" class="small">
<optgroup title="Site Options" label="Site Options">
<option value="index.php">Main Page</option>
<option value="forum.php">Forum Home</option>
<option value="search.php">Search Site</option>
<option value="online.php">Who's Online</option>
<option value="user.php">User Control Panel</option>
<option value="pm.php">Private Messages</option>
<option value="newthreads.php">View Newest Threads</option>
<option value="-1">----------------</option>
</optgroup>
<optgroup title="Forums" label="Forums">
$forumjump
</optgroup>
</select>
<input type="button" onclick="forumJump(getElement('forumjump').options[getElement('forumjump').selectedIndex].value)" value="Go" class="small" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074825606";}s:13:"image_missing";a:4:{s:8:"category";s:0:"";s:4:"body";s:102:"<include template="message_header" />
You must provide an image.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:22:"login_account_password";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:457:"<include template="message_header" />
The password you gave is incorrect.<if $config[login_fail]> You have used <b>$numfailed</b> out of <b>$config[login_fail]</b> attempts. <if ($numfailed>=$config[login_fail])>You may not log in for another <b>$config[login_failtime]</b> minutes.<else />If you use all $config[login_fail] attempts, you will not be able to log in for <b>$config[login_failtime]</b> minutes.</if></if>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1060386543";}s:22:"login_account_attempts";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:174:"<include template="message_header" />
You have used all of your login attempts. You may not log in for another <b>$failtime</b> minutes.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1060386488";}s:14:"post_codeblock";a:4:{s:8:"category";s:0:"";s:4:"body";s:184:"<blockquote><div class="small">Code:</div><div><hr /><pre style="white-space: pre; font:12px Courier New, courier, serif; margin:0; padding:0;">$codetext</pre><hr /></div></blockquote>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074975429";}s:13:"post_phpblock";a:4:{s:8:"category";s:0:"";s:4:"body";s:182:"<blockquote><div class="small">PHP:</div><div><hr /><pre style="white-space: pre; font:12px Courier New, courier, serif; margin:0; padding:0;">$phptext</pre><hr /></div></blockquote>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074975457";}s:10:"email_form";a:4:{s:8:"category";s:13:"Email Display";s:4:"body";s:971:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b> <a href="profile.php?id=$user[userid]"><b>User Profile</b></a> <b>&gt; Email User</b><br />
<br />
<form action="email.php" method="post">
<div class="center">
<input name="op" type="hidden" value="doemail" />
<input name="id" type="hidden" value="$user_result[userid]" />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="tableheader">Email $user_result[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Subject:</b></td><td><input name="subject" type="text" size="80" /></td>
</tr>
<tr>
<td><b>Message:</b></td><td><textarea name="message" cols="70" rows="20"></textarea></td>
</tr>
<tr>
<td colspan="2" class="center"><input type="submit" value="Send Email" /></td>
</tr>
<include template="form_footer" />
</table></div></form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1073888340";}s:19:"email_send_redirect";a:4:{s:8:"category";s:13:"Email Display";s:4:"body";s:187:"<include template="redirect_header" />
Your email has been sent to <b>$user_result[name]</b>. You are now being returned to his or her profile page.
<include template="redirect_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:22:"register_account_comma";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:202:"<include template="message_header" />
You may not have a comma (<b>,</b>) in your name. This character is used to separate user names when sending private messages.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:9:"main_date";a:4:{s:8:"category";s:9:"Main Page";s:4:"body";s:82:"<b>Articles from $date[articles_date]:</b><br /><br /><br />
$date[articles]<br />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:8:"icon_row";a:4:{s:8:"category";s:5:"Icons";s:4:"body";s:18:"<tr>$icon_row</tr>";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:10:"icon_table";a:4:{s:8:"category";s:5:"Icons";s:4:"body";s:254:"<tr>
<td style="white-space: nowrap"><b>Icon:</b><br />
<input name="iconid" type="radio" value="0"<if !$iconid> checked="checked"</if> /> <span class="small">No icon</span></td>
<td><table style="text-align:left; margin-left:0">$icons</table></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062725270";}s:23:"printthread_poll_result";a:4:{s:8:"category";s:12:"Print Thread";s:4:"body";s:543:"<tr>
<td style="width: 99%; text-align: right; background-color: #FFFFFF"><b>$choice[choice]</b></td>
<td style="white-space: nowrap; background-color: #FFFFFF"><img alt="$percent%" src="$style[images]/left_$bar.gif" /><img alt="$percent%" src="$style[images]/$bar.gif" style="width: $width; height: 10px" /><img alt="$percent%" src="$style[images]/right_$bar.gif" /></td>
<td style="text-align: center; background-color: #FFFFFF"><b>$choice[votes]</b></td>
<td style="text-align: center; background-color: #FFFFFF"><b>$percent%</b></td>
</tr>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055920679";}s:11:"server_busy";a:4:{s:8:"category";s:0:"";s:4:"body";s:134:"<include template="message_header" />
The server is currently too busy. Please check back later.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:17:"server_busy_guest";a:4:{s:8:"category";s:0:"";s:4:"body";s:219:"<include template="message_header" />
The server is currently too busy, so guest access has been blocked. Please register for an account by <a href="register.php">clicking here</a>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:21:"editprofile_signature";a:4:{s:8:"category";s:12:"Edit Profile";s:4:"body";s:287:"<include template="message_header" />
Your signature may not exceed <if $config[sig_lines]><b>$config[sig_lines]</b> lines</if><if ($config[sig_lines] && $config[sig_chars])> and </if><if $config[sig_chars]><b>$config[sig_chars]</b> characters</if>.
<include template="message_footer" />";s:17:"lastedit_username";s:0:"";s:13:"lastedit_date";s:1:"0";}s:20:"forum_forum_subforum";a:4:{s:8:"category";s:11:"Forum Index";s:4:"body";s:109:"<if $subforums>, </if><a class="linksmall" href="forum_display.php?id=$subforum[forumid]">$subforum[name]</a>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1055865273";}s:27:"forumdisplay_forum_subforum";a:4:{s:8:"category";s:13:"Forum Display";s:4:"body";s:118:"<if $subsubforums>, </if><a class="linksmall" href="forum_display.php?id=$subsubforum[forumid]">$subsubforum[name]</a>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1055866325";}s:9:"faq_index";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:369:"<include template="header" />
<a href="$relativeurl/index.php"><b>$config[name]</b></a> <b>&gt; $faq[name]</b><br />
<br />
<table width="100%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">$faq[name]</td>
</tr>
<tr>
<td class="cellmain">$categories</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055868719";}s:12:"faq_category";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:138:"<if $categories><br />
<br /></if>
<a href="faq.php?faq=$faq[shortname]&amp;id=$category[faqcategoryid]"><b>$category[name]</b></a>
$items";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055869144";}s:8:"faq_item";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:168:"<br />
&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a class="linksmall" href="faq.php?faq=$faq[shortname]&amp;id=$category[faqcategoryid]#item_$item[faqitemid]">$item[name]</a>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055868898";}s:11:"invalid_faq";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:109:"<include template="message_header" />
The specified FAQ does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055869039";}s:17:"faq_show_category";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:559:"<include template="header" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="faq.php?faq=$faq[shortname]"><b>$faq[name]</b></a> <b>&gt; $category[name]</b><br />
<br />
<table width="100%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader"><a name="top"></a>$category[name]</td>
</tr>
<tr>
<td class="cellmain">$toc<br />
<a class="linksmall" href="faq.php?faq=$faq[shortname]">Return to the $faq[name] index</a></td>
</tr>
</table><br />
$items
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055870479";}s:7:"faq_toc";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:108:"&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a class="linksmall" href="#item_$item[faqitemid]">$item[name]</a><br />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055870501";}s:17:"faq_item_contents";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:387:"<if ($items || !$faq[tree])><br /></if>
<table width="100%" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader"><a name="item_$item[faqitemid]"></a><a name="$item[anchor]"></a>$item[name]</td>
</tr>
<tr>
<td class="cellmain">$item[content]<br />
<br />
<a class="linksmall" href="#top">Return to top</a></td>
</tr>
</table>";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1058850506";}s:13:"faq_item_tree";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:141:"<if $items>,</if>['<a href="faq.php?faq=$faq[shortname]&amp;id=$category[faqcategoryid]#item_$item[faqitemid]"><i>$item[name]</i></a>', null]";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055873291";}s:17:"faq_category_tree";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:145:"<if $categories>,</if>['<a href="faq.php?faq=$faq[shortname]&amp;id=$category[faqcategoryid]">$category[name]</a>', null<if $items>, $items</if>]";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055873911";}s:14:"faq_index_tree";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:569:"<include template="header" />
<script type="text/javascript" src="javascript/tree.js"></script>
<script type="text/javascript" src="javascript/tree_tpl.js"></script>
<a href="index.php"><b>$config[name]</b></a> <b>&gt; $faq[name]</b>
<br />
<br />
<table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain"><script type="text/javascript">
<!--
var TREE_ITEMS = [['<b>$faq[tree_name]</b>', null, $categories]];
new tree (TREE_ITEMS, tree_tpl);
//-->
</script></td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074966048";}s:22:"faq_show_category_tree";a:4:{s:8:"category";s:10:"FAQ Viewer";s:4:"body";s:775:"<include template="header" />
<script type="text/javascript" src="javascript/tree.js"></script>
<script type="text/javascript" src="javascript/tree_tpl.js"></script>
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="faq.php?faq=$faq[shortname]"><b>$faq[name]</b></a> <b>&gt; $category[name]</b>
<br />
<br />
<table cellpadding="5">
<tr valign="top">
<td><table class="tableline" cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]">
<tr>
<td class="cellmain" style="white-space: nowrap"><script type="text/javascript">
<!--
var TREE_ITEMS = [['<b>$faq[tree_name]</b>', null, $categories]];
new tree (TREE_ITEMS, tree_tpl);
//-->
</script></td>
</tr>
</table></td>
<td><a name="top"></a>
$items</td>
</tr>
</table>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1061947661";}s:18:"server_busy_search";a:4:{s:8:"category";s:6:"Search";s:4:"body";s:153:"<include template="message_header" />
The server is currently too busy to process searches. Please try again later.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1055890817";}s:28:"register_account_imageverify";a:4:{s:8:"category";s:8:"Register";s:4:"body";s:291:"<include template="message_header" />
The value you entered for the image verification does not match the value stored. Please make sure you have images enabled. If you cannot enable images, please contact the site administrator for further information.
<include template="message_footer" />";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1060335421";}s:12:"invalid_page";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:130:"<include template="message_header" />
The specified page does not exist, or is not viewable.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062645389";}s:25:"add_ignored_user_redirect";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:139:"<include template="redirect_header" />
<b>$user_result[name]</b> has been added to your ignore list.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1062897254";}s:22:"login_account_redirect";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:140:"<include template="redirect_header" />
Welcome, <b>$usercheck[name]</b>! You are now being logged in.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1068954619";}s:23:"logout_account_redirect";a:4:{s:8:"category";s:7:"User CP";s:4:"body";s:107:"<include template="redirect_header" />
You are now being logged out.
<include template="redirect_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1066961943";}s:10:"invalid_pm";a:4:{s:8:"category";s:13:"Invalid Items";s:4:"body";s:121:"<include template="message_header" />
The specified private message does not exist.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1070858516";}s:13:"email_missing";a:4:{s:8:"category";s:13:"Email Display";s:4:"body";s:115:"<include template="message_header" />
You must enter a subject and a message.
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074398667";}s:9:"pm_delete";a:4:{s:8:"category";s:16:"Private Messages";s:4:"body";s:464:"<include template="message_header" />
Are you sure you want to delete the specified message<if $num_messages!=1>s</if>?<br />
<br />
<br />
<form action="pm.php?$deletequery" method="post">
<div class="center">
<input name="dodelete" type="hidden" value="1" />
<input name="folder" type="hidden" value="$folder" />
<input type="submit" value="Yes" /> <input type="button" value="No" onclick="history.back();" />
</div>
</form>
<include template="message_footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074813824";}s:12:"poll_options";a:4:{s:8:"category";s:5:"Polls";s:4:"body";s:983:"<include template="header" />
<form action="poll.php" method="post">
<div><input name="op" type="hidden" value="create" />
<input name="id" type="hidden" value="$thread[threadid]" />
<a href="index.php"><b>$config[name]</b></a> <b>&gt;</b> <a href="forum.php"><b>Forum</b></a> <b>&gt;</b>$forums <a href="thread.php?id=$thread[threadid]"><b>$thread[name]</b></a> <b>&gt; Create Poll</b>
<br />
<br /></div>
<div class="center"><table cellspacing="$style[cellspacing]" cellpadding="$style[cellpadding]" class="tableline">
<tr>
<td class="tableheader">Poll for $thread[name]</td>
</tr>
<include template="form_header" />
<tr>
<td><b>Number of poll choices:</b><br />
<span class="small">Please enter an appropriate number of choices.</span></td>
<td><input name="options" type="text" size="5" /></td>
</tr>
<tr>
<td class="center" colspan="2"><input type="submit" value="Create Poll" /></td>
</tr>
<include template="form_footer" />
</table></div>
</form>
<include template="footer" />";s:17:"lastedit_username";s:6:"Andrew";s:13:"lastedit_date";s:10:"1074814978";}s:14:"post_htmlblock";a:4:{s:8:"category";s:0:"";s:4:"body";s:189:"<blockquote><div class="small">HTML Code:</div><div><hr /><pre style="white-space: pre; font:12px Courier New, courier, serif; margin:0; padding:0;">$htmltext</pre><hr /></div></blockquote>";s:17:"lastedit_username";s:4:"Jeff";s:13:"lastedit_date";s:10:"1074975443";}}
*/ ?>