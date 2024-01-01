<?php
/**************************************************
* Moderator Control Panel
* -----------------------
* Contains links to the various panels of the
* Moderator Control Panel.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'mod_index';
/**************************************************
* Global variable resetting                      */
unset($uptime);
/*************************************************/
require('../function.php');

$pagetitle = 'Moderator Control Panel';

if ($group['supermod_massdelete'] || $group['supermod_massmove'] || $group['supermod_banusers'] || $group['supermod_log'] || $group['supermod_announcements'] || $group['supermod_viewfullprofiles'] || $modperm['announcements'] || $modperm['massdelete'] || $modperm['massmove'])
{
	if (!$avg)
	{
		if ($average = @exec('uptime'))
			preg_match('/([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/', $average, $avg);
	}
	if ($avg[1])
		$uptime = "<b>$avg[1]</b>, <b>$avg[2]</b>, <b>$avg[3]</b>";
	moderatorlog('Viewed moderator control panel', 0, '');
	eval(get_template('mod_index'));
}
else
	eval(get_template('permission_error'));
?>