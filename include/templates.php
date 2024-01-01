<?php
/**************************************************
* Templates API
* -------------
* build_pagenav($thispage, $page, $numpages, $numlinks, $params='')
* cache_templates($templatestr)
* store_template($name, $variablename=false, $addon=false)
* get_template($name)
* class->template_variables (instantiated as $template_vars)
* parse_template($name)
* 
* Deluxe Portal Version 2.0
**************************************************/
$templatecache .= ',pagenav,pagenav_first,pagenav_last,pagenav_link,pagenav_next,pagenav_nolink,pagenav_prev';
if ($admincache)
	$admincache .= ',pagenav,pagenav_first,pagenav_last,pagenav_link,pagenav_next,pagenav_nolink,pagenav_prev';
/**************************************************
* Global variable resetting                      */
$alltemplates = false;
unset($templatestore);
unset($config);
unset($execution_time);
unset($totaltemplates);
unset($style);
/*************************************************/

define('ERROR_STR', '<hr style=\'width:60%;text-align:left;\' /><div style=\'text-align:left;width:60%;margin:2px;margin-left:0px;padding:4px;font-size:10px;font-family:verdana,arial,sans-serif\'><b>Template Warning:</b><br />', 0);
define('ERROR_END', '</div><hr style=\'width:60%;text-align:left;\' />', 0);

function build_pagenav($thispage, $page, $numpages, $numlinks, $params='')
{
	if ($numpages>1)
	{
		if ($numlinks)
		{
			if (($page-$numlinks)>1)
			{
				eval(store_template('pagenav_first'));
				$pagenav .= $pagenav_first;
			}
			if ($page>1)
			{
				$prevpage = $page-1;
				eval(store_template('pagenav_prev'));
				$pagenav .= $pagenav_prev;
			}
			for ($pagelink=($page-$numlinks); $pagelink<$page; $pagelink++)
			{
				if ($pagelink>0)
				{
					eval(store_template('pagenav_link'));
					$pagenav .= $pagenav_link;
				}
			}
			eval(store_template('pagenav_nolink'));
			$pagenav .= $pagenav_nolink;
			for ($pagelink=($page+1); $pagelink<=($page+$numlinks); $pagelink++)
			{
				if ($pagelink<=$numpages)
				{
					eval(store_template('pagenav_link'));
					$pagenav .= $pagenav_link;
				}
			}
			if ($page<$numpages)
			{
				$nextpage = $page+1;
				eval(store_template('pagenav_next'));
				$pagenav .= $pagenav_next;
			}
			if (($page+$numlinks)<$numpages)
			{
				eval(store_template('pagenav_last'));
				$pagenav .= $pagenav_last;
			}
		}
		else
		{
			if ($page>1)
			{
				$prevpage = $page-1;
				eval(store_template('pagenav_prev'));
				$pagenav .= $pagenav_prev;
			}
			for ($pagelink=1; $pagelink<$page; $pagelink++)
			{
				eval(store_template('pagenav_link'));
				$pagenav .= $pagenav_link;
			}
			eval(store_template('pagenav_nolink'));
			$pagenav .= $pagenav_nolink;
			for ($pagelink=($page+1); $pagelink<=$numpages; $pagelink++)
			{
				eval(store_template('pagenav_link'));
				$pagenav .= $pagenav_link;
			}
			if ($page<$numpages)
			{
				$nextpage = $page+1;
				eval(store_template('pagenav_next'));
				$pagenav .= $pagenav_next;
			}
		}
		eval(store_template('pagenav', '$return_pagenav'));
	}
	return $return_pagenav;
}

function parse_vars($string, $addslashes = true, $additional_vars = array())
{
	extract($GLOBALS, EXTR_OVERWRITE, '');
	extract((array) $additional_vars, EXTR_OVERWRITE, '');
	if ($addslashes)
		$string = str_replace("\\'", "'", addslashes($string));
	eval("\$string = \"$string\";");
	return $string;
}

function store_template($name, $variablename = false, $addon = false)
{
	$variablename = (($variablename || strtolower($variablename)=='auto') ? $variablename : '$' . $name);
	return ($addon ? "if (!isset($variablename)) $variablename = '';" : '') . "
	ob_start();
		eval(get_template('$name'));
		$variablename " . ($addon ? '.' : '') . '= ob_get_contents();
	ob_end_clean();';
}

function get_template($name)
{
	global $admincache, $config, $group, $alltemplates, $execution_time, $templatestore, $totaltemplates, $style;
	
	if (!$templatestore[$name] && !$alltemplates)
	{
		$alltemplates = true;
		$query = db_query("select * from parsedtemplate where templatesetid=".($admincache ? 1 : $style['templatesetid']));
		while($get_template = db_fetch_array($query))
			$templatestore[$get_template['name']] = $get_template['body'];
		$totaltemplates = count($templatestore);
	}
	if ($templatestore[$name])
	{
		preg_match_all('/eval\(get_template\(\'(.+?)\'\)\);/', $templatestore[$name], $match);
		if (is_array($match))
		{
			$matched_evals = $match[0];
			$included_templates = $match[1];
			foreach ($included_templates as $match_num => $templatename)
			{
				if ($templatename==$name)
				$templatestore[$name] = str_replace($matched_evals[$match_num], 'echo "'.str_replace('"', '\\"', ERROR_STR . 'Template cannot be included within itself: <b>&lt;include template=&quot;' . str_replace(' ', '&nbsp;', htmlspecialchars($name)) . '&quot; /&gt;</b>' . ERROR_END) . '";', $templatestore[$name]);
			}
		}
		end_timer();
		if (!($config['show_querycounter'] && isset($_REQUEST['explain']) && $_REQUEST['explain']==1 && (!$config['listqueries'] || $group['configuration'])))
			return $templatestore[$name];
	}
	else
		return 'echo "' . ERROR_STR . 'Template &quot;' . str_replace(' ', '&nbsp;', htmlspecialchars(str_replace('$', '\$', $name))) . '&quot; does not exist.' . ERROR_END . '";';
}

function cache_templates($templates_str)
{
	global $templatestore, $totaltemplates, $style;
	$templatesused = explode (',', $templates_str);
	foreach ($templatesused as $used)
		$templatequery .= " or name='$used'";
	$templatequery = substr($templatequery, 4);
	$query = db_query("select * from parsedtemplate where templatesetid=$style[templatesetid] and ($templatequery)");
	while($get_template = db_fetch_array($query))
		$templatestore[$get_template['name']] = $get_template['body'];
	$totaltemplates = count($templatestore);
}

class template_variables
{
	function setVariable($var_name, $var_value, $var_append=NULL)
	{
		$var_name = '_' . $var_name;
		if (isset($var_append))
			$this->{$var_name} .= $var_value;
		else
			$this->{$var_name} = $var_value;
	}
	
	function getVariable($var_name, $var_onfalse=false)
	{
		$var_name = '_' . $var_name;
		if (isset($this->{$var_name}))
			return $this->{$var_name};
		else
			return $var_onfalse;
	}
}

$template_vars = new template_variables;

function parse_template($template)
{
	global $config;
	
	$prefix = '<CODE-STR::' . rand(1,32000) . '::>';
	$suffix = '<CODE-END::' . rand(1,32000) . '::>';
	$nlbrk  = '<LINE-BRK::' . rand(1,32000) . '::>';
	$bslash = '<BACK-SLA::' . rand(1,32000) . '::>';
	$rand   = rand(1,32000);

	$template = str_nl_normalize($template);

	$template = str_replace('\\"', '&double' . $rand . 'quot;', $template);
	$template = str_replace('\\\'', '&single' . $rand . 'quot;', $template);
	$template = str_replace("\n", $nlbrk . "\n", $template);

	$template = preg_replace('/<\?(?!php|xml|xsl)/i', '<?php', $template);
	$template = preg_replace('/<\?php=(.*?)\?>/', '<' . '?php echo(\1); ?' . '>', $template);
	$php_blocknum = 0;
	while (preg_match('/<\?php(.*?)\?' . '>/s', $template, $match))
	{
		$php_code[++$php_blocknum] = $match[1];
		$template = str_replace($match[0], "\n" . $prefix . '{P'.'HP::' . md5($php_blocknum . $rand) . '::}' . $suffix . "\n", $template);
	}
	
		$template = str_replace('\\$', $bslash . '$', $template);

		$template = str_replace('\\', '\\\\', $template);
		
		$template = preg_replace("/<comment(.*?)\/>(.*?)\n/i", $nlbrk . "\n", $template);
		$template = preg_replace('/<comment(.*?)>(.*?)<\/comment>/si', '', $template);

		while (preg_match('/<else\s*?\/>(.*?)<\/if>/si', $template, $match))
			$template = str_replace($match[0], "</if>\n" . $prefix . ' else { ' . $suffix . "\n" . $match[1] . "\n" . $prefix . ' } ' . $suffix . "\n", $template);

		while (preg_match('/<if \((.*?)\)>(.*?)<\/if>/si', $template, $match))
		{
			if (trim($match[1]))
			{
				while (preg_match('/%(\S+?)%/', $match[1], $match1))
					$match[1] = str_replace($match1[0], '($template_vars->getVariable(\'' . str_replace('\'', '\\\'', $match1[1]) . '\', false))', $match[1]);

				while (preg_match('/{%(.+?)%}/', $match[1], $match1))
					$match[1] = str_replace($match1[0], '($template_vars->getVariable(\'' . str_replace('\'', '\\\'', $match1[1]) . '\', false))', $match[1]);

				$template = str_replace($match[0], "\n" . $prefix . 'if ((' . $match[1] . '))' . $nlbrk . '{ ' . $suffix . "\n" . $match[2] .  "\n" . $prefix . ' } ' . $suffix . "\n", $template);
			}
			else
				$template = str_replace($match[0], ERROR_STR . 'Complex &lt;if ()&gt; statement is empty, or contains only white-space:<br />' . trim(htmlspecialchars($match[0])) . ERROR_END, $template);
		}

		while (preg_match('/<if ((.*?)([^<.]*?))>(.*?)<\/if>/si', $template, $match))
		{
			if (trim($match[1]))
			{
				while (preg_match('/%(\S+?)%/', $match[1], $match1))
					$match[1] = str_replace($match1[0], '($template_vars->getVariable(\'' . str_replace('\'', '\\\'', $match1[1]) . '\', false))', $match[1]);

				while (preg_match('/{%(.+?)%}/', $match[1], $match1))
					$match[1] = str_replace($match1[0], '($template_vars->getVariable(\'' . str_replace('\'', '\\\'', $match1[1]) . '\', false))', $match[1]);

				$template = str_replace($match[0], "\n" . $prefix . 'if ((' . $match[1] . '))' . $nlbrk . '{ ' . $suffix . "\n" . $match[4] .  "\n" . $prefix . ' } ' . $suffix . "\n", $template);
			}
			else
				$template = str_replace($match[0], ERROR_STR . 'Simple &lt;if&gt; statement is empty, or contains only white-space:<br />' . trim(htmlspecialchars($match[0])) . ERROR_END, $template);
		}
		
		$template = preg_replace('/<if \((.*?)\)>/esi', 'stripslashes(\'' . addslashes(ERROR_STR) . 'Non-ending Complex &lt;if ()&gt; statement: &lt;if (\'.trim(htmlspecialchars(str_replace(\'$\', \'\\$\', \'\1\'))).\')&gt;' . addslashes(ERROR_END) . '\')', $template);
		$template = preg_replace('/<if ((.*?)([^<.]*?))>/esi', "stripslashes('" . addslashes(ERROR_STR) . 'Non-ending Simple &lt;if&gt; statement: &lt;if\'.trim(htmlspecialchars(str_replace(\'$\', \'\\$\', \'\1\'))).\'&gt;' . addslashes(ERROR_END) . '\')', $template);
		$template = preg_replace('/<\/if>/i', ERROR_STR . 'End tag for &lt;if&gt; statement which is not open.' . ERROR_END, $template);
		$template = preg_replace('/<else.*?\/>/si', ERROR_STR . '&lt;else /&gt; tag which is not encapsulated within &lt;if&gt; tag, or &lt;if&gt; tag contains errors.' . ERROR_END, $template);

		while (preg_match('/<variable(.*?)\/>/si', $template, $match))
		{
			preg_match('/\bname=("|\')(.*?)\1/i', $match[1], $var_name);
			preg_match('/\bvalue=("|\')(.*?)\1/i', $match[1], $var_value);
			preg_match('/\bforce=("|\')php\1/i', $match[1], $var_usephp);
			if ($var_name[2])
			{
				if (strlen($var_name[2]) >= 1)
				{
					if (!isset($var_usephp[1]))
					{
						if (isset($var_value[2]))
							$template = str_replace($match[0], "\n" . $prefix . '$template_vars->setVariable(\''. str_replace('\'', '\\\'', $var_name[2]) . '\', "' . str_replace('"', '\\"', str_replace(($var_value[1]=='"' ? '&double' . $rand . 'quot;' : '&single' . $rand . 'quot;'), $var_value[1], $var_value[2])) . '");' . $suffix . "\n", $template);
						else
							$template = str_replace($match[0], "\n" . $prefix . 'echo($template_vars->getVariable(\'' . $var_name[2] . '\', false) ? $template_vars->getVariable(\'' . str_replace('"', '\\"', $var_name[2]) . '\') : (isset(${\'' . str_replace('\'', '\\\'', $var_name[2]) . '\'}) ? ${\'' . $var_name[2] . '\'} : ""));' . $suffix . "\n", $template);
					}
					else
					{
						if (preg_match("/([a-zA-Z_\x7f-\xff\[\]][a-zA-Z0-9_\x7f-\xff\[\]]*)/", $var_name[2], $match1) && $match1[0]==$var_name[2])
						{
							if (isset($var_value[2]))
								$template = str_replace($match[0], "\n" . $prefix . '$' . $var_name[2] . ' = "' . str_replace(($var_value[1]=='"' ? '&double' . $rand . 'quot;' : '&single' . $rand . 'quot;'), $var_value[1], $var_value[2]) . '";' . $suffix . "\n", $template);
							else
								$template = str_replace($match[0], "\n" . $prefix . 'echo ($' . $var_name[2] . ');' . $suffix . "\n", $template);
						}
						else
							$template = str_replace($match[0], ERROR_STR . 'Variable name contains invalid characters: <b>' . str_replace(' ', '&nbsp;', htmlspecialchars($match[0])) . '</b>' . ERROR_END, $template);
					}
				}
				else
					$template = str_replace($match[0], ERROR_STR . 'Variable name must be at least one character: <b>' . str_replace(' ', '&nbsp;', htmlspecialchars($match[0])) . '</b>' . ERROR_END, $template);
			}
			else
				$template = str_replace($match[0], ERROR_STR . 'Variable name not specified: <b>' . str_replace(' ', '&nbsp;', htmlspecialchars($match[0])) . '</b>' . ERROR_END, $template);
		}
		
		while (preg_match('/%(\S+?)%/', $template, $match))
			$template = str_replace($match[0], "\n" . $prefix . 'echo($template_vars->getVariable(\'' . str_replace('\'', '\\\'', $match[1]) . '\'));' . $suffix . "\n", $template);

		while (preg_match('/{%(.+?)%}/', $template, $match))
			$template = str_replace($match[0], "\n" . $prefix . 'echo($template_vars->getVariable(\'' . str_replace('\'', '\\\'', $match[1]) . '\'));' . $suffix . "\n", $template);

		while (preg_match('/<include(.*?)\/>/i', $template, $match))
		{
			preg_match('/\bsrc=("|\')(.*?)\1/i', $match[1], $inc_src);
			preg_match('/\btype=("|\')(.*?)\1/i', $match[1], $inc_type);
			preg_match('/\btemplate=("|\')(.*?)\1/i', $match[1], $inc_template);
			if ($inc_src[2] && !$inc_template[2])
			{
				if (strlen($inc_src[2]) >= 1)
					$template = str_replace($match[0], "\n" . $prefix . (strtolower($inc_type[2])=='require' ? 'require' : (strtolower($inc_type[2])=='include' ? 'include' : 'readfile')) . '(\'' . str_replace(($inc_src[1]=='"' ? '&double' . $rand . 'quot;' : '&single' . $rand . 'quot;'), $inc_src[1], $inc_src[2]) . '\');' . $suffix . "\n", $template);
				else
					$template = str_replace($match[0], ERROR_STR . 'Source file name must be at least one character: <b>' . str_replace(' ', '&nbsp;', htmlspecialchars($match[0])) . '</b>' . ERROR_END, $template);
			}
			elseif ($inc_template[2] && !$inc_src)
			{
				if (strlen($inc_template[2]) >= 1)
				{
					if (preg_match("/([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/", $inc_template[2], $match1) && $match1[0]==$inc_template[2])
						$template = str_replace($match[0], "\n" . $prefix . 'eval(get_template(\'' . $inc_template[2] . '\'));' . $suffix . "\n", $template);
					else
						$template = str_replace($match[0], ERROR_STR . 'Template name contains invalid characters: ' . htmlspecialchars($match[0]) . ERROR_END, $template);
				}
				else
					$template = str_replace($match[0], ERROR_STR . 'Template must have a name of greater than one character: ' . htmlspecialchars($match[0]) . ERROR_END, $template);
			}
			else
				$template = str_replace($match[0], ERROR_STR . '&lt;include&gt; tag does not contain enough information, or contains conflicting information: <b>' . str_replace(' ', '&nbsp;', htmlspecialchars($match[0])) . '</b>' . ERROR_END, $template);
		}

		while (preg_match('/<cache(.*?)templates=("|\')(.*?)\\2(.*?)\/>/i', $template, $match))
		{
			if (strlen($match[3]) >= 1)
			{
				if (preg_match("/([a-zA-Z,_\x7f-\xff][a-zA-Z0-9,_\x7f-\xff]*)/", $match[3], $match1) && $match1[0]==$match[3])
					$template = str_replace($match[0], "\n" . $prefix . 'cache_templates(\'' . $match[3] . '\');' . $suffix . "\n", $template);
				else
					$template = str_replace($match[0], ERROR_STR . 'Template list name contains invalid characters: ' . htmlspecialchars($match[0]) . '<br />Note: Do not use spaces in between template names.' . ERROR_END, $template);
			}
			else
				$template = str_replace($match[0], ERROR_STR . 'Template list must have a name of greater than one character: ' . htmlspecialchars($match[0]) . ERROR_END, $template);
		}
		
		$template = explode("\n", $template);
		$parsedtemplate = '';
		if (is_array($template))
		{
			foreach ($template as $line)
			{
				if (!preg_match('/' . $prefix . '(.*?)' . $suffix . '/', $line) && $line!='')
					$line = 'echo("' . str_replace('"', '\\"', $line) . "\");\n";
				else
					$line .= "\n";
				$parsedtemplate .= $line;
			}
		}

		$parsedtemplate = str_replace($prefix, '', $parsedtemplate);
		$parsedtemplate = str_replace($suffix, '', $parsedtemplate);
	
		if (is_array($php_code))
		{
			foreach ($php_code as $code_block => $code)
				$parsedtemplate = str_replace('{P'.'HP::' . md5($code_block.$rand) . '::}', $code . "\n", $parsedtemplate);
		}

		$parsedtemplate = str_replace($nlbrk, "\n", $parsedtemplate);
		$parsedtemplate = str_replace($bslash, '\\', $parsedtemplate);
		$parsedtemplate = str_replace('&double' . $rand . 'quot;', '\\"', $parsedtemplate);
		$parsedtemplate = str_replace('&single' . $rand . 'quot;', '\\\'', $parsedtemplate);
		return trim($parsedtemplate);
}
?>