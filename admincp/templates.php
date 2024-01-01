<?php
/**************************************************
* Templates
* ---------
* Allows you to manage templates and template sets.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_templateset,delete_template,delete_templateset,delete_templateset_admin,delete_templateset_denied,demo,edit_template,edit_templateset,import_templateset,import_templateset_redirect,import_template_missing,invalid_template,invalid_templateset,replace_templates_redirect,revert_template,revert_templateset,revert_templateset_redirect,revert_template_redirect,templateset_choice,templateset_default_invalid,templateset_import_invalid,templates_category,templates_duplicate,templates_duplicate_templateset,templates_index,templates_missing,templates_separator,templates_template,templates_templateset_missing';
/**************************************************
* Global variable resetting                      */
unset($previous_category);
unset($template_categories);
unset($templates);
unset($templateset_name);
unset($templatesets);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$body = $_POST['body'];
$category = $_POST['category'];
$current_templateset = $_REQUEST['current_templateset'];
$id = $_REQUEST['id'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$replace = $_REQUEST['replace'];
$search = $_REQUEST['search'];
/*************************************************/

$pagetitle = 'Templates';

if($group['templates'])
{
	if ($op=='edit')
	{
		$template = db_fetch_array(db_query("select * from template where templateid='$id'"));
		$current_templateset = $template['templatesetid'];
	}
	if (!$current_templateset || ($current_templateset==1 && !$config['show_cptemplates']))
		$current_templateset = $style['templatesetid'];
	$search = stripslashes($search);
	$searchwords = rawurldecode($search);
	$search = urlencode($search);
	$searchterms = htmlspecialchars($searchwords);
	$searchwords = addslashes($searchwords);
	$query = db_query("select * from template where templatesetid='$current_templateset' and body like '%".escape_like($searchwords)."%' order by category asc, name asc");
	while ($template_result = db_fetch_array($query))
	{
		$template_result['name'] = str_replace('\'', '\\\'', $template_result['name']);
		$template_result['category'] = str_replace('\'', '\\\'', $template_result['category']);
		if ($template_result['category']==$previous_category)
		{
			if ($templates)
			{
				eval(store_template('templates_separator'));
				$templates .= $templates_separator;
			}
			eval(store_template('templates_template', '$template_name'));
			$templates .= $template_name;
		}
		else
		{
			if ($templates)
			{
				eval(store_template('templates_category'));
				$template_categories .= $templates_category;
			}
			eval(store_template('templates_template', '$template_name'));
			$templates = $template_name;
			$previous_category = $template_result['category'];
		}
	}
	eval(store_template('templates_category'));
	$template_categories .= $templates_category;
	if ($_POST['op']=='add')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if (($name = trim(htmlspecialchars($name))) && $body)
		{
			$category = htmlspecialchars($category);
			if ($duplicate = db_fetch_array($query = db_query("select templateid from template where name='$name' and templatesetid='$current_templateset'")))
				eval(get_template('templates_duplicate'));
			else
			{
				adminlog("Added template - <b>$name</b>");
				db_query("insert into template (name, category, body, templatesetid, custom, lastedit_username, lastedit_date) values ('$name', '$category', '$body', '$current_templateset', 1, '".addslashes($user['name'])."', $current_time)");
				$id = db_fetch_array(db_query("select templateid from template where name='$name' and templatesetid='$current_templateset'"));
				$id = $id['templateid'];
				$parsed_body = addslashes(parse_template(stripslashes($body)));
				db_query("insert into parsedtemplate (templateid, name, body, templatesetid) values ($id, '$name', '$parsed_body', '$current_templateset')");
				$search = urldecode($search);
				header("Location: templates.php?search=$search&current_templateset=$current_templateset");
			}
		}
		else
			eval(get_template('templates_missing'));
	}
	elseif ($op=='replace')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$current_templateset'")))
		{
			$replaceterms = htmlspecialchars(stripslashes($replace));
			$searchterms = urldecode($searchterms);
			$searchwords = addslashes(urldecode(stripslashes($searchwords)));
			adminlog("Replaced <b>$searchterms</b> with <b>$replaceterms</b> in template set <b>$templateset_result[name] ($templateset_result[templatesetid])</b>");
			$query = db_query("select * from template where templatesetid='$templateset_result[templatesetid]' and body like '%".escape_like($searchwords)."%'");
			while ($template = db_fetch_array($query))
			{
				$body = addslashes(preg_replace('/'.preg_quote(stripslashes($searchwords)).'/i', str_replace('$', '\$', $replace), $template['body']));
				db_query("update template set custom=1,lastedit_username='".addslashes($user['name'])."',lastedit_date=$current_time,body='$body' where templateid='$template[templateid]'");
				$parsed_body = addslashes(parse_template(stripslashes($body)));
				db_query("update parsedtemplate set body='$parsed_body' where templateid=$template[templateid]");
			}
			$redirect_url = "templates.php?current_templateset=$templateset_result[templatesetid]";
			eval(get_template('replace_templates_redirect'));
		}
		else
			eval(get_template('invalid_templateset'));
	}
	elseif ($op=='export')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$current_templateset'")))
		{
			adminlog("Exported template set - <b>$templateset_result[name] ($templateset_result[templatesetid])</b>");
			header('Cache-control: private');
			header('Content-Type: text/plain');
			header("Content-Disposition: attachment; filename=\"$templateset_result[name].dpt\"");
			$query = db_query("select * from template where templatesetid='$templateset_result[templatesetid]' order by templateid asc");
			$templates = array();
			while ($template_result = db_fetch_array($query))
			{
				$templates[$template_result['name']]['category'] = $template_result['category'];
				$template_result['body'] = str_replace("\r\n", "\n", $template_result['body']);
				$template_result['body'] = str_replace("\r", "\n", $template_result['body']);
				$templates[$template_result['name']]['body'] = $template_result['body'];
				$templates[$template_result['name']]['lastedit_username'] = $template_result['lastedit_username'];
				$templates[$template_result['name']]['lastedit_date'] = $template_result['lastedit_date'];
			}
			$store = serialize($templates);
			echo "<?php /*\n$store\n*/ ?>";
		}
		else
			eval(get_template('invalid_templateset'));
	}
	elseif ($op=='deleteset')
	{
		if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$current_templateset'")))
		{
			if ($templateset_result['templatesetid']==1)
				die(eval(get_template('delete_templateset_admin')));
			if (db_num_rows(db_query("select * from styleset where templatesetid='$templateset_result[templatesetid]'")))
				die(eval(get_template('delete_templateset_denied')));
			eval(get_template('delete_templateset'));
		}
		else
			eval(get_template('invalid_templateset'));
	}
	elseif ($_POST['op']=='dodeleteset')
	{
		if (!$templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$current_templateset'")))
			die(eval(get_template('invalid_templateset')));
		if ($templateset_result['templatesetid']==1)
			die(eval(get_template('delete_templateset_admin')));
		if (db_num_rows(db_query("select * from styleset where templatesetid='$templateset_result[templatesetid]'")))
			die(eval(get_template('delete_templateset_denied')));
		adminlog("Deleted template set - <b>$templateset_result[name] ($templateset_result[templatesetid])</b>");
		db_query("delete from parsedtemplate where templatesetid='$templateset_result[templatesetid]'");
		db_query("delete from template where templatesetid='$templateset_result[templatesetid]'");
		db_query("delete from templateset where templatesetid='$templateset_result[templatesetid]'");
		header('Location: templates.php');
	}
	elseif ($op=='revertset')
	{
		if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$current_templateset'")))
			eval(get_template('revert_templateset'));
		else
			eval(get_template('invalid_templateset'));
	}
	elseif ($op=='revert')
	{
		if ($template_result = db_fetch_array(db_query("select * from template where templateid='$id'".(!$config['show_cptemplates'] ? ' and templatesetid>1' : ''))))
			eval(get_template('revert_template'));
		else
			eval(get_template('invalid_template'));
	}
	elseif ($op=='addset')
	{
		$query = db_query('select * from templateset'.(!$config['show_cptemplates'] ? ' where templatesetid>1' : '').' order by name asc');
		while ($templateset_result = db_fetch_array($query))
		{
			if ($templateset_result['templatesetid']==$current_templateset)
				$selected = true;
			else
				$selected = false;
			eval(store_template('templateset_choice'));
			$templatesets .= $templateset_choice;
		}
		eval(get_template('add_templateset'));
	}
	elseif ($_POST['op']=='doaddset')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if (!$name = trim(htmlspecialchars($name)))
			die(eval(get_template('templates_templateset_missing')));
		if ($duplicate = db_fetch_array(db_query("select * from templateset where name='$name'")))
			die(eval(get_template('templates_duplicate_templateset')));
		
		if ($_POST['templateset_select']=='default')
		{
			if (!$templatesetid = import_templateset('../data/template.dpt.php', 0, $name))
				die(eval(get_template('templateset_default_invalid')));
		}
		elseif ($_POST['templateset_select']=='import')
		{
			if (!$templatesetid = import_templateset($_FILES['import']['tmp_name'], 0, $name))
				die(eval(get_template('templateset_import_invalid')));
		}
		elseif ($_POST['templateset_select']=='copy')
		{
			if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$_POST[templateset_copy]'".(!$config['show_cptemplates'] ? ' and templatesetid>1' : ''))))
			{
				db_query("insert into templateset (name) values ('$name')");
				$templateset_result = db_fetch_array(db_query('select * from templateset order by templatesetid desc limit 1'));
				$query = db_query("select * from template where templatesetid='$_POST[templateset_copy]'");
				while ($template_result = db_fetch_array($query))
				{
					$template_result['name'] = addslashes($template_result['name']);
					$parsed_body = addslashes(parse_template($template_result['body']));
					$template_result['body'] = addslashes($template_result['body']);
					$template_result['category'] = addslashes($template_result['category']);
					$template_result['lastedit_username'] = addslashes($template_result['lastedit_username']);
					db_query("insert into template (name, body, category, templatesetid, custom, lastedit_username, lastedit_date) values ('$template_result[name]', '$template_result[body]', '$template_result[category]', $templateset_result[templatesetid], $template_result[custom], '$template_result[lastedit_username]', '$template_result[lastedit_date]')");
					$id = db_fetch_array(db_query("select templateid from template where name='$template_result[name]' and templatesetid='$templateset_result[templatesetid]'"));
					$id = $id['templateid'];
					db_query("insert into parsedtemplate (templateid, name, body, templatesetid) values ($id, '$template_result[name]', '$parsed_body', '$templateset_result[templatesetid]')");
				}
				$templatesetid = $templateset_result['templatesetid'];
			}
			else
				die(eval(get_template('invalid_templateset')));
		}
		adminlog("Added template set - <b>$name ($templatesetid)</b>");
		$search = urldecode($search);
		header("Location: templates.php?current_templateset=$templatesetid&search=$search");
	}
	elseif ($op=='import')
	{
		$query = db_query('select * from templateset'.(!$config['show_cptemplates'] ? ' where templatesetid>1' : '').' order by name asc');
		while ($templateset_result = db_fetch_array($query))
		{
			if ($templateset_result['templatesetid']==$current_templateset)
			{
				$templateset_res = $templateset_result;
				$selected = true;
				eval(store_template('templateset_choice'));
				$templatesets .= $templateset_choice;
			}
			else
			{
				$selected = false;
				eval(store_template('templateset_choice'));
				$templatesets .= $templateset_choice;
				$templateset_choices .= $templateset_choice;
			}
		}
		if (!$templateset_res['templatesetid'])
			die(eval(get_template('invalid_templateset')));
		eval(get_template('import_templateset'));
	}
	elseif ($_POST['op']=='doimport')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$current_templateset'")))
		{
			if ($templateset_result['templatesetid']==1)
				$defaultpath = '../data/admin_template.dpt.php';
			else
				$defaultpath = '../data/template.dpt.php';
			if ($_POST['delete_old'])
			{
				db_query("delete from template where templatesetid=$templateset_result[templatesetid]");
				db_query("delete from parsedtemplate where templatesetid=$templateset_result[templatesetid]");
			}
			if ($_POST['templateset_select']=='default')
			{
				if (!$templatesetid = import_templateset($defaultpath, $templateset_result['templatesetid'], ''))
					die(eval(get_template('templateset_default_invalid')));
			}
			elseif ($_POST['templateset_select']=='import')
			{
				if (!$templatesetid = import_templateset($_FILES['import']['tmp_name'], $templateset_result['templatesetid'], ''))
					die(eval(get_template('templateset_import_invalid')));
			}
			elseif ($_POST['templateset_select']=='copy')
			{
				if ($templateset_copy = db_fetch_array(db_query("select * from templateset where templatesetid='$_POST[templateset_copy]'".(!$config['show_cptemplates'] ? ' and templatesetid>1' : ''))))
				{
					$query = db_query("select * from template where templatesetid='$templateset_result[templatesetid]'");
					$templatestr = array();
					while ($template = db_fetch_array($query))
						$templatestr[$template['name']] = true;
					if (!$dfp = fopen($defaultpath, 'r'))
						return false;
					$dcontents = trim(substr(fread($dfp, filesize($defaultpath)), 8, -5));
					fclose($dfp);
					$dcontents = str_replace("\r\n", "\n", $dcontents);
					$dcontents = str_replace("\r", "\n", $dcontents);
					$defaulttemplates = unserialize($dcontents);
					$query = db_query("select template.*,parsedtemplate.body as parsedbody from template,parsedtemplate where template.templateid=parsedtemplate.templateid and template.templatesetid=$templateset_copy[templatesetid] order by templatesetid asc");
					while ($template = db_fetch_array($query))
					{
						$name = $template['name'];
						$template['category'] = addslashes($template['category']);
						$template['body'] = addslashes($template['body']);
						$template['parsedbody'] = addslashes($template['parsedbody']);
						$template['lastedit_username'] = addslashes($template['lastedit_username']);
						$custom = 0;
						if (md5(addslashes($defaulttemplates[$name]['body']))!=md5($template['body']))
							$custom = 1;
						if (isset($templatestr[$name]))
						{
							$name = addslashes($name);
							db_query("update template set category='$template[category]',body='$template[body]',custom=$custom,lastedit_username='$template[lastedit_username]',lastedit_date='$template[lastedit_date]' where name='$name' and templatesetid='$templateset_result[templatesetid]'");
							db_query("update parsedtemplate set body='$template[parsedbody]' where name='$name' and templatesetid='$templateset_result[templatesetid]'");
						}
						else
						{
							$name = addslashes($name);
							db_query("insert into template (name, category, body, templatesetid, custom, lastedit_username, lastedit_date) values ('$name', '$template[category]', '$template[body]', '$templateset_result[templatesetid]', $custom, '$template[lastedit_username]', '$template[lastedit_date]')");
							$id = db_fetch_array(db_query("select templateid from template where name='$name' and templatesetid='$templateset_result[templatesetid]'"));
							$id = $id['templateid'];
							db_query("insert into parsedtemplate (templateid, name, body, templatesetid) values ($id, '$name', '$template[parsedbody]', '$templateset_result[templatesetid]')");
						}
					}
				}
				else
					die(eval(get_template('invalid_templateset')));
			}
			adminlog("Imported template set - <b>$templateset_result[name] ($templateset_result[templatesetid])</b>");
			$redirect_url = "templates.php?current_templateset=$templateset_result[templatesetid]&search=$search";
			eval(get_template('import_templateset_redirect'));
		}
		else
			eval(get_template('invalid_templateset'));
	}
	elseif ($_POST['op']=='dorevertset')
	{
		if ($templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$current_templateset'")))
		{
			adminlog("Reverted template set - <b>$templateset_result[templatesetid]</b>");
			if ($templateset_result['templatesetid']==1)
				$defaultpath = '../data/admin_template.dpt.php';
			else
				$defaultpath = '../data/template.dpt.php';
			if (!import_templateset($defaultpath, $templateset_result['templatesetid'], ''))
				die(eval(get_template('templateset_import_invalid')));
			$redirect_url = "templates.php?current_templateset=$templateset_result[templatesetid]&search=$search";
			eval(get_template('revert_templateset_redirect'));
		}
		else
			eval(get_template('invalid_templateset'));
	}
	elseif ($_POST['op']=='dorevert')
	{
		if ($template_result = db_fetch_array(db_query("select * from template where templateid='$id'".(!$config['show_cptemplates'] ? ' and templatesetid>1' : ''))))
		{
			adminlog("Reverted template - <b>$template_result[name] ($template_result[templateid])</b>");
			if ($template_result['templatesetid']==1)
				$defaultpath = '../data/admin_template.dpt.php';
			else
				$defaultpath = '../data/template.dpt.php';
			if (!$fp = fopen($defaultpath, 'r'))
				eval(get_template('templateset_import_invalid'));
			else
			{
				$contents = trim(dp_substr(fread($fp, filesize($defaultpath)), 8, -5));
				fclose($fp);
				$contents = str_replace("\r\n", "\n", $contents);
				$contents = str_replace("\r", "\n", $contents);
				$templates = unserialize($contents);
				if (isset($templates[$template_result['name']]))
				{
					$template['category'] = addslashes($templates[$template_result['name']]['category']);
					$template['parsed_body'] = addslashes(parse_template($templates[$template_result['name']]['body']));
					$template['body'] = addslashes($templates[$template_result['name']]['body']);
					$template['lastedit_username'] = addslashes($templates[$template_result['name']]['lastedit_username']);
					$template['lastedit_date'] = $templates[$template_result['name']]['lastedit_date'];
					db_query("update template set category='$template[category]',body='$template[body]',custom=0,lastedit_username='$template[lastedit_username]',lastedit_date='$template[lastedit_date]' where templateid='$template_result[templateid]'");
					db_query("update parsedtemplate set body='$template[parsed_body]' where templateid='$template_result[templateid]'");
					$redirect_url = "templates.php?current_templateset=$template_result[templatesetid]&search=$search";
					eval(get_template('revert_template_redirect'));
				}
				else
					eval(get_template('import_template_missing'));
			}
		}
		else
			eval(get_template('invalid_template'));
	}
	elseif ($op=='edit')
	{
		if (!$template['templateid'] || ($template['templatesetid']==1 && !$config['show_cptemplates']))
			die(eval(get_template('invalid_template')));
		adminlog("Edited template - <b>$template[name] ($template[templateid])</b>");
		$query = db_query('select * from templateset'.(!$config['show_cptemplates'] ? ' where templatesetid>1' : '').' order by name asc');
		while ($templateset_result = db_fetch_array($query))
		{
			$template_result['name'] = str_replace('\'', '\\\'', $template_result['name']);
			$template_result['category'] = str_replace('\'', '\\\'', $template_result['category']);
			if ($templateset_result['templatesetid']==$template['templatesetid'])
			{
				$selected = true;
				$templateset_name = str_replace('\'', '\\\'', $templateset_result['name']);
			}
			else
				$selected = false;
			eval(store_template('templateset_choice'));
			$templatesets .= $templateset_choice;
		}
		$template['name'] = htmlspecialchars($template['name']);
		$template['category'] = htmlspecialchars($template['category']);
		$template['body'] = htmlspecialchars($template['body']);
		$template['lastedit_date'] = time_adjust($template['lastedit_date'], $style['log_date_format']);
		eval(get_template('edit_template'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if (($name = trim(htmlspecialchars($name))) && $body)
		{
			if ($template = db_fetch_array(db_query("select * from template where templateid='$id'".(!$config['show_cptemplates'] ? ' and templatesetid>1' : ''))))
			{
				$category = trim(htmlspecialchars($category));
				if ($duplicate = db_fetch_array(db_query("select templateid from template where name='$name' and templateid!='$template[templateid]' and templatesetid='$template[templatesetid]'")))
					eval(get_template('templates_duplicate'));
				else
				{
					$parsed_body = addslashes(parse_template(stripslashes($body)));
					adminlog("Updated template - <b>$template[name] ($template[templateid])</b>");
					if ($body != $template['body'])
						db_query("update template set name='$name',category='$category',body='$body',custom=1,lastedit_username='".addslashes($user['name'])."',lastedit_date='$current_time' where templateid='$template[templateid]'");
					else
						db_query("update template set name='$name',category='$category',body='$body' where templateid='$template[templateid]'");
					db_query("update parsedtemplate set name='$name',body='$parsed_body' where templateid='$template[templateid]'");
					$search = urldecode($search);
					header("Location: templates.php?current_templateset=$template[templatesetid]&search=$search");
				}
			}
			else
				eval(get_template('invalid_template'));
		}
		else
			eval(get_template('templates_missing'));
	}
	elseif ($op=='editset')
	{
		$query = db_query('select * from templateset'.(!$config['show_cptemplates'] ? ' where templatesetid>1' : '').' order by name asc');
		while ($templateset_result = db_fetch_array($query))
		{
			if ($templateset_result['templatesetid']==$current_templateset)
			{
				$selected = true;
				$templateset_name = $templateset_result['name'];
				$templateset_res = $templateset_result;
			}
			else
				$selected = false;
			eval(store_template('templateset_choice'));
			$templatesets .= $templateset_choice;
		}
		if (!$templateset_res['templatesetid'])
			die(eval(get_template('invalid_templateset')));
		adminlog("Edited template set - <b>$templateset_res[name] ($templateset_res[templatesetid])</b>");
		$templateset_res['name'] = htmlspecialchars($templateset_res['name']);
		eval(get_template('edit_templateset'));
	}
	elseif ($_POST['op']=='doeditset')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if (!$templateset_result = db_fetch_array(db_query("select * from templateset where templatesetid='$current_templateset'")))
				die(eval(get_template('invalid_templateset')));
			if ($duplicate = db_fetch_array(db_query("select templatesetid from templateset where name='$name' and templatesetid!='$current_templateset'")))
				eval(get_template('templates_duplicate_templateset'));
			else
			{
				adminlog("Updated template set - <b>$templateset_result[name] ($templateset_result[templatesetid])</b>");
				db_query("update templateset set name='$name' where templatesetid='$templateset_result[templatesetid]'");
				$search = urldecode($search);
				header("Location: templates.php?current_templateset=$templateset_result[templatesetid]&search=$search");
			}
		}
		else
			eval(get_template('templates_templateset_missing'));
	}
	elseif ($op=='delete')
	{
		if ($template_result = db_fetch_array(db_query("select * from template where templateid='$id'".(!$config['show_cptemplates'] ? ' and templatesetid>1' : ''))))
		{
			$current_templateset = $template_result['templatesetid'];
			eval(get_template('delete_template'));
		}
		else
			eval(get_template('invalid_template'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if ($template_result = db_fetch_array(db_query("select * from template where templateid='$id'".(!$config['show_cptemplates'] ? ' and templatesetid>1' : ''))))
		{
			adminlog("Deleted template - <b>$template_result[name] ($template_result[templateid])</b>");
			db_query("delete from template where templateid='$template_result[templateid]'");
			db_query("delete from parsedtemplate where templateid='$template_result[templateid]'");
			$search = urldecode($search);
			header("Location: templates.php?search=$search&current_templateset=$template_result[templatesetid]");
		}
		else
			eval(get_template('invalid_template'));
	}
	else
	{
		adminlog('Viewed templates panel');
		$query = db_query('select * from templateset'.(!$config['show_cptemplates'] ? ' where templatesetid>1' : '').' order by name asc');
		while ($templateset_result = db_fetch_array($query))
		{
			$template_result['name'] = str_replace('\'', '\\\'', $template_result['name']);
			$template_result['category'] = str_replace('\'', '\\\'', $template_result['category']);
			if ($templateset_result['templatesetid']==$current_templateset)
			{
				$selected = true;
				$templateset_name = str_replace('\'', '\\\'', $templateset_result['name']);
			}
			else
				$selected = false;
			eval(store_template('templateset_choice'));
			$templatesets .= $templateset_choice;
		}
		if (!$templateset_name)
			die(eval(get_template('invalid_templateset')));
		eval(get_template('templates_index'));
	}
}
else
	eval(get_template('permission_error'));
?>