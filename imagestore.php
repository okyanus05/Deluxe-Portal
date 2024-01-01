<?php
/**************************************************
* Imagestore
* ----------
* Displays an image stored in the database.
* 
* Deluxe Portal Version 2.0
**************************************************/

require('minifunction.php');

if ($image = db_fetch_array($query = db_query("select * from imagestore where imageid='$_REQUEST[id]'")))
{
	header('Cache-control: private');
	header("Content-type: $image[type]");
	header("Content-Disposition: attachment; filename=$image[name]");
	echo $image['content'];
}
?>