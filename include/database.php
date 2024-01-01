<?php
/**************************************************
* Database API
* ------------
* db_connect()
* db_data_seek($query)
* db_error()
* db_fetch_resultset($query)
* db_fetch_array($query)
* db_fetch_assoc($query)
* db_insert_id()
* db_num_rows($query)
* db_query($query)
* 
* Deluxe Portal Version 2.0
**************************************************/

/**************************************************
* Global variable resetting                      */
unset($config);
unset($group);
unset($lastquery);
unset($sql_time);
unset($query_counter);
unset($querylog);
unset($style);
/*************************************************/

function db_connect()
{
	global $dbconnection, $dbhost, $dbname, $dbpass, $dbuser, $query_counter;
	$query_counter = 0;
	$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(db_error());
	mysql_select_db($dbname, $dbconnection) or die(db_error());
}

function db_data_seek($query, $offset)
{
	if (!db_num_rows($query))
		return;
	mysql_data_seek($query, $offset);
}

function db_error()
{
	global $dbconnection, $config, $style, $technical_email, $lastquery, $group, $_SERVER;
	$error = mysql_error($dbconnection);
	$errno = mysql_errno($dbconnection);
	$errormessage = "Error number: $errno\n";
	$errormessage .= "Error description: $error\n";
	$errormessage .= "Last query: $lastquery\n";
	$errormessage .= "Page: $_SERVER[PHP_SELF]";
	dp_mail($technical_email, "Database error - $config[name]", $errormessage, "From: \"Portal mailer\" <$techemail>");
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
	 background-image:url(<?php echo $style['images'] ?>/tableheader.gif);
	}
	.heading, .cellmain .heading, .cellalt .heading {
	 font-weight:bold;
	 text-align:center;
	 color:white;
	 padding:4px;
	 background-color:#94A6B8;
	 background-image:url(<?php echo $style['images'] ?>/heading.gif);
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
	 background-image:url(<?php echo $style['images'] ?>/logo_bg.gif);
	 background-repeat:repeat-x;
	}
	#logodiv img {
	 display:block;
	}
	#footerdiv {
	 padding:28px 0 24px;
	 background-color:#2a4a6b;
	 background-image:url(<?php echo $style['images'] ?>/footer_bg.gif);
	 background-repeat:repeat-x;
	}
	#navbartable {
	 color:white;
	 width:100%;
	 height:22px;
	 margin:0 auto;
	 background-color:transparent;
	 background-image:url(<?php echo $style['images'] ?>/navbar_bg.gif);
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
	Database Error - Deluxe Portal <?php echo $config['version']; ?>
	</title>
	</head>
	<body>
	<div id="logodiv"><a href="<?php echo $relativeurl; ?>/index.php"><img alt="Deluxe Portal" src="<?php echo $style['logo']; ?>" /></a></div>
	<table id="navbartable" cellspacing="0" cellpadding="3" class="foreground" width="100%">
	<tr>
	<td><div id="loggedindiv"></div></td>
	<td align="right"></td>
	</tr>
	</table>
	<div style="text-align:center;"><table cellspacing="1" cellpadding="4" id="contenttable" class="foreground contenttable" width="95%">
	<tr>
	<td id="contentcell" class="contentcell"><br />
	<div class="center"><table class="tableline" width="75%" cellspacing="1" cellpadding="4">
	<tr>
	<td	class="tableheader">Database Error</td>
	</tr>
	<tr>
	<td class="cellmain">
	There has been a database error. Possible causes include server configuration problems or database corruption. If the problem continues, please contact the site's <a href="mailto:<?php echo $technical_email; ?>">technical support staff</a>.
	<?php
	if (!$group['configuration'])
		echo '<!--';
	echo "<br /><br /><form action=\"\"><div class=\"center\"><textarea class=\"small\" rows=\"10\" cols=\"80\">$errormessage</textarea></div></form>";
	if (!$group['configuration'])
		echo '-->';
	?>
	</td>
	</tr>
	</table></div>
	<br /></td>
	</tr>
	</table>
	</div>
	<div id="footerdiv" class="center">
	Powered by <a class="backgroundlink" href="http://www.deluxeportal.net" onclick="window.open(this.href,'_blank');return false;">Deluxe Portal</a><?php if (isset($config)) echo ", Version $config[version]" ?><br />
	Copyright &copy;2002-2006 <a class="backgroundlink" href="http://www.nomative.com" onclick="window.open(this.href,'_blank');return false;">Nomative Systems</a><br />
	</div>
	</body>
	</html>
	<?php
	if ($errno == 1114 && stristr($error, 'session'))
		db_query("truncate session");
}

function db_fetch_resultset($query)
{
	$resultset = array();
	while ($row = db_fetch_array($query))
		$resultset[] = $row;
	return $resultset;
}

function db_fetch_array($query)
{
	return mysql_fetch_array($query);
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
	global $group, $dbconnection, $config, $lastquery, $sql_time, $query_counter, $querylog, $_REQUEST;
	$lastquery = htmlspecialchars($query);
	$query_counter++;
	$time = microtime();
	$time = explode(' ', $time);
	$start_time = $time[1] + $time[0];
	$result = mysql_query($query, $dbconnection) or die(db_error());
	$time = microtime();
	$time = explode(' ', $time);
	$end_time = $time[1] + $time[0];
	$sql_time += ($end_time - $start_time);
	if ($config['show_querycounter'] && isset($_REQUEST['explain']) && $_REQUEST['explain']==1 && (!$config['listqueries'] || $group['configuration']))
	{
		if (substr($query, 0, 6)=='select' || substr($query, 0, 6) =='SELECT')
		{
			echo '<b>'.htmlspecialchars($query).'</b> ('.round($end_time - $start_time, 5).' seconds)<br /><br />';
			echo '
			<table border="1" cellpadding="2" cellspacing="1">
			<tr>
			<td><b>table</b></td>
			<td><b>type</b></td>
			<td><b>possible_keys</b></td>
			<td><b>key</b></td>
			<td><b>key_len</b></td>
			<td><b>ref</b></td>
			<td><b>rows</b></td>
			<td><b>Extra</b></td>
			</tr>
			';
			$query = db_query("explain $query");
			while($array = db_fetch_array($query))
			{
				echo "
				<tr>
				<td>$array[table]&nbsp;</td>
				<td>$array[type]&nbsp;</td>
				<td>$array[possible_keys]&nbsp;</td>
				<td>$array[key]&nbsp;</td>
				<td>$array[key_len]&nbsp;</td>
				<td>$array[ref]&nbsp;</td>
				<td>$array[rows]&nbsp;</td>
				<td>$array[Extra]&nbsp;</td>
				</tr>
				";
			}
			echo "</table><br /><hr /><br />";
		}
		elseif (substr($query, 0, 7)!='explain')
			echo '<b>'.htmlspecialchars($query).'</b> ('.round($end_time - $start_time, 5).' seconds)<br /><br /><hr /><br />';
	}
	return $result;
}
?>