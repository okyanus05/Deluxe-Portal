<?php
/**************************************************
* Downloads
* ---------
* Allows you to manage downloads.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_download,add_download_category,delete_download,delete_download_category,delete_download_category_denied,downloadcategory_choice,downloads_category,downloads_category_missing,downloads_download,downloads_duplicate_category,downloads_index,downloads_missing,edit_download,edit_download_category,invalid_download,invalid_download_category,usergroup_choice';
/**************************************************
* Global variable resetting                      */
unset($category_choices);
unset($download_categories);
unset($groups);
unset($groups_col1);
unset($groups_col2);
unset($groups_col3);
unset($image);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$downloadcategoryid = $_POST['downloadcategoryid'];
$id = $_REQUEST['id'];
$location = $_POST['location'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
/*************************************************/

$pagetitle = 'Downloads';

if ($group['downloads'])
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
		eval(get_template('add_download_category'));
	}
	elseif ($_POST['op']=='doaddcategory')
	{
		if ($name = htmlspecialchars(trim($name)))
		{
			if ($duplicate = db_fetch_array(db_query("select * from downloadcategory where name='$name'")))
				die(eval(get_template('downloads_duplicate_category')));
			adminlog("Added download category - <b>$name</b>");
			if ($_POST['transfer']=='upload')
				$image = upload_image('download', 1);
			else
				$image = $_POST['image_location'];
			db_query("insert into downloadcategory (name, image) values ('$name', '$image')");
			$category = db_fetch_array(db_query('select downloadcategoryid from downloadcategory order by downloadcategoryid desc limit 1'));
			$query = db_query('select groupid from groups');
			while ($group_result = db_fetch_array($query))
			{
				if ($_POST["group_$group_result[groupid]"])
					db_query("insert into downloadpermissions (downloadcategoryid, groupid) values ($category[downloadcategoryid], $group_result[groupid])");
			}
			header('Location: downloads.php');
		}
		else
			eval(get_template('downloads_category_missing'));
	}
	elseif ($op=='editcategory')
	{
		if ($category = db_fetch_array(db_query("select * from downloadcategory where downloadcategoryid='$id'")))
		{
			adminlog("Edited download category - <b>$category[name] ($category[downloadcategoryid])</b>");
			$query = db_query("select * from downloadpermissions where downloadcategoryid='$category[downloadcategoryid]'");
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
			$query = db_query('select * from downloadcategory order by name asc');
			while ($category_result = db_fetch_array($query))
			{
				eval(store_template('downloads_category'));
				$download_categories .= $downloads_category;
				$n=0;
				while ($download_result = $downloadstore[$n++])
				{
					if ($category_result['downloadcategoryid']==$download_result['downloadcategoryid'])
					{
						eval(store_template('downloads_download'));
						$download_categories .= $downloads_download;
					}
				}
			}
			eval(get_template('edit_download_category'));
		}
		else
			eval(get_template('invalid_download'));
	}
	elseif ($op=='doeditcategory')
	{
		if ($name = trim($name))
		{
			if ($category = db_fetch_array(db_query("select * from downloadcategory where downloadcategoryid='$id'")))
			{
				$name = htmlspecialchars($name);
				if ($duplicate = db_fetch_array(db_query("select * from downloadcategory where name='$name' and downloadcategoryid!='$category[downloadcategoryid]'")))
					die(eval(get_template('downloads_duplicate_category')));
				adminlog("Updated download category - <b>$name ($category[downloadcategoryid])</b>");
				if ($_POST['transfer']=='upload')
				{
					$image = ',image=\''.upload_image('download', 1).'\'';
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
					$image='';
				db_query("update downloadcategory set name='$name'$image where downloadcategoryid='$category[downloadcategoryid]'");
				db_query("delete from downloadpermissions where downloadcategoryid='$category[downloadcategoryid]'");
				$query = db_query('select groupid from groups');
				while ($group_result = db_fetch_array($query))
				{
					if ($_POST["group_$group_result[groupid]"])
						db_query("insert into downloadpermissions (groupid, downloadcategoryid) values ($group_result[groupid], '$category[downloadcategoryid]')");
				}
				header('Location: downloads.php');
			}
			else
				eval(get_template('invalid_download_category'));
		}
		else
			eval(get_template('downloads_category_missing'));
	}
	elseif ($op=='deletecategory')
	{
		if ($category = db_fetch_array(db_query("select * from downloadcategory where downloadcategoryid='$id'")))
		{
			if (db_num_rows(db_query("select downloadid from download where downloadcategoryid='$category[downloadcategoryid]'")))
				die(eval(get_template('delete_download_category_denied')));
			$category['parsed_image'] = parse_image($category['image']);
			eval(get_template('delete_download_category'));
		}
		else
			eval(get_template('invalid_download_category'));
	}
	elseif ($_POST['op']=='dodeletecategory')
	{
		if ($category = db_fetch_array(db_query("select * from downloadcategory where downloadcategoryid='$id'")))
		{
			if (db_num_rows(db_query("select downloadid from download where downloadcategoryid='$category[downloadcategoryid]'")))
				die(eval(get_template('delete_download_category_denied')));
			adminlog("Deleted download category - <b>$category[name] ($category[downloadcategoryid])</b>");
			db_query("delete from downloadcategory where downloadcategoryid='$category[downloadcategoryid]'");
			db_query("delete from downloadpermissions where downloadcategoryid='$category[downloadcategoryid]'");
			if (dp_substr($category['image'], 0, 1)==':')
				db_query('delete from imagestore where imageid=\''.dp_substr($category['image'], 1).'\'');
			header('Location: downloads.php');
		}
		else
			eval(get_template('invalid_download_category'));
	}
	elseif ($op=='add')
	{
		$query = db_query('select * from downloadcategory order by name asc');
		$i=0;
		while ($cat = db_fetch_array($query))
			$categorystore[$i++] = $cat;
		$query = db_query('select * from download order by name asc');
		$i=0;
		while ($down = db_fetch_array($query))
			$downloadstore[$i++] = $down;
		
		$i=0;
		while ($category_result = $categorystore[$i++])
		{
			eval(store_template('downloads_category'));
			if ($category_result['downloadcategoryid']==$id)
				$selected = true;
			else
				$selected = false;
			eval(store_template('downloadcategory_choice', '$category_choice'));
			$category_choices .= $category_choice;
			$download_categories .= $downloads_category;
			$n=0;
			while ($download_result = $downloadstore[$n++])
			{
				if ($category_result['downloadcategoryid']==$download_result['downloadcategoryid'])
				{
					eval(store_template('downloads_download'));
					$download_categories .= $downloads_download;
				}
			}
		}
		eval(get_template('add_download'));
	}
	elseif ($op=='doadd')
	{
		if (($name = htmlspecialchars(trim($name))) && ($location = htmlspecialchars(trim($location))) && ($location != 'http://') && db_num_rows(db_query("select downloadcategoryid from downloadcategory where downloadcategoryid='$downloadcategoryid'")))
		{
			adminlog("Added download - <b>$name</b>");
			$email = htmlspecialchars(trim($_POST['email']));
			$author = htmlspecialchars(trim($_POST['author']));
			$version = htmlspecialchars(trim($_POST['version']));
			db_query("insert into download (name, downloadcategoryid, description, version, author, location, email) values ('$name', '$downloadcategoryid', '$_POST[description]', '$version', '$author', '$location', '$email')");
			header('Location: downloads.php');
		}
		else
			eval(get_template('downloads_missing'));
	}
	elseif ($op=='edit')
	{
		if ($download = db_fetch_array(db_query("select * from download where downloadid='$id'")))
		{
			adminlog("Edited download - <b>$download[name] ($download[downloadid])</b>");
			$query = db_query('select * from downloadcategory order by name asc');
			while ($category_result = db_fetch_array($query))
			{
				eval(store_template('downloads_category'));
				if ($category_result['downloadcategoryid']==$download['downloadcategoryid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('downloadcategory_choice', '$category_choice'));
				$category_choices .= $category_choice;
			}
			$download['description'] = htmlspecialchars($download['description']);
			eval(get_template('edit_download'));
		}
		else
			eval(get_template('invalid_download'));
	}
	elseif ($op=='doedit')
	{
		if (($name = htmlspecialchars(trim($name))) && ($location = htmlspecialchars(trim($location))) && ($location != 'http://') && db_num_rows(db_query("select downloadcategoryid from downloadcategory where downloadcategoryid='$downloadcategoryid'")))
		{
			if ($download = db_fetch_array(db_query("select * from download where downloadid='$_POST[id]'")))
			{
				adminlog("Updated download - <b>$name ($download[downloadid])</b>");
				$email = htmlspecialchars(trim($_POST['email']));
				$author = htmlspecialchars(trim($_POST['author']));
				$version = htmlspecialchars(trim($_POST['version']));
				db_query("update download set name='$name',downloadcategoryid='$downloadcategoryid',description='$_POST[description]',email='$email',version='$version',author='$author',location='$location' where downloadid='$download[downloadid]'");
				header('Location: downloads.php');
			}
			else
				eval(get_template('invalid_download'));
		}
		else
			eval(get_template('downloads_missing'));
	}
	elseif ($op=='delete')
	{
		if ($download = db_fetch_array(db_query("select * from download where downloadid='$id'")))
			eval(get_template('delete_download'));
		else
			eval(get_template('invalid_download'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($download = db_fetch_array(db_query("select * from download where downloadid='$id'")))
		{
			adminlog("Deleted download - <b>$download[name] ($download[downloadid])</b>");
			db_query("delete from download where downloadid='$download[downloadid]'");
			header('Location: downloads.php');
		}
		else
			eval(get_template('invalid_download'));
	}
	else
	{
		adminlog('Viewed downloads panel');
		$query = db_query('select * from downloadcategory order by name asc');
		$i=0;
		while ($cat = db_fetch_array($query))
			$categorystore[$i++] = $cat;
		$query = db_query('select * from download order by name asc');
		$i=0;
		while ($down = db_fetch_array($query))
			$downloadstore[$i++] = $down;
		
		$i=0;
		while ($category_result = $categorystore[$i++])
		{
			eval(store_template('downloads_category'));
			$download_categories .= $downloads_category;
			$n=0;
			while ($download_result = $downloadstore[$n++])
			{
				if ($category_result['downloadcategoryid']==$download_result['downloadcategoryid'])
				{
					eval(store_template('downloads_download'));
					$download_categories .= $downloads_download;
				}
			}
		}
		eval(get_template('downloads_index'));
	}
}
else
	eval(get_template('permission_error'));
?>