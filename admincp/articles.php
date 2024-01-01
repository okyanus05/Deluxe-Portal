<?php
/**************************************************
* Articles
* --------
* Allows you to edit, add, and delete news posts
* and articles.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'articles_article,articles_index,articles_missing,delete_article,edit_article,invalid_article,section_choice,topic_choice';
/**************************************************
* Global variable resetting                      */
unset($articles);
unset($others_sectionquery);
unset($others_topicquery);
unset($own_sectionquery);
unset($own_topicquery);
unset($post_sectionquery);
unset($post_topicquery);
unset($sections);
unset($sectionquery);
unset($smilie_box);
unset($topics);
unset($topicquery);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$dpcode = $_POST['dpcode'];
$id = $_REQUEST['id'];
$location = $_POST['location'];
$message = $_POST['message'];
$op = $_REQUEST['op'];
$sectionid = $_POST['sectionid'];
$smilies = $_POST['smilies'];
$title = $_POST['title'];
$topicid = $_POST['topicid'];
$url = $_POST['url'];
/*************************************************/

$pagetitle = 'Articles';

if($group['articles'])
{
	if ($op=='add')
	{
		if (($title = trim($title)) && ($message = trim($message)) && (($location=='topic' && $topicid) || ($location=='section' && $sectionid)))
		{
			if ($location=='topic')
			{
				$sectionid = 0;
				if (!db_num_rows(db_query("select * from topicpermissions where ($groupquery) and topicid='$topicid' and post=1")))
					die(eval(get_template('permission_error')));
				$topic = db_fetch_array(db_query("select forumid from topic where topicid='$topicid'"));
			}
			else
			{
				$topicid = 0;
				if (!db_num_rows(db_query("select * from sectionpermissions where ($groupquery) and sectionid='$sectionid' and post=1")))
					die(eval(get_template('permission_error')));
			}
			adminlog('Posted article - <b>'.stripslashes($title).'</b>');
			$url = ($url ? 1 : 0);
			$dpcode = ($dpcode ? 0 : 1);
			$smilies = ($smilies ? 0 : 1);
			$body = $message;
			
			if ($topic['forumid'] && ($forum = db_fetch_array(db_query("select * from forum where forumid=$topic[forumid]"))))
			{
				$perm = get_forum_permissions($forum);
				get_forum_store();
				$parsed_body = str_replace('[page /]', '', $body);
				if ($forum['allow_posting'] && $perm['postthreads'])
				{
					$thread = post_thread($title, $parsed_body, 0, $forum, $dpcode, $showsignature, $smilies, $url, true);
					if ($user['markread'] && $config['markread'])
						db_query("insert into markread (threadid, userid, postid) values ($thread[threadid], $user[userid], $thread[lastpostid])");
				}
			}
			if (!$thread)
				$thread['threadid'] = 0;
			if ($url)
				$body = auto_url($body);
			$body = wysiwyg_parse($body, $smilies, true);
			db_query("insert into article (title, body, topicid, userid, posted, username, sectionid, dpcode, smilies, threadid, replies, url) values ('".htmlspecialchars($title)."', '$body', '$topicid', $user[userid], $current_time, '".addslashes($user['name'])."', '$sectionid', $dpcode, $smilies, $thread[threadid], 0, $url)");
			header('Location: articles.php');
		}
		else
			eval(get_template('articles_missing'));
	}
	elseif ($op=='edit')
	{
		if ($article = db_fetch_array(db_query("select * from article where articleid='$id'")))
		{
			if ($article['topicid'])
			{
				if ($article['userid']==$user['userid'])
					$query = db_query("select * from topicpermissions where ($groupquery) and topicid=$article[topicid] and editown=1");
				else
					$query = db_query("select * from topicpermissions where ($groupquery) and topicid=$article[topicid] and editothers=1");
				if (!db_num_rows($query))
					die(eval(get_template('permission_error')));
			}
			else
			{
				if ($article['userid']==$user['userid'])
					$query = db_query("select * from sectionpermissions where ($groupquery) and sectionid=$article[sectionid] and editown=1");
				else
					$query = db_query("select * from sectionpermissions where ($groupquery) and sectionid=$article[sectionid] and editothers=1");
				if (!db_num_rows($query))
					die(eval(get_template('permission_error')));
			}
			adminlog("Edited article - <b>$article[title] ($article[articleid])</b>");
			$query = db_query("select * from topicpermissions where ($groupquery) and post=1");
			while ($perm = db_fetch_array($query))
			{
				if (!$post_topicquery)
					$post_topicquery = ' where ';
				$post_topicquery .= "topicid=$perm[topicid] or ";
			}
			if ($post_topicquery)
				$post_topicquery = dp_substr($post_topicquery, 0, -4);
			else
				$post_topicquery = ' where topicid=0';
			
			$query = db_query("select * from sectionpermissions where ($groupquery) and post=1");
			while ($perm = db_fetch_array($query))
			{
				if (!$post_sectionquery)
					$post_sectionquery = ' where ';
				$post_sectionquery .= "sectionid=$perm[sectionid] or ";
			}
			if ($post_sectionquery)
				$post_sectionquery = dp_substr($post_sectionquery, 0, -4);
			else
				$post_sectionquery = ' where sectionid=0';
			
			$query = db_query("select * from topic$post_topicquery or topicid=$article[topicid] order by name asc");
			while ($topic = db_fetch_array($query))
			{
				if ($topic['topicid']==$article['topicid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('topic_choice', '$topic'));
				$topics .= $topic;
			}
			$query = db_query("select * from section$post_sectionquery or sectionid=$article[sectionid] order by name asc");
			while ($section = db_fetch_array($query))
			{
				if ($section['sectionid']==$article['sectionid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('section_choice', '$section'));
				$sections .= $section;
			}
			
			if ($config['number_smilies'])
				$smilie_box = smilie_box();
			edit_parse($article['body'], true, true, true);
			eval(get_template('edit_article'));
		}
		else
			eval(get_template('invalid_article'));
	}
	elseif ($op=='doedit')
	{
		if (($title = trim($title)) && ($message = trim($message)) && (($location=='topic' && $topicid) || ($location=='section' && $sectionid)))
		{
			if ($article = db_fetch_array(db_query("select * from article where articleid='$id'")))
			{
				if ($article['topicid'])
				{
					if ($article['userid']==$user['userid'])
						$query = db_query("select * from topicpermissions where ($groupquery) and topicid=$article[topicid] and editown=1");
					else
						$query = db_query("select * from topicpermissions where ($groupquery) and topicid=$article[topicid] and editothers=1");
					if (!db_num_rows($query))
						die(eval(get_template('permission_error')));
				}
				else
				{
					if ($article['userid']==$user['userid'])
						$query = db_query("select * from sectionpermissions where ($groupquery) and sectionid=$article[sectionid] and editown=1");
					else
						$query = db_query("select * from sectionpermissions where ($groupquery) and sectionid=$article[sectionid] and editothers=1");
					if (!db_num_rows($query))
						die(eval(get_template('permission_error')));
				}
				
				if ($location=='topic')
				{
					$sectionid = 0;
					if ($topicid!=$article['topicid'])
					{
						if (!db_num_rows(db_query("select * from topicpermissions where ($groupquery) and topicid=$topicid and post=1")))
							die(eval(get_template('permission_error')));
					}
				}
				else
				{
					$topicid = 0;
					if ($sectionid!=$article['sectionid'])
					{
						if (!db_num_rows(db_query("select * from sectionpermissions where ($groupquery) and sectionid=$sectionid and post=1")))
							die(eval(get_template('permission_error')));
					}
				}
				adminlog("Updated article - <b>$article[title] ($article[articleid])</b>");
				$url = ($url ? 1 : 0);
				$dpcode = ($dpcode ? 0 : 1);
				$smilies = ($smilies ? 0 : 1);
				$body = $message;
				if ($article['threadid'] && ($forum = db_fetch_array(db_query("select forum.* from forum,thread where thread.threadid=$article[threadid] and thread.forumid=forum.forumid"))))
				{
					$break = false;
					if (!($moderator['editposts'] || $group['supermod_editposts'] || ($perm['editposts'] && !$config['edit_post_time'] && $post['userid']==$user['userid']) || ($perm['editposts'] && $post['userid']==$user['userid'] && $current_time-$post['postdate']<=($config['edit_post_time']*60))) || !$forum['allow_posting'])
						$break = true;
					if (!(!$thread['closed'] || $group['supermod_close'] || $moderator['close'] || ($thread['userid']==$user['userid'] && $perm['close'])))
						$break = true;
					if (!$break)
					{
						$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$forum[forumid]"));
						$perm = get_forum_permissions($forum);
						$parsed_body = str_replace('[page /]', '', $body);
						$thread = db_fetch_array(db_query("select * from thread where threadid='$article[threadid]'"));
						$firstpost = db_fetch_array(db_query("select * from post where threadid=$article[threadid] order by postid asc limit 1"));
						edit_post($firstpost, $title, $parsed_body, 0, $thread, $dpcode, false, $smilies, $url, true, $forum);
					}
				}
				if ($url)
					$body = auto_url($body);
				$body = wysiwyg_parse($body, $smilies, true);
				db_query("update article set title='".htmlspecialchars($title)."',url=$url,body='$body',topicid='$topicid',sectionid='$sectionid',dpcode=$dpcode,smilies=$smilies where articleid='$article[articleid]'");
				header('Location: articles.php');
			}
			else
				eval(get_template('invalid_article'));
		}
		else
			eval(get_template('articles_missing'));
	}
	elseif ($op=='delete')
	{
		if ($article = db_fetch_array(db_query("select * from article where articleid='$id'")))
		{
			if ($article['topicid'])
			{
				if ($article['userid']==$user['userid'])
					$query = db_query("select * from topicpermissions where ($groupquery) and topicid=$article[topicid] and deleteown=1");
				else
					$query = db_query("select * from topicpermissions where ($groupquery) and topicid=$article[topicid] and deleteothers=1");
				if (!db_num_rows($query))
					die(eval(get_template('permission_error')));
			}
			else
			{
				if ($article['userid']==$user['userid'])
					$query = db_query("select * from sectionpermissions where ($groupquery) and sectionid=$article[sectionid] and deleteown=1");
				else
					$query = db_query("select * from sectionpermissions where ($groupquery) and sectionid=$article[sectionid] and deleteothers=1");
				if (!db_num_rows($query))
					die(eval(get_template('permission_error')));
			}
			eval(get_template('delete_article'));
		}
		else
			eval(get_template('invalid_article'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($article = db_fetch_array(db_query("select * from article where articleid='$_POST[id]'")))
		{
			if ($article['topicid'])
			{
				if ($article['userid']==$user['userid'])
					$query = db_query("select * from topicpermissions where ($groupquery) and topicid=$article[topicid] and deleteown=1");
				else
					$query = db_query("select * from topicpermissions where ($groupquery) and topicid=$article[topicid] and deleteothers=1");
				if (!db_num_rows($query))
					die(eval(get_template('permission_error')));
			}
			else
			{
				if ($article['userid']==$user['userid'])
					$query = db_query("select * from sectionpermissions where ($groupquery) and sectionid=$article[sectionid] and deleteown=1");
				else
					$query = db_query("select * from sectionpermissions where ($groupquery) and sectionid=$article[sectionid] and deleteothers=1");
				if (!db_num_rows($query))
					die(eval(get_template('permission_error')));
			}
			adminlog("Deleted article - <b>$article[title] ($article[articleid])</b>");
			
			if ($article['threadid'] && ($forum = db_fetch_array(db_query("select forum.*,thread.lastpostid as threadlastpost from forum,thread where thread.threadid=$article[threadid] and thread.forumid=forum.forumid"))))
			{
				if (!($moderator['editposts'] || $group['supermod_editposts'] || ($perm['editposts'] && !$config['edit_post_time'] && $post['userid']==$user['userid']) || ($perm['editposts'] && $post['userid']==$user['userid'] && $current_time-$post['postdate']<=($config['edit_post_time']*60))) || !$forum['allow_posting'])
					break;
				if (!(!$thread['closed'] || $group['supermod_close'] || $moderator['close'] || ($thread['userid']==$user['userid'] && $perm['close'])))
					break;
				$moderator = db_fetch_array(db_query("select * from moderator where userid=$user[userid] and forumid=$forum[forumid]"));
				$perm = get_forum_permissions($forum);
				$thread = db_fetch_array(db_query("select * from thread where threadid=$article[threadid]"));
				if ($group['supermod_deletethreads'] || $moderator['deletethreads'] || ($perm['deletethreads'] && !$config['delete_thread_time']) || ($perm['deletethreads'] && $config['delete_thread_time'] && $current_time-$post['postdate']<=($config['delete_thread_time']*60)))
					delete_thread($thread, $forum);
			}
			
			db_query("delete from article where articleid='$article[articleid]'");
			header('Location: articles.php');
		}
		else
			eval(get_template('invalid_article'));
	}
	else
	{
		adminlog('Viewed articles panel');
		$query = db_query("select * from topicpermissions where ($groupquery) and (editown=1 or editothers=1 or deleteown=1 or deleteothers=1 or post=1)");
		while ($perm = db_fetch_array($query))
		{
			if ($perm['editown'] || $perm['deleteown'])
			{
				if ($own_topicquery)
					$own_topicquery .= " or topicid=$perm[topicid]";
				else
					$own_topicquery = " (userid=$user[userid] and (topicid=$perm[topicid]";
			}
			if ($perm['editothers'] || $perm['deleteothers'])
			{
				if ($others_topicquery)
					$others_topicquery .= " or topicid=$perm[topicid]";
				else
					$others_topicquery = " (topicid=$perm[topicid]";
			}
			if ($perm['post'])
			{
				if (!$post_topicquery)
					$post_topicquery = ' where ';
				$post_topicquery .= "topicid=$perm[topicid] or ";
			}
		}
		if ($own_topicquery)
		{
			$topicquery = "$own_topicquery))";
			if ($others_topicquery)
				$topicquery .= ' or';
		}
		if ($others_topicquery)
			$topicquery .= "$others_topicquery)";
		if ($post_topicquery)
			$post_topicquery = dp_substr($post_topicquery, 0, -4);
		else
			$post_topicquery = ' where topicid=0';
		
		$query = db_query("select * from sectionpermissions where ($groupquery) and (editown=1 or editothers=1 or deleteown=1 or deleteothers=1 or post=1)");
		while ($perm = db_fetch_array($query))
		{
			if ($perm['editown'] || $perm['deleteown'])
			{
				if ($own_sectionquery)
					$own_sectionquery .= " or sectionid=$perm[sectionid]";
				else
					$own_sectionquery = " (userid=$user[userid] and (sectionid=$perm[sectionid]";
			}
			if ($perm['editothers'] || $perm['deleteothers'])
			{
				if ($others_sectionquery)
					$others_sectionquery .= " or sectionid=$perm[sectionid]";
				else
					$others_sectionquery = " (sectionid=$perm[sectionid]";
			}
			if ($perm['post'])
			{
				if (!$post_sectionquery)
					$post_sectionquery = ' where ';
				$post_sectionquery .= "sectionid=$perm[sectionid] or ";
			}
		}
		if ($own_sectionquery)
		{
			$sectionquery = "$own_sectionquery))";
			if ($others_sectionquery)
				$sectionquery .= ' or';
		}
		if ($others_sectionquery)
			$sectionquery .= "$others_sectionquery)";
		if ($post_sectionquery)
			$post_sectionquery = dp_substr($post_sectionquery, 0, -4);
		else
			$post_sectionquery = ' where sectionid=0';
		
		if ($topicquery && $sectionquery)
			$topicquery .= ' or';
		if (!$topicquery && !$sectionquery)
			$topicquery = ' articleid=0';
		
		get_topic_store();
		get_section_store();
		$color = 'cellalt';
		$query = db_query("select * from article where$topicquery$sectionquery order by articleid desc limit $config[admin_articles_per_page]");
		while ($article_result = db_fetch_array($query))
		{
			$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
			$article_result['topicname'] = $topicstoreid[$article_result['topicid']]['name'];
			$article_result['sectionname'] = $sectionstoreid[$article_result['sectionid']]['name'];
			$article_result['date_posted'] = time_adjust($article_result['posted'], $style['log_date_format']);
			eval(store_template('articles_article', '$article_result'));
			$articles .= $article_result;
		}
		
		$query = db_query("select * from topic$post_topicquery order by name asc");
		while ($topic = db_fetch_array($query))
		{
			eval(store_template('topic_choice', '$topic'));
			$topics .= $topic;
		}
		$query = db_query("select * from section$post_sectionquery order by name asc");
		while ($section = db_fetch_array($query))
		{
			eval(store_template('section_choice', '$section'));
			$sections .= $section;
		}
		if ($config['number_smilies'])
			$smilie_box = smilie_box();
		
		eval(get_template('articles_index'));
	}
}
else
	eval(get_template('permission_error'));
?>