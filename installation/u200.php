<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Release Candidate 3 -> Final");

db_connect();
db_select_db();

echo 'Upgrading from 2.0.0 Release Candidate 3 to 2.0.0 Final<br />';
	
if (!$_REQUEST['op'])
{
	echo 'Step 1: Altering database<br /><br />';
	db_query("alter table config modify avatar_types text not null");
	db_query("alter table config modify attachment_types text not null");
	db_query("alter table config modify attachment_image_types text not null");
	redirect("u200.php?op=2&template_edit=$template_edit");
}
elseif ($_REQUEST['op']==2)
{
	echo 'Step 2: Setting up templates<br /><br />';
	
	if ($template_edit)
		$change = 'header';
	else
		$change = '';
	
	$delete = '';
	
	$new = '';
	
	$admin_change = 'header';

	$admin_delete = '';
	
	$admin_new = 'demo';
	
	db_query("truncate parsedtemplate");
	selective_import(1, $admin_new, $admin_change, $admin_delete);
	$query = db_query("select * from templateset where templatesetid>1");
	while ($tset = db_fetch_array($query))
		selective_import($tset['templatesetid'], $new, $change, $delete);
	
	db_query("update config set version='2.0.0'");
	redirect("upgrade.php");
}

print_footer();
?>