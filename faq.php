<?php
/**************************************************
* FAQ Viewer
* ----------
* Displays frequently asked questions and answers.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'faq_category,faq_category_tree,faq_index,faq_index_tree,faq_item,faq_item_contents,faq_item_tree,faq_show_category,faq_show_category_tree,faq_toc,invalid_faq';

require('function.php');

if ($faq = db_fetch_array(db_query("select * from faq where shortname='$_REQUEST[faq]'")))
{
	if (($_REQUEST['id'] && $category = db_fetch_array(db_query("select * from faqcategory where faqcategoryid='$_REQUEST[id]'"))) || ($_REQUEST['category'] && $category = db_fetch_array(db_query('select * from faqcategory where name=\''.urldecode($_REQUEST['category']).'\''))))
	{
		if ($faq['tree'])
		{
			$oldcategory = $category;
			$i = 0;
			$query = db_query('select * from faqitem order by ordered asc');
			while ($item = db_fetch_array($query))
				$itemstore[$i++] = $item;
			$query = db_query("select * from faqcategory where faqid=$faq[faqid] order by ordered asc");
			$categories = '';
			while ($category = db_fetch_array($query))
			{
				$items = '';
				if ($itemstore)
				{
					foreach ($itemstore as $item)
					{
						if ($item['faqcategoryid']!=$category['faqcategoryid'])
							continue;
						$item['anchor'] = preg_replace('/[^A-Za-z0-9\-_\:\.]/', '', str_replace(' ', '_', $item['name']));
						$item['name'] = str_replace('\'', '\\\'', $item['name']);
						eval(store_template('faq_item_tree'));
						$items .= $faq_item_tree;
					}
				}
				$category['name'] = str_replace('\'', '\\\'', $category['name']);
				eval(store_template('faq_category_tree'));
				$categories .= $faq_category_tree;
			}
			$category = $oldcategory;
			$items = '';
			if ($itemstore)
			{
				foreach ($itemstore as $item)
				{
					if ($item['faqcategoryid']!=$category['faqcategoryid'])
						continue;
					$item['anchor'] = preg_replace('/[^A-Za-z0-9\-_\:\.]/', '', str_replace(' ', '_', $item['name']));
					$templatestore['DP_FAQITEM'] = parse_template($item['content']);
					eval(store_template('DP_FAQITEM', '$item[content]'));
					eval(store_template('faq_item_contents'));
					$items .= $faq_item_contents;
				}
			}
			$pagetitle = "$faq[name] - $category[name]";
			$faq['tree_name'] = str_replace('\'', '\\\'', $faq['name']);
			eval(get_template('faq_show_category_tree'));
		}
		else
		{
			$query = db_query("select * from faqitem where faqcategoryid=$category[faqcategoryid] order by ordered asc");
			$toc = '';
			$items = '';
			while ($item = db_fetch_array($query))
			{
				$templatestore['DP_FAQITEM'] = parse_template($item['content']);
				eval(store_template('DP_FAQITEM', '$item[content]'));
				eval(store_template('faq_toc'));
				$toc .= $faq_toc;
				$item['anchor'] = preg_replace('/[^A-Za-z0-9\-_\:\.]/', '', str_replace(' ', '_', $item['name']));
				eval(store_template('faq_item_contents'));
				$items .= $faq_item_contents;
			}
			$pagetitle = "$faq[name] - $category[name]";
			eval(get_template('faq_show_category'));
		}
	}
	else
	{
		$i = 0;
		$query = db_query('select * from faqitem order by ordered asc');
		while ($item = db_fetch_array($query))
			$itemstore[$i++] = $item;
		$query = db_query("select * from faqcategory where faqid=$faq[faqid] order by ordered asc");
		$categories = '';
		$pagetitle = $faq['name'];
		
		if ($faq['tree'])
		{
			while ($category = db_fetch_array($query))
			{
				$items = '';
				if ($itemstore)
				{
					foreach ($itemstore as $item)
					{
						if ($item['faqcategoryid']!=$category['faqcategoryid'])
							continue;
						$item['name'] = str_replace('\'', '\\\'', $item['name']);
						eval(store_template('faq_item_tree'));
						$items .= $faq_item_tree;
					}
				}
				$category['name'] = str_replace('\'', '\\\'', $category['name']);
				eval(store_template('faq_category_tree'));
				$categories .= $faq_category_tree;
			}
			$pagetitle = $faq['name'];
			$faq['tree_name'] = str_replace('\'', '\\\'', $faq['name']);
			eval(get_template('faq_index_tree'));
		}
		else
		{
			while ($category = db_fetch_array($query))
			{
				$items = '';
				if ($itemstore)
				{
					foreach ($itemstore as $item)
					{
						if ($item['faqcategoryid']!=$category['faqcategoryid'])
							continue;
						eval(store_template('faq_item'));
						$items .= $faq_item;
					}
				}
				eval(store_template('faq_category'));
				$categories .= $faq_category;
			}
			$pagetitle = $faq['name'];
			eval(get_template('faq_index'));
		}
	}
}
else
{
	$pagetitle = 'Invalid FAQ';
	eval(get_template('invalid_faq'));
}
?>