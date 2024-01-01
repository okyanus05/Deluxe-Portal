<?php
/**************************************************
* Sections
* --------
* Shows a list of sections, or displays a section.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_section,section_article,section_index,section_row,section_section,section_showsection';
/**************************************************
* Global variable resetting                      */
unset($articles);
unset($sections);
unset($sectionquery);
/*************************************************/
require('function.php');
require('sidebar.php');
/**************************************************
* Variable initialization                        */
$order = $_REQUEST['order'];
$sort = $_POST['sort'];
/*************************************************/

if ($_REQUEST['id'] && $section = db_fetch_array(db_query("select * from section,sectionpermissions where ($groupquery) and sectionpermissions.sectionid=section.sectionid and section.sectionid='$_REQUEST[id]' and sectionpermissions.view=1")))
{
	if ($sort!='asc' && $sort!='desc')
		$sort = 'asc';
	if ($order!='title' && $order!='username' && $order!='posted')
		$order = 'title';
	$query = db_query("select * from article where sectionid=$section[sectionid] order by $order $sort");
	if (db_num_rows($query)==1)
	{
		$article = db_fetch_array($query);
		die(header("Location: article.php?id=$article[articleid]"));
	}
	while ($article = db_fetch_array($query))
	{
		$article['posted'] = time_adjust($article['posted'], $style['frontpage_date_format']);
		eval(store_template('section_article'));
		$articles .= $section_article;
	}
	$pagetitle = $section['name'];
	eval(get_template('section_showsection'));
}
elseif ($_REQUEST['id'])
{
	$pagetitle = 'Invalid section';
	eval(get_template('invalid_section'));
}
else
{
	$query = db_query("select * from sectionpermissions where ($groupquery) and view=1");
	while ($perm = db_fetch_array($query))
	{
		if ($sectionquery)
			$sectionquery .= " or sectionid=$perm[sectionid]";
		else
			$sectionquery = "sectionid=$perm[sectionid]";
	}
	
	if ($sectionquery)
	{
		$n=0;
		$query = db_query("select * from section where $sectionquery order by name asc");
		while ($n<db_num_rows($query))
		{
			$section_col = '';
			for ($i=0; $i<$config['sections_per_row']; $i++)
			{
				$n++;
				$section = db_fetch_array($query);
				$section['parsed_image'] = parse_image($section['image']);
				eval(store_template('section_section', '$section_result'));
				$section_col .= $section_result;
			}
			eval(store_template('section_row'));
			$sections .= $section_row;
		}
	}
	$pagetitle = 'Sections';
	eval(get_template('section_index'));
}
?>