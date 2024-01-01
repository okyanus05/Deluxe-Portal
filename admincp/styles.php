<?php
/**************************************************
* Styles
* ------
* Allows you to manage styles (colors, fonts, etc.)
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_style,delete_style,delete_style_denied,edit_style_redirect,invalid_style,revert_style,revert_style_redirect,styles_category,styles_category_link,styles_duplicate,styles_index,styles_missing,style_choice,style_default_invalid,style_import_invalid';
/**************************************************
* Global variable resetting                      */
unset($currentstyle);
unset($styles);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$current_style = $_REQUEST['current_style'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
/*************************************************/

$pagetitle = 'Styles';

if ($group['styles'])
{
	if (!is_numeric($current_style))
		$current_style = $style['styleid'];
	if ($_POST['op']=='doedit')
	{
		if (!$name = trim(htmlspecialchars($name)))
			die(eval(get_template('styles_missing')));
		if ($style_result = db_fetch_array(db_query("select * from style where styleid='$current_style'")))
		{
			if ($duplicate = db_fetch_array(db_query("select * from style where name='$name' and styleid!='$style_result[styleid]'")))
				die(eval(get_template('styles_duplicate')));
			adminlog("Updated style - <b>$style_result[name] ($style_result[styleid])</b>");
			db_query("update style set wysiwygcss='$_POST[wysiwygcss]',php_comment='$_POST[php_comment]',php_string='$_POST[php_string]',php_keyword='$_POST[php_keyword]',php_html='$_POST[php_html]',php_default='$_POST[php_default]',name='$name',extra='$_POST[extra]' where styleid='$style_result[styleid]'");
			$columns_query = db_query("show columns from stylecss");
			$columns = array();
			while ($column = db_fetch_array($columns_query))
				$columns[] = $column['Field'];
			$css_query = db_query("select * from stylecss where styleid='$current_style' order by ordered asc");
			while ($cat = db_fetch_array($css_query))
			{
				if (isset($_POST['category'.$cat['selectorid']]))
				{
					if (isset($_POST['category'.$cat['selectorid']]['verticalalign_value']) && $_POST['category'.$cat['selectorid']]['verticalalign']=="")
						$_POST['category'.$cat['selectorid']]['verticalalign'] = '{V}' . $_POST['category'.$cat['selectorid']]['verticalalign_value'];

					$query_string = '';
					foreach ($columns as $column)
					{
						if ($column!='selectorid' && $column!='ordered' && $column!='styleid' && $column!='selector' && $column!='name')
							$query_string .= "`$column`='".(isset($_POST['category'.$cat['selectorid']][$column]) ? $_POST['category'.$cat['selectorid']][$column] : '')."',";
					}
					if (strlen($query_string) and ($query_string = substr($query_string, 0, -1)))
						db_query("update stylecss set $query_string where selectorid=$cat[selectorid]");
				}
			}
			$redirect_url = "styles.php?current_style=$style_result[styleid]";
			eval(get_template('edit_style_redirect'));
		}
		else
			eval(get_template('invalid_style'));
	}
	elseif ($op=='delete')
	{
		
		if ($style_result = db_fetch_array(db_query("select * from style where styleid='$current_style'")))
		{
			if (db_num_rows(db_query("select * from styleset where styleid='$style_result[styleid]'")))
				die(eval(get_template('delete_style_denied')));
			eval(get_template('delete_style'));
		}
		else
			eval(get_template('invalid_style'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($style_result = db_fetch_array(db_query("select * from style where styleid='$current_style'")))
		{
			if (db_num_rows(db_query("select * from styleset where styleid='$style_result[styleid]'")))
				die(eval(get_template('delete_style_denied')));
			adminlog("Deleted style - <b>$style_result[name] ($style_result[styleid])</b>");
			db_query("delete from style where styleid='$style_result[styleid]'");
			db_query("delete from stylecss where styleid='$style_result[styleid]'");
			header('Location: styles.php');
		}
		else
			eval(get_template('invalid_style'));
	}
	elseif ($op=='add')
	{
		$query = db_query('select * from style order by name asc');
		while ($style_result = db_fetch_array($query))
		{
			if ($style_result['styleid']==$current_style)
			{
				$selected = true;
				$currentstyle = $style_result;
			}
			else
				$selected = false;
			eval(store_template('style_choice'));
			$styles .= $style_choice;
		}
		eval(get_template('add_style'));
	}
	elseif ($op=='revert')
	{
		if ($style_result = db_fetch_array(db_query("select * from style where styleid='$current_style'")))
			eval(get_template('revert_style'));
		else
			eval(get_template('invalid_style'));
	}
	elseif ($_POST['op']=='dorevert')
	{
		if (!$style_result = db_fetch_array(db_query("select * from style where styleid='$current_style'")))
			die(eval(get_template('invalid_style')));
		adminlog("Reverted style - <b>$style_result[name] ($style_result[styleid])</b>");
		if (!import_style('../data/style.dps.php', $style_result[styleid], ''))
			die(eval(get_template('style_import_invalid')));
		$redirect_url = "styles.php?current_style=$style_result[styleid]";
		eval(get_template('revert_style_redirect'));
	}
	elseif ($op=='export')
	{
		if ($style_result = db_fetch_array(db_query("select * from style where styleid='$current_style'")))
		{
			adminlog("Exported style - <b>$style_result[name] ($style_result[styleid])</b>");
			header('Cache-control: private');
			header('Content-Type: text/plain');
			header("Content-Disposition: attachment; filename=\"$style_result[name].dps\"");
			$style_result['version'] = $config['version'];
			$style_result['css'] = array();
			$stylecss_query = db_query("select * from stylecss where styleid='$current_style' order by ordered asc");
			while ($stylecss_result = db_fetch_array($stylecss_query))
				$style_result['css'][] = $stylecss_result;
			$content = trim(chunk_split(base64_encode(serialize(array_walk_multi($style_result, 'addslashes'))), 65, "\n"));
			die("<"."?php /*\nDELUXE PORTAL 2.0 STYLE EXPORT\n\n$content\n*/ ?".">");
		}
		else
			eval(get_template('invalid_style'));
	}
	elseif ($_POST['op']=='doadd')
	{
		if (!$name = trim(htmlspecialchars($name)))
			die(eval(get_template('styles_missing')));
		if ($duplicate = db_fetch_array(db_query("select * from style where name='$name'")))
			die(eval(get_template('styles_duplicate')));
		if ($_POST['style_select']=='default')
		{
			if (!$styleid = import_style('../data/style.dps.php', 0, $name))
				die(eval(get_template('style_default_invalid')));
		}
		elseif ($_POST['style_select']=='import')
		{
			if (!$styleid = import_style($_FILES['import']['tmp_name'], 0, $name))
				die(eval(get_template('style_import_invalid')));
		}
		elseif ($_POST['style_select']=='copy')
		{
			if ($style_result = db_fetch_array(db_query("select * from style where styleid='$_POST[style_copy]'")))
			{
				$style_result['extra'] = addslashes($style_result['extra']);
				$php_comment = addslashes($style_result['php_comment']);
				$php_default = addslashes($style_result['php_default']);
				$php_keyword = addslashes($style_result['php_keyword']);
				$php_string = addslashes($style_result['php_string']);
				$php_html = addslashes($style_result['php_html']);
				$wysiwygcss = addslashes($style_result['wyswiwygcss']);
				db_query("insert into style (wysiwygcss, php_comment, php_default, php_keyword, php_string, php_html, extra, name) values ('$wysiwygcss', '$php_comment', '$php_default', '$php_keyword', '$php_string', '$php_html', '$style_result[extra]', '$name')");
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
		adminlog('Added style - <b>' . stripslashes($name) . '</b>');
		header("Location: styles.php?current_style=$styleid");
	}
	else
	{
		adminlog('Viewed styles panel');
		$query = db_query('select * from style order by name asc');
		while ($style_result = db_fetch_array($query))
		{
			if ($style_result['styleid']==$current_style)
			{
				$selected = true;
				$currentstyle = $style_result;
			}
			else
				$selected = false;
			eval(store_template('style_choice'));
			$styles .= $style_choice;
		}
		if (!$currentstyle)
			die(eval(get_template('invalid_style')));
		array_walk_multi($currentstyle, 'htmlspecialchars');
		$query = db_query("select * from stylecss where styleid=$currentstyle[styleid] order by ordered asc");
		$links = $categories = '';
		$i = 0;
		while ($cat = db_fetch_array($query))
		{
			if ($i==0)
				$first_id = $cat['selectorid'];
			else
				$not_first = true;
			if (substr($cat['verticalalign'], 0, 3)=='{V}')
			{
				$cat['verticalalign_value'] = substr($cat['verticalalign'], 3);
				$cat['verticalalign'] = 'value';
			}
			eval(store_template('styles_category_link'));
			eval(store_template('styles_category'));
			$categories .= $styles_category;
			$links .= $styles_category_link;
			$i++;
		}
		eval(get_template('styles_index'));
	}
}
else
	eval(get_template('permission_error'));
?>