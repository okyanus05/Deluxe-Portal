<?php
/**************************************************
* Private Messages
* ----------------
* Shows a list of private messages, and allows you
* to archive or delete them.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'pm_delete,pm_disabled,pm_index,pm_message';
/**************************************************
* Global variable resetting                      */
unset($archivequery);
unset($deletequery);
unset($private_messages);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$folder = $_REQUEST['folder'];
$order = $_REQUEST['order'];
$sort = $_REQUEST['sort'];
/*************************************************/

if ($group['privatemessaging'])
{
	if (!$user['pm'])
	{
		$pagetitle = 'Private messaging is disabled';
		die(eval(get_template('pm_disabled')));
	}
	if ($folder!='archive' && $folder!='inbox' && $folder!='sent')
		$folder = 'inbox';
	if ($order!='fromusername' && $order!='tousername' && $order!='subject' && $order!='sentdate')
		$order = 'sentdate';
	if ($sort!='asc' && $sort!='desc')
		$sort = 'desc';
	if ($_REQUEST['archive'])
	{
		$query = db_query("select privatemessageid from privatemessage where userid=$user[userid] and folder='$folder'");
		while ($pm = db_fetch_array($query))
		{
			if ($_REQUEST["pm_$pm[privatemessageid]"])
			{
				if (!$archivequery)
					$archivequery = "privatemessageid=$pm[privatemessageid]";
				else
					$archivequery .= " or privatemessageid=$pm[privatemessageid]";
			}
		}
		if (!$archivequery)
			$archivequery = 'privatemessageid=0';
		db_query("update privatemessage set folder='archive' where ($archivequery)");
		header("Location: pm.php?folder=$folder");
	}
	elseif ($_REQUEST['delete'])
	{
		$query = db_query("select privatemessageid from privatemessage where userid=$user[userid] and folder='$folder'");
		$num_messages = 0;
		while ($pm = db_fetch_array($query))
		{
			if ($_REQUEST["pm_$pm[privatemessageid]"])
			{
				$num_messages++;
				if (!$deletequery)
					$deletequery = "pm_$pm[privatemessageid]=1";
				else
					$deletequery .= "&amp;pm_$pm[privatemessageid]=1";
			}
		}
		$pagetitle = "Delete Private Message" . ($num_messages!=1 ? "s" : "");
		eval(get_template('pm_delete'));
	}
	elseif ($_REQUEST['dodelete'])
	{
		$query = db_query("select privatemessageid from privatemessage where userid=$user[userid] and folder='$folder'");
		while ($pm = db_fetch_array($query))
		{
			if ($_REQUEST["pm_$pm[privatemessageid]"])
			{
				if (!$deletequery)
					$deletequery = "privatemessageid=$pm[privatemessageid]";
				else
					$deletequery .= " or privatemessageid=$pm[privatemessageid]";
			}
		}
		if (!$deletequery)
			$deletequery = 'privatemessageid=0';
		db_query("delete from privatemessage where ($deletequery)");
		header("Location: pm.php?folder=$folder");
	}
	else
	{
		$color = 'cellalt';
		$query = db_query("select privatemessage.*,icon.image,icon.name as icon_name from privatemessage left join icon on icon.iconid=privatemessage.iconid where userid=$user[userid] and folder='$folder' order by isread asc,$order $sort");
		while ($pm = db_fetch_array($query))
		{
			$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
			if ($pm['iconid'])
				$pm['image'] = parse_image($pm['image']);
			$pm['sentdate'] = time_adjust($pm['sentdate'], $style['lastpost_date_format']);
			$pm['subject'] = censor($pm['subject'], $config['censored_words']);
			eval(store_template('pm_message'));
			$private_messages .= $pm_message;
		}
		
		if ($group['maxpm'] && db_num_rows(db_query("select privatemessageid from privatemessage where userid=$user[userid]"))>=$group['maxpm'])
			$overlimit = true;
		else
			$overlimit = false;
		
		$pagetitle = 'Private messages';
		eval(get_template('pm_index'));
	}
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>