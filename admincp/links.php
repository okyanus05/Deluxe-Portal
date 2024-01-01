<?php
/**************************************************
* Links
* -----
* Manages links and link categories.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_link,add_link_category,delete_link,delete_link_category,delete_link_category_denied,edit_link,edit_link_category,invalid_link,invalid_link_category,linkcategory_choice,links_category,links_category_missing,links_duplicate_category,links_index,links_link,links_missing,usergroup_choice';
/**************************************************
* Global variable resetting                      */
unset($category_choices);
unset($groups);
unset($groups_col1);
unset($groups_col2);
unset($groups_col3);
unset($link_categories);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$link = $_POST['link'];
$linkcategoryid = $_POST['linkcategoryid'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
/*************************************************/

$pagetitle = 'Links';

if ($group['links'])
{
	if ($_REQUEST['op']=='addcategory')
	{
		$query = db_query('select * from groups order by name asc');
		$num_col1 = ceil(db_num_rows($query)/3);
		$remaining = db_num_rows($query) - $num_col1;
		$num_col2 = $num_col1 + ceil($remaining/2);
		$i = 0;
		$checked = true;
		while ($group_result = db_fetch_array($query))
		{
			eval(store_template('usergroup_choice'));
			if (++$i<=$num_col1)
				$groups_col1 .= $usergroup_choice;
			elseif ($i<=$num_col2)
				$groups_col2 .= $usergroup_choice;
			else
				$groups_col3 .= $usergroup_choice;
		}
		eval(get_template('add_link_category'));
	}
	elseif ($_POST['op']=='doaddcategory')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if ($duplicate = db_fetch_array(db_query("select * from linkcategory where name='$name'")))
				die(eval(get_template('links_duplicate_category')));
			adminlog("Added link category - <b>$name</b>");
			if ($_POST['transfer']=='upload')
				$image = upload_image('link', 1);
			else
				$image = $_POST['image_location'];
			db_query("insert into linkcategory (name, image) values ('$name', '$image')");
			$category = db_fetch_array(db_query('select linkcategoryid from linkcategory order by linkcategoryid desc limit 1'));
			$query = db_query('select groupid from groups');
			while ($group_result = db_fetch_array($query))
			{
				if ($_POST["group_$group_result[groupid]"])
					db_query("insert into linkpermissions (linkcategoryid, groupid) values ($category[linkcategoryid], $group_result[groupid])");
			}
			header('Location: links.php');
		}
		else
			eval(get_template('links_category_missing'));
	}
	elseif ($op=='editcategory')
	{
		if ($category = db_fetch_array(db_query("select * from linkcategory where linkcategoryid='$id'")))
		{
			adminlog("Edited link category - <b>$category[name] ($category[linkcategoryid])</b>");
			$query = db_query("select * from linkpermissions where linkcategoryid='$category[linkcategoryid]'");
			while ($perm = db_fetch_array($query))
				$groups .= "$perm[groupid],";
			$query = db_query('select * from groups order by name asc');
			$num_col1 = ceil(db_num_rows($query)/3);
			$remaining = db_num_rows($query) - $num_col1;
			$num_col2 = $num_col1 + ceil($remaining/2);
			$i = 0;
			while ($group_result = db_fetch_array($query))
			{
				if (++$i<=$num_col1)
				{
					if (strstr($groups, $group_result['groupid']))
						$checked = true;
					else
						$checked = false;
					eval(store_template('usergroup_choice'));
					$groups_col1 .= $usergroup_choice;
				}
				elseif ($i<=$num_col2)
				{
					if (strstr($groups, $group_result['groupid']))
						$checked = true;
					else
						$checked = false;
					eval(store_template('usergroup_choice'));
					$groups_col2 .= $usergroup_choice;
				}
				else
				{
					if (strstr($groups, $group_result['groupid']))
						$checked = true;
					else
						$checked = false;
					eval(store_template('usergroup_choice'));
					$groups_col3 .= $usergroup_choice;
				}
			}
			$query = db_query('select * from linkcategory order by name asc');
			$i=0;
			while ($cat = db_fetch_array($query))
				$categorystore[$i++] = $cat;
			$query = db_query('select * from link order by name asc');
			$i=0;
			while ($down = db_fetch_array($query))
				$linkstore[$i++] = $down;
			
			$i=0;
			while ($category_result = $categorystore[$i++])
			{
				eval(store_template('links_category'));
				$link_categories .= $links_category;
				$n=0;
				while ($link_result = $linkstore[$n++])
				{
					if ($category_result['linkcategoryid']==$link_result['linkcategoryid'])
					{
						eval(store_template('links_link'));
						$link_categories .= $links_link;
					}
				}
			}
			$category['description'] = htmlspecialchars($category['description']);
			eval(get_template('edit_link_category'));
		}
		else
			eval(get_template('invalid_link_category'));
	}
	elseif ($_POST['op']=='doeditcategory')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if ($category = db_fetch_array(db_query("select * from linkcategory where linkcategoryid='$id'")))
			{
				if ($duplicate = db_fetch_array(db_query("select * from linkcategory where name='$name' and linkcategoryid!='$category[linkcategoryid]'")))
					die(eval(get_template('links_duplicate_category')));
				adminlog("Updated link category - <b>$category[name] ($category[linkcategoryid])</b>");
				if ($_POST['transfer']=='upload')
				{
					$image = ',image=\''.upload_image('link', 1).'\'';
					if (dp_substr($category['image'], 0, 1)==':')
						db_query('delete from imagestore where imageid=\''.dp_substr($category['image'], 1).'\'');
				}
				elseif ($_POST['transfer']=='location')
				{
					$image = ",image='$_POST[image_location]'";
					if (dp_substr($category['image'], 0, 1)==':')
						db_query('delete from imagestore where imageid=\''.dp_substr($category['image'], 1).'\'');
				}
				else
					$image = '';
				db_query("update linkcategory set name='$name'$image where linkcategoryid='$category[linkcategoryid]'");
				db_query("delete from linkpermissions where linkcategoryid='$category[linkcategoryid]'");
				$query = db_query('select groupid from groups');
				while ($group_result = db_fetch_array($query))
				{
					if ($_POST["group_$group_result[groupid]"])
						db_query("insert into linkpermissions (groupid, linkcategoryid) values ($group_result[groupid], '$category[linkcategoryid]')");
				}
				header('Location: links.php');
			}
			else
				eval(get_template('invalid_link_category'));
		}
		else
			eval(get_template('links_category_missing'));
	}
	elseif ($op=='deletecategory')
	{
		if ($category = db_fetch_array(db_query("select * from linkcategory where linkcategoryid='$id'")))
		{
			if (db_num_rows(db_query("select linkid from link where linkcategoryid='$category[linkcategoryid]'")))
				die(eval(get_template('delete_link_category_denied')));
			$category['parsed_image'] = parse_image($category['image']);
			eval(get_template('delete_link_category'));
		}
		else
			eval(get_template('invalid_link_category'));
	}
	elseif ($_POST['op']=='dodeletecategory')
	{
		if ($category = db_fetch_array(db_query("select * from linkcategory where linkcategoryid='$id'")))
		{
			if (db_num_rows(db_query("select linkid from link where linkcategoryid='$category[linkcategoryid]'")))
				die(eval(get_template('delete_link_category_denied')));
			adminlog("Deleted link category - <b>$category[name] ($category[linkcategoryid])</b>");
			db_query("delete from linkcategory where linkcategoryid='$category[linkcategoryid]'");
			db_query("delete from linkpermissions where linkcategoryid='$category[linkcategoryid]'");
			if (dp_substr($category['image'], 0, 1)==':')
				db_query('delete from imagestore where imageid=\''.dp_substr($category['image'], 1).'\'');
			header('Location: links.php');
		}
		else
			eval(get_template('invalid_link_category'));
	}
	elseif ($op=='add')
	{
		$query = db_query('select * from linkcategory order by name asc');
		$i=0;
		while ($cat = db_fetch_array($query))
			$categorystore[$i++] = $cat;
		$query = db_query('select * from link order by name asc');
		$i=0;
		while ($down = db_fetch_array($query))
			$linkstore[$i++] = $down;
		
		$i=0;
		while ($category_result = $categorystore[$i++])
		{
			eval(store_template('links_category'));
			if ($category_result['linkcategoryid']==$id)
				$selected = true;
			else
				$selected = false;
			eval(store_template('linkcategory_choice', '$category_choice'));
			$category_choices .= $category_choice;
			$link_categories .= $links_category;
			$n=0;
			while ($link_result = $linkstore[$n++])
			{
				if ($category_result['linkcategoryid']==$link_result['linkcategoryid'])
				{
					eval(store_template('links_link'));
					$link_categories .= $links_link;
				}
			}
		}
		eval(get_template('add_link'));
	}
	elseif ($_POST['op']=='doadd')
	{
		if (($name = trim(htmlspecialchars($name))) && ($link = trim(htmlspecialchars($link))) && $link!='http://' && ($category = db_fetch_array(db_query("select linkcategoryid from linkcategory where linkcategoryid='$linkcategoryid'"))))
		{
			adminlog("Added link - <b>$name</b>");
			db_query("insert into link (name, linkcategoryid, description, link) values ('$name', $category[linkcategoryid], '$_POST[description]', '$link')");
			header('Location: links.php');
		}
		else
			eval(get_template('links_missing'));
	}
	elseif ($op=='edit')
	{
		if ($link = db_fetch_array(db_query("select * from link where linkid='$id'")))
		{
			adminlog("Edited link - <b>$link[name] ($link[linkid])</b>");
			$query = db_query('select * from linkcategory order by name asc');
			$i=0;
			while ($cat = db_fetch_array($query))
				$categorystore[$i++] = $cat;
			$query = db_query('select * from link order by name asc');
			$i=0;
			while ($down = db_fetch_array($query))
				$linkstore[$i++] = $down;
			
			$i=0;
			while ($category_result = $categorystore[$i++])
			{
				eval(store_template('links_category'));
				if ($category_result['linkcategoryid']==$link['linkcategoryid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('linkcategory_choice', '$category_choice'));
				$category_choices .= $category_choice;
				$link_categories .= $links_category;
				$n=0;
				while ($link_result = $linkstore[$n++])
				{
					if ($category_result['linkcategoryid']==$link_result['linkcategoryid'])
					{
						eval(store_template('links_link'));
						$link_categories .= $links_link;
					}
				}
			}
			eval(get_template('edit_link'));
		}
		else
			eval(get_template('invalid_link'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if (($name = trim(htmlspecialchars($name))) && ($link = trim(htmlspecialchars($link))) && $link!='http://' && ($link_result = db_fetch_array(db_query("select linkid from link where linkid='$id'"))) && ($category = db_fetch_array(db_query("select linkcategoryid from linkcategory where linkcategoryid='$linkcategoryid'"))))
		{
			adminlog("Updated link - <b>$link_result[name] ($link_result[linkid])</b>");
			db_query("update link set name='$name',linkcategoryid='$category[linkcategoryid]',description='$_POST[description]',link='$link' where linkid='$link_result[linkid]'");
			header('Location: links.php');
		}
		else
			eval(get_template('links_missing'));
	}
	elseif ($op=='delete')
	{
		if ($link = db_fetch_array(db_query("select * from link where linkid='$id'")))
			eval(get_template('delete_link'));
		else
			eval(get_template('invalid_link'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($link = db_fetch_array(db_query("select * from link where linkid='$id'")))
		{
			adminlog("Deleted link - <b>$link[name] ($link[linkid])</b>");
			db_query("delete from link where linkid='$link[linkid]'");
			header('Location: links.php');
		}
		else
			eval(get_template('invalid_link'));
	}
	else
	{
		adminlog('Viewed links panel');
		$query = db_query('select * from linkcategory order by name asc');
		$i=0;
		while ($cat = db_fetch_array($query))
			$categorystore[$i++] = $cat;
		$query = db_query('select * from link order by name asc');
		$i=0;
		while ($down = db_fetch_array($query))
			$linkstore[$i++] = $down;
		
		$i=0;
		while ($category_result = $categorystore[$i++])
		{
			eval(store_template('links_category'));
			$link_categories .= $links_category;
			$n=0;
			while ($link_result = $linkstore[$n++])
			{
				if ($category_result['linkcategoryid']==$link_result['linkcategoryid'])
				{
					eval(store_template('links_link'));
					$link_categories .= $links_link;
				}
			}
		}
		eval(get_template('links_index'));
	}
}
else
	eval(get_template('permission_error'));
?>