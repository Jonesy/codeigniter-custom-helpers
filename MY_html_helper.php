<?php
/*
 * Extends the HTML Helper for some custom uses.
 * 
 * script_link_tag()
 * USAGE:
 * script_link_tag(array('parent_dir/filename'));
 * 
 * 
 * stylesheet_link_tag()
 * USAGE:
 * Set up an array with all the values.
 * $stylesheets = array(array('file' => 'filename', 'type' => 'cssfiletype', [optional]: 'cache' => TRUE));
 * 
 * Call the function like so:
 * <?= stylesheet_link_tag($stylesheets); ?>
 */
if ( ! function_exists('script_link_tag'))
{
	function script_link_tag($file)
	{
		if(is_array($file))
		{
			$script  = '';
			
			foreach($file as $v => $k)
			{
				$script .= '<script type="text/javascript" src="/javascripts/' . $k . '.js"></script>';
				$script .= "\n\t\t";
			}	
		}
		else
		{
			$script  = '<script type="text/javascript" src="/javascripts/' . $file . '.js"></script>';
			$script .= "\n";
		}

		return $script;
		
	}
	
	function stylesheet_link_tag($file)
	{
		$style = '';
		
		foreach($file as $v)
		{
			(isset($v['cache'])) ? $timestamp = '' : $timestamp = '?' . time();
			
			$style .= '<link href="/stylesheets/' . $v['file'] . '.css' . $timestamp .'" rel="stylesheet" media="' . $v['type'] . '" type="text/css"/>';
			$style .= "\n\t\t";
		}
		
		return $style;
	}
}