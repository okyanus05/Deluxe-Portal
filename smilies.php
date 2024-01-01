<?php
/**************************************************
* Smilies
* -------
* Shows the smilie popup box.
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache = 'smilie_index';

require('function.php');

$pagetitle = 'Smilies';
$smilie_row = '';
$smilies = '';
$smilie_box = '';
$query = db_query('select * from smilie where ordered>0 order by ordered');
$total = db_num_rows($query);
$row = 0;
while ($smilie = db_fetch_array($query))
{
	$smilie['image'] = parse_image($smilie['image']);
	$smilie['escaped_tag'] = str_replace('\'', '\\\'', $smilie['tag']);
	$showtags = true;
	eval(store_template('smilie_column'));
	$smilie_row .= $smilie_column;
	if (++$row>=2)
	{
		eval(store_template('smilie_row', '$smilie_result'));
		$smilies .= $smilie_result;
		$smilie_row = '';
		$row = 0;
	}
}
if ($smilie_row)
{
	eval(store_template('smilie_row', '$smilie_result'));
	$smilies .= $smilie_result;
}
eval(get_template('smilie_index'));
?>