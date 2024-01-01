<?php
/**************************************************
* Print Thread
* ------------
* Displays a thread in printable format.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'invalid_thread,printthread_index,printthread_pagenav,printthread_poll_result,printthread_post';
/**************************************************
* Global variable resetting                      */
unset($nextpage);
unset($pagenav);
unset($prevpage);
unset($poll_choices);
unset($posts);
unset($thread_pagenav);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$page = $_REQUEST['page'];
/*************************************************/

$query = db_query("select thread.*,post.postdate from thread,post where thread.threadid='$_REQUEST[id]' and thread.redirect=0 and post.threadid=thread.threadid order by postid asc limit 1");
if ($thread = db_fetch_array($query))
{
	$thread['name'] = censor($thread['name'], $config['censored_words']);
	get_dpcode_store();
	get_smilie_store();
	
	$forum = get_forum_store($thread['forumid']);
	get_forum_nav($forum['forumid'], true);
	$perm = get_forum_permissions($forum);
	if (!$perm['viewthreads'])
	{
		$pagetitle = 'Access denied';
		die(eval(get_template('permission_error')));
	}
	$query = db_query("select post.*,user.signature,icon.image,icon.name as icon_name from post left join icon on post.iconid=icon.iconid left join user on post.userid=user.userid where threadid=$thread[threadid] group by postid order by post.postid $config[post_order]");
	
	if ($page!='all')
	{
		if (!is_numeric($page))
			$page = 1;
		$numpages = ceil($thread['posts']/$config['posts_per_page']);
		
		$page--;
		for ($i=0; $i<$page*$config['posts_per_page']; $i++)
			db_fetch_array($query);
		$page++;
	}
	else
		$numpages=1;
	
	$thispage = 'print_thread';
	$numlinks = $config['numlinks_pagenav'];
	$params = "id=$thread[threadid]";
	if ($numpages>1)
	{
		if ($numlinks)
		{
			if (($page-$numlinks)>1)
			{
				eval(store_template('pagenav_first'));
				$pagenav .= $pagenav_first;
			}
			if ($page>1)
			{
				$prevpage = $page-1;
				eval(store_template('pagenav_prev'));
				$pagenav .= $pagenav_prev;
			}
			for ($pagelink=($page-$numlinks); $pagelink<$page; $pagelink++)
			{
				if ($pagelink>0)
				{
					eval(store_template('pagenav_link'));
					$pagenav .= $pagenav_link;
				}
			}
			eval(store_template('pagenav_nolink'));
			$pagenav .= $pagenav_nolink;
			for ($pagelink=($page+1); $pagelink<=($page+$numlinks); $pagelink++)
			{
				if ($pagelink<=$numpages)
				{
					eval(store_template('pagenav_link'));
					$pagenav .= $pagenav_link;
				}
			}
			if ($page<$numpages)
			{
				$nextpage = $page+1;
				eval(store_template('pagenav_next'));
				$pagenav .= $pagenav_next;
			}
			if (($page+$numlinks)<$numpages)
			{
				eval(store_template('pagenav_last'));
				$pagenav .= $pagenav_last;
			}
		}
		else
		{
			if ($page>1)
			{
				$prevpage = $page-1;
				eval(store_template('pagenav_prev'));
				$pagenav .= $pagenav_prev;
			}
			for ($pagelink=1; $pagelink<$page; $pagelink++)
			{
				eval(store_template('pagenav_link'));
				$pagenav .= $pagenav_link;
			}
			eval(store_template('pagenav_nolink'));
			$pagenav .= $pagenav_nolink;
			for ($pagelink=($page+1); $pagelink<=$numpages; $pagelink++)
			{
				eval(store_template('pagenav_link'));
				$pagenav .= $pagenav_link;
			}
			if ($page<$numpages)
			{
				$nextpage = $page+1;
				eval(store_template('pagenav_next'));
				$pagenav .= $pagenav_next;
			}
		}
		eval(store_template('printthread_pagenav', '$thread_pagenav'));
	}
	
	if ($thread['poll'] && ($page==1 || $page=='all'))
	{
		
		$bar = 6;
		if ($thread['poll']=='.')
			$name = $thread['name'];
		else
			$name = $thread['poll'];
		$total = 0;
		$query2 = db_query("select * from poll where threadid=$thread[threadid] order by ordered asc");
		while ($choice = db_fetch_array($query2))
			$total += $choice['votes'];
		db_data_seek($query2, 0);
		while ($choice = db_fetch_array($query2))
		{
			if ($forum['dpcode'])
				$choice['choice'] = dpcode_parse($choice['choice'], $forum['img']);
			if ($forum[smilies])
				$choice['choice'] = smilie_parse($choice['choice']);
			if ($bar==6)
				$bar = 1;
			elseif ($bar==5)
				$bar = 6;
			elseif ($bar==4)
				$bar = 5;
			elseif ($bar==3)
				$bar = 4;
			elseif ($bar==2)
				$bar = 3;
			else
				$bar = 2;
			if ($total)
				$percent = round($choice['votes']/$total*100, 0);
			else
				$percent = 0;
			$width = ($percent*3).'px';
			eval(store_template('printthread_poll_result', '$poll_choice'));
			$poll_choices .= $poll_choice;
		}
	}
	
	$i = 0;
	while ($post = db_fetch_array($query))
	{
		if ($page!='all' && !($i++<$config['posts_per_page']))
			break;
		$post['postdate'] = time_adjust($post['postdate'], $style['post_date_format']);
		if ($post['iconid'])
			$post['image'] = parse_image($post['image']);
		if ($post['dpcode'] && $forum['dpcode'])
			$post['message'] = dpcode_parse($post['message'], $forum['img']);
		if ($post['smilies'] && $forum['smilies'])
			$post['message'] = smilie_parse($post['message']);
		$post['message'] = censor($post['message'], $config['censored_words']);
		$post['subject'] = censor($post['subject'], $config['censored_words']);
		
		if ($post['subject'] || $post['iconid'])
			$showbreaks = true;
		else
			$showbreaks = false;
		
		if ($post['showsignature'] && $post['signature'] && $user['displaysignatures'])
			$showsig = true;
		else
			$showsig = false;
		
		if ($post['signature'])
		{
			if ($config['signature_dpcode'])
				$post['signature'] = dpcode_parse($post['signature'], $config['signature_img']);
			if ($config['signature_smilies'])
				$post['signature'] = smilie_parse($post['signature']);
		}
		
		eval(store_template('printthread_post', '$post_result'));
		$posts .= $post_result;
	}

	if ($config['whos_online'] && ($config['browsingforum'] || $config['viewingthread']) && $user['userid'])
	{
		$currentuser_forumids = '';
		$update_threadid = 0;
		if ($config['browsingforum'])
		{
			$forum_parents = get_forum_parents($forum['forumid']);
			foreach ($forum_parents as $forum_forum)
				$currentuser_forumids .= addslashes("$forum_forum[forumid],");
		}
		if ($config['viewingthread'])
			$update_threadid = $id;
		db_query("update session set viewthreadid='$update_threadid',forumids='$currentuser_forumids' where sessionid='$_COOKIE[sessionid]'");
	}

	$pagetitle = $thread['name'];
	eval(get_template('printthread_index'));
}
else
{
	$pagetitle = 'Invalid thread';
	eval(get_template('invalid_thread'));
}
?>