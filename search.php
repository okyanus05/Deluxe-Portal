<?php
/**************************************************
* Search
* ------
* Allows searching of posts, articles, and user
* accounts.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'custom_field,forum_choice,hot_icons,new_posts,new_posts_closed,new_posts_closed_hot,new_posts_hot,no_new_posts,no_new_posts_closed,no_new_posts_closed_hot,no_new_posts_hot,search_index,search_length,search_results,search_result_article,search_result_article_full,search_result_ignored,search_result_post,search_result_thread,section_choice,server_busy_search,topic_choice';
/**************************************************
* Global variable resetting                      */
unset($customfields);
unset($forums);
unset($hot_icons);
unset($nextpage);
unset($pagenav);
unset($prevpage);
unset($search_pagenav);
unset($sections);
unset($topics);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$forumid = $_REQUEST['fi'] ? explode(',', $_REQUEST['fi']) : $_REQUEST['forumid'];
$op = $_REQUEST['op'];
$sectionid = $_REQUEST['sectionid'];
$sort = $_REQUEST['sort'];
$original_terms = $terms = $_REQUEST['terms'];
$topicid = $_REQUEST['topicid'];
$type = $_REQUEST['type'];
$username = dp_htmlspecialchars($_POST['username']);
$userid = strchr($_REQUEST['userid'], ',') ? explode(',', $_REQUEST['userid']) : $_REQUEST['userid'];
$name_partial = $_POST['name_partial'];
$search_subforums = $_REQUEST['search_subforums'];
$searchid = $_REQUEST['id'];
$page = $_REQUEST['page'];
/*************************************************/

if ($group['search'])
{
	if ($config['search_load'] && $config['search_load']!='0.00' && !$group['configuration'])
	{
		if (!$avg)
		{
			if ($average = @exec('uptime'))
				preg_match('/([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/', $average, $avg);
		}
		if ($avg[1] && $config['search_load']!='0.00' && (float)$avg[1] > (float)$config['search_load'])
		{
			$pagetitle = 'Server too busy';
			die(eval(get_template('server_busy_search')));
		}
	}
	if ($searchid)
	{
		if (!($searchinfo = db_fetch_array(db_query("select * from search where searchid='$searchid' and userid=$user[userid]"))))
			die(header('Location: search.php'));
		
		db_query("update search set lastaccessed=" . time() . " where searchid='$searchid'");
		
		$forumperms = '';
		get_forum_store();
		while ($forum = $forumstore[$i++])
		{
			$perm = get_forum_permissions($forum);
			if ($perm['viewthreads'])
			{
				if ($forumperms)
					$forumperms .= ",$forum[forumid]";
				else
					$forumperms = "$forum[forumid] ";
			}
		}
		reset ($forumstore);

		if (!$forumperms)
		{
			$pagetitle = 'Access denied';
			eval(get_template('permission_error'));
		}
		$numresults = db_fetch_array(db_query("select count(*) as counted from searchresult where searchid=$searchinfo[searchid] and forumid in ($forumperms)"));
		$numresults = $numresults['counted'];

		$type = $searchinfo['type'];
		$op = 'post';

		if (!$page || !is_numeric($page))
			$page = 1;
		$numpages = ceil($numresults / $config['search_per_page']);
		$search_pagenav = build_pagenav('search', $page, $numpages, $config['numlinks_search'], "id=$searchid");
		
		$end   = $config['search_per_page'];
		$start = $config['search_per_page'] * ($page - 1);

		if ($searchinfo['type']=='post' || $searchinfo['type']=='postasthread')
		{
			$query = db_query("
			
				SELECT		searchresult.resultid,
							thread.poll,
							post.*,
							thread.threadid,
							thread.lastpostdate,
							thread.name,
							thread.posts,
							thread.views,
							thread.lastuserid,
							thread.lastpostid,
							thread.lastusername,
							thread.username as threadusername,
							thread.userid as threaduserid,
							icon.image,
							icon.name as icon_name,
							icon.iconid,
							ignorelist.ignoreuserid,
							post.userid as doticon,
							forum.name as forumname,
							forum.forumid
	
				FROM		searchresult,thread,forum,post
	
				LEFT JOIN	icon on icon.iconid=post.iconid
				LEFT JOIN	ignorelist ON ignorelist.userid=$user[userid] AND
							ignorelist.ignoreuserid=post.userid
	
				WHERE		thread.redirect=0 AND
							post.threadid=thread.threadid AND
							searchresult.forumid=forum.forumid AND
							post.postid=searchresult.postid AND
							searchresult.searchid='$searchid' AND
							searchresult.forumid IN ($forumperms)
	
				ORDER BY	resultid ASC
	
				LIMIT		$start,$end");
		}
		else
		{
			$query = db_query("
			
				SELECT		searchresult.resultid,
							thread.poll,
							thread.threadid,
							thread.lastpostdate,
							thread.name,
							thread.posts,
							thread.views,
							thread.lastuserid,
							thread.lastpostid,
							thread.lastusername,
							thread.username,
							thread.userid,
							thread.userid as doticon,
							icon.image,
							icon.name as icon_name,
							icon.iconid,
							ignorelist.ignoreuserid,
							forum.name as forumname,
							forum.forumid
	
				FROM		searchresult,thread,forum
	
				LEFT JOIN	icon on icon.iconid=thread.iconid
				LEFT JOIN	ignorelist ON ignorelist.userid=$user[userid] AND
							ignorelist.ignoreuserid=thread.userid
	
				WHERE		thread.redirect=0 AND
							searchresult.threadid=thread.threadid AND
							searchresult.forumid=forum.forumid AND
							searchresult.searchid='$searchid' AND
							searchresult.forumid IN ($forumperms)
	
				ORDER BY	resultid ASC
	
				LIMIT		$start,$end");
		}
		$query2 = db_query("select markread.* from markread,thread where markread.userid=$user[userid] and thread.threadid=markread.threadid"); // and ($forumquery)
		$search = db_fetch_array(db_query("select * from search where searchid='$searchid'"));
		$search['searchterms'] = dp_htmlspecialchars($search['searchterms']);
		while ($markread_res = db_fetch_array($query2))
			$markreadstore[$markread_res['threadid']] = $markread_res;
		
		$results = '';
		$i = 0;
		$color = 'cellalt';
		while ($result = db_fetch_array($query))
		{
			$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
			$result['replies'] = --$result['posts'];
			$result['parsed_date'] = time_adjust($result['postdate'], $style['lastpost_date_format']);
			$result['lastpost'] = $result['lastpostdate'];
			$result['lastpostdate'] = time_adjust($result['lastpostdate'], $style['lastpost_date_format']);
			
			if ($config['doticons'] && $result['doticon'])
				$doticon = true;
			else
				$doticon = false;
			
			if ($result['ignoreuserid'])
			{
				$result['threaduserid'] = ($result['threaduserid'] ? $result['threaduserid'] : $result['userid']);
				$result['threadusername'] = ($result['threadusername'] ? $result['threadusername'] : $result['username']);
				eval(store_template('search_result_ignored', '$thread_ignore'));
				$results .= $thread_ignore;
				continue;
			}
			
			if ($result['poll'])
				$result['iconid'] = 0;
			elseif ($result['iconid'])
					$result['image'] = parse_image($result['image']);
			
			if ($user['lastvisit'] < $result['lastpost'])
				$newposts = true;
			else
				$newposts = false;
			if ($config['markread'] && $user['markread'])
			{
				$markread = $markreadstore[$result['threadid']];
				if ($newposts && $markread['postid']<$result['lastpostid'])
					$newposts = true;
				else
					$newposts = false;
			}
			ob_start();
				if ($result['closed'])
				{
					if ($result['posts'] >= $config['min_posts_hot'] || $result['views'] >= $config['min_views_hot'])
					{
						if ($newposts)
							eval(get_template('new_posts_closed_hot'));
						else
							eval(get_template('no_new_posts_closed_hot'));
					}
					else
					{
						if ($newposts)
							eval(get_template('new_posts_closed'));
						else
							eval(get_template('no_new_posts_closed'));
					}
				}
				else
				{
					if ($result['posts'] >= $config['min_posts_hot'] || $result['views'] >= $config['min_views_hot'])
					{
						if ($newposts)
							eval(get_template('new_posts_hot'));
						else
							eval(get_template('no_new_posts_hot'));
					}
					else
					{
						if ($newposts)
							eval(get_template('new_posts'));
						else
							eval(get_template('no_new_posts'));
					}
				}
				$isread = ob_get_contents();
			ob_end_clean();
			
			$result['name'] = censor($result['name'], $config['censored_words']);
			ob_start();
				if ($type=='post')
				{
					$result['message'] = dpcode_strip(str_replace('&lt;br /&gt;', '<br />', html_strip($result['message'])));
					$result['shortpost'] = censor(dp_substr($result['message'], 0, 250), $config['censored_words']);
					if (dp_strlen($result['message'])>250)
						$dodots = true;
					else
						$dodots = false;
					eval(get_template('search_result_post'));
				}
				else
				{
					if ($type=='postasthread')
						$result['username'] = $result['threadusername'];
					eval(get_template('search_result_thread'));
				}
				$search_result = ob_get_contents();
			ob_end_clean();
			$results .= $search_result;
		}
		
		if ($config['min_posts_hot'] || $config['min_views_hot'])
			eval(store_template('hot_icons'));
		
		$pagetitle = 'Search results';
		eval(get_template('search_results'));
	}
	elseif ($op=='post')
	{
		$terms = dp_trim($terms);
		if ((dp_strlen($terms) < $config['min_search_length']) && !$userid && !$username)
		{
			$pagetitle = 'Search terms too short';
			die(eval(get_template('search_length')));
		}
		unset($haveperm);
		unset($forumquery);
		get_forum_store();
		while ($forum = $forumstore[$i++])
		{
			$perm = get_forum_permissions($forum);
			if ($perm['viewthreads'])
				$haveperm[] = $forum['forumid'];
		}
		reset ($forumstore);
		if ($forumid || (is_array($forumid) && $forumid[0]))
		{
			$forumids = (array) $forumid;
			foreach ($forumids as $forumid)
			{
				$forumid = (int) $forumid;
				if ($search_subforums && ($forumarray = get_forums($forumid)))
				{
					while (list($forumextra, $forum_result) = each($forumarray))
					{
						if (in_array($forum_result['forumid'], $haveperm))
							$forumquery[] = $forum_result['forumid'];
					}
				}
				if (in_array($forumid, $haveperm))
					$forumquery[] = $forumid;
			}
		}
		else
			$forumquery = $haveperm;
		if (is_array($forumquery))
			$forumquery = implode(',', $forumquery);
		if (!$forumquery)
			$forumquery = 0;
		$userquery = '';
		$threaduserquery = '';
		if ($userid)
		{
			if (is_array($userid))
			{
				$userid_loop = $userid;
				unset($userid);
				foreach ($userid_loop as $user_result['userid'])
				{
					if ($username_result_string_p1)
					 	$username_result_string_p1 .= " or post.userid=$user_result[userid]";
					else
						$username_result_string_p1 = "post.userid=$user_result[userid]";

					if ($username_result_string_thread)
					 	$username_result_string_thread .= " or thread.userid=$user_result[userid]";
					else
						$username_result_string_thread = "thread.userid=$user_result[userid]";

					if ($userid)
						$userid .= ",$user_result[userid]";
					else
						$userid = $user_result['userid'];
				}
				if ($username_result_string_p1)
					$userquery = "($username_result_string_p1) and ";
				if ($username_result_string_thread)
					$threaduserquery = "($username_result_string_thread) and ";
			}
			else
			{
				$username = db_fetch_array(db_query("select name from user where userid='$userid'"));
				$username = addslashes($username['name']);
				$userquery = "post.userid='$userid' and ";
				$threaduserquery = "thread.userid='$userid' and ";
			}
		}
		elseif ($username)
		{
			if ($name_partial)
			{
				$query = db_query("select * from user where name like '".escape_like($username)."%'");
				while($user_result = db_fetch_array($query))
				{
					if ($username_result_string_p1)
					 	$username_result_string_p1 .= " or post.userid=$user_result[userid]";
					else
						$username_result_string_p1 = "post.userid=$user_result[userid]";

					if ($username_result_string_thread)
					 	$username_result_string_thread .= " or thread.userid=$user_result[userid]";
					else
						$username_result_string_thread = "thread.userid=$user_result[userid]";

					if ($userid)
						$userid .= ",$user_result[userid]";
					else
						$userid = $user_result['userid'];
				}
				if ($username_result_string_p1)
					$userquery = "($username_result_string_p1) and ";
				if ($username_result_string_thread)
					$threaduserquery = "($username_result_string_thread) and ";
				if (!$username_result_string_thread && !$username_result_string_p1)
				{
					$pagetitle = 'No users match input';
					die(eval(get_template('search_length')));
				}
			}
			else
			{
				$user_result = db_fetch_array(db_query("select * from user where name='$username'"));
				if ($userid = $user_result['userid'])
				{
					$userquery = "post.userid=$user_result[userid] and ";
					$threaduserquery = "thread.userid=$user_result[userid] and ";
				}
				else
				{
					$pagetitle = 'Selected user does not exist.';
					die(eval(get_template('search_length')));
				}
			}
		}
		if ($config['fulltextsearch'] && ($type=='post' || $type=='postasthread'))
		{
			unset($matchagainst_select);
			unset($matchagainst_query);
			if ($config['booleansearch'] && $terms)
			{
				$terms = preg_replace('/(^| )([^\+\-~\*"])/', "\\1{{{+}}}\\2", stripslashes($terms));
				$terms = preg_replace('/\(([^\+\-~\*"])/', "({{{+}}}\\1", $terms);
				$terms = preg_replace('/(".*?")/e', "stripslashes(str_replace('{{{+}}}', '', '\\1'))", $terms);
				$terms = addslashes(str_replace("{{{+}}}", "+", $terms));
				$matchagainst_select = ",MATCH (post.message,thread.name) AGAINST ('$terms' IN BOOLEAN MODE) AS score";
				$matchagainst_query = "MATCH (post.message,thread.name) AGAINST ('$terms' IN BOOLEAN MODE) AND";
				$relavence_query = "";
			}
			elseif ($terms)
			{
				$matchagainst_select = ",MATCH (post.message) AGAINST ('$terms') AS score";
				$matchagainst_query = "(MATCH (post.message) AGAINST ('$terms') OR thread.name like ('%terms%')) AND";
				$relavence_query = "";//"score>0.5 AND";
			}
			
			$querystring = "
				SELECT
					post.*,
					thread.name,
					thread.forumid,
					thread.threadid
					$matchagainst_select
					
				FROM
					post,
					thread
					
				LEFT JOIN post AS p2 ON thread.threadid=p2.threadid AND p2.userid=$user[userid]
				
				WHERE
					$matchagainst_query
					$relavence_query
					forumid in ($forumquery) AND
					$userquery
					post.threadid=thread.threadid

				GROUP BY
					" . ($type=="postasthread" ? "thread.threadid" : "post.postid");
			if ($sort=='relavence' && $terms)
				$querystring .= ' ORDER BY score,post.postdate DESC';
			elseif ($sort=='asc')
				$querystring .= ' ORDER BY post.postdate ASC';
			else
				$querystring .= ' ORDER BY post.postdate DESC';
		}
		elseif ($type=='post' || $type=='postasthread')
		{
			$querystring = "
				SELECT
					post.*,
					thread.name,
					thread.forumid,
					thread.threadid
					
				FROM
					post,
					thread
					
				LEFT JOIN post as p2 on thread.threadid=p2.threadid and p2.userid=$user[userid]
				
				WHERE
					post.threadid=thread.threadid and
					forumid in ($forumquery) AND
					$userquery
					(post.message like '%".escape_like($terms)."%' or
						thread.name like '%".escape_like($terms)."%')
				
				GROUP BY
					" . ($type=='postasthread' ? "thread.threadid" : "post.postid");
			if ($sort=='relavence' || $sort=='desc')
				$querystring .= ' ORDER BY post.postdate DESC';
			elseif ($sort=='asc')
				$querystring .= ' ORDER BY post.postdate ASC';
		}
		elseif ($config['fulltextsearch'])
		{
			$booleanmode = $config['booleansearch'] ? ' IN BOOLEAN MODE' : '';
			if ($config['booleansearch'])
			{
				$terms = preg_replace('/(^| )([^\+\-~\*"])/', "\\1{{{+}}}\\2", stripslashes($terms));
				$terms = preg_replace('/\(([^\+\-~\*"])/', "({{{+}}}\\1", $terms);
				$terms = preg_replace('/(".*?")/e', "stripslashes(str_replace('{{{+}}}', '', '\\1'))", $terms);
				$terms = addslashes(str_replace("{{{+}}}", "+", $terms));
			}
			$querystring = "
				SELECT
					".($terms ? "MATCH (thread.name) AGAINST ('$terms'$booleanmode) AS score," : '')."
					thread.lastpostdate,
					thread.threadid,
					thread.forumid
					
				FROM
					thread
					
				WHERE
					".($terms ? "MATCH (thread.name) AGAINST ('$terms'$booleanmode) AND" : '')."
					"./*(($terms && !$config['booleansearch']) ? "score>0.5 AND" : '').*/"
					$threaduserquery
					forumid in ($forumquery)
						
				GROUP BY
					threadid
			";
			if ($sort=='relavence' && $terms)
				$querystring .= 'ORDER BY score,lastpostdate DESC';
			elseif ($sort=='asc')
				$querystring .= 'ORDER BY lastpostdate ASC';
			else
				$querystring .= 'ORDER BY lastpostdate DESC';
		}
		else
		{
			$querystring = "
				SELECT
					thread.lastpostdate,
					thread.threadid,
					thread.forumid

				FROM
					thread
					
				WHERE
					$threaduserquery
					forumid in ($forumquery) AND
					thread.name like '%".escape_like($terms)."%'
				
				GROUP BY
					threadid
			";
			if ($sort=='relavence' || $sort=='desc')
				$querystring .= 'ORDER BY lastpostdate DESC';
			elseif ($sort=='asc')
				$querystring .= 'ORDER BY lastpostdate ASC';
		}
		$query = db_query($querystring);
		db_query("insert into search (searchterms,searchusername,lastaccessed,type,userid) values ('$original_terms','$username'," . time() . ",'$type', $user[userid])");
		$searchid = db_insert_id();
		$b = $i = 0;
		$threadused = $insertion = array();
		while ($result = db_fetch_array($query))
		{
			if ($i++ > 25000)
			{
				$b++;
				$i = 0;
			}
			if ($type=='title' && in_array($result['threadid'], $threadused))
				break;
			$threadused[] = $result['threadid'];
			$result['postid'] = $result['postid'] ? $result['postid'] : '\'\'';
			if (isset($insertion[$b]))
				$insertion[$b] .= "($searchid,$result[forumid],$result[threadid],$result[postid]),";
			else
				$insertion[$b]  = "($searchid,$result[forumid],$result[threadid],$result[postid]),";
		}
		foreach ($insertion as $insert_string)
		{
			$insert_string = substr($insert_string, 0, -1);
			db_query("insert into searchresult (searchid,forumid,threadid,postid) values $insert_string");
		}
		header("Location: search.php?id=$searchid");
	}
	elseif ($op=='article')
	{
		$terms = dp_trim($terms);
		if (dp_strlen($terms)<$config['min_search_length'] && !$userid && !$username && !$topicid && !$sectionid)
		{
			$pagetitle = 'Search terms too short';
			die(eval(get_template('search_length')));
		}
		$userquery = '';
		$threaduserquery = '';
		if ($userid)
			$userquery = "userid='$userid' and ";
		if ($username)
		{
			$user_result = db_fetch_array(db_query("select * from user where name='$username'"));
			if ($userid = $user_result['userid'])
				$userquery = "userid=$user_result[userid] and ";
		}
		if ($sectionid)
		{
			if ($section = db_fetch_array(db_query("select section.* from section,sectionpermissions where ($groupquery) and view=1 and section.sectionid=sectionpermissions.sectionid and section.sectionid='$sectionid'")))
			{
				$sectionquery = "sectionid=$section[sectionid]";
				$topicquery = 'topicid=0';
			}
			else
			{
				$pagetitle = 'Access denied';
				eval(get_template('permission_error'));
			}
			$topicid = 0;
		}
		elseif ($topicid)
		{
			if ($topic = db_fetch_array(db_query("select topic.* from topic,topicpermissions where ($groupquery) and view=1 and topic.topicid=topicpermissions.topicid and topic.topicid='$topicid'")))
			{
				$topicquery = "topicid=$topic[topicid]";
				$sectionquery = 'sectionid=0';
			}
			else
			{
				$pagetitle = 'Access denied';
				eval(get_template('permission_error'));
			}
			$sectionid = 0;
		}
		else
		{
			$sectionquery = 'sectionid=0';
			$topicquery = 'topicid=0';
			$query = db_query("select section.* from section,sectionpermissions where ($groupquery) and view=1 and section.sectionid=sectionpermissions.sectionid group by sectionid order by name asc");
			while ($section = db_fetch_array($query))
			{
				$sectionstore[$section['sectionid']] = $section;
				$sectionquery .= " or sectionid=$section[sectionid]";
			}
			$query = db_query("select topic.* from topic,topicpermissions where ($groupquery) and view=1 and topic.topicid=topicpermissions.topicid group by topicid order by name asc");
			while ($topic = db_fetch_array($query))
			{
				$topicstore[$topic['topicid']] = $topic;
				$topicquery .= " or topicid=$topic[topicid]";
			}
		}
		
		if ($type=='content')
			$query = db_query("SELECT article.* FROM article WHERE ($sectionquery) and ($topicquery) and $userquery(body like '%".escape_like($terms)."%' or title like '%".escape_like($terms)."%') order by posted $sort");
		else
			$query = db_query("SELECT article.* FROM article WHERE ($sectionquery) and ($topicquery) and ".$userquery."title like '%".escape_like($terms)."%' order by posted $sort");
		$page--;
		for ($i=0; $i<$page*$config['search_per_page']; $i++)
			db_fetch_array($query);
		$page++;
		$numresults = db_num_rows($query);
		$numpages = ceil($numresults/$config['search_per_page']);
		$url_terms = urlencode(stripslashes($terms));
		$form_terms = dp_htmlspecialchars(stripslashes($terms));
		$search_pagenav = build_pagenav('search', $page, $numpages, $config['numlinks_search'], "op=$op&amp;terms=$url_terms&amp;type=$type&amp;sort=$sort&amp;userid=$userid&amp;sectionid=$sectionid&amp;topicid=$topicid\" onclick=\"submitPageForm(this.rel.substr(4)); return false;");

		$results = '';
		$i = 0;
		$color = 'cellalt';
		while ($result = db_fetch_array($query))
		{
			if ($i++<$config['search_per_page'])
			{
				$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
				if (!$topicid && !$sectionid)
				{
					$topic = $topicstore[$result['topicid']];
					$section = $sectionstore[$result['sectionid']];
				}
				$result['posted'] = time_adjust($result['posted'], $style['lastpost_date_format']);
				ob_start();
					if ($type=='content')
					{
						$result['body'] = dpcode_strip(str_replace('&lt;br /&gt;', '<br />', html_strip($result['body'])));
						$result['shortbody'] = dp_substr($result['body'], 0, 250);
						if (dp_strlen($result['body'])>250)
							$dodots = true;
						else
							$dodots = false;
						eval(get_template('search_result_article_full'));
					}
					else
						eval(get_template('search_result_article'));
					$search_result = ob_get_contents();
				ob_end_clean();
				$results .= $search_result;
			}
			else
				break;
		}
		
		$pagetitle = 'Search results';
		eval(get_template('search_results'));
	}
	else
	{
		get_forum_store();
		$selected = false;
		if ($forumarray = get_forums(0))
		{
			while (list($key, $forum_result) = each($forumarray))
			{
				if (!$forum_result['ordered'])
					continue;
				$perm = get_forum_permissions($forum_result);
				if ($perm['viewthreads'])
				{
					for ($i=0; $i<$forum_result['depth']; $i++)
					{
						eval(store_template('option_indention'));
						$forum_result['name'] = $option_indention.$forum_result['name'];
					}
					eval(store_template('forum_choice'));
					$forums .= $forum_choice;
				}
			}
		}
		$query = db_query("select section.* from section,sectionpermissions where ($groupquery) and view=1 and section.sectionid=sectionpermissions.sectionid group by sectionid order by name asc");
		while ($section = db_fetch_array($query))
		{
			eval(store_template('section_choice'));
			$sections .= $section_choice;
		}
		$query = db_query("select topic.* from topic,topicpermissions where ($groupquery) and view=1 and topic.topicid=topicpermissions.topicid group by topicid order by name asc");
		while ($topic = db_fetch_array($query))
		{
			eval(store_template('topic_choice'));
			$topics .= $topic_choice;
		}
		$query = db_query('select * from customfield order by ordered');
		while ($field = db_fetch_array($query))
		{
			eval(store_template('custom_field', '$customfield'));
			$customfields .= $customfield;
		}
		$pagetitle = 'Search';
		eval(get_template('search_index'));
	}
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>