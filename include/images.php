<?php
/**************************************************
* Images API
* ----------
* check_image($size, $types, $width, $height)
* parse_image($image)
* upload_image($type, $admin)
* file_get_contents($filename [, $int_use_include_path = NULL])
* file_put_contents($filename, $content [, $int_flag = NULL [, $resource_context = false]])
*                                                             ($resource_context has no effect in this function)
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache .= ',image_missing';
/**************************************************
* Global variable resetting                      */
unset($config);
unset($current_time);
/*************************************************/


function check_image($size, $types, $width, $height)
{
	$info = getimagesize($_FILES['image']['tmp_name']);
	if ($info[0] <= $width && $info[1] <= $height && $_FILES['image']['size'] <= ($size * 1024) && strstr($types, $_FILES['image']['type']))
		return true;
	else
		return false;
}

function parse_image($image)
{
	global $relativeurl;
	$firstchar = substr($image, 0, 1);
	if ($firstchar==':')
	{
		$image = substr($image, 1);
		return "$relativeurl/imagestore.php?id=$image";
	}
	else
	{
		if ($firstchar!='/' && strpos($image, '://')===false)
			return "$relativeurl/$image";
		else
			return $image;
	}
}

function upload_image($type, $admin)
{
	global $_FILES, $pagetitle;
	foreach ($GLOBALS as $key => $value)
		${$key} = $value;
	if (!$_FILES['image']['size'])
	{
		$pagetitle = 'Missing image';
		die(eval(get_template('image_missing')));
	}
	if ($config[$type.'_location']=='database')
	{
		$file = file_get_contents($_FILES['image']['tmp_name']);
		$file = addslashes($file);
		db_query("insert into imagestore (content, type, name) values ('$file', '".$_FILES['image']['type'].'\', \''.addslashes($_FILES['image']['name']).'\')');
		$imagestore = db_fetch_array(db_query('select imageid from imagestore order by imageid desc limit 1'));
		$image = ':'.$imagestore['imageid'];
	}
	else
	{
		if ($admin)
			$location = '../';
		$filename = explode('.', $_FILES['image']['name']);
		if (count($filename) > 1)
			$ext = '.'.$filename[count($filename)-1];
		else
			$ext = '';
		$location .= $config[$type.'_directory'].'/'.rand(0,32000).$current_time.rand(0,32000).$ext;
		copy($_FILES['image']['tmp_name'], $location);
		if ($admin)
			$location = dp_substr($location, 3);
		$image = $location;
	}
	return $image;
}

if (!function_exists('file_get_contents'))
{
	function file_get_contents($filename, $int_use_include_path = NULL)
	{
		ob_start();
			readfile($filename, $int_use_include_path);
			$file_contents = ob_get_contents();
		ob_end_clean();
		return $file_contents;
	}
}

if (!function_exists('file_put_contents'))
{
	define('FILE_USE_INCLUDE_PATH', 1, 0);
	define('FILE_APPEND', 8, 0);
	function file_put_contents($filename, $content, $int_flag = NULL, $resource_context = false)
	{
		if ($fp = @fopen($filename, 'wb', ($int_flag==1 ? true : NULL)))
		{
			if ($int_flag==8)
				$content = file_get_contents($filename, 0) . $content;
			if (!@fwrite($fp, $content))
			{
				fclose($fp);
				return false;
			}
			fclose($fp);
			return true;
		}
		return false;
	}
}
?>