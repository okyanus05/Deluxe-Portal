<?php
/**************************************************
* DP Info
* -------
* Show PHP info, as well as permission information
* for the server.
* 
* Deluxe Portal Version 2.0
**************************************************/
header('Content-Type: text/html; charset=iso-8859-1');
require('../function.php');
if (!$config['dp_info'] && !$group['configuration'])
	die('You are not permitted to access DP Info on this site.');
$infotype = $_REQUEST['infotype'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/dtd/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Deluxe Portal 2.0 Information Page</title>
<style type="text/css" media="screen">
.c1 {
 font-size:10px;
 font-family:verdana,arial,helvetica,sans-serif;
}
.center {
 text-align:center;
}
.content {
 margin:15px;
 border:1px solid #000000;
 padding:6px;
}
.center h1, .content h1 {
 font-size:24px;
 font-family:tahoma,verdana,arial,helvetica,sans-serif;
 font-weight:normal;
}
</style>
<?php
function get_perms($name)
{
	$decperms = fileperms($name);
	$octalperms = sprintf("%o", $decperms);
	$perms = dp_substr($octalperms, -3);
	return $perms;
}
?>
</head>
<body>
<div class="center"><h1>Deluxe Portal 2.0 Information</h1></div>
<div class="content"><div class="c1">
You are currently running Deluxe Portal Version <b><?php echo $config[version]; ?></b>.<br />
You are currently running PHP Version <b><?php echo phpversion(); ?></b>.<?php if (phpversion() < 4.1) { echo " It is recommended you upgrade your Server to PHP version 4.1.0 or higher."; } ?><br />
You are currently running the following webserver: <b><?php echo $_SERVER['SERVER_SOFTWARE']; ?></b>.<br />
You are currently running Deluxe Portal on <b><?php echo $_SERVER['SERVER_NAME']; ?></b> on port <b><?php echo $_SERVER['SERVER_PORT']; ?></b>.<br />
<?php if ($_SERVER['SERVER_ADDR']) { ?>The server's IP address is: <b><?php echo $_SERVER['SERVER_ADDR']; ?></b>.<br /><?php } ?>
Your IP address is: <b><?php if ($_SERVER['HTTP_X_FORWARDED_FOR']) { echo $_SERVER['HTTP_X_FORWARDED_FOR']; } else { echo $_SERVER['REMOTE_ADDR']; } ?></b>.<br />
PHP is currently <?php if (!ini_get('safe_mode')) { echo "<b>not</b> "; } ?>running in safe mode.<br />
PHP <b>register_globals</b> is currently <b><?php if (ini_get('register_globals')) { echo "on"; } else { echo "off"; } ?></b>.<br />
PHP <b>magic_quotes_gpc</b> is currently <b><?php if (ini_get('magic_quotes_gpc')) { echo "on"; } else { echo "off"; } ?></b>.<br />
<br />
<b>Permissions:</b><br />
<?php
if ($config['avatar_location']=='file')     echo "Avatars Upload Directory Permissions:     <b>chmod " . get_perms($requireurl . '/' . $config['avatar_directory']) .     "</b>.<br />";
if ($config['smilie_location']=='file')     echo "Smilies Upload Directory Permissions:     <b>chmod " . get_perms($requireurl . '/' . $config['smilie_directory']) .     "</b>.<br />";
if ($config['icon_location']=='file')       echo "Icons Upload Directory Permissions:       <b>chmod " . get_perms($requireurl . '/' . $config['icon_directory']) .       "</b>.<br />";
if ($config['section_location']=='file')    echo "Sections Upload Directory Permissions:    <b>chmod " . get_perms($requireurl . '/' . $config['section_directory']) .    "</b>.<br />";
if ($config['topic_location']=='file')      echo "Topics Upload Directory Permissions:      <b>chmod " . get_perms($requireurl . '/' . $config['topic_directory']) .      "</b>.<br />";
if ($config['download_location']=='file')   echo "Downloads Upload Directory Permissions:   <b>chmod " . get_perms($requireurl . '/' . $config['download_directory']) .   "</b>.<br />";
if ($config['link_location']=='file')       echo "Links Upload Directory Permissions:       <b>chmod " . get_perms($requireurl . '/' . $config['link_directory']) .       "</b>.<br />";
if ($config['attachment_location']=='file') echo "Attachments Upload Directory Permissions: <b>chmod " . get_perms($requireurl . '/' . $config['attachment_directory']) . "</b>.<br />";
?>
Admin Directory (<?php echo $admincp_dir; ?>) Permissions: <b>chmod <?php echo get_perms($requireurl . '/' . $admincp_dir); ?></b>.<br />
Mod Directory (<?php echo $modcp_dir; ?>) Permissions: <b>chmod <?php echo get_perms($requireurl . '/' . $modcp_dir); ?></b>.<br />
Main Directory Permissions: <b>chmod <?php echo get_perms($requireurl . '/'); ?></b>.<br />
Current Directory (<?php echo basename(dirname(__FILE__)); ?>) Permissions: <b>chmod <?php echo get_perms(dirname($_SERVER['SCRIPT_FILENAME'])); ?></b>.<br />

</div><br /><br /><div><div class="c1 center">The following is some information about PHP running on your server:</div><br /><?php

ob_start();
if (!$infotype) $infotype=1;
phpinfo($infotype);
$php_info = ob_get_contents();
ob_end_clean();
preg_match('/<body([^>]*)>(.*?)<\/body>/si', $php_info, $body);
preg_match('/<style([^>]*)>(.*?)<\/style>/si', $php_info, $styles);
echo ($styles[0]);
echo ($body[2]);

echo '<div class="center c1">';
if ($_GET['infotype']!=-1)
	echo '<a href="dp_info.php?infotype=-1">Show all PHP Information</a>';
else
	echo '<a href="dp_info.php">Show partial PHP Information</a>';
?>	
</div></div><br />
</div>
<div class="center c1">Deluxe Portal, &copy; 2002-2006 Nomative Systems, All rights reserved.</div>
</body>
</html>