<?php
/**************************************************
* Titles
* ------
* Allows you to manage user titles.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'delete_title,edit_title,group_choice,invalid_title,titles_duplicate,titles_group,titles_index,titles_missing,titles_title';
/**************************************************
* Global variable resetting                      */
unset($groups);
unset($title_groups);
unset($titles);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$groupid = $_POST['groupid'];
$id = $_REQUEST['id'];
$image = $_POST['image'];
$op = $_REQUEST['op'];
$posts = $_POST['posts'];
$repeat = $_POST['repeat'];
$title = $_POST['title'];
/*************************************************/

$pagetitle = 'Titles';

if($group['titles'])
{
	if ($op=='add')
	{
		if (($title = trim($title)) && is_numeric($posts) && $groupid)
		{
			if ($duplicate = db_fetch_array(db_query("select * from title where posts='$posts' and groupid='$groupid'")))
				eval(get_template('titles_duplicate'));
			else
			{
				$images = htmlspecialchars(trim($images));
				adminlog("Added user title - <b>$title</b> to group <b>$groupid</b>");
				db_query("insert into title (title, posts, groupid, image, `repeat`) values ('$title', '$posts', '$groupid', '$image', '$repeat')");
				header('Location: titles.php');
			}
		}
		else
			eval(get_template('titles_missing'));
	}
	elseif ($op=='edit')
	{
		if ($title = db_fetch_array(db_query("select * from title where titleid='$id'")))
		{
			adminlog("Edited user title - <b>$title[title] ($title[titleid])</b> in group <b>$title[groupid]</b>");
			$title['title'] = htmlspecialchars($title['title']);
			$query = db_query('select title.* from title,groups where title.groupid=groups.groupid order by groups.name asc,posts asc');
			$i = 0;
			while ($title_result = db_fetch_array($query))
				$titlestore[$i++] = $title_result;
			$i = 0;
			$query = db_query('select * from groups order by name asc');
			while ($group_result = db_fetch_array($query))
			{
				while ($title_result = $titlestore[$i])
				{
					if ($title_result['groupid']!=$group_result['groupid'])
						break;
					eval(store_template('titles_title', '$title_name'));
					$titles .= $title_name;
					$i++;
				}
				eval(store_template('titles_group', '$group_name'));
				$title_groups .= $group_name;
				$titles = '';
				if ($group_result['groupid']==$title['groupid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('group_choice'));
				$groups .= $group_choice;
			}
			eval(get_template('edit_title'));
		}
		else
			eval(get_template('invalid_title'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if (($title = trim($title)) && is_numeric($posts) && $groupid)
		{
			if ($title_result = db_fetch_array(db_query("select * from title where titleid='$id'")))
			{
				if ($duplicate = db_fetch_array(db_query("select * from title where posts='$posts' and groupid='$groupid' and titleid!='$title_result[titleid]'")))
					eval(get_template('titles_duplicate'));
				else
				{
					$images = htmlspecialchars(trim($images));
					adminlog("Updated user title - <b>$title ($title[titleid])</b> in group <b>$groupid</b>");
					db_query("update title set title='$title',posts='$posts',groupid='$groupid',image='$image',`repeat`='$repeat' where titleid='$title_result[titleid]'");
					header('Location: titles.php');
				}
			}
			else
				eval(get_template('invalid_title'));
		}
		else
			eval(get_template('titles_missing'));
	}
	elseif ($op=='delete')
	{
		if ($title = db_fetch_array(db_query("select * from title where titleid='$id'")))
			eval(get_template('delete_title'));
		else
			eval(get_template('invalid_title'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($title = db_fetch_array(db_query("select * from title where titleid='$id'")))
		{
			adminlog("Deleted user title - <b>$title[titleid]</b>");
			db_query("delete from title where titleid='$title[titleid]'");
			header('Location: titles.php');
		}
		else
			eval(get_template('invalid_title'));
	}
	else
	{
		adminlog('Viewed user titles panel');
		$query = db_query('select title.* from title,groups where title.groupid=groups.groupid order by groups.name asc,posts asc');
		$i = 0;
		while ($title_result = db_fetch_array($query))
			$titlestore[$i++] = $title_result;
		$i = 0;
		$query = db_query('select * from groups order by name asc');
		while ($group_result = db_fetch_array($query))
		{
			while ($title_result = $titlestore[$i])
			{
				if ($title_result['groupid']!=$group_result['groupid'])
					break;
				eval(store_template('titles_title', '$title_name'));
				$titles .= $title_name;
				$i++;
			}
			eval(store_template('titles_group', '$group_name'));
			$title_groups .= $group_name;
			$titles = '';
			if ($group_result['groupid']==$config['default_register_group'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('group_choice'));
			$groups .= $group_choice;
		}
		eval(get_template('titles_index'));
	}
}
else
	eval(get_template('permission_error'));
?>