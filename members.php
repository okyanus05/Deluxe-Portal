<?php
/**************************************************
* Member list
* -----------
* Displays a list of members on the site.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'memberlist_index,memberlist_member';
/**************************************************
* Global variable resetting                      */
unset($memberlist_pagenav);
unset($members);
unset($nextpage);
unset($pagenav);
unset($prevpage);
/*************************************************/
require('function.php');
/**************************************************
* Variable initialization                        */
$fields = $_REQUEST['fields'];
$letter = $_REQUEST['letter'];
$maxjoin = $_REQUEST['maxjoin'];
$maxposts = $_REQUEST['maxposts'];
$minjoin = $_REQUEST['minjoin'];
$minposts = $_REQUEST['minposts'];
$name = $_REQUEST['name'];
$order = $_REQUEST['order'];
$page = $_REQUEST['page'];
$sort = $_REQUEST['sort'];
/*************************************************/

if ($group['view_memberlist'])
{
	if (!is_numeric($page))
		$page = 1;
	if ($sort!='asc' && $sort!='desc')
		$sort = 'desc';
	if ($order!='name' && $order!='joindate' && $order!='posts')
		$order = 'posts';
	get_group_store();
	if (!$letter)
	{
		if ($_REQUEST['search'])
		{
			$fieldquery = '';
			$tablelist = '';
			$i = 1;
			if ($fields = unserialize(urldecode(stripslashes($fields))))
			{
				while (list($key, $field) = each($fields))
				{
					if ($field['value'])
					{
						$tablelist .= ",usercustomfield as c$i";
						$fieldquery .= " and (c$i.customfieldid=$field[id] and c$i.userid=user.userid and c$i.value like '%".escape_like(addslashes($field['value'])).'%\')';
						$i++;
					}
				}
			}
			else
			{
				$fields = array();
				$query = db_query('select * from customfield');
				while ($field = db_fetch_array($query))
				{
					$f['id'] = $field['customfieldid'];
					$f['value'] = $_REQUEST["field_$field[customfieldid]"];
					$fields[] = $f;
					if ($f['value'])
					{
						$tablelist .= ",usercustomfield as c$i";
						$fieldquery .= " and (c$i.customfieldid=$field[customfieldid] and c$i.userid=user.userid and c$i.value like '%".escape_like($f['value'])."%')";
						$i++;
					}
				}
			}
			$fields = urlencode(serialize($fields));
			if (!is_numeric($minposts))
				$minposts = 0;
			if (!is_numeric($maxposts))
				$maxposts = 4294967296;
			if (!$minjoin)
				$minjoin = '1969-12-31';
			if (!$maxjoin)
				$maxjoin = '2029-12-31';
			$name = dp_htmlspecialchars(addslashes($name));
			$query = db_query("select * from user$tablelist where user.name like '%".escape_like($name)."%' and aol like '%".escape_like($_REQUEST['aol'])."%' and icq like '%".escape_like($_REQUEST['icq'])."%' and msn like '%".escape_like($_REQUEST['msn'])."%' and yahoo like '%".escape_like($_REQUEST['yahoo'])."%' and website like '%".escape_like($_REQUEST['website'])."%' and title like '%".escape_like($_REQUEST['title'])."%' and posts>='$minposts' and posts<='$maxposts'".($minjoin && $minjoin!='1969-12-31' ? " and joindate>=UNIX_TIMESTAMP('$minjoin')" : '').($maxjoin && $maxjoin!='2029-12-31' ? " and joindate<=UNIX_TIMESTAMP('$maxjoin')" : '')." and uncached_signature like '%".escape_like($_REQUEST['signature'])."%' and location like '%".escape_like($_REQUEST['location'])."%'$fieldquery order by $order $sort limit ".(($page-1)*$config['members_per_page']).','.$config['members_per_page']);
			$num = db_fetch_array(db_query("select count(*) as num from user$tablelist where user.name like '%".escape_like($name)."%' and aol like '%".escape_like($_REQUEST['aol'])."%' and icq like '%".escape_like($_REQUEST['icq'])."%' and msn like '%".escape_like($_REQUEST['msn'])."%' and yahoo like '%".escape_like($_REQUEST['yahoo'])."%' and website like '%".escape_like($_REQUEST['website'])."%' and title like '%".escape_like($_REQUEST['title'])."%' and posts>='$minposts' and posts<='$maxposts'".($minjoin && $minjoin!='1969-12-31' ? " and joindate>=UNIX_TIMESTAMP('$minjoin')" : '').($maxjoin && $maxjoin!='2029-12-31' ? " and joindate<=UNIX_TIMESTAMP('$maxjoin')" : '')." and uncached_signature like '%".escape_like($_REQUEST['signature'])."%' and location like '%".escape_like($_REQUEST['location'])."%'$fieldquery"));
		}
		else
			$query = db_query("select user.* from user order by $order $sort limit ".(($page-1)*$config['members_per_page']).','.$config['members_per_page']);
	}
	else
	{
		if ($letter==1)
		{
			$query = db_query("select * from user where user.name like '0%' or user.name like '1%' or user.name like '2%' or user.name like '3%' or user.name like '4%' or user.name like '5%' or user.name like '6%' or user.name like '7%' or user.name like '8%' or user.name like '9%' order by $order $sort limit ".(($page-1)*$config['members_per_page']).','.$config['members_per_page']);
			$num = db_fetch_array(db_query("select count(*) as num from user where user.name like '0%' or user.name like '1%' or user.name like '2%' or user.name like '3%' or user.name like '4%' or user.name like '5%' or user.name like '6%' or user.name like '7%' or user.name like '8%' or user.name like '9%'"));
		}
		else
		{
			$query = db_query("select * from user where user.name like '$letter%' order by $order $sort limit ".(($page-1)*$config['members_per_page']).','.$config['members_per_page']);
			$num = db_fetch_array(db_query("select count(*) as num from user where name like '$letter%'"));
		}
	}
	if ($_REQUEST['search'] || $letter)
		$numpages = ceil($num['num']/$config['members_per_page']);
	else
		$numpages = ceil($config['stat_members']/$config['members_per_page']);
	$memberlist_pagenav = build_pagenav('members', $page, $numpages, $config['numlinks_memberlistnav'], "search=$search&amp;sort=$sort&amp;order=$order&amp;name=$name&amp;email=$_REQUEST[email]&amp;aol=$_REQUEST[aol]&amp;icq=$_REQUEST[icq]&amp;msn=$_REQUEST[msn]&amp;yahoo=$_REQUEST[yahoo]&amp;minposts=$minposts&amp;maxposts=$maxposts&amp;title=$_REQUEST[title]&amp;minjoin=$minjoin&amp;maxjoin=$maxjoin&amp;signature=$_REQUEST[signature]&amp;location=$_REQUEST[location]&amp;website=$_REQUEST[website]&amp;fields=$fields&amp;letter=$letter");
	
	$color = 'cellalt';
	while ($user_result = db_fetch_array($query))
	{
		$color = ($color=='cellmain' ? 'cellalt' : 'cellmain');
		eval('$user_result[parsed_name] = "'.str_replace('\\\'', '\'', addslashes($groupstoreid[$user_result['groupid']]['online_template_large'])).'";');
		$user_result['joindate'] = time_adjust($user_result['joindate'], $style['join_date_format']);
		$showemail = show_email($user_result);
		$showpm = show_pm($user_result);
		$showsearch = show_search($user_result);
		$user_result['posts'] = number_format($user_result['posts'], 0, '.', $style['separator']);
		eval(store_template('memberlist_member', '$member'));
		$members .= $member;
	}
	$pagetitle = 'Member list';
	eval(get_template('memberlist_index'));
}
else
{
	$pagetitle = 'Access denied';
	eval(get_template('permission_error'));
}
?>