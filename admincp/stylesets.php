<?php
/**************************************************
* Style Sets
* ----------
* Allows the management of style sets. You can also
* add and remove styles and template sets from
* here.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'delete_styleset,delete_styleset_denied,demo,edit_styleset,invalid_style,invalid_styleset,invalid_tempalteset,invalid_templateset,stylesets_duplicate,stylesets_duplicate_templateset,stylesets_index,stylesets_missing,stylesets_styleset,styles_duplicate,style_choice,style_default_invalid,style_import_invalid,templateset_choice,templateset_default_invalid,templateset_import_invalid,templates_duplicate_templateset';
/**************************************************
* Global variable resetting                      */
unset($styles);
unset($stylesets);
unset($templatesets);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$announcement_date_format = $_POST['announcement_date_format'];
$delete_style = $_POST['delete_style'];
$delete_templateset = $_POST['delete_templateset'];
$editedby_date_format = $_POST['editedby_date_format'];
$frontpage_date_format = $_POST['frontpage_date_format'];
$frontpage_day_date_format = $_POST['frontpage_day_date_format'];
$id = $_REQUEST['id'];
$images = $_POST['images'];
$join_date_format = $_POST['join_date_format'];
$join_post_date_format = $_POST['join_post_date_format'];
$lastpost_date_format = $_POST['lastpost_date_format'];
$log_date_format = $_POST['log_date_format'];
$logo = $_POST['logo'];
$most_online_date_format = $_POST['most_online_date_format'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$post_date_format = $_POST['post_date_format'];
$style_copy = $_POST['style_copy'];
$style_copy_name = $_POST['style_copy_name'];
$style_default_name = $_POST['style_default_name'];
$style_existing = $_POST['style_existing'];
$style_import_name = $_POST['style_import_name'];
$style_select = $_POST['style_select'];
$templateset_copy = $_POST['templateset_copy'];
$templateset_copy_name = $_POST['templateset_copy_name'];
$templateset_default_name = $_POST['templateset_default_name'];
$templateset_existing = $_POST['templateset_existing'];
$templateset_import_name = $_POST['templateset_import_name'];
$templateset_select = $_POST['templateset_select'];
$today_text = $_POST['today_text'];
$yesterday_text = $_POST['yesterday_text'];
$charset = htmlspecialchars($_POST['charset']);
/*************************************************/

$pagetitle = 'Style Sets';

if($group['stylesets'])
{
	if ($op=='add')
	{
		if (($name = htmlspecialchars(trim($name))) && ($today_text = htmlspecialchars(trim($today_text))) && ($yesterday_text = htmlspecialchars(trim($yesterday_text))) && ($logo = htmlspecialchars(trim($logo))) && ($images = htmlspecialchars(trim($images))) && ($frontpage_day_date_format = htmlspecialchars(trim($frontpage_day_date_format))) && ($frontpage_date_format = htmlspecialchars(trim($frontpage_date_format))) && ($lastpost_date_format = htmlspecialchars(trim($lastpost_date_format))) && ($join_post_date_format = htmlspecialchars(trim($join_post_date_format))) && ($post_date_format = htmlspecialchars(trim($post_date_format))) && ($join_date_format = htmlspecialchars(trim($join_date_format))) && ($editedby_date_format = htmlspecialchars(trim($editedby_date_format))) && ($most_online_date_format = htmlspecialchars(trim($most_online_date_format))) && (($style_select=='default' && ($style_default_name = htmlspecialchars(trim($style_default_name)))) || ($style_select=='copy' && $style_copy && ($style_copy_name = htmlspecialchars(trim($style_copy_name)))) || ($style_select=='existing' && $style_existing) || ($style_select=='import' && ($style_import_name = htmlspecialchars(trim($style_import_name))) && $_FILES['import']['tmp_name'])) && (($templateset_select=='default' && ($templateset_default_name = htmlspecialchars(trim($templateset_default_name)))) || ($templateset_select=='copy' && $templateset_copy && ($templateset_copy_name = htmlspecialchars(trim($templateset_copy_name)))) || ($templateset_select=='existing' && $templateset_existing) || ($templateset_select=='import' && ($templateset_import_name = htmlspecialchars(trim($templateset_import_name))) && $_FILES['import_template']['tmp_name'])))
		{
			if ($duplicate = db_fetch_array(db_query("select * from styleset where name='$name'")))
				die(eval(get_template('stylesets_duplicate')));
			
			if ($style_select=='default')
			{
				if (db_num_rows(db_query("select * from style where name='$style_default_name'")))
					die(eval(get_template('styles_duplicate')));
				if (!$styleid = import_style('../data/style.dps.php', 0, $style_default_name))
					die(eval(get_template('style_default_invalid')));
			}
			elseif ($style_select=='import')
			{
				if (db_num_rows(db_query("select * from style where name='$style_import_name'")))
					die(eval(get_template('styles_duplicate')));
				if (!$styleid = import_style($_FILES['import']['tmp_name'], 0, $style_import_name))
					die(eval(get_template('style_import_invalid')));
			}
			elseif ($style_select=='copy')
			{
				if (db_num_rows(db_query("select * from style where name='$style_copy_name'")))
					die(eval(get_template('styles_duplicate')));
				if ($style_result = db_fetch_array(db_query("select * from style where styleid='$style_copy'")))
				{
					$style_result['extra'] = addslashes($style_result['extra']);
					db_query("insert into style (extra, name) values ('$style_result[extra]', '$style_copy_name')");
					$styleid = db_insert_id();
	
					$columns_query = db_query("show columns from stylecss");
					$columns = array();
					while ($column = db_fetch_array($columns_query))
						$columns[] = $column['Field'];
	
					$query = db_query("select * from stylecss where styleid='$_POST[style_copy]' order by ordered asc");
					while ($stylecss_result = db_fetch_array($query))
					{
						$columns_string = '';
						$values_string = '';
						foreach ($columns as $column_name)
						{
							if (isset($stylecss_result[$column_name]) && $column_name!='styleid' && $column_name!='selectorid')
							{
								$columns_string .= "`$column_name`,";
								$values_string .= '\'' . addslashes($stylecss_result[$column_name]) . '\',';
							}
						}
						$columns_string .= "`styleid`";
						$values_string .= $styleid;
						db_query("insert into stylecss ($columns_string) values ($values_string)");
					}
				}
				else
					die(eval(get_template('invalid_style')));
			}
			elseif ($style_select=='existing')
			{
				if (db_num_rows(db_query("select styleid from style where styleid='$style_existing'")))
					$styleid = $style_existing;
				else
					die(eval(get_template('invalid_style')));
			}
			
			if ($templateset_select=='default')
			{
				if (db_num_rows(db_query("select * from templateset where name='$templateset_default_name'")))
					die(eval(get_template('templates_duplicate_templateset')));
				if (!$templatesetid = import_templateset('../data/template.dpt.php', 0, $templateset_default_name))
					die(eval(get_template('templateset_default_invalid')));
			}
			elseif ($templateset_select=='import')
			{
				if ($demo_mode)
					die(eval(get_template('demo')));
				if (db_num_rows(db_query("select * from templateset where name='$templateset_import_name'")))
					die(eval(get_template('templates_duplicate_templateset')));
				if (!$templatesetid = import_templateset($_FILES['import_template']['tmp_name'], 0, $templateset_import_name))
					die(eval(get_template('templateset_import_invalid')));
			}
			elseif ($templateset_select=='copy')
			{
				if (db_num_rows(db_query("select * from templateset where name='$templateset_copy_name'")))
					die(eval(get_template('templates_duplicate_templateset')));
				if ($duplicate = db_fetch_array(db_query("select * from templateset where name='$templateset_copy_name'")))
					die(eval(get_template('stylesets_duplicate_templateset')));
				if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$templateset_copy' and templatesetid!=1")))
				{
					db_query("insert into templateset (name) values ('$templateset_copy_name')");
					$templateset_result = db_fetch_array(db_query('select * from templateset order by templatesetid desc limit 1'));
					$query = db_query("select * from template where templatesetid='$templateset_copy'");
					while ($template_result = db_fetch_array($query))
					{
						$template_result['name'] = addslashes($template_result['name']);
						$template_result['body'] = addslashes($template_result['body']);
						$template_result['category'] = addslashes($template_result['category']);
						$template_result['lastedit_username'] = addslashes($template_result['lastedit_username']);
						db_query("insert into template (name, body, category, templatesetid, custom, lastedit_username, lastedit_date) values ('$template_result[name]', '$template_result[body]', '$template_result[category]', $templateset_result[templatesetid], $template_result[custom], '$template_result[lastedit_username]', '$template_result[lastedit_date]')");
					}
					$templatesetid = $templateset_result['templatesetid'];
				}
				else
					die(eval(get_template('invalid_templateset')));
			}
			elseif ($templateset_select=='existing')
			{
				if (db_num_rows(db_query("select templatesetid from templateset where templatesetid='$templateset_existing' and templatesetid!=1")))
					$templatesetid = $templateset_existing;
				else
					die(eval(get_template('invalid_templateset')));
			}
			adminlog("Added style set - <b>$name</b>");
			db_query("insert into styleset (name, `separator`, sidebar, cellspacing, cellpadding, frontpage_date_format, logo, lastpost_date_format, join_post_date_format, post_date_format, join_date_format, announcement_date_format, styleid, templatesetid, enabled, editedby_date_format, most_online_date_format, images, log_date_format, today_text, yesterday_text, frontpage_day_date_format, charset) values ('$name', '$_POST[separator]', '$_POST[sidebar]', '$_POST[cellspacing]', '$_POST[cellpadding]', '$frontpage_date_format', '$logo', '$lastpost_date_format', '$join_post_date_format', '$post_date_format', '$join_date_format', '$announcement_date_format', '$styleid', '$templatesetid', '$_POST[enabled]', '$editedby_date_format', '$most_online_date_format', '$images', '$log_date_format', '$today_text', '$yesterday_text', '$frontpage_day_date_format', '$charset')");
			header('Location: stylesets.php');
		}
		else
			eval(get_template('stylesets_missing'));
	}
	elseif ($op=='edit')
	{
		$query = db_query("select stylesetid,count(*) as counted from user group by stylesetid");
		while ($usercount = db_fetch_array($query))
			$users[$usercount['stylesetid']] = $usercount['counted'];
		$query = db_query('select * from styleset order by styleset.name asc');
		while ($styleset_result = db_fetch_array($query))
		{
			$number = isset($users[$styleset_result['stylesetid']]) ? $users[$styleset_result['stylesetid']] : 0;
			eval(store_template('stylesets_styleset'));
			$stylesets .= $stylesets_styleset;
		}
		if ($styleset_result = db_fetch_array(db_query("select * from styleset where stylesetid='$id'")))
		{
			adminlog("Edited style set - <b>$styleset_result[name] ($styleset_result[stylesetid])</b>");
			$query = db_query('select * from style order by name asc');
			while ($style_result = db_fetch_array($query))
			{
				if ($style_result['styleid']==$styleset_result['styleid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('style_choice'));
				$styles .= $style_choice;
			}
			$query = db_query('select * from templateset where templatesetid>1 order by name asc');
			while ($templateset_result = db_fetch_array($query))
			{
				if ($templateset_result['templatesetid']==$styleset_result['templatesetid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('templateset_choice'));
				$templatesets .= $templateset_choice;
			}
			eval(get_template('edit_styleset'));
		}
		else
			eval(get_template('invalid_styleset'));
	}
	elseif ($op=='doedit')
	{
		if (($name = htmlspecialchars(trim($name))) && ($today_text = htmlspecialchars(trim($today_text))) && ($yesterday_text = htmlspecialchars(trim($yesterday_text))) && ($logo = htmlspecialchars(trim($logo))) && ($images = htmlspecialchars(trim($images))) && ($frontpage_day_date_format = htmlspecialchars(trim($frontpage_day_date_format))) && ($frontpage_date_format = htmlspecialchars(trim($frontpage_date_format))) && ($lastpost_date_format = htmlspecialchars(trim($lastpost_date_format))) && ($join_post_date_format = htmlspecialchars(trim($join_post_date_format))) && ($post_date_format = htmlspecialchars(trim($post_date_format))) && ($join_date_format = htmlspecialchars(trim($join_date_format))) && ($editedby_date_format = htmlspecialchars(trim($editedby_date_format))) && ($most_online_date_format = htmlspecialchars(trim($most_online_date_format))) && (($style_select=='default' && ($style_default_name = htmlspecialchars(trim($style_default_name)))) || ($style_select=='copy' && $style_copy && ($style_copy_name = htmlspecialchars(trim($style_copy_name)))) || ($style_select=='existing' && $style_existing) || ($style_select=='import' && ($style_import_name = htmlspecialchars(trim($style_import_name))) && $_FILES['import']['tmp_name'])) && (($templateset_select=='default' && ($templateset_default_name = htmlspecialchars(trim($templateset_default_name)))) || ($templateset_select=='copy' && $templateset_copy && ($templateset_copy_name = htmlspecialchars(trim($templateset_copy_name)))) || ($templateset_select=='existing' && $templateset_existing) || ($templateset_select=='import' && ($templateset_import_name = htmlspecialchars(trim($templateset_import_name))) && $_FILES['import_template']['tmp_name'])))
		{
			if ($styleset_result = db_fetch_array(db_query("select * from styleset where stylesetid='$id'")))
			{
				if ($duplicate = db_fetch_array(db_query("select * from styleset where name='$name' and stylesetid!='$styleset_result[stylesetid]'")))
					die(eval(get_template('stylesets_duplicate')));
				
				if ($style_select=='default')
				{
					if (db_num_rows(db_query("select * from style where name='$style_default_name'")))
						die(eval(get_template('styles_duplicate')));
					if (!$styleid = import_style('../data/style.dps.php', 0, $style_default_name))
						die(eval(get_template('style_default_invalid')));
				}
				elseif ($style_select=='import')
				{
					if (db_num_rows(db_query("select * from style where name='$style_import_name'")))
						die(eval(get_template('styles_duplicate')));
					if (!$styleid = import_style($_FILES['import']['tmp_name'], 0, $style_import_name))
						die(eval(get_template('style_import_invalid')));
				}
				elseif ($style_select=='copy')
				{
					if (db_num_rows(db_query("select * from style where name='$style_copy_name'")))
						die(eval(get_template('styles_duplicate')));
					if ($style_result = db_fetch_array(db_query("select * from style where styleid='$style_copy'")))
					{
						$style_result['extra'] = addslashes($style_result['extra']);
						db_query("insert into style (extra, name) values ('$style_result[extra]', '$style_copy_name')");
						$styleid = db_insert_id();
		
						$columns_query = db_query("show columns from stylecss");
						$columns = array();
						while ($column = db_fetch_array($columns_query))
							$columns[] = $column['Field'];
		
						$query = db_query("select * from stylecss where styleid='$_POST[style_copy]' order by ordered asc");
						while ($stylecss_result = db_fetch_array($query))
						{
							$columns_string = '';
							$values_string = '';
							foreach ($columns as $column_name)
							{
								if (isset($stylecss_result[$column_name]) && $column_name!='styleid' && $column_name!='selectorid')
								{
									$columns_string .= "`$column_name`,";
									$values_string .= '\'' . addslashes($stylecss_result[$column_name]) . '\',';
								}
							}
							$columns_string .= "`styleid`";
							$values_string .= $styleid;
							db_query("insert into stylecss ($columns_string) values ($values_string)");
						}
					}
					else
						die(eval(get_template('invalid_style')));
				}
				elseif ($style_select=='existing')
				{
					if (db_num_rows(db_query("select styleid from style where styleid='$style_existing'")))
						$styleid = $style_existing;
					else
						die(eval(get_template('invalid_style')));
				}
				
				if ($templateset_select=='default')
				{
					if (db_num_rows(db_query("select * from templateset where name='$templateset_default_name'")))
						die(eval(get_template('templates_duplicate_templateset')));
					if (!$templatesetid = import_templateset('../data/template.dpt.php', 0, $templateset_default_name))
						die(eval(get_template('templateset_default_invalid')));
				}
				elseif ($templateset_select=='import')
				{
					if ($demo_mode)
						die(eval(get_template('demo')));
					if (db_num_rows(db_query("select * from templateset where name='$templateset_import_name'")))
						die(eval(get_template('templates_duplicate_templateset')));
					if (!$templatesetid = import_templateset($_FILES['import_template']['tmp_name'], 0, $templateset_import_name))
						die(eval(get_template('templateset_import_invalid')));
				}
				elseif ($templateset_select=='copy')
				{
					if (db_num_rows(db_query("select * from templateset where name='$templateset_copy_name'")))
						die(eval(get_template('templates_duplicate_templateset')));
					if ($duplicate = db_fetch_array(db_query("select * from templateset where name='$templateset_copy_name'")))
						die(eval(get_template('stylesets_duplicate_templateset')));
					if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$templateset_copy' and templatesetid!=1")))
					{
						db_query("insert into templateset (name) values ('$templateset_copy_name')");
						$templateset_result = db_fetch_array(db_query('select * from templateset order by templatesetid desc limit 1'));
						$query = db_query("select * from template where templatesetid='$templateset_copy'");
						while ($template_result = db_fetch_array($query))
						{
							$template_result['name'] = addslashes($template_result['name']);
							$template_result['body'] = addslashes($template_result['body']);
							$template_result['category'] = addslashes($template_result['category']);
							$template_result['lastedit_username'] = addslashes($template_result['lastedit_username']);
							db_query("insert into template (name, body, category, templatesetid, custom, lastedit_username, lastedit_date) values ('$template_result[name]', '$template_result[body]', '$template_result[category]', $templateset_result[templatesetid], $template_result[custom], '$template_result[lastedit_username]', '$template_result[lastedit_date]')");
						}
						$templatesetid = $templateset_result['templatesetid'];
					}
					else
						die(eval(get_template('invalid_templateset')));
				}
				elseif ($templateset_select=='existing')
				{
					if (db_num_rows(db_query("select templatesetid from templateset where templatesetid='$templateset_existing' and templatesetid!=1")))
						$templatesetid = $templateset_existing;
					else
						die(eval(get_template('invalid_tempalteset')));
				}
				adminlog("Updated style set - <b>$name ($styleset_result[stylesetid])</b>");
				db_query("update styleset set name='$name',frontpage_day_date_format='$frontpage_day_date_format',`separator`='$_POST[separator]',sidebar='$_POST[sidebar]',cellspacing='$_POST[cellspacing]',cellpadding='$_POST[cellpadding]',announcement_date_format='$announcement_date_format',log_date_format='$log_date_format',frontpage_date_format='$frontpage_date_format',logo='$logo',lastpost_date_format='$lastpost_date_format',join_post_date_format='$join_post_date_format',post_date_format='$post_date_format',join_date_format='$join_date_format',styleid='$styleid',templatesetid='$templatesetid',enabled='$_POST[enabled]',editedby_date_format='$editedby_date_format',most_online_date_format='$most_online_date_format',images='$images',today_text='$today_text',yesterday_text='$yesterday_text',charset='$charset' where stylesetid='$styleset_result[stylesetid]'");
				header('Location: stylesets.php');
			}
			else
				eval(get_template('invalid_styleset'));
		}
		else
			eval(get_template('stylesets_missing'));
	}
	elseif ($op=='delete')
	{
		if ($styleset_result = db_fetch_array(db_query("select * from styleset where stylesetid='$id'")))
		{
			if (db_num_rows(db_query("select * from config where guest_stylesetid='$styleset_result[stylesetid]' or default_styleset='$styleset_result[stylesetid]'")))
				die(eval(get_template('delete_styleset_denied')));
			$delete_style = false;
			$delete_templateset = false;
			if (!db_num_rows(db_query("select * from styleset where styleid=$styleset_result[styleid] and stylesetid!='$styleset_result[stylesetid]'")) && $style_result = db_fetch_array(db_query("select * from style where styleid=$styleset_result[styleid]")))
				$delete_style = true;
			if (!db_num_rows(db_query("select * from styleset where templatesetid=$styleset_result[templatesetid] and stylesetid!='$styleset_result[stylesetid]'")) && $templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid=$styleset_result[templatesetid]")))
				$delete_templateset = true;
			eval(get_template('delete_styleset'));
		}
		else
			eval(get_template('invalid_styleset'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($styleset_result = db_fetch_array(db_query("select * from styleset where stylesetid='$id'")))
		{
			if (db_num_rows(db_query("select * from config where guest_stylesetid='$styleset_result[stylesetid]' or default_styleset='$styleset_result[stylesetid]'")))
				die(eval(get_template('delete_styleset_denied')));
			adminlog("Deleted style set - <b>$styleset_result[name] ($styleset_result[stylesetid])</b>");
			if (!db_num_rows(db_query("select * from styleset where styleid=$styleset_result[styleid] and stylesetid!='$styleset_result[stylesetid]'")) && $delete_style)
			{
				db_query("delete from style where styleid=$styleset_result[styleid]");
				db_query("delete from stylecss where styleid=$styleset_result[styleid]");
			}
			if (!db_num_rows(db_query("select * from styleset where templatesetid=$styleset_result[templatesetid] and stylesetid!='$styleset_result[stylesetid]'")) && $delete_templateset)
			{
				db_query("delete from template where templatesetid=$styleset_result[templatesetid]");
				db_query("delete from templateset where templatesetid=$styleset_result[templatesetid]");
			}
			db_query("update user set stylesetid=$config[default_styleset] where stylesetid='$styleset_result[stylesetid]'");
			db_query("delete from styleset where stylesetid='$styleset_result[stylesetid]'");
			header('Location: stylesets.php');
		}
		else
			eval(get_template('invalid_styleset'));
	}
	else
	{
		$selected = false;
		adminlog('Viewed style sets panel');
		$query = db_query("select stylesetid,count(*) as counted from user group by stylesetid");
		while ($usercount = db_fetch_array($query))
			$users[$usercount['stylesetid']] = $usercount['counted'];
		$query = db_query('select * from styleset order by styleset.name asc');
		while ($styleset_result = db_fetch_array($query))
		{
			$number = isset($users[$styleset_result['stylesetid']]) ? $users[$styleset_result['stylesetid']] : 0;
			eval(store_template('stylesets_styleset'));
			$stylesets .= $stylesets_styleset;
		}
		$query = db_query('select * from style order by name asc');
		while ($style_result = db_fetch_array($query))
		{
			eval(store_template('style_choice'));
			$styles .= $style_choice;
		}
		$query = db_query('select * from templateset where templatesetid!=1 order by name asc');
		while ($templateset_result = db_fetch_array($query))
		{
			eval(store_template('templateset_choice'));
			$templatesets .= $templateset_choice;
		}
		eval(get_template('stylesets_index'));
	}
}
else
	eval(get_template('permission_error'));
?>