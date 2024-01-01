<?php
/**************************************************
* Sections
* --------
* Manages article sections.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_section,deleteothersgroup_choice,deleteowngroup_choice,delete_section,delete_section_denied,editothersgroup_choice,editowngroup_choice,edit_section,invalid_section,postgroup_choice,sections_duplicate,sections_index,sections_missing,sections_row,sections_section,viewgroup_choice';
/**************************************************
* Global variable resetting                      */
unset($deleteothers_groups_col1);
unset($deleteothers_groups_col2);
unset($deleteothers_groups_col3);
unset($deleteown_groups_col1);
unset($deleteown_groups_col2);
unset($deleteown_groups_col3);
unset($editothers_groups_col1);
unset($editothers_groups_col2);
unset($editothers_groups_col3);
unset($editown_groups_col1);
unset($editown_groups_col2);
unset($editown_groups_col3);
unset($post_groups_col1);
unset($post_groups_col2);
unset($post_groups_col3);
unset($sections);
unset($view_groups_col1);
unset($view_groups_col2);
unset($view_groups_col3);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
/*************************************************/

$pagetitle = 'Sections';

if ($group['sections'])
{
	if ($_REQUEST['op']=='add')
	{
		$query = db_query('select * from groups order by name asc');
		$num_col1 = ceil(db_num_rows($query)/3);
		$remaining = db_num_rows($query) - $num_col1;
		$num_col2 = $num_col1 + ceil($remaining/2);
		$i = 0;
		while ($group_result = db_fetch_array($query))
		{
			$checked = true;
			eval(store_template('viewgroup_choice', '$view_group'));
			if ($group_result['articles'])
				$checked = true;
			else
				$checked = false;
			eval(store_template('postgroup_choice', '$post_group'));
			eval(store_template('editowngroup_choice', '$editown_group'));
			eval(store_template('deleteowngroup_choice', '$deleteown_group'));
			if ($group_result['articles'] && $group_result['sections'])
				$checked = true;
			else
				$checked = false;
			eval(store_template('editothersgroup_choice', '$editothers_group'));
			eval(store_template('deleteothersgroup_choice', '$deleteothers_group'));
			if (++$i<=$num_col1)
			{
				$post_groups_col1 .= $post_group;
				$editown_groups_col1 .= $editown_group;
				$editothers_groups_col1 .= $editothers_group;
				$view_groups_col1 .= $view_group;
				$deleteown_groups_col1 .= $deleteown_group;
				$deleteothers_groups_col1 .= $deleteothers_group;
			}
			elseif ($i<=$num_col2)
			{
				$post_groups_col2 .= $post_group;
				$editown_groups_col2 .= $editown_group;
				$editothers_groups_col2 .= $editothers_group;
				$view_groups_col2 .= $view_group;
				$deleteown_groups_col2 .= $deleteown_group;
				$deleteothers_groups_col2 .= $deleteothers_group;
			}
			else
			{
				$post_groups_col3 .= $post_group;
				$editown_groups_col3 .= $editown_group;
				$editothers_groups_col3 .= $editothers_group;
				$view_groups_col3 .= $view_group;
				$deleteown_groups_col3 .= $deleteown_group;
				$deleteothers_groups_col3 .= $deleteothers_group;
			}
		}
		eval(get_template('add_section'));
	}
	elseif ($_POST['op']=='doadd')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if ($duplicate = db_fetch_array(db_query("select * from section where name='$name'")))
				eval(get_template('sections_duplicate'));
			adminlog("Added section - <b>$name</b>");
			if ($_POST['transfer']=='upload')
				$image = upload_image('section', 1);
			else
				$image = $_POST['image_location'];
			db_query("insert into section (name, image, sidebar) values ('$name', '$image', '1')");
			$section = db_fetch_array(db_query('select sectionid from section order by sectionid desc limit 1'));
			$query = db_query('select groupid from groups');
			while ($group_result = db_fetch_array($query))
			{
				$view = ($_POST["view_$group_result[groupid]"] ? 1 : 0);
				$editown = ($_POST["editown_$group_result[groupid]"] ? 1 : 0);
				$editothers = ($_POST["editothers_$group_result[groupid]"] ? 1 : 0);
				$deleteown = ($_POST["deleteown_$group_result[groupid]"] ? 1 : 0);
				$deleteothers = ($_POST["deleteothers_$group_result[groupid]"] ? 1 : 0);
				$post = ($_POST["post_$group_result[groupid]"] ? 1 : 0);
				db_query("insert into sectionpermissions (sectionid, groupid, view, post, editown, editothers, deleteown, deleteothers) values ($section[sectionid], $group_result[groupid], $view, $post, $editown, $editothers, $deleteown, $deleteothers)");
			}
			header('Location: sections.php');
		}
		else
			eval(get_template('sections_missing'));
	}
	elseif ($op=='edit')
	{
		if ($section = db_fetch_array(db_query("select * from section where sectionid='$id'")))
		{
			adminlog("Edited section - <b>$section[name] ($section[sectionid])</b>");
			$query = db_query("select * from sectionpermissions where sectionid='$section[sectionid]'");
			$view_groups = ',';
			$post_groups = ',';
			$editown_groups = ',';
			$editothers_groups = ',';
			$deleteown_groups = ',';
			$deleteothers_groups = ',';
			while ($perm = db_fetch_array($query))
			{
				if ($perm['view'])
					$view_groups .= "$perm[groupid],";
				if ($perm['post'])
					$post_groups .= "$perm[groupid],";
				if ($perm['editown'])
					$editown_groups .= "$perm[groupid],";
				if ($perm['editothers'])
					$editothers_groups .= "$perm[groupid],";
				if ($perm['deleteown'])
					$deleteown_groups .= "$perm[groupid],";
				if ($perm['deleteothers'])
					$deleteothers_groups .= "$perm[groupid],";
			}
			$query = db_query('select * from groups order by name asc');
			$num_col1 = ceil(db_num_rows($query)/3);
			$remaining = db_num_rows($query) - $num_col1;
			$num_col2 = $num_col1 + ceil($remaining/2);
			$i = 0;
			while ($group_result = db_fetch_array($query))
			{
				if (strstr($post_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('postgroup_choice', '$post_group'));
				if (strstr($view_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('viewgroup_choice', '$view_group'));
				if (strstr($editown_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('editowngroup_choice', '$editown_group'));
				if (strstr($editothers_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('editothersgroup_choice', '$editothers_group'));
				if (strstr($deleteown_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('deleteowngroup_choice', '$deleteown_group'));
				if (strstr($deleteothers_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('deleteothersgroup_choice', '$deleteothers_group'));
				if (++$i<=$num_col1)
				{
					$post_groups_col1 .= $post_group;
					$editown_groups_col1 .= $editown_group;
					$editothers_groups_col1 .= $editothers_group;
					$view_groups_col1 .= $view_group;
					$deleteown_groups_col1 .= $deleteown_group;
					$deleteothers_groups_col1 .= $deleteothers_group;
				}
				elseif ($i<=$num_col2)
				{
					$post_groups_col2 .= $post_group;
					$editown_groups_col2 .= $editown_group;
					$editothers_groups_col2 .= $editothers_group;
					$view_groups_col2 .= $view_group;
					$deleteown_groups_col2 .= $deleteown_group;
					$deleteothers_groups_col2 .= $deleteothers_group;
				}
				else
				{
					$post_groups_col3 .= $post_group;
					$editown_groups_col3 .= $editown_group;
					$editothers_groups_col3 .= $editothers_group;
					$view_groups_col3 .= $view_group;
					$deleteown_groups_col3 .= $deleteown_group;
					$deleteothers_groups_col3 .= $deleteothers_group;
				}
			}
			eval(get_template('edit_section'));
		}
		else
			eval(get_template('invalid_section'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if ($section = db_fetch_array(db_query("select * from section where sectionid='$id'")))
			{
				if ($duplicate = db_fetch_array(db_query("select * from section where name='$name' and sectionid!='$section[sectionid]'")))
					die(eval(get_template('sections_duplicate')));
				adminlog("Updated section - <b>$section[name] ($section[sectionid])</b>");
				if ($_POST['transfer']=='upload')
				{
					$image = ',image=\''.upload_image('section', 1).'\'';
					if (dp_substr($section['image'], 0, 1)==':')
						db_query('delete from imagestore where imageid=\''.dp_substr($section['image'], 1).'\'');
				}
				elseif ($_POST['transfer']=='location')
				{
					$image = ",image='$_POST[image_location]'";
					if (dp_substr($section['image'], 0, 1)==':')
						db_query('delete from imagestore where imageid=\''.dp_substr($section['image'], 1).'\'');
				}
				else
					$image = '';
				db_query("update section set name='$name',sidebar='1'$image where sectionid='$section[sectionid]'");
				$query = db_query('select groupid from groups');
				while ($group_result = db_fetch_array($query))
				{
					$view = ($_POST["view_$group_result[groupid]"] ? 1 : 0);
					$editown = ($_POST["editown_$group_result[groupid]"] ? 1 : 0);
					$editothers = ($_POST["editothers_$group_result[groupid]"] ? 1 : 0);
					$deleteown = ($_POST["deleteown_$group_result[groupid]"] ? 1 : 0);
					$deleteothers = ($_POST["deleteothers_$group_result[groupid]"] ? 1 : 0);
					$post = ($_POST["post_$group_result[groupid]"] ? 1 : 0);
					db_query("update sectionpermissions set view=$view,post=$post,editown=$editown,editothers=$editothers,deleteown=$deleteown,deleteothers=$deleteothers where sectionid='$section[sectionid]' and groupid=$group_result[groupid]");
				}
				header('Location: sections.php');
			}
			else
				eval(get_template('invalid_section'));
		}
		else
			eval(get_template('sections_missing'));
	}
	elseif ($op=='delete')
	{
		if ($section = db_fetch_array(db_query("select * from section where sectionid='$id'")))
		{
			if (db_num_rows(db_query("select articleid from article where sectionid='$section[sectionid]'")))
				die(eval(get_template('delete_section_denied')));
			$section['parsed_image'] = parse_image($section['image']);
			eval(get_template('delete_section'));
		}
		else
			eval(get_template('invalid_section'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($section = db_fetch_array(db_query("select * from section where sectionid='$id'")))
		{
			if (db_num_rows(db_query("select articleid from article where sectionid='$section[sectionid]'")))
				die(eval(get_template('delete_section_denied')));
			adminlog("Deleted section - <b>$section[name] ($section[sectionid])</b>");
			db_query("delete from section where sectionid='$section[sectionid]'");
			db_query("delete from sectionpermissions where sectionid='$section[sectionid]'");
			if (dp_substr($section['image'], 0, 1)==':')
				db_query('delete from imagestore where imageid=\''.dp_substr($section['image'], 1).'\'');
			header('Location: sections.php');
		}
		else
			eval(get_template('invalid_section'));
	}
	else
	{
		$query = db_query('select * from section order by name asc');
		$n = 0;
		while ($n<db_num_rows($query))
		{
			$section_col = '';
			for ($i=0; $i<$config['sections_per_row']; $i++)
			{
				$n++;
				$section = db_fetch_array($query);
				$section['parsed_image'] = parse_image($section['image']);
				eval(store_template('sections_section'));
				$section_col .= $sections_section;
			}
			eval(store_template('sections_row'));
			$sections .= $sections_row;
		}
		adminlog('Viewed sections panel');
		eval(get_template('sections_index'));
	}
}
else
	eval(get_template('permission_error'));
?>