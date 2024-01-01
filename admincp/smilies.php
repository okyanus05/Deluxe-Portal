<?php
/**************************************************
* Smilies
* -------
* Allows the addition, editing, and deletion of
* smiley images.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'delete_smilie,edit_smilie,invalid_smilie,smilies_index,smilies_missing,smilies_smilie';
/**************************************************
* Global variable resetting                      */
unset($smilies);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$ordered = $_POST['ordered'];
$tag = $_POST['tag'];
/*************************************************/

$pagetitle = 'Smilies';

if ($group['smilies'])
{
	if ($op=='add')
	{
		if (($tag = trim(htmlspecialchars($tag))) && ($name = trim(htmlspecialchars($name))))
		{
			adminlog("Added smilie - <b>$name $tag</b>");
			if ($_POST['transfer']=='upload')
				$image = upload_image('smilie', 1);
			else
				$image = $_POST['image_location'];
			db_query("insert into smilie (tag, name, image, ordered, `insensitive`) values ('$tag', '$name', '$image', '$ordered', '$_POST[insensitive]')");
			header('Location: smilies.php');
		}
		else
			eval(get_template('smilies_missing'));
	}
	elseif ($_POST['op']=='order')
	{
		$query = db_query('select * from smilie');
		while ($smilie = db_fetch_array($query))
			db_query('update smilie set ordered=\''.$_POST["smilie_$smilie[smilieid]"]."' where smilieid=$smilie[smilieid]");
		header('Location: smilies.php');
	}
	elseif ($op=='edit')
	{
		$query = db_query('select * from smilie order by ordered asc');
		while ($smilie = db_fetch_array($query))
		{
			$smilie['parsed_image'] = parse_image($smilie['image']);
			eval(store_template('smilies_smilie', '$smilie_result'));
			$smilies .= $smilie_result;
		}
		if ($smilie = db_fetch_array(db_query("select * from smilie where smilieid='$id'")))
		{
			adminlog("Edited smilie - <b>$smilie[name] $smilie[tag] ($smilie[smilieid])</b>");
			$smilie['parsed_image'] = parse_image($smilie['image']);
			eval(get_template('edit_smilie'));
		}
		else
			eval(get_template('invalid_smilie'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if (($tag = trim(htmlspecialchars($tag))) && ($name = trim(htmlspecialchars($name))))
		{
			if ($smilie = db_fetch_array(db_query("select * from smilie where smilieid='$id'")))
			{
				adminlog("Updated smilie - <b>$smilie[name] $smilie[tag] ($smilie[smilieid])</b>");
				if ($_POST['transfer']=='upload')
					$image = ',image=\''.upload_image('smilie', 1).'\'';
				elseif ($_POST['transfer']=='location')
					$image = ",image='$_POST[image_location]'";
				else
					$image = '';
				db_query("update smilie set `insensitive`='$_POST[insensitive]', tag='$tag',name='$name',ordered='$ordered'$image where smilieid='$smilie[smilieid]'");
				header('Location: smilies.php');
			}
			else
				eval(get_template('invalid_smilie'));
		}
		else
			eval(get_template('smilies_missing'));
	}
	elseif ($op=='delete')
	{
		if ($smilie = db_fetch_array(db_query("select * from smilie where smilieid='$id'")))
		{
			$smilie['parsed_image'] = parse_image($smilie['image']);
			eval(get_template('delete_smilie'));
		}
		else
			eval(get_template('invalid_smilie'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($smilie = db_fetch_array(db_query("select * from smilie where smilieid='$id'")))
		{
			adminlog("Deleted smilie - <b>$smilie[smilieid]</b>");
			db_query("delete from smilie where smilieid='$smilie[smilieid]'");
			header('Location: smilies.php');
		}
		else
			eval(get_template('invalid_smilie'));
	}
	else
	{
		$query = db_query('select * from smilie order by ordered asc');
		while ($smilie = db_fetch_array($query))
		{
			$smilie['parsed_image'] = parse_image($smilie['image']);
			eval(store_template('smilies_smilie', '$smilie_result'));
			$smilies .= $smilie_result;
		}
		adminlog('Viewed smilies panel');
		eval(get_template('smilies_index'));
	}
}
else
	eval(get_template('permission_error'));
?>