<?php
/**************************************************
* Users
* -----
* Allows moderators to view full user profile
* information, search for users, and ban users.
* 
* Deluxe Portal Version 2.0
**************************************************/
$admincache = 'ban_user,ban_user_redirect,mod_check_ip,check_ip_result,mod_check_ip_results,custom_field,group_choice,invalid_user,styleset_choice,usergroup_choice,modusers_index,modusers_search,modusers_search_result,modusers_user,view_user';
/**************************************************
* Global variable resetting                      */
unset($customfields);
unset($groups);
unset($stylesets);
unset($usergroups_col1);
unset($usergroups_col2);
unset($users);
/*************************************************/
require('../function.php');
/**************************************************
* Variable initialization                        */
$aol = $_POST['aol'];
$email = $_POST['email'];
$groupid = $_POST['groupid'];
$icq = $_POST['icq'];
$id = $_REQUEST['id'];
$location = $_POST['location'];
$maxjoin = $_POST['maxjoin'];
$maxposts = $_POST['maxposts'];
$message = $_POST['message'];
$minjoin = $_POST['minjoin'];
$minposts = $_POST['minposts'];
$msn = $_POST['msn'];
$name = $_POST['name'];
$op = $_REQUEST['op'];
$signature = $_POST['signature'];
$stylesetid = $_REQUEST['stylesetid'];
$subject = $_POST['subject'];
$title = $_POST['title'];
$username = $_POST['username'];
$website = $_POST['website'];
$yahoo = $_POST['yahoo'];
/*************************************************/

$pagetitle = 'Users';

if ($group['supermod_viewfullprofiles'] || $group['supermod_banusers'])
{
	if ($op=='search')
	{
		moderatorlog('Viewed user search results', 0, '');
		$color = 'cellalt';
		$usergroupquery = '';
		$query = db_query('select groupid from groups');
		while ($group_result = db_fetch_array($query))
		{
			if ($_REQUEST["group_$group_result[groupid]"] || $_REQUEST['all_groups'])
				$usergroupquery .= "FIND_IN_SET($group_result[groupid], usergroups) or ";
		}
		$usergroupquery = dp_substr($usergroupquery, 0, -4);
		if (!$usergroupquery)
			$usergroupquery = 'FIND_IN_SET(0, usergroups)';
		get_group_store();
		if (!$_REQUEST['all'])
		{
			$fieldquery = '';
			$tablelist = '';
			$i = 1;
			$query = db_query('select * from customfield');
			while ($field = db_fetch_array($query))
			{
				if ($_POST["field_$field[customfieldid]"])
				{
					$tablelist .= ",usercustomfield as c$i";
					$fieldquery .= " and (c$i.customfieldid=$field[customfieldid] and c$i.userid=user.userid and c$i.value like '%".escape_like($_POST["field_$field[customfieldid]"]).'%\')';
					$i++;
				}
			}
			$name = htmlspecialchars(addslashes($name));
			$query = db_query("select * from user$tablelist where user.name like '%".escape_like($name)."%' ".($stylesetid ? "and stylesetid='$stylesetid' " : '')."and website like '%".escape_like($website)."%' and email like '%".escape_like($email)."%' and aol like '%".escape_like($aol)."%' and icq like '%".escape_like($icq)."%' and msn like '%".escape_like($msn)."%' and yahoo like '%".escape_like($yahoo)."%' and title like '%".escape_like($_REQUEST['title'])."%' and posts>='$minposts' and posts<='$maxposts'".($minjoin && $minjoin!='1969-12-31' ? " and joindate>=UNIX_TIMESTAMP('$minjoin')" : '').($maxjoin && $maxjoin!='2029-12-31' ? " and joindate<=UNIX_TIMESTAMP('$maxjoin')" : '')." and uncached_signature like '%".escape_like($signature)."%' and location like '%".escape_like($location)."%' and ($usergroupquery)$fieldquery order by name");
		}
		else
			$query = db_query("select * from user where $usergroupquery order by user.name");
		while ($user_result = db_fetch_array($query))
		{
			if (db_num_rows($query)==1)
				die(header("Location: users.php?op=view&id=$user_result[userid]"));
			$color = ($color=='cellalt' ? 'cellmain' : 'cellalt');
			eval('$user_result[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($groupstoreid[$user_result['groupid']]['online_template_large'])).'";');
			$user_result['joindate'] = time_adjust($user_result['joindate'], $style['join_date_format']);
			$showemail = show_email($user_result);
			$showpm = show_pm($user_result);
			$showsearch = show_search($user_result);
			eval(store_template('modusers_search_result', '$user_name'));
			$users .= $user_name;
		}
		eval(get_template('modusers_search'));
	}
	elseif ($op=='ipcheck')
		eval(get_template('mod_check_ip'));
	elseif ($op=='doipcheck')
	{
		if (!$username)
		{
			$user_result = db_fetch_array(db_query("select name from user where userid='$_REQUEST[userid]'"));
			$username = $user_result['name'];
		}
		moderatorlog("Checked IP Addresses - Username <b>$username</b>, IP address <b>$_REQUEST[ipaddress]</b>", 0, '');
		$url = 'users.php';
		$query = db_query('select * from post where '.($username ? 'username=\''.addslashes($username)."' and " : '')."ip!=0 and ip!='' and ip like '".escape_like($_REQUEST['ipaddress'])."%' group by ".($username ? 'ip' : 'username').' order by postdate asc');
		unset($results);
		while ($ip = db_fetch_array($query))
		{
			$hostname = @gethostbyaddr($ip['ip']);
			eval(store_template('check_ip_result'));
			$results .= $check_ip_result;
		}
		eval(get_template('mod_check_ip_results'));
	}
	elseif ($op=='view')
	{
		if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
		{
			moderatorlog("Viewed user - <b>$user_result[name] ($user_result[userid])</b>", 0, '');
			$query = db_query('select * from groups order by name asc');
			$num_col1 = ceil(db_num_rows($query)/2);
			$i = 0;
			while ($group_result = db_fetch_array($query))
			{
				if ($group_result['groupid']==$user_result['groupid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('group_choice'));
				if (in_array($group_result['groupid'], explode(',', $user_result['usergroups'])) && $group_result['groupid']!=$user_result['groupid'])
					$checked = true;
				else
					$checked = false;
				eval(store_template('usergroup_choice'));
				if (++$i<=$num_col1)
					$usergroups_col1 .= $usergroup_choice;
				else
					$usergroups_col2 .= $usergroup_choice;
				$groups .= $group_choice;
			}
			
			$query = db_query("select * from customfield,usercustomfield where userid='$user_result[userid]' and customfield.customfieldid=usercustomfield.customfieldid order by ordered");
			while ($field = db_fetch_array($query))
			{
				$field['value'] = html_fix($field['value']);
				eval(store_template('custom_field', '$customfield'));
				$customfields .= $customfield;
			}
			$query = db_query('select * from styleset order by name asc');
			while ($styleset_result = db_fetch_array($query))
			{
				if ($styleset_result['stylesetid']==$user_result['stylesetid'])
					$selected = true;
				else
					$selected = false;
				eval(store_template('styleset_choice'));
				$stylesets .= $styleset_choice;
			}
			if ($user_result['avatar'])
				$user_result['parsed_avatar'] = parse_image($user_result['avatar']);
			$user_result['joindate'] = time_adjust($user_result['joindate'], 'Y-m-d H:i:s');
			$user_result['location'] = html_fix($user_result['location']);
			$user_result['title'] = html_fix($user_result['title']);
			edit_parse($user_result['uncached_signature'], $config['signature_dpcode'], $config['signature_img'], $config['signature_smilies']);
			eval(get_template('view_user'));
		}
		else
			eval(get_template('invalid_user'));
	}
	elseif ($op=='ban')
	{
		if ($user_result = db_fetch_array(db_query("select * from user where userid='$id'")))
			eval(get_template('ban_user'));
		else
			eval(get_template('invalid_user'));
	}
	elseif ($_POST['op']=='doban')
	{
		if ($user_result = db_fetch_array(db_query("select * from user where userid='$_POST[id]'")))
		{
			moderatorlog("Banned user - <b>$user_result[userid]</b>", 0, '');
			db_query("update user set groupid=$config[ban_groupid],usergroups=$config[ban_groupid] where userid='$user_result[userid]'");
			$redirect_url = 'users.php';
			eval(get_template('ban_user_redirect'));
		}
		else
			eval(get_template('invalid_user'));
	}
	else
	{
		$selected = false;
		moderatorlog('Viewed users panel', 0, '');
		$query = db_query('select * from groups order by name asc');
		$num_col1 = ceil(db_num_rows($query)/2);
		$i = 0;
		while ($group_result = db_fetch_array($query))
		{
			$checked = true;
			eval(store_template('usergroup_choice'));
			if (++$i<=$num_col1)
				$usergroups_col1 .= $usergroup_choice;
			else
				$usergroups_col2 .= $usergroup_choice;
		}
		$query = db_query('select * from customfield order by ordered');
		while ($field = db_fetch_array($query))
		{
			eval(store_template('custom_field', '$customfield'));
			$customfields .= $customfield;
		}
		$query = db_query('select * from user order by userid desc limit 20');
		while ($user_result = db_fetch_array($query))
		{
			eval(store_template('modusers_user', '$user_template'));
			$users .= $user_template;
		}
		$selected = false;
		$query = db_query('select * from styleset order by name asc');
		while ($styleset_result = db_fetch_array($query))
		{
			eval(store_template('styleset_choice'));
			$stylesets .= $styleset_choice;
		}
		eval(get_template('modusers_index'));
	}
}
else
	eval(get_template('permission_error'));
?>