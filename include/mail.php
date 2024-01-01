<?php
/**************************************************
* Mail API
* --------
* dp_mail($recipient, $subject, $message, $sender)
* 
* Deluxe Portal Version 2.0
**************************************************/

function dp_mail($recipient, $subject, $message, $sender)
{
	mail($recipient, htmlunspecialchars($subject), htmlunspecialchars($message), htmlunspecialchars($sender));
}
?>