<?php

/**************************************************
* String API
* ----------
* in_set($value, $set, $seperator = ',')
* generate_css(&$style)
* generate_css_category($cat)
* dp_strlen($str)
* dp_substr($str, $start, $length = NULL)
* htmlunspecialchars($text)
* html_fix($text)
* html_strip($text)
* str_nl_normalize($string, $nl_style = "\n")
* str_rot13($string)
* dp_hash($name, $password)
* 
* Deluxe Portal Version 2.0
**************************************************/

function in_set($value, $set, $seperator = ',')
{
	return in_array($value, explode($seperator, $set));
}

function generate_css(&$style)
{
	global $config, $user;
	$query = db_query("select * from stylecss where styleid=$style[styleid] order by ordered asc");
	$pagestyle = '';
	while ($cat = db_fetch_array($query))
		$pagestyle .= generate_css_category($cat);

	$pagestyle .= $style['extra'];
	return parse_vars($pagestyle);
}

function generate_css_category($cat)
{
	$css = '';
	if ($cat['bold'])
		$css .= " font-weight:bold;\n";
	if ($cat['italic'] || $cat['oblique'])
		$css .= ' font-style:' . ($cat['italic'] ? 'italic ' : '') . ($cat['oblique'] ? 'oblique' : '') . ";\n";
	if ($cat['textdecoration_none'])
		$css .= " text-decoration:none;\n";
	elseif ($cat['underline'] || $cat['overline'] || $cat['linethrough'])
		$css .= ' text-decoration:' . ($cat['underline'] ? 'underline ' : '') . ($cat['overline'] ? 'overline ' : '') . ($cat['linethrough'] ? 'line-through' : '') . ";\n";
	if ($cat['textalign'])
		$css .= " text-align:$cat[textalign];\n";
	if ($cat['texttransform'])
		$css .= " text-transform:$cat[texttransform];\n";
	if ($cat['smallcaps'])
		$css .= " font-variant:small-caps;\n";
	if ($cat['color'])
		$css .= " color:$cat[color];\n";
	if ($cat['fontsize']!='')
		$css .= " font-size:$cat[fontsize];\n";
	if ($cat['letterspacing']!='')
		$css .= " letter-spacing:$cat[letterspacing];\n";
	if ($cat['lineheight']!='')
		$css .= " line-height:$cat[lineheight];\n";
	if ($cat['whitespace'])
		$css .= " white-space:$cat[whitespace];\n";
	if ($cat['position'])
		$css .= " position:$cat[position];\n";
	if ($cat['floatposition'])
		$css .= " float:$cat[floatposition];\n";
	if ($cat['clear'])
		$css .= " clear:$cat[clear];\n";
	if ($cat['toppos']!='')
		$css .= " top:$cat[toppos];\n";
	if ($cat['bottompos']!='')
		$css .= " bottom:$cat[bottompos];\n";
	if ($cat['leftpos']!='')
		$css .= " left:$cat[leftpos];\n";
	if ($cat['rightpos']!='')
		$css .= " right:$cat[rightpos];\n";
	if ($cat['width']!='')
		$css .= " width:$cat[width];\n";
	if ($cat['height']!='')
		$css .= " height:$cat[height];\n";
	if ($cat['margin']!='')
		$css .= " margin:$cat[margin];\n";
	if ($cat['padding']!='')
		$css .= " padding:$cat[padding];\n";
	if ($cat['backgroundcolor'])
		$css .= " background-color:$cat[backgroundcolor];\n";
	if ($cat['backgroundimage'])
		$css .= " background-image:url($cat[backgroundimage]);\n";
	if ($cat['backgroundrepeat'])
		$css .= " background-repeat:$cat[backgroundrepeat];\n";
	if ($cat['backgroundattachment'])
		$css .= " background-attachment:$cat[backgroundattachment];\n";
	if ($cat['bordertop']!='' && $cat['bordersame'])
		$css .= " border:$cat[bordertop];\n";
	else
	{
		if ($cat['borderleft']!='')
			$css .= " border-left:$cat[borderleft];\n";
		if ($cat['borderright']!='')
			$css .= " border-right:$cat[borderright];\n";
		if ($cat['bordertop']!='')
			$css .= " border-top:$cat[bordertop];\n";
		if ($cat['borderbottom']!='')
			$css .= " border-bottom:$cat[borderbottom];\n";
	}
	if ($cat['fontfamily'])
		$css .= " font-family:$cat[fontfamily];\n";
	if ($cat['display'])
		$css .= " display:$cat[display];\n";
	if ($cat['verticalalign'])
		$css .= " vertical-align:$cat[verticalalign];\n";
	if ($cat['extra'])
		$css .= " $cat[extra]\n";
	if ($css)
		$css = "$cat[selector] {\n$css}\n";
	return $css;
}

function dp_strlen($str)
{
	if (function_exists('mb_strlen'))
		return mb_strlen($str);
	else
		return strlen($str);
}

function dp_substr($str, $start, $length = NULL)
{
	if ($length)
	{
		if (function_exists('mb_substr'))
			return mb_substr($str, $start, $length);
		else
			return substr($str, $start, $length);
	}
	elseif (function_exists('mb_substr'))
		return mb_substr($str, $start);
	else
		return substr($str, $start);
}

function dp_trim($str)
{
	global $config;
	if ($chararray = explode(' ', $config['blocked_characters']))
	foreach ($chararray as $char)
		$chars .= chr($char);
	return trim($str, " \t\n\r\0\x0B$chars");
}

function htmlunspecialchars($text)
{
	return str_replace(array('&gt;', '&lt;', '&quot;', '&amp;'), array('>', '<', '"', '&'), $text);
}

function dp_htmlspecialchars($text)
{
	$text = htmlspecialchars($text);
	$text = preg_replace("/&amp;#([\d\w]{1,6});/", "&#\\1;", $text);
	return $text;
}

function html_fix($text)
{
	/*$text = str_replace('&#', '!{!DP_UNICODE!}!', $text);
	$text = str_replace('&', '&amp;', $text);
	$text = str_replace('!{!DP_UNICODE!}!', '&#', $text);
	$text = str_replace('"', '&quot;', $text);*/
	if (strstr($text, '<') || strstr($text, '>') || strstr($text, '"'))
		$text = htmlspecialchars($text);
	return $text;
}

function html_strip($text)
{
	$text = str_replace('<', '&lt;', $text);
	$text = str_replace('>', '&gt;', $text);
	return $text;
}

function str_nl_normalize($string, $nl_style = "\n")
{
	$nl_style = ($nl_style=="\n" || $nl_style=="\r\n" || $nl_style=="\r") ? $nl_style : "\n";
	$string = str_replace("\r\n", "\n", $string);
	$string = str_replace("\r", "\n", $string);
	if ($nl_style!="\n")
		$string = str_replace("\n", $nl_style, $string);
	return $string;
}

if (!function_exists('str_rot13'))
{
	function str_rot13($string)
	{
		static $from = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		static $to = 'nopqrstuvwxyzabcdefghijklmNOPQRSTUVWXYZABCDEFGHIJKLM';
		return strtr($string, $from, $to);
	}
}

function generate_salt($length = 16)
{
	$valid = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
				   'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
				   0, 1, 2, 3, 4, 5, 6, 7, 8, 9);

	$count = count($valid) - 1;
	$salt = '';
	
	for ($i=0; $i < $length; $i++)
	{
		$char = $valid[rand(0, $count)];
		if ($i % 2)
			$char = strtoupper($char);
		$salt .= $char;
	}
	return $salt;
}

function dp_hash($salt, $password, $ismd5ed = false)
{
	if (!$ismd5ed)
		$password = md5($password);
	$password = md5($password . $salt);
	return $password;
}

function escape_like($string)
{
	return str_replace('%', '\%', str_replace('_', '\_', $string));
}
?>