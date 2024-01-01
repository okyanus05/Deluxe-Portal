<?php
/**************************************************
* Topics
* ------
* Allows you to manage news topics.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'add_topic,deleteothersgroup_choice,deleteowngroup_choice,delete_topic,delete_topic_denied,editothersgroup_choice,editowngroup_choice,edit_topic,forum_choice,invalid_topic,postgroup_choice,topics_duplicate,topics_index,topics_missing,topics_row,topics_topic,viewgroup_choice';
/**************************************************
* Global variable resetting                      */
unset($deleteothers_groups_col1);
unset($deleteothers_groups_col2);
unset($deleteothers_groups_col3);
unset($deleteown_groups_col1);
unset($deleteown_groups_col2);
unset($deleteown_groups_col3);
unset($editothers_groups_col1);
unset($editothers_groups_col2);
unset($editothers_groups_col3);
unset($editown_groups_col1);
unset($editown_groups_col2);
unset($editown_groups_col3);
unset($forum_choices);
unset($post_groups_col1);
unset($post_groups_col2);
unset($post_groups_col3);
unset($topics);
unset($view_groups_col1);
unset($view_groups_col2);
unset($view_groups_col3);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$id = $_REQUEST['id'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
/*************************************************/

$pagetitle = 'Topics';

if ($group['topics'])
{
	if ($_REQUEST['op']=='add')
	{
		$query = db_query('select * from groups order by name asc');
		$num_col1 = ceil(db_num_rows($query)/3);
		$remaining = db_num_rows($query) - $num_col1;
		$num_col2 = $num_col1 + ceil($remaining/2);
		$i = 0;
		while ($group_result = db_fetch_array($query))
		{
			$checked = true;
			eval(store_template('viewgroup_choice', '$view_group'));
			if ($group_result['articles'])
				$checked = true;
			else
				$checked = false;
			eval(store_template('postgroup_choice', '$post_group'));
			eval(store_template('editowngroup_choice', '$editown_group'));
			eval(store_template('deleteowngroup_choice', '$deleteown_group'));
			if ($group_result['articles'] && $group_result['sections'])
				$checked = true;
			else
				$checked = false;
			eval(store_template('editothersgroup_choice', '$editothers_group'));
			eval(store_template('deleteothersgroup_choice', '$deleteothers_group'));
			if (++$i<=$num_col1)
			{
				$post_groups_col1 .= $post_group;
				$editown_groups_col1 .= $editown_group;
				$editothers_groups_col1 .= $editothers_group;
				$view_groups_col1 .= $view_group;
				$deleteown_groups_col1 .= $deleteown_group;
				$deleteothers_groups_col1 .= $deleteothers_group;
			}
			elseif ($i<=$num_col2)
			{
				$post_groups_col2 .= $post_group;
				$editown_groups_col2 .= $editown_group;
				$editothers_groups_col2 .= $editothers_group;
				$view_groups_col2 .= $view_group;
				$deleteown_groups_col2 .= $deleteown_group;
				$deleteothers_groups_col2 .= $deleteothers_group;
			}
			else
			{
				$post_groups_col3 .= $post_group;
				$editown_groups_col3 .= $editown_group;
				$editothers_groups_col3 .= $editothers_group;
				$view_groups_col3 .= $view_group;
				$deleteown_groups_col3 .= $deleteown_group;
				$deleteothers_groups_col3 .= $deleteothers_group;
			}
		}
		$selected = false;
		get_forum_store();
		if ($forumarray = get_forums(0))
		{
			while (list($forumextra, $forum_result) = each($forumarray))
			{
				$perm = get_forum_permissions($forum_result);
				if (!$perm['viewforums'])
					continue;
				for ($i=0; $i<$forum_result['depth']; $i++)
				{
					eval(store_template('option_indention'));
					$forum_result['name'] = $option_indention.$forum_result['name'];
				}
				eval(store_template('forum_choice'));
				$forum_choices .= $forum_choice;
			}
		}
		eval(get_template('add_topic'));
	}
	elseif ($_POST['op']=='doadd')
	{
		if ($name = trim(htmlspecialchars($name)))
		{
			if ($duplicate = db_fetch_array(db_query("select * from topic where name='$name'")))
				die(eval(get_template('topics_duplicate')));
			adminlog("Added topic - <b>$name</b>");
			if ($_POST['transfer']=='upload')
				$image = upload_image('topic', 1);
			else
				$image = $_POST['image_location'];
			db_query("insert into topic (name, image, forumid) values ('$name', '$image', '$_POST[forumid]')");
			$topic = db_fetch_array(db_query('select topicid from topic order by topicid desc limit 1'));
			$query = db_query('select groupid from groups');
			while ($group_result = db_fetch_array($query))
			{
				$view = ($_POST["view_$group_result[groupid]"] ? 1 : 0);
				$editown = ($_POST["editown_$group_result[groupid]"] ? 1 : 0);
				$editothers = ($_POST["editothers_$group_result[groupid]"] ? 1 : 0);
				$deleteown = ($_POST["deleteown_$group_result[groupid]"] ? 1 : 0);
				$deleteothers = ($_POST["deleteothers_$group_result[groupid]"] ? 1 : 0);
				$post = ($_POST["post_$group_result[groupid]"] ? 1 : 0);
				db_query("insert into topicpermissions (topicid, groupid, view, post, editown, editothers, deleteown, deleteothers) values ($topic[topicid], $group_result[groupid], $view, $post, $editown, $editothers, $deleteown, $deleteothers)");
			}
			header('Location: topics.php');
		}
		else
			eval(get_template('topics_missing'));
	}
	elseif ($op=='edit')
	{
		if ($topic = db_fetch_array(db_query("select * from topic where topicid='$id'")))
		{
			adminlog("Edited topic - <b>$topic[name] ($topic[topicid])</b>");
			$query = db_query("select * from topicpermissions where topicid='$topic[topicid]'");
			$view_groups = ',';
			$post_groups = ',';
			$editown_groups = ',';
			$editothers_groups = ',';
			$deleteown_groups = ',';
			$deleteothers_groups = ',';
			while ($perm = db_fetch_array($query))
			{
				if ($perm['view'])
					$view_groups .= "$perm[groupid],";
				if ($perm['post'])
					$post_groups .= "$perm[groupid],";
				if ($perm['editown'])
					$editown_groups .= "$perm[groupid],";
				if ($perm['editothers'])
					$editothers_groups .= "$perm[groupid],";
				if ($perm['deleteown'])
					$deleteown_groups .= "$perm[groupid],";
				if ($perm['deleteothers'])
					$deleteothers_groups .= "$perm[groupid],";
			}
			$query = db_query('select * from groups order by name asc');
			$num_col1 = ceil(db_num_rows($query)/3);
			$remaining = db_num_rows($query) - $num_col1;
			$num_col2 = $num_col1 + ceil($remaining/2);
			$i = 0;
			while ($group_result = db_fetch_array($query))
			{
				if (strstr($post_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('postgroup_choice', '$post_group'));
				if (strstr($view_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('viewgroup_choice', '$view_group'));
				if (strstr($editown_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('editowngroup_choice', '$editown_group'));
				if (strstr($editothers_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('editothersgroup_choice', '$editothers_group'));
				if (strstr($deleteown_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('deleteowngroup_choice', '$deleteown_group'));
				if (strstr($deleteothers_groups, ",$group_result[groupid],"))
					$checked = true;
				else
					$checked = false;
				eval(store_template('deleteothersgroup_choice', '$deleteothers_group'));
				if (++$i<=$num_col1)
				{
					$post_groups_col1 .= $post_group;
					$editown_groups_col1 .= $editown_group;
					$editothers_groups_col1 .= $editothers_group;
					$view_groups_col1 .= $view_group;
					$deleteown_groups_col1 .= $deleteown_group;
					$deleteothers_groups_col1 .= $deleteothers_group;
				}
				elseif ($i<=$num_col2)
				{
					$post_groups_col2 .= $post_group;
					$editown_groups_col2 .= $editown_group;
					$editothers_groups_col2 .= $editothers_group;
					$view_groups_col2 .= $view_group;
					$deleteown_groups_col2 .= $deleteown_group;
					$deleteothers_groups_col2 .= $deleteothers_group;
				}
				else
				{
					$post_groups_col3 .= $post_group;
					$editown_groups_col3 .= $editown_group;
					$editothers_groups_col3 .= $editothers_group;
					$view_groups_col3 .= $view_group;
					$deleteown_groups_col3 .= $deleteown_group;
					$deleteothers_groups_col3 .= $deleteothers_group;
				}
			}
			get_forum_store();
			if ($forumarray = get_forums(0))
			{
				while (list($forumextra, $forum_result) = each($forumarray))
				{
					$perm = get_forum_permissions($forum_result);
					if (!$perm['viewforums'])
						continue;
					for ($i=0; $i<$forum_result['depth']; $i++)
					{
						eval(store_template('option_indention'));
						$forum_result['name'] = $option_indention.$forum_result['name'];
					}
					if ($forum_result['forumid']==$topic['forumid'])
						$selected = true;
					else
						$selected = false;
					eval(store_template('forum_choice'));
					$forum_choices .= $forum_choice;
				}
			}
			eval(get_template('edit_topic'));
		}
		else
			eval(get_template('invalid_topic'));
	}
	elseif ($_POST['op']=='doedit')
	{
		if ($topic = db_fetch_array(db_query("select * from topic where topicid='$id'")))
		{
			if ($name = trim(htmlspecialchars($name)))
			{
				if ($duplicate = db_fetch_array(db_query("select * from topic where name='$name' and topicid!='$topic[topicid]'")))
					die(eval(get_template('topics_duplicate')));
				adminlog("Updated topic - <b>$topic[name] ($topic[topicid])</b>");
				if ($_POST['transfer']=='upload')
				{
					$image = ',image=\''.upload_image('topic', 1).'\'';
					if (dp_substr($topic['image'], 0, 1)==':')
						db_query('delete from imagestore where imageid=\''.dp_substr($topic['image'], 1).'\'');
				}
				elseif ($_POST['transfer']=='location')
				{
					$image = ",image='$_POST[image_location]'";
					if (dp_substr($topic['image'], 0, 1)==':')
						db_query('delete from imagestore where imageid=\''.dp_substr($topic['image'], 1).'\'');
				}
				else
					$image = '';
				db_query("update topic set name='$name',forumid='$_POST[forumid]'$image where topicid='$topic[topicid]'");
				$query = db_query('select groupid from groups');
				while ($group_result = db_fetch_array($query))
				{
					$view = ($_POST["view_$group_result[groupid]"] ? 1 : 0);
					$editown = ($_POST["editown_$group_result[groupid]"] ? 1 : 0);
					$editothers = ($_POST["editothers_$group_result[groupid]"] ? 1 : 0);
					$deleteown = ($_POST["deleteown_$group_result[groupid]"] ? 1 : 0);
					$deleteothers = ($_POST["deleteothers_$group_result[groupid]"] ? 1 : 0);
					$post = ($_POST["post_$group_result[groupid]"] ? 1 : 0);
					db_query("update topicpermissions set view=$view,post=$post,editown=$editown,editothers=$editothers,deleteown=$deleteown,deleteothers=$deleteothers where topicid='$topic[topicid]' and groupid=$group_result[groupid]");
				}
				header('Location: topics.php');
			}
			else
				eval(get_template('topics_missing'));
		}
		else
			eval(get_template('invalid_topic'));
	}
	elseif ($op=='delete')
	{
		if ($topic = db_fetch_array(db_query("select * from topic where topicid='$id'")))
		{
			if (db_num_rows(db_query("select articleid from article where topicid='$topic[topicid]'")))
				die(eval(get_template('delete_topic_denied')));
			$topic['parsed_image'] = parse_image($topic['image']);
			eval(get_template('delete_topic'));
		}
		else
			eval(get_template('invalid_topic'));
	}
	elseif ($_POST['op']=='dodelete')
	{
		if ($topic = db_fetch_array(db_query("select * from topic where topicid='$id'")))
		{
			if (db_num_rows(db_query("select articleid from article where topicid='$topic[topicid]'")))
				die(eval(get_template('delete_topic_denied')));
			adminlog("Deleted topic - <b>$topic[name] ($topic[topicid])</b>");
			db_query("delete from topic where topicid='$topic[topicid]'");
			db_query("delete from topicpermissions where topicid='$topic[topicid]'");
			if (dp_substr($topic['image'], 0, 1)==':')
				db_query('delete from imagestore where imageid=\''.dp_substr($topic['image'], 1).'\'');
			header('Location: topics.php');
		}
		else
			eval(get_template('invalid_topic'));
	}
	else
	{
		$query = db_query('select * from topic order by name asc');
		$n = 0;
		while ($n<db_num_rows($query))
		{
			$topic_col = '';
			for ($i=0; $i<$config['topics_per_row']; $i++)
			{
				$n++;
				$topic = db_fetch_array($query);
				$topic['parsed_image'] = parse_image($topic['image']);
				eval(store_template('topics_topic'));
				$topic_col .= $topics_topic;
			}
			eval(store_template('topics_row'));
			$topics .= $topics_row;
		}
		adminlog('Viewed topics panel');
		eval(get_template('topics_index'));
	}
}
else
	eval(get_template('permission_error'));
?>