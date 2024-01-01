<?php
/**************************************************
* Display
* -------
* Displays a template.
* 
* Deluxe Portal Version 2.0
**************************************************/
$page = htmlspecialchars(trim($_REQUEST['page']));
$templatecache = "invalid_page,$page";

require('function.php');

@get_template($page);
$pagetitle = 'Invalid page';

if (stristr($templatestore[$page], '//*'))
{
	preg_match('/\/\/\*(.*)/', $templatestore[$page], $match);
	eval("\$pagetitle = \"".str_replace("\\'", "'", addslashes(dp_htmlspecialchars($match[1]))).'";');
	eval(store_template($page));
	echo preg_replace('/\/\/\*(.*)/', '', ${$page});
}
else
	eval(get_template('invalid_page'));
?>