<?php
/**************************************************
* FAQ Manager
* -----------
* Allows you to add new FAQs, and manage existing
* FAQs.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_faq,add_faq_category,add_faq_item,delete_faq,delete_faq_category,delete_faq_item,demo,edit_faq,edit_faq_category,edit_faq_item,faqmanager_category,faqmanager_duplicate,faqmanager_faq,faqmanager_index,faqmanager_item,faqmanager_missing,faqmanager_missing_category,faqmanager_missing_item,faq_choice,invalid_faq,invalid_faq_category,invalid_faq_item';

require('../function.php');

$pagetitle = 'FAQ Manager';

if($group['faq'])
{
	if ($_REQUEST['op']=='addfaq')
		eval(get_template('add_faq'));
	elseif ($_POST['op']=='doaddfaq')
	{
		if (($name = trim(htmlspecialchars($_POST['name']))) && ($shortname = trim(htmlspecialchars($_POST['shortname']))))
		{
			if ($duplicate = db_fetch_array(db_query("select * from faq where shortname='$shortname'")))
				eval(get_template('faqmanager_duplicate'));
			else
			{
				adminlog("Added FAQ - <b>$name</b>");
				db_query("insert into faq (name, shortname, tree) values ('$name', '$shortname', '$_POST[tree]')");
				header('Location: faqmgr.php');
			}
		}
		else
			eval(get_template('faqmanager_missing'));
	}
	elseif ($_REQUEST['op']=='editfaq')
	{
		if ($faq = db_fetch_array(db_query("select * from faq where faqid='$_REQUEST[id]'")))
		{
			adminlog("Edited FAQ - <b>$faq[name] ($faq[faqid])</b>");
			eval(get_template('edit_faq'));
		}
		else
			eval(get_template('invalid_faq'));
	}
	elseif ($_POST['op']=='doeditfaq')
	{
		if ($faq = db_fetch_array(db_query("select * from faq where faqid='$_POST[id]'")))
		{
			if (($name = trim(htmlspecialchars($_POST['name']))) && ($shortname = trim(htmlspecialchars($_POST['shortname']))))
			{
				if ($duplicate = db_fetch_array(db_query("select * from faq where faqid!=$faq[faqid] and shortname='$shortname'")))
					eval(get_template('faqmanager_duplicate'));
				else
				{
					adminlog("Updated FAQ - <b>$faq[name] ($faq[faqid])</b>");
					db_query("update faq set name='$name',shortname='$shortname',tree='$_POST[tree]' where faqid=$faq[faqid]");
					header('Location: faqmgr.php');
				}
			}
			else
				eval(get_template('faqmanager_missing'));
		}
		else
			eval(get_template('invalid_faq'));
	}
	elseif ($_REQUEST['op']=='deletefaq')
	{
		if ($faq = db_fetch_array(db_query("select * from faq where faqid='$_REQUEST[id]'")))
			eval(get_template('delete_faq'));
		else
			eval(get_template('invalid_faq'));
	}
	elseif ($_POST['op']=='dodeletefaq')
	{
		if ($faq = db_fetch_array(db_query("select * from faq where faqid='$_POST[id]'")))
		{
			adminlog("Deleted FAQ - <b>$faq[name] ($faq[faqid])</b>");
			db_query("delete from faq where faqid=$faq[faqid]");
			$query = db_query("select faqcategoryid from faqcategory where faqid=$faq[faqid]");
			while ($category = db_fetch_array($query))
				db_query("delete from faqitem where faqcategoryid=$category[faqcategoryid]");
			db_query("delete from faqcategory where faqid=$faq[faqid]");
			header('Location: faqmgr.php');
		}
		else
			eval(get_template('invalid_faq'));
	}
	elseif ($_REQUEST['op']=='addcategory')
	{
		$query = db_query('select * from faq order by name asc');
		$faqs = '';
		while ($faq = db_fetch_array($query))
		{
			if ($_REQUEST['id']==$faq['faqid'])
				$selected = true;
			else
				$selected = false;
			eval(store_template('faq_choice'));
			$faqs .= $faq_choice;
		}
		eval(get_template('add_faq_category'));
	}
	elseif ($_POST['op']=='doaddcategory')
	{
		if ($name = trim(htmlspecialchars($_POST['name'])))
		{
			adminlog("Added FAQ category - <b>$name</b>");
			db_query("insert into faqcategory (name, ordered, faqid) values ('$name', '$_POST[ordered]', '$_POST[faqid]')");
			header('Location: faqmgr.php');
		}
		else
			eval(get_template('faqmanager_missing_category'));
	}
	elseif ($_REQUEST['op']=='editcategory')
	{
		if ($category = db_fetch_array(db_query("select * from faqcategory where faqcategoryid='$_REQUEST[id]'")))
		{
			adminlog("Edited FAQ category - <b>$category[name] ($category[faqcategoryid])</b>");
			$query = db_query('select * from faq order by name asc');
			$faqs = '';
			while ($faq = db_fetch_array($query))
			{
				if ($category['faqid']==$faq['faqid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('faq_choice'));
				$faqs .= $faq_choice;
			}
			eval(get_template('edit_faq_category'));
		}
		else
			eval(get_template('invalid_faq_category'));
	}
	elseif ($_POST['op']=='doeditcategory')
	{
		if ($category = db_fetch_array(db_query("select * from faqcategory where faqcategoryid='$_POST[id]'")))
		{
			if ($name = trim(htmlspecialchars($_POST['name'])))
			{
				adminlog("Updated FAQ category - <b>$category[name] ($category[faqcategoryid])</b>");
				db_query("update faqcategory set name='$name',faqid='$_POST[faqid]',ordered='$_POST[ordered]' where faqcategoryid=$category[faqcategoryid]");
				header('Location: faqmgr.php');
			}
			else
				eval(get_template('faqmanager_missing_category'));
		}
		else
			eval(get_template('invalid_faq_category'));
	}
	elseif ($_REQUEST['op']=='deletecategory')
	{
		if ($category = db_fetch_array(db_query("select * from faqcategory where faqcategoryid='$_REQUEST[id]'")))
			eval(get_template('delete_faq_category'));
		else
			eval(get_template('invalid_faq_category'));
	}
	elseif ($_POST['op']=='dodeletecategory')
	{
		if ($category = db_fetch_array(db_query("select * from faqcategory where faqcategoryid='$_POST[id]'")))
		{
			adminlog("Deleted FAQ category - <b>$category[name] ($category[faqcategoryid])</b>");
			db_query("delete from faqcategory where faqcategoryid=$category[faqcategoryid]");
			db_query("delete from faqitem where faqcategoryid=$category[faqcategoryid]");
			header('Location: faqmgr.php');
		}
		else
			eval(get_template('invalid_faq_category'));
	}
	elseif ($_REQUEST['op']=='additem')
	{
		$id = $_REQUEST['id'];
		eval(get_template('add_faq_item'));
	}
	elseif ($_POST['op']=='doadditem')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if (($name = trim(htmlspecialchars($_POST['name']))) && ($content = trim($_POST['content'])))
		{
			adminlog("Added FAQ item - <b>$name</b>");
			db_query("insert into faqitem (name, ordered, content, faqcategoryid) values ('$name', '$_POST[ordered]', '$content', '$_POST[id]')");
			header('Location: faqmgr.php');
		}
		else
			eval(get_template('faqmanager_missing_item'));
	}
	elseif ($_REQUEST['op']=='edititem')
	{
		if ($item = db_fetch_array(db_query("select * from faqitem where faqitemid='$_REQUEST[id]'")))
		{
			adminlog("Edited FAQ item - <b>$item[name] ($item[faqitemid])</b>");
			$item['content'] = htmlspecialchars($item['content']);
			eval(get_template('edit_faq_item'));
		}
		else
			eval(get_template('invalid_faq_item'));
	}
	elseif ($_POST['op']=='doedititem')
	{
		if ($demo_mode)
			die(eval(get_template('demo')));
		if ($item = db_fetch_array(db_query("select * from faqitem where faqitemid='$_POST[id]'")))
		{
			if (($name = trim(htmlspecialchars($_POST['name']))) && ($content = trim($_POST['content'])))
			{
				adminlog("Updated FAQ item - <b>$item[name] ($item[faqitemid])</b>");
				db_query("update faqitem set name='$name',content='$content',ordered='$_POST[ordered]' where faqitemid=$item[faqitemid]");
				header('Location: faqmgr.php');
			}
			else
				eval(get_template('faqmanager_missing_item'));
		}
		else
			eval(get_template('invalid_faq_item'));
	}
	elseif ($_REQUEST['op']=='deleteitem')
	{
		if ($item = db_fetch_array(db_query("select * from faqitem where faqitemid='$_REQUEST[id]'")))
			eval(get_template('delete_faq_item'));
		else
			eval(get_template('invalid_faq_item'));
	}
	elseif ($_POST['op']=='dodeleteitem')
	{
		if ($item = db_fetch_array(db_query("select * from faqitem where faqitemid='$_POST[id]'")))
		{
			adminlog("Deleted FAQ item - <b>$item[name] ($item[faqitemid])</b>");
			db_query("delete from faqitem where faqitemid=$item[faqitemid]");
			header('Location: faqmgr.php');
		}
		else
			eval(get_template('invalid_faq_item'));
	}
	else
	{
		$i = 0;
		$query = db_query('select * from faqcategory order by ordered asc');
		while ($category = db_fetch_array($query))
			$categorystore[$i++] = $category;
		$i = 0;
		$query = db_query('select * from faqitem order by ordered asc');
		while ($item = db_fetch_array($query))
			$itemstore[$i++] = $item;
		$faqs = '';
		$query = db_query('select * from faq order by name asc');
		while ($faq = db_fetch_array($query))
		{
			$faq['name'] = str_replace('\'', '\\\'', $faq['name']);
			$faq['shortname'] = str_replace('\'', '\\\'', $faq['shortname']);
			$categories = '';
			if ($categorystore)
			{
				foreach ($categorystore as $category)
				{
					if ($category['faqid']!=$faq['faqid'])
						continue;
					$category['name'] = str_replace('\'', '\\\'', $category['name']);
					$items = '';
					if ($itemstore)
					{
						foreach ($itemstore as $item)
						{
							if ($item['faqcategoryid']!=$category['faqcategoryid'])
								continue;
							$item['name'] = str_replace('\'', '\\\'', $item['name']);
							eval(store_template('faqmanager_item'));
							$items .= $faqmanager_item;
						}
					}
					eval(store_template('faqmanager_category'));
					$categories .= $faqmanager_category;
				}
			}
			if (!$categories)
				$categories = '[\'You have not yet added any categories\', null]';
			eval(store_template('faqmanager_faq'));
			$faqs .= $faqmanager_faq;
		}
		adminlog('Viewed FAQ Manager');
		eval(get_template('faqmanager_index'));
	}
}
else
	eval(get_template('permission_error'));
?>