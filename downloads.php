<?php
/**************************************************
* Downloads
* ---------
* Displays download categories, or a download
* category list.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'download_category,download_download,download_index,download_row,download_showcategory,invalid_download_category';
/**************************************************
* Global variable resetting                      */
unset($downloads);
/*************************************************/
require('function.php');
require('sidebar.php');
/**************************************************
* Variable initialization                        */
$sort = $_REQUEST['sort'];
$order = $_REQUEST['order'];
/*************************************************/

if ($_REQUEST['id'] && $category = db_fetch_array(db_query("select * from downloadcategory,downloadpermissions where ($groupquery) and downloadpermissions.downloadcategoryid=downloadcategory.downloadcategoryid and downloadcategory.downloadcategoryid='$_REQUEST[id]'")))
{
	if ($sort!='asc' && $sort!='desc')
		$sort = 'asc';
	if ($order!='name' && $order!='author' && $order!='version')
		$order = 'name';
	$pagetitle = $category['name'];
	$query = db_query("select * from download where downloadcategoryid=$category[downloadcategoryid] order by $order $sort");
	while ($download = db_fetch_array($query))
	{
		if ($download['author'] && $download['version'])
			$both = true;
		else
			$both = false;
		
		eval(store_template('download_download'));
		$downloads .= $download_download;
	}
	eval(get_template('download_showcategory'));
}
elseif ($_REQUEST['id'])
{
	$pagetitle = 'Invalid download category';
	eval(get_template('invalid_download_category'));
}
else
{
	$query = db_query("select * from downloadpermissions where ($groupquery)");
	while ($perm = db_fetch_array($query))
	{
		if ($downloadquery)
			$downloadquery .= " or downloadcategoryid=$perm[downloadcategoryid]";
		else
			$downloadquery = "downloadcategoryid=$perm[downloadcategoryid]";
	}
	
	if ($downloadquery)
	{
		$n=0;
		$query = db_query("select downloadcategory.* from downloadcategory,downloadpermissions where ($groupquery) and downloadcategory.downloadcategoryid=downloadpermissions.downloadcategoryid group by downloadcategoryid order by name asc");
		while ($n<db_num_rows($query))
		{
			$download_col = '';
			for ($i=0; $i<$config['downloads_per_row']; $i++)
			{
				$n++;
				$category = db_fetch_array($query);
				$category['parsed_image'] = parse_image($category['image']);
				eval(store_template('download_category'));
				$download_col .= $download_category;
			}
			eval(store_template('download_row'));
			$downloads .= $download_row;
		}
	}
	$pagetitle = 'Downloads';
	eval(get_template('download_index'));
}
?>