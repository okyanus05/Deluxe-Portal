<?php
require('function.php');
$query = db_query("select * from thread");
while ($thread = db_fetch_array($query))
{
	db_query("insert into markread (userid, threadid, postid) values (2, $thread[threadid], 1)");
	echo '.';
}
?>