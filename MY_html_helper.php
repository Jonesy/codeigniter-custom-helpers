<?php
/*
 * Extends the HTML Helper for some custom uses.
 * NOTES:
 * Requires the File Helper for listing all stylesheets
 * Last updated: April 3rd, 2009
 */
 
/*
 * script_link_tag()
 * USAGE:
 * script_link_tag(array('parent_dir/filename'));
 * OR
 * $javascripts = array('parent_dir/filename1','parent_dir/filename2');
 * <?= script_link_tag(array($javascripts)); ?>
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
			$script  = '';
			$script .= '<script type="text/javascript" src="/javascripts/' . $file . '.js"></script>';
			$script .= "\n\t\t";
		}

		return $script;
	}

/* 
 * stylesheet_link_tag()
 * USAGE:
 * Set up an array with all the values.
 * <?= stylesheet_link_tag('filename'); ?>
 * 
 * OR
 * $stylesheets = array(array('file' => 'filename', 'type' => 'cssfiletype', [optional]: 'cache' => TRUE));
 * <?= stylesheet_link_tag($stylesheets); ?>
 */
	
	function stylesheet_link_tag($file, $media = '')
	{
		if(is_array($file))
		{
			$style = '';
			
			foreach($file as $v)
			{
				$file = (isset($v['timestamp'])) ? $v['file'] . '.css?' . time() : $v['file'] . '.css';
				$media = (isset($v['media'])) ? $v['media'] : 'screen, projection';
				
				$style .= '<link href="/stylesheets/' . $file .'" rel="stylesheet" media="' . $media . '" type="text/css"/>';
				$style .= "\n\t\t";
			}
			
			
		}
		else
		{
			$mediatype = ($media != '') ? $media : 'screen, projection';
			$style = '<link href="/stylesheets/' . $file .'.css" rel="stylesheet" media="' . $mediatype . '" type="text/css"/>';
			$style .= "\n\t\t";
		}
		return $style;
	}

/* 
 * embed_flash()
 * USAGE:
 * Places the Javascript for Adobe's Run Content Flash replacement. Read more here:
 * http://www.adobe.com/devnet/activecontent/articles/beginners_guide.html
 * Assumes you have AC_RunActiveContent.js installed, which is available (with samples) here:
 * http://download.macromedia.com/pub/developer/activecontent_samples.zip
 * 
 * Call the function like so:
 * <?= embed_flash(filename, moviename, moviewidth, movieheight, bgcolor, noscriptid, noscriptcontent); ?>
 * 
 * TODO:
 * Add additional options in a separate array.
 */	
	function embed_flash($swf, $name, $width, $height, $bgcolor, $noscript, $error_msg)
	{
		$flash  = '';
		$flash .= "<script language=\"javascript\">if (AC_FL_RunContent == 0) {alert(\"This page requires AC_RunActiveContent.js.\");} else {AC_FL_RunContent('codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',";
		$flash .= "'width', '" . $width . "',";
		$flash .= "'height', '" . $height . "',";
		$flash .= "'src', '" . $swf . "',";
		$flash .= "'quality', 'high',";
		$flash .= "'pluginspage', 'http://get.adobe.com/flashplayer/',";
		$flash .= "'align', 'middle',";
		$flash .= "'play', 'true',";
		$flash .= "'loop', 'true',";
		$flash .= "'scale', 'showall',";
		$flash .= "'wmode', 'transparent',";
		$flash .= "'devicefont', 'false',";
		$flash .= "'id', '" . $name . "',";
		$flash .= "'name', '" . $name . "',";
		$flash .= "'bgcolor', '#" . $bgcolor . "',";
		$flash .= "'menu', 'true',";
		$flash .= "'allowFullScreen', 'false',";
		$flash .= "'allowScriptAccess','sameDomain',";
		$flash .= "'movie', '" . $swf . "',";
		$flash .= "'salign', ''";
		$flash .= ');}</script>';
		$flash .= '<noscript><div id="' . $noscript . '">';
		$flash .= '<h1>' . $error_msg . '</h1>';
		$flash .= "</div></noscript>";
		$flash .= "\n";
		
		return $flash;
	}
}