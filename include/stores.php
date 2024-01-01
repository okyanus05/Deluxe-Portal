<?php
/**************************************************
* Stores API
* ----------
* get_changergroup_store()
* get_dpcode_store()
* get_forum_store($id=0)
* get_group_store()
* get_icon_store()
* get_ignore_store()
* get_markforumread_store()
* get_markread_store($id)
* get_moderator_store()
* get_online_section_store()
* get_online_topic_store()
* get_permission_store()
* get_rule_store()
* get_section_store()
* get_smilie_store()
* get_template_store()
* get_title_store()
* get_topic_store()
* 
* Deluxe Portal Version 2.0
**************************************************/

/**************************************************
* Global variable resetting                      */
unset($changergroupstore);
unset($downloadstore);
unset($dpcodestore);
unset($forumstore);
unset($forumstoreid);
unset($groupstore);
unset($groupstoreid);
unset($groupquery);
unset($iconstore);
unset($ignorestore);
unset($linkstore);
unset($markforumreadstore);
unset($markreadstore);
unset($moderatorstore);
unset($permissionstore);
unset($rulestore);
unset($sectionstore);
unset($sectionstoreid);
unset($smiliestore);
unset($style);
unset($templatestore);
unset($totaltemplates);
unset($titlestore);
unset($topicstore);
unset($topicstoreid);
unset($user);
/*************************************************/


function get_changergroup_store()
{
	global $changergroupstore;
	if ($changergroupstore)
		return;
	$query = db_query('select * from changergroups');
	$i=0;
	while ($store_result = db_fetch_array($query))
	{
		if ($oldgroup!=$store_result['groupruleid'])
		{
			$oldgroup = $store_result['groupruleid'];
			$i = 0;
		}
		$changergroupstore[$store_result['groupruleid']][$i++] = $store_result;
	}
}

function get_dpcode_store()
{
	global $dpcodestore;
	if ($dpcodestore)
		return;
	$query = db_query('select * from dpcode');
	$i=0;
	while ($dpcode_result = db_fetch_array($query))
	{
		$dpcode_result['replacement'] = str_replace('[', '&#091;', $dpcode_result['replacement']);
		$dpcode_result['option'] = strpos($dpcode_result['replacement'], '{option}')===false ? false : true;
		$dpcode_result['tag'] = preg_quote($dpcode_result['tag'], '/');
		$dpcodestore[$i++] = $dpcode_result;
	}
}

function get_forum_store($id=0)
{
	global $forumstore, $forumstoreid;
	if ($forumstore)
		return;
	$query = db_query('select forum.*,icon.name as icon_name,icon.image as icon_image from forum left join icon on forum.threadiconid=icon.iconid order by forum.ordered asc');
	$i = 0;
	while ($store_result = db_fetch_array($query))
	{
		$store_result['threadfullname'] = htmlspecialchars($store_result['threadname']);
		if ($store_result['threadiconid'])
			$store_result['icon_image'] = parse_image($store_result['icon_image']);
		if (dp_strlen($store_result['threadname']) > 23)
			$store_result['threadname'] = trim(dp_substr($store_result['threadname'], 0, 23)) . '...';
		$store_result['threadname'] = htmlspecialchars($store_result['threadname']);
		if ($id==$store_result['forumid'])
			$forum = $store_result;
		$forumstore[$i++] = $store_result;
		$forumstoreid[$store_result['forumid']] = $store_result;
	}
	return $forum;
}

function get_group_store()
{
	global $groupstore, $groupstoreid;
	if ($groupstore)
		return;
	$query = db_query('select * from groups order by name asc');
	$i = 0;
	while ($store_result = db_fetch_array($query))
	{
		$groupstore[$i++] = $store_result;
		$groupstoreid[$store_result['groupid']] = $store_result;
	}
}

function get_icon_store()
{
	global $iconstore;
	if ($iconstore)
		return;
	$query = db_query('select * from icon');
	$i=0;
	while ($icon_result = db_fetch_array($query))
		$iconstore[$icon_result['iconid']] = $icon_result;
}

function get_ignore_store()
{
	global $ignorestore, $user;
	if ($ignorestore)
		return;
	$query = db_query("select * from ignorelist where userid=$user[userid]");
	while ($ignore_result = db_fetch_array($query))
		$ignorestore[$ignore_result['ignoreuserid']] = $ignore_result;
}

function get_markforumread_store()
{
	global $markforumreadstore, $user;
	if ($markforumreadstore)
		return;
	$query = db_query("select count(*),thread.forumid from thread where redirect=0 and lastpostdate>$user[lastvisit] group by forumid");
	while ($store_result = db_fetch_array($query))
		$markforumreadstore[$store_result['forumid']] = $store_result[0];
	$query = db_query("select count(*),thread.forumid from markread,thread where thread.redirect=0 and thread.lastpostdate>$user[lastvisit] and markread.threadid=thread.threadid and markread.userid=$user[userid] and markread.postid=thread.lastpostid group by thread.forumid");
	while ($store_result = db_fetch_array($query))
		$markforumreadstore[$store_result['forumid']] -= $store_result[0];
}

function get_markread_store($id)
{
	global $markreadstore, $user;
	if ($markreadstore)
		return;
	$query = db_query("select markread.* from markread,thread where markread.userid=$user[userid] and markread.threadid=thread.threadid and thread.forumid='$id'");
	while ($store_result = db_fetch_array($query))
		$markreadstore[$store_result['threadid']] = $store_result;
}

function get_moderator_store()
{
	global $moderatorstore;
	if ($moderatorstore)
		return;
	$query = db_query('select moderator.*,groups.online_template,groups.online_template_large from moderator,user,groups where moderator.userid=user.userid and user.groupid=groups.groupid order by moderator.username asc');
	while ($store_result = db_fetch_array($query))
		$moderatorstore[$store_result['forumid']][] = $store_result;
}

function get_online_download_store()
{
	global $groupquery, $downloadstore;
	if ($downloadstore)
		return;
	$query = db_query("select downloadpermissions.*,downloadcategory.name from downloadpermissions,downloadcategory where downloadcategory.downloadcategoryid=downloadpermissions.downloadcategoryid and ($groupquery) group by downloadcategoryid");
	while ($category = db_fetch_array($query))
		$downloadstore[$category['downloadcategoryid']] = $category;
}

function get_online_link_store()
{
	global $groupquery, $linkstore;
	if ($linkstore)
		return;
	$query = db_query("select linkpermissions.*,linkcategory.name from linkpermissions,linkcategory where linkcategory.linkcategoryid=linkpermissions.linkcategoryid and ($groupquery) group by linkcategoryid");
	while ($category = db_fetch_array($query))
		$linkstore[$category['linkcategoryid']] = $category;
}

function get_online_section_store()
{
	global $groupquery, $sectionstore;
	if ($sectionstore)
		return;
	$query = db_query("select sectionpermissions.*,section.name from section,sectionpermissions where view=1 and section.sectionid=sectionpermissions.sectionid and ($groupquery) group by sectionid");
	while ($section = db_fetch_array($query))
		$sectionstore[$section['sectionid']] = $section;
}

function get_online_topic_store()
{
	global $groupquery, $topicstore;
	if ($topicstore)
		return;
	$query = db_query("select topicpermissions.*,topic.name from topic,topicpermissions where view=1 and topic.topicid=topicpermissions.topicid and ($groupquery) group by topicid");
	while ($topic = db_fetch_array($query))
		$topicstore[$topic['topicid']] = $topic;
}

function get_permission_store()
{
	global $permissionstore;
	if ($permissionstore)
		return;
	$query = db_query('select * from forumpermission');
	while ($perm_res = db_fetch_array($query))
		$permissionstore[$perm_res['forumid']][$perm_res['groupid']] = $perm_res;
}

function get_rule_store()
{
	global $rulestore;
	if ($rulestore)
		return;
	$query = db_query('select * from grouprules');
	$i=0;
	while ($store_result = db_fetch_array($query))
		$rulestore[$i++] = $store_result;
}

function get_section_store()
{
	global $sectionstore, $sectionstoreid;
	if ($sectionstore)
		return;
	$query = db_query('select * from section order by name asc');
	$i = 0;
	while ($store_result = db_fetch_array($query))
	{
		$sectionstore[$i++] = $store_result;
		$sectionstoreid[$store_result['sectionid']] = $store_result;
	}
}

function get_smilie_store()
{
	global $smiliestore;
	if ($smiliestore)
		return;
	$query = db_query('select * from smilie order by LENGTH(tag) desc');
	$i=0;
	while ($smilie = db_fetch_array($query))
	{
		$smilie['parsed_image'] = parse_image($smilie['image']);
		$smilie['tag1'] = $smilie['tag'];
		$smilie['tag'] = htmlspecialchars($smilie['tag']);
		eval(store_template('smilie', '$smilie_image'));
		$smilie['tag'] = $smilie['tag1'];
		$smilie['smilie_image'] = $smilie_image;
		$smiliestore[$i++] = $smilie;
	}
}

function get_template_store()
{
	global $admincache, $style, $templatecache, $templatestore, $totaltemplates;
	if ($admincache)
		$templatesused = explode (',', $admincache);
	else
		$templatesused = explode (',', $templatecache);
		
	foreach ($templatesused as $used)
		$templatequery .= ",'$used'";
	$templatequery = dp_substr($templatequery, 1);
	if ($admincache)
		$query = db_query("select * from parsedtemplate where name in ($templatequery) and templatesetid=1");
	else
		$query = db_query("select * from parsedtemplate where name in ($templatequery) and templatesetid=$style[templatesetid]");
	while($get_template = db_fetch_array($query))
		$templatestore[$get_template['name']] = $get_template['body'];
	$totaltemplates = count($templatestore);
}

function get_title_store()
{
	global $titlestore;
	if ($titlestore)
		return;
	$query = db_query('select * from title order by groupid,posts asc');
	$i=0;
	while ($usertitle = db_fetch_array($query))
		$titlestore[$i++] = $usertitle;
}

function get_topic_store()
{
	global $topicstore, $topicstoreid;
	if ($topicstore)
		return;
	$query = db_query('select * from topic order by name asc');
	$i = 0;
	while ($store_result = db_fetch_array($query))
	{
		$topicstore[$i++] = $store_result;
		$topicstoreid[$store_result['topicid']] = $store_result;
	}
}
?>