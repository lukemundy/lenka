<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY HTML Helper
 *
 * @package Lenka
 * @author Luke Mundy
 */

/**
 * Generate a css <link> tag
 * @param string $href
 * @param string $media
 * @return string
 */
function css($href, $media = 'all')
{
	return '<link href="'. $href .'" rel="stylesheet" type="text/css" media="'. $media .'" />'."\n";
}

/**
 * Generate a <script> tag
 * @param string $src
 * @return string
 */
function script($src)
{
	return '<script src="'. $src .'" type="text/javascript"></script>'."\n";
}
 
 // END - MY_html_helper.php