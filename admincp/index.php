<?php
/**************************************************
* Administrator Control Panel
* ---------------------------
* Contains links to the various panels of the
* Administrator Control Panel.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'admin_index';
/**************************************************
* Global variable resetting                      */
unset($new_announcement);
unset($new_version);
unset($uptime);
/*************************************************/
require('../function.php');

$pagetitle = 'Administrator Control Panel';

if ($group['adminlog'] || $group['articles'] || $group['configuration'] || $group['customfields'] || $group['downloads'] || $group['dpcode'] || $group['faq'] || $group['forumperm'] || $group['forums'] || $group['groupchanger'] || $group['groups'] || $group['icons'] || $group['links'] || $group['maintenance'] || $group['moderators'] || $group['sections'] || $group['smilies'] || $group['styles'] || $group['stylesets'] || $group['tasks'] || $group['templates'] || $group['titles'] || $group['topics'] || $group['users'])
{
	if(is_dir('../installation'))
		$installation_dir = true;
	else
		$installation_dir = false;
	if (!$avg)
	{
		if ($average = @exec('uptime'))
			preg_match('/([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/', $average, $avg);
	}
	if ($avg[1])
		$uptime = "<b>$avg[1]</b>, <b>$avg[2]</b>, <b>$avg[3]</b>";
	if ($fp = fopen('http://www.deluxeportal.net/version.php', 'r'))
	{
		$new_version = trim(fgets($fp, 255));
		$new_announcement = trim(fgets($fp, 255));
	}
	adminlog('Viewed administrator control panel');
	eval(get_template('admin_index'));
}
else
	eval(get_template('permission_error'));
?>