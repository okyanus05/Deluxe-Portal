<?php
/**************************************************
* Forum API
* ---------
* get_forum_jump($id=0)
* get_forum_nav($id, $link=true)
* get_forum_parents($forumid, $depth=0)
* get_forum_permissions($forum)
* get_forum_permissions_group($forum, $group)
* get_forums($parentid, $depth=0)
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache .= ',forumjump_forum,forumnav_link,forumnav_nolink,option_indention';
if ($admincache)
	$admincache .= ',option_indention';
/**************************************************
* Global variable resetting                      */
unset($depth_list);
unset($forumarray_list);
unset($forumarray_nav);
unset($forumindex_list);
unset($forumindex_nav);
unset($forumjump);
unset($forumstore);
unset($forumstoreid);
unset($grouparray);
unset($permissionstore);
unset($selected);
/*************************************************/

function get_forum_jump($id=0)
{
	global $config, $forumjump, $forumstore, $selected;
	if ($forumarray = get_forums(0))
	{
		while (list($key, $forum_result) = each($forumarray))
		{
			$jumpperm = get_forum_permissions($forum_result);
			if (!$jumpperm['viewforums'] && $config['hideforums'])
				continue;
			if (!$forum_result['ordered'])
				continue;
			for ($i=0; $i<$forum_result['depth']; $i++)
			{
				eval(store_template('option_indention'));
				$forum_result['name'] = $option_indention.$forum_result['name'];
			}
			if ($forum_result['forumid']==$id)
				$selected = true;
			else
				$selected = false;
			eval(store_template('forumjump_forum', '$forum_choice'));
			$forumjump .= $forum_choice;
		}
	}
	reset($forumstore);
}

function get_forum_nav($id, $link=true)
{
	global $forums, $forumstore;
	get_forum_store();
	if ($forumarray = get_forum_parents($id))
	{
		$forumarray = array_reverse($forumarray);
		while (list($forumextra, $forumnav) = each($forumarray))
		{
			if ($forumnav['forumid']==$id)
				$forum = $forumnav;
			$forumnav['description'] = htmlspecialchars($forumnav['description']);
			ob_start();
				if ($link || $forum['forumid']!=$id)
					eval(get_template('forumnav_link'));
				else
					eval(get_template('forumnav_nolink'));
				$forumnav_result = ob_get_contents();
			ob_end_clean();
			$forums .= $forumnav_result;
		}
	}
	reset($forumstore);
	return $forum;
}

function get_forum_parents($forumid, $depth=0)
{
	global $forumarray_nav, $forumindex_nav, $forumstoreid;
	get_forum_store();
	$depth++;
	if ($forumid)
	{
		$forum = $forumstoreid[$forumid];
		$forumarray_nav[$forumindex_nav++] = $forum;
		get_forum_parents($forum['parentid'], $depth);
	}
	$depth--;
	$forumarray = $forumarray_nav;
	if (!$depth)
	{
		$forumarray_nav = '';
		$forumindex_nav = 0;
	}
	return $forumarray;
}

function get_forum_permissions($forum)
{
	global $forumstoreid, $grouparray, $permissionstore;
	get_permission_store();
	get_forum_store();
	while (list($groupextra, $group) = each($grouparray))
	{
		$perm = $permissionstore[$forum['forumid']][$group['groupid']];
		if ($perm['type']=='group')
			$perm = $group;
		elseif ($perm['type']=='parent')
		{
			$forumid = $forum['forumid'];
			while (true)
			{
				$perm = $permissionstore[$forumstoreid[$forumid]['parentid']][$group['groupid']];
				if ($perm['type'] == 'group')
					$perm = $group;
				if ($perm['type']!='parent')
					break;
				elseif ($perm['type']=='parent' && !$forumstoreid[$forumid]['parentid'])
					$perm = $group;
				else
					$forumid = $forumstoreid[$forumid]['parentid'];
				if (!$forumstoreid[$forumid]['forumid'])
					break;
			}
		}
		$permres['close'] |= $perm['close'];
		$permres['copymove'] |= $perm['copymove'];
		$permres['deleteposts'] |= $perm['deleteposts'];
		$permres['deletethreads'] |= $perm['deletethreads'];
		$permres['editposts'] |= $perm['editposts'];
		$permres['editthreads'] |= $perm['editthreads'];
		$permres['postattachments'] |= $perm['postattachments'];
		$permres['postthreads'] |= $perm['postthreads'];
		$permres['replytoother'] |= $perm['replytoother'];
		$permres['replytoown'] |= $perm['replytoown'];
		$permres['startpolls'] |= $perm['startpolls'];
		$permres['viewattachments'] |= $perm['viewattachments'];
		$permres['viewforums'] |= $perm['viewforums'];
		$permres['viewthreads'] |= $perm['viewthreads'];
		$permres['votepolls'] |= $perm['votepolls'];
	}
	reset($grouparray);
	return $permres;
}

function get_forum_permissions_group($forum, $group)
{
	global $permissionstore, $forumstoreid;
	get_permission_store();
	get_forum_store();
	$perm = $permissionstore[$forum['forumid']][$group['groupid']];
	if ($perm['type']=='group')
		$perm = $group;
	elseif ($perm['type']=='parent')
	{
		$forumid = $forum['forumid'];
		while (true)
		{
			$perm = $permissionstore[$forumstoreid[$forumid]['parentid']][$group['groupid']];
			if ($perm['type'] == 'group')
				$perm = $group;
			if ($perm['type']!='parent')
				break;
			elseif ($perm['type']=='parent' && !$forumstoreid[$forumid]['parentid'])
				$perm = $group;
			else
				$forumid = $forumstoreid[$forumid]['parentid'];
			if (!$forumstoreid[$forumid]['forumid'])
				break;
		}
	}
	return $perm;
}

function get_forums($parentid, $depth = 0, $maxdepth = 4294967296)
{
	global $ex, $depth_list, $forumarray_list, $forumindex_list, $forumstore;
	get_forum_store();
	$i=0;
	$depth++;
	if ($depth<=$maxdepth)
	{
		while ($forum = $forumstore[$i++])
		{
			if ($forum['parentid']!=$parentid)
				continue;
			else
			{
				$forumarray_list[$forumindex_list] = $forum;
				$forumarray_list[$forumindex_list++]['depth'] = $depth_list;
				$depth_list++;
				get_forums($forum['forumid'], $depth);
				$depth_list--;
			}
		}
	}
	$forumarray = $forumarray_list;
	$depth--;
	if (!$depth)
	{
		$depth_list = 0;
		$forumarray_list = '';
		$forumindex_list = 0;
	}
	return $forumarray;
}
?>