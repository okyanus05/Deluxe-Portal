<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Beta 3 -> Beta 4");

function old_import_style($url, $styleid, $name)
{
	if (!($content = file_get_contents($url)))
		return false;
	$style = unserialize(base64_decode(substr($content, 41, -6)));

	$columns_query = db_query("show columns from stylecss");
	$columns = array();
	while ($column = db_fetch_array($columns_query))
		$columns[] = $column['Field'];

	if (!$styleid)
	{
		db_query("insert into style (extra, name) values ('$style[extra]', '$name')");
		$styleid = db_insert_id();
	}
	else
		db_query("update style set extra='$style[extra]'");
	db_query("delete from stylecss where styleid='$styleid'");

	foreach ($style['css'] as $stylecss_result)
	{
		$columns_string = '';
		$values_string = '';
		foreach ($columns as $column_name)
		{
			if (isset($stylecss_result[$column_name]) && $column_name!='styleid' && $column_name!='selectorid')
			{
				$columns_string .= "`$column_name`,";
				$values_string .= '\'' . addslashes($stylecss_result[$column_name]) . '\',';
			}
		}
		$columns_string .= "`styleid`";
		$values_string .= $styleid;
		db_query("insert into stylecss ($columns_string) values ($values_string)");
	}

	return $styleid;
}

db_connect();
db_select_db();

echo 'Upgrading from 2.0.0 Beta 3 to 2.0.0 Beta 4<br />';
	
if (!$_REQUEST['op'])
{
	echo 'Step 1: Altering database<br /><br />';
	db_query("alter table groups drop ban");
	db_query("alter table config add description text not null");
	db_query("update config set description='Place a brief description of what $config[name] Forums are about here. This message is editable &amp; can be disabled from the configuration panel. Note: You <b><i>can</i></b> use HTML in this message.'");
	db_query("alter table dpcode add empty tinyint unsigned not null");
	db_query("update dpcode set empty=0");
	db_query("alter table config drop time_zone");
	db_query("alter table user add auto_time_zone tinyint unsigned not null");
	db_query("alter table user add time_zone_dst tinyint unsigned not null");
	db_query("alter table user add southern_hemisphere tinyint unsigned not null");
	db_query("update user set auto_time_zone=1,time_zone_dst=1,southern_hemisphere=0");
	db_query("alter table styleset add frontpage_day_date_format char(255) not null");
	db_query("alter table styleset add today_text char(255) not null");
	db_query("alter table styleset add yesterday_text char(255) not null");
	db_query("update styleset set frontpage_day_date_format='[isday][day /][/isday]l, F d, Y',today_text='Today',yesterday_text='Yesterday'");
	db_query("alter table post add html tinyint unsigned not null");
	db_query("update post set html=0");
	db_query("alter table user modify quick_reply enum('multi', 'single', 'none')");
	db_query("update user set quick_reply='multi' where quick_reply!=0");
	db_query("update user set quick_reply='none' where quick_reply!='multi'");
	db_query("alter table config add icons_row int unsigned not null");
	db_query("alter table config add time_offset int not null");
	db_query("alter table config add show_description tinyint unsigned not null");
	db_query("alter table config add booleansearch tinyint unsigned not null");
	db_query("alter table config add blocked_characters char(255) not null");
	db_query("update config set icons_row=7,time_offset=0,show_description=1,booleansearch=0,blocked_characters=''");
	db_query("update config set booleansearch=1 where fulltextsearch=1");
	db_query("alter table user add lastactivity int unsigned not null");
	db_query("update user set lastactivity=lastvisit");
	db_query("alter table config add copyright char(255) not null");
	db_query("alter table config add load_limit char(5) not null");
	db_query("alter table config add search_load char(5) not null");
	db_query("alter table config add guest_load char(5) not null");
	db_query("alter table config add sig_lines int unsigned not null");
	db_query("alter table config add show_moderators tinyint unsigned not null");
	db_query("update config set copyright='',load_limit='',search_load='',guest_load='',sig_lines=10,show_moderators=1");
	db_query("alter table title add image char(255) not null");
	db_query("alter table title add `repeat` int unsigned not null");
	db_query("update title set image='\$style[images]/star.gif',`repeat`=0");
	db_query("alter table config add sig_chars int unsigned not null");
	db_query("update config set sig_chars=1000");
	db_query("alter table template add lastedit_username char(255) not null");
	db_query("alter table template add lastedit_date int unsigned not null");
	db_query("update template set lastedit_username='',lastedit_date=0");
	db_query("alter table session add forumids varchar(255) not null");
	db_query("alter table session add viewthreadid int unsigned not null");
	db_query("update session set forumids='',viewthreadid=0");
	db_query("alter table config add viewingthread tinyint unsigned not null");
	db_query("update config set viewingthread=0");
	db_query("update config set viewingthread=1 where browsingforum=1");
	db_query("alter table groups add faq tinyint unsigned not null");
	db_query("update groups set faq=0");
	db_query("update groups set faq=1 where templates=1");
	
	db_query("CREATE TABLE faq (
  faqid int(10) unsigned NOT NULL auto_increment,
  name char(255) NOT NULL default '',
  shortname char(255) NOT NULL default '',
  tree tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (faqid),
  KEY shortname (shortname(10))
)");

db_query("INSERT INTO faq (faqid, name, shortname, tree) VALUES (2, 'Frequently Asked Questions', 'userfaq', 0),
(3, 'Admin FAQ', 'adminfaq', 1),
(4, 'Moderator FAQ', 'modfaq', 1)");

db_query("CREATE TABLE faqcategory (
  faqcategoryid int(10) unsigned NOT NULL auto_increment,
  faqid int(10) unsigned NOT NULL default '0',
  name char(255) NOT NULL default '',
  ordered int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (faqcategoryid),
  KEY faqid (faqid,ordered),
  KEY name (name(10))
)");

db_query("INSERT INTO faqcategory (faqcategoryid, faqid, name, ordered) VALUES (1, 2, 'Posting', 10),
(2, 2, 'Private Messaging', 20),
(3, 2, 'User Control Panel', 30),
(6, 3, 'Admin Log', 10),
(7, 3, 'Announcements', 20),
(8, 3, 'Articles', 30),
(9, 3, 'Configuration', 40),
(10, 3, 'Custom Fields', 50),
(11, 3, 'Downloads', 60),
(12, 3, 'DP Code', 70),
(13, 3, 'FAQ Manager', 80),
(14, 3, 'Forum Permissions', 90),
(15, 3, 'Forums', 100),
(16, 3, 'Group Changer', 110),
(17, 3, 'Groups', 120),
(18, 3, 'Icons', 130),
(19, 3, 'Links', 140),
(20, 3, 'Maintenance', 150),
(21, 3, 'Mass Delete', 160),
(22, 3, 'Mass Move', 170),
(23, 3, 'Moderator Log', 180),
(24, 3, 'Moderators', 190),
(25, 3, 'Scheduled Tasks', 200),
(26, 3, 'Sections', 210),
(27, 3, 'Smilies', 220),
(28, 3, 'Style Sets', 230),
(29, 3, 'Styles', 240),
(30, 3, 'Templates', 250),
(31, 3, 'Titles', 260),
(32, 3, 'Topics', 270),
(33, 3, 'Users', 280),
(34, 4, 'Announcements', 10),
(35, 4, 'Mass Delete', 20),
(36, 4, 'Mass Move', 30),
(37, 4, 'Moderator Log', 40),
(38, 4, 'View Users', 50)");

db_query("CREATE TABLE faqitem (
  faqitemid int(10) unsigned NOT NULL auto_increment,
  faqcategoryid int(10) unsigned NOT NULL default '0',
  name char(255) NOT NULL default '',
  content text NOT NULL,
  ordered int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (faqitemid)
)");

db_query("INSERT INTO faqitem (faqitemid, faqcategoryid, name, content, ordered) VALUES (1, 2, 'What is private messaging?', 'Private messaging is a way to communicate privately with other users on the site. When you receive a message, the messages button on the top of each page will light up (if the administrator has enabled this). You can then read the message, and response. Private messaging works well if you need to get in touch with someone on the site privately.', 40),
(3, 1, 'What are smilies?', 'Smilies, also referred to as emoticons, are symbols you may have seen on other websites, or may have used yourself. <b>:)</b> and <b>:p</b> are examples of smilies. Deluxe Portal can turn those text smilies into actual pictures automatically. Here is a list of the smilies installed on this site. The \"tag\" is what you would type in a post to make the associated picture appear.\n<?php\n\$faqcolor = \'cellalt\';\n\$faqquery = db_query(\'select * from smilie where ordered>0 order by ordered asc\');\n\$smilies = \'\';\nwhile (\$smilie = db_fetch_array(\$faqquery))\n{\n	\$faqcolor = (\$faqcolor==\'cellalt\' ? \'cellmain\' : \'cellalt\');\n	\$smilie[\'image\'] = parse_image(\$smilie[\'image\']);\n	\$smilies .= \"<tr><td class=\\\\\"\$faqcolor\\\\\"><div class=\\\\\"center\\\\\"><img alt=\\\\\"\$smilie[name]\\\\\" src=\\\\\"\$smilie[image]\\\\\" /></div></td><td class=\\\\\"\$faqcolor\\\\\"><b>\$smilie[tag]</b></td><td class=\\\\\"\$faqcolor\\\\\"><b>\$smilie[name]</b></td></tr>\";\n}\n?>\n<br />\n<br />\n<div class=\"center\"><table class=\"tableline\" cellspacing=\"\$style[cellspacing]\" cellpadding=\"\$style[cellpadding]\">\n<tr>\n<td class=\"tableheader\"><span class=\"small\">Image</span></td><td class=\"tableheader\"><span class=\"small\">Tag</span></td><td class=\"tableheader\"><span class=\"small\">Name</span></td>\n</tr>\n\$smilies\n</table></div>', 10),
(4, 1, 'What is DP Code?', 'DP Code is the safe way to add formatting to your posts without using HTML. For example, you could use <b>[b]Text[/b]</b> to make \"Text\" <b>bold</b>. Here is a list of the DP Code set up on this site:<br />\n<?php\n\$faqquery = db_query(\'select * from dpcode order by tag asc\');\n\$dpcode_list = \'\';\nwhile (\$dpcode = db_fetch_array(\$faqquery))\n{\n	\$dpcode[\'parsed_example\'] = dpcode_parse(\$dpcode[\'example\'], true);\n	\$dpcode_list .= \"<br />\n<table class=\\\\\"tableline\\\\\" cellspacing=\\\\\"\$style[cellspacing]\\\\\" cellpadding=\\\\\"\$style[cellpadding]\\\\\" width=\\\\\"100%\\\\\">\n<tr>\n<td class=\\\\\"cellalt\\\\\"><b>[\$dpcode[tag]]</b><br />\n<br />\n\$dpcode[description]<br />\n<br />\n<b>Example:</b> \$dpcode[example] becomes \$dpcode[parsed_example]</td>\n</tr>\n</table>\";\n}\n?>\n<if \$dpcode_list>\$dpcode_list\n<br />\n</if><table class=\"tableline\" cellspacing=\"\$style[cellspacing]\" cellpadding=\"\$style[cellpadding]\" width=\"100%\">\n<tr>\n<td class=\"cellalt\"><b>[code]</b><br />\n<br />\nThis is used to display code or monospaced text. If you would like line numbers to be added automatically, use <b>[code=num]</b>.<br />\n<br />\n<b>Example:</b> [code]This text is monospaced[/code] becomes <blockquote><span class=\"small\">Code:</span><hr /><div style=\\\"white-space: pre; font:12px Courier New;\\\">This text is monospaced</div><hr /></blockquote></td>\n</tr>\n</table><br />\n<table class=\"tableline\" cellspacing=\"\$style[cellspacing]\" cellpadding=\"\$style[cellpadding]\" width=\"100%\" class=\"tableline\">\n<tr>\n<td class=\"cellalt\"><b>[php]</b><br />\n<br />\nThis is used to display PHP code with syntax highlighting. By default, line numbers are automatically added, and <b>&lt;?php ?&gt;</b> blocks are added around the code. To remove the line numbers, use <b>[php=nonum]</b>.<br />\n<br />\n<b>Example:</b> [php]echo \"Hello, \".\\\\\$username;[/php] becomes <blockquote><span class=\"small\">PHP:</span><hr /><div style=\"white-space: pre; font:12px Courier New;\"><span class=\"cellmain\">1.</span>&nbsp;<code><font color=\"#000000\"><font color=\"#0000BB\">&lt;?php<br /><span class=\"cellmain\">2.</span>&nbsp;</font><font color=\"#007700\">echo </font><font color=\"#DD0000\">\"Hello, \"</font><font color=\"#0000BB\">.\\\\\$username</font><font color=\"#007700\">;<br /><span class=\"cellmain\">3.</span>&nbsp;</font><font color=\"#0000BB\">?&gt;</font></font></code><br /></div><hr /></blockquote></td>\n</tr>\n</table>', 20),
(5, 1, 'What is WYSIWYG?', 'WYSIWYG, or What You See Is What You Get, is an exciting new way of posting. Instead of having to use a boring old text box to type your posts into, and having to type out DP Code tags to provide formatting, the new WYSIWYG input control allows you to post as if you were using a program such as Microsoft Word. Want to make text bold? Just click the <b>B</b> (bold) icon in the toolbar. Same goes for smilies. Once you see WYSIWYG, you won\'t want to post any other way!\n\nWYSIWYG only works in Internet Explorer 5.5 or higher for Windows. If WYSIWYG works on your computer, you will see a box below, with a toolbar directly above it. Try it out!<br />\n<form>\n<input name=\"parsed_message\" type=\"hidden\" value=\"\" />\n<div class=\"center\"><textarea name=\"message\" id=\"message\" rows=\"10\" cols=\"80\"></textarea></div>\n<script type=\"text/javascript\" src=\"editor.js\"></script>\n<script type=\"text/javascript\">\n<!--\n_editor_url = \"\";\neditor_generate(\'message\');\n-->\n</script>\n</form>', 30),
(6, 2, 'How do I disable it?', 'If you do not want to use the private messaging system, go to your user control panel. Click <b>Edit Options</b>, and set <b>Use Private Messaging</b> to <b>No</b>. This will prevent users from sending messages to you, but it will also prevent you from sending any messages.', 10),
(7, 2, 'How do I see when someone has read the message I sent them?', 'When you send the message, you must make sure the <b>Save a copy of this message</b> box is checked. Then, go to the <b>Sent Messages</b> folder (this is found on your main private messaging page). If the recipient has read the message, it will show a closed envelope. Otherwise, an open envelope will be shown.', 20),
(8, 2, 'How do I send someone a message?', 'There are a number of ways to send someone a message. The easiest way is to view the user\'s profile page, and click <b>Send a private message</b>. Another way is to click the <b>New Message</b> button on the private messaging page, and enter the user\'s name. Yet another way is to use the links on your buddy list.', 30),
(9, 3, 'How do I change my options?', 'You can set a number of options to customize your forum experience by clicking the <a href=\"edit_options.php\"><b>Edit Options</b></a> link from your user control panel. There are a number of options that can be set from this page. The style setting decides the colors and images that pages on the site will use. The WYSIWYG setting allows you to use a better text input box for posting that shows how your post will actually appear. However, this setting requires Internet Explorer 5.5 or higher. Staying invisible on the Who\'s Online listing will prevent other users from seeing when you are on the site, and what you are currently doing. The avatar setting, if enabled by the administrators, allows you to choose a small image to appear under your name in posts, and upload it.', 10),
(10, 3, 'How do I change my password?', 'To change your password, click the <a href=\"change_password.php\"><b>Change Password</b></a> link in your user control panel. You will need your current password. When you choose your new password, try to pick a combination of numbers and mixed-case letters.', 20),
(11, 3, 'How do I edit my profile?', 'Your profile is your personal information. This is where people can get information about you, such as your email address and location. You can edit this information at any time by clicking the <a href=\"edit_profile.php\"><b>Edit Profile</b></a> link in your user control panel. This brings up a page where you can change your information. Parts of this page, such as custom title and signature, may only be shown if the administrators have enabled them.', 30),
(12, 3, 'What are subscribed forums?', 'Subscribing to forums is a great way to keep track of new posts made to forums in which you are interested. You can subscribe by choosing \"Subscribe to forum\" from the subscribe dropdown on the forum display page. While in the user control panel, you can see a list of forum that have new posts in them which you have not yet read. From there, you can click on links to those forums.', 40),
(13, 3, 'What are subscribed threads?', 'Subscribing to threads is a great way to keep track of new posts made to threads in which you are interested. When you make a post in a thread, you can check a box that will subscribe you to the thread. You can also subscribe by choosing \"Subscribe to thread\" from the subscribe dropdown on the thread display page. While in the user control panel, you can see a list of threads that have new posts in them which you have not yet read. From there, you can click on links to those threads.', 50),
(14, 3, 'What is the buddy list?', 'The buddy list is a way to keep track of your online friends. When you add someone to your buddy list, you can see when they\'re online, and you can easily send them private messages. To add a user to your buddy list, you can type their name into the <b>Add User</b> box under the Buddy List in your user control panel, or you can click <b>Add to Buddy List</b> in that person\'s profile.', 60),
(15, 3, 'What is the ignore list?', 'If a user annoys you and you no longer wish to see their posts, you can add them to your ignore list. This causes their posts to be hidden unless you click a link, and prevents them from sending you private messages. To add a user to your ignore list, you can type their name into the <b>Add User</b> box under the Ignore List in your user control panel, or you can click <b>Add to Ignore List</b> in that person\'s profile.', 70),
(16, 3, 'What is the user control panel?', 'The user control panel is your central location to change your user information, settings, manage your buddy and ignore lists, and view subscribed threads and forums.', 80),
(17, 6, 'What is the admin log?', 'The admin log allows you to see what other administrators have done while in the administrator control panel. The following information is available:<br />\n<ul>\n<li>Username of the administrator</li>\n<li>Action he or she performed</li>\n<li>The date and time on which this action occurred</li>\n<li>The IP address of the user</li>\n</ul><br />\nThe entries are sorted by the date and time, in descending order. You can also search for entries by using any of the above categories as criteria.', 10),
(18, 7, 'What is an announcement?', 'An announcement\nis a way to easily post important information in the forum. Announcements are\nalways displayed above threads, including sticky threads. You can set them to\nstart and end at certain dates/times, and to appear in one forum, all forums,\nor all sub-forums of a particular forum. Users cannot reply to announcements.', 10),
(19, 34, 'What is an announcement?', 'An announcement\nis a way to easily post important information in the forum. Announcements are\nalways displayed above threads, including sticky threads. You can set them to\nstart and end at certain dates/times, and to appear in one forum, all forums,\nor all sub-forums of a particular forum. Users cannot reply to announcements.', 10),
(20, 7, 'How do I edit an announcement?', 'To edit\nan announcement, find the announcement in the list. It will be listed under <b>All\nforums </b>if it is a global announcement; otherwise it will be under the forum\nto which the announcement was assigned. After clicking the <b>Edit</b> link,\nyou can change the name, start date, end date, forum, and body of the\nannouncement.', 20),
(21, 34, 'How do I edit an announcement?', 'To edit\nan announcement, find the announcement in the list. It will be listed under <b>All\nforums </b>if it is a global announcement; otherwise it will be under the forum\nto which the announcement was assigned. After clicking the <b>Edit</b> link,\nyou can change the name, start date, end date, forum, and body of the\nannouncement.', 20),
(22, 7, 'How do I delete an announcement?', 'Find the\nannouncement in the list. It will be under its assigned forum. Click the <b>Delete</b>\nlink beside the announcement.', 30),
(23, 34, 'How do I delete an announcement?', 'Find the\nannouncement in the list. It will be under its assigned forum. Click the <b>Delete</b>\nlink beside the announcement.', 30),
(24, 8, 'What is an article?', 'In Deluxe\nPortal, an article can be one of two things: a news post, or an entry which is\nplaced into a section. News articles are displayed on the front page.', 10),
(25, 8, 'How do I post an article?', 'Articles\ncan be posted by visiting the articles control panel. You must enter a title\nfor your article. You must then choose either a topic or a section in which the\narticle will be posted. Placing the article into a topic will cause it to be\nshown as a news article. Otherwise, it will be placed into a section. You may\nthen type your article text. When you are finished, click <b>Add Article</b>.', 20),
(26, 8, 'Can I split articles up into more than one page?', 'Yes. This\nis can be done in two ways. The first method is used if you are placing your\narticle into a topic. By inserting the following text into your article:<br />\n\n<br />\n\n<b>[page\n/]</b><br />\n\n<b></b><br />\n\nonly the\ntext before the <b>[page /]</b> code will be shown on the front page. There\nwill then be a <b>Read more</b> link. Clicking this link will allow you to see\nthe entire article. You can only have one <b>[page /]</b> per article. This is\na sample article which uses this type of page break:<br />\n\n<br />\n\n<i>Welcome\nto my news article!</i><br />\n\n<i>[page\n/]</i><br />\n\n<i>This\npart cannot be seen on the front page.</i><br />\n\n<br />\n\n<br />\n\nThe\nsecond method is used for articles that are in sections. Every place in the\narticle in which you would like to have a page break, you must insert the\nfollowing code:<br />\n\n<br />\n\n<b>[page=<i>name\nof page</i> /]</b><br />\n\n<b></b><br />\n\nThis will\nnot only insert a page break in that location, but will also name the page.\nThese page names are used in the quick navigation drop down box at the top of\nthe article page. If you use any page breaks in your article, you will also\nneed to start your article with a <b>[page=<i>name of page</i> /]</b> entry.\nThis ensures that the first page in your article has a name. You may have as\nmany <b>[page=<i>name of page</i> /]</b> entries in your article as you desire.\nThe following is a sample article using this type of page break:<br />\n\n<br />\n\n<i>[page=Introduction\n/]</i><br />\n\n<i>This\nbegins my three page review of graphics cards.</i><br />\n\n<i>[page=Benchmarks\n/]</i><br />\n\n<i>Look\nat all my graphs!</i><br />\n\n<i>[page=Conclusion\n/]</i><br />\n\n<i>I hope\nyou enjoyed my graphics card review.</i>', 30),
(27, 8, 'How do I edit an article?', 'To edit\nan article, go to the articles control panel. There will be a list of recent\narticles at the bottom of the page. Click the <b>Edit</b> link beside the\narticle you wish to edit. Note that you may not have permission to edit some\narticles. If the article does not appear in the list, you can find the article\n(via a search, direct link, etc.), and click the <b>Edit</b> link at the bottom\nof the article page.', 40),
(28, 8, 'How do I delete an article?', 'Articles\ncan be deleted via the articles control panel. Go to the list of recent\narticles at the bottom of the page, and click <b>Delete</b> beside the\nappropriate article. Note that you may not have permission to delete some\narticles. If the article does not appear in the list, you can find the article\n(via a search, direct link, etc.), and click the <b>Delete</b> link at the\nbottom of the article page.', 50),
(29, 9, 'Overview of the configuration control panel', 'The configuration\ncontrol panel is where you will find Deluxe Portals global configuration\noptions. Since each of these options already contains a description, these\ndescriptions will not be repeated here. Check the descriptions given in the\nconfiguration control panel for more information.<br />\n\n<br />\n\nHowever,\nthe <b>Image Locations</b> may need a bit of an explanation. For each of the\nvarious types of images and files (avatars, attachments, smilies, etc.), you\ncan select whether the image will go into the database, or into a directory as\na file. Uploading your images to the databases is easiest, as this requires no\nadditional setup. Uploading them as files will require a bit of additional\nsetup work, but may be somewhat faster than using the database, especially if\nyour server is under heavy loads.<br />\n\n<br />\n\nTo setup\ndirectory uploading, first set the appropriate image types to <b>File</b>. You\ncan then specify a directory; <b>uploads</b> is the default. After you have the\ndirectory(s) selected, make sure they exist on your server. Then, you must make\nsure they can be written to. If you are running a server with Linux, BSD,\nSolaris, or pretty much any other non-Window server, you can <b>chmod</b> the\ndirectory to <b>777</b>. This can be done from a command line, by typing:<br />\n\n<br />\n\n<i>chmod\n777 directoryname</i><br />\n\n<br />\n\nYou can\nalso do this from most FTP clients. Select the directory, and look for a <b>Change\npermissions</b> option (this will depend on your particular FTP client). You\nwill want to select <b>Read</b>, <b>Write</b>, and <b>Execute</b> permissions\nfor <b>User</b>, <b>Group</b>, and <b>World</b> (also known as <b>All</b>).\nYour directory uploads will then be ready to go.<br />\n\n<br />\n\nOne other\nitem worth explaining is the <b>Enable fulltext searching</b> option. This\noption will only work with MySQL 3.23.23 or higher. However, it speeds up\nsearches, and allows sorting by relevance. If you enable this option after your\nforum has thousands of posts, it will have to index the posts, which will take\na while.', 10),
(30, 10, 'What are custom profile fields?', 'Custom\nprofile fields are a way to add additional fields to user profiles. For\nexample, if you run a site about dogs, you may wish to add a custom field in\nwhich your users can list the types of dogs they own.', 10),
(31, 10, 'How do I add a custom profile field?', 'To add a\ncustom profile field, you must first enter the name of the field. You can enter\nan optional description, which will be listed under the name of the field. You\nalso must have a display order, which decides the order in which the field is\ndisplayed on profile pages, in relation to the other custom fields. For\nexample, a custom field with a display order of <b>3</b> would come after one\nwith a display order of <b>2</b>, but before a field with a display order of <b>4</b>.\nFinally, there are two options that can be set for each custom field. If the <b>Users\ncan edit this field</b> option is enabled, the user will be able to edit the\ncontents of this field via the <b>Edit Profile</b> page. The <b>Other users can\nview the contents of this field</b> option decides whether the field will be\nshown on user profile pages.', 20),
(32, 10, 'How do I edit a custom profile field?', 'Find the\nprofile field in the list, and click the <b>Edit </b>link. After doing that,\nyou will be able to change the name, description, display order, and options\nfor that profile field.', 30),
(33, 10, 'How do I delete a custom profile field?', 'Once you\nfind the profile field in the list, click the <b>Delete</b> link. You will then\nbe asked to confirm the deletion of the field.', 40),
(34, 11, 'What are downloads?', 'Downloads\nare a way to organize links to downloadable files in Deluxe Portal. You can add\ndownload categories, which are used to group downloads into categories. From\nthere, you may add downloads to each category.', 10),
(35, 11, 'How do I add a download category?', 'First,\nchoose a name for the download category. You must then either upload an image\nfor the download category, or specify the URL of another image. Finally, check\noff the groups that you wish to be able to view this download category.', 20),
(36, 11, 'How do I edit a download category?', 'In the\ndownloads control panel, find the download category, and click the <b>Edit </b>link.\nFrom there, you will be able to change the name of the category, the image\nassociated with it, and the viewing permissions.', 30),
(37, 11, 'How do I delete a download category?', 'Click the\n<b>Delete</b> link beside the name of the download category. If any downloads\nare using the category, you will not be able to delete it. Therefore, you\nshould move either move the downloads to another category, or delete them\nbefore proceeding.', 40),
(38, 11, 'How do I add a download?', 'First,\nclick the <b>Add Download</b> link beside the category in which you want the\ndownload to be displayed. Once you are on the add download page, you must\nspecify a name for the download. The appropriate download category will already\nbe selected. A URL to the download itself must be specified beside <b>Location</b>.\nFinally, there are optional fields for description, author name, author email\naddress, and version number.', 50),
(39, 11, 'How do I edit a download?', 'Click the\n<b>Edit </b>link beside the name of the download. You may then edit the name,\ndownload location, description, author, email address, version number, and\ndownload category to which the download belongs.', 60),
(40, 11, 'How do I delete a download?', 'Find the\ndownload in the list, and click the <b>Delete</b> link. Deleting a download\nwill not remove the actual file; it will just remove the listing entry for it\nfrom your site.', 70),
(41, 12, 'What is DP Code?', 'DP Code is Deluxe Portals replacement for HTML, to be used within posts and articles.\nDP Code is much safer than HTML, because you choose exactly what is allowed,\nand you cannot affect the format of a page by forgetting to close a tag.', 10),
(42, 12, 'How do I add DP Code?', 'You must\nfirst choose a tag for your DP Code. DP Code tags are always done in the\nfollowing format:<br />\n\n<br />\n\n[<b>tag\nname</b>]<br />\n\n<br />\n\nYou\nshould not insert the <b>[ ]</b> brackets as part of the tag name; this is\nautomatically handled by Deluxe Portal. After choosing a name, enter the\nappropriate HTML replacement in the <b>Replacement</b> box. For this\nreplacement, you have two special options at your disposal.<br />\n\n<br />\n\nThe first\nof these is <b>{param}</b>. <b>{param}</b> is the text entered between the\nstarting and closing tags of the DP Code. For example, if the following text\nwas entered:<br />\n\n<br />\n\n<i>[b]This\ntext is bold.[/b]</i><br />\n\n<br />\n\nthen <b><i>This\ntext is bold</i></b> would be the <b>{param}</b>. Therefore, the replacement\nfor the <b>[b]</b> bold tag would be:<br />\n\n<br />\n\n<i>&lt;b&gt;{param}&lt;/b&gt;</i><br />\n\n<i></i><br />\n\nThe\nsecond block of text you have at your disposal is <b>{option}</b>. <b>{option}</b>\nis the text used with some DP Codes inside the opening tag itself. This allows\nyou to specify additional conditions within your DP Code, such as color, size,\netc. An example is the <b>[color]</b> tag:<br />\n\n<br />\n\n<i>[color=red]This\ntext is red.[/color]</i><br />\n\n<i></i><br />\n\nFor which\nthe appropriate replacement would be:<br />\n\n<br />\n\n<i>&lt;span\nstyle=color: {option}&gt;{param}&lt;/span&gt;</i><br />\n\n<i></i><br />\n\n<i></i><br />\n\nThe next\nitem is the description of the DP Code. This description is shown on the\nFrequently Asked Questions page.<br />\n\n<br />\n\nThe\nexample is also shown on the FAQ page. This example should illustrate how the\nDP Code is used. A good example for the bold tag would be:<br />\n\n<br />\n\n<i>[b]This\ntext is bold.[/b]</i>', 20),
(43, 12, 'How do I edit DP Code?', 'To edit\nDP Code, first find the particular code you wish to edit in the DP Code control\npanel, and click <b>Edit</b>. You may then change the DP Code. Please note that\nthese changes will not take place in signatures, and cached posts (if this has\nbeen enabled in the configuration panel). If this is a problem, run the <b>Reparse\nPost Cache</b> and/or <b>Reparse Signatures</b> scripts in the maintenance\ncontrol panel.', 30),
(44, 12, 'How do I delete DP Code?', 'Find the\nDP Code entry in the DP Code control panel, and click the <b>Delete</b> link.\nThis will not affect any current signatures or cached posts. If you wish for\nthe updates to take effect in old signatures and cached posts, run the <b>Reparse\nPost Cache</b> and <b>Reparse Signatures</b> scripts in the maintenance control\npanel.', 40),
(45, 13, 'What is a FAQ?', 'In Deluxe\nPortal, a FAQ is basically a grouping of categories pertaining to a subject.\nEach category contains items, which usually correspond to a question/answer\npair. For example, the admin help, moderator help, and user FAQ were all\ncreated and maintained using the FAQ Manager. You can create FAQs of your own,\nor edit existing ones.', 10),
(46, 13, 'How do I add a FAQ?', 'Click the\n<b>Add New FAQ</b> link in the FAQ manager. You may then specify a name for the\nFAQ. You must then specify a short name, which is used for linking to the\nFAQ. It must consist of letters, numbers, and the underscore (<b>_</b>)\ncharacter only. If you enable the tree display, all FAQ categories and items\nwill be displayed in a branching tree on the left side of the screen when\nviewing the FAQ. Otherwise, they will be listed using standard text and links,\nand will not be shown on the side of the screen when viewing a specific\ncategory/item.<br />\n\n<br />\n\nTo link\nto a FAQ, you must refer to <b>faq.php?faq=<i>shortname</i></b>, where <i>shortname</i>\nrefers to the short name you entered when creating the FAQ.', 20),
(47, 13, 'How do I edit a FAQ?', 'Click the\n<b>Edit</b> link next to the name of the FAQ. You may then change the name,\nshort name, and tree display options.', 30),
(48, 13, 'How do I delete a FAQ?', 'Click the\n<b>Delete</b> link next to the name of the FAQ. This will remove the FAQ, and\nall of its categories and items. It is not recommended that you delete any of\nthe FAQs that come with Deluxe Portal.', 40),
(49, 13, 'How do I add a category?', 'Find the\nFAQ in the list, and click the <b>Add Category</b> link. On the following\nscreen, enter the name of the category, and the display order. The higher the\ndisplay order, the farther down the list the category will be. You can link to\na specific category by using the form <b>faq.php?faq=<i>shortname</i>&amp;category=<i>categoryname</i></b>,\nwhere <i>shortname</i> is the short name of the FAQ, and <i>categoryname</i> is\nthe name of the category.', 50),
(50, 13, 'How do I edit a category?', 'After\nfinding the category in the list, click <b>Edit</b>. This will allow you to\nchange the name and display order of the category. Additionally, you can move\nthe category to another FAQ if you wish.', 60),
(51, 13, 'How do I delete a category?', 'Click the\n<b>Delete</b> link beside the name of the category, in the FAQ Manager list.\nDeleting the category will also delete any items in the category.', 70),
(52, 13, 'How do I add an item?', 'Click the\n<b>Add Item</b> link next to the category to which you want to add the item.\nEnter a name for the item. This is usually in the form of a question; for\nexample: <i>How do I post threads?</i>. The larger the display order, the\nfarther down the item will appear, in relation to other items in that category.\nIn the content field, you may use the Deluxe Portal template engines features\nin addition to plain text. These features include displaying variables, using\nconditionals, and including files. Take a look at the What additional features\ncan be used in templates? item of the templates FAQ for more information.<br />\n\n<br />\n\nIf you\nwant to link to a specific item, use the form <b>faq.php?faq=<i>shortname</i>&amp;category=<i>categoryname</i>#<i>itemname</i></b>,\nwhere <i>shortname</i> is the short name of the FAQ, <i>categoryname</i> is the\nname of the category to which the item belongs, and <i>itemname</i> is the name\nof the item.', 80),
(53, 13, 'How do I edit an item?', 'First,\nyou will have to click the plus box beside the items category, to make the\ntree expand. Then, click the <b>Edit</b> link beside the item. From there, you\nwill be able to edit the name, display order, and content of the item.', 90),
(54, 13, 'How do I delete an item?', 'To delete\nan item, expand the tree so that you can see the item. Then, click the <b>Delete</b>\nlink next to the item.', 100),
(55, 14, 'What is the forum permissions page used for?', 'Normally,\nyou specify what users in a specific group can do by editing the options for\nthat group. Editing posts and posting new threads are two examples of group\npermissions. However, sometimes, you may need to override these permissions in\none or more forums. This is especially useful for such things as private\nforums.', 10),
(56, 14, 'How do I edit forum permissions?', 'Forum\npermissions can be edited by expanding the tree on the left so that you can see\nthe forum and group you wish to edit. Then, click the <b>Edit</b> link. You\nhave three options on the edit forum permissions page. The first option is <b>Group</b>,\nwhich simply causes the forum to use the default options for that group. The\nsecond option is <b>Custom</b>, which will allow you to choose the appropriate\noption checkboxes. The third option, which will only appear if the forum you\nare editing has a parent forum, is <b>Parent</b>. This option will cause the\ngroup to inherit the options from the parent forum.', 20),
(57, 14, 'How do I quickly reset the permissions of a forum?', 'You can\nquickly and easily reset any custom or group permissions in a forum by clicking\nthe <b>Reset</b> link next to the name of the forum. On the following page, you\nwill be able to specify whether you wish to reset its sub-forums as well.', 30),
(58, 14, 'How do I quickly deny all groups access to a forum?', 'Sometimes,\nit is convenient to deny access to a forum for every group on the site. For\nexample, if you have several groups and only want one or two to be able to see\na forum, you can just enable the permissions of those two groups, instead of\nhaving to deny the permissions of several other groups. To deny access for all\ngroups, click the <b>Deny All </b>link next to the forum. On the following\npage, you will be able to specify whether you want sub-forums to be affected.', 40),
(59, 15, 'How do I add a forum?', 'First,\nclick the <b>Add New Forum </b>link. A name must be given for the forum. You\ncan then enter an optional description, which will be displayed below the name\nof the forum on the forum index page. Then, a parent forum must be chosen. If\nyou select a parent forum, the forum you are adding will be made a subforum of\nthat forum. This means that it will be listed on the forum display page of the\nparent forum. Only forums with no parent and forums with a parent that has no\nparent will be shown on the forum index. Otherwise, the forum will only be\nlisted on the appropriate forum display page.<br />\n\n<br />\n\nA display\norder must then be chosen. This is the order in which the forum will be\ndisplayed on the page, relative to the other forums. A display order of <b>0</b>\n(zero) will cause the forum to be hidden on both the forum index and any forum\ndisplay pages.<br />\n\n<br />\n\nThe <b>Allow\nposting</b> option, if set to no, prevents everyone from posting in this forum,\nregardless of group setting. You will probably want to set this option to <b>No\n</b>if you are making a category (a forum that does nothing but hold other\nforums). The <b>Allow DP Code</b>, <b>Allow image tags</b>, and <b>Allow\nsmilies</b> options control the ability to post DP Code, [img] tags, and\nsmilies, respectively, in this forum. Finally, the <b>Count posts</b> option,\nif enabled, will cause posts made in this forum to be added to the posters\npost count.', 10),
(60, 15, 'How do I edit a forum?', 'To edit a\nforum, click the <b>Edit</b> link next to the forum. You will then be able to\nedit all of the forums options. You are also able to change the forums parent\nforum.', 20),
(61, 15, 'How do I delete a forum?', 'To delete\na forum, click the <b>Delete</b> link next to the forum. Deleting a forum will\nremove all threads and posts from that forum. If the forum had sub-forums, they\nwill become children of the parent forum of the forum you are deleting.', 30),
(62, 16, 'What is the group changer?', 'The group\nchanger allows you to have users removed from or placed into various groups\nwhen certain conditions are met. Typical group changer rules would include\nadding a user to a group that allows custom titles when a certain number of\ndays registered and/or post count is reached.', 10),
(63, 16, 'How do I add a group changer rule?', 'Choose a\nname for the rule. You can add a number of days registered condition, which\nwill cause the rule to be run on users who have been registered at least that\nmany days. You can also add a post count value, and specify that the rule\nshould run when the user has reached that post count, by selecting <b>Reaches</b>,\nor that is should be run when the user drops below a certain post count, by\nselecting <b>Drops below</b>. You can select <b>And</b> from the dropdown on\nthe left if you want the rule to run when both the days registered and the post\ncount conditions are met, or <b>Or</b> to run it when either condition is met.<br />\n\n<br />\n\nYou must\ncheck one or more boxes in the <b>And user is in one of the following groups</b>\nsection. The rule will only be run on users who are in at least one of the\nselected groups.<br />\n\n<br />\n\nIf all of\nthe above conditions are met, you can add the user to one or more groups, and\nyou can also remove them from one or more groups. You may also choose to change\nthe users primary group, and specify whether or not you want them to remain in\ntheir old group as well.', 20),
(64, 16, 'How do I edit a group changer rule?', 'Click the\n<b>Edit</b> link beside the rule name. You will be able to edit all of the\nrules options in the screen that appears.', 30),
(65, 16, 'How do I delete a group changer rule?', 'Find the\nrule in the list, and click the <b>Delete</b> link. This will remove the group\nchanger rule.', 40),
(66, 16, 'Do the rules run as soon as a user meets the conditions?', 'Partly\nbecause of the inability to check all users number of days registered\nconstantly, and partly because of server load issues, the group changer is run\nas a scheduled task. This means that, by default, group changer rules are only\nrun at 30 minutes past the hour, every hour. To learn more about scheduled\ntasks, and how to change how often the group changer runs, check out the\nScheduled Tasks section of the FAQ.', 50),
(67, 17, 'What is a group?', 'Groups are\nthe way you manage permissions in Deluxe Portal. You can specify what a certain\ngroup can do, and then place users into the group. Users in the group will have\nthe permissions of that group. You can place users into more than one group.', 10),
(68, 17, 'How do I add a group?', 'Click the\n<b>Add New Group </b>link to begin. You must first choose a name for the group.\nThe first group of permissions you have to choose from are administrative\npermissions, which control access to various parts of the administrator control\npanel. These permissions are basically self-explanatory.<br />\n\n<br />\n\nThe super\nmoderator permissions control global moderating permissions. Enabling one of\nthese options will allow the user to perform this operation in all forums. One\nof the options that may need a bit of explaining is the <b>View full user\nprofiles</b> options. This allows access to the <b>View Users</b> section of\nthe moderator control panel. From there, you can view extended information\nabout the user, including their options and group settings.<br />\n\n<br />\n\nUser\npermissions control standard user operations, including posting, editing, and\ndeleting posts.<br />\n\n<br />\n\nThe <b>Other</b>\nsection has miscellaneous items. The <b>Can use HTML</b> option allows the user\nto use HTML and Javascript tags within posts. This is dangerous, and a security\nhazard, so if you use this option at all, it should be granted to only the most\ntrusted users (i.e. administrators). Using DP Code is far more preferable than\nenabling HTML.<br />\n\n<br />\n\nThe <b>Exempt\nfrom title censoring</b> option allows the user to bypass the custom title\ncensor. Normally, you would censor words like Moderator and Administrator\nwithin custom titles, so that other users cannot use these words in their\ntitle. Therefore, this option is useful for moderators and administrators. The <b>Exempt\nfrom ignore list</b> option will prevent other users from adding this user to\ntheir ignore list, and is also useful for moderators and administrators. <b>Exempt\nfrom Edited by message</b> will prevent the <i>Edited by username on\ndate/time</i>option from appearing at the bottom of posts that users in\nthis group have edited.<br />\n\n<br />\n\n<b>View\nfull Whos Online</b>\nwill allow access to the Whos Online page, which lists what each user on the\nsite is doing at that time. Invisible users are hidden from Whos Online unless\nthe person viewing the list has either the administrative <b>Users</b> option,\nor the super moderator <b>View full user profiles</b> option enabled. In that\ncase, the invisible users will have an <b>* </b>(asterisk) beside their names.<br />\n\n<br />\n\n<b>Lock\npost count</b> will\nprevent the users post count from incrementing or decrementing. Use this if you\nwould like for the users post count to always remain the same. <b>Username\nstyle (large) </b>and <b>Username style (small)</b> control the format of\nusernames. You can use this to make administrators appear in <b><i>bold italics</i></b>,\nfor example. <b>\\\\\$user_result[name]</b> will be replaced by the users name. The\nsmall style is used for the Whos Online listing at the bottom of the forum\nindex, and for the Currently Browsing Forum list at the top of the forum\ndisplay pages. The large style is used elsewhere. Any applicable HTML and CSS\ncan be used within the username styles.<br />\n\n<br />\n\nThe\nremaining options are explained in the groups control panel.', 20),
(69, 17, 'How do I edit a group?', 'To edit a\ngroup, click the <b>Edit</b> link beside the name of the group. You can then\nedit the groups options and permissions.', 30),
(70, 17, 'How do I delete a group?', 'To delete\na group, click the <b>Delete </b>link beside the group. You cannot delete the\ngroup if there are users in the group. You also cannot delete the group if it\nis being used as the default group for users, guests, banned users, or users\nawaiting email verification. These settings are controlled in the configuration\ncontrol panel.', 40),
(71, 17, 'How are permissions decided for users in multiple groups?', 'Since\nusers can be in more than one group, this raises a question: how are the\npermissions and options decided for the user when there are different options\nand permissions assigned to each group?<br />\n\n<br />\n\nFor the\npermissions, as long as at least one of the users groups has the permission,\nthe user has the permission. So, for example, if one group had the <b>Post new\nthreads</b> permission enabled and the other did not, the user would have\npermission to post new threads.<br />\n\nThe <b>Username\nstyle</b> options are decided based on the users primary group. The username\nstyles of the users primary group are used for that user. The <b>Maximum\nnumber of recipients of a PM</b> and <b>Maximum number of saved PMs</b>\noptions are done by selecting the largest number from all the groups. For\nexample, if a user was a member of three groups, one of which allowed <b>5</b>\nsaved PMs, one of which allowed <b>10</b>, and the other allowing <b>2</b>,\nthe user would be able to have <b>10</b> saved PMs.', 50),
(72, 18, 'What are icons?', 'Icons are\noptional indicators displayed beside thread and post titles to give a general\nindication of what the thread or post is about.', 10),
(73, 18, 'How do I add an icon?', 'You must\nfirst specify a name for the icon. You should then choose a display order,\nwhich will decide where the icon will be shown relative to other icons on the\nposting pages. A display order of <b>0</b> (zero) will hide the icon. Finally,\nyou can either upload an image, or specify the URL of an existing image.', 20),
(74, 18, 'How do I edit an icon?', 'Click the\n<b>Edit</b> link beside the icon in the list. You can then rename the icon, and\nchange its image.', 30),
(75, 18, 'How do I delete an icon?', 'Find the\nicon in the list, and click <b>Delete</b>. Doing this will remove the icon from\nany threads and posts that were using it, as well as delete the icon itself.', 40),
(76, 19, 'What are links?', 'Links are\na way to direct people from your site to other sites of potential interest. You\ncan organize your links into link categories, and control who can see which\nlinks.', 10),
(77, 19, 'How do I add a link category?', 'Click the\n<b>Add New Link Category </b>link to begin. A name must first be chosen for the\nlink category. Then, you need to either upload an image, or provide the URL of\nan existing image. Finally, you can select the groups which will be able to see\nlinks in this link category.', 20),
(78, 19, 'How do I edit a link category?', 'Click the\n<b>Edit</b> link beside the name of the link category. You will then be\npermitted to change the name, image, and viewing permissions for that link\ncategory.', 30),
(79, 19, 'How do I delete a link category?', 'Find the\nlink category in the list, and click <b>Delete</b>. You cannot delete a link\ncategory if there are currently any links using that category.', 40),
(80, 19, 'How do I add a link?', 'First,\nclick the <b>Add Link</b> link beside the link category to which you would like\nthis link added. Once you are on the Add New Link page, choose a name for your\nlink. The appropriate link category will already be selected. You may then\ninput a description of the link, although this is optional. Finally, you must\nspecify the URL of the link itself.', 50),
(81, 19, 'How do I edit a link?', 'Find the\nlink in the list, and click <b>Edit</b>. On the following page, you will be\nable to change the name of the link, the description, the link itself, and the\nlink category.', 60),
(82, 19, 'How do I delete a link?', 'Click the\n<b>Delete </b>link beside the name of the link. You will be asked to confirm\nwhether you want to remove the link.', 70),
(83, 20, 'Maintenance panel overview', 'Sometimes,\nthings can get out of sync. This may be because of database corruption, server\ncrashes, or other problems. For such situations, the maintenance control panel\nis here to fix the most common issues that may occur.', 10),
(84, 20, 'Update forum counters', 'After\nupgrading from Deluxe Portal 1.x or importing from another forum system, you\nwill need to run this script. This is also useful if any of the following\ninformation becomes incorrect: number of posts in forum, number of threads in a\nforum, or last thread information of a forum.', 20),
(85, 20, 'Update thread counters', 'After\nupgrading from Deluxe Portal 1.x or importing from another forum system, you\nwill need to run this script. This is also useful if any of the following\ninformation becomes incorrect: number of posts in a thread, or last post\ninformation of a thread.', 30),
(86, 20, 'Update user post counts', 'In the\nevent that one or more users post counts become incorrect, you can run this\nscript to update them to the correct count. This will not run on any users that\nhave the <b>Lock post count</b> group option enabled.', 40),
(87, 20, 'Update usernames', 'This is\nmainly something that needs to be done when upgrading from Deluxe Portal 1.x.\nHowever, in the case that a user has their name changed, and this change is not\nreflected throughout the site, you will need to run this maintenance option.\nYou should also run this script if the number of users or the last user to\nregister are displayed incorrectly on the forum home page.', 50),
(88, 20, 'Reparse post cache', 'By\ndefault, Deluxe Portal caches the posts of threads that have been posted in\nwithin the last two month, and any sticky threads as well. If you make any DP\nCode or smilie modifications, they will not be reflected in currently cached\nposts (unless they are edited). You can run this script to reparse all\ncurrently cached posts, thereby making them reflect your changes.', 60),
(89, 20, 'Reparse signature cache', 'All\nsignatures are cached in Deluxe Portal for performance reasons. If you modify\nany DP Code or smilies, current signatures will not reflect these changes. You\nmay run this script to reparse all signatures to take your changes into\naccount.', 70),
(90, 20, 'Reparse templates', 'When you\nedit or add a template, the template must be preprocessed and cached. In the\nevent that this cache (the <b>parsedtemplate</b> table) becomes corrupted, you\nwill need to run this script.', 80),
(91, 20, 'Clean imagestore', 'Older\nbeta releases of Deluxe Portal 2.0 (beta 2 and earlier) sometimes left orphaned images in the\ndatabase (also called the imagestore). This maintenance script will remove any\norphaned images, thereby potentially freeing up database space.', 90),
(92, 21, 'How do I mass delete threads?', 'Mass\ndeleting threads is a quick way to remove large numbers of threads, based on a\ngiven criteria. There are two ways to mass delete. The first is to mass delete\nby date. Enter a number of days in the <b>Delete threads with last post older\nthan x days</b> field. Then, you can specify a forum, or select <b>All forums</b>\nfrom the list. You can also specify whether or not you want to include\nsub-forums of that forum.<br />\n\n<br />\n\nThe\nsecond method is to delete all threads started by specific user. Enter their\nusername in the <b>Delete threads started by user</b> field. Then, select the\nappropriate forum from the drop down list. Check the <b>Include sub-forums</b>\nbox if you want to include sub-forums in the mass delete operation.<br />\n\n<br />\n\nMass\nDeleting does not affect the post count of any users. To correct users post\ncounts after doing a mass delete, run the <b>Update User Post Counts</b> script\nin the maintenance control panel.', 10),(93, 35, 'How do I mass delete threads?', 'Mass\ndeleting threads is a quick way to remove large numbers of threads, based on a\ngiven criteria. There are two ways to mass delete. The first is to mass delete\nby date. Enter a number of days in the <b>Delete threads with last post older\nthan x days</b> field. Then, you can specify a forum, or select <b>All forums</b>\nfrom the list. You can also specify whether or not you want to include\nsub-forums of that forum.<br />\n\n<br />\n\nThe\nsecond method is to delete all threads started by specific user. Enter their\nusername in the <b>Delete threads started by user</b> field. Then, select the\nappropriate forum from the drop down list. Check the <b>Include sub-forums</b>\nbox if you want to include sub-forums in the mass delete operation.<br />\n\n<br />\n\nMass\nDeleting does not affect the post count of any users. To correct users post\ncounts after doing a mass delete, run the <b>Update User Post Counts</b> script\nin the maintenance control panel.', 10),(94, 22, 'How do I mass move threads?', 'Mass\nmoving threads is useful when you want to move a large number of threads\nquickly. This can be used to archive old posts, or merge two forums. The first\nway to mass move threads is by last post date. Enter the number of days in the <b>Move\nthreads with last post older than x days </b>field. In the <b>From</b> field,\nselect the forums from which you want to move the threads. You can check the <b>Include\nsub-forums</b> box if you want to include the forums sub-forums. Finally,\nselect the destination forum in the <b>To</b> list.<br />\n\n<br />\n\nYou can\nalso move all threads started by a certain user. Enter their username in the <b>Move\nthreads started by user</b> field. Select the forum that contains the threads\nyou want to move in the <b>From</b> box, and the destination forum in the <b>To</b>\nbox.<br />\n\n<br />\n\nIf you\nare moving threads from a forum that counts posts towards user post counts to a\nforum that doesnt, or vice-versa, the mass move script does not recognize\nthis, and will not change any post counts. To correct this, run the <b>Update\nUser Post Counts</b> script in the maintenance control panel.', 10),
(95, 36, 'How do I mass move threads?', 'Mass\nmoving threads is useful when you want to move a large number of threads\nquickly. This can be used to archive old posts, or merge two forums. The first\nway to mass move threads is by last post date. Enter the number of days in the <b>Move\nthreads with last post older than x days </b>field. In the <b>From</b> field,\nselect the forums from which you want to move the threads. You can check the <b>Include\nsub-forums</b> box if you want to include the forums sub-forums. Finally,\nselect the destination forum in the <b>To</b> list.<br />\n\n<br />\n\nYou can\nalso move all threads started by a certain user. Enter their username in the <b>Move\nthreads started by user</b> field. Select the forum that contains the threads\nyou want to move in the <b>From</b> box, and the destination forum in the <b>To</b>\nbox.<br />\n\n<br />\n\nIf you\nare moving threads from a forum that counts posts towards user post counts to a\nforum that doesnt, or vice-versa, the mass move script does not recognize\nthis, and will not change any post counts. To correct this, run the <b>Update\nUser Post Counts</b> script in the maintenance control panel.', 10),
(96, 23, 'What is the moderator log?', 'The\nmoderator log monitors everything that is done in the moderator control panel.\nIt also logs every action performed using the moderator options found in each\nthread.<br />\n\n<br />\n\nThe\nfollowing information is logged:<br />\n\n<ul>\n <li>Username</li>\n <li>Action\n     (including thread name and a link to the thread, where appropriate)</li>\n <li>Date\n     and time of the action</li>\n <li>IP address</li>\n</ul>\n\n<br />\n\nYou can\nalso search the moderator log by using any of the criteria listed above.', 10),
(97, 37, 'What is the moderator log?', 'The\nmoderator log monitors everything that is done in the moderator control panel.\nIt also logs every action performed using the moderator options found in each\nthread.<br />\n\n<br />\n\nThe\nfollowing information is logged:<br />\n\n<ul>\n <li>Username</li>\n <li>Action\n     (including thread name and a link to the thread, where appropriate)</li>\n <li>Date\n     and time of the action</li>\n <li>IP address</li>\n</ul>\n\n<br />\n\nYou can\nalso search the moderator log by using any of the criteria listed above.', 10),
(98, 24, 'What is a moderator?', 'A\nmoderator is a user who has special permissions in one or more forums. These\npermissions include editing other users posts, and making announcements.', 10),
(99, 24, 'How do I add a moderator?', 'Click the\n<b>Add Moderator</b> link next to the forum to which you want to add the\nmoderator. On the Add Moderator screen, enter the username of the moderator.\nThen, select the permissions that you wish to give the moderator in this forum.\nWhen you add a moderator to a forum, he or she will automatically be added to\nall sub-forums of that forum.', 20),
(100, 24, 'How do I edit a moderator?', 'Click the\n<b>Edit </b>link beside the moderator you wish to edit. You will then be able\nto edit the permissions of the moderator, and even change the user and forum to\nwhich the entry applies. Any changes made here do not affect the moderator\nentries present in the forums sub-forums.', 30),
(101, 24, 'How do I delete a moderator?', 'To remove\na moderator, click the <b>Delete</b> link beside the moderators name, under\nthe forum from which you want to delete the moderator. Deleting a moderator\nwill not remove any moderator entries from any of the forums sub-forums.', 40),
(102, 25, 'What is a scheduled task?', 'Deluxe\nPortal allows you to run scripts at regular intervals (once a minute, hourly,\ndaily, and weekly). This is useful for certain maintenance scripts, and\nanything else you may want to run on a regular basis. Deluxe Portal comes with\nfour scheduled tasks by default. One of them runs group changer rules once an\nhour. Another clears old entries from the post cache daily. Another script\nremoves old entries from the session table, to prevent it from getting too\nlarge. Finally, there is one to prune old entries from the scheduled task log,\nand that script runs once a month.<br />\n\n<br />\n\nWith the\nscheduled task manager, you can not only edit and remove Deluxe Portals\nexisting scripts, but you can add your own scripts as well.', 10),
(103, 25, 'How do I add a scheduled task?', 'First,\ngive a name for the task. You can enter an optional description, which is\nsimply for anyone who wants additional information about the task (the\ndescription is only visible on the edit page). Next, you must enter the path to\nthe PHP script you wish to run. Unless you enter a leading slash (<b>/</b>),\nthe path will be relative to the main Deluxe Portal directory. Deluxe Portal\nkeeps all of its default task scripts in the <b>tasks</b> directory, so that\nmay be where you wish to store yours as well.<br />\n\n<br />\n\nYou must\nnext choose whether to enable this script. If it is not enabled, it will not\nrun. It is recommended that you set <b>Run if late </b>to yes. Otherwise, if\nthere is no one on your site at the time the script is supposed to run, the\ntask will not run until its next scheduled time. If you do enable <b>Run if\nlate</b>, the script will run as soon as someone comes onto your site. The <b>Log\ntask</b> setting specified whether the start time, end time, and any additional\ninformation (depending on the script) is placed into the scheduled task log.<br />\n\n<br />\n\nThe <b>Only\nrun if server load is below</b> option allows you to specify that you do not\nwant the script to run if the server is too busy. To enable this, enter a load\nlimit, for example, <i>5.00</i>. Otherwise, enter 0. This only works on\nLinux/UNIX based servers.<br />\n\n<br />\n\nEnter a\nvalue between <b>0 </b>and <b>59</b> for the minute if you want the script to\nrun only when the current minute is equal to the minute you specify. Otherwise,\nenter <b>Any</b>. The same applies for <b>hour</b>, <b>day of week</b>, and <b>day\nof month</b>. For example, if you set the minute to <i>0</i>, and the hour, day\nof week, and day of month to <i>Any</i>, the script would run on the hour,\nevery hour. Another example would be to set the minute to <i>30</i>, the hour\nto <i>2</i>, and the day of week to <i>Friday</i>. This will cause the script\nto run every Friday at 2:30 a.m., server time. Note that the day of week\nsetting overrides the day of month setting.', 20),
(104, 25, 'How do I edit a scheduled task?', 'To edit a\nscheduled task, click the <b>Edit</b> link beside the name of the task. You\nwill then be able to edit all options for that task. It will also show you when\nthe task is next scheduled to run according to your local time, not the server\ntime.', 30),
(105, 25, 'How do I delete a scheduled task?', 'Click the\n<b>Delete</b> link next to the task. This will not physically remove the script\nfrom your server.', 40),
(106, 25, 'How do I run a script right now?', 'Since you\ncannot directly run scheduled task scripts, click the <b>Run now</b> link\nbeside the name of the task. This will schedule the task to run immediately.\nAfter it has run, it will return to its regular schedule.', 50),
(107, 25, 'How do I make a scheduled task script?', 'Since\nDeluxe Portal expects a couple of things from a scheduled task script, you\ncannot schedule any script you want without first making a couple of changes.\nThese changes are quite simple, however.<br />\n\n<br />\n\n<ol>\n <li>Do not\n     provide any output. In other words, no <b>echo </b>or <b>print</b>\n     statements.</li>\n <li>Every\n     script should start with the following:\n<br />\n<br />\n<b>if (!defined(\'DP_CRON\'))</b><br />\n\n<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;die(\'This script can only be run from Deluxe\nPortal.\');</b><br />\n\n<b>\\\\\$DP_TASK = true;</b><br />\n\n<br />\n\nThis prevents people from being able to directly run the\nscript. It also lets Deluxe Portal know if the script ran.</li>\n <li>You\n     have access to all of Deluxe Portals functions (look through the files in\n     the include directory for more details), as well as an active database\n     connection. You also have access to the <b>\\\\\$config</b> array, which stores\n     global configuration information for Deluxe Portal, and the <b>\\\\\$task</b>\n     array, which contains information about the task currently being executed.</li>\n <li>You may\n     add entries to the task log with your script as well, by calling the\n     following function:</li>\n</ol>\n\n<br />\n\n<b>task_log(\\\\\$task, <i>Text for log entry goes here.</i>);</b><br />\n\n<br />\n\n<b>\\\\\$task</b> is passed to your script by Deluxe Portal, and must be passed to the\ntask_log() function.', 60),
(108, 25, 'How do I view the scheduled task log?', 'Click the\n<b>View Log</b> link. Each entry will tell you the name of the task, the action\nbeing taken when the log entry was created, and the time of the action. By\ndefault, entries older than two months are cleared from the log. You can\ndisable this log pruning by disabling the <b>Prune task log</b> task.\nAdditionally, you can remove all entries from the log by clicking the <b>Remove\nLog Entries</b> link.', 70),
(109, 26, 'What are sections?', 'Sections are\nwhere non-news articles are stored. Sections can be accessed from the Sections\npage, or from the left navbar that is present on some pages.', 10),
(110, 26, 'How do I add a section?', 'First, click\nthe <b>Add New Section </b>link. You must give the section a name. Then,\nspecify an image for your section. There are several permissions you must set\nfor the section. The <b>Viewing Permissions</b> control which groups can see\nthe section, as well as articles within that section. <b>Posting Permissions </b>control\nwhich groups can post articles to this section. The <b>Edit Own Article\nPermissions</b> allow the people in the selected groups to edit the articles\nthat they have posted, but not articles that others have posted. The <b>Delete\nOwn Article Permissions</b> control works similarly. Finally, <b>Edit Others Articles</b>\nand <b>Delete Others Articles</b> allow users in the specified groups to edit\nall articles and delete all articles, respectively. Note that for a user to be\nable to use any of the editing, deleting, or posting privileges, he or she must\nalso be in a group that allows access to the <b>Articles</b> control panel.', 20),
(111, 26, 'How do I edit a section?', 'Click the\n<b>Edit</b> link underneath the name of the section. You will then be taken to\na page where you can edit the sections name, image, and permissions.', 30),
(112, 26, 'How do I delete a section?', 'Click the\n<b>Delete</b> link underneath the section you wish to remove. You will not be\nable to remove a section if there are articles currently in that section.', 40),
(113, 27, 'What are smilies?', 'Smilies,\nalso known as emoticons, are a way to express your emotions in posts, news articles,\netc. Deluxe Portals smilies system allows you to replace text, such as <b>:) </b>with\nimages.', 10),
(114, 27, 'How do I add a smilie?', 'To add a\nsmilie, you must first enter a tag for the smilie. This tag is the text which\nwill be replaced with the smilie image. For example, the tag for a frown is <b>:(</b>.\nIf you enable the <b>Case insensitive </b>option, case will not be observed for\nthis smilie. For example, <i>:p </i>and <i>:P </i>would both refer to the same\nsmilie. Next, you should choose a name which describes the smilie, for example,\n<b>Frown</b>. Then, specify a display order. This is the order in which the\nsmilie will be displayed in the smilie list, relative to the other smilies. By\nspecifying a display order of <b>0</b> (zero), the smilie can still be used in\nposts, but will not be shown in the list of smilies.', 20),
(115, 27, 'How do I edit a smilie?', 'To edit a\nsmilie, click the <b>Edit </b>link next to the name of the smilie. You will be\nable to edit the smilie from there. Please note that any currently cached posts\nor signatures will not reflect the changes you make. To remedy this, run the <b>Reparse\nPost Cache</b> and <b>Reparse Signatures</b> scripts from the maintenance\ncontrol panel.', 30),
(116, 27, 'How do I delete a smilie?', 'Click the\n<b>Delete </b>link beside the smilie. Any currently cached signatures and posts\nwill not reflect the change. If you wish to correct this, run the <b>Reparse\nPost Cache </b>and <b>Reparse Signatures</b> scripts in the maintenance control\npanel.', 40),
(117, 28, 'What are style sets?', 'A style\nset is a combination of a template set and a style. This combination can then\nbe selected by users on the site, to control the look and layout of the site.', 10),
(118, 28, 'How do I add a style set?', 'Input a\nname for your style set. Then, enter the path to the logo you wish to use. An\nimages directory must be specified as well. Both the logo and images\ndirectories can be specified relative to your main Deluxe Portal directory. Do\nnot end the path for the images directory with a slash (<b>/</b>). The <b>Number\nseparator</b> field allows you to input the character with which you would like\nto separate numbers. For example, inputting a <b>,</b> (comma) would cause the\nnumber <i>10000</i> to be displayed as <i>10,000</i>. Finally, the <b>Enabled</b>\nselector allows you to specify whether the style set will be selectable by\nusers. Even if the style set is disabled, it can be assigned to a user by\nediting their account in the administrator control panel.<br />\n\n<br />\n\nYou have\nfour style options for the style set. You can create a copy of the default\nstyle, copy an existing style on the site, import a style from a file, or just\nuse an existing style. For all of these options, except the last one, you will\nbe required to name the new style.<br />\n\n<br />\n\nJust like\nwith styles, you also have four template set options. You can create a copy of\nthe default template set, copy an existing template set, import a template set,\nor use an existing template set.<br />\n\n<br />\n\n<b>Cell\nspacing</b> basically\ndetermines the number of pixels wide each table line will be. <b>Cell padding</b>\ndetermines the number of pixels between the edge of the table cell, and the\nstart of the cells content. Sidebar width, which can be specified in any valid\nCSS unit (<b>px</b> for pixels, <b>%</b> for relative percentages, etc.),\nspecifies the width of the sidebar shown on some pages.<br />\n\n<br />\n\nUnder\ndate formats, you can specify the date format for various parts of Deluxe Portal.\nThese should be specified using the PHP date format options, which can be found\nhere: <a href=\"http://www.php.net/manual/en/function.date.php\">http://www.php.net/manual/en/function.date.php</a>.\nDeluxe Portal also provides two extra date formatting options. The first is the\nability to display the words <b>Today</b> and <b>Yesterday</b> in place of the\ndate. To do this, enter the following in your date format:<br />\n\n<br />\n\n<b>[isday]<i>dayformat</i>[/isday]<i>dateformat</i></b><br />\n\n<br />\n\nAny\nformatting placed between the <b>[isday]</b> tags will be shown if the date is\neither today or yesterday. Otherwise, the formatting outside of the <b>[isday]</b>\ntags will be used. You can display the appropriate Today/Yesterday keywords by\nusing the <b>[day /] </b>tag. The text used to display <b>Today</b> and <b>Yesterday</b>\nare specified in the <b>[day /] Today</b> and <b>[day /] Yesterday</b> fields.<br />\n\n<br />\n\nDeluxe\nPortal also provides a <b>[text]</b> tag, for an easy way to display text\nwithout applying PHPs date formatting to it.<br />\n\n<br />\n\nThe\nfollowing is a complete example of Deluxe Portals default last post date\nformat. It uses all of the date formatting features described above:<br />\n\n<br />\n\n<i>[isday][day\n/] [text]at[/text] g:i A[/isday]n-d-Y g:i A</i><br />\n\n<br />\n\nIf the\ndate is either todays date or yesterdays date, Deluxe Portal will display,\nfor example, <i>Today at 3:15 PM</i>. If the date is not todays or yesterdays\ndate, it would display <i>8-01-2003 at 3:15 PM</i>.', 20),
(119, 28, 'How do I edit a style set?', 'To edit a\nstyle set, click the <b>Edit</b> link beside the name of the style set. By\ndefault, it will be set to continue using the existing style and template set\npreviously associated with this style set. You can associate a new style or\ntemplate set with the style set by using the options available under the Style\nand Template headings.', 30),
(120, 28, 'How do I delete a style set?', 'Click the\n<b>Delete</b> link beside the name of the style set. If this is a default style\nset (set in the configuration control panel), or is in use by one or more\nusers, you will not be able to delete it. Otherwise, you will be able to delete\nit. If this was the only style set using its associated style or template set, you\nwill also have the option of deleting them.', 40),
(121, 29, 'What are styles?', 'Styles\ncontrol the colors, fonts, and background images of your site. You can add many\nstyles, so that your users have a choice of how they want your site to look.', 10),
(122, 29, 'How do I add a style?', 'First,\nclick the <b>Add</b> link at the top of the styles control panel. Input a name\nfor the style. You have three options for setting up the new style. First, you\ncan create a copy of the default Deluxe Portal style. Secondly, you can make a\ncopy of one of the existing styles on the site. And third, you can import a\nstyle from a file.', 20),
(123, 29, 'How do I edit a style?', 'In the\nstyles control panel, choose the style you wish to edit from the dropdown list\nat the top of the page. You edit various parts of the style by clicking the\ncategory links on the left-hand side of the screen. Doing so will present you\nwith a wide variety of options for that part of the style, including font, text\nlayout, background, and positioning. You can also enter any additional CSS you\nmay need in the <b>Extra CSS </b>box. At the bottom of the screen, you will\nfind a section for style information, where you can set the name of the style,\nand any global CSS you wish to add for that style. For more help with CSS, see\nthis website: <a href=\"http://www.htmlhelp.com/reference/css/\">http://www.htmlhelp.com/reference/css/</a><br />\n\n<br />\n\nThe\nfollowing is a brief run down of where each of the style sections is used:<br />\n\n<ul>\n <li><b>Background:</b> This controls the frame\n     around the page.</li>\n <li><b>Foreground:</b> This is the main page, and\n     includes anything thats not in a table.</li>\n <li><b>Table\n     Lines:</b> Table\n     lines are the lines that separate each cell in a table.</li>\n <li><b>Table\n     Header: </b>This\n     is the row at the top of most tables used in Deluxe Portal, which usually\n     contains information about the table. For example, when adding a new user\n     via the admin control panel, the table header on that page says <i>Add\n     User</i>.</li>\n <li><b>Heading:\n     </b>Headings can\n     be used to separate different sections within a table. For example, in the\n     styles control panel, <i>Style Information</i>, <i>Background</i>, and\n     others are headings.</li>\n <li><b>Main\n     Table Cell: </b>In\n     Deluxe Portals tables, each row alternates between using main table\n     cells, and alternate table cells. This is where you edit the main table\n     cell display.</li>\n <li><b>Alternate\n     Table Cell: </b>This\n     is the table cell that is used on every other row (the rows in which main\n     table cells are not used).</li>\n <li><b>Small\n     Text:</b> In\n     some places, Deluxe Portal uses text that is smaller than the usual page\n     text.</li>\n <li><b>Logo\n     Background: </b>This\n     controls the area at the top of the page, where the logo is displayed.</li>\n <li><b>Logo\n     Image:</b> This\n     control the logo itself.</li>\n <li><b>Footer:</b> The footer is the area at\n     the bottom of the page, where text such as the copyright notice is\n     displayed.</li>\n <li><b>Navigation\n     Bar:</b> The\n     navigation bar separates the logo area from the background, and contains a\n     few buttons and a link stating whether you are logged in.</li>\n <li><b>Navigation\n     Bar Link:</b>\n     Controls the logged in/not logged in link displayed in the navigation bar.</li>\n <li><b>Navigation\n     Bar Image:</b>\n     This controls the image displayed in the navigation bar.</li>\n <li><b>Link:</b> This controls the display of\n     links. You can specify different formatting for unvisited links, visited\n     links, and active links (links over which the mouse is being hovered).</li>\n <li><b>Background\n     Link: </b>These\n     are the links which are shown in the background part of the page (mainly\n     links that appear at the bottom of the page, such as the <i>Contact Us</i>\n     link.</li>\n <li><b>Header\n     Link: </b>These\n     are links which are displayed within table headers.</li>\n <li><b>Small\n     Link:</b> These\n     are used when a smaller text size is desired for the link.</li>\n</ul>', 30),
(124, 29, 'How do I delete a style?', 'First,\nselect the style from the dropdown list at the top of the page. Then, click the\n<b>Delete</b> link, which is also near the top. If the style is being used by\none or more style sets, you will not be allowed to delete the style. Otherwise,\nyou will be permitted to delete it.', 40),
(125, 29, 'How do I export a style?', 'Exporting\na style allows you to save the content of a style to a file. This makes backing\nup styles easy, and also makes transferring styles to other websites easy. To\nexport a style, select the style from the dropdown list at the top of the page.\nThen, click <b>Export</b>. This will send a file to your browser, which you\nwill be able to save. This style file can later be imported, by adding a style\nand choosing the <b>Import</b> option.', 50),
(126, 29, 'How do I revert a style?', 'If you\nwould like to revert any of your styles to the default Deluxe Portal style,\nselect the style from the dropdown list at the top of the page, and click <b>Revert</b>.', 60),
(127, 30, 'What are templates?', 'Templates\nallow you to control every aspect of Deluxe Portals look and feel. All of the\nHTML used in Deluxe Portal is stored in templates. You can edit any of these\ntemplates, as well as add and delete your own custom templates. You are also\nallowed to have multiple template sets, so you can give your users many\ndifferent interface options.', 10),
(128, 30, 'How do I add a template set?', 'To add a\ntemplate set, click the <b>Add</b> link, which can be found beside the Search\nbutton. You must specify a name for your template set. You may then choose to\nbase this template set off of the default Deluxe Portal template set. Another\noption is to create a copy of an existing template set. Finally, you may also\nchoose to import a template set from a file.', 20),
(129, 30, 'How do I edit a template set?', 'Make sure\nthe correct template set is selected from the drop down list at the top of the\npage. Click the <b>Edit </b>link. This will permit you to change the name of\nthe template set.', 30),
(130, 30, 'How do I delete a template set?', 'To delete\na template set, first make sure the appropriate template set is selected from\nthe drop down list box at the top of the page. Then, click the <b>Delete </b>link.\nYou will only be allowed to remove the template set if there are no style sets\nusing the template set.', 40),
(131, 30, 'How do I export a template set?', 'Select\nthe appropriate template set from the drop down list, and then click <b>Export</b>.\nThis will allow you to save an entire template set to a file. This is useful\nfor backups, and for transferring template sets from one site to another.', 50),
(132, 30, 'How do I import a template set?', 'Select\nthe correct template set from the drop down list, and click <b>Import</b>. This\nwill allow you to bring the templates from a previously exported template set\ninto this template set. You can also select whether to delete the current\ntemplate sets old templates first.', 60),
(133, 30, 'How do I revert a template set?', 'Select\nthe correct template set from the drop down list, and click <b>Import</b>. This\nwill allow you to bring the templates from a previously exported template set\ninto this template set. You can also select whether to delete the current\ntemplate sets old templates first.', 70),
(134, 30, 'How do I add a template?', 'To add a\ntemplate, select the correct template set from the drop down list. Then, type\nin a name for your template in the <b>Name</b> box. We recommend using all\nlowercase names, and using letters, numbers, and underscores only. However,\nthis is not a requirement. You can input a category name as well. This can be\nan existing category, or a new one of your choosing. This is used simply to\norganize templates in the list to the left of your screen.<br />\n\n<br />\n\nFinally,\nyou must input the actual content of your template. This content will consist\nof HTML. Variables can be displayed in this template by inputting the name of\nthe variable. For example, putting <i>\\\\\$user[name]</i> in a template will cause\nthe current logged in users name to be displayed. It is recommended that you\nuse XHTML 1.0 Strict for your templates, since that is what Deluxe Portal uses.\nThis is not a requirement, however. There are several other features that you\ncan use in templates. These are covered in the FAQ topic What additional\nfeatures can be used in templates?', 80),
(135, 30, 'How do I edit a template?', 'Expand\nthe tree on the left side of the screen so that you can see the name of the\ntemplate. Click the <b>Edit</b> link beside the template. You will then be able\nto change the templates name, category, and contents.', 90),
(136, 30, 'How do I delete a template?', 'Using the\ntree control on the left side of the page, expand the categories out until you\nfind the template you wish to delete. Then, simply click the <b>Delete</b> link\nnext to the template. You are allowed to delete any template in Deluxe Portal,\nbut it is strongly advised that you do not delete any template that comes with\nDeluxe Portal, unless you are sure of what you are doing.', 100),
(137, 30, 'How do I revert a single template?', 'If you\nwish to revert one template to its default state, but not the whole template\nset, simply navigate to the template by using the tree control. Then, click the\n<b>Revert</b> link beside the template.', 110),
(138, 30, 'How do I search for (and replace) text within templates?', 'To search\nfor text, first make sure that you have selected the correct template set. You\ncan only search one template set at a time. Enter the text for which you are\nsearching in the input field labeled <b>Search</b>. Then click the <b>Search</b>\nbutton. The tree on the left of the page will then only show templates which\nmatch your search term.<br />\n\n<br />\n\nTo\nreplace the search term in all matching templates with alternate text, enter\nthe text into the <b>Replace with</b> box, which is shown in the tree control.\nThen, click <b>Replace</b>.', 120),
(139, 30, 'What additional features can be used in templates?', 'In\naddition to displaying HTML and variables, Deluxe Portals template system has\nseveral advanced features.<br />\n\n<br />\n\n<ul>\n <li><b>&lt;comment\n     /&gt; </b>-\n     Everything on the line after this tag will be ignored.</li>\n <li><b>&lt;comment&gt;&lt;/comment&gt;\n     </b>- Everything\n     between these tags will be ignored.</li>\n <li><b>&lt;if\n     <i>statement</i>&gt;&lt;else /&gt;&lt;/if&gt; </b>- The statement will be\n     checked. If it is true, then the HTML within the &lt;if&gt;&lt;/if&gt;\n     tags will be displayed. Otherwise, the code between the &lt;else\n     /&gt;&lt;/if&gt; will be displayed (if there is no &lt;else /&gt; tag,\n     nothing will be shown. Any valid PHP comparisons can be used (<i>==</i>, <i>&lt;</i>,\n     <i>&gt;</i>, etc.). You can also combine statements by using &amp;&amp;\n     for and, and || for or. If you use more than one greater than (<b>&gt;</b>) comparison, you must enclose the statement in parentheses. For example:<br />\n<br />\n<i>&lt;if (\\\\\$var==2 || \\\\\$var&gt;5)&gt;Yes&lt;else\n/&gt;No&lt;/if&gt;</i><br />\n<br /></li>\n <li><b>&lt;variable\n     name=<i>name</i> value=<i>value</i> /&gt; </b>- This sets a variable called\n     <i>name</i>, to contain <i>value</i>.</li>\n <li><b>&lt;variable\n     name=<i>name</i> force=php value=<i>value</i> /&gt; </b>- This sets a variable, but\n     will overwrite existing PHP variables if they exist. Normally, variables\n     set within templates are protected, so you cannot overwrite a needed\n     Deluxe Portal variable. However, with the <b>force=php</b> option, any\n     existing Deluxe Portal variable will be overwritten. Only use this if you\n     are sure of what you are doing. One use for this is to change the title of\n     a page, which is displayed in the title bar of your browser. For example:<br />\n<br />\n<i>&lt;variable name=pagetitle force=php value=Test\npage /&gt;</i><br />\n<i>&lt;include template=header /&gt;</i><br />\n<br /></li>\n <li><b>&lt;variable\n     name=<i>name</i> /&gt; </b>- This displays a previously set variable. <b>\\\$<i>name</i></b>\n     can be used instead.</li>\n <li><b>&lt;include\n     template=<i>name</i> /&gt; </b>- Includes an existing template, called <i>name</i>.</li>\n <li><b>&lt;include\n     src=<i>filename</i> /&gt; </b>- Includes a file to display within the template.</li>\n<li><b>&lt;include src=<i>filename</i> type=<i>type</i> /&gt;\n</b>- Includes a\nfile. If type is set to <b>require</b>, then the file will be included as PHP\ncode, and an error will occur if the file is not present. The <b>include</b>\noption works the same way, except that no error will be generated if the file\nis not present. Finally, the <b>readfile</b> option will simply display the\ncontents of the file.</li>\n <li><b>&lt;?php\n     <i>code</i> ?&gt; </b>- Evaluates the PHP code between the tags.</li>\n <li><b>&lt;?\n     <i>code</i> ?&gt; </b>- Another way to include PHP code in a template.</li>\n <li><b>&lt;?=<i>variable/string</i>?&gt;\n     </b>- Displays\n     the contents of the variable, string, or expression.</li>\n <li><b>&lt;?php=<i>variable/string</i>?&gt;\n     </b>- Another\n     way of writing the above statement.</li>\n</ul>', 130),
(140, 31, 'What is a title?', 'A title\nis an indicator of a users status. It can be based on post count, permission\nlevel, or anything else. Deluxe Portal allows you to specify default titles for\nusers, on a group-by-group, and post count basis.', 10),
(141, 31, 'How do I add a title?', 'In the\ntitles control panel, enter the actual title in the <b>Title</b> field. Next,\nspecify the minimum number of posts a user must have before they can use this\ntitle. You must also choose a group. All users who have this group set as their\nprimary group will use this title. You can optionally include an image to be\ndisplayed along with the title. To do this, enter either a path to the image in\nthe <b>Rank image </b>field. You can use <b>\\\\\$style[images]</b> within the path\nto reference the image directory of the current style set. You can make the\nimage repeat by entering a number larger than 1 in the <b>Number of times to\ndisplay image </b>field. You can enter a <b>0 </b>(zero) in this field to\ndisable the image.', 20),
(142, 31, 'How do I edit a title?', 'Click the\n<b>Edit</b> link beside the title you wish to edit. You will be able to change\nall aspects of the title.', 30),
(143, 31, 'How do I delete a title?', 'Find the\ntitle in the list found on the left side of the titles control panel. Beside\nthe title you wish to remove, click the <b>Delete</b> link.', 40),
(144, 31, 'How does Deluxe Portal decide which title to use?', 'There are\nseveral factors that determine which title a user will receive. The first\nquestion you may have is Since a user can belong to more than one group, which\ngroup will be used for his or her title? The primary group is the one that\ndetermines a users title. The primary group is the group that is selected in\nthe drop down list (you will see this when editing users, setting default\ngroups, and other activities).<br />\n\n<br />\n\nPost\ncount is the next factor. Since each group can have an unlimited number of\npossible titles, post count is used to decide. The title that will be used for\nthe user is the title which has the closest post count to the users post\ncount, without going over. Therefore, if you wanted to make everyone in a group\nhave the same title, you would set the post count to zero.<br />\n\n<br />\n\nFinally,\nif a group has the <b>Can use custom title</b> permission set (this is done in\nthe groups control panel), then the user will be able to override the default\ntitle and supply their own. If they do not do this, then they will be given a\ntitle based on the rules already covered here. In addition, you can give any\nuser a custom title by editing their account in the user control panel.<br />\n\n<br />\n\nIf your\ntitle uses a rank image, the image will be displayed even if the user has a\ncustom title.', 50),
(145, 32, 'What is a topic?', 'A topic\nis a news category. When you post an article, by specifying a topic, you are\nindicating that this article should be displayed on the front page. You can use\ntopics as an indicator of what your news article is about.', 10),
(146, 32, 'How do I add a topic?', 'First, click\nthe <b>Add New Topic </b>link. Specify a name for the topic in the <b>Name</b>\nfield. Next, you can elect to have articles belonging to that topic\nautomatically posted in the forum of your choosing. If you wish to do this,\nselect a forum from the list. By doing this, when viewing the article on the\nfront page, there will be a comments link. Clicking this link will take you to\nthe thread which has been automatically generated for that article.<br />\n\n<br />\n\nIf you\nuse this setting, keep in mind that all forum permissions still apply. The\narticle poster must have posting rights in the forum to be able to have a\nthread generated. Likewise, members must have the appropriate permissions so\nthat they can view, and possibly reply to, the thread. Topic permissions\n(covered next) do not apply to the thread, so it is important to get both the\ntopic permissions and the forum permissions correct. Finally, you must choose\nan image to represent this topic.<br />\n\n<br />\n\nThere are\nseveral permissions that can be set, that will apply to all articles in the\ntopic. For each permission setting, users belonging to groups that are checked\nwill have that permission. If a user does not belong to any of the checked\ngroups, they will not have that permission. The permissions are self\nexplanatory, and allow for viewing the articles, posting new articles, editing\narticles posted by the author, editing articles posted by other authors,\ndeleting articles posted by the author, and deleting articles posted by other\narticles. For a user to be able to use any of the posting, editing, or deleting\npermissions, they must belong to a group that has the <b>Articles</b>\npermission enabled.', 20),
(147, 32, 'How do I edit a topic?', 'Find the\ntopic in the topics control panel, and click <b>Edit</b>. You will be able to\nchange the name, forum, image, and permissions of the topic in the following\nscreen.', 30),
(148, 32, 'How do I delete a topic?', 'To delete\na topic, find it on the list on the left side of the page. Click the delete\nlink below the topic name. You will only be able to delete the topic if there\nare no articles using the topic.', 40),
(149, 33, 'How do I add a user?', 'Administrators\nhave the ability to add users, thereby bypassing the normal registration\nmethod. This can be useful for adding test users, or perhaps normal accounts,\ndepending on how your site is set up. To add a user, click the <b>Add new user</b>\nicon/link. You will be required to enter a username, email address, and\npassword. You also must specify the users primary group (which is used to\ndetermine user titles), and any additional groups to which the user will\nbelong. You are also able to set up any additional profile fields/options at\nthis time.', 10),
(150, 33, 'How do I edit a user?', 'First,\nyou must find the user. This can be done by using the search function of the\nusers control panel (covered in the How do I search for users section). You\ncan also use the normal user search functionality of the search page, or you\ncan bring up the users profile and click the <b>Edit User</b> link. Any way\nyou do it, you will come to the edit user page.<br />\n\n<br />\n\nThis page\nis much like the add new user page, except that you will be viewing and editing\nthe details of an existing account. User passwords cannot be viewed, because\nthey are encrypted. If you need to change the users password, however, you can\nenter it at the bottom of the page. Otherwise, his or her password will remain\nunchanged.<br />\n\n<br />\n\nYou will\nnotice several buttons at the bottom of the page. <b>Update User</b> will save\nyour changes. <b>Log User Off </b>will clear that users sessions, and could\npotentially be helpful if the users account is hacked. The <b>Check IP</b> and\n<b>Delete User</b> buttons are covered in other sections.', 20),
(151, 33, 'How do I delete a user?', 'The\neasiest way to delete a user is by bringing up the edit user page for that\nuser. From there, you can click the <b>Delete User</b> link at the bottom of\nthe page. This is, of course, an irreversible action, so do not delete a user\naccount unless you are sure that you want it gone forever.', 30),
(152, 33, 'How do I search for users?', 'In the\nusers control panel, you will notice a search box. This is much like the one\nfound on the search page, with a couple of exceptions. First, you can specify groups\nwith this search. A user match will only be returned if they belong to at least\none of the groups checked off on this page. You can search by style set, in\ncase you want to see who is using a particular style, or to help narrow down\nyour results. Alternatively, you can click the <b>View All Users</b> icon to\nshow all users. This can take a long time if you have a lot of users.<br />\n\n<br />\n\nWhen the\nsearch results are shown, you will see <b>Edit </b>and <b>Delete</b> links for\neach account. These links are self-explanatory. You will also see three buttons\nat the top of the page. These functions are explained in other sections.', 40),
(153, 33, 'How do I mass delete users?', 'Run a\nsearch in the users control panel that will match the users you wish to delete.\nOn the search results page, click the <b>Delete</b> button. This will remove\nevery account you see listed on the page. Be careful with this function, as it\nhas the potential to wipe out every user account on your site.', 50),
(154, 33, 'How do I mass email users?', 'Do a\nsearch in the users control panel that will match the users you want to email.\nOn the search results page, click the <b>Email</b> button. You will then be\nable to enter a subject and message. You can also specify how many users to\nemail per page cycle. If you set this number too high, you may cause the script\nto time out. This will only email users who have set <b>Receive mail from the\nadministrators</b> to yes.', 60),
(155, 33, 'How do I mass PM users?', 'Run a\nsearch in the users control panel which will match the users you wish to\nprivate message. On the search results page, click the <b>PM</b> button. You\nwill be presented with a standard private message page. However, this one does\nnot enforce limits (group-based setting of how many users a person can private\nmessage at one time). Just like with mass email, this page has a setting to\nspecify how many users to message per cycle. If this number is set too high,\nthe script may time out.', 70),
(156, 33, 'How do I check IP addresses?', 'The first\nway is from the edit user page. Bring up the edit user page for a user, and\nclick the <b>Check IP</b> button. The second way is by clicking the <b>Check IP\naddresses</b> icon, found on the main users control panel screen. From there,\nyou can enter a username and/or an IP address to search for (partial IP\naddresses are acceptable).<br />\n\n<br />\n\nThis\nfunction checks the post database for all posts matching the given username/IP\ninformation. You will receive a list of matches. From this list, you can also\nclick a username or IP address, and a search will be run on the specified term.', 80),
(157, 38, 'How do I view a user?', 'First,\nyou must find the user, either by using the search function in the view users\ncontrol panel, or by clicking the <b>View User</b> link in the users profile\npage. This function will allow you to see all information about the user,\nexcept for passwords (which are encrypted). You are not, however, allowed to\nchange any of the information found on the page. The two buttons found at the\nbottom of the page are covered in other sections of the FAQ.', 10),
(158, 38, 'How do I search for users?', 'You can\nsearch for users in much the same way as you can from the standard search page.\nHowever, the view users panel also allows you to use groups, style set, and\nemail address as criteria. You can also click the <b>View All Users</b> link to\ndisplay a list of every user registered on the site, but this can take a long\ntime if there are a lot of users registered.', 20),
(159, 38, 'How do I ban users?', 'To ban a\nuser, view them via the view users control panel, and click <b>Ban User</b>.\nYou can also run a search, and click the <b>Ban </b>link next to the user.\nBanning a user will move them to the banned group, as specified in the\nconfiguration panel of the administrator control panel.', 30),
(160, 38, 'How do I check IP addresses?', 'One way\nis to click the <b>Check IP </b>button while viewing the users profile from\nwithin the view users control panel. Alternatively, you can click the <b>Check\nIP Addresses</b> link in the view users control panel. This will allow you to\nspecify usernames and/or IP addresses to search for. The resulting page will\ndisplay username and IP address pairs. You can click on a username or IP\naddress to run a search on it. This information comes from posts made by the\nuser.', 40)");

	db_query("alter table config add show_subforums tinyint unsigned not null");
	db_query("update config set show_subforums=1");
	db_query("alter table groups add tasks tinyint unsigned not null");
	db_query("update groups set tasks=0");
	db_query("update groups set tasks=1 where configuration=1");
	db_query("alter table config add next_task int unsigned not null");
	
	$task_post = get_next_timestamp(0, 3, -1, -1);
$task_session = get_next_timestamp(0, 0, -1, -1);
$task_task = get_next_timestamp(15, 0, 1, -1);
$task_changer = get_next_timestamp(30, -1, -1, -1);
$next_task = min($task_post, $task_session, $task_task, $task_changer);
	db_query("update config set next_task='$next_task'");
	
	db_query("CREATE TABLE task (
  taskid int(10) unsigned NOT NULL auto_increment,
  name char(255) NOT NULL default '',
  script char(255) NOT NULL default '',
  minute tinyint(4) NOT NULL default '0',
  hour tinyint(4) NOT NULL default '0',
  day tinyint(4) NOT NULL default '0',
  dayofweek tinyint(4) NOT NULL default '0',
  enabled tinyint(3) unsigned NOT NULL default '0',
  late tinyint(3) unsigned NOT NULL default '0',
  log tinyint(3) unsigned NOT NULL default '0',
  nextrun int(10) unsigned NOT NULL default '0',
  max_load char(5) NOT NULL default '',
  description char(255) NOT NULL default '',
  PRIMARY KEY  (taskid),
  KEY name (name(10)),
  KEY nextrun (nextrun)
)");

db_query("INSERT INTO task (taskid, name, script, minute, hour, day, dayofweek, enabled, late, log, nextrun, max_load, description) VALUES (1, 'Prune post cache', 'tasks/postcache.php', 0, 3, -1, -1, 1, 1, 1, '$task_post', '0', 'Removes old entries from the post cache, to save disk space. You can configure this in the configuration panel, under Server Options.'),
(2, 'Prune session table', 'tasks/session.php', 0, 0, -1, -1, 1, 1, 1, '$task_session', '0', 'Removes old entries from the session table, in order to keep the size down.'),
(3, 'Prune task log', 'tasks/tasklog.php', 15, 0, 1, -1, 1, 1, 1, '$task_task', '0', 'Removes entries older than two months from the scheduled task log.'),
(4, 'Group changer', 'tasks/groupchanger.php', 30, -1, -1, -1, 1, 1, 1, '$task_changer', '0', 'Runs group changer tasks.')");
	
	db_query("alter table forum add threadname char(255) not null");
	db_query("alter table forum add threadiconid int unsigned not null");
	db_query("alter table forum add lastthreadid int unsigned not null");
	db_query("update forum set threadname='',threadiconid=0,lastthreadid=0");
	db_query("alter table config add lastpost_thread tinyint unsigned not null");
	db_query("update config set lastpost_thread=1");
	
	db_query("CREATE TABLE tasklog (
  taskid int(10) unsigned NOT NULL auto_increment,
  name char(255) NOT NULL default '',
  logdate int(10) unsigned NOT NULL default '0',
  action char(255) NOT NULL default '',
  PRIMARY KEY  (taskid)
)");
	
	db_query("alter table config drop modlog_per_page");
	db_query("alter table config drop numlinks_modlog");
	db_query("alter table config change adminlog_per_page log_per_page int unsigned not null");
	db_query("alter table config change numlinks_adminlog numlinks_log int unsigned not null");
	db_query("alter table user add user_salt char(16) not null");
	db_query("alter table config add dp_info tinyint unsigned not null");
	db_query("alter table config drop show_images");
	db_query("alter table config drop allowphp_templates");
	db_query("update config set dp_info=1");
	db_query("alter table grouprules rename grouprule");
	db_query("alter table grouprule change condition post_condition enum('drops', 'reaches') not null");
	db_query("alter table grouprule add and_or enum('and', 'or') not null");
	db_query("alter table grouprule add groupid int unsigned not null");
	db_query("alter table grouprule add dont_remove tinyint unsigned not null");
	db_query("update grouprule set and_or='and',groupid=0,dont_remove=0");
	db_query("alter table user change signature uncached_signature text not null");
	db_query("alter table user add signature text not null");
	db_query("update user set signature=''");
	db_query("alter table post add parsed_message mediumtext not null");
	db_query("update post set parsed_message=''");
	db_query("alter table config add post_cache int unsigned not null");
	db_query("alter table config add showspiders tinyint unsigned not null");
	db_query("alter table config add spider_names text not null");
	db_query("alter table config add spider_agents text not null");
	db_query("update config set post_cache=60,showspiders=1,spider_names='AlltheWeb\nAltavista\nAsk Jeeves\nExalead\nGoogle\nGrub\nInktomi\nLycos\nNameProtect\nTurnitin.com\nW3C Validator\nWhois Source\nWiseNut',spider_agents='fast-webcrawler\nscooter\nask jeeves\nexalead\ngooglebot\ngrub-client\nslurp@inktomi\nlycos\nnpbot\nturnitinbot\nw3c_validator\nsurveybot\nzyborg'");
	db_query("alter table session add useragent varchar(50) not null");
	db_query("update session set useragent=''");
	db_query("alter table privatemessage add html tinyint unsigned not null");
	db_query("alter table privatemessage add showsignature tinyint unsigned not null");
	db_query("update privatemessage set html=0,showsignature=0");
	
	db_query("CREATE TABLE stylecss (
  selectorid int(10) unsigned NOT NULL auto_increment,
  styleid int(10) unsigned NOT NULL default '0',
  ordered int(3) unsigned NOT NULL default '0',
  name char(255) NOT NULL default '',
  selector char(255) NOT NULL default '',
  italic tinyint(1) unsigned NOT NULL default '0',
  bold tinyint(1) unsigned NOT NULL default '0',
  obique tinyint(1) unsigned NOT NULL default '0',
  textdecoration_none tinyint(1) unsigned NOT NULL default '0',
  underline tinyint(1) unsigned NOT NULL default '0',
  overline tinyint(1) unsigned NOT NULL default '0',
  linethrough tinyint(1) unsigned NOT NULL default '0',
  textalign char(7) NOT NULL default '',
  texttransform char(10) NOT NULL default '',
  smallcaps tinyint(1) unsigned NOT NULL default '0',
  color char(20) NOT NULL default '',
  fontsize char(12) NOT NULL default '',
  letterspacing char(12) NOT NULL default '',
  lineheight char(12) NOT NULL default '',
  whitespace char(6) NOT NULL default '',
  position char(8) NOT NULL default '',
  floatposition char(5) NOT NULL default '',
  clear char(5) NOT NULL default '',
  toppos char(12) NOT NULL default '',
  bottompos char(12) NOT NULL default '',
  leftpos char(12) NOT NULL default '',
  rightpos char(12) NOT NULL default '',
  width char(12) NOT NULL default '',
  height char(12) NOT NULL default '',
  margin char(12) NOT NULL default '',
  padding char(12) NOT NULL default '',
  backgroundcolor char(20) NOT NULL default '',
  backgroundimage char(255) NOT NULL default '',
  backgroundrepeat char(9) NOT NULL default '',
  backgroundattachment char(5) NOT NULL default '',
  borderleft char(255) NOT NULL default '',
  borderright char(255) NOT NULL default '',
  bordertop char(255) NOT NULL default '',
  borderbottom char(255) NOT NULL default '',
  bordersame tinyint not null,
  fontfamily char(255) NOT NULL default '',
  display char(255) NOT NULL default '',
  verticalalign char(255) NOT NULL default '',
  extra text NOT NULL,
  PRIMARY KEY  (selectorid),
  KEY styleid (styleid, ordered)
)");
	
	db_query("alter table config drop new_messages_indicator");
	db_query("drop table style");
	
	db_query("CREATE TABLE style (
  styleid int(10) unsigned NOT NULL auto_increment,
  extra text NOT NULL,
  name char(255) NOT NULL default '',
  php_default char(7) NOT NULL default '',
  php_comment char(7) NOT NULL default '',
  php_html char(7) NOT NULL default '',
  php_keyword char(7) NOT NULL default '',
  php_string char(7) NOT NULL default '',
  PRIMARY KEY  (styleid)
)");
	
	db_query("alter table config add gd_registration tinyint unsigned not null");
	db_query("update config set gd_registration=1");
	db_query("alter table session add registerid varchar(7) not null");
	db_query("update session set registerid=''");
	db_query("alter table user drop numfailed");
	db_query("alter table user drop lastfail");
	
	db_query("CREATE TABLE iplock (
  ip char(39) NOT NULL default '',
  numfailed int(10) unsigned NOT NULL default '0',
  lastfail int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (ip)
)");
	
	db_query("alter table config add external_style tinyint unsigned not null");
	db_query("update config set external_style=1");
	db_query("alter table parsedtemplate modify name char(255) not null");
	db_query("alter table thread add redirected tinyint unsigned not null");
	$config = db_fetch_array(db_query("select * from config"));
	if ($config['email_groupid'])
	{
		db_query("update config set default_register_group=$config[email_groupid],email_groupid=$config[default_register_group]");
		db_query("delete from defaultgroups where user=1");
		db_query("insert into defaultgroups (groupid, user) values ($config[email_groupid], 1)");
	}
	db_query("update config set online_timeout=15 where online_timeout=10");
	db_query("update config set redirect_time=redirect_time*1000,listqueries=1");
	db_query("update dpcode set replacement='<hr />',empty=1 where tag='hr'");
	db_query("truncate style");
	$styleid = old_import_style('../data/style.dps.php', 0, 'Default');
	db_query("update styleset set styleid='$styleid'");
	db_query("update groups set html=1 where groups=1");
	$threadquery = '';
	$query = db_query("select redirect from thread where redirect>0");
	while ($thread = db_fetch_array($query))
		$threadquery .= ($threadquery ? " or " : '')."threadid=$thread[redirect]";
	if ($threadquery)
		db_query("update thread set redirected=1 where $threadquery");
	db_query("alter table config add show_rules tinyint unsigned not null");
	db_query("alter table config add rules text not null");
	db_query("update config set show_rules=0,rules='Enter your forum rules here.'");
	if ($styleset_delete)
	{
		db_query("truncate styleset");
		db_query("INSERT INTO `styleset` (`stylesetid`, `name`, `frontpage_date_format`, `logo`, `lastpost_date_format`, `join_post_date_format`, `post_date_format`, `join_date_format`, `styleid`, `templatesetid`, `enabled`, `editedby_date_format`, `most_online_date_format`, `images`, `log_date_format`, `announcement_date_format`, cellspacing, cellpadding, sidebar, separator, frontpage_day_date_format, today_text, yesterday_text) VALUES (1, 'Default', 'l, F j, g:i A', 'images/logo.gif', '[isday][day /] [text]at[/text] g:i A[/isday]n-d-Y g:i A', 'F Y', '[isday][day /] [text]at[/text] g:i A[/isday]n-d-Y g:i A', 'n-d-Y', '$styleid', 2, 1, '[isday][day /] [text]at[/text] g:i A[/isday] [text]on[/text] n-d-Y g:i A', 'n-d-Y [text]at[/text] g:i A', 'images/default', 'n-d-Y [text]at[/text] g:i A', 'n-d-Y', 1, 4, '200px', ',', '[isday][day /][/isday]l, F d, Y', 'Today', 'Yesterday')");
		db_query("update config set guest_stylesetid=1,default_styleset=1");
		db_query("update user set stylesetid=1");
	}
	
	redirect("u200b4.php?op=2&template_edit=$template_edit&template_delete=$template_delete");
}
elseif ($_REQUEST['op']==2)
{
	echo 'Step 2: Altering indexes<br /><br />';
	db_query_noerror("alter table announcement add index userid (userid)");
	db_query("alter table article drop index userid");
	db_query("alter table article drop index sectionid");
	db_query("alter table download drop index downloadcategoryid");
	db_query("alter table download add index name (name(10))");
	db_query("alter table downloadcategory add index name (name(10))");
	db_query("alter table downloadpermissions drop index downloadcategoryid");
	db_query_noerror("alter table emailverify drop index userid");
	db_query("alter table forum drop index parentid");
	db_query_noerror("alter table forum drop index lastuserid");
	db_query("alter table forumpermission add index forumid (forumid)");
	db_query_noerror("alter table grouprule drop index groupid");
	db_query("alter table ignorelist drop index userid");
	db_query("alter table ignorelist drop index ignoreuserid");
	db_query("alter table ignorelist add index userid (userid, ignoreuserid)");
	db_query("alter table link drop index linkcategoryid");
	db_query("alter table link add index name (name(10))");
	db_query("alter table linkcategory add index name (name(10))");
	db_query("alter table linkpermissions drop index linkcategoryid");
	db_query("alter table markread drop index userid");	
	db_query("alter table markread drop index threadid");
	db_query("alter table markread drop index postid");
	db_query("alter table markread add index threadid (threadid, userid, postid)");
	db_query("alter table moderator drop index forumid");
	db_query("alter table moderator drop index userid");
	db_query("alter table moderator add index userid (userid, forumid)");
	db_query("alter table moderator add index userid_2 (userid, announcements, massdelete, massmove)");
	db_query("alter table parsedtemplate drop index templatesetid");
	db_query("alter table parsedtemplate drop index name");
	db_query("alter table parsedtemplate add index name (name(10), templatesetid)");
	db_query("alter table post drop index threadid");
	db_query("alter table post drop index iconid");
	db_query("alter table post add index threadid (threadid, userid)");
	db_query_noerror("alter table post add index editedby_userid (editedby_userid)");
	db_query("alter table privatemessage drop index userid");
	db_query("alter table privatemessage drop index iconid");
	db_query("alter table privatemessage drop index isread");
	db_query("alter table privatemessage drop index folder");
	db_query("alter table privatemessage add index userid (userid, folder, isread, sentdate)");
	db_query_noerror("alter table privatemessage add index touserid (touserid)");
	db_query("alter table section add index name (name(10))");
	db_query("alter table sectionpermissions drop index sectionid");
	db_query("alter table sectionpermissions drop index groupid");
	db_query("alter table sectionpermissions drop index view");
	db_query("alter table sectionpermissions add index groupid (groupid, view)");
	db_query("alter table session drop index sessionid");
	db_query("alter table session drop index userid");
	db_query("alter table session drop index lastactivity");
	db_query("alter table session add primary key (sessionid)");
	db_query("alter table session add index userid (userid, lastactivity)");
	db_query("alter table session add index url (url(10))");
	db_query("alter table session add index viewthreadid (viewthreadid)");
	db_query("alter table styleset drop index styleid");
	db_query("alter table styleset drop index templatesetid");
	db_query("alter table subscribedemail drop index userid");
	db_query("alter table subscribedemail drop index threadid");
	db_query("alter table subscribedemail add index threadid (threadid, userid)");
	db_query("alter table subscribedforum drop index forumid");
	db_query("alter table template drop index category");
	db_query("alter table template add index category (category(10))");
	db_query("alter table thread drop index forumid");
	db_query("alter table thread drop index lastpostid");
	db_query("alter table thread drop index name");
	db_query("alter table thread drop index redirect");
	db_query("alter table thread drop index lastpostdate");
	db_query("alter table thread add index redirect (redirect, lastpostdate)");
	db_query("alter table thread add index forumid (forumid, sticky)");
	db_query("alter table thread add index name (name(10))");
	db_query_noerror("alter table thread add index lastuserid (lastuserid)");
	db_query("alter table topic add index name (name(10))");
	db_query("alter table topicpermissions drop index topicid");
	db_query("alter table topicpermissions drop index groupid");
	db_query("alter table topicpermissions drop index view");
	db_query("alter table topicpermissions add index groupid (groupid, view)");
	db_query("alter table user add index name (name(10))");
	db_query("alter table user add index stylesetid (stylesetid)");
	db_query("alter table user add index posts (posts, joindate)");
	db_query("alter table usergroups drop index userid");
	db_query("alter table usergroups drop index groupid");
	db_query("alter table usergroups add index userid (userid, groupid)");
	db_query_noerror("alter table whovoted add index threadid (threadid)");
	
	redirect("u200b4.php?op=3&template_edit=$template_edit&template_delete=$template_delete");
}
elseif ($_REQUEST['op']==3)
{
	echo 'Step 3: Setting up templates<br /><br />';
	
	$tid = db_fetch_array(db_query("select templatesetid from templateset order by templatesetid desc limit 1"));
	$newid = $tid['templatesetid'] + 1;
	db_query("update templateset set templatesetid='$newid' where templatesetid=1");
	db_query("update template set templatesetid='$newid' where templatesetid=1");
	db_query("update parsedtemplate set templatesetid='$newid' where templatesetid=1");
	db_query("insert into templateset (templatesetid, name) values (1, 'Admin/Mod CP')");
	db_query("update styleset set templatesetid='$newid' where templatesetid=1");
	
	if ($template_edit)
		$change = 'main_index,main_article,redirect_header,user_index,permission_error,header,footer,register_index,register_account,forum_index,profile_index,forum_forum_parent,forum_forum,forumdisplay_index,forumdisplay_thread,thread_index,thread_post,newthread_index,forumdisplay_forum,newreply_index,editpost_index,icon_column,ip_index,option_indention,smilie,forumdisplay_multipage_last,editprofile_index,editoptions_index,memberlist_index,close_thread_redirect,moderate_delete_thread,edit_thread,delete_thread,delete_post,pm_index,leaders_group,leaders_user,pm_message,newpm_index,forum_forum_parent_canpost,readpm_index,email_hidden,leaders_moderator,user_ignored_user,add_buddy_redirect,user_buddy,topic_index,topic_showtopic,section_index,section_showsection,section_section,download_index,download_showcategory,download_download,link_showcategory,link_link,link_index,pagenav,pagenav_first,pagenav_last,pagenav_link,pagenav_next,pagenav_prev,article_index,unsubscribe_thread_redirect,unsubscribe_email_redirect,user_subscribed_forum,unsubscribe_forum_redirect,moderate_copymove,forumdisplay_thread_redirect,online_index,online_user,search_index,add_poll,thread_poll_vote,reset_poll,moderate_poll_option,search_results,search_result_post,search_result_ignored,search_length,forumdisplay_announcement,announcement_announcement,activate_account_invalid,nav_header,newreply_post,newthreads_index,rules,replies_user,popup_header,replies_index,mail_emailreverify,search_result_article_full,search_result_article,smilie_column,smilie_box,smilie_index,send_pm_failed,report_index,unsubscribe_threads,unsubscribe_emails,printthread_index,printthread_pagenav,printthread_post,moderate_delete_redirect,forumjump,login_account_password,login_account_attempts,post_codeblock,post_phpblock,main_date,icon_row,icon_table,printthread_poll_result,server_busy,server_busy_guest,editprofile_signature,forum_forum_subforum,forumdisplay_forum_subforum,faq_index,faq_category,faq_item,invalid_faq,faq_show_category,faq_toc,faq_item_contents,faq_item_tree,faq_category_tree,faq_index_tree,faq_show_category_tree,server_busy_search,register_account_imageverify,invalid_page,add_ignored_user_redirect';
	else
		$change = '';
	
	if ($template_delete)
		$delete = 'templates_index,admin_index,logout_redirect,login_account_redirect,templates_category,templates_template,add_template_redirect,templates_missing,delete_template,delete_template_redirect,edit_template,templates_duplicate,edit_template_redirect,configuration_index,edit_configuration_redirect,forums_index,groups_index,groups_group,groups_duplicate,add_group_redirect,groups_missing,edit_group,edit_group_redirect,delete_group,delete_group_redirect,delete_group_denied,users_index,icons_index,post_thread_redirect,post_reply_redirect,edit_post_redirect,styles_index,icons_missing,add_icon_redirect,icons_icon,edit_icon,edit_icon_redirect,delete_icon,delete_icon_redirect,invalid_icon,icon_choice,titles_index,edit_title,add_title_redirect,titles_title,titles_group,group_choice,invalid_title,titles_duplicate,edit_title_redirect,titles_missing,delete_title,delete_title_redirect,users_search_result,users_search,forums_forum,indent,delete_forum,delete_forum_redirect,add_forum_redirect,forums_missing,edit_forum,edit_forum_redirect,dpcode_index,dpcode_duplicate,add_dpcode_redirect,dpcode_dpcode,edit_dpcode,dpcode_missing,edit_dpcode_redirect,delete_dpcode,delete_dpcode_redirect,smilies_index,smilies_smilie,add_smilie_redirect,smilies_missing,edit_smilie,edit_smilie_redirect,delete_smilie,invalid_smilie,delete_smilie_redirect,edit_user,users_duplicate,edit_user_redirect,delete_user,delete_user_redirect,users_user,add_user,users_missing,users_password,add_user_redirect,edit_style_redirect,stylesets_index,templateset_choice,style_choice,stylesets_styleset,stylesets_missing,moderators_index,moderators_moderator,moderators_forum,add_moderator,add_moderator_redirect,invalid_moderator,delete_moderator,delete_moderator_redirect,edit_moderator,edit_moderator_redirect,fields_index,fields_duplicate,add_field_redirect,fields_field,edit_field,edit_field_redirect,fields_missing,delete_field,delete_field_redirect,invalid_customfield,usergroup_choice,topics_topic,add_topic_redirect,topics_missing,topics_index,edit_topic,edit_topic_redirect,delete_topic,delete_topic_redirect,viewgroup_choice,editowngroup_choice,editothersgroup_choice,deleteowngroup_choice,deleteothersgroup_choice,postgroup_choice,topics_duplicate,sections_duplicate,templates_separator,delete_section_redirect,delete_section,edit_section,edit_section_redirect,sections_section,sections_index,sections_missing,add_section_redirect,articles_article,articles_index,articles_missing,add_article_redirect,edit_article,edit_article_redirect,delete_article,delete_topic_denied,delete_section_denied,delete_article_redirect,guestgroup_choice,forum_online,add_styleset_redirect,stylesets_duplicate_templateset,stylesets_duplicate,edit_styleset,edit_styleset_redirect,delete_styleset,delete_styleset_denied,delete_styleset_redirect,forum_pm,moderators_duplicate,archive_messages_redirect,delete_messages_redirect,delete_buddy_redirect,delete_ignored_user_redirect,forumperm_index,forumperm_forum,downloads_index,downloads_category,add_download_category_redirect,downloads_category_missing,edit_download_category,edit_download_category_redirect,delete_download_category_denied,delete_download_category,delete_download_category_redirect,add_download_redirect,add_download,edit_download,edit_download_redirect,downloads_missing,delete_download,delete_download_redirect,downloadcategory_choice,downloads_download,add_link,add_link_category_redirect,add_link_redirect,delete_link_category_denied,delete_link_category_redirect,delete_link_category,delete_link_redirect,delete_link,links_category,linkcategory_choice,links_link,links_index,edit_link,edit_link_category,links_category_missing,edit_link_category_redirect,links_missing,edit_link_redirect,invalid_download,invalid_link,adminlog_index,adminlog_adminlog,styles_duplicate,invalid_style,delete_style,delete_style_denied,delete_style_redirect,forumperm_group,forumperm_end,forumperm_edit,invalid_forumperm,edit_forumperm_redirect,groupchanger_index,ingroup_choice,addgroup_choice,removegroup_choice,groupchanger_duplicate,add_rule_redirect,groupchanger_rule,invalid_dpcode,edit_rule,edit_rule_redirect,delete_rule,invalid_grouprule,delete_rule_redirect,maintenance_index,maintenance_threads,maintenance_users,faq_usercp,add_poll_redirect,vote_poll_redirect,mod_index,modlog_log,modlog_index,view_user,viewusers_index,viewusers_user,viewusers_search,viewusers_search_result,ban_user,ban_user_redirect,announcements_index,announcements_announcement,announcements_forum,search_pagenav_first,search_pagenav_last,search_pagenav_link,search_pagenav_next,search_pagenav_prev,add_announcement,announcements_missing,add_announcement_redirect,invalid_announcement,delete_announcement,delete_announcement_redirect,edit_announcement,edit_announcement_redirect,downloads_duplicate_category,links_duplicate_category,groupchanger_missing,invalid_addon,maintenance_usernames,emailgroup_choice,run_rule_redirect,edit_templateset,templates_duplicate_templateset,edit_templateset_redirect,templates_templateset_missing,add_style,styles_missing,add_style_redirect,style_default_invalid,style_import_invalid,revert_style,revert_style_redirect,invalid_templateset,revert_templateset,templateset_import_invalid,revert_templateset_redirect,delete_templateset_denied,delete_templateset,delete_templateset_redirect,revert_template,invalid_template,revert_template_redirect,import_template_missing,add_templateset,add_templateset_redirect,massmove_index,option_nomoving,massmove_done,massdelete_done,forum_nodeleting,massdelete_index,massdelete_users_redirect,massdelete_users,massmail_users,massmail_users_redirect,mass_number,check_ip,check_ip_result,check_ip_results,check_ip_results_mod,check_ip_mod,faq_posting,faq_smilie,faq_dpcode,faq_pm,logout_user_redirect,replace_templates_redirect,markread_allforums_redirect,maintenance_templates,markread_forum_redirect,maintenance_imagestore,announcements_date,massmail_users_continue,masspm_users,masspm_users_continue,masspm_users_redirect';
	else
		$delete = '';
	
	$new = 'icon_column,main_date,icon_row,icon_table,printthread_poll_result,server_busy,server_busy_guest,editprofile_signature,forum_forum_subforum,forumdisplay_forum_subforum,faq_category,faq_item,invalid_faq,faq_show_category,faq_toc,faq_item_contents,faq_item_tree,faq_category_tree,faq_index_tree,faq_show_category_tree,server_busy_search,register_account_imageverify,invalid_page';
	
	$admin_change = '';
	
	$admin_delete = '';
	
	$admin_new = 'templates_index,admin_index,templates_category,templates_template,templates_missing,delete_template,edit_template,templates_duplicate,configuration_index,edit_configuration_redirect,forums_index,groups_index,groups_group,groups_duplicate,groups_missing,edit_group,delete_group,delete_group_denied,users_index,icons_index,styles_index,icons_missing,icons_icon,edit_icon,delete_icon,titles_index,edit_title,titles_title,titles_group,titles_duplicate,titles_missing,delete_title,users_search_result,users_search,forums_forum,delete_forum,forums_missing,edit_forum,dpcode_index,dpcode_duplicate,dpcode_dpcode,edit_dpcode,dpcode_missing,delete_dpcode,smilies_index,smilies_smilie,smilies_missing,edit_smilie,delete_smilie,edit_user,users_duplicate,edit_user_redirect,delete_user,delete_user_redirect,users_user,add_user,users_missing,users_password,edit_style_redirect,stylesets_index,stylesets_styleset,stylesets_missing,moderators_index,moderators_moderator,moderators_forum,add_moderator,delete_moderator,edit_moderator,fields_index,fields_duplicate,fields_field,edit_field,fields_missing,delete_field,topics_topic,topics_missing,topics_index,edit_topic,delete_topic,topics_duplicate,sections_duplicate,templates_separator,delete_section,edit_section,sections_section,sections_index,sections_missing,articles_article,articles_index,articles_missing,edit_article,delete_article,delete_topic_denied,delete_section_denied,stylesets_duplicate_templateset,stylesets_duplicate,edit_styleset,delete_styleset,delete_styleset_denied,moderators_duplicate,forumperm_index,forumperm_forum,downloads_index,downloads_category,downloads_category_missing,edit_download_category,delete_download_category_denied,delete_download_category,add_download,edit_download,downloads_missing,delete_download,downloads_download,add_link,delete_link_category_denied,delete_link_category,delete_link,links_category,links_link,links_index,edit_link,edit_link_category,links_category_missing,links_missing,adminlog_index,adminlog_adminlog,styles_duplicate,delete_style,delete_style_denied,forumperm_group,forumperm_end,forumperm_edit,groupchanger_index,groupchanger_duplicate,groupchanger_rule,edit_rule,delete_rule,maintenance_index,maintenance_threads,maintenance_users,mod_index,modlog_log,modlog_index,view_user,viewusers_index,viewusers_user,viewusers_search,viewusers_search_result,ban_user,ban_user_redirect,announcements_index,announcements_announcement,announcements_forum,add_announcement,announcements_missing,delete_announcement,edit_announcement,downloads_duplicate_category,links_duplicate_category,groupchanger_missing,maintenance_usernames,edit_templateset,templates_duplicate_templateset,templates_templateset_missing,add_style,styles_missing,style_default_invalid,style_import_invalid,revert_style,revert_style_redirect,revert_templateset,templateset_import_invalid,revert_templateset_redirect,delete_templateset_denied,delete_templateset,revert_template,invalid_template,revert_template_redirect,import_template_missing,add_templateset,massmove_index,massmove_redirect,massdelete_redirect,massdelete_index,massdelete_users_redirect,massdelete_users,massmail_users,massmail_users_redirect,check_ip,check_ip_results,check_ip_results_mod,check_ip_mod,logout_user_redirect,replace_templates_redirect,maintenance_templates,maintenance_imagestore,announcements_date,massmail_users_continue,masspm_users,masspm_users_continue,masspm_users_redirect,header,footer,form_footer,form_header,message_header,message_footer,templateset_choice,addgroup_choice,deleteothersgroup_choice,deleteowngroup_choice,downloadcategory_choice,editothersgroup_choice,editowngroup_choice,emailgroup_choice,forum_choice,forum_nodeleting,group_choice,guestgroup_choice,ingroup_choice,linkcategory_choice,option_indention,option_noposting,postgroup_choice,removegroup_choice,section_choice,styleset_choice,style_choice,topic_choice,usergroup_choice,viewgroup_choice,redirect_footer,redirect_header,permission_error,site_closed,invalid_announcement,invalid_article,invalid_customfield,invalid_download,invalid_download_category,invalid_dpcode,invalid_forum,invalid_forumperm,invalid_grouprule,invalid_icon,invalid_link,invalid_link_category,invalid_moderator,invalid_section,invalid_smilie,invalid_style,invalid_styleset,invalid_templateset,invalid_title,invalid_topic,invalid_user,banned,icon_column,icon_row,icon_table,import_templateset,server_busy,server_busy_guest,forumperm_reset,forumperm_deny,import_templateset_redirect,check_ip_result,add_forum,add_rule,add_group,faqmanager_index,faqmanager_item,faqmanager_category,faqmanager_faq,add_faq,faqmanager_duplicate,faqmanager_missing,invalid_faq,edit_faq,delete_faq,add_faq_category,faq_choice,faqmanager_missing_category,edit_faq_category,invalid_faq_category,delete_faq_category,add_faq_item,invalid_faq_item,faqmanager_missing_item,edit_faq_item,delete_faq_item,tasks_index,tasks_task,tasks_missing,tasks_duplicate,tasks_range,edit_task,invalid_task,delete_task,tasks_show_log,tasks_log,prune_task_log,mass_number,run_task,run_task_redirect,add_download_category,add_link_category,sections_row,add_section,topics_row,add_topic,maintenance_signatures,maintenance_posts,maintenance_posts_disabled,maintenance_forums,styles_category,styles_category_link,indent,smilie_box,smilie_row,smilie_column,pagenav,pagenav_first,pagenav_last,pagenav_link,pagenav_next,pagenav_nolink,pagenav_prev,smilie,custom_field,mail_pmnotification,delete_templateset_admin';
	
	selective_import(1, $admin_new, $admin_change, $admin_delete);
	
	$query = db_query("select * from templateset where templatesetid>1");
	while ($tset = db_fetch_array($query))
		selective_import($tset['templatesetid'], $new, $change, $delete);
	
	redirect("u200b4.php?op=4");
}
elseif ($_REQUEST['op']==4)
{
	echo 'Step 4: Updating user password and lastactivity';
	if (!is_numeric($start))
		$start = 0;
	$query = db_query("select user.*,session.lastactivity as ses_lastactivity from user left join session on session.userid=user.userid where user.userid>$start group by user.userid order by user.userid asc,session.lastactivity desc limit 500");
	$i = 0;
	$lastid = 0;
	while ($user = db_fetch_array($query))
	{
		$salt = generate_salt();
		$md5password = addslashes(dp_hash($salt, $user['password'], true));
		db_query("update user set password='$md5password',user_salt='".addslashes($salt)."',lastactivity='$user[ses_lastactivity]' where userid=$user[userid]");
		$i++;
		$lastid = $user['userid'];
	}
	if ($i==500)
	{
		echo "<br /><br />Updated through user $lastid";
		redirect("u200b4.php?op=4&start=$lastid");
	}
	else
	{
		echo "<br /><br />Finished updating users";
		db_query("update config set version='2.0.0 Beta 4'");
		redirect("upgrade.php");
	}
}

print_footer();
?>