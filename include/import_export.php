<?php
/**************************************************
* Import/Export API
* -----------------
* import_templateset($url, $templatesetid, $name)
* import_style($url, $styleid, $name)
* 
* Deluxe Portal Version 2.0
**************************************************/

function import_templateset($url, $templatesetid, $name)
{
	if (!$fp = fopen($url, 'r'))
		return false;
	if ($templatesetid==1)
		$defaultpath = '../data/admin_template.dpt.php';
	else
		$defaultpath = '../data/template.dpt.php';
	$contents = trim(substr(fread($fp, filesize($url)), 8, -5));
	fclose($fp);
	$contents = str_replace("\r\n", "\n", $contents);
	$contents = str_replace("\r", "\n", $contents);
	$templates = unserialize($contents);
	if (!$templatesetid)
	{
		db_query("insert into templateset (name) values ('$name')");
		$templateset_result = db_fetch_array(db_query('select templatesetid from templateset order by templatesetid desc limit 1'));
		$templatesetid = $templateset_result['templatesetid'];
	}
	$query = db_query("select * from template where templatesetid='$templatesetid'");
	$templatestore = array();
	while ($template = db_fetch_array($query))
		$templatestore[$template['name']] = true;
	if ($url!=$defaultpath)
	{
		if (!$dfp = fopen($defaultpath, 'r'))
			return false;
		$dcontents = trim(substr(fread($dfp, filesize($defaultpath)), 8, -5));
		fclose($dfp);
		$dcontents = str_replace("\r\n", "\n", $dcontents);
		$dcontents = str_replace("\r", "\n", $dcontents);
		$defaulttemplates = unserialize($dcontents);
	}
	db_query("update template set custom=1 where templatesetid='$templatesetid'");
	foreach ($templates as $name => $template)
	{
		$template['category'] = addslashes($template['category']);
		$parsed_template = addslashes(parse_template($template['body']));
		$template['body'] = addslashes($template['body']);
		$template['lastedit_username'] = addslashes($template['lastedit_username']);
		$custom = 0;
		if ($url!=$defaultpath && md5(addslashes($defaulttemplates[$name]['body']))!=md5($template['body']))
			$custom = 1;
		if (isset($templatestore[$name]))
		{
			$name = addslashes($name);
			db_query("update template set category='$template[category]',body='$template[body]',custom=$custom,lastedit_username='$template[lastedit_username]',lastedit_date='$template[lastedit_date]' where name='$name' and templatesetid='$templatesetid'");
			db_query("update parsedtemplate set body='$parsed_template' where name='$name' and templatesetid='$templatesetid'");
		}
		else
		{
			$name = addslashes($name);
			db_query("insert into template (name, category, body, templatesetid, custom, lastedit_username, lastedit_date) values ('$name', '$template[category]', '$template[body]', '$templatesetid', $custom, '$template[lastedit_username]', '$template[lastedit_date]')");
			$id = db_insert_id();
			db_query("insert into parsedtemplate (templateid, name, body, templatesetid) values ('$id', '$name', '$parsed_template', '$templatesetid')");
		}
	}
	return $templatesetid;
}

function import_style($url, $styleid, $name)
{
	if (!($content = file_get_contents($url)))
		return false;
	$style = unserialize(base64_decode(substr($content, 41, -6)));
	if (!$style['version'])
		$style['version'] = "2.0.0 Beta 4";

	$columns_query = db_query("show columns from stylecss");
	$columns = array();
	while ($column = db_fetch_array($columns_query))
		$columns[] = $column['Field'];

	if (!$styleid)
	{
		db_query("insert into style (extra, name, wysiwygcss) values ('$style[extra]', '$name', '$style[wysiwygcss]')");
		$styleid = db_insert_id();
	}
	else
		db_query("update style set extra='$style[extra]',wysiwygcss='$style[wysiwygcss]' where styleid='$styleid'");
	db_query("delete from stylecss where styleid='$styleid'");

	foreach ($style['css'] as $stylecss_result)
	{
		$columns_string = '';
		$values_string = '';
		foreach ($columns as $column_name)
		{
			if (isset($stylecss_result[$column_name]) && $column_name!='styleid' && $column_name!='selectorid')
			{
				if ($style['version']=='2.0.0 Beta 4' && $column_name=='selector')
				{
					if ($stylecss_result[$column_name]=='.cellmain')
						$stylecss_result[$column_name] = '.cellmain, .cellmain td, .cellmain th, .cellalt .cellmain';
					if ($stylecss_result[$column_name]=='.cellalt')
						$stylecss_result[$column_name] = '.cellalt, .cellalt td, .cellalt th, .cellmain .cellalt';
					if ($stylecss_result[$column_name]=='.heading')
						$stylecss_result[$column_name] = '.heading, .cellmain .heading, .cellalt .heading';
					if ($stylecss_result[$column_name]=='.tableheader')
						$stylecss_result[$column_name] = '.tableheader, .cellmain .tableheader, .cellalt .tableheader';
					if ($stylecss_result[$column_name]=='.tableline')
						$stylecss_result[$column_name] = '.tableline, .cellmain .tableline, .cellalt .tableline';
					if ($stylecss_result[$column_name]=='.small')
						$stylecss_result[$column_name] = '.small, .cellmain .small, .cellalt .small';
				}
				if (($style['version']=='2.0.0 RC 1' || $style['version']=='2.0.0 Beta 4') && $column_name=='selector' && $stylecss_result[$column_name]=='select')
					$stylecss_result[$column_name] = 'select, optgroup';
				$columns_string .= "`$column_name`,";
				$values_string .= "'{$stylecss_result[$column_name]}',";
			}
		}
		$columns_string .= "`styleid`";
		$values_string .= $styleid;
		db_query("insert into stylecss ($columns_string) values ($values_string)");
	}

	return $styleid;
}
?>