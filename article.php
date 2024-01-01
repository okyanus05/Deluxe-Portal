<?php
/**************************************************
* Article
* -------
* Displays an article.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'article_index,article_page,invalid_article';
/**************************************************
* Global variable resetting                      */
unset($article_pagenav);
unset($nextpage);
unset($numpages);
unset($pagearray);
unset($pagenav);
unset($pages);
unset($prevpage);
/*************************************************/
require('function.php');
require('sidebar.php');
/**************************************************
* Variable initialization                        */
$page = $_REQUEST['page'];
/*************************************************/

if ($article = db_fetch_array(db_query("select * from article where articleid='$_REQUEST[id]'")))
{
	if (($article['topicid'] && $perm = db_fetch_array(db_query("select sum(editown) as editown,sum(editothers) as editothers,sum(deleteown) as deleteown,sum(deleteothers) as deleteothers,view from topicpermissions where ($groupquery) and view=1 and topicid=$article[topicid] group by topicid"))) || ($article['sectionid'] && $perm = db_fetch_array(db_query("select sum(editown) as editown,sum(editothers) as editothers,sum(deleteown) as deleteown,sum(deleteothers) as deleteothers,view from sectionpermissions where ($groupquery) and view=1 and sectionid=$article[sectionid] group by sectionid"))))
	{
		$pagetitle = $article['title'];
		if ($article['topicid'])
			$article['body'] = str_replace('[page /]', '', $article['body']);
		else
		{
			if (!is_numeric($page))
				$page = 1;
			$numpages = substr_count($article['body'], '[page=');
			if ($numpages>1)
			{
				if (preg_match_all('/\[page=(.*?) \/\]/', $article['body'], $pagearray))
				{
					$i = 0;
					while ($articlepage = $pagearray[1][$i++])
					{
						$articlepage = dp_htmlspecialchars($articlepage);
						eval(store_template('article_page'));
						$pages .= $article_page;
					}
				}
				$article['body'] = " $article[body]";
				for ($i=0; $i<$page; $i++)
					$article['body'] = strstr(dp_substr($article['body'], 1), '[page=');
				$article['body'] = preg_replace('/^\[page=.*? \/\]/', '', $article['body']);
				$article['body'] = preg_replace('/\[page=.*/', '', $article['body']);
				$article_pagenav = build_pagenav('article', $page, $numpages, $config['numlinks_articlenav'], "id=$article[articleid]");					
			}
		}
		$article['date_posted'] = time_adjust($article['posted'], $style['frontpage_date_format']);
		if ($article['dpcode'])
			$article['body'] = dpcode_parse($article['body'], 1);
		if ($article['smilies'])
			$article['body'] = smilie_parse($article['body']);
		if ($group['articles'] && ($perm['editothers'] || ($article['userid']==$user['userid'] && $perm['editown'])))
			$editlink = true;
		else
			$editlink = false;
		if ($group['articles'] && ($perm['deleteothers'] || ($article['userid']==$user['userid'] && $perm['deleteown'])))
			$deletelink = true;
		else
			$deletelink = false;
		eval(get_template('article_index'));
	}
	else
	{
		$pagetitle = 'Access denied';
		eval(get_template('permission_error'));
	}
}
else
{
	$pagetitle = 'Invalid article';
	eval(get_template('invalid_article'));
}
?>