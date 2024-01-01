<?php
/**************************************************
* Sidebar
* -------
* Sets up the download, link, section, private
* message, and Who's Online information for the
* sidebar.
* 
* Deluxe Portal Version 2.0
**************************************************/

/**************************************************
* Global variable resetting                      */
unset($nav_downloads);
unset($nav_links);
unset($nav_sections);
/*************************************************/

if ($config['whos_online'] && $config['sidebar_online'])
{
	$config['most_online_date'] = time_adjust($config['most_online_date'], $style['most_online_date_format']);
	$timeout = $current_time-($config['online_timeout']*60);
	$num_guests_online_result = db_fetch_array(db_query("select COUNT(DISTINCT ip) from session where userid=0 and lastactivity>=$timeout"));
	$num_guests_online = $num_guests_online_result[0];
	$num_users_online_result = db_fetch_array(db_query("select COUNT(DISTINCT userid) from session where session.userid>0 and session.lastactivity>=$timeout"));
	$num_users_online = $num_users_online_result[0];
	$total_online = $num_guests_online + $num_users_online;
	if ($config['most_online']<$total_online)
		db_query("update config set most_online=$total_online,most_online_date=$current_time");
}

if ($config['sidebar_sections'])
{
	$query = db_query("select DISTINCT section.* from section,sectionpermissions where section.sectionid=sectionpermissions.sectionid and ($groupquery) and view=1 order by name asc");
	while ($section = db_fetch_array($query))
	{
		if ($section['sidebar'])
		{
			eval(store_template('sidebar_section'));
			$nav_sections .= $sidebar_section;
		}
	}
}

if ($config['sidebar_downloads'])
{
	$query = db_query("select DISTINCT downloadcategory.* from downloadcategory,downloadpermissions where downloadcategory.downloadcategoryid=downloadpermissions.downloadcategoryid and ($groupquery) order by name asc");
	while ($category = db_fetch_array($query))
	{
		eval(store_template('sidebar_download'));
		$nav_downloads .= $sidebar_download;
	}
}

if ($config['sidebar_links'])
{
	$query = db_query("select DISTINCT linkcategory.* from linkcategory,linkpermissions where linkcategory.linkcategoryid=linkpermissions.linkcategoryid and ($groupquery) order by name asc");
	while ($category = db_fetch_array($query))
	{
		eval(store_template('sidebar_link'));
		$nav_links .= $sidebar_link;
	}
}

if ($group['privatemessaging'] && $user['pm'] && $config['sidebar_pm'])
{
	$pmenabled = true;
	$pmquery = db_query("select * from privatemessage where userid=$user[userid] and folder='inbox' and isread=0");
	$num_pm = db_num_rows($pmquery);
}
?>