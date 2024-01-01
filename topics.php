<?php
/**************************************************
* Topics
* ------
* Shows a list of topics, or displays a topic.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_topic,topic_article,topic_index,topic_row,topic_showtopic,topic_topic';
/**************************************************
* Global variable resetting                      */
unset($articles);
unset($topics);
unset($topicquery);
/*************************************************/
require('function.php');
require('sidebar.php');
/**************************************************
* Variable initialization                        */
$order = $_REQUEST['order'];
$sort = $_POST['sort'];
/*************************************************/

if ($_REQUEST['id'] && $topic = db_fetch_array(db_query("select * from topic,topicpermissions where ($groupquery) and topicpermissions.topicid=topic.topicid and topic.topicid='$_REQUEST[id]' and topicpermissions.view=1")))
{
	if ($sort!='asc' && $sort!='desc')
		$sort = 'desc';
	if ($order!='title' && $order!='username' && $order!='posted')
		$order = 'posted';
	$query = db_query("select * from article where topicid=$topic[topicid] order by $order $sort");
	while ($article = db_fetch_array($query))
	{
		$article['posted'] = time_adjust($article['posted'], $style['frontpage_date_format']);
		eval(store_template('topic_article'));
		$articles .= $topic_article;
	}
	$pagetitle = $topic['name'];
	eval(get_template('topic_showtopic'));
}
elseif ($_REQUEST['id'])
{
	$pagetitle = 'Invalid topic';
	eval(get_template('invalid_topic'));
}
else
{
	$query = db_query("select * from topicpermissions where ($groupquery) and view=1");
	while ($perm = db_fetch_array($query))
	{
		if ($topicquery)
			$topicquery .= " or topicid=$perm[topicid]";
		else
			$topicquery = "topicid=$perm[topicid]";
	}
	if ($topicquery)
	{
		$n=0;
		$query = db_query("select * from topic where $topicquery order by name asc");
		while ($n<db_num_rows($query))
		{
			$topic_col = '';
			for ($i=0; $i<$config['topics_per_row']; $i++)
			{
				$n++;
				$topic = db_fetch_array($query);
				$topic['parsed_image'] = parse_image($topic['image']);
				eval(store_template('topic_topic', '$topic_result'));
				$topic_col .= $topic_result;
			}
			eval(store_template('topic_row'));
			$topics .= $topic_row;
		}
	}
	$pagetitle = 'Topics';
	eval(get_template('topic_index'));
}
?>