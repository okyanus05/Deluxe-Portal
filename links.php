<?php
/**************************************************
* Links
* -----
* Displays link categories, or a link category
* list.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_link_category,link_category,link_index,link_link,link_row,link_showcategory';
/**************************************************
* Global variable resetting                      */
unset($links);
/*************************************************/

require('function.php');
require('sidebar.php');

if ($_REQUEST['id'] && $category = db_fetch_array(db_query("select * from linkcategory,linkpermissions where ($groupquery) and linkpermissions.linkcategoryid=linkcategory.linkcategoryid and linkcategory.linkcategoryid='$_REQUEST[id]'")))
{
	$pagetitle = $category['name'];
	$query = db_query("select * from link where linkcategoryid=$category[linkcategoryid] order by name asc");
	while ($link = db_fetch_array($query))
	{
		eval(store_template('link_link'));
		$links .= $link_link;
	}
	eval(get_template('link_showcategory'));
}
elseif ($_REQUEST['id'])
	eval(get_template('invalid_link_category'));
else
{
	$query = db_query("select * from linkpermissions where ($groupquery)");
	while ($perm = db_fetch_array($query))
	{
		if ($linkquery)
			$linkquery .= " or linkcategoryid=$perm[linkcategoryid]";
		else
			$linkquery = "linkcategoryid=$perm[linkcategoryid]";
	}
	
	if ($linkquery)
	{
		$n=0;
		$query = db_query("select * from linkcategory where $linkquery order by name asc");
		while ($n<db_num_rows($query))
		{
			$link_col = '';
			for ($i=0; $i<$config['links_per_row']; $i++)
			{
				$n++;
				$category = db_fetch_array($query);
				$category['parsed_image'] = parse_image($category['image']);
				eval(store_template('link_category'));
				$link_col .= $link_category;
			}
			eval(store_template('link_row'));
			$links .= $link_row;
		}
	}
	$pagetitle = 'Links';
	eval(get_template('link_index'));
}
?>