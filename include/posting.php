<?php
/**************************************************
* Posting API
* -----------
* check_pspell()
* str_ireplace($search, $replace, $string)
*             ($search, $replace, and $string CANNOT be arrays like the CVS str_ireplace() function will accept.)
* attach($postid)
* attach_check()
* auto_url($message)
* censor($message, $words)
* update_thread_attachment($threadid)
* delete_post($post, $thread = 0, $forum = 0)
* delete_thread($thread, $forum = 0)
* display_icons($iconid = 0)
* do_subscriptions($subscribe, $subscribe_email)
* set_php_highlighting($default, $comment, $html, $keyword, $string, $bg = false)
* get_php_highlighting()
* dpcode_parse($message, $img, $quote)
* dpcode_css_parse($css)
* dpcode_html_parse($html, $linenums = false)
* dpcode_code_parse($codetext, $linenums = false)
* dpcode_php_parse($phptext, $linenums = false)
* dpcode_strip($message)
* edit_parse($message, $dpcode, $img, $smilies)
* edit_post($subject, $message, $post, $dpcode=true, $img=true, $smilies=true, $url=true, $showsignature=true, $iconid=0, $html=false, $checkshouting=true)
* post_message($subject, $message, $iconid, $thread, $dpcode, $showsignature, $smilies, $url=true, $html=false, $forum=0)
* post_thread($subject, $message, $iconid, $forum, $dpcode, $showsignature, $smilies, $url=true, $html=false)
* smilie_box()
* smilie_parse($message)
* wysiwyg_parse($message, $smilies=true, $html=false)
* wysiwyg_smilie_parse($message)
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache .= ',attachment_dimensions,attachment_size,attachment_type,icon_column,icon_row,icon_table,post_codeblock,post_htmlblock,post_phpblock,smilie,smilie_box,smilie_column,smilie_row';
if ($admincache)
	$admincache .= ',icon_column,icon_row,icon_table,post_codeblock,post_phpblock,post_htmlblock,smilie,smilie_box,smilie_column,smilie_row';
/**************************************************
* Global variable resetting                      */
unset($config);
unset($current_time);
unset($dpcodestore);
unset($execution_time);
unset($forumstore);
unset($group);
unset($moderator);
unset($pagestyle);
unset($parsedmessage);
unset($perm);
unset($query_counter);
unset($querylog);
unset($smiliestore);
unset($style);
unset($user);
/*************************************************/

function check_pspell()
{
	if (function_exists('pspell_new') && function_exists('pspell_check'))
		return true;
	else
		return false;
}

if (!function_exists('str_ireplace'))
{
	function str_ireplace($search, $replace, $string)
	{
		return preg_replace('/' . preg_quote($search, '/') . '/i', $replace, $string);
	}
}

function attach($postid)
{
	global $config, $current_time;	
	$threadinfo = db_fetch_array(db_query("select threadid from post where postid='$postid'"));
	db_query("update thread set hasattachment=1 where threadid='$threadinfo[threadid]'");
	if ($config['attachment_location']=='database')
	{
		$file = addslashes(file_get_contents($_FILES['attachment']['tmp_name']));
		db_query("insert into attachment (postid, attachment, type, size, name) values ('$postid', '$file', '".$_FILES['attachment']['type'].'\', \''.round($_FILES['attachment']['size']/1024, 0).'\', \''.addslashes($_FILES['attachment']['name']).'\')');
	}
	else
	{
		$filename = explode('.', $_FILES['attachment']['name']);
		if (count($filename) > 1)
			$ext = '.'.$filename[count($filename)-1];
		else
			$ext = '';
		$location .= $config['attachment_directory'].'/'.rand(0,32000).$current_time.rand(0,32000).$ext;
		copy($_FILES['attachment']['tmp_name'], $location);
		$file = addslashes($location);
		db_query("insert into attachment (postid, attachment, type, size, name) values ('$postid', '!:!$file', '".$_FILES['attachment']['type'].'\', \''.round($_FILES['attachment']['size']/1024, 0).'\', \''.addslashes($_FILES['attachment']['name']).'\')');
	}
}

function attach_check()
{
	foreach ($GLOBALS as $key => $value)
		${$key} = $value;
	if (!in_set($_FILES['attachment']['type'], $config['attachment_types'], ' '))
	{
		$pagetitle = 'Incorrect attachment type';
		$attachment_type = $_FILES['attachment']['type'];
		die(eval(get_template('attachment_type')));
	}
	if ($config['attachment_size'] && ($_FILES['attachment']['size'] > ($config['attachment_size'] * 1024)))
	{
		$pagetitle = 'Incorrect attachment size';
		die(eval(get_template('attachment_size')));
	}
	if (stristr($_FILES['attachment']['type'], 'image/'))
	{
		$info = getimagesize($_FILES['attachment']['tmp_name']);
		if (($config['attachment_width'] && ($info[0] > $config['attachment_width'])) || ($config['attachment_height'] && ($info[1] > $config['attachment_height'])))
		{
			$pagetitle = 'Incorrect attachment dimensions';
			die(eval(get_template('attachment_dimensions')));
		}
	}
}

function auto_url($message)
{
	$message = str_replace(' ', '  ', $message);
	$message = ' ' . $message . ' ';
	$message = preg_replace('/([\s()]){1}(gopher|irc|https|news|telnet|http|ftp){1}(:\/\/[\S^(^)]+?)([\s()]){1}/i', '\1[url]\2\3[/url]\4', $message);
	$message = preg_replace('/([\s()]){1}(www\.[\S^(^)]+?)([\s()]){1}/i', '\1[url]\2[/url]\3', $message);
	$message = str_replace('  ', ' ', $message);
	return dp_trim($message);
}

function censor($message, $words = false)
{
	global $config;
	if (!$words)
		$words = $config['censored_words'];
	$censored = explode(' ', $words);
	$i = 0;
	while ($word = $censored[$i++])
	{
		$replace = str_pad('', dp_strlen($word), $config['censor']);
		if (substr($word, 0, 1)=='{' && substr($word, -1, 1)=='}')
		{
			$replace = substr($replace, 0, -2);
			$message = preg_replace("/\b" . preg_quote(substr($word, 1, -1), '/') . "\b/i", $replace, $message);
		}
		else
			$message = str_ireplace($word, $replace, $message);
	}
	return $message;
}

function update_thread_attachment($threadid)
{
	$posts = db_query("select post.postid, attachment.name from post left join attachment on post.postid=attachment.postid where threadid='$threadid' and name<>''");
	$attachments = db_num_rows($posts) ? 1 : 0;
	db_query("update thread set hasattachment=$attachments where threadid='$threadid'");
}

function delete_post($post, $thread = 0, $forum = 0)
{
	global $group, $user;
	if (!$thread)
		$thread = db_fetch_array(db_query("select * from thread where threadid=$post[threadid]"));
	if (!$forum)
		$forum = db_fetch_array(db_query("select * from forum where forumid=$thread[forumid]"));
	if ($user['userid']==$post['userid'])
		$delgroup = $group;
	else
		$delgroup = get_groups($post['userid']);
	if (!$delgroup['lockpostcount'] && $forum['countposts'])
		db_query("update user set posts=posts-1 where userid=$post[userid]");
	db_query("delete from post where postid=$post[postid]");
	db_query("update article set replies=replies-1 where threadid=$post[threadid]");
	if ($thread['lastpostid']==$post['postid'])
	{
		$lastpost = db_fetch_array(db_query("select * from post where threadid=$thread[threadid] order by postdate desc limit 1"));
		db_query("update thread set posts=posts-1,lastuserid=$lastpost[userid],lastpostid=$lastpost[postid],lastpostdate=$lastpost[postdate],lastusername='".addslashes($lastpost['username'])."' where threadid=$thread[threadid]");
		$lastpost = db_fetch_array(db_query("select post.* from post,thread where post.threadid=thread.threadid and thread.forumid=$forum[forumid] order by postdate desc limit 1"));
		$forumarray = get_forum_parents($thread['forumid']);
		while (list($forumextra, $forumbump) = each($forumarray))
		{
			if ($forumbump['lastpostdate']<$lastpost['postdate'] || $forumbump['lastpostid']==$thread['lastpostid'])
			{
				$lastthread = db_fetch_array(db_query("select * from thread where threadid=$lastpost[threadid]"));
				db_query("update forum set threadiconid='$lastthread[iconid]',lastthreadid=$lastthread[threadid],lastforumid='$lastthread[forumid]',threadname='".addslashes(censor(htmlunspecialchars($lastthread['name'])))."',lastuserid=$lastpost[userid],lastpostid=$lastpost[postid],lastpostdate=$lastpost[postdate],posts=posts-1,lastusername='".addslashes($lastpost['username'])."' where forumid=$forumbump[forumid]");
			}
			else
				db_query("update forum set posts=posts-1 where forumid=$forumbump[forumid]");
		}
	}
	else
	{
		db_query("update thread set posts=posts-1 where threadid=$thread[threadid]");
		$forumarray = get_forum_parents($thread['forumid']);
		while (list($forumextra, $forumbump) = each($forumarray))
			db_query("update forum set posts=posts-1 where forumid=$forumbump[forumid]");
	}
	if ($post['userid'])
	{
		if ($newpost = db_fetch_array(db_query("select postid from post where userid='$post[userid]' order by postdate desc limit 1")))
			db_query("update user set lastpost='$newpost[postid]' where userid='$post[userid]'");
		else
			db_query("update user set lastpost=0 where userid='$post[userid]'");
	}
}

function delete_thread($thread, $forum=0)
{
	global $config, $user;
	if (!$forum)
		$forum = db_fetch_array(db_query("select * from forum where forumid=$thread[forumid]"));
	if ($forum['countposts'])
	{
		$query = db_query("select groupid from groups where lockpostcount=1");
		while ($group = db_fetch_array($query))
			$groups[] = $group['groupid'];
		if ($groups)
		{
			$query = db_query("select user.userid,user.usergroups from post,user where post.threadid=$thread[threadid] and post.userid=user.userid");
			while ($delpost = db_fetch_array($query))
			{
				$lock = false;
				foreach ($groups as $group)
				{
					if (in_set($group, $delpost['usergroups']))
						$lock = true;
				}
				if ($newpost = db_fetch_array(db_query("select postid from post where userid='$post[userid]' order by postdate desc limit 1")))
					$lastpost = $newpost['postid'];
				else
					$lastpost = 0;
				db_query("update user set ".(!$lock ? "posts=posts-1," : '')."lastpost='$lastpost' where userid=$delpost[userid]");
			}
		}
	}
	db_query("delete from thread where threadid=$thread[threadid]");
	db_query("delete from thread where redirect=$thread[threadid]");
	db_query("delete from post where threadid=$thread[threadid]");
	db_query("delete from markread where threadid=$thread[threadid]");
	db_query("delete from subscribedthread where threadid=$thread[threadid]");
	db_query("delete from subscribedemail where threadid=$thread[threadid]");
	db_query("delete from poll where threadid=$thread[threadid]");
	db_query("delete from whovoted where threadid=$thread[threadid]");
	db_query("update article set replies=0,threadid=0 where threadid=$thread[threadid]");
	$lastthread = db_fetch_array(db_query("select * from thread where forumid=$forum[forumid] and redirect=0 order by lastpostdate desc limit 1"));
	if (!$lastthread['lastpostid'])
	{
		$lastthread['lastuserid'] = 0;
		$lastthread['lastpostid'] = 0;
		$lastthread['lastpostdate'] = 0;
		$lastthread['forumid'] = 0;
		$lastthread['lastusername'] = '';
		$lastthread['iconid'] = 0;
		$lastthread['threadid'] = 0;
		$lastthread['name'] = '';
	}
	$forumarray = get_forum_parents($forum['forumid']);
	while (list($forumextra, $forumbump) = each($forumarray))
	{
		if ($forumbump['lastpostdate']<$lastthread['lastpostdate'] || $forumbump['lastpostid']==$thread['lastpostid'])
			db_query("update forum set threadiconid=$lastthread[iconid],lastthreadid=$lastthread[threadid],lastforumid=$lastthread[forumid],threadname='".addslashes(censor(htmlunspecialchars($lastthread['name'])))."',lastuserid=$lastthread[lastuserid],lastpostid=$lastthread[lastpostid],lastpostdate=$lastthread[lastpostdate],posts=posts-$thread[posts],threads=threads-1,lastusername='".addslashes($lastthread['lastusername'])."' where forumid=$forumbump[forumid]");
		else
			db_query("update forum set posts=posts-$thread[posts],threads=threads-1 where forumid=$forumbump[forumid]");
	}
}

function disable_images($message)
{
	global $user;
	if ($user['img'])
		return $message;
	return preg_replace('/<img src="([^"]*)"[^>]*>/', '<a href="\1" onclick="window.open(this.href,\'_blank\');return false;">\1</a>', $message);
}

function display_icons($iconid = 0)
{
	global $config;
	$query = db_query('select * from icon where ordered>0 order by ordered');
	if (db_num_rows($query))
	{
		$row = 0;
		$total = 0;
		while ($icon = db_fetch_array($query))
		{
			$icon['image'] = parse_image($icon['image']);
			$icon['selected'] = $iconid;
			if ($icon['iconid']==$iconid)
				$checked = true;
			else
				$checked = false;
			eval(store_template('icon_column'));
			$icon_row .= $icon_column;
			if (++$row>=$config['icons_row'])
			{
				eval(store_template('icon_row', '$icon_result'));
				$icons .= $icon_result;
				$icon_row = '';
				$row = 0;
			}
		}
		if ($icon_row)
		{
			eval(store_template('icon_row', '$icon_result'));
			$icons .= $icon_result;
		}
		eval(store_template('icon_table'));
		return $icon_table;
	}
}

function do_subscriptions($post, $subscribe, $subscribe_email)
{
	global $user;
	if ($subscribe && !db_num_rows(db_query("select * from subscribedthread where userid=$user[userid] and threadid=$post[threadid]")))
		db_query("insert into subscribedthread (userid, threadid) values ($user[userid], $post[threadid])");
	elseif (!$subscribe)
		db_query("delete from subscribedthread where userid=$user[userid] and threadid=$post[threadid]");
	if ($subscribe_email && !db_num_rows(db_query("select * from subscribedemail where userid=$user[userid] and threadid=$post[threadid]")))
		db_query("insert into subscribedemail (userid, threadid, lastsent) values ($user[userid], $post[threadid], 0)");
	elseif (!$subscribe_email)
		db_query("delete from subscribedemail where userid=$user[userid] and threadid=$post[threadid]");
}

function set_php_highlighting($default, $comment, $html, $keyword, $string, $bg = false)
{
	if ($default)
		ini_set('highlight.default', $default);
	if ($comment)
		ini_set('highlight.comment', $comment);
	if ($html)
		ini_set('highlight.html', $html);
	if ($keyword)
		ini_set('highlight.keyword', $keyword);
	if ($string)
		ini_set('highlight.string', $string);
	if ($bg)
		ini_set('highlight.bg', $bg);
	return true;
}

function get_php_highlighting()
{
	return array('default' => ini_get('highlight.default'),
				 'comment' => ini_get('highlight.comment'),
				 'keyword' => ini_get('highlight.keyword'),
				 'string'  => ini_get('highlight.string'),
				 'html'    => ini_get('highlight.html'),
				 'bg'      => ini_get('highlight.bg'));
}

function strip_smilies($text)
{
	global $smiliestore;
	get_smilie_store();
	$i = 0;
	while ($smilie = $smiliestore[$i++])
	{
		if ($smilie['insensitive'])
			$text = str_ireplace($smilie['tag'], "{:smilie:}$smilie[tag]{:endsmilie:}", $text);
		else
			$text = str_replace($smilie['tag'], "{:smilie:}$smilie[tag]{:endsmilie:}", $text);
	}
	return $text;
}

function dpcode_parse($text, $images, $quote = 1, $imgovr = false)
{
//	return $text;
	global $dpcodestore, $user, $config, $group;
	$text = preg_replace('/\[php(=nonum)?\](.+?)\[\/php\]/ei', 'dpcode_php_parse(\'\2\', \'\1\')', $text);
	$text = preg_replace('/\[code(=num)?\](.+?)\[\/code\]/ei', 'dpcode_code_parse(\'\2\', \'\1\')', $text);
	$text = preg_replace('/\[html(=nonum)?\](.+?)\[\/html\]/ei', 'dpcode_html_parse(\'\2\', \'\1\')', $text);
	get_dpcode_store();
	$i = 0;
	while ($dpcode = $dpcodestore[$i++])
	{
		if (!$quote && $dpcode['tag']=='quote')
			continue;
		if (!$dpcode['empty'])
			$text = preg_replace('/\['.$dpcode['tag'].'(=[^\]]*)?\]\[\/'.$dpcode['tag'].'\]/si', '', $text);
		if ($dpcode['option'])
		{
			while (preg_match('/\['.$dpcode['tag'].'=([^\]]*)\](.' . ($dpcode['empty']==1 ? '*' : '+'). '?)\[\/'.$dpcode['tag'].'\]/si', $text, $match))
			{
				$replacement = str_replace('{param}', $match[2], $dpcode['replacement']);
				$replacement = str_replace('{option}', $match[1], $replacement);
				if ($dpcode['nosmilies'])
					$replacement = strip_smilies($replacement);
				$text = str_replace($match[0], $replacement, $text);
			}
		}
		else
		{
			while (preg_match('/\['.$dpcode['tag'].'\](.' . ($dpcode['empty']==1 ? '*' : '+'). '?)\[\/'.$dpcode['tag'].'\]/si', $text, $match))
			{
				$replacement = str_replace('{param}', $match[1], $dpcode['replacement']);
				if ($dpcode['nosmilies'])
					$replacement = strip_smilies($replacement);
				$text = str_replace($match[0], $replacement, $text);
			}
		}
	}
	$text = preg_replace('/\[url=(javascript:|vbscript:|about:).*?\](.*?)\[\/url\]/i', '$2', $text);
	$text = preg_replace('/\[url\](javascript:|vbscript:|about:)(.*?)\[\/url\]/i', '$2', $text);
	$text = preg_replace('/\[img\](javascript:|vbscript:|about:)(.*?)\[\/img\]/i', '$2', $text);
	$text = preg_replace('/\[(url|code|php|img)(=[^\]]*?)?\]\[\/\1\]/si', '', $text);
	while(preg_match('/\[url\]([^"]+?)\[\/url\]/i', $text, $match))
	{
		$match[1] = strip_smilies($match[1]);
		$url = $match[1];
		if (!preg_match('/^(irc:\/\/|telnet:\/\/|news:\/\/|mailto:|https:\/\/|gopher:\/\/|http:\/\/|ftp:\/\/)/i', $url))
			$url = 'http://' . $url;
		$text = str_replace($match[0], '<a href="' . $url . '" onclick="window.open(this.href,\'_blank\');return false;">' . $match[1] . '</a>', $text);
	}
	while(preg_match('/\[url=([^"]*?)\](.+?)\[\/url\]/i', $text, $match))
	{
		$url = strip_smilies($match[1]);
		if (!preg_match('/^(irc:\/\/|telnet:\/\/|news:\/\/|mailto:|https:\/\/|gopher:\/\/|http:\/\/|ftp:\/\/)/i', $url))
			$url = 'http://' . $url;
		$text = str_replace($match[0], '<a href="' . $url . '" onclick="window.open(this.href,\'_blank\');return false;">' . $match[2] . '</a>', $text);
	}
	
	if ($images && ($user['img'] || $imgovr))
	{
		preg_match_all('/\[img\]([^"]+?)\[\/img\]/i', $text, $img_match);
		if (is_array($img_match[0]))
		{
			reset($img_match[0]);
			while (list($num) = each($img_match[0]))
			{
				if (censor($img_match[1][$num], $config['censored_img'])==$img_match[1][$num])
				{
					$img_match[1][$num] = strip_smilies($img_match[1][$num]);
					if (strtolower(dp_substr($img_match[1][$num], 0, 7))=='http://' || strtolower(dp_substr($img_match[1][$num], 0, 6))=='ftp://' || strtolower(dp_substr($img_match[1][$num], 0, 8))=='https://')
						$text = str_replace($img_match[0][$num], '<img src="'.$img_match[1][$num].'" alt="' . $img_match[1][$num] . '" />', $text);
					else
						$text = str_replace($img_match[0][$num], '<img src="http://'.$img_match[1][$num].'" alt="http://' . $img_match[1][$num] . '" />', $text);
				}
			}
		} 
	}
	else
	{
		while(preg_match('/\[img\]([^"]+?)\[\/img\]/i', $text, $match))
		{
			$match[1] = strip_smilies($match[1]);
			if (!preg_match('/^(irc:\/\/|telnet:\/\/|news:\/\/|mailto:|https:\/\/|gopher:\/\/|http:\/\/|ftp:\/\/)/i', $match[1]))
				$url = 'http://' . $match[1];
			$text = str_replace($match[0], '<a href="' . $url . '" onclick="window.open(this.href,\'_blank\');return false;">' . $match[1] . '</a>', $text);
		}
	}
	
	return $text;
}

function dpcode_css_parse($css)
{
	$css = explode("\n", dp_trim($css));
	if (!(!strstr($css[0], '&lt;--') && !strstr($css[count($css)-1], '--&gt;')))
	{
		$start = $css[0];
		$end = $css[count($css)-1];		
		array_shift($css);
		array_pop($css);
	}
	$css = implode("\n", $css);
	$css = preg_replace('/(\s*?)([a-zA-Z\-][^"\{\}<>;]*?)\:/', '\1<span style="color: #00008b">\2</span>:', $css);
	$css = preg_replace('/\:([^">]*?)(;|\})/s', ':<span style="color: blue">\1</span>\2', $css);
	$css = preg_replace('/(&quot;|\')([^\1]*?)\1/', '<span style="color: #009900">\1\2\1</span>', $css);
	$css = preg_replace('/(\/\*(.*?)\*\/)/se', "'<span style=\"color: #999999; font-style: italic\">' . strip_tags('\\1') . '</span>'", $css);
	$css = (isset($start) ? $start . "\n" : '') . '<span style="color: #FF00FF; font-style:normal">' . $css . '</span>' . (isset($end) ? "\n" . $end : '');
	return $css;
}

function dpcode_html_parse($html, $linenums = false)
{
	$html = str_replace('"', "&quot;", $html);
	$html = dp_trim($html);
	$html = str_replace("\t", "    ", $html);
	$html = preg_replace('/(&lt;!--(.*?)--&gt;)/s', '<span style="color:#999999; font-style: italic">\1</span>', $html);
	$html = preg_replace('/(&quot;|\')([^\1]*?)\1/e', "'\\1' . str_replace('&gt;', '!{~!{gt}!~}!', '\\2') . '\\1'", $html);
	$html = preg_replace('/(&lt;style.*?&gt;\s*)(.*?)(\s*&lt;\/style&gt;)/sie', "'\\1' . dpcode_css_parse('\\2') . '\\3'", $html);
	preg_match_all('/&lt;(\/)?(\w*)(.*?)&gt;/si', $html, $match, PREG_SET_ORDER);
	foreach ($match as $tag)
	{
		if ($tag[2])
		{
			$tag['end']     = &$tag[1];
			$tag['end']     = $tag['end']=='/' ? true : false;
			$tag['full']    = &$tag[0];
			$tag['name']    = &$tag[2];
			$tag['lowname'] = strtolower($tag[2]);
			$tag['attribs'] = dp_trim($tag[3]) ? $tag[3] : false;
			$tag['attrib_color'] = '#0000FF';
			if ($tag['lowname']=='script')
			{
				$color = '#990000';
				$tag['attrib_color'] = '#000000; font-style: italic';
			}
			elseif ($tag['lowname']=='a')
				$color = '#009900';
			elseif ($tag['lowname']=='td'
				 || $tag['lowname']=='tr'
				 || $tag['lowname']=='th'
				 || $tag['lowname']=='thead'
				 || $tag['lowname']=='tfoot'
				 || $tag['lowname']=='tbody'
				 || $tag['lowname']=='table')
				$color = '#009999';
			elseif ($tag['lowname']=='form'
				 || $tag['lowname']=='input'
				 || $tag['lowname']=='button'
				 || $tag['lowname']=='option'
				 || $tag['lowname']=='select')
				$color = '#FF9900';
			elseif ($tag['lowname']=='img'
				 || $tag['lowname']=='style')
			{
				$color = '#990099';
				if ($tag['lowname']=='style')
					$tag['attrib_color'] = '#009900';
			}
			else
				$color = '#00008b';
			$html = str_replace($tag['full'], '<span style="color: ' . $color . '">' . preg_replace('/(&quot;|\')([^\1]*?)\1/', '<span style="color: ' . $tag['attrib_color'] . '">\1\2\1</span>', ($tag['full'])) . '</span>', $html);
		}
	}
	$html = str_replace('!{~!{gt}!~}!', '&gt;', $html);
	$html = preg_replace('/&amp;(\S+?);/', '<strong style="color: black; font-style: italic">&amp;\1;</strong>', $html);
	$html = str_replace('<br />', "\n", $html);
	if ($linenums==false)
	{
		$html_arr = explode("\n", dp_trim($html));
		$html = '';
		$numlines = dp_strlen(count($html_arr));
		$linenum = 0;
		foreach ($html_arr as $htmlline)
		{
			$linenum++;
			$numspaces = $numlines - dp_strlen($linenum);
			$pad = str_repeat('&nbsp;', $numspaces);
			$html .= $pad . $linenum . '.&nbsp;' . $htmlline . "<br />";
		}
	}
	$htmltext = dp_trim($html);
	eval(store_template('post_htmlblock'));
	return $post_htmlblock;
}

function dpcode_code_parse($codetext, $linenums = false)
{
	$codetext = preg_replace("/\n|\r/", '', $codetext);
	$codetext = preg_replace('/<br(.*?)>/', "\n", $codetext);
	$codetext = dp_trim($codetext);
	if ($linenums==true)
	{
		$codetext_arr = explode("\n", $codetext);
		$codetext = '';
		$numlines = dp_strlen(count($codetext_arr));
		$linenum = 0;
		foreach ($codetext_arr as $codeline)
		{
			$linenum++;
			$numspaces = $numlines - dp_strlen($linenum);
			$pad = str_repeat('&nbsp;', $numspaces);
			$codetext .= $pad . $linenum . '.&nbsp;' . $codeline . "\n";
		}
	}
	eval(store_template('post_codeblock'));
	return $post_codeblock;
}

function dpcode_php_parse($phptext, $nolinenums = false)
{
	global $color;
	$phptext = preg_replace("/\n|\r/", '', $phptext);
	$phptext = preg_replace('/<br(.*?)>/', "\n", $phptext);
	$phptext = dp_trim($phptext);
	$phptext = htmlunspecialchars($phptext);
	$phptext = preg_replace('/<\?(?!php|xml|xsl)/', '<'.'?php', $phptext);
	if (strpos($phptext, '<'.'?php')===false)
	{
		$phptext = '/*DPPHPCODE*/<'."?php/*/DPPHPCODE*/" . $phptext;
		$nostart = true;
	}
	if (strpos($phptext, '?'.'>')===false)
	{
		$noend = true;
		$phptext .= "/*DPPHPCODE*/?".'>/*/DPPHPCODE*/';
	}
	ob_start();
		highlight_string($phptext);
		$phptext = ob_get_contents();
		$phptext = str_ireplace("</font>", "</span>", $phptext);
		$phptext = preg_replace("/<font color=\"(.*?)\">/i", "<span style=\"color: $1;\">", $phptext);
	ob_end_clean();
	$phptext = preg_replace('/\/\*DPPHPCODE\*\/.*?\/\*\/DPPHPCODE\*\//s', '', $phptext);
	$phptext = dp_trim($phptext);
	$phptext = preg_replace("/\r\n|\n|\r/", '', $phptext);
	$phptext_arr = preg_split("/<br[^>]*>/i", $phptext);
	$phptext = '';
	$numlines = dp_strlen(count($phptext_arr));
	$linenum = 0;
	foreach ($phptext_arr as $phpline)
	{
		if ($nolinenums==false)
		{
			$linenum++;
			$numspaces = $numlines - dp_strlen($linenum);
			$pad = str_repeat('&nbsp;', $numspaces);
			$phptext .= '<span style="background-color: transparent;" class="' . ($color ? $color : 'cellmain') . '">' . $pad . $linenum . '.</span>&nbsp;' . $phpline . '<br />';
		}
		else
			$phptext .= "$phpline<br />";
	}
	eval(store_template('post_phpblock'));
	return $post_phpblock;
}

function dpcode_strip($text)
{
	global $dpcodestore, $user;
	get_dpcode_store();

	$text = preg_replace('/\[code(=num)?\](.*?)\[\/code\]/si', '\1', $text);
	$text = preg_replace('/\[php(=nonum)?\](.*?)\[\/php\]/si', '\1', $text);
	$text = preg_replace('/\[html(=nonum)?\](.*?)\[\/html\]/si', '\1', $text);
	$text = preg_replace('/\[page=(.*?)\/\]/i', '', $text);
	$text = preg_replace('/\[page\s*?\/\]/i', '', $text);
	$text = preg_replace('/\[email(=[^\]]*?)\](.*?)\[\/email\]/i', '\2', $text);
	$text = preg_replace('/\[url(=[^\]]*?)\](.*?)\[\/url\]/i', '\2', $text);
	$text = preg_replace('/\[url\](.*?)\[\/url\]/i', '\1', $text);
	$text = preg_replace('/\[img\](.*?)\[\/img\]/i', '\1', $text);
	
	foreach ($dpcodestore as $dpcode)
		$text = preg_replace('/\['.$dpcode['tag'] . (strpos($dpcode['replacement'], '{option}')!==false ? '=[^\]]*' : '') . '\](.*?)\[\/'.$dpcode['tag'].'\]/i', '\1', $text);

	return $text;
}

function edit_parse($msg, $dpcode, $img, $smilies, $html = false)
{
	global $message, $parsedmessage;
	$parsedmessage = $msg;
	if ($html)
		$parsedmessage = preg_replace('/&lt;br.*?&gt;/i', '<br />', dp_htmlspecialchars($parsedmessage));
	$parsedmessage = str_replace("\t", '    ', $parsedmessage);
	$parsedmessage = preg_replace('/&((#[\d]{1,5}?)|([a-z]*?));\)/i', '&\1;<span></span>)', $parsedmessage);
	if ($smilies)
		$parsedmessage = wysiwyg_smilie_parse($parsedmessage);
	$parsedmessage = str_replace('  ', ' &nbsp;', $parsedmessage);
	if ($dpcode)
	{
		while (preg_match('/\[list\]([^(\[item\]|\[\/item\])]*?)<br([^>]*?)>(.*?)\[\/list\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<ul>$match[1]$match[3]</ul>", $parsedmessage);

		while (preg_match('/\[ol\]([^(\[item\]|\[\/item\])]*?)<br([^>]*?)>(.*?)\[\/ol\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<ol>$match[1]$match[3]</ol>", $parsedmessage);

		while (preg_match('/\[list\](.*?)\[\/list\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<ul>$match[1]</ul>", $parsedmessage);

		while (preg_match('/\[ol\](.*?)\[\/ol\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<ol>$match[1]</ol>", $parsedmessage);

		while (preg_match('/\[item\](.*?)\[\/item\](.*?)<br(.*?)>/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<li>$match[1]</li>$match[2]", $parsedmessage);

		while (preg_match('/\[item\](.*?)\[\/item\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<li>$match[1]</li>", $parsedmessage);

		while (preg_match('/<br([^>]*)>(.*?)\[hr\](.*?)\[\/hr\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], '<hr />', $parsedmessage);

		while (preg_match('/\[hr\](.*?)\[\/hr\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], '<hr />', $parsedmessage);

		while (preg_match('/\[b\](.+?)\[\/b\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<b>$match[1]</b>", $parsedmessage);
	
		while (preg_match('/\[i\](.+?)\[\/i\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<i>$match[1]</i>", $parsedmessage);
			
		while (preg_match('/\[u\](.+?)\[\/u\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<u>$match[1]</u>", $parsedmessage);
			
		while (preg_match('/\[align=([^\]]*)\](.*?)\[\/align\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<div align=\"$match[1]\">$match[2]</div>", $parsedmessage);

		while (preg_match('/\[font=([^\]]*)\](.*?)\[\/font\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<span style=\"" . strip_smilies("font-family:$match[1]") . "\">$match[2]</span>", $parsedmessage);
	
		while (preg_match('/\[color=([^\]]*)\](.*?)\[\/color\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<span style=\"" . strip_smilies("color:$match[1]") . "\">$match[2]</span>", $parsedmessage);
	
		while (preg_match('/\[size=([^\]]*)\](.*?)\[\/size\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<span style=\"" . strip_smilies("font-size:$match[1]") . "\">$match[2]</span>", $parsedmessage);

		while(preg_match('/\[url\]([^"]+?)\[\/url\]/i', $parsedmessage, $match))
		{
			$match[1] = strip_smilies($match[1]);
			$url = $match[1];
			if (!preg_match('/^(irc:\/\/|telnet:\/\/|news:\/\/|mailto:|https:\/\/|gopher:\/\/|http:\/\/|ftp:\/\/)/i', $url))
				$url = 'http://' . $url;
			$parsedmessage = str_replace($match[0], '<a href="' . $url . '" onclick="window.open(this.href,\'_blank\');return false;">' . $match[1] . '</a>', $parsedmessage);
		}
		while(preg_match('/\[url=([^"]*?)\](.+?)\[\/url\]/i', $parsedmessage, $match))
		{
			$url = strip_smilies($match[1]);
			if (!preg_match('/^(irc:\/\/|telnet:\/\/|news:\/\/|mailto:|https:\/\/|gopher:\/\/|http:\/\/|ftp:\/\/)/i', $url))
				$url = 'http://' . $url;
			$parsedmessage = str_replace($match[0], '<a href="' . $url . '" onclick="window.open(this.href,\'_blank\');return false;">' . $match[2] . '</a>', $parsedmessage);
		}


		while (preg_match('/\[email\]([^"]+?)\[\/email\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<a href=\"" . strip_smilies("mailto:$match[1]") . "\">" . strip_smilies($match[1]) . "</a>", $parsedmessage);

		while (preg_match('/\[email=([^"]+?)\](.+?)\[\/email\]/si', $parsedmessage, $match))
			$parsedmessage = str_replace($match[0], "<a href=\"" . strip_smilies("mailto:$match[1]") . "\">$match[2]</a>", $parsedmessage);
	
		if ($img)
		{
			$parsedmessage = preg_replace('/\[img\](http:\/\/|ftp:\/\/)(.*?)\[\/img\]/ie', "stripslashes('<img src=\"' . strip_smilies('\\1\\2') . '\" alt=\"\" />')", $parsedmessage);
			$parsedmessage = preg_replace('/\[img\](.*?)\[\/img\]/ie', "stripslashes('<img src=\"http://' . strip_smilies('\\1') . '\" alt=\"\" />')", $parsedmessage);
		}
	}
	$parsedmessage = str_replace('<span></span>)', ')', $parsedmessage);
	$parsedmessage = dp_htmlspecialchars($parsedmessage);
	$message = str_replace('<br />', "\n", $msg);
}

function add_word_breaks($message)
{
	global $config;
	$message = stripslashes($message);
	if ($config['max_wordlen'])
	{
		while (preg_match('/(\S{'.($config['max_wordlen'] + 1).',}?)/', $message, $match))
		$message = str_replace($match[1], dp_substr($match[1], 0, $config['max_wordlen']).' '.dp_substr($match[1], $config['max_wordlen']), $message);
	}
	return addslashes($message);
}

function truncate_subject($subject)
{
	global $config;
	if ($config['max_titlelen'])
		$subject = dp_substr($subject, 0, $config['max_titlelen']);
	return $subject;
}

function thread_shouting($subject)
{
	global $config;
	if ($config['disable_shouting'] && !preg_match('/[a-z]+/', $subject))
	{
		$subject = strtolower($subject);
		$subject = ucwords($subject);
	}
	return $subject;
}

function edit_post($post, $subject, $message, $iconid, $thread, $dpcode, $showsignature, $smilies, $url=true, $html=false, $forum='')
{
	global $config, $current_time, $group, $moderator, $perm, $user;
	if ($post['postid'] && $message)
	{
		if ($url)
			$message = auto_url($message);
		$message = dp_trim(add_word_breaks(wysiwyg_parse($message, $smilies, $html)));
		$subject = addslashes(thread_shouting(dp_trim(truncate_subject(dp_htmlspecialchars(dp_trim(stripslashes($subject)))))));
		if ($config['post_cache'] && ($thread['lastpostdate']>=$current_time-$config['post_cache']*86400 || $thread['sticky']))
		{
			if (!$forum)
				$forum = db_fetch_array(db_query("select * from forum where forumid=$thread[forumid]"));
			$parsed_message = stripslashes($message);
			if ($dpcode && $forum['dpcode'])
				$parsed_message = dpcode_parse($parsed_message, $forum['img'], true, true);
			if ($smilies && $forum['smilies'])
				$parsed_message = smilie_parse($parsed_message);
			$parsed_message = addslashes(censor($parsed_message, $config['censored_words']));
		}
		if ((!$group['show_editedby'] && !$config['edited_by_time']) || (!$group['show_editedby'] && $config['edited_by_time'] && ($current_time-$post['postdate'])>($config['edited_by_time']*60)))
			db_query("UPDATE post SET url='$url',parsed_message='$parsed_message',subject='$subject',iconid='$iconid',message='$message',dpcode='$dpcode',smilies='$smilies',showsignature='$showsignature',editedby_userid=$user[userid],editedby_username='".addslashes($user['name'])."',editedby_date=$current_time,html='$html' WHERE postid=$post[postid]");
		else
			db_query("UPDATE post SET url='$url',parsed_message='$parsed_message',subject='$subject',iconid='$iconid',message='$message',dpcode='$dpcode',smilies='$smilies',showsignature='$showsignature',html='$html' WHERE postid=$post[postid]");
		$firstpost = db_fetch_array(db_query("SELECT postid FROM post where threadid='$post[threadid]' ORDER BY postid ASC LIMIT 1"));
		if ($firstpost['postid']==$post['postid'] && ($moderator['editthreads'] || $group['supermod_editthreads'] || ($perm['editthreads'] && !$config['edit_thread_time']) || ($perm['editthreads'] && ($current_time-$post['postdate'])<($config['edit_thread_time']*60))))
		{
			if ($subject)
			{
				db_query("UPDATE thread SET name='$subject',iconid='$iconid' WHERE threadid=$post[threadid]");
				$forumarray = get_forum_parents($thread['forumid']);
				$inforums = '';
				while (list($forumextra, $forumbump) = each($forumarray))
					$inforums .= ",$forumbump[forumid]";
				if ($inforums)
					db_query("update forum set threadiconid='$iconid',threadname='".censor(htmlunspecialchars($subject)).'\' where forumid in ('.substr($inforums, 1).") and lastthreadid=$thread[threadid]");
			}
		}
	}
}

function post_message($subject, $message, $iconid, $thread, $dpcode, $showsignature, $smilies, $url=true, $html=false, $forum=0)
{
	global $config, $user, $group, $current_time, $_SERVER, $forumstore;
	if (!$forum)
		$forum = db_fetch_array(db_query("select * from forum where forumid=$thread[forumid]"));
	$subject = dp_htmlspecialchars($subject);
	if ($url)
		$message = auto_url($message);
	$message = wysiwyg_parse($message, $smilies, $html);
	$message = add_word_breaks($message);
	if ($config['post_cache'])
	{
		if (!$forum)
			$forum = db_fetch_array(db_query("select * from forum where forumid=$thread[forumid]"));
		$parsed_message = stripslashes($message);
		if ($dpcode && $forum['dpcode'])
			$parsed_message = dpcode_parse($parsed_message, $forum['img'], true, true);
		if ($smilies && $forum['smilies'])
			$parsed_message = smilie_parse($parsed_message);
		$parsed_message = addslashes(censor($parsed_message, $config['censored_words']));
	}
	db_query("insert into post (threadid, iconid, subject, message, userid, postdate, ip, username, dpcode, smilies, showsignature, url, html, parsed_message) values ($thread[threadid], '$iconid', '$subject', '$message', $user[userid], '$current_time', '$_SERVER[REMOTE_ADDR]', '".addslashes($user['name'])."', '$dpcode', '$smilies', '$showsignature', '$url', '$html', '$parsed_message')");
	$query = db_query("select * from post where threadid=$thread[threadid] and userid=$user[userid] order by postid desc limit 1");
	$post = db_fetch_array($query);
	db_query('update thread set posts=posts+1,lastusername=\''.addslashes($user['name'])."',lastuserid='$user[userid]',lastpostid='$post[postid]',lastpostdate='$current_time' where threadid=$thread[threadid]");
	db_query("update article set replies=replies+1 where threadid=$thread[threadid]");
	$threadname = db_fetch_array(db_query("select * from thread where threadid=$post[threadid]"));
	$forumarray = get_forum_parents($thread['forumid']);
	$inforums = '';
	while (list($forumextra, $forumbump) = each($forumarray))
		$inforums .= ",$forumbump[forumid]";
	if ($inforums)
		db_query("update forum set threadiconid=$threadname[iconid],lastthreadid=$threadname[threadid],lastforumid=$threadname[forumid],threadname='".addslashes(censor(htmlunspecialchars($threadname['name'])))."',lastuserid=$user[userid],lastpostid=$post[postid],lastpostdate=$current_time,posts=posts+1,lastusername='".addslashes($user['name']).'\' where forumid in ('.substr($inforums, 1).')');
	if ($forum['countposts'] && !$group['lockpostcount'])
		db_query("update user set posts=posts+1,lastpost=$post[postid] where userid=$user[userid]");
	else
		db_query("update user set lastpost=$post[postid] where userid=$user[userid]");
	return $post;
}

function post_thread($subject, $message, $iconid, $forum, $dpcode, $showsignature, $smilies, $url=true, $html=false)
{
	global $config, $user, $group, $current_time, $_SERVER, $forumstore;
	$subject_forum = $subject;
	$subject = dp_htmlspecialchars($subject);
	if ($url)
		$message = auto_url($message);
	$message = wysiwyg_parse($message, $smilies, $html);
	$message = add_word_breaks($message);
	if ($config['post_cache'])
	{
		if (!$forum)
			$forum = db_fetch_array(db_query("select * from forum where forumid=$thread[forumid]"));
		$parsed_message = stripslashes($message);
		if ($dpcode && $forum['dpcode'])
			$parsed_message = dpcode_parse($parsed_message, $forum['img'], true, true);
		if ($smilies && $forum['smilies'])
			$parsed_message = smilie_parse($parsed_message);
		$parsed_message = addslashes(censor($parsed_message, $config['censored_words']));
	}
	db_query("insert into thread (name, iconid, userid, lastpostdate, lastuserid, posts, views, forumid, lastusername, username, lastpostid, closed, sticky, redirect, poll, poll_days, poll_multiple) values ('$subject', '$iconid', $user[userid], $current_time, $user[userid], 1, 0, $forum[forumid], '".addslashes($user['name']).'\', \''.addslashes($user['name']).'\', 0, 0, 0, 0, \'\', 0, 0)');
	$thread = db_fetch_array(db_query("select * from thread where userid=$user[userid] order by threadid desc limit 1"));
	db_query("insert into post (threadid, iconid, subject, message, userid, postdate, ip, username, dpcode, smilies, showsignature, url, html, parsed_message) values ($thread[threadid], $iconid, '$subject', '$message', $user[userid], $current_time, '$_SERVER[REMOTE_ADDR]', '".addslashes($user['name'])."', '$dpcode', '$smilies', '$showsignature', '$url', '$html', '$parsed_message')");
	$query = db_query("select * from post where threadid=$thread[threadid] and userid=$user[userid] order by postid desc limit 1");
	$post = db_fetch_array($query);
	db_query("update thread set lastpostid='$post[postid]' where threadid='$thread[threadid]'");
	$thread['lastpostid'] = $post['postid'];
	$forumarray = get_forum_parents($forum['forumid']);
	$inforums = '';
	while (list($forumextra, $forumbump) = each($forumarray))
		$inforums .= ",$forumbump[forumid]";
	if ($inforums)
		db_query("update forum set threadiconid='$iconid',threadname='".censor($subject_forum)."',lastthreadid=$thread[threadid],lastforumid=$thread[forumid],lastuserid=$user[userid],lastpostid=$post[postid],lastpostdate=$current_time,posts=posts+1,threads=threads+1,lastusername='".addslashes($user['name']).'\' where forumid in ('.substr($inforums, 1).')');
	if ($forum['countposts'] && !$group['lockpostcount'])
		db_query("update user set posts=posts+1,lastpost=$post[postid] where userid=$user[userid]");
	else
		db_query("update user set lastpost=$post[postid] where userid=$user[userid]");
	return $thread;
}

function smilie_box()
{
	extract($GLOBALS, EXTR_OVERWRITE, '');
	$showmore = false;
	$showtags = false;
	$query = db_query('select * from smilie where ordered>0 order by ordered');
	$total = db_num_rows($query);
	$row = 0;
	$total = 0;
	while ($smilie = db_fetch_array($query))
	{
		if (++$total>$config['number_smilies'])
			$showmore = true;
		else
		{
			$smilie['image'] = parse_image($smilie['image']);
			$smilie['escaped_tag'] = str_replace('\'', '\\\'', $smilie['tag']);
			eval(store_template('smilie_column'));
			$smilie_row .= $smilie_column;
			if (++$row>=$config['smilies_row'])
			{
				eval(store_template('smilie_row', '$smilie_result'));
				$smilies .= $smilie_result;
				$smilie_row = '';
				$row = 0;
			}
		}
	}
	if ($smilie_row)
	{
		eval(store_template('smilie_row', '$smilie_result'));
		$smilies .= $smilie_result;
	}
	if ($total)
		eval(store_template('smilie_box'));
	return $smilie_box;
}

function smilie_parse($text, $admin=false)
{
	global $smiliestore;
	get_smilie_store();
	$text = preg_replace('/&((#[\d]{1,5}?)|([a-z]*?));\)/i', '&\1;<span></span>)', $text);
	preg_match_all('/\{\:smilie\:\}(.*?)\{\:endsmilie\:\}/', $text, $match, PREG_SET_ORDER);
	$i = $s = 0;
	foreach ($match as $smilie)
	{
		$text = str_replace($smilie[0], '||smilie::' . $s . '||', $text);
		$smilies[$s++] = $smilie[1];
	}
	$add_tag = true;
	while ($smilie = $smiliestore[$i++])
	{
		if ($admin && strstr($smilie['smilie_image'], ' src="../'))
			$smilie['smilie_image'] = str_replace(' src="../', ' src="', $smilie['smilie_image']);
		if ($smilie['insensitive']==1)
			$text = str_ireplace($smilie['tag'], $smilie['smilie_image'], $text);
		else
			$text = str_replace($smilie['tag'], $smilie['smilie_image'], $text);
	}
	if (is_array($smilies))
	{
		foreach ($smilies as $smilieI => $smilie)
			$text = str_replace("||smilie::$smilieI||", $smilie, $text);
	}
	return str_replace('<span></span>)', ')', $text);
}

function wysiwyg_parse($message, $smilies = true, $html = false)
{
	global $style, $dpcodestore;
	$message = stripslashes($message);
	$i = 0;
	while ($dpcode = $dpcodestore[$i++])
	{
		if (strstr($dpcode['replacement'], '{option}'))
		{
			$dpcode['replacement'] = str_replace('{param}', '(.*?)', $dpcode['replacement']);
			$dpcode['replacement'] = str_replace('{option}', '(.*?)', $dpcode['replacement']);
			$message = preg_replace('/' . preg_quote($dpcode['replacement'], '/') . '/si', "[$dpcode[tag]=\\1]\\2[/$dpcode[tag]]", $message);
		}
		else
		{
			$dpcode['replacement'] = str_replace('{param}', '(.*?)', $dpcode['replacement']);
			$message = preg_replace('/' . preg_quote($dpcode['replacement'], '/') . '/si', "[$dpcode[tag]]\\1[/$dpcode[tag]]", $message);
		}
	}
	if (!$html)
		$message = dp_htmlspecialchars($message);
	
	$message = str_replace("\n", '<br />', $message);
	return addslashes($message);
}

function wysiwyg_smilie_parse($text)
{
	global $smiliestore, $config;
	get_smilie_store();
	preg_match_all('/\{\:smilie\:\}(.*?)\{\:endsmilie\:\}/', $text, $match, PREG_SET_ORDER);
	$i = $s = 0;
	foreach ($match as $smilie)
	{
		$text = str_replace($smilie[0], '||smilie::' . $s . '||', $text);
		$smilies[$s++] = $smilie[1];
	}
	while ($smilie = $smiliestore[$i++])
	{
		if (substr($smilie['image'], 0, 7)!='http://' && substr($smilie['image'], 0, 6)!='ftp://')
			$smilie['parsed_image'] = "$config[url]/$smilie[image]";
		if ($smilie['insensitive'])
			$text = str_ireplace($smilie['tag'], "<img src=\"$smilie[parsed_image]\" tag=\"$smilie[tag]\">", $text);
		else
			$text = str_replace($smilie['tag'], "<img src=\"$smilie[parsed_image]\" tag=\"$smilie[tag]\">", $text);
	}
	if (is_array($smilies))
	{
		foreach ($smilies as $smilieI => $smilie)
			$text = str_replace("||smilie::$smilieI||", $smilie, $text);
	}

	return $text;
}
?>