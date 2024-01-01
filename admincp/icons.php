<?php
/**************************************************
* Icons
* -------------
* This admin panel manages icons, which can be used
* to help indicate thread and post topics.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'delete_icon,edit_icon,icons_icon,icons_index,icons_missing,invalid_icon';
/**************************************************
* Global variable resetting                      */
unset($icons);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
/*************************************************/

$pagetitle = 'Icons';

if ($group['icons'])
{
	if ($_POST['op']=='add')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			adminlog("Added icon - <b>$name</b>");
			if ($_POST['transfer']=='upload')
				$image = upload_image('icon', 1);
			else
				$image = $_POST['image_location'];
			db_query("insert into icon (name, image, ordered) values ('$name', '$image', '$_POST[ordered]')");
			header('Location: icons.php');
		}
		else
			eval(get_template('icons_missing'));
	}
	elseif ($_POST['op']=='order')
	{
		$query = db_query('select * from icon');
		while ($icon = db_fetch_array($query))
			db_query('update icon set ordered=\''.$_POST["icon_$icon[iconid]"]."' where iconid=$icon[iconid]");
		header('Location: icons.php');
	}
	elseif ($op=='edit')
	{
		$query = db_query('select * from icon order by ordered asc');
		while ($icon = db_fetch_array($query))
		{
			$icon['parsed_image'] = parse_image($icon['image']);
			eval(store_template('icons_icon'));
			$icons .= $icons_icon;
		}
		if ($icon = db_fetch_array(db_query("select * from icon where iconid='$id'")))
		{
			adminlog("Edited icon - <b>$icon[name] ($icon[iconid])</b>");
			$icon['parsed_image'] = parse_image($icon['image']);
			eval(get_template('edit_icon'));
		}
		else
			eval(get_template('invalid_icon'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if ($icon = db_fetch_array(db_query("select * from icon where iconid='$id'")))
			{
				adminlog("Updated icon - <b>$icon[name] ($icon[iconid])</b>");
				if ($_POST['transfer']=='upload')
					$image = ',image=\''.upload_image('icon', 1).'\'';
				elseif ($_POST['transfer']=='location')
					$image = ",image='$_POST[image_location]'";
				else
					$image = '';
				db_query("update icon set name='$name',ordered='$_POST[ordered]'$image where iconid=$icon[iconid]");
				header('Location: icons.php');
			}
			else
				eval(get_template('invalid_icon'));
		}
		else
			eval(get_template('icons_missing'));
	}
	elseif ($op=='delete')
	{
		if ($icon = db_fetch_array(db_query("select * from icon where iconid='$id'")))
		{
			$icon['parsed_image'] = parse_image($icon['image']);
			eval(get_template('delete_icon'));
		}
		else
			eval(get_template('invalid_icon'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($icon = db_fetch_array(db_query("select * from icon where iconid='$id'")))
		{
			adminlog("Deleted icon - <b>$icon[iconid]</b>");
			db_query("delete from icon where iconid=$icon[iconid]");
			db_query("update forum set threadiconid=0 where threadiconid=$icon[iconid]");
			db_query("update thread set iconid=0 where iconid=$icon[iconid]");
			db_query("update post set iconid=0 where iconid=$icon[iconid]");
			header('Location: icons.php');
		}
		else
			eval(get_template('invalid_icon'));
	}
	else
	{
		$query = db_query('select * from icon order by ordered asc');
		while ($icon = db_fetch_array($query))
		{
			$icon['parsed_image'] = parse_image($icon['image']);
			eval(store_template('icons_icon'));
			$icons .= $icons_icon;
		}
		adminlog('Viewed icons panel');
		eval(get_template('icons_index'));
	}
}
else
	eval(get_template('permission_error'));
?>