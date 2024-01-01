<?php
require ('functions.php');
print_header("Deluxe Portal 2.0 Release Candidate 2 -> Release Candidate 3");

db_connect();
db_select_db();

echo 'Upgrading from 2.0.0 Release Candidate 2 to 2.0.0 Release Candidate 3<br />';
	
if (!$_REQUEST['op'])
{
	echo 'Step 1: Altering database<br /><br />';
	db_query("alter table user add lastpost int unsigned not null");
	db_query("update faqitem set content='WYSIWYG, or What You See Is What You Get, is an exciting new way of posting. Instead of having to use a boring old text box to type your posts into, and having to type out DP Code tags to provide formatting, the new WYSIWYG input control allows you to post as if you were using a program such as Microsoft Word. Want to make text bold? Just click the <b>B</b> (bold) icon in the toolbar. Same goes for smilies. Once you see WYSIWYG, you won\'t want to post any other way!\n\nWYSIWYG only works in Internet Explorer 6.0 or higher for Windows, and Mozilla 1.3 or higher across any platform. If WYSIWYG works on your computer, you will see a box below, with a toolbar directly above it. Try it out!<br /><br />\n<form action=\"faq.php\" method=\"post\">\n<div class=\"center\">\n<script type=\"text/javascript\">\n<!--\ndocument.write(\'<div style=\"display:none\" id=\"messageDiv\"><iframe id=\"messageIframe\"></iframe></div>\');\n//-->\n</script>\n<textarea name=\"message\" id=\"message\" rows=\"10\" cols=\"80\"></textarea></div>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg.js\"></script>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg_en.js\"></script>\n<script type=\"text/javascript\" src=\"javascript/wysiwyg_dialog.js\"></script>\n<script type=\"text/javascript\">\n<!--\ngenerate_wysiwyg(\'message\');\n-->\n</script>\n</form>' where name='What is WYSIWYG?'");
	db_query("update user set lastpost=0");
	redirect("u200rc3.php?op=2&template_edit=$template_edit");
}
elseif ($_REQUEST['op']==2)
{
	echo 'Step 2: Setting up templates<br /><br />';
	
	if ($template_edit)
		$change = 'footer,register_account,editoptions_index';
	else
		$change = '';
	
	$delete = '';
	
	$new = '';
	
	$admin_change = 'edit_user,add_user,maintenance_index,view_user';

	$admin_delete = '';
	
	$admin_new = 'maintenance_lastpost';
	
	db_query("truncate parsedtemplate");
	selective_import(1, $admin_new, $admin_change, $admin_delete);
	$query = db_query("select * from templateset where templatesetid>1");
	while ($tset = db_fetch_array($query))
		selective_import($tset['templatesetid'], $new, $change, $delete);
	
	db_query("update config set version='2.0.0 RC 3'");
	redirect("upgrade.php");
}

print_footer();
?>