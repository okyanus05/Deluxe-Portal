<?php
/**************************************************
* Main index
* ----------
* Displays articles and headlines.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'main_article,main_date,main_headline,main_index';
/**************************************************
* Global variable resetting                      */
unset($articles);
unset($headlines);
unset($topicquery);
/*************************************************/

require('function.php');
require('sidebar.php');

$query = db_query("select * from topicpermissions where ($groupquery) and view=1");
while ($perm = db_fetch_array($query))
{
	if ($topicquery)
		$topicquery .= " or topic.topicid=$perm[topicid]";
	else
		$topicquery = " and (topic.topicid=$perm[topicid]";
}
if ($topicquery)
	$topicquery .= ')';

if ($topicquery)
{
	$query = db_query("select * from article,topic where article.topicid>0 and article.topicid=topic.topicid$topicquery order by articleid desc limit $config[num_frontpage_articles]");
	while ($article = db_fetch_array($query))
	{
		if ($config['headlines'])
		{
			eval(store_template('main_headline'));
			if ($headlines)
				$headlines .= $main_headline;
			else
				$headlines = $main_headline;
		}
		if ($article['threadid'])
			$link = "thread.php?id=$article[threadid]";
		else
			$link = "article.php?id=$article[articleid]";
		$readmore = false;
		if ($extended_body = stristr($article['body'], '[page /]'))
		{
			$article['body'] = str_replace($extended_body, '', $article['body']);
			$readmore = true;
		}
		$article['date_posted'] = time_adjust($article['posted'], $style['frontpage_date_format']);
		$article['parsed_image'] = parse_image($article['image']);
		if ($article['dpcode'])
			$article['body'] = dpcode_parse($article['body'], true);
		if ($article['smilies'])
			$article['body'] = smilie_parse($article['body']);
		
		eval(store_template('main_article'));
		$articles_array[strtotime(time_adjust($article['posted'], 'd F Y'))][] = $main_article;
	}
	$articles = '';
	if ($articles_array)
	{
		foreach ($articles_array as $articles_date => $date_articles)
		{
			$date['articles'] = '';
			foreach ($date_articles as $article)
				$date['articles'] .= $article;
			$date['articles_date'] = time_adjust($articles_date - get_offset(), $style['frontpage_day_date_format']);
			eval(store_template('main_date'));
			$articles .= $main_date;
		}
	}
}
$pagetitle = 'Main page';
eval(get_template('main_index'));
?>