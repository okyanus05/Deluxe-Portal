<?php
error_reporting(7);

require('../config.php');
if (!ini_get('register_globals'))
	import_request_variables('gpc');

function print_header($title)
{
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1" />
	<style type="text/css" media="all">
	body {
	 color:white;
	 font-size:10px;
	 margin:0;
	 padding:0;
	 background-color:#355F89;
	 font-family:Verdana,Tahoma,Arial,Helvetica,sans-serif;
	}
	.foreground {
	 text-align:left;
	 color:black;
	 font-size:12px;
	 margin:25px auto;
	 background-color:white;
	}
	img {
	 border:0;
	 vertical-align:middle;
	}
	.tableline, .cellmain .tableline, .cellalt .tableline {
	 color:black;
	 background-color:#a0a0a0;
	}
	.tableheader, .cellmain .tableheader, .cellalt .tableheader {
	 font-weight:bold;
	 text-align:center;
	 color:white;
	 font-size:12px;
	 background-color:#67819D;
	 background-image:url(tableheader.gif);
	}
	.heading, .cellmain .heading, .cellalt .heading {
	 font-weight:bold;
	 text-align:center;
	 color:white;
	 padding:4px;
	 background-color:#94A6B8;
	 background-image:url(heading.gif);
	}
	.cellmain, .cellmain td, .cellmain th, .cellalt .cellmain {
	 color:black;
	 font-size:12px;
	 background-color:#dbe1e4;
	}
	.cellalt, .cellalt td, .cellalt th, .cellmain .cellalt {
	 color:black;
	 font-size:12px;
	 background-color:#f2f4f2;
	}
	select, optgroup {
	 font-size:11px;
	 font-family:tahoma,verdana,arial,helvetica,sans-serif;
	 vertical-align:middle;
	}
	textarea {
	 font-size:12px;
	 padding:1px;
	 font-family:verdana,tahoma,arial,helvetica,sans-serif;
	}
	input {
	 font-size:11px;
	 padding:2px;
	 font-family:tahoma,verdana,arial,helvetica,sans-serif;
	 vertical-align:middle;
	}
	.small, .cellmain .small, .cellalt .small {
	 font-size:10px;
	 font-family:Verdana,Tahoma,Arial,Helvetica,sans-serif;
	}
	#logodiv {
	 width:100%;
	 background-image:url(logo_bg.gif);
	 background-repeat:repeat-x;
	}
	#logodiv img {
	 display:block;
	}
	#footerdiv {
	 padding:28px 0 24px;
	 background-color:#2a4a6b;
	 background-image:url(footer_bg.gif);
	 background-repeat:repeat-x;
	}
	#navbartable {
	 color:white;
	 width:100%;
	 height:22px;
	 margin:0 auto;
	 background-color:transparent;
	 background-image:url(navbar_bg.gif);
	 background-repeat:repeat-x;
	 border:0;
	}
	#navbartable td {
	 font-size:10px;
	 white-space:nowrap;
	 padding:0;
	 vertical-align:top;
	}
	#navbartable a {
	 color:white;
	 background-color:transparent;
	}
	#navbartable img {
	 margin:0 8px 0 0;
	}
	#loggedindiv {
	 padding:3px 0 0 6px;
	}
	a:link {
	 text-decoration:none;
	 color:#08396b;
	 background-color:transparent;
	}
	a:visited {
	 text-decoration:none;
	 color:#08396b;
	 background-color:transparent;
	}
	a:hover,a:focus,a:active {
	 text-decoration:underline ;
	 color:#dc8303;
	 background-color:transparent;
	}
	.backgroundlink:link {
	 text-decoration:none;
	 color:#e4edfb;
	 background-color:transparent;
	}
	.backgroundlink:visited {
	 text-decoration:none;
	 color:#e4edfb;
	 background-color:transparent;
	}
	.backgroundlink:hover,.backgroundlink:focus,.backgroundlink:active {
	 text-decoration:underline ;
	 color:white;
	 background-color:transparent;
	}
	.linkheader:link {
	 text-decoration:none;
	 color:#e4edfb;
	 background-color:transparent;
	}
	.linkheader:visited {
	 text-decoration:none;
	 color:#e4edfb;
	 background-color:transparent;
	}
	.linkheader:hover,.linkheader:focus,.linkheader:active {
	 text-decoration:underline ;
	 color:white;
	 background-color:transparent;
	}
	.linksmall:link {
	 text-decoration:none;
	 font-size:10px;
	}
	.linksmall:visited {
	 text-decoration:none;
	 font-size:10px;
	}
	.linksmall:hover,.linksmall:focus,.linksmall:active {
	 text-decoration:underline ;
	 font-size:10px;
	}
	.center {text-align: center}
	.center table {margin: 0 auto; text-align: left}
	.right {text-align: right}
	.hiderow {vertical-align: top; display: none}
	.floatright {float: right}
	.bottom {vertical-align: bottom}
	.clearboth {clear: both}
	.contenttable {border:1px solid black;}
	.contentcell {padding-left:18px; padding-right:18px;}
	.monospaced {font-size:12px; font-family:"courier new",courier,serif}
	fieldset td {white-space:nowrap; vertical-align:middle;}
	fieldset td.small {width:80px;}
	.displayNone {display:none}
	</style>
	<title>
	<?php echo $title; ?>
	</title>
	</head>
	<body>
	<div id="logodiv"><a href="index.php"><img alt="Deluxe Portal" src="logo.gif" /></a>
	<table id="navbartable" cellspacing="0" cellpadding="3" class="foreground" width="100%">
	<tr>
	<td><div id="loggedindiv"></div></td>
	<td align="right"></td>
	</tr>
	</table>
	<div style="text-align:center;"><table cellspacing="1" cellpadding="4" id="contenttable" class="foreground contenttable" width="95%">
	<tr>
	<td id="contentcell" class="contentcell"><br />
	<?php
}

function print_footer()
{
	?>
	<br /></td>
	</tr>
	</table>
	</div>
	<div id="footerdiv" class="center">
	Powered by <a class="backgroundlink" href="http://www.deluxeportal.net" onclick="window.open(this.href,'_blank');return false;">Deluxe Portal</a><br />
	Copyright &copy;2002-2006 <a class="backgroundlink" href="http://www.nomative.com" onclick="window.open(this.href,'_blank');return false;">Nomative Systems</a><br />
	</div>
	</body>
	</html>
	<?php
}

function db_connect()
{
	global $dbconnection, $dbhost, $dbpass, $dbuser;
	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(db_error());
}

function db_select_db()
{
	global $dbconnection, $dbname;
	mysql_select_db($dbname, $dbconnection) or die(db_error());
}

function db_error()
{
	global $dbconnection, $lastquery;
	$lastquery = htmlspecialchars($lastquery);
	$error = mysql_error($dbconnection);
	$errno = mysql_errno($dbconnection);
	$errormessage = "Error number: $errno\n";
	$errormessage .= "Error description: $error\n";
	$errormessage .= "Last query: $lastquery\n";
	$errormessage .= "Page: $_SERVER[PHP_SELF]";
	?>
	<div class="center"><table class="tableline" width="75%" cellspacing="1" cellpadding="4">
	<tr>
	<td	class="tableheader">Database Error</td>
	</tr>
	<tr>
	<td class="cellmain">
	There has been a database error. Possible causes include server configuration problems or database corruption. If the problem continues, please contact the site's <a href="mailto:<?php echo $technical_email; ?>">technical support staff</a>.
	<?php
	echo "<br /><br /><form action=\"\"><div class=\"center\"><textarea class=\"small\" rows=\"10\" cols=\"80\">$errormessage</textarea></div></form>";
	?>
	</td>
	</tr>
	</table></div>
	<br /></td>
	</tr>
	</table>
	</div>
	<div id="footerdiv" class="center">
	Powered by <a class="backgroundlink" href="http://www.deluxeportal.net" onclick="window.open(this.href,'_blank');return false;">Deluxe Portal</a><br />
	Copyright &copy;2002-2006 <a class="backgroundlink" href="http://www.nomative.com" onclick="window.open(this.href,'_blank');return false;">Nomative Systems</a><br />
	</div>
	</body>
	</html>
	<?php
}

function db_fetch_array($query)
{
	return mysql_fetch_array($query);
}

function db_data_seek($query, $offset)
{
	mysql_data_seek($query, $offset);
}

function db_insert_id()
{
	global $dbconnection;
	return mysql_insert_id($dbconnection);
}

function db_num_rows($query)
{
	return mysql_num_rows($query);
}

function db_query($query)
{
	global $dbconnection, $lastquery;
	$lastquery = $query;
	$result = mysql_query($query, $dbconnection) or die(db_error());
	return $result;
}

function db_query_noerror($query)
{
	global $dbconnection;
	return mysql_query($query, $dbconnection);
}

function redirect($redirect_url)
{
	echo '<br />';
	echo '<br />';
	echo "<b>You are now being redirected to the next step. <a href=\"$redirect_url\">Please click here if you are not automatically redirected.</a></b>";
	echo '<script type="text/javascript">';
	echo 'function move() {';
	echo "window.location = '$redirect_url' }";
	echo "setTimeout('move()',0)";
	echo '</script>';
}

function array_walk_multi(&$array, $function, $type = 'string', $nocheck_input = false)
{
	$type_check_function = 'is_' . $type;
	if (!is_array($array) && $nocheck_input===false)
	{
		trigger_error('Argument passed to array_walk_multi() not an array.', E_USER_WARNING);
		return false;
	}
	if (!function_exists($type_check_function) && $type!='all' && $nocheck_input===false)
	{
		trigger_error('Type checking function for ' . $type . ' does not exist.', E_USER_WARNING);
		return false;
	}
	elseif (!function_exists($function) && $nocheck_input===false)
	{
		trigger_error('Function ' . $function . ' does not exist for use in array_walk_multi().', E_USER_WARNING);
		return false;
	}
	else
	{
		reset($array);
		while (list($var) = each($array))
		{
			if (($type=='all' || $type_check_function($array[$var])) && !is_array($array[$var]))
				$array[$var] = $function($array[$var]);
			elseif (is_array($array[$var]))
				$array[$var] = array_walk_multi($array[$var], $function, $type, true);
		}
		reset($array);
	}
	return $array;
}

function selective_import($templatesetid, $new, $change, $delete)
{
	$importpath = ($templatesetid==1 ? '../data/admin_template.dpt.php' : '../data/template.dpt.php');
	if (!$fp = fopen($importpath, 'r'))
		return false;
	$contents = trim(substr(fread($fp, filesize($importpath)), 8, -5));
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
			$template['lastedit_username'] = addslashes($template['lastedit_username']);
			$custom = 0;
			$name = addslashes($name);
			db_query("insert into template (name, category, body, templatesetid, custom, lastedit_username, lastedit_date) values ('$name', '$template[category]', '$template[body]', '$templatesetid', $custom, '$template[lastedit_username]', '$template[lastedit_date]')");
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
			$template['lastedit_username'] = addslashes($template['lastedit_username']);
			$custom = 0;
			$name = addslashes($name);
			db_query("update template set lastedit_username='$template[lastedit_username]',lastedit_date='$template[lastedit_date]',category='$template[category]',body='$template[body]',custom=$custom where name='$name' and templatesetid='$templatesetid'");
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

$current_time = mktime();

require ('../include/images.php');
require ('../include/import_export.php');
require ('../include/string.php');
require ('../include/tasks.php');
require ('../include/templates.php');
?>