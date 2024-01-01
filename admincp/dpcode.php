<?php
/**************************************************
* DP Code
* -------
* Lets you manage DP Code (formatting tags that can
* be safely used in place of HTML).
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'delete_dpcode,dpcode_dpcode,dpcode_duplicate,dpcode_index,dpcode_missing,edit_dpcode,invalid_dpcode';
/**************************************************
* Global variable resetting                      */
unset($dpcodes);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$example = $_POST['example'];
$id = $_REQUEST['id'];
$op = $_REQUEST['op'];
$replacement = $_POST['replacement'];
$tag = $_POST['tag'];
$nosmilies = (int) $_POST['nosmilies'];
/*************************************************/

$pagetitle = 'DP Code';

if($group['dpcode'])
{
	if ($op=='add')
	{
		if (($tag = htmlspecialchars(trim($tag))) && ($replacement = trim($replacement)))
		{
			$example = htmlspecialchars(trim($example));
			$dupcheck = (strstr($replacement, '{option}') ? "replacement like '%{option}%' and replacement like '%{param}%'" : "replacement like '%{param}%' and replacement not like '%{option}%'");
			$empty_dpcode = (!strstr($replacement, '{param}')) ? 1 : 0;
			if (db_fetch_array(db_query("select * from dpcode where tag='$tag' and $dupcheck")))
				eval(get_template('dpcode_duplicate'));
			else
			{
				adminlog("Added DP Code - <b>[$tag]</b>");
				db_query("insert into dpcode (tag, replacement, description, example, empty, nosmilies) values ('$tag', '$replacement', '$_POST[description]', '$example', '$empty_dpcode', '$nosmilies')");
				header('Location: dpcode.php');
			}
		}
		else
			eval(get_template('dpcode_missing'));
	}
	elseif ($op=='edit')
	{
		if ($dpcode = db_fetch_array(db_query("select * from dpcode where dpcodeid='$id'")))
		{
			adminlog("Edited DP Code - <b>[$dpcode[tag]] ($dpcode[dpcodeid])</b>");
			$dpcode['replacement'] = htmlspecialchars($dpcode['replacement']);
			$dpcode['example'] = htmlspecialchars($dpcode['example']);
			$dpcode['description'] = htmlspecialchars($dpcode['description']);
			$query = db_query('select * from dpcode order by tag asc');
			while ($dpcode_result = db_fetch_array($query))
			{
				eval(store_template('dpcode_dpcode', '$dpcode_result'));
				$dpcodes .= $dpcode_result;
			}
			eval(get_template('edit_dpcode'));
		}
		else
			eval(get_template('invalid_dpcode'));
	}
	elseif ($op=='doedit')
	{
		if (($tag = htmlspecialchars(trim($tag))) && ($replacement = trim($replacement)))
		{
			if ($dpcode = db_fetch_array(db_query("select * from dpcode where dpcodeid='$id'")))
			{
				$example = htmlspecialchars(trim($example));
				$dupcheck = (strstr($replacement, '{option}') ? "replacement like '%{option}%' and replacement like '%{param}%'" : "replacement like '%{param}%' and replacement not like '%{option}%'");
				$empty_dpcode = (!strstr($replacement, '{param}')) ? 1 : 0;
				$query = db_query("select * from dpcode where tag='$tag' and $dupcheck and dpcodeid!='$dpcode[dpcodeid]'");
				if ($duplicate = db_fetch_array($query))
					eval(get_template('dpcode_duplicate'));
				else
				{
					adminlog("Updated DP Code - <b>[$tag] ($dpcode[dpcodeid])</b>");
					db_query("update dpcode set nosmilies='$nosmilies',tag='$tag',replacement='$replacement',description='$_POST[description]',example='$example',empty='$empty_dpcode' where dpcodeid='$dpcode[dpcodeid]'");
					header('Location: dpcode.php');
				}
			}
			else
				eval(get_template('invalid_dpcode'));
		}
		else
			eval(get_template('dpcode_missing'));
	}
	elseif ($_REQUEST['op']=='delete')
	{
		if ($dpcode = db_fetch_array(db_query("select * from dpcode where dpcodeid='$id'")))
			eval(get_template('delete_dpcode'));
		else
			eval(get_template('invalid_dpcode'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($dpcode = db_fetch_array(db_query("select * from dpcode where dpcodeid='$id'")))
		{
			adminlog("Deleted DP Code - <b>[$dpcode[tag]] ($dpcode[dpcodeid])</b>");
			db_query("delete from dpcode where dpcodeid='$dpcode[dpcodeid]'");
			header('Location: dpcode.php');
		}
		else
			eval(get_template('invalid_dpcode'));
	}
	else
	{
		$query = db_query('select * from dpcode order by tag asc');
		while ($dpcode_result = db_fetch_array($query))
		{
			eval(store_template('dpcode_dpcode', '$dpcode_result'));
			$dpcodes .= $dpcode_result;
		}
		adminlog('Viewed DP Code panel');
		eval(get_template('dpcode_index'));
	}
}
else
	eval(get_template('permission_error'));
?>