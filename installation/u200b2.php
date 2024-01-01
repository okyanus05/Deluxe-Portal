<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Beta 1 -> Beta 2");

function old_import_templateset($url, $templatesetid, $name)
{
	if (!$fp = fopen($url, 'r'))
		return false;
	$contents = trim(substr(fread($fp, filesize($url)), 8, -5));
	fclose($fp);
	$contents = str_replace("\r\n", "\n", $contents);
	$contents = str_replace("\r", "\n", $contents);
	$templates = unserialize($contents);
	if (!$templatesetid)
	{
		db_query("insert into templateset (name) values ('$name')");
		$templateset_result = db_fetch_array(db_query('select templatesetid from templateset order by templatesetid desc limit 1'));
		$templatesetid = $templateset_result[templatesetid];
	}
	$query = db_query("select * from template where templatesetid='$templatesetid'");
	$templatestore = array();
	while ($template = db_fetch_array($query))
		$templatestore[$template[name]] = true;
	if ($url!="../data/template.dpt.php")
	{
		if (!$dfp = fopen("../data/template.dpt.php", 'r'))
			return false;
		$dcontents = trim(substr(fread($dfp, filesize('../data/template.dpt.php')), 8, -5));
		fclose($dfp);
		$dcontents = str_replace("\r\n", "\n", $dcontents);
		$dcontents = str_replace("\r", "\n", $dcontents);
		$defaulttemplates = unserialize($dcontents);
	}
	db_query("update template set custom=1 where templatesetid='$templatesetid'");
	while (list($name, $template) = each($templates))
	{
		$template[category] = addslashes($template[category]);
		$parsed_template = addslashes(parse_template($template[body]));
		$template[body] = addslashes($template[body]);
		if (substr(strtolower($template[category]), 0, 5)=='admin') $admin = 1; else $admin = 0;
		if (substr(strtolower($template[category]), 0, 3)=='mod') $mod = 1; else $mod = 0;
		$custom = 0;
		if ($url!="../data/template.dpt.php" && md5(addslashes($defaulttemplates[$name][body]))!=md5($template[body]))
			$custom = 1;
		if (isset($templatestore[$name]))
		{
			$name = addslashes($name);
			db_query("update template set category='$template[category]',body='$template[body]',custom=$custom where name='$name' and templatesetid='$templatesetid'");
			db_query("update parsedtemplate set admincp='$admin', modcp='$mod', body='$parsed_template' where name='$name' and templatesetid='$templatesetid'");
		}
		else
		{
			$name = addslashes($name);
			db_query("insert into template (name, category, body, templatesetid, custom) values ('$name', '$template[category]', '$template[body]', '$templatesetid', $custom)");
			$id = db_fetch_array(db_query("select templateid from template where name='$name' and templatesetid='$templatesetid';"));
			$id = $id[templateid];
			db_query("insert into parsedtemplate (templateid, name, body, admincp, modcp, templatesetid) values ($id, '$name', '$parsed_template', '$admin', '$mod', '$templatesetid');");
		}
	}
	return $templatesetid;
}

function old_import_style($url, $styleid, $name)
{
	if (!$lines = file($url))
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

	echo 'Upgrading from 2.0.0 Beta 1 to 2.0.0 Beta 2<br />';
	echo '<br />';
	db_query("alter table config add stop_redirect tinyint unsigned not null");
	db_query("update config set stop_redirect=0");
	db_query("alter table config add show_querycounter tinyint unsigned not null");
	db_query("update config set show_querycounter=0");
	db_query("alter table config add show_cptemplates tinyint unsigned not null");
	db_query("update config set show_cptemplates=0");
	db_query("alter table config add numlinks_articlenav int unsigned not null");
	db_query("update config set numlinks_articlenav=0");
	db_query("alter table config add listqueries tinyint unsigned not null");
	db_query("update config set listqueries=0");
	db_query("alter table config add allowphp_templates tinyint unsigned not null");
	db_query("update config set allowphp_templates=1");
	db_query("alter table config add cookie_domain char(255) not null");
	db_query("update config set cookie_domain=''");
	db_query("alter table config add cookie_path char(255) not null");
	db_query("update config set cookie_path='/'");
	db_query("alter table config add censor char(255) not null");
	db_query("update config set censor='*'");
	db_query("alter table template add custom tinyint unsigned not null");
	db_query("update template set custom=0");
	db_query("alter table styleset add separator char(255) not null");
	db_query("update styleset set separator=','");
	db_query("alter table user add notify_pm tinyint unsigned not null");
	db_query("update user set notify_pm=0 where subscribe_email=0");
	db_query("update user set notify_pm=1 where subscribe_email=1");
	db_query("alter table user add lastvisit int unsigned not null");
	db_query("update user set lastvisit=0");
	db_query("alter table emailverify modify activationkey char(32) not null");
	db_query("drop table addon");
	db_query("alter table session drop extra");
	db_query("alter table templateset drop preprocessed");
	db_query("alter table groups drop addons");
	db_query("update customfield set description='Tell us about yourself' where name='Biography'");
	db_query("update customfield set description='Things you enjoy' where name='Interests'");
	db_query("update customfield set description='How you make a living' where name='Occupation'");
	db_query("CREATE TABLE parsedtemplate (
  templateid int(10) unsigned NOT NULL default '0',
  name varchar(255) NOT NULL default '',
  body mediumtext NOT NULL,
  admincp tinyint(3) unsigned NOT NULL default '0',
  modcp tinyint(3) unsigned NOT NULL default '0',
  templatesetid int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (templateid),
  KEY templatesetid (templatesetid)
)");
	db_query("INSERT INTO `dpcode` (`tag`, `description`, `replacement`, `example`, `useoption`) VALUES ('ol', 'This produces a numbered list.', '<ol>{param}</ol>', '[ol][item]Item 1[/item][item]Item 2[/item][/ol]', 0),
('align', 'This allows you to left, center, or right align text.', '<div style=\"text-align: {option}\">{param}</div>', '[align=center]This text is centered[/align]', 1),
('hr', 'This inserts a horizontal line in your post.', '<hr />{param}', '[hr][/hr]', 0)");
	db_query("delete from template");
	if ($revert_styles)
	{
		$mac = db_fetch_array(db_query("select * from style where name='Mac'"));
		$mac = old_import_style('../data/style.dps.php', $mac[styleid], '');
		$dark = db_fetch_array(db_query("select * from style where name='Dark'"));
		$dark = old_import_style('dark.dps.php', $dark[styleid], '');
		$light = db_fetch_array(db_query("select * from style where name='Light'"));
		$light = old_import_style('light.dps.php', $light[styleid], '');
	}
	$query = db_query("select * from templateset");
	while ($tset = db_fetch_array($query))
		old_import_templateset("../data/template.dpt.php", $tset[templatesetid], '');
	
	db_query("update config set version='2.0.0 Beta 2'");
	
	redirect('upgrade.php');

print_footer();
?>