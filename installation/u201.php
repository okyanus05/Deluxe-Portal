<?php
require ('functions.php');
print_header("Deluxe Portal 2.0.0 -> 2.0.1");

db_connect();
db_select_db();

echo 'Upgrading from 2.0.0 to 2.0.1<br />';
	
if (!$_REQUEST['op'])
{
	echo 'Step 1: Altering database<br /><br />';
	db_query("alter table `section` add `sidebar` tinyint unsigned not null");
	db_query("alter table `forum` add `link` char(255) not null");
	db_query("update `section` set `sidebar`=1");
	db_query("update `forum` set `link`=''");
	redirect("u201.php?op=2&template_edit=$template_edit");
}
elseif ($_REQUEST['op']==2)
{
	echo 'Step 2: Setting up templates<br /><br />';
	
	if ($template_edit)
		$change = 'footer,forum_forum,forumdisplay_forum,printthread_index';
	else
		$change = '';
	
	$delete = '';
	
	$new = '';
	
	$admin_change = 'admin_index,configuration_index,edit_forum,mod_index,footer,add_forum';

	$admin_delete = '';
	
	$admin_new = '';
	
	db_query("truncate parsedtemplate");
	selective_import(1, $admin_new, $admin_change, $admin_delete);
	$query = db_query("select * from templateset where templatesetid>1");
	while ($tset = db_fetch_array($query))
		selective_import($tset['templatesetid'], $new, $change, $delete);
	
	db_query("update config set version='2.0.1'");
	redirect("upgrade.php");
}

print_footer();
?>