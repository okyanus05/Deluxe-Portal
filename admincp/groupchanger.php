<?php
/**************************************************
* Group Changer
* -------------
* Allows you to set rules, based on post counts and
* number of days registered, to change the groups
* of users.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'addgroup_choice,add_rule,delete_rule,edit_rule,groupchanger_duplicate,groupchanger_index,groupchanger_missing,groupchanger_rule,group_choice,ingroup_choice,invalid_grouprule,removegroup_choice';
/**************************************************
* Global variable resetting                      */
unset($addgroups_col1);
unset($addgroups_col2);
unset($ingroups_col1);
unset($ingroups_col2);
unset($removegroups_col1);
unset($removegroups_col2);
unset($rules);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$op = $_REQUEST['op'];
$posts = $_POST['posts'];
/*************************************************/

$pagetitle = 'Group Changer';

if($group['groupchanger'])
{
	if ($_POST['op']=='doadd')
	{
		if (($name = trim(htmlspecialchars($_POST['name']))) && $_POST['post_condition'] && $_POST['and_or'])
		{
			if (db_fetch_array(db_query("select * from grouprule where name='$name'")))
				eval(get_template('groupchanger_duplicate'));
			else
			{
				adminlog("Added group changer rule - <b>$name</b>");
				db_query("insert into grouprule (name, posts, post_condition, days, and_or, groupid, dont_remove) values ('$name', '$posts', '$_POST[post_condition]', '$_POST[days]', '$_POST[and_or]', '$_POST[groupid]', '$_POST[dont_remove]')");
				$rule = db_fetch_array(db_query('select * from grouprule order by groupruleid desc limit 1'));
				$query = db_query('select groupid from groups');
				while ($group_result = db_fetch_array($query))
				{
					$in = ($_POST["in_$group_result[groupid]"] ? 1 : 0);
					$add = ($_POST["add_$group_result[groupid]"] ? 1 : 0);
					$remove = ($_POST["remove_$group_result[groupid]"] ? 1 : 0);
					db_query("insert into changergroups (groupruleid, groupid, ingroup, addgroup, removegroup) values ($rule[groupruleid], $group_result[groupid], $in, $add, $remove)");
				}
				header('Location: groupchanger.php');
			}
		}
		else
			eval(get_template('groupchanger_missing'));
	}
	elseif ($op=='edit')
	{
		if ($rule = db_fetch_array(db_query("select * from grouprule where groupruleid='$id'")))
		{
			adminlog("Edited group changer rule - <b>$rule[name] ($rule[groupruleid])</b>");
			$query = db_query("select * from changergroups where groupruleid='$rule[groupruleid]'");
			$in_groups = ',';
			$add_groups = ',';
			$remove_groups = ',';
			while ($perm = db_fetch_array($query))
			{
				if ($perm['ingroup'])
					$in_groups .= "$perm[groupid],";
				if ($perm['addgroup'])
					$add_groups .= "$perm[groupid],";
				if ($perm['removegroup'])
					$remove_groups .= "$perm[groupid],";
			}
			$query = db_query('select * from groups order by name asc');
			$num_col1 = ceil(db_num_rows($query)/2);
			$i = 0;
			$primary_groups = '';
			while ($group_result = db_fetch_array($query))
			{
				if ($rule['groupid']==$group_result['groupid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('group_choice'));
				$primary_groups .= $group_choice;
				if (++$i<=$num_col1)
				{
					if (strstr($in_groups, ",$group_result[groupid],"))
						$checked = true;
					else
						$checked = false;
					eval(store_template('ingroup_choice', '$in_group'));
					$ingroups_col1 .= $in_group;
					if (strstr($add_groups, ",$group_result[groupid],"))
						$checked = true;
					else
						$checked = false;
					eval(store_template('addgroup_choice', '$add_group'));
					$addgroups_col1 .= $add_group;
					if (strstr($remove_groups, ",$group_result[groupid],"))
						$checked = true;
					else
						$checked = false;
					eval(store_template('removegroup_choice', '$remove_group'));
					$removegroups_col1 .= $remove_group;
				}
				else
				{
					if (strstr($in_groups, ",$group_result[groupid],"))
						$checked = true;
					else
						$checked = false;
					eval(store_template('ingroup_choice', '$in_group'));
					$ingroups_col2 .= $in_group;
					if (strstr($add_groups, ",$group_result[groupid],"))
						$checked = true;
					else
						$checked = false;
					eval(store_template('addgroup_choice', '$add_group'));
					$addgroups_col2 .= $add_group;
					if (strstr($remove_groups, ",$group_result[groupid],"))
						$checked = true;
					else
						$checked = false;
					eval(store_template('removegroup_choice', '$remove_group'));
					$removegroups_col2 .= $remove_group;
				}
			}
			eval(get_template('edit_rule'));
		}
		else
			eval(get_template('invalid_grouprule'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if (($name = trim(htmlspecialchars($_POST['name']))) && $_POST['post_condition'] && $_POST['and_or'])
		{
			if ($rule = db_fetch_array(db_query("select * from grouprule where groupruleid='$id'")))
			{
				if ($duplicate = db_fetch_array(db_query("select * from grouprule where name='$name' and groupruleid!='$rule[groupruleid]'")))
					eval(get_template('groupchanger_duplicate'));
				else
				{
					adminlog("Updated group changer rule - <b>$name ($rule[groupruleid])</b>");
					db_query("update grouprule set name='$name',posts='$posts',post_condition='$_POST[post_condition]',groupid='$_POST[groupid]',and_or='$_POST[and_or]',days='$_POST[days]',dont_remove='$_POST[dont_remove]' where groupruleid='$rule[groupruleid]'");
					$query = db_query('select groupid from groups');
					while ($group_result = db_fetch_array($query))
					{
						$in = ($_POST["in_$group_result[groupid]"] ? 1 : 0);
						$add = ($_POST["add_$group_result[groupid]"] ? 1 : 0);
						$remove = ($_POST["remove_$group_result[groupid]"] ? 1 : 0);
						db_query("update changergroups set ingroup=$in,addgroup=$add,removegroup=$remove where groupruleid='$rule[groupruleid]' and groupid=$group_result[groupid]");
					}
					header('Location: groupchanger.php');
				}
			}
			else
				eval(get_template('invalid_grouprule'));
		}
		else
			eval(get_template('groupchanger_missing'));
	}
	elseif ($op=='delete')
	{
		if ($rule = db_fetch_array(db_query("select * from grouprule where groupruleid='$id'")))
			eval(get_template('delete_rule'));
		else
			eval(get_template('invalid_grouprule'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($rule = db_fetch_array(db_query("select * from grouprule where groupruleid='$id'")))
		{
			adminlog("Deleted group changer rule - <b>$rule[groupruleid]</b>");
			db_query("delete from grouprule where groupruleid='$rule[groupruleid]'");
			db_query("delete from changergroups where groupruleid='$rule[groupruleid]'");
			header('Location: groupchanger.php');
		}
		else
			eval(get_template('invalid_grouprule'));
	}
	elseif ($_REQUEST['op']=='add')
	{
		$i = 0;
		$query = db_query('select * from groups order by name asc');
		$num_col1 = ceil(db_num_rows($query)/2);
		$checked = false;
		$selected = false;
		$primary_groups = '';
		while ($group_result = db_fetch_array($query))
		{
			eval(store_template('group_choice'));
			$primary_groups .= $group_choice;
			eval(store_template('ingroup_choice'));
			if (++$i<=$num_col1)
				$ingroups_col1 .= $ingroup_choice;
			else
				$ingroups_col2 .= $ingroup_choice;
			eval(store_template('addgroup_choice'));
			if ($i<=$num_col1)
				$addgroups_col1 .= $addgroup_choice;
			else
				$addgroups_col2 .= $addgroup_choice;
			eval(store_template('removegroup_choice'));
			if ($i<=$num_col1)
				$removegroups_col1 .= $removegroup_choice;
			else
				$removegroups_col2 .= $removegroup_choice;
		}
		eval(get_template('add_rule'));
	}
	else
	{
		adminlog('Viewed group changer panel');
		$query = db_query('select * from grouprule order by name asc');
		while ($rule_result = db_fetch_array($query))
		{
			eval(store_template('groupchanger_rule', '$rule'));
			$rules .= $rule;
		}
		eval(get_template('groupchanger_index'));
	}
}
else
	eval(get_template('permission_error'));
?>