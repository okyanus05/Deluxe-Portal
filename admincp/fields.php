<?php
/**************************************************
* Custom Profile Fields
* ---------------------
* Manages custom user profile fields.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'delete_field,edit_field,fields_duplicate,fields_field,fields_index,fields_missing,invalid_customfield,invalid_field';
/**************************************************
* Global variable resetting                      */
unset($custom_fields);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$edit = $_POST['edit'];
$id = $_REQUEST['id'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$view = $_POST['view'];
/*************************************************/

$pagetitle = 'Custom Profile Fields';

if($group['customfields'])
{
	if ($op=='add')
	{
		if ($name = htmlspecialchars(trim($name)))
		{
			if (db_num_rows(db_query("select * from customfield where name='$name'")))
				eval(get_template('fields_duplicate'));
			else
			{
				adminlog("Added custom profile field - <b>$name</b>");
				$edit = ($edit ? 1 : 0);
				$view = ($view ? 1 : 0);
				db_query("insert into customfield (name, ordered, description, edit, view) values ('$name', '$_POST[ordered]', '$_POST[description]', $edit, $view)");
				$field = db_fetch_array(db_query('select customfieldid from customfield order by customfieldid desc'));
				$query = db_query('select userid from user');
				while ($user_result = db_fetch_array($query))
					db_query("insert into usercustomfield (customfieldid, userid, value) values ($field[customfieldid], $user_result[userid], '')");
				header('Location: fields.php');
			}
		}
		else
			eval(get_template('fields_missing'));
	}
	elseif ($_POST['op']=='order')
	{
		$query = db_query('select * from customfield');
		while ($field = db_fetch_array($query))
			db_query('update customfield set ordered=\''.$_POST["field_$field[customfieldid]"]."' where customfieldid=$field[customfieldid]");
		header('Location: fields.php');
	}
	elseif ($op=='edit')
	{
		adminlog("Edited custom profile field - <b>$field[name] ($field[customfieldid])</b>");
		$query = db_query('select * from customfield order by ordered asc');
		while ($field = db_fetch_array($query))
		{
			eval(store_template('fields_field'));
			$custom_fields .= $fields_field;
		}
		if ($field = db_fetch_array(db_query("select * from customfield where customfieldid='$id'")))
		{
			$field['description'] = htmlspecialchars($field['description']);
			eval(get_template('edit_field'));
		}
		else
			eval(get_template('invalid_field'));
	}
	elseif ($op=='doedit')
	{
		if ($name = htmlspecialchars(trim($name)))
		{
			if ($field = db_fetch_array(db_query("select * from customfield where customfieldid='$id'")))
			{
				if ($duplicate = db_fetch_array(db_query("select * from customfield where name='$name' and customfieldid!=$field[customfieldid]")))
					eval(get_template('fields_duplicate'));
				else
				{
					adminlog("Updated custom profile field - <b>$name ($field[customfieldid])</b>");
					$edit = ($edit ? 1 : 0);
					$view = ($view ? 1 : 0);
					db_query("update customfield set name='$name',description='$_POST[description]',ordered='$_POST[ordered]',edit=$edit,view=$view where customfieldid='$field[customfieldid]'");
					header('Location: fields.php');
				}
			}
			else
				eval(get_template('invalid_field'));
		}
		else
			eval(get_template('fields_missing'));
	}
	elseif ($op=='delete')
	{
		if ($field = db_fetch_array(db_query("select * from customfield where customfieldid='$id'")))
			eval(get_template('delete_field'));
		else
			eval(get_template('invalid_customfield'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($field = db_fetch_array(db_query("select * from customfield where customfieldid='$_POST[id]'")))
		{
			adminlog("Deleted custom profile field - <b>$field[name] ($field[customfieldid])</b>");
			db_query("delete from customfield where customfieldid='$field[customfieldid]'");
			db_query("delete from usercustomfield where customfieldid='$field[customfieldid]'");
			header('Location: fields.php');
		}
		else
			eval(get_template('invalid_field'));
	}
	else
	{
		$query = db_query('select * from customfield order by ordered asc');
		while ($field = db_fetch_array($query))
		{
			eval(store_template('fields_field'));
			$custom_fields .= $fields_field;
		}
		adminlog('Viewed custom profile fields panel');
		eval(get_template('fields_index'));
	}
}
else
	eval(get_template('permission_error'));
?>