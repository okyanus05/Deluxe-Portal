<?php
/**************************************************
* GD Registration
* ---------------
* Shows an image to be used for image verification
* when registering.
* 
* Deluxe Portal Version 2.0
**************************************************/
require('../function.php');

$filename = "$relativeurl/images/registration/background.jpg";
header('Content-Type: image/jpeg');
header('Content-Disposition: inline; filename=gd_registration.jpg');
if (ImageVerification::check_gd())
{
	$user['registerid'] = dp_trim($user['registerid']);
	$user['registerid'] = $user['registerid'] ? $user['registerid'] : ' ';
	$image = new ImageVerification($filename);
	if ($image->add_text_to_image(28, $user['registerid'], 255, 255, 255))
		echo ($image->get_image());
	$image->clean_up();
}
else
	readfile($filename);
?>