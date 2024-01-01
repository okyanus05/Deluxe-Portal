<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Alpha 3 -> Beta 1");

function old_import_templateset($url, $templatesetid, $name)
{
	if (!($fp = fopen($url, 'rb')))
		return false;
	$contents = trim(substr(fread($fp, filesize($url)), 8, -5));
	fclose($fp);
	$contents = str_replace("\r", "", $contents);
	$contents = str_replace("\n", "\r\n", $contents);
	$templates = unserialize($contents);
	if (!$templatesetid)
	{
		db_query("insert into templateset (name, preprocessed) values ('$name', '".$templates['**reserved**_preprocessed'][body]."')");
		$templateset_result = db_fetch_array(db_query('select templatesetid from templateset order by templatesetid desc limit 1'));
		$templatesetid = $templateset_result[templatesetid];
	}
	else
		db_query("update templateset set preprocessed='".$templates['**reserved**_preprocessed'][body]."' where templatesetid='$templatesetid'");
	$query = db_query("select * from template where templatesetid='$templatesetid'");
	$templatestore = array();
	while ($template = db_fetch_array($query))
		$templatestore[$template[name]] = true;
	if ($templates)
	{
		reset($templates);
		while (list($name, $template) = each($templates))
		{
			if ($name!='**reserved**_preprocessed')
			{
				$template[category] = addslashes($template[category]);
				$template[body] = addslashes($template[body]);
				if (isset($templatestore[$name]))
				{
					$name = addslashes($name);
					db_query("update template set category='$template[category]',body='$template[body]' where name='$name' and templatesetid='$templatesetid'");
				}
				else
				{
					$name = addslashes($name);
					db_query("insert into template (name, category, body, templatesetid) values ('$name', '$template[category]', '$template[body]', '$templatesetid')");
				}
			}
		}
	}
	return $templatesetid;
}

function old_import_style($url, $styleid, $name)
{
	if (!($lines = file($url)))
		return false;
	if (!$styleid)
	{
		db_query("insert into style (background_backgroundcolor,background_color,background_extra,background_font,background_size,cellalt_backgroundcolor,cellalt_color,cellalt_extra,cellalt_font,cellalt_size,cellmain_backgroundcolor,cellmain_color,cellmain_extra,cellmain_font,cellmain_size,foreground_backgroundcolor,foreground_color,foreground_extra,foreground_font,foreground_size,heading_backgroundcolor,heading_color,heading_extra,heading_font,heading_size,small_color,small_extra,small_font,small_size,tableheader_backgroundcolor,tableheader_color,tableheader_extra,tableheader_font,tableheader_size,tableline_backgroundcolor,tableline_color,tableline_extra,link_font,link_color,link_size,link_extra,linkactive_font,linkactive_color,linkactive_size,linkactive_extra,linkvisited_font,linkvisited_color,linkvisited_size,linkvisited_extra,backgroundlink_font,backgroundlink_size,backgroundlink_color,backgroundlink_extra,backgroundlinkactive_font,backgroundlinkactive_size,backgroundlinkactive_color,backgroundlinkactive_extra,backgroundlinkvisited_font,backgroundlinkvisited_size,backgroundlinkvisited_color,backgroundlinkvisited_extra,linksmall_font,linksmall_size,linksmall_color,linksmall_extra,linksmallactive_font,linksmallactive_size,linksmallactive_color,linksmallactive_extra,linksmallvisited_font,linksmallvisited_size,linksmallvisited_color,linksmallvisited_extra,linkheader_font,linkheader_size,linkheader_color,linkheader_extra,linkheaderactive_font,linkheaderactive_size,linkheaderactive_color,linkheaderactive_extra,linkheadervisited_font,linkheadervisited_size,linkheadervisited_color,linkheadervisited_extra, extra, name) values ('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','', '$name')");
		$style_result = db_fetch_array(db_query('select styleid from style order by styleid desc limit 1'));
		$styleid = $style_result[styleid];
	}
	$styles = array('background_backgroundcolor','background_font','background_size','background_color','background_extra','link_font','link_size','link_color','link_extra','small_font','small_size','small_color','small_extra','linkvisited_font','linkvisited_size','linkvisited_color','linkvisited_extra','linkactive_font','linkactive_size','linkactive_color','linkactive_extra','foreground_backgroundcolor','foreground_font','foreground_size','foreground_color','foreground_extra','tableline_backgroundcolor','tableline_color','tableline_extra','cellmain_backgroundcolor','cellmain_font','cellmain_size','cellmain_color','cellmain_extra','cellalt_backgroundcolor','cellalt_font','cellalt_size','cellalt_color','cellalt_extra','tableheader_backgroundcolor','tableheader_font','tableheader_size','tableheader_color','tableheader_extra','heading_backgroundcolor','heading_font','heading_size','heading_color','heading_extra','backgroundlink_font','backgroundlink_size','backgroundlink_color','backgroundlink_extra','backgroundlinkvisited_font','backgroundlinkvisited_size','backgroundlinkvisited_color','backgroundlinkvisited_extra','backgroundlinkactive_font','backgroundlinkactive_size','backgroundlinkactive_color','backgroundlinkactive_extra','linkheader_font','linkheader_size','linkheader_color','linkheader_extra','linkheadervisited_font','linkheadervisited_size','linkheadervisited_color','linkheadervisited_extra','linkheaderactive_font','linkheaderactive_size','linkheaderactive_color','linkheaderactive_extra','linksmall_font','linksmall_size','linksmall_color','linksmall_extra','small_font','small_size','small_color','small_extra','linksmallvisited_font','linksmallvisited_size','linksmallvisited_color','linksmallvisited_extra','linksmallactive_font','linksmallactive_size','linksmallactive_color','linksmallactive_extra','extra');
	$i = 0;
	$dobreak = false;
	each($lines);
	while (list($key, $line) = each($lines))
	{
		$line = trim($line);
		if ($i==89)
		{
			$n = 91;
			$line .= "\n";
			while ($res = $lines[$n++])
				$line .= $res;
			$line = str_replace("\n*/ ?>", '', $line);
			$dobreak = true;
		}
		$style = $styles[$i++];
		$updatequery .= "$style='".addslashes($line)."',";
		if ($dobreak)
			break;
	}
	db_query("update style set ".substr($updatequery, 0, -1)." where styleid='$styleid'");
	return $styleid;
}

db_connect();
db_select_db();

	echo 'Upgrading from 2.0.0 Alpha 3 to 2.0.0 Beta 1<br />';
	echo '<br />';
	db_query("alter table grouprules add days int unsigned not null");
	db_query("update grouprules set days=0");
	db_query("alter table user add massmail tinyint unsigned not null");
	db_query("update user set massmail=1");
	db_query("alter table config add doticons tinyint unsigned not null");
	db_query("update config set doticons=1");
	db_query("alter table config add headlines tinyint unsigned not null");
	db_query("update config set headlines=0");
	db_query("alter table styleset add cellspacing int unsigned not null");
	db_query("update styleset set cellspacing=1");
	db_query("alter table styleset add cellpadding int unsigned not null");
	db_query("update styleset set cellpadding=4");
	db_query("alter table groups add maxpm int unsigned not null");
	db_query("update groups set maxpm=4294967295 where groups=1");
	db_query("update groups set maxpm=50 where groups=0");
	db_query("alter table groups add html tinyint unsigned not null");
	db_query("alter table thread modify `redirect` int(10) unsigned NOT NULL default '0'");
	db_query("update groups set html=0");
	db_query("CREATE TABLE `emailgroups` (
  `userid` int(10) unsigned NOT NULL default '0',
  `groupid` int(10) unsigned NOT NULL default '0',
  `isprimary` tinyint(3) unsigned NOT NULL default '0',
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`)
) TYPE=MyISAM");
	db_query("alter table styleset add sidebar char(255) not null");
	db_query("update styleset set sidebar='200px'");
	db_query("alter table config add number_smilies int unsigned not null");
	db_query("update config set number_smilies=12");
	db_query("alter table config add smilies_row int unsigned not null");
	db_query("update config set smilies_row=3");
	db_query("alter table post add url tinyint unsigned not null");
	db_query("update post set url=1");
	db_query("alter table article add url tinyint unsigned not null");
	db_query("update article set url=1");
	db_query("alter table announcement add url tinyint unsigned not null");
	db_query("update announcement set url=1");
	db_query("alter table user add website char(255) not null");
	db_query("update user set website=''");
	db_query("alter table user add img tinyint unsigned not null");
	db_query("update user set img=1");
	db_query("alter table imagestore add type char(255) not null");
	db_query("alter table imagestore add name char(255) not null");
	if (!$import_smilies)
	{
		db_query("delete from smilie");
		db_query("INSERT INTO `smilie` (`smilieid`, `tag`, `name`, `image`, `ordered`) VALUES (1, ':)', 'Smile', 'images/smilies/smile.gif', 1),
(3, ':(', 'Frown', 'images/smilies/sad.gif', 2),
(4, ':eek:', 'Eek!', 'images/smilies/eek.gif', 10),
(5, ':mad:', 'Mad', 'images/smilies/mad.gif', 9),
(6, ':D', 'Big Grin', 'images/smilies/biggrin.gif', 4),
(7, ':p', 'Stick out Tongue', 'images/smilies/tongue.gif', 6),
(9, ':o', 'Embarrassed', 'images/smilies/embarrassed.gif', 3),
(10, ';)', 'Wink', 'images/smilies/wink.gif', 4),
(11, ':cool:', 'Cool', 'images/smilies/cool.gif', 7),
(12, ':rolleyes:', 'Roll eyes', 'images/smilies/rolleyes.gif', 8),
(13, ':confused:', 'Confused', 'images/smilies/confused.gif', 11)");
	}
	if (!$import_icons)
	{
		db_query("delete from icon");
		db_query("INSERT INTO `icon` (`iconid`, `name`, `image`, `ordered`) VALUES (7, 'Smile', 'images/icons/smile.gif', 7),
(8, 'Frown', 'images/icons/sad.gif', 9),
(10, 'Wink', 'images/icons/wink.gif', 12),
(9, 'Big grin', 'images/icons/biggrin.gif', 10),
(11, 'Cool', 'images/icons/cool.gif', 6),
(12, 'Thumbs down', 'images/icons/thumbsdown.gif', 13),
(13, 'Mad', 'images/icons/mad.gif', 8),
(14, 'Thumbs up', 'images/icons/thumbsup.gif', 14),
(15, 'Embarrassed', 'images/icons/embarrassed.gif', 11),
(16, 'Exclamation', 'images/icons/exclamation.gif', 4),
(17, 'Post', 'images/icons/post.gif', 1),
(18, 'Arrow', 'images/icons/arrow.gif', 2),
(19, 'Lightbulb', 'images/icons/lightbulb.gif', 3),
(20, 'Question', 'images/icons/question.gif', 5)");
	}
	
	db_query("delete from template");
	db_query("delete from templateset");
	db_query("delete from style");
	db_query("delete from styleset");
	$mac = old_import_style('../data/style.dps.php', 0, 'Mac');
	$dark = old_import_style('dark.dps.php', 0, 'Dark');
	$light = old_import_style('light.dps.php', 0, 'Light');
	db_query("INSERT INTO `styleset` (`stylesetid`, `name`, `frontpage_date_format`, `logo`, `lastpost_date_format`, `join_post_date_format`, `post_date_format`, `join_date_format`, `styleid`, `templatesetid`, `enabled`, `editedby_date_format`, `most_online_date_format`, `images`, `log_date_format`, `announcement_date_format`, cellspacing, cellpadding, sidebar) VALUES (3, 'Dark', 'l, F j, g:i A', 'images/logo.gif', 'n-d-Y g:i A', 'F Y', 'n-d-Y g:i A', 'n-d-Y', '$dark', 1, 1, 'n-d-Y g:i A', 'n-d-Y \\\\a\\\\t g:i A', 'images/dark', 'n-d-Y \\\\a\\\\t g:i A', 'n-d-Y', 1, 4, '200px'),
(2, 'Light', 'l, F j, g:i A', 'images/logo.gif', 'n-d-Y g:i A', 'F Y', 'n-d-Y g:i A', 'n-d-Y', '$light', 1, 1, 'n-d-Y g:i A', 'n-d-Y \\\\a\\\\t g:i A', 'images/light', 'n-d-Y \\\\a\\\\t g:i A', 'n-d-Y', 1, 4, '200px'),
(1, 'Mac', 'l, F j, g:i A', 'images/maclogo.gif', 'n-d-Y g:i A', 'F Y', 'n-d-Y g:i A', 'n-d-Y', '$mac', 1, 1, 'n-d-Y g:i A', 'n-d-Y \\\\a\\\\t g:i A', 'images/mac', 'n-d-Y \\\\a\\\\t g:i A', 'n-d-Y', 1, 4, '200px')");
	db_query("INSERT INTO `templateset` (`templatesetid`, `name`, `preprocessed`) VALUES (1, 'Default', 'header\r\nfooter\r\nmessage_header\r\nmessage_footer\r\nredirect_header\r\nredirect_footer\r\nform_header\r\nform_footer\r\nnav_header\r\nnav_footer\r\npopup_header\r\npopup_footer')");
	old_import_templateset("../data/template.dpt.php", 1, '');
	db_query("update user set stylesetid=1");
	db_query("update config set default_styleset=1,guest_stylesetid=1");
	
	db_query("update config set version='2.0.0 Beta 1'");
	
	redirect('upgrade.php');

print_footer();
?>